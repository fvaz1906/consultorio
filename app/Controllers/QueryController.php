<?php

namespace App\Controllers;

use App\Models\Csrf;
use App\Models\User;
use App\Models\Patient;
use App\Models\Query;
use Respect\Validation\Validator;

class QueryController extends BaseController
{
    public function index($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'querys' => Query::all(),
            'patients' => Patient::all(),
            'users' => User::all()
        ];

        return $this->c->view->render($response, 'query/query_list.html', $data);
    }

    public function queryAdd($request, $response)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $medicos = User::all();
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'medicos' => $medicos,
            'csrf' => $csrf
        ];
        return $this->c->view->render($response, 'query/query_add.html', $data);
    }

    public function add($request, $response)
    {
        $date = explode('/', $request->getParam('date_query'));
        $datePart = explode(' ', $date[2]);
        $data = $datePart[0] . '-' . $date[1] . '-' . $date[0] . ' ' . $datePart[1] . ':00';
        $paciente = Patient::where('cpf', str_replace('.','', str_replace('-','', $request->getParam('cpf'))))->first();
        if ($paciente->id):
            Query::create([
                'patient' => $paciente->id,
                'user' => $request->getParam('user'),
                'date_query' => $data
            ]);
            return $response->withRedirect('/query/list');
        else:
            return $response->withRedirect('/query/add');
        endif;
    }

    public function editQuery($request, $response, $args)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf,
            'querys' => Query::select('walt_query.id', 'walt_patient.cpf')->where('walt_query.id', '=', $args['id'])->join('walt_patient', 'walt_query.patient', '=', 'walt_patient.id')->get(),
            'medicos' => User::all(),
        ];
        return $this->c->view->render($response, 'query/query_edit.html', $data);
    }

    public function editPostQuery($request, $response)
    {
        $date = explode('/', $request->getParam('date_query'));
        $datePart = explode(' ', $date[2]);
        $data = $datePart[0] . '-' . $date[1] . '-' . $date[0] . ' ' . $datePart[1] . ':00';
        $paciente = Patient::where('cpf', str_replace('.','', str_replace('-','', $request->getParam('cpf'))))->first();
        Query::where('id', $request->getParam('query_id'))->update([
            'patient' => $paciente->id,
            'user' => $request->getParam('user'),
            'date_query' => $data
        ]);
        return $response->withRedirect('/query/list');
    }

    public function remove($request, $response, $args)
    {
        Query::destroy([$args['id']]);
        return $response->withRedirect('/query/list');
    }

    public function markedQuerys()
    {
        $marked_querys = Query::select('walt_query.id','walt_patient.name', 'walt_query.date_query')
                                ->join('walt_patient', 'walt_query.patient', '=', 'walt_patient.id')
                                ->join('walt_usuarios', 'walt_query.user', '=', 'walt_usuarios.id')
                                ->get();
        return $marked_querys->toJson(JSON_PRETTY_PRINT);
    }

}




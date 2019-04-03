<?php

namespace App\Controllers;

use App\Models\Agreement;
use App\Models\Patient;
use App\Models\Csrf;
use App\Models\Query;
use App\Models\User;

class PatientController extends BaseController
{
    public function index($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'patients' => Patient::select('walt_patient.id', 'walt_patient.name', 'walt_patient.cpf', 'walt_patient.cellphone', 'walt_patient.email', 'walt_agreement.agreement')->leftJoin('walt_agreement', 'walt_patient.agreement', '=', 'walt_agreement.id')->get()
        ];

        return $this->c->view->render($response, 'patient/patient_list.html', $data);
    }

    public function addPatient($request, $response)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);

        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'agreements' => Agreement::all(),
            'csrf' => $csrf
        ];
        
        return $this->c->view->render($response, 'patient/patient_add.html', $data);
    }

    public function editPatient($request, $response, $args)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);

        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf,
            'patients' => Patient::find([$args['id']]),
            'agreements' => Agreement::all()
        ];

        return $this->c->view->render($response, 'patient/patient_edit.html', $data);
    }

    public function add($request, $response)
    {
        $patient = Patient::create([
            'name' => ucwords(strtolower($request->getParam('name'))),
            'sex' => $request->getParam('sex'),
            'date_birth' => $request->getParam('date_birth'),
            'cpf' => str_replace('.','', str_replace('-','', $request->getParam('cpf'))),
            'cellphone' => str_replace(' ','', str_replace('(','', str_replace(')','', str_replace('-','', $request->getParam('cellphone'))))),
            'email' => strtolower($request->getParam('email')),
            'color' => strtolower($request->getParam('color')),
            'cep' => str_replace('-','', $request->getParam('cep')),
            'street' => $request->getParam('street'),
            'number' => $request->getParam('number') == null ? null:$request->getParam('number'),
            'neighborhood' => $request->getParam('neighborhood'),
            'complement' => $request->getParam('complement') == null ? null:$request->getParam('complement'),
            'city' => $request->getParam('city'),
            'state' => $request->getParam('state'),
            'agreement' => $request->getParam('agreement') == null ? null:$request->getParam('agreement')
        ]);

        return $response->withRedirect('/patient/view/' . $patient->id);
    }

    public function edit($request, $response)
    {
        Patient::where('id', $request->getParam('patient_id'))->update([
            'name' => ucwords(strtolower($request->getParam('name'))),
            'sex' => $request->getParam('sex'),
            'date_birth' => $request->getParam('date_birth'),
            'cpf' => str_replace('.','', str_replace('-','', $request->getParam('cpf'))),
            'cellphone' => str_replace(' ','', str_replace('(','', str_replace(')','', str_replace('-','', $request->getParam('cellphone'))))),
            'email' => strtolower($request->getParam('email')),
            'color' => strtolower($request->getParam('color')),
            'cep' => str_replace('-','', $request->getParam('cep')),
            'street' => $request->getParam('street'),
            'number' => $request->getParam('number') == null ? null:$request->getParam('number'),
            'neighborhood' => $request->getParam('neighborhood'),
            'complement' => $request->getParam('complement') == null ? null:$request->getParam('complement'),
            'city' => $request->getParam('city'),
            'state' => $request->getParam('state'),
            'agreement' => $request->getParam('agreement') == null ? null:$request->getParam('agreement')
        ]);
        return $response->withRedirect('/patient/view/' . $request->getParam('patient_id'));
    }

    public function remove($request, $response, $args)
    {
        Patient::destroy([$args['id']]);
        return $response->withRedirect('/patient/list');
    }

    public function view($request, $response, $args)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);

        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'patients' => Patient::find($args['id']),
            'querys' => Query::select('walt_query.id', 'walt_query.patient as patient_id', 'walt_patient.name as patient_name', 'walt_usuarios.name as doctor_name', 'walt_query.date_query')->join('walt_patient', 'walt_query.patient', '=', 'walt_patient.id')->join('walt_usuarios', 'walt_query.user', '=', 'walt_usuarios.id')->where('walt_query.date_query', '>', date('Y-m-d H:i:s'))->where('walt_query.patient', '=', $args['id'])->get(),
            'histQuerys' => Query::select('walt_query.id', 'walt_query.patient as patient_id', 'walt_patient.name as patient_name', 'walt_usuarios.name as doctor_name', 'walt_query.date_query')->join('walt_patient', 'walt_query.patient', '=', 'walt_patient.id')->join('walt_usuarios', 'walt_query.user', '=', 'walt_usuarios.id')->where('walt_query.date_query', '<', date('Y-m-d H:i:s'))->where('walt_query.patient', '=', $args['id'])->get(),
            'doctors' => User::where('perfil', '=', 1)->where('email', '!=', 'admin@teste.com')->get(),
            'csrf' => $csrf
        ];

        return $this->c->view->render($response, 'patient/patient_view.html', $data);
    }
}
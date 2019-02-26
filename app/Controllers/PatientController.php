<?php

namespace App\Controllers;

use App\Models\Agreement;
use App\Models\Patient;
use App\Models\Csrf;

class PatientController extends BaseController
{
    public function index($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'patients' => Patient::all(),
            'agreements' => Agreement::all()
        ];

        return $this->c->view->render($response, 'patient/list_patient.html', $data);
    }

    public function addPatient($request, $response)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);

        $data = [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'agreements' => Agreement::all(),
            'csrf' => $csrf
        ];
        
        return $this->c->view->render($response, 'patient/add_patient.html', $data);
    }

    public function add($request, $response)
    {
        Patient::create([
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
            'agreement' => $request->getParam('agreement')
        ]);

        return $response->withRedirect('/patient/list');
    }
}
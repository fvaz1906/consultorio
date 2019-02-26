<?php

namespace App\Controllers;

use App\Models\Agreement;

class PatientController extends BaseController
{
    public function index($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg'
        ];

        return $this->c->view->render($response, 'patient/list_patient.html', $data);
    }

    public function add($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'agreements' => Agreement::all()
        ];
        
        return $this->c->view->render($response, 'patient/add_patient.html', $data);
    }
}
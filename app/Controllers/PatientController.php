<?php

namespace App\Controllers;

use App\Models\User;

class PatientController extends BaseController
{
    public function index($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg'
        ];

        return $this->c->view->render($response, 'patient/list_patient.twig', $data);
    }

    public function add($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg'
        ];
        
        return $this->c->view->render($response, 'patient/add_patient.twig', $data);
    }
}
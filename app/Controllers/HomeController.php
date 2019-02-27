<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\Query;

class HomeController extends BaseController
{
    public function index($request, $response)
    {
        return $this->c->view->render($response, 'home.html', [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'number_patients' => Patient::all()->count(),
            'number_querys' => Query::all()->count()
        ]);
    }

    public function logout($request, $response)
    {
        $auth = User::where('token', $_SESSION['TOKEN'])->get();
        foreach ($auth as $item):
                $item->token = null;
                $item->save();
                unset($_SESSION['TOKEN']);
                unset($_SESSION['USER']);
                return $response->withRedirect('/auth/sign');
        endforeach;
    }

}
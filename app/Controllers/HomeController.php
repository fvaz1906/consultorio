<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\Query;
use App\Models\Finances;

/**
 *     [TOKEN] => 098d41baa6906f381c9c357125010ce0
 *     [USER] => prfelipevaz@gmail.com
 *     [PERFIL] => 1
 */

class HomeController extends BaseController
{
    public function index($request, $response)
    {
        $financeValue = 0;
        $entradas = Finances::select('value')->where('active', 1)->where('type_movement', 1)->get();
        $saidas = Finances::select('value')->where('active', 1)->where('type_movement', 0)->get();
        foreach ($entradas as $e):
            $financeValue += $e->value;
        endforeach;
        foreach ($saidas as $s):
            $financeValue -= $s->value;
        endforeach;
        return $this->c->view->render($response, 'home.html', [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'number_patients' => Patient::all()->count(),
            'number_querys' => Query::all()->count(),
            'finance_value' => $financeValue
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
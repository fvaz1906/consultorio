<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\GCalendar;

class HomeController extends BaseController
{
    public function index($request, $response)
    {
        $agenda = new Gcalendar;
        $agenda->getClient();
        $agenda->serviceCalendar();
        $agenda->getAgenda();
        die;
        return $this->c->view->render($response, 'home.twig', [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg'
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
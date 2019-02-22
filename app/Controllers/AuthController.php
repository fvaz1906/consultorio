<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Auth;
use App\Models\Log;
use App\Models\Csrf;

class AuthController extends BaseController
{
    public function getSignUp($request, $response)
    {
        return $this->c->view->render($response, 'authentication/signup.twig');
    }

    public function postSignUp($request, $response)
    {

        User::create([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);

        return $response->withRedirect('/auth/sign');
    }

    public function getSign($request, $response)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        //$logger = new Log;
        //$logger->generateLog('aplicação iniciada... ' . $_SERVER['REMOTE_ADDR']);
        return $this->c->view->render($response, 'authentication/sign.twig', ['csrf' => $csrf]);
    }

    public function postSign($request, $response)
    {
        $data = User::where('email', $request->getParam('email'))->get();
        $auth = new Auth($data, $request->getParam('password'));
        $auth->scrollData();
        if ($auth->returnAuthentication()):
            return $response->withRedirect('/');
        else:
            return $response->withRedirect('/auth/sign');
        endif;
    }
}
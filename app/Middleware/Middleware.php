<?php

namespace App\Middleware;

use App\Models\User;

//prfelipevaz@gmail.com

class Middleware extends BaseMiddleware
{

    private $token;
    private $users = [];

    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['TOKEN'])):
            $this->users = User::where('token', $_SESSION['TOKEN'])->get();
            $this->generatorToken(); $this->saveToken(); $this->guardSessionToken();
            $response = $next($request, $response);
        else:
            $response = $response->withRedirect($this->router->pathFor('auth.sign'), 302);
        endif;

        return $response;
    }

    public function saveToken()
    {
        foreach ($this->users as $user)
        $user->token = $this->getToken();
        $user->save();
    }

    public function generatorToken()
    {
        $this->setToken(md5(uniqid(rand(), true)));
    }

    public function guardSessionToken()
    {
        $_SESSION['TOKEN'] = $this->getToken();
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
    
}
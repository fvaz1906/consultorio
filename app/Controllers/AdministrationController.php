<?php

namespace App\Controllers;

use App\Models\Agreement;
use App\Models\Csrf;
use App\Models\User;

class AdministrationController extends BaseController
{
    public function index($request, $response)
    {
        $covenants = Agreement::all();
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'covenants' => $covenants
        ];
        return $this->c->view->render($response, 'administration/agreement_list.html', $data);
    }

    public function editAgreement($request, $response, $args)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf,
            'agreement' => Agreement::find([$args['id']])
        ];
        return $this->c->view->render($response, 'administration/agreement_edit.html', $data);
    }

    public function add($request, $response)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf
        ];
        return $this->c->view->render($response, 'administration/agreement_add.html', $data);
    }

    public function edit($request, $response)
    {
        Agreement::where('id', $request->getParam('agreement_id'))->update(['agreement' => $request->getParam('agreement')]);
        return $response->withRedirect('/administration/agreement/list');
    }

    public function postAgreement($request, $response)
    {
        Agreement::create([
            'agreement' => $request->getParam('agreement'),
        ]);
        return $response->withRedirect('/administration/agreement/list');
    }

    public function remove($request, $response, $args)
    {
        Agreement::destroy([$args['id']]);
        return $response->withRedirect('/administration/agreement/list');
    }

    public function listUsers($request, $response)
    {
        $users = User::select('walt_usuarios.id as user_id', 'walt_perfil.perfil as name_perfil', 'walt_usuarios.name', 'walt_usuarios.crm_cpf', 'walt_usuarios.email', 'walt_usuarios.celular')->join('walt_perfil', 'walt_usuarios.perfil', '=', 'walt_perfil.id')->get();
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'users' => $users
        ];
        return $this->c->view->render($response, 'administration/users_list.html', $data);
    }

    public function editUsers($request, $response, $args)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf,
            'users' => User::find([$args['id']])
        ];
        return $this->c->view->render($response, 'administration/users_edit.html', $data);
    }

    public function postEditUser($request, $response, $args)
    {
        if($request->getParam('crm_cpf_1')):
            $crm_cpf = str_replace('.','', str_replace('-','', $request->getParam('crm_cpf_1')));
        else:
            $crm_cpf = $request->getParam('crm_cpf_2');
        endif;
        User::where('id', $request->getParam('user_id'))
            ->update([
                'name' => ucwords(strtolower($request->getParam('name'))),
                'email' => strtolower($request->getParam('email')),
                'perfil' => $request->getParam('perfil'),
                'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
                'celular' => str_replace(' ','', str_replace('(','', str_replace(')','', str_replace('-','', $request->getParam('celular'))))),
                'crm_cpf' => $crm_cpf,
                'token' => null
            ]);
        return $response->withRedirect('/auth/sign');
    }

    public function addUsers($request, $response)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf
        ];
        return $this->c->view->render($response, 'administration/users_add.html', $data);
    }

    public function postUsers($request, $response)
    {
        if($request->getParam('crm_cpf_1')):
            $crm_cpf = str_replace('.','', str_replace('-','', $request->getParam('crm_cpf_1')));
        else:
            $crm_cpf = $request->getParam('crm_cpf_2');
        endif;

        User::create([
            'name' => ucwords(strtolower($request->getParam('name'))),
            'email' => strtolower($request->getParam('email')),
            'perfil' => $request->getParam('perfil'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
            'celular' => str_replace(' ','', str_replace('(','', str_replace(')','', str_replace('-','', $request->getParam('celular'))))),
            'crm_cpf' => $crm_cpf,
            'token' => null
        ]);
        return $response->withRedirect('/administration/users/list');
    }

    public function removeUsers($request, $response, $args)
    {
        User::destroy([$args['id']]);
        return $response->withRedirect('/administration/users/list');
    }

}
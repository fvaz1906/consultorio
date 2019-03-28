<?php

namespace App\Controllers;

use App\Models\Agreement;
use App\Models\Csrf;
use App\Models\User;
use App\Models\Cid;
use App\Models\Exam;
use App\Models\Medicine;

class AdministrationController extends BaseController
{
    public function index($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'covenants' => Agreement::all()
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
            'name_user' => $_SESSION['NAME'],
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

    public function listCid($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'cids' => Cid::all()
        ];
        return $this->c->view->render($response, 'administration/cid_list.html', $data);
    }

    public function listExam($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'exams' => Exam::all()
        ];
        return $this->c->view->render($response, 'administration/exam_list.html', $data);
    }

    public function addExam($request, $response)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf
        ];
        return $this->c->view->render($response, 'administration/exam_add.html', $data);
    }

    public function postAddExam($request, $response)
    {
        Exam::create([
            'exam' => ucwords(strtolower($request->getParam('exam'))),
            'material' => $request->getParam('material'),
            'normal_values' => $request->getParam('normal_values'),
            'description' => $request->getParam('description')
        ]);
        return $response->withRedirect('/administration/exam/list');
    }

    public function editExam($request, $response, $args)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf,
            'exams' => Exam::find([$args['id']])
        ];
        return $this->c->view->render($response, 'administration/exam_edit.html', $data);
    }

    public function postEditExam($request, $response)
    {
        Exam::where('id', $request->getParam('exam_id'))
            ->update([
                'exam' => ucwords(strtolower($request->getParam('exam'))),
                'material' => $request->getParam('material'),
                'normal_values' => $request->getParam('normal_values'),
                'description' => $request->getParam('description')
            ]);
        return $response->withRedirect('/administration/exam/list');
    }

    public function removeExam($request, $response, $args)
    {
        Exam::destroy([$args['id']]);
        return $response->withRedirect('/administration/exam/list');
    }

    public function listMedicine($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'medicines' => Medicine::all()
        ];
        return $this->c->view->render($response, 'administration/medicine_list.html', $data);
    }

    public function addMedicine($request, $response)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf
        ];
        return $this->c->view->render($response, 'administration/medicine_add.html', $data);
    }

    public function postAddMedicine($request, $response)
    {
        Medicine::create([
            'medicine' => ucwords(strtolower($request->getParam('medicine'))),
            'active_principle' => $request->getParam('active_principle'),
            'concentration' => $request->getParam('concentration'),
            'type_use' => $request->getParam('type_use'),
            'type_packing' => strtolower($request->getParam('type_packing')),
            'dosage' => strtolower($request->getParam('dosage'))
        ]);
        return $response->withRedirect('/administration/medicine/list');
    }

    public function editMedicine($request, $response, $args)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf,
            'medicines' => Medicine::find([$args['id']])
        ];
        return $this->c->view->render($response, 'administration/medicine_edit.html', $data);
    }

    public function postEditMedicine($request, $response)
    {
        Medicine::where('id', $request->getParam('medicine_id'))
            ->update([
                'medicine' => ucwords(strtolower($request->getParam('medicine'))),
                'active_principle' => $request->getParam('active_principle'),
                'concentration' => $request->getParam('concentration'),
                'type_use' => $request->getParam('type_use'),
                'type_packing' => strtolower($request->getParam('type_packing')),
                'dosage' => strtolower($request->getParam('dosage'))
            ]);
        return $response->withRedirect('/administration/medicine/list');
    }

    public function removeMedicine($request, $response, $args)
    {
        Medicine::destroy([$args['id']]);
        return $response->withRedirect('/administration/medicine/list');
    }

    public function medicine()
    {
        $medicine = Medicine::select('walt_medicine.medicine')->get();
        return $medicine->toJson(JSON_PRETTY_PRINT);
    }

}
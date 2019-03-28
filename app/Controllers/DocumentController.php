<?php

namespace App\Controllers;

use App\Models\Recipe;
use App\Models\RecipeMedicine;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Csrf;

class DocumentController extends BaseController
{

    public function index($request, $response)
    {
        /*$data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'patients' => Patient::select('walt_patient.id', 'walt_patient.name', 'walt_patient.cpf', 'walt_patient.cellphone', 'walt_patient.email', 'walt_agreement.agreement')->leftJoin('walt_agreement', 'walt_patient.agreement', '=', 'walt_agreement.id')->get()
        ];
        return $this->c->view->render($response, 'patient/patient_list.html', $data);*/
    }

    public function listRecipe($request, $response)
    {
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'recipes' => Recipe::select('walt_usuarios.name as doctor', 'walt_patient.name as patient', 'walt_recipe.created_at')->join('walt_usuarios', 'walt_recipe.id_doctor', '=', 'walt_usuarios.id')->join('walt_patient', 'walt_recipe.id_patient', '=', 'walt_patient.id')->get()
        ];
        return $this->c->view->render($response, 'documents/recipe_list.html', $data);
    }

    public function addRecipe($request, $response, $args)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'id_doctor' => $_SESSION['ID'],
            'id_patient' => $args['id'],
            'medicines' => Medicine::all(),
            'csrf' => $csrf
        ];
        return $this->c->view->render($response, 'documents/recipe_add.html', $data);
    }

    public function addRecipeMedicine($request, $response)
    {
        $recipe = Recipe::create([
            'id_doctor' => $request->getParam('id_doctor'),
            'id_patient' => $request->getParam('id_patient'),
            'annotation' => $request->getParam('annotation') == null ? null:$request->getParam('annotation')
        ]);
        foreach ($request->getParam('medicine') as $value):
            RecipeMedicine::create(['id_recipe' => $recipe->id, 'id_medicine' => $value]);
        endforeach;
        return $response->withRedirect('/documents/recipe/list');
    }

    public function editPatient($request, $response, $args)
    {
        /*-$guard = new Csrf;
        $csrf = $guard->generateCsrf($request);
        $data = [
            'name_user' => $_SESSION['NAME'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf,
            'patients' => Patient::find([$args['id']]),
            'agreements' => Agreement::all()
        ];
        return $this->c->view->render($response, 'patient/patient_edit.html', $data);*/
    }

    public function add($request, $response)
    {
        /*Patient::create([
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
            'agreement' => $request->getParam('agreement') == null ? null:$request->getParam('agreement')
        ]);
        return $response->withRedirect('/patient/list');*/
    }

    public function edit($request, $response)
    {
        /*Patient::where('id', $request->getParam('patient_id'))->update([
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
            'agreement' => $request->getParam('agreement') == null ? null:$request->getParam('agreement')
        ]);
        return $response->withRedirect('/patient/list');*/
    }

    public function remove($request, $response, $args)
    {
        /*Patient::destroy([$args['id']]);
        return $response->withRedirect('/patient/list');*/
    }

}
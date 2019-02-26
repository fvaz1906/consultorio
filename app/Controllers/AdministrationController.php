<?php

namespace App\Controllers;

use App\Models\Agreement;
use App\Models\Csrf;

class AdministrationController extends BaseController
{
    public function index($request, $response)
    {

        $covenants = Agreement::all();

        $data = [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'covenants' => $covenants
        ];

        return $this->c->view->render($response, 'administration/agreement_list.html', $data);
    }

    public function add($request, $response)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);

        $data = [
            'name_user' => $_SESSION['USER'],
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

    public function removeAgreement($request, $response, $args)
    {
        Agreement::destroy([$args['id']]);
        return $response->withRedirect('/administration/agreement/list');
    }

    public function editAgreement($request, $response, $args)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);

        $data = [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf,
            'agreement' => Agreement::find([$args['id']])
        ];

        return $this->c->view->render($response, 'administration/agreement_edit.html', $data);
    }

}
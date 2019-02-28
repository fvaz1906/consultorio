<?php

namespace App\Controllers;

use App\Models\Csrf;
use App\Models\Finances;

class FinancesController extends BaseController
{
    public function index($request, $response)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);

        $finances = Finances::where('created_at', 'like', date('Y-m-d') . '%')->get();

        return $this->c->view->render($response, 'finances/finances_cashier.html', [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf,
            'finances' => $finances
        ]);
    }

    public function add($request, $response)
    {
        Finances::create([
            'cpf' => str_replace('.','', str_replace('-','', $request->getParam('cpf'))),
            'value' => $request->getParam('value'),
            'description' => $request->getParam('description'),
            'type_movement' => $request->getParam('type_movement'),
        ]);

        return $response->withRedirect('/finances/cashier');
    }

}
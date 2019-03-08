<?php

namespace App\Controllers;

use App\Models\Csrf;
use App\Models\Finances;
use App\Models\Receipts;
use App\Models\Cid;
use App\Models\Cid02;
use \Mpdf\Mpdf;

class FinancesController extends BaseController
{
    public function index($request, $response, $args)
    {
        $guard = new Csrf;
        $csrf = $guard->generateCsrf($request);

        if ($args['type'] == 'dia') :
            $finances = Finances::whereDay('created_at', '=', date('d'))->get();
        else:
            $finances = Finances::whereMonth('created_at', '=', date('m'))->get();
        endif;
        return $this->c->view->render($response, 'finances/finances_cashier.html', [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'csrf' => $csrf,
            'finances' => $finances,
            'type' => $args['type']
        ]);
    }

    public function add($request, $response)
    {
        Finances::create([
            'cpf' => str_replace('.','', str_replace('-','', $request->getParam('cpf'))),
            'value' => $request->getParam('value'),
            'description' => $request->getParam('description'),
            'type_movement' => $request->getParam('type_movement'),
            'active' => 1
        ]);

        return $response->withRedirect('/finances/dia');
    }

    public function remove($request, $response, $args)
    {
        $receipts = Receipts::where('finances_id', $args['id'])->get();
        $count = count($receipts);
        if ($count>0):
            Finances::where('id', $args['id'])->update(['active' => 0]);
        endif;
        return $response->withRedirect('/finances/mes');
    }

    public function print($request, $response, $args)
    {
        $printFinances = Finances::find($args['id']);
        self::savePdf($printFinances);
        self::generatePdf($printFinances);
    }

    private function savePdf($datas)
    {
        Receipts::create([
            'finances_id' => $datas->id,
            'cpf' => $datas->cpf,
            'value' => $datas->value,
            'description' => $datas->description
        ]);
    }

    private function generatePdf($datas)
    {
        $mpdf = new Mpdf([
            'tempDir' => '/tmp',
            'mode' => 'utf-8',
            'format' => [120, 190],
            'orientation' => 'L'
        ]);
        $mpdf->SetHeader('Walterritti - Consultório Médico||Recibo de Pagamento');
        $mpdf->SetFooter('CNPJ: 11.111.111/0001-11, Rua teste teste nº 111, Bairro: Teste - Fortaleza/CE');
        $mpdf->WriteHTML("
            <htm>
                <head>
                    <title>Recibo de Pagamento</title>
                    <style>
                        body {
                            font-size: 18px;
                            line-height: 2em;
                        }
                    </style>
                </head>
                <body>
                    <br>
                    Recebemos de ..................................................................... inscrito no CPF: " . $datas->cpf . ", a quantia de R$ " . number_format($datas->value, '2',',','') . " (........................................), correspondente a(o) <b>" . $datas->description . "</b> , e para clareza firmo(amos) o presente na cidade de .................................... no dia " . date('d') . " de " . ucfirst(strftime('%B')) . " de " . date('Y') . ".
                    <br><br>
                    <p>Assinatura: ....................................................</p>
                </body>
            </html>
        ");
        $mpdf->Output();
        die;
    }

    public function listReceipts($request, $response)
    {
        return $this->c->view->render($response, 'finances/list_receipts.html', [
            'name_user' => $_SESSION['USER'],
            'photo_user' => '/assets/images/default-avatar.jpg',
            'receipts' => Receipts::all()
        ]);
    }

    public function printReceipt($request, $response, $args)
    {
        $receipts = Receipts::find([$args['id']]);
        $mpdf = new Mpdf([
            'tempDir' => '/tmp',
            'mode' => 'utf-8',
            'format' => [120, 190],
            'orientation' => 'L'
        ]);
        $mpdf->SetHeader('Walterritti - Consultório Médico||Recibo de Pagamento');
        $mpdf->SetFooter('CNPJ: 11.111.111/0001-11, Rua teste teste nº 111, Bairro: Teste - Fortaleza/CE');
        foreach ($receipts as $receipt) :
            $mpdf->WriteHTML("
                <htm>
                    <head>
                        <title>Recibo de Pagamento</title>
                        <style>
                            body {
                                font-size: 18px;
                                line-height: 2em;
                            }
                        </style>
                    </head>
                    <body>
                        <br>
                        Recebemos de ..................................................................... inscrito no CPF: " . $receipt->cpf . ", a quantia de R$ " . number_format($receipt->value, '2',',','') . " (........................................), correspondente a(o) <b>" . $receipt->description . "</b> , e para clareza firmo(amos) o presente na cidade de .................................... no dia " . date('d') . " de " . ucfirst(strftime('%B')) . " de " . date('Y') . ".
                        <br><br>
                        <p>Assinatura: ....................................................</p>
                    </body>
                </html>
            ");
        endforeach;
        $mpdf->Output();
        die;
    }

    public function DocsCid($request, $response)
    {
        $cid = Cid02::select('codigo', 'descricao')->get();
        foreach ($cid as $c) :
            Cid::create([ 'code' => $c->codigo, 'description' => $c->descricao ]);
        endforeach;
        echo 'ok!';
        die;
    }

}
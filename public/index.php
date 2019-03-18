<?php

header("Access-Control-Allow-Origin: *");
date_default_timezone_set('America/Fortaleza');
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' ); 

session_start();

require '../bootstrap/app.php';
require '../bootstrap/container.php';
require '../bootstrap/routes.php';

$app->add(new \Slim\Csrf\Guard);
$app->run();

<?php

date_default_timezone_set('America/Fortaleza');

session_start();

require '../bootstrap/app.php';
require '../bootstrap/container.php';
require '../routes/web.php';

$app->add(new \Slim\Csrf\Guard);
$app->run();

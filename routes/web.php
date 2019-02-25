<?php 

//Autenticação
$app->get('/auth/sign', '\App\Controllers\AuthController:getSign')->setName('auth.sign');
$app->post('/auth/sign', '\App\Controllers\AuthController:postSign');
$app->get('/auth/signup', '\App\Controllers\AuthController:getSignUp')->setName('auth.signup');
$app->post('/auth/signup', '\App\Controllers\AuthController:postSignUp');

//Home
$app->get('/', '\App\Controllers\HomeController:index')->add( new \App\Middleware\Middleware($container));
$app->get('/logout', '\App\Controllers\HomeController:logout')->setName('logout');

//Pacientes
$app->get('/patient/list', '\App\Controllers\PatientController:index')->add( new \App\Middleware\Middleware($container));
$app->get('/patient/add', '\App\Controllers\PatientController:add')->add( new \App\Middleware\Middleware($container));
<?php

$container = $app->getContainer();

//Container untuk View
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig( __DIR__ . '/../resources/views', [
        'cache' => false
    ]);
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->addConnection($container['settings']['db2'], 'db2');
$capsule->setAsGlobal();
$capsule->bootEloquent();

//Container untuk database
$container['db'] = function ($container) use ($capsule){
    return $capsule;
};

$container['validator'] = function ($container) {
    return new App\Validation\Validator;
};

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('app_dashboard');
    $file_handler = new \Monolog\Handler\StreamHandler( __DIR__ . '/../public/logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard;
};
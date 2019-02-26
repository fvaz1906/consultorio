<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
         'db' => [
            'driver'   => 'mysql',
            'host'     => 'localhost',
            'database' => 'walterritti',
            'username' => 'root',
            'password' => '@Cqc4ymtz',
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => '',
        ]
    ]
]);
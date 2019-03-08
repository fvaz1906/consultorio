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
         ],
         'db2' => [
            'driver'   => 'mysql',
            'host'     => '216.172.172.65',
            'database' => 'infovazc_dbmeds',
            'username' => 'infovazc_adm',
            'password' => 's4p069@Felipe',
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => '',
        ]
    ]
]);
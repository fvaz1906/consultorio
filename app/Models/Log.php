<?php

namespace App\Models;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Log
{
    const app_name = 'app_dashboard';
    const way = __DIR__ . '/../../public/logs/app.log';

    private $log;
    private $log_instance;

    public function __construct()
    {
        $this->setLog_instance(new Logger(self::app_name));
        $this->addHandler();
    }

    public function addHandler()
    {
        $this->getLog_instance()->pushHandler(new StreamHandler(self::way, Logger::DEBUG));
        $this->getLog_instance()->pushHandler(new FirePHPHandler());
    }

    public function generateLog($log)
    {
        $this->setLog($log);
        $this->infoLog();
    }

    public function infoLog()
    {
        $this->getLog_instance()->info($this->getLog());
    }

    public function getLog() { return $this->log; }

    public function setLog($log) { $this->log = $log; return $this; }

    public function getLog_instance() { return $this->log_instance; }

    public function setLog_instance($log_instance) { $this->log_instance = $log_instance; return $this; }
}
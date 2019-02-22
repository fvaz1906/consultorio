<?php

namespace App\Models;

use \Slim\Csrf\Guard;

class Csrf
{
    private $slimGuard;
    
    public function __construct()
    {
        $this->setSlimGuard(new \Slim\Csrf\Guard);
    }

    public function generateCsrf($request)
    {
        $name = [
            'nameKey' => $this->getSlimGuard()->getTokenNameKey(),
            'valueKey' => $this->getSlimGuard()->getTokenValueKey()
        ];

        $value = [
            'name' => $request->getAttribute($name['nameKey']),
            'value' => $request->getAttribute($name['valueKey'])
        ];

        return array_merge($name, $value);
    }

    public function getSlimGuard()
    {
        return $this->slimGuard;
    }

    public function setSlimGuard($slimGuard)
    {
        $this->slimGuard = $slimGuard;

        return $this;
    }
}
<?php

namespace App\Controllers;

use Interop\Container\ContainerInterface;

class BaseController
{
    protected $c;

    public function __construct(ContainerInterface $container)
    {
        $this->c = $container;
    }
}

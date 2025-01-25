<?php

namespace App\Middleware;

use App\Config\Session;

abstract class BaseMiddleware
{
    protected Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }
    abstract public function handle(): void;

}
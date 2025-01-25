<?php

namespace App\Middleware;

class AuthMiddleware extends BaseMiddleware
{
    public function handle(): void
    {
        if(!$this->session->hasKey('User')){
            header('Location: login.php');
            exit();
        }
    }
}
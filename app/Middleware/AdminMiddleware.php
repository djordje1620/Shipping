<?php

namespace App\Middleware;

class AdminMiddleware extends BaseMiddleware
{
    public function handle(): void
    {
        if(!$this->session->hasKey('Role') || $this->session->get('Role')!==1){
            header('Location: unauthorized.php');
            exit();
        }
    }
}
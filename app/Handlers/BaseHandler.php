<?php

namespace App\Handlers;

use App\Config\Session;
use App\Interfaces\IRequestHandler;

abstract class BaseHandler implements IRequestHandler
{
    protected Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    protected function checkAuth(): void
    {
        if(!$this->session->hasKey('User')){
            header('Location:login.php');
            exit();
        }
    }

    public function isAdmin(): bool
    {
        if($this->session->hasKey('Role') && $this->session->get('Role')===1){
             return true;
        }
        return false;
    }
    protected function redirect(string $url): void
    {
        header("Location:$url");
        exit();
    }

    protected function getRequestData(): array
    {
        switch ($_SERVER['REQUEST_METHOD']){
            case 'POST':
                if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
                    $data = file_get_contents('php://input');
                    return json_decode($data, true);
                }
                return $_POST;
                break;
            case 'GET':
                return $_GET;
                break;
            default:
                throw new Exception("Unsupported request method");
        }
    }

    abstract public function handleRequest(): void;
   
}

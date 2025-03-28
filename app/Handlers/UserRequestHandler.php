<?php

namespace App\Handlers;

use App\Controllers\UserController;
use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;

class UserRequestHandler extends BaseHandler
{
    public function handleRequest(): void
    {
        $data = $this->getRequestData(); //Dobijamo podatke sa odg HTTP zahteva (POST, GET)

        if(!isset($data['type'])){
            throw new \Exception("Invalid request type!");
        }
        $type = strtolower(($data['type']));
        $userController = new UserController();
        $authMiddleware = new AuthMiddleware();

        switch ($type){
            case "register":
                $response = $userController->register($data);
                $redirectTo = "login.php";
                break;
            case "login":
                $response = $userController->login($data);
                $redirectTo = $this->isAdmin() ? "admin-panel.php" : "index.php";
                break;
            case "logout":
                $authMiddleware->handle();
                $response = $userController->logout();
                $redirectTo = "index.php";
                break;
            default:
                throw new \Exception("Invalid type");
        }

        if($response){
            $this->redirect("../../views/$redirectTo");
        }else{
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
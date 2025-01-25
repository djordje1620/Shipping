<?php

namespace App\Handlers;

use App\Controllers\ShipmentController;
use App\Middleware\AuthMiddleware;

class ShipmentRequestHandler extends BaseHandler
{
    public function handleRequest(): void
    {
        $authMIddleware = new AuthMiddleware();
        $authMIddleware->handle();
        
        $data = $this->getRequestData();

        if(!isset($data['type'])){
            throw new \Exception("Invalid request type");
        }

        $type = strtolower($data['type']);
        $shipmentController = new ShipmentController();

        switch ($type){
            case "create":
                $response = $shipmentController->create($data);
                $redirectTo = "index.php";
                break;
            case "delete":
                $response = $shipmentController->delete($data);
                $redirectTo = "index.php";
                break;
            default:
                throw new \Exception("Invalid type!");
        }

        if($response) {
            $this->redirect("../../$redirectTo");
        }else{
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
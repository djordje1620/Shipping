<?php

namespace App\Controllers;

use App\Config\Session;
use App\Models\Shipments;
use App\Services\ShipmentService;
use App\Validators\Shipments\CreateShipmentValidator;
use App\Validators\Shipments\DeleteShipmentValidator;
use http\Params;

class ShipmentController
{
    private readonly Session $session;
    private readonly ShipmentService $shipmentService;
    public function __construct()
    {
        $this->session = new Session();
        $this->shipmentService = new ShipmentService();
    }

    public function create(array $data): bool
    {
        $validator = new CreateShipmentValidator();
        if(!$validator->validateData($data)){
            $this->session->flash("form_validation_error", $validator->getErrors());
            return false;
        }
        return $this->shipmentService->create($this->session->get('User'), $data);
    }
    public function delete(array $data): bool
    {
        $validator = new DeleteShipmentValidator();
        if(!$validator->validateData($data)){
            $this->session->flash("form_validation_error", "Niste dobro uneli podatke");
            return false;
        }

        $shipment = $this->shipments->getShipmentById($data['id']);

        if($shipment === null || $shipment['user_id'] !== $this->session->flash('User')){
           return  false;
        }
        $this->shipments->delete($data['id']);
        return true;


    }
}

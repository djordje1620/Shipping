<?php

use App\Handlers\ShipmentRequestHandler;

require_once "../../vendor/autoload.php";

$shipmentRequestHandler = new ShipmentRequestHandler();
$shipmentRequestHandler->handleRequest();




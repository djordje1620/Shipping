<?php

use App\Config\Session;
use App\Enums\Shipments\MethodEnum;
use App\Enums\Shipments\SizeEnum;
use App\Enums\Shipments\StatusEnum;
use App\Enums\Shipments\LocationEnum;
use App\Middleware\AuthMiddleware;
use App\Repositories\ShipmentRepository;

require_once "vendor/autoload.php";

    $session = new Session();
    $authMiddleware = new AuthMiddleware();
    $authMiddleware->handle();

    $shipmentRepository = new ShipmentRepository();
    $shipments = $shipmentRepository->getShipmentsForUser($session->get('User'));
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Shipment Details: <span class="font-weight-bold"><?= $shipments[0]['first_name']?> <?= $shipments[0]['last_name'] ?></span></h2>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Enter Tracking Number</h5>

                    <div class="input-group mb-3">
                        <input type="text" name="tracking_number" id="tracking_number" value="78043988" class="form-control" placeholder="Enter Tracking Number" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="check_tn" name="send_tn">Check</button>
                        </div>
                    </div>

                    <p id="message" class="text-center text-danger"></p>
                </div>
            </div>
        </div>
    </div>

    <div id="shipment-details" class="mt-5">
    </div>

</div>


    <script src="public/js/trackShipment.js"></script>
</body>
</html>






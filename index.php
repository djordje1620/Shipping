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
</head>
<body>
<div class="container mt-5">
    <h2>Shipment Details: (<?= $shipments[0]['first_name']?> <?= $shipments[0]['last_name'] ?>)</h2>
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Tracking number</th>
            <th>Status</th>
            <th>Size</th>
            <th>Location From</th>
            <th>Location To</th>
            <th>Method</th>
            <th>Note</th>
            <th>Delivery Information</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($shipments as $shipment): ?>
            <tr>
                <td><?= $shipment['tracking_number'] ?></td>
                <td><?= StatusEnum::from($shipment['status'])->getStatusName() ?></td>
                <td><?= SizeEnum::from($shipment['size'])->getSizeName()  ?></td>
                <td><?= LocationEnum::from($shipment['location_from'])->getCityName() ?></td>
                <td><?= LocationEnum::from($shipment['location_to'])->getCityName() ?></td>
                <td><?= $shipment['method']?></td>
                <td><?= $shipment['note'] ?></td>
                <td><?= $shipment['delivery_info'] ?></td>
                <td><?= $shipment['created_at'] ?></td>
                <td><?= $shipment['updated_at'] ?></td>
                <td>
                    <a href="app/Handlers/ShipmentHandler.php?id=<?=$shipment['id'] ?>&type=delete" class="btn btn-danger">Remove</a>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
       
</body>
</html>






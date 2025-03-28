<?php

use App\Config\Session;
use \App\Enums\Shipments\SizeEnum;
use \App\Enums\Shipments\MethodEnum;
use \App\Enums\Shipments\LocationEnum;
use App\Middleware\AuthMiddleware;
use App\Models\ShipmentMethod;

require_once "../vendor/autoload.php";

$session = new Session();

$authMiddleware = new AuthMiddleware();
$authMiddleware->handle();

$shipmentMethods = new ShipmentMethod();
$methods = $shipmentMethods->getShipemntMethods();

$locations = LocationEnum::cases();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <?php
        require_once "fixed/navbar.php";
    ?>

    <div class="container mt-5">
        <h2>Shipment Entry Form</h2>
        <?php if($session->hasKey('form_validation_error')): ?>
            <p>
                <?=$session->get('form_validation_error') ?>
            </p>
        <?php endif; ?>
        <form method="post" action="../app/Handlers/ShipmentHandler.php">
            <div class="form-group">
                <label for="size">Size</label>
                <select class="form-control" id="size" name="size">
                    <?php foreach(SizeEnum::cases() as $case): ?>
                        <option value="<?= $case->value ?>"><?= $case->getSizeName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="method">Method</label>
                <select class="form-control" id="method" name="method">
                    <?php foreach ($methods as $method): ?>
                        <option value="<?= $method['id'] ?>"><?= $method['method'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="location_from">Location From</label>
                <select class="form-control" id="location_from" name="location_from">
                    <?php foreach ($locations as $case): ?>
                        <option value="<?= $case->value ?>"><?= $case->getCityName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="location_to">Location To</label>
                <select class="form-control" id="location_to" name="location_to">
                    <?php foreach ($locations as $case): ?>
                        <option value="<?= $case->value ?>"><?= $case->getCityName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="note">Note</label>
                <textarea name="note" class="form-control" id="note" required>Note <?= time(); ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="delivery">Delivery Info</label>
                <textarea name="delivery" class="form-control" id="delivery" required>Info <?= time(); ?>
                </textarea>
            </div>
            <input type="submit" name="type" value="Create" class="btn btn-primary" />
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
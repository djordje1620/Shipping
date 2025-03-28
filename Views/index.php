<?php

use App\Config\Session;
use App\Repositories\ShipmentRepository;

require_once "../vendor/autoload.php";


$session = new Session();
$shipmentRepository = new ShipmentRepository();

if ($session->hasKey('User')) {
    $user_id = $session->get('User');
    $shipments = $shipmentRepository->getShipmentsForUser($user_id);
} else {
    $shipments = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<?php require_once "fixed/navbar.php"; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Shipment Tracking</h2>

    <?php if (!empty($shipments)): ?>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-light">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Enter Tracking Number</h5>
                        <div class="input-group">
                            <input type="text" name="tracking_number" id="tracking_number" class="form-control" placeholder="Enter Tracking Number">
                            <button class="btn btn-primary" id="check_tn">Check</button>
                        </div>
                        <p id="message" class="text-center text-danger mt-3"></p>
                    </div>
                </div>
            </div>
        </div>

        <div id="shipment-details" class="mt-5"></div>
    <?php endif; ?>
</div>

<script src="../public/js/trackShipment.js"></script>
</body>
</html>

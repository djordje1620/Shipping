<?php

use App\Services\CityService;

require_once "../vendor/autoload.php";
$session = new \App\Config\Session();
if($session->hasKey('User')){
    header('Location: index.php');
}

$cityService = new CityService();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .form-container {
            width: 30%;
            margin: 50px auto;
            
        }
    </style>
</head>
<body>
<?php
require_once "fixed/navbar.php";
?>
<div class="container form-container">
    <form method="POST" action="../app/Handlers/UserHandler.php" class="p-4 shadow rounded bg-light">
        <h2>Register</h2>
        <?php if ($session->hasKey('form_validation_error')): ?>
            <div class="danger text-danger">
                <?php
                $errors = $session->getFlash('form_validation_error');
                foreach ($errors as $field => $fieldErrors):
                    foreach ($fieldErrors as $error): ?>
                        <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endforeach;
                endforeach; ?>
            </div>
        <?php endif; ?>


        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter your first name" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter your last name" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <select name="city" id="city" class="form-control" required>
                <?php foreach ($cityService->getFormatedCities() as $city): ?>
                  <option value="<?=$city['id'] ?>"><?= $city['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">

            <label for="street" class="form-label">Street</label>
            <input type="text" name="street" id="street" class="form-control" placeholder="Enter your street" required>
        </div>
        <input type="submit" name="type" value="Register" class="btn btn-primary w-100"> <br/><br/>
        <a href="">You have an account, <a href="login.php">CLICK HERE</a></a>
    </form>
</div>
</body>
</html>

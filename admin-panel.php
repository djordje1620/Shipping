<?php

require_once "vendor/autoload.php";

$session = new \App\Config\Session();
$authMiddleware = new \App\Middleware\AuthMiddleware();
$authMiddleware->handle();
$adminMiddleware = new \App\Middleware\AdminMiddleware();
$adminMiddleware->handle();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1> USER
        <?php if($session->hasKey('User') && $session->get('Role') === 1): ?>
            <?= $session->get('User'); ?> - Admin
        <?php endif; ?>
        <br/>
        <a href="app/Handlers/UserHandler.php?type=logout">Odjavi se</a>
        
    </h1>
</body>
</html>
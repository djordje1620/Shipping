<?php

    require_once "vendor/autoload.php";
    use App\Config\Session;
    use App\Middleware\AuthMiddleware;
    $session = new Session();
    $authMiddleware = new AuthMiddleware();
    $authMiddleware->handle();
    
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
         <?php if($session->hasKey('User')): ?>
            <?= $session->get('User');  ?>
          <?php endif; ?>
      </h1>
      
      <a href="app/Handlers/UserHandler.php?type=logout">Odjavi se</a>

</body>
</html>
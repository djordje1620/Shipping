<?php
    require_once "vendor/autoload.php";
    $session = new \App\Config\Session();
    if($session->hasKey('User')){
        header('Location: user.php');
    }
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
    <style>
        .form-container {
            width: 30%;
            margin: 100px auto;

        }
    </style>
</head>
<body>
<div class="container form-container">
    <form method="POST" action="app/Handlers/UserHandler.php" class="p-4 shadow rounded bg-light">
        <h2>Login</h2>
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
        <input type="submit" name="type" value="Login" class="btn btn-primary w-100"> <br/>  <br/>

        <a href="">Don't have an account? <a href="register.php">CLICK HERE</a></a>
        
    </form>
</div>
</body>
</html>

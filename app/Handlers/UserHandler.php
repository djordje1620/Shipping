<?php

use App\Handlers\UserRequestHandler;

require_once "../../vendor/autoload.php";

$userRequestHandler = new UserRequestHandler();
$userRequestHandler->handleRequest();
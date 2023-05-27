<?php
require_once("./vendor/autoload.php");
require_once("./database/boot.php");

use Illuminate\Database\Capsule\Manager as Capsule;
use Bramus\Router\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$router = new Router();
require_once("./routes/routes.php");
$router->run();
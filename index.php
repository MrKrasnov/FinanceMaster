<?php
include __DIR__."/app/config/const.php";

use App\Core\Router;
use Dotenv\Dotenv;

require __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv::createImmutable(realpath('.'));
$dotenv->load();

$router = new Router();
$router->run();




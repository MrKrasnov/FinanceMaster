<?php
include __DIR__."/app/config/const.php";

use App\Core\Log;
use App\Core\Router;
use Dotenv\Dotenv;

require __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv::createImmutable(realpath('.'));
$dotenv->load();

try {
    $router = new Router();
    $router->run();
} catch (Exception $error) {
    Log::writeLog($error->getMessage());
}





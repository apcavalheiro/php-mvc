<?php

use App\App;
use App\Utils\Error;

session_start();

error_reporting(E_ALL & ~E_NOTICE);

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/utils/helper.php";
header("Content-type: text/html; charset=utf-8");
try {
    $app = new App();
    $app->run();
} catch (\Exception $e) {
    $error = new Error($e);
    $error->render();
}

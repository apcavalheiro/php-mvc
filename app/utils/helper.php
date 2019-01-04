<?php

define('APP_HOST', $_SERVER['HTTP_HOST'] . "/php-mvc");
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "mvc");
define('DB_DRIVER', "mysql");
define('TITLE', "PHP-MVC");


function dd($dump)
{
    var_dump($dump);
    die();
}

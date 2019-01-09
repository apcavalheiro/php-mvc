<?php

namespace App\Utils;

use Exception;
use PDO;
use PDOException;

class FactoryConnection
{

    private static $connection;

    private function __construct()
    {
    }

    public static function mysqlConnect()
    {
        $pdoConfig = DB_DRIVER . ":" . "host=" . DB_HOST . ";";
        $pdoConfig .= "dbname=" . DB_NAME . ";" . "charset=utf8";

        try {
            if (!isset($connection)) {
                $connection = new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
        } catch (PDOException $e) {
            throw new Exception("Erro de conexão com o banco de dados", 500);
        }
    }
}
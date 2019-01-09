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
    public static function sqlConnect()
    {
        try {
            if (!isset(self::$connection)) {
                self::$connection = new PDO("sqlsrv:Database=mvc;server=localhost\SQLEXPRESS;ConnectionPooling=0", "sa", "root");
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$connection;
        } catch (PDOException $e) {
            throw new Exception("Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers()), 500);
        }
    }

    public static function mysqlConnect()
    {
        $pdoConfig = DB_DRIVER . ":" . "host=" . DB_HOST . ";";
        $pdoConfig .= "dbname=" . DB_NAME . ";" . "charset=utf8";

        try {
            if (!isset(self::$connection)) {
                self::$connection = new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$connection;
        } catch (PDOException $e) {
            throw new Exception("Erro de conexão com o banco de dados", 500);
        }
    }
}
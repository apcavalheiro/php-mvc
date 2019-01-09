<?php

namespace App\Utils;

class Connection
{
    private function __construct()
    {
    }

    public static function getConnection()
    {
        return FactoryConnection::mysqlConnect();
    }
}
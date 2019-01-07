<?php

namespace App\Models\Dao;

use App\Utils\Connection;

abstract class BaseDao
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function select($querySql)
    {
        if (!empty($querySql)) {
            return $this->connection->query($querySql);
        }
    }

    public function insert($table, $cols, $values)
    {
        if (!empty($table) && !empty($cols) && !empty($values)) {
            $parameters = $cols;
            $coluns = str_replace(":", "", $cols);
            $stmt = $this->connection->prepare("INSERT INTO $table ($coluns) VALUES ($parameters)");
            $stmt->execute($values);
            return $stmt->rowCount();
        } else {
            return false;
        }
    }

    public function update($table, $cols, $values, $where = null)
    {
        if (!empty($table) && !empty($cols) && !empty($values)) {
            if ($where) {
                $where = " WHERE $where ";
            }

            $stmt = $this->connection->prepare("UPDATE $table SET $cols $where");
            $stmt->execute($values);

            return $stmt->rowCount();
        } else {
            return false;
        }
    }

    public function delete($table, $where = null)
    {
        if (!empty($table)) {
            if ($where) {
                $where = " WHERE $where ";
            }
            $stmt = $this->connection->prepare("DELETE FROM $table $where");
            $stmt->execute();
            return $stmt->rowCount();
        } else {
            return false;
        }
    }
}

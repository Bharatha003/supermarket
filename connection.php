<?php

class Database
{

    public static $connection;

    public static function setupConnection()
    {

        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("127.0.0.1", "root", "Mysql@2003", "supermarket_db", "3306");
        }
    }

    public static function iud($q)
    {

        Database::setupConnection();
        Database::$connection->query($q);
    }

    public static function search($q)
    {

        Database::setupConnection();
        $resultset  = Database::$connection->query($q);
        return $resultset;
    }
}

<?php

class Connection
{
    private static ?mysqli $connection = null;

    public static function getInstance(): mysqli
    {
        if (!self::$connection) {

            $host = getenv("DB_HOST") ?: "";
            $db   = getenv("DB_NAME") ?: "";
            $user = getenv("DB_USER") ?: "";
            $pass = getenv("DB_PASS") ?: "";

            self::$connection = new mysqli($host, $user, $pass, $db);
            if (self::$connection->connect_error) {
                die("Connection failed: " . htmlspecialchars(self::$connection->connect_error));
            }
        }
        return self::$connection;
    }
}

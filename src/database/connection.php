<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../trait/Logger.php';
class Connection
{
    use Logger;
    private static ?mysqli $connection = null;

    public static function getInstance(): mysqli
    {
        if (!self::$connection) {

            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();
            $host = $_ENV["DB_HOST"] ?: "";
            $db   = $_ENV["DB_DATABASE"] ?: "";
            $user = $_ENV["DB_USER"] ?: "";
            $pass = $_ENV["DB_PASS"] ?: "";

            self::$connection = new mysqli($host, $user, $pass, $db);
            if (self::$connection->connect_error) {
                (new self())->logError("Connection failed -> Connection:getInstance -> " . self::$connection->connect_error);
                throw new ErrorException("Connection failed -> Connection:getInstance -> " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}

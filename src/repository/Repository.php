<?php
require_once __DIR__ . '/../trait/Logger.php';
require_once __DIR__ . '/../database/connection.php';
require_once __DIR__ . '/../model/Model.php';
require_once __DIR__ . '/../model/User.php';

abstract class Repository
{
    use Logger;
    private mysqli $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();
    }
    abstract public function create(Model $model): bool;
    abstract public function getById(string $id): ?Model;
    abstract public function getAll(): array;
    abstract public function update(string $id, Model $model): bool;
    abstract public function delete(string $id): bool;

    protected function prepareAndExecute(string $sql, array $params): mysqli_stmt
    {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            $this->logError("mysqli error -> Repository::prepareAndExecute -> " . htmlspecialchars($this->conn->error));
            throw new ErrorException("Database error: " . $this->conn->error);
        }
        $types = "";
        if (!empty($params)) {
            foreach ($params as $param) {
                $types .= gettype($param)[0];
            }
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt;
    }

}
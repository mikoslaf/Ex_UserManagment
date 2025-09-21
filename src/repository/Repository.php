<?php

require_once "../model/Model.php";
require_once "../database/connection.php";
require_once "../traits/Logger.php";

abstract class Repository
{
    use Logger;
    private mysqli $conn  = Connection::getInstance();
    abstract public function create(Model $model): Model | bool;
    abstract public function getById(string $id): Model | null;
    abstract public function getAll(): array;
    abstract public function update(string $id, Model $model): Model | bool;
    abstract public function delete(string $id): bool;

    protected function prepareAndExecute(string $sql, array $params): mysqli_stmt
    {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            $this->logError("mysqli error: " . htmlspecialchars($this->conn->error) . " -> Repository::prepareAndExecute");
            die("mysqli error: " . htmlspecialchars($this->conn->error));
        }
        $types = "";
        foreach ($params as $param) {
            $types .= gettype($param)[0];
        }
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        return $stmt;
    }

}
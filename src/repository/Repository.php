<?php

require_once '../model/Model.php';

abstract class Repository
{
    abstract public function create(Model $model): Model | bool;
    abstract public function getById(string $id): Model | null;
    abstract public function getAll(): array;
    abstract public function update(string $id, Model $model): Model | bool;
    abstract public function delete(string $id): bool;

    protected function prepareAndExecute($conn, string $sql, array $params): mysqli_stmt
    {
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('mysqli error: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
        return $stmt;
    }
}
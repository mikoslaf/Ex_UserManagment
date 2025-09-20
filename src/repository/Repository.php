<?php

require_once '../model/Model.php';

abstract class Repository
{
    abstract public function create(Model $model): Model | bool;
    abstract public function getById(string $id): Model | null;
    abstract public function getAll(): array;
    abstract public function update(string $id, Model $model): Model | bool;
    abstract public function delete(string $id): bool;
}
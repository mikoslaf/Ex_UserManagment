<?php

require_once '../model/Model.php';

abstract class Repository
{
    abstract public function create(Model $entity): Model | bool;
    abstract public function getById(string $id): Model | null;
    abstract public function getAll(): array;

    abstract public function update(string $id, $data): bool;
    abstract public function delete(string $id): bool;
}
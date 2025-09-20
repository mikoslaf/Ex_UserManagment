<?php

require_once '../model/user.php';
require_once '../model/Model.php';

class UserRepository extends Repository {

    public function create(Model $model): bool | Model {
        if (!$model instanceof User) {
            return false;
        }
        #TODO: Create a logic to add user to storage
        #$this->users[$entity->getId()] = $entity;
        return $model;
    }

    public function getById(string $id): Model | null {
        return $this->users[$id] ?? null;
    }

    public function getAll(): array {
        return array_values();
    }

    public function update(string $id, Model $model): Model | bool {
        if (!isset($this->users[$id])) {
            return false;
        }
        if (isset($model->name)) {
            $this->users[$id]->name = $model->name;
        }
        if (isset($model->email)) {
            // Assuming email is private, we would need a setter method in User class
            // $this->users[$id]->setEmail($model->email);
        }
        if (isset($model->age)) {
            // Assuming age is protected, we would need a setter method in User class
            // $this->users[$id]->setAge($model->age);
        }
        return true;
    }

    public function delete(string $id): bool {
        if (!isset($this->users[$id])) {
            return false;
        }
        unset($this->users[$id]);
        return true;
    }
}
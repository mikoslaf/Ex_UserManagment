<?php

require_once '../model/user.php';
require_once '../model/Model.php';

class UserRepository extends Repository {
    private array $users = [];

    public function create(Model $entity): bool | Model {
        if (!$entity instanceof User) {
            return false;
        }
        #TODO: Create a logic to add user to storage
        #$this->users[$entity->getId()] = $entity;
        return $entity;
    }

    public function getById(string $id): Model | null {
        return $this->users[$id] ?? null;
    }

    public function getAll(): array {
        return array_values($this->users);
    }

    public function update(string $id, $data): bool {
        if (!isset($this->users[$id])) {
            return false;
        }
        if (isset($data['name'])) {
            $this->users[$id]->name = $data['name'];
        }
        if (isset($data['email'])) {
            // Assuming email is private, we would need a setter method in User class
            // $this->users[$id]->setEmail($data['email']);
        }
        if (isset($data['age'])) {
            // Assuming age is protected, we would need a setter method in User class
            // $this->users[$id]->setAge($data['age']);
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
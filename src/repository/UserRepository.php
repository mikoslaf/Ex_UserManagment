<?php

require_once '../model/user.php';
require_once '../model/Model.php';
require_once '../model/Field.php';

class UserRepository extends Repository {
    use Logger;
    public function create(Model $model): bool | User {
        if (!$model instanceof User) {
            $this->logError("Invalid model type -> UserRepository::create");
            return false;
        }
        $query = "INSERT INTO users (name, email, age) VALUES (?, ?, ?) returning *";
        $params = [
            $model->name->getValue(),
            $model->email->getValue(),
            $model->age->getValue()
        ];

        $stmt = $this->prepareAndExecute($this->conn, $query, $params);
        if ($stmt) {
            $result = $stmt->get_result();
            $data = $result ? $result->fetch_assoc() : null;
            if ($data) {
                $model->setId($data['id']);

                $this->logInfo("User created: " . $model->__tostring());
                return $model;
            }
            $this->logError('No data returned -> UserRepository::create');
            return false;
        }
        $this->logError('Database error -> UserRepository::create');
        return false;
    }

    public function getById(string $id): Model | null {
        $query = "SELECT * FROM users WHERE id = ?";
        $params = [$id];
        $stmt = $this->prepareAndExecute($this->conn, $query, $params);
        
        if ($stmt) {
            $result = $stmt->get_result();
            $data = $result ? $result->fetch_assoc() : null;
            if ($data) {
                return new User(
                    $data['name'],
                    $data['email'],
                    (int)$data['age'],
                    $data['id']
                );
            } else {
                $this->logWarning("User not found by id: " . $id . " -> UserRepository::getById");
            }
        } else {
            $this->logError('Database error -> UserRepository::getById');
        }
        return null;
    }

    public function getAll(): array {
        $query = "SELECT * FROM users";
        $stmt = $this->prepareAndExecute($this->conn, $query, []);
        $users = [];
        if ($stmt) {
            $result = $stmt->get_result();
            while ($data = $result->fetch_assoc()) {
                $users[] = new User(
                    $data['name'],
                    $data['email'],
                    (int)$data['age'],
                    $data['id']
                );
            }
        } else {
            $this->logError('Database error -> UserRepository::getAll');
        }
        return $users;
    }

    public function update(string $id, Model $model): User | bool {
        if (!$model instanceof User) {
            $this->logError("Invalid model type -> UserRepository::update");
            return false;
        }
        $query = 'UPDATE users SET name = ?, email = ?, age = ? WHERE id = ? RETURNING *';
        $params = [
            $model->name->getValue(),
            $model->email->getValue(),
            $model->age->getValue(),
            $id
        ];
        $stmt = $this->prepareAndExecute($this->conn, $query, $params);
        if ($stmt) {
            $result = $stmt->get_result();
            $data = $result ? $result->fetch_assoc() : null;
            if ($data) {
                $newUser = new User(
                    $data['name'],
                    $data['email'],
                    (int)$data['age'],
                    $data['id']
                );
                $this->logInfo("User updated from: " . $model->__tostring() . " to: " . $newUser->__tostring());
                return $newUser;
            }
            $this->logError('No data returned -> UserRepository::update');
            return false;
        } else {
            $this->logError('Database error -> UserRepository::update');
        }
        return false;
    }

    public function delete(string $id): bool {
        $query = "DELETE FROM users WHERE id = ?";
        $params = [$id];
        $stmt = $this->prepareAndExecute($this->conn, $query, $params);
        if ($stmt) {
            if ($stmt->affected_rows > 0) {
                $this->logInfo("User deleted with id: " . $id . " -> UserRepository::delete");
                return true;
            } else {
                $this->logWarning("No user found to delete with id: " . $id . " -> UserRepository::delete");
            }
        } else {
            $this->logError('Database error -> UserRepository::delete');   
        }
        return false;
    }
}
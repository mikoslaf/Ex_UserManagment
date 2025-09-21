<?php
require_once __DIR__ . '/Repository.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Model.php';
require_once __DIR__ . '/../trait/Logger.php';

class UserRepository extends Repository {
    public function create(Model $model): bool {
        if (!$model instanceof User) {
            $this->logError("Invalid model type -> UserRepository::create");
            throw new InvalidArgumentException("Invalid model type");
        }
        $query = "INSERT INTO users (name, email, age) VALUES (?, ?, ?)";
        $params = [
            $model->name->getValue(),
            $model->email->getValue(),
            $model->age->getValue()
        ];

        $stmt = $this->prepareAndExecute($query, $params);
        if ($stmt) {
            $result = $stmt->affected_rows;
            if ($result === 1) {
                $this->logInfo("User created: " . $model->__tostring());
                return true;
            }
            $this->logWarning('User not created -> UserRepository::create ->' . $stmt->error);
            return false;
        }
        $this->logError('Database error -> UserRepository::create');
        return false;
    }

    public function getById(string $id): Model | null {
        $query = "SELECT * FROM users WHERE id = ?";
        $params = [$id];
        $stmt = $this->prepareAndExecute($query, $params);
        
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
            }
        } else {
            $this->logError('Database error -> UserRepository::getById');
        }
        return null;
    }

    public function getAll(): array {
        $query = "SELECT * FROM users";
        $stmt = $this->prepareAndExecute($query, []);
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

    public function update(string $id, Model $model): bool {
        if (!$model instanceof User) {
            $this->logError("Invalid model type -> UserRepository::update");
            return false;
        }
        $query = 'UPDATE users SET name = ?, email = ?, age = ? WHERE id = ?';
        $params = [
            $model->name->getValue(),
            $model->email->getValue(),
            $model->age->getValue(),
            $id
        ];
        $stmt = $this->prepareAndExecute($query, $params);
        if ($stmt) {
            $result = $stmt->affected_rows;
            if ($result === 1) {
                $this->logInfo("User updated: " . $model->__tostring());
                return true;
            }
            $this->logWarning('User not updated -> UserRepository::update ->' . $stmt->error);
            return false;
        }
        return false;
    }

    public function delete(string $id): bool {
        $query = "DELETE FROM users WHERE id = ?";
        $params = [$id];
        $stmt = $this->prepareAndExecute($query, $params);
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
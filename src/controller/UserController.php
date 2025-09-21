<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../trait/Logger.php';
require_once __DIR__ . '/../repository/Repository.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Model.php';
class UserController extends Controller {
    use Logger;
    private UserRepository $userRepository;

    public function __construct() {
        try {
            $this->userRepository = new UserRepository();
        } catch (Exception $e) {
            $this->logError("Failed to initialize UserRepository -> UserController::__construct -> " . $e->getMessage());
            
        }
    }

    public function create(array $data): bool {
        $fields = ['name', 'email', 'age'];
        foreach ($fields as $field) {
            if (!array_key_exists($field, $data)) {
                $this->AddError($field, "Field '$field' cannot be empty.");
                return false;
            }
            if (empty($data[$field])) {
                $this->AddError($field, "Field '$field' cannot be empty.");
                return false;
            }
        }

        try {
            $user = new User($data['name'], $data['email'], (int)$data['age']);
            $result = $this->userRepository->create($user);
            return $result;
        } catch (Exception $e) {
            return false;
        } 
    }

    public function readAll(): array {
        try {
            return $this->userRepository->getAll();
        } catch (Exception $e) {
            $this->logError("Failed to read users -> UserController::readAll -> " . $e->getMessage());
            return [];
        }
    }

    public function read(string $id): User | null {
        try {
            return $this->userRepository->getById($id);
        } catch (Exception $e) {
            $this->logError("Failed to read user -> UserController::read -> " . $e->getMessage());
            return null;
        }
    }

    public function update(array $data): bool {
        $fields = ['id', 'name', 'email', 'age'];
        foreach ($fields as $field) {
            if (!array_key_exists($field, $data)) {
                $this->AddError($field, "Field '$field' cannot be empty.");
                return false;
            }
            if (empty($data[$field])) {
                $this->AddError($field, "Field '$field' cannot be empty.");
                return false;
            }
        }

        try {
            $user = new User($data['name'], $data['email'], (int)$data['age']);
            $result = $this->userRepository->update($data['id'], $user);
            return $result;
        } catch (Exception $e) {
            return false;
        } 
    }

    public function delete(string $id): bool {
        try {
            return $this->userRepository->delete($id);
        } catch (Exception $e) {
            $this->logError("Failed to delete user -> UserController::delete -> " . $e->getMessage());
            return false;
        }
    }
}
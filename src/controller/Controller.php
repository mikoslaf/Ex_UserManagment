<?php
require_once __DIR__ . '/../trait/Logger.php';
abstract class Controller {
    private array $errors = [];

    public function addError(string $field, string $message): void {
        $this->errors[$field] = $message;
    }

    public function getErrors(): array {
        return $this->errors;
    }
}
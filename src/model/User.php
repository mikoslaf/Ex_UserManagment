<?php
require_once __DIR__ . '/Model.php';
require_once __DIR__ . '/Field.php';
class User implements Model {
    private Field $id;
    public Field $name;
    public Field $email;
    public Field $age;

    public function __construct(string $name, string $email, int $age, ?string $id = null) {
        $this->name = new Field("name", 'text', true, $name);
        $this->email = new Field("email", 'text', true, $email);
        $this->age = new Field("age", 'integer', true, $age);
        $this->id = new Field('id', 'text', false, $id);
    }

    public function setId(string $id): void {
        $this->id->setValue($id);
    }

    public function getId(): ?string {
        return $this->id ? $this->id->getValue() : null;
    }

    public function setName(string $name): void {
        $this->name->setValue($name);
    }

    public function getName(): string {
        return $this->name->getValue();
    }

    public function setEmail(string $email): void {
        $this->email->setValue($email);
    }

    public function getEmail(): string {
        return $this->email->getValue();
    }

    public function setAge(int $age): void {
        $this->age->setValue($age);
    }
    public function getAge(): int {
        return $this->age->getValue();
    }

    public function __toString(): string {
        return "User{id=" . $this->id->getValue() . ", name=" . $this->name->getValue() . ", email=" . $this->email->getValue() . ", age=" . $this->age->getValue() . "}";
    }
}
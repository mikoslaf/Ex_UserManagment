<?php

class User implements Model, FormModel {
    private Field $id;
    public Field $name;
    public Field $email;
    public Field $age;

    public function __construct(string $name, string $email, int $age, string $id = null) {
        $this->name = new Field("name", 'text', true, $name);
        $this->email = new Field("email", 'text', true, $email);
        $this->age = new Field("age", 'integer', true, $age);
        $this->id = new Field('id', 'text', false, $id);
    }

    public function setId(string $id): void {
        $this->id->setValue($id);
    }

    public function __tostring(): string {
        return "User{id=" . $this->id->getValue() . ", name=" . $this->name->getValue() . ", email=" . $this->email->getValue() . ", age=" . $this->age->getValue() . "}";
    }
}
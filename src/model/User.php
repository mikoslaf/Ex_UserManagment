<?php

class User implements Model {
    private string | null $id;
    public string $name;
    private string $email;
    protected int $age;

    public function __construct(string $name, string $email, int $age) {
        $this->id = null;
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
    }

}
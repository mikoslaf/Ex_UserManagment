<?php

class User implements Model, FormModel {
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

    // public function getFields(): array
    // {
    //     $fields = [];
    //     $reflection = new ReflectionClass($this);

    //     foreach ($reflection->getProperties() as $property) {
    //         $name = $property->getName();

    //         $type = 'text';
    //         if ($property->hasType()) {
    //             $ptype = $property->getType()->getName();
    //             if ($ptype === 'int') $type = 'number';
    //             if ($ptype === 'bool') $type = 'checkbox';
    //             if ($ptype === 'string' && stripos($name, 'email') !== false) $type = 'email';
    //         }

    //         $fields[] = [
    //             'name'  => $name,
    //             'type'  => $type,
    //             'isRequired' => true
    //         ];
    //     }

    //     return $fields;
    // }
}
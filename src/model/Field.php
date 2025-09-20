<?php

class Field {
    private string $name;
    private string $type;
    private bool $isRequired;
    private $value;

    public function __construct(string $name, string $type, bool $isRequired, $value = null) {
        $this->name = $name;
        $this->type = $type;
        $this->isRequired = $isRequired;
        $this->value = $value;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }

    public function isRequired(): bool {
        return $this->isRequired;
    }
    public function setValue($value): void {
        $this->value = $value;
    }
    public function getValue() {
        return $this->value;
    }
}

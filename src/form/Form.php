<?php

abstract class Form {
    private array $errors = [];

    public function addError(string $field, string $message): void {
        $this->errors[$field] = $message;
    }

    public function getErrors(): array {
        return $this->errors;
    }

    // public function render(string $action): string {
    //     $formHtml = '<form method="POST" action="' . htmlspecialchars($action) . '">';
    //     foreach ($this->model->getFields() as $field) {
    //         $formHtml .= sprintf(
    //             '<label for="%s">%s:</label>',
    //             htmlspecialchars($field->getName()),
    //             htmlspecialchars($field->getLabel())
    //         );
    //         $formHtml .= sprintf(
    //             '<input type="%s" id="%s" name="%s" value="%s" required>',
    //             htmlspecialchars($field->getType()),
    //             htmlspecialchars($field->getName()),
    //             htmlspecialchars($field->getName()),
    //             htmlspecialchars($field->getValue())
    //         );
    //         $formHtml .= '<br>';
    //     }
    //     $formHtml .= '<button type="submit">Submit</button>';
    //     $formHtml .= '</form>';
    //     return $formHtml;
    // }
}
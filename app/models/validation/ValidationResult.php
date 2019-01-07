<?php

namespace App\Models\Validation;

class ValidationResult {

    private $errors = [];

    public function addErrors($field, $message)
    {
        $this->errors[$field] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}

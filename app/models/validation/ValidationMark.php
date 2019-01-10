<?php

namespace App\Models\Validation;

use App\Models\Entities\Marca;
use App\Models\Validation\ValidationResult;

class ValidationMark
{
    public function validate(Marca $marca)
    {
        $insert = new ValidationResult();

        if (empty($marca->getNome())) {
            $insert->addErrors('nome', "Marca: Este campo não pode ser vazio");
        }
        return $insert;
    }
}
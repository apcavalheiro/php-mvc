<?php

namespace App\Models\Validation;

use App\Models\Entities\Marca;

class ValidationProduct
{
    public function validate(Marca $marca)
    {
        $insert = new ValidationResult();

        if (empty($marca->getMarca())) {
            $insert->addErro('marca', "Marca: Este campo não pode ser vazio");
        }
    }
}
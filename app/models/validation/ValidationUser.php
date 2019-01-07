<?php

namespace App\Models\Validation;

use App\Models\Entities\Usuario;
use App\Models\Validation\ValidationResult;

class ValidationUser {

    public function validate(Usuario $user)
    {
        $result = new ValidationResult();

        if(empty($user->getNome())){
            $result->addErrors('nome',"Nome: Este campo não pode ser vazio!");
        }

        if (empty($user->getEmail())) {
            $result->addErrors('email', "E-Mail: Este campo não pode ser vazio!");
        }

        return $result;
    }
}
<?php

namespace App\Controllers;

use App\Controllers\Controller;

class UsuarioController extends Controller
{
    public function cadastro()
    {
        $this->render("/usuario/cadastro");
    }

    public function salvar()
    {
        dd($_POST);
    }
}

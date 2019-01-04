<?php

namespace App\Controllers;

use App\Utils\Connection;

class ProdutoController extends Controller
{

    public function index()
    {

        echo 'teste'
        ;
    }

    public function cadastro()
    {
        $teste = Connection::getConnection();
        dd($teste);

    }
}

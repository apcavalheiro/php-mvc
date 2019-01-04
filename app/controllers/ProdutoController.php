<?php

namespace App\Controllers;

class ProdutoController extends Controller {

    public function index()
    {
        $this->render('produto/index');
    }

    public function cadastro()
    {
        $this->render('produto/index');
    }
}
<?php

namespace App\Controllers;

class ProdutoController extends Controller {

    public function index()
    {
        $this->render('produto/index');
    }

    public function teste()
    {
        echo "teste";
        //$this->render('produto/index');
    }
}
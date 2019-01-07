<?php

namespace App\Controllers;

use App\Utils\Session;

abstract class Controller
{
    protected $app;
    private $viewVar;

    public function __construct($app)
    {
        $this->setViewParam('nameController', $app->getControllerName());
        $this->setViewParam('nameAction', $app->getAction());
    }

    public function render($view)
    {
        $viewVar = $this->getViewVar();
        $Session = Session::class;

        require_once '../app/views/layouts/header.php';
        require_once '../app/views/layouts/menu.php';
        require_once '../app/views/' . $view . '.php';
        require_once '../app/views/layouts/footer.php';
    }

    public function redirect($view)
    {
        header('Location:' . $view);
        exit;
    }

    public function getViewVar()
    {
        return $this->viewVar;
    }

    public function setViewParam($varName, $varValue)
    {
        if ($varName != "" && $varValue != "") {
            $this->viewVar[$varName] = $varValue;
        }
    }
}

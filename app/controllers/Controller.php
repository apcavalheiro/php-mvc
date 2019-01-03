<?php

namespace App\Controllers;


abstract class Controller
{
    protected $app;
    private $viewVar;

    public function __construct($app)
    {
        $this->setViewParam('nameController', $app->getControllerName());
       // $this->setViewParam('nameAction', $app->getAction());
    }

    public function render($view)
    {
        $viewVar = $this->getViewVar();
        
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/layouts/menu.php';
        require_once '../app/views/' . $view . '.php';
        require_once '../app/views/layouts/footer.php';
    }
     
    public function redirect($view)
    {
        header('Location:' . APP_HOST . $view);
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
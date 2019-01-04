<?php

namespace App;

use Exception;
use App\Controllers\HomeController;

class App
{

    private $controller;
    private $controllerFile;
    private $action;
    private $params;
    public $controllerName;

    public function __construct()
    {
        $this->url();
    }

    public function run()
    {
        if ($this->controller) {
            $this->controllerName = ucwords($this->controller) . 'Controller';
            $this->controllerName = preg_replace('/[^a-zA-Z]/i', '', $this->controllerName);
        } else {
            $this->controllerName = "HomeController";
        }

        $this->controllerFile = $this->controllerName . '.php';
        $this->action = preg_replace('/[^a-zA-Z]/i', '', $this->action);

        if (!$this->controller) {
            $this->controller = new HomeController($this);
            $this->controller->index();
        }

        if (!file_exists(__DIR__ . '/../app/controllers/' . $this->controllerFile)) {
            throw new Exception("Página não encontrada.", 404);
        }

        $className = "\\App\\Controllers\\" . $this->controllerName;

        $objectController = new $className($this);

        if (!class_exists($className)) {
            throw new Exception("Erro na aplicação", 500);
        }

        if (method_exists($objectController, $this->action)) {
            $objectController->{$this->action}($this->params);
            return;
        } else if (!$this->action && method_exists($objectController, 'index')) {
            $objectController->index($this->params);
            return;
        } else {
            throw new Exception("Nosso suporte já esta verificando desculpe!", 500);
        }
        throw new Exception("Página não encontrada.", 404);
    }

    public function url()
    {
        $path = $this->getUrl();

        $path = rtrim($path, '/');

        $path = filter_var($path, FILTER_SANITIZE_URL);

        $path = explode('/', $path);
        // Remove os valores nulos
        $path = array_filter($path);
        // Recria as chaves do array
        $path = array_values($path);
       
        $this->controller = $this->verificaArray($path, 0);
        $this->action = $this->verificaArray($path, 1);

        if ($this->verificaArray($path, 2)) {
            unset($path[0]);
            unset($path[1]);
            $this->params = array_values($path);
        }
    }

    private function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    private function verificaArray($array, $key)
    {
        if (isset($array[$key]) && !empty($array[$key])) {
            return $array[$key];
        }
        return null;
    }
}

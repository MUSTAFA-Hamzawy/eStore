<?php


namespace MVC\controllers;


abstract class controller
{
    protected $controller;
    protected $method;
    protected $parameters;

    public function setValues($controller, $method, $parameters)
    {
        $this->controller = $controller;
        $this->method = $method;
        $this->parameters = $parameters;
    }

    protected function view($path){
        $viewFile = VIEWS . DIRECTORY_SEPARATOR . $path . ".php";
        require_once ($viewFile);
    }

    abstract public function defaultMethod();
}
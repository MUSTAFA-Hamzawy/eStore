<?php


namespace MVC\controllers;


use MVC\core\session;
use MVC\core\validation;

abstract class controller
{
  use validation;
    protected $controller;
    protected $method;
    protected $parameters;
    protected $viewFolderName;
    protected $massegesToUser;
    protected $model;
    protected $pageTitle;

    public function __construct()
    {
      session::start();
    }

    public function setValues($controller, $method, $parameters)
    {
        $this->controller = $controller;
        $this->method = $method;
        $this->parameters = $parameters;
    }

    protected function view(){
        $viewFile = VIEWS . DIRECTORY_SEPARATOR . $this->viewFolderName . DIRECTORY_SEPARATOR . $this->method . ".php";
        require_once ($viewFile);
    }

    protected function addMessageToUser($key, $value){
      $this->massegesToUser[$key] = array();
      array_push($this->massegesToUser[$key], $value);
    }

    abstract public function main();


}
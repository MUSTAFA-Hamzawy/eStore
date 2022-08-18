<?php


namespace MVC\controllers;


use MVC\core\session;
use MVC\core\validation;
use MVC\core\helpers;

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

  protected function view($parameter = null){
    if ($parameter)
      $viewFile = VIEWS . DIRECTORY_SEPARATOR . $this->viewFolderName . DIRECTORY_SEPARATOR . $this->method .
          DIRECTORY_SEPARATOR . $parameter . ".php";
    else
      $viewFile = VIEWS . DIRECTORY_SEPARATOR . $this->viewFolderName . DIRECTORY_SEPARATOR . $this->method . ".php";
    require_once ($viewFile);
  }

  protected function addMessageToUser($key, $value){
    $this->massegesToUser[$key] = $value;
  }

  protected function redirectToHomePage(){
    helpers::reDirect($this->controller);
  }

  abstract public function main();


}

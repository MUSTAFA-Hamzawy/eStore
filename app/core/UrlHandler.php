<?php


namespace MVC\core;


class UrlHandler
{
    private $controller;
    private $method;
    private $parameters;
    private $databaseObj;
    private $authenticationInstance;
    private $ControllersNamespce;

    public function __construct($db){
        $this->method = "main";         // default
        $this->ControllersNamespce = "MVC\controllers\\";
        $this->databaseObj = $db;
        $this->authenticationInstance = Authentication::getInstance();
        $this->analyzeUrl();
        $this->render();

    }

    private function analyzeUrl(){
        $queryString = trim($_SERVER['QUERY_STRING'], "/ ");

        if (!empty($queryString)){
            $urlInfo = explode('/', $queryString);

            if (!empty($urlInfo[0]))
                $this->controller = filter_var($urlInfo[0], FILTER_SANITIZE_STRING);
            if (!empty($urlInfo[1]))
                $this->method = filter_var($urlInfo[1], FILTER_SANITIZE_STRING );

            if (count($urlInfo) > 2)
                $this->parameters = array_slice($urlInfo, 2);

        }else{
            $this->controller = "home";
            $this->method = "main";
        }
    }

    // to check whether the user already logged in or not.
    private function checkAuthorization(){
      if (! $this->authenticationInstance->isAuthorized())
      {
        $controllerClass = $this->ControllersNamespce . "authentication";
        $this->method = "login";
      }
      else{
        if ($this->controller == 'authentication' && $this->method == 'login')
          if (isset($_SERVER['HTTP_REFERER']))
          {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
      }
    }

    private function checkRouteAccess(){
      $route = $this->controller . '/' . $this->method;
      if (! $this->authenticationInstance->canAccessRoute($route))
        helpers::reDirect('accessDenied');
    }

    private function render(){
        $controllerClass = $this->ControllersNamespce . $this->controller;

        if (!class_exists($controllerClass))
        {
            $controllerClass = $this->ControllersNamespce . "home"; // default page
            $this->method = "main";
        }

      $this->checkAuthorization();

      $controllerInstance = new $controllerClass($this->databaseObj);

      if (! method_exists($controllerInstance, $this->method))
        $this->method = "main";

      $this->checkRouteAccess();

      $controllerInstance->setValues($this->controller, $this->method, $this->parameters);
      $controllerInstance->{$this->method}();     // call the method

    }
}
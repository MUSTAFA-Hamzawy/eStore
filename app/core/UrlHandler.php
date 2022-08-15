<?php


namespace MVC\core;


class UrlHandler
{
    private $controller;
    private $method;
    private $parameters;

    public function __construct(){
        $this->method = "main";
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

    private function render(){
        $namespace = "MVC\controllers\\";
        $controllerClass = $namespace . $this->controller;

        if (!class_exists($controllerClass))
        {
            $controllerClass = $namespace . "home"; // default page
            $this->controller = "home";
        }

        $controllerInstance = new $controllerClass;

        if (! method_exists($controllerInstance, $this->method))
            $this->method = "main";

        $controllerInstance->setValues($this->controller, $this->method, $this->parameters);
        $controllerInstance->{$this->method}();     // call the method

    }
}
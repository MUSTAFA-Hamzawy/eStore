<?php


namespace MVC\controllers;
use MVC\core\helpers;
use MVC\core\session;


class admin extends controller
{

    public function __construct()
    {
        session::start();
    }
    public function defaultMethod()
    {
        if (empty($_SESSION))
            helpers::reDirect("user");

        $this->view("dashboard/index");
    }




}
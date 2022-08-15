<?php


namespace MVC\controllers;
use MVC\core\helpers;
use MVC\core\session;


class admin extends controller
{

    public function __construct()
    {
        parent::__construct();
        $this->viewFolderName = 'admin';
        session::start();
    }

    public function main()
    {
        if (empty($_SESSION))
            helpers::reDirect("user");

        $this->view();
    }




}
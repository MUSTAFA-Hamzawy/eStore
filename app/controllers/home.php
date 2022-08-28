<?php


namespace MVC\controllers;


use MVC\core\session;

class home extends controller
{

  public function main()
  {
      $this->pageTitle = 'Home Page';
     $this->viewFolderName = "home";
      $this->view();
  }
}
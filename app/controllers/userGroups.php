<?php


namespace MVC\controllers;


use MVC\core\helpers;
use MVC\models\group as groupModel;

class userGroups extends controller
{

  public function __construct(){
    parent::__construct();
    $this->viewFolderName = 'UserGroups';
    $this->model = new groupModel();
  }

  public function main()
  {
    if (!empty($_SESSION))
      helpers::reDirect("../admin");

    $this->view();
  }
}
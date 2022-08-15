<?php


namespace MVC\controllers;


use MVC\core\helpers;
use MVC\models\privileges as privilegeModel;

class privileges extends controller
{
  public $data;
  public function __construct(){
    parent::__construct();

    $this->viewFolderName = "privileges";
    $this->model = new privilegeModel();
    $this->data = $this->model->fetchRecords();
  }

  public function main()
  {
    if (empty($_SESSION))
      helpers::reDirect("../admin");

    $this->pageTitle = 'Privileges';
    $this->view();
  }

  public function add(){

    if (isset($_POST['submit'])) {

      $this->model->Name = $this->sanitizeString($_POST['privilege']);
      $this->model->url_title = $this->sanitizeString($_POST['link']);
      if ($this->model->add())
        $this->addMessageToUser('success', "Privilege is added successfully.");
      else
        $this->addMessageToUser('errors', "Failed to add this privilege.");
    }

    $this->pageTitle = "Add Privilege";
    $this->view();
  }
  public function edit(){

    if (isset($_POST['submit'])) {

      $this->model->Name = $this->sanitizeString($_POST['privilege']);
      $this->model->url_title = $this->sanitizeString($_POST['link']);
      if ($this->model->add())
        $this->addMessageToUser('success', "Privilege is added successfully.");
      else
        $this->addMessageToUser('errors', "Failed to add this privilege.");
    }

    $this->pageTitle = "Add Privilege";
    $this->view();
  }

  public function delete(){
    $this->model->id = $this->parameters[0];

    if($this->model->delete())
      $this->addMessageToUser('success', "Privilege is Removed successfully.");
    else
      $this->addMessageToUser('errors', "Failed to remove this privilege.");

    helpers::reDirect("../");
  }
}
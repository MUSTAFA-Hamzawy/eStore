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
    if (empty($_SESSION))   // todo-me : another way to check that the person is logged in
      helpers::reDirect("../admin");  // todo-me: think of good way to get the path not written manually

    $this->pageTitle = 'Privileges';
    $this->view();
  }

  public function add(){

    if (isset($_POST['submit'])) {
      // todo-me: make the field is required by js to avoid empty
      $this->model->Name = $this->sanitizeString($_POST['privilege']);
      $this->model->url_title = $this->sanitizeString($_POST['link']);

      if ($this->model->add())    // todo: show the massages to user for 5 seconds
        $this->addMessageToUser('success', "Privilege is added successfully.");
      else
        $this->addMessageToUser('errors', "Failed to add this privilege.");
    }

    $this->pageTitle = "Add Privilege";
    $this->view();
  }

  public function edit(){

    $this->pageTitle = "Edit Privilege";
    $this->model->id = $this->parameters[0];    // todo-me : sanitize the parameters first
    $this->data = $this->model->fetchRecord();

    $this->view();

    if (isset($_POST['submit'])) {

      $this->model->Name = $this->sanitizeString($_POST['privilege']);
      $this->model->url_title = $this->sanitizeString($_POST['link']);
      if ($this->model->edit())
        $this->addMessageToUser('success', "Privilege is Updated successfully.");
      else
        $this->addMessageToUser('errors', "Failed to update this privilege.");

      helpers::reDirect("../test");     // todo-me : redirect after editing to the home page and show the msgs
    }

  }

  public function delete(){
    $this->model->id = $this->parameters[0]; // todo-me : sanitize the parameters first

    if($this->model->delete())
      $this->addMessageToUser('success', "Privilege is Removed successfully.");
    else
      $this->addMessageToUser('errors', "Failed to remove this privilege.");

    helpers::reDirect("../");// todo-me : redirect after deleting to the home page and show the msgs
  }
}
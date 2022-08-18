<?php


namespace MVC\controllers;


use MVC\core\helpers;
use MVC\models\privileges as privilegeModel;

class privileges extends controller
{
  public function __construct(){
    parent::__construct();

    $this->viewFolderName = "privileges";
    $this->model = new privilegeModel();
    $this->data = $this->model->fetchRecords();
  }

  public function main()    // default method
  {
    if (empty($_SESSION))   // todo-me : another way to check that the person is logged in
      helpers::reDirect("admin");  // todo-me: think of good way to get the path not written manually

    $this->pageTitle = 'Privileges';
    $this->method = "main";
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

  private function fetchPrivilegeById(){
    $this->model->id = filter_var($this->parameters[0], FILTER_SANITIZE_NUMBER_INT);
    $this->data = $this->model->fetchRecord();
    if (! $this->data)
      $this->redirectToHomePage();
  }

  private function editPrivilege(){
    if (isset($_POST['submit'])) {

      $this->model->Name = $this->sanitizeString($_POST['privilege']);
      $this->model->url_title = $this->sanitizeString($_POST['link']);
      if ($this->model->edit())
        $this->addMessageToUser('success', "Privilege is Updated successfully.");
      else
        $this->addMessageToUser('errors', "Failed to update this privilege.");

      $this->redirectToHomePage();

    }
  }

  public function edit(){

    $this->fetchPrivilegeById();

    $this->editPrivilege();

    $this->pageTitle = "Edit Privilege";
    $this->view();
  }

  public function delete(){
    $this->model->id = filter_var($this->parameters[0], FILTER_SANITIZE_NUMBER_INT);

    if($this->model->delete())
      $this->addMessageToUser('success', "Privilege is Removed successfully.");
    else
      $this->addMessageToUser('errors', "Failed to remove this privilege.");

    $this->redirectToHomePage();
  }
}
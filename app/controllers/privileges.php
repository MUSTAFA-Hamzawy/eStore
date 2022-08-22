<?php


namespace MVC\controllers;


use MVC\core\helpers;
use MVC\core\Messenger;
use MVC\models\privileges as privilegeModel;

class privileges extends controller
{
  public function __construct($db){
    parent::__construct($db);

    $this->viewFolderName = "privileges";
    $this->model = new privilegeModel($db);
    $this->data = $this->model->fetchModelRecords();
  }

  public function main()    // default method
  {
//    if (empty($_SESSION))
//      helpers::reDirect("admin");

    $this->pageTitle = 'Privileges';
    $this->method = "main";
    $this->data = $this->model->fetchModelRecords();
    $this->view();
  }

  public function add(){

    $this->pageTitle = "Add Privilege";

    if (isset($_POST['submit'])) {
      $this->model->Name = $this->sanitizeString($_POST['privilege']);
      $this->model->url_title = $this->sanitizeString($_POST['link']);

      if ($this->model->add())
        $this->messenger->addMessage("Privilege has been added successfully.");
      else
        $this->messenger->addMessage( "Failed to add this privilege.", Messenger::ERROR_MESSAGE);
    }

    $this->view();
  }

  // To avoid if anyone from playing in the URL
  private function checkIdValidity(){
    if (!isset($this->parameters[0]))
      $this->redirectToHomePage();

    $this->model->id = filter_var($this->parameters[0], FILTER_SANITIZE_NUMBER_INT);

    if (empty($this->model->id))
      $this->redirectToHomePage();
  }

  private function fetchPrivilegeById(){
    $this->checkIdValidity();
    $this->data = $this->model->fetchRecord();
    if (! $this->data)
      $this->redirectToHomePage();
  }

  private function editPrivilege(){
    if (isset($_POST['submit'])) {

      $this->model->Name = $this->sanitizeString($_POST['privilege']);
      $this->model->url_title = $this->sanitizeString($_POST['link']);
      if ($this->model->edit())
        $this->messenger->addMessage("Privilege is Updated successfully.");
      else
        $this->messenger->addMessage("Failed to update this privilege.", Messenger::ERROR_MESSAGE);
    }
  }

  public function edit(){

    $this->fetchPrivilegeById();
    $this->editPrivilege();

    $this->pageTitle = "Edit Privilege";
    $this->view();
  }

  public function delete(){
    $this->checkIdValidity();

    if($this->model->deleteByPK())
      $this->messenger->addMessage( "Privilege is Removed successfully.");
    else
      $this->messenger->addMessage("Failed to remove this privilege.", Messenger::ERROR_MESSAGE);

    helpers::reDirectAfterTime($this->controller, 2);
    $this->main();
  }

}
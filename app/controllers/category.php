<?php


namespace MVC\controllers;


use MVC\core\helpers;
use MVC\core\Messenger;
use MVC\core\validation;
use MVC\models\category as categoryModel;

class category extends controller
{

  public function __construct($db){
    parent::__construct($db);

    $this->viewFolderName = 'category';
    $this->model = new categoryModel($db);
  }

  public function main()
  {
    $this->data['mainData'] = $this->model->fetchModelRecords();
    $this->pageTitle = 'Categories';
    $this->method = "main";
    $this->view();
  }

  private function validateName(){

    $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);

    $result = true;
    if (empty($name))
    {
      $this->messenger->addMessage("Client Name is required.", Messenger::ERROR_MESSAGE);
      $result = false;
    }
    if (! validation::isAlphabetical($name)) {
      $this->messenger->addMessage("Client Name must be only alphabetical.", Messenger::ERROR_MESSAGE);
      $result = false;
    }

    if ($result)
      $this->model->Name = $name;

    return $result;
  }

  private function validateData(){

    // validating full name
    if(! $this->validateName() ) return false;

    // validating Email
    if (! $this->validateEmail()) return false;

    // validating Phone Number
    if (!$this->validatePhoneNumber()) return false;

    // validating address
    if (!$this->validateAddress()) return false;

    return true;
  }

  public function add(){

    $this->pageTitle = "Add Category";

    if (isset($_POST['submit'])) {

      print_r($_FILES);die;
      if(! $this->validateData()){
        $this->view();
        return;
      }
      if($this->model->add() == clientModel::EMAIL_EXIT_ERROR)
        $this->messenger->addMessage("This email is already exist.", Messenger::ERROR_MESSAGE);
      else if($this->model->add())
        $this->messenger->addMessage("Client has been added successfully.");
      else
        $this->messenger->addMessage("Failed to add this client.", Messenger::ERROR_MESSAGE);
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

  private function isSameOldData(){
    return
        $this->data['storedClient']->Name == $_POST['name'] &&
        $this->data['storedClient']->PhoneNumber == $_POST['phone'] &&
        $this->data['storedClient']->Email == $_POST['email'] &&
        $this->data['storedClient']->address == $_POST['address'];
  }

  public function edit(){
    $this->checkIdValidity();
    $this->pageTitle = "Edit Client";
    $this->data['storedClient'] = $this->model->fetchRecord();

    if (isset($_POST['submit']))
    {
      if ($this->isSameOldData()) {
        $this->messenger->addMessage("No change happened.", Messenger::WARNING_MESSAGE);
        $this->view();
        return;
      }

      if ($this->validateData())
      {
        if ($this->model->edit())
          $this->messenger->addMessage("Client has been successfully modified.");
        else
          $this->messenger->addMessage("Failed.", Messenger::ERROR_MESSAGE);
      }else
        $this->messenger->addMessage("Failed.", Messenger::ERROR_MESSAGE);
    }

    $this->data['storedClient'] = $this->model->fetchRecord();
    $this->view();
  }

  public function delete(){
    $this->checkIdValidity();

    if($this->model->deleteByPK())
      $this->messenger->addMessage( "Client is Removed successfully.");
    else
      $this->messenger->addMessage("Failed to remove this supplier.", Messenger::ERROR_MESSAGE);

    helpers::reDirectAfterTime($this->controller, 2);
    $this->main();
  }
}
<?php


namespace MVC\controllers;


use MVC\core\helpers;
use MVC\core\Messenger;
use MVC\core\session;
use MVC\core\validation;
use MVC\models\supplier as supplierModel;

class supplier extends controller
{

  public function __construct($db){
    parent::__construct($db);

    $this->viewFolderName = 'supplier';
    $this->model = new supplierModel($db);
  }

  public function main()
  {
    $this->data['mainData'] = $this->model->fetchModelRecords();
    $this->pageTitle = 'Suppliers';
    $this->method = "main";
    $this->view();
  }

  private function validateEmail(){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // check not empty
    if (empty($email))
    {
      $this->messenger->addMessage("Email is required", Messenger::ERROR_MESSAGE);
      return false;
    }

    // check data type
    if (! validation::isEmail($email))
    {
      $this->messenger->addMessage("Invalid Email", Messenger::ERROR_MESSAGE);
      return false;
    }

    $this->model->email = $email;
    return true;
  }

  private function validatePhoneNumber(){
    $number = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);

    if (! is_integer((int)$number) || !validation::between(strlen($number),11,15))
    {
      $this->messenger->addMessage("Invalid Phone Number", Messenger::ERROR_MESSAGE);
      return false;
    }
    $this->model->phoneNumber = $number;
    return true;
  }

  private function validateName(){

    $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);

    $result = true;
    if (empty($name))
    {
      $this->messenger->addMessage("Supplier Name is required.", Messenger::ERROR_MESSAGE);
      $result = false;
    }
    if (! validation::isAlphabetical($name)) {
      $this->messenger->addMessage("First Name must be only alphabetical.", Messenger::ERROR_MESSAGE);
      $result = false;
    }

    if ($result)
      $this->model->Name = $name;

    return $result;
  }

  private function validateAddress(){

    $address = filter_var($_POST['address'],FILTER_SANITIZE_STRING);

    if (empty($address))
    {
      $this->messenger->addMessage("Address is required.", Messenger::ERROR_MESSAGE);
      return false;
    }
    else $this->model->address = $address;

    return true;
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

    $this->pageTitle = "Add Supplier";

    if (isset($_POST['submit'])) {

      if(! $this->validateData()){
        $this->view();
        return;
      }
      if($this->model->add() == supplierModel::EMAIL_EXIT_ERROR)
        $this->messenger->addMessage("This email is already exist.", Messenger::ERROR_MESSAGE);
      else if($this->model->add())
        $this->messenger->addMessage("Supplier has been added successfully.");
      else
        $this->messenger->addMessage("Failed to add this supplier.", Messenger::ERROR_MESSAGE);
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
        $this->data['storedSupplier']->Name == $_POST['name'] &&
        $this->data['storedSupplier']->PhoneNumber == $_POST['phone'] &&
        $this->data['storedSupplier']->Email == $_POST['email'] &&
        $this->data['storedSupplier']->address == $_POST['address'];
  }

  public function edit(){
    $this->checkIdValidity();
    $this->pageTitle = "Edit User";
    $this->data['storedSupplier'] = $this->model->fetchRecord();

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
          $this->messenger->addMessage("Supplier has been successfully modified.");
        else
          $this->messenger->addMessage("Failed.", Messenger::ERROR_MESSAGE);
      }else
        $this->messenger->addMessage("Failed.", Messenger::ERROR_MESSAGE);
    }

    $this->data['storedSupplier'] = $this->model->fetchRecord();
    $this->view();
  }

  public function delete(){
    $this->checkIdValidity();

    if($this->model->deleteByPK())
      $this->messenger->addMessage( "Supplier is Removed successfully.");
    else
      $this->messenger->addMessage("Failed to remove this supplier.", Messenger::ERROR_MESSAGE);

    helpers::reDirectAfterTime($this->controller, 2);
    $this->main();
  }


}
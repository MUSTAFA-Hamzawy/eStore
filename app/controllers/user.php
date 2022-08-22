<?php


namespace MVC\controllers;
use Cassandra\Exception\ValidationException;
use MVC\core\helpers;
use MVC\core\Messenger;
use MVC\core\session;
use MVC\core\validation;
use MVC\models\group;
use MVC\models\model;
use MVC\models\user as userModel;


class user extends controller
{
    private $groupModel;
    public function __construct($db){
      parent::__construct($db);

      $this->viewFolderName = 'user';
      $this->model = new userModel($db);
      $this->groupModel = new group($db);
    }

    public function main()
    {
//      $this->data['myData'] = $this->model->fetchModelRecords();
      $this->data['mainData'] = $this->model->getUserGroups();
      $this->pageTitle = 'Users';
      $this->method = "main";
      $this->view();
    }
    private function validateChosenGroup(){
//      print_r($_POST);die;
      $selectedGroupId = filter_var($_POST['selectedGroup'], FILTER_SANITIZE_NUMBER_INT);
      if (empty($selectedGroupId) || ! is_integer((int)$selectedGroupId))
        $this->messenger->addMessage("Invalid Chosen Group", Messenger::ERROR_MESSAGE);
      else
        $this->model->groupId = $selectedGroupId;
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

    private function validateUsername(){
      $username = validation::sanitizeString($_POST['username']);

      // check not empty
      if (empty($username))
      {
        $this->messenger->addMessage("username is required", Messenger::ERROR_MESSAGE);
        return false;
      }

      // check data type
      if (! is_string($username))
      {
        $this->messenger->addMessage("Invalid Username", Messenger::ERROR_MESSAGE);
        return false;
      }

      // check length
      if (! validation::between(strlen($username),5, 25))
      {
        $this->messenger->addMessage("username length must be between 5 and 25", Messenger::ERROR_MESSAGE);
        return false;
      }

      $this->model->username = $username;
      return true;
    }

    private function checkPasswordPower($password){
    if (strlen($password) < 8)
    {
      $this->messenger->addMessage("Write more powerful password", Messenger::WARNING_MESSAGE);
      return false;
    }

    if (! preg_match("/[a-z]/i", $password) || ! preg_match("/[0-9]/", $password))
    {
        $this->messenger->addMessage("Password must be mix of characters and numbers", Messenger::WARNING_MESSAGE);
        return false;
    }

    if (! preg_match("/[A-Z]/", $password))
    {
        $this->messenger->addMessage("Password must have at least one Capital character", Messenger::WARNING_MESSAGE);
        return false;
    }

    return true;
  }

    private function validatePassword(){
    $password = validation::sanitizeString($_POST['password']);

    // check not empty
    if (empty($password))
    {
      $this->messenger->addMessage("Password is required", Messenger::ERROR_MESSAGE);
      return false;
    }

    // check data type
    if (! is_string($password))
    {
      $this->messenger->addMessage("Password must be only alphanumeric", Messenger::ERROR_MESSAGE);
      return false;
    }

    // check powerful
    if (! $this->checkPasswordPower($password))
      return false;

    $this->model->password = $password;
    return $password;
  }

    private function checkSamePassword($pass, $rePass){

        validation::sanitizeString($rePass);

        if ($pass !== $rePass){
          $this->messenger->addMessage("Two passwords are not matching", Messenger::WARNING_MESSAGE);
          return false;
        }
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

    private function validateData(){
      $condition = true;

      // validating Selected Group
      $this->validateChosenGroup();

      // validating username
      $condition = $this->validateUsername();

      // validating Email
      $condition = $this->validateEmail();

      // validating Password
      $password  = $this->validatePassword();

      // validating Confirm Password
      $condition = $this->checkSamePassword($password, $_POST['CPassword']);

      // validating Phone Number
      if (! empty($_POST['phone']))
        $condition = $this->validatePhoneNumber();

      return $condition;
    }

    private function checkAddSuccess(){

      $returnCode = $this->model->add();

      switch ($returnCode)
      {
        case userModel::SUCCESS_ADD_CODE :
          $this->messenger->addMessage("User has been added successfully.");
        break;
        case userModel::FAIL_ADD_CODE :
          $this->messenger->addMessage("Failed to add this user.", Messenger::ERROR_MESSAGE);
        break;
        case userModel::EMAIL_EXIT_ERROR :
          $this->messenger->addMessage("Email is already exist.", Messenger::WARNING_MESSAGE);
        break;
        case userModel::USERNAME_EXIT_ERROR :
          $this->messenger->addMessage("Username is used.", Messenger::WARNING_MESSAGE);
        break;
        case userModel::PHONE_NUMBER_EXIT_ERROR :
          $this->messenger->addMessage("Phone Number is used before.", Messenger::WARNING_MESSAGE);
          break;
      }

    }

    public function add(){

    $this->pageTitle = "Add User";
    $this->data['groups'] = $this->groupModel->fetchModelRecords();

    if (isset($_POST['submit'])) {

      if(! $this->validateData()){
        $this->view();
        return;
      }
      $this->checkAddSuccess();
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

    public function delete(){
      $this->checkIdValidity();

      if($this->model->deleteByPK())
        $this->messenger->addMessage( "User is Removed successfully.");
      else
        $this->messenger->addMessage("Failed to remove this user.", Messenger::ERROR_MESSAGE);

      helpers::reDirectAfterTime($this->controller, 2);
      $this->main();
    }

    public function register(){
        if (!empty($_SESSION))
            helpers::reDirect("../admin");

        $this->view("MainFiles/register", $this->errors);
    }

    public function registerValidation(){

        // this condition to prevent errors if the user selected the url then pressed Enter
        if (!isset($_POST['name']))
            helpers::reDirect("register");

        $this->validateEmail($_POST['email']);
        $this->validateName($_POST['name']);
        $this->validatePassword($_POST['password']);
        $this->checkSamePassword($_POST['password'], $_POST['rePassword']);

        if (! empty($this->errors))
            $this->view("MainFiles/register", $this->errors);
        else{
            $this->addUser();
        }
    }

    public function login(){
        if (!empty($_SESSION))
            helpers::reDirect("../admin");

        $this->view("MainFiles\login");
    }

    public function validateLogin(){

        // this condition to prevent errors if the user selected the url then pressed Enter
        if (!isset($_POST['email']))
            helpers::reDirect("login");

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_EMAIL);

        if (empty($email))
            $this->addError("Email is required.");
        if (empty($password))
            $this->addError("Password is required.");
        if (!empty($this->errors))
            $this->view("MainFiles/login", $this->errors);

        $loginCondition = $this->userModel->checkUserExist($email, $password);

        if ($loginCondition)
        {
            session::set('email', $email);
            session::set('name', $this->userModel->getUserName($email));

            helpers::reDirect("../admin");
        }else{
            $this->addError("Failed!, Wrong email or password.");
            $this->view("MainFiles/login", $this->errors);
        }
    }

    public function logout(){
        session::stop();
        helpers::reDirect("../user/login");
    }

    private function addUser(){
        $data = [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "password" => $_POST['password']
        ];
        $this->userModel->addUser($data);

        session::set("name", $_POST['name']);
        session::set("email", $_POST['email']);

        helpers::reDirect("../admin");
    }

    public function getErrors(){
        return $this->errors;
    }

    public function clearErrors(){
        unset($this->errors);
    }

    public function showUsersInfo(){
        $this->view();
    }



}
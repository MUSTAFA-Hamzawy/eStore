<?php


namespace MVC\controllers;
use MVC\core\helpers;
use MVC\core\Messenger;
use MVC\core\session;
use MVC\models\user as UserModel;

class authentication extends controller
{

  public function __construct($db){
    parent::__construct($db);

    $this->viewFolderName = "auth";
    $this->model = new UserModel($db);
  }

  public function main()
  {
    $this->login();
  }

  private function isUserFound(){

    $username = $_POST['username'];
    $password = $_POST['password'];
    return $this->model->authenticate($username, $password, $userData);
  }

  private function handleResult($isUserFound){

    switch ($isUserFound)
    {
      case UserModel::SUCCESS_LOGIN:
        $this->messenger->addMessage("Success Login, you'll be redirected to your page.");
        helpers::reDirect("home/main");
        break;
      case UserModel::DISABLED_USER:
        $this->messenger->addMessage("Sorry, You are disabled.", Messenger::WARNING_MESSAGE);
        break;
      case UserModel::NOT_FOUND_USER:
        $this->messenger->addMessage("Email or Password is wrong.", Messenger::ERROR_MESSAGE);
        break;
    }

  }

  public function login(){

    // if the user is already logged in, redirect him to the home page
    if(\MVC\core\Authentication::getInstance()->isAuthorized())
      helpers::reDirect("home/main");

    $this->pageTitle = 'Login';
    if (isset($_POST['submit']))
    {
      $isFound = $this->isUserFound();
      $this->handleResult($isFound);
    }
    $this->view();
  }

  public function logout(){
      session::stop();
      helpers::reDirect("authentication/login");
  }


}
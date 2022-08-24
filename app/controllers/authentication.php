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
  public function login(){

    if(\MVC\core\Authentication::getInstance()->isAuthorized())
      helpers::reDirect("userGroups");      // todo-me: check if is authorized-->go to his privilege direct

    $this->pageTitle = 'Login';

    if (isset($_POST['submit']))
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $found = $this->model->authenticate($username, $password, $userData);

      switch ($found)
      {
        case UserModel::SUCCESS_LOGIN:
          $this->messenger->addMessage("Success Login, you'll be redirected to your page.");
          helpers::reDirect("userGroups");  //todo-me: change it to his privilege url_link
         break;
        case UserModel::DISABLED_USER:
          $this->messenger->addMessage("Sorry, You are disabled.", Messenger::WARNING_MESSAGE);
          break;
        case UserModel::NOT_FOUND_USER:
          $this->messenger->addMessage("Email or Password is wrong.", Messenger::ERROR_MESSAGE);
          break;
      }
    }
    $this->view();
  }
  public function logout(){
    if (\MVC\core\Authentication::getInstance()->isAuthorized())
    {
      session::stop();
      helpers::reDirect("authentication/login");
    }

  }


}
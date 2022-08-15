<?php


namespace MVC\controllers;
use MVC\core\helpers;
use MVC\core\session;
use MVC\core\validation;
use MVC\models\model;
use MVC\models\user as userModel;


class user extends controller
{
    public function __construct(){
      parent::__construct();
      $this->viewFolderName = 'user';
      $this->model = new userModel();
    }

    public function main()
    {
        helpers::reDirect("user/login");
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
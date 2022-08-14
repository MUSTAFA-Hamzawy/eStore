<?php


namespace MVC\controllers;
use MVC\core\helpers;
use MVC\core\session;
use MVC\models\model;
use MVC\models\user as userModel;
use function Sodium\add;


class user extends controller
{
    private $errors;
    private $userModel;

    public function __construct(){
        session::start();
        $this->userModel = new userModel();
    }

    /***********  Private Methods  ***************/
    private function sanitizeString(&$str)
    {
        $str = filter_var($str,FILTER_SANITIZE_STRING);
    }

    private function validateEmail(&$email)
    {
        if (empty($email))
        {
            $this->addError("Email Field can't be empty.");
            return;
        }

        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

        if ($email === false)
        {
            $this->addError("Invalid Email");
            return;
        }
    }

    private function validateName(&$str)
    {
        if (empty($str))
        {
            $this->addError("Name Field is required");
            return;
        }
        $this->sanitizeString($str);
    }

    private function checkPasswordPower(&$str){
        if (strlen($str) < 8)
        {
            $this->addError("Write more powerful password");
            return;
        }
        if (! preg_match("/[a-z]/i", $str) || ! preg_match("/[0-9]/", $str))
        {
            {
                $this->addError("Password must be mix of characters and numbers");
                return;
            }
        }
        if (! preg_match("/[A-Z]/", $str))
        {
            {
                $this->addError("Password must have at least one Capital character");
                return;
            }
        }
    }

    private function validatePassword(&$str)
    {
        if (empty($str))
        {
            $this->addError("Password Field is required");
            return;
        }

        $this->sanitizeString($str);

        $this->checkPasswordPower($str);
    }

    private function checkSamePassword($pass, $rePass){

        $this->sanitizeString($rePass);

        if ($pass !== $rePass)
            $this->addError("Two Passwords are not matching");
    }

    private function addError($error){
        $this->errors[] = $error;
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

    /***********  Public Methods  ***************/

    public function defaultMethod()
    {
        helpers::reDirect("user/login");
    }

    public function register(){

        if (!empty($_SESSION))
            helpers::reDirect("../admin");

        $this->view("dashboard/register", $this->errors);
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
            $this->view("dashboard/register", $this->errors);
        else{
            $this->addUser();
        }
    }

    public function login(){
        if (!empty($_SESSION))
            helpers::reDirect("../admin");

        $this->view("dashboard/login", $this->errors);
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
            $this->view("dashboard/login", $this->errors);

        $loginCondition = $this->userModel->checkUserExist($email, $password);

        if ($loginCondition)
        {
            session::set('email', $email);
            session::set('name', $this->userModel->getUserName($email));

            helpers::reDirect("../admin");
        }else{
            $this->addError("Failed!, Wrong email or password.");
            $this->view("dashboard/login", $this->errors);
        }
    }

    public function logout(){
        session::stop();
        helpers::reDirect("../user/login");
    }

    public function getErrors(){
        return $this->errors;
    }

    public function clearErrors(){
        unset($this->errors);
    }
}
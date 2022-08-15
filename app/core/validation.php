<?php


namespace MVC\core;


trait validation
{
  public function sanitizeString($str)
  {
    $str = filter_var($str,FILTER_SANITIZE_STRING);
    return $str;
  }

  public function validateEmail(&$email)
  {
    if (empty($email))
    {
      $this->addMessageToUser('errors', "Email Field can't be empty.");
      return;
    }

    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

    if ($email === false)
    {
      $this->addMessageToUser('errors',"Invalid Email");
      return;
    }
  }

  public function validateName(&$str)
  {
    if (empty($str))
    {
      $this->addMessageToUser('errors',"Name Field is required");
      return;
    }
    $this->sanitizeString($str);
  }

  public function checkPasswordPower(&$str){
    if (strlen($str) < 8)
    {
      $this->addMessageToUser('errors',"Write more powerful password");
      return;
    }
    if (! preg_match("/[a-z]/i", $str) || ! preg_match("/[0-9]/", $str))
    {
      {
        $this->addMessageToUser('errors',"Password must be mix of characters and numbers");
        return;
      }
    }
    if (! preg_match("/[A-Z]/", $str))
    {
      {
        $this->addMessageToUser('errors',"Password must have at least one Capital character");
        return;
      }
    }
  }

  public function validatePassword(&$str)
  {
    if (empty($str))
    {
      $this->addMessageToUser('errors',"Password Field is required");
      return;
    }

    $this->sanitizeString($str);

    $this->checkPasswordPower($str);
  }

  public function checkSamePassword($pass, $rePass){

    $this->sanitizeString($rePass);

    if ($pass !== $rePass)
      $this->addMessageToUser('errors',"Two Passwords are not matching");
  }
}
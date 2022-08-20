<?php


namespace MVC\core;


trait validation
{

  private $regExPattern = [
      'num'   => '/^[0-9]+(?:\.[0-9]+)?$/',     // no -ve values
      'int'   => '/^[0-9]+$/',
      'float' => '/^[0-9]+\.[0-9]+$/',
      'alphabet' => '/^[a-z\p{Arabic}]+$/iu',
      'alpha_numeric' => '/^[a-z0-9\p{Arabic}]+$/iu',
      'date' => '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/',
      'email' =>  '/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b/i',
      'url' => "/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/"

  ];

  public function isAlphabetical($value){
    return (boolean) preg_match($this->regExPattern['alphabet'], $value);
  }

  public function isAlphaNumeric($value){
    return (boolean) preg_match($this->regExPattern['alpha_numeric'], $value);
  }

  public function isDate($value){
    return (boolean) preg_match($this->regExPattern['date'], $value);
  }

  public function isEmail($value){
    return (boolean) preg_match($this->regExPattern['email'], $value);
  }

  public function isUrl($value){
    return (boolean) preg_match($this->regExPattern['url'], $value);
  }


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
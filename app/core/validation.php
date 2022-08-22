<?php


namespace MVC\core;


class validation
{

  private static $regExPattern = [
      'num'   => '/^[0-9]+(?:\.[0-9]+)?$/',     // no -ve values
      'int'   => '/^[0-9]+$/',
      'float' => '/^[0-9]+\.[0-9]+$/',
      'alphabet' => '/^[a-z\p{Arabic}]+$/iu',
      'alpha_numeric' => '/^[a-z0-9\p{Arabic}]+$/iu',
      'date' => '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/',
      'email' =>  '/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b/i',
      'url' => "/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/"

  ];

  public static function isAlphabetical($value){
    return (boolean) preg_match(self::$regExPattern['alphabet'], $value);
  }

  public static function isAlphaNumeric($value){
    return (boolean) preg_match(self::$regExPattern['alpha_numeric'], $value);
  }

  public static function isDate($value){
    return (boolean) preg_match(self::$regExPattern['date'], $value);
  }

  public static function isEmail($value){
    return (boolean) preg_match(self::$regExPattern['email'], $value);
  }

  public static function isUrl($value){
    return (boolean) preg_match(self::$regExPattern['url'], $value);
  }

  public static function between($value, $min, $max)
  {
    return $value >= $min && $value <= $max;
  }


  public static function sanitizeString($str)
  {
    return filter_var($str,FILTER_SANITIZE_STRING);
  }

  public static function validateEmail(&$email)
  {
    if (empty($email))
    {
      //self::$addMessageToUser('errors', "Email Field can't be empty.");
      return;
    }

    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

    if ($email === false)
    {
      //self::$addMessageToUser('errors',"Invalid Email");
      return;
    }
  }

  public static function validateName(&$str)
  {
    if (empty($str))
    {
      //self::$addMessageToUser('errors',"Name Field is required");
      return;
    }
    //self::$sanitizeString($str);
  }

  public static function checkPasswordPower(&$str){
    if (strlen($str) < 8)
    {
      //self::$addMessageToUser('errors',"Write more powerful password");
      return;
    }
    if (! preg_match("/[a-z]/i", $str) || ! preg_match("/[0-9]/", $str))
    {
      {
        //self::$addMessageToUser('errors',"Password must be mix of characters and numbers");
        return;
      }
    }
    if (! preg_match("/[A-Z]/", $str))
    {
      {
        //self::$addMessageToUser('errors',"Password must have at least one Capital character");
        return;
      }
    }
  }

  public static function validatePassword(&$str)
  {
    if (empty($str))
    {
      //self::$addMessageToUser('errors',"Password Field is required");
      return;
    }

    //self::$sanitizeString($str);

   // self::$checkPasswordPower($str);
  }






}
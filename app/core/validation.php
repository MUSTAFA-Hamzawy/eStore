<?php


namespace MVC\core;


class validation
{

  private static $regExPattern = [
      'num'   => '/^[0-9]+(?:\.[0-9]+)?$/',     // no -ve values
      'int'   => '/^[0-9]+$/',
      'float' => '/^[0-9]+\.[0-9]+$/',
      'alphabet' => '/^[a-z\s\p{Arabic}]+$/iu',
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
    if ($value >= $min && $value <= $max)
      return $value >= $min && $value <= $max;
  }

  public static function sanitizeString($str)
  {
    return filter_var($str,FILTER_SANITIZE_STRING);
  }






}
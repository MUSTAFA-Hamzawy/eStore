<?php


namespace MVC\core;


class Registry
{
  private static $instance;
  private function __construct(){

  }
  private function __clone(){

  }
  public static function getInstance(){
    if (self::$instance === null)
      self::$instance = new self();

    return self::$instance;
  }

  public function __get($key){
    return $this->$key;
  }

  public function __set($key, $value)
  {
    $this->$key = $value;
  }


}
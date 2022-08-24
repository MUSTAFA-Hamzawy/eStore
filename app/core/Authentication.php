<?php


namespace MVC\core;


class Authentication
{
  private static $instance;
  private $allowedRoutes = [
      'accessDenied/main'
  ];

  private function __construct(){}
  private function __clone(){}

  public static function getInstance(){
    if (self::$instance == null)
    {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function isAuthorized(){
    session::start();
    if (session::get('user_data'))
      return true;
    return false;
  }

  public function canAccessRoute($route){
    print_r(session::get('user_data'));
    $privileges = session::get('user_data')['group_privileges'];
    return in_array($route, $this->allowedRoutes) || in_array($route, $privileges);
  }
}
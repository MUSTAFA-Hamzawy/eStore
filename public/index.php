<?php
  use MVC\core\UrlHandler;
use Dcblogdev\PdoWrapper\Database;
  require_once "../vendor/autoload.php";
  require_once "config.php";

  $options = [
      //required
      'username' => USER_NAME,
      'database' => DATABASE_NAME,
      //optional
      'password' => PASSWORD,
      'type' => 'mysql',
      'charset' => 'utf8',
      'host' => HOST_NAME,
      'port' => PORT
  ];

  $database = new Database($options);
  $app = new UrlHandler($database);
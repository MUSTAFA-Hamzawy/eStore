<?php


namespace MVC\core;


class Messenger
{
  const SUCCESS_MESSAGE = "Success";
  const ERROR_MESSAGE   = "Error";
  const WARNING_MESSAGE = "Warning";

  private static $instance;
  private static $messeges;

  private function __construct() { }

  private function __clone(){

  }

  public static function getInstance(){
    if (! isset(self::$instance))
    {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function messageExist($msg){
    return isset($this->session->messages);
}

  public function addMessage($msg, $msgType = self::SUCCESS_MESSAGE){
    if (!$this->messageExist($msg))
    {
      self::$messeges[] = [$msgType, $msg];
    }
  }

  public function getMesseges(){
    return self::$messeges;
  }

}
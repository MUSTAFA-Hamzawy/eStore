<?php


namespace MVC\models;
use MVC\core\session;
use PDO;

class user extends model
{
  public $id;
  public $username;
  public $password;
  public $email;
  public $phoneNumber	;
  public $joinDate	;
  public $groupId	;
  public $status	;

  const SUCCESS_ADD_CODE = 0;
  const EMAIL_EXIT_ERROR = 1;
  const USERNAME_EXIT_ERROR = 2;
  const PHONE_NUMBER_EXIT_ERROR = 3;
  const FAIL_ADD_CODE = 4;
  const NOT_FOUND_USER = 5;
  const DISABLED_USER = 6;
  const SUCCESS_LOGIN = 7;



  public function __construct($db)
  {
    parent::__construct($db);
    $this->tableName = "user";
    $this->primaryKey = 'id';
    $this->tableSchema = array('username', 'password', 'email', 'phone_number', 'group_id',);
    $this->phoneNumber = null;   // optional

  }

  public function edit(){

    $data = array_combine(
        [$this->tableSchema[3], $this->tableSchema[4]],
        [$this->phoneNumber,$this->groupId]
    );
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update($this->tableName, $data, $condition);
  }

  public function authenticate($username, $password, &$userData){
    $password = md5($password);
    $query = "SELECT * FROM `user` where `username` = ? AND `password` = ?";
    $conditions = [$username, $password];
    $data = $this->db->row($query, $conditions);
    if ($data)
    {
      if ($data->status == 1){
        session::start();
        session::set('user', $data);
        return self::SUCCESS_LOGIN;
      }
      if ($data->status == 0)
        return self::DISABLED_USER;
    }
    return self::NOT_FOUND_USER;
  }

  private function isEmailExist(){
    $query = "SELECT `{$this->primaryKey}` FROM `{$this->tableName}` WHERE `email` = ? ";
    $conditions = [$this->email];
    $count = $this->db->count($query, $conditions);
    return $count > 0;
  }

  private function isUsernameExist(){
    $query = "SELECT `{$this->primaryKey}` FROM `{$this->tableName}` WHERE `username` = ? ";
    $conditions = [$this->username];
    $count = $this->db->count($query, $conditions);
    return $count > 0;
  }

  private function isPhoneNumberExist(){
    $query = "SELECT `{$this->primaryKey}` FROM `{$this->tableName}` WHERE `phone_number` = ? ";
    $conditions = [$this->phoneNumber];
    $count = $this->db->count($query, $conditions);
    return $count > 0;
  }

  public function hashPassword($pass){
    return md5($pass,);
  }

  public function add()
    {
      $nonExistingUser = true;
      if ($this->isEmailExist())
        return self::EMAIL_EXIT_ERROR;
      if ($this->isUsernameExist())
        return self::USERNAME_EXIT_ERROR;
      if ( $this->phoneNumber != "NULL" && $this->isPhoneNumberExist())
        return self::PHONE_NUMBER_EXIT_ERROR;

      $data = array_combine($this->tableSchema, [
          $this->username, $this->password, $this->email, $this->phoneNumber,$this->groupId
      ]);
      if ($this->db->insert($this->tableName, $data))
        return self::SUCCESS_ADD_CODE;
      return self::FAIL_ADD_CODE;
    }

  public function addUserMessage(){

  }

  public function getUserGroups(){
    $query = "SELECT `user`.`id`,`username`, `phone_number`,`email`, `last_login`,`join_date`,users_groups.name as groupName
                from `user` INNER JOIN users_groups ON `user`.`group_id` = users_groups.id;";
    return $this->db->rows($query);
  }

}
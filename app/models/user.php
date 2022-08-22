<?php


namespace MVC\models;
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



  public function __construct($db)
  {
    parent::__construct($db);
    $this->tableName = "user";
    $this->primaryKey = 'id';
    $this->tableSchema = array('username', 'password', 'email', 'phone_number', 'group_id',);
    $this->phoneNumber = null;   // optional
  }

  public function edit(){
    $data = array_combine($this->tableSchema, [
        $this->username, $this->password, $this->email, $this->phoneNumber,$this->groupId
    ]);
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update($this->tableName, $data, $condition);
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
    return $this->db->run($query)->fetchAll(PDO::FETCH_ASSOC);
  }
}
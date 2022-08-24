<?php


namespace MVC\models;
use MVC\core\session;
use PDO;

class userProfile extends model
{
  public $id;
  public $firstName;
  public $lastName;
  public $address;
  public $dateOfBirth;
  public $image;

  public function __construct($db)
  {
    parent::__construct($db);
    $this->tableName = "user_profile";
    $this->primaryKey = 'id';
    $this->tableSchema = array('id','first_name', 'last_name', 'address', 'DOB', 'image');
  }

  public function edit(){

    $data = array_combine(
        [$this->tableSchema[3], $this->tableSchema[4]],
        [$this->phoneNumber,$this->groupId]
    );
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update($this->tableName, $data, $condition);
  }

  public function add()
  {
    $data = array_combine([$this->tableSchema[0], $this->tableSchema[1], $this->tableSchema[2]],
        [$this->id,$this->firstName, $this->lastName]);
    return $this->db->insert($this->tableName, $data);
  }



}
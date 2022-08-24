<?php


namespace MVC\models;


class client extends model
{

  public $id;
  public $Name;
  public $email;
  public $phoneNumber;
  public $address;

  const EMAIL_EXIT_ERROR = -1;

  public function __construct($db)
  {
    parent::__construct($db);
    $this->tableName = "client";
    $this->primaryKey = 'ClientId';
    $this->tableSchema = array('Name', 'PhoneNumber', 'Email', 'address');
  }

  private function isEmailExist(){
    $query = "SELECT `{$this->primaryKey}` FROM `{$this->tableName}` WHERE `Email` = ? ";
    $conditions = [$this->email];
    $count = $this->db->count($query, $conditions);
    return $count > 0;
  }

  public function add(){

    if ($this->isEmailExist())
      return self::EMAIL_EXIT_ERROR;

    $data = array_combine($this->tableSchema, [$this->Name,
        $this->phoneNumber, $this->email, $this->address
        ]);
    return $this->db->insert($this->tableName, $data);    // returned value is the last inserted id
  }

  public function edit(){
    $data = array_combine($this->tableSchema, [$this->Name,
        $this->phoneNumber, $this->email, $this->address
    ]);
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update($this->tableName, $data, $condition);
  }
}
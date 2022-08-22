<?php


namespace MVC\models;
use PDO;

class group extends model
{
  public $id;
  public $Name;


  public function __construct($db)
  {
    parent::__construct($db);
    $this->tableName = "users_groups";
    $this->primaryKey = 'id';
    $this->tableSchema = array('name');
  }

  public function add(){
    // check that email is not already exist



    $data = array_combine($this->tableSchema, [$this->Name]);
    $check = $this->db->insert($this->tableName, $data);
    return $check > 0 ;    // returned value is the last inserted id so it it is not 0, then successfully inserted
  }

  public function edit(){
    $data = array_combine($this->tableSchema, [$this->Name]);
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update($this->tableName, $data, $condition);
  }


}
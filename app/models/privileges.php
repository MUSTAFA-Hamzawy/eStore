<?php


namespace MVC\models;
use PDO;

class privileges extends model
{
  public $id;
  public $Name;
  public $url_title;

  public function __construct($db)
  {
    parent::__construct($db);
    $this->tableName = "privilleges";
    $this->primaryKey = 'id';
    $this->tableSchema = array('privillege', 'url_title');
  }

  public function add(){
    $data = array_combine($this->tableSchema, [$this->Name, $this->url_title]);
    $check = $this->db->insert($this->tableName, $data);
    return $check;    // returned value is the last inserted id
  }

  public function edit(){
    $data = array_combine($this->tableSchema, [$this->Name, $this->url_title]);
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update($this->tableName, $data, $condition);
  }
}
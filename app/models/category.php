<?php


namespace MVC\models;


class category extends model
{

  public $id;
  public $name;
  public $image;

  public function __construct($db)
  {
    parent::__construct($db);
    $this->tableName = "category";
    $this->primaryKey = 'CategoryId';
    $this->tableSchema = array('Name', 'Image');
  }

  public function add(){
    $data = array_combine($this->tableSchema, [$this->name, $this->image ]);
    return $this->db->insert($this->tableName, $data);    // returned value is the last inserted id
  }

  public function edit(){
    $data = array_combine($this->tableSchema, [$this->name, $this->image]);
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update($this->tableName, $data, $condition);
  }
}
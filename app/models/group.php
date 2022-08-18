<?php


namespace MVC\models;
use PDO;

class group extends model
{
  public $id;
  public $Name;
  public const tableName = "users_groups";
  public $tableSchema = array('name');
  protected $primaryKey = 'id';

  public function __construct()
  {
    parent::__construct();
  }

  public function fetchRecords(){
    $name = self::tableName;
    $query = "SELECT * FROM `{$name}`";
    return $this->db->rows($query);
  }

  /**
   * This function fetches the data of the a record that has primary key value equals to the data member id
   * @return object
   */
  public function fetchRecord(){
    $name = self::tableName;
    $query = "SELECT * FROM `{$name}` where {$this->primaryKey} = ?";
    return $this->db->row($query, [$this->id]);
  }

  public function add(){
    $data = array_combine($this->tableSchema, [$this->Name]);
    $check = $this->db->insert(self::tableName, $data);
    return $check > 0 ;    // returned value is the last inserted id so it it is not 0, then successfully inserted
  }

  public function edit(){
    $data = array_combine($this->tableSchema, [$this->Name]);
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update(self::tableName, $data, $condition);
  }

  public function deleteByPK(){
    $condition = [$this->primaryKey => $this->id];
    return $this->db->delete(self::tableName, $condition);
  }

  public function getLastInsertedId(){
    return $this->db->lastInsertId();
  }
}
<?php


namespace MVC\models;
use PDO;

class privileges extends model
{
  public $id;
  public $Name;
  public $url_title;
  public const tableName = "privilleges";
  public $tableSchema = array('privillege', 'url_title');
  protected $primaryKey = 'id';

  public function __construct()
  {
    parent::__construct();
  }

  public function fetchModelRecords(){   //todo-me : common functions in the abstract model + think of static functions
    $name = self::tableName;
    return $this->db->rows("SELECT * FROM " . self::tableName);
  }

  /**
   * This function fetches the data of the a record that has primary key value equals to the data member id
   * @return object
   */
  public function fetchRecord(){
    $name = self::tableName;
    $query = "SELECT * FROM {$name} where {$this->primaryKey} = ?";
    return $this->db->row($query, [$this->id]);
  }

  public function add(){
    $data = array_combine($this->tableSchema, [$this->Name, $this->url_title]);
    $check = $this->db->insert(self::tableName, $data);
    return $check;    // returned value is the last inserted id
  }

  public function edit(){
    $data = array_combine($this->tableSchema, [$this->Name, $this->url_title]);
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update(self::tableName, $data, $condition);
  }

  public function deleteByPK(){
    $condition = [$this->primaryKey => $this->id];
    return $this->db->delete(self::tableName, $condition);
  }
}
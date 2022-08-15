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

  public function fetchRecords(){
    $name = self::tableName;
    return $this->db->rows("SELECT * FROM " . self::tableName);
  }

  public function add(){
    $data = array_combine($this->tableSchema, [$this->Name, $this->url_title]);
    $check = $this->db->insert(self::tableName, $data);
    return $check > 0 ;    // returned value is the last inserted id so it it is not 0, then successfully inserted
  }

  public function edit(){

  }

  public function delete(){
    $condition = [$this->primaryKey => $this->id];
    return $this->db->delete(self::tableName, $condition);
  }
}
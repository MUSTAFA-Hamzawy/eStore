<?php


namespace MVC\models;

abstract class model
{
    protected $db;
    protected $tableName;
    protected $primaryKey;
    protected $tableSchema;

    public function __construct($db)
    {
      $this->db = $db;
    }

    public function fetchModelRecords(){
    $query = "SELECT * FROM `{$this->tableName}`";
    return $this->db->rows($query);
  }

    public function getLastInsertedId(){
      return $this->db->lastInsertId();
    }

    public function deleteByPK(){
      $condition = [$this->primaryKey => $this->id];
      return $this->db->delete($this->tableName, $condition);
    }

    /**
     * This function fetches the data of the a record that has primary key value equals to the data member id
     * @return object
     */
    public function fetchRecord(){
      $query = "SELECT * FROM `{$this->tableName}` where {$this->primaryKey} = ?";
      return $this->db->row($query, [$this->id]);
    }

    abstract public function add();
    abstract public function edit();


}
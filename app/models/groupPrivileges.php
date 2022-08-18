<?php


namespace MVC\models;
use PDO;

class groupPrivileges extends model
{
  public $id;
  public $groupId;
  public $privilegeId;
  public const tableName = "users_groups_privilleges";
  public $tableSchema = array('group_id', 'privillege_id');
  protected $primaryKey = 'id';

  public function __construct()
  {
    parent::__construct();
  }

  public function fetchModelRecords(){
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
    $data = array_combine($this->tableSchema, [$this->groupId, $this->privilegeId]);
    $check = $this->db->insert(self::tableName , $data);
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

  public function deleteGroupPrivilege(){
    $condition = [
        $this->tableSchema[0] => $this->groupId,
        $this->tableSchema[1] => $this->privilegeId
    ];
    return $this->db->delete(self::tableName, $condition);
  }

  public function getPrivilegesByGroupId(){
    $name = self::tableName;
    $query = "SELECT `privillege_id` FROM `{$name}` where group_id = ?";
    return $this->db->rows($query, [$this->groupId]);
  }
}
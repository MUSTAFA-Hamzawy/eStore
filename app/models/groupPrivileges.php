<?php


namespace MVC\models;
use PDO;

class groupPrivileges extends model
{
  public $id;
  public $groupId;
  public $privilegeId;

  public function __construct($db)
  {
    parent::__construct($db);
    $this->tableName = "users_groups_privilleges";
    $this->primaryKey = 'id';
    $this->tableSchema = array('group_id', 'privillege_id');
  }

  public function add(){
    $data = array_combine($this->tableSchema, [$this->groupId, $this->privilegeId]);
    $check = $this->db->insert($this->tableName, $data);
    return $check > 0 ;    // returned value is the last inserted id so it it is not 0, then successfully inserted
  }

  public function edit(){
    $data = array_combine($this->tableSchema, [$this->Name]);
    $condition = [$this->primaryKey => $this->id];
    return $this->db->update($this->tableName, $data, $condition);
  }

  public function deleteGroupPrivilege(){
    $condition = [
        $this->tableSchema[0] => $this->groupId,
        $this->tableSchema[1] => $this->privilegeId
    ];
    return $this->db->delete($this->tableName, $condition);
  }

  public function getPrivilegesByGroupId(){
    $query = "SELECT `privillege_id` FROM `{$this->tableName}` where group_id = ?";
    return $this->db->rows($query, [$this->groupId]);
  }

  public function getGroupAndPrivileges($groupId){
    $query = "
      SELECT privilleges.url_title from `users_groups` INNER JOIN `users_groups_privilleges` 
      ON `users_groups`.`id` = users_groups_privilleges.group_id
      INNER JOIN privilleges ON privilleges.id = users_groups_privilleges.privillege_id
      WHERE users_groups.id = ?;
      ";

    $data = $this->db->rows($query, [$groupId]);
    $extractedURLs = [];
    foreach ($data as $item)
      $extractedURLs[] = $item->url_title;

    return $extractedURLs;

  }
}
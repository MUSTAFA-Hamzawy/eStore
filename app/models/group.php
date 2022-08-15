<?php


namespace MVC\models;


class group extends model
{
  public $id;
  public $Name;
  protected static $tableName = "group";
  protected static $tableSchema = [
      'id', 'Name'
  ];
  protected static $primaryKey = 'id';
}
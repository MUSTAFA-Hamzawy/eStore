<?php


namespace MVC\models;
use Dcblogdev\PdoWrapper\Database;

abstract class model
{
    protected $db;

    public function __construct()
    {
        $options = [
            //required
            'username' => USER_NAME,
            'database' => DATABASE_NAME,
            //optional
            'password' => PASSWORD,
            'type' => 'mysql',
            'charset' => 'utf8',
            'host' => HOST_NAME,
            'port' => PORT
        ];

        $this->db = new Database($options);
    }

    public function getLastInsertedId(){
      return $this->db->lastInsertId();
    }

    abstract public function fetchModelRecords();
    abstract public function fetchRecord();
    abstract public function add();
    abstract public function edit();
    abstract public function deleteByPK();

}
<?php


namespace MVC\models;
use Dcblogdev\PdoWrapper\Database;

class model
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
}
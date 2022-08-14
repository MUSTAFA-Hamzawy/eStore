<?php


namespace MVC\models;
use Dcblogdev\PdoWrapper\Database;

class model
{
    protected $connect;

    public function __construct()
    {
        $options = [
            //required
            'username' => 'root',
            'database' => 'news_website',
            //optional
            'password' => '',
            'type' => 'mysql',
            'charset' => 'utf8',
            'host' => 'localhost',
            'port' => '3306'
        ];

        $this->connect = new Database($options);
    }
}
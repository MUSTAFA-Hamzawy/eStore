<?php


namespace MVC\models;
use PDO;

class user extends model
{

    public function checkUserExist($email, $password)
    {
        $query = "SELECT password from user where email = ?";
        $result = $this->connect->run($query, [$email])->fetch(PDO::FETCH_ASSOC);
        if (isset($result['password']))
            return $result['password'] == $password;
        else return false;
    }

    // data is an associated array
    public function addUser($data)
    {
        $this->connect->insert('user', $data);
    }

    public function getUserName($email)
    {
        $query = "SELECT `name` from `user` where email = ?";
        $result = $this->connect->run($query, [$email])->fetch(PDO::FETCH_ASSOC);
        return $result['name'];
    }
}
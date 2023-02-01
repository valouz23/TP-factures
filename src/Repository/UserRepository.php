<?php

namespace Fac\Repository;

use Fac\Connection;

class UserRepository{
    private $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    public function getAllUser(){
        $sql = "SELECT name FROM user";
        return $this->connection->query(sql)->fetchAll();
    }

    public function getUserById(int $i){
        $sql = "SELECT name, email FROM user WHERE id =$i";
        return $this->connection->query(sql)->fetchAll();
    }

    public function addUser(int $id, string $name, string $email){
        $sql = "INSERT INTO user VALUES ($id, $name, $email)";
        $this->connection->query($sql);
    }

    public function deleteUser(int $id){
        $sql = "DELETE FROM user WHERE id = $id";
        $this->connection->query($sql);
    }
}
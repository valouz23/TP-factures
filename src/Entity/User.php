<?php

namespace Fac\Entity;

class User {

    private int $id;
    private string $name;
    private string $email;

    public function setId($i){
        $this->id = $i;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($n){
        $this->name = $n;
    }

    public function getName(){
        return $this->name;
    }

    public function setMail($e){
        $this->email = $e;
    }

    public function getMail(){
        return $this->email;
    }
}
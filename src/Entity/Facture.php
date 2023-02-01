<?php

namespace Fac\Entity;

class Facture {
    private $num_facture;
    private $amount;
    private $id_user;
    private $statut;

    public function setNum(int $n){
        $this->num_facture = $n;
    }

    public function getNum(){
        return $this->num_facture;
    }

    public function setAmount(int $a){
        $this->amount = $a;
    }

    public function getAmount(){
        return ($this->amount);
    }

    public function setUserId(int $i){
        $this->id_user = $i;
    }

    public function getUserId(){
        return $this->id_user;
    }

    public function setStatut(bool $s){
        $this->statut = $s;
    }

    public function getStatut(){
        return $this->statut;
    }
}
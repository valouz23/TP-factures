<?php

namespace Fac\Repository;

use Fac\Connection;

class FactureRepository{
    private $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    public function findAllFacture(){
        $sql = "SELECT * FROM facture";
        return $this->connection->query($sql)->fetchAll();
    }

    public function findAllNumFacture(){
        $sql = "SELECT num_facture FROM facture";
        return $this->connection->query($sql)->fetchAll();
    }

    public function findAllFactureImpayés(){
        $sql = "SELECT * FROM facture WHERE statut = false";
        return $this->connection->query($sql)->fetchAll();
    }

    public function findAllFactureFromUser(int $i){
        $sql = "SELECT * FROM facture WHERE user_id = $i";
        return $this->connection->query($sql)->fetchAll();
    }
    
    public function getFactureById(int $n){
        $sql = "SELECT * FROM facture WHERE num_facture = $n";
        return $this->connection->query($sql)->fetchAll();
    }

    public function getFactureByUser(int $i){
        $sql = "SELECT * FROM facture WHERE user_id = $i";
        return $this->connection->query($sql)->fetchAll();
    }

    public function addFacture(int $num_facture, int $amount, int $user_id, bool $statut){
        $sql = "INSERT INTO facture VALUES ($num_facture, $amount, $user_id, $statut)";
        $this->connection->query($sql);
    }

    public function changeStatus(int $num_facture,bool $statut){
        $sql = "UPDATE facture SET statut = $statut WHERE num_facture = $num_facture";
        $this->connection->query($sql);
    }

    public function deleteFacture(int $num_facture){
        $sql = "DELETE FROM facture WHERE num_facture = $num_facture";
        $this->connection->query($sql);
    }
}


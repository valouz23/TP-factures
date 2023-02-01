<?php

$conn = new PDO('mysql:host=localhost', 'root', 'WINmaths42');

$sql_db = "CREATE DATABASE IF NOT EXISTS facturation";

if ($conn->query($sql_db) == TRUE){
    echo "Database successfully created\n";
} else {
    echo "Database creation failed\n";
}

$conn_db = new PDO('mysql:host=localhost;dbname=facturation', 'root', 'WINmaths42');

$sql_factures = "CREATE TABLE IF NOT EXISTS facture (
    num_facture INT(8) PRIMARY KEY,
    amount INT(6) NOT NULL,
    user_id INT(6) NOT NULL,
    statut BOOL NOT NULL
    )";

if ($conn_db->query($sql_factures) == TRUE){
    echo "Table successfully created\n";
} else {
    echo "Table creation failed\n";
}

$sql_clients = "CREATE TABLE IF NOT EXISTS clients (
    id INT(6) PRIMARY KEY,
    name VARCHAR(250) NOT NULL,
    email VARCHAR(250) NOT NULL
    )";

if ($conn_db->query($sql_clients) == TRUE){
    echo "Table successfully created\n";
} else {
    echo "Table creation failed\n";
}

require_once 'vendor/autoload.php';
require_once 'vendor/fakerphp/faker/src/autoload.php';

for($i=0; $i<15; $i++){
    $faker = Faker\Factory::create();
    $name = $faker->name();
    $email = $faker->email();

    $sql = "INSERT INTO clients VALUES ($i, '$name', '$email')";

    if(!$conn_db->query($sql)){
        echo "Erreur lors de l'ajout de l'utilisateur $name : ";
        print_r($conn_db->errorInfo());
    } else {
        echo "Utilisateur $name added successfully\n";
    }
}

for($i=0; $i <60; $i++){
    $faker = Faker\Factory::create();
    $amount = random_int(10,500);
    $user_id = random_int(0,14);
    $statut = $faker->randomElements(['true', 'false']);
    $sql = "INSERT INTO facture VALUES ($i, $amount, $user_id, $statut[0])";


    if(!$conn_db->query($sql)){
        echo "Erreur lors de l'ajout de la facture $name : ";
        print_r($conn_db->errorInfo());
    } else {
        echo "Facture $i added successfully\n";
    }

}




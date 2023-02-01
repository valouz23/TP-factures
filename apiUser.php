<?php

$conn = new PDO('mysql:host=localhost;dbname=facturation', 'root', 'WINmaths42');

header('Content-Type : application/json');
header('Access-Control-Allow-Origin: *');

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'GET':
        if(isset($_GET['id'])){
            getUserById($_GET['id']);
        } elseif (isset($_GET['name'])){
            getUserByName($_GET['name']);
        } else {
            handleGetRequest();
        }
        break;
    case 'POST':
        handlePostRequest();
        break;
    case 'DELETE':
        handleDeleteRequest($_GET['id']);
        break;
}

function getUserById(int $i){
    global $conn;

    $sql = "SELECT * FROM clients WHERE id = $i";
    $result = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    if($result<>array()){
        echo json_encode($result);
    } else {
        echo "Aucun client trouvé";
    }
}

function handleGetRequest(){
    global $conn;

    $sql = "SELECT * FROM clients";
    $result = $conn->query($sql);
    if($result->rowCount() >0){
        $clients=[];
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $clients[] = $row;
        }
        echo json_encode($clients);
    } else {
        echo "Aucun client trouvé";
    }
}

function handlePostRequest(){
    global $conn;

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO clients VALUES ($id, $name, $email)";
    echo json_encode($_POST);
    if($conn->query($sql)){
        $response = ['message' => 'Client ajouté avec succès'];
        echo json_encode($response);
    } else {
        $response = ['message' => "Erreur lors de l'ajout du client"];
        echo json_encode($response);
    }

}

function handleDeleteRequest(int $i){
    global $conn;

    $sql = "DELETE FROM clients WHERE id = $i";
    if($conn->query($sql)){
        $response = ['message' => 'Client supprimé avec succès'];
        echo json_encode($response);
    } else {
        $response = ['message' => "Erreur lors de la suppression du client"];
        echo json_encode($response);
    }
}
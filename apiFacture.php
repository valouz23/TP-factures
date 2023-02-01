<?php

$conn = new PDO('mysql:host=localhost;dbname=facturation', 'root', 'WINmaths42');

header('Content-Type : application/json');
header('Access-Control-Allow-Origin: *');

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'GET':
        if(isset($_GET['num_facture'])){
            getFactureByNum($_GET['num_facture']);
        } elseif (isset($_GET['user_id'])){
            getFactureByUser($_GET['user_id']);
        } else if (isset($_GET['statut'])){
            getFactureByStatut($_GET['statut']);
        } else {
            handleGetRequest();
        }
        break;
    case 'POST':
        handlePostRequest();
        break;
    case 'DELETE':
        handleDeleteRequest($_GET['num_facture']);
        break;
}

function getFactureByNum(int $n){
    global $conn;

    $sql = "SELECT * FROM facture WHERE num_facture = $n";
    $result = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    if($result<>array()){
        echo json_encode($result);
    } else {
        echo "Aucunes factures trouvées";
    }
}

function getFactureByUser(int $i){
    global $conn;

    $sql = "SELECT * FROM facture WHERE user_id = $i";
    $result = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    if($result<>array()){
        echo json_encode($result);
    } else {
        echo "Aucunes factures trouvées";
    }
}

function getFactureByStatut($s){
    global $conn;

    $sql = "SELECT * FROM facture WHERE statut = $s";
    $result = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    if($result<>array()){
        echo json_encode($result);
    } else {
        echo "Aucunes factures trouvées";
    }
}

// function changeStatus(int $num_facture,bool $statut){
//     $sql = "UPDATE facture SET statut = $statut WHERE num_facture = $num_facture";
//     $this->connection->query($sql);
// }

function handleGetRequest(){
    global $conn;

    $sql = "SELECT * FROM facture";
    $result = $conn->query($sql);
    if($result->rowCount() >0){
        $factures=[];
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $factures[] = $row;
        }
        echo json_encode($factures);
    } else {
        echo "Aucunes factures trouvées";
    }
}

function handlePostRequest(){
    global $conn;

    $num_facture = $_POST['num_facture'];
    $amount = $_POST['amount'];
    $user_id = $_POST['user_id'];
    $statut = $_POST['statut'];
    $sql = "INSERT INTO facture VALUES ($num_facture, $amount, $user_id, $statut)";
    echo json_encode($_POST);
    if($conn->query($sql)){
        $response = ['message' => 'Facture ajoutée avec succès'];
        echo json_encode($response);
    } else {
        $response = ['message' => "Erreur lors de l'ajout de la facture"];
        echo json_encode($response);
    }

}

function handleDeleteRequest(int $n){
    global $conn;

    $sql = "DELETE FROM facture WHERE num_facture = $n";
    if($conn->query($sql)){
        $response = ['message' => 'Facture supprimée avec succès'];
        echo json_encode($response);
    } else {
        $response = ['message' => "Erreur lors de la suppression de la facture"];
        echo json_encode($response);
    }
}
<?php

namespace Fac\Controller;

use Fac\Entity\Facture;
use Fac\Repository\FactureRepository;

class FactureController{
    private $factureRepository;

    public function __construct(){
        $this->factureRepository = new FactureRepository();
    }

    public function handleRequest(){
        $errors =[];
        if ($_SERVER["REQUEST_METHOD"] = "POST"){
            if(empty($_POST['num_facture'])  or empty($_POST['amount']) or empty($_POST['user_id']) or ($_POST['statut']<>'true' and $_POST['statut']<>'false')){
                $errors[] = "Veuillez remplir tous les champs correctement";
                return $errors;
            }
            $facture = new Facture();
            $facture->setNum($_POST['num_facture']);
            $facture->setAmount($_POST['amount']);
            $facture->setUserId($_POST['user_id']);
            $facture->setStatut($_POST['statut']);
            $this->factureRepository->addFacture($facture->getNum(),$facture->getAmount(),$facture->getUserId(),$facture->getStatut());
    
        }

        header('Location: /');
        exit();
    }

}
<?php

namespace Fac\Controller;

use Fac\Entity\User;
use Fac\Repository\UserRepository;

class UserController{
    private $userRepository;

    public function __construct(){
        $this->userRepository = new userRepository();
    }

    public function handleRequest(){
        $errors =[];
        if ($_SERVER["REQUEST_METHOD"] = "POST"){
            if(empty($_POST['id'])  or empty($_POST['name']) or empty($_POST['email'])){
                $errors[] = "Veuillez remplir tous les champs correctement";
                return $errors;
            }
            $user = new User();
            $user->setId($_POST['id']);
            $user->setName($_POST['name']);
            $user->setMail($_POST['email']);
            $this->userRepository->addUser($user->getId(),$user->getName(),$user->getMail());
        }

        header('Location: /');
        exit();
    }

    

}
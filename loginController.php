<?php

require __DIR__.'/inc/db.php';

session_start();
//print_r($_POST);

if (isset($_POST['username']) && isset($_POST['password']))
{

    $dbConnexion = new DB ;
    $pdo = $dbConnexion->getPdo();

    print_r($_POST);
    //die;

    if($_POST['username']!=="" && $_POST['password']!==""){

        $pdoConnexionSecured = $pdo->prepare("SELECT * FROM utilisateurs WHERE `name`=:toto");
        $pdoConnexionSecured->bindValue(':toto', $_POST['username']);
        //$pdoConnexionSecured->bindValue(':password', $_POST['password']);
        $pdoConnexionSecured->execute();
        $result = $pdoConnexionSecured->fetch(PDO::FETCH_ASSOC);
        //print_r($result);
        var_dump($result);
        $isPasswordCorrect = password_verify($_POST['password'], $result['password']);
        var_dump($isPasswordCorrect);
        die;

        if ($isPasswordCorrect != 0) {
            die;
            $_SESSION['name'] = $result['name'];
            var_dump($_SESSION['name']);
            //die;
            header('Location: privatespace.php');
        } 
        else {
            header('Location: connexion.php?erreur=1');
        }   
    } 
    else {
        // fonction header me permet de faire une redirection cf la documentation : https://www.php.net/manual/fr/function.header.php
        header('Location: connexion.php?erreur=1');
    }
} 
else {
    header('Location: connexion.php');
}
<?php

require __DIR__.'/inc/db.php';

var_dump($_POST);
//die;

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password-check'])) {

    if ($_POST['username'] !== "" && $_POST['password'] !== "") {

        if ($_POST['password'] ===  $_POST['password-check']) {

            $dbConnexion = new DB;
            $pdo = $dbConnexion->getPdo();

            $newUserName = $_POST['username'];
            $newPass = $_POST['password'];
            $newPassSecured = password_hash($newPass, PASSWORD_DEFAULT);
            var_dump($newPassSecured);
        }



    } else {
        header('Location: inscription.php/?erreur=1');
        // erreur1 = Nom d'utilisateur ou mot de passe vide
    }

} else {
    header('Location: inscription.php');
}
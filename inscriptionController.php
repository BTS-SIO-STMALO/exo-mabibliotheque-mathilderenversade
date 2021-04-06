<?php

require __DIR__.'/inc/db.php';

var_dump($_POST);

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password-check'])) {

    if ($_POST['username'] !== "" && $_POST['password'] !== "") {

    } else {
        header('Location: inscription.php/?erreur=1');
        // erreur1 = Nom d'utilisateur ou mot de passe vide
    }

} else {
    header('Location: inscription.php');
}
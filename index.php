<?php

// Inclusion du fichier s'occupant de la connexion à la DB (TODO)
require __DIR__.'/inc/db.php'; // Pour __DIR__ => http://php.net/manual/fr/language.constants.predefined.php
// Rappel : la variable $pdo est disponible dans ce fichier
//          car elle a été créée par le fichier inclus ci-dessus
$dbConnexion = new DB; 

// Initialisation de variables (évite les "NOTICE - variable inexistante")
$bookList = array();
$genreList = array();
$name = '';
$author = '';
$release_date = '';
$genre = '';

// Si le formulaire a été soumis
if (!empty($_POST)) {
    // Récupération des valeurs du formulaire dans des variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $release_date = isset($_POST['release_date']) ? $_POST['release_date'] : '';
    $genre = isset($_POST['genre']) ? intval($_POST['genre']) : 0;
    
    // TODO #3 (optionnel) valider les données reçues (ex: donnée non vide)
    
    // TO DO #3 Insertion en DB d'un livre
    $insertQuery = "
 
    ";
    // TODO #3 exécuter la requête qui insère les données


    // TODO #3 une fois inséré, faire une redirection vers la page "index.php" (fonction header : https://www.php.net/manual/fr/function.header.php)


    }

// Liste des Genres
// TODO #4 récupérer cette liste depuis la base de données

$genreList = array(
    1 => 'Drame',
    2 => 'Poésie',
    3 => 'Je suis un genre statique',
    4 => 'Salut'
);




// TODO #1 écrire la requête SQL permettant de récupérer les livres en base de données (mais ne pas l'exécuter maintenant)
$sql = 'SELECT * FROM `book` 
';

// Si un tri a été demandé, on réécrit la requête
if (!empty($_GET['order'])) {
    // Récupération du tri choisi
    $order = trim($_GET['order']);
    if ($order == 'name') {
        // TODO #2 écrire la requête avec un tri par nom croissant
        $sql = 'SELECT * from `book`
        ORDER BY `name` ASC
        ';
    }
    else if ($order == 'author') {
        // TODO #2 écrire la requête avec un tri par autheur croissant
        $sql = 'SELECT * from `book`
        ORDER BY `author` ASC 
        ';
    }
}
// TODO #1 exécuter la requête contenue dans $sql et récupérer les valeurs dans la variable $BookList
$pdo = $dbConnexion->getPdo();
$pdoStatement = $pdo->query($sql);
//var_dump($pdoStatement);
$bookList = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
//var_dump($bookList);

// Inclusion du fichier s'occupant d'afficher le code HTML
require __DIR__.'/view/book.php';

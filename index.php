<?php

// Inclusion du fichier s'occupant de la connexion à la DB (TODO)
require __DIR__.'/inc/db.php'; // Pour __DIR__ => http://php.net/manual/fr/language.constants.predefined.php
// Rappel : la variable $pdo est disponible dans ce fichier
//          car elle a été créée par le fichier inclus ci-dessus
$dbConnexion = new DB; 
$pdo = $dbConnexion->getPdo();


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
    $insertQuery = "INSERT into `book` (name, author, release_date, genre_id)
    VALUES ('{$name}', '{$author}', '{$release_date}', '{$genre}');
    ";
    // TODO #3 exécuter la requête qui insère les données
    $pdoStatement = $pdo->exec($insertQuery);
    var_dump($pdoStatement);

    // TODO #3 une fois inséré, faire une redirection vers la page "index.php" (fonction header : https://www.php.net/manual/fr/function.header.php)
    header('Location', 'index.php');
    }

// Liste des Genres
// TODO #4 récupérer cette liste depuis la base de données
/*
$genreList = array(
    1 => 'Drame',
    2 => 'Poésie',
    3 => 'Je suis un genre statique',
    4 => 'Salut'
);
*/
// Afin de display correctement les genres en front sur mon tableau (et pas des chiffres correspondant aux ids de ces genres) j'ai besoin de récupérer l'id et de le faire correspondre au name correspondant. Je rajoute donc dans ma requête l'id
$sqlGenre = 'SELECT `id`, `name` from `genre`;
';
$pdoStatement = $pdo->query($sqlGenre);
/* avec ma nouvelle requête sql si je laisse le paramètre PDO::FETCH_COLUMN à mon fetchAll, et que je dump $genreList ça me renvoie ce tableau :
 0 => string '1' (length=1)
  1 => string '2' (length=1)
  2 => string '3' (length=1)
  3 => string '4' (length=1)
  !!! ça me va pas du tout. Je cherche donc le bon paramètre que me permet d'associer en clé l'id et en valeur le name correspondant ... Je sais pas comment faire => je fais une recherche en anglais sur google, je tombe sur cette ressource https://stackoverflow.com/questions/7451126/pdo-fetchall-group-key-value-pairs-into-assoc-array, je teste donc le paramètre FETCH_KEY_PAIR et ça me renvoie ça : 
1 => string 'Drame' (length=5)
  2 => string 'Poésie' (length=7)
  3 => string 'Thriller' (length=8)
  4 => string 'Théâtre' (length=9)

  => je sors le champagne : c'est exactement ce que je voulais :-)
*/ 
$genreList = $pdoStatement->fetchAll(PDO::FETCH_KEY_PAIR);
var_dump($genreList);



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
$pdoStatement = $pdo->query($sql);
//var_dump($pdoStatement);
$bookList = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
//var_dump($bookList);

// Inclusion du fichier s'occupant d'afficher le code HTML
require __DIR__.'/view/book.php';

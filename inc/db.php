<?php

// TODO #1 créer un objet PDO permettant de se connecter à la base de données "book"
// et le stocker dans la variable $pdo
class DB {

    private $pdo; 

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=book;charset=utf8';
        $user = 'book';
        $password = 'book';

        try {
            $pdoConnexion = new PDO(
                $dsn,
                $user,
                $password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING

                )
                );
        } catch (PDOException $exception) {
            echo 'Connexion échouée : '. $exception->getMessage();
        }
        $this->pdo = $pdoConnexion;
    }
    
    public function getPdo(){
        return $this->pdo;
    }
}


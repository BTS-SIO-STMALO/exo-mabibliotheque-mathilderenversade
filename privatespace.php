<?php session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />


    <title>Espace privé</title>
  </head>
  <body style="background: white">
      <div id="content"> 
        <!-- je veux tester si mon utilisateur est bien connecté et que donc la super global $_SESSION existe et que  la clé name existe aussi et est bien renseignée -->
        <?php var_dump($_SESSION);?>
        <?php if (empty($_SESSION)) : ?>
        <h1>Vous n'êtes pas autorisé à voir cette page</h1>        
        <?php else :?>
        <div class="content-message">
            <h1>Bonjour <?=$_SESSION['name'];?></h1>
            <p> bienvenue, vous êtes connecté </p>
        </div>
        <img src="docs/chiot-licorne.jpg">
        <a href="deconnexionController.php" class="btn btn-dark offset-md-4 mt-3"> Se déconnecter </a>
        <?php endif;?>
      </div>
  </body>
</html>
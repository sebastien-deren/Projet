<?php 
    include('includes/variables.php');
    include('includes/function.php');
    // retenir l'email de la personne connectée pendant 1 an
    //problème de rechargement de la page (faut recharger deux fois)
    creer_cookie($_POST,$users);

    if (isset($_COOKIE['LOGGED_USER'])){
        $user=$users[$_COOKIE['LOGGED_USER']];
        
    }
    ?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style/style.css"/>
        <title>Marché de pro </title>
    </head>
    <body id="page">

        <div id="corps_texte">
            <div id="left">
                <?php include('includes/header.php'); ?>
                <?php include('includes/nav.php');?>
            </div>
            <div id="right"> 
            <?php
                $inscription = (isset($_POST['inscription']));
                include(choix_vue($inscription));
            ?>
            </div>
        </div>
    </body>

</html>
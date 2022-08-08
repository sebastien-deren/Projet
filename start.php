<?php 
    include('includes/variables.php');
    include('includes/function.php');
    // retenir l'email de la personne connectée pendant 1 an
    $status_log=0;
    if (isset($_POST['connection']) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])){
        $status_log = connection($_POST['pseudo'], $_POST['mdp'], $users);
        if ($status_log!= null){
            setcookie(
                'LOGGED_USER',
                $status_log,
                [
                    'expires' => time() + 365*24*3600,
                    'secure' => true,
                    'httponly' => true,
                ]
            );
        }

    }

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
            <?php  echo($user['nom']);?>   
            <?php
                include(choix_vue($_POST, $users));
            ?>
            </div>
        </div>
    </body>

</html>
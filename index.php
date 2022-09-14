<?php
    session_start();
    include('includes/variables.php');
    include('includes/call_db.php');
    include('includes/function.php');
    include('includes/formulaire.php');
    include('includes/vue.php');
    ?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style/style.css"/>
        <title>Marché de pro </title>
    </head>
    <body id="page">
        <div id="up">
            <?php include('includes/header.php'); ?>
            <?php include('includes/nav.php');?>
        </div>
        <div id="down"> 
        <?php 
        include("vue/".$_SESSION['view'].".php");?>
        </div>
    </body>

</html>
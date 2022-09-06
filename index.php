<?php
    session_start();
    include('includes/variables.php');
    include('includes/function.php');
    include('vue/vue.php');
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
            include("vue/vue_".$_SESSION['view'].".php");?>
            </div>
        </div>
    </body>

</html>
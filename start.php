<?php
    isset($deco)? :session_start();
    include('includes/variables.php');
    include('includes/function.php');
    if(isset($_POST['checkout'])){  
        if(isset($_SESSION['panier'])){
            $panier=delete_panier();
            $_SESSION['panier']==null;
        }
    }
    if(isset($_POST['connection'])){
        creer_session();
    }
    if(isset($_POST['inscrit'])){
        $verif_form=inscription();
        foreach($verif_form as $verif_champ){
            if($verif_champ ==false){
                $_POST['inscription']="reinscription"; 
            }
        }
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
            <?php include('vue/vue.php');?>
            </div>
        </div>
    </body>

</html>
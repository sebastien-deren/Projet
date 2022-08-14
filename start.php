<?php
    session_start();
    //include('config/mysql.php');
    include('includes/variables.php');
    include('includes/function.php');
    // retenir l'email de la personne connectée pendant 1 an
    //problème de rechargement de la page (faut recharger deux fois)
    if(isset($_POST['connection'])){
        $cook=creer_cookie();
        $co='ouit';
    }
    if(isset($_POST['inscrit'])){
        $verif_form=inscription($_POST);
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
                <?php echo"<p>".$co."</p>";?>
                <?php echo "<p>".$_SESSION['FULL_NAME']."</p>";
                echo "<p>".$_COOKIE['LOGGED_USER'].$cook."</p>";?>

            <?php include('vue/vue.php');?>
            </div>
        </div>
    </body>

</html>
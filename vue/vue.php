<?php
if(isset($_POST['panier'])){
    $_SESSION['view']="panier";
}
elseif(isset($_POST['inscription'])){
    $_SESSION['view']="inscription";
}
elseif(isset($_POST['connection']) || isset(($_SESSION['ID']))){
    $_SESSION['view']='marche';
}
else {
    $_SESSION['view']='connection';}
echo($_SESSION['view']);

include("vue_".$_SESSION['view'].".php");


/*
if(isset($_POST['panier']))
    include('vue_panier.php');
elseif(isset($_SESSION['FULL_NAME']))
    include('vue_marche.php');
elseif(isset($_POST['inscription']))
    include('vue_inscription.php');
else include('vue_connection.php');*/
?>
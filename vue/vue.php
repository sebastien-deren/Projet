<?php

if(!isset($_SESSION['view'])){
    $_SESSION['view']="connection";
}
if (isset($_SESSION['ID']) && null !==$_SESSION['ID']){
    if(isset($_POST['panier'])){
        $_SESSION['view']="panier";
    }
    elseif(isset($_POST['connection']) || isset($_POST['checkout']))
    {
        $_SESSION['view']="marche";
    }

}
else{
    if(!isset($_POST['inscription'])){
        $_SESSION['view']="connection";
    }
    else{
        $_SESSION['view']="inscription";
    }

}
include("vue_".$_SESSION['view'].".php");
?>
<?php

/*ce fichier gère l'affichage des différentes vues*/



//selectionner la vue
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
//si on passe par le menu on verifie que le get view existe puis on modifie la vue
if(isset($_GET['view'])){
    $view=array('panier','marche','connection','inscription');
    $_SESSION['view'] = in_array($_GET['view'],$view,true)? $_GET['view'] : $_SESSION['view']; 
} 
//!!fin de la selection de la vue

?>
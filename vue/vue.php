<?php
if(isset($_GET['deco']))
{
    $_SESSION['FULL_NAME']=null;
    $_SESSION['ID']=null;
    $_SESSION['PANIER']=null;
}
//vide le panier lorsque qu'on checkout son panier
if(isset($_POST['checkout'])){  
    if(isset($_SESSION['PANIER'])){
        $panier=delete_panier();
        $_SESSION['PANIER']==null;
    }
}
//creer une session quand le formulaire de connection est rempli
if(isset($_POST['connection'])){
    creer_session();
}
// gère l'inscription d'une personne
if(isset($_POST['inscrit'])){
    $verif_form=inscription();
    foreach($verif_form as $verif_champ){
        if($verif_champ ==false){
            $_POST['inscription']="reinscription"; 
        }
    }
}


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
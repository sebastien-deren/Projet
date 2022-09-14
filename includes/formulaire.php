<?php

/* ce fichier gère les différents formulaires envoyé par l'utilisateur */

//nous deconecte avant de choisir la vue(si on a choisi de se déconnecter ofc)
if(isset($_GET['deco']))
{
    $_SESSION['FULL_NAME']=null;
    $_SESSION['ID']=null;
}
//vide le cart lorsque qu'on checkout son cart
if(isset($_POST['checkout'])){  
        $num_command=command_cart();
        delete_cart_db();
}
//creer une session quand le formulaire de connection est rempli
if(isset($_POST['connection'])){
    $verif_connection=creer_session();
}
// gère l'inscription d'une personne
if(isset($_POST['inscrit'])){
    $verif_form=inscription();
    foreach($verif_form as $verif_champ){
        if($verif_champ ==false){
            $_POST['inscription']="reinscription"; 
        }
    }
    $verif_inscription=  isset($_POST['inscription'])?false:true;
}
//gère l'ajout d'item au cart
//modifier afin de supprimer la case a cocher (BAD UI)
$MAX_ID=get_max_id_products();
for($i=0;$i<=$MAX_ID;$i++){
    if(isset($_POST["product".$i])){
        add_cart($i,$_POST["quantity".$i]);
    }
}
//gère la supression d'item du cart
if(isset($_POST['supprimer'])){
    delete_item_in_cart_db($_POST['id_product']);

}

?>
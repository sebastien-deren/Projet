<?php
//gere l'affichage de la page de contenu
//probablement à deplacer dans un fichier vue avec les autres vue_ pour une meilleure lisibilité

//creer la session stockant l'id de l'utilisateur.
function creer_session():bool{
    if (!empty($_POST['email']) && !empty($_POST['mdp'])){
        $formulaire=['email'=> $_POST['email'],'mdp'=> $_POST['mdp']];
        $status_log = connection_db($formulaire);
        if ($status_log!= 0){
            $_SESSION['FULL_NAME']=$status_log['full_name'];
            $_SESSION['ID']=$status_log['id_user'];
            return 1;
        }
    }
    return 0;
}
//verifie que le formulaire à été correctement rempli à retravailler ?
function inscription():array{
    $formulaire=$_POST;
    $array_inscription=[];
    if((isset($formulaire['nom'],$formulaire['prenom']))){
        $full_name="".strip_tags($formulaire['nom'])." ".strip_tags($formulaire['prenom'])."";
        if(isset($formulaire['mdp'],$formulaire['mdp_confirm']) &&
        ($formulaire['mdp']===$formulaire['mdp_confirm'])){
            $mdp= password_hash($formulaire['mdp'],PASSWORD_DEFAULT);

            if(isset($formulaire['email'])&& filter_var($formulaire['email'],FILTER_VALIDATE_EMAIL)&&
             !doublon_email_db($formulaire['email'])){
                $email= $formulaire['email'];
            }
            else{
                $email=false;
            }    
        }
        else{
            $mdp =false;
        }
    }
    else{
        $full_name=false;
    }
    $array_inscription =['full_name'=>$full_name,'password'=>$mdp,'email'=>$email];
    foreach($array_inscription as $champ){
        if($champ==false){
            return $array_inscription;
        }
    }
    return inscription_db($array_inscription);
}


/*retourne les produits de la base de donnée product, soit toute la table ,
     soit si une catégorie a été spécifié les produits de cette catégorie*/
function product_db($category):array
{
    include('config/mysql.php');
    if($category=="false"){
    $sql_querry='SELECT * from products';
    $product_statement=$db ->prepare($sql_querry);
    $product_statement->execute();
    }
    else{
    $sql_querry='SELECT id_product,name, quantity, unit_quantity, price
                FROM products WHERE category = :category';
    $product_statement =$db ->prepare($sql_querry);
    $product_statement->execute(
        [
            'category'=>$category,
        ]
        );
    }
    return $product_statement->fetchAll(PDO::FETCH_ASSOC);
}
//ajoute un produit a la table panier 
function add_cart($id,$quantity):bool{
    $in_cart=check_in_panier_db($id);
    if(empty($in_cart)){
        add_in_panier_db($id,$quantity);
        return 1;
    }
    else{
        update_in_panier_db($id,$quantity);
        return true;
    }
    return false;
}
//suprimer le panier de l'utilisateur et met a jour la table produits
// !!! ajouter dans la vue marche un if pour si le produit est en rupture de stock quty==0
//retravailler cette fonction en recursive ? permet de l'integrer pour le cas d'une suprresion d'un item dans le panier?
function command_panier(){
    $panier =get_panier_db();
    if(is_null($panier)){
        return null;
    }
    //get_num_commandd_db return max(n_command) if it's null we start at 0 else we increment it 
    $n_command = get_num_command_db();
    $n_command = is_null($n_command)? 0 : ++$n_command;
    foreach($panier as $product){
        //ajoute un à un le produit à la commande.
        $check_update_products = update_product_db($product);
        $check_command = command_product_db($product,$n_command);
    }
    return $n_command;
}

//gere l'affichage du prix en euro
function affiche_prix(int $prix) :string{
    return $prix%100==0? intdiv($prix,100)."€": intdiv($prix,100)."€".$prix%100; 
}
//gere l'affichage du poids en Kg
function affiche_poids(int $mass) :string{
    return $mass%1000==0? intdiv($mass,1000).",": intdiv($mass,1000).",".$mass%1000; 
}
//gere les decimale d'un produit en kg (solution non implémentée)
function prix_produit(array $product) :float{
    return $product['unit_quantity']=='kg'? 
                    ($product['quantity_cart']*$product['price'])/100000 : ($product['quantity_cart']*$product['price'])/100;
}
?>
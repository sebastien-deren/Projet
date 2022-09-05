<?php
//gere l'affichage de la page de contenu
//probablement à deplacer dans un fichier vue avec les autres vue_ pour une meilleure lisibilité

/* fonction traitant de la connection des utilisateurs*/
function connection(array $form){
    include('config/mysql.php');
    $sql_querry="SELECT * FROM users WHERE email = :email";
    $id_statement = $db->prepare($sql_querry);
    $id_statement->execute([
        'email'=>$form['email'],
    ]);
    $id_checks= $id_statement->fetch(PDO::FETCH_BOTH);
    if(password_verify($form['mdp'],$id_checks['passwrd'])){
        return $id_checks;
    }
    return;
}

//creer la session stockant l'id de l'utilisateur.
function creer_session(){
    if (!empty($_POST['email']) && !empty($_POST['mdp'])){
        $formulaire=['email'=> $_POST['email'],'mdp'=> $_POST['mdp']];
        $status_log = connection($formulaire);
        if ($status_log!= null){
            $_SESSION['FULL_NAME']=$status_log['full_name'];
            $_SESSION['ID']=$status_log['id_user'];
            $test="et le status_log était pas nul";
        }
    }
}
//verifie la presence d'email en double dans notre base de donnée
function doublon_email_db(string $email):bool{
    include('config/mysql.php');
    $sql_querry='SELECT email FROM users WHERE email= :email';
    $check_email= $db->prepare($sql_querry);
    $check_email->execute(
        [
            'email' => $email,
        ]
        );
    $emails_db =$check_email->fetchAll();
    foreach($emails_db as $email_db){
        if($email_db['email']==$email){
            return true;
        }
    }
    return false;
    


}
//inscrit la personne dans la table users
function inscription_db(array $verif_form){
    include('config/mysql.php');
    $sql_querry='INSERT INTO users(full_name, email, passwrd ) VALUES(:full_name, :email, :passwrd)';
    $insert_user = $db->prepare($sql_querry);
    $insert_user->execute([
        'full_name' =>$verif_form['full_name'],
        'email'=>$verif_form['email'],
        'passwrd'=>$verif_form['password'],
        ]);
        return $verif_form;
}

//verifie que le formulaire à été correctement rempli à retravailler ?
function inscription():array{
    $formulaire=$_POST;
    $array_inscription=[];
    if((isset($formulaire['nom']) && isset($formulaire['prenom']))){
        $full_name="".strip_tags($formulaire['nom'])." ".strip_tags($formulaire['prenom'])."";
        if(isset($formulaire['mdp']) && isset($formulaire['mdp_confirm']) &&
        ($formulaire['mdp']==$formulaire['mdp_confirm'])){
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

//recupere les differentes catégorie de produits
function category_product_db():array
{
    include('config/mysql.php');
    $sql_querry='SELECT category FROM products';
    $cat_statement = $db->prepare($sql_querry);
    $cat_statement->execute();
    $cat_products =$cat_statement->fetchAll();
    $table_cat=[];
    foreach($cat_products as $category){
        if(!in_array($category['category'], $table_cat)){
            $table_cat[]=$category['category'];
        }
        
    }
    foreach($table_cat as $cat){
        echo $cat;
    }
    
    return $table_cat;
}
//retourne l'id la plus haute de la table product
function get_max_id_product():int{
    include('config/mysql.php');
    $sql_querry='SELECT MAX(id_product) FROM products';
    $max_statement=$db->prepare($sql_querry);
    $max_statement->execute();
    $max_id=$max_statement->fetch();
    return $max_id[0];
    
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
    include('config/mysql.php');
    $sql_querry=('SELECT id_panier FROM panier WHERE id_product= :id_product AND id_user=:id_user');
    $id_check=$db->prepare($sql_querry);
    $id_check->execute(
        [
            'id_product'=>$id,
            'id_user' =>$_SESSION['ID'],
        ]
        );
    $in_cart=$id_check->fetchALL();
    if(empty($in_cart)){
        $sql_querry='INSERT INTO panier(id_product, id_user,quantity_cart) VALUES(:id_product,:id_user,:quantity_cart)';
        $panier_insert =$db->prepare($sql_querry);
        $panier_insert->execute(
            [
                'id_product' => $id,
                'id_user' => $_SESSION['ID'],
                'quantity_cart'=>$quantity,
    
    
            ]
        );
        return true;
    }
    else{
        $sql_querry='UPDATE panier SET quantity_cart = :quantity_cart WHERE id_product=:id_product AND id_user=:id_user';
        $panier_insert =$db->prepare($sql_querry);
        $panier_insert->execute(
            [
                'id_product' => $id,
                'id_user' => $_SESSION['ID'],
                'quantity_cart'=>$quantity,
    
    
            ]
        );
        return true;
    }
    return false;
}

//recupere tout les produits dans le panier pour l'utilisateur connecter
function get_panier():array{
    include('config/mysql.php');
    $sql_querry='SELECT p.*, c.quantity_cart FROM panier c INNER JOIN products p ON c.id_product=p.id_product 
                WHERE c.id_user=:id_user 
                ORDER BY p.category';
    $panier_print=$db->prepare($sql_querry);
    $panier_print->execute(
        [
            'id_user'=> $_SESSION['ID'],
        ]
        );
        return $panier_print->fetchAll(PDO::FETCH_ASSOC);

}

//suprimer le panier de l'utilisateur et met a jour la table produits
// !!! ajouter dans la vue marche un if pour si le produit est en rupture de stock quty==0
function delete_panier(){
    include('config/mysql.php');
    $panier =get_panier();
    foreach($panier as $produit){
        $sql_querry='UPDATE products SET quantity= :quantity WHERE id_product=:id_product';
        $product_update=$db->prepare($sql_querry);
        $product_update->execute(
            [
            'quantity'=>($produit['quantity'] - $produit['quantity_cart']),
            'id_product'=> $produit['id_product'],
            ]
        );
    }
    $sql_querry='DELETE FROM panier WHERE id_user=:id_user';
    $cart_delete=$db->prepare($sql_querry);
    $cart_delete->execute(
        [
            'id_user'=>$_SESSION['ID'],
        ]
    );
    $_SESSION['PANIER']=null;
    return $panier;
}
<?php
/* APPEL A LA TABLE USERS
/
/
/
*/
function connection_db(array $form){
    include('config/mysql.php');
    $sql_querry="SELECT * FROM users WHERE email = :email";
    $id_statement = $db->prepare($sql_querry);
    $id_statement->execute([
        'email'=>$form['email'],
    ]);
    $id_checks= $id_statement->fetch(PDO::FETCH_BOTH);
    if($id_checks && (password_verify($form['mdp'],$id_checks['passwrd']))){
            return $id_checks;
    }
    return 0;
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


/* APPEL A LA TABLE PRODUIT
/
/
/
*/

//
function category_product_db():array
{
    include('config/mysql.php');
    $sql_querry='SELECT category FROM products ORDER BY category';
    $cat_statement = $db->prepare($sql_querry);
    $cat_statement->execute();
    $cat_products =$cat_statement->fetchAll();
    $table_cat=[];
    foreach($cat_products as $category){
        if(!in_array($category['category'], $table_cat)){
            $table_cat[]=$category['category'];
        }
        
    }
    return $table_cat;
}
//retourne l'id la plus haute d'une table
function get_max_id_products():int{
    include('config/mysql.php');
    $sql_querry='SELECT MAX(id_product) FROM products';
    $max_statement=$db->prepare($sql_querry);
    $max_statement->execute();
    $max_id=$max_statement->fetch();
    return $max_id[0];
    
}
function update_product_db($product){
    include('config/mysql.php');
    $quantity_cart= $product['unit_quantity']=='kg' ? $product['quantity_cart']*1000 : $product['quantity_cart'];
    $final_quantity= $product['quantity'] - $quantity_cart;
    $sql_querry='UPDATE products SET quantity= :quantity WHERE id_product=:id_product';
    $product_update=$db->prepare($sql_querry);
    $product_update->execute(
        [
        'quantity'=>$final_quantity,
        'id_product'=> $product['id_product'],
        ]
    );
}


/*
 * 
 * 
 *      APPEL A LA TABLE PANIER
 * 
 *   */ 

//recupere tout les produits dans le panier pour l'utilisateur connecter
function get_panier_db():array{
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
function check_in_panier_db($id){
    include('config/mysql.php');
    $sql_querry=('SELECT id_panier, quantity_cart FROM panier WHERE id_product= :id_product AND id_user=:id_user');
    $id_check=$db->prepare($sql_querry);
    $id_check->execute(
        [
            'id_product'=>$id,
            'id_user' =>$_SESSION['ID'],
        ]
        );
        return $id_check->fetchALL();

}
function add_in_panier_db(int $id,int $quantity){
    include('config/mysql.php');
    $sql_querry='INSERT INTO panier(id_product, id_user,quantity_cart) VALUES(:id_product,:id_user,:quantity_cart)';
    $panier_insert =$db->prepare($sql_querry);
    $panier_insert->execute(
        [
            'id_product' => $id,
            'id_user' => $_SESSION['ID'],
            'quantity_cart'=>$quantity,


        ]
    );
}
function update_in_panier_db(int $id, int $quantity){
    include('config/mysql.php');
    $sql_querry='UPDATE panier SET quantity_cart = :quantity_cart WHERE id_product=:id_product AND id_user=:id_user';
    $panier_insert =$db->prepare($sql_querry);
    $panier_insert->execute(
        [
            'id_product' => $id,
            'id_user' => $_SESSION['ID'],
            'quantity_cart'=>$quantity,


        ]
    );

}
//supprime un produit particulier du produit d'un utilisateur
function delete_item_in_panier_db($id){
    include("config/mysql.php");
    $sql_querry='DELETE FROM panier WHERE id_user=:id_user AND id_product=:id_product';
    $prod_delete = $db->prepare($sql_querry);
    $prod_delete->execute(
        [
            'id_user'=>$_SESSION['ID'],
            'id_product'=>$id,
        ]
        );
    return;
}
//supprime le panier de l'utilisateur une fois que tout est commandé
function delete_panier_db(){
    include('config/mysql.php');
    $sql_querry='DELETE FROM panier WHERE id_user=:id_user';
    $cart_delete=$db->prepare($sql_querry);
    $cart_delete->execute(
        [
            'id_user'=>$_SESSION['ID'],
        ]
    );
    return ;
}





/**
 * 
 * 
 *      APPEL A LA TABLE COMMANDS
 * 
 * 
*/
function get_num_command_db(){
    include('config/mysql.php');
    $sql_querry='SELECT MAX(n_command) FROM commands';
    $max_statement=$db->prepare($sql_querry);
    $max_statement->execute();
    $max_command=$max_statement->fetch();
    return is_null($max_command[0])?null:$max_command[0];
    /*retourne le plus haut numero de commande de l'utilisateur +1*/
}

function command_product_db(array $product,int $n_command){
    include('config/mysql.php');
    $product_text= "".$product['name']." , ".$product['quantity_cart']." , ".$product['price']." ";
    $sql_querry='INSERT INTO commands(n_command,id_users,product_text) VALUES(:n_command,:id_users,:product_text)';
    $insert_command=$db->prepare($sql_querry);
    $insert_command->execute([
        'n_command' => $n_command,
        'id_users' => $_SESSION['ID'],
        'product_text' =>$product_text,
        ]

    );
}


//commande un produit
?>
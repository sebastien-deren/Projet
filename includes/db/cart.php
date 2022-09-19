<?php

/*
 * 
 * 
 *      APPEL A LA TABLE cart
 * 
 *   */

//recupere tout les produits dans le cart pour l'utilisateur connecter
function get_cart_db(): array
{
    include('config/mysql.php');
    $sql_querry = 'SELECT p.*, c.quantity_cart FROM cart c INNER JOIN products p ON c.id_product=p.id_product 
                WHERE c.id_user=:id_user 
                ORDER BY p.category';
    $cart_print = $db->prepare($sql_querry);
    $cart_print->execute(
        [
            'id_user' => intval($_SESSION['ID']),
        ]
    );
    return $cart_print->fetchAll(PDO::FETCH_ASSOC);
}
function check_in_cart_db($id)
{
    include('config/mysql.php');
    $sql_querry = ('SELECT id_cart, quantity_cart FROM cart WHERE id_product= :id_product AND id_user=:id_user');
    $id_check = $db->prepare($sql_querry);
    $id_check->execute(
        [
            'id_product' => $id,
            'id_user' => intval($_SESSION['ID']),
        ]
    );
    return $id_check->fetchALL();
}
function get_number_in_cart_db()
{
    include('config/mysql.php');
    $sql_querry = ('SELECT COUNT(*) FROM cart WHERE id_user=:id_user');
    $count = $db->prepare($sql_querry);
    $count->execute(
        [
            'id_user' => intval($_SESSION['ID']),
        ]
    );
    $nb_item = $count->fetch();
    return $nb_item[0];
}
function add_in_cart_db(int $id, int $quantity)
{
    include('config/mysql.php');
    $sql_querry = 'INSERT INTO cart(id_product, id_user,quantity_cart) VALUES(:id_product,:id_user,:quantity_cart)';
    $cart_insert = $db->prepare($sql_querry);
    $cart_insert->execute(
        [
            'id_product' => $id,
            'id_user' => intval($_SESSION['ID']),
            'quantity_cart' => $quantity,


        ]
    );
}
function update_in_cart_db(int $id, int $quantity)
{
    include('config/mysql.php');
    $sql_querry = 'UPDATE cart SET quantity_cart = :quantity_cart WHERE id_product=:id_product AND id_user=:id_user';
    $cart_insert = $db->prepare($sql_querry);
    $cart_insert->execute(
        [
            'id_product' => $id,
            'id_user' => intval($_SESSION['ID']),
            'quantity_cart' => $quantity,


        ]
    );
}
//supprime un produit particulier du produit d'un utilisateur
function delete_item_in_cart_db($id)
{
    include("config/mysql.php");
    $sql_querry = 'DELETE FROM cart WHERE id_user=:id_user AND id_product=:id_product';
    $prod_delete = $db->prepare($sql_querry);
    $prod_delete->execute(
        [
            'id_user' => intval($_SESSION['ID']),
            'id_product' => $id,
        ]
    );
    return;
}
//supprime le cart de l'utilisateur une fois que tout est commandé
function delete_cart_db()
{
    include('config/mysql.php');
    $sql_querry = 'DELETE FROM cart WHERE id_user=:id_user';
    $cart_delete = $db->prepare($sql_querry);
    $cart_delete->execute(
        [
            'id_user' => intval($_SESSION['ID']),
        ]
    );
    return;
}

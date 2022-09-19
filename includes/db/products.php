<?php

/** 
 *
 *   APPEL A LA TABLE PRODUIT
 *
 */

function category_product_db(): array
{
    include('config/mysql.php');
    $sql_querry = 'SELECT category FROM products ORDER BY category';
    $cat_statement = $db->prepare($sql_querry);
    $cat_statement->execute();
    $cat_products = $cat_statement->fetchAll();
    $table_cat = [];
    foreach ($cat_products as $category) {
        if (!in_array($category['category'], $table_cat)) {
            $table_cat[] = $category['category'];
        }
    }
    return $table_cat;
}
//retourne l'id la plus haute d'une table
function get_max_id_products()
{
    include('config/mysql.php');
    $sql_querry = 'SELECT MAX(id_product) FROM products';
    $max_statement = $db->prepare($sql_querry);
    $max_statement->execute();
    $max_id = $max_statement->fetch();
    return $max_id[0];
}
function update_product_db($product)
{
    include('config/mysql.php');
    $quantity_cart = $product['unit_quantity'] == 'kg' ? $product['quantity_cart'] * 1000 : $product['quantity_cart'];
    $final_quantity = $product['quantity'] - $quantity_cart;
    $sql_querry = 'UPDATE products SET quantity= :quantity WHERE id_product=:id_product';
    $product_update = $db->prepare($sql_querry);
    $product_update->execute(
        [
            'quantity' => $final_quantity,
            'id_product' => $product['id_product'],
        ]
    );
}
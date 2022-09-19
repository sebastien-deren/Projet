<?php

/**
 * 
 * 
 *      APPEL A LA TABLE COMMANDS
 * 
 * 
 */
function get_num_command_db()
{
    include('config/mysql.php');
    $sql_querry = 'SELECT MAX(n_command) FROM commands WHERE id_users=:id_users';
    $max_statement = $db->prepare($sql_querry);
    $max_statement->execute(
        [
            'id_users' => intval($_SESSION['ID']),
        ]
    );
    $max_command = $max_statement->fetch();
    return is_null($max_command[0]) ? null : $max_command[0];
    /*retourne le plus haut numero de commande de l'utilisateur +1*/
}

//ajoute un produit dans la commande
function command_product_db(array $product, int $n_command)
{
    include('config/mysql.php');
    $product_text = "" . $product['name'] . " , " . $product['quantity_cart'] . " , " . $product['price'] . " ";
    $sql_querry = 'INSERT INTO commands(n_command,id_users,product_text) VALUES(:n_command,:id_users,:product_text)';
    $insert_command = $db->prepare($sql_querry);
    $insert_command->execute(
        [
            'n_command' => $n_command,
            'id_users' => intval($_SESSION['ID']),
            'product_text' => $product_text,
        ]

    );
}
function get_command(int $n_command)
{
    include('config/mysql.php');
    $sql_querry = ('SELECT product_text, date FROM commands WHERE n_command=:n_command  AND id_users=:id_users');
    $get_command = $db->prepare($sql_querry);
    $get_command->execute(
        [
            'n_command' => $n_command,
            'id_users' => intval($_SESSION['ID']),
        ]
    );
    return $get_command->fetchALL();
}

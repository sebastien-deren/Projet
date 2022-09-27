<?php

/**
 * creer la session stockant l'id de l'utilisateur.
 *
 * @return boolean
 */
function creer_session(): bool
{
    if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
        $formulaire = ['email' => strip_tags($_POST['email']), 'mdp' => strip_tags($_POST['mdp'])];
        $status_log = connection_db($formulaire);
        if ($status_log != 0) {
            $_SESSION['FULL_NAME'] = $status_log['full_name'];
            $_SESSION['id'] = $status_log['id_user'];
            return 1;
        }
    }
    return 0;
}
/**
 * verifie que le formulaire à été correctement rempli
 *
 * @return array
 */
function inscription(): bool
{
    $formulaire = $_POST;
    $array_inscription = [];
    if ((isset($formulaire['nom'], $formulaire['prenom']))) {
        $full_name = "" . strip_tags($formulaire['nom']) . " " . strip_tags($formulaire['prenom']) . "";
    }
    if (
        isset($formulaire['mdp'], $formulaire['mdp_confirm']) &&
        ($formulaire['mdp'] === $formulaire['mdp_confirm'])
    ) {
        $mdp = password_hash($formulaire['mdp'], PASSWORD_DEFAULT);
    }
    if (
        isset($formulaire['email']) && filter_var($formulaire['email'], FILTER_VALIDATE_EMAIL) &&
        !doublon_email_db($formulaire['email'])
    ) {
        $email = $formulaire['email'];
    }
    if (isset($email) && isset($mdp) && isset($full_name)) {

        $array_inscription = ['full_name' => $full_name, 'password' => $mdp, 'email' => $email];
        return inscription_db($array_inscription);
    } else {
        return 0;
    }
}

/**
 * ajoute un produit a la table cart 
 *
 * @param integer $id
 * @param integer $quantity
 * @return boolean
 */
function add_cart(int $id, int $quantity): bool
{

    $in_cart = check_in_cart_db($id);
    if (0 == $quantity) {
        if (!empty($in_cart)) {
            return delete_item_in_cart_db($id);
        }
        return false;
    }
    if (empty($in_cart)) {
        return add_in_cart_db($id, $quantity);
    } else {
        return update_in_cart_db($id, $quantity);
    }
    return false;
}
/**
 * vide le panier et rempli la table de commande s'éxecute lors du paiement du panier.
 *
 * @return void
 */
function command_cart()
{
    $cart = get_cart_db();
    if (is_null($cart)) {
        return null;
    }

    //get_num_commandd_db return max(n_command) if it's null we start at 0 else we increment it 
    $n_command = get_num_command_db();
    $n_command = is_null($n_command) ? 0 : ++$n_command;
    foreach ($cart as $product) {
        //ajoute un à un le produit à la commande.
        $check_update_products = update_product_db($product);
        $check_command = command_product_db($product, $n_command);
    }
    return $n_command;
}

/**
 * gere l'affichage du prix en euro
 *
 * @param integer $prix
 * @return string
 */
function affiche_prix(int $prix): string
{
    return $prix % 100 == 0 ? intdiv($prix, 100) . "€" : intdiv($prix, 100) . "€" . $prix % 100;
}
/**
 * gere l'affichage du poids en Kg
 *
 * @param integer $mass
 * @return string
 */
function affiche_poids(int $mass): string
{
    return $mass % 1000 == 0 ? intdiv($mass, 1000) . "," : intdiv($mass, 1000) . "," . $mass % 1000;
}
/**
 * gere les decimale d'un produit en kg (solution non implémentée)
 *
 * @param array $product
 * @return float
 */
function prix_produit(array $product): float
{
    return $product['unit_quantity'] == 'kg' ?
        ($product['quantity_cart'] * $product['price']) / 100000 : ($product['quantity_cart'] * $product['price']) / 100;
}
/**
 * traduit la date anglaise en français
 *
 * @param string $date
 * @param string $format
 * @return string
 */
function dateToFrench(string $date, string $format): string
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}
/**
 * decompose le texte d'une colonne de command pour en extraire le prix et formate le texte.
 *
 * @param array $command
 * @return array
 */
function affiche_commande(array $command): array
{
    $affiche = "";
    $prix_total = 0;
    foreach ($command as $product) {
        $ar_product = explode(",", $product[0]);
        $affiche = $affiche . "<p>" . $ar_product[1] . $ar_product[0] . " à " . affiche_prix($ar_product[2]) . " </p>";
        $prix_total += ($ar_product[2] * $ar_product[1]);
    }

    return ["affiche" => $affiche, "prix" => $prix_total];
}
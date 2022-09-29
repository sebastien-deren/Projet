<?php

/*ce fichier gère l'affichage des différentes vues*/

//si on passe par le menu on verifie que le get view existe puis on modifie la vue
if (isset($_GET['view'])) {
    $view = array('cart', 'marche', 'connection', 'inscription', 'default');
    $_SESSION['view'] = in_array($_GET['view'], $view, true) ? $_GET['view'] : $_SESSION['view'];
}
//selectionner la vue
if (!isset($_SESSION['view']) || !isset($_SESSION['id'])) {
    $_SESSION['view'] = "connection";
}
if (isset($_SESSION['id']) && null !== $_SESSION['id']) {
    if (isset($_POST['cart'])) {
        $_SESSION['view'] = "cart";
    } elseif ( isset($_POST['checkout'])) {
        $_SESSION['view'] = "default";
    }
    elseif (isset($_POST['connection'])){
        $_SESSION['view']="marche";
    }
} else {
    if (!isset($_POST['inscription'])) {
        $_SESSION['view'] = "connection";
    } else {
        $_SESSION['view'] = "inscription";
    }
}
//!!fin de la selection de la vue
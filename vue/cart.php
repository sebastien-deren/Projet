<?php
$test=4;
$MAX_ID=get_max_id_products();
for($i=0;$i<=$MAX_ID;$i++){

    if(isset($_POST["quantity".$i])){
        add_cart($i,$_POST["quantity".$i]);
    }
}
if(isset($_POST['supprimer'])){
    delete_item_in_cart_db($_POST['id_product']);
}
$cart=get_cart_db();


if(empty($cart)){
    echo("<h2>votre panier est vide</h2>");
}
else{
    $prix_total=0;

    foreach($cart as $product){

        echo"<form method=\"post\" action=\"index.php\">";
        $prix_produit=$product['quantity_cart']*$product['price'];
        //valable si la quantité de kg n'est plus à multiplier par 1000 prix_produit($product)
        $prix_total = $prix_total+$prix_produit;
        echo("<h3>".$product['name']."</h3>");
        echo("<p> quantité commandé: ".$product['quantity_cart']." ".$product['unit_quantity']." prix: ".affiche_prix($product['price']).
            " / ".$product['unit_quantity']."");
        echo(" prix commandé : ".affiche_prix($prix_produit)."");   
        ?>
    <input type="hidden" value=<?=$product['id_product']?> name="id_product"/> 
    <input type="submit" value="supprimer" name="supprimer"/>
    <?php
        
        echo"</form></p>";
    }
    ?>
    <h2> prix total: <?=affiche_prix($prix_total)?></h2>

    <form method="post" action='index.php'>
    <p><input type="submit" value="checkout" name="checkout"/> </p>
    </form>
    <?php
}
?>
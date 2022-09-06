<?php
$MAX_ID=get_max_id_product();
for($i=0;$i<=$MAX_ID;$i++){
    if(isset($_POST[$i])){
        $id=$_POST[$i];
        $quantity="quantity".$i;
        add_cart($i,$_POST[$quantity]);
    }
}
if(isset($_POST['supprimer'])){
    delete_item($_POST['id_product']);

}
$_SESSION['PANIER']=get_panier();
?>

<?php
if(null==$_SESSION['PANIER']){
    echo("<h2>votre panier est vide</h2>");
}
else{
    $prix_total=0;
    foreach($_SESSION['PANIER'] as $product){
        echo"<form method=\"post\" action=\"index.php\">";
        $prix_produit=$product['quantity_cart']*$product['price'];
        //valable si la quantité de kg n'est plus à multiplier par 1000 prix_produit($product)
        $prix_total = $prix_total+$prix_produit;
        echo("<h3>".$product['name']."</h3>");
        echo("<p> quantité commandé: ".$product['quantity_cart']." ".$product['unit_quantity']." prix: ".affiche_prix($product['price']).
            " / ".$product['unit_quantity']."");
        echo(" prix commandé : ".affiche_prix($prix_produit)."");   
        ?>
    <input type="hidden" value=<?php echo($product['id_product']);?> name="id_product"/> 
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
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
foreach($_SESSION['PANIER'] as $product){
    echo"<form method=\"post\" action=\"start.php\">";
    $price=intdiv($product['price'],100);
    $pricecent=$product['price']%100;
    echo("<h3>".$product['name']."</h3>");
    echo("<p> quantité commandé: ".$product['quantity_cart']." prix: ".affiche_prix($product['price']).
        " unité de prix: ".$product['unit_quantity']."</p>");
    ?>
<input type="hidden" value=<?php echo($product['id_product']);?> name="id_product"/> 
<input type="submit" value="supprimer" name="supprimer"/>
<?php    echo"</form>";
}
?>


<form method="post" action='start.php'>
<p><input type="submit" value="checkout" name="checkout"/> </p>
</form>
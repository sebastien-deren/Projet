<?php
$MAX_ID=get_max_id_product();
for($i=0;$i<=$MAX_ID;$i++){
    if(isset($_POST[$i])){
        $id=$_POST[$i];
        $quantity="quantity".$i;
        echo"<p>".$_POST[$quantity]."</p>";
        add_cart($i,$_POST[$quantity]);
    }
}
$_SESSION['panier']=get_panier();
foreach($_SESSION['panier'] as $product){
    echo"<p>";
    foreach($product as $champ){
        echo(" ".$champ." ");
    }
}
?>
<form action='checkout.php'>
<p><input type="submit" value="checkout" name="checkout"/> </p>
</form>
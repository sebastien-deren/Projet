<?php
echo($_SESSION['ID']);
$MAX_ID=get_max_id_product();
for($i=0;$i<=$MAX_ID;$i++){
    if(isset($_POST[$i])){
        $id=$_POST[$i];
        $quantity="quantity".$i;
        echo"<p>".$_POST[$quantity]."</p>";
        add_cart($i,$_POST[$quantity]);
    }
}
$_SESSION['PANIER']=get_panier();
?>
<form method="post" action="start.php">
<?php
foreach($_SESSION['PANIER'] as $product){
    echo"<p>";
    foreach($product as $champ){
        echo(" ".$champ." ");

    }
    echo("<input type=\"submit\" value=\"supprimer\" name=\"supprimer\"/>");
    echo"</p>";
}
?>
</form>
<form method="post" action='start.php'>
<p><input type="submit" value="checkout" name="checkout"/> </p>
</form>
<?php echo('<p> bonjour '. $_SESSION['FULL_NAME'] . ' et bienvenu sur le site</p>');?>

<?php   
    $cat_products=category_product_db();
    echo"<form method='POST' action='index.php'>";
    foreach($cat_products as $category){
        echo("<article id=\"".$category."\">");
        echo ('<h2>'.$category.'</h2>');
        $products=product_db($category);

        foreach($products as $product){
            $quantity = $product['unit_quantity']=="kg"? 
            affiche_poids($product['quantity']): $product['quantity'];
            $quantity_max = $product['unit_quantity']=="kg"?
            round(intdiv($product['quantity'],1000)):$product['quantity'];
            $checkbox="<input type=\"checkbox\" name=\"".$product['id_product']."\"/>";
            $number="<input type=\"number\" name=\"quantity".$product['id_product']."\"
            min=\"0\" max=\"".$quantity_max."\"
            step=\"1\"
            value=\"0\"/>";

            ?>
            <!-- !!!DEMAIN changer les <p> par des <div class produits>
                 les <span> par des des <div class champ> afin de construire le tableau en css
                 à voir possibilité de td /tr   -->
            <p><b><?=$product['name']?> </b> <span> <?=$quantity?> <?=$product['unit_quantity']?></span> 
            <span> <?=affiche_prix($product['price'])?>/<?=$product['unit_quantity']?></span>
            <span> <?=$number?> <?=$product['unit_quantity']?> </span>
            <span>commandez: <?= $checkbox?> </span></p>
            <?php
        }
        echo "<input type=\"submit\" value=\"panier\" name=\"panier\"/>";
        echo("</article>");

    }
    echo"</form>";

?>
</div>
<?php
echo "<div>";


echo "</div>";
?>
<div class="marche">
<div class=lien><a href="index.php?view=cart"> acceder au panier</a></div>
<?php   
    $cat_products=category_product_db();

    echo"<form method='POST' action='index.php'>";
    foreach($cat_products as $category){
        echo ('<h2>'.$category.'</h2>');
        echo("<article id=\"".$category."\">");
        $products=product_db($category);

        foreach($products as $product){
            $in_cart =check_in_cart_db($product['id_product']);
            $value= empty($in_cart) ? 0 : $in_cart[0]['quantity_cart'];
            $quantity = $product['unit_quantity']=="kg"? 
            affiche_poids($product['quantity']): $product['quantity'];
            $quantity_max = $product['unit_quantity']=="kg"?
            round(intdiv($product['quantity'],1000)):$product['quantity'];
            $class = $quantity_max<=0?"rupture":"achat";
            $submit="<input class=\"submit\" type=\"submit\" name=\"product".$product['id_product']."\" value=\"ajouter au panier\"/>";
            $number="<input class=\"number\" type=\"number\" name=\"quantity".$product['id_product']."\"
            min=\"0\" max=\"".$quantity_max."\"
            step=\"1\"
            value=\"".$value."\"/>";

            ?>
            <!-- !!!DEMAIN changer les <p> par des <div class produits>
                les <div> par des des <div class champ> afin de construire le tableau en css
                à voir possibilité de td /tr   -->
            <div class="<?=$class?>">
                <div><?=$product['name']?> </div> <div> <?=$quantity?> <?=$product['unit_quantity']?></div>
                <div><img src="images/placeholder.jpg" alt="enveloppe" class="imgproduct"/></div> 
                <div> <?=affiche_prix($product['price'])?>/<?=$product['unit_quantity']?></div>
                <div> <?=$number?> <?=$product['unit_quantity']?> </div>
                <div><?=$submit?> </div>
            </div>
            <?php
        }
        
        echo("</article>");
        echo "<input type=\"submit\" value=\"ajouter tout au panier.\" name=\"cart\"/>";
    }
    echo"</form>";

?>
</div>
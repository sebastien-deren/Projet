<
<?php   
    $cat_products=category_product_db();
    echo"<form method='POST' action='index.php'>";
    foreach($cat_products as $category){
        echo("<article id=\"".$category."\">");
        echo ('<h2>'.$category.'</h2>');
        $products=product_db($category);

        foreach($products as $product){
            $in_cart =check_in_cart_db($product['id_product']);
            print_r($in_cart);
            $value= empty($in_cart) ? 0 : $in_cart[0]['quantity_cart'];
            $quantity = $product['unit_quantity']=="kg"? 
            affiche_poids($product['quantity']): $product['quantity'];
            $quantity_max = $product['unit_quantity']=="kg"?
            round(intdiv($product['quantity'],1000)):$product['quantity'];
            $class = $quantity_max<=0?"rupture":"achat";
            $checkbox="<input type=\"checkbox\" name=\"".$product['id_product']."\"/>";
            $number="<input type=\"number\" name=\"quantity".$product['id_product']."\"
            min=\"0\" max=\"".$quantity_max."\"
            step=\"1\"
            value=\"".$value."\"/>";

            ?>
            <!-- !!!DEMAIN changer les <p> par des <div class produits>
                les <span> par des des <div class champ> afin de construire le tableau en css
                à voir possibilité de td /tr   -->
            <div class="<?=$class?>">
                <p>
                    <b><?=$product['name']?> </b> <span> <?=$quantity?> <?=$product['unit_quantity']?></span> 
                    <span> <?=affiche_prix($product['price'])?>/<?=$product['unit_quantity']?></span>
                    <span> <?=$number?> <?=$product['unit_quantity']?> </span>
                    <span>commandez: <?= $checkbox?> </span>
                </p>
            </div>
            <?php
        }
        echo "<input type=\"submit\" value=\"cart\" name=\"cart\"/>";
        echo("</article>");

    }
    echo"</form>";

?>
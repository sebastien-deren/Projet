<div id="body">
    <div id="cat">
        <h2> Catégories</h2>

        <nav>
            <?php
            $categories = category_product_db();
            $i = 0;
            foreach ($categories as $category) {
            ?>
                <a href="#<?= $category ?>">
                    <div class="element">
                        <?= $category ?>
                    </div>
                </a>

            <?php
                $i++;
            }
            ?>
        </nav>
    </div>


    <div class="marche">

        <?php
        $cat_products = category_product_db();

        echo "<form method='POST' action='index.php'>";
        foreach ($cat_products as $category) {
            echo ('<h2>' . $category . '</h2>');
            echo ("<article id=\"" . $category . "\">");
            $products = product_db($category);

            foreach ($products as $product) {
                $in_cart = check_in_cart_db($product['id_product']);
                $value = empty($in_cart) ? 0 : $in_cart[0]['quantity_cart'];
                $quantity = $product['unit_quantity'] == "kg" ?
                    affiche_poids($product['quantity']) : $product['quantity'];
                $quantity_max = $product['unit_quantity'] == "kg" ?
                    round(intdiv($product['quantity'], 1000)) : $product['quantity'];
                $class = $quantity_max <= 0 ? "rupture" : "achat";
                $value_submit = $value == 0 ? "ajouter au panier" : "modifier la quantité";
                $submit = "<input class=\"submit\" type=\"submit\" name=\"product" . $product['id_product'] . "\" value=\"" . $value_submit . "\"/>";
                $number = "<input class=\"number\" type=\"number\" name=\"quantity" . $product['id_product'] . "\"
            min=\"0\" max=\"" . $quantity_max . "\"
            step=\"1\"
            value=\"" . $value . "\"/>";

        ?>
                <!-- !!!DEMAIN changer les <p> par des <div class produits>
                les <div> par des des <div class champ> afin de construire le tableau en css
                à voir possibilité de td /tr   -->
                <div class="<?= $class ?>">
                    <div class="nom"><?= $product['name'] ?> </div>
                    <div class="info">
                        <?php if ($class == "rupture") {
                        ?>
                            <div>Produit en rupture de stock</div>
                        <?php
                        } else {
                        ?>

                            <div> <?= $quantity ?> <?= $product['unit_quantity'] ?></div>
                            <div> <?= affiche_prix($product['price']) ?>/<?= $product['unit_quantity'] ?></div>
                            <div> <?= $number ?> <?= $product['unit_quantity'] ?> </div>
                            <div><?= $submit ?> </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
        <?php
            }

            echo ("</article>");
            echo "<input type=\"submit\" value=\"ajouter tout au panier.\" name=\"cart\"/>";
        }
        echo "</form>";

        ?>
    </div>
</div>
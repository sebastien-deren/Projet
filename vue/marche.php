<div id="body">
    <div id="cat">
        <h2> Catégories</h2>

        <nav>
            <?php
            $categories = category_product_db();
            foreach ($categories as $category) {
            ?>
            <a href="#<?= $category ?>">
                <div class="element">
                    <?= $category ?>
                </div>
            </a>

            <?php
            }
            ?>
        </nav>
    </div>


    <div class="marche">

        <?php
        foreach ($categories as $category) {
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

        ?>
        <form method='POST' action='index.php?view=marche#<?=$product['id_product']?>'>
            <div class="<?= $class ?> " id="<?=$product['id_product']?>">
                <div class="nom"><div><?= $product['name'] ?></div> </div>
                <div class="info">
                    <?php if ($class == "rupture") {
                            ?>
                    <div>Produit en rupture de stock</div>
                    <?php
                            } else {
                            ?>

                    <div> <?= $quantity ?> <?= $product['unit_quantity'] ?></div>
                    <div class="prix">
                        <div>
                            <?= affiche_prix($product['price']) ?>/<?= $product['unit_quantity'] ?>
                        </div>
                        <div>
                            <input class='number' type='number' name='quantity' min='0' max='<?=$quantity_max?>'
                            step='1' value='<?=$value?>'/>
                            <?= $product['unit_quantity'] ?>
                        </div>
                    </div>
                    <div class="submit">
                        <input class ='button' type='submit' name='add_once' value='<?=$value_submit?>'/>
                        
                    </div><input type="hidden" value="<?=$product['id_product']?>" name="id_product"/>
                    <?php
                            }
                            ?>
                </div>
            </div>
        </form>
        <?php
            }
            echo ("</article>");
        }

        ?>
    </div>
</div>
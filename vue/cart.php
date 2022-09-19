<?php
$test = 4;
$MAX_ID = get_max_id_products();
for ($i = 0; $i <= $MAX_ID; $i++) {

    if (isset($_POST["quantity" . $i])) {
        add_cart($i, $_POST["quantity" . $i]);
    }
}
if (isset($_POST['supprimer'])) {
    delete_item_in_cart_db($_POST['id_product']);
}
$cart = get_cart_db();

?>
<section class="page_panier">
    <?php

    if (empty($cart)) {
        echo ("<div class=\"empty\">");
        echo ("<h2>votre panier est vide</h2>");
        echo ("</div>");
    } else {
        echo ("<div class=\"cart\">");
        $prix_total = 0;
        echo ("<header>");
        echo ("<p>Produit</p><p>Prix</p><p>qty</p><p>subtotatl</p><p>suprimmer</p>");
        echo ("</header>");
        echo ("<div class=\"produits\">");
        foreach ($cart as $product) {

            echo "<form method=\"post\" action=\"index.php\">";
            $prix_produit = $product['quantity_cart'] * $product['price'];
            //valable si la quantité de kg n'est plus à multiplier par 1000 prix_produit($product)
            $prix_total = $prix_total + $prix_produit;
            echo ("<p>" . $product['name'] . "</p>");
            echo ("<p>" . affiche_prix($product['price']) . " / " . $product['unit_quantity'] . "</p>");
            echo ("<p>" . $product['quantity_cart'] . "</p>");

            echo ("<p> " . affiche_prix($prix_produit) . "</p>");
    ?>
            <input type="hidden" value=<?= $product['id_product'] ?> name="id_product" />
            <div><input class="supr" type="submit" value="" name="supprimer" /></div>

        <?php
            // Ilham Fitrotul Hayat icon delete
            echo "</form>";
        }
        echo ("</div>");

        echo ("<footer><h2> Prix total:" . affiche_prix($prix_total) . "</h2></footer>");
        echo ("</div>");
        ?>
        <form method="post" action='index.php' class="paiement">
            <h4> Paiement</h4>
            <div>
                <p class="prix_total">Prix total : <?= affiche_prix($prix_total) ?></p>
            </div>
            <div class="info">
                <h4>Information de paiement</h4>
                <div>
                    <label for="cb">Numéro de carte bancaire</label></br>
                    <input type="tel" id="cb" name="cb" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}" placeholder="ne pas remplir">
                </div>
                <div>
                    <label for="date">Date d'expiration</label></br>
                    <input type="date" id="date" name="date"></br>
                </div>
                <div>
                    <label for="csv">CSV</label>
                    <input type="tel" id="csv" name="csv" pattern="[0-9]{3}" placeholder="NON">
                </div>
            </div>
            <h4 class="input_botom"><input class="button" type="submit" value="Pay" name="checkout" /> </h4>

        </form>
    <?php
    }
    ?>
</section>
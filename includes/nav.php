<nav>

    <div id="date">
        <?= dateToFrench("now", "l j F Y"); ?>
    </div>
    <section class="cat_nav">
        <?php
        $in_page = $_SESSION['view'];
        if (isset($_SESSION['ID'])) {
            $nombre_produit = get_number_in_cart_db();

        ?>
            <a href="index.php?view=marche">
                <div class="<?= $in_page == "marche" ? "in" : "not_in" ?>">
                    Marché
                </div>
            </a>
            <a href="index.php?view=default">
                <div class="<?= $in_page == "default" ? "in" : "not_in" ?>">
                    <!--<img src="images/accueil.png" alt="maison" class="icon"/>-->
                    Commandes
                </div>
            </a>
            <a href="index.php?view=cart">
                <div class="<?= $in_page == "cart" ? "in" : "not_in" ?>">
                    Panier <?= $nombre_produit == 0 ? "" : "(" . $nombre_produit . ")" ?>
                </div>
            </a>
            <a href="index.php?deco">
                <div class="deco">
                    Se déconnecter
                </div>
            </a>

        <?php
        } else {
        ?>
            <a href="index.php?view=connection">
                <div class="<?= $in_page == "connection" ? "in" : "not_in" ?>">
                    Connection
                </div>
            </a>
            <a href="index.php?view=inscription">
                <div class="<?= $in_page == "inscription" ? "in" : "not_in" ?>">
                    Inscription
                </div>
            </a>
        <?php
        }
        ?>

    </section>
</nav>
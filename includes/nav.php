<nav>

    <div id="date">
        <?=dateToFrench("now" ,"l j F Y");?>
    </div>
     <section class="cat_nav">
        <?php
        if(isset($_SESSION['ID'])){
            $in_page= $_SESSION['view'];
            $nombre_produit=get_number_in_cart_db();
            
        ?>
        <a href="index.php?view=marche"><div class="<?= $in_page=="marche"? "in":"not_in"?>">
            Marché
        </div></a>
        <?php
        
        ?>
        <a href="index.php?view=default"><div class="<?= $in_page=="default"? "in":"not_in"?>">
            <!--<img src="images/accueil.png" alt="maison" class="icon"/>-->
            Commandes
        </div></a>
        <a href="index.php?view=cart"><div class="<?= $in_page=="panier"? "in":"not_in"?>">
            Panier <?= $nombre_produit==0 ? "": "(".$nombre_produit.")"?>
        </div></a>
        <a href="index.php?deco"><div class="deco">
            Se déconnecter
        </div></a>

        <?php
        }
        else{
        ?>
        <a href="index.php?view=connection"><div class="element">
            Connection
        </div></a>
        <a href="index.php?view=inscription"><div class="element">
            Inscription
        </div></a>
        <?php
        }
        ?>

    </section>
</nav>

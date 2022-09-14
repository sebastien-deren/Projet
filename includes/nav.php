<header id="tete">
    <!-- afficher une demande de connexion si pas connecté
        si connecté affiché l'icone choisi par l'utilisateur + son nom +titre
        sur le modéle si dessous -->

    <div id="presentation">
        <?php if(isset($_SESSION['FULL_NAME'])){
            echo("<h1>".$_SESSION['FULL_NAME']."</h1>");
        }
        else{
            echo("<h1>connecter vous</h1>");
        }?>
    </div>



    <nav id="menu">
        <section class="cat_nav">
        <a href="index.php?view=default"><div class="element">
            <!--<img src="images/accueil.png" alt="maison" class="icon"/>-->
            Home
        </div></a>
        <?php
        if(isset($_SESSION['ID'])){
            $nombre_produit=get_number_in_cart_db();
        ?>
        
        <a href="index.php?view=marche"><div class="element">
            Marché
        </div></a>
        <a href="index.php?view=cart"><div class="element">
            Panier <?= $nombre_produit==0 ? "": "(".$nombre_produit.")"?>
        </div></a>
        <a href="index.php?deco"><div class="element">
            se déconnecter
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
</header>
                <?php
                    
                    /*si nous sommes dans la vue marché on va afficher dans la navigation 
                    les differentes catégories de produits*/
                        if($_SESSION['view']=='marche'){
                            ?>
                            <section class="cat_nav">
                            <?php
                            $categories=category_product_db();
                            $i=0;
                            foreach($categories as $category){
                            ?>
                            <a href="#<?=$category?>">
                            <div class="element">
                                <?=$category?>
                            </div></a>
                            <?php
                                $i++;
                            }
                            echo("</section>");
                        }
                        ?>

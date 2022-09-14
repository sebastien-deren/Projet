<nav id="menu">
                    <section class="cat_nav">
                    <a href="index.php?view=default"><div class="element 1">
                        <!--<img src="images/accueil.png" alt="maison" class="icon"/>-->
                        Home
                    </div></a>
                    <?php
                    if(isset($_SESSION['ID'])){
                    ?>
                    
                    <a href="index.php?view=marche"><div class="element 2">
                        Marché
                    </div></a>
                    <?php
                    
                    /*si nous sommes dans la vue marché on va afficher dans la navigation 
                    les differentes catégories de produits*/
                        if($_SESSION['view']=='marche'){
                            ?>
                            <section class="cat_subnav">
                            <?php
                            $categories=category_product_db();
                            $i=0;
                            foreach($categories as $category){
                            ?>
                            <a href="#<?=$category?>">
                            <div class="element <?=$i?>">
                                <?=$category?>
                            </div></a>
                            <?php
                                $i++;
                            }
                        }
                        ?>
                    <a href="index.php?view=cart"><div class="element 3">
                        Panier
                    </div></a>
                    <?php if($_SESSION['view']=='default'){
                        ?>
                            <a href="index.php?deco"><div class="element 4">
                            Deconection
                            </div></a>
                    <?php
                    }?>

                    <?php
                    }
                    else{
                    ?>
                    <a href="index.php?view=connection"><div class="element 2">
                        Connection
                    </div></a>
                    <a href="index.php?view=inscription"><div class="element 3">
                        Inscription
                    </div></a>
                    <?php
                    }
                    ?>

                </section>
                </nav>
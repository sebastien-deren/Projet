<?php
    print_r($_SESSION['ID']);
    $n_command=get_num_command_db();
    if (is_null($n_command)){
        ?>
        <h2> vous n'avez encore rien commander !</h2>
        <p>
            <a href='index.php?view=marche'>si vous souhaiter choisir des produit venez dans le marché!</a></br>
            <a href='index.php?view=cart'>sinon vous pouvez regarder votre cartes et commandez des produits </a>
        </p>
        <?php
    }
    else{
        $command =get_command($n_command);
        $n_command--;
        ?>
        <h2>dernière commande! effectué le <?=$command[0]['date']?></h2>
        <?php

            
            foreach($command as $product){
                $ar_product=explode(",",$product[0]);

                echo "<p>".$ar_product[1].$ar_product[0]." à ".affiche_prix($ar_product[2])." </p>";

            }
        ?> 
        <h2> commande précedente </h2>
        <?php
            for($i=$n_command;$i>=0;$i--){
                $command= get_command($i);
                ?>
                <h4> commande effectué le <?=$command[0]['date']?></h4>
                <?php
                    foreach($command as $product){
                        echo"<p>".$product[0]."</p>";
                    }

            }
    }
    ?>
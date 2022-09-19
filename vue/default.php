<?php
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
        <section class="command">
        
        <h2>Dernière commande!</h2>
        <article class="last_command">
        <header>
        <h4> Commande effectué le <?=$command[0]['date']?></h4>
        </header>
        <div class="list">
        <?php
            $parse_command=affiche_commande($command);
            echo($parse_command["affiche"]);
        ?> 
        </div>
        <div class="total">Total: <?=affiche_prix($parse_command["prix"])?></div>
        </article>
        
        <h2> Commande précedente </h2>
        <?php
            for($i=$n_command;$i>=0;$i--){
                $command= get_command($i);
                ?><article>
                    <header>
                        <h4> Commande effectué le <?=$command[0]['date']?></h4>
                    </header>
                    <div class="list">
                <?php
                    $parse_command =affiche_commande($command);
                    echo ($parse_command["affiche"]);
                ?></div>
            <div class="total">Total: <?=affiche_prix($parse_command["prix"])?></div>
            </article><?php
                

            }
            ?>
        </section>
            <?php
        }
    ?>
    <?php

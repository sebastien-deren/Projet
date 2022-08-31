<?php echo('<p> bonjour '. $users[$_COOKIE['LOGGED_USER']]['nom'] . ', '. $users[$_COOKIE['LOGGED_USER']]['prenom'] . ' et bienvenu sur le site</p>');?>
<div class="tableau">
    <div class="tete_tableau">
        <div class="element_tete">nom</div>
        <div class="element_tete">quantité</div>
        <div class="element_tete">unité</div>
        <div class="element_tete">prix</div>
        <div class="element_tete">quantité</div>
        <div class="element_tete">achat</div>
</div>
<?php   

foreach($products as $product){
    echo ("<div class=\"corps_tableau\">");
    foreach($product as $champ){
        echo ("<div class=\"element_tableau\">".$champ."</div>");
    }
    ?>
        <div class="element_tableau">
        <input type ="number" min="1"
        <?php echo("id=".$product.['name']." ");
                echo("max=".$product['quantity']." ");
            ?>
        />
    </div>
    <div class="element_achat">
        <input type="checkbox" name="achat" 
        <?php echo("id=".$product."achat");?>/>
    </div>

    <?php
    echo("</div>");
}
?>
</div>
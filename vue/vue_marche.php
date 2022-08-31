<?php echo('<p> bonjour '. $_SESSION['FULL_NAME'] . ' et bienvenu sur le site</p>');?>

<?php   
    $cat_products=category_product_db();
    echo"<form method='POST' action='panier.php'>";
    foreach($cat_products as $category){
        echo ('<h2>'.$category.'</h2>');
        $products=product_db($category);

        foreach($products as $product){
            foreach($product as $champ){
                if($product['id_product']==$champ){
                    $achat="<input type=\"checkbox\" name=\"achat\"
                    id=".$champ."/>
                    <input type=\"number\" name=\"quantity\"
                    id=\"quantity".$champ."\"
                    min=\"0\" max=\"".$product['quantity']."\"
                    step=\"1\"
                    />";
                }
                else{
                    echo (" ".$champ."");
                }
                
                
           }
           echo $achat;
           echo ("</p>");
        }

    }
    echo "<input type=\"submit\" value=\"panier\"/>";
    echo"</form>";
?>
</div>
<?php
echo "<div>";


echo "</div>";
?>

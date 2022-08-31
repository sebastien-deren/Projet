<?php
if(isset($_POST['panier']))
    include('vue_panier.php');
elseif(isset($_SESSION['FULL_NAME']))
    include('vue_marche.php');
elseif(isset($_POST['inscription']))
    include('vue_inscription.php');
else include('vue_connection.php');
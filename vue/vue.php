<?php
if(isset($_SESSION['FULL_NAME']))
    include('vue_marche.php');
elseif(isset($_POST['inscription']))
    include('vue_inscription.php');
else include('vue_connection.php');
<?php
try{
        $db =new PDO(
        'mysql:host=localhost;dbname=test;charset=utf8',
        'root',
        "",
        );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e){
        die('erreur: ' .$e->getMessage());
    }
?>
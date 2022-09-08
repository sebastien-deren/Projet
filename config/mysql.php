<?php
try{
        $db =new PDO(
        'mysql:host=mysql:3306;dbname=test;charset=utf8',
        'user',
        'user',
        );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e){
        die('erreur: ' .$e->getMessage());
    }
?>
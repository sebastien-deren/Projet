<?php
/* fonction traitant de la connection des utilisateurs*/
function connection(string $nom,string $mdp,array $users){
    for($i=0;$i<count($users);$i++){
            if($users[$i]['nom']==$nom && $users[$i]['mdp']==$mdp){
                return $i; 
        }
    }
    return;
}
function choix_vue(array $formulaire,array $users){
    if(isset($_COOKIE['LOGGED_USER'])){
            echo('<p> bonjour '. $users[$_COOKIE['LOGGED_USER']]['nom'] . ', '. $users[$_COOKIE['LOGGED_USER']]['prenom'] . ' et bienvenu sur le site</p>');
            return "includes/vue_marche.php";
        }
    if(isset($formulaire['inscription'])){
        return"includes/vue_inscription.php";
    }
    return "includes/vue_connection.php";
    //ajout du formulaire d'inscription
}
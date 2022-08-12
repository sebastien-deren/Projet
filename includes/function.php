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
function choix_vue(bool $insc){
    if(isset($_COOKIE['LOGGED_USER'])){
            return "includes/vue_marche.php";
        }
    else if($insc==true){
        return"includes/vue_inscription.php";
    }
    else{
    return "includes/vue_connection.php";
    }
    //ajout du formulaire d'inscription
}
function creer_cookie(array $formulaire,array $users){
    if (isset($formulaire['connection']) && !empty($formulaire['pseudo']) && !empty($formulaire['mdp'])){
        $status_log = connection($formulaire['pseudo'], $formulaire['mdp'], $users);
        if ($status_log!= null){
            setcookie(
                'LOGGED_USER',
                $status_log,
                [
                    'expires' => time() + 365*24*3600,
                    'secure' => true,
                    'httponly' => true,
                ]
            );
        }

    }
}
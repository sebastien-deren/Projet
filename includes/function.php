<?php
/* fonction traitant de la connection des utilisateurs*/
function connection(string $nom,string $mdp,array $users):string{
    echo("$nom");
    echo("$mdp");
    if($nom!="" || $mdp!=""){
        for($i=0;$i<count($users);$i++){
            if($users[$i]['nom']==$nom && $users[$i]['mdp']==$mdp){
                return "$i"; 
            }
        }
        return "erreur";
    }
    return "not_set";
}
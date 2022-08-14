<?php
//gere l'affichage de la page de contenu
//probablement à deplacer dans un fichier vue avec les autres vue_ pour une meilleure lisibilité

/* fonction traitant de la connection des utilisateurs*/
function connection(array $form){
    include('config/mysql.php');
    $sql_querry="SELECT * FROM users WHERE email = :email";
    $id_statement = $db->prepare($sql_querry);
    $id_statement->execute([
        'email'=>$form['email'],
    ]);
    $id_checks= $id_statement->fetch(PDO::FETCH_BOTH);
    if(password_verify($form['mdp'],$id_checks['passwrd'])){
        return $id_checks;
    }
    return;
}

//creer le cookie stockant l'id de l'utilisateur, en cours de modification par une session.
function creer_cookie(){
    $test="";
    if (!empty($_POST['email']) && !empty($_POST['mdp'])){
        $formulaire=['email'=> $_POST['email'],'mdp'=> $_POST['mdp']];
        $status_log = connection($formulaire);
        if ($status_log!= null){
            setcookie(
                'LOGGED_USER',
                $status_log['id_user'],
                [
                    'expires' => time() + 3000,
                    'secure' => true,
                    'httponly' => true,
                ]
            );
            $_SESSION['FULL_NAME']=$status_log['full_name'];
            $test="et le status_log était pas nul";
        }
        return "on est aller creer le cookie".$test.$formulaire['email'];

    }
}
//verifie la presence d'email en double dans notre base de donnée
function doublon_email_db(string $email):bool{
    include('config/mysql.php');
    $sql_querry='SELECT email FROM users WHERE email= :email';
    $check_email= $db->prepare($sql_querry);
    $check_email->execute(
        [
            'email' => $email,
        ]
        );
    $emails_db =$check_email->fetchAll();
    foreach($emails_db as $email_db){
        if($email_db['email']==$email){
            return true;
        }
    }
    return false;
    


}
//inscrit la personne dans la table users
function inscription_db(array $verif_form){
    include('config/mysql.php');
    $sql_querry='INSERT INTO users(full_name, email, passwrd ) VALUES(:full_name, :email, :passwrd)';
    $insert_user = $db->prepare($sql_querry);
    $insert_user->execute([
        'full_name' =>$verif_form['full_name'],
        'email'=>$verif_form['email'],
        'passwrd'=>$verif_form['password'],
        ]);
        return $verif_form;
}

//verifie que le formulaire à été correctement rempli
function inscription(array $formulaire):array{
    $array_inscription=[];
    if((isset($formulaire['nom']) && isset($formulaire['prenom'])) &&
         (!empty($_POST['nom']) && !empty($_POST['prenom']))){
        $full_name="".strip_tags($formulaire['nom'])." ".strip_tags($formulaire['prenom'])."";
        if(isset($formulaire['mdp']) && isset($formulaire['mdp_confirm']) &&
        ($formulaire['mdp']==$formulaire['mdp_confirm'])){
            $mdp= password_hash($formulaire['mdp'],PASSWORD_DEFAULT);

            if(isset($formulaire['email'])&& filter_var($formulaire['email'],FILTER_VALIDATE_EMAIL)&&
             !doublon_email_db($formulaire['email'])){
                $email= $formulaire['email'];
            }
            else{
                $email=false;
            }    
        }
        else{
            $mdp =false;
        }
    }
    else{
        $full_name=false;
    }
    $array_inscription =['full_name'=>$full_name,'password'=>$mdp,'email'=>$email];
    foreach($array_inscription as $champ){
        if($champ==false){
            return $array_inscription;
        }
    }
    return inscription_db($array_inscription);
}
<?php
    include('includes/function.php');
    /* verifier que la personne est connecté au compte
    si elle ne l'est pas afficher la page de connection.
    si elle l'est:
    creer pour chaque catégorie d'article une page de choix d'article*/?>
    <?php
    $users = [
        ['nom' => 'jean',
        'prenom' => 'valjean',
        'mail' => 'jean.valjean@text.p',
        'mdp' => '1234',],
        ['nom' => 'poulet',
        'prenom'=> 'cotcot',
        'mail'=>'poulet.cotcot@terxt.d',
        'mdp'=>'1234',
        ],
        ['nom' => 'renard',
        'prenom' => 'goupil',
        'mail' => 'goupil@renard.c',
        'mdp' => '456',
        ],

        
        ];

?>

<?php
    $connecter =false;
    $connection=false;
    if(isset($_POST['pseudo']) && isset ($_POST['mdp'])){
        $pseudo = $_POST['pseudo'];
        $mdp =$_POST['mdp']; 
    }
    if(isset($_POST['connection'])){
        $connection=true;
    }


    if($_POST['inscription']){
        $connecter =true;
        echo('<p> ici il y aura le formulaire d\'inscription</p>');
    }
    elseif($connection){
        foreach($users as $user){
            if($pseudo==$user['nom'] && $mdp==$user['mdp']){
                echo('<p> bonjour '. $user['nom'] . ', '. $user['prenom'] . ' et bienvenu sur le site');
                $connecter = true;
            }
        }
            /*
            la connection fonctionne
            il faut tout d'abord ajouter un tableau d'utilisateur a vérifier
            puis il faudra ajouter le marché,*/
    }

    if(!$connecter) formulaire($connection);
?>
    
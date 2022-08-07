<?php
    include('function.php');

    /* verifier que la personne est connecté au compte
    si elle ne l'est pas afficher la page de connection.
    si elle l'est:
    creer pour chaque catégorie d'article une page de choix d'article*/?>
    <?php
    $users = [
        ['nom' => 'jean',
        'prenom' => 'valjean',
        'mail' => 'jean.valjean@text.p',
        'mdp' => '1234',
        ],
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
    if(isset($_POST['connection'])){
        $status_log = connection($_POST['pseudo'], $_POST['mdp'], $users);
    }
    echo ("<h1>".$status_log."</h1>");
    if(isset($status_log)){
        if($status_log==="erreur"){
            echo"<p>erreur</p>";
            include('formulaire_connection.php');
        }
        else if($status_log==="not_set"){
            echo"<p>not_set</p>";
            include('formulaire_connection.php');
        }
        else{
            $n_user=intval($status_log);
            echo('<p> bonjour '. $users[$n_user]['nom'] . ', '. $users[$n_user]['prenom'] . ' et bienvenu sur le site</p>');
            /*la connection fonctionne
            il faut tout d'abord ajouter un tableau d'utilisateur a vérifier
            puis il faudra ajouter le marché,*/
         }
    }
    else{
        echo("<p> erreur status_log</p>");
        include('formulaire_connection.php');
    }

?>
    
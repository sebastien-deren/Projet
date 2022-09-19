<?php
/* APPEL A LA TABLE USERS
/
/
/
*/
function connection_db(array $form)
{
    include('config/mysql.php');
    $sql_querry = "SELECT * FROM users WHERE email = :email";
    $id_statement = $db->prepare($sql_querry);
    $id_statement->execute([
        'email' => $form['email'],
    ]);
    $id_checks = $id_statement->fetch(PDO::FETCH_BOTH);
    if ($id_checks && (password_verify($form['mdp'], $id_checks['passwrd']))) {
        return $id_checks;
    }
    return 0;
}
//verifie la presence d'email en double dans notre base de donnée
function doublon_email_db(string $email): bool
{
    include('config/mysql.php');
    $sql_querry = 'SELECT email FROM users WHERE email= :email';
    $check_email = $db->prepare($sql_querry);
    $check_email->execute(
        [
            'email' => $email,
        ]
    );
    $emails_db = $check_email->fetchAll();
    foreach ($emails_db as $email_db) {
        if ($email_db['email'] == $email) {
            return true;
        }
    }
    return false;
}

//inscrit la personne dans la table users
function inscription_db(array $verif_form)
{
    include('config/mysql.php');
    $sql_querry = 'INSERT INTO users(full_name, email, passwrd ) VALUES(:full_name, :email, :passwrd)';
    $insert_user = $db->prepare($sql_querry);
    $insert_user->execute([
        'full_name' => $verif_form['full_name'],
        'email' => $verif_form['email'],
        'passwrd' => $verif_form['password'],
    ]);
    return $verif_form;
}
<div class="form_connection">
    <form method="post" action="index.php">
        <?php
        $message_inscription = (isset($_POST['inscrit'])) ? "<p> vous êtes bien inscrit a notre site</p>" : "";
        $first_try = "Bonjour, merci de vous connectez sur notre site !";
        $retry = "Vous vous êtes trompé d'identifiant ou de mot de passe merci de réessayer";
        $message_co = (isset($_POST['connection'])) ? $retry : $first_try;
        ?>
        <?= $message_inscription ?>
        <p><?= $message_co ?> </p>
        <p>Votre email:</p>
        <input type="email" name="email" />
        <p>Votre mot de passe:</p>
        <input type="password" name="mdp" />
        <div class="input">
            <input class="button" type="submit" value="Se connecter" name="connection" />
            <input class="button" type="submit" value="Inscription" name="inscription" />
        </div>
    </form>
    <div>
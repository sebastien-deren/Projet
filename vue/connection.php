<div class="form_connection">
<form method ="post" action="index.php">
    <?php 
    $message_inscription = (isset($_POST['inscrit']))? "<p> vous êtes bien inscrit a notre site</p>":"";
    $first_try="bonjour, merci de vous connectez sur notre site !";
    $retry="vous vous êtes trompé d'identifiant ou de mot de passe merci de réessayer";
    $message_co = (isset($connection))? $retry: $first_try;
    ?>
    <?=$message_inscription?>
    <p><?= $message_co?> </p>
    <p>votre nom d'utilisateur ou email. <input type="email" name="email"/></p>
    <p>votre mot de passe <input type="password" name="mdp"/></p>
    <p><input type ="submit" value="se connecter" name="connection"/> </p>
    <p><input type="submit" value="inscription" name="inscription"/> </p>
</form>
<div>
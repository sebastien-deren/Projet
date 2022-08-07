<?php
function formulaire(bool $connect)
{
    if($connect) echo("<p> le mot de passe ou nom d'utilisateur est érroné</>");
?>
    <form method ="post" action="start.php">
    <p> bonjour, merci de vous connectez sur notre site !</p>
    <p>votre nom d'utilisateur ou email. <input type="text" name="pseudo"/></p>
    <p>votre mot de passe <input type="password" name="mdp"/></p>
    <p><input type ="submit" value="se connecter" name="connection"/> </p>
    <p><input type="submit" value="inscription" name="inscription"/> </p>
    </form>

<?php }
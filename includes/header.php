<header id="tete">
                    <!-- afficher une demande de connexion si pas connecté
                        si connecté affiché l'icone choisi par l'utilisateur + son nom +titre
                        sur le modéle si dessous -->

                    <div id="photoID">
                        <img class="photo" src="./images/avatar.jpg" alt="ma photo"/>
                    </div>
                    <div id="presentation">
                        <?php if(isset($_SESSION['FULL_NAME'])){
                            echo("<h1>".$_SESSION['FULL_NAME']."</h1>");
                        }
                        else{
                            echo("<h1>connecter vous</h1>");
                        }?>
                        <h2>apprenti developeur Web</h2>
                    </div>
                </header>
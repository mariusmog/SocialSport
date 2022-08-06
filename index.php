<!-- INDEX : Cette page est le "sommaire" du site. A l'aide de la méthode GET, cette page affiche le contenu de la page entrée en argument.
Elle affiche également un header à chaque page avec le logo du site à gauche, le nom du site au milieu qui s'avère être un lien vers l'accueil et
un lien permettant de se déconnecter, un lien vers le profil de l'utilisateur actif puis un lien vers les messages de l'utilisateur actif si la session est active.
Si l'utilisateur actif est privé, un lien renvoyant vers la page Demandes_abonnement est également disponible.
Cette page vérifie si la page existe dans le dossier page et met son nom dans la variable $contenu si elle existe. Dans le cas contraire, on est redirigé vers la page accueil ou la page connexion.

-->
<?php

session_start();
$page = htmlentities($_GET['page']);
$pages = scandir('pages');


if(!empty($page) && in_array($_GET['page'].".php",$pages)){
    $contenu = 'pages/'.$_GET['page'].".php";
}
else{
	if(isset($_SESSION['id'])){
		header("Location:index.php?page=Accueil");
	}else{
    header("Location:index.php?page=Connexion");
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
	  <link rel =" stylesheet " href ="css/style.css">
        <meta charset="utf-8">
    </head>
    <body>
		<header classe="head">
		<nav>
			<div id="logo">
				<h1><a href="index.php?page=Accueil">SocialSport</a></h1>
			</div>
			<img class="img_logo" src="images/logo.png" alt="">
			<div class="menu">
				<?php 
					if(isset($_SESSION['pseudo'])){
						echo '<a href="index.php?page=Deconnexion">déconnectez-vous</a><a href="index.php?page=Profil&pseudo='.html_entity_decode($_SESSION['pseudo']).'" id="profil">'.$_SESSION['pseudo'].'</a>';
					}
				?>
				<?php
				if(isset($_SESSION['pseudo'])){
					if($_SESSION['privé']==1){
						echo '<a href="index.php?page=Demandes_abonnement">Demandes</a>';
					}
				}
				?>
				<?php
					if(isset($_SESSION['pseudo'])){
						echo '<a href="index.php?page=Conversations">Messages</a>';
					}
				?>
			</div>
		</nav>
		</header>
        <div id='content'>
        <?php
            include($contenu);
        ?>
        </div>
    </body>
</html>
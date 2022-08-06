<!-- Page Publication : On est redirigé vers cette page lorsque l'on clique sur une publication. 
Cette page affiche la publication en question avec le pseudo et la photo de profil de l'utilisateur l'ayant posté.
Si c'est l'utilisateur actif qui l'a posté, un bouton supprimer la publication est disponible.
-->
<?php
if(isset($_SESSION['id'])){
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');

	if(publicationExiste($connect,$_GET['id_publication'])&&ctype_digit($_GET['id_publication'])){
	$infosPubli=infosPublication($connect,$_GET['id_publication']);
	$infosUser=infosUserId($connect,$infosPubli['id_membre']);
	if(isset($_POST['submit'])){
	supprimePublication($connect,$infosPubli['id_publication']);
	echo "<h2>Cette publication n'existe plus</h2>";
	}else{
	if($infosUser['privé']==0 || estAbonné($connect,$_SESSION['id'],$infosUser['id']) || $_SESSION['administrateur']==1||$infosUser['id']==$_SESSION['id']){
		affichePublication($connect,$infosPubli['id_publication']);
	}else{
		echo '<h2>Cette publication est privée.</h2>';
	}
		if(($_SESSION['id']==$infosUser['id'])||($_SESSION['administrateur']==1&&$_SESSION['id']!=$infosUser['id']&&$infosUser['administrateur']==0)){
			echo '<form method="POST" action="">';
			$str="Supprimer cette publication";
			echo '<p class="align"><input type="submit"'.'value="'.$str.'"name="submit" id="submit"></p>';
			}
	
	
	
	}
	
	
	}else{
		echo "<h2>Cette publication n'existe pas.</h2>";
	}
	echo '<br>';
	
	}else{
    header("Location:index.php?page=Connexion");
}
	
	
	?>
		
	
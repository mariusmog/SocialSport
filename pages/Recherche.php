<!-- Page Recherche : On est redirigé vers cette page lorsqu'on recherche un utilisateur dans la barre de recherche.
Cette page affiche tous les utilisateurs contenant dans leur pseudo la chaîne de caractères entrée dans la barre de recherche.
Si aucun utilisateur n'a cette chaîne de caractère dans son pseudo, la page affiche le message "Aucun utilisateur trouvé.".-->
<?php
if(isset($_SESSION['id'])){
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');
	?>
	<div id="Rechercher">
	<form method="POST" action="index.php?page=Recherche">
		<p><input type='search' placeholder='Rechercher un utilisateur' name='search' id='search'>
	    <input type='submit' value="Rechercher" name='submitR' id='submitR'></p>
		</form>
	</div>
	<?php
	if(isset($_POST['submitR'])&&!empty($_POST['search'])){
		$string=mysqli_real_escape_string($connect,trim(htmlentities($_POST['search'])));
		afficheRecherche($connect,$string);
		
		
		echo '<br>';
	}else{
		
		echo '<h2>Aucun utilisateur trouvé.</h2>';
	}
	}else{
	 header("Location:index.php?page=Connexion");
}
	?>
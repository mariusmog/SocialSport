<!-- Page Page_nombre_abonnements_utilisateur : Cette page affiche une liste des abonnements de l'utilisateur en question.
-->
<?php
if(isset($_SESSION['id'])){
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');
	$var=mysqli_real_escape_string($connect,trim(htmlentities($_GET['pseudo'])));
	if(!pseudo_existant($connect,$var)){
		$var=$_SESSION['pseudo'];
	}
	echo '<h2>Abonnements de '.$var.' :</h2>';
	$infosProfil=infosUserPseudo($connect,$var);
		afficheAbonnements($connect,$infosProfil['id']);
		}else{
    header("Location:index.php?page=Connexion");
}
	?>
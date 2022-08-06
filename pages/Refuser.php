<?php
//page Refuser : page vers laquelle on est redirigé lorsqu'un utilisateur privé refuse la demande d'abonnement d'un autre utilisateur.
//Cette page refuse la demande puis redirige vers la page Demande_abonnement.
if(isset($_SESSION['id'])){
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');
	$var=mysqli_real_escape_string($connect,trim(htmlentities($_GET['pseudo'])));
	$infosUser=infosUserPseudo($connect,$var);
	supprimerDemande($connect,$infosUser['id'],$_SESSION['id']);
	header('Location:index.php?page=Demandes_abonnement');
	}else{
	 header("Location:index.php?page=Connexion");
}
	?>
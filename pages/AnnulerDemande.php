<!-- Page AnnulerDemande : On est redirigé vers cette page lorsqu'on appuie sur le lien "refuser" sur la page Demandes_abonnement d'un compte privé,
ou le lien "annuler la demande" sur la page profil d'un utilisateur privé à qui on a envoyé une demande.

-->
<?php
if(isset($_SESSION['id'])){
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');
	$var=mysqli_real_escape_string($connect,trim(htmlentities($_GET['pseudo'])));
	$infosUser=infosUserPseudo($connect,$var);
	supprimerDemande($connect,$_SESSION['id'],$infosUser['id']);
	header('Location:index.php?page=Profil&pseudo='.html_entity_decode($infosUser['pseudo']));
	}else{
    header("Location:index.php?page=Connexion");
}
	?>
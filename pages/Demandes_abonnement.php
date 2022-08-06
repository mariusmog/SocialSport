<!-- Page Demandes_abonnements : Cette page n'est visible que pour les comptes privés, elle affiche une liste des demandes faites par 
les autres utilisateurs si il y en a. L'utilisateur peut accepter ou bien refuser.
-->
<?php 
if(isset($_SESSION['id'])){
	if($_SESSION['privé']==1){
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');
	?>
	<h2>Vos demandes d'abonnement :</h2>
	<?php
	afficheInvitations($connect,$_SESSION['id']);
	}else{
		header("Location:index.php?page=Accueil");
	}
	}else{
		 header("Location:index.php?page=Connexion");
}
	?>
	
	
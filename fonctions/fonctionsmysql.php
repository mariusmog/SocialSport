<?php
$connect=mysqli_connect('localhost','root','','base') or die("Impossible de se connecter à a base de données.");

//Fonctions qui traitent les données pour pouvoir les entrer dans la base de données sans erreur
function traiter_mysqli($connect,$donnée) {
 if (!empty($donnée)) {
 $don = trim($donnée);
 $don= mysqli_real_escape_string($connect,$don);
 }else{
	 $don=$donnée;
 }
 return $don;
}

function traiterDonnees_mysqli($connect,&$donnees){
	foreach($donnees as $clef => $contenu){
		$tab[$clef]=traiter_mysqli($connect,$contenu);
	}
	return $tab;
}
//Fonction qui inscrit un utilisateur sur le réseau social
function inscrire($connect,$pseudo,$email,$mdp,$date,$sexe,$taille,$poids){
	
	$req="INSERT INTO users(id,pseudo,email,mdp,date,sexe,taille,poids) VALUES('','$pseudo','$email','$mdp','$date','$sexe','$taille','$poids');";
	$resultat=mysqli_query($connect,$req);
	
}
//Fonction qui regarde si le pseudo entré existe déjà ou non dans la base de données
function pseudo_existant($connect,$pseudo){
	$select = mysqli_query($connect,"SELECT * FROM users WHERE pseudo = '$pseudo';");
	$compte=mysqli_num_rows($select);
	if($compte!=0){
		return true;
	}else{
		return false;
	}
}
//Fonction qui regarde si l'email entré existe déjà ou non dans la base de données
function email_existant($connect,$email){
	$select = mysqli_query($connect,"SELECT * FROM users WHERE email = '$email';");
	$compte=mysqli_num_rows($select);
	if($compte!=0){
		return true;
	}else{
		return false;
	}
	
	
}
//Fonction qui vérifie le mot de passe
function verifie_mdp($connect,$pseudo,$mdp){
	$req = mysqli_query($connect,"SELECT * FROM users WHERE pseudo = '$pseudo' AND mdp = '$mdp';");
	$compte=mysqli_num_rows($req);
	if($compte!=0){
		return true;
	}else{
		return false;
	}
	
}
//Fonction qui renvoie l'id d'un utilisateur
function id_membre($connect,$pseudo){
	$req = mysqli_query($connect,"SELECT * FROM users WHERE pseudo = '$pseudo';");
    $tab=mysqli_fetch_assoc($req);
	$id=$tab['id'];
	return $id;
}
//Fonction qui crée une session avec les informations de l'utilisateur
function crée_session($connect,$pseudo){
	$req = mysqli_query($connect,"SELECT * FROM users WHERE pseudo = '$pseudo';");
	$tab= mysqli_fetch_assoc($req);
	foreach($tab as $clé => $valeur){
		$_SESSION[$clé] = $valeur;
	}	
}
//Fonction qui renvoie le nombre d'abonnés d'un utilisateur
function nombre_abonnés($connect,$id){
	$req = mysqli_query($connect,"SELECT * FROM abonnements WHERE id_suivi = '$id';");
	return mysqli_num_rows($req);
}
//Fonction qui renvoie le nombre d'abonnements d'un utilisateur
function nombre_abonnements($connect,$id){
	$req = mysqli_query($connect,"SELECT * FROM abonnements WHERE id_abonné = '$id';");
	return mysqli_num_rows($req);
}
//Fonction qui modifie l'attribut pseudo d'un utilisateur dans la base de données
function modifie_pseudo($connect,$pseudo){
	$req = mysqli_query($connect,"UPDATE users SET pseudo='$pseudo' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['pseudo']=$pseudo;
}
//Fonction qui modifie l'attribut email d'un utilisateur dans la base de données
function modifie_email($connect,$email){
	$req = mysqli_query($connect,"UPDATE users SET email='$email' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['email']=$email;
}
//Fonction qui modifie l'attribut photo_de_profil d'un utilisateur dans la base de données
function modifie_pp($connect,$photo_de_profil){
	$req = mysqli_query($connect,"UPDATE users SET photo_de_profil='$photo_de_profil' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['photo_de_profil']=$photo_de_profil;
}
//Fonction qui modifie l'attribut mdp d'un utilisateur dans la base de données
function modifie_mdp($connect,$mdp){
	$req = mysqli_query($connect,"UPDATE users SET mdp='$mdp' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['mdp']=$mdp;
}
//Fonction qui modifie l'attribut sexe d'un utilisateur dans la base de données
function modifie_sexe($connect,$sexe){
	$req = mysqli_query($connect,"UPDATE users SET sexe='$sexe' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['sexe']=$sexe;
}
//Fonction qui modifie l'attribut taille d'un utilisateur dans la base de données
function modifie_taille($connect,$taille){
	$req = mysqli_query($connect,"UPDATE users SET taille='$taille' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['taille']=$taille;
}
//Fonction qui modifie l'attribut poids d'un utilisateur dans la base de données
function modifie_poids($connect,$poids){
	$req = mysqli_query($connect,"UPDATE users SET poids='$poids' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['poids']=$poids;
}
//Fonction qui modifie l'attribut biographie d'un utilisateur dans la base de données
function modifie_biographie($connect,$biographie){
	$req = mysqli_query($connect,"UPDATE users SET biographie='$biographie' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['biographie']=$biographie;
}
//Fonction qui modifie l'attribut sport_favori d'un utilisateur dans la base de données
function modifie_sport_favori($connect,$sport_favori){
	$req = mysqli_query($connect,"UPDATE users SET sport_favori='$sport_favori' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['sport_favori']=$sport_favori;
}
//Fonction qui modifie l'attribut question1 d'un utilisateur dans la base de données
function modifie_question1($connect,$question1){
	$req = mysqli_query($connect,"UPDATE users SET question1='$question1' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['question1']=$question1;
}
//Fonction qui modifie l'attribut question2 d'un utilisateur dans la base de données
function modifie_question2($connect,$question2){
	$req = mysqli_query($connect,"UPDATE users SET question2='$question2' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['question2']=$question2;
}
//Fonction qui modifie l'attribut question3 d'un utilisateur dans la base de données
function modifie_question3($connect,$question3){
	$req = mysqli_query($connect,"UPDATE users SET question3='$question3' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['question3']=$question3;
}
//Fonction qui modifie l'attribut question4 d'un utilisateur dans la base de données
function modifie_question4($connect,$question4){
	$req = mysqli_query($connect,"UPDATE users SET question4='$question4' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['question4']=$question4;
}
//Fonction qui modifie l'attribut privé d'un utilisateur dans la base de données
function modifie_privé($connect,$privé){
	$req = mysqli_query($connect,"UPDATE users SET privé='$privé' WHERE pseudo='".$_SESSION['pseudo']."';");
	$_SESSION['privé']=$privé;
	
	
}
//Fonction qui crée une nouvelle publication
function nouvellePublication($connect,$description,$image,$privé){
	$id_membre=id_membre($connect,$_SESSION['pseudo']);
	$req=mysqli_query($connect,"INSERT INTO publications(id_publication,id_membre,description,image,privé) VALUES('','$id_membre','$description','$image','$privé');");
}

//Fonction qui renvoie un tableau contenant les informations d'un utilisateur grâce à son pseudo

function infosUserPseudo($connect,$pseudo){
	$req = mysqli_query($connect,"SELECT * FROM users WHERE pseudo = '$pseudo';");
    $tab=mysqli_fetch_assoc($req);
	return $tab;
}
//Fonction qui renvoie un tableau contenant les informations d'un utilisateur grâce à son id
function infosUserId($connect,$id){
	$req = mysqli_query($connect,"SELECT * FROM users WHERE id = '$id';");
    $tab=mysqli_fetch_assoc($req);
	return $tab;
}
//Fonction qui vérifie si un utilisateur est abonné à un autre utilisateur
function estAbonné($connect,$id_abonné,$id_suivi){
	$req = mysqli_query($connect,"SELECT * FROM abonnements WHERE id_abonné = '$id_abonné' AND id_suivi = '$id_suivi';");
	$compte=mysqli_num_rows($req);
	if($compte!=0){
		return true;
	}else{
		return false;
	}
	
}
//Fonction qui affiche les publications d'un utilisateur sur son profil
function affichePublicationsProfil($connect,$id_membre){
	$req = mysqli_query($connect,"SELECT * FROM publications WHERE id_membre = '$id_membre' ORDER BY id_publication DESC;");
	$infos=infosUserId($connect,$id_membre);
    while($tab=mysqli_fetch_assoc($req)){
		if(($tab['privé']==1)&&(estAbonné($connect,$_SESSION['id'],$id_membre)||$_SESSION['id']==$id_membre||$_SESSION['administrateur']==1)){
		echo '<a href=index.php?page=Publication&id_publication='.$tab['id_publication'].'><div class="publication"><p class="align"><B>'.$infos['pseudo'].'</B></p><p class="align"><img src="avatars/'.$infos['photo_de_profil'].'" width="50" height="50"/></p>';
	if(strlen($tab['image'])>1){echo '<p class="align"><img src="images/'.$tab['image'].'"width=400px/></p>';} echo '<p class="align">'.$tab['description'].'</p><br></div></a>';
		}else{
			if($tab['privé']==0){
			echo '<a href=index.php?page=Publication&id_publication='.$tab['id_publication'].'><div class="publication"><p class="align"><B>'.$infos['pseudo'].'</B></p><p class="align"><img src="avatars/'.$infos['photo_de_profil'].'" width="50" height="50"/></p>';
		if(strlen($tab['image'])>1){echo '<p class="align"><img src="images/'.$tab['image'].'" width=400px/></p>';} echo '<p class="align">'.$tab['description'].'</p><br></div></a>';
			}
		}
	}
}

//Fonction qui vérifie si une demande d'abonnement existe
function demande_existe($connect,$id_demandeur,$id_receveur){
	$req = mysqli_query($connect,"SELECT * FROM demandeAbonnement WHERE id_demandeur = '$id_demandeur' AND id_receveur = '$id_receveur';");
	$compte=mysqli_num_rows($req);
	if($compte!=0){
		return true;
	}else{
		return false;
	}
}
//Fonction qui envoie une demande d'abonnement à un compte privé
function nouvelleDemande($connect,$id_demandeur,$id_receveur){
	$req="INSERT INTO demandeabonnement(id_demande,id_demandeur,id_receveur) VALUES('','$id_demandeur','$id_receveur');";
	$resultat=mysqli_query($connect,$req);
	
}
//Fonction qui abonne un utilisateur à un autre
function nouvelAbonnement($connect,$id_abonné,$id_suivi){
	$req="INSERT INTO abonnements(id_abonnement,id_abonné,id_suivi) VALUES('','$id_abonné','$id_suivi');";
	$resultat=mysqli_query($connect,$req);
	
}
//Fonction qui supprime une demande d'abonnement
function supprimerDemande($connect,$id_demandeur,$id_receveur){
	$req=mysqli_query($connect,"DELETE FROM demandeabonnement WHERE id_demandeur='$id_demandeur' AND id_receveur='$id_receveur';");
	
}
//Fonction qui désabonne un utilisateur d'un autre utilisateur
function supprimerAbonnement($connect,$id_abonné,$id_suivi){
	$req=mysqli_query($connect,"DELETE FROM abonnements WHERE id_abonné='$id_abonné' AND id_suivi='$id_suivi';");
}
//Fonction qui accepte une demande d'abonnement pour les comptes privés
function accepterDemande($connect,$id_demandeur,$id_receveur){
	nouvelAbonnement($connect,$id_demandeur,$id_receveur);
	supprimerDemande($connect,$id_demandeur,$id_receveur);
	
}
// Fonction qui affiche pour les comptes privés leurs demandes d'abonnement
function afficheInvitations($connect,$id_membre){
	$req = mysqli_query($connect,"SELECT * FROM demandeAbonnement WHERE id_receveur = '$id_membre' ORDER BY id_demande DESC;");
	$compte=mysqli_num_rows($req);
	if($compte==0){
		echo "<p class='align'>"."Vous n'avez aucune demande en attente de validation.</p>";
	}else{
	while($tab=mysqli_fetch_assoc($req)){
		$infos=infosUserId($connect,$tab['id_demandeur']);
		echo '<div class="demande"><p class="align"><img src="avatars/'.$infos['photo_de_profil'].'" width="50" height="50"/> '
		.$infos['pseudo']." veut s'abonner à votre profil.</p>";
	echo '<p class="align"><a href="index.php?page=Accepter&pseudo='.html_entity_decode($infos['pseudo']).'">Accepter</a>
	ou     <a href="index.php?page=Refuser&pseudo='.html_entity_decode($infos['pseudo']).'">Refuser</a>';
	 		
	}
	}
}
//Fonction qui affiche les publications dans le fil d'actualité
function affichePublicationsAccueil($connect,$id_membre){
	$req = mysqli_query($connect,"SELECT * FROM publications ORDER BY id_publication DESC;");
	while($tab=mysqli_fetch_assoc($req)){
		if(estAbonné($connect,$id_membre,$tab['id_membre'])){
			$infos=infosUserId($connect,$tab['id_membre']);
			echo '<a href=index.php?page=Publication&id_publication='.$tab['id_publication'].'><div class="publication"><p class="align"><B>'.$infos['pseudo'].'</B></p><p class="align"><img src="avatars/'.$infos['photo_de_profil'].'" width="50" height="50"/></p>';
	if(strlen($tab['image'])>1){echo '<p class="align"><img src="images/'.$tab['image'].'" width=400px/></p>';} echo '<p class="align">'.$tab['description'].'</p><br></div></a>';
			
		}
	}
}
//Fonction qui affiche une publication
function affichePublication($connect,$id_publication){
	$req = mysqli_query($connect,"SELECT * FROM publications WHERE id_publication ='$id_publication';");
	$tab=mysqli_fetch_assoc($req);
	$infosPubli=infosPublication($connect,$tab['id_publication']);
	$infosUser=infosUserId($connect,$tab['id_membre']);
	echo '<div class="publication"><p class="align"><B>'.$infosUser['pseudo'].'</B></p>
	<p class="align"><a href=index.php?page=Profil&pseudo='.$infosUser['pseudo'].'>
	<img src="avatars/'.$infosUser['photo_de_profil'].'" width="50" height="50"/></a></p>';
	if(strlen($tab['image'])>1){
		echo '<p class="align"><img src="images/'.$tab['image'].'" width=400px/></p>';}
		echo '<p class="align">'.$tab['description'].'</p><br></div>';

}
//Fonction qui renvoie un tableau contenant les informations de la publication dont l'id est $id_publication
function infosPublication($connect,$id_publication){
	$req = mysqli_query($connect,"SELECT * FROM publications WHERE id_publication ='$id_publication';");
	$tab=mysqli_fetch_assoc($req);
	return $tab;

}
//Fonction qui cherche dans la base de donnée si une publication existe ou non
function publicationExiste($connect,$id_publication){
$req = mysqli_query($connect,"SELECT * FROM publications WHERE id_publication ='$id_publication';");
	$compte=mysqli_num_rows($req);
	if($compte!=0){
		return true;
	}else{
		return false;
	}
	
}

//Fonction qui supprime une publication
function supprimePublication($connect,$id_publication){
		$req=mysqli_query($connect,"DELETE FROM publications WHERE id_publication='$id_publication';");
}
// Fonction qui ajoute un nouvel administrateur
function nouvelAdministrateur($connect,$id_membre){
	$req = mysqli_query($connect,"UPDATE users SET administrateur=1 WHERE id='$id_membre';");	
}

//Fonction qui va afficher les utilisateurs dont le pseudo contient $string
function afficheRecherche($connect,$string){
	$req = mysqli_query($connect,"SELECT * FROM users;");
	$ct=0;
	while($tab=mysqli_fetch_assoc($req)){
		if(!(stripos($tab['pseudo'],$string)===false)){
			$ct=$ct+1;
		echo '<div class="rechercheProfil"><p class="align"><a href=index.php?page=Profil&pseudo='.$tab['pseudo'].'><img src="avatars/'.$tab['photo_de_profil'].'" width="50" height="50"/></a>    '.$tab['pseudo']."</p></div>";
		
		}
	}
	if($ct==0){
		echo '<h2>Aucun utilisateur trouvé.</h2>';
	}	
}
//Fonction qui va afficher les abonnements de la personne dont l'id est celui entré en paramètres
function afficheAbonnements($connect,$id_membre){
	$req = mysqli_query($connect,"SELECT * FROM abonnements WHERE id_abonné = '$id_membre' ORDER BY id_abonnement DESC;");
	$infos=infosUserId($connect,$id_membre);
    while($tab=mysqli_fetch_assoc($req)){
		$infosTab=infosUserId($connect,$tab['id_suivi']);
		if(($infos['privé']==1)&&(estAbonné($connect,$_SESSION['id'],$id_membre)||$_SESSION['id']==$id_membre||$_SESSION['administrateur']==1)){
		echo '<div class="abonnements"><p class="align"><a href=index.php?page=Profil&pseudo='.html_entity_decode($infosTab['pseudo']).'><img src="avatars/'.$infosTab['photo_de_profil'].'" width="50" height="50"/></a>    '.$infosTab['pseudo']."</p></div>";
		}else{
			if($infos['privé']==0){
				echo '<div class="abonnements"><p class="align"><a href=index.php?page=Profil&pseudo='.html_entity_decode($infosTab['pseudo']).'><img src="avatars/'.$infosTab['photo_de_profil'].'" width="50" height="50"/></a>    '.$infosTab['pseudo']."</p></div>";
			
			}
		}
	}
}
//Fonction qui va afficher les abonnés de la personne dont l'id est celui entré en paramètres
function afficheAbonnés($connect,$id_membre){
	$req = mysqli_query($connect,"SELECT * FROM abonnements WHERE id_suivi = '$id_membre' ORDER BY id_abonnement DESC;");
	$infos=infosUserId($connect,$id_membre);
    while($tab=mysqli_fetch_assoc($req)){
		$infosTab=infosUserId($connect,$tab['id_abonné']);
		if(($infos['privé']==1)&&(estAbonné($connect,$_SESSION['id'],$id_membre)||$_SESSION['id']==$id_membre||$_SESSION['administrateur']==1)){
		echo '<div class="abonnements"><p class="align"><a href=index.php?page=Profil&pseudo='.html_entity_decode($infosTab['pseudo']).'><img src="avatars/'.$infosTab['photo_de_profil'].'" width="50" height="50"/></a>    '.$infosTab['pseudo']."</p></div>";
		}else{
			if($infos['privé']==0){
				echo '<div class="abonnements"><p class="align"><a href=index.php?page=Profil&pseudo='.html_entity_decode($infosTab['pseudo']).'><img src="avatars/'.$infosTab['photo_de_profil'].'" width="50" height="50"/></a>    '.$infosTab['pseudo']."</p></div>";
			
			}
		}
	}
}

//Fonction qui créé la conversation et le message qui va avec

function creer_conv($connect,$sujet,$message){
	$var=htmlentities($_GET['pseudo']);
	mysqli_query($connect,"INSERT INTO conversations(id_conversation,sujet_conversation) VALUES('','{$sujet}')");
	mysqli_query($connect,"INSERT INTO conversations_mess(id_conversation,pseudo_expe,corps_mess,date_mess) VALUES('','{$_SESSION["pseudo"]}','{$message}',NOW())");
	mysqli_query($connect,"INSERT INTO conversations_membres(id_conversation,pseudo_dest) VALUES('','{$var}')");
}

//Fonction qui va récuperer les conversations

function recup_conv($connect){
	$results = array();
	$req = mysqli_query($connect,"SELECT conversations.id_conversation,
	conversations.sujet_conversation,
	users.pseudo,
	users.photo_de_profil,
	conversations_mess.date_mess
	FROM conversations
	LEFT JOIN conversations_mess
	ON conversations.id_conversation = conversations_mess.id_conversation
	INNER JOIN conversations_membres
	ON conversations.id_conversation = conversations_membres.id_conversation
	INNER JOIN users
	ON users.pseudo = conversations_mess.pseudo_expe
	WHERE pseudo_dest = '{$_SESSION["pseudo"]}'
	GROUP BY conversations.id_conversation
	ORDER BY conversations_mess.date_mess DESC");
	while($row = mysqli_fetch_assoc($req)){
		$results[] = $row;
	}
	return $results;
}

//Fonction qui va recupérer les messages

function recup_msg($connect){
	$messages = array();
	$req = mysqli_query($connect,"SELECT conversations_mess.date_mess,
	conversations_mess.corps_mess,
	conversations.sujet_conversation,
	users.pseudo,
	users.photo_de_profil
	FROM conversations_mess
	INNER JOIN users ON users.pseudo = conversations_mess.pseudo_expe
	INNER JOIN conversations_membres ON conversations_mess.id_conversation = conversations_membres.id_conversation
	INNER JOIN conversations ON conversations_mess.id_conversation = conversations.id_conversation WHERE conversations_mess.id_conversation = '{$_GET["id"]}'
	AND conversations_membres.pseudo_dest = '{$_SESSION["pseudo"]}'
	ORDER BY conversations_mess.date_mess DESC");
	while($row = mysqli_fetch_assoc($req)){
		$messages[] = $row;
	}
	return $messages;
}

?>
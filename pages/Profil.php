<!--Page profil : affiche le profil de l'utilisateur connecté ou le profil d'un autre utilisateur à l'aide de $_GET.
Si le profil en question est privé, les publications et les informations de ce profil ne sont pas affichées et 
un bouton demande d'abonnement est disponible pour l'utilisateur actif.
Si l'utilisateur actif est un administrateur, il peut promouvoir l'utilisateur du profil en question administrateur.
On peut aussi s'abonner et se désabonner du profil avec l'aide de plusieurs boutons.
Si le profil est celui de l'utilisateur actif, il peut modifier ses informations grâce à un lien vers la page Complete_profil.
Des liens vers les pages Page_nombre_abonnements_utilisateur et Page_nombre_abonnés_utilisateur permettent de voir les abonnements et les abonnés de l'utilisateur en question.
-->
<?php
if(isset($_SESSION['id'])){
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');
	$var=mysqli_real_escape_string($connect,trim(htmlentities($_GET['pseudo'])));
	if(!pseudo_existant($connect,$var)){
		$var=$_SESSION['pseudo'];
	}
	$infosProfil=infosUserPseudo($connect,$var);
	if(isset($_POST['submitD'])&&!demande_existe($connect,$_SESSION['id'],$infosProfil['id'])){
		nouvelleDemande($connect,$_SESSION['id'],$infosProfil['id']);
	}
	if(isset($_POST['submitA'])&&!estAbonné($connect,$_SESSION['id'],$infosProfil['id'])){
		nouvelAbonnement($connect,$_SESSION['id'],$infosProfil['id']);
	}
	if(isset($_POST['submitS'])&&estAbonné($connect,$_SESSION['id'],$infosProfil['id'])){
		supprimerAbonnement($connect,$_SESSION['id'],$infosProfil['id']);
	}
	if(isset($_POST['submitP'])){
		nouvelAdministrateur($connect,$infosProfil['id']);
	}
	if(isset($_POST['submitRE'])){
		supprimerAbonnement($connect,$infosProfil['id'],$_SESSION['id']);
	}
?>
	
<h2> Profil de <?php echo $infosProfil['pseudo'];?></h2>
<?php if(strcasecmp($_SESSION['pseudo'],htmlentities($_GET["pseudo"]))!=0){ 
echo '<a href="index.php?page=new_message&pseudo='.$_GET["pseudo"].'"> Envoyer un message </a>';
}?>
<div id="div1">
<br>
    <?php
		echo '<p class="align"><img src="avatars/'.$infosProfil['photo_de_profil'].'" width="150" height="150"/></p>';
	?>
    <h3 class='align'><?php echo $infosProfil['pseudo'];?></h3>
	<?php
	if($infosProfil['privé']==1){echo '<br>';}
		if($infosProfil['privé']==0||$infosProfil['id']==$_SESSION['id']||estAbonné($connect,$_SESSION['id'],$infosProfil['id'])||$_SESSION['administrateur']==1){
	?>
	<p class='align'>
	<?php
		echo $infosProfil['biographie'];
	?>
	</p>
	<div class='trait'></div><br><br>
    <B> Email : </B>
	<?php
		echo $infosProfil['email'];
	?>
    <p><B>nombre d'abonnés : </B><a href="index.php?page=Page_nombre_abonnés_utilisateur&pseudo=<?php echo html_entity_decode($infosProfil['pseudo']);?>">
	<?php
		echo nombre_abonnés($connect,$infosProfil['id']);
	?>
	</a>      <B>   nombre d'abonnements : </B><a href="index.php?page=Page_nombre_abonnements_utilisateur&pseudo=<?php echo html_entity_decode($infosProfil['pseudo']);?>">
	<?php
		echo nombre_abonnements($connect,$infosProfil['id']);
	?>
	</a></p>
    <?php
		if(strlen($infosProfil['sport_favori'])>0){
			echo '<p><B>Sport favori : </B>'.$infosProfil['sport_favori'].'</p>';
		}
	?>
	<?php
		if(strlen($infosProfil['question1'])>0){
			echo '<p><B>Âge auquel '.$infosProfil['pseudo'].' a commencé le sport : </B>'.$infosProfil['question1'].' ans.</p>';
		}
	?>
	<?php
		if(strlen($infosProfil['question2'])>1){
			echo '<p><B>Sportif préféré : </B>'.$infosProfil['question2'].'</p>';
		}
	?>
	<?php
		if(strlen($infosProfil['question3'])>1){
			echo '<p><B>Sport que '.$infosProfil['pseudo'].' aimerait pratiquer : </B>'.$infosProfil['question3'].'</p>';
		}
	?>
	<?php
		if(strlen($infosProfil['question4'])>1){
			echo '<p><B>Pratique préférée :  </B>'.$infosProfil['question4'].'</p>';
		}
	?>
    <p><B>IMC de : </B>
	<?php
		$imc=10000*($infosProfil['poids']/($infosProfil['taille']*$infosProfil['taille']));
		echo $imc;
	?>
	</p>
	<?php
		if(($_SESSION['id']!=$infosProfil['id'])&&(!estAbonné($connect,$_SESSION['id'],$infosProfil['id']))){
			echo '<form method="POST" action="">';
			$str="Suivre";
			echo '<p class="align"><input type="submit"'.'value="'.$str.'"name="submitA" id="submitA"></p>';
		}
			if(($_SESSION['id']!=$infosProfil['id'])&&(estAbonné($connect,$_SESSION['id'],$infosProfil['id']))){
				echo '<form method="POST" action="">';
				$str2="se désabonner";
				echo '<p class="align"><input type="submit"'.'value="'.$str2.'"name="submitS" id="submitS"></p>';
			}
			if(($_SESSION['privé']==1)&&(estAbonné($connect,$infosProfil['id'],$_SESSION['id']))){
				echo '<form method="POST" action="">';
				$str3="Retirer de mes abonnés";
				echo '<p class="align"><input type="submit"'.'value="'.$str3.'"name="submitRE" id="submitRE"></p>';
			}
			if(($_SESSION['id']!=$infosProfil['id'])&&($_SESSION['administrateur']==1)&&($infosProfil['administrateur']==0)){
				$str4="Promouvoir administrateur";
				echo '<p class="align"><input type="submit"'.'value="'.$str4.'"name="submitP" id="submitP"></p>';
			}
			
	?>
    <?php
		if($infosProfil['id']==$_SESSION['id']){
			echo '<p><a href="index.php?page=Complete_profil">Complète ton profil</a></p>';
		}
	?>
		<br>
</div>

<div class="publications">
<h4> Publications : </h4>
<?php
	affichePublicationsProfil($connect,$infosProfil['id']);
?>
</div>
<br>
<?php
	}
	else{
		echo '</div>';
		if(demande_existe($connect,$_SESSION['id'],$infosProfil['id'])){
			echo '<p class="align">'."Demande d'abonnement en attente de validation.</p>";
			echo '<p class="align"><a href="index.php?page=AnnulerDemande&pseudo='.html_entity_decode($infosProfil['pseudo']).'">Annuler la demande</a></p>';
		}
		else{
			echo "<p class='align'>Compte privé</p>";
			echo '<form method="POST" action="">';
			$str="Envoyer une demande d'abonnement";
			echo '<p class="align"><input type="submit"'.'value="'.$str.'"name="submitD" id="submitD"></p>';
		}
	}
}else{
    header("Location:index.php?page=Connexion");
}
		?>
		
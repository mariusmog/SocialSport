<!-- Page Connexion : Cette page permet à un utilisateur de se connecter si il a un compte existant. Si il ne possède pas de comptes,
il peut être redirigé vers la page Inscription pour s'inscrire. Si les informations entrées n'existent pas dans la base de données
ou ne coincident pas, des messages d'erreurs correspondants sont affichés.
On est redirigé vers cette page si on essaie d'accéder à une page à laquelle on ne devrait pas pouvoir accéder lorsque la session n'existe pas.
-->
<?php
if(!isset($_SESSION['id'])){
if(isset($_POST['submit'])){
	$DONNEES = $_POST;
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');
	$DONNEES=traiterDonnees($DONNEES);
	$DONNEES=traiterDonnees_mysqli($connect,$DONNEES);
	$erreurs = array();
	$pseudo=$DONNEES['pseudo'];
	$mdp=$DONNEES['mdp'];
	$mdp=md5($mdp);
	if(!pseudo_existant($connect,$pseudo)) {
		$erreurs['pseudo']="* Ce pseudo n'existe pas *";
		$erreurs['mdp']='';
	}
	else{
		$erreurs['pseudo']='';
		if(verifie_mdp($connect,$pseudo,$mdp)){
			$erreurs['mdp']='';
			crée_session($connect,$pseudo);
			header("Location:index.php?page=Profil&pseudo=".html_entity_decode($pseudo));
			
	}
	else{
		$erreurs['mdp']='* Ce mot de passe ne correspond pas à ce pseudo. *';
	}
	}
}		
?>
<h2>Bienvenue sur SocialSport</h2>
	<div id="div1">
		<br>
		<p class="align"><img src="images/logo.png" width="150" height="150"/></p>
       	 <p class="align">Connectez-vous ! Pas de compte ? Inscrivez-vous <a href="Index.php?page=Inscription">ici</a> !</p>
      	  <form method="POST" action="index.php?page=Connexion">
       	     <p>
               
        	        <input type="text" placeholder="Entrez votre pseudo" name="pseudo" id="pseudo" <?php if(isset($_POST['submit'])){ echo "value ='".$pseudo."'";}?>required/>
					<?php if(isset($_POST['submit'])){ echo '<br> <span class="error">'.$erreurs['pseudo'].'</span>';}?>
        	    </p>
        	    <p>
            
          	      <input type="password" placeholder="Entrez votre mot de passe" name="mdp" id="mdp" required/>
					<?php if(isset($_POST['submit'])){echo '<br> <span class="error">'.$erreurs['mdp'].'</span>';}?>
          	  </p>
         	   <p class="align">
        	    <input type='submit' value="Se connecter" name='submit' id='submit'></p>
				<br>
      	  </form>
 	</div>
	<br>
	
<?php

}else{
	header("Location:index.php?page=Accueil");
}
?>

<!-- Page Inscription : Cette page permet à un nouvel utilisateur de s'inscrire sur SocialSport.
Il rentre ses données dans le formulaire, la page vérifie si les informations entrées sont valides, et ajoute les données dans la base de données puis renvoie vers une page de succès si elles le sont.
Dans le cas contraire, le formulaire est réaffiché avec des messages d'erreurs spécifiques pour les erreurs faites par l'utilisateur.
-->
<?php 
if(!isset($_SESSION['id'])){
if(isset($_POST['submit'])){
	$DONNEES = $_POST;
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');
		$DONNEES=traiterDonnees($DONNEES);
		$DONNEES=traiterDonnees_mysqli($connect,$DONNEES);
		$erreurs_form = array();
		$ok=verifFormatIns($DONNEES,$erreurs_form);
		$erreurs=erreursIns($erreurs_form);
		
		$pseudo=$DONNEES['pseudo'];
		$email=$DONNEES['email'];
		 if(!pseudo_existant($connect,$pseudo)) {
		$erreurs['pseudo']='';
	}else{
		$erreurs['pseudo']='Ce pseudo est déjà attribué';
	}
	if(!email_existant($connect,$email)){
		$erreurs['email']='';
		}else{
			$erreurs['email']='Cet email est déjà attribué';
		}
		
		if ($ok){
	$mdp=$DONNEES['mdp'];
	$mdp=md5($mdp);
	$date=$DONNEES['date'];
	$sexe=$DONNEES['sexe'];
	$taille=$DONNEES['taille'];
	$poids=$DONNEES['poids'];
			
	if(pseudo_existant($connect,$pseudo) || email_existant($connect,$email)){
		réafficherForm($DONNEES,$erreurs);
	}else{
		inscrire($connect,$pseudo,$email,$mdp,$date,$sexe,$taille,$poids);
		page_succes($DONNEES);
	}
	}else{
		réafficherForm($DONNEES,$erreurs);
	}
	
}else{ 
	
	
	
	








?>
        <h2>Créez un compte !</h2>
		<div id="div1">
		<br>
		<p class="align"><img src="images/logo.png" width="150" height="150"/></p>
		<p class="align">Déjà inscrit? Connectez-vous <a href="index.php?page=Connexion">ici</a> !</p>
        <form method="post" action="index.php?page=Inscription">
            <p>
                <input type="text" name="pseudo" id="pseudo" placeholder="Choisissez un pseudo" required/>
            </p>
			<p>
                <input type="email" placeholder="Entrez votre e-mail" name="email" id="email" required/>
            </p>
            <p>
              
                <input type="password" placeholder="Choisissez un mot de passe" name="mdp" id="mdp" required/>
            </p>
            <p>
                <input type="password" placeholder="Confirmez votre mot de passe" name="rmdp" id="rmdp" required/>
            </p>
            <p>
                <label for="date">
                 <B>   Votre date de naissance</B>	
                </label> : 
                <input type="date" name="date" id="date" required/>
            </p>
            <p>
                <label for="sexe">
                <B>    Votre sexe</B>	
                </label> : 
                <select name="sexe" id="sexe">
                    <option value="Masculin">Masculin</option>
                    <option value="Feminin">Feminin</option>
                </select>
            </p>
			 <p>
			<Input type="text" placeholder="Votre taille (en cm)	"name = "taille" id="taille" required/><br>
			</p>
			<p>
			<Input type="text" placeholder="Votre poids (en kg)"name = "poids" id="poids" required/><br>
			</p>
			
            <p class="align">
            <input type='submit' value="S'inscrire" name='submit' id='submit'></p>
			
        </form>
		<br>
		</div>
		<br>
		<?php
		}
}else{
header("Location:index.php?page=Connexion");
}
		?>
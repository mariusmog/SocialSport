<!-- Page Complete_profil : On est redirigé vers cette page lorsque l'on clique sur le lien "Complète ton profil" sur la page Profil.
Cette page permet à l'utilisateur de changer de photo de profil, de passer son compte en privé et de modifier ses informations.
-->

<?php 

if(isset($_SESSION['id'])){
if(isset($_POST['submit'])){
	$DONNEES = $_POST;
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');
		$DONNEES=traiterDonnees($DONNEES);
		$DONNEES=traiterDonnees_mysqli($connect,$DONNEES);
		$erreursform = array();
		$ok=verifFormatModif($DONNEES,$erreurs_form);
		$erreurs=erreursModif($erreurs_form);
		
		$pseudo=$DONNEES['pseudo'];
		$email=$DONNEES['email'];
		 if($pseudo==$_SESSION['pseudo']) {
		$erreurs['pseudo']='';
	}else{
		if(!pseudo_existant($connect,$pseudo)){
			$erreurs['pseudo']='';
		modifie_pseudo($connect,$pseudo);
		}else{
		$erreurs['pseudo']='* Le pseudo entré est déjà attribué *';
	}
	}
	if($email==$_SESSION['email']) {
		$erreurs['email']='';
	}else{
	if(!email_existant($connect,$email)){
		$erreurs['email']='';
		modifie_email($connect,$email);
		}else{
			$erreurs['email']="* L'email entré est déjà attribué *";
		}
	}
	if (isset($_FILES['photo_de_profil']['tmp_name'])&&strlen($_FILES['photo_de_profil']['tmp_name'])>1) {
        $retour = copy($_FILES['photo_de_profil']['tmp_name'],'avatars/'.$_FILES['photo_de_profil']['name']);
	}
		if(isset($_FILES['photo_de_profil']['name']) &&strlen($_FILES['photo_de_profil']['name'])>1){
			if(verifImage($_FILES['photo_de_profil']['name'])){
				
			$photo_de_profil=$_FILES['photo_de_profil']['name'];
			$erreurs['photo_de_profil']='';
			}else{
				$photo_de_profil=$_SESSION['photo_de_profil'];
				$erreurs['photo_de_profil']='* Veuillez choisir une image valide *';
				}
		}else{
			$photo_de_profil=$_SESSION['photo_de_profil'];
			$erreurs['photo_de_profil']='';
		}
				modifie_pp($connect,$photo_de_profil);
	
		
		if($ok){
			if(isset($DONNEES['privé'])){
			$privé=$DONNEES['privé'];
		}else{
			$privé=0;
		}
		modifie_privé($connect,$privé);
			
			$mdp=$DONNEES['mdp'];
			$mdp=md5($mdp); modifie_mdp($connect,$mdp);
		$sexe=$DONNEES['sexe']; modifie_sexe($connect,$sexe);
		$taille=$DONNEES['taille'];modifie_taille($connect,$taille);
		$poids=$DONNEES['poids'];modifie_poids($connect,$poids);
				
				
		if(isset($DONNEES['biographie'])){$biographie=$DONNEES['biographie'];}else{$biographie=$_SESSION['biographie'];}modifie_biographie($connect,$biographie);
		if(isset($DONNEES['sport_favori'])){$sport_favori=$DONNEES['sport_favori'];}else{$sport_favori=$_SESSION['sport_favori'];}modifie_sport_favori($connect,$sport_favori);
		if(isset($DONNEES['question1'])){$question1=$DONNEES['question1'];}else{$question1=$_SESSION['question1'];}modifie_question1($connect,$question1);
		if(isset($DONNEES['question2'])){$question2=$DONNEES['question2'];}else{$question2=$_SESSION['question2'];}modifie_question2($connect,$question2);
		if(isset($DONNEES['question3'])){$question3=$DONNEES['question3'];}else{$question3=$_SESSION['question3'];}modifie_question3($connect,$question3);
		if(isset($DONNEES['question4'])){$question4=$DONNEES['question4'];}else{$question4=$_SESSION['question4'];}modifie_question4($connect,$question4);
		
		}
		
		
		
}
		
		
		
		
		
		?><p class='align'><a href="index.php?page=Profil&pseudo=<?php echo $_SESSION['pseudo'];?>">Retour vers le profil</a><br></p>
	<div id='div1'>
	<h2>Modifie ton profil :</h2>
        <form method="POST" enctype="multipart/form-data" action="index.php?page=Complete_profil">
		<br>
		<?php echo '<p class="align"><img src="avatars/'.$_SESSION['photo_de_profil'].'" width="150" height="150"/></p>';?>
		<p class='align'>
		 <label for="photo_de_profil">
                   <B> photo de profil</B>
				   </label> :
                <input type='file' name='photo_de_profil' id='photo_de_profil'>
				<?php if(isset($_POST['submit'])&&strlen($erreurs['photo_de_profil'])>1){ echo '<br><br> <span class="error">'.$erreurs['photo_de_profil'].'</span>';}?>
            </p><br>
		 <p>
                <label for="pseudo">
                   <B> pseudo</B>
                </label> : 
                <input type="text" name="pseudo" id="pseudo" value="<?php echo $_SESSION['pseudo'];?>" required/>
				<?php if(isset($_POST['submit'])&&strlen($erreurs['pseudo'])>1){ echo '<br><br> <span class="error">'.$erreurs['pseudo'].'</span>';}?>
            </p>
			<p>
                <label for="email">
                 <B>   email</b>
                </label> : 
                <input type="email" name="email" id="email" value="<?php echo $_SESSION['email'];?>" required/>
				<?php if(isset($_POST['submit'])&&strlen($erreurs['email'])>1){ echo '<br><br> <span class="error">'.$erreurs['email'].'</span>';}?>
            </p>
            <p>
                <label for="mdp">
                 <B>   mot de passe</B>	
                </label> : 
                <input type="password" name="mdp" id="mdp" required/>
				<?php if(isset($_POST['submit'])&&strlen($erreurs['mdp'])>1){ echo '<br><br> <span class="error">'.$erreurs['mdp'].'</span>';}?>
				</p>
            <p>
                <label for="sexe">
                <B>    sexe</B>	
                </label> : 
                <select name="sexe" id="sexe" required/>
                    <option value="Masculin">Masculin</option>
                    <option value="Feminin">Feminin</option>
                </select>
            </p>
			 <p>
                <label for="taille">
                 <B>   taille (en cm)		</B>		
					</label> :
			<Input type="text" name = "taille" id="taille" value="<?php echo $_SESSION['taille'];?>"required/><br>
			<?php if(isset($_POST['submit'])&&strlen($erreurs['taille'])>1){ echo '<br><br> <span class="error">'.$erreurs['taille'].'</span>';}?>
			</p>
			<p>
                <label for="poids">
                 <B>   poids (en kg)	</B>		
					</label> :
			<Input type="text" name = "poids" id="poids" value="<?php echo $_SESSION['poids'];?>"required/><br>
			<?php if(isset($_POST['submit'])&&strlen($erreurs['poids'])>1){ echo '<br><br> <span class="error">'.$erreurs['poids'].'</span>';}?>
			</p>
			<div class='trait'></div>
			<h3><u>Informations complémentaires :</u></h3>
            <p>
                <label for="sport_favori">
                   <B>Quel est ton sport favori ?</B>
                </label> : 
                <input type="text" name="sport_favori" id="sport_favori" value="<?php echo $_SESSION['sport_favori'];?>" >
            </p>
            <p>
                <label for="question1">
                   <B>A quel âge as-tu commencé le sport ?</B>
                </label> : 
                <input type="text" name="question1" id="question1" value="<?php echo $_SESSION['question1'];?>" >
				<?php if(isset($_POST['submit'])&&strlen($erreurs['question1'])>1){ echo '<br> <span class="error">'.$erreurs['question1'].'</span>';}?>
            </p>
            <p>
                <label for="question2">
                   <B>Ton sportif préféré ?</B>
                </label> : 
                <input type="text" name="question2" id="question2" value="<?php echo $_SESSION['question2'];?>" >
            </p>
			<p>
                <label for="question3">
                   <B>Quel sport aimerais-tu pratiquer?</B>
                </label> : 
                <input type="text" name="question3" id="question3" value="<?php echo $_SESSION['question3'];?>" >
            </p>
			<p>
                <label for="question4">
                   <B>Préfères-tu les sports individuels ou collectifs ?</B>
                </label> : 
                <input type="text" name="question4" id="question4" value="<?php echo $_SESSION['question4'];?>" >
            </p>
			<br>
			  <p class="align">
                <label for="biographie">
                  <B>Modifier la biographie</B>
                </label> : <br>
                <textarea rows='6' cols='30' name="biographie" id="biographie"><?php echo $_SESSION['biographie'];?></textarea>
            </p>
			<p class="align">
                <label for="privé">
                  <B>Compte privé</B>
                </label> : 
                <input type='checkbox' name='privé' id='privé' value=1>
            </p>
            <p class="align">
            <input type='submit' value="Terminer" name='submit' id='submit'></p>
			<br>
        </form>    
</div>		

<?php }else{
	 header("Location:index.php?page=Connexion");
}
?>
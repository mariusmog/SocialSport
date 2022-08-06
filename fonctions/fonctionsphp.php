
<?php
//Fonctions qui traitent les données pour pouvoir les afficher correctement sur la page
function traiter($donnée) {
 if (!empty($donnée)) {
 $don = trim($donnée);
 $don = htmlentities($don);
 }else{
	 $don=$donnée;
 }
 return $don;
}

function traiterDonnees(&$donnees){
	foreach($donnees as $clef => $contenu){
		$tab[$clef]=traiter($contenu);
	}
	return $tab;
}
//Fonction qui vérifie si le mot de passe est valide
function mdp_valide($mdp) {
	$maj = preg_match('@[A-Z]@', $mdp);
	$chiffre = preg_match('@[0-9]@', $mdp);
	if(!$maj || !$chiffre || strlen($mdp)<6){
		return false;
	}else{
		return true;
	}
}
//Fonction qui vérifie la validité des données pour la page Inscription
function verifFormatIns(&$donnees, &$erreur){
$check = true;
if (!mdp_valide($donnees["mdp"])) {
$erreur["mdp"] = true;
$check = false;
}else{
	$erreur["mdp"] = false;
}
if ($donnees["mdp"] != $donnees["rmdp"]) {
$erreur["rmdp"]= true;
$check = false;
}else{
	$erreur["rmdp"] = false;
}
if (strlen($donnees["taille"])>3 ||strlen($donnees["taille"])<0 || !ctype_digit($donnees['taille'])) {
$erreur["taille"]= true;
$check = false;
}else{
	$erreur["taille"]= false;
}
if (strlen($donnees["poids"])>3 ||strlen($donnees["poids"])<0 || !ctype_digit($donnees['poids'])) {
$erreur["poids"]= true;
$check = false;
}else{
	$erreur["poids"]= false;
}

return $check;
}


//Fonction qui vérifie la validité des données pour la page Complète_Profil
function verifFormatModif(&$donnees, &$erreur){
$check = true;
if (!mdp_valide($donnees["mdp"])) {
$erreur["mdp"] = true;
$check = false;
}else{
	$erreur["mdp"] = false;
}
if (strlen($donnees["taille"])>3 ||strlen($donnees["taille"])<0 || !ctype_digit($donnees['taille'])) {
$erreur["taille"]= true;
$check = false;
}else{
	$erreur["taille"]= false;
}
if (strlen($donnees["poids"])>3 ||strlen($donnees["poids"])<0 || !ctype_digit($donnees['poids'])) {
$erreur["poids"]= true;
$check = false;
}else{
	$erreur["poids"]= false;
}
if(strlen($donnees['question1'])>0){
if(strlen($donnees['question1'])<0 ||strlen($donnees['question1'])>3 || !ctype_digit($donnees['question1'])){
	$erreur['question1']=true;
	$check=false;
}else{
	$erreur['question1']=false;
}
}else{
	$erreur['question1']=false;
}
	

return $check;
}

//Fonction qui renvoie un tableau contenant les erreurs pour la page Inscription
function erreursIns(&$erreurs_format){
$erreurs = array();
if ($erreurs_format["mdp"]){
$erreurs["mdp"] = " * le mot de passe doit contenir au moins
 un chiffre et une majuscule, et doit faire au moins 6 caractères. * ";
}else{
	$erreurs["mdp"] = "";
}
	
 if ($erreurs_format["rmdp"]){
	 $erreurs["rmdp"] = " * Vos deux mots de passe doivent être identiques. * ";
 }else{
	 $erreurs["rmdp"] = "";
 }

  if ($erreurs_format["taille"]){
	 $erreurs["taille"] = " * Veuillez entrer une taille valide. * ";
	  }else{
	 $erreurs["taille"] = "";
	  }

   if ($erreurs_format["poids"]){
	 $erreurs["poids"] = " * Veuillez entrer un poids valide. * ";
   }else{
	 $erreurs["poids"] = "";
   }
return $erreurs;
}

//Fonction qui renvoie un tableau contenant les erreurs pour la page Complète_Profil
function erreursModif(&$erreurs_format){
$erreurs = array();
if ($erreurs_format["mdp"]){
$erreurs["mdp"] = " * le mot de passe doit contenir au moins
 un chiffre et une majuscule, et doit faire au moins 6 caractères. * ";
}else{
	$erreurs["mdp"] = "";
}

  if ($erreurs_format["taille"]){
	 $erreurs["taille"] = " * Veuillez entrer une taille valide. * ";
	  }else{
	 $erreurs["taille"] = "";
	  }

   if ($erreurs_format["poids"]){
	 $erreurs["poids"] = " * Veuillez entrer un poids valide. * ";
   }else{
	 $erreurs["poids"] = "";
   }
   
   if ($erreurs_format["question1"]){
	 $erreurs["question1"] = " * Veuillez entrer un âge valide * ";
   }else{
	 $erreurs["question1"] = "";
   }
return $erreurs;
}
//Fonction qui affiche une page de succès
function page_succes(&$donnees){
	echo '<div id="div1"><br><h2 id="succes">Bravo '.$donnees["pseudo"]."!</h2><h3> Votre inscription a été effectuée avec succès.<br>";
	echo 'Connectez vous <a href="Index.php?page=Connexion">ici</a> ! </h3><br></div>';
}
//Fonction qui réaffiche le formulaire d'inscription
function réafficherForm(&$donnees, &$erreurs){
	echo '        
        <h2>Créez un compte !</h2>
		<div id="div1">
		<br>
		<p class="align"><img src="images/logo.png" width="150" height="150"/></p>
		<p class="align">Déjà inscrit? Connectez-vous <a href="Index.php?page=Connexion">ici</a> !</p>
		<form method="post" action="index.php?page=Inscription">
            <p>
               
                <input type="text" name="pseudo" id="pseudo" value="'.$donnees['pseudo'].'" placeholder="Choisissez un pseudo" required/> <br> <span class="error">'.$erreurs['pseudo'].'</span>
            </p>
				<p>
                
                <input type="email" placeholder="Entrez votre e-mail" name="email" id="email" value="'.$donnees['email'].'"required/><br> <span class="error">'.$erreurs['email'].'</span>
            </p>
            <p>
               
                <input type="password" placeholder="Choisissez un mot de passe" name="mdp" id="mdp" required/> <br><span class="error">'.$erreurs['mdp'].'</span>
            </p>
            <p>
                
                <input type="password" placeholder="Confirmez votre mot de passe" name="rmdp" id="rmdp" required/> <br><span class="error">'.$erreurs['rmdp'].'</span>
            </p>
            <p>
                <label for="date">
                 <B>    Votre date de naissance</B>
                </label> : 
                <input type="date" name="date" id="date" value="'.$donnees['date'].'"required/>
            </p>
            <p>
                <label for="sexe">
                <B>     Votre sexe</B>
                </label> : 
                <select name="sexe" id="sexe">
                    <option value="Masculin">Masculin</option>
                    <option value="Feminin">Feminin</option>
                </select>
            </p>
			 <p>
               
			<Input type="text" placeholder="Votre taille (en cm)	"name = "taille" id="taille" value="'.$donnees['taille'].'"required/><br> <span class="error">'.$erreurs['taille'].'</span>
			</p>
			<p>
             
			<Input type="text" placeholder="Votre poids (en kg)" name = "poids" id="poids" value="'.$donnees['poids'].'" required/> <br><span class="error">'.$erreurs['poids'].'</span>
			</p>
			
             <p class="align">
            '.'<input type="'.'submit'.'" value='."S'inscrire"." name='submit' id='submit'></p>".'
			
        </form>
		<br>
		</div><br>';
	
	
	
}
//Fonction qui vérifie si un fichier est une image
function verifImage($image){
	$extExplode=explode('.',$image);
	$ext=strtolower(end($extExplode));
	if(in_array($ext,array('jpg','png','jpeg','gif'))){
		return true;
	}else{
		return false;
	}
}
		?>
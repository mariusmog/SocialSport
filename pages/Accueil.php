<!-- Page Accueil : Cette page affiche une barre de recherche permettant de trouver d'autres utilisateurs et une bulle permettant 
de poster une nouvelle publication pouvant contenir une image et du texte, et être publiée en privé. Elle affiche également un fil d'actualité avec 
toutes les publications des utilisateurs auquel l'utilisateur actif est abonné.
-->
<?php
	require('fonctions/fonctionsphp.php');
	require('fonctions/fonctionsmysql.php');
 if(isset($_SESSION['pseudo'])){
	if(isset($_POST['submitP'])){
	$DONNEES = $_POST;
		$DONNEES=traiterDonnees($DONNEES);
		$DONNEES=traiterDonnees_mysqli($connect,$DONNEES);
		$erreurs=array();
		$ok=true;
		if(strlen($DONNEES['description'])<500){
			$description=$DONNEES['description'];
			$erreurs['description']='';
		}else{
			$erreurs['description']='Votre publication doit faire moins de 500 caractères.';
			$ok=false;
		}
		if (isset($_FILES['image']['tmp_name'])&&strlen($_FILES['image']['tmp_name'])>1) {
        $retour = copy($_FILES['image']['tmp_name'],'images/'.$_FILES['image']['name']);
	}
		if(isset($_FILES['image']['name'])&&strlen($_FILES['image']['name'])>1){
			if(verifImage($_FILES['image']['name'])){
			$image=$_FILES['image']['name'];
			$erreurs['image']='';
			}else{
				$image='';
				$erreurs['image']='* Veuillez choisir une image valide. *';
				$ok=false;
				}
		}else{
			$image='';
			$erreurs['image']='';
		}
		if($ok){
		if(isset($DONNEES['privé'])){
			$privé=$DONNEES['privé'];
		}else{
			$privé=0;
		}
			nouvellePublication($connect,$description,$image,$privé);
			echo '<p class="align"><B>Votre publication a été publiée avec succès !</B></p>';
		}
	}		
	?>
	<div id="Rechercher">
	<form method="POST" action="index.php?page=Recherche">
		<p><input type='search' placeholder='Rechercher un utilisateur' name='search' id='search'>
	    <input type='submit' value="Rechercher" name='submitR' id='submitR'></p>
		</form>
	</div>

	<div id="div1">
	<div id="NewPost">
	<form method="POST" enctype="multipart/form-data" action="">
		<br>
	  <p class="align">
       
            <textarea rows='6' cols='30' name="description" id="description" placeholder="Nouvelle publication"></textarea>
			<?php if(isset($_POST['submitP'])&&strlen($erreurs['description'])>1){ echo '<br> <span class="error">'.$erreurs['description'].'</span>';}?>
			</p>
			<p class='align'>
		 <label for="image">
                   <B> image</B>
				   </label> :
                <input type='file' name='image' id='image'>
					<?php if(isset($_POST['submitP'])&&strlen($erreurs['image'])>1){ echo '<br><br> <span class="error">'.$erreurs['image'].'</span>';}?>
				</p>
				<p class='align'>
                <label for="privé">
                  <B>        publication privée</B>
                </label> : 
                <input type='checkbox' name='privé' id='privé' value=1>
            </p>
            <p class="align">
            <input type='submit' value="Publier" name='submitP' id='submitP'></p>
			<br>
        </form>   
	</div>
	</div><br>

	<?php
	
		affichePublicationsAccueil($connect,$_SESSION['id']);
		echo '<br>';
		}
		else{
		header('Location:index.php?page=Connexion');
		}
		
	?>

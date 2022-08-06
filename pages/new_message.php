<!-- Page new_message : On est redirigé vers cette page lorsqu'on clique sur le lien "Envoyer un message" sur le profil d'un autre utilisateur.
Cette page permet à l'utilisateur actif d'envoyer un message à l'utilisateur en question.
-->
<?php
if(isset($_SESSION['id'])){
require('fonctions/fonctionsphp.php');
require('fonctions/fonctionsmysql.php');
if(isset($_GET["pseudo"]) && !empty($_GET["pseudo"]) && pseudo_existant($connect,mysqli_real_escape_string($connect,htmlentities($_GET["pseudo"]))) === true){
    if(isset($_POST["submit"])){
        $sujet = mysqli_real_escape_string($connect,(trim(htmlentities($_POST["sujet"]))));
        $message = mysqli_real_escape_string($connect,(trim(htmlentities($_POST["message"]))));
        if(!empty($message) && !empty($sujet)){
            creer_conv($connect,$sujet,$message);
            ?>
                <div class="success">Votre message a bien été envoyé</div>
            <?php
        }
        else{
            ?>
            <div class="error">Le sujet et le message sont obligatoires</div>
            <?php
        }
    }
}
else{
    header("Location:index.php?page=Profil&pseudo=".$_SESSION['pseudo']);
}

?>

<div id="div1">
<h2>Envoyer un message</h2>
<form method="POST" action="">
<label for="a"> à : </label>
<input type="text" name="a" value="<?php echo $_GET["pseudo"]; ?>" disabled="disabled" id="a"><br/>
<label for="sujet">Sujet : </label>
<input type="text" name="sujet" id="sujet"><br/>
<label for="message">Votre message : </label>
<textarea name="message" id="message" cols="30" rows="6"></textarea><br/><br/>
<input type="submit" name="submit" value="Envoyer" id="submit">
</form>
<br>
</div>
<?php 
}else{
	 header("Location:index.php?page=Connexion");
}
?>
<!-- Page messages : On est redirigé vers cette page lorsqu'on clique sur l'objet d'un message sur la page Conversations.
Cette page affiche le message, l'objet du message, la date d'envoi du message ainsi que le pseudo de son utilisateur.
-->
<?php
if(isset($_SESSION['id'])){
require('fonctions/fonctionsphp.php');
require('fonctions/fonctionsmysql.php');

?>

<h2>Message</h2>

<?php

$messages = recup_msg($connect);
if($messages == true){
foreach($messages as $message){
    ?>
    <div id="div1">
    <div class="messages"><br>
    <p>Envoyé par : <a href="index.php?page=Profil&pseudo=<?php echo $message["pseudo"]; ?>"><?php echo $message["pseudo"]; ?></a>
    Le : <?php echo date('d/m/Y à H:i:s',strtotime($message["date_mess"])) ?></p>
    <p><?php echo $message["corps_mess"]; ?></p>
	<br>
    </div>
    </div>
    <?php
}
}
else{
    ?>
    <div class="error">Ce message n'existe pas.</div>
    <?php
}
}else{
	
	 header("Location:index.php?page=Connexion");
}

?>
<!-- Page Conversation : Cette page affiche une liste des messages reçus de l'utilisateur actif par d'autres utilisateurs.
lorsque l'utilisateur clique sur l'objet du message, il est redirigé vers une page affichant ce message.
-->
<?php
if(isset($_SESSION['id'])){
require('fonctions/fonctionsphp.php');
require('fonctions/fonctionsmysql.php');

?>

<h2>Messages</h2>

<?php

$conversations = recup_conv($connect);
if($conversations == true){
    foreach($conversations as $conversation){
        ?>
        <div id="div1">
		<p class='align' id='conversation'><a href="index.php?page=Profil&pseudo=<?php echo $conversation["pseudo"]; ?>"><?php echo $conversation["pseudo"]; ?></a></p>
        <img src="avatars/<?php echo $conversation["photo_de_profil"]; ?>" height="70px" width="70px" alt="">
        <p><a href="index.php?page=messages&id=<?php echo $conversation["id_conversation"]; ?>"><?php echo $conversation["sujet_conversation"]; ?></a></p>
        <p>Posté le : <?php echo date('d/m/Y à H:i:s',strtotime($conversation["date_mess"])); ?></p>
        </div>
        <?php
    }
}
else{
    ?>
    <div class="error">Vous n'avez pas de messages</div>
    <?php
}
}else{
    header("Location:index.php?page=Connexion");
}

?>
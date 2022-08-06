<!-- Page Deconnexion : Cette page détruit la session active et redirige vers la page de connexion.
-->
<?php
$_SESSION=array();
session_destroy();
header('Location:index.php?page=Connexion');
?>
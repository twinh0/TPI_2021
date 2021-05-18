<?php
session_start();
//On détruis et vide la session actuelle pour se déconnecter
session_destroy();
session_unset();
$_SESSION = array();
//On redirige directement l'utilisateur vers l'accueil
header("location: accueil.php");
?>
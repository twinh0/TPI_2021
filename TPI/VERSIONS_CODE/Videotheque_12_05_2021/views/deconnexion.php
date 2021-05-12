<?php
session_start();
$_SESSION = array();
header("location: accueil.php");
?>
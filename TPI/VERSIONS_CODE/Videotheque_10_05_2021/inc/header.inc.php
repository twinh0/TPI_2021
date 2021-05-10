<?php
function connexion(){
	$base = null;
	try{
	  $base = new PDO('mysql:host=localhost; dbname=videotheque', 'root', '');
	}
	catch(exception $e){
		die('Erreur'.$e->getMessage()); 
	}
	$base->exec("SET CHARACTER SET utf8");
	return($base);
}
?>
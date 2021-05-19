<?php
/*
* N'hamoucha Mehdi
* Travail pratique individuel : Site web "Vidéothèque" 
* Mai 2021
*/

//Import des constantes
require("./constantes.inc.php");

//Connection à la base de données
static $conn = null;
function getConnexion()
{
    global $conn;
    if ($conn == null) {
        //mdp secu
        $connectionString = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8";
        try {
            $conn = new PDO(
                $connectionString,
                DBUSER,
                DBPWD,
                [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("ERREUR PDO: " . $e->getMessage());
        }
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("SET CHARACTER SET utf8");
    }
    return $conn;
}

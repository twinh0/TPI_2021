<?php
//Import des constantes
require("../inc/constantes.inc.php");

static $conn = null;
function getConnexion()
{
    global $conn;
    if ($conn == null) {
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

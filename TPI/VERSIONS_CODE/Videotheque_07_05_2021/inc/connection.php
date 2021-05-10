<?php
//INFOS BDD
const DB_HOST = "localhost";
const DB_NAME = "videotheque";
const DB_USER = "root";
const DB_PASS = "";

static $conn = null;
function getConnexion()
{
    global $conn;
    if ($conn == null) {
        $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
        try {
            $conn = new PDO($connectionString,DB_USER,DB_PASS,[PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("ERREUR PDO: " . $e->getMessage());
        }
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("SET CHARACTER SET utf8");
    }
    return $conn;
}

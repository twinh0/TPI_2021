<?php
//Page contenant toutes les fonctions js nécessaires au fonctionnement du site avec la bdd

//INCLUSION DES CONSTANTES
require("../inc/constantes.inc.php");

//Connecteur à la base de donnée
//Si la connection n'est pas possible, le script meurt
function Videotheque()
{
    //dbc = database connection
    static $dbc = null;

    //Première visite de la fonction
    if ($dbc == null) {
        //Essaie le code ci-dessous
        try {
            $dbc = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBUSER, DBPWD, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_PERSISTENT => true
            ));
        }
        //Si une exception est arrivée
        catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            //Quitte le script et meurt
            die('Could not connect to MySQL');
        }
    }
    //Pas d'erreur, retourne un connecteur
    return $dbc;
}

//READ
function GetTable($nomTable)
{
    //Retourne le contenu de la table donnée en paramètre
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare("SELECT * FROM " . $nomTable);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}

//Va chercher un utilisateur selon son email
function GetUserByEmail($email)
{
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare("SELECT * FROM utilisateur WHERE email = '$email'");
    $requete->bindParam(":email", $email, PDO::PARAM_STR);
    $requete->execute();
    $user = $requete->fetchAll();
    var_dump($user);
    return $user;
}

//Va chercher un pseudo d'utilisateur selon son email
function GetPseudoByEmail($email)
{
    $sql = "SELECT pseudo FROM utilisateur WHERE email = '$email'";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(":email", $email, PDO::PARAM_STR);
    $requete->execute();
    $pseudo = $requete->fetchAll();
    return $pseudo;
}

function GetIdByEmail($email)
{
    $sql = "SELECT idUtilisateur FROM utilisateur WHERE email = '$email'";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(":email", $email, PDO::PARAM_STR);
    $requete->execute();
    $idutilisateur = $requete->fetchAll();
    return $idutilisateur;
}

//Permet de verifier les infos entrées dans le login en comparant avec celles des comptes existant 
function CompareLogin($password, $email)
{
    $user = GetUserByEmail($email);
    //on recupere les infos du user
    if (isset($user[0])) {
        if (password_verify($password, $user[0]["password"])) {
            return true;
        } else {
            return false;
        }
    }
}
//Pour verifier si un mail existe déjà
function Exists($email)
{
    $user = GetUserByEmail($email);
    if ($user != null) {
        return true;
    } else {
        return false;
    }
}

//CREATION UTILISATEUR
//Crée le user à inserer dans la base de données avec le mot de passe hashé
function CreateUser($pseudo, $password1, $email)
{
    //Chiffrage du mdp pour qu'il soit sécurisé en cas de fuite
    $password = password_hash($password1, PASSWORD_DEFAULT);
    //ps = Prepare statement 
    static $ps = null;
    if ($ps == null) {
        $ps = Videotheque()->prepare('INSERT INTO utilisateur VALUES (null,"' . $pseudo . '","' . $password . '","' . $email . '","0")');
    }
    $answer = false;
    try {
        $ps->bindParam(':PSEUDO', $pseudo, PDO::PARAM_STR);
        $ps->bindParam(':PASSWORD', $password, PDO::PARAM_STR);
        $ps->bindParam(':EMAIL', $email, PDO::PARAM_STR);

        $answer = $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}


//MODIFICATION UTILISATEUR
function UpdateUser($idutilisateur, $pseudo, $password, $email)
{
    //$ps 
    static $ps = null;
    $sql = "UPDATE `utilisateur` SET `pseudo` = :PSEUDO, `motDePasse` = :MOTDEPASSE, `email` = :EMAIL WHERE (`idUtilisateur` = :IDUTILISATEUR)";

    if ($ps == null) {
        $ps = Videotheque()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':PSEUDO', $pseudo, PDO::PARAM_STR);
        $ps->bindParam(':MOTDEPASSE', $password, PDO::PARAM_STR);
        $ps->bindParam(':EMAIL', $email, PDO::PARAM_STR);
        $ps->bindParam(':IDUTILISATEUR', $idutilisateur, PDO::PARAM_INT);

        $ps->execute();
        $answer = ($ps->rowCount() > 0);
        var_dump($ps);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

//CREATION CRITIQUE
//Fonction qui importe la critique dans la base de données
function InsertNewCritique($titre, $date, $contenu, $note)
{
    static $ps = null;

    if ($ps == null) {
        $ps = Videotheque()->prepare('INSERT INTO critique VALUES (null,"' . $titre . '","' . $date . '","' . $contenu . '","' . $note . '")');
    }
    $answer = false;
    try {
        $ps->bindParam(':TITRE', $titre, PDO::PARAM_STR);
        $ps->bindParam(':DATE', $date, PDO::PARAM_STR);
        $ps->bindParam(':CONTENU', $contenu, PDO::PARAM_STR);
        $ps->bindParam(':NOTE', $note, PDO::PARAM_INT);

        $answer = $ps->execute();
        var_dump($ps);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

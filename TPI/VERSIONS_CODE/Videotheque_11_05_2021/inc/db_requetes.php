<?php
//Page contenant toutes les requêtes js nécessaires au fonctionnement du site avec la bdd

//CONNEXION A LA BDD
//require("../inc/header.inc.php");
require("../inc/constantes.inc.php");

//Connecteur à la base de donnée
//Si la connection n'est pas possible, le script meurt
function videotheque()
{
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
        // Si une exception est arrivée
        catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            // Quitte le script et meurt
            die('Could not connect to MySQL');
        }
    }
    // Pas d'erreur, retourne un connecteur
    return $dbc;
}

//READ
function getTable($nomTable)
{
    //Retourne le contenu de la table donnée en paramètre
    videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = videotheque()->prepare("SELECT * FROM " . $nomTable);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
//Va chercher le password de l'utilisateur selon son email
function getPasswordByEmail($email)
{
    videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = videotheque()->prepare("SELECT motDePasse FROM utilisateur WHERE email = :email");
    $requete->bindParam(":email", $email, PDO::PARAM_STR);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
//Va chercher un utilisateur selon son email
function GetUserByEmail($email)
{
    videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = videotheque()->prepare("SELECT * FROM utilisateur WHERE email = '$email'");
    $requete->execute();
    $user = $requete->fetchAll();
    var_dump($user);
    return $user;
}
//Va chercher un pseudo d'utilisateur selon son email
function GetPseudoByEmail($email)
{
    videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = videotheque()->prepare("SELECT pseudo FROM utilisateur WHERE email = '$email'");
    $requete->execute();
    $userName = $requete->fetchAll();
    return $userName;
}
//Permet de verifier les infos entrées dans le login en comparant avec celles des comptes existant 
function compareLogin($password, $email)
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
function exists($email)
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
function createUser($pseudo, $password1, $email)
{
    //Chiffrage du mdp pour qu'il soit sécurisé en cas de fuite
    $password = password_hash($password1, PASSWORD_DEFAULT);

    static $poste = null;
    if ($poste == null) {
        $poste = videotheque()->prepare('INSERT INTO utilisateur VALUES (null,"' . $pseudo . '","' . $password . '","' . $email . '","0")');
    }
    $answer = false;
    try {
        $poste->bindParam(':PSEUDO', $pseudo, PDO::PARAM_STR);
        $poste->bindParam(':PASSWORD', $password, PDO::PARAM_STR);
        $poste->bindParam(':EMAIL', $email, PDO::PARAM_STR);

        $answer = $poste->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}
//MODIFICATION UTILISATEUR


//CREATION CRITIQUE
//Fonction qui importe la critique dans la base de données
function insertNewCritique($titre, $date, $contenu, $note)
{
    static $poste = null;
    if ($poste == null) {
        $poste = videotheque()->prepare('INSERT INTO critique VALUES (null,"' . $titre . '","' . $date . '","' . $contenu  . $note . '","0")');
    }
    $answer = false;
    try {
        $poste->bindParam(':TITRE', $titre, PDO::PARAM_STR);
        $poste->bindParam(':DATE', $date, PDO::PARAM_STR);
        $poste->bindParam(':CONTENU', $contenu, PDO::PARAM_STR);
        $poste->bindParam(':NOTE', $note, PDO::PARAM_INT);

        $answer = $poste->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

<?php
//Page contenant toutes les requêtes js nécessaires au fonctionnement du site avec la bdd

//CONNEXION A LA BDD
require("../inc/header.inc.php");

//READ
function getTable($nomTable)
{
    //Retourne le contenu de la table donnée en paramètre
    connexion()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = connexion()->prepare("SELECT * FROM " . $nomTable);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}

function getPasswordByEmail($email)
{
    //Va chercher le password de l'utilisateur selon son email
    connexion()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = connexion()->prepare("SELECT motDePasse FROM utilisateur WHERE email = :email");
    $requete->bindParam(":email", $email, PDO::PARAM_STR);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
//Va chercher un utilisateur selon son email
function GetUserByEmail($email)
{
    connexion()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = connexion()->prepare("SELECT * FROM utilisateur WHERE email = '$email'");
    $requete->execute();
    $user = $requete->fetchAll();
    var_dump($user);
    return $user;
}
//Va chercher un pseudo d'utilisateur selon son email
function GetPseudoByEmail($email)
{
    connexion()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = connexion()->prepare("SELECT pseudo FROM utilisateur WHERE email = '$email'");
    $requete->execute();
    $userName = $requete->fetchAll();
    return $userName;
}

//Permet de verifier les infos entrées dans 
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

//CREATION UTILISATEUR
//Fonction qui importe l'utilisateur (appelée dans la fonction createUser())
function insertNewUser($pseudo, $password, $email)
{
    connexion()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    //Ajoute un utilisateur avec id de base, son pseudo, son email, son mdp, et en admin (bool = 1)
    $poste = connexion()->prepare('INSERT INTO utilisateur VALUES (null,"' . $pseudo . '","' . $password . '","' . $email . '","0")');
    var_dump($poste);
    if ($poste->execute()) {
        return true;
    } else {
        return false;
    }
}

//Fonction hashant le mot de passe (sert surtout à être appelée dans la page login)
function passSha256($password)
{
    return hash('sha256', $password);
}

//Crée le user à inserer dans la base de données avec le mot de passe hashé
function createUser($pseudo, $password, $email)
{
    //Chiffrage du mdp pour qu'il soit sécurisé en cas de fuite
    $pass = password_hash($password, PASSWORD_DEFAULT);
    if (insertNewUser($pseudo, $pass, $email)) {
        return true;
    } else {
        return false;
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

//MODIFICATION UTILISATEUR


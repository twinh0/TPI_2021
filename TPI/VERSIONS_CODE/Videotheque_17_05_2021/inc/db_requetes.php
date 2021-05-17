<?php
/*
* N'hamoucha Mehdi
* Travail pratique individuel : Site web "Vidéothèque" 
* Mai 2021
*/

//Page contenant toutes les fonctions nécessaires au fonctionnement du site
//Variables sessions
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
    $_SESSION['idUtilisateur'] = null;
    $_SESSION['pseudo'] = null;
    $_SESSION['password'] = false;
    $_SESSION['email'] = false;
    $_SESSION['isAdmin'] = null;
}
//Inclustion des constantes
require("../inc/constantes.inc.php");

//Connecteur à la base de donnée
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

//Va chercher un utilisateur selon son email
function GetUserByEmail($email)
{
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $requete->bindParam(":email", $email, PDO::PARAM_STR);
    $requete->execute();
    $user = $requete->fetchAll();
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

//Récupère l'ID d'un utilisateur selon son mail
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

//Sert dans la page login pour savoir si un utilisateur est un admin ou non
function GetRoleByEmail($email)
{
    $sql = "SELECT admin FROM utilisateur WHERE email = '$email'";
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
        if (password_verify($password, $user[0]["motDePasse"])) {
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

//Crée le user à inserer dans la base de données avec le mot de passe hashé
function CreateUser($pseudo, $password1, $email)
{
    //Chiffrage du mdp pour qu'il soit sécurisé en cas de fuite
    $password = password_hash($password1, PASSWORD_DEFAULT);
    //ps = Prepare statement 
    static $ps = null;
    if ($ps == null) {
        $ps = Videotheque()->prepare('INSERT INTO utilisateur(pseudo, motDePasse, email, admin) VALUES(:pseudo, :motDePasse, :email, 0)');
    }
    $answer = false;
    try {
        $ps->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $ps->bindParam(':motDePasse', $password, PDO::PARAM_STR);
        $ps->bindParam(':email', $email, PDO::PARAM_STR);
        $answer = $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}


//Modifie toutes les infos d'un utilisateur
function UpdateUser($idutilisateur, $pseudo, $password, $email)
{
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    //$ps 
    static $ps = null;
    $sql = "UPDATE `utilisateur` SET `pseudo` = :PSEUDO, `motDePasse` = :MOTDEPASSE, `email` = :EMAIL WHERE (`idUtilisateur` = :IDUTILISATEUR)";

    if ($ps == null) {
        $ps = Videotheque()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':PSEUDO', $pseudo, PDO::PARAM_STR);
        $ps->bindParam(':MOTDEPASSE', $passwordHash, PDO::PARAM_STR);
        $ps->bindParam(':EMAIL', $email, PDO::PARAM_STR);
        $ps->bindParam(':IDUTILISATEUR', $idutilisateur, PDO::PARAM_INT);

        $ps->execute();
        $answer = ($ps->rowCount() > 0);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

//Fonction qui importe la critique dans la base de données
function InsertNewCritique($titre, $date, $contenu, $note, $idutilisateur)
{
    static $ps = null;

    if ($ps == null) {
        $ps = Videotheque()->prepare('INSERT INTO critique(dateCritique, contenu, note, estValide, idFilm, idUtilisateur) VALUES(:dateCritique, :contenu, :note, 0, :idFilm, :idUtilisateur)');
    }
    $answer = false;
    try {
        $ps->bindParam(':dateCritique', $date, PDO::PARAM_STR);
        $ps->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $ps->bindParam(':note', $note, PDO::PARAM_INT);
        $ps->bindParam(':idFilm', $titre, PDO::PARAM_INT);
        $ps->bindParam(':idUtilisateur', $idutilisateur, PDO::PARAM_INT);

        $answer = $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function GetAllFilms()
{
    static $ps = null;

    if ($ps == null) {
        $ps = Videotheque()->prepare('SELECT * FROM film');
    }
    $answer = false;
    try {
        $ps->execute();
        $answer = $ps->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function GetAllFilmsFilterByTitle($title, $methode)
{

    if ($methode == "") {
        $methode = 'titre';
    }
    static $ps = null;

    if ($ps == null) {

        $ps = Videotheque()->prepare('SELECT * FROM film WHERE titre LIKE :filtre ORDER BY ' . $methode);
    }
    $answer = false;
    try {
        $filtre = "%" . $title . "%";
        $ps->bindParam(':filtre', $filtre);
        $ps->execute();
        $answer = $ps->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}


function GetAllPendingPost()
{
    $sql = "SELECT * FROM critique WHERE estValide = 0";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->execute();
    $posts = $requete->fetchAll();
    return $posts;
}


function GetAllValidatePost()
{
    $sql = "SELECT * FROM critique WHERE estValide = 1";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->execute();
    $posts = $requete->fetchAll();
    return $posts;
}

function GetAllUserPost($idutilisateur)
{
    $sql = "SELECT * FROM critique WHERE idUtilisateur = :idUtilisateur";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(':idUtilisateur', $idutilisateur);
    $requete->execute();
    $posts = $requete->fetchAll();
    return $posts;
}



function GetFilmNameById($idFilm)
{
    $sql = "SELECT titre FROM film WHERE idFilm = :idFilm";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(":idFilm", $idFilm, PDO::PARAM_STR);
    $requete->execute();
    $idFilm = $requete->fetch();
    return $idFilm;
}


function GetFilmById($idFilm)
{
    $sql = "SELECT * FROM film WHERE idFilm = :idFilm";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(":idFilm", $idFilm, PDO::PARAM_STR);
    $requete->execute();
    $film = $requete->fetch();
    return $film;
}

function UpdateCritiqueStatement($idCritique, $statement)
{
    $sql = "UPDATE critique SET estValide = :etat WHERE idCritique = :idCritique";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(":etat", $statement, PDO::PARAM_STR);
    $requete->bindParam(":idCritique", $idCritique, PDO::PARAM_STR);
    $requete->execute();
}


function AddFilmToFavoris($idFilm, $idUtilisateur)
{
    $sql = "INSERT INTO marque(idUtilisateur, idFilm) VALUES(:idUtilisateur, :idFilm)";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(":idUtilisateur", $idUtilisateur);
    $requete->bindParam(":idFilm", $idFilm);
    $requete->execute();
}

function RemoveFilmFromFavoris($idFilm, $idUtilisateur)
{
    $sql = "DELETE FROM marque WHERE idUtilisateur = :idUtilisateur AND idFilm = :idFilm";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(":idUtilisateur", $idUtilisateur);
    $requete->bindParam(":idFilm", $idFilm);
    $requete->execute();
}




function GetAllUserFavoriteFilm($idUtilisateur)
{
    $sql = "SELECT * FROM marque WHERE idUtilisateur = :idUtilisateur";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(":idUtilisateur", $idUtilisateur);
    $requete->execute();
    $favoris = $requete->fetchAll();

    return $favoris;
}


function CheckIfFilmIsInFavoris($idUtilisateur, $idFilm)
{
    $sql = "SELECT * FROM marque WHERE idUtilisateur = :idUtilisateur";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(":idUtilisateur", $idUtilisateur);
    $requete->execute();
    $favoris = $requete->fetchAll();
    foreach ($favoris as $f) {
        if ($f['idFilm'] == $idFilm) {
            return true;
        }
    }
    return false;
}


function DeleteCritique($idCritique)
{
    $sql = "DELETE FROM critique WHERE idCritique = :idCritique";
    Videotheque()->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $requete = Videotheque()->prepare($sql);
    $requete->bindParam(":idCritique", $idCritique);
    $requete->execute();
}

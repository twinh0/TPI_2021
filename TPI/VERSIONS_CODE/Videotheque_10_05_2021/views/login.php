<?php
session_start();
require("../inc/db_requetes.php");
// EN-TÊTE/NAVBAR 
include_once("../inc/nav.php");

//On reset les champs
if (isset($_SESSION["pseudo"])) {
    if ($_SESSION["pseudo"] != "") {
        $pseudo = "";
    }
}
if (isset($_SESSION["password"])) {
    if ($_SESSION["password"] != "") {
        $password = "";
    }
}
if (isset($_SESSION["email"])) {
    if ($_SESSION["email"] != "") {
        $email = "";
    }
}
//On initialise le message qui changera selon l'erreur rencontrée
$message = "";

//On re-set les variables
$pseudo = "";
$password = "";
$email = "";

//On vérifie si un formulaire a été envoyé
if (isset($_POST["submitButton"])) {
    //Si oui, on filtre les variables
    //$pseudo = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $pseudo = GetPseudoByEmail($email);

    //On vérifie que les 2 champs soient remplis
    if ($password != "" && $email != "") {
        //Si oui, toutes les variables sont complètes et filtrées. On vérifie maintenant si les infos entrées existent dans la bdd
        //if (compareLogin($password, $email) != -1) {
        if (sizeof($password) != 0 && sizeof($pseudo) != 0 && sizeof($email) != 0) {
            $message .= "<div class='alert alert-success' role='alert'>Connexion réussie.</div>";
            $_SESSION["pseudo"] = $pseudo;
            $_SESSION["password"] = $password;
            $_SESSION["email"] = $email;
        } else {
            $message .= "<div class='alert alert-danger' role='alert'>Les identifiants sont incorrects. Si vous n'avez pas de compte, <a href='register.php' class='alert-link'>Inscrivez-vous ici</a></div>";
        }
    } else {
        //Si on n'a oublié de remplir un/des champs, une erreur est envoyée
        $message .= "<div class='alert alert-danger' role='alert'>Tout les champs du formulaire doivent être remplis.</div>";
    }
    echo $message;
}
?>

<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/style.css">
    <title>Login</title>
</head>

<body>
    <!-- FORMULAIRE D'INSCRIPTION -->
    <div class="border border-danger" style="margin-top: 100px; margin-left: 300px; margin-right:300px;">
        <!-- SOUS-TITRE -->
        <h3 class="text-center" style="padding-top: 30px;">Connection</h3>
        <div class="d-flex bd-highlight justify-content-center" style="padding:50px;">
            <form class="row g-3" method="post" action="#">
                <!-- <div>
                     CHAMP PSEUDO 
                    <label for="inputName4" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="username">
                </div> -->
                <div>
                    <!-- CHAMP MOT DE PASSE -->
                    <label for="inputPassword4" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div>
                    <!-- CHAMP EMAIL -->
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="votrenom@example.com" name="email">
                </div>
                <div>
                    <!-- BTN CONNECTION -->
                    <button type="submit" name="submitButton" class="btn btn-primary">Connection</button>
                </div>
            </form>
        </div>
        <!-- JAVASCRIPT ADDITIONNEL -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>

</html>
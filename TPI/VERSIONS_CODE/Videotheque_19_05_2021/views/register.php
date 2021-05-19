<?php
/*
* N'hamoucha Mehdi
* Travail pratique individuel : Site web "Vidéothèque" 
* Mai 2021
*/

//Page de register d'utilisateur
session_start();
require("../inc/db_requetes.php");
// EN-TÊTE/NAVBAR
include_once("../inc/nav.inc.php");

//On initialise le message qui changera selon l'erreur rencontrée
$message = "";
//On initialise les champs utilisateur
$pseudo = "";
$email = "";
$password1 = "";
$password2 = "";

//On vérifie si un formulaire a été envoyé
if (isset($_POST["submitButton"])) {
    //Si oui, on filtre les variables
    $pseudo = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_STRING);
    $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_STRING);

    //On vérifie que les 4 champs sont remplis
    if ($pseudo != "" && $email != "" && $password1 != "" && $password2 != "") {
        //Si oui, toutes les variables sont complètes et filtrées
        if ($password1 != $password2) {
            $message .= "<div class='alert alert-danger' role='alert'> Les deux mots de passes doivent être identiques! Mot de passe 1 : " . $password1 . ", Mot de passe 2 : " . $password2 . "</div>";
        } else {
            //Si l'email a déjà été enregistré dans la bdd, afficher message d'erreur
            if (Exists($email)) {
                $message .= "<div class='alert alert-success' role='alert'>Cet utilisateur existe déjà.</div>";
            } else {
                //Sinon, toutes les infos sont prêtes, on ajoute le nouvel utilisateur dans la bdd 
                if (CreateUser($pseudo, $password1, $email)) {
                    $message .= "<div class='alert alert-success' role='alert'>Inscription réussie. Redirection...</div>";
                    //On est redirigé vers l'accueil
                    header("Location: accueil.php");
                } else {
                    //Sinon, on renvois un message d'erreur
                    $message = "<div class='alert alert-danger' role='alert'>L'utilisateur n'as pas pu être créé.</div>";
                }
            }
        }
    } else {
        //Si on a pas rempli tous les champs, on nous le demande
        $message .= "<div class='alert alert-danger' role='alert'>Veuillez remplir tout les champs du formulaire.</div>";
    }
    //On envoie le message final
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
    <title>Register</title>
</head>

<body>
    <!-- FORMULAIRE D'INSCRIPTION -->
    <div class="border border-danger" style="margin-top: 100px; margin-left: 300px; margin-right:300px;">
        <!-- SOUS-TITRE -->
        <h3 class="text-center" style="padding-top: 30px;">Inscription</h3>
        <div class="d-flex bd-highlight justify-content-center" style="padding:50px;">
            <form class="row g-3" method="post" action="#">
                <div>
                    <!-- CHAMP NOM -->
                    <label for="inputName4" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div>
                    <!-- CHAMP EMAIL -->
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="votrenom@example.com" name="email">
                </div>
                <div>
                    <!-- CHAMP MOT DE PASSE -->
                    <label for="inputPassword4" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password1">
                </div>
                <div>
                    <!-- BTN CONFIRMATION MOT DE PASSE -->
                    <label for="inputPassword4" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" name="password2">
                </div>
                <div>
                    <!-- BTN INSCRIPTION -->
                    <button type="submit" name="submitButton" class="btn btn-primary">S'inscrire</button>
                    <a class="text-decoration-none" href="login.php">Déjà un compte ?</a>
                </div>
            </form>
        </div>
    </div>
    <!-- JAVASCRIPT ADDITIONNEL -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <?php
    include_once("../inc/footer.inc.php");
    ?>
</body>

</html>
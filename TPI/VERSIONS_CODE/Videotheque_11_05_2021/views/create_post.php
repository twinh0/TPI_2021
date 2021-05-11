<?php
session_start();
require("../inc/db_requetes.php");
//EN-TÊTE//NAVBAR
include_once("../inc/nav.php");

$message = "";
//On initialise les variables des champs du post
$titre = "";
$contenu = "";
$note = "";

//On vérifie si un formulaire a été envoyé
if (isset($_POST["submitButton"])) {
    //Si oui, on filtre les variables
    $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
    $contenu = filter_input(INPUT_POST, "contenu", FILTER_SANITIZE_STRING);
    $date = date("D.m.y");
    $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);

    //On vérifie que les 3 champs sont remplis
    if ($titre != "" && $contenu != "" && $note != "") {
        //Si oui, toutes les variables sont complètes et filtrées et on peut envoyer la critique à la vérification admin, date incluse.
        if (insertNewCritique($titre, $date, $contenu, $note)) {
            $message .= "<div class='alert alert-success' role='alert'>Critique envoyées. Un administrateur va vérifier votre critique avant de la valider.</div>";
        } else {
            $message = "<div class='alert alert-danger' role='alert'>La critique n'as pas pu être envoyée.</div>";
        }
    } else {
        $message .= "<div class='alert alert-danger' role='alert'>Veuillez remplir tout les champs du formulaire.</div>";
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
    <title>Créer un post</title>
</head>

<body>
    <!-- SOUS-TITRE -->
    <h1 class="text-center" style="padding-top: 50px;">Créer un post</h1>
    <!-- FORMULAIRE DE CREATION DE POST -->
    <div class="border border-danger" style="margin-top: 100px; margin-left: 300px; margin-right:300px;">
        <!-- SOUS-TITRE -->
        <h3 class="text-center" style="padding-top: 30px;">Veuillez entrer les informations du post</h3>
        <div class="d-flex bd-highlight justify-content-center" style="padding:50px;">
            <form class="row g-3" method="post" action="#">
                <div>
                    <!-- CHAMP NOM FILM -->
                    <label for="inputText4" class="form-label">Nom du film</label>
                    <select class="form-control" name="titre">
                        <option value="" disabled selected>Choisir un film...</option>
                        <option value="1">Fight Club</option>
                        <option value="2">Pulp Fiction</option>
                        <option value="3">Interstellar</option>
                        <option value="4">2001 : L'Odyssée de l'espace</option>
                        <option value="5">Parasite</option>
                    </select>
                </div>
                <div>
                    <!-- CHAMP TEXTE CRITIQUE -->
                    <label for="inputText4" class="form-label">Texte de la critique</label>
                    <input placeholder="Rédiger une critique..." type="text" class="form-control" name="contenu">
                </div>
                <div>
                    <!-- CHAMP NOTE -->
                    <label for="inputEmail4" class="form-label">Note</label>
                    <select class="form-control" placeholder="Choisir une note..." name="note">
                        <option value="" disabled selected>Choisir une note...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div>
                    <!-- BTN SUBMIT POST -->
                    <button type="submit" name="submitButton" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>

        <!-- JAVASCRIPT ADDITIONNEL -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>

</html>
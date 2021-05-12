<?php
session_start();
require("../inc/db_requetes.php");
//EN-TÊTE//NAVBAR
include_once("../inc/nav.inc.php");
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
    <title>Accueil</title>
</head>

<body>
    <!-- SOUS-TITRE -->
    <h1 class="text-center" style="padding-top: 50px;">Accueil</h1>
    <!-- TEXTE EXPLICATIF -->
    <p class="text-center" style="padding-top: 20px;">
        Le site Vidéothèque permet aux utilisateurs de créer un compte, se connecter et pouvoir partager leurs opinions sur leurs films favoris.
        </br> </br>
        Rendez-vous sur la page <b>"Login/Register"</b> de l'onglet <b>"Compte"</b> pour vous enregistrer si ce n'est pas déjà le cas.
    </p>
    <!-- JAVASCRIPT ADDITIONNEL -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <?php
    //include_once("../inc/footer.php");
    ?>

</body>

</html>
<?php
session_start();
require("../inc/db_requetes.php");
// EN-TÊTE/NAVBAR 
include_once("../inc/nav.php");
var_dump($_SESSION);

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
    <title>Profil</title>
</head>

<body>
    <!-- PROFIL -->
    <div class="border border-danger" style="margin-top: 100px; margin-left: 300px; margin-right:300px;">
        <!-- SOUS-TITRE -->
        <h3 class="text-center" style="padding-top: 30px;">Profil</h3>
        <div class="d-flex bd-highlight justify-content-center" style="padding:50px;">
            <form class="row g-3" method="post" action="#">
                <div>
                    <label for="inputName4" class="form-label">Nom : </label>
                    <label class="form-label" name="username"><?php $_SESSION["pseudo"]; ?></label>
                </div>
                <div>
                    <label for="inputEmail4" class="form-label">Email : </label>
                    <label class="form-label" name="username"><? $_SESSION["email"]; ?></label>
                </div>
                <div>
                    <label for="inputPassword4" class="form-label">Mot de passe : </label>
                    <label class="form-label" name="username"><? $_SESSION["password"]; ?></label>
                </div>
                <div>
                    <!-- BOUTON MODIFICATION USER -->
                    <button type="button" name="modifier" class="btn btn-primary">Modifier</button>
                </div>
            </form>

        </div>
        <!-- SOUS-TITRE -->


    </div>
    <div class="border border-danger" style="margin-top: 100px; margin-left: 300px; margin-right:300px;">
        <h3 class="text-center" style="padding-top: 50px;">Mes critiques</h3>
        <div class="d-flex bd-highlight justify-content-center" style="padding:50px;">


        </div>
    </div>
    <!-- JAVASCRIPT ADDITIONNEL -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>

</html>
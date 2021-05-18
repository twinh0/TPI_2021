<?php
/*
* N'hamoucha Mehdi
* Travail pratique individuel : Site web "Vidéothèque" 
* Mai 2021
*/

//Page de profil d'utilisateur où l'on peut voir et modifier ses informations, ses films ajoutés et ses critiques
session_start();
//INCLUSION DES FONCTIONS
require("../inc/db_requetes.php");
//EN-TÊTE/NAVBAR
include_once("../inc/nav.inc.php");


// on vérifie que l'utilisateur est connecté
if ($_SESSION['isConnected'] == false) {
    header('Location: accueil.php');
}

//On initialise le message qui changera selon l'erreur rencontrée
$message = "";
//On initialise les champs utilisateur
$pseudo = "";
$email = "";
$password = "";
$idUtilisateur = "";

//On vérifie si un formulaire a été envoyé
if (isset($_POST["submitButton"])) {
    //Si oui, on filtre les variables
    $pseudo = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);


    $idUtilisateur = GetIdByEmail($email);
    //On vérifie que les 3 champs sont remplis
    if ($pseudo != "" && $email != "" && $password != "") {
        //Si oui, toutes les variables sont complètes et filtrées et on peut modifier les 3 infos de l'utilisateur.
        if (UpdateUser($_SESSION['idUtilisateur'], $pseudo, $password, $email)) {
            $_SESSION["pseudo"] = $pseudo;
            $_SESSION["password"] = $password;
            $_SESSION["email"] = $email;
            $message .= "<div class='alert alert-success' role='alert'>Profil modifié avec succès.</div>";
        } else {
            $message = "<div class='alert alert-danger' role='alert'>Le profil n'a pas pu être modifié.</div>";
        }
    } else {
        $message .= "<div class='alert alert-danger' role='alert'>Veuillez remplir tout les champs du formulaire de modification.</div>";
    }
    echo $message;
}

if (filter_input(INPUT_GET, 'favoris') != null) {
    RemoveFilmFromFavoris(filter_input(INPUT_GET, 'idFilm'), $_SESSION['idUtilisateur']);
    header('Location: profil.php');
}

if (filter_input(INPUT_GET, 'idCritique') != null) {
    DeleteCritique(filter_input(INPUT_GET, 'idCritique'));
    header('Location: profil.php');
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
    <title>Profil</title>
</head>

<body>
    <!-- PROFIL -->
    <div class="border border-danger" style="margin-top: 5%; margin-left: 20%; margin-right:20%;">
        <!-- SOUS-TITRE -->
        <h3 class="text-center" style="padding-top: 2%;">Profil</h3>
        <div class="d-flex bd-highlight justify-content-center" style="padding:3%;">
            <form class="row g-3" method="post" action="#">
                <div>
                    <label for="inputName4" class="form-label">Nom</label>
                    <input type="text" class="form-control" placeholder="<?php echo ($_SESSION["pseudo"]) ?>" name="username">
                </div>
                <div>
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="<?php echo ($_SESSION["email"]) ?>" name="email">
                </div>
                <div>
                    <label for="inputPassword4" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" placeholder="<?php echo ($_SESSION["password"]) ?>" name="password">
                </div>
                <div>
                    <!-- BOUTON MODIFICATION USER -->
                    <button type="submit" name="submitButton" class="btn btn-primary">Modifier</button>
                </div>
            </form>

        </div>
    </div>
    <div class="border border-danger" style="margin-top: 5%; margin-left: 20%; margin-right:20%; max-height: 700px; overflow-y: auto; overflow-x: hidden;">
        <!-- SOUS-TITRE -->
        <h3 class="text-center" style="padding-top: 2%;">Ma vidéothèque</h3>
        <div class="row d-flex bd-highlight justify-content-center" style="padding:3%;">
            <?php
            $favoris = GetAllUserFavoriteFilm($_SESSION['idUtilisateur']);
            foreach ($favoris as $f) {
                $film = GetFilmById($f['idFilm']);
            ?>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="../<?= $film['image'] ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= $film['titre'] ?></h5><br>
                            <a href="profil.php?favoris=2&idFilm=<?= $film['idFilm'] ?>" class="btn btn-danger" style="width: 100%;">Retirer des favoris</a>
                        </div>
                    </div>
                </div>
            <?php

            }

            ?>

        </div>
    </div>

    <div class="border border-danger" style="margin-top: 5%; margin-left: 20%; margin-bottom:10%; margin-right:20%;">
        <!-- SOUS-TITRE -->
        <h3 class="text-center" style="padding-top: 2%;">Mes critiques</h3>
        <div class="d-flex bd-highlight justify-content-center" style="padding:3%;">
            <table class="table table-sm table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Film</th>
                        <th scope="col">note</th>
                        <th scope="col">Critique</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //On récupère l'id de notre utilisateur pour afficher les posts correspondant à ce dernier
                    $posts = GetAllUserPost($_SESSION['idUtilisateur']);
                    foreach ($posts as $p) {
                    ?>
                        <tr class="table-light">
                            <td><?= $p['dateCritique'] ?></td>
                            <td><?= GetFilmNameById($p['idFilm'])[0] ?></td>
                            <td><?= $p['note'] ?></td>
                            <td><?= $p['contenu'] ?></td>
                            <td>
                                <?php
                                switch ($p['estValide']) {
                                    case '0':
                                        echo 'En cours de validation';
                                        break;
                                    case '1':
                                        echo 'Accepté';
                                        break;
                                    case '2':
                                        echo 'Refusé';
                                        break;
                                }
                                ?>
                            </td>
                            <td style="width:25%;">
                                <?php
                                //Si le post a été accepté, on peut le modifier, sinon non
                                if ($p['estValide'] != '2') {
                                ?>
                                    <a class="btn btn-warning" style="width: 47%;" href="modifier_post.php?idCritique=<?= $p['idCritique'] ?>">Modifier</a>
                                <?php
                                }
                                ?>
                                <a class="btn btn-danger" style="width: 47%;" href="profil.php?idCritique=<?= $p['idCritique'] ?>">Effacer</a>
                            </td>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
            </table>
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
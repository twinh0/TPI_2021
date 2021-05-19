<?php
/*
* N'hamoucha Mehdi
* Travail pratique individuel : Site web "Vidéothèque" 
* Mai 2021
*/

//Page qui affiche toutes les informations d'un film, personalisée selon ce dernier
session_start();
require("../inc/db_requetes.php");
//EN-TÊTE//NAVBAR
include_once("../inc/nav.inc.php");

$idFilm = filter_input(INPUT_GET, 'idFilm');

if ($idFilm == null) {
    header('Location: forum.php');
}
//On récupere l'id du film sur lequel on a cliqué
$film = GetFilmById($idFilm);

//Si le btn favoris est cliqué : 
if (filter_input(INPUT_GET, 'favoris') != null) {
    //Si le champs favoris = 1, le film n'est pas en favoris alors on l'y met 
    if (filter_input(INPUT_GET, 'favoris') == 1) {
        AddFilmToFavoris($idFilm, $_SESSION['idUtilisateur']);
    }
    //Si le champs favoris = 2, le film est en favoris alors on l'y enlève
    if (filter_input(INPUT_GET, 'favoris') == 2) {
        RemoveFilmFromFavoris($idFilm, $_SESSION['idUtilisateur']);
    }
    //Refresh la page info pour afficher le btn favoris update
    header('Location: details_film.php?idFilm=' . $idFilm);
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>Accueil</title>
</head>

<body>
    <div class="container" style="width: 100%; margin:auto;">
        <!-- SOUS-TITRE -->
        <h1 class="text-center" style="padding-top: 50px;">Détails du film</h1>

        <!-- TABLEAU D'INFORMATIONS -->
        <div class="row" style="size: 100%;">

            <!-- COLONNE AFFICHE + BOUTON FAV -->
            <div class="col-4" style="width: 30%;">
                <img src="../<?= $film['image'] ?>" alt="Affiche du film" width="100%">
                <?php
                //Si on est connecté le bouton favoris apparaît, sinon non
                if ($_SESSION['isConnected'] == true) {
                ?>
                    <!-- Bouton ajouter en forme d'étoile -->
                    <div>
                        <a class="btn btn-success" style="width: 45%; padding:5%; margin: 2%;" href="create_post.php?idFilm=<?= $idFilm ?>">Créer une critique</a>
                        <?php
                        //Si le film est déjà dans les favoris de l'utilisateur, le bouton sert à l'enlever. Sinon, il permet de l'y ajouter. 
                        if (CheckIfFilmIsInFavoris($_SESSION['idUtilisateur'], $idFilm)) {
                        ?>
                            <!-- Bouton retirer en forme d'étoile -->
                            <a class="btn btn-danger" style="width: 35%; padding:5%; margin: 2%;" href="details_film.php?idFilm=<?= $film['idFilm'] ?>&favoris=2">
                                <i class="fas fa-star"></i>
                            </a>
                        <?php
                        } else {
                        ?>
                            <!-- Bouton ajouter en forme d'étoile -->
                            <a class="btn btn-primary" style="width: 35%; padding:5%; margin: 2%;" href="details_film.php?idFilm=<?= $film['idFilm'] ?>&favoris=1">
                                <i class="fas fa-star"></i>
                            </a>
                    </div>
            <?php
                        }
                    }
            ?>
            </div>

            <!-- COLONNE SYNOPSIS + TABLEAU D'INFOS + CRITIQUES -->
            <div class="col-8">
                <!-- TABLEAU AFFICHANT LES INFORMATIONS DU FILM -->
                <div>
                    <!-- SYNOPSIS -->
                    <h3 class="text-center" style="padding-top: 50px;">Synopsis</h3>
                    <p><?= $film['synopsis'] ?></p>
                </div>
                <table class="table table-sm table-dark table-hover">
                    <!-- CHAMPS -->
                    <thead>
                        <tr>
                            <th scope="col">Nom du film</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Date de sortie</th>
                            <th scope="col">Durée</th>
                            <th scope="col">Producteur</th>
                            <th scope="col">Scénariste</th>
                            <th scope="col">Acteur principal</th>
                        </tr>
                    </thead>
                    <!-- DONNÉES -->
                    <tbody>
                        <tr class="table-light">
                            <th><?= $film['titre'] ?></td>
                            <td><?= $film['genre'] ?></td>
                            <td><?= $film['sortie'] ?></td>
                            <td><?= $film['duree'] ?> minutes</td>
                            <td><?= $film['producteur'] ?></td>
                            <td><?= $film['scenariste'] ?></td>
                            <td><?= $film['acteurPrincipal'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <!-- CRITIQUES SUR LE FILM -->
                <h3 class="text-center" style="padding-top: 50px;">Critiques</h3>
                <table class="table table-sm table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Date du post</th>
                            <th scope="col">Film</th>
                            <th scope="col">Note</th>
                            <th scope="col">Critique</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Pour chaque critique de film, si les films correspondent au film de la page sur laquelle on est, on affiche cette critique
                        $posts = GetAllValidatePost();
                        foreach ($posts as $p) {
                            if ($p['idFilm'] == $idFilm) {
                        ?>
                                <tr class="table-light">
                                    <td><?= $p['dateCritique'] ?></td>
                                    <td><a class="text-primary text-decoration-none" href="details_film.php?idFilm=<?= $p['idFilm'] ?>"> <?= GetFilmNameById($p['idFilm'])[0] ?></a></td>
                                    <td><?= $p['note'] ?></td>
                                    <td><?= $p['contenu'] ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- JAVASCRIPT ADDITIONNEL -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <?php
    //include_once("../inc/footer.php");
    ?>
    <?php
    include_once("../inc/footer.inc.php");
    ?>
</body>

</html>
<?php
/*
* N'hamoucha Mehdi
* Travail pratique individuel : Site web "Vidéothèque" 
* Mai 2021
*/

//Page qui affiche les films. Recherche avec critères de tri possible.
session_start();
require("../inc/db_requetes.php");
//EN-TÊTE//NAVBAR
include_once("../inc/nav.inc.php");

if (filter_input(INPUT_GET, 'favoris') != null) {
    $idFilm = filter_input(INPUT_GET, 'idFilm');
    // si favoris = 1 : met le film en favoris
    if (filter_input(INPUT_GET, 'favoris') == 1) {
        AddFilmToFavoris($idFilm, $_SESSION['idUtilisateur']);
    }

    if (filter_input(INPUT_GET, 'favoris') == 2) {
        RemoveFilmFromFavoris($idFilm, $_SESSION['idUtilisateur']);
    }
    header('Location: films.php');
}

$methodeTri = "";
$nomTri = "";
if (filter_input(INPUT_POST, 'subimt') != null) {
    $nomTri = filter_input(INPUT_POST, 'nomTri', FILTER_SANITIZE_STRING);
    $methodeTri = filter_input(INPUT_POST, 'metodeTri');
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
    <title>Forum</title>
</head>

<body style="margin-bottom: 50px;">
    <div class="container">
        <!-- SOUS-TITRE -->
        <h1 class="text-center" style="padding-top: 50px;">Liste des films</h1>
        <div class="d-flex bd-highlight justify-content-center">
            <form action="#" method="post" id="frmTri">
                <select name="metodeTri">
                    <!-- SELECTEUR DE CRITERE DE TRI -->
                    <option value="titre" <?= $methodeTri == "titre" ? "selected" : "" ?>>Titre croissant</option>
                    <option value="titre DESC" <?= $methodeTri == "titre DESC" ? "selected" : "" ?>>Titre décroissant</option>
                    <option value="producteur" <?= $methodeTri == "producteur" ? "selected" : "" ?>>Producteur croissant</option>
                    <option value="producteur DESC" <?= $methodeTri == "producteur DESC" ? "selected" : "" ?>>Producteur décroissant</option>
                    <option value="scenariste" <?= $methodeTri == "scenariste" ? "selected" : "" ?>>Scénariste croissant</option>
                    <option value="scenariste DESC" <?= $methodeTri == "scenariste DESC" ? "selected" : "" ?>>Scénariste décroissant</option>
                    <option value="acteurPrincipal" <?= $methodeTri == "acteurPrincipal" ? "selected" : "" ?>>Acteur principal croissant</option>
                    <option value="acteurPrincipal DESC" <?= $methodeTri == "acteurPrincipal DESC" ? "selected" : "" ?>>Acteur principal décroissant</option>
                    <option value="genre" <?= $methodeTri == "genre" ? "selected" : "" ?>>Genre croissant</option>
                    <option value="genre DESC" <?= $methodeTri == "genre DESC" ? "selected" : "" ?>>Genre décroissant</option>
                </select>
                <input type="text" class="form-group" name="nomTri" value="<?= $nomTri ?>" placeholder="Entrez le nom du titre">
                <input type="submit" value="Rechercher" name="subimt">
            </form>
        </div>
        <div class="row">
            <?php
            //On récupère tous les films et on les filtre selon leur titre
            $films = GetAllFilmsFilterByTitle($nomTri, $methodeTri);
            //On les affiche sous forme de carte avec : leur affiche, un bouton qui redirige vers leur page info et un bouton qui permet de les ajouter/retirer directement en favoris
            foreach ($films as $f) {
            ?>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="../<?= $f['image'] ?>" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= $f['titre'] ?></h5><br>
                            <p class="card-text">Genre : <?= $f['genre'] ?></p>

                            <a href="details_film.php?idFilm=<?= $f['idFilm'] ?>" class="btn btn-success" style="width: 60%;">Voir les détails</a>
                            <?php
                            //Si on est connecté le bouton favoris apparaît, sinon non
                            if ($_SESSION['isConnected'] == true) {
                                if (CheckIfFilmIsInFavoris($_SESSION['idUtilisateur'], $f['idFilm'])) {
                            ?>
                                    <a href="films.php?idFilm=<?= $f['idFilm'] ?>&favoris=2" class="btn btn-danger" style="width: 35%; float: right;">Retirer</a>
                                <?php
                                } else {
                                ?>
                                    <a href="films.php?idFilm=<?= $f['idFilm'] ?>&favoris=1" class="btn btn-primary" style="width: 35%; float: right;">Ajouter</a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
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
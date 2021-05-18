<?php
session_start();
require("../inc/db_requetes.php");
//EN-TÊTE//NAVBAR
include_once("../inc/nav.inc.php");

//Si le post est validé par un admin, il est update puis affiché sur la page 
if (filter_input(INPUT_GET, 'accept') != null) {
    UpdateCritiqueStatement(filter_input(INPUT_GET, 'accept'), 1);
    header('Location: forum.php');
}
//Sinon, il est refusé et pas affiché
if (filter_input(INPUT_GET, 'deny') != null) {
    UpdateCritiqueStatement(filter_input(INPUT_GET, 'deny'), 2);
    header('Location: forum.php');
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

<body>
    <div class="container">
        <!-- SOUS-TITRE -->
        <h1 class="text-center" style="padding-top: 50px;">Forum</h1>

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
                //On récupère tous les posts validés par un admin
                $posts = GetAllValidatePost();
                foreach ($posts as $p) {
                ?>
                    <tr class="table-light">
                        <td><?= $p['dateCritique'] ?></td>
                        <td><a class="text-primary text-decoration-none" href="details_film.php?idFilm=<?= $p['idFilm'] ?>"> <?= GetFilmNameById($p['idFilm'])[0] ?></a></td>
                        <td><?= $p['note'] ?></td>
                        <td><?= $p['contenu'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <?php
        if ($_SESSION['isAdmin'] == 1) {
        ?>
            <h2 class="text-center" style="padding-top: 50px;">Posts en attente</h2>
            <table class="table table-sm table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">Date du post</th>
                        <th scope="col">Film</th>
                        <th scope="col">Note</th>
                        <th scope="col">Critique</th>
                        <th scope="col">Statut</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $posts = GetAllPendingPost();
                    foreach ($posts as $p) {
                    //On récupère tous les posts en attente de vérification et on les affiche pour les admins pour qu'ils puissent les vérifier
                    ?>
                        <tr class="table-light">
                            <td><?= $p['dateCritique'] ?></td>
                            <td><a href="details_film.php?idFilm=<?= $p['idFilm'] ?>"><?= GetFilmNameById($p['idFilm'])[0] ?></a></td>
                            <td><?= $p['note'] ?></td>
                            <td><?= $p['contenu'] ?></td>
                            <td>
                                <a class="btn btn-success" href="forum.php?accept=<?= $p['idCritique'] ?>">Accepter</a>
                                <a class="btn btn-danger" href="forum.php?deny=<?= $p['idCritique'] ?>">Refuser</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>

        <?php
        }
        ?>
    </div>

    <!-- JAVASCRIPT ADDITIONNEL -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <?php
    include_once("../inc/footer.inc.php");
    ?>
</body>

</html>
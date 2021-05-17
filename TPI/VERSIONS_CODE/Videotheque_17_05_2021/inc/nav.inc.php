<?php
/*
* N'hamoucha Mehdi
* Travail pratique individuel : Site web "Vidéothèque" 
* Mai 2021
*/

//Barre de navigation inclue dans chaque page
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
        <a class="navbar-brand" href="../views/accueil.php">
            <img src="https://raw.githubusercontent.com/twinh0/TPI_2021/main/TPI/DOCUMENTATION/RESSOURCES/LOGO_V2.png" alt="" width="30" height="30" class="d-inline-block align-text-bottom">
            Vidéothèque
        </a>
        <!-- ONGLETS CLICKABLES -->
        <div class="d-flex navbar-nav" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" aria-current="page" href="../views/accueil.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Forum
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="../views/forum.php">Voir posts</a></li>
                        <?php
                        //L'onglet créer post s'affiche uniquement si l'on est connecté
                        if ($_SESSION["isConnected"] == true) {
                            echo '<li><a class="dropdown-item" href="../views/create_post.php">Créer post</a></li>';
                        }
                        ?>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <li class="nav-item dropdown">
                    <a class="nav-link" aria-current="page" href="../views/films.php">Liste des films</a>
                </li>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Compte
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <?php
                        if ($_SESSION["isConnected"] == false) {
                            echo '<li><a class="dropdown-item" href="../views/register.php">Log In/Out</a></li>';
                        }
                        ?>

                        <?php
                        //L'onglet profil s'affiche uniquement si l'on est connecté
                        if ($_SESSION["isConnected"] == true) {
                                echo '<li><a class="dropdown-item" href="../views/profil.php">Profil</a></li>';
                            }
                        ?>
                    </ul>
                </li>
                <?php
                //L'onglet déconnexion s'affiche uniquement si l'on est connecté
                if ($_SESSION["isConnected"] == true) {
                        echo '<li class="nav-item dropdown">';
                        echo '<a class="nav-link" aria-current="page" href="../views/deconnexion.php">Déconnexion</a>';
                        echo '</li>';
                }
                ?>

        </div>
</nav>
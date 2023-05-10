<?php
session_start();
require_once 'autoload.php';
require_once 'config.inc.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="./Styles/bootstrap.css">
    <link rel="stylesheet" href="./Styles/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark" data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'monteur') {
                        echo "Montage d'ordinateur"; 
                    } elseif (isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') { 
                        echo "Conception d'ordinateur";
                    } else { 
                        echo "CLDL"; 
                    } ?>
                    </a>
                    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">
                                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'monteur') {
                        echo "Liste des modèles"; 
                    } elseif (isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') { 
                        echo "Statistiques";
                    }  ?> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="?page=concepteur/listComposant">
                                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'monteur') {
                        echo "Liste des composants"; 
                    } elseif (isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') { 
                        echo "Ajout pièces";
                    }?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="?page=concepteur/createModele">
                                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') { 
                        echo "Créa/Modif modèle";
                    }?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="?page=concepteur/listModeleConcepteur">
                                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') { 
                        echo "Liste modèle";
                    }?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'monteur') {
                        echo "Commentaires "; 
                    } elseif (isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') { 
                        echo "Stock";
                    }  ?>
                                </a>
                            </li>
                            <?php
                            if (isset($_SESSION['nom'])) {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="?page=commun/login">
                                        <?php echo $_SESSION['nom']; ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="?page=commun/logout">Deconnexion</a>
                                </li>

                                <?php
                            } else {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="?page=commun/login">Connexion</a>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="?page=commun/inscription">S'inscrire</a>
                            </li>
                                <?php
                            } ?>
                        </ul>

                    </div>
                </div>
            </nav>
        <?php
        if (isset($_GET['login']) && $_GET['login'] == "success") {
            ?>
            <div class="alert alert-success" role="alert">
                Vous êtes connecté !
            </div>
        <?php
        }
        if (isset($_GET['logout']) && $_GET['logout'] == "success") {
            ?>
            <div class="alert alert-success" role="alert">
            Vous êtes deconnecté !
            </div>
        <?php
        }
        ?>
    </header>
</body>
</html>
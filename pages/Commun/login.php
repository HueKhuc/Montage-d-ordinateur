<?php

        $pageTitle = "Connexion";


        $loginErrors = [];



        if (isset($_POST["nom"]) && isset($_POST["password"])) {
            $password = $_POST["password"];
            $nom = $_POST["nom"];
            $subStatement = $db->prepare('SELECT password FROM utilisateur WHERE nom= :nom');
            $subStatement->execute([
                ':nom' => $nom,
            ]);
            $passwordBdd = $subStatement->fetch(PDO::FETCH_COLUMN);

            if (empty($password)) {
                $loginErrors[] = "Veuillez saisir un mot de passe";
            } elseif (password_verify($password, $passwordBdd) === false) {
                $loginErrors[] = "Mot de passe incorrect";
            }

            if (empty($nom)) {
                $loginErrors[] = "Veuillez saisir un nom";
            }

            if (empty($loginErrors) && password_verify($password, $passwordBdd) == true) {
                $_SESSION["nom"] = $_POST["nom"];
                header("Location: index.php?page=commun/home&loginSuccess=1");
            }
            foreach ($loginErrors as $loginError) {
        ?>
                <div class="d-flex justify-content-center alert alert-danger" role="alert">
                    <?= $loginError; ?>
                </div>
            <?php
            }
            ?>

        <?php
        }

        ?>

    <div class="container-fluid">
        <div class="row d-flex justify-content-center mt-5 mb-5">
            <form class="" action="" method="post">
                <div class="form-group m-5">
                    <label for="nom">Nom</label>
                    <input type="text" class="textCenter form-control" id="nom" name="nom" placeholder="gerard545">
                    
                </div>
                <div class="resize form-group m-5">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input type="password" class="textCenter form-control" id="password" name="password" placeholder="Entrer mot de passe">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Connexion</button>
                </div>


            </form>
        </div>
        


    </div>
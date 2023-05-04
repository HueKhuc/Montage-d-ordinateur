<?php

        $pageTitle = "Connexion";

        var_dump($_POST);
        $loginErrors = [];



        if (isset($_POST["nom"]) && isset($_POST["password"])) {
            $password = $_POST["password"];
            $nom = $_POST["nom"];
            $subStatement = $db->prepare('SELECT 
                utilisateur.password,
                utilisateur.Id_Utilisateur AS IdU,
                concepteur.Id_Utilisateur AS IdC,
                monteur.Id_Utilisateur AS IdM
                FROM utilisateur
                LEFT JOIN concepteur ON utilisateur.Id_Utilisateur = concepteur.Id_Utilisateur
                LEFT JOIN monteur ON utilisateur.Id_Utilisateur = monteur.Id_Utilisateur
                WHERE nom = :nom'
        );
            $subStatement->execute([
                ':nom' => $nom,
            ]);
            $results = $subStatement->fetch();
            $passwordBdd = $results['password'];
            
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
                $_SESSION["id"] = $results['IdU'];
                $_SESSION['type'] = 'utilisateur';
                if ($results['IdC'] != null) {
                    $_SESSION["type"] = "concepteur";
                } elseif ($results['IdM'] != null) {
                    $_SESSION["type"] = "monteur";
                }
                header("Location: index.php?page=commun/home&login=success");
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
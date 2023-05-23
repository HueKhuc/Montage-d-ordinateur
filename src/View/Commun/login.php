<?php



    foreach ($loginErrors as $loginError) {
        ?>
        <div class="d-flex justify-content-center alert alert-danger" role="alert">
            <?= $loginError; ?>
        </div>
        <?php
    }

?>

<!-- Formulaire de connexion -->
<div class="container-fluid">
    <div class="row d-flex justify-content-center mt-5 mb-5">
        <form class="" action="" method="post">
            <div class="form-group m-5">
                <label for="nom">Identifiant</label>
                <input type="text" class="textCenter form-control" id="nom" name="nom" placeholder="Votre identifiant">
            </div>
            <div class="resize form-group m-5">
                <label for="exampleInputmotDePasse1">Mot de passe</label>
                <input type="password" class="textCenter form-control" id="motDePasse" name="motDePasse"
                    placeholder="Votre mot de passe">
            </div>

<!-- Bouton de validation de la connexion -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
        </form>
    </div>
</div>
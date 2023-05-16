<?php
$loginErrors = [];

// Récupération et comparaison des données POST avec la BDD
if (isset($_POST["nom"]) && isset($_POST["motDePasse"])) {
    $motDePasse = $_POST["motDePasse"];
    $nom = $_POST["nom"];
    $subStatement = $db->prepare('SELECT 
                utilisateur.motDePasse,
                utilisateur.idUtilisateur AS IdU,
                concepteur.idUtilisateur AS IdC,
                monteur.idUtilisateur AS IdM
                FROM utilisateur
                LEFT JOIN concepteur ON utilisateur.idUtilisateur = concepteur.idUtilisateur
                LEFT JOIN monteur ON utilisateur.idUtilisateur = monteur.idUtilisateur
                WHERE nom = :nom'
    );
    $subStatement->execute([':nom' => $nom]);
    $results = $subStatement->fetch();
    $motDePasseBdd = $results['motDePasse'];

    // Gestion des cas d'erreurs possibles
    if (empty($motDePasse)) {
        $loginErrors[] = "Veuillez saisir un mot de passe";
    } elseif (password_verify($motDePasse, $motDePasseBdd) === false) {
        $loginErrors[] = "Mot de passe incorrect";
    }

    if (empty($nom)) {
        $loginErrors[] = "Veuillez saisir un nom";
    }

    if (empty($loginErrors) && password_verify($motDePasse, $motDePasseBdd) == true) {
        $_SESSION["nom"] = $_POST["nom"];
        $_SESSION["idUtilisateur"] = $results['IdU'];
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
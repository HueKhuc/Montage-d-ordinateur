<?php
// Récupération des données POST
if (isset($_POST["nom"]) && isset($_POST["motDePasse"])) {
    $motDePasse = $_POST['motDePasse'];
    $nom = $_POST['nom'];
    $utilisateur = $_POST['utilisateur'];
    $motDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);

    // Insertion dans la table utilisateur
    $subStatement = $db->prepare('INSERT INTO utilisateur (nom, motDePasse) VALUES (:nom, :motDePasse)');
    $subStatement->execute([
        ':nom' => $nom,
        ':motDePasse' => $motDePasse
    ]);

    // Insertion dans la table concepteur ou dans la table monteur
    $idUtilisateur = $db->lastInsertId();
    if (isset($_POST['utilisateur']) && $_POST['utilisateur'] == 'concepteur') {
        $stmt = $db->prepare('INSERT INTO concepteur (idUtilisateur) VALUES (:idUtilisateur)');
        $stmt->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $stmt->execute();
    } elseif (isset($_POST['utilisateur']) && $_POST['utilisateur'] == 'monteur') {
        $stmt = $db->prepare('INSERT INTO monteur (idUtilisateur) VALUES (:idUtilisateur)');
        $stmt->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $stmt->execute();
    }
    ?>

<!-- Message d'inscription validée -->
    <div class="alert alert-success" role="alert">
        Inscription réussie !
    </div>
    <?php
}
?>

<!-- Formulaire d'inscription -->
<div class="container-fluid">
    <div class="row d-flex justify-content-center mt-5 mb-5">
        <form class="" action="" method="post">
            <div class="form-group m-5">
                <label for="nom">Identifiant</label>
                <input type="text" class="textCenter form-control" id="nom" name="nom"
                    placeholder="Choisissez un identifiant">
            </div>
            <div class="resize form-group m-5">
                <label for="exampleInputmotDePasse1">Mot de passe</label>
                <input type="password" class="textCenter form-control" id="motDePasse" name="motDePasse"
                    placeholder="Choisissez un mot de passe">
            </div>

<!-- Choix du mode (concepteur ou monteur) -->
            <div>
                <label for="utilisateur">Vous êtes : </label>
                <select name="utilisateur" id="utilisateur">
                    <option value="concepteur">Concepteur</option>
                    <option value="monteur">Monteur</option>
                </select>
            </div>

<!-- Bouton de validation du formulaire d'inscription -->
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </form>
    </div>
</div>
<?php

// Récupération des données POST
if (isset($_POST["nom"]) && isset($_POST["password"])) {
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $utilisateur = $_POST['utilisateur'];
    $password = password_hash($password, PASSWORD_DEFAULT);

// Insertion dans la table utilisateur
    $subStatement = $db->prepare('INSERT INTO utilisateur (nom, password) VALUES (:nom, :password)');
    $subStatement->execute([
        ':nom' => $nom,
        ':password' => $password
    ]);

// Insertion dans la table concepteur ou dans la table monteur
    $id = $db->lastInsertId();
    if (isset($_POST['utilisateur']) && $_POST['utilisateur'] == 'concepteur') {
        $stmt = $db->prepare('INSERT INTO concepteur (Id_Utilisateur) VALUES (:id)');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } elseif (isset($_POST['utilisateur']) && $_POST['utilisateur'] == 'monteur') {
        $stmt = $db->prepare('INSERT INTO monteur (Id_Utilisateur) VALUES (:id)');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
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
                <input type="text" class="textCenter form-control" id="nom" name="nom" placeholder="Choisissez un identifiant">
            </div>
            <div class="resize form-group m-5">
                <label for="exampleInputPassword1">Mot de passe</label>
                <input type="password" class="textCenter form-control" id="password" name="password"
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
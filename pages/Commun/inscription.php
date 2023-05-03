<?php

$pageTitle = "Inscription";


if (isset($_POST["nom"]) && isset($_POST["password"])) {

    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $utilisateur = $_POST['utilisateur'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $subStatement = $db->prepare('INSERT INTO utilisateur (nom, password) VALUES (:nom, :password)');
    $subStatement->execute([
        ':nom' => $nom,
        ':password' => $password
    ]);
    $id = $db->lastInsertId();
    if (isset($_POST['utilisateur']) && $_POST['utilisateur']=='concepteur'){
        $stmt = $db->prepare('INSERT INTO concepteur (Id_Utilisateur) VALUES (:id)');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
    } elseif (isset($_POST['utilisateur']) && $_POST['utilisateur']=='monteur') {
        $stmt = $db->prepare('INSERT INTO monteur (Id_Utilisateur) VALUES (:id)');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>


    <div class="container-fluid">
        <div class="row d-flex justify-content-center mt-5 mb-5">
            <form class="" action="" method="post">
                <div class="form-group m-5">
                    <label for="nom">Nom</label>
                    <input type="text" class="textCenter form-control" id="nom" name="nom" placeholder="gerard45">
                </div>
        
                <div class="resize form-group m-5">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input type="password" class="textCenter form-control" id="password" name="password" placeholder="Entrer mot de passe">
                </div>
                <div>
                    <label for="utilisateur">Utilisateur</label>
                    <select name="utilisateur" id="utilisateur">
                        <option value="concepteur">Concepteur</option>
                        <option value="monteur">Monteur</option>
                    </select>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>


            </form>
        </div>

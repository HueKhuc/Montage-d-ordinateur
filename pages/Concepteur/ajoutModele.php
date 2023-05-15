<?php
$sta = $db->prepare('SELECT * FROM composant');
$sta->setFetchMode(PDO::FETCH_CLASS, Composant::class);
$sta->execute();
$results = $sta->fetchAll();
$errors = [];
if (isset($_POST['modele'])) {
    foreach (Composant::LIMITS as $slug => $limit) {
        if (empty($_POST[$slug . '_quantite'])) {
            $errors[$slug] = "Veuillez saisir la quantité";
        } elseif ($_POST[$slug] && $_POST[$slug . '_quantite'] > $limit) {
            $errors[$slug] = "Trop grande quantité";
        }
    }
    if (empty($errors)) {
        // Insertion des données dans la table Modele
        $sqlModele = 'INSERT INTO modele(nom, estPortable, quantite, idUtilisateur)
            VALUES (:nom, :estPortable, :quantite, :idUtilisateur)';
        $pdoStat = $db->prepare($sqlModele);
        $pdoStat->bindValue(':nom', $_POST['modele'], PDO::PARAM_STR);
        $pdoStat->bindValue(':estPortable', $_POST['estPortable'], PDO::PARAM_BOOL);
        $pdoStat->bindValue(':quantite', 0, PDO::PARAM_INT);
        $pdoStat->bindValue(':idUtilisateur', $_SESSION["id"], PDO::PARAM_STR);
        $pdoStat->execute();
        $id = $db->lastInsertId();
        foreach (Composant::CATEGORIES as $slug => $categorie) {
            $sqlComponent = 'INSERT INTO montage VALUES (:idModele, :idComposant, :quantite)';
            $pdoStat = $db->prepare($sqlComponent);
            $pdoStat->bindValue(':quantite', $_POST[$slug . '_quantite'], PDO::PARAM_INT);
            $pdoStat->bindValue(':idModele', $id, PDO::PARAM_INT);
            $pdoStat->bindValue(':idComposant', $_POST[$slug], PDO::PARAM_INT);
            $pdoStat->execute();
        }
    }
}
?>

<!-- Formulaire d'ajout modele -->
<h1 class="text-center mt-5">Création ou modification modèle</h1>
<form action="" method="post">
    <?php
    foreach (Composant::CATEGORIES as $slug => $categorie) {
        ?>
        <div class="m-3 d-flex ">
            <label for="<?= $slug; ?>"><?= $categorie; ?> :</label>
            <select name="<?= $slug; ?>" id="<?= $slug; ?>">
                <?php
                /** @var Composant $composant */
                foreach ($results as $key => $composant) {
                    if ($composant->getCategorie() == $categorie) {
                        ?>
                        <option value="<?= $composant->getId(); ?>"><?= $composant->getNom(); ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <label for="<?= $slug; ?>_quantite">
                <input type="number" name="<?= $slug; ?>_quantite" id="<?= $slug; ?>_quantite" placeholder="Quantite" value="<?php if (isset($_POST[$slug . '_quantite'])) {
                        echo $_POST[$slug . '_quantite'];
                    }
                    ?>">
                <?php if (isset($errors[$slug])) { ?>
                    <span class="error">
                        <?= $errors[$slug];
                } ?>
                </span>
            </label>
        </div>
        <?php
    }
    ?>
    <div class="m-3">
        <label for="estPortable">Portable :</label>
        <select name="estPortable" id="estPortable">
            <option value="0">Non</option>
            <option value="1">Oui</option>
        </select>
    </div>
    <div class="m-3">
        <label for="modele">Modele : </label>
        <input type="text" name="modele" id="modele">
        <input type="submit" value="Envoyer">
    </div>
</form>
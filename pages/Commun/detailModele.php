<?php
$idModele = $_GET['idModele'];

// Récupération des infos en BDD
$pdoStat = $db->prepare('SELECT * FROM modele WHERE idModele = :idModele');
$pdoStat->bindValue(':idModele', $idModele, PDO::PARAM_INT);
$pdoStat->setFetchMode(PDO::FETCH_CLASS, Modele::class);
$pdoStat->execute();
$modele = $pdoStat->fetch();

$pdo = $db->prepare('SELECT utilisateur.nom, modele.idUtilisateur 
                    FROM utilisateur
                    LEFT JOIN modele ON utilisateur.idUtilisateur = modele.idUtilisateur
                    WHERE modele.idModele = :idModele');
$pdo->bindValue(':idModele', $idModele, PDO::PARAM_INT);
$pdo->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
$pdo->execute();
$util = $pdo->fetch();

$sql = $db->prepare("SELECT 
composant.*,
montage.quantite as quantiteModele,
alimentation.*,
carte_graphique.*,
carte_mere.*,
clavier.*,
disque_dur.*,
ecran.*,
memoire_vive.*,
processeur.*,
souris.*
FROM composant
INNER JOIN montage ON composant.idComposant = montage.idComposant
LEFT JOIN alimentation ON composant.idComposant = alimentation.idComposant
LEFT JOIN carte_graphique ON composant.idComposant = carte_graphique.idComposant
LEFT JOIN carte_mere ON composant.idComposant = carte_mere.idComposant
LEFT JOIN clavier ON composant.idComposant = clavier.idComposant
LEFT JOIN disque_dur ON composant.idComposant = disque_dur.idComposant
LEFT JOIN ecran ON composant.idComposant = ecran.idComposant
LEFT JOIN memoire_vive ON composant.idComposant = memoire_vive.idComposant
LEFT JOIN processeur ON composant.idComposant = processeur.idComposant
LEFT JOIN souris ON composant.idComposant = souris.idComposant
WHERE idModele = :idModele");
$sql->bindValue(':idModele', $idModele, PDO::PARAM_INT);
$sql->execute();
$res = $sql->fetchAll();

$results = [];
foreach ($res as $tableauComposant) {
    $categorie = str_replace(' ', '', $tableauComposant['categorie']);
    $composantObj = new $categorie($tableauComposant);
    $results[] = $composantObj;
}
?>

<!-- Détails du modèle -->
<h1 class="text-center mt-5">Détails du modèle</h1>
<div class="m-3">
    <p><strong>Nom :</strong>
        <?php echo $modele->getNom(); ?>
    </p>
    <p><strong>Portable :</strong>
        <?php echo $modele->getEstPortable() ? 'Oui' : 'Non'; ?>
    </p>
    <p><strong>Quantité :</strong>
        <?php echo $modele->getQuantite(); ?>
    </p>
    <p><strong>Concepteur :</strong>
        <?php echo $util->getNom(); ?>
    </p>
    <p><strong>Description :</strong>
        <?php echo $modele->getDescription(); ?>
    </p>
</div>

<!-- Composants du modèle -->
<div class="m-3">
    <h2>Composants</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Categorie</th>
                <th>Propriétés</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $composant) { ?>
                <tr>
                    <td>
                        <?php echo $composant->getNom(); ?>
                    </td>
                    <td>
                        <?php echo $composant->getQuantiteModele(); ?>
                    </td>
                    <td>
                        <?php echo $composant->getCategorie(); ?>
                    </td>
                    <td>
                        <?php echo $composant->getMore(); ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
// Requête pour le formulaire de commentaire
if (isset($_POST['submit'])) {
    echo '<div class="alert alert-success my-5" role="alert">Message envoyé</div>';
    $statement = $db->prepare('INSERT INTO message (texte, idModele, idUtilisateur) VALUES (:texte, :idModele, :idUtilisateur)');
    $statement->bindValue(':texte', $_POST['commentaire'], PDO::PARAM_STR);
    $statement->bindValue(':idModele', $_GET['idModele'], PDO::PARAM_INT);
    $statement->bindValue(':idUtilisateur', $_SESSION["idUtilisateur"], PDO::PARAM_INT);
    $statement->execute();
}

$staCo = $db->prepare('SELECT message.*, utilisateur.nom AS userName FROM message 
INNER JOIN utilisateur ON message.idUtilisateur = utilisateur.idUtilisateur
WHERE idModele = :idModele ORDER BY dateMessage ');
$staCo->bindValue(":idModele", $idModele, PDO::PARAM_INT);
$staCo->setFetchMode(PDO::FETCH_CLASS, Message::class);
$staCo->execute();
$resCo = $staCo->fetchAll();

$sqlUpdateCo = 'UPDATE message 
                        SET estLu = :estLu
                        WHERE idModele = :idModele AND idUtilisateur != :idUtilisateur';
$updateCo = $db->prepare($sqlUpdateCo);
$updateCo->bindValue(':estLu', 1, PDO::PARAM_BOOL);
$updateCo->bindValue(':idModele', $_GET['idModele'], PDO::PARAM_INT);
$updateCo->bindValue(':idUtilisateur', $_SESSION["idUtilisateur"], PDO::PARAM_INT);
$updateCo->execute();
?>

<!-- Affichage du formulaire de commentaire -->
<div class=" container">
    <form class="row g-3 mt-5" method="post" action="">
        <div class="mb-3">
            <h5>Commentaire : </h5>
            <?php foreach ($resCo as $commentaire) {
                echo '<div> le ';
                echo $commentaire->getDateMessage() . ' de ';
                echo $commentaire->getUserName();
                if (!$commentaire->getEstLu()) {
                    echo ' (Non-lu)';
                }
                echo '<p>' . $commentaire->getTexte() . '</p>';
                echo '</div>';
            } ?>
        </div>

        <div class="mb-3">
            <label for="commentaire" class="form-label">Commentaire</label>
            <textarea class="form-control" name="commentaire" id="commentaire" rows="5"></textarea>
        </div>
        <div class="col-12 justify-content-center">
            <button type="submit" name="submit" class="btn btn-dark">Envoyer</button>
        </div>
    </form>
</div>
<?php
$id = $_GET['id'];

$pdoStat = $db->prepare('SELECT * FROM modele WHERE Id_Modele = :id');
$pdoStat->bindValue(':id', $id, PDO::PARAM_INT);
$pdoStat->setFetchMode(PDO::FETCH_CLASS, Modele::class);
$pdoStat->execute();
$modele = $pdoStat->fetch();

$pdo = $db->prepare('SELECT utilisateur.nom,
modele.Id_Utilisateur FROM utilisateur
LEFT JOIN modele ON utilisateur.Id_Utilisateur = modele.Id_Utilisateur
WHERE modele.Id_Modele = :id');
$pdo->bindValue(':id', $id, PDO::PARAM_INT);
$pdo->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
$pdo->execute();
$util = $pdo->fetch();

$sql = $db->prepare("SELECT 
composant.*,
assembler.quantite as quantiteModele,
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
INNER JOIN assembler ON composant.Id_Composant = assembler.Id_Composant
LEFT JOIN alimentation ON composant.Id_Composant = alimentation.Id_Composant
LEFT JOIN carte_graphique ON composant.Id_Composant = carte_graphique.Id_Composant
LEFT JOIN carte_mere ON composant.Id_Composant = carte_mere.Id_Composant
LEFT JOIN clavier ON composant.Id_Composant = clavier.Id_Composant
LEFT JOIN disque_dur ON composant.Id_Composant = disque_dur.Id_Composant
LEFT JOIN ecran ON composant.Id_Composant = ecran.Id_Composant
LEFT JOIN memoire_vive ON composant.Id_Composant = memoire_vive.Id_Composant
LEFT JOIN processeur ON composant.Id_Composant = processeur.Id_Composant
LEFT JOIN souris ON composant.Id_Composant = souris.Id_Composant
WHERE Id_Modele = :idModele");
$sql->bindValue(':idModele', $id, PDO::PARAM_INT);
$sql->execute();
$res = $sql->fetchAll();

$results = [];
foreach ($res as $composantTab) {
    $categorie = str_replace(' ', '', $composantTab['categorie']);
    $composantObj = new $categorie($composantTab);
    $results[] = $composantObj;
}


?>

<!-- Infos du modèle -->
<h1 class="text-center mt-5">Détails du modèle</h1>
<div class="m-3">
    <p><strong>Nom :</strong> <?php echo $modele->getNom(); ?> </p>
    <p><strong>Portable :</strong> <?php echo $modele->getPortable() ? 'Oui' : 'Non'; ?> </p>
    <p><strong>Quantité :</strong> <?php echo $modele->getQuantite(); ?></p>
    <p><strong>Concepteur :</strong> <?php echo $util->getNom(); ?></p>
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
            <?php foreach ($results as $composant){ ?>
            <tr>
                <td><?php echo $composant->getNom(); ?></td>
                <td><?php echo $composant->getQuantiteModele(); ?></td>
                <td><?php echo $composant->getCategorie(); ?></td>
                <td><?php echo $composant->getMore(); ?></td>                
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
// Requête pour formulaire commentaire

if (isset($_POST['submit'])) {
    echo '<div class="alert alert-success my-5" role="alert">Message envoyé</div>';
    $statement = $db->prepare('INSERT INTO message (texte, Id_Modele, Id_Utilisateur) VALUES (:texte, :Id_Modele, :Id_Utilisateur)');
$statement->bindValue(':texte', $_POST['commentaire'], PDO::PARAM_STR);
$statement->bindValue(':Id_Modele', $_GET['id'], PDO::PARAM_INT);
$statement->bindValue(':Id_Utilisateur', $_SESSION["id"], PDO::PARAM_INT);
$statement-> execute();
}

$staCo = $db->prepare('SELECT message.*, utilisateur.nom AS userName FROM message 
INNER JOIN utilisateur ON message.Id_Utilisateur = utilisateur.Id_Utilisateur
WHERE Id_Modele = :idModele ORDER BY dateMess ');
$staCo->bindValue(":idModele", $id, PDO::PARAM_INT);
$staCo->setFetchMode(PDO::FETCH_CLASS, Message::class);
$staCo->execute();
$resCo = $staCo->fetchAll();

$sqlUpdateCo = 'UPDATE message 
                        SET lu = :lu
                        WHERE Id_Modele = :id AND Id_Utilisateur != :id_utilisateur';
        $updateCo = $db->prepare($sqlUpdateCo);
        $updateCo->bindValue(':lu', 1, PDO::PARAM_BOOL);
        $updateCo->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $updateCo->bindValue(':id_utilisateur', $_SESSION["id"], PDO::PARAM_INT);
        $updateCo->execute();




?>
<div class=" container">
    <form class="row g-3 mt-5" method="post" action="">
        <div class="mb-3">
            <h5>Commentaire : </h5>
                <?php foreach ($resCo as $commentaire) { 
                    echo '<div> le ';
                    echo $commentaire->getDateMess().' de ';
                    echo $commentaire->getUserName();
                    if (!$commentaire->getLu()) {
                        echo ' (Non-lu)';
                    } 
                    echo '<p>'.$commentaire->getTexte().'</p>';
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
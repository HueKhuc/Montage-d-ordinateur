<?php
$id = $_GET['id'];

$pdoStat = $db->prepare('SELECT * FROM modele WHERE Id_Modele = :id');
$pdoStat->bindValue(':id', $id, PDO::PARAM_INT);
$pdoStat->setFetchMode(PDO::FETCH_CLASS, Modele::class);
$pdoStat->execute();
$modele = $pdoStat->fetch();


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

// var_dump($res);

$results = [];
foreach ($res as $composantTab) {
    $categorie = str_replace(' ', '', $composantTab['categorie']);
    $composantObj = new $categorie($composantTab);
    $results[] = $composantObj;
}


?>

<h1 class="text-center mt-5">Détails du modèle</h1>

<div class="m-3">
    <p><strong>Nom :</strong> <?php echo $modele->getNom(); ?></p>
    <p><strong>Portable :</strong> <?php echo $modele->getPortable() ? 'Oui' : 'Non'; ?></p>
    <p><strong>Quantité :</strong> <?php echo $modele->getQuantite(); ?></p>
</div>

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


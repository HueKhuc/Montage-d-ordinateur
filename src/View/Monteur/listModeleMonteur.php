<?php
// Récupération des données en BDD
$sqlVerif = "SELECT montage.quantite as quantiteDemandee, composant.quantite as quantiteDispo 
FROM `montage` 
    INNER JOIN composant ON composant.idComposant = montage.idComposant 
WHERE idModele = :idModele
GROUP BY montage.idComposant 
HAVING (quantiteDispo - quantiteDemandee < 0)";
$sthCompte = $db->prepare($sqlVerif);

if (isset($_GET['id'])) {
    $idModele = $_GET['id'];

    $sthCompte->bindValue(':idModele', $idModele, PDO::PARAM_INT);
    $sthCompte->execute();
    $resCompte = $sthCompte->fetchAll();

    if (empty($resCompte)) {

        $sqlMod = 'UPDATE modele SET quantite = quantite + 1 WHERE idModele = :id';
        $sthMod = $db->prepare($sqlMod);
        $sthMod->bindValue(':id', $idModele, PDO::PARAM_INT);
        $sthMod->execute();

        $sqlAss = 'SELECT * FROM montage WHERE idModele = :id';
        $sthAss = $db->prepare($sqlAss);
        $sthAss->bindValue(':id', $idModele, PDO::PARAM_INT);
        $sthAss->execute();
        $ass = $sthAss->fetchAll();
        
        foreach ($ass as $compo) {

            $sqlCompo = 'UPDATE composant SET quantite = quantite - :quantite WHERE idComposant = :id';
            $sthCompo = $db->prepare($sqlCompo);
            $sthCompo->bindValue(':id', $compo['idComposant'], PDO::PARAM_INT);
            $sthCompo->bindValue(':quantite', $compo['quantite'], PDO::PARAM_INT);
            $sthCompo->execute();

            $sqlStock = 'INSERT INTO stock(idComposant, quantite, entree) VALUES
        (:id, :quantite, :entree)';
            $sthStock = $db->prepare($sqlStock);
            $sthStock->bindValue(':id', $compo['idComposant'], PDO::PARAM_INT);
            $sthStock->bindValue(':quantite', $compo['quantite'], PDO::PARAM_INT);
            $sthStock->bindValue(':entree', 0, PDO::PARAM_BOOL);
            $sthStock->execute();
        }
    }
    header('Location: ?page=monteur/listModeleMonteur');
}

$sql_order = ('SELECT * FROM modele ');
$sth = $db->prepare($sql_order);
$sth->setFetchMode(PDO::FETCH_CLASS, Modele::class);
$sth->execute();
$results = $sth->fetchAll();
?>

<!-- Liste des modèles -->
<div class="container">
    <div class='mt-5'>
        <h2 class='text-center m-3 text-uppercase'>Liste des modèles</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Nom Modele</th>
                    <th scope="col" class="text-center">Quantité</th>
                    <th scope="col" class="text-center">Portable</th>
                    <th scope="col" class="text-center">Date Ajout</th>
                    <th scope="col" class="text-center">Détails</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php
                foreach ($results as $key => $modele) {
                    $idModele = $modele->getIdModele();
                    $nom = $modele->getNom();
                    $quantite = $modele->getQuantite();
                    $estPortable = $modele->getEstPortable();
                    $dateAjoutModele = $modele->getDateAjoutModele();
                    $sthCompte->bindValue(':idModele', $idModele, PDO::PARAM_INT);
                    $sthCompte->execute();
                    $resCompte = $sthCompte->fetchAll();
                echo
                    '<tr>
                        <th class="text-center" scope="row">' . $idModele . '</th>
                            <td class="text-center">' . $nom . '</td>
                            <td class="text-center">' . $quantite . '</td>
                            <td class="text-center">' . $estPortable . '</td>
                            <td class="text-center">' . $dateAjoutModele . '</td>
                            <td class="text-center"><a class="navbar-brand" href="?page=commun/detailModele&idModele=' . $idModele . '">Détail</a></td>
                            <td class="text-center">';
                            if (empty($resCompte)) {
                                echo 
                                    '<a class="navbar-brand" href="?page=monteur/listModeleMonteur&id=' . $idModele . '">Monter</a>';
                            } 
                            echo 
                                '</td>
                    </tr>';
                } 
            ?>
            </tbody>
        </table>
    </div>
</div>
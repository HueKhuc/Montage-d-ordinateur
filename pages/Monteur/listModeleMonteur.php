<?php

$sqlVerif = "SELECT assembler.quantite as quantiteDemandee, composant.quantite as quantiteDispo 
FROM `assembler` 
    INNER JOIN composant ON composant.Id_Composant = assembler.Id_Composant 
WHERE Id_Modele = :idModele
GROUP BY assembler.Id_Composant 
HAVING (quantiteDispo - quantiteDemandee < 0)";
$sthCompte = $db->prepare($sqlVerif);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sthCompte->bindValue(':idModele', $id, PDO::PARAM_INT);
    $sthCompte->execute();
    $resCompte = $sthCompte->fetchAll();

    if (empty($resCompte)) {

        $sqlMod = 'UPDATE modele SET quantite = quantite + 1 WHERE Id_Modele = :id';
        $sthMod = $db->prepare($sqlMod);
        $sthMod->bindValue(':id', $id, PDO::PARAM_INT);
        $sthMod->execute();

        $sqlAss = 'SELECT * FROM assembler WHERE Id_Modele = :id';
        $sthAss = $db->prepare($sqlAss);
        $sthAss->bindValue(':id', $id, PDO::PARAM_INT);
        $sthAss->execute();
        $ass = $sthAss->fetchAll();
        // var_dump($ass);
        foreach ($ass as $compo) {
            // var_dump($compo['Id_Composant']);

            $sqlCompo = 'UPDATE composant SET quantite = quantite -1 WHERE Id_Composant = :id';
            $sthCompo = $db->prepare($sqlCompo);
            $sthCompo->bindValue(':id', $compo['Id_Composant'], PDO::PARAM_INT);
            $sthCompo->execute();

            $sqlStock = 'INSERT INTO gestion_stock(Id_Composant, quantite, entree) VALUES
        (:id, :quantite, :entree)';
            $sthStock = $db->prepare($sqlStock);
            $sthStock->bindValue(':id', $compo['Id_Composant'], PDO::PARAM_INT);
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
<h1>Liste Modèle</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom Modele</th>
            <th scope="col" class="text-center">Quantité</th>
            <th scope="col" class="text-center">Portable</th>
            <th scope="col">Date Ajout</th>
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
            echo
                '<tr>
                        <th scope="row">' . $idModele . '</th>
                        <td>' . $nom . '</td>
                        <td class="text-center">' . $quantite . '</td>
                        <td class="text-center">' . $estPortable . '</td>
                        <td>' . $dateAjoutModele . '</td>
                        <td><a class="navbar-brand" href="?page=commun/detailModele&idModele=' . $idModele . '">Detail</a></td>
                        <td>';
            if (empty($resCompte)) {
                echo '
                    <a class="navbar-brand" href="?page=monteur/listModeleMonteur&id=' . $id . '">Monter</a>';
            }
            echo '
                        </td>
                    </tr>';
        } ?>
    </tbody>
</table>
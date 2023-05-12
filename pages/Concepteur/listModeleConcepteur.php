<?php

// Tri de la liste modele + Fonction Prix Modèle
$sql_order = ('SELECT modele.*, sum(assembler.quantite*composant.prix) AS prixModele 
FROM modele 
    LEFT JOIN assembler ON modele.Id_Modele = assembler.Id_Modele
    LEFT JOIN composant ON composant.Id_Composant = assembler.Id_Composant
    GROUP BY modele.Id_Modele');
$tri = '';
if (isset($_POST['trier'])) {
    $tri = $_POST['trier'];
    $choixTri = ['Id_Modele', 'quantite', 'nom', 'dateAjout'];
    if (in_array($tri, $choixTri, true)) {
        $sql_order .= ' ORDER BY ' . $tri;
    } else {
        $sql_order .= ' ORDER BY Id_Modele';
    }
}
$sth = $db->prepare($sql_order);
$sth->setFetchMode(PDO::FETCH_CLASS, Modele::class);
$sth->execute();
$results = $sth->fetchAll();
?>

<div class="container">
    <h1>Liste des Modèles</h1>
    <form method="POST" action="">
        <div class="col-2 my-5 mx-2 d-flex flex-row">
            <select class="form-select p-1" aria-label="Default select example" name="trier">
                <option selected class="text-center">ID</option>
                <?php
                $colonnes = [
                    [
                        'value' => 'quantite',
                        'label' => 'Quantité'
                    ],
                    [
                        'value' => 'nom',
                        'label' => 'Nom'
                    ],
                    [
                        'value' => 'dateAjout',
                        'label' => 'Date Ajout'
                    ],
                ];
                foreach ($colonnes as $colonne) {
                    echo '<option class="text-center" value="' . $colonne['value'] . '" ';
                    if ($tri == $colonne['value']) {
                        echo 'selected';
                    }
                    echo '>' . $colonne['label'] . '</option>';
                }
                ?>
            </select>
            <input type="submit" name="submit" value="Trier" />
        </div>
    </form>

    <!-- Liste de modeles -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Nom Modele</th>
                <th scope="col" class="text-center">Quantité</th>
                <th scope="col" class="text-center">Portable</th>
                <th scope="col" class="text-center">Date Ajout</th>
                <th scope="col" class="text-center">Prix</th>
                <th scope="col" class="text-center">Détails</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach ($results as $key => $modele) {
                $id = $modele->getId();
                $nom = $modele->getNom();
                $quantite = $modele->getQuantite();
                $portable = $modele->getPortable();
                $dateAjout = $modele->getDateAjout();
                $prixModele = $modele->getPrixModele();
                echo
                    '<tr>
                    <th scope="row">' . $id . '</th>
                    <td class="text-center">' . $nom . '</td>
                    <td class="text-center">' . $quantite . '</td>
                    <td class="text-center">' . $portable . '</td>
                    <td class="text-center">' . $dateAjout . '</td>
                    <td class="text-center">' . $prixModele . '€</td>
                    <td class="text-center"><a class="navbar-brand" href="?page=commun/detailModele&id=' . $id . '">Detail</a></td>
                </tr>';
            } ?>
        </tbody>
    </table>

    <!-- Bouton ajouter composant -->
    <?php
    if (isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') {
        echo
            '<div class="m5 d-flex justify-content-end">
            <a type="button" class="btn btn-outline-dark" href="?page=concepteur/ajoutModele">Ajouter un nouveau modèle</a>
        </div>';
    }
    ?>
</div>
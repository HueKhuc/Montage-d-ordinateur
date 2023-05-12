<?php
$sql_order = ('SELECT * FROM modele ');
// Tri de la liste composant
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
    <!-- Tri de la liste composant -->
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
                $id = $modele->getId();
                $nom = $modele->getNom();
                $quantite = $modele->getQuantite();
                $portable = $modele->getPortable();
                $dateAjout = $modele->getDateAjout();
                echo
                    '<tr>
                    <th scope="row">' . $id . '</th>
                    <td>' . $nom . '</td>
                    <td class="text-center">' . $quantite . '</td>
                    <td class="text-center">' . $portable . '</td>
                    <td>' . $dateAjout . '</td>
                    <td><a class="navbar-brand" href="?page=commun/detailModele&id=' . $id . '">Detail</a></td>
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
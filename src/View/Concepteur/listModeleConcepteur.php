<?php
use Model\ModelesFilter;
?>
<!-- Filtre de la liste des modèles -->
<form action="" method="post" class="container">
    <div class="d-flex flex-column gap-2 mt-5">
        <label for="nonLus">Commentaires non-lus</label>
        <input type="checkbox" name="nonLus" id="nonLus" value="1" <?php if ($modelesfilter->getNonLus()) {
            echo "checked";
        } ?>>
        <label for="estPortable">Portable</label>
        <input type="checkbox" name="estPortable" id="estPortable" value="1" <?php if ($modelesfilter->getEstPortable()) {
            echo "checked";
        } ?>>
        <label for="prixmin">Prix min :</label>
        <input type="number" name="prixmin" id="prixmin" value="<?php if ($modelesfilter->getPrixmin()) {
            echo $modelesfilter->getPrixmin();
        } ?>">
        <label for="prixmax">Prix max :</label>
        <input type="number" name="prixmax" id="prixmax" value="<?php if ($modelesfilter->getPrixmax()) {
            echo $modelesfilter->getPrixmax();
        } ?>">
        <button type="submit" class="btn btn-primary">Filtrer</button>
    </div>
</form>

<!-- Affichage du tri de la liste des modèles -->
<div class="container">
    <div class='mt-5'>
        <h2 class='text-center m-3 text-uppercase'>Liste des modèles</h2>
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
                        'value' => 'dateAjoutModele',
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

<!-- Liste de modèles -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Nom Modele</th>
                <th scope="col" class="text-center">Quantité</th>
                <th scope="col" class="text-center">Portable</th>
                <th scope="col" class="text-center">Date Ajout</th>
                <th scope="col" class="text-center">Prix</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach ($modelesfilter->getModeles() as $key => $modele) {
                $idModele = $modele->getIdModele();
                $nom = $modele->getNom();
                $quantite = $modele->getQuantite();
                $estPortable = $modele->getEstPortable();
                $dateAjoutModele = $modele->getDateAjoutModele();
                $prixModele = $modele->getPrixModele();
                echo
                    '<tr>
                    <th scope="row">' . $idModele . '</th>
                    <td class="text-center">' . $nom . '</td>
                    <td class="text-center">' . $quantite . '</td>
                    <td class="text-center">' . $estPortable . '</td>
                    <td class="text-center">' . $dateAjoutModele . '</td>
                    <td class="text-center">' . $prixModele . '€</td>
                    <td class="text-center"><a class="navbar-brand" href="?page=commun/detailModele&idModele=' . $idModele . '">Details</a></td>
                    <td class="text-center"><a type="button" class="btn btn-outline-dark align-middle" href="?page=concepteur/modifModele&idModele=' . $idModele . '">Modifier</a></td>
                </tr>';
            } ?>
        </tbody>
    </table>

<!-- Bouton ajouter un modèle -->
    <?php
    if (isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') {
        echo
            '<div class="m5 d-flex justify-content-end">
            <a type="button" class="btn btn-outline-dark" href="?page=concepteur/ajoutModele">Ajouter un nouveau modèle</a>
        </div>';
    }
    ?>
    </div>
</div>
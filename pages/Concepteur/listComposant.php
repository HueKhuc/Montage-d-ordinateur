<?php
$pageTitle = "Liste des composants";
$sql_order = 'SELECT nom, marque, quantite, prix, categorie, datAjout, isLaptop, Id_Composant FROM composant';
$tri = '';
if (isset($_POST['trier'])) {
    $tri = $_POST['trier'];
    if ($tri === 'quantite') {
        $sql_order .= ' ORDER BY ' . $tri;
    } elseif ($tri === 'nom') {
        $sql_order .= ' ORDER BY ' . $tri;
    } elseif ($tri === 'marque') {
        $sql_order .= ' ORDER BY ' . $tri;
    } elseif ($tri === 'prix') {
        $sql_order .= ' ORDER BY ' . $tri;
    } elseif ($tri === 'datAjout') {
        $sql_order .= ' ORDER BY ' . $tri;
    } else {
        $sql_order .= ' ORDER BY Id_Composant';
    }
}
$sth = $db->prepare($sql_order);
$sth->setFetchMode(PDO::FETCH_CLASS, Composant::class);
$sth->execute();
$results = $sth->fetchAll();
$piecesfilter = new PiecesFilter($_POST, $results);
?>

<!-- Filtre de la liste composant -->
<form action="" method="post" class="container">
    <div class="d-flex flex-column gap-2 mt-5">
    <label for="categorie">Catégorie :</label>
    <select name="categorie" id="categorie">
        <option value=""></option>
        <?php
        foreach (Composant::CATEGORIES as $id => $categorie) {
        ?>
        <option value="<?= $categorie ?>" 
        <?php if ($piecesfilter->getCategorie() == $categorie) {
            echo 'selected';
        }?>>
            <?= $categorie ?>
        </option>
        <?php
        }
        ?>
    </select>
        <label for="marque">Marque :</label>
        <input type="text" name="marque" id="marque" value="<?php if ($piecesfilter->getMarque()) {
            echo $piecesfilter->getMarque();
        } ?>">
        <label for="quantite">En stock</label>
        <input type="checkbox" name="quantite" id="quantite" value="1" checked <?php if ($piecesfilter->getQuantite()) {
            echo "checked";
        } ?>>
        <label for="islaptop">Compatible PC portable</label>
        <input type="checkbox" name="islaptop" id="islaptop" value="1" <?php if ($piecesfilter->getIsLaptop()) {
            echo "checked";
        } ?>>
        <label for="prixmin">Prix min :</label>
        <input type="number" name="prixmin" id="prixmin" value="<?php if ($piecesfilter->getPrixmin()) {
            echo $piecesfilter->getPrixmin();
        } ?>">
        <label for="prixmax">Prix max :</label>
        <input type="number" name="prixmax" id="prixmax" value="<?php if ($piecesfilter->getPrixmax()) {
            echo $piecesfilter->getPrixmax();
        } ?>">
        <input  type="number" name="id" value="<?php if ($piecesfilter->getId()) {
            echo $piecesfilter->getId();
        } ?>">
        <button type="submit" class="btn btn-primary">Filtrer</button>
    </div>
</form>

<!-- Tri de la liste composant -->
<div class="container">
    <div class='mt-5'>
        <h2 class='text-center m-3 text-uppercase'>Liste des composants</h2>
        <form method="POST" action="">
            <div class="col-2 my-5 mx-2 d-flex flex-row">
                <select class="form-select p-1" aria-label="Default select example" name="trier">
                    <option selected class="text-center">#</option>
                    <option value="quantite" <?php if ($tri === 'quantite') {
                        echo 'selected';
                    } ?>>
                        Quantité en stock
                    </option>
                    <option value="nom" <?php if ($tri === 'nom') {
                        echo 'selected';
                    } ?>>
                        Nom
                    </option>
                    <option value="marque" <?php if ($tri === 'marque') {
                        echo 'selected';
                    } ?>>
                        Marque
                    </option>
                    <option value="prix" <?php if ($tri === 'prix') {
                        echo 'selected';
                    } ?>>
                        Prix
                    </option>
                    <option value="datAjout" <?php if ($tri === 'datAjout') {
                        echo 'selected';
                    } ?>>
                        Date d'ajout
                    </option>
                    <option value="modele" <?php if ($tri === 'modele') {
                        echo 'selected';
                    } ?>>
                        Modèles créés avec cette pièce
                    </option>
                </select>
                <input type="submit" name="submit" value="Trier" />
            </div>
        </form>
    <!-- Liste de composants -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom de la pièce </th>
                <th scope="col">Marque</th>
                <th scope="col" class="text-center">Quantité en stock</th>
                <th scope="col" class="text-center">Prix</th>
                <th scope="col" class="text-center">Nombre de modèles créés avec cette pièce</th>
                <th scope="col">Catégories</th>
                <th scope="col" class="text-center">Action</th>
                <th scope="col">Archiver</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach ($piecesfilter->getComposants() as $key => $composant) {
                $nom = $composant->getNom();
                $marque = $composant->getMarque();
                $quantite = $composant->getQuantite();
                $prix = number_format($composant->getPrix(), 2);
                $categorie = $composant->getCategorie();
                $id = $composant->getId();
                echo
                    '<tr>
                        <th scope="row" class="align-middle">' . $key + 1 . '</th>
                        <td class="align-middle">' . $nom . '</td>
                        <td class="align-middle">' . $marque . '</td>
                        <td class="text-center align-middle">' . $quantite . '</td>
                        <td class="text-end align-middle">' . $prix . '</td>
                        <td class="align-middle"> </td>
                        <td class="align-middle">' . $categorie . '</td>
                        <td> <a type="button" class="btn btn-outline-dark align-middle" href="?page=concepteur/modifierComposant&id='.$id.'">Modifier</a> </td>
';
                        if ($quantite == 0) {
                            echo '<td> <button type="submit" class="btn btn-primary">Archiver</button> </td>';
                        }
                        
                echo    '</tr>';
                } ?>
            </tbody>
        </table>
    </div>


<!-- Bouton ajouter composant -->
<?php 
if (isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur'){
    echo 
        '<div class="m5 d-flex justify-content-end">
            <a type="button" class="btn btn-outline-dark" href="?page=concepteur/ajoutComposant">Ajouter un nouveau composant</a>
        </div>'; 
}
?>
</div>
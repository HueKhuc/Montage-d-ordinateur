<?php
$sql_order = 'SELECT nom, marque, quantite, prix, categorie, datAjout FROM composant';

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
;

$sth = $db->prepare($sql_order);
$sth->setFetchMode(PDO::FETCH_CLASS, Composant::class);
$sth->execute();
$results = $sth->fetchAll();

?>

<!-- tri de tableau-->
<div class='mt-5'>
    <h2 class='text-center m-3 text-uppercase'>Liste de pièces</h2>
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

    <!-- Liste de pièces -->
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
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach ($results as $key => $composant) {
                $nom = $composant->getNom();
                $marque = $composant->getMarque();
                $quantite = $composant->getQuantite();
                $prix = number_format($composant->getPrix(), 2);
                $categorie = $composant->getCategorie();
                echo
                    '<tr>
                        <th scope="row">' . $key + 1 . '</th>
                        <td>' . $nom . '</td>
                        <td>' . $marque . '</td>
                        <td class="text-center">' . $quantite . '</td>
                        <td class="text-end">' . $prix . '</td>
                        <td> </td>
                        <td>' . $categorie . '</td>
                    </tr>';
            } ?>
        </tbody>
    </table>
</div>
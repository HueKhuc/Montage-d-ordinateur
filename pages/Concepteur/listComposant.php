<?php
$sth = $db->prepare('SELECT nom, marque, quantite, prix, categorie FROM composant');
$sth->setFetchMode(PDO::FETCH_CLASS, Composant::class);
$sth->execute();
$results = $sth->fetchAll();
?>

<div class='mt-5'>
    <h2 class='text-center m-3 text-uppercase'>Liste de pièces</h2>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom de la pièce</th>
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
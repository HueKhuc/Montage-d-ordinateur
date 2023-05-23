<?php

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
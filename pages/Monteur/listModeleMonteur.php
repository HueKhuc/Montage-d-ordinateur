<?php
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
            foreach ($results as $key=>$modele ) {
                $idModele = $modele->getId();
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
                        <td><a class="navbar-brand" href="?page=commun/detailModele&id='.$id.'">Detail</a></td>
                        <td><a class="navbar-brand" href="?page=monteur/selectTypeComposant&id='.$id.'">Monter</a></td>
                    </tr>';
            } ?>
        </tbody>
    </table>

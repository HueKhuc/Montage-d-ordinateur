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
                        <td><a class="navbar-brand" href="?page=commun/detailModele&id='.$id.'">Detail</a></td>
                    </tr>';
            } ?>
        </tbody>
    </table>

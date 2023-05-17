<?php
// Récupération des données en BDD
$sqlStat = 'SELECT message.*, utilisateur.nom AS userName
            FROM message
            LEFT JOIN utilisateur ON utilisateur.idUtilisateur = message.idUtilisateur
            ';
$sth = $db->prepare($sqlStat);
$sth->setFetchMode(PDO::FETCH_CLASS, Message::class);
$sth->execute();
$results = $sth->fetchAll();

$sqlMod = 'SELECT * FROM modele';
$sti = $db->prepare($sqlMod);
$sti->setFetchMode(PDO::FETCH_CLASS, Modele::class);
$sti->execute();
$res = $sti->fetchAll();

// Fonction archivage du modèle
if (isset($_GET['idModele'])) {
  $sqlUpdateArchivage = 'UPDATE modele 
                     SET archivageModele = :archivageModele
                     WHERE idModele = :idModele';
  $pdoStatement = $db->prepare($sqlUpdateArchivage);
  $pdoStatement->bindValue(':archivageModele', 1, PDO::PARAM_BOOL);
  $pdoStatement->bindValue(':idModele', $_GET['idModele'], PDO::PARAM_INT);
  $pdoStatement->execute();
  echo '<div class="alert alert-success my-5" role="alert">Modèle archivé !</div>';
}
?>

<!-- Affichage des commentaires -->
<div class="container">
    <div class='mt-5'>
        <h2 class='text-center m-3 text-uppercase'>Commentaires</h2>
        <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Nom Auteur</th>
                <th scope="col" class="text-center">Date Message</th>
                <th scope="col" class="text-center">Lu</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach ($results as $key => $message) {
                $idMessage = $message->getIdMessage();
                $userName = $message->getUserName();
                $dateMessage = $message->getDateMessage();
                $estLu = $message->getEstLu();
                echo
                    '<tr>
                    <th class="text-center" scope="row">' . $idMessage . '</th>
                    <td class="text-center">' . $userName . '</td>
                    <td class="text-center">' . $dateMessage . '</td>';                    
                    if ($estLu == 0) {
                        echo
                            '<td class="text-center"> x </td>';
                    } else {
                        echo
                            '<td class="text-center"> v </td>';
                    }                                      
                '</tr>';
            } ?>
        </tbody>
    </table>
    </div>
</div>

<!-- Affichage de la liste des modèles -->
<div class="container">
    <div class='mt-5'>
        <h2 class='text-center m-3 text-uppercase'>Liste des modèles</h2>
        <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Nom modèle</th>
                <th scope="col" class="text-center">Exemplaires</th>
                <th scope="col" class="text-center">Modifier</th>
                <th scope="col" class="text-center">Archiver</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach ($res as $key => $modele) {
                $idModele = $modele->getIdModele();
                $nomModele = $modele->getNom();
                $quantite = $modele->getQuantite();
                $archivageModele = $modele->getArchivageModele();
                echo
                    '<tr>
                    <th class="text-center" scope="row">' . $idModele . '</th>
                    <td class="text-center">' . $nomModele . '</td>
                    <td class="text-center">' . $quantite . '</td>                  
                    <td class="text-center"><a type="button" class="btn btn-outline-dark align-middle" href="?page=concepteur/modifModele&idModele=' . $idModele . '">Modifier</a></td>                  
                    <td class="text-center"><a type="button" class="btn btn-primary align-middle" name="archiver" href="?page=concepteur/statistics&idModele=' . $idModele . '">Archiver</a></td>                                                        
                    </tr>';
            } ?>
        </tbody>
    </table>
    </div>
</div>
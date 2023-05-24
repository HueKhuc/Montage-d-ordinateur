<?php
namespace Controller\Concepteur;

use Controller\AbstractController;
use Model\Composant;
use PDO;
class AjoutComposantController extends AbstractController {

public function getContent(): array {
  
  // Récupération de données de la table Composant
$sqlClass = 'SELECT * FROM composant';
$sth = $this->db->prepare($sqlClass);
$sth->setFetchMode(PDO::FETCH_CLASS, Composant::class);
$sth->execute();
$results = $sth->fetchAll();

if (isset($_POST['composant'])) {
    echo '<div class="alert alert-success my-5" role="alert">Composant ajouté !</div>';

// Insertion de données dans la table Composant
    $sqlInsertComposant = 'INSERT INTO composant(nom, marque, categorie, prix, quantite, estPortable, archivage)
        VALUES (:nom, :marque, :categorie, :prix, :quantite, :estPortable, :archivage)';

    $pdoStatement = $this->db->prepare($sqlInsertComposant);

    $categorie = $_POST['categorie'];
    $portable = 0;
    if ($_POST['estPortable'] == 'on') {
        $portable = 1;
    }
    $archivage = 0;

    $pdoStatement->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
    $pdoStatement->bindValue(':marque', $_POST['marque'], PDO::PARAM_STR);
    $pdoStatement->bindValue(':categorie', $_POST['categorie'], PDO::PARAM_STR);
    $pdoStatement->bindValue(':prix', $_POST['prix'], PDO::PARAM_INT);
    $pdoStatement->bindValue(':quantite', $_POST['quantite'], PDO::PARAM_INT);
    $pdoStatement->bindValue(':estPortable', $portable, PDO::PARAM_INT);
    $pdoStatement->bindValue(':archivage', $archivage, PDO::PARAM_INT);
    $pdoStatement->execute();
    $idComposant = $this->db->lastInsertId();

// Insertion de données dans les tables enfants
    if ($categorie == 'Alimentation') {
        $sql = 'INSERT INTO alimentation(idComposant, puissance)
        VALUES (:idComposant, :puissance)';
        $params = [
            ':idComposant' => $idComposant,
            ':puissance' => $_POST['puissance'],

        ];
    } elseif ($categorie == 'Carte Mere') {
        $sql = 'INSERT INTO carte_mere
        VALUES (:idComposant, :socket, :format)';
        $params = [
            ':idComposant' => $idComposant,
            ':socket' => $_POST['socket'],
            ':format' => $_POST['format'],

        ];
    } elseif ($categorie == 'Disque dur') {
        $sql = 'INSERT INTO disque_dur
        VALUES (:idComposant, :estSsd, :capaciteDisqueDur)';
        $params = [
            ':idComposant' => $idComposant,
            ':estSsd' => $_POST['estSsd'],
            ':capaciteDisqueDur' => $_POST['capaciteDisqueDur'],

        ];
    } elseif ($categorie == 'Memoire vive') {
        $sql = 'INSERT INTO memoire_vive
        VALUES (:idComposant, :capaciteMemoireVive, :nbBarrettes, :type)';
        $params = [
            ':idComposant' => $idComposant,
            ':capaciteMemoireVive' => $_POST['capaciteMemoireVive'],
            ':nbBarrettes' => $_POST['nbBarrettes'],
            ':type' => $_POST['type'],
        ];
    } elseif ($categorie == 'Carte Graphique') {
        $sql = 'INSERT INTO carte_graphique
        VALUES (:idComposant, :chipset, :memoire)';
        $params = [
            ':idComposant' => $idComposant,
            ':chipset' => $_POST['chipset'],
            ':memoire' => $_POST['memoire'],

        ];
    } elseif ($categorie == 'Clavier') {
        $fil = 0;
        if ($_POST['Fil'] == '1') {
            $fil = 1;
        }
        $pave = 0;
        if ($_POST['Pave'] == '1') {
            $pave = 1;
        }
        $sql = 'INSERT INTO clavier
        VALUES (:idComposant, :clavierSansFil, :paveNumerique, :typeTouche)';
        $params = [
            ':idComposant' => $idComposant,
            ':clavierSansFil' => $fil,
            ':paveNumerique' => $pave,
            ':typeTouche' => $_POST['typeTouche'],
        ];
    } elseif ($categorie == 'Ecran') {
        $sql = 'INSERT INTO ecran
        VALUES (:idComposant, :taille)';
        $params = [
            ':idComposant' => $idComposant,
            ':taille' => $_POST['taille'],
        ];
    } elseif ($categorie == 'Souris') {
        $filSouris = 0;
        if ($_POST['avecFilSouris'] == 'on') {
            $filSouris = 1;
        }
        $sql = 'INSERT INTO souris
        VALUES (:idComposant, :sourisSansFil, :nbTouches)';
        $params = [
            ':idComposant' => $idComposant,
            ':sourisSansFil' => $filSouris,
            ':nbTouches' => $_POST['nbTouches'],
        ];
    } elseif ($categorie == 'Processeur') {
        $sql = 'INSERT INTO processeur
        VALUES (:id, :frequence, :nbCoeurs, :chipsetcompatible)';
        $params = [
            ':idComposant' => $idComposant,
            ':frequence' => $_POST['frequence'],
            ':nbCoeurs' => $_POST['nbCoeurs'],
            ':chipsetCompatible' => $_POST['chipsetCompatible'],
        ];
    }
    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
}
  return [
    'results' => $results,
];
}
public function getFileName(): string {
  return 'Concepteur/ajoutComposant';
}
public function getPageTitle(): string {
  return 'Ajouter un composant';
}
}
?>
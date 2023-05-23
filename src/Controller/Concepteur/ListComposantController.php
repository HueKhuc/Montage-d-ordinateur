<?php
namespace Controller\Concepteur;

use Controller\AbstractController;
use Model\Composant;
use Model\ComposantsFilter;
use PDO;

class ListComposantController extends AbstractController
{
    public function getContent(): array
    {
        // Tri de la liste des composants
        $sql_order = 'SELECT nom, marque, composant.quantite, prix, categorie, dateAjoutComposant, estPortable, composant.idComposant, COUNT(DISTINCT montage.idModele) AS quantiteModele 
FROM composant 
    LEFT JOIN montage ON montage.idComposant = composant.idComposant
GROUP BY composant.idComposant';
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
            } elseif ($tri === 'dateAjoutComposant') {
                $sql_order .= ' ORDER BY ' . $tri;
            } else {
                $sql_order .= ' ORDER BY idComposant';
            }
        }
        $sth = $this->db->prepare($sql_order);
        $sth->setFetchMode(PDO::FETCH_CLASS, Composant::class);
        $sth->execute();
        $results = $sth->fetchAll();
        $composantsfilter = new ComposantsFilter($_POST, $results);

        // Fonction archivage/suppression de composant
        if (isset($_GET['idComposant'])) {
            if (isset($_GET['delete'])) {
                foreach (Composant::CATEGORIES as $categorie => $label) {
                    $sqlSupp = 'DELETE FROM ' . $categorie . ' WHERE idComposant = :idComposant';
                    $pdoStatement = $this->db->prepare($sqlSupp);
                    $pdoStatement->bindValue(':idComposant', $_GET['idComposant'], PDO::PARAM_INT);
                    $pdoStatement->execute();
                }
                $sqlSupp = 'DELETE FROM composant WHERE idComposant = :idComposant';
                $pdoStatement = $this->db->prepare($sqlSupp);
                $pdoStatement->bindValue(':idComposant', $_GET['idComposant'], PDO::PARAM_INT);
                $pdoStatement->execute();
                echo '<div class="alert alert-danger my-5" role="alert">Composant supprimé</div>';
            } else {
                $sqlUpdateArchivage = 'UPDATE composant 
                           SET archivage = :archivage
                           WHERE idComposant = :idComposant';
                $pdoStatement = $this->db->prepare($sqlUpdateArchivage);
                $pdoStatement->bindValue(':archivage', 1, PDO::PARAM_BOOL);
                $pdoStatement->bindValue(':idComposant', $_GET['idComposant'], PDO::PARAM_INT);
                $pdoStatement->execute();
                echo '<div class="alert alert-success my-5" role="alert">Composant archivé</div>';
            }
        }

        return [
            'composantsfilter'=>$composantsfilter,
            'tri'=>$tri
    ];
    }
    public function getFileName(): string
    {
        return 'Concepteur/listComposant';
    }
    public function getPageTitle(): string
    {
        return 'Liste des composants';
    }
}
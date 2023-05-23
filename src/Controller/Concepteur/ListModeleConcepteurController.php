<?php
namespace Controller\Concepteur;

use Controller\AbstractController;
use Model\ModelesFilter;
use PDO;

class ListModeleConcepteurController extends AbstractController
{
    public function getContent(): array
    {
        // Tri de la liste des modèles + Fonction prix modèle
        $sql_order = ('SELECT modele.*, sum(montage.quantite*composant.prix) AS prixModele 
    FROM modele 
        LEFT JOIN montage ON modele.idModele = montage.idModele
        LEFT JOIN composant ON composant.idComposant = montage.idComposant
        GROUP BY modele.idModele');
        $tri = '';
        if (isset($_POST['trier'])) {
            $tri = $_POST['trier'];
            $choixTri = ['idModele', 'quantite', 'nom', 'dateAjoutModele'];
            if (in_array($tri, $choixTri, true)) {
                $sql_order .= ' ORDER BY ' . $tri;
            } else {
                $sql_order .= ' ORDER BY idModele';
            }
        }
        $sth = $this->db->prepare($sql_order);
        $sth->setFetchMode(PDO::FETCH_CLASS, Modele::class);
        $sth->execute();
        $results = $sth->fetchAll();
        $modelesfilter = new ModelesFilter($_POST, $results);

        return ['modelesfilter' => $modelesfilter];
    }

    public function getFileName(): string
    {
        return 'Concepteur/listModeleConcepteur';
    }

    public function getPageTitle(): string
    {
        return 'Liste des modèles';
    }

}
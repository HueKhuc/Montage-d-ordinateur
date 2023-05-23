<?php
namespace Controller\Monteur;
use PDO;
use Model\Modele;

use Controller\AbstractController;

class ListModeleMonteurController extends AbstractController
{

    public function getContent(): array
    {
        // Récupération des données en BDD
$sqlVerif = "SELECT montage.quantite as quantiteDemandee, composant.quantite as quantiteDispo 
FROM `montage` 
    INNER JOIN composant ON composant.idComposant = montage.idComposant 
WHERE idModele = :idModele
GROUP BY montage.idComposant 
HAVING (quantiteDispo - quantiteDemandee < 0)";
$sthCompte = $this->db->prepare($sqlVerif);

if (isset($_GET['id'])) {
    $idModele = $_GET['id'];

    $sthCompte->bindValue(':idModele', $idModele, PDO::PARAM_INT);
    $sthCompte->execute();
    $resCompte = $sthCompte->fetchAll();

    if (empty($resCompte)) {

        $sqlMod = 'UPDATE modele SET quantite = quantite + 1 WHERE idModele = :id';
        $sthMod = $this->db->prepare($sqlMod);
        $sthMod->bindValue(':id', $idModele, PDO::PARAM_INT);
        $sthMod->execute();

        $sqlAss = 'SELECT * FROM montage WHERE idModele = :id';
        $sthAss = $this->db->prepare($sqlAss);
        $sthAss->bindValue(':id', $idModele, PDO::PARAM_INT);
        $sthAss->execute();
        $ass = $sthAss->fetchAll();
        
        foreach ($ass as $compo) {

            $sqlCompo = 'UPDATE composant SET quantite = quantite - :quantite WHERE idComposant = :id';
            $sthCompo = $this->db->prepare($sqlCompo);
            $sthCompo->bindValue(':id', $compo['idComposant'], PDO::PARAM_INT);
            $sthCompo->bindValue(':quantite', $compo['quantite'], PDO::PARAM_INT);
            $sthCompo->execute();

            $sqlStock = 'INSERT INTO stock(idComposant, quantite, entree) VALUES
        (:id, :quantite, :entree)';
            $sthStock = $this->db->prepare($sqlStock);
            $sthStock->bindValue(':id', $compo['idComposant'], PDO::PARAM_INT);
            $sthStock->bindValue(':quantite', $compo['quantite'], PDO::PARAM_INT);
            $sthStock->bindValue(':entree', 0, PDO::PARAM_BOOL);
            $sthStock->execute();
        }
    }
    header('Location: ?page=monteur/listModeleMonteur');
}

$sql_order = ('SELECT * FROM modele ');
$sth = $this->db->prepare($sql_order);
$sth->setFetchMode(PDO::FETCH_CLASS, Modele::class);
$sth->execute();
$results = $sth->fetchAll();
        return [
            'results' => $results,
            'sthCompte' => $sthCompte,
        ];
    }
    public function getFileName(): string
    {
        return 'monteur/listModeleMonteur';
    }
    public function getPageTitle(): string
    {
        return 'Liste des modèles';
    }
}
?>
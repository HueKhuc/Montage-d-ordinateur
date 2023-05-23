<?php
namespace Controller\Commun;

use PDO;
use Model\Modele;
use Model\Alimentation;
use Model\Souris;
use Model\CarteGraphique;
use Model\CarteMere;
use Model\Clavier;
use Model\Processeur;
use Model\DisqueDur;
use Model\Ecran;
use Model\MemoireVive;
use Model\Message;
use Model\Utilisateur;

use Controller\AbstractController;

class DetailModeleController extends AbstractController
{

    public function getContent(): array
    {
        $idModele = $_GET['idModele'];

        // Récupération des infos en BDD
        $pdoStat = $this->db->prepare('SELECT * FROM modele WHERE idModele = :idModele');
        $pdoStat->bindValue(':idModele', $idModele, PDO::PARAM_INT);
        $pdoStat->setFetchMode(PDO::FETCH_CLASS, Modele::class);
        $pdoStat->execute();
        $modele = $pdoStat->fetch();

        $pdo = $this->db->prepare('SELECT utilisateur.nom, modele.idUtilisateur 
                    FROM utilisateur
                    LEFT JOIN modele ON utilisateur.idUtilisateur = modele.idUtilisateur
                    WHERE modele.idModele = :idModele');
        $pdo->bindValue(':idModele', $idModele, PDO::PARAM_INT);
        $pdo->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        $pdo->execute();
        $util = $pdo->fetch();

        $sql = $this->db->prepare("SELECT 
composant.*,
montage.quantite as quantiteModele,
alimentation.*,
carte_graphique.*,
carte_mere.*,
clavier.*,
disque_dur.*,
ecran.*,
memoire_vive.*,
processeur.*,
souris.*
FROM composant
INNER JOIN montage ON composant.idComposant = montage.idComposant
LEFT JOIN alimentation ON composant.idComposant = alimentation.idComposant
LEFT JOIN carte_graphique ON composant.idComposant = carte_graphique.idComposant
LEFT JOIN carte_mere ON composant.idComposant = carte_mere.idComposant
LEFT JOIN clavier ON composant.idComposant = clavier.idComposant
LEFT JOIN disque_dur ON composant.idComposant = disque_dur.idComposant
LEFT JOIN ecran ON composant.idComposant = ecran.idComposant
LEFT JOIN memoire_vive ON composant.idComposant = memoire_vive.idComposant
LEFT JOIN processeur ON composant.idComposant = processeur.idComposant
LEFT JOIN souris ON composant.idComposant = souris.idComposant
WHERE idModele = :idModele");
        $sql->bindValue(':idModele', $idModele, PDO::PARAM_INT);
        $sql->execute();
        $res = $sql->fetchAll();

        $results = [];
        foreach ($res as $tableauComposant) {
            $categorie = 'Model\\'.str_replace(' ', '', $tableauComposant['categorie']);
            $composantObj = new $categorie($tableauComposant);
            $results[] = $composantObj;
        }
        if (isset($_POST['submit'])) {

            $statement = $this->db->prepare('INSERT INTO message (texte, idModele, idUtilisateur) VALUES (:texte, :idModele, :idUtilisateur)');
            $statement->bindValue(':texte', $_POST['commentaire'], PDO::PARAM_STR);
            $statement->bindValue(':idModele', $_GET['idModele'], PDO::PARAM_INT);
            $statement->bindValue(':idUtilisateur', $_SESSION["idUtilisateur"], PDO::PARAM_INT);
            $statement->execute();
        }

        $staCo = $this->db->prepare('SELECT message.*, utilisateur.nom AS userName FROM message 
INNER JOIN utilisateur ON message.idUtilisateur = utilisateur.idUtilisateur
WHERE idModele = :idModele ORDER BY dateMessage ');
        $staCo->bindValue(":idModele", $idModele, PDO::PARAM_INT);
        $staCo->setFetchMode(PDO::FETCH_CLASS, Message::class);
        $staCo->execute();
        $resCo = $staCo->fetchAll();

        $sqlUpdateCo = 'UPDATE message 
                        SET estLu = :estLu
                        WHERE idModele = :idModele AND idUtilisateur != :idUtilisateur';
        $updateCo = $this->db->prepare($sqlUpdateCo);
        $updateCo->bindValue(':estLu', 1, PDO::PARAM_BOOL);
        $updateCo->bindValue(':idModele', $_GET['idModele'], PDO::PARAM_INT);
        $updateCo->bindValue(':idUtilisateur', $_SESSION["idUtilisateur"], PDO::PARAM_INT);
        $updateCo->execute();
        return [
            'results' => $results,
            'res' => $res,
            'resCo' => $resCo,
            'modele' => $modele,
            'util' => $util,
            'idModele' => $idModele,
        ];
    }
    public function getFileName(): string
    {
        return 'Commun/detailModele';
    }
    public function getPageTitle(): string
    {
        return 'Détails du modèle';
    }
}
?>
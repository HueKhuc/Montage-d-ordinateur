<?php
namespace Controller\Concepteur;

use Controller\AbstractController;
use Model\Modele;
use Model\Composant;
use Model\Alimentation;
use Model\Souris;
use Model\CarteGraphique;
use Model\CarteMere;
use Model\Clavier;
use Model\Processeur;
use Model\DisqueDur;
use Model\Ecran;
use Model\MemoireVive;

use PDO;

class ModifModeleController extends AbstractController
{

  public function getContent(): array
  {
    if (isset($_GET['idModele']) && isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') {
      $id = $_GET['idModele'];

      // Récupération de données
      $pdoStat = $this->db->prepare('SELECT * FROM modele WHERE idModele = :idModele');
      $pdoStat->bindValue(':idModele', $id, PDO::PARAM_INT);
      $pdoStat->setFetchMode(PDO::FETCH_CLASS, Modele::class);
      $pdoStat->execute();
      $modele = $pdoStat->fetch();

      $sqlSelect = $this->db->prepare("SELECT 
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
      $sqlSelect->bindValue(':idModele', $id, PDO::PARAM_INT);
      $sqlSelect->execute();
      $res = $sqlSelect->fetchAll();


      $results = [];
      foreach ($res as $caracTab) {
        $categorie = 'Model\\'. str_replace(' ', '', $caracTab['categorie']);
        $caracObj = new $categorie($caracTab);
        $results[] = $caracObj;
      }

      $sta = $this->db->prepare('SELECT * FROM composant');
      $sta->setFetchMode(PDO::FETCH_CLASS, Composant::class);
      $sta->execute();
      $composants = $sta->fetchAll();

      if (isset($_POST['modifier'])) {
        echo '<div class="alert alert-success my-5" role="alert">Modèle modifié !</div>';
        // Update la table 'Modele'
        $sqlUpdateMod = 'UPDATE modele
                                SET estPortable = :estPortable, quantite = :quantite, nom =:nom, description = :description
                                WHERE idModele = :idModele';
        $pdoUpdateMod = $this->db->prepare($sqlUpdateMod);
        $pdoUpdateMod->bindValue(':idModele', $id, PDO::PARAM_INT);
        $pdoUpdateMod->bindValue(':estPortable', $_POST['estPortable'], PDO::PARAM_INT);
        $pdoUpdateMod->bindValue(':quantite', $_POST['quantiteModele'], PDO::PARAM_INT);
        $pdoUpdateMod->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $pdoUpdateMod->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
        $pdoUpdateMod->execute();

        // Update la table 'Montage'
        $sqlDelMontage = 'DELETE FROM montage WHERE idModele = :idModele';
        $pdoDelMontage = $this->db->prepare($sqlDelMontage);
        $pdoDelMontage->bindValue(':idModele', $id, PDO::PARAM_INT);
        $pdoDelMontage->execute();

        foreach ($results as $composant) {
          $cat = str_replace(' ', '', $composant->getCategorie());
          $sqlInsertMontage = 'INSERT INTO montage (idModele, idComposant, quantite)
                                    VALUES (:idModele, :idComposant,:quantite)';
          $pdoInsertMontage = $this->db->prepare($sqlInsertMontage);
          $pdoInsertMontage->bindValue(':idModele', $id, PDO::PARAM_INT);
          $pdoInsertMontage->bindValue(':idComposant', $_POST[$cat], PDO::PARAM_INT);
          $pdoInsertMontage->bindValue(':quantite', $_POST['quantite' . $cat], PDO::PARAM_INT);
          $pdoInsertMontage->execute();
        }
      }
      return [
        'res' => $res,
        'composants' => $composants,
        'results' => $results,
        // 'caracTab' => $caracTab,
        'modele' => $modele,
      ];
    }
  }
  public function getFileName(): string
  {
    return 'Concepteur/modifModele';
  }
  public function getPageTitle(): string
  {
    return 'Modifier un modèle';
  }
}
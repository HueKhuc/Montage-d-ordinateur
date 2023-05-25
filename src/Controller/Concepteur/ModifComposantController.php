<?php
namespace Controller\Concepteur;

use Controller\AbstractController;
use PDO;


class ModifComposantController extends AbstractController
{

  public function getContent(): array
  {
    // Récupération de données de la table Composant
    if (isset($_GET['idComposant']) && isset($_SESSION['type']) && $_SESSION['type'] == 'concepteur') {
      $idComposant = $_GET['idComposant'];

      if (isset($_POST['modifier'])) {
        echo '<div class="alert alert-success my-5" role="alert">Done</div>';
        // Insertion de données dans la table Composant
        $sqlUpdateComposant = '
          UPDATE composant
          SET nom = :nom,
              marque = :marque,
              prix = :prix,
              quantite = :quantite,
              estPortable = :estPortable
          WHERE idComposant = :idComposant';
        $pdoStatement = $this->db->prepare($sqlUpdateComposant);

        $pdoStatement->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':marque', $_POST['marque'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':prix', $_POST['prix'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':quantite', $_POST['quantite'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':estPortable', $_POST['estPortable'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':idComposant', $idComposant, PDO::PARAM_INT);

        $pdoStatement->execute();

        // Insertion de données dans les tables enfants
        $categorie = $_POST['categorie'];
        if ($categorie == 'Alimentation') {
          $sql = 'UPDATE alimentation
                  SET puissance = :puissance
                  WHERE idComposant = :idComposant ';
          $params = [
            ':idComposant' => $idComposant,
            ':puissance' => $_POST['puissance'],

          ];
        } elseif ($categorie == 'Carte Mere') {
          $sql = 'UPDATE carte_mere
                  SET socket = :socket,
                      format = :format
                  WHERE idComposant = :idComposant ';
          $params = [
            ':idComposant' => $idComposant,
            ':socket' => $_POST['socket'],
            ':format' => $_POST['format'],

          ];
        } elseif ($categorie == 'Disque dur') {
          $sql = 'UPDATE disque_dur
                  SET ssd = :ssd,
                      capaciteDisque = :capacite
                  WHERE idComposant = :idComposant';
          $params = [
            ':idComposant' => $idComposant,
            ':estSsd' => $_POST['estSsd'],
            ':capaciteDisqueDur' => $_POST['capaciteDisqueDur'],

          ];
        } elseif ($categorie == 'Memoire vive') {
          $sql = 'UPDATE memoire_vive
                  SET capaciteMemoireVive = :capaciteMemoireVive,
                      nbBarrettes = :nbBarrettes,
                      type = :type
                  WHERE idComposant = :idComposant ';
          $params = [
            ':idComposant' => $idComposant,
            ':capaciteMemoireVive' => $_POST['capacite'],
            ':nbBarrettes' => $_POST['nbBarrettes'],
            ':type' => $_POST['type'],
          ];
        } elseif ($categorie == 'Carte Graphique') {
          $sql = 'UPDATE carte_graphique
                  SET chipset = :chipset,
                      memoire = :memoire
                  WHERE idComposant = :idComposant ';
          $params = [
            ':idComposant' => $idComposant,
            ':chipset' => $_POST['chipset'],
            ':memoire' => $_POST['memoire'],

          ];
        } elseif ($categorie == 'Clavier') {
          $sql = 'UPDATE clavier
                  SET clavierSansFil = :clavierSansFil,
                      paveNumerique = :paveNumerique,
                      typeTouche = :typeTouche
                  WHERE idComposant = :idComposant';
          $params = [
            ':idComposant' => $idComposant,
            ':clavierSansFil' => $_POST['sansFil'],
            ':paveNumerique' => $_POST['avecPave'],
            ':typeTouche' => $_POST['typeTouche'],
          ];
        } elseif ($categorie == 'Ecran') {
          $sql = 'UPDATE ecran
                  SET taille = :taille,
                  WHERE idComposant = :idComposant';
          $params = [
            ':idComposant' => $idComposant,
            ':taille' => $_POST['taille'],
          ];
        } elseif ($categorie == 'Souris') {
          $sql = 'UPDATE souris
                  SET sourisSansFil = :sourisSansFil,
                      nbTouches = :nbTouches,
                  WHERE idComposant = :idComposant';
          $params = [
            ':idComposant' => $idComposant,
            ':sourisSansFil' => $_POST['sourisSansFil'],
            ':nbTouches' => $_POST['nbTouches'],
          ];
        } elseif ($categorie == 'Processeur') {
          $sql = 'UPDATE processeur
                  SET frequence = :frequence,
                      nbCoeurs = :nbCoeurs,
                      chipsetCompatible = :chipsetCompatible
                  WHERE idComposant = :idComposant';
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

      // Récupération de données
      $sqlSelect = $this->db->prepare("SELECT 
  composant.*,
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
  LEFT JOIN alimentation ON composant.idComposant = alimentation.idComposant
  LEFT JOIN carte_graphique ON composant.idComposant = carte_graphique.idComposant
  LEFT JOIN carte_mere ON composant.idComposant = carte_mere.idComposant
  LEFT JOIN clavier ON composant.idComposant = clavier.idComposant
  LEFT JOIN disque_dur ON composant.idComposant = disque_dur.idComposant
  LEFT JOIN ecran ON composant.idComposant = ecran.idComposant
  LEFT JOIN memoire_vive ON composant.idComposant = memoire_vive.idComposant
  LEFT JOIN processeur ON composant.idComposant = processeur.idComposant
  LEFT JOIN souris ON composant.idComposant = souris.idComposant
  WHERE composant.idComposant = :idComposant");
      $sqlSelect->bindValue(':idComposant', $idComposant, PDO::PARAM_INT);
      $sqlSelect->execute();
      $res = $sqlSelect->fetchAll();

    }
    return [
      'res' => $res,
      
    ];
  }
  public function getFileName(): string
  {
    return 'Concepteur/modifComposant';
  }
  public function getPageTitle(): string
  {
    return 'Modifier un composant';
  }
}
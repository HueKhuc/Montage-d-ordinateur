<?php
namespace Controller\Concepteur;

use Controller\AbstractController;
use Model\Message;
use Model\Modele;
use PDO;

class StatistiquesController extends AbstractController
{

  public function getContent(): array
  {
    // Récupération des données en BDD
    $sqlStat = 'SELECT message.*, utilisateur.nom AS userName
                FROM message
                LEFT JOIN utilisateur ON utilisateur.idUtilisateur = message.idUtilisateur';
    $sth = $this->db->prepare($sqlStat);
    $sth->setFetchMode(PDO::FETCH_CLASS, Message::class);
    $sth->execute();
    $results = $sth->fetchAll();

    $sqlMod = 'SELECT * FROM modele';
    $sti = $this->db->prepare($sqlMod);
    $sti->setFetchMode(PDO::FETCH_CLASS, Modele::class);
    $sti->execute();
    $res = $sti->fetchAll();

    // Fonction archivage du modèle
    if (isset($_GET['idModele'])) {
      $sqlUpdateArchivage = 'UPDATE modele 
         SET archivageModele = :archivageModele
         WHERE idModele = :idModele';
      $pdoStatement = $this->db->prepare($sqlUpdateArchivage);
      $pdoStatement->bindValue(':archivageModele', 1, PDO::PARAM_BOOL);
      $pdoStatement->bindValue(':idModele', $_GET['idModele'], PDO::PARAM_INT);
      $pdoStatement->execute();
      echo '<div class="alert alert-success my-5" role="alert">Modèle archivé !</div>';
    }
    return [
      'res' => $res,
      'results' => $results,
    ];
  }
  public function getFileName(): string
  {
    return 'Concepteur/statistiques';
  }
  public function getPageTitle(): string
  {
    return 'Statistiques';
  }
}
?>
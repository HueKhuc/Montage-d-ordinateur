<?php
namespace Controller\Concepteur;
use Controller\AbstractController;
use Model\Composant;
use PDO;
class AjoutModeleController extends AbstractController {

public function getContent(): array {

  // Récupération de données de la table Composants
$sta = $this->db->prepare('SELECT * FROM composant');
$sta->setFetchMode(PDO::FETCH_CLASS, Composant::class);
$sta->execute();
$results = $sta->fetchAll();
$errors = [];

if (isset($_POST['modele'])) {
    
    foreach (Composant::LIMITS as $slug => $limit) {
        if (empty($_POST[$slug . '_quantite'])) {
            $errors[$slug] = "Veuillez saisir la quantité";
        } elseif ($_POST[$slug] && $_POST[$slug . '_quantite'] > $limit) {
            $errors[$slug] = "Trop grande quantité";
        }
    }
    if (empty($errors)) {
// Insertion des données dans la table Modèles
        $sqlModele = 'INSERT INTO modele(nom, estPortable, quantite, idUtilisateur, description)
            VALUES (:nom, :estPortable, :quantite, :idUtilisateur, :description)';
        $pdoStat = $this->db->prepare($sqlModele);
        $pdoStat->bindValue(':nom', $_POST['modele'], PDO::PARAM_STR);
        $pdoStat->bindValue(':estPortable', $_POST['estPortable'], PDO::PARAM_BOOL);
        $pdoStat->bindValue(':quantite', 0, PDO::PARAM_INT);
        $pdoStat->bindValue(':idUtilisateur', $_SESSION["idUtilisateur"], PDO::PARAM_STR);
        $pdoStat->bindValue(':description', $_POST["description"], PDO::PARAM_STR);
        $pdoStat->execute();
        $idModele = $this->db->lastInsertId();
        foreach (Composant::CATEGORIES as $slug => $categorie) {
            $sqlComponent = 'INSERT INTO montage VALUES (:idModele, :idComposant, :quantite)';
            $pdoStat = $this->db->prepare($sqlComponent);
            $pdoStat->bindValue(':quantite', $_POST[$slug . '_quantite'], PDO::PARAM_INT);
            $pdoStat->bindValue(':idModele', $idModele, PDO::PARAM_INT);
            $pdoStat->bindValue(':idComposant', $_POST[$slug], PDO::PARAM_INT);
            $pdoStat->execute();
        }
    }
}

  return [
    'results' => $results
];
}
public function getFileName(): string {
  return 'Concepteur/ajoutModele';
}
public function getPageTitle(): string {
  return 'Ajouter un modèle';
}
}
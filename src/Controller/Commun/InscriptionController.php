<?php
namespace Controller\Commun;
use Controller\AbstractController;
use PDO;
class InscriptionController extends AbstractController {

public function getContent(): array {

  $idUtilisateur = null;
// Récupération des données POST
if (isset($_POST["nom"]) && isset($_POST["motDePasse"])) {
    $motDePasse = $_POST['motDePasse'];
    $nom = $_POST['nom'];
    $utilisateur = $_POST['utilisateur'];
    $motDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);

// Insertion dans la table utilisateur
    $subStatement = $this->db->prepare('INSERT INTO utilisateur (nom, motDePasse) VALUES (:nom, :motDePasse)');
    $subStatement->execute([
        ':nom' => $nom,
        ':motDePasse' => $motDePasse
    ]);

// Insertion dans la table concepteur ou dans la table monteur
    $idUtilisateur = $this->db->lastInsertId();
    if (isset($_POST['utilisateur']) && $_POST['utilisateur'] == 'concepteur') {
        $stmt = $this->db->prepare('INSERT INTO concepteur (idUtilisateur) VALUES (:idUtilisateur)');
        $stmt->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $stmt->execute();
    } elseif (isset($_POST['utilisateur']) && $_POST['utilisateur'] == 'monteur') {
        $stmt = $this->db->prepare('INSERT INTO monteur (idUtilisateur) VALUES (:idUtilisateur)');
        $stmt->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $stmt->execute();
    }
}
  return [
    'idUtilisateur'=>$idUtilisateur
  ];
}
public function getFileName(): string {
  return 'Commun/inscription';
}
public function getPageTitle(): string {
  return 'Inscription';
}
}
?>
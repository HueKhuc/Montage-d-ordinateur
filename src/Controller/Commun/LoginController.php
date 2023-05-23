<?php
namespace Controller\Commun;

use Controller\AbstractController;


class LoginController extends AbstractController
{

  public function getContent(): array
  {
    $loginErrors = [];

    // Récupération et comparaison des données POST avec la BDD
    if (isset($_POST["nom"]) && isset($_POST["motDePasse"])) {
      $motDePasse = $_POST["motDePasse"];
      $nom = $_POST["nom"];
      $subStatement = $this->db->prepare('SELECT 
                utilisateur.motDePasse,
                utilisateur.idUtilisateur AS IdU,
                concepteur.idUtilisateur AS IdC,
                monteur.idUtilisateur AS IdM
                FROM utilisateur
                LEFT JOIN concepteur ON utilisateur.idUtilisateur = concepteur.idUtilisateur
                LEFT JOIN monteur ON utilisateur.idUtilisateur = monteur.idUtilisateur
                WHERE nom = :nom'
      );
      $subStatement->execute([':nom' => $nom]);
      
      $results = $subStatement->fetch();
      if (!$results) {
        $loginErrors[] = "Le nom d'utilisateur n'existe pas";
      } else {
      $motDePasseBdd = $results['motDePasse'];


      // Gestion des cas d'erreurs possibles
      if (empty($motDePasse)) {
        $loginErrors[] = "Veuillez saisir un mot de passe";
      } elseif (password_verify($motDePasse, $motDePasseBdd) === false) {
        $loginErrors[] = "Mot de passe incorrect";
      }

      if (empty($nom)) {
        $loginErrors[] = "Veuillez saisir un nom";
      }

      if (empty($loginErrors) && password_verify($motDePasse, $motDePasseBdd) == true) {
        $_SESSION["nom"] = $_POST["nom"];
        $_SESSION["idUtilisateur"] = $results['IdU'];
        $_SESSION['type'] = 'utilisateur';
        if ($results['IdC'] != null) {
          $_SESSION["type"] = "concepteur";
        } elseif ($results['IdM'] != null) {
          $_SESSION["type"] = "monteur";
        }
        header("Location: index.php?page=commun/home&login=success");
      }
    }
  }
    return [
      'loginErrors' => $loginErrors
    ];
  }
  public function getFileName(): string
  {
    return 'Commun/login';
  }
  public function getPageTitle(): string
  {
    return 'Connexion';
  }
}
?>
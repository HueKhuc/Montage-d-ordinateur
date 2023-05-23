<?php
namespace Controller\Commun;
use Controller\AbstractController;
use PDO;
class AjoutModeleController extends AbstractController {

public function getContent(): array {
  return [];
}
public function getFileName(): string {
  return 'Concepteur/ajoutModele';
}
public function getPageTitle(): string {
  return 'Ajouter un modèle';
}
}
?>
<?php
namespace Controller\Concepteur;

use Controller\AbstractController;
use PDO;

class ModifModeleController extends AbstractController {

public function getContent(): array {
  return [];
}
public function getFileName(): string {
  return 'Concepteur/modifModele';
}
public function getPageTitle(): string {
  return 'Modifier un modèle';
}
}
?>
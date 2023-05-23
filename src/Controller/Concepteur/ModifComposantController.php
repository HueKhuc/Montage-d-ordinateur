<?php
namespace Controller\Concepteur;

use Controller\AbstractController;
use PDO;

class ModifComposantController extends AbstractController {

public function getContent(): array {
  return [];
}
public function getFileName(): string {
  return 'Concepteur/modifComposant';
}
public function getPageTitle(): string {
  return 'Modifier un composant';
}
}
?>
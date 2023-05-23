<?php
namespace Controller\Concepteur;

use Controller\AbstractController;
use PDO;

class StatistiquesController extends AbstractController {

public function getContent(): array {
  return [];
}
public function getFileName(): string {
  return 'Concepteur/statistiques';
}
public function getPageTitle(): string {
  return 'Statistiques';
}
}
?>
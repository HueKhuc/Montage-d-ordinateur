<?php
namespace Controller\Commun;
use Controller\AbstractController;
use PDO;
class AjoutComposantController extends AbstractController {

public function getContent(): array {
  return [];
}
public function getFileName(): string {
  return 'Concepteur/ajoutComposant';
}
public function getPageTitle(): string {
  return 'Ajouter un composant';
}
}
?>
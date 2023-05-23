<?php
namespace Controller\Concepteur;
use Controller\AbstractController; 
use PDO;
class FormReponseController extends AbstractController {

public function getContent(): array {
  return [];
}
public function getFileName(): string {
  return 'Concepteur/formReponse';
}
public function getPageTitle(): string {
  return 'Formulaire de réponse';
}
}
?>
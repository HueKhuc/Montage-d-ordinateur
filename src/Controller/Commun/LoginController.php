<?php
namespace Controller\Commun;
use Controller\AbstractController;
class LoginController extends AbstractController {

public function getContent(): array {
  return [];
}
public function getFileName(): string {
  return 'Commun/login';
}
public function getPageTitle(): string {
  return 'Connexion';
}
}
?>
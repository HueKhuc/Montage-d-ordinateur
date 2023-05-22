<?php
namespace Controller\Commun;
use Controller\AbstractController;
class LogoutController extends AbstractController {

public function getContent(): array {
  return [];
}
public function getFileName(): string {
  return 'Commun/logout';
}
public function getPageTitle(): string {
  return 'Déconnexion';
}
}
?>
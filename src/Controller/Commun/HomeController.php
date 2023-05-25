<?php
namespace Controller\Commun;
use Controller\AbstractController;

class HomeController extends AbstractController {

public function getContent(): array {
  return [];
}

public function getFileName(): string {
  return 'Commun/home';
}

public function getPageTitle(): string {
  return 'Accueil';
}

}
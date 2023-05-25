<?php
namespace Controller\Commun;

use Controller\AbstractController;

class LogoutController extends AbstractController
{

  public function getContent(): array
  {
    session_destroy();
    header("Location:index.php?logout=success");
    return [];
  }
  public function getFileName(): string
  {
    return 'Commun/logout';
  }
  public function getPageTitle(): string
  {
    return 'Déconnexion';
  }
}
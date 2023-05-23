<?php
namespace Controller\Concepteur;
use Controller\AbstractController;
use PDO;
class StockComposantController extends AbstractController {

public function getContent(): array {
  return [];
}
public function getFileName(): string {
  return 'Concepteur/stockComposant';
}
public function getPageTitle(): string {
  return 'Gestion du stock';
}
}
?>
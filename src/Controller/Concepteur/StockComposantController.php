<?php
namespace Controller\Concepteur;
use Controller\AbstractController;
use Model\Stock;
use PDO;

class StockComposantController extends AbstractController {

public function getContent(): array {

$sqlStock = $this->db->prepare('SELECT * FROM stock WHERE idComposant = :idComposant');
$sqlStock->bindValue(':idComposant', $_GET['idStock'], PDO::PARAM_INT);
$sqlStock->setFetchMode(PDO::FETCH_CLASS, Stock::class);
$sqlStock->execute();
$resultStock = $sqlStock->fetchAll();
  return [
    'resultStock' => $resultStock,
];
}
public function getFileName(): string {
  return 'Concepteur/stockComposant';
}
public function getPageTitle(): string {
  return 'Gestion du stock';
}
}
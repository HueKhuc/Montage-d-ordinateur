<?php
namespace Controller;
use PDO;
abstract class AbstractController {
  
protected PDO $db;
public function __construct(PDO $db)
{
    $this->db = $db;
}

public function render()
{
  session_start();
  ob_start();

  require_once 'includes/function.php';

  $pageTitle = $this->getPageTitle();

  include_once 'src/View/header.php';

  $viewParams = $this->getContent();
  extract($viewParams);
  include_once 'src/View/' . $this->getFileName() . '.php';

  include_once 'src/View/footer.php';

  ob_end_flush();
}

abstract public function getContent(): array;
abstract public function getFileName(): string;
abstract public function getPageTitle(): string;
}
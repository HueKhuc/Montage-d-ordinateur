<?php
use Controller\Commun\DetailModeleController;
use Controller\Commun\InscriptionController;
use Controller\Commun\HomeController;
use Controller\Commun\LoginController;
use Controller\Commun\LogoutController;
use Controller\Concepteur\AjoutComposantController;
use Controller\Concepteur\AjoutModeleController;
use Controller\Concepteur\FormReponseController;
use Controller\Concepteur\ListComposantController;
use Controller\Concepteur\ListModeleConcepteurController;
use Controller\Concepteur\ModifComposantController;
use Controller\Concepteur\ModifModeleController;
use Controller\Concepteur\StatistiquesController;
use Controller\Concepteur\StockComposantController;
use Controller\Monteur\ListModeleController;

include 'includes/autoload.php';
include 'includes/config.inc.php';
$pages = [
  'commun/home'                              => HomeController::class,
  'commun/inscription'                       => InscriptionController::class,
  'commun/login'                             => LoginController::class,
  'commun/logout'                            => LogoutController::class,
  'commun/detailModele'                      => DetailModeleController::class,
  'concepteur/listComposant'                 => ListComposantController::class,
  'concepteur/ajoutComposant'                => AjoutComposantController::class,
  'concepteur/modifComposant'                => ModifComposantController::class,
  'concepteur/listModeleConcepteur'          => ListModeleConcepteurController::class,
  'concepteur/ajoutModele'                   => AjoutModeleController::class,  
  'concepteur/modifModele'                   => ModifModeleController::class,
  'concepteur/statistiques'                  => StatistiquesController::class,
  'concepteur/stockComposant'                => StockComposantController::class,
  'concepteur/formReponse'                   => FormReponseController::class,  
  'monteur/listModeleMonteur'                => ListModeleController::class,
];
$page = 'commun/home';
if (isset($_GET['page']) && array_key_exists($_GET['page'], $pages)) {
  $page = $_GET['page'];
}
$controller = $pages[$page];
$current = new $controller($db);
$current->render();
?>
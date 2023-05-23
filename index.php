<?php
use Controller\Commun\DetailModeleController;
use Controller\Commun\InscriptionController;
use Controller\Commun\HomeController;
use Controller\Commun\LoginController;
use Controller\Commun\LogoutController;
use Controller\Concepteur\AjoutComposantController;
use Controller\Concepteur\AjoutModeleController;
use Controller\Concepteur\FormReponseController;
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
  'concepteur/listComposant'                 => 'Liste des composants',
  'concepteur/ajoutComposant'                => AjoutComposantController::class,
  'concepteur/modifComposant'                => 'Modifier un composant',
  'concepteur/listModeleConcepteur'          => 'Liste des modèles',
  'concepteur/ajoutModele'                   => AjoutModeleController::class,  
  'concepteur/modifModele'                   => 'Modifier un modèle',
  'concepteur/statistiques'                  => 'Statistiques',
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
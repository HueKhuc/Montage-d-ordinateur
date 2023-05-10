<?php 
require_once 'includes/header.php';
$page = 'commun/home';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
require_once 'pages/' . $page .'.php';
require_once 'includes/footer.php';
?>

<?php
 /*
$pages = [
  'home'                => 'Accueil',
  'inscription'         => 'Inscription',
  'login'               => 'Connexion',
  'logout'              => 'Déconnexion',
  'listComposant'       => 'Liste des composants',
  'ajoutComposant'      => 'Ajouter un composant',
  'modifComposant'      => 'Modifier un composant',
  'stockComposant'      => 'Gestion du stock',
  'statistics'          => 'Statistiques',
  'formReponse'         => 'Formulaire de réponse',
  'listModele'          => 'Liste des modèles',
  'detailModele'        => 'Détails du modèle',
  'ajoutModele'         => 'Ajouter un modèle',
  'modifModele'         => 'Modifier un modèle',
];
$page = $_GET['page'];
if (isset($_GET['page']) && in_array($_GET['page'], $pages)) {
  $page = $_GET['page'];
}
$pageTitle = $pages[$page];
require_once 'includes/header.php';
include 'pages/' . $page . '.php';
require_once 'includes/footer.php';
*/
?> 
<?php
ob_start();
$pages = [
  'commun/home'                              => 'Accueil',
  'commun/inscription'                       => 'Inscription',
  'commun/login'                             => 'Connexion',
  'commun/logout'                            => 'Déconnexion',
  'commun/detailModele'                      => 'Détails du modèle',
  'concepteur/listComposant'                 => 'Liste des composants',
  'concepteur/ajoutComposant'                => 'Ajouter un composant',
  'concepteur/modifComposant'                => 'Modifier un composant',
  'concepteur/stockComposant'                => 'Gestion du stock',
  'concepteur/statistics'                    => 'Statistiques',
  'concepteur/formReponse'                   => 'Formulaire de réponse',  
  'concepteur/listModeleConcepteur'          => 'Liste des modèles',
  'concepeur/ajoutModele'                    => 'Ajouter un modèle',  
  'concepteur/modifModele'                   => 'Modifier un modèle',
  'monteur/listModeleMonteur'                => 'Liste des modèles',
  'monteur/formCommentaire'                  => 'Formulaire de commentaire',
];
$page = 'commun/home';
if (isset($_GET['page']) && array_key_exists($_GET['page'], $pages)) {
  $page = $_GET['page'];
}
$pageTitle = $pages[$page];
require_once 'includes/header.php';
include 'pages/' . $page . '.php';
require_once 'includes/footer.php';
ob_end_flush();
?>
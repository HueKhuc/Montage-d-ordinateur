<?php

$pages = [
  'commun/home'                              => 'Accueil',
  'commun/inscription'                       => 'Inscription',
  'commun/login'                             => 'Connexion',
  'commun/logout'                            => 'Déconnexion',
  'concepteur/listComposant'                 => 'Liste des composants',
  'concepteur/ajoutComposant'                => 'Ajouter un composant',
  'concepteur/modifComposant'                => 'Modifier un composant',
  'concepteur/stockComposant'                => 'Gestion du stock',
  'concepteur/statistics'                    => 'Statistiques',
  'concepteur/formReponse'                   => 'Formulaire de réponse',
  'concepteur/listModeleConcepteur'          => 'Liste des modèles',
  'commun/detailModele'                      => 'Détails du modèle',
  'commun/ajoutModele'                       => 'Ajouter un modèle',
  'concepteur/modifModele'                   => 'Modifier un modèle',
];
$page = $_GET['page'];
if (isset($_GET['page']) && in_array($_GET['page'], $pages)) {
  $page = $_GET['page'];
}
$pageTitle = $pages[$page];
require_once 'includes/header.php';
include 'pages/' . $page . '.php';
require_once 'includes/footer.php';

?>
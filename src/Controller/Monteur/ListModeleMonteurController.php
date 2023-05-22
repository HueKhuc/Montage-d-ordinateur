<?php
namespace Controller\Monteur;

use Controller\AbstractController;

class ListModeleController extends AbstractController
{

    public function getContent(): array
    {
        return [];
    }
    public function getFileName(): string
    {
        return 'monteur/listModeleMonteur';
    }
    public function getPageTitle(): string
    {
        return 'Liste des modèles';
    }
}
?>
<?php
namespace Controller\Commun;

use Controller\AbstractController;

class DetailModeleController extends AbstractController
{

    public function getContent(): array
    {
        return [];
    }
    public function getFileName(): string
    {
        return 'Commun/detailModele';
    }
    public function getPageTitle(): string
    {
        return 'Détails du modèle';
    }
}
?>
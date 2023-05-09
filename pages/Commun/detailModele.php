<?php
$sta = $db->prepare('SELECT 
assembler.Id_Composant, 
assembler.quantite as quantiteModele, 
composant.*
FROM assembler
INNER JOIN composant ON composant.Id_Composant = assembler.Id_Composant
WHERE Id_Modele = :idModele
');
$sta->setFetchMode(PDO::FETCH_CLASS, Composant::class);
$sta->bindValue(':idModele', $_GET['id'], PDO::PARAM_INT);
$sta->execute();
$results = $sta->fetchAll();



var_dump($results);
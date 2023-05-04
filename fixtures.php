<?php
spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});

require_once 'function.php';
require_once 'config.inc.php';

$sqlComposant = 'INSERT INTO composant(nom, marque, categorie, prix, quantite, isLaptop, archivage)
        VALUES (:nom, :marque, :categorie, :prix, :quantite, :isLaptop, :archivage)';

$pdoStatement = $connection->prepare($sqlComposant);

$alimentation1 = new Alimentation();
$alimentation1->setNom("LUX 750");
$alimentation1->setMarque('Aerocool');
$alimentation1->setCategorie('Alimentation');
$alimentation1->setprix(80);
$alimentation1->setQuantite(3);
$alimentation1->setIsLaptop(false);
$alimentation1->setArchivage(false);
$alimentation1->setPuissance(750);

$alimentation2 = new Alimentation();
$alimentation2->setNom("LUX 1000");
$alimentation2->setMarque('Aerocool');
$alimentation2->setCategorie('Alimentation');
$alimentation2->setprix(130);
$alimentation2->setQuantite(9);
$alimentation2->setIsLaptop(false);
$alimentation2->setArchivage(false);
$alimentation2->setPuissance(1000);

$alimentation3 = new Alimentation();
$alimentation3->setNom("RM850");
$alimentation3->setMarque('Corsair');
$alimentation3->setCategorie('Alimentation');
$alimentation3->setprix(175);
$alimentation3->setQuantite(2);
$alimentation3->setIsLaptop(false);
$alimentation3->setArchivage(false);
$alimentation3->setPuissance(850);

$alimentation4 = new Alimentation();
$alimentation4->setNom("ROG STRIX");
$alimentation4->setMarque('Asus');
$alimentation4->setCategorie('Alimentation');
$alimentation4->setprix(200);
$alimentation4->setQuantite(6);
$alimentation4->setIsLaptop(false);
$alimentation4->setArchivage(false);
$alimentation4->setPuissance(850);


$carteMere1 = new CarteMere();
$carteMere1->setNom("A620M");
$carteMere1->setMarque('ASRock');
$carteMere1->setCategorie('Carte Mere');
$carteMere1->setprix(125);
$carteMere1->setQuantite(4);
$carteMere1->setIsLaptop(false);
$carteMere1->setArchivage(false);
$carteMere1->setSocket('AMD AM5');
$carteMere1->setFormat('ATX');

$carteMere2 = new CarteMere();
$carteMere2->setNom("B550");
$carteMere2->setMarque('ASRock');
$carteMere2->setCategorie('Carte Mere');
$carteMere2->setprix(170);
$carteMere2->setQuantite(7);
$carteMere2->setIsLaptop(false);
$carteMere2->setArchivage(false);
$carteMere2->setSocket('AMD AM4');
$carteMere2->setFormat('ATX');

$carteMere3 = new CarteMere();
$carteMere3->setNom("B650 Pro");
$carteMere3->setMarque('ASRock');
$carteMere3->setCategorie('Carte Mere');
$carteMere3->setprix(300);
$carteMere3->setQuantite(1);
$carteMere3->setIsLaptop(false);
$carteMere3->setArchivage(false);
$carteMere3->setSocket('AMD AM5');
$carteMere3->setFormat('ATX');

$carteMere4 = new CarteMere();
$carteMere4->setNom("TUF Gaming B550");
$carteMere4->setMarque('Asus');
$carteMere4->setCategorie('Carte Mere');
$carteMere4->setprix(165);
$carteMere4->setQuantite(4);
$carteMere4->setIsLaptop(false);
$carteMere4->setArchivage(false);
$carteMere4->setSocket('AMD AM4');
$carteMere4->setFormat('Micro-ATX');

$disqueDur1 = new DisqueDur();
$disqueDur1->setNom("BarraCuda 2 To");
$disqueDur1->setMarque('Seagate');
$disqueDur1->setCategorie('Disque dur');
$disqueDur1->setprix(50);
$disqueDur1->setQuantite(3);
$disqueDur1->setIsLaptop(false);
$disqueDur1->setArchivage(false);
$disqueDur1->setSsd(false);
$disqueDur1->setCapacite(2000);

$disqueDur2 = new DisqueDur();
$disqueDur2->setNom("BarraCuda 4 To");
$disqueDur2->setMarque('Seagate');
$disqueDur2->setCategorie('Disque dur');
$disqueDur2->setprix(90);
$disqueDur2->setQuantite(5);
$disqueDur2->setIsLaptop(false);
$disqueDur2->setArchivage(false);
$disqueDur2->setSsd(false);
$disqueDur2->setCapacite(4000);

$disqueDur3 = new DisqueDur();
$disqueDur3->setNom("PM18 M2");
$disqueDur3->setMarque('Fox Spirit');
$disqueDur3->setCategorie('Disque dur');
$disqueDur3->setprix(80);
$disqueDur3->setQuantite(7);
$disqueDur3->setIsLaptop(true);
$disqueDur3->setArchivage(false);
$disqueDur3->setSsd(true);
$disqueDur3->setCapacite(960);

$disqueDur4 = new DisqueDur();
$disqueDur4->setNom("Force MP600");
$disqueDur4->setMarque('Corsair');
$disqueDur4->setCategorie('Disque dur');
$disqueDur4->setprix(150);
$disqueDur4->setQuantite(2);
$disqueDur4->setIsLaptop(true);
$disqueDur4->setArchivage(false);
$disqueDur4->setSsd(true);
$disqueDur4->setCapacite(1000);

$memoireVive1 = new MemoireVive();
$memoireVive1->setNom("Akura CL18");
$memoireVive1->setMarque('Fox Spirit');
$memoireVive1->setCategorie('Memoire vive');
$memoireVive1->setprix(90);
$memoireVive1->setQuantite(2);
$memoireVive1->setIsLaptop(false);
$memoireVive1->setArchivage(false);
$memoireVive1->setCapacite(16);
$memoireVive1->setNbBarrettes(2);
$memoireVive1->setType('DDR4 3600 MHz PC4-28800');

$memoireVive2 = new MemoireVive();
$memoireVive2->setNom("Dominator CL40");
$memoireVive2->setMarque('Corsair');
$memoireVive2->setCategorie('Memoire vive');
$memoireVive2->setprix(240);
$memoireVive2->setQuantite(6);
$memoireVive2->setIsLaptop(false);
$memoireVive2->setArchivage(false);
$memoireVive2->setCapacite(32);
$memoireVive2->setNbBarrettes(2);
$memoireVive2->setType('DDR5 5200 MHz PC5-41600');

$memoireVive3 = new MemoireVive();
$memoireVive3->setNom("Dominator CL32");
$memoireVive3->setMarque('Corsair');
$memoireVive3->setCategorie('Memoire vive');
$memoireVive3->setprix(380);
$memoireVive3->setQuantite(2);
$memoireVive3->setIsLaptop(false);
$memoireVive3->setArchivage(false);
$memoireVive3->setCapacite(64);
$memoireVive3->setNbBarrettes(2);
$memoireVive3->setType('DDR5 6600 MHz PC5-52800');

$memoireVive4 = new MemoireVive();
$memoireVive4->setNom("Vengeance CL36");
$memoireVive4->setMarque('Corsair');
$memoireVive4->setCategorie('Memoire vive');
$memoireVive4->setprix(140);
$memoireVive4->setQuantite(2);
$memoireVive4->setIsLaptop(false);
$memoireVive4->setArchivage(false);
$memoireVive4->setCapacite(32);
$memoireVive4->setNbBarrettes(2);
$memoireVive4->setType('DDR5 6000 MHz PC4-32400');


$composants = [
    $alimentation1,
    $alimentation2,
    $alimentation3,
    $alimentation4,
    $carteMere1,
    $carteMere2,
    $carteMere3,
    $carteMere4,
    $disqueDur1,
    $disqueDur2,
    $disqueDur3,
    $disqueDur4,
    $memoireVive1,
    $memoireVive2,
    $memoireVive3,
    $memoireVive4,
    $carteGraphique1,
    $carteGraphique2,
    $carteGraphique3,
    $carteGraphique4,
    $clavier1,
    $clavier2,
    $clavier3,
    $clavier4,
    $ecran1,
    $ecran2,
    $ecran3,
    $ecran4,
    $souris1,
    $souris2,
    $souris3,
    $souris4,
    $processeur1,
    $processeur2,
    $processeur3,
    $processeur4,
];

foreach ($composants as $composant) {
    $pdoStatement->bindValue(':nom', $composant->getNom(), PDO::PARAM_STR);
    $pdoStatement->bindValue(':marque', $composant->getMarque(), PDO::PARAM_INT);
    $pdoStatement->bindValue(':categorie', $composant->getCategorie(), PDO::PARAM_STR);
    $pdoStatement->bindValue(':prix', $composant->getPrix(), PDO::PARAM_STR);
    $pdoStatement->bindValue(':quantite', $composant->getQuantite(), PDO::PARAM_STR);
    $pdoStatement->bindValue(':isLaptop', $composant->getIsLaptop(), PDO::PARAM_STR);
    $pdoStatement->bindValue(':archivage', $composant->getArchivage(), PDO::PARAM_STR);
    $count = $pdoStatement->execute();

    $id = $connection->lastInsertId();

    if ($composant instanceof Alimentation) {
        $sql = 'INSERT INTO Alimentation';
    } elseif ($composant instanceof CarteMere) {
        $sql = 'INSERT INTO carte_mere';
    } elseif ($composant instanceof DisqueDur) {
        $sql = 'INSERT INTO disque_dur';
    } elseif ($composant instanceof MemoireVive) {
        $sql = 'INSERT INTO memoire_vive';
    } elseif ($composant instanceof CarteGraphique) {
        $sql = 'INSERT INTO carte_graphique';
    } elseif ($composant instanceof Clavier) {
        $sql = 'INSERT INTO clavier';
    } elseif ($composant instanceof Ecran) {
        $sql = 'INSERT INTO ecran';
    } elseif ($composant instanceof Souris) {
        $sql = 'INSERT INTO souris';
    } elseif ($composant instanceof Processeur) {
        $sql = 'INSERT INTO processeur';
    }
}

// var_dump($count);
?>
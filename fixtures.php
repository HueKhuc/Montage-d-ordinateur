<?php
spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});
require_once 'includes/function.php';
require_once 'includes/config.inc.php';

$sqlTruncate = 'SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE composant;
TRUNCATE TABLE alimentation;
TRUNCATE TABLE carte_mere;
TRUNCATE TABLE disque_dur;
TRUNCATE TABLE memoire_vive;
TRUNCATE TABLE carte_graphique;
TRUNCATE TABLE clavier;
TRUNCATE TABLE ecran;
TRUNCATE TABLE souris;
TRUNCATE TABLE processeur;
TRUNCATE TABLE gestion_stock;
TRUNCATE TABLE assembler;
TRUNCATE TABLE gerer;
TRUNCATE TABLE message;
TRUNCATE TABLE modele;
SET FOREIGN_KEY_CHECKS = 1;';
$db->exec($sqlTruncate);

// Insertion des composants en BDD
$sqlComposant = 'INSERT INTO composant(nom, marque, categorie, prix, quantite, isLaptop, archivage)
        VALUES (:nom, :marque, :categorie, :prix, :quantite, :isLaptop, :archivage)';
$pdoStatement = $db->prepare($sqlComposant);

$sqlStock = 'INSERT INTO gestion_stock(nom, quantite) VALUES
(:nom, :quantite)';  
$pdoStatementStock = $db->prepare($sqlStock);


$alimentation1 = new Alimentation();
$alimentation1->setNom("LUX 750");
$alimentation1->setMarque('Aerocool');
$alimentation1->setCategorie('Alimentation');
$alimentation1->setprix(80);
$alimentation1->setQuantite(0);
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

$carteGraphique1 = new CarteGraphique();
$carteGraphique1->setNom('Radeon RX 6500 XT OC');
$carteGraphique1->setMarque('ASUS');
$carteGraphique1->setCategorie('Carte Graphique');
$carteGraphique1->setPrix(180.27);
$carteGraphique1->setQuantite(10);
$carteGraphique1->setIsLaptop(true);
$carteGraphique1->setArchivage(false);
$carteGraphique1->setChipset('AMD');
$carteGraphique1->setMemoire(4);

$carteGraphique2 = new CarteGraphique();
$carteGraphique2->setNom('Radeon RX 550 GDDR5');
$carteGraphique2->setMarque('Maxsun');
$carteGraphique2->setCategorie('Carte Graphique');
$carteGraphique2->setPrix(103.67);
$carteGraphique2->setQuantite(20);
$carteGraphique2->setIsLaptop(false);
$carteGraphique2->setArchivage(false);
$carteGraphique2->setChipset('AMD');
$carteGraphique2->setMemoire(4);

$carteGraphique3 = new CarteGraphique();
$carteGraphique3->setNom('Radeon RX 6600 Gaming GDDR6');
$carteGraphique3->setMarque('Sapphire');
$carteGraphique3->setCategorie('Carte Graphique');
$carteGraphique3->setPrix(259.99);
$carteGraphique3->setQuantite(5);
$carteGraphique3->setIsLaptop(true);
$carteGraphique3->setArchivage(false);
$carteGraphique3->setChipset('AMD');
$carteGraphique3->setMemoire(8);

$carteGraphique4 = new CarteGraphique();
$carteGraphique4->setNom('GT 710 DDR3 Evo');
$carteGraphique4->setMarque('ASUS');
$carteGraphique4->setCategorie('Carte Graphique');
$carteGraphique4->setPrix(50.10);
$carteGraphique4->setQuantite(50);
$carteGraphique4->setIsLaptop(false);
$carteGraphique4->setArchivage(false);
$carteGraphique4->setChipset('NVIDIA');
$carteGraphique4->setMemoire(2);

$clavier1 = new Clavier();
$clavier1->setNom('K120 Clavier filaire Business Windows');
$clavier1->setMarque('Logitech');
$clavier1->setCategorie('Clavier');
$clavier1->setPrix(12.99);
$clavier1->setQuantite(20);
$clavier1->setIsLaptop(true);
$clavier1->setArchivage(false);
$clavier1->setSansFil(false);
$clavier1->setPaveNumerique(true);
$clavier1->setTypeTouche('Clavier à membrane');

$clavier2 = new Clavier();
$clavier2->setNom('G815 LIGHTSPEED Clavier Gamer');
$clavier2->setMarque('Logitech');
$clavier2->setCategorie('Clavier');
$clavier2->setPrix(155.99);
$clavier2->setQuantite(10);
$clavier2->setIsLaptop(true);
$clavier2->setArchivage(false);
$clavier2->setSansFil(true);
$clavier2->setPaveNumerique(true);
$clavier2->setTypeTouche('Clavier mécanique');

$clavier3 = new Clavier();
$clavier3->setNom('Clavier sans Fil Rechargeable');
$clavier3->setMarque('JELLY OFFICE');
$clavier3->setCategorie('Clavier');
$clavier3->setPrix(44.99);
$clavier3->setQuantite(25);
$clavier3->setIsLaptop(true);
$clavier3->setArchivage(false);
$clavier3->setSansFil(true);
$clavier3->setPaveNumerique(true);
$clavier3->setTypeTouche('Clavier mécanique');

$clavier4 = new Clavier();
$clavier4->setNom('Balance Keyboard Wired');
$clavier4->setMarque('Contour');
$clavier4->setCategorie('Clavier');
$clavier4->setPrix(125.57);
$clavier4->setQuantite(5);
$clavier4->setIsLaptop(true);
$clavier4->setArchivage(false);
$clavier4->setSansFil(false);
$clavier4->setPaveNumerique(true);
$clavier4->setTypeTouche('Ergonomique');

$ecran1 = new Ecran();
$ecran1->setNom('S24R35AFHU');
$ecran1->setMarque('Samsung');
$ecran1->setCategorie('Ecran');
$ecran1->setPrix(129);
$ecran1->setQuantite(30);
$ecran1->setIsLaptop(false);
$ecran1->setArchivage(false);
$ecran1->setTaille(24);

$ecran2 = new Ecran();
$ecran2->setNom('EK240YC');
$ecran2->setMarque('Acer');
$ecran2->setCategorie('Ecran');
$ecran2->setPrix(99);
$ecran2->setQuantite(5);
$ecran2->setIsLaptop(false);
$ecran2->setArchivage(false);
$ecran2->setTaille(23.8);

$ecran3 = new Ecran();
$ecran3->setNom('273V7QDSB/00');
$ecran3->setMarque('Philips');
$ecran3->setCategorie('Ecran');
$ecran3->setPrix(126.52);
$ecran3->setQuantite(35);
$ecran3->setIsLaptop(false);
$ecran3->setArchivage(false);
$ecran3->setTaille(27);

$ecran4 = new Ecran();
$ecran4->setNom('Zenscreen MB165B');
$ecran4->setMarque('ASUS');
$ecran4->setCategorie('Ecran');
$ecran4->setPrix(150.90);
$ecran4->setQuantite(15);
$ecran4->setIsLaptop(true);
$ecran4->setArchivage(false);
$ecran4->setTaille(15.6);

$souris1 = new Souris();
$souris1->setNom('M185');
$souris1->setMarque('Logitech');
$souris1->setCategorie('Souris');
$souris1->setPrix(13.99);
$souris1->setQuantite(40);
$souris1->setIsLaptop(true);
$souris1->setArchivage(false);
$souris1->setSansFil(true);
$souris1->setNbTouche(2);

$souris2 = new Souris();
$souris2->setNom('Scimitar ELITE MOBA/MMO');
$souris2->setMarque('Corsair');
$souris2->setCategorie('Souris');
$souris2->setPrix(69.99);
$souris2->setQuantite(5);
$souris2->setIsLaptop(true);
$souris2->setArchivage(false);
$souris2->setSansFil(true);
$souris2->setNbTouche(17);

$souris3 = new Souris();
$souris3->setNom('G600 MMO');
$souris3->setMarque('Logitech ');
$souris3->setCategorie('Souris');
$souris3->setPrix(57.20);
$souris3->setQuantite(15);
$souris3->setIsLaptop(true);
$souris3->setArchivage(false);
$souris3->setSansFil(false);
$souris3->setNbTouche(20);

$souris4 = new Souris();
$souris4->setNom('Tartarus V2');
$souris4->setMarque('Razer');
$souris4->setCategorie('Souris');
$souris4->setPrix(83.30);
$souris4->setQuantite(21);
$souris4->setIsLaptop(true);
$souris4->setArchivage(false);
$souris4->setSansFil(false);
$souris4->setNbTouche(32);

$processeur1 = new Processeur();
$processeur1->setNom('AMD Ryzen 7 5800X');
$processeur1->setMarque('AMD');
$processeur1->setCategorie('Processeur');
$processeur1->setPrix(250.04);
$processeur1->setQuantite(10);
$processeur1->setIsLaptop(false);
$processeur1->setArchivage(false);
$processeur1->setFrequence(3.8);
$processeur1->setNbCoeurs(8);
$processeur1->setChipsetCompatible('HDMP-1032');

$processeur2 = new Processeur();
$processeur2->setNom('Core i5-12400F');
$processeur2->setMarque('Intel');
$processeur2->setCategorie('Processeur');
$processeur2->setPrix(177.33);
$processeur2->setQuantite(15);
$processeur2->setIsLaptop(true);
$processeur2->setArchivage(false);
$processeur2->setFrequence(2.5);
$processeur2->setNbCoeurs(6);
$processeur2->setChipsetCompatible('HDMP-1034');

$processeur3 = new Processeur();
$processeur3->setNom('Core i7-13700KF');
$processeur3->setMarque('Intel');
$processeur3->setCategorie('Processeur');
$processeur3->setPrix(443.16);
$processeur3->setQuantite(10);
$processeur3->setIsLaptop(true);
$processeur3->setArchivage(false);
$processeur3->setFrequence(2.5);
$processeur3->setNbCoeurs(16);
$processeur3->setChipsetCompatible('HDMP-1034');

$processeur4 = new Processeur();
$processeur4->setNom('CoreTM i5-10400F');
$processeur4->setMarque('Intel');
$processeur4->setCategorie('Processeur');
$processeur4->setPrix(110.27);
$processeur4->setQuantite(10);
$processeur4->setIsLaptop(true);
$processeur4->setArchivage(false);
$processeur4->setFrequence(4.3);
$processeur4->setNbCoeurs(6);
$processeur4->setChipsetCompatible('HDMP-1032');

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
    $pdoStatement->bindValue(':marque', $composant->getMarque(), PDO::PARAM_STR);
    $pdoStatement->bindValue(':categorie', $composant->getCategorie(), PDO::PARAM_STR);
    $pdoStatement->bindValue(':prix', $composant->getPrix(), PDO::PARAM_STR);
    $pdoStatement->bindValue(':quantite', $composant->getQuantite(), PDO::PARAM_STR);
    $pdoStatement->bindValue(':isLaptop', $composant->getIsLaptop(), PDO::PARAM_STR);
    $pdoStatement->bindValue(':archivage', $composant->getArchivage(), PDO::PARAM_STR);
    $pdoStatementStock->bindValue(':nom', $composant->getNom(), PDO::PARAM_STR);
$pdoStatementStock->bindValue(':quantite', $composant->getQuantite(), PDO::PARAM_INT);

    $count = $pdoStatement->execute();
    $id = $db->lastInsertId();
    $pdoStatementStock->execute();

// Insertion des caractéristiques spécifiques des composants en BDD
    if ($composant instanceof Alimentation) {
        $sql = 'INSERT INTO alimentation(Id_Composant, puissance)
        VALUES (:id, :puissance)';
        $params = [
            ':id' => $id,
            ':puissance' => $composant->getPuissance(),            
        ];
    } elseif ($composant instanceof CarteMere) {
        $sql = 'INSERT INTO carte_mere
        VALUES (:id, :socket, :format)';
        $params = [
            ':id' => $id,
            ':socket' => $composant->getSocket(),
            ':format' => $composant->getFormat(),            
        ];
    } elseif ($composant instanceof DisqueDur) {
        $sql = 'INSERT INTO disque_dur
        VALUES (:id, :ssd, :capacite)';
        $params = [
            ':id' => $id,
            ':ssd' => $composant->getSsd(),
            ':capacite' => $composant->getCapacite(),            
        ];
    } elseif ($composant instanceof MemoireVive) {
        $sql = 'INSERT INTO memoire_vive
        VALUES (:id, :capacite, :nbBarrettes, :type)';
        $params = [
            ':id' => $id,
            ':capacite' => $composant->getCapacite(),
            ':nbBarrettes' => $composant->getNbBarrettes(),
            ':type' => $composant->getType(),
        ];
    } elseif ($composant instanceof CarteGraphique) {
        $sql = 'INSERT INTO carte_graphique
        VALUES (:id, :chipset, :memoire)';
        $params = [
            ':id' => $id,
            ':chipset' => $composant->getChipset(),
            ':memoire' => $composant->getMemoire(),            
        ];
    } elseif ($composant instanceof Clavier) {
        $sql = 'INSERT INTO clavier
        VALUES (:id, :sansfil, :pavenumerique, :typetouche)';
        $params = [
            ':id' => $id,
            ':sansfil' => $composant->getSansFil(),
            ':pavenumerique' => $composant->getPaveNumerique(),
            ':typetouche' => $composant->getTypeTouche(),            
        ];
    } elseif ($composant instanceof Ecran) {
        $sql = 'INSERT INTO ecran
        VALUES (:id, :taille)';
        $params = [
            ':id' => $id,
            ':taille' => $composant->getTaille(),            
        ];
    } elseif ($composant instanceof Souris) {
        $sql = 'INSERT INTO souris
        VALUES (:id, :sansfil, :nbtouche)';
        $params = [
            ':id' => $id,
            ':sansfil' => $composant->getSansFil(),
            ':nbtouche' => $composant->getNbTouche(),            
        ];
    } elseif ($composant instanceof Processeur) {
        $sql = 'INSERT INTO processeur
        VALUES (:id, :frequence, :nbcoeurs, :chipsetcompatible)';
        $params = [
            ':id' => $id,
            ':frequence' => $composant->getFrequence(),
            ':nbcoeurs' => $composant->getNbCoeurs(),
            ':chipsetcompatible' => $composant->getChipsetCompatible(),            
        ];
    } 
    $stmt = $db->prepare($sql);
    $stmt->execute($params);


}
?>
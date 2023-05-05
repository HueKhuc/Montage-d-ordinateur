-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 05 mai 2023 à 14:24
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `montage_ordi`
--

-- --------------------------------------------------------

--
-- Structure de la table `alimentation`
--

DROP TABLE IF EXISTS `alimentation`;
CREATE TABLE IF NOT EXISTS `alimentation` (
  `Id_Composant` int NOT NULL,
  `puissance` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `alimentation`
--

INSERT INTO `alimentation` (`Id_Composant`, `puissance`) VALUES
(1, '750'),
(2, '1000'),
(3, '850'),
(4, '850');

-- --------------------------------------------------------

--
-- Structure de la table `assembler`
--

DROP TABLE IF EXISTS `assembler`;
CREATE TABLE IF NOT EXISTS `assembler` (
  `Id_Modele` int NOT NULL,
  `Id_Composant` int NOT NULL,
  `quantite` smallint NOT NULL,
  PRIMARY KEY (`Id_Modele`,`Id_Composant`),
  KEY `Id_Composant` (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `assembler`
--

INSERT INTO `assembler` (`Id_Modele`, `Id_Composant`, `quantite`) VALUES
(9, 1, 1),
(9, 5, 1),
(9, 9, 3),
(9, 13, 2),
(9, 17, 1),
(9, 21, 1),
(9, 25, 1),
(9, 29, 1),
(9, 33, 1);

-- --------------------------------------------------------

--
-- Structure de la table `carte_graphique`
--

DROP TABLE IF EXISTS `carte_graphique`;
CREATE TABLE IF NOT EXISTS `carte_graphique` (
  `Id_Composant` int NOT NULL,
  `chipset` varchar(50) DEFAULT NULL,
  `memoire` int DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `carte_graphique`
--

INSERT INTO `carte_graphique` (`Id_Composant`, `chipset`, `memoire`) VALUES
(17, 'AMD', 4),
(18, 'AMD', 4),
(19, 'AMD', 8),
(20, 'NVIDIA', 2);

-- --------------------------------------------------------

--
-- Structure de la table `carte_mere`
--

DROP TABLE IF EXISTS `carte_mere`;
CREATE TABLE IF NOT EXISTS `carte_mere` (
  `Id_Composant` int NOT NULL,
  `socket` varchar(50) DEFAULT NULL,
  `format` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `carte_mere`
--

INSERT INTO `carte_mere` (`Id_Composant`, `socket`, `format`) VALUES
(5, 'AMD AM5', 'ATX'),
(6, 'AMD AM4', 'ATX'),
(7, 'AMD AM5', 'ATX'),
(8, 'AMD AM4', 'Micro-ATX');

-- --------------------------------------------------------

--
-- Structure de la table `clavier`
--

DROP TABLE IF EXISTS `clavier`;
CREATE TABLE IF NOT EXISTS `clavier` (
  `Id_Composant` int NOT NULL,
  `sansFil` tinyint(1) DEFAULT NULL,
  `paveNumerique` tinyint(1) DEFAULT NULL,
  `typeTouche` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `clavier`
--

INSERT INTO `clavier` (`Id_Composant`, `sansFil`, `paveNumerique`, `typeTouche`) VALUES
(21, 0, 1, 'Clavier à membrane'),
(22, 1, 1, 'Clavier mécanique'),
(23, 1, 1, 'Clavier mécanique'),
(24, 0, 1, 'Ergonomique');

-- --------------------------------------------------------

--
-- Structure de la table `composant`
--

DROP TABLE IF EXISTS `composant`;
CREATE TABLE IF NOT EXISTS `composant` (
  `Id_Composant` int NOT NULL AUTO_INCREMENT,
  `categorie` varchar(50) DEFAULT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `prix` decimal(5,2) DEFAULT NULL,
  `quantite` smallint DEFAULT NULL,
  `datAjout` datetime DEFAULT CURRENT_TIMESTAMP,
  `archivage` tinyint(1) DEFAULT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `isLaptop` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `composant`
--

INSERT INTO `composant` (`Id_Composant`, `categorie`, `nom`, `prix`, `quantite`, `datAjout`, `archivage`, `marque`, `isLaptop`) VALUES
(1, 'Alimentation', 'LUX 750', '80.00', 3, '2023-05-05 11:29:44', 0, 'Aerocool', 0),
(2, 'Alimentation', 'LUX 1000', '130.00', 9, '2023-05-05 11:29:44', 0, 'Aerocool', 0),
(3, 'Alimentation', 'RM850', '175.00', 2, '2023-05-05 11:29:44', 0, 'Corsair', 0),
(4, 'Alimentation', 'ROG STRIX', '200.00', 6, '2023-05-05 11:29:44', 0, 'Asus', 0),
(5, 'Carte Mere', 'A620M', '125.00', 4, '2023-05-05 11:29:44', 0, 'ASRock', 0),
(6, 'Carte Mere', 'B550', '170.00', 7, '2023-05-05 11:29:44', 0, 'ASRock', 0),
(7, 'Carte Mere', 'B650 Pro', '300.00', 1, '2023-05-05 11:29:44', 0, 'ASRock', 0),
(8, 'Carte Mere', 'TUF Gaming B550', '165.00', 4, '2023-05-05 11:29:44', 0, 'Asus', 0),
(9, 'Disque dur', 'BarraCuda 2 To', '50.00', 3, '2023-05-05 11:29:44', 0, 'Seagate', 0),
(10, 'Disque dur', 'BarraCuda 4 To', '90.00', 5, '2023-05-05 11:29:44', 0, 'Seagate', 0),
(11, 'Disque dur', 'PM18 M2', '80.00', 7, '2023-05-05 11:29:44', 0, 'Fox Spirit', 1),
(12, 'Disque dur', 'Force MP600', '150.00', 2, '2023-05-05 11:29:44', 0, 'Corsair', 1),
(13, 'Memoire vive', 'Akura CL18', '90.00', 2, '2023-05-05 11:29:44', 0, 'Fox Spirit', 0),
(14, 'Memoire vive', 'Dominator CL40', '240.00', 6, '2023-05-05 11:29:44', 0, 'Corsair', 0),
(15, 'Memoire vive', 'Dominator CL32', '380.00', 2, '2023-05-05 11:29:44', 0, 'Corsair', 0),
(16, 'Memoire vive', 'Vengeance CL36', '140.00', 2, '2023-05-05 11:29:44', 0, 'Corsair', 0),
(17, 'Carte Graphique', 'Radeon RX 6500 XT OC', '180.27', 10, '2023-05-05 11:29:44', 0, 'ASUS', 1),
(18, 'Carte Graphique', 'Radeon RX 550 GDDR5', '103.67', 20, '2023-05-05 11:29:44', 0, 'Maxsun', 0),
(19, 'Carte Graphique', 'Radeon RX 6600 Gaming GDDR6', '259.99', 5, '2023-05-05 11:29:44', 0, 'Sapphire', 1),
(20, 'Carte Graphique', 'GT 710 DDR3 Evo', '50.10', 50, '2023-05-05 11:29:44', 0, 'ASUS', 0),
(21, 'Clavier', 'K120 Clavier filaire Business Windows', '12.99', 20, '2023-05-05 11:29:44', 0, 'Logitech', 1),
(22, 'Clavier', 'G815 LIGHTSPEED Clavier Gamer', '155.99', 10, '2023-05-05 11:29:44', 0, 'Logitech', 1),
(23, 'Clavier', 'Clavier sans Fil Rechargeable', '44.99', 25, '2023-05-05 11:29:44', 0, 'JELLY OFFICE', 1),
(24, 'Clavier', 'Balance Keyboard Wired', '125.57', 5, '2023-05-05 11:29:44', 0, 'Contour', 1),
(25, 'Ecran', 'S24R35AFHU', '129.00', 30, '2023-05-05 11:29:44', 0, 'Samsung', 0),
(26, 'Ecran', 'EK240YC', '99.00', 5, '2023-05-05 11:29:44', 0, 'Acer', 0),
(27, 'Ecran', '273V7QDSB/00', '126.52', 35, '2023-05-05 11:29:44', 0, 'Philips', 0),
(28, 'Ecran', 'Zenscreen MB165B', '150.90', 15, '2023-05-05 11:29:44', 0, 'ASUS', 1),
(29, 'Souris', 'M185', '13.99', 40, '2023-05-05 11:29:44', 0, 'Logitech', 1),
(30, 'Souris', 'Scimitar ELITE MOBA/MMO', '69.99', 5, '2023-05-05 11:29:44', 0, 'Corsair', 1),
(31, 'Souris', 'G600 MMO', '57.20', 15, '2023-05-05 11:29:44', 0, 'Logitech ', 1),
(32, 'Souris', 'Tartarus V2', '83.30', 21, '2023-05-05 11:29:44', 0, 'Razer', 1),
(33, 'Processeur', 'AMD Ryzen 7 5800X', '250.04', 10, '2023-05-05 11:29:44', 0, 'AMD', 0),
(34, 'Processeur', 'Core i5-12400F', '177.33', 15, '2023-05-05 11:29:44', 0, 'Intel', 1),
(35, 'Processeur', 'Core i7-13700KF', '443.16', 10, '2023-05-05 11:29:44', 0, 'Intel', 1),
(36, 'Processeur', 'CoreTM i5-10400F', '110.27', 10, '2023-05-05 11:29:44', 0, 'Intel', 1);

-- --------------------------------------------------------

--
-- Structure de la table `concepteur`
--

DROP TABLE IF EXISTS `concepteur`;
CREATE TABLE IF NOT EXISTS `concepteur` (
  `Id_Utilisateur` int NOT NULL,
  PRIMARY KEY (`Id_Utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `concepteur`
--

INSERT INTO `concepteur` (`Id_Utilisateur`) VALUES
(5),
(7);

-- --------------------------------------------------------

--
-- Structure de la table `disque_dur`
--

DROP TABLE IF EXISTS `disque_dur`;
CREATE TABLE IF NOT EXISTS `disque_dur` (
  `Id_Composant` int NOT NULL,
  `ssd` tinyint(1) DEFAULT NULL,
  `capacite` int DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `disque_dur`
--

INSERT INTO `disque_dur` (`Id_Composant`, `ssd`, `capacite`) VALUES
(9, 0, 2000),
(10, 0, 4000),
(11, 1, 960),
(12, 1, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `ecran`
--

DROP TABLE IF EXISTS `ecran`;
CREATE TABLE IF NOT EXISTS `ecran` (
  `Id_Composant` int NOT NULL,
  `taille` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ecran`
--

INSERT INTO `ecran` (`Id_Composant`, `taille`) VALUES
(25, '24'),
(26, '23.8'),
(27, '27'),
(28, '15.6');

-- --------------------------------------------------------

--
-- Structure de la table `gerer`
--

DROP TABLE IF EXISTS `gerer`;
CREATE TABLE IF NOT EXISTS `gerer` (
  `Id_Composant` int NOT NULL,
  `Id_Gestion_stock` int NOT NULL,
  PRIMARY KEY (`Id_Composant`,`Id_Gestion_stock`),
  KEY `Id_Gestion_stock` (`Id_Gestion_stock`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `gestion_stock`
--

DROP TABLE IF EXISTS `gestion_stock`;
CREATE TABLE IF NOT EXISTS `gestion_stock` (
  `Id_Gestion_stock` int NOT NULL AUTO_INCREMENT,
  `dte` date DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `quantite` smallint DEFAULT NULL,
  `entree` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id_Gestion_stock`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `memoire_vive`
--

DROP TABLE IF EXISTS `memoire_vive`;
CREATE TABLE IF NOT EXISTS `memoire_vive` (
  `Id_Composant` int NOT NULL,
  `capacite` varchar(50) DEFAULT NULL,
  `nbBarrettes` smallint DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `memoire_vive`
--

INSERT INTO `memoire_vive` (`Id_Composant`, `capacite`, `nbBarrettes`, `type`) VALUES
(13, '16', 2, 'DDR4 3600 MHz PC4-28800'),
(14, '32', 2, 'DDR5 5200 MHz PC5-41600'),
(15, '64', 2, 'DDR5 6600 MHz PC5-52800'),
(16, '32', 2, 'DDR5 6000 MHz PC4-32400');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `Id_Message` int NOT NULL AUTO_INCREMENT,
  `dateMess` date DEFAULT NULL,
  `texte` varchar(500) DEFAULT NULL,
  `Id_Modele` int NOT NULL,
  `Id_Utilisateur` int NOT NULL,
  PRIMARY KEY (`Id_Message`),
  KEY `Id_Modele` (`Id_Modele`),
  KEY `Id_Utilisateur` (`Id_Utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `Id_Modele` int NOT NULL AUTO_INCREMENT,
  `portable` tinyint(1) DEFAULT NULL,
  `quantite` tinyint DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `dateAjout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Id_Utilisateur` int NOT NULL,
  PRIMARY KEY (`Id_Modele`),
  KEY `Id_Utilisateur` (`Id_Utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`Id_Modele`, `portable`, `quantite`, `nom`, `dateAjout`, `Id_Utilisateur`) VALUES
(8, 1, 0, 'AsusFX-015', '2023-05-05 14:03:58', 7),
(9, 1, 0, 'AsusFX-015', '2023-05-05 14:04:35', 7);

-- --------------------------------------------------------

--
-- Structure de la table `monteur`
--

DROP TABLE IF EXISTS `monteur`;
CREATE TABLE IF NOT EXISTS `monteur` (
  `Id_Utilisateur` int NOT NULL,
  PRIMARY KEY (`Id_Utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `monteur`
--

INSERT INTO `monteur` (`Id_Utilisateur`) VALUES
(4),
(6);

-- --------------------------------------------------------

--
-- Structure de la table `processeur`
--

DROP TABLE IF EXISTS `processeur`;
CREATE TABLE IF NOT EXISTS `processeur` (
  `Id_Composant` int NOT NULL,
  `frequence` varchar(50) DEFAULT NULL,
  `nbCoeurs` tinyint DEFAULT NULL,
  `chipsetCompatible` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `processeur`
--

INSERT INTO `processeur` (`Id_Composant`, `frequence`, `nbCoeurs`, `chipsetCompatible`) VALUES
(33, '3.8', 8, 'HDMP-1032'),
(34, '2.5', 6, 'HDMP-1034'),
(35, '2.5', 16, 'HDMP-1034'),
(36, '4.3', 6, 'HDMP-1032');

-- --------------------------------------------------------

--
-- Structure de la table `souris`
--

DROP TABLE IF EXISTS `souris`;
CREATE TABLE IF NOT EXISTS `souris` (
  `Id_Composant` int NOT NULL,
  `sansFil` tinyint(1) DEFAULT NULL,
  `nbTouche` smallint DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `souris`
--

INSERT INTO `souris` (`Id_Composant`, `sansFil`, `nbTouche`) VALUES
(29, 1, 2),
(30, 1, 17),
(31, 0, 20),
(32, 0, 32);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `Id_Utilisateur` int NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Id_Utilisateur`, `password`, `nom`) VALUES
(4, '$2y$10$gPCLS4FPwKHNNknfqIh.lOcglng5tmUrihaVQJV99OpbCHtR/.4ZO', 'Toto'),
(5, '$2y$10$XDT9av4t8DoDiOJyOLtaY.Asij0D5.9w9jJLqhYJdMBeHDURo6GXK', 'tata'),
(6, '$2y$10$Tvs.bdmygjkPIc2kRKbNT.NRmjMEvRSZAmQOlI6abJFrmojGDtxC6', 'john'),
(7, '$2y$10$B8rpuMuJqkOb3MUAUvIRaOFXekcKGFttHNc9C6Vu/t.585ZKbVEm2', 'TattyJosy');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alimentation`
--
ALTER TABLE `alimentation`
  ADD CONSTRAINT `alimentation_ibfk_1` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`);

--
-- Contraintes pour la table `assembler`
--
ALTER TABLE `assembler`
  ADD CONSTRAINT `assembler_ibfk_1` FOREIGN KEY (`Id_Modele`) REFERENCES `modele` (`Id_Modele`),
  ADD CONSTRAINT `assembler_ibfk_2` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`);

--
-- Contraintes pour la table `carte_graphique`
--
ALTER TABLE `carte_graphique`
  ADD CONSTRAINT `carte_graphique_ibfk_1` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`);

--
-- Contraintes pour la table `carte_mere`
--
ALTER TABLE `carte_mere`
  ADD CONSTRAINT `carte_mere_ibfk_1` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`);

--
-- Contraintes pour la table `clavier`
--
ALTER TABLE `clavier`
  ADD CONSTRAINT `clavier_ibfk_1` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`);

--
-- Contraintes pour la table `concepteur`
--
ALTER TABLE `concepteur`
  ADD CONSTRAINT `concepteur_ibfk_1` FOREIGN KEY (`Id_Utilisateur`) REFERENCES `utilisateur` (`Id_Utilisateur`);

--
-- Contraintes pour la table `disque_dur`
--
ALTER TABLE `disque_dur`
  ADD CONSTRAINT `disque_dur_ibfk_1` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`);

--
-- Contraintes pour la table `ecran`
--
ALTER TABLE `ecran`
  ADD CONSTRAINT `ecran_ibfk_1` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`);

--
-- Contraintes pour la table `gerer`
--
ALTER TABLE `gerer`
  ADD CONSTRAINT `gerer_ibfk_1` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`),
  ADD CONSTRAINT `gerer_ibfk_2` FOREIGN KEY (`Id_Gestion_stock`) REFERENCES `gestion_stock` (`Id_Gestion_stock`);

--
-- Contraintes pour la table `memoire_vive`
--
ALTER TABLE `memoire_vive`
  ADD CONSTRAINT `memoire_vive_ibfk_1` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`Id_Modele`) REFERENCES `modele` (`Id_Modele`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`Id_Utilisateur`) REFERENCES `utilisateur` (`Id_Utilisateur`);

--
-- Contraintes pour la table `modele`
--
ALTER TABLE `modele`
  ADD CONSTRAINT `modele_ibfk_1` FOREIGN KEY (`Id_Utilisateur`) REFERENCES `utilisateur` (`Id_Utilisateur`);

--
-- Contraintes pour la table `monteur`
--
ALTER TABLE `monteur`
  ADD CONSTRAINT `monteur_ibfk_1` FOREIGN KEY (`Id_Utilisateur`) REFERENCES `utilisateur` (`Id_Utilisateur`);

--
-- Contraintes pour la table `processeur`
--
ALTER TABLE `processeur`
  ADD CONSTRAINT `processeur_ibfk_1` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`);

--
-- Contraintes pour la table `souris`
--
ALTER TABLE `souris`
  ADD CONSTRAINT `souris_ibfk_1` FOREIGN KEY (`Id_Composant`) REFERENCES `composant` (`Id_Composant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

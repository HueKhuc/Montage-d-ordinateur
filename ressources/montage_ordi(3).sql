-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 10 mai 2023 à 14:13
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

-- --------------------------------------------------------

--
-- Structure de la table `clavier`
--

DROP TABLE IF EXISTS `clavier`;
CREATE TABLE IF NOT EXISTS `clavier` (
  `Id_Composant` int NOT NULL,
  `sansFilClavier` tinyint(1) DEFAULT NULL,
  `paveNumerique` tinyint(1) DEFAULT NULL,
  `typeTouche` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `concepteur`
--

DROP TABLE IF EXISTS `concepteur`;
CREATE TABLE IF NOT EXISTS `concepteur` (
  `Id_Utilisateur` int NOT NULL,
  PRIMARY KEY (`Id_Utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `disque_dur`
--

DROP TABLE IF EXISTS `disque_dur`;
CREATE TABLE IF NOT EXISTS `disque_dur` (
  `Id_Composant` int NOT NULL,
  `ssd` tinyint(1) DEFAULT NULL,
  `capaciteDisque` int DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `monteur`
--

DROP TABLE IF EXISTS `monteur`;
CREATE TABLE IF NOT EXISTS `monteur` (
  `Id_Utilisateur` int NOT NULL,
  PRIMARY KEY (`Id_Utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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

-- --------------------------------------------------------

--
-- Structure de la table `souris`
--

DROP TABLE IF EXISTS `souris`;
CREATE TABLE IF NOT EXISTS `souris` (
  `Id_Composant` int NOT NULL,
  `sansFilSouris` tinyint(1) DEFAULT NULL,
  `nbTouche` smallint DEFAULT NULL,
  PRIMARY KEY (`Id_Composant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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

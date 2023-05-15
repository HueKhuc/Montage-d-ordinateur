-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 12 mai 2023 à 14:52
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
CREATE DATABASE IF NOT EXISTS `montage_ordi` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `montage_ordi`;

-- --------------------------------------------------------

--
-- Structure de la table `alimentation`
--

DROP TABLE IF EXISTS `alimentation`;
CREATE TABLE IF NOT EXISTS `alimentation` (
  `idComposant` int NOT NULL,
  `puissance` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `montage`
--

DROP TABLE IF EXISTS `montage`;
CREATE TABLE IF NOT EXISTS `montage` (
  `idModele` int NOT NULL,
  `idComposant` int NOT NULL,
  `quantite` smallint NOT NULL,
  PRIMARY KEY (`idModele`,`idComposant`),
  KEY `idComposant` (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `carte_graphique`
--

DROP TABLE IF EXISTS `carte_graphique`;
CREATE TABLE IF NOT EXISTS `carte_graphique` (
  `idComposant` int NOT NULL,
  `chipset` varchar(50) DEFAULT NULL,
  `memoire` int DEFAULT NULL,
  PRIMARY KEY (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `carte_mere`
--

DROP TABLE IF EXISTS `carte_mere`;
CREATE TABLE IF NOT EXISTS `carte_mere` (
  `idComposant` int NOT NULL,
  `socket` varchar(50) DEFAULT NULL,
  `format` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `clavier`
--

DROP TABLE IF EXISTS `clavier`;
CREATE TABLE IF NOT EXISTS `clavier` (
  `idComposant` int NOT NULL,
  `clavierSansFil` tinyint(1) DEFAULT NULL,
  `paveNumerique` tinyint(1) DEFAULT NULL,
  `typeTouche` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `composant`
--

DROP TABLE IF EXISTS `composant`;
CREATE TABLE IF NOT EXISTS `composant` (
  `idComposant` int NOT NULL AUTO_INCREMENT,
  `categorie` varchar(50) DEFAULT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `prix` decimal(5,2) DEFAULT NULL,
  `quantite` smallint DEFAULT NULL,
  `datAjout` datetime DEFAULT CURRENT_TIMESTAMP,
  `archivage` tinyint(1) DEFAULT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `estPortable` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `concepteur`
--

DROP TABLE IF EXISTS `concepteur`;
CREATE TABLE IF NOT EXISTS `concepteur` (
  `idUtilisateur` int NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `disque_dur`
--

DROP TABLE IF EXISTS `disque_dur`;
CREATE TABLE IF NOT EXISTS `disque_dur` (
  `idComposant` int NOT NULL,
  `ssd` tinyint(1) DEFAULT NULL,
  `capaciteDisque` int DEFAULT NULL,
  PRIMARY KEY (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ecran`
--

DROP TABLE IF EXISTS `ecran`;
CREATE TABLE IF NOT EXISTS `ecran` (
  `idComposant` int NOT NULL,
  `taille` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `gestion_stock`
--

DROP TABLE IF EXISTS `gestion_stock`;
CREATE TABLE IF NOT EXISTS `gestion_stock` (
  `Id_Gestion_stock` int NOT NULL AUTO_INCREMENT,
  `dte` datetime DEFAULT CURRENT_TIMESTAMP,
  `quantite` smallint NOT NULL,
  `entree` tinyint(1) NOT NULL DEFAULT '1',
  `idComposant` int NOT NULL,
  PRIMARY KEY (`Id_Gestion_stock`),
  KEY `idComposant` (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `memoire_vive`
--

DROP TABLE IF EXISTS `memoire_vive`;
CREATE TABLE IF NOT EXISTS `memoire_vive` (
  `idComposant` int NOT NULL,
  `capacite` varchar(50) DEFAULT NULL,
  `nbBarrettes` smallint DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `Id_Message` int NOT NULL AUTO_INCREMENT,
  `dateMess` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `texte` varchar(500) DEFAULT NULL,
  `idModele` int NOT NULL,
  `idUtilisateur` int NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id_Message`),
  KEY `idModele` (`idModele`),
  KEY `idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `idModele` int NOT NULL AUTO_INCREMENT,
  `portable` tinyint(1) DEFAULT NULL,
  `quantite` tinyint DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `dateAjout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUtilisateur` int NOT NULL,
  PRIMARY KEY (`idModele`),
  KEY `idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `monteur`
--

DROP TABLE IF EXISTS `monteur`;
CREATE TABLE IF NOT EXISTS `monteur` (
  `idUtilisateur` int NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `processeur`
--

DROP TABLE IF EXISTS `processeur`;
CREATE TABLE IF NOT EXISTS `processeur` (
  `idComposant` int NOT NULL,
  `frequence` varchar(50) DEFAULT NULL,
  `nbCoeurs` tinyint DEFAULT NULL,
  `chipsetCompatible` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `souris`
--

DROP TABLE IF EXISTS `souris`;
CREATE TABLE IF NOT EXISTS `souris` (
  `idComposant` int NOT NULL,
  `sourisSansFil` tinyint(1) DEFAULT NULL,
  `nbTouches` smallint DEFAULT NULL,
  PRIMARY KEY (`idComposant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int NOT NULL AUTO_INCREMENT,
  `motDePasse` varchar(255) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alimentation`
--
ALTER TABLE `alimentation`
  ADD CONSTRAINT `alimentation_ibfk_1` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`);

--
-- Contraintes pour la table `montage`
--
ALTER TABLE `montage`
  ADD CONSTRAINT `montage_ibfk_1` FOREIGN KEY (`idModele`) REFERENCES `modele` (`idModele`),
  ADD CONSTRAINT `montage_ibfk_2` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`);

--
-- Contraintes pour la table `carte_graphique`
--
ALTER TABLE `carte_graphique`
  ADD CONSTRAINT `carte_graphique_ibfk_1` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`);

--
-- Contraintes pour la table `carte_mere`
--
ALTER TABLE `carte_mere`
  ADD CONSTRAINT `carte_mere_ibfk_1` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`);

--
-- Contraintes pour la table `clavier`
--
ALTER TABLE `clavier`
  ADD CONSTRAINT `clavier_ibfk_1` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`);

--
-- Contraintes pour la table `concepteur`
--
ALTER TABLE `concepteur`
  ADD CONSTRAINT `concepteur_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `disque_dur`
--
ALTER TABLE `disque_dur`
  ADD CONSTRAINT `disque_dur_ibfk_1` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`);

--
-- Contraintes pour la table `ecran`
--
ALTER TABLE `ecran`
  ADD CONSTRAINT `ecran_ibfk_1` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`);

--
-- Contraintes pour la table `gestion_stock`
--
ALTER TABLE `gestion_stock`
  ADD CONSTRAINT `gestion_stock_ibfk_1` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `memoire_vive`
--
ALTER TABLE `memoire_vive`
  ADD CONSTRAINT `memoire_vive_ibfk_1` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`idModele`) REFERENCES `modele` (`idModele`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `modele`
--
ALTER TABLE `modele`
  ADD CONSTRAINT `modele_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `monteur`
--
ALTER TABLE `monteur`
  ADD CONSTRAINT `monteur_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `processeur`
--
ALTER TABLE `processeur`
  ADD CONSTRAINT `processeur_ibfk_1` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`);

--
-- Contraintes pour la table `souris`
--
ALTER TABLE `souris`
  ADD CONSTRAINT `souris_ibfk_1` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`idComposant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

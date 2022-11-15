-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 15 nov. 2022 à 00:00
-- Version du serveur : 8.0.30
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `garage-voiture`
--
CREATE DATABASE IF NOT EXISTS `garage-voiture` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `garage-voiture`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '22063751573e5dfee590a6a131530f5f8468e047a8a6aa0eacd08d8dd87a4d15');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

DROP TABLE IF EXISTS `voiture`;
CREATE TABLE IF NOT EXISTS `voiture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `immatriculation` varchar(30) NOT NULL,
  `marque` varchar(20) NOT NULL,
  `modele` varchar(20) NOT NULL,
  `dateMEC` date NOT NULL,
  `prix` varchar(255) NOT NULL,
  `dateEntreeGarage` date NOT NULL,
  `nbChevaux` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dateAjout` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`id`, `immatriculation`, `marque`, `modele`, `dateMEC`, `prix`, `dateEntreeGarage`, `nbChevaux`, `description`, `dateAjout`) VALUES
(1, '302 657 NC', 'Audi', 'R8', '2020-02-15', '18000000', '2021-02-12', '400', 'Voiiture rapide', NULL),
(2, '250 354 NC', 'Toyota', 'Hilux', '2021-07-29', '4295000', '2022-01-06', '171', 'Pick-up pour aller en brousse', NULL),
(3, '123 943 NC', 'Citroen', 'C3', '2022-02-28', '450000', '2022-03-10', '50', 'La woatur ', NULL),
(4, '123 943 NC', 'Citroen', 'C3', '2022-02-28', '450000', '2022-03-10', '50', 'La woatur ', NULL),
(5, '234 567 NC', 'Suzuki', 'Splash', '2014-08-23', '14000000', '2015-11-23', '12', 'La woatur carÃ©e.', NULL),
(6, '234 567 NC', 'Suzuki', 'Splash', '2014-08-23', '14000000', '2015-11-23', '12', 'La woatur carÃ©e.', NULL),
(7, '234 567 NC', 'Suzuki', 'Splash', '2014-08-23', '14000000', '2015-11-23', '12', 'La woatur carÃ©e.', NULL),
(8, '234 567 NC', 'Suzuki', 'Splash', '2014-08-23', '14000000', '2015-11-23', '12', 'La woatur carÃ©e.', NULL),
(9, '421 123 NC', 'Citroen', 'C4', '2012-02-19', '500000', '2020-11-02', '650', 'Voiture bien', NULL),
(10, '421 123 NC', 'Audi ', 'R312', '2020-02-12', '12321', '2021-04-19', '25', 'Fausse voiture !', '2022-04-18 00:00:00'),
(11, '421 123 NC', 'Audi ', 'R312', '2020-02-12', '12321', '2021-04-19', '25', 'Fausse voiture !', '2022-04-18 06:26:46'),
(12, '154', 'Audi', 'R3123', '2222-04-19', '259999', '3200-09-18', '14', 'oui', '2022-11-14 23:46:26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

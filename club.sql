-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 22 mars 2021 à 18:44
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `club`
--
CREATE DATABASE IF NOT EXISTS `club` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `club`;

-- --------------------------------------------------------

--
-- Structure de la table `abscences`
--

DROP TABLE IF EXISTS `abscences`;
CREATE TABLE IF NOT EXISTS `abscences` (
  `id` int NOT NULL,
  `motif` enum('ABS','NL','SUS','BLE') COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `abscences`
--

INSERT INTO `abscences` (`id`, `motif`, `date`) VALUES
(8, 'NL', '2022-02-27'),
(1, 'ABS', '2021-08-08'),
(7, 'NL', '2021-08-01'),
(1, 'ABS', '2021-08-01'),
(3, 'BLE', '2021-08-01'),
(8, 'SUS', '2021-08-01');

-- --------------------------------------------------------

--
-- Structure de la table `authentification`
--

DROP TABLE IF EXISTS `authentification`;
CREATE TABLE IF NOT EXISTS `authentification` (
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(50) COLLATE utf8_bin NOT NULL,
  `role` enum('Entraineur','Secrétaire','','') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `authentification`
--

INSERT INTO `authentification` (`login`, `mdp`, `role`) VALUES
('GGrenon', 'Bo$$DelFuego', 'Entraineur'),
('JLaffely', 'MiNeCrAfT53100', 'Entraineur'),
('DLesaint', 'ViveLapero49', 'Entraineur'),
('GHunault', 'ViveLeGouter', 'Secrétaire');

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

DROP TABLE IF EXISTS `joueurs`;
CREATE TABLE IF NOT EXISTS `joueurs` (
  `id` int NOT NULL,
  `nom` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prenom` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ddn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id`, `nom`, `prenom`, `ddn`) VALUES
(1, 'Baba', 'Ali', '1997-05-16'),
(2, 'Kujo', 'Jotaro', '1980-05-04'),
(3, 'File', 'Théo', '1998-01-17'),
(4, 'Coustaud', 'Jacques-Ives', '1991-07-30'),
(5, 'Simpson', 'Homer', '1985-02-27'),
(6, 'Emilou', 'Tintin', '1996-11-06'),
(7, 'Ebile', 'Bowl', '2001-09-11'),
(8, 'Sarkozy', 'Nicolas', '1983-10-21'),
(9, 'Pompidou', 'Georges', '1989-06-17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

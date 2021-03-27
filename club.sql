-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 27 mars 2021 à 00:48
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
-- Structure de la table `absences`
--

DROP TABLE IF EXISTS `absences`;
CREATE TABLE IF NOT EXISTS `absences` (
  `id` int NOT NULL,
  `motif` enum('ABS','NL','SUS','BLE') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `absences`
--

INSERT INTO `absences` (`id`, `motif`, `date`) VALUES
(8, 'NL', '2022-02-27'),
(1, 'ABS', '2021-08-08'),
(9, 'ABS', '2021-08-22'),
(1, 'NL', '2021-08-01'),
(6, 'NL', '2021-08-08'),
(11, 'SUS', '2021-08-01'),
(5, 'BLE', '2021-08-01'),
(2, 'ABS', '2021-08-08'),
(2, 'ABS', '2021-08-01'),
(3, 'ABS', '2021-08-01'),
(4, 'ABS', '2021-08-01'),
(6, 'ABS', '2021-08-01'),
(7, 'ABS', '2021-08-01'),
(8, 'ABS', '2021-08-01'),
(9, 'ABS', '2021-08-01'),
(3, 'BLE', '2021-08-08'),
(4, 'BLE', '2021-08-08'),
(5, 'BLE', '2021-08-08'),
(7, 'BLE', '2021-08-08'),
(8, 'BLE', '2021-08-08'),
(13, 'NL', '2021-08-08'),
(9, 'BLE', '2021-08-08'),
(10, 'BLE', '2021-08-08'),
(11, 'BLE', '2021-08-08'),
(12, 'ABS', '2021-08-15'),
(13, 'ABS', '2021-08-15'),
(14, 'ABS', '2021-08-15'),
(15, 'ABS', '2021-08-15'),
(16, 'ABS', '2021-08-15'),
(17, 'ABS', '2021-08-15'),
(18, 'ABS', '2021-08-15'),
(13, 'BLE', '2021-08-22'),
(14, 'BLE', '2021-08-22'),
(15, 'BLE', '2021-08-22'),
(16, 'BLE', '2021-08-22'),
(17, 'BLE', '2021-08-22'),
(18, 'BLE', '2021-08-22'),
(19, 'BLE', '2021-08-22'),
(20, 'BLE', '2021-08-22');

-- --------------------------------------------------------

--
-- Structure de la table `authentification`
--

DROP TABLE IF EXISTS `authentification`;
CREATE TABLE IF NOT EXISTS `authentification` (
  `login` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mdp` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role` enum('Entraineur','Secrétaire','','') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
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
-- Structure de la table `convocations`
--

DROP TABLE IF EXISTS `convocations`;
CREATE TABLE IF NOT EXISTS `convocations` (
  `date` date NOT NULL,
  `competition` varchar(30) COLLATE utf8_bin NOT NULL,
  `equipe` varchar(30) COLLATE utf8_bin NOT NULL,
  `adversaire` varchar(30) COLLATE utf8_bin NOT NULL,
  `site` varchar(30) COLLATE utf8_bin NOT NULL,
  `terrain` varchar(30) COLLATE utf8_bin NOT NULL,
  `heure` time NOT NULL,
  `joueurs` longtext COLLATE utf8_bin NOT NULL,
  `type` enum('Brouillon','Valider') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `convocations`
--

INSERT INTO `convocations` (`date`, `competition`, `equipe`, `adversaire`, `site`, `terrain`, `heure`, `joueurs`, `type`) VALUES
('2021-08-01', 'Coupe Departementale', 'SENIORS_1', 'FC Argentre', 'Argentre', 'Stade Chirac', '00:00:00', 'Genest David;Zidane Zinédine;Burns Montgomery;', 'Brouillon'),
('2021-08-01', '', '', '', '', '', '00:00:00', '', 'Brouillon'),
('2021-08-01', 'Championnat Departementale', 'SENIORS_3', 'FC Brece', 'Brece', 'Stade du chat', '17:00:00', 'D. Malplacé Iladézy;Touille Sacha;Toketchup Thomas;', 'Brouillon');

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
(9, 'Pompidou', 'Georges', '1989-06-17'),
(10, 'Genest', 'David', '1980-05-12'),
(11, 'Richer', 'Jean-Michel', '1975-02-04'),
(12, 'Zidane', 'Zinédine', '1972-06-23'),
(13, 'Burns', 'Montgomery', '1950-07-05'),
(14, 'Smith', 'Will', '1967-09-09'),
(15, 'Stephan', 'Igor', '1975-05-20'),
(16, 'Dorf', 'Ganon', '1974-04-16'),
(17, 'Auboisdormant', 'Abel', '1984-08-02'),
(18, 'D. Malplacé', 'Iladézy', '1962-11-27'),
(19, 'Touille', 'Sacha', '2001-06-30'),
(20, 'Toketchup', 'Thomas', '1993-09-18'),
(21, 'K. Paétrela', 'Xavier', '1997-01-01'),
(22, 'Atéfesse', 'Edgard', '1989-03-18'),
(23, 'Ottofraize', 'Charles', '2001-09-11'),
(24, 'Haba', 'Bart', '1991-07-17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

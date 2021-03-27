-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 27 mars 2021 à 17:24
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
(7, 'ABS', '2021-08-01'),
(13, 'NL', '2021-08-01'),
(23, 'SUS', '2021-08-01'),
(28, 'ABS', '2021-08-01'),
(34, 'BLE', '2021-08-01'),
(3, 'BLE', '2021-08-08'),
(7, 'NL', '2021-08-08'),
(11, 'BLE', '2021-08-08'),
(15, 'BLE', '2021-08-08'),
(19, 'NL', '2021-08-08'),
(23, 'NL', '2021-08-08'),
(27, 'ABS', '2021-08-08'),
(32, 'NL', '2021-08-08'),
(38, 'BLE', '2021-08-08'),
(9, 'BLE', '2021-08-15'),
(14, 'NL', '2021-08-15'),
(18, 'NL', '2021-08-15'),
(23, 'NL', '2021-08-15'),
(29, 'BLE', '2021-08-15'),
(35, 'NL', '2021-08-15');

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
('GHunault', 'ViveLeGouter', 'Secrétaire'),
('DLesaintS', 'ViveLinfo49', 'Secrétaire'),
('DLesaintE', 'ViveLinfo49', 'Entraineur');

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
('2021-08-01', 'Coupe Departementale', 'SENIORS_1', 'FC Argentre', 'Argentre', 'Stade Chirac', '17:00:00', 'Sarkozy Nicolas;Pompidou Georges;Stephan Igor;D. Malplacé Iladézy;Haba Bart;Bonaparte Léon;Mora Aloa;Aituntest Ceci;Gourcuff Yohan;Deschamps Didier;Gold D. Roger;Tony Tony Chopper;Zelda Link;', 'Valider'),
('2021-08-01', 'Coupe Intercommunale', 'SENIORS_2', 'FC Bonchamp', 'Bonchamp', 'Stade Mandela', '17:00:00', 'Auboisdormant Abel;Touille Sacha;Toketchup Thomas;', 'Brouillon'),
('2021-08-01', 'Championnat Departementale', 'SENIORS_3', 'FC Brece', 'Brece', 'Stade du chat', '17:00:00', 'Baba Ali;Kujo Jotaro;File Théo;Coustaud Jacques-Ives;Monkey D. Luffy;Vinsmoke Sanji;', 'Brouillon'),
('2021-08-15', 'Amical', 'SENIORS_2', 'FC Contest', 'Contest', 'Stade Hunault', '17:00:00', 'Baba Ali;Kujo Jotaro;File Théo;', 'Brouillon'),
('2021-08-15', 'Coupe Departementale', 'SENIORS_3', 'FC Craon', 'Craon', 'Stade Gandhi', '17:00:00', 'Emilou Tintin;Sarkozy Nicolas;Genest David;', 'Brouillon'),
('2021-12-19', 'Championnat Departementale', 'SENIORS_3', 'FC Ernee', 'Ernee', 'Stade du chat', '17:00:00', 'Dorf Ganon;Auboisdormant Abel;D. Malplacé Iladézy;Touille Sacha;Toketchup Thomas;K. Paétrela Xavier;Atéfesse Edgard;Ottofraize Charles;Haba Bart;Bonaparte Léon;Mora Aloa;Aituntest Ceci;Potter Harry;Mbappe Kylian;Griezmann Antoine;', 'Valider'),
('2021-12-19', 'Coupe Departementale', 'SENIORS_1', 'FC Gorron', 'Gorron', 'Stade du grand ourson', '17:00:00', 'Kujo Jotaro;File Théo;Coustaud Jacques-Ives;', 'Brouillon');

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
(24, 'Haba', 'Bart', '1991-07-17'),
(25, 'Bonaparte', 'Léon', '1967-04-18'),
(26, 'Mora', 'Aloa', '1989-06-17'),
(27, 'Aituntest', 'Ceci', '2001-12-07'),
(28, 'Potter', 'Harry', '1990-05-10'),
(29, 'Mbappe', 'Kylian', '1997-11-18'),
(30, 'Griezmann', 'Antoine', '1991-03-18'),
(31, 'Gourcuff', 'Yohan', '1971-11-24'),
(32, 'Antoine', 'Eric', '1983-09-15'),
(33, 'Deschamps', 'Didier', '1968-12-18'),
(34, 'Lefevre', 'Lucas', '2000-10-18'),
(35, 'Monkey D.', 'Luffy', '1997-04-14'),
(36, 'Gold D.', 'Roger', '1992-03-01'),
(37, 'Roronoa', 'Zoro', '1993-12-19'),
(38, 'Tony Tony', 'Chopper', '1998-05-30'),
(39, 'Vinsmoke', 'Sanji', '1999-12-19'),
(40, 'Zelda', 'Link', '1968-05-18');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

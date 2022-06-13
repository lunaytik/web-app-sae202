-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 13 juin 2022 à 17:11
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `web-app-sae202`
--

-- --------------------------------------------------------

--
-- Structure de la table `quest`
--

DROP TABLE IF EXISTS `quest`;
CREATE TABLE IF NOT EXISTS `quest` (
  `quest_id` int(255) NOT NULL AUTO_INCREMENT,
  `quest_name` varchar(80) NOT NULL,
  `quest_text` varchar(80) NOT NULL,
  `quest_content` varchar(100) NOT NULL,
  `quest_rep` varchar(100) NOT NULL,
  `quest_act` int(1) NOT NULL,
  `quest_step` int(2) NOT NULL,
  `quest_type` int(2) NOT NULL,
  `quest_finished` tinyint(1) NOT NULL,
  `_quest_tp` varchar(1) NOT NULL,
  PRIMARY KEY (`quest_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quest`
--

INSERT INTO `quest` (`quest_id`, `quest_name`, `quest_text`, `quest_content`, `quest_rep`, `quest_act`, `quest_step`, `quest_type`, `quest_finished`, `_quest_tp`) VALUES
(3, 'Quete 1', 'Texte de dingue', 'Img.jpeg', 'hiboux', 1, 1, 1, 0, 'A'),
(4, 'Quete 2', 'Retrouvez la personne dans la boîte de nuit', 'Img.jpeg', 'hibouxm', 1, 2, 1, 0, 'A'),
(5, 'Quete 3', 'Je suis le précédent avec un s en plus', 'Img.jpeg', 'hibouxms', 1, 3, 1, 0, 'A'),
(6, 'Queteeee', 'Dingueeee', 'Img.jpeg', 'a', 2, 1, 1, 0, 'A'),
(7, 'Oueoue', 'Oue', 'Img.jpeg', 'a', 3, 1, 1, 0, 'A');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_mdp` varchar(255) NOT NULL,
  `user_nom` varchar(50) NOT NULL,
  `user_prenom` varchar(50) NOT NULL,
  `user_statut` int(1) NOT NULL,
  `user_tp` char(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`user_id`, `user_name`, `user_mdp`, `user_nom`, `user_prenom`, `user_statut`, `user_tp`) VALUES
(6, 'anotherone', '$2y$10$zr52NgikTTupoJRwWBmrjOJV6RnRlK19JobZgjPgrQpDBDGUnXAHG', 'Doe', 'John', 1, 'A'),
(5, 'lunaytiik', '$2y$10$FjEpTZH6Xk.F4ogTTkn68OGlonKuSmN9X.k/HQP59w3dM89zfczE2', 'Deuil', 'Nathan', 1, 'A'),
(7, 'lunaytiik1', '$2y$10$jGX4mhdO2XIy.imnb7EwQeh11P4qHOrkGj1rxCEvRxhT0kBpoIiR2', 'Deuil', 'Nathan', 1, 'B'),
(8, 'unautre', '$2y$10$QFZ9p3eLRh6HK9HlSBX5K.QeUidBQJ/ymq5WBG.SFG7rr7qqb1vbO', 'Dose', 'Johnny', 1, 'A'),
(9, 'aza', '$2y$10$3ToJ3QxZgfA4Fz6TqxOnz.0xgjH1T1HQ3sl0DAVrh3QWMSnBfK7ge', 'Aza', 'Aza', 1, 'B');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

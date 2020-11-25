-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 06 oct. 2020 à 11:12
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `suivi_gai`
--

-- --------------------------------------------------------

--
-- Structure de la table `enregistrement_tmp`
--

DROP TABLE IF EXISTS `enregistrement_tmp`;
CREATE TABLE IF NOT EXISTS `enregistrement_tmp` (
  `nom` varchar(20) COLLATE utf8_estonian_ci NOT NULL,
  `prenom` varchar(20) COLLATE utf8_estonian_ci NOT NULL,
  `adresse_mail` varchar(256) COLLATE utf8_estonian_ci NOT NULL,
  `identifiant` varchar(20) COLLATE utf8_estonian_ci NOT NULL,
  `code_genere` varchar(20) COLLATE utf8_estonian_ci NOT NULL,
  `temps_d_activation` int(11) NOT NULL,
  `heure_demande` datetime NOT NULL,
  UNIQUE KEY `adresse_mail` (`adresse_mail`),
  UNIQUE KEY `identifiant` (`identifiant`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Déchargement des données de la table `enregistrement_tmp`
--

INSERT INTO `enregistrement_tmp` (`nom`, `prenom`, `adresse_mail`, `identifiant`, `code_genere`, `temps_d_activation`, `heure_demande`) VALUES
('bbbb', 'cccc', 'aaaa', 'dddd', 'cb060720201315', 3, '2020-07-06 13:15:17'),
('ouioui', 'zuzu', 'xhdrh', 'prout', 'zo070720200710', 3, '2020-07-07 07:10:28'),
('rgfrs', 'geg', 'gerg', 'gregr', 'gr070720200712', 3, '2020-07-07 07:12:33'),
('greqge', 'grqgq', 'gfger', 'gqrgr', 'gg070720200724', 3, '2020-07-07 07:24:34'),
('totot', 'toto', 'toto', 'ttoo', 'tt070720200816', 3, '2020-07-07 08:16:11'),
('tby,i,i,', 'ii', 'fvtb', ',i', 'it070720200820', 3, '2020-07-07 08:20:04'),
('dded', 'fefe', 'rfer@ce.com', '', 'fd070720201130', 3, '2020-07-07 11:30:18'),
('ti', 'tu', '.@', 'to', 'tt070720200959', 3, '2020-07-07 09:59:15'),
('takacs', 'Meagane', 'meagane.takacs@gmail.com', 'mtakacs', 'Mt070720201113', 3, '2020-07-07 11:13:12');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_image` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
  `statut_image` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
  `date_creation` date NOT NULL,
  `date_maj` date NOT NULL,
  `nom_createur` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
  `nom_maj` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
  `identifiant` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
  `adresse_mail` varchar(255) COLLATE utf8_estonian_ci DEFAULT NULL,
  `nb_tentative_conn` int(11) NOT NULL DEFAULT 0,
  `nb_tentative_max` int(11) NOT NULL DEFAULT 3,
  `acces_verrouille` varchar(255) COLLATE utf8_estonian_ci DEFAULT 'N',
  `verrouillage_administratif` varchar(255) COLLATE utf8_estonian_ci DEFAULT NULL,
  `type_d_acces` varchar(255) COLLATE utf8_estonian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `identifiant`, `password`, `adresse_mail`, `nb_tentative_conn`, `nb_tentative_max`, `acces_verrouille`, `verrouillage_administratif`, `type_d_acces`) VALUES
(1, 'Sarah', 'Loli', 'prout', 'prout', '', 0, 3, 'en ligne', NULL, '0'),
(2, 'Scampy', 'ku', 'hyd', 'jfjy', '', 0, 3, NULL, NULL, '0'),
(3, 'Scampy', 'ku', 'hth', 'hth', '', 0, 3, NULL, NULL, '0'),
(4, ',hg,hg', ',hgh,', ',ghg,hg', ',gh,', NULL, 0, 3, NULL, NULL, NULL),
(5, 'greqgerq', 'geqgqe', 'gege', 'gerge', 'frfgrg', 0, 3, NULL, NULL, NULL),
(6, 'htrh', 'htr', 'th', 'th', 'xhdrh', 0, 3, NULL, NULL, NULL),
(7, 'bgngf', 'fhjfjfj', 'gngfnj', 'gfj,nf', 'bfbfbf', 0, 3, NULL, NULL, NULL),
(8, 'nggn', 'jfjf', 'fjfj', 'jfyhfj', 'xhdrh', 0, 3, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

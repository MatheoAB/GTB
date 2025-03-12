-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 12 mars 2025 à 13:13
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mairie`
--

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

CREATE TABLE `etats` (
  `ID` int(11) NOT NULL,
  `Passerelle` tinyint(1) NOT NULL,
  `Connecteur` tinyint(1) NOT NULL,
  `CapteurT` tinyint(1) NOT NULL,
  `CapteurM` tinyint(1) NOT NULL,
  `CapteurC` tinyint(1) NOT NULL,
  `CapteurB` tinyint(1) NOT NULL,
  `AlarmeT` tinyint(1) NOT NULL,
  `AlarmeA` tinyint(1) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etats`
--

INSERT INTO `etats` (`ID`, `Passerelle`, `Connecteur`, `CapteurT`, `CapteurM`, `CapteurC`, `CapteurB`, `AlarmeT`, `AlarmeA`, `Date`) VALUES
(1, 0, 1, 0, 0, 0, 1, 0, 0, '2025-03-11 15:47:57');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etats`
--
ALTER TABLE `etats`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etats`
--
ALTER TABLE `etats`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

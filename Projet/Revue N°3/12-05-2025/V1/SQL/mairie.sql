-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 03 mars 2025 à 16:28
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

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
-- Structure de la table `connexions`
--

CREATE TABLE `connexions` (
  `ID` int(11) NOT NULL,
  `Nom` int(50) NOT NULL,
  `Mdp` int(50) NOT NULL,
  `Statut` int(20) NOT NULL,
  `Code` varchar(20) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `ID` int(11) NOT NULL,
  `Connexions` varchar(80) NOT NULL,
  `Modifications` varchar(80) NOT NULL,
  `Ajouts` varchar(80) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `variables`
--

CREATE TABLE `variables` (
  `ID` int(11) NOT NULL,
  `Temp` float NOT NULL,
  `ConsT` float NOT NULL,
  `Luminosité` float NOT NULL,
  `ConsL` float NOT NULL,
  `Mouvement` tinyint(1) NOT NULL,
  `Eau` float NOT NULL,
  `Electricité` float NOT NULL,
  `Gaz` float NOT NULL,
  `Air` varchar(25) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `connexions`
--
ALTER TABLE `connexions`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `etats`
--
ALTER TABLE `etats`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `variables`
--
ALTER TABLE `variables`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `connexions`
--
ALTER TABLE `connexions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etats`
--
ALTER TABLE `etats`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `variables`
--
ALTER TABLE `variables`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

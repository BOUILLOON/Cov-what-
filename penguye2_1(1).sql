-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 03 mai 2024 à 11:35
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
-- Base de données : `penguye2`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `id_travail` int(11) NOT NULL,
  `id_vehicule` int(11) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `selections` varchar(255) DEFAULT NULL,
  `etudiant_emetteur` varchar(30) NOT NULL,
  `nom_emetteur` varchar(255) DEFAULT NULL,
  `date_proposition` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `id_travail`, `id_vehicule`, `nom`, `prenom`, `adresse`, `ville`, `code_postal`, `telephone`, `email`, `mot_de_passe`, `selections`, `etudiant_emetteur`, `nom_emetteur`, `date_proposition`) VALUES
(1, 1, NULL, 'RANDRIANASOLO', 'Nantenaina', '4 rue des trouduc coston', 'Montbéliard', 25200, '0615848956', 'r.nantenaina@outlook.fr', 'a', NULL, '', 'Coston', NULL),
(10, 10, 10, 'admin', 'admin', 'admin', 'admin', 90100, '90100', 'admin@admin.fr', 'admin', '19,20', '', NULL, NULL),
(17, 1, NULL, 'NGUYEN-TAN-HON', 'Paul-Emile', '37 Rue Georges Clemenceau', 'Montbéliard', 25200, '0610641293', 'paulemile25000@gmail.com', '4CGy6ij7', NULL, '', NULL, NULL),
(18, 1, 1, 'COSTON', 'Hugo', '3 rue des deux fontaines', 'Lebetain', 90100, '0616525318', 'costonhugo@gmail.com', 'a', NULL, '', NULL, NULL),
(20, 2, NULL, 'HAMDI', 'Yousef ', '3 Avenue Charles Bohn', 'Belfort', 90000, '0612544356', 'yousefhamdi1804@gmail.com', 'a', NULL, '', NULL, NULL),
(21, 2, NULL, 'ARAGOU', 'Soulayman', '37 Rue Georges Clemenceau', 'Montbéliard', 25200, '0658966325', 'aragou.soulayman@yahoo.com', '2i2IP01Lu3', NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `id_horaire` int(11) NOT NULL,
  `id_travail` int(11) NOT NULL,
  `Lu_debut-cours` time DEFAULT NULL,
  `Lu_fin-cours` time DEFAULT NULL,
  `Ma_debut-cours` time DEFAULT NULL,
  `Ma_fin-cours` time DEFAULT NULL,
  `Me_debut-cours` time DEFAULT NULL,
  `Me_fin-cours` time DEFAULT NULL,
  `Je_debut-cours` time DEFAULT NULL,
  `Je_fin-cours` time DEFAULT NULL,
  `Ve_debut-cours` time DEFAULT NULL,
  `Ve_fin-cours` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id_horaire`, `id_travail`, `Lu_debut-cours`, `Lu_fin-cours`, `Ma_debut-cours`, `Ma_fin-cours`, `Me_debut-cours`, `Me_fin-cours`, `Je_debut-cours`, `Je_fin-cours`, `Ve_debut-cours`, `Ve_fin-cours`) VALUES
(9, 1, '08:00:00', '18:00:00', '08:00:00', '18:00:00', '08:00:00', '18:00:00', '08:00:00', '18:00:00', '08:00:00', '18:00:00'),
(10, 2, '08:00:00', '18:00:00', '08:00:00', '18:00:00', '08:00:00', '15:00:00', '13:30:00', '18:00:00', '09:30:00', '16:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `id_trajet` int(11) NOT NULL,
  `date_heure_depart` time NOT NULL,
  `date_heure_arrivee` time NOT NULL,
  `lieu_depart` varchar(255) NOT NULL,
  `lieu_arrivee` varchar(255) NOT NULL,
  `conducteur` int(11) NOT NULL,
  `passager1` int(11) DEFAULT NULL,
  `passager2` int(11) DEFAULT NULL,
  `passager3` int(11) DEFAULT NULL,
  `passager4` int(11) DEFAULT NULL,
  `passager5` int(11) DEFAULT NULL,
  `passager6` int(11) DEFAULT NULL,
  `passager7` int(11) DEFAULT NULL,
  `passager8` int(11) DEFAULT NULL,
  `passager9` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`id_trajet`, `date_heure_depart`, `date_heure_arrivee`, `lieu_depart`, `lieu_arrivee`, `conducteur`, `passager1`, `passager2`, `passager3`, `passager4`, `passager5`, `passager6`, `passager7`, `passager8`, `passager9`) VALUES
(1, '07:00:00', '07:45:00', 'Lebetain', 'Université', 18, 17, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '18:05:00', '18:45:00', 'Université', 'Lebetain', 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `travail`
--

CREATE TABLE `travail` (
  `id_travail` int(11) NOT NULL,
  `formation` varchar(255) NOT NULL,
  `promotion` varchar(255) NOT NULL,
  `groupe` varchar(255) NOT NULL,
  `sous_groupe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `travail`
--

INSERT INTO `travail` (`id_travail`, `formation`, `promotion`, `groupe`, `sous_groupe`) VALUES
(1, 'R&T', '1ère année', 'GB', 'GB2'),
(2, 'R&T', '1ère année', 'LK', 'LK1');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id_vehicule` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `nb_place` int(11) NOT NULL,
  `immatriculation` varchar(255) NOT NULL,
  `assurance` varchar(255) NOT NULL,
  `date_prochain_controle_technique` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id_vehicule`, `type`, `modele`, `nb_place`, `immatriculation`, `assurance`, `date_prochain_controle_technique`) VALUES
(1, 'Citadine', 'Suzuki', 5, 'AM-404-RG', 'maif', '2028-04-15');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD KEY `id_travail` (`id_travail`),
  ADD KEY `id_vehicule` (`id_vehicule`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id_horaire`),
  ADD KEY `id_travail` (`id_travail`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id_trajet`),
  ADD KEY `conducteur` (`conducteur`,`passager1`,`passager2`,`passager3`,`passager4`,`passager5`,`passager6`,`passager7`,`passager8`,`passager9`);

--
-- Index pour la table `travail`
--
ALTER TABLE `travail`
  ADD PRIMARY KEY (`id_travail`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id_vehicule`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `id_horaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `travail`
--
ALTER TABLE `travail`
  MODIFY `id_travail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id_vehicule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

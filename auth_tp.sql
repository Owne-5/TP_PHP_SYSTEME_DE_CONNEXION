-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 22 mai 2026 à 23:51
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
-- Base de données : `auth_tp`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(180) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_inscription` datetime DEFAULT current_timestamp(),
  `photo_profil` varchar(255) DEFAULT 'default.png',
  `role` varchar(20) DEFAULT 'membre',
  `tentatives_connexion` int(11) DEFAULT 0,
  `verrouille_jusqua` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `token_reset` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `date_inscription`, `photo_profil`, `role`, `tentatives_connexion`, `verrouille_jusqua`, `remember_token`, `token_reset`) VALUES
(5, 'Jean', 'Pierre', 'jeanpierre@gmail.com', '$2y$10$DOvcNdSUL8OQ2WljGkpE4OLt5Dfa/c0DD5OZN4zyE6hhCQNMMEmSO', '2026-05-21 19:48:02', '6a1032670a23d_Gemini_Generated_Image_q6qwcaq6qwcaq6qw.png', 'admin', 0, NULL, '774572d0ef88e92ffd234ecf2a0c9e87ae8939026530799610051bd4395d5242', NULL),
(6, 'ndong', 'naomie', 'ndongp565@gmail.com', '$2y$10$MhGT2QtWUrbEBJ5yjHDSN.s53tGWfaL8vHDRGVND1WaH9VEP/RFfu', '2026-05-21 20:48:44', 'default.png', 'membre', 0, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

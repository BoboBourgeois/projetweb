-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 04 juin 2024 à 07:00
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `univ_ndere`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int(15) NOT NULL,
  `id_resto` int(15) NOT NULL,
  `nom` varchar(55) NOT NULL,
  `prenom` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `motdepasse` varchar(10) NOT NULL,
  `tel` int(15) NOT NULL,
  `genre` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `id_resto`, `nom`, `prenom`, `email`, `motdepasse`, `tel`, `genre`) VALUES
(1, 1, 'burrows', 'kms', 'burrowskms@gmail.com', '1234', 656689640, 'Masculin'),
(9, 1, 'BEROSBAYE', 'KAMIS', 'berosbayekamis@gmail.com', '1234', 66760478, 'Masculin');

--
-- Déclencheurs `administrateur`
--
DELIMITER $$
CREATE TRIGGER `test` BEFORE INSERT ON `administrateur` FOR EACH ROW SET new.nom = upper(new.nom)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `test2` BEFORE INSERT ON `administrateur` FOR EACH ROW SET new.prenom = upper(new.prenom)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(50) NOT NULL,
  `id_resto` int(15) NOT NULL,
  `nom` varchar(55) NOT NULL,
  `prenom` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `genre` varchar(55) DEFAULT NULL,
  `age` int(15) DEFAULT NULL,
  `telephone` int(15) NOT NULL,
  `nationalite` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `id_resto`, `nom`, `prenom`, `email`, `genre`, `age`, `telephone`, `nationalite`) VALUES
(8, 1, 'berosbaye', 'kamis', 'berosbayekamis@gmail.com', 'Masculin', 22, 656689640, 'Tchad'),
(10, 1, 'ABOUBAKAR', 'HAMAMISSA', 'aboubakarhamamissa@gmail.com', 'Masculin', 23, 655251337, 'Cameroun '),
(13, 1, 'DJEKELLABER', 'BONHEUR', 'djekellaberbonheur@gmail.com', 'Masculin', 22, 655453421, 'Cameroon');

--
-- Déclencheurs `client`
--
DELIMITER $$
CREATE TRIGGER `nom_majuscule` BEFORE INSERT ON `client` FOR EACH ROW SET new.nom = upper(new.nom)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `prenom_majuscule` BEFORE INSERT ON `client` FOR EACH ROW SET new.prenom = upper(new.prenom)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_comment` int(50) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `contenu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_comment`, `titre`, `contenu`) VALUES
(5, 'bonjour', 'salut comment vous '),
(6, 'dgdfdfffx', 'gdhjfdkfr'),
(7, 'bonjout', 'je veux faire une reservation'),
(8, 'DDDD', 'VCBVRED');

-- --------------------------------------------------------

--
-- Structure de la table `faire`
--

CREATE TABLE `faire` (
  `id_faire` int(50) NOT NULL,
  `id_client` int(50) NOT NULL,
  `id_reser` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `faire`
--

INSERT INTO `faire` (`id_faire`, `id_client`, `id_reser`) VALUES
(6, 8, 9),
(8, 10, 11),
(11, 13, 14);

-- --------------------------------------------------------

--
-- Structure de la table `gerer`
--

CREATE TABLE `gerer` (
  `id_gerer` int(50) NOT NULL,
  `id_admin` int(15) NOT NULL,
  `id_tabtente` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `gerer`
--

INSERT INTO `gerer` (`id_gerer`, `id_admin`, `id_tabtente`) VALUES
(2, 1, 34),
(3, 1, 35),
(4, 1, 36),
(5, 1, 37);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paie` int(50) NOT NULL,
  `mode_paie` varchar(50) NOT NULL,
  `prix_paie` int(55) NOT NULL,
  `tel_paie` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paie`, `mode_paie`, `prix_paie`, `tel_paie`) VALUES
(9, 'Orange Money', 100000, 656689640),
(11, 'Orange Money', 15000, 692242568),
(14, 'Orange Money', 30000, 690897718);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reser` int(50) NOT NULL,
  `id_tabtente` int(50) NOT NULL,
  `id_paie` int(50) NOT NULL,
  `id_admin` int(15) NOT NULL,
  `style` varchar(20) NOT NULL,
  `nb_reservation` int(15) NOT NULL,
  `valide` tinyint(1) NOT NULL,
  `date_demande` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reser`, `id_tabtente`, `id_paie`, `id_admin`, `style`, `nb_reservation`, `valide`, `date_demande`) VALUES
(9, 2, 9, 1, 'ceremonie de mariage', 1, 1, '2024-04-25 01:41:00'),
(11, 10, 11, 1, 'ceremonie de consert', 1, 1, '2024-05-30 03:37:00'),
(14, 1, 14, 1, 'ceremonie de marige', 2, 1, '2024-05-31 09:03:00');

-- --------------------------------------------------------

--
-- Structure de la table `resto_ndere`
--

CREATE TABLE `resto_ndere` (
  `id_resto` int(15) NOT NULL,
  `nom_resto` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `localite` varchar(55) NOT NULL,
  `tel_resto` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `resto_ndere`
--

INSERT INTO `resto_ndere` (`id_resto`, `nom_resto`, `email`, `localite`, `tel_resto`) VALUES
(1, 'Resto de la ville', 'resto@gmail.com', 'Ngaoundéré', 656689640);

-- --------------------------------------------------------

--
-- Structure de la table `suggerer`
--

CREATE TABLE `suggerer` (
  `id_suggerer` int(50) NOT NULL,
  `id_client` int(50) NOT NULL,
  `id_comment` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tabtente`
--

CREATE TABLE `tabtente` (
  `id_tabtente` int(50) NOT NULL,
  `classe` varchar(20) NOT NULL,
  `prix` int(15) NOT NULL,
  `nb_reservation` int(15) NOT NULL,
  `ville_demande` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `horaire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tabtente`
--

INSERT INTO `tabtente` (`id_tabtente`, `classe`, `prix`, `nb_reservation`, `ville_demande`, `destination`, `horaire`) VALUES
(1, 'VIP', 200000, 10, 'Ceremonie de consert', 'VIP', '2024-05-22 12:32:00'),
(2, 'Commerciale', 100000, 30, 'Yaoundé', 'ville ndéré', '2024-03-13 00:00:00'),
(10, 'Commerciale', 100000, 30, 'Douala', 'ville ndéré', '2024-05-18 10:36:42'),
(34, 'VIP', 200000, 10, 'Maroua', 'ville ndéré', '2024-05-01 16:15:36'),
(35, 'Commerciale', 150000, 30, 'Ngaoundéré', 'Ville Ndéré', '2024-05-06 12:23:00'),
(36, 'Commerciale', 150000, 30, 'Ceremonie de consert', 'Commerciale', '2024-05-22 12:32:00'),
(37, 'Commerciale', 150000, 30, 'Ceremonie de consert', 'Ville Ndéré', '2024-05-22 12:23:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_resto` (`id_resto`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `id_resto` (`id_resto`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_comment`);

--
-- Index pour la table `faire`
--
ALTER TABLE `faire`
  ADD PRIMARY KEY (`id_faire`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_reser` (`id_reser`);

--
-- Index pour la table `gerer`
--
ALTER TABLE `gerer`
  ADD PRIMARY KEY (`id_gerer`),
  ADD KEY `id_tabtente` (`id_tabtente`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paie`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reser`),
  ADD KEY `id_tabtente` (`id_tabtente`),
  ADD KEY `id_paie` (`id_paie`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Index pour la table `resto_ndere`
--
ALTER TABLE `resto_ndere`
  ADD PRIMARY KEY (`id_resto`);

--
-- Index pour la table `suggerer`
--
ALTER TABLE `suggerer`
  ADD PRIMARY KEY (`id_suggerer`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_comment` (`id_comment`);

--
-- Index pour la table `tabtente`
--
ALTER TABLE `tabtente`
  ADD PRIMARY KEY (`id_tabtente`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_comment` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `faire`
--
ALTER TABLE `faire`
  MODIFY `id_faire` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `gerer`
--
ALTER TABLE `gerer`
  MODIFY `id_gerer` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paie` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reser` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `resto_ndere`
--
ALTER TABLE `resto_ndere`
  MODIFY `id_resto` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `suggerer`
--
ALTER TABLE `suggerer`
  MODIFY `id_suggerer` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tabtente`
--
ALTER TABLE `tabtente`
  MODIFY `id_tabtente` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`id_resto`) REFERENCES `resto_ndere` (`id_resto`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`id_resto`) REFERENCES `resto_ndere` (`id_resto`);

--
-- Contraintes pour la table `faire`
--
ALTER TABLE `faire`
  ADD CONSTRAINT `faire_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `faire_ibfk_2` FOREIGN KEY (`id_reser`) REFERENCES `reservation` (`id_reser`);

--
-- Contraintes pour la table `gerer`
--
ALTER TABLE `gerer`
  ADD CONSTRAINT `gerer_ibfk_1` FOREIGN KEY (`id_tabtente`) REFERENCES `tabtente` (`id_tabtente`),
  ADD CONSTRAINT `gerer_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `administrateur` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_tabtente`) REFERENCES `tabtente` (`id_tabtente`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_paie`) REFERENCES `paiement` (`id_paie`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `administrateur` (`id`);

--
-- Contraintes pour la table `suggerer`
--
ALTER TABLE `suggerer`
  ADD CONSTRAINT `suggerer_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `suggerer_ibfk_2` FOREIGN KEY (`id_comment`) REFERENCES `commentaires` (`id_comment`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

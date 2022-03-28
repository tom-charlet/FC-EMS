-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 28 mars 2022 à 15:58
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
-- Base de données : `fcems`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` int(10) UNSIGNED NOT NULL,
  `titre` varchar(80) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `sub` varchar(500) NOT NULL,
  `texte` text NOT NULL,
  `auteur` int(10) UNSIGNED NOT NULL,
  `date` varchar(14) NOT NULL,
  `type` tinyint(2) UNSIGNED NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `titre`, `keyword`, `sub`, `texte`, `auteur`, `date`, `type`) VALUES
(10, 'machi', 'dsqdqsd;dsqsqds;sdsqd', 'cgdgsqcgqcs', 'cgsdcgfqcds', 1, '20220328', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `equipe` tinyint(3) UNSIGNED NOT NULL,
  `categorie` varchar(30) NOT NULL,
  `lien` varchar(500) NOT NULL,
  `photo` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `equipe`, `categorie`, `lien`, `photo`) VALUES
(4, 1, 'U13 B', 'https://www.fff.fr/competition/club/552519-f-c-eure-madrie-seine/equipe/2021121182U138/resultats-et-calendrier.html|U13 - U12 2', NULL),
(6, 3, 'U15 A', 'https://www.fff.fr/competition/club/552519-f-c-eure-madrie-seine/equipe/2021121182U155/resultats-et-calendrier.html|U15 - U14', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `convocation`
--

CREATE TABLE `convocation` (
  `id_convocation` int(10) UNSIGNED NOT NULL,
  `joueur` int(10) UNSIGNED NOT NULL,
  `categorie` tinyint(3) UNSIGNED NOT NULL,
  `id_rencontre` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id_equipe` tinyint(10) UNSIGNED NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`id_equipe`, `nom`) VALUES
(1, 'U13'),
(3, 'U15'),
(4, 'Senior');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `id_joueur` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `equipe` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`id_joueur`, `nom`, `prenom`, `equipe`) VALUES
(1, 'Charlet', 'Tom', 4),
(9, 'Abraha', 'Noah', 1);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id_media` smallint(5) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `equipe` tinyint(3) UNSIGNED DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `article` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id_media`, `nom`, `equipe`, `type`, `article`) VALUES
(1, 'chat.jpg|une photo de chat', NULL, 'photo', NULL),
(3, 'loupe.jpg|une image de loupe', 1, 'photo', NULL),
(39, 'match ems.png|photo de vsdvxvxcv', NULL, 'sponsor', NULL),
(40, 'bF8N5fTogu7c46U.png|', NULL, 'image', 10);

-- --------------------------------------------------------

--
-- Structure de la table `palmares`
--

CREATE TABLE `palmares` (
  `id_palmares` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date` varchar(20) NOT NULL,
  `equipe` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rencontre`
--

CREATE TABLE `rencontre` (
  `id_rencontre` int(10) UNSIGNED NOT NULL,
  `categorie` tinyint(3) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `date` varchar(40) NOT NULL,
  `equipe_int` varchar(100) NOT NULL,
  `equipe_ext` varchar(100) NOT NULL,
  `score` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rencontre`
--

INSERT INTO `rencontre` (`id_rencontre`, `categorie`, `nom`, `date`, `equipe_int`, `equipe_ext`, `score`) VALUES
(1, 4, 'U13 DEPARTEMENTAL 4 - 1', '20210925 samedi 13:30', 'PACY MENILLES RC 4', 'EURE MADRIE SEINE FC 3', '3 - 0'),
(2, 4, 'U13 DEPARTEMENTAL 4 - 1', '20210925 samedi 14:00', 'EURE MADRIE SEINE FC 2', 'ENT MUIDS/IGOVILLE', '7 - 1'),
(3, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211002 samedi 13:30', 'EURE MADRIE SEINE FC 3', 'MADRIE F.C.', '1 - 6'),
(4, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211002 samedi 14:30', 'CHARLEVAL FC', 'EURE MADRIE SEINE FC 2', '5 - 1'),
(5, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211009 samedi 14:00', 'EURE MADRIE SEINE FC 2', 'FC HENNEZIS VEXIN', '2 - 3'),
(6, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211009 samedi 14:30', 'AILLY FONTAIN', 'EURE MADRIE SEINE FC 3', '14 - 3'),
(7, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211016 samedi 13:30', 'EURE MADRIE SEINE FC 3', 'GRPT JEUNES EPIS FC 2', '2 - 1'),
(8, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211016 samedi 14:30', 'AS VALLEE D&#039;ANDELLE 2', 'EURE MADRIE SEINE FC 2', '0 - 15'),
(9, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20211023 samedi 14:00', 'EURE MADRIE SEINE FC', 'LA CROIX VALLEE EURE', '6 - 0'),
(10, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20211023 samedi 14:00', 'EURE MADRIE SEINE FC', 'LOUVIERS FC 2', '7 - 1'),
(11, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20211023 samedi 14:00', 'VERNON SPN 3', 'EURE MADRIE SEINE FC 2', '1 - 0'),
(12, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20211023 samedi 14:00', 'AILLY FONTAIN', 'EURE MADRIE SEINE FC 2', '1 - 0'),
(13, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20211023 samedi 14:00', 'MADRIE F.C.', 'EURE MADRIE SEINE FC 2', '0 - 3'),
(14, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20211023 samedi 14:00', 'GASNY-U.S.', 'EURE MADRIE SEINE FC 3', '4 - 0'),
(15, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20211023 samedi 14:00', 'FC HENNEZIS VEXIN', 'EURE MADRIE SEINE FC 3', '2 - 1'),
(16, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211106 samedi 13:30', 'LOUVIERS FC 2', 'EURE MADRIE SEINE FC 2', '5 - 1'),
(17, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211106 samedi 13:30', 'EURE MADRIE SEINE FC 3', 'GJACMIE 3', '8 - 2'),
(18, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211113 samedi 14:00', 'EURE MADRIE SEINE FC 2', 'CS LES ANDELYS 2', '6 - 2'),
(19, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211113 samedi 14:30', 'ST MARCEL F 3', 'EURE MADRIE SEINE FC 3', '2 - 3'),
(20, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211120 samedi 14:00', 'EURE MADRIE SEINE FC 2', 'A.F. DE BOUAFLES', '3 - 3'),
(21, 4, 'U13 DEPARTEMENTAL 4 - 1', '20211120 samedi 14:30', 'C.F. DOUAINS', 'EURE MADRIE SEINE FC 3', '7 - 3'),
(22, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20211211 samedi 14:00', 'LERY RC', 'EURE MADRIE SEINE FC', '0 - 1'),
(23, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20211211 samedi 14:00', 'AILLY FONTAIN', 'EURE MADRIE SEINE FC', '0 - 3'),
(24, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20211211 samedi 14:00', 'EURE MADRIE SEINE FC', 'FC SEINE-EURE', '0 - 0'),
(25, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20220129 samedi 14:00', 'FC VAL DE REUIL 2', 'EURE MADRIE SEINE FC', '2 - 1'),
(26, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20220129 samedi 14:00', 'GASNY-U.S.', 'EURE MADRIE SEINE FC', '1 - 0'),
(27, 4, 'FESTIVAL FOOT U13 - QUALIFICATIONS', '20220129 samedi 14:00', 'EURE MADRIE SEINE FC', 'GISORS F.C.G.V.N. 27 2', '1 - 1'),
(28, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220226 samedi 13:30', 'EURE MADRIE SEINE FC 3', 'PACY MENILLES RC 4', '1 - 0'),
(29, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220226 samedi 14:30', 'A.F. DE BOUAFLES', 'EURE MADRIE SEINE FC 2', '5 - 1'),
(30, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220305 samedi 14:00', 'EURE MADRIE SEINE FC 2', 'FC SEINE EURE 3', '8 - 1'),
(31, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220305 samedi 14:30', 'MADRIE F.C.', 'EURE MADRIE SEINE FC 3', '4 - 0'),
(32, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220312 samedi 13:30', 'EURE MADRIE SEINE FC 3', 'VERNON SPN 4', '3 - 4'),
(33, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220312 samedi 14:30', 'CS LES ANDELYS 2', 'EURE MADRIE SEINE FC 2', '0 - 4'),
(34, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220319 samedi 14:00', 'EURE MADRIE SEINE FC 2', 'VERNON SPN 5', '2 - 2'),
(35, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220319 samedi 14:30', 'AILLY FONTAIN', 'EURE MADRIE SEINE FC 3', '5 - 1'),
(36, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220326 samedi 13:30', 'EURE MADRIE SEINE FC 3', 'ST MARCEL F 3', '2 - 3'),
(37, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220326 samedi 14:30', 'FC HENNEZIS VEXIN', 'EURE MADRIE SEINE FC 2', '2 - 1'),
(38, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220514 samedi 13:30', 'EURE MADRIE SEINE FC 3', 'C.F. DOUAINS', '-'),
(39, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220514 samedi 14:30', 'ST MARCEL AS 2', 'EURE MADRIE SEINE FC 2', '-'),
(40, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220521 samedi 13:30', 'LOUVIERS FC 2', 'EURE MADRIE SEINE FC 3', '-'),
(41, 4, 'U13 DEPARTEMENTAL 4 - 1', '20220521 samedi 14:00', 'EURE MADRIE SEINE FC 2', 'US ETREPAGNY 2', '-'),
(42, 6, 'U15 DEPARTEMENTAL 1 - 1', '20210925 samedi 15:30', 'EURE MADRIE SEINE FC', 'ANDELYS CS', '13 - 1'),
(43, 6, 'COUPE DE NORMANDIE U15-ORANGE - 1', '20211002 samedi 15:00', 'US ETREPAGNY', 'FC EURE MADRIE SEINE', '3 - 5'),
(44, 6, 'U15 DEPARTEMENTAL 1 - 1', '20211009 samedi 15:30', 'EURE MADRIE SEINE FC', 'FA DU ROUMOIS', '3 - 2'),
(45, 6, 'COUPE DE NORMANDIE U15-ORANGE - 1', '20211016 samedi 15:00', 'STADE VERNOLIEN', 'FC EURE MADRIE SEINE', '0 - 2'),
(46, 6, 'U15 DEPARTEMENTAL 1 - 1', '20211023 samedi 16:00', 'VERNON SPN', 'EURE MADRIE SEINE FC', '4 - 1'),
(47, 6, 'U15 DEPARTEMENTAL 1 - 1', '20211106 samedi 16:00', 'FC SEINE-EURE', 'EURE MADRIE SEINE FC', '5 - 3'),
(48, 6, 'U15 DEPARTEMENTAL 1 - 1', '20211113 samedi 15:00', 'EURE MADRIE SEINE FC', 'PT AUDEMER CA', '1 - 1'),
(49, 6, 'U15 DEPARTEMENTAL 1 - 1', '20211120 samedi 15:00', 'EURE MADRIE SEINE FC', 'NORMANVIL.ES', '2 - 4'),
(50, 6, 'U15 DEPARTEMENTAL 1 - 1', '20220129 samedi 15:00', 'LA CROIX VALLEE EURE', 'EURE MADRIE SEINE FC', '2 - 2'),
(51, 6, 'COUPE DE NORMANDIE U15-ORANGE - 1', '20220219 samedi 15:00', 'FC DU PAYS AIGLON', 'FC EURE MADRIE SEINE', '4 - 1'),
(52, 6, 'U15 DEPARTEMENTAL 2 - 2', '20220226 samedi 15:00', 'EURE MADRIE SEINE FC', 'GJACMIE', '2 - 0'),
(53, 6, 'U15 DEPARTEMENTAL 2 - 2', '20220305 samedi 15:00', 'US GASNY 2', 'EURE MADRIE SEINE FC', '0 - 5'),
(54, 6, 'U15 DEPARTEMENTAL 2 - 2', '20220312 samedi 15:00', 'EURE MADRIE SEINE FC', 'ANDELYS CS', 'arrêté'),
(55, 6, 'U15 DEPARTEMENTAL 2 - 2', '20220319 samedi 15:30', 'ABPV ES', 'EURE MADRIE SEINE FC', '0 - 3'),
(56, 6, 'U15 DEPARTEMENTAL 2 - 2', '20220402 samedi 15:30', 'EURE MADRIE SEINE FC', 'ROMIL.PT ST P', '-'),
(57, 6, 'COUPE U15 A.LEDUC', '20220409 samedi 15:00', 'ENT CONCHES/RUGLES', 'EURE MADRIE SEINE FC', '-'),
(58, 6, 'U15 DEPARTEMENTAL 2 - 2', '20220514 samedi 15:30', 'EURE MADRIE SEINE FC', 'EPIS FC', '-'),
(59, 6, 'U15 DEPARTEMENTAL 2 - 2', '20220521 samedi 15:30', 'PITRES CA', 'EURE MADRIE SEINE FC', '-');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id_settings` tinyint(4) NOT NULL,
  `name` varchar(256) NOT NULL,
  `value` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id_settings`, `name`, `value`) VALUES
(3, 'home_text', 'voici l histoire du club EMS c est super tout ce blabla');

-- --------------------------------------------------------

--
-- Structure de la table `sponsor`
--

CREATE TABLE `sponsor` (
  `id_sponsor` int(10) UNSIGNED NOT NULL,
  `nom` varchar(80) NOT NULL,
  `date` tinytext NOT NULL,
  `type` varchar(40) NOT NULL,
  `texte` text NOT NULL,
  `photo` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sponsor`
--

INSERT INTO `sponsor` (`id_sponsor`, `nom`, `date`, `type`, `texte`, `photo`) VALUES
(6, 'vsdvxvxcv', '2022', 'materiel', 'vsvxcvxvd', 39);

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `infos` varchar(255) DEFAULT NULL,
  `name` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `staff`
--

INSERT INTO `staff` (`id_staff`, `nom`, `prenom`, `type`, `infos`, `name`, `password`, `photo`) VALUES
(1, 'Caillot', 'Antoine', 'admin', 'fsefsfqd', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', NULL),
(2, 'Charlet', 'Tom', 'president', NULL, 'tommy', '044f4b3501cd8e8131d40c057893f4fdff66bf4032ecae159e0c892a28cf6c8e', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorie` (`categorie`),
  ADD KEY `equipe` (`equipe`) USING BTREE,
  ADD KEY `photo` (`photo`);

--
-- Index pour la table `convocation`
--
ALTER TABLE `convocation`
  ADD PRIMARY KEY (`id_convocation`),
  ADD KEY `joueur` (`joueur`) USING BTREE,
  ADD KEY `categorie` (`categorie`),
  ADD KEY `id_rencontre` (`id_rencontre`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_equipe`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`id_joueur`),
  ADD KEY `equipe` (`equipe`) USING BTREE;

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id_media`),
  ADD KEY `article` (`article`),
  ADD KEY `equipe` (`equipe`);

--
-- Index pour la table `palmares`
--
ALTER TABLE `palmares`
  ADD PRIMARY KEY (`id_palmares`),
  ADD KEY `equipe` (`equipe`);

--
-- Index pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD PRIMARY KEY (`id_rencontre`),
  ADD KEY `categorie` (`categorie`) USING BTREE;

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_settings`);

--
-- Index pour la table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id_sponsor`);

--
-- Index pour la table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD KEY `photo` (`photo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `convocation`
--
ALTER TABLE `convocation`
  MODIFY `id_convocation` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_equipe` tinyint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id_joueur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `palmares`
--
ALTER TABLE `palmares`
  MODIFY `id_palmares` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rencontre`
--
ALTER TABLE `rencontre`
  MODIFY `id_rencontre` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id_settings` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id_sponsor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`equipe`) REFERENCES `equipe` (`id_equipe`);

--
-- Contraintes pour la table `convocation`
--
ALTER TABLE `convocation`
  ADD CONSTRAINT `convocation_ibfk_1` FOREIGN KEY (`joueur`) REFERENCES `joueur` (`id_joueur`) ON UPDATE CASCADE,
  ADD CONSTRAINT `convocation_ibfk_2` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `convocation_ibfk_3` FOREIGN KEY (`id_rencontre`) REFERENCES `rencontre` (`id_rencontre`);

--
-- Contraintes pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `joueur_ibfk_1` FOREIGN KEY (`equipe`) REFERENCES `equipe` (`id_equipe`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`equipe`) REFERENCES `equipe` (`id_equipe`) ON UPDATE CASCADE,
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`article`) REFERENCES `article` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `palmares`
--
ALTER TABLE `palmares`
  ADD CONSTRAINT `palmares_ibfk_1` FOREIGN KEY (`equipe`) REFERENCES `equipe` (`id_equipe`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD CONSTRAINT `categorie_ibfk_2` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

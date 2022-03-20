-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 20 mars 2022 à 18:10
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

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
  `date` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `titre`, `keyword`, `sub`, `texte`, `auteur`, `date`, `type`) VALUES
(1, 'Article victoire senior', 'senior;victoire', 'Lorem ipsum dolor sit amet. Et assumenda illo ut rerum dolorem non sunt impedit ut amet expedita vel ipsam ratione! Aut voluptatem ipsam sit dolorum consequatur eos fugiat exercitationem qui modi dolorem.', 'Lorem ipsum dolor sit amet. Et assumenda illo ut rerum dolorem non sunt impedit ut amet expedita vel ipsam ratione! Aut voluptatem ipsam sit dolorum consequatur eos fugiat exercitationem qui modi dolorem. Cum omnis amet id incidunt sint est totam dignissimos ut dolores nihil est voluptatem recusandae in unde odit.\r\n\r\nEa galisum vero aut officiis enim ad deleniti voluptates nam quas itaque ad Quis incidunt. Est nihil harum quo rerum enim qui ipsam velit eum recusandae sint ab autem temporibus et temporibus amet. Et voluptas alias et omnis nemo hic ipsum rerum non provident nulla.\r\n\r\nEst rerum accusantium et perspiciatis quisquam hic iste necessitatibus est velit galisum ea nesciunt inventore in officia laborum aut dolor nisi? Eum quasi quam non aspernatur voluptas qui commodi excepturi non aspernatur maxime et tenetur veritatis eos ducimus consequatur. Eum sunt corporis est ducimus voluptate sed aliquam illum sit vero molestias et quos asperiores quo neque vitae. In quaerat sint eum deleniti saepe sed dicta neque 33 quod veritatis eos fuga nihil?', 1, '20220130', 'type1');

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
(4, 1, 'U13 B', '', NULL),
(6, 3, 'U15 A', '', NULL),
(7, 3, 'U15 B', '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `classement`
--

CREATE TABLE `classement` (
  `id_classement` smallint(5) UNSIGNED NOT NULL,
  `categorie` tinyint(3) UNSIGNED NOT NULL,
  `position` tinyint(3) UNSIGNED NOT NULL,
  `point` tinyint(4) NOT NULL,
  `nom` varchar(70) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'femme.jpg|une jolie photo de femme', 4, 'photo', 1),
(3, 'loupe.jpg|une image de loupe', 1, 'photo', NULL);

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
  `nom` varchar(50) NOT NULL,
  `date` varchar(40) NOT NULL,
  `equipe_int` smallint(5) UNSIGNED NOT NULL,
  `equipe_ext` smallint(5) UNSIGNED NOT NULL,
  `score` varchar(12) NOT NULL,
  `categorie` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sponsor`
--

INSERT INTO `sponsor` (`id_sponsor`, `nom`, `date`, `type`) VALUES
(1, 'nike', '2018', 'materiel'),
(2, 'nike', '2023', 'materiel');

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
-- Index pour la table `classement`
--
ALTER TABLE `classement`
  ADD PRIMARY KEY (`id_classement`),
  ADD KEY `categorie` (`categorie`);

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
  ADD KEY `equipe_ext` (`equipe_ext`),
  ADD KEY `equipe_int` (`equipe_int`),
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
  MODIFY `id_article` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `classement`
--
ALTER TABLE `classement`
  MODIFY `id_classement` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_media` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `palmares`
--
ALTER TABLE `palmares`
  MODIFY `id_palmares` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rencontre`
--
ALTER TABLE `rencontre`
  MODIFY `id_rencontre` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id_settings` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id_sponsor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Contraintes pour la table `classement`
--
ALTER TABLE `classement`
  ADD CONSTRAINT `classement_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`);

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
  ADD CONSTRAINT `categorie_ibfk_2` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `equipe_ext_ibfk_3` FOREIGN KEY (`equipe_ext`) REFERENCES `classement` (`id_classement`),
  ADD CONSTRAINT `equipe_int_ibfk_4` FOREIGN KEY (`equipe_int`) REFERENCES `classement` (`id_classement`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

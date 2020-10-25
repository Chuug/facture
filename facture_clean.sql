-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 30 oct. 2019 à 11:54
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `facture_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `a_type` varchar(20) DEFAULT NULL,
  `custom_id` varchar(50) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `compagnie_id` int(11) DEFAULT NULL,
  `link_id` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `rib_id` int(11) DEFAULT NULL,
  `factures` tinyint(1) DEFAULT NULL,
  `acomptes` tinyint(1) DEFAULT NULL,
  `solde` tinyint(1) DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '1',
  `validity` smallint(6) DEFAULT NULL,
  `devise` varchar(10) DEFAULT NULL,
  `tva_non_applicable` tinyint(1) NOT NULL DEFAULT '1',
  `remise_generale` int(11) DEFAULT NULL,
  `remise_generale_param` tinyint(4) DEFAULT NULL,
  `pay_conditions` text NOT NULL,
  `pay_type` text NOT NULL,
  `pay_interest` text NOT NULL,
  `text_introduction` text,
  `text_conclusion` text,
  `text_foot` text,
  `text_conditions` text,
  `ts_created` int(10) UNSIGNED DEFAULT NULL,
  `ts_updated` int(10) UNSIGNED DEFAULT NULL,
  `ts_pdf` int(10) UNSIGNED DEFAULT NULL,
  `ts_finalized` int(10) UNSIGNED DEFAULT NULL,
  `ts_signed` int(10) UNSIGNED DEFAULT NULL,
  `ts_paid` int(10) UNSIGNED DEFAULT NULL,
  `total_ht` float DEFAULT NULL,
  `total_ttc` float DEFAULT NULL,
  `acompte_montant` float DEFAULT NULL,
  `acompte_montant_param` tinyint(2) DEFAULT NULL,
  `acompte_tva` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `a_type` tinyint(4) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `compagny_id` int(11) DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `ts_created` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `action_id` int(11) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `quantity` smallint(5) UNSIGNED DEFAULT NULL,
  `ht_price` float DEFAULT NULL,
  `tva` tinyint(4) DEFAULT NULL,
  `reduction` float DEFAULT NULL,
  `reduction_param` tinyint(4) NOT NULL,
  `ht_total` float DEFAULT NULL,
  `ttc_total` float DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `fonction` varchar(50) DEFAULT NULL,
  `langue` varchar(25) NOT NULL,
  `note` text,
  `compagnie_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `ts_created` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `compagnies`
--

CREATE TABLE `compagnies` (
  `id` int(11) NOT NULL,
  `nom_societe` varchar(100) NOT NULL,
  `tva` varchar(50) DEFAULT NULL,
  `siren` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `langue` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `ts_created` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `coordonnees`
--

CREATE TABLE `coordonnees` (
  `id` int(11) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `cpl_adresse` varchar(255) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(58) DEFAULT NULL,
  `pays` varchar(51) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `compagnie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `parameters`
--

CREATE TABLE `parameters` (
  `id` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `parameter` varchar(200) DEFAULT NULL,
  `bool` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `parameters`
--

INSERT INTO `parameters` (`id`, `label`, `description`, `parameter`, `bool`) VALUES
(5, 'devise', 'Euro', '€', 1),
(12, 'articleType', NULL, 'Heures', 0),
(14, 'articleType', NULL, 'Jours', 0),
(15, 'articleType', NULL, 'Acompte', 0),
(22, 'payType', NULL, 'Carte bancaire', 1),
(26, 'payInterest', NULL, '1% par mois', 0),
(28, 'applyTva', 'Tva applicable', NULL, 0),
(29, 'tva', NULL, '6', 0),
(30, 'tva', NULL, '12', 0),
(31, 'tva', NULL, '21', 1),
(32, 'applyTvaText', NULL, 'TVA non applicable', 1),
(33, 'articleType', NULL, 'Produits', 1),
(34, 'articleType', NULL, 'Service', 0),
(35, 'devisCounter', 'Compteur devis', '0', 0),
(36, 'facturesCounter', 'Compteur factures', '0', 0),
(37, 'avoirsCounter', 'Compteur avoirs', '0', 0),
(38, 'acomptesCounter', 'Compteur acomptes', '0', 0),
(39, 'linkId', NULL, '6', 0),
(40, 'formatNumerotation', NULL, 'label.aa.n', 0),
(41, 'tailleCompteur', NULL, '5', 0),
(42, 'devisLabel', NULL, 'D', 0),
(43, 'facturesLabel', NULL, 'F', 0),
(44, 'avoirsLabel', NULL, 'A', 0),
(45, 'acomptesLabel', NULL, 'FA', 0),
(46, 'devisTextIntroduction', NULL, '', 0),
(47, 'devisTextConclusion', NULL, '', 0),
(48, 'devisTextFooter', NULL, 'Pied de page de devis', 0),
(49, 'devisTextConditions', NULL, '', 0),
(50, 'facturesTextIntroduction', NULL, '', 0),
(51, 'facturesTextConclusion', NULL, '', 0),
(52, 'facturesTextFooter', NULL, 'pied facture', 0),
(53, 'avoirsTextIntroduction', NULL, '', 0),
(54, 'avoirsTextConclusion', NULL, '', 0),
(55, 'avoirsTextFooter', NULL, 'pied avoir', 0),
(56, 'acomptesTextIntroduction', NULL, '', 0),
(57, 'acomptesTextConclusion', NULL, '', 0),
(58, 'acomptesTextFooter', NULL, 'pied acomptes', 0),
(59, 'userMail', NULL, NULL, 0),
(60, 'userPrenom', NULL, NULL, 0),
(61, 'userNom', NULL, NULL, 0),
(62, 'userCompagny', NULL, NULL, 0),
(63, 'userSiret', NULL, NULL, 0),
(64, 'userCode', NULL, NULL, 0),
(65, 'userTva', NULL, NULL, 0),
(66, 'userAdresse', NULL, NULL, 0),
(67, 'userPostal', NULL, NULL, 0),
(68, 'userVille', NULL, NULL, 0),
(69, 'userPays', NULL, NULL, 0),
(70, 'userTelephone', NULL, NULL, 0),
(71, 'userWeb', NULL, NULL, 0),
(72, 'payInterest', 'default', 'Pas d\'intérêts', 1),
(73, 'payCondition', NULL, 'Sur réception', 0),
(74, 'payCondition', NULL, 'Fin de mois', 0),
(75, 'payCondition', NULL, '10 jours', 0),
(76, 'payCondition', NULL, '30 jours', 0),
(77, 'payCondition', NULL, '30 jours fin de mois', 0),
(78, 'payCondition', NULL, '45 jours fin de mois', 1),
(79, 'payCondition', NULL, '60 jours', 0),
(80, 'payCondition', NULL, '60 jours fin de mois', 0),
(81, 'payCondition', NULL, '90 jours', 0),
(82, 'payCondition', NULL, '90 jours fin de mois', 0),
(83, 'payCondition', NULL, '120 jours', 0),
(84, 'payType', NULL, 'Espèces', 0),
(85, 'payType', NULL, 'Chèque', 0),
(86, 'payType', NULL, 'Virement bancaire', 0),
(87, 'payType', NULL, 'Paypal', 0),
(88, 'payType', NULL, 'Prélèvement', 0),
(89, 'payType', NULL, 'Lettre de change', 0),
(90, 'payType', NULL, 'Lettre de change relevé', 0),
(91, 'payType', NULL, 'Lettre de change sans acceptation', 0),
(92, 'payType', NULL, 'Billet à ordre', 0),
(93, 'payInterest', NULL, '1,5% par mois', 0),
(94, 'payInterest', NULL, '2% par mois', 0),
(95, 'payInterest', NULL, 'Taux d\'intérêt légal en vigueur', 0),
(96, 'payInterest', NULL, 'À préciser', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ribs`
--

CREATE TABLE `ribs` (
  `id` int(11) NOT NULL,
  `iban` varchar(100) NOT NULL,
  `bic` varchar(100) NOT NULL,
  `titulaire` varchar(100) NOT NULL,
  `libel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `install_config` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_type` (`a_type`);

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compagnies`
--
ALTER TABLE `compagnies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `coordonnees`
--
ALTER TABLE `coordonnees`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `label` (`label`);

--
-- Index pour la table `ribs`
--
ALTER TABLE `ribs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `compagnies`
--
ALTER TABLE `compagnies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `coordonnees`
--
ALTER TABLE `coordonnees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `ribs`
--
ALTER TABLE `ribs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

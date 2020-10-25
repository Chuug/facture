-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 15 oct. 2020 à 18:23
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `facture`
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

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`id`, `a_type`, `custom_id`, `client_id`, `compagnie_id`, `link_id`, `origin_id`, `rib_id`, `factures`, `acomptes`, `solde`, `state`, `validity`, `devise`, `tva_non_applicable`, `remise_generale`, `remise_generale_param`, `pay_conditions`, `pay_type`, `pay_interest`, `text_introduction`, `text_conclusion`, `text_foot`, `text_conditions`, `ts_created`, `ts_updated`, `ts_pdf`, `ts_finalized`, `ts_signed`, `ts_paid`, `total_ht`, `total_ttc`, `acompte_montant`, `acompte_montant_param`, `acompte_tva`) VALUES
(1, 'devis', 'D1900002', 5, 19, 4, NULL, NULL, 1, 1, NULL, 4, 5, '€', 0, 5, 0, '60 jours fin de mois', 'Virement bancaire', 'Pas d\'intérêts de retard', NULL, NULL, NULL, NULL, 1566344414, 1570162287, 1570618729, 1567190917, 1569925251, NULL, 315, NULL, NULL, NULL, NULL),
(2, 'devis', 'D1900003', 10, NULL, 3, NULL, NULL, 1, NULL, NULL, 4, NULL, '£', 0, NULL, 0, '60 jours fin de mois', 'Virement bancaire', 'Pas d\'intérêts de retard', NULL, NULL, NULL, NULL, 1566348474, 1567190379, 1570618719, 1567195174, 1569518146, 1569426633, 200, NULL, NULL, NULL, NULL),
(12, 'devis', NULL, 5, 19, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', 'Texte intro', 'Text conclusion', 'Je suis une pied', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tincidunt faucibus sagittis. Vivamus in elit ante. Vivamus et fringilla enim, vel lacinia tellus. Duis iaculis ex ultrices pulvinar viverra. Nunc eleifend lacus elit, sit amet dictum magna imperdiet quis. Morbi bibendum sollicitudin arcu, sit amet pharetra nibh tempus in. Donec tempor aliquam fermentum. Phasellus vel tortor eu leo suscipit rhoncus eu eu orci. Phasellus pharetra placerat mauris sed dapibus. Cras euismod tempus diam et blandit. Donec hendrerit ultrices molestie. Phasellus dignissim ante vel augue fermentum, sit amet pharetra mi rhoncus.\r\n\r\nNam vel arcu non mauris aliquam vehicula gravida vitae metus. Duis elementum efficitur placerat. Morbi eu dignissim arcu, sit amet fermentum arcu. Morbi vel bibendum leo. Sed hendrerit sed ipsum sit amet suscipit. Nunc a condimentum eros. Proin iaculis vel neque in suscipit. Quisque et arcu sed nibh dapibus sagittis vel scelerisque dui. Sed aliquam viverra nunc, eu accumsan elit tincidunt sed. Nam eget dignissim orci.\r\n\r\nPhasellus pretium, lorem ac convallis posuere, est mi fringilla purus, eget rhoncus ligula purus ut ex. Cras tempus maximus semper. Proin cursus feugiat mi in sodales. In justo lacus, molestie ultricies justo elementum, malesuada blandit quam. Aliquam id massa ornare, venenatis nibh nec, convallis nulla. Ut non nulla gravida, tempus dolor nec, vulputate velit. Nam lacinia tortor a quam venenatis congue. Mauris pretium nunc augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed iaculis mi at libero sodales, sit amet efficitur arcu feugiat. Etiam non ornare sapien, non eleifend enim.\r\n\r\nIn nibh felis, aliquam sit amet ligula at, ultricies venenatis lacus. Cras ultricies at arcu eget pharetra. Cras efficitur dui in ultrices ornare. Praesent hendrerit arcu leo, a condimentum justo sagittis eget. Suspendisse potenti. Morbi interdum aliquam sem. Duis ultricies orci sed molestie dapibus. In non turpis aliquet, semper elit id, varius lorem. Vestibulum eget massa a magna sollicitudin egestas nec ut orci.\r\n\r\nCras nec laoreet quam. Phasellus imperdiet ante a elit accumsan ultricies. Integer fringilla sit amet felis sed maximus. Nulla ac nulla elementum, molestie justo non, fermentum felis. Donec placerat imperdiet sodales. Nam rhoncus fringilla tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sit amet nibh sed ante tristique euismod in in magna. Fusce id scelerisque quam. Pellentesque ultricies, nisi a ultrices iaculis, ante leo dictum mauris, ut bibendum erat neque ac nunc. Sed quis consequat nulla. Quisque quis nulla a turpis sodales sollicitudin id a felis. Vestibulum augue felis, aliquet at consequat id, porta eu nunc. Quisque cursus nisl purus. Pellentesque sagittis dignissim lacus quis congue. Praesent a velit ultricies, suscipit erat non, luctus diam.', 1567649084, 1570342254, 1570618713, NULL, NULL, NULL, 55530, NULL, NULL, NULL, NULL),
(13, 'factures', 'F1900001', 5, 19, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', NULL, NULL, NULL, NULL, 1567729643, NULL, 1570618797, 1567730450, NULL, 1568002415, 300, NULL, NULL, NULL, NULL),
(14, 'avoirs', 'A1900001', 11, 19, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', NULL, NULL, NULL, NULL, 1567729846, NULL, 1570618815, 1567730430, NULL, NULL, 10, NULL, NULL, NULL, NULL),
(16, 'factures', 'F1900004', 8, 29, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', NULL, NULL, NULL, NULL, 1567734211, 1567739470, 1570618792, 1569452279, NULL, NULL, 2250, NULL, NULL, NULL, NULL),
(17, 'avoirs', NULL, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', NULL, NULL, NULL, NULL, 1567734244, NULL, 1570618811, NULL, NULL, NULL, 339, NULL, NULL, NULL, NULL),
(19, 'factures', 'F1900002', NULL, 25, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', NULL, NULL, NULL, NULL, 1568013042, NULL, 1570618787, 1568013066, NULL, NULL, 100, NULL, NULL, NULL, NULL),
(22, 'factures', 'F20190926006', 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '€', 1, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', NULL, NULL, NULL, NULL, 1569452330, NULL, 1570618781, 1569452457, NULL, NULL, 50, NULL, NULL, NULL, NULL),
(24, 'factures', 'F1900007', 10, NULL, 3, NULL, NULL, NULL, NULL, NULL, 2, NULL, '€', 0, NULL, 0, '60 jours fin de mois', 'Virement bancaire', 'Pas d\'intérêts de retard', NULL, NULL, NULL, NULL, 1569518253, NULL, 1570618772, 1569518266, NULL, NULL, 250, NULL, NULL, NULL, NULL),
(25, 'factures', NULL, 10, NULL, NULL, 24, NULL, NULL, NULL, NULL, 1, NULL, '£', 0, NULL, 0, '60 jours fin de mois', 'Virement bancaire', 'Pas d\'intérêts de retard', 'Intro 3', 'Conclu 3', 'Pied3', NULL, 1569527756, NULL, 1570618764, NULL, NULL, NULL, 300, NULL, NULL, NULL, NULL),
(29, 'factures', NULL, 10, NULL, 3, NULL, NULL, NULL, NULL, NULL, 1, NULL, '£', 0, 10, 0, '60 jours fin de mois', 'Virement bancaire', 'Pas d\'intérêts de retard', NULL, NULL, NULL, NULL, 1569532370, 1570419478, 1570618759, NULL, NULL, NULL, 190, NULL, NULL, NULL, NULL),
(37, 'devis', 'D1900006', 5, 19, 6, 12, NULL, NULL, 1, NULL, 4, 2, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', 'Intro 37', NULL, NULL, NULL, 1569535136, 1569994302, 1570618703, 1570156478, 1570156482, NULL, 4321, NULL, NULL, NULL, NULL),
(38, 'acomptes', 'FA1900012', 5, 19, 4, NULL, NULL, NULL, NULL, NULL, 5, NULL, '€', 0, 5, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', NULL, NULL, NULL, NULL, 1569923150, NULL, 1570618837, 1569923262, NULL, 1569925256, 315, NULL, 10, 0, 21),
(44, 'acomptes', 'FA1900019', 5, 19, 4, NULL, NULL, NULL, NULL, NULL, 5, NULL, '€', 0, 5, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', NULL, NULL, NULL, NULL, 1569927613, NULL, 1570618833, 1569927618, NULL, 1569927626, 315, NULL, 5, 0, 21),
(47, 'factures', 'F1900008', 5, 19, 4, NULL, NULL, NULL, NULL, 1, 2, NULL, '€', 0, 5, 0, '60 jours fin de mois', 'Virement bancaire', 'Pas d\'intérêts de retard', NULL, NULL, NULL, NULL, 1569929097, NULL, 1570618755, 1569929222, NULL, NULL, 315, NULL, NULL, NULL, NULL),
(48, 'acomptes', 'FA1900021', 5, 19, 6, NULL, NULL, NULL, NULL, NULL, 5, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', 'acomptes intro', 'acomptes conclu', 'pied acomptes', NULL, 1570156516, NULL, 1570618829, 1570156521, NULL, 1570157145, 4321, NULL, 8, 0, 21),
(49, 'devis', 'D1900007', 5, 19, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', 'Texte d\'introduction de devis', 'Texte de conclusion de devis', 'Pied de page de devis', 'Conditions devis', 1570161071, 1570161105, 1570618683, 1570163806, 1570163809, NULL, 4, NULL, NULL, NULL, NULL),
(58, 'acomptes', NULL, 5, 19, 6, NULL, 1, NULL, NULL, NULL, 1, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1000% mamen', 'acomptes intro', NULL, 'pied acomptes', NULL, 1570331204, 1570428060, 1570618825, NULL, NULL, NULL, 4321, NULL, 10, 0, 6),
(59, 'factures', NULL, 5, 19, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '€', 0, 10, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'Intro facture', 'Conclusion de facture', NULL, NULL, 1570427567, 1571852922, 1571853581, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL),
(60, 'factures', NULL, 11, 19, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'Intro facture', 'Conclusion de facture', NULL, NULL, 1570427587, 1570427969, 1570618738, NULL, NULL, NULL, 900, NULL, NULL, NULL, NULL),
(61, 'devis', 'D1900008', 5, 19, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'Texte d\'introduction de devis', 'Texte de conclusion de devis', NULL, 'Conditions devis', 1570432125, NULL, 1570618638, 1570432129, NULL, NULL, 1320, NULL, NULL, NULL, NULL),
(62, 'factures', 'F1900009', NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'Intro facture', 'Conclusion de facture', NULL, NULL, 1570535274, NULL, 1571950060, 1570535278, NULL, 1571801962, 2, NULL, NULL, NULL, NULL),
(63, 'devis', 'D1900009', 5, 19, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'Texte d\'introduction de devis', 'Texte de conclusion de devis', NULL, 'Conditions devis', 1570620774, 1570620954, 1570621039, 1570620980, 1570621020, NULL, 2500, NULL, NULL, NULL, NULL),
(65, 'devis', 'D1900011', NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'Texte d\'introduction de devis', 'Texte de conclusion de devis', NULL, 'Conditions devis', 1570796415, NULL, 1572143020, 1570796420, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(66, 'devis', NULL, 9, 29, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'Texte d\'introduction de devis', 'Texte de conclusion de devis', NULL, 'Conditions devis', 1571862607, NULL, 1571863132, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL),
(67, 'devis', 'D1900012', 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '€', 0, 5, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'Texte d\'introduction de devis', 'Texte de conclusion de devis', NULL, 'Conditions devis', 1572132383, NULL, 1572143012, 1572132479, NULL, NULL, 17183, NULL, NULL, NULL, NULL),
(68, 'devis', 'D1900013', 5, 19, 7, NULL, NULL, 1, 1, NULL, 4, 10, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1000% mamen', 'Texte d\'introduction de devis', 'Texte de conclusion de devis', NULL, 'Conditions devis', 1572870940, NULL, 1572870952, 1572870951, 1572870960, NULL, 90000, NULL, NULL, NULL, NULL),
(70, 'factures', NULL, 8, 29, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'Intro facture', 'Conclusion de facture', NULL, NULL, 1572871065, NULL, 1572871065, NULL, NULL, NULL, 17183, NULL, NULL, NULL, NULL),
(71, 'avoirs', 'A1900002', 8, 29, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'intro avoirs', 'conclu avoir', NULL, NULL, 1572872549, NULL, 1572872553, 1572872552, NULL, NULL, 1000, NULL, NULL, NULL, NULL),
(72, 'acomptes', 'FA1900033', 5, 19, 7, NULL, NULL, NULL, NULL, NULL, 5, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', 'Pas d\'intérêts', 'acomptes intro', 'acomptes conclu', NULL, NULL, 1572873488, NULL, 1572873493, 1572873493, NULL, 1572873529, 90000, NULL, 20, 0, 21),
(73, 'factures', 'F19000010', 5, 19, 7, NULL, NULL, NULL, NULL, 1, 5, NULL, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1000% mamen', 'Intro facture', 'Conclusion de facture', NULL, NULL, 1572873570, NULL, 1602781032, 1572873578, NULL, 1572873586, 90000, NULL, NULL, NULL, NULL),
(74, 'devis', 'D2000014', 8, 29, NULL, NULL, NULL, NULL, NULL, NULL, 2, 30, '€', 0, NULL, 0, '45 jours fin de mois', 'Carte bancaire', '1% par mois', 'Texte d\'introduction de devis', 'Texte de conclusion de devis', NULL, 'Conditions devis', 1602781434, NULL, 1602781452, 1602781441, NULL, NULL, 1440, NULL, NULL, NULL, NULL);

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

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `action_id`, `type`, `quantity`, `ht_price`, `tva`, `reduction`, `reduction_param`, `ht_total`, `ttc_total`, `description`) VALUES
(1, 1, 'Pets', 1, 100, 12, 5, 0, 95, 106.4, ''),
(2, 1, 'Pets', 2, 10, 12, NULL, 0, 20, 22.4, ''),
(3, 2, 'Acompte', 1, 200, 12, NULL, 0, 200, 224, 'giveaway'),
(8, 1, 'Pets', 2, 100, 12, NULL, 0, 200, 224, ''),
(14, 7, 'Produits', 1, 10000, 6, NULL, 0, 10000, 10600, 'batmobile'),
(15, 7, 'Produits', 1, 150, 6, NULL, 0, 150, 159, 'spray poivre'),
(16, 8, 'Produits', 1, 10000, 12, 5, 0, 9500, 10640, 'grosse fusée'),
(17, 8, 'Produits', 2, 118, 21, NULL, 0, 236, 285.56, 'petite fusée'),
(20, 10, 'Produits', 2, 10, 12, 5, 0, 19, 21.28, ''),
(21, 10, 'Produits', 1, 100, 12, NULL, 0, 100, 112, ''),
(23, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(24, 13, 'Produits', 1, 100, 12, NULL, 0, 100, 112, 'Tuiles'),
(25, 13, 'Produits', 2, 100, 12, NULL, 0, 200, 224, 'Tuiles'),
(26, 14, 'Produits', 1, 10, 12, NULL, 0, 10, 11.2, 'nesquick'),
(28, 16, 'Produits', 1, 2500, 12, 10, 0, 2250, 2520, 'batmobile'),
(29, 17, 'Produits', 1, 339, 12, NULL, 0, 339, 379.68, 'boulier'),
(31, 19, 'Produits', 1, 100, 12, NULL, 0, 100, 112, ''),
(32, 22, 'Produits', 1, 20, NULL, NULL, 0, 20, 20, 'Filet de poulet'),
(33, 22, 'Produits', 2, 15, NULL, NULL, 0, 30, 30, 'Cuisses de poulets'),
(34, 24, 'Acompte', 1, 250, 12, NULL, 0, 250, 280, 'giveaway 2'),
(35, 25, 'Acompte', 1, 300, 12, NULL, 0, 300, 336, 'giveaway 3'),
(40, 29, 'Acompte', 1, 200, 12, 5, 0, 190, 212.8, 'giveaway'),
(44, 37, 'Produits', 1, 4321, 12, NULL, 0, 4321, 4839.52, ''),
(51, 47, 'Pets', 1, 100, 12, 5, 0, 95, 106.4, ''),
(52, 47, 'Pets', 2, 10, 12, NULL, 0, 20, 22.4, ''),
(53, 47, 'Pets', 2, 100, 12, NULL, 0, 200, 224, ''),
(54, 49, 'Produits', 1, 2, 12, NULL, 0, 2, 2.24, ''),
(55, 49, 'Produits', 1, 2, 21, NULL, 0, 2, 2.42, ''),
(56, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(57, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(58, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(59, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(60, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(61, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(62, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(63, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(64, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(65, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(66, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(67, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(68, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(69, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(70, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(71, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(72, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(73, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(74, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(75, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(76, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(77, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(78, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(79, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(80, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(81, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(82, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(83, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(84, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(85, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(86, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(87, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(88, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(89, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(90, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(91, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(92, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(93, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(94, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(95, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(96, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(97, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(98, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(99, 12, 'Produits', 1, 1234, 12, NULL, 0, 1234, 1382.08, ''),
(100, 59, 'Produits', 1, 100, 12, NULL, 0, 100, 112, 'écran'),
(101, 60, 'Produits', 2, 450, 12, NULL, 0, 900, 1008, 'CG'),
(102, 61, 'Produits', 1, 1320, 12, NULL, 0, 1320, 1478.4, ''),
(103, 62, 'Produits', 1, 2, 12, NULL, 0, 2, 2.24, ''),
(104, 63, 'Produits', 1, 1000, 12, NULL, 0, 1000, 1120, 'pdf generator'),
(105, 63, 'Produits', 1, 1500, 21, NULL, 0, 1500, 1815, 'mailer'),
(107, 65, 'Produits', 1, 1, 12, NULL, 0, 1, 1.12, ''),
(108, 66, 'Produits', 1, 100, 12, NULL, 0, 100, 112, ''),
(109, 67, 'Produits', 53, 30, 12, NULL, 0, 1590, 1780.8, 'Interrupteur simple 2d ou inverseur'),
(110, 67, 'Produits', 108, 20, 12, NULL, 0, 2160, 2419.2, 'Point lumineux '),
(111, 67, 'Produits', 6, 60, 12, NULL, 0, 360, 403.2, 'Led niko balise'),
(112, 67, 'Produits', 1, 275, 12, NULL, 0, 275, 308, 'Détecteur de mouvement Niko'),
(113, 67, 'Produits', 4, 95, 12, NULL, 0, 380, 425.6, 'Prise quadruple'),
(114, 67, 'Produits', 14, 38, 12, NULL, 0, 532, 595.84, 'Prise Simple'),
(115, 67, 'Produits', 26, 57, 12, NULL, 0, 1482, 1659.84, 'Prise Double'),
(116, 67, 'Produits', 2, 76, 12, NULL, 0, 152, 170.24, 'Prise Triple'),
(117, 67, 'Produits', 1, 40, 12, NULL, 0, 40, 44.8, 'Prise machine à laver'),
(118, 67, 'Produits', 1, 40, 12, NULL, 0, 40, 44.8, 'Prise séchoir'),
(119, 67, 'Produits', 1, 40, 12, NULL, 0, 40, 44.8, 'Prise lave vaisselle'),
(120, 67, 'Produits', 3, 40, 12, NULL, 0, 120, 134.4, 'Prise four'),
(121, 67, 'Produits', 1, 120, 12, NULL, 0, 120, 134.4, 'Alimentation taques de cuisson'),
(122, 67, 'Produits', 2, 70, 12, NULL, 0, 140, 156.8, 'Prise TV'),
(123, 67, 'Produits', 9, 70, 12, NULL, 0, 630, 705.6, 'Prise RJ 45'),
(124, 67, 'Produits', 1, 815, 12, NULL, 0, 815, 912.8, 'Parlophone kit ticino simple 238 363 411'),
(125, 67, 'Produits', 10, 40, 12, NULL, 0, 400, 448, 'Tubage alarme'),
(126, 67, 'Produits', 24, 64, 12, NULL, 0, 1536, 1720.32, 'Module deux boutons 101'),
(127, 67, 'Produits', 4, 76, 12, NULL, 0, 304, 340.48, 'Module quatre boutons 101'),
(128, 67, 'Produits', 1, 88, 12, NULL, 0, 88, 98.56, 'Module six boutons 101'),
(129, 67, 'Produits', 34, 14, 12, NULL, 0, 476, 533.12, 'Support bouton '),
(130, 67, 'Produits', 1, 200, 12, NULL, 0, 200, 224, 'Alimentation Niko HC'),
(131, 67, 'Produits', 1, 242, 12, NULL, 0, 242, 271.04, 'Module intelligent HC'),
(132, 67, 'Produits', 1, 205, 12, NULL, 0, 205, 229.6, 'Module ip HC'),
(133, 67, 'Produits', 6, 225, 12, NULL, 0, 1350, 1512, 'Module six sortie '),
(134, 67, 'Produits', 2, 265, 12, NULL, 0, 530, 593.6, 'Module dimmer '),
(135, 67, 'Produits', 3, 220, 12, NULL, 0, 660, 739.2, 'Module volet'),
(136, 67, 'Produits', 1, 1000, 12, NULL, 0, 1000, 1120, 'Programmation'),
(137, 67, 'Produits', 2, 48, 12, NULL, 0, 96, 107.52, 'Lien rail din '),
(138, 67, 'Produits', 1, 125, 12, NULL, 0, 125, 140, 'Coffret d\'alimentation 25S60'),
(139, 67, 'Produits', 1, 745, 12, NULL, 0, 745, 834.4, 'Coffret de distribution apparent'),
(140, 67, 'Produits', 1, 100, 12, NULL, 0, 100, 112, 'Mise à la terre et équipotentiel'),
(141, 67, 'Produits', 1, 250, 12, NULL, 0, 250, 280, 'Réception par un organisme agréer + plan'),
(142, 68, 'Produits', 1, 100000, 12, 10, 0, 90000, 100800, 'une tesla dernier modèle S'),
(143, 70, 'Produits', 53, 30, 21, NULL, 0, 1590, 1923.9, 'Interrupteur simple 2d ou inverseur'),
(144, 70, 'Produits', 108, 20, 21, NULL, 0, 2160, 2613.6, 'Point lumineux '),
(145, 70, 'Produits', 6, 60, 21, NULL, 0, 360, 435.6, 'Led niko balise'),
(146, 70, 'Produits', 1, 275, 21, NULL, 0, 275, 332.75, 'Détecteur de mouvement Niko'),
(147, 70, 'Produits', 4, 95, 21, NULL, 0, 380, 459.8, 'Prise quadruple'),
(148, 70, 'Produits', 14, 38, 21, NULL, 0, 532, 643.72, 'Prise Simple'),
(149, 70, 'Produits', 26, 57, 21, NULL, 0, 1482, 1793.22, 'Prise Double'),
(150, 70, 'Produits', 2, 76, 21, NULL, 0, 152, 183.92, 'Prise Triple'),
(151, 70, 'Produits', 1, 40, 21, NULL, 0, 40, 48.4, 'Prise machine à laver'),
(152, 70, 'Produits', 1, 40, 21, NULL, 0, 40, 48.4, 'Prise séchoir'),
(153, 70, 'Produits', 1, 40, 21, NULL, 0, 40, 48.4, 'Prise lave vaisselle'),
(154, 70, 'Produits', 3, 40, 21, NULL, 0, 120, 145.2, 'Prise four'),
(155, 70, 'Produits', 1, 120, 21, NULL, 0, 120, 145.2, 'Alimentation taques de cuisson'),
(156, 70, 'Produits', 2, 70, 21, NULL, 0, 140, 169.4, 'Prise TV'),
(157, 70, 'Produits', 9, 70, 21, NULL, 0, 630, 762.3, 'Prise RJ 45'),
(158, 70, 'Produits', 1, 815, 21, NULL, 0, 815, 986.15, 'Parlophone kit ticino simple 238 363 411'),
(159, 70, 'Produits', 10, 40, 21, NULL, 0, 400, 484, 'Tubage alarme'),
(160, 70, 'Produits', 24, 64, 21, NULL, 0, 1536, 1858.56, 'Module deux boutons 101'),
(161, 70, 'Produits', 4, 76, 21, NULL, 0, 304, 367.84, 'Module quatre boutons 101'),
(162, 70, 'Produits', 1, 88, 21, NULL, 0, 88, 106.48, 'Module six boutons 101'),
(163, 70, 'Produits', 34, 14, 21, NULL, 0, 476, 575.96, 'Support bouton '),
(164, 70, 'Produits', 1, 200, 21, NULL, 0, 200, 242, 'Alimentation Niko HC'),
(165, 70, 'Produits', 1, 242, 21, NULL, 0, 242, 292.82, 'Module intelligent HC'),
(166, 70, 'Produits', 1, 205, 21, NULL, 0, 205, 248.05, 'Module ip HC'),
(167, 70, 'Produits', 6, 225, 21, NULL, 0, 1350, 1633.5, 'Module six sortie '),
(168, 70, 'Produits', 2, 265, 21, NULL, 0, 530, 641.3, 'Module dimmer '),
(169, 70, 'Produits', 3, 220, 21, NULL, 0, 660, 798.6, 'Module volet'),
(170, 70, 'Produits', 1, 1000, 21, NULL, 0, 1000, 1210, 'Programmation'),
(171, 70, 'Produits', 2, 48, 21, NULL, 0, 96, 116.16, 'Lien rail din '),
(172, 70, 'Produits', 1, 125, 21, NULL, 0, 125, 151.25, 'Coffret d\'alimentation 25S60'),
(173, 70, 'Produits', 1, 745, 21, NULL, 0, 745, 901.45, 'Coffret de distribution apparent'),
(174, 70, 'Produits', 1, 100, 21, NULL, 0, 100, 121, 'Mise à la terre et équipotentiel'),
(175, 70, 'Produits', 1, 250, 21, NULL, 0, 250, 302.5, 'Réception par un organisme agréer + plan'),
(176, 71, 'Produits', 1, 1000, 12, NULL, 0, 1000, 1120, 'batmobile'),
(177, 73, 'Produits', 1, 100000, 12, 10, 0, 90000, 100800, 'une tesla dernier modèle S'),
(178, 74, 'Produits', 2, 500, 12, 10, 0, 900, 1008, 'RTX 3080'),
(179, 74, 'Produits', 2, 300, 12, 10, 0, 540, 604.8, 'RTX 3070');

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

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `mail`, `nom`, `prenom`, `fonction`, `langue`, `note`, `compagnie_id`, `is_deleted`, `ts_created`) VALUES
(5, 'collot.hugo@gmail.com', 'Collot', 'Hugo', NULL, 'Français', NULL, 19, 0, NULL),
(7, 'hugo.collot@gmail.com', 'Pompidou', 'George', NULL, 'Français', NULL, 19, 0, NULL),
(8, 'batman@gmail.com', 'Wayne', 'Bruce', 'Batman', 'Français', NULL, 29, 0, NULL),
(9, 'super.homefull@gmail.com', 'Chuug', 'Super', 'Homefull', 'Français', 'A la rue', 29, 0, NULL),
(10, NULL, 'Griffin', 'Peter', NULL, 'Français', NULL, NULL, 0, NULL),
(11, 'supermail@mail.com', 'Prénom1', 'Nom1', 'Fonction1', 'Français', NULL, 19, 0, NULL),
(12, NULL, 'Monica', 'Serez', NULL, 'Français', NULL, NULL, 0, 1571244239);

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

--
-- Déchargement des données de la table `compagnies`
--

INSERT INTO `compagnies` (`id`, `nom_societe`, `tva`, `siren`, `code`, `langue`, `is_deleted`, `ts_created`) VALUES
(19, 'DC', '123321', '258741', '321654', 'Français', 0, NULL),
(23, 'Microsoft', NULL, NULL, NULL, 'Français', 0, NULL),
(25, 'Carrefour', NULL, NULL, NULL, 'Français', 0, NULL),
(26, 'SpaceX', NULL, NULL, NULL, 'Français', 0, NULL),
(27, 'BigSoc', '123', '123', '123', 'Français', 0, NULL),
(28, 'HelloTeam', NULL, NULL, NULL, 'Français', 1, NULL),
(29, 'HelloTeam', NULL, NULL, NULL, 'Français', 0, NULL);

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

--
-- Déchargement des données de la table `coordonnees`
--

INSERT INTO `coordonnees` (`id`, `adresse`, `cpl_adresse`, `code_postal`, `ville`, `pays`, `website`, `telephone`, `client_id`, `compagnie_id`) VALUES
(15, 'Rue de Balart 53', NULL, 5000, 'Namur', 'Belgique', 'www.chuug.be', '0494607670', NULL, 19),
(19, NULL, '', 1000, 'Bruxelles', 'Belgique', NULL, '081020103', NULL, 23),
(26, 'Rue de Balart 53/5', NULL, 5000, 'Namur', 'Belgique', 'www.chuug.net', '0494607670', 5, NULL),
(27, NULL, NULL, NULL, NULL, 'Belgique', NULL, NULL, 6, NULL),
(28, NULL, NULL, NULL, 'Namur', 'Belgique', NULL, NULL, 7, NULL),
(29, NULL, NULL, NULL, NULL, 'Belgique', NULL, NULL, NULL, 25),
(30, 'Rue des rues chauve-souris 69', NULL, 13377, 'Gotham', 'Belgique', 'www.batman.swag', '0494606060', 8, NULL),
(31, 'Rue des homeless 0', NULL, 5000, 'Namur', 'Belgique', 'www.homefull.be', '0494647824', 9, NULL),
(32, NULL, NULL, NULL, NULL, 'Belgique', NULL, NULL, NULL, 26),
(33, NULL, NULL, NULL, NULL, 'Belgique', NULL, NULL, 10, NULL),
(34, NULL, NULL, NULL, NULL, 'Belgique', NULL, '0494111111', 11, NULL),
(35, 'Rue de la Soc 123', NULL, 5123, 'Kappa', 'Belgique', NULL, NULL, NULL, 27),
(36, NULL, NULL, NULL, NULL, 'Belgique', NULL, NULL, NULL, 28),
(37, NULL, NULL, NULL, NULL, 'Belgique', NULL, NULL, NULL, 29),
(38, NULL, NULL, NULL, NULL, 'Belgique', NULL, NULL, 12, NULL),
(42, NULL, NULL, NULL, NULL, 'Belgique', NULL, NULL, 16, NULL);

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
(18, 'payCondition', NULL, '45 jours fin de mois', 1),
(22, 'payType', NULL, 'Carte bancaire', 1),
(25, 'payInterest', NULL, '2% par mois', 0),
(26, 'payInterest', NULL, '1% par mois', 0),
(28, 'applyTva', 'Tva applicable', NULL, 0),
(29, 'tva', NULL, '6', 0),
(30, 'tva', NULL, '12', 1),
(31, 'tva', NULL, '21', 0),
(32, 'applyTvaText', NULL, 'TVA non applicable', 1),
(33, 'articleType', NULL, 'Produits', 1),
(34, 'articleType', NULL, 'Service', 0),
(35, 'devisCounter', 'Compteur devis', '14', 0),
(36, 'facturesCounter', 'Compteur factures', '10', 0),
(37, 'avoirsCounter', 'Compteur avoirs', '2', 0),
(38, 'acomptesCounter', 'Compteur acomptes', '33', 0),
(39, 'linkId', NULL, '7', 0),
(40, 'formatNumerotation', NULL, 'label.aa.n', 0),
(41, 'tailleCompteur', NULL, '5', 0),
(42, 'devisLabel', NULL, 'D', 0),
(43, 'facturesLabel', NULL, 'F', 0),
(44, 'avoirsLabel', NULL, 'A', 0),
(45, 'acomptesLabel', NULL, 'FA', 0),
(46, 'devisTextIntroduction', NULL, 'Texte d\'introduction de devis', 0),
(47, 'devisTextConclusion', NULL, 'Texte de conclusion de devis', 0),
(48, 'devisTextFooter', NULL, 'Pied de page de devis', 0),
(49, 'devisTextConditions', NULL, 'Conditions devis', 0),
(50, 'facturesTextIntroduction', NULL, 'Intro facture', 0),
(51, 'facturesTextConclusion', NULL, 'Conclusion de facture', 0),
(52, 'facturesTextFooter', NULL, 'pied facture', 0),
(53, 'avoirsTextIntroduction', NULL, 'intro avoirs', 0),
(54, 'avoirsTextConclusion', NULL, 'conclu avoir', 0),
(55, 'avoirsTextFooter', NULL, 'pied avoir', 0),
(56, 'acomptesTextIntroduction', NULL, 'acomptes intro', 0),
(57, 'acomptesTextConclusion', NULL, 'acomptes conclu', 0),
(58, 'acomptesTextFooter', NULL, 'pied acomptes', 0),
(59, 'userMail', NULL, 'a@a.a', 0),
(60, 'userPrenom', NULL, 'Huguette', 0),
(61, 'userNom', NULL, 'Collette', 0),
(62, 'userCompagny', NULL, 'Chuug Compagny', 0),
(63, 'userSiret', NULL, NULL, 0),
(64, 'userCode', NULL, NULL, 0),
(65, 'userTva', NULL, NULL, 0),
(66, 'userAdresse', NULL, 'Rue des A 32', 0),
(67, 'userPostal', NULL, '5050A', 0),
(68, 'userVille', NULL, 'Super A', 0),
(69, 'userPays', NULL, 'AAAAAAAAAAA', 0),
(70, 'userTelephone', NULL, NULL, 0),
(71, 'userWeb', NULL, NULL, 0),
(72, 'payInterest', 'default', 'Pas d\'intérêts', 1);

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

--
-- Déchargement des données de la table `ribs`
--

INSERT INTO `ribs` (`id`, `iban`, `bic`, `titulaire`, `libel`) VALUES
(1, 'BE00 0000 000 0000 0', 'GKCCBNEB', 'Hugo Collot', 'perso');

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
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `nom`, `prenom`, `password`, `install_config`) VALUES
(6, 'test@chuug.be', 'Collot', 'Hugo', '$2y$10$PIjWvR4O5cAKu7sl2EMmOOx4N2m2U4E.3Onb6Kk74TEvvBIoznYo.', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `compagnies`
--
ALTER TABLE `compagnies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `coordonnees`
--
ALTER TABLE `coordonnees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `ribs`
--
ALTER TABLE `ribs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 02 nov. 2019 à 23:39
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `miniblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `reporting` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`, `reporting`) VALUES
(10, 2, 'Machine', 'In eius perniciem conspiraret, solisque scholis iussit esse contentum palatinis et protectorum cum Scutariis et Gentilibus, et mandabat Domitiano, ex comite largitionum, praefecto ut cum in Syriam venerit, Gallum, quem crebro acciverat, ad Italiam properare blande hortaretur et verecunde.', '2019-10-18 12:44:10', NULL),
(6, 2, 'Sébastien', 'Wouaaa ce blog est minimaliste ! On dirait du brutalisme poussé à l\'extrême. Va falloir ajouter un peu de style...\r\n\r\nCordialement\r\n\r\nBisou', '2019-10-18 12:17:39', NULL),
(11, 2, 'Sébastien', 'qzrgseqhsb qtqe yes ets rt', '2019-10-18 14:13:26', NULL),
(14, 2, 'Machine', 'test', '2019-10-22 12:19:43', NULL),
(16, 2, 'Anonyme', 'qf<f', '2019-10-22 18:24:00', NULL),
(20, 2, 'Seb', '111', '2019-10-27 08:17:46', NULL),
(23, 2, 'Seb', 'test', '2019-10-27 12:52:16', NULL),
(26, 2, 'Bibi', '<p>Voici un commentaire <strong>fantastique</strong> !</p>', '2019-10-30 07:41:37', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscription_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `pseudo`, `pass`, `email`, `subscription_date`) VALUES
(1, 'sebast.senechal', '$2y$10$TjtqPutXN8xwzO5sJyH9de0m6jvIjg11ziaWUUNIFeU4E/hJqQHW.', 'sebast.senechal@gmail.com', '2019-10-27'),
(3, 'seb', '$2y$10$ds.UTsSQvaT902CA1EUc1eDNFQl/xD8HEnlra1es8pwGzN521FT22', 'test@gmail.com', '2019-10-27'),
(4, 'Machin', '$2y$10$FC6RwjsUK4Xdq3WZLaLrrelI/qLI5uaNl1daEU/eMOLNE8O1TU0r6', 'test2@gmail.com', '2019-10-28'),
(5, 'Untest', '$2y$10$4ADezUdrtgWykHJg4g7Va.rjORSs5uQhodFgdPBQEViqCz2cfPEt2', 'test3@gmail.com', '2019-11-01'),
(6, 'test4', '$2y$10$ATz3jfqZGwkdL4C1JKTFCe1TCUrjc5BK4w6gdn6VG64z.p8Sg5Bf6', 'test4@gmail.com', '2019-11-01');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `author` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `creation_date`, `author`) VALUES
(2, 'La tour de Babylone', '<p><strong>En se r&eacute;veillant un matin apr&egrave;s des r&ecirc;ves agit&eacute;s, Gregor Samsa se retrouva, dans son lit, m&eacute;tamorphos&eacute; en un monstrueux insecte.</strong></p>\r\n<p>Il &eacute;tait sur le dos, un dos aussi dur qu&rsquo;une carapace, et, en relevant un peu la t&ecirc;te, il vit, bomb&eacute;, brun, cloisonn&eacute; par des arceaux plus rigides, son abdomen sur le haut duquel la couverture, pr&ecirc;te &agrave; glisser tout &agrave; fait, ne tenait plus qu&rsquo;&agrave; peine. Ses nombreuses pattes, lamentablement gr&ecirc;les par comparaison avec la corpulence qu&rsquo;il avait par ailleurs, grouillaient d&eacute;sesp&eacute;r&eacute;ment sous ses yeux.</p>\r\n<p>&laquo; <em>Qu&rsquo;est-ce qui m&rsquo;est arriv&eacute; ?</em> &raquo; pensa-t-il. Ce n&rsquo;&eacute;tait pas un r&ecirc;ve. Sa chambre, une vraie chambre humaine, juste un peu trop petite, &eacute;tait l&agrave; tranquille entre les quatre murs qu&rsquo;il connaissait bien. Au-dessus de la table o&ugrave; &eacute;tait d&eacute;ball&eacute;e une collection d&rsquo;&eacute;chantillons de tissus - Samsa &eacute;tait repr&eacute;sentant de commerce - on voyait accroch&eacute;e l&rsquo;image qu&rsquo;il avait r&eacute;cemment d&eacute;coup&eacute;e dans un magazine</p>', '2019-10-31 17:08:01', 'sebast.senechal'),
(5, 'Un article de test', '<p>G&eacute;n&eacute;ralement, on utilise un texte en faux latin (le texte ne veut rien dire, il a &eacute;t&eacute; modifi&eacute;), le <strong>Lorem ipsum</strong> ou <strong>Lipsum</strong>, qui permet donc de faire office de texte d\'attente. L\'avantage de le mettre en latin est que l\'op&eacute;rateur sait au premier coup d\'oeil que la page contenant ces lignes n\'est pas valide, et surtout l\'attention du client n\'est pas d&eacute;rang&eacute;e par le contenu, il demeure concentr&eacute; seulement sur l\'aspect graphique.</p>\r\n<p>Ce texte a pour autre avantage d\'utiliser des mots de longueur variable, essayant de simuler une occupation normale. La m&eacute;thode simpliste consistant &agrave; copier-coller un court texte plusieurs fois (&laquo; ceci est un faux-texte ceci est un faux-texte ceci est un faux-texte ceci est un faux-texte ceci est un faux-texte &raquo;) a l\'inconv&eacute;nient de ne pas permettre une juste appr&eacute;ciation typographique du r&eacute;sultat final.</p>\r\n<p>Il circule des centaines de versions diff&eacute;rentes du Lorem ipsum, mais ce texte aurait originellement &eacute;t&eacute; tir&eacute; de l\'ouvrage de Cic&eacute;ron, De Finibus Bonorum et Malorum (Liber Primus, 32), texte populaire &agrave; cette &eacute;poque, dont l\'une des premi&egrave;res phrases est : &laquo; Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit... &raquo; (&laquo; Il n\'existe personne qui aime la souffrance pour elle-m&ecirc;me, ni qui la recherche ni qui la veuille pour ce qu\'elle est... &raquo;).</p>', '2019-10-31 10:11:43', 'sebast.senechal');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

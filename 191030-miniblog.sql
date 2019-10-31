-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 30 oct. 2019 à 06:52
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`) VALUES
(10, 2, 'Machine', 'In eius perniciem conspiraret, solisque scholis iussit esse contentum palatinis et protectorum cum Scutariis et Gentilibus, et mandabat Domitiano, ex comite largitionum, praefecto ut cum in Syriam venerit, Gallum, quem crebro acciverat, ad Italiam properare blande hortaretur et verecunde.', '2019-10-18 12:44:10'),
(6, 2, 'Sébastien', 'Wouaaa ce blog est minimaliste ! On dirait du brutalisme poussé à l\'extrême. Va falloir ajouter un peu de style...\r\n\r\nCordialement\r\n\r\nBisou', '2019-10-18 12:17:39'),
(7, 1, 'Anonyme', 'Quanta autem vis amicitiae sit, ex hoc intellegi maxime potest, quod ex infinita societate generis humani, quam conciliavit ipsa natura, ita contracta res est et adducta in angustum ut omnis caritas aut inter duos aut inter paucos iungeretur.', '2019-10-18 12:18:36'),
(8, 1, 'Spameur du 77', 'Quanta autem vis amicitiae sit, ex hoc intellegi maxime potest, quod ex infinita societate generis humani, quam conciliavit ipsa natura, ita contracta res est et adducta in angustum ut omnis caritas aut inter duos aut inter paucos iungeretur.\r\n\r\nQuanta autem vis amicitiae sit, ex hoc intellegi maxime potest, quod ex infinita societate generis humani, quam conciliavit ipsa natura, ita contracta res est et adducta in angustum ut omnis caritas aut inter duos aut inter paucos iungeretur.', '2019-10-18 12:18:56'),
(9, 2, 'Visiteur de passage', 'Cognitis enim pilatorum caesorumque funeribus nemo deinde ad has stationes appulit navem, sed ut Scironis praerupta letalia declinantes litoribus Cypriis contigui navigabant, quae Isauriae scopulis sunt controversa.\r\n\r\nMetuentes igitur idem latrones Lycaoniam magna parte campestrem cum se inpares nostris fore congressione stataria documentis frequentibus scirent, tramitibus deviis petivere Pamphyliam diu quidem intactam sed timore populationum et caedium, milite per omnia diffuso propinqua, magnis undique praesidiis conmunitam.', '2019-10-18 12:19:36'),
(11, 2, 'Sébastien', 'qzrgseqhsb qtqe yes ets rt', '2019-10-18 14:13:26'),
(12, 1, 'Sébastien', '+1', '2019-10-18 15:46:29'),
(13, 1, 'Machine', 'sqgseyh', '2019-10-18 16:32:56'),
(14, 2, 'Machine', 'test', '2019-10-22 12:19:43'),
(15, 2, 'Anonyme', '+1', '2019-10-22 15:22:45'),
(16, 2, 'Anonyme', 'qf<f', '2019-10-22 18:24:00'),
(17, 1, 'Sébastien', 'sqgdb', '2019-10-23 17:36:17'),
(18, 2, 'Seb', 'Test', '2019-10-25 11:05:18'),
(19, 1, 'Seb', '+1', '2019-10-25 14:00:31'),
(20, 2, 'Seb', '111', '2019-10-27 08:17:46'),
(21, 2, 'Seb', 'rtsfvs', '2019-10-27 10:24:11'),
(22, 1, 'Visiteur', 'Lorem ipsum', '2019-10-27 12:41:47'),
(23, 2, 'Seb', 'test', '2019-10-27 12:52:16'),
(24, 1, 'Seb', 'Test', '2019-10-28 11:05:39'),
(25, 2, 'Machin', 'Test', '2019-10-28 12:22:22'),
(26, 2, 'Bibi', '<p>Voici un commentaire <strong>fantastique</strong> !</p>', '2019-10-30 07:41:37');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `pseudo`, `pass`, `email`, `subscription_date`) VALUES
(1, 'sebast.senechal', '$2y$10$TjtqPutXN8xwzO5sJyH9de0m6jvIjg11ziaWUUNIFeU4E/hJqQHW.', 'sebast.senechal@gmail.com', '2019-10-27'),
(3, 'seb', '$2y$10$ds.UTsSQvaT902CA1EUc1eDNFQl/xD8HEnlra1es8pwGzN521FT22', 'test@gmail.com', '2019-10-27'),
(4, 'Machin', '$2y$10$FC6RwjsUK4Xdq3WZLaLrrelI/qLI5uaNl1daEU/eMOLNE8O1TU0r6', 'test2@gmail.com', '2019-10-28');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `modif_date` date DEFAULT NULL,
  `author` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `id_post`, `title`, `content`, `creation_date`, `modif_date`, `author`) VALUES
(1, 1, 'Premier contact', 'Denique Antiochensis ordinis vertices sub uno elogio iussit occidi ideo efferatus, quod ei celebrari vilitatem intempestivam urgenti, cum inpenderet inopia, gravius rationabili responderunt; et perissent ad unum ni comes orientis tunc Honoratus fixa constantia restitisset.\r\n\r\nHomines enim eruditos et sobrios ut infaustos et inutiles vitant, eo quoque accedente quod et nomenclatores adsueti haec et talia venditare, mercede accepta lucris quosdam et prandiis inserunt subditicios ignobiles et obscuros.\r\n\r\nNisi mihi Phaedrum, inquam, tu mentitum aut Zenonem putas, quorum utrumque audivi, cum mihi nihil sane praeter sedulitatem probarent, omnes mihi Epicuri sententiae satis notae sunt. atque eos, quos nominavi, cum Attico nostro frequenter audivi, cum miraretur ille quidem utrumque, Phaedrum autem etiam amaret, cotidieque inter nos ea, quae audiebamus, conferebamus, neque erat umquam controversia, quid ego intellegerem, sed quid probarem.', '2010-03-25 16:28:41', NULL, ''),
(2, 2, 'La tour de Babylone', 'En se réveillant un matin après des rêves agités, Gregor Samsa se retrouva, dans son lit, métamorphosé en un monstrueux insecte.\r\n\r\nIl était sur le dos, un dos aussi dur qu’une carapace, et, en relevant un peu la tête, il vit, bombé, brun, cloisonné par des arceaux plus rigides, son abdomen sur le haut duquel la couverture, prête à glisser tout à fait, ne tenait plus qu’à peine. Ses nombreuses pattes, lamentablement grêles par comparaison avec la corpulence qu’il avait par ailleurs, grouillaient désespérément sous ses yeux.\r\n\r\n« Qu’est-ce qui m’est arrivé ? » pensa-t-il. Ce n’était pas un rêve. Sa chambre, une vraie chambre humaine, juste un peu trop petite, était là tranquille entre les quatre murs qu’il connaissait bien. Au-dessus de la table où était déballée une collection d’échantillons de tissus - Samsa était représentant de commerce - on voyait accrochée l’image qu’il avait récemment découpée dans un magazine ', '2019-10-28 11:02:17', NULL, 'sebast.senechal');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

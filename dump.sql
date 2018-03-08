-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 20 Juillet 2017 à 12:22
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `clubcritique`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id` int(11) NOT NULL,
  `id_membre1` int(11) NOT NULL,
  `id_membre2` int(11) NOT NULL,
  `accepter` tinyint(1) NOT NULL,
  `vu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `amis`
--

INSERT INTO `amis` (`id`, `id_membre1`, `id_membre2`, `accepter`, `vu`) VALUES
(1, 5, 8, 1, 1),
(5, 5, 10, 0, 0),
(7, 8, 16, 0, 0),
(10, 10, 8, 0, 1),
(11, 8, 15, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `resume` varchar(250) NOT NULL,
  `urlVendeur` int(250) NOT NULL,
  `statut` enum('à prêter','prêté','je le veux','je ne le veux plus','je ne veux pas le prêter') NOT NULL,
  `laune` tinyint(1) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `attribute`
--

CREATE TABLE `attribute` (
  `id` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `obligatory` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `attribute`
--

INSERT INTO `attribute` (`id`, `id_categorie`, `name`, `type`, `obligatory`) VALUES
(1, 1, 'titre', 1, 0),
(2, 1, 'description', 1, 0),
(3, 1, 'image', 5, 0),
(4, 1, 'front', 3, 0),
(5, 2, 'titre', 1, 0),
(6, 2, 'description', 1, 0),
(7, 2, 'image', 5, 0),
(8, 2, 'front', 3, 0),
(9, 3, 'titre', 1, 0),
(10, 3, 'description', 1, 0),
(11, 3, 'image', 5, 0),
(12, 3, 'front', 3, 0),
(13, 4, 'titre', 1, 0),
(14, 4, 'description', 1, 0),
(15, 4, 'image', 5, 0),
(16, 4, 'front', 3, 0),
(17, 5, 'titre', 1, 0),
(18, 5, 'description', 1, 0),
(19, 5, 'image', 5, 0),
(20, 5, 'front', 3, 0),
(21, 6, 'titre', 1, 0),
(22, 6, 'description', 1, 0),
(23, 6, 'image', 5, 0),
(24, 6, 'front', 3, 0),
(25, 7, 'titre', 1, 0),
(26, 7, 'description', 1, 0),
(27, 7, 'image', 5, 0),
(28, 7, 'front', 3, 0),
(29, 8, 'titre', 1, 0),
(30, 8, 'description', 1, 0),
(31, 8, 'image', 5, 0),
(32, 8, 'front', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `attribute_option`
--

CREATE TABLE `attribute_option` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `attribute_option`
--

INSERT INTO `attribute_option` (`id`, `attribute_id`, `value`) VALUES
(1, 3, 'aze'),
(2, 3, 'qsd'),
(3, 5, 'AZERTYUI'),
(4, 5, 'AZSDX'),
(5, 5, 'GDF'),
(6, 5, 'NFGN'),
(7, 6, '2');

-- --------------------------------------------------------

--
-- Structure de la table `bon_mauvais_membre`
--

CREATE TABLE `bon_mauvais_membre` (
  `id` int(11) NOT NULL,
  `id_membre_recoit` int(11) NOT NULL,
  `id_membre_donne` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `bon_mauvais_membre`
--

INSERT INTO `bon_mauvais_membre` (`id`, `id_membre_recoit`, `id_membre_donne`, `note`) VALUES
(2, 2, 1, 1),
(3, 2, 3, 21),
(5, 3, 1, 1),
(7, 5, 1, 1),
(8, 8, 5, 1),
(9, 10, 5, -1);

-- --------------------------------------------------------

--
-- Structure de la table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `id_loan` int(11) DEFAULT NULL,
  `id_product` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `borrow`
--

INSERT INTO `borrow` (`id`, `id_owner`, `id_loan`, `id_product`, `status`) VALUES
(12, 8, 8, 3, 2),
(13, 8, 8, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `titre`) VALUES
(1, 'book'),
(2, 'movies'),
(3, 'cds'),
(4, 'cinema'),
(5, 'télévision'),
(6, 'jeu'),
(7, 'sport'),
(8, 'roman');

-- --------------------------------------------------------

--
-- Structure de la table `chatsalon`
--

CREATE TABLE `chatsalon` (
  `id` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `msg` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `chatsalon`
--

INSERT INTO `chatsalon` (`id`, `id_salon`, `id_membre`, `msg`, `date`) VALUES
(1, 26, 8, 'test', '2017-06-28 17:51:21'),
(2, 26, 8, 'ca va?', '2017-06-28 17:51:49'),
(3, 26, 8, 'ok', '2017-06-28 17:52:08'),
(4, 26, 8, 'saeggg', '2017-06-29 06:09:50'),
(5, 26, 8, 'sanae', '2017-06-29 08:21:40'),
(6, 26, 8, 'test', '2017-06-29 08:21:47'),
(7, 26, 8, 'test', '2017-06-29 08:21:50'),
(8, 26, 8, 'sanae', '2017-06-30 14:34:30'),
(9, 26, 8, '', '2017-06-30 14:34:37'),
(10, 26, 8, '', '2017-06-30 14:34:42');

-- --------------------------------------------------------

--
-- Structure de la table `concept`
--

CREATE TABLE `concept` (
  `id` int(11) NOT NULL,
  `concept` varchar(2000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `concept`
--

INSERT INTO `concept` (`id`, `concept`) VALUES
(1, 'Contrairement à une opinion répandue, le Lorem Ipsum n\'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s\'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d\'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l\'éthique. Les premières lignes du Lorem Ipsum, "Lorem ipsum dolor sit amet...", proviennent de la section ');

-- --------------------------------------------------------

--
-- Structure de la table `destinataire`
--

CREATE TABLE `destinataire` (
  `id` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `idMessagerie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `entity`
--

CREATE TABLE `entity` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entity`
--

INSERT INTO `entity` (`id`, `code`, `categorie_id`) VALUES
(1, 'Movie', 2),
(2, 'test', 1),
(3, 'Test ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `dateEnvoi` date NOT NULL,
  `idAmis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `mail` varchar(100) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `picture` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `mail`, `description`, `mdp`, `statut`, `picture`) VALUES
(5, 'willson', 'sarah', 'sanaebelahj@gmail.com', 'Je suis un jeune homme de vingt-quatre ans, je mesure un mettre soixante-dix-neuf et je ne suis ni gros ni maigre.\r\nJ\'ai le visage rectangulaire, le nez arqué, le front droit et les joues saillantes avec de grandes oreilles et un menton saillant. \r\nJ\'ai le teint mat, la peau blanche et grasse, les cheveux bruns foncés et la mine fraîche avec des lèvres charnues et des dents blanches.\r\nLe regard vive, le sourire mignon avec des yeux bridés, paupières tombantes, sourcils épais et cils fins.', 'RTAReJB91VW/c', 1, '1-coupe-de-cheveux-femme-avec-cheveux-rouges-et-yeux-vert-quelle-coupe-de-cheveux-femme.jpg'),
(8, 'belhaj', 'sanae', 'sanai-son112@hotmail.fr', 'Write a brief intro about yourself. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec.', 'RTFYj2mJ3qt0k', 1, 'beautiful-girl-beauty-fraicheur-girl-Favim.com-3620107.jpg'),
(10, 'belhaj', 'rara', 'test@test.com', NULL, NULL, NULL, NULL),
(15, 'Utilisateur', 'Utilisateur', 'sanae@club.com', NULL, 'RTJ0f4sovBGS.', 1, NULL),
(16, 'test', NULL, 'test', NULL, NULL, 1, NULL),
(17, 'Plet', NULL, 'pplet14140@gmail.com', NULL, NULL, NULL, NULL),
(18, 'sanae', NULL, 'sanae.b@outlook.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id` int(11) NOT NULL,
  `objet` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_sender` int(11) NOT NULL,
  `id_recever` int(11) NOT NULL,
  `vu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `objet`, `message`, `date`, `id_sender`, `id_recever`, `vu`) VALUES
(4, 'bonjour', 'gkgkjkj', '2017-05-26 21:02:56', 5, 8, 1),
(5, 'Excuse...', 'gkgkjkj', '2017-05-26 21:03:35', 5, 8, 1),
(6, 'hghjdghj', 'sqdhkhkd', '2017-05-26 21:09:13', 5, 8, 1),
(7, 'hghjdghj', 'sqdhkhkd', '2017-05-26 23:18:59', 5, 8, 1),
(8, 'xw<wx', 'xwwx', '2017-05-26 23:18:18', 8, 5, 0),
(10, 'wxwxw', 'cdssqs', '2017-05-26 21:28:39', 5, 8, 1),
(11, 'wxwxw', 'cdssqs', '2017-05-26 21:29:19', 5, 8, 0),
(12, 'test', 'cdssqs', '2017-05-26 21:31:07', 11, 8, 1),
(13, 'xxww', 'wssdd', '2017-05-26 21:33:54', 5, 8, 1),
(14, 'xwxwx', 'xxbjcbbjhhdbs', '2017-05-26 21:38:51', 5, 8, 0),
(15, 'hhhhh', 'bbnbn', '2017-06-04 23:10:28', 5, 5, 0),
(16, 'hvhvnh', 'gsjgdjhskjddsqhkj', '2017-06-09 14:51:44', 10, 5, 0),
(17, 'test test', 'vgshsgjdqgsqjq sqdjgsh', '2017-06-09 15:00:24', 10, 5, 0),
(18, 'tets', 'test', '2017-06-09 15:05:48', 11, 5, 0),
(19, 'test', 'test', '2017-06-19 22:26:19', 5, 5, 0),
(20, 'Bonjour', 'Adolescebat autem obstinatum propositum erga haec et similia multa scrutanda, stimulos admovente regina, quae abrupte mariti fortunas trudebat in exitium praeceps, cum eum potius lenitate feminea ad veritatis humanitatisque viam reducere utilia suadendo deberet, ut in Gordianorum actibus factitasse Maximini truculenti illius imperatoris rettulimus coniugem.\r\n\r\nHaec subinde Constantius audiens et quaedam referente Thalassio doctus, quem eum odisse iam conpererat lege communi, scribens ad Caesarem blandius adiumenta paulatim illi subtraxit, sollicitari se simulans ne, uti est militare otium fere tumultuosum, in eius perniciem conspiraret, solisque scholis iussit esse contentum palatinis et protectorum cum Scutariis et Gentilibus, et mandabat Domitiano, ex comite largitionum, praefecto ut cum in Syriam venerit, Gallum, quem crebro acciverat, ad Italiam properare blande hortaretur et verecunde.', '2017-06-29 08:14:12', 8, 11, 0),
(21, 'Bonjour', 'Adolescebat autem obstinatum propositum erga haec et similia multa scrutanda, stimulos admovente regina, quae abrupte mariti fortunas trudebat in exitium praeceps, cum eum potius lenitate feminea ad veritatis humanitatisque viam reducere utilia suadendo deberet, ut in Gordianorum actibus factitasse Maximini truculenti illius imperatoris rettulimus coniugem.\r\n\r\nHaec subinde Constantius audiens et quaedam referente Thalassio doctus, quem eum odisse iam conpererat lege communi, scribens ad Caesarem blandius adiumenta paulatim illi subtraxit, sollicitari se simulans ne, uti est militare otium fere tumultuosum, in eius perniciem conspiraret, solisque scholis iussit esse contentum palatinis et protectorum cum Scutariis et Gentilibus, et mandabat Domitiano, ex comite largitionum, praefecto ut cum in Syriam venerit, Gallum, quem crebro acciverat, ad Italiam properare blande hortaretur et verecunde.', '2017-06-29 08:14:22', 8, 11, 0),
(22, 'test objjs', 'hfsdhgdjsdq', '2017-06-29 08:53:07', 8, 5, 0),
(23, 'tatat', 'vgnvnxb', '2017-06-29 10:19:22', 8, 5, 0),
(24, 'test', 'test', '2017-07-01 14:59:48', 16, 8, 0),
(25, 'Test votre site', 'Je suis nouveau je veux tester ce site', '2017-07-15 18:35:42', 17, 8, 1),
(26, 'Message Administrative', 'vhgvggv', '2017-07-18 23:10:37', 8, 17, 0),
(27, 'Message Administrative 1', 'test test ', '2017-07-18 23:20:57', 8, 17, 0),
(28, 'tesGFFG 1', 'dfcgvhbjnk,l;', '2017-07-18 23:24:20', 8, 17, 0),
(29, 'Bonjour', 'Message externe vers admin', '2017-07-19 07:17:17', 18, 16, 0);

-- --------------------------------------------------------

--
-- Structure de la table `moderateur`
--

CREATE TABLE `moderateur` (
  `id` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `moderateur` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `moderateur`
--

INSERT INTO `moderateur` (`id`, `id_membre`, `moderateur`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id`, `note`, `id_article`, `id_membre`) VALUES
(1, 2, 1, 1),
(2, 2, 1, 8),
(3, 3, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `id` int(11) NOT NULL,
  `nb_max_salon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `parametres`
--

INSERT INTO `parametres` (`id`, `nb_max_salon`) VALUES
(1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `ban` int(1) NOT NULL DEFAULT '0',
  `id_membres_who_ban` varchar(250) DEFAULT NULL,
  `actif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `participant`
--

INSERT INTO `participant` (`id`, `id_salon`, `id_membre`, `ban`, `id_membres_who_ban`, `actif`) VALUES
(1, 2, 8, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `salon`
--

CREATE TABLE `salon` (
  `id` int(11) NOT NULL,
  `titre_salon` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `valide` tinyint(1) NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `salon`
--

INSERT INTO `salon` (`id`, `titre_salon`, `description`, `date_debut`, `date_fin`, `valide`, `id_article`) VALUES
(2, 'TEST salon', 'gsfhgfgs sdhfhgs sdhgfhgds', '2017-07-20', '2017-07-20', 1, 2),
(3, 'salon oniria', 'gsfhgfgs sdhfhgs sdhgfhgds', '2017-07-19', '2017-07-20', 1, 3),
(4, 'salon oniria', 'gsfhgfgs sdhfhgs sdhgfhgds', '2017-07-16', '2017-07-17', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `send_request_salon`
--

CREATE TABLE `send_request_salon` (
  `id` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `send_request_salon`
--

INSERT INTO `send_request_salon` (`id`, `id_membre`, `id_salon`, `date`) VALUES
(6, 1, 11, '2017-06-21 10:50:42'),
(7, 1, 12, '2017-06-25 12:54:50'),
(10, 1, 9, '2017-06-29 11:16:38'),
(12, 5, 2, '2017-07-19 04:57:52'),
(13, 8, 2, '2017-07-19 06:50:47');

-- --------------------------------------------------------

--
-- Structure de la table `staticpage`
--

CREATE TABLE `staticpage` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `staticpage`
--

INSERT INTO `staticpage` (`id`, `name`, `content`) VALUES
(1, 'CGU', 'fxgxq ,hb;:n;w'),
(5, 'dfghjk', 'xfghjkl'),
(6, 'dftgtyhujkl', 'dfghjk'),
(7, 'Condition générale', 'Ce site est un bon moyen pour les lovrer des livres et de ce qu\'est artistique....');

-- --------------------------------------------------------

--
-- Structure de la table `valuedate`
--

CREATE TABLE `valuedate` (
  `id` int(11) NOT NULL,
  `id_attribute` int(11) NOT NULL,
  `id_entity` int(11) NOT NULL,
  `value` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `valuedate`
--

INSERT INTO `valuedate` (`id`, `id_attribute`, `id_entity`, `value`) VALUES
(1, 6, 1, '2017-06-19 23:58:29');

-- --------------------------------------------------------

--
-- Structure de la table `valueinteger`
--

CREATE TABLE `valueinteger` (
  `id` int(11) NOT NULL,
  `id_attribute` int(11) NOT NULL,
  `id_entity` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `valueinteger`
--

INSERT INTO `valueinteger` (`id`, `id_attribute`, `id_entity`, `value`) VALUES
(1, 3, 1, 2),
(2, 5, 1, 4),
(3, 3, 2, 1),
(4, 5, 2, 3),
(5, 2, 2, 1),
(6, 4, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `valuestring`
--

CREATE TABLE `valuestring` (
  `id` int(11) NOT NULL,
  `id_attribute` int(11) NOT NULL,
  `id_entity` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `valuestring`
--

INSERT INTO `valuestring` (`id`, `id_attribute`, `id_entity`, `value`) VALUES
(1, 1, 1, 'testing');

-- --------------------------------------------------------

--
-- Structure de la table `valuetext`
--

CREATE TABLE `valuetext` (
  `id` int(11) NOT NULL,
  `id_attribute` int(11) NOT NULL,
  `id_entity` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `valuetext`
--

INSERT INTO `valuetext` (`id`, `id_attribute`, `id_entity`, `value`) VALUES
(1, 2, 2, 'Oniria '),
(2, 1, 2, 'Oniria'),
(3, 3, 2, '../images\\uploads\\inu.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `visitecategorie`
--

CREATE TABLE `visitecategorie` (
  `id` int(11) NOT NULL,
  `nb_visite` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `visitecategorie`
--

INSERT INTO `visitecategorie` (`id`, `nb_visite`, `id_categorie`) VALUES
(1, 1, 4),
(2, 6, 1),
(3, 8, 3),
(4, 4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE `visiteur` (
  `id` int(11) NOT NULL,
  `nb_visite` int(11) NOT NULL,
  `date_visite` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_membre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nb_visite`, `date_visite`, `id_membre`) VALUES
(1, 5, '2017-07-09 15:04:35', 8),
(2, 1, '2017-07-09 17:39:54', 8),
(3, 1, '2017-07-10 22:04:38', 8),
(4, 1, '2017-07-11 22:34:17', 8),
(5, 1, '2017-07-11 23:06:24', 8),
(6, 1, '2017-07-12 19:06:20', 8),
(7, 1, '2017-07-12 21:14:31', 8),
(8, 1, '2017-07-13 19:43:36', 5),
(9, 1, '2017-07-14 01:36:24', 8),
(10, 1, '2017-07-14 16:03:38', 8),
(11, 1, '2017-07-14 16:39:37', 8),
(12, 1, '2017-07-14 21:59:54', 5),
(13, 1, '2017-07-14 22:17:13', 8),
(14, 1, '2017-07-14 23:43:43', 8),
(15, 1, '2017-07-14 23:48:14', 8),
(16, 1, '2017-07-15 14:05:03', 8),
(17, 1, '2017-07-15 22:20:20', 8),
(18, 1, '2017-07-15 22:56:53', 8),
(19, 1, '2017-07-16 21:46:08', 8),
(20, 1, '2017-07-18 21:49:43', 8),
(21, 1, '2017-07-19 01:45:30', 8),
(22, 1, '2017-07-19 05:00:55', 8),
(23, 1, '2017-07-19 07:18:29', 8),
(24, 1, '2017-07-19 07:23:23', 8),
(25, 1, '2017-07-19 12:09:55', 8),
(26, 1, '2017-07-19 23:20:25', 8),
(27, 1, '2017-07-20 09:34:42', 8),
(28, 1, '2017-07-20 12:58:43', 8);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMembre1` (`id_membre1`,`id_membre2`),
  ADD KEY `idMembre2` (`id_membre2`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bon_mauvais_membre`
--
ALTER TABLE `bon_mauvais_membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chatsalon`
--
ALTER TABLE `chatsalon`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `concept`
--
ALTER TABLE `concept`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `destinataire`
--
ALTER TABLE `destinataire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMembre` (`idMembre`,`idMessagerie`),
  ADD KEY `idMessagerie` (`idMessagerie`);

--
-- Index pour la table `entity`
--
ALTER TABLE `entity`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAmis` (`idAmis`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMembre` (`id_sender`);

--
-- Index pour la table `moderateur`
--
ALTER TABLE `moderateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salon`
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `send_request_salon`
--
ALTER TABLE `send_request_salon`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `staticpage`
--
ALTER TABLE `staticpage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `valueinteger`
--
ALTER TABLE `valueinteger`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `valuetext`
--
ALTER TABLE `valuetext`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visitecategorie`
--
ALTER TABLE `visitecategorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_membre_2` (`id_membre`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `chatsalon`
--
ALTER TABLE `chatsalon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `concept`
--
ALTER TABLE `concept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `destinataire`
--
ALTER TABLE `destinataire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `entity`
--
ALTER TABLE `entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `moderateur`
--
ALTER TABLE `moderateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `parametres`
--
ALTER TABLE `parametres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `salon`
--
ALTER TABLE `salon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `send_request_salon`
--
ALTER TABLE `send_request_salon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `staticpage`
--
ALTER TABLE `staticpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `valueinteger`
--
ALTER TABLE `valueinteger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `valuetext`
--
ALTER TABLE `valuetext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `visitecategorie`
--
ALTER TABLE `visitecategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `visiteur`
--
ALTER TABLE `visiteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `amis_ibfk_1` FOREIGN KEY (`id_membre1`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `amis_ibfk_2` FOREIGN KEY (`id_membre2`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `destinataire`
--
ALTER TABLE `destinataire`
  ADD CONSTRAINT `destinataire_ibfk_1` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `destinataire_ibfk_2` FOREIGN KEY (`idMessagerie`) REFERENCES `messagerie` (`id`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`idAmis`) REFERENCES `amis` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

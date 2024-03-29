-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 29 mars 2024 à 16:03
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `livred'occaz`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `cover` blob NOT NULL,
  `titre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `auteur` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `editeur` varchar(100) CHARACTER SET utf8 NOT NULL,
  `categorie` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pages` varchar(100) CHARACTER SET utf8 NOT NULL,
  `isbn` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date` varchar(100) CHARACTER SET utf8 NOT NULL,
  `prix` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_annonce`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `cover`, `titre`, `auteur`, `description`, `editeur`, `categorie`, `pages`, `isbn`, `date`, `prix`, `id_user`) VALUES
(1, 0x687474703a2f2f626f6f6b732e676f6f676c652e636f6d2f626f6f6b732f636f6e74656e743f69643d56353736447741415142414a267072696e747365633d66726f6e74636f76657226696d673d31267a6f6f6d3d3126656467653d6375726c26736f757263653d6762735f617069, 'Tout arrive deux fois', 'Cécile Gabrié', 'Quand elles se rencontrent, Dona et Geneviève n’ont en commun que leurs bébés nés un même jour de novembre 1997 : d’un côté une jeune femme seule, pauvre, sexy en diable, qui vit au jour le jour, de l’autre une fascinante bourgeoise en quête d’étourdissements. Un pacte aux termes flous se noue : Geneviève propose à Dona de s’installer dans sa maison, au bord de l’Yonne, qui deviendra bientôt un lieu de fête, abritant une communauté joyeuse mais sans limites. Dans ce paradis toxique, leurs enfants, Simone et Matteo, vont grandir, s’aimer, se perdre. À Paris, les orphelins Saadi et Zorah savent, eux, comment avancer : accrochés l’un à l’autre. Nourris des rencontres qui élèvent, guident et poussent à l’espoir, forts des métiers qu’ils ont choisis en lignes de conduite, ils tracent leur route. Mais quand les destins s’emmêlent, les forts peuvent-ils vraiment aider les faibles ? Ou les faibles entraîneront-ils les forts vers l’abîme ? Cécile Gabrié est née à Paris en 1976. Elle est parolière de chansons et écrivain. Elle a publié Le Soir des fourmis (Viviane Hamy, 2003).', 'Éditions Anne Carrière', 'Fiction', '131', '2380821410', '2020-10-23', 12, 1),
(2, 0x687474703a2f2f626f6f6b732e676f6f676c652e636f6d2f626f6f6b732f636f6e74656e743f69643d7a54564f657741414341414a267072696e747365633d66726f6e74636f76657226696d673d31267a6f6f6d3d3126736f757263653d6762735f617069, 'Le pouvoir du moment présent', 'Eckhart Tolle, Annie J. Ollivier', 'Le pouvoir du moment présent est probablement l\'un des livres les plus importants de notre époque. Son enseignement simple et néanmoins profond a aidé des millions de gens à travers le monde à trouver la paix intérieure et à se sentir plus épanouis dans leur vie. Au coeur de cet enseignement se trouve la transformation de la conscience : en vivant dans l\'instant présent, nous transcendons notre ego et accédons à \" un état de grâce, de légèreté et de bien-être \". Ce livre a le pouvoir de métamorphoser votre vie par une expérience unique.', 'J\'Ai Lu', 'Self-actualization (Psychology)', '253', '9782290020203', '2010-08-28', 10, 1),
(6, 0x687474703a2f2f626f6f6b732e676f6f676c652e636f6d2f626f6f6b732f636f6e74656e743f69643d465f3953414141414d41414a267072696e747365633d66726f6e74636f76657226696d673d31267a6f6f6d3d3126736f757263653d6762735f617069, 'The Google Story', 'David A. Vise, Mark Malseed', 'An inside look at the billion-dollar enterprise reveals how the Internet icon grew from a concept to a social phenomenon with a bold mission: to organize all of the world\'s information and make it easily accessible.', 'Random House Digital, Inc.', 'Business & Economics', '352', '055380457X', '2005', 14, 1),
(7, 0x687474703a2f2f626f6f6b732e676f6f676c652e636f6d2f626f6f6b732f636f6e74656e743f69643d465f3953414141414d41414a267072696e747365633d66726f6e74636f76657226696d673d31267a6f6f6d3d3126736f757263653d6762735f617069, 'The Google Story', 'David A. Vise, Mark Malseed', 'An inside look at the billion-dollar enterprise reveals how the Internet icon grew from a concept to a social phenomenon with a bold mission: to organize all of the world\'s information and make it easily accessible.', 'Random House Digital, Inc.', 'Business & Economics', '352', '055380457X', '2005', 14, 1),
(8, 0x687474703a2f2f626f6f6b732e676f6f676c652e636f6d2f626f6f6b732f636f6e74656e743f69643d56353736447741415142414a267072696e747365633d66726f6e74636f76657226696d673d31267a6f6f6d3d3526656467653d6375726c26736f757263653d6762735f617069, 'Tout arrive deux fois', 'CÃ©cile GabriÃ©', 'Quand elles se rencontrent, Dona et GeneviÃ¨ve nâ€™ont en commun que leurs bÃ©bÃ©s nÃ©s un mÃªme jour de novembre 1997 : dâ€™un cÃ´tÃ© une jeune femme seule, pauvre, sexy en diable, qui vit au jour le jour, de lâ€™autre une fascinante bourgeoise en quÃªte dâ€™Ã©tourdissements. Un pacte aux termes flous se noue : GeneviÃ¨ve propose Ã  Dona de sâ€™installer dans sa maison, au bord de lâ€™Yonne, qui deviendra bientÃ´t un lieu de fÃªte, abritant une communautÃ© joyeuse mais sans limites. Dans ce paradis toxique, leurs enfants, Simone et Matteo, vont grandir, sâ€™aimer, se perdre. Ã€ Paris, les orphelins Saadi et Zorah savent, eux, comment avancer : accrochÃ©s lâ€™un Ã  lâ€™autre. Nourris des rencontres qui Ã©lÃ¨vent, guident et poussent Ã  lâ€™espoir, forts des mÃ©tiers quâ€™ils ont choisis en lignes de conduite, ils tracent leur route. Mais quand les destins sâ€™emmÃªlent, les forts peuvent-ils vraiment aider les faibles ? Ou les faibles entraÃ®neront-ils les forts vers lâ€™abÃ®me ? CÃ©cile GabriÃ© est nÃ©e Ã  Paris en 1976. Elle est paroliÃ¨re de chansons et Ã©crivain. Elle a publiÃ© Le Soir des fourmis (Viviane Hamy, 2003).', 'Ã‰ditions Anne CarriÃ¨re', 'Fiction', '131', '2380821410', '2020-10-23', 51, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`) VALUES
(1, 'test', 'test@hotmail.fr', '$2y$10$aFzpatAV4XtLFBvZtz2hg.O6kjxJggiNvRRGKuOjt15kHdKvvrAY6');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 21 Septembre 2014 à 14:44
-- Version du serveur :  5.5.34
-- Version de PHP :  5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `planning`
--

-- --------------------------------------------------------

--
-- Structure de la table `GROUPE`
--

CREATE TABLE `GROUPE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ANNEE` int(11) NOT NULL,
  `GROUPE` int(11) NOT NULL,
  `IDTREE` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Contenu de la table `GROUPE`
--

INSERT INTO `GROUPE` (`ID`, `ANNEE`, `GROUPE`, `IDTREE`) VALUES
(1, 1, 0, 0x383338352c383338362c383338372c383338382c383338392c383339302c383339312c383339322c383339332c38333934),
(2, 1, 1, 0x383338352c38333836),
(3, 1, 2, 0x383338372c38333838),
(4, 1, 3, 0x383338392c38333930),
(5, 1, 4, 0x383339312c38333932),
(6, 1, 5, 0x383339332c38333934),
(7, 2, 0, 0x383430302c383430312c383430322c383430332c383430342c383430352c3335382c333539),
(8, 2, 1, 0x383430302c38343031),
(9, 2, 2, 0x383430322c38343033),
(10, 2, 3, 0x383430342c38343035),
(11, 2, 4, 0x3335382c333539);

-- --------------------------------------------------------

--
-- Structure de la table `PLANNING`
--

CREATE TABLE `PLANNING` (
  `ID` int(11) NOT NULL,
  `NUMSEM` int(11) NOT NULL,
  `LASTSAVE` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`NUMSEM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `SEMAINE`
--

CREATE TABLE `SEMAINE` (
  `ID` int(11) NOT NULL,
  `TITRE` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `SEMAINE`
--

INSERT INTO `SEMAINE` (`ID`, `TITRE`) VALUES
(1, 0x30312073657074656d6272652032303134202d2030362073657074656d6272652032303134),
(2, 0x30382073657074656d6272652032303134202d2031332073657074656d6272652032303134),
(3, 0x31352073657074656d6272652032303134202d2032302073657074656d6272652032303134),
(4, 0x32322073657074656d6272652032303134202d2032372073657074656d6272652032303134),
(5, 0x32392073657074656d6272652032303134202d203034206f63746f6272652032303134),
(6, 0x3036206f63746f6272652032303134202d203131206f63746f6272652032303134),
(7, 0x3133206f63746f6272652032303134202d203138206f63746f6272652032303134),
(8, 0x3230206f63746f6272652032303134202d203235206f63746f6272652032303134),
(9, 0x3237206f63746f6272652032303134202d203031206e6f76656d6272652032303134),
(10, 0x3033206e6f76656d6272652032303134202d203038206e6f76656d6272652032303134),
(11, 0x3130206e6f76656d6272652032303134202d203135206e6f76656d6272652032303134),
(12, 0x3137206e6f76656d6272652032303134202d203232206e6f76656d6272652032303134),
(13, 0x3234206e6f76656d6272652032303134202d203239206e6f76656d6272652032303134),
(14, 0x30312064c383c2a963656d6272652032303134202d2030362064c383c2a963656d6272652032303134),
(15, 0x30382064c383c2a963656d6272652032303134202d2031332064c383c2a963656d6272652032303134),
(16, 0x31352064c383c2a963656d6272652032303134202d2032302064c383c2a963656d6272652032303134),
(17, 0x32322064c383c2a963656d6272652032303134202d2032372064c383c2a963656d6272652032303134),
(18, 0x32392064c383c2a963656d6272652032303134202d203033206a616e766965722032303135),
(19, 0x3035206a616e766965722032303135202d203130206a616e766965722032303135),
(20, 0x3132206a616e766965722032303135202d203137206a616e766965722032303135),
(21, 0x3139206a616e766965722032303135202d203234206a616e766965722032303135),
(22, 0x3236206a616e766965722032303135202d203331206a616e766965722032303135),
(23, 0x30322066c383c2a976726965722032303135202d2030372066c383c2a976726965722032303135),
(24, 0x30392066c383c2a976726965722032303135202d2031342066c383c2a976726965722032303135),
(25, 0x31362066c383c2a976726965722032303135202d2032312066c383c2a976726965722032303135),
(26, 0x32332066c383c2a976726965722032303135202d2032382066c383c2a976726965722032303135),
(27, 0x3032206d6172732032303135202d203037206d6172732032303135),
(28, 0x3039206d6172732032303135202d203134206d6172732032303135),
(29, 0x3136206d6172732032303135202d203231206d6172732032303135),
(30, 0x3233206d6172732032303135202d203238206d6172732032303135),
(31, 0x3330206d6172732032303135202d20303420617672696c2032303135),
(32, 0x303620617672696c2032303135202d20313120617672696c2032303135),
(33, 0x313320617672696c2032303135202d20313820617672696c2032303135),
(34, 0x323020617672696c2032303135202d20323520617672696c2032303135),
(35, 0x323720617672696c2032303135202d203032206d61692032303135),
(36, 0x3034206d61692032303135202d203039206d61692032303135),
(37, 0x3131206d61692032303135202d203136206d61692032303135),
(38, 0x3138206d61692032303135202d203233206d61692032303135),
(39, 0x3235206d61692032303135202d203330206d61692032303135),
(40, 0x3031206a75696e2032303135202d203036206a75696e2032303135),
(41, 0x3038206a75696e2032303135202d203133206a75696e2032303135),
(42, 0x3135206a75696e2032303135202d203230206a75696e2032303135),
(43, 0x3232206a75696e2032303135202d203237206a75696e2032303135),
(44, 0x3239206a75696e2032303135202d203034206a75696c6c65742032303135),
(45, 0x3036206a75696c6c65742032303135202d203131206a75696c6c65742032303135),
(46, 0x3133206a75696c6c65742032303135202d203138206a75696c6c65742032303135);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `PLANNING`
--
ALTER TABLE `PLANNING`
  ADD CONSTRAINT `ID` FOREIGN KEY (`ID`) REFERENCES `GROUPE` (`ID`);
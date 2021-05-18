-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 15 mai 2021 à 21:40
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `videotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `critique`
--

CREATE TABLE `critique` (
  `idCritique` int(11) NOT NULL,
  `dateCritique` date NOT NULL,
  `contenu` text NOT NULL,
  `note` int(11) NOT NULL,
  `estValide` tinyint(1) NOT NULL COMMENT '0 = en attente, 1 = validé, 2 = refusé',
  `idFilm` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `idFilm` int(11) NOT NULL,
  `titre` varchar(40) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `sortie` date NOT NULL,
  `duree` smallint(6) NOT NULL,
  `producteur` varchar(60) NOT NULL,
  `scenariste` varchar(60) NOT NULL,
  `synopsis` text NOT NULL,
  `acteurPrincipal` varchar(60) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table contenant les informations sur un film';

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`idFilm`, `titre`, `genre`, `sortie`, `duree`, `producteur`, `scenariste`, `synopsis`, `acteurPrincipal`, `image`) VALUES
(1, 'Fight Club', 'Drame', '1999-11-10', 131, 'David Fincher', 'Jim Uhls', 'Insomniaque, désillusionné par sa vie personnelle et professionnelle, un jeune cadre expert en assurances, mène une vie monotone et sans saveur. Face à la vacuité de son existence, son médecin lui conseille de suivre une thérapie afin de relativiser son mal-être. Lors d\'un voyage d\'affaires, il fait la connaissance de Tyler Durden, une sorte de gourou anarchiste et philosophe. Ensemble, ils fondent le Fight Club. Cercle très fermé, où ils organisent des combats clandestins et violents, destinés à évacuer l\'ordre établi.', 'Brad Pitt', 'img/fight_club.jpg'),
(2, 'Pulp Fiction', 'Gangster et comédie', '1994-09-10', 140, 'Quentin Tarantino', 'Roger Avary', 'L\'odyssée sanglante, burlesque et cocasse de petits malfrats dans la jungle de Hollywood à travers trois histoires qui s\'entremêlent.', 'John Travolta', 'img/pulp_fiction.jpg'),
(3, 'Interstellar', 'Aventure,Science-fiction,Drame', '2014-11-05', 149, 'Christopher Nolan', 'Christopher Nolan', 'Un groupe d\'explorateurs exploite une faille dans l\'espace-temps afin de parcourir des distances incroyables dans le but de sauver l\'humanité.', 'Matthew McConaughey', 'img/interstellar.jpg'),
(4, '2001 : L\'Odyssée de l\'espace', 'Aventure et science-fiction', '1968-09-27', 160, 'Stanley Kubrick', 'Arthur Clarke', 'A l\'aube de l\'Humanité, dans le désert africain, une tribu de primates subit les assauts répétés d\'une bande rivale, qui lui dispute un point d\'eau. La découverte d\'un monolithe noir inspire au chef des singes assiégés un geste inédit et décisif.\r\nEn 2001, quatre millions d\'années plus tard, un vaisseau spatial évolue en orbite lunaire au rythme langoureux du \"Beau Danube Bleu\". A son bord, le Dr. Heywood Floyd enquête secrètement sur la découverte d\'un monolithe noir qui émet d\'étranges signaux vers Jupiter.', 'Keir Dullea', 'img/2001.jpg'),
(5, 'Parasite', 'Drame, Thriller', '2019-06-05', 132, 'Gisaengchoong', 'Bong Joon-ho', 'Toute la famille de Ki-taek est au chômage, et s’intéresse fortement au train de vie de la richissime famille Park. Un jour, leur fils réussit à se faire recommander pour donner des cours particuliers d’anglais chez les Park. C’est le début d’un engrenage incontrôlable, dont personne ne sortira véritablement indemne…', 'Choi Woo-Sik', 'img/parasite.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `idUtilisateur` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`idUtilisateur`, `idFilm`) VALUES
(2, 5),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `motDePasse` varchar(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table contenant les infos des utilisateurs';

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `pseudo`, `motDePasse`, `email`, `admin`) VALUES
(2, 'test', '$2y$10$8kLkUjycLvaltJEkWiY7eeK46PfZdI4HUAr3AEjc7tWfFcDzio7gS', 'test@test', 1),
(3, 'test2', '$2y$10$jCrqh2T9qSN6laHARX8HYe1T29F86q3kXNErgANcF17pveGdXJvS6', 'test2@test', 1),
(4, 'test3', '$2y$10$s.tJd29wLmhx9m53HKhSxOPat3fj4eTZrJ7oTZP24Wac2WaU.hcxK', 'test3@test', 1),
(5, 'test1', 'test1', 'test1@test', 1),
(14, 'test5', '$2y$10$SUh5XBSpInhgJ6SHdA7FoevEtahVrXM9fkmNi/hfz7/72wdtCQU6y', 'test5@test', 0),
(15, 'test12', '$2y$10$hS7sI6yU7XkTyYbdHe8UKek97nMroGKsQmjqE333QE0p9U8/idYz.', 'test12@test', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `critique`
--
ALTER TABLE `critique`
  ADD PRIMARY KEY (`idCritique`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`idFilm`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `critique`
--
ALTER TABLE `critique`
  MODIFY `idCritique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `idFilm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

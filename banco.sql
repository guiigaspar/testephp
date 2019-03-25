-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 25, 2019 at 02:25 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `jogo`
--

-- --------------------------------------------------------

--
-- Table structure for table `arma`
--

CREATE TABLE `arma` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `ForcaMin` int(11) NOT NULL,
  `ForcaMax` int(11) NOT NULL,
  `DestrezaMin` int(11) NOT NULL,
  `DestrezaMax` int(11) NOT NULL,
  `MagiaMin` int(11) NOT NULL,
  `MagiaMax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arma`
--

INSERT INTO `arma` (`ID`, `Nome`, `ForcaMin`, `ForcaMax`, `DestrezaMin`, `DestrezaMax`, `MagiaMin`, `MagiaMax`) VALUES
(1, 'Espada curta', 1, 3, 2, 4, 0, 0),
(2, 'Espada curta mágica', 1, 3, 2, 4, 1, 1),
(3, 'Espada longa', 4, 6, 1, 1, 0, 0),
(4, 'Duas espadas', 1, 3, 4, 6, 0, 0),
(5, 'Arco curto', 1, 3, 3, 4, 0, 0),
(6, 'Arco longo', 3, 5, 5, 7, 0, 0),
(7, 'Machado', 4, 6, 1, 3, 0, 0),
(8, 'Machado duplo', 6, 8, 0, 2, 0, 0),
(9, 'Cajado', 1, 1, 0, 0, 8, 10),
(10, 'Um Anel', 100, 100, 100, 100, 100, 100),
(11, 'Chamar Arwen', 0, 0, 0, 0, 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `armaLimitacao`
--

CREATE TABLE `armaLimitacao` (
  `ID` int(11) NOT NULL,
  `ArmaID` int(11) NOT NULL,
  `Propriedade` varchar(30) DEFAULT NULL,
  `Condicao` varchar(10) DEFAULT NULL,
  `PersonagemID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `armaLimitacao`
--

INSERT INTO `armaLimitacao` (`ID`, `ArmaID`, `Propriedade`, `Condicao`, `PersonagemID`) VALUES
(1, 1, 'Forca', '>= 2', NULL),
(2, 2, 'Forca', '>= 2', NULL),
(3, 3, 'Forca', '>= 5', NULL),
(4, 4, 'Destreza', '>= 5', NULL),
(5, 5, 'Destreza', '>= 4', NULL),
(6, 6, 'Destreza', '>= 7', NULL),
(7, 7, 'Forca', '>= 5', NULL),
(8, 8, 'Forca', '>= 8', NULL),
(9, 9, 'Magia', '>= 10', NULL),
(10, 10, NULL, NULL, 1),
(11, 11, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `personagem`
--

CREATE TABLE `personagem` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `ClasseID` int(11) NOT NULL,
  `Forca` int(11) NOT NULL,
  `Destreza` int(11) NOT NULL,
  `Magia` int(11) NOT NULL,
  `Tropa` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personagem`
--

INSERT INTO `personagem` (`ID`, `Nome`, `ClasseID`, `Forca`, `Destreza`, `Magia`, `Tropa`) VALUES
(1, 'Frodo', 1, 1, 2, 0, 'Sociedade'),
(2, 'Sam', 1, 4, 3, 0, 'Sociedade'),
(3, 'Merry', 1, 3, 2, 0, 'Sociedade'),
(4, 'Pippin', 1, 2, 2, 0, 'Sociedade'),
(5, 'Aragorn', 2, 8, 5, 1, 'Sociedade'),
(6, 'Boromir', 2, 9, 4, 0, 'Sociedade'),
(7, 'Legolas', 3, 5, 9, 4, 'Sociedade'),
(8, 'Gimli', 4, 8, 3, 0, 'Sociedade'),
(9, 'Gandalf', 5, 3, 4, 10, 'Sociedade'),
(10, 'Olho De Sauron', 5, 100, 100, 1000, 'Orcs'),
(11, 'Uruk-Hai', 6, 10, 7, 0, 'Orcs'),
(12, 'Snaga', 6, 4, 6, 0, 'Orcs');

-- --------------------------------------------------------

--
-- Table structure for table `personagemClasse`
--

CREATE TABLE `personagemClasse` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personagemClasse`
--

INSERT INTO `personagemClasse` (`ID`, `Nome`) VALUES
(1, 'Hobbit'),
(2, 'Humano'),
(3, 'Elfo'),
(4, 'Anão'),
(5, 'Mago'),
(6, 'Orc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arma`
--
ALTER TABLE `arma`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `armaLimitacao`
--
ALTER TABLE `armaLimitacao`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ArmaID` (`ArmaID`),
  ADD KEY `FK_PersonagemID` (`PersonagemID`);

--
-- Indexes for table `personagem`
--
ALTER TABLE `personagem`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ClasseID` (`ClasseID`);

--
-- Indexes for table `personagemClasse`
--
ALTER TABLE `personagemClasse`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arma`
--
ALTER TABLE `arma`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `armaLimitacao`
--
ALTER TABLE `armaLimitacao`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personagem`
--
ALTER TABLE `personagem`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personagemClasse`
--
ALTER TABLE `personagemClasse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `armaLimitacao`
--
ALTER TABLE `armaLimitacao`
  ADD CONSTRAINT `FK_ArmaID` FOREIGN KEY (`ArmaID`) REFERENCES `arma` (`ID`),
  ADD CONSTRAINT `FK_PersonagemID` FOREIGN KEY (`PersonagemID`) REFERENCES `personagem` (`ID`);

--
-- Constraints for table `personagem`
--
ALTER TABLE `personagem`
  ADD CONSTRAINT `FK_ClasseID` FOREIGN KEY (`ClasseID`) REFERENCES `personagemClasse` (`ID`);

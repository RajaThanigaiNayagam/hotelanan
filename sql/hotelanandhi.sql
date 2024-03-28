-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 mars 2024 à 12:39
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hotelanandhi`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 5689784592, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2022-10-27 05:25:30');

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

CREATE TABLE `booking` (
  `ID` int(10) NOT NULL,
  `RoomId` int(5) DEFAULT NULL,
  `BookingNumber` varchar(120) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `UserID` int(5) NOT NULL,
  `IDType` varchar(120) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Address` mediumtext DEFAULT NULL,
  `CheckinDate` varchar(200) DEFAULT NULL,
  `CheckoutDate` varchar(200) DEFAULT NULL,
  `BookingDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `ID` int(10) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `EnquiryDate` timestamp NULL DEFAULT current_timestamp(),
  `IsRead` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`ID`, `Name`, `MobileNumber`, `Email`, `Message`, `EnquiryDate`, `IsRead`) VALUES
(1, 'Himanshi', 9879797979, 'himanshi@gmail.com', 'Puis-je obtenir une réduction ?', '2022-11-01 12:49:20', 1),
(2, 'Jean luc', 4564654654, 'jluc@gmail.com', 'fhhsdfkjhf', '2022-11-01 12:53:07', 1),
(3, 'Gomez Richards', 9879746547, 'grichards@gmail.com', 'yiuoic cbhjgdh jhgdhsadb ', '2022-11-01 12:56:46', 1),
(4, 'TORE Munis', 5465446446, 'tmulis@gmail.com', 'jkhihihckjdshfhiuweayrufh', '2022-11-06 12:25:45', 1),
(5, 'Ruben Joseph', 2715351263, 'djshajdhas@gmail.com', 'Message de teste', '2022-11-06 14:02:22', 1);

-- --------------------------------------------------------

--
-- Structure de la table `pageutil`
--

CREATE TABLE `pageutil` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(120) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pageutil`
--

INSERT INTO `pageutil` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'à propos de nous', 'Nous disposons de 12 chambres confortablement équipées, dont deux suites : la Suite Président et la Suite Ambassadeur, avec plus de cent mètres de surface, qui sauront émerveiller les Hôtes les plus exigeants. Nous proposons 7 salles des fête, où nous préparons déjà depuis 15 ans des réunions de famille et d\'affaires.', 'test@test.fr', 1234521498, '2024-01-24 23:05:39'),
(2, 'contactus', 'Nous contacter', 'N. 11 Résidence des tilleuls, 77340 Pontault Combault', 'info@gmail.com', 8529631236, '2024-01-24 23:06:34');

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

CREATE TABLE `room` (
  `ID` int(10) NOT NULL,
  `RoomType` int(10) DEFAULT NULL,
  `RoomName` varchar(200) DEFAULT NULL,
  `MaxAdult` int(5) DEFAULT NULL,
  `MaxChild` int(5) DEFAULT NULL,
  `RoomDesc` mediumtext DEFAULT NULL,
  `NoofBed` int(5) DEFAULT NULL,
  `Image` varchar(200) DEFAULT NULL,
  `RoomFacility` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`ID`, `RoomType`, `RoomName`, `MaxAdult`, `MaxChild`, `RoomDesc`, `NoofBed`, `Image`, `RoomFacility`, `CreationDate`) VALUES
(1, 1, 'Chambre simple pour une personne', 1, 1, 'Une chambre simple est pour une personne et contient un lit simple, et sera généralement assez petite', 1, '2870b3543f2550c16a4551f03a0b84ac1582975994.jpg', 'Service d\'étage 24h/24, Accès Internet sans fil gratuit', '2020-02-29 10:33:14'),
(2, 2, 'Chambre Double', 2, 2, 'Une chambre double est une chambre destinée à accueillir deux personnes, généralement un couple. Une personne occupant une chambre double doit payer un supplément.', 2, '74375080377499ab76dad37484ee7f151582982180.jpg', '24-Hour room service,Free wireless internet accesService d\'étage 24h/24, Accès Internet sans fil gratuit', '2022-11-01 10:35:47'),
(3, 3, 'Chambre triple', 4, 2, 'Une chambre triple est une chambre d\'hôtel conçue pour accueillir confortablement trois personnes. La chambre triple , simplement appelée triple, peut parfois être configurée avec différentes tailles de lit pour garantir que trois clients de l\'hôtel puissent être logés confortablement.', 3, '5ebc75f329d3b6f84d44c2c2e9764d4f1582976638.jpg', '24-Hour room service,Free wireless internet access,Laundry service,Babysitting on request,24-Hour doctor on call,Meeting facilities', '2022-11-01 10:43:58'),
(4, 4, 'Chambre quadruple', 6, 3, 'Un quad, en référence aux chambres d\'hôtel, est une chambre pouvant accueillir quatre personnes. La chambre quadruple peut être configurée avec différentes tailles de lit pour garantir que quatre clients de l\'hôtel peuvent être logés confortablement :', 4, '0cdcf50ea65522a6e15d4e0ac383a30e1582976749.jpg', 'Service d\'étage 24h/24, Accès Internet sans fil gratuit, Service de blanchisserie, Visites et excursions, Transferts aéroport, Baby-sitting sur demande, Médecin de garde 24h/24, Salles de réunion', '2022-11-01 10:45:49'),
(5, 5, 'Chambre suite', 2, 1, 'A room with a queen-size bed. It may be occupied by one or more people (Size: 153 x 203 cm). King:', 1, '7edd3d2f392c4a07d107f07cbe764fa51582977081.jpg', 'Service d\'étage 24h/24, Accès Internet sans fil gratuit, Service de blanchisserie, Visites et excursions, Transferts aéroport, Baby-sitting sur demande, Médecin de garde 24h/24, Salles de réunion', '2022-11-01 10:51:21'),
(6, 1, 'Chambre Simple avec Balcon', 1, 0, 'Chaque chambre est équipée d\'une télévision par satellite, d\'un minibar et d\'un plateau/bouilloire. Du matériel de repassage est fourni dans toutes les chambres.\r\n\r\nLe Treebo Select Royal Garden propose un centre d\'affaires bien équipé. Vous pourrez organiser vos déplacements au bureau d\'excursions.\r\n\r\nLe restaurant Checkers sert une variété de plats indiens, chinois et continentaux.', 1, 'ca3de1cf40a0af9351083d4b0e95736c1583047692.jpg', 'Médecin de garde 24h/24', '2022-11-01 12:28:12');

-- --------------------------------------------------------

--
-- Structure de la table `roombooking`
--

CREATE TABLE `roombooking` (
  `ID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roombooking`
--

INSERT INTO `roombooking` (`ID`, `BookingID`, `roomID`, `Quantity`) VALUES
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 3),
(5, 5, 1, 2),
(55, 86124, 1, 6),
(56, 86124, 2, 12),
(57, 86124, 3, 4),
(58, 86124, 4, 2),
(61, 86125, 2, 12),
(62, 86125, 3, 4),
(63, 86125, 4, 2),
(64, 86125, 5, 2),
(66, 86126, 2, 12),
(67, 86126, 3, 4),
(68, 86126, 4, 2),
(69, 86126, 5, 2),
(71, 86127, 2, 12),
(72, 86127, 3, 4),
(73, 86127, 4, 2),
(74, 86127, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `roomcategory`
--

CREATE TABLE `roomcategory` (
  `ID` int(10) NOT NULL,
  `CategoryName` varchar(120) DEFAULT NULL,
  `RoomsAvail` int(11) NOT NULL,
  `Description` mediumtext DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Price` int(5) NOT NULL,
  `Date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roomcategory`
--

INSERT INTO `roomcategory` (`ID`, `CategoryName`, `RoomsAvail`, `Description`, `Image`, `Price`, `Date`) VALUES
(1, 'Chambre individuelle', 6, 'seulement pour une personne', '2870b3543f2550c16a4551f03a0b84ac1582975994.jpg', 100, '2022-10-28 04:43:55'),
(2, 'Chambre double', 12, 'pour deux personne. Peut être occupé par une ou plusieurs personnes', '74375080377499ab76dad37484ee7f151582982180.jpg', 150, '2022-10-28 04:44:55'),
(3, 'Chambre triple', 4, 'pour trois personne. Peut être occupé par une ou plusieurs personnes.', '5ebc75f329d3b6f84d44c2c2e9764d4f1582976638.jpg', 200, '2022-10-28 04:45:27'),
(4, 'Chambre quadruple', 2, 'pour quatre personne. Peut être occupé par une ou plusieurs personnes.', '0cdcf50ea65522a6e15d4e0ac383a30e1582976749.jpg', 250, '2022-10-28 04:45:56'),
(5, 'Chambre suite', 2, 'chambres de luxe. Peut être occupé par une ou plusieurs personnes.', 'ca3de1cf40a0af9351083d4b0e95736c1583047692.jpg', 300, '2022-10-28 04:46:30');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `FullName`, `MobileNumber`, `Email`, `Password`, `RegDate`) VALUES
(1, 'Test', 7897897899, 'test@gmail.com', '202cb962ac59075b964b07152d234b70', '2022-10-27 15:07:28'),
(2, 'Sample', 4644654646, 'sample@gmail.com', '202cb962ac59075b964b07152d234b70', '2022-11-01 11:51:42'),
(3, 'Raja Thanigai', 1234569871, 'Test@test.com', 'f925916e2754e5e03f75dd58a5733251', '2022-11-06 13:53:36'),
(4, 'test8', 123454689, 'test9@test.fr', 'e10adc3949ba59abbe56e057f20f883e', '2023-07-11 21:40:43'),
(5, 'test10', 123456789, 'test10@test.fr', 'e10adc3949ba59abbe56e057f20f883e', '2023-07-11 21:42:21');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RoomId` (`RoomId`),
  ADD KEY `UserID` (`UserID`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `pageutil`
--
ALTER TABLE `pageutil`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RoomType` (`RoomType`);

--
-- Index pour la table `roombooking`
--
ALTER TABLE `roombooking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `bookingID` (`BookingID`),
  ADD KEY `roomID` (`roomID`);

--
-- Index pour la table `roomcategory`
--
ALTER TABLE `roomcategory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `booking`
--
ALTER TABLE `booking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86129;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pageutil`
--
ALTER TABLE `pageutil`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `room`
--
ALTER TABLE `room`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `roombooking`
--
ALTER TABLE `roombooking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `roomcategory`
--
ALTER TABLE `roomcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

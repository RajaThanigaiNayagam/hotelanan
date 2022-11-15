
--
-- Table structure for table `tbladmin`
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

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `roomcategory` (
  `ID` int(10) NOT NULL,
  `CategoryName` varchar(120) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `Price` int(5) NOT NULL,
  `Date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `tbluser`
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
-- Table structure for table `tblpage`
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
-- Table structure for table `tblcontact`
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
-- Table structure for table `tblbooking`
--

CREATE TABLE `booking` (
  `ID` int(10) NOT NULL,
  `RoomId` int(5) DEFAULT NULL,
  `BookingNumber` varchar(120) DEFAULT NULL,
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

--
-- Table structure for table `tblroom`
-- -----------------OK-------------------
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
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `roomcategory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `pageutil`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblroom`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RoomType` (`RoomType`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `booking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `roomcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `pageutil`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblroom`
--
ALTER TABLE `room`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;



--
-- Dumping data for table `tbladmin`
--

INSERT INTO `admin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 5689784592, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2022-10-27 07:25:30');

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `roomcategory` (`ID`, `CategoryName`, `Description`, `Price`, `Date`) VALUES
(1, 'Chambre individuelle', 'seulement pour une personne', 100, '2022-10-28 06:43:55'),
(2, 'Chambre double', 'pour deux personne. Peut être occupé par une ou plusieurs personnes', 150, '2022-10-28 06:44:55'),
(3, 'Chambre triple', 'pour trois personne. Peut être occupé par une ou plusieurs personnes.', 200, '2022-10-28 06:45:27'),
(4, 'Chambre quadruple', 'pour quatre personne. Peut être occupé par une ou plusieurs personnes.', 250, '2022-10-28 06:45:56'),
(5, 'Chambre suite', 'chambres de luxe. Peut être occupé par une ou plusieurs personnes.', 300, '2022-10-28 06:46:30');

--
-- Dumping data for table `tbluser`
--

INSERT INTO `user` (`ID`, `FullName`, `MobileNumber`, `Email`, `Password`, `RegDate`) VALUES
(1, 'Test', 7897897899, 'test@gmail.com', '202cb962ac59075b964b07152d234b70', '2022-10-27 17:07:28'),
(2, 'Sample', 4644654646, 'sample@gmail.com', '202cb962ac59075b964b07152d234b70', '2022-11-01 12:51:42'),
(3, 'Anuj Kumar', 1234569871, 'Test@test.com', 'f925916e2754e5e03f75dd58a5733251', '2022-11-06 14:53:36');


--
-- Dumping data for table `tblpage`
--

INSERT INTO `pageutil` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'à propos de nous', 'à propos de nous', 'Nous disposons de 12 chambres confortablement équipées, dont deux suites : la Suite Président et la Suite Ambassadeur, avec plus de cent mètres de surface, qui sauront émerveiller les Hôtes les plus exigeants. Nous proposons 7 salles des fête, où nous préparons déjà depuis 15 ans des réunions de famille et d\'affaires.', 'test@test.fr', '01234521498',  '2022-10-29 14:14:30'),
(2, 'Nous contacter', 'Nous contacter', 'N. 11 Résidence des tilleuls, 77340 Pontault Combault', 'info@gmail.com', 8529631236, '2022-10-29 14:14:30');

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `contact` (`ID`, `Name`, `MobileNumber`, `Email`, `Message`, `EnquiryDate`, `IsRead`) VALUES
(1, 'Himanshi', 9879797979, 'himanshi@gmail.com', 'Puis-je obtenir une réduction ?', '2022-11-01 13:49:20', 1),
(2, 'Jean luc', 4564654654, 'jluc@gmail.com', 'fhhsdfkjhf', '2022-11-01 13:53:07', 1),
(3, 'Gomez Richards', 9879746547, 'grichards@gmail.com', 'yiuoic cbhjgdh jhgdhsadb ', '2022-11-01 13:56:46', 1),
(4, 'TORE Munis', 5465446446, 'tmulis@gmail.com', 'jkhihihckjdshfhiuweayrufh', '2022-11-06 13:25:45', 1),
(5, 'Ruben Joseph', 2715351263, 'djshajdhas@gmail.com', 'Message de teste', '2022-11-06 15:02:22', 1);


--
-- Dumping data for table `tblbooking`
--

INSERT INTO `booking` (`ID`, `RoomId`, `BookingNumber`, `UserID`, `IDType`, `Gender`, `Address`, `CheckinDate`, `CheckoutDate`, `BookingDate`, `Remark`, `Status`, `UpdationDate`) VALUES
(1, 2, '803934050', 1, 'Pièce d\'identité', 'home', 'Paris FRANCE', '2022-11-04', '2022-11-05', '2022-11-02 14:20:53', 'Cancelled', 'Cancelled', '2022-11-02 15:01:41'),
(2, 1, '132018073', 3, 'Passport', 'femme', 'cretail  France', '2022-11-05', '2022-11-06', '2022-11-03 14:54:49', 'Booking Confirmed.', 'Approved', '2022-11-03 15:00:46');

--
-- Dumping data for table `tblroom`
--

INSERT INTO `room` (`ID`, `RoomType`, `RoomName`, `MaxAdult`, `MaxChild`, `RoomDesc`, `NoofBed`, `Image`, `RoomFacility`, `CreationDate`) VALUES
(1, 1, 'Chambre simple pour une personne', 1, 2, 'Une chambre simple est pour une personne et contient un lit simple, et sera généralement assez petite', 1, '2870b3543f2550c16a4551f03a0b84ac1582975994.jpg', 'Service d\'étage 24h/24, Accès Internet sans fil gratuit', '2020-02-29 11:33:14'),
(2, 2, 'Chambre Double', 2, 2, 'Une chambre double est une chambre destinée à accueillir deux personnes, généralement un couple. Une personne occupant une chambre double doit payer un supplément.', 2, '74375080377499ab76dad37484ee7f151582982180.jpg', '24-Hour room service,Free wireless internet accesService d\'étage 24h/24, Accès Internet sans fil gratuit', '2022-11-01 11:35:47'),
(3, 3, 'Chambre triple', 4, 2, 'Une chambre triple est une chambre d\'hôtel conçue pour accueillir confortablement trois personnes. La chambre triple , simplement appelée triple, peut parfois être configurée avec différentes tailles de lit pour garantir que trois clients de l\'hôtel puissent être logés confortablement.', 3, '5ebc75f329d3b6f84d44c2c2e9764d4f1582976638.jpg', '24-Hour room service,Free wireless internet access,Laundry service,Babysitting on request,24-Hour doctor on call,Meeting facilities', '2022-11-01 11:43:58'),
(4, 4, 'Chambre quadruple', 6, 3, 'Un quad, en référence aux chambres d\'hôtel, est une chambre pouvant accueillir quatre personnes. La chambre quadruple peut être configurée avec différentes tailles de lit pour garantir que quatre clients de l\'hôtel peuvent être logés confortablement :', 4, '0cdcf50ea65522a6e15d4e0ac383a30e1582976749.jpg', 'Service d\'étage 24h/24, Accès Internet sans fil gratuit, Service de blanchisserie, Visites et excursions, Transferts aéroport, Baby-sitting sur demande, Médecin de garde 24h/24, Salles de réunion', '2022-11-01 11:45:49'),
(5, 5, 'Chambre suite', 2, 1, 'A room with a queen-size bed. It may be occupied by one or more people (Size: 153 x 203 cm). King:', 1, '7edd3d2f392c4a07d107f07cbe764fa51582977081.jpg', 'Service d\'étage 24h/24, Accès Internet sans fil gratuit, Service de blanchisserie, Visites et excursions, Transferts aéroport, Baby-sitting sur demande, Médecin de garde 24h/24, Salles de réunion', '2022-11-01 11:51:21'),
(6, 1, 'Chambre Simple avec Balcon', 1, 2, 'Chaque chambre est équipée d\'une télévision par satellite, d\'un minibar et d\'un plateau/bouilloire. Du matériel de repassage est fourni dans toutes les chambres.\r\n\r\nLe Treebo Select Royal Garden propose un centre d\'affaires bien équipé. Vous pourrez organiser vos déplacements au bureau d\'excursions.\r\n\r\nLe restaurant Checkers sert une variété de plats indiens, chinois et continentaux.', 1, 'ca3de1cf40a0af9351083d4b0e95736c1583047692.jpg', 'Médecin de garde 24h/24', '2022-11-01 13:28:12');



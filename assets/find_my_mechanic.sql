-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2017 at 02:41 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_my_mechanic`
--
CREATE DATABASE IF NOT EXISTS `find_My_Mechanic` DEFAULT CHARACTER SET = 'utf8' COLLATE utf8_general_ci;
USE `find_My_Mechanic`;
-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminName` varchar(30) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `flag` int(1) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminName`, `Email`, `flag`, `Status`, `Password`) VALUES
('Nabil', 'nabil@admin.com', 3, 'Active', 'Simone123');

-- --------------------------------------------------------

--
-- Table structure for table `availableservices`
--

CREATE TABLE `availableservices` (
  `ServicesId` varchar(11) NOT NULL,
  `ServiceName` varchar(40) NOT NULL,
  `Cost` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `availableservices`
--

INSERT INTO `availableservices` (`ServicesId`, `ServiceName`, `Cost`) VALUES
('1512416170', 'Oil Change', '300'),
('1512416209', 'Engine fix', '6000'),
('1512416217', 'Circuit fix', '5000'),
('1512416263', 'Engine fix', '5000'),
('1512416280', 'Circuit fix', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `carowner`
--

CREATE TABLE `carowner` (
  `Name` varchar(30) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Contact` varchar(16) NOT NULL,
  `DOB` date NOT NULL,
  `NID` varchar(20) NOT NULL,
  `DrivingLicence` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `flag` int(1) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carowner`
--

INSERT INTO `carowner` (`Name`, `Email`, `Contact`, `DOB`, `NID`, `DrivingLicence`, `Password`, `Address`, `flag`, `Status`) VALUES
('Faisal Nabil', 'nabilt59@gmail.com', '01521480904', '1994-11-20', '2610413965400', 'DX00721553684CL005', 'Hacker123', '523, Seroil, Rajshahi', 1, 'Active'),
('Sarwar', 'sarwarhosen007@gmail.com', '01521554477', '1994-12-22', '8855455151845', 'DZ7726SS8ur22', 'Cisco@2014', 'Dhaka, Bangladesh', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `carshop`
--

CREATE TABLE `carshop` (
  `Email` varchar(35) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `flag` int(1) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carshop`
--

INSERT INTO `carshop` (`Email`, `Password`, `flag`, `Status`) VALUES
('hrepair@yahoo.com', 'Hacker@123', 2, 'Active'),
('nabil@admin.com', 'Simone123', 3, 'Active'),
('nabilt59@gmail.com', 'Hacker123', 1, 'Active'),
('onestop@ymail.com', 'Hacker123', 2, 'Active'),
('sarwarhosen007@gmail.com', 'Cisco@2014', 1, 'Active'),
('tuhin@gmail.com', 'Hacker@123', 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `MessageId` int(10) NOT NULL,
  `SenderMail` varchar(25) NOT NULL,
  `ReceiverMail` varchar(25) NOT NULL,
  `MessageBody` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`MessageId`, `SenderMail`, `ReceiverMail`, `MessageBody`, `Date`, `Status`) VALUES
(57, 'nabilt59@gmail.com', 'onestop@ymail.com', 'Flat Tire problem', '2017-04-29', 'read'),
(58, 'sdfg@gdf.com', 'nabil@admin.com', 'sdfghjk', '2017-05-02', 'read'),
(59, 'nabilt59@gmail.com', 'onestop@ymail.com', 'Help me', '2017-05-03', 'read'),
(60, 'onestop@ymail.com', 'nabilt59@gmail.com', 'Ok', '2017-05-03', 'read'),
(61, 'onestop@ymail.com', 'nabilt59@gmail.com', 'ki help?\r\n', '2017-05-03', 'read'),
(62, 'nabilt59@gmail.com', 'onestop@ymail.com', 'Hi', '2017-05-10', 'unread'),
(63, 'nabilt59@gmail.com', 'onestop@ymail.com', 'Hi', '2017-05-10', 'unread'),
(64, 'nabilt59@gmail.com', 'onestop@ymail.com', 'hmm', '2017-05-10', 'unread'),
(65, 'sarwarhosen007@gmail.com', 'onestop@ymail.com', 'Hey can you help?', '2017-12-04', 'read'),
(66, 'onestop@ymail.com', 'sarwarhosen007@gmail.com', 'ok', '2017-12-04', 'read'),
(67, 'sarwarhosen007@gmail.com', 'onestop@ymail.com', 'Hey can you help?', '2017-12-04', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `NotificationId` int(100) NOT NULL,
  `FromEmail` varchar(30) NOT NULL,
  `ToEmail` varchar(30) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(7) NOT NULL,
  `ServiceId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`NotificationId`, `FromEmail`, `ToEmail`, `Type`, `Date`, `Status`, `ServiceId`) VALUES
(33, 'nabilt59@gmail.com', 'onestop@ymail.com', '1', '2017-04-29', 'read', 'no1493484147'),
(34, 'onestop@ymail.com', 'nabilt59@gmail.com', '2', '2017-04-29', 'read', 'no1493484147'),
(35, 'nabilt59@gmail.com', 'onestop@ymail.com', '1', '2017-05-03', 'read', 'no2017-05-03'),
(36, 'onestop@ymail.com', 'nabilt59@gmail.com', '3', '2017-05-03', 'read', 'no2017-05-03'),
(37, 'nabilt59@gmail.com', 'onestop@ymail.com', '1', '2017-05-10', 'unread', 'no1494387599'),
(38, 'nabilt59@gmail.com', 'onestop@ymail.com', '1', '2017-05-10', 'unread', 'no1494387632'),
(39, 'nabilt59@gmail.com', 'onestop@ymail.com', '1', '2017-05-10', 'unread', 'no1494387638'),
(40, 'sarwarhosen007@gmail.com', 'onestop@ymail.com', '1', '2017-12-04', 'read', 'so1512373126'),
(41, 'onestop@ymail.com', 'sarwarhosen007@gmail.com', '2', '2017-12-04', 'read', 'so1512373126'),
(42, 'sarwarhosen007@gmail.com', 'onestop@ymail.com', '1', '2017-12-04', 'unread', 'so1512373218');

-- --------------------------------------------------------

--
-- Table structure for table `ownervehiclerelation`
--

CREATE TABLE `ownervehiclerelation` (
  `Email` varchar(35) NOT NULL,
  `VehicleRegNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ownervehiclerelation`
--

INSERT INTO `ownervehiclerelation` (`Email`, `VehicleRegNo`) VALUES
('nabilt59@gmail.com', 'BP-1478HD'),
('nabilt59@gmail.com', 'RAJ Metro ha-1420'),
('sarwarhosen007@gmail.com', 'DHK-Ka 12-1222');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `ServiceId` varchar(20) NOT NULL,
  `CarOwnerEmail` varchar(35) NOT NULL,
  `ShopOwnerEmail` varchar(35) NOT NULL,
  `VehicleRegNo` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Latitude` varchar(100) NOT NULL,
  `Longitude` varchar(100) NOT NULL,
  `SecretKey` int(5) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ServiceId`, `CarOwnerEmail`, `ShopOwnerEmail`, `VehicleRegNo`, `Date`, `Latitude`, `Longitude`, `SecretKey`, `Status`) VALUES
('no1493484147', 'nabilt59@gmail.com', 'onestop@ymail.com', 'RAJ Metro ha-1420', '2017-04-29', '23.810332', '90.4125181', 12345, 'Done'),
('no1494387599', 'nabilt59@gmail.com', 'onestop@ymail.com', 'BP-1478HD', '2017-05-10', '23.810332', '90.4125181', 0, 'Pending'),
('no1494387632', 'nabilt59@gmail.com', 'onestop@ymail.com', 'BP-1478HD', '2017-05-10', '23.810332', '90.4125181', 0, 'Pending'),
('no1494387638', 'nabilt59@gmail.com', 'onestop@ymail.com', 'BP-1478HD', '2017-05-10', '23.810332', '90.4125181', 0, 'Pending'),
('no2017-05-03', 'nabilt59@gmail.com', 'onestop@ymail.com', 'RAJ Metro ha-1420', '2017-05-03', '23.7946582', '90.4059319', 12345, 'Rejected'),
('so1512373126', 'sarwarhosen007@gmail.com', 'onestop@ymail.com', 'DHK-Ka 12-1222', '2017-12-04', '23.8294967', '90.41897449999999', 12345, 'Done'),
('so1512373218', 'sarwarhosen007@gmail.com', 'onestop@ymail.com', 'DHK-Ka 12-1222', '2017-12-04', '23.8294967', '90.41897449999999', 0, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `shopowner`
--

CREATE TABLE `shopowner` (
  `ShopName` varchar(35) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Contact` varchar(18) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Latitude` decimal(65,9) NOT NULL,
  `Longitude` decimal(65,9) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `ShopTradeLicence` varchar(20) NOT NULL,
  `flag` int(1) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopowner`
--

INSERT INTO `shopowner` (`ShopName`, `Email`, `Contact`, `Password`, `Latitude`, `Longitude`, `Address`, `ShopTradeLicence`, `flag`, `Status`) VALUES
('Handy Repair', 'hrepair@yahoo.com', '0155774411', 'Hacker@123', '23.818383000', '90.415147000', 'Shewra rail crossing, Dhaka', 'DHK554484GT2214', 2, 'Active'),
('Onestop Mechanic', 'onestop@ymail.com', '0182771221', 'Hacker@123', '23.824844000', '90.422181000', 'Bishwaroad,Dhaka', 'DHK554314CL2235', 2, 'Active'),
('Tuhin Car Repair', 'tuhin@gmail.com', '01711665588', 'Hacker@123', '23.826325000', '90.428976000', 'Progoti Sarani, Basundhara R/A, Dhaka', 'DHK554314CL2234', 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `shopservicerelation`
--

CREATE TABLE `shopservicerelation` (
  `ShopEmail` varchar(30) NOT NULL,
  `ServicesId` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopservicerelation`
--

INSERT INTO `shopservicerelation` (`ShopEmail`, `ServicesId`) VALUES
('onestop@ymail.com', '1512416170'),
('onestop@ymail.com', '1512416209'),
('onestop@ymail.com', '1512416217'),
('tuhin@gmail.com', '1512416263'),
('tuhin@gmail.com', '1512416280');

-- --------------------------------------------------------

--
-- Table structure for table `shopstockrelation`
--

CREATE TABLE `shopstockrelation` (
  `ShopEmail` varchar(35) NOT NULL,
  `StockId` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopstockrelation`
--

INSERT INTO `shopstockrelation` (`ShopEmail`, `StockId`) VALUES
('onestop@ymail.com', '1493486056'),
('onestop@ymail.com', '1493798705'),
('tuhin@gmail.com', '1512413610');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `StockId` varchar(11) NOT NULL,
  `PartsName` varchar(30) NOT NULL,
  `PricePerUnit` varchar(15) NOT NULL,
  `TotalUnit` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`StockId`, `PartsName`, `PricePerUnit`, `TotalUnit`) VALUES
('1493486056', 'Head Light for Bike', '5000', 11),
('1493798705', 'Bumper', '1200', 11),
('1512413610', 'Tyres', '3000', 10);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `VehicleRegNo` varchar(20) NOT NULL,
  `RegistrationDate` date NOT NULL,
  `InsuranceNumber` varchar(20) NOT NULL,
  `VehicleType` varchar(30) NOT NULL,
  `ModelName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`VehicleRegNo`, `RegistrationDate`, `InsuranceNumber`, `VehicleType`, `ModelName`) VALUES
('BP-1478HD', '2012-04-10', 'CX122545RJ', 'Private Car', 'Marcedes benz c100'),
('DHK-Ka 12-1222', '2015-12-09', 'KS127T515', 'Private Car', 'Mercedese C-300'),
('RAJ Metro ha-1420', '2016-08-17', 'CF45121MM', 'Motor Cycle', 'Yamaha FZ150');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `availableservices`
--
ALTER TABLE `availableservices`
  ADD PRIMARY KEY (`ServicesId`);

--
-- Indexes for table `carowner`
--
ALTER TABLE `carowner`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `carshop`
--
ALTER TABLE `carshop`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`MessageId`),
  ADD KEY `SenderMail` (`SenderMail`) USING BTREE,
  ADD KEY `ReceiverMail` (`ReceiverMail`) USING BTREE;

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`NotificationId`),
  ADD KEY `CarOwnerEmail` (`FromEmail`),
  ADD KEY `ShopOwnerEmail` (`ToEmail`);

--
-- Indexes for table `ownervehiclerelation`
--
ALTER TABLE `ownervehiclerelation`
  ADD KEY `Email` (`Email`),
  ADD KEY `VehicleRegNo` (`VehicleRegNo`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ServiceId`),
  ADD KEY `CarOwnerEmail` (`CarOwnerEmail`),
  ADD KEY `ShopOwner` (`ShopOwnerEmail`),
  ADD KEY `VehiceRegNo` (`VehicleRegNo`);

--
-- Indexes for table `shopowner`
--
ALTER TABLE `shopowner`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `shopservicerelation`
--
ALTER TABLE `shopservicerelation`
  ADD KEY `ShopEmail` (`ShopEmail`),
  ADD KEY `ServicesId` (`ServicesId`);

--
-- Indexes for table `shopstockrelation`
--
ALTER TABLE `shopstockrelation`
  ADD KEY `ShopEmail` (`ShopEmail`),
  ADD KEY `StockId` (`StockId`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`StockId`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`VehicleRegNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `MessageId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `NotificationId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`FromEmail`) REFERENCES `carshop` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`ToEmail`) REFERENCES `carshop` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ownervehiclerelation`
--
ALTER TABLE `ownervehiclerelation`
  ADD CONSTRAINT `ownervehiclerelation_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `carowner` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ownervehiclerelation_ibfk_2` FOREIGN KEY (`VehicleRegNo`) REFERENCES `vehicle` (`VehicleRegNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`CarOwnerEmail`) REFERENCES `carowner` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`ShopOwnerEmail`) REFERENCES `shopowner` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_ibfk_3` FOREIGN KEY (`VehicleRegNo`) REFERENCES `vehicle` (`VehicleRegNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopservicerelation`
--
ALTER TABLE `shopservicerelation`
  ADD CONSTRAINT `shopservicerelation_ibfk_1` FOREIGN KEY (`ShopEmail`) REFERENCES `shopowner` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shopservicerelation_ibfk_2` FOREIGN KEY (`ServicesId`) REFERENCES `availableservices` (`ServicesId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopstockrelation`
--
ALTER TABLE `shopstockrelation`
  ADD CONSTRAINT `shopstockrelation_ibfk_1` FOREIGN KEY (`ShopEmail`) REFERENCES `shopowner` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shopstockrelation_ibfk_2` FOREIGN KEY (`StockId`) REFERENCES `stock` (`StockId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

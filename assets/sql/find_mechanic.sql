-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2017 at 07:18 PM
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
-- Table structure for table `availableservices`
--

CREATE TABLE `availableservices` (
  `ServicesId` varchar(10) NOT NULL,
  `ServiceName` varchar(40) NOT NULL,
  `Cost` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `availableservices`
--

INSERT INTO `availableservices` (`ServicesId`, `ServiceName`, `Cost`) VALUES
('A32', 'paintjob', '5000tk');

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
  `flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carowner`
--

INSERT INTO `carowner` (`Name`, `Email`, `Contact`, `DOB`, `NID`, `DrivingLicence`, `Password`, `Address`, `flag`) VALUES
('Nabil', 'nabilt59@gmail.com', '01521480480', '1994-11-20', '199646896557', '46788065', '12345', 'nikunja-2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `carshop`
--

CREATE TABLE `carshop` (
  `Email` varchar(35) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carshop`
--

INSERT INTO `carshop` (`Email`, `Password`, `flag`) VALUES
('tuhinbhuiyan7@gmail.com', '1234', 2),
('nabilt59@gmail.com', '12345', 1);

-- --------------------------------------------------------


--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `CarOwnerEmail` varchar(35) NOT NULL,
  `ShopOwnerEmail` varchar(35) NOT NULL,
  `MessageBody` varchar(255) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`CarOwnerEmail`, `ShopOwnerEmail`, `MessageBody`, `Date`) VALUES
('nabilt59@gmail.com', 'tuhinbhuiyan7@gmail.com', 'asdasdas', '2017-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `CarOwnerEmail` varchar(30) NOT NULL,
  `ShopOwnerEmail` varchar(30) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`CarOwnerEmail`, `ShopOwnerEmail`, `Type`, `Date`) VALUES
('nabilt59@gmail.com', 'tuhinbhuiyan7@gmail.com', '1', '2017-02-12');

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
('nabilt59@gmail.com', 'AB-23212');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `ServiceId` varchar(10) NOT NULL,
  `CarOwnerEmail` varchar(35) NOT NULL,
  `ShopOwnerEmail` varchar(35) NOT NULL,
  `VehicleRegNo` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ServiceId`, `CarOwnerEmail`, `ShopOwnerEmail`, `VehicleRegNo`, `Date`, `Location`) VALUES
('35636', 'nabilt59@gmail.com', 'tuhinbhuiyan7@gmail.com', 'AB-23212', '2017-02-12', 'uttara');

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
  `flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopowner`
--

INSERT INTO `shopowner` (`ShopName`, `Email`, `Contact`, `Password`, `Latitude`, `Longitude`, `Address`, `ShopTradeLicence`, `flag`) VALUES
('Sarwar Carwash', 'hosensarwar007@gmail.com', '01700000000', '1234', '23.128912000', '93.009122000', 'Gulshan,Dhaka', '889872', 2),
('Tuhin Enterprise', 'tuhinbhuiyan7@gmail.com', '01521498220', '1234', '9.999999999', '9.999999999', 'uttara', 'A123E', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shopservicerelation`
--

CREATE TABLE `shopservicerelation` (
  `ShopEmail` varchar(30) NOT NULL,
  `ServicesId` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopservicerelation`
--

INSERT INTO `shopservicerelation` (`ShopEmail`, `ServicesId`) VALUES
('tuhinbhuiyan7@gmail.com', 'A32');

-- --------------------------------------------------------

--
-- Table structure for table `shopstockrelation`
--

CREATE TABLE `shopstockrelation` (
  `ShopEmail` varchar(35) NOT NULL,
  `StockId` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopstockrelation`
--

INSERT INTO `shopstockrelation` (`ShopEmail`, `StockId`) VALUES
('tuhinbhuiyan7@gmail.com', '2631');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `StockId` varchar(10) NOT NULL,
  `PartsName` varchar(30) NOT NULL,
  `PricePerUnit` varchar(15) NOT NULL,
  `TotalUnit` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`StockId`, `PartsName`, `PricePerUnit`, `TotalUnit`) VALUES
('2631', 'Bumper', '5000tk', 50);

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
('AB-23212', '2017-04-12', 'AC6546V', 'Private Car', 'Toyota');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD KEY `CarOwnerEmail` (`CarOwnerEmail`),
  ADD KEY `ShopOwnerEmail` (`ShopOwnerEmail`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD KEY `CarOwnerEmail` (`CarOwnerEmail`),
  ADD KEY `ShopOwnerEmail` (`ShopOwnerEmail`);

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
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`CarOwnerEmail`) REFERENCES `carowner` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`ShopOwnerEmail`) REFERENCES `shopowner` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`CarOwnerEmail`) REFERENCES `carowner` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`ShopOwnerEmail`) REFERENCES `shopowner` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

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

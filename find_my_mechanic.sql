-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2017 at 09:01 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findMyMechanic`
--
CREATE DATABASE IF NOT EXISTS `findMyMechanic` DEFAULT CHARACTER SET = 'utf8' COLLATE utf8_general_ci;
USE `findMyMechanic`;

-- --------------------------------------------------------

--
-- Table structure for table `availableservice`
--

CREATE TABLE `availableservice` (
  `Services Id` varchar(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Cost` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `carowner`
--

CREATE TABLE `carowner` (
  `National Id` varchar(20) NOT NULL,
  `Driving Licence` varchar(20) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `DOB` date NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Address` varchar(70) NOT NULL,
  `Password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carowner`
--

INSERT INTO `carowner` (`National Id`, `Driving Licence`, `Name`, `DOB`, `Email`, `Phone`, `Address`, `Password`) VALUES
('19952312232234123', 'AB234C', 'Nabil', '1995-11-20', 'nabilt59@gmail.com', '01723232231', 'Uttara,Dhaka', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `National Id` varchar(20) NOT NULL,
  `Shop Trade Licence` varchar(20) NOT NULL,
  `Message Body` varchar(255) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `Shop Trade Licence` varchar(20) NOT NULL,
  `National Id` varchar(20) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ownervehiclerelation`
--

CREATE TABLE `ownervehiclerelation` (
  `National Id` varchar(20) NOT NULL,
  `Driving Licence` varchar(20) NOT NULL,
  `Vehicle reg no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `Service Id` varchar(10) NOT NULL,
  `National Id` varchar(20) NOT NULL,
  `Driving Licence` varchar(20) NOT NULL,
  `Shop Trade Licence` varchar(20) NOT NULL,
  `Vehicle reg no` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shopowner`
--

CREATE TABLE `shopowner` (
  `Shop Trade Licence` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Address` varchar(70) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopowner`
--

INSERT INTO `shopowner` (`Shop Trade Licence`, `Name`, `Phone`, `Password`, `Address`, `Email`, `Location`) VALUES
('AVC1231', 'Tuhin Enterprise', '01733131232', '23456', 'Uttara,Dhaka', 'mshtb786@gmail.com', 'Uttara,Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `shopservicerelation`
--

CREATE TABLE `shopservicerelation` (
  `Shop Trade Licence` varchar(20) NOT NULL,
  `Services Id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shopstockrelation`
--

CREATE TABLE `shopstockrelation` (
  `Shop Trade Licence` varchar(20) NOT NULL,
  `Stock Id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `Stock Id` varchar(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Total Unit` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`Stock Id`, `Name`, `Price`, `Total Unit`) VALUES
('1232', 'Bumper', '1000tk', 50);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `VehicleRegNo` varchar(20) NOT NULL,
  `RegDate` date DEFAULT NULL,
  `InsuranceNo` varchar(20) NOT NULL,
  `vehicleType` varchar(20) NOT NULL,
  `ModelName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`VehicleRegNo`, `RegDate`, `InsuranceNo`, `vehicleType`, `ModelName`) VALUES
('DHK-21-2202', '2017-04-24', '424241', 'Private Car', 'BMW i8'),
('RAJ-19-2099', '2017-04-02', '12313', 'Private Car', 'Jaguar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availableservice`
--
ALTER TABLE `availableservice`
  ADD PRIMARY KEY (`Services Id`);

--
-- Indexes for table `carowner`
--
ALTER TABLE `carowner`
  ADD PRIMARY KEY (`National Id`,`Driving Licence`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD KEY `Shop Trade Licence` (`Shop Trade Licence`),
  ADD KEY `National Id` (`National Id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD KEY `Shop Trade Licence` (`Shop Trade Licence`),
  ADD KEY `National Id` (`National Id`);

--
-- Indexes for table `ownervehiclerelation`
--
ALTER TABLE `ownervehiclerelation`
  ADD KEY `National Id` (`National Id`,`Driving Licence`),
  ADD KEY `Vehicle reg no` (`Vehicle reg no`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`Service Id`),
  ADD KEY `National Id` (`National Id`,`Driving Licence`),
  ADD KEY `Shop Trade Licence` (`Shop Trade Licence`),
  ADD KEY `Vehicle reg no` (`Vehicle reg no`);

--
-- Indexes for table `shopowner`
--
ALTER TABLE `shopowner`
  ADD PRIMARY KEY (`Shop Trade Licence`);

--
-- Indexes for table `shopservicerelation`
--
ALTER TABLE `shopservicerelation`
  ADD KEY `Shop Trade Licence` (`Shop Trade Licence`),
  ADD KEY `Services Id` (`Services Id`);

--
-- Indexes for table `shopstockrelation`
--
ALTER TABLE `shopstockrelation`
  ADD KEY `Shop Trade Licence` (`Shop Trade Licence`),
  ADD KEY `Stock Id` (`Stock Id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`Stock Id`);

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
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`Shop Trade Licence`) REFERENCES `shopowner` (`Shop Trade Licence`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`National Id`) REFERENCES `carowner` (`National Id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`Shop Trade Licence`) REFERENCES `shopowner` (`Shop Trade Licence`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`National Id`) REFERENCES `carowner` (`National Id`);

--
-- Constraints for table `ownervehiclerelation`
--
ALTER TABLE `ownervehiclerelation`
  ADD CONSTRAINT `OwnerVehicleRelation_ibfk_1` FOREIGN KEY (`National Id`,`Driving Licence`) REFERENCES `carowner` (`National Id`, `Driving Licence`),
  ADD CONSTRAINT `OwnerVehicleRelation_ibfk_2` FOREIGN KEY (`Vehicle reg no`) REFERENCES `vehicle` (`VehicleRegNo`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`National Id`,`Driving Licence`) REFERENCES `carowner` (`National Id`, `Driving Licence`),
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`Shop Trade Licence`) REFERENCES `shopowner` (`Shop Trade Licence`),
  ADD CONSTRAINT `service_ibfk_3` FOREIGN KEY (`Vehicle reg no`) REFERENCES `vehicle` (`VehicleRegNo`);

--
-- Constraints for table `shopservicerelation`
--
ALTER TABLE `shopservicerelation`
  ADD CONSTRAINT `ShopServiceRelation_ibfk_1` FOREIGN KEY (`Shop Trade Licence`) REFERENCES `shopowner` (`Shop Trade Licence`),
  ADD CONSTRAINT `ShopServiceRelation_ibfk_2` FOREIGN KEY (`Services Id`) REFERENCES `availableservice` (`Services Id`);

--
-- Constraints for table `shopstockrelation`
--
ALTER TABLE `shopstockrelation`
  ADD CONSTRAINT `ShopStockRelation_ibfk_1` FOREIGN KEY (`Shop Trade Licence`) REFERENCES `shopowner` (`Shop Trade Licence`),
  ADD CONSTRAINT `ShopStockRelation_ibfk_2` FOREIGN KEY (`Stock Id`) REFERENCES `stock` (`Stock Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

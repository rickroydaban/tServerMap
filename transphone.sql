-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2013 at 04:00 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `transphone`
--
CREATE DATABASE IF NOT EXISTS `transphone` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `transphone`;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `Client_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Src_Latitude` double NOT NULL,
  `Src_Longitude` double NOT NULL,
  `Dest_Latitude` double NOT NULL,
  `Dest_Longitude` double NOT NULL,
  PRIMARY KEY (`Client_ID`),
  KEY `Client_IP` (`Src_Latitude`,`Src_Longitude`,`Dest_Latitude`,`Dest_Longitude`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Contains the data of clients' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Client_ID`, `Src_Latitude`, `Src_Longitude`, `Dest_Latitude`, `Dest_Longitude`) VALUES
(8, 10.3174679, 123.9019049, 10.327938493735221, 123.90679690986872),
(3, 10.3174696, 123.9019048, 10.328531552496838, 123.90671107918024),
(7, 10.3174909, 123.901898, 10.328130132979084, 123.90644654631613),
(9, 10.3174934, 123.9019428, 10.328639081384994, 123.90777926892042),
(2, 10.3175224, 123.9019064, 10.328414458113631, 123.9063687622547),
(6, 10.3175479, 123.9019046, 10.278277569690143, 123.97441539913417),
(5, 10.3175562, 123.9019738, 10.278277569690143, 123.97441539913417),
(4, 10.3175747, 123.9019752, 10.328531552496838, 123.90671107918024);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `Driver_License` varchar(30) NOT NULL,
  `Driver_Name` varchar(50) NOT NULL,
  `Driver_No` bigint(11) unsigned zerofill NOT NULL,
  PRIMARY KEY (`Driver_License`),
  UNIQUE KEY `Driver_No` (`Driver_No`),
  KEY `Driver_Name` (`Driver_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`Driver_License`, `Driver_Name`, `Driver_No`) VALUES
('G14-11-000300', 'Stanley Yu', 09225011358),
('R15-21-000200', 'Rick Aban', 09435413846);

-- --------------------------------------------------------

--
-- Table structure for table `taxi`
--

CREATE TABLE IF NOT EXISTS `taxi` (
  `Plate_No` varchar(10) NOT NULL,
  `Body_No` varchar(30) NOT NULL,
  `Taxi_Company` varchar(30) NOT NULL,
  `Taxi_Description` varchar(50) NOT NULL,
  `Taxi_IP` varchar(15) NOT NULL,
  `Taxi_Latitude` double NOT NULL,
  `Taxi_Longitude` double NOT NULL,
  `Vacancy_Status` char(1) NOT NULL,
  `Driver_License` varchar(30) NOT NULL,
  PRIMARY KEY (`Plate_No`),
  UNIQUE KEY `Body_No` (`Body_No`),
  KEY `Plate_No` (`Plate_No`,`Body_No`,`Taxi_Description`,`Taxi_Latitude`,`Taxi_Longitude`),
  KEY `Taxi_IP` (`Taxi_IP`),
  KEY `Vacancy_Status` (`Vacancy_Status`),
  KEY `Taxi_Company` (`Taxi_Company`),
  KEY `Driver_License_2` (`Driver_License`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Contains the data of taxi vehicles';

--
-- Dumping data for table `taxi`
--

INSERT INTO `taxi` (`Plate_No`, `Body_No`, `Taxi_Company`, `Taxi_Description`, `Taxi_IP`, `Taxi_Latitude`, `Taxi_Longitude`, `Vacancy_Status`, `Driver_License`) VALUES
('FML 182', 'ABC-DEF-GHI', 'EE Taxi', 'Ferrari 458 Spider', '', 0, 0, '', ''),
('WTF 777', 'XXX-XXX-XXX', 'EE Taxi', 'Lamborghini Gallardo LP 550-2', '', 0, 0, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

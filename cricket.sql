-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 08:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cricket`
--

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `CoachID` int(10) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `YearsActive` int(10) DEFAULT NULL,
  `Salary` int(10) DEFAULT NULL,
  `Nationality` varchar(50) DEFAULT NULL,
  `DOA` varchar(50) DEFAULT NULL,
  `DOR` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`CoachID`, `Status`, `FirstName`, `LastName`, `Email`, `YearsActive`, `Salary`, `Nationality`, `DOA`, `DOR`) VALUES
(1, 'Leaving', 'Rashid', 'Iqbal', 'rashida', 9, 1000000, 'German', '24th Feb 2013', '12th June 2023');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `MatchNo` int(10) NOT NULL,
  `Date` varchar(50) DEFAULT NULL,
  `Time` varchar(50) DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  `OpponentName` varchar(50) DEFAULT NULL,
  `MatchType` varchar(50) NOT NULL,
  `MatchStatus` varchar(50) NOT NULL,
  `Result` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`MatchNo`, `Date`, `Time`, `Location`, `OpponentName`, `MatchType`, `MatchStatus`, `Result`) VALUES
(1, '23rd Febuary 2024', '10AM', 'Brisbane', 'Australia', 'Test', 'Happening', 'TBD'),
(2, '2023-06-29', '21:22', 'Haryana', 'India', 'ODI', 'Ongoing', 'TBD');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `PlayerID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Age` int(10) NOT NULL,
  `Position` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`PlayerID`, `Name`, `Type`, `Age`, `Position`) VALUES
(1, 'Hamza Nawaz', 'Batsman', 21, 1),
(2, 'Malik', 'Batsman', 19, 8);

-- --------------------------------------------------------

--
-- Table structure for table `playerstats`
--

CREATE TABLE `playerstats` (
  `TotalRuns` int(10) DEFAULT NULL,
  `FiftyHundreds` varchar(50) DEFAULT NULL,
  `HS` int(10) DEFAULT NULL,
  `BF` int(10) DEFAULT NULL,
  `Average` float DEFAULT NULL,
  `NO` int(10) DEFAULT NULL,
  `Maidens` int(10) DEFAULT NULL,
  `BB` varchar(50) DEFAULT NULL,
  `Matches` int(10) NOT NULL,
  `Overs` float DEFAULT NULL,
  `Balls` int(10) DEFAULT NULL,
  `Wickets` int(10) DEFAULT NULL,
  `RunsConceded` int(10) DEFAULT NULL,
  `PlayerID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playerstats`
--

INSERT INTO `playerstats` (`TotalRuns`, `FiftyHundreds`, `HS`, `BF`, `Average`, `NO`, `Maidens`, `BB`, `Matches`, `Overs`, `Balls`, `Wickets`, `RunsConceded`, `PlayerID`) VALUES
(9000, '9000', 9000, 9000, 9000, 9000, 9000, '9000', 9000, 9, 9, 9, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `TeamName` varchar(50) NOT NULL,
  `TeamCaptain` varchar(50) NOT NULL,
  `Wins` int(10) NOT NULL,
  `Losses` int(10) NOT NULL,
  `Ranking` int(10) NOT NULL,
  `HomeGround` varchar(50) NOT NULL,
  `Logo` blob NOT NULL,
  `PlayerID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`TeamName`, `TeamCaptain`, `Wins`, `Losses`, `Ranking`, `HomeGround`, `Logo`, `PlayerID`) VALUES
('Hello', 'Majid Khan', 5, 1, 1, 'Hrna', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`CoachID`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`MatchNo`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`PlayerID`);

--
-- Indexes for table `playerstats`
--
ALTER TABLE `playerstats`
  ADD KEY `PlayerID` (`PlayerID`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD KEY `PlayerID` (`PlayerID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `playerstats`
--
ALTER TABLE `playerstats`
  ADD CONSTRAINT `playerstats_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`);

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

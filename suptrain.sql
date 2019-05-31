-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 12:31 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suptrain`
--

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `organizationID` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `contactperson` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`organizationID`, `name`, `address`, `contactperson`, `email`, `phone`) VALUES
(1, 'Health Care Center, Tornio', 'Sairaalakatu 1, 95400 TORNIO', 'Taina Taitava', 'taina.taitava@tornio.fi', '+358765457'),
(2, 'Terveystalo, Tornio', 'Rajalla Kauppakeskus, Länsiranta 10, 95400 Tornio\r\n', 'Aino Ainoa', 'aino.ainoa@terveystalo.fi', '+35876544255'),
(3, 'Health Care Center, Keminmaa', 'Väylätie 2, 94400 KEMINMAA', 'Paula Paavola', 'paula.paavola@keminmaa.fi', '+35950998877');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `practicaltrainingdone` tinyint(1) NOT NULL DEFAULT '0',
  `groupname` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `imagestudent` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `firstname`, `lastname`, `email`, `phone`, `practicaltrainingdone`, `groupname`, `password`, `imagestudent`) VALUES
('A123444', 'John', 'Doe', 'john.doe@edu.lapinamk.fi', '+358909873', 0, 'T42D17S', '', ''),
('A123445', 'Erja', 'Lyytinen', 'erja.lyytinen@edu.lapinamk.fi', '+35844223344', 1, 'T42D17S', '', ''),
('A123447', 'Albert', 'Järvinen', 'albert.jarvinen@edu.lapinamk.fi', '+358505050', 1, 'T42D17S', '', ''),
('A123449', 'Hilkka', 'Kallio', 'hilkka.kallio@edu.lapinamk.fi', '+35811221122', 1, 'T42D17S', '', ''),
('A1234567', 'George', 'Harrison', 'george.harrison@edu.lapinamk.fi', '+35840987654', 0, 'T42D17S', '', ''),
('T123321', 'Hasse', 'Walli', 'hasse.walli@edu.lapinamk.fi', '+35841223344', 1, 'A42D17S', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `supervisorID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`supervisorID`, `firstname`, `lastname`, `email`, `phone`, `password`, `image`) VALUES
(1, 'Johanna', 'Vuokila', 'johanna.vuokila@lapinamk.fi', '+35812346', '', ''),
(2, 'Yrjö', 'Koskenniemi', 'yrjo.koskenniemi@lapinamk.fi', '+3583109230', '', ''),
(3, 'Juha', 'Orre', 'juha.orre@lapinamk.fi', '+358323123', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `supervisorhours`
--

CREATE TABLE `supervisorhours` (
  `supervisorhoursID` int(11) NOT NULL,
  `supervisorID` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `hours` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisorhours`
--

INSERT INTO `supervisorhours` (`supervisorhoursID`, `supervisorID`, `year`, `hours`) VALUES
(1, 1, 2018, 100),
(2, 1, 2019, 150),
(3, 2, 2018, 50),
(4, 1, 2017, 70),
(5, 2, 2017, 40),
(6, 2, 2019, 60),
(7, 3, 2018, 20);

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `trainingID` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `studentID` varchar(10) NOT NULL,
  `supervisorID` int(11) NOT NULL,
  `organizationID` int(11) NOT NULL,
  `supervisorhours` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`trainingID`, `start`, `end`, `studentID`, `supervisorID`, `organizationID`, `supervisorhours`) VALUES
(1, '2018-11-11', '2018-12-22', 'A1234567', 1, 1, 15),
(2, '2018-12-30', '2019-01-18', 'A1234567', 1, 2, 10),
(3, '2017-12-30', '2018-01-18', 'A1234567', 1, 1, 20),
(4, '2018-11-04', '2018-11-30', 'A123444', 2, 2, 30),
(6, '2018-09-30', '2018-10-31', 'A123447', 2, 3, 10),
(7, '2018-07-11', '2018-12-30', 'A123449', 1, 1, 10),
(8, '2017-12-30', '2018-02-02', 'A123449', 2, 2, 10),
(9, '2017-03-04', '2017-06-06', 'A123449', 1, 1, 10),
(10, '2018-12-13', '2018-12-28', 'A123447', 1, 3, 15),
(11, '2018-12-06', '2019-01-31', 'A123445', 2, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `email`, `password`, `firstname`, `lastname`, `role`) VALUES
(1, 'dustin.ngo2906@gmail.com', '$2y$10$d3bFyIx3QBM86dBlpPNVdOHfsnS1dKLFhYCHEbPBL859wG3nYOLBS', 'Duc', 'Ngo', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`organizationID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`supervisorID`);

--
-- Indexes for table `supervisorhours`
--
ALTER TABLE `supervisorhours`
  ADD PRIMARY KEY (`supervisorhoursID`),
  ADD KEY `supervisorID` (`supervisorID`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`trainingID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `organizationID` (`organizationID`),
  ADD KEY `supervisorID` (`supervisorID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `organizationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `supervisorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supervisorhours`
--
ALTER TABLE `supervisorhours`
  MODIFY `supervisorhoursID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `trainingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `supervisorhours`
--
ALTER TABLE `supervisorhours`
  ADD CONSTRAINT `supervisorhours_ibfk_1` FOREIGN KEY (`supervisorID`) REFERENCES `supervisor` (`supervisorID`);

--
-- Constraints for table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `training_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`),
  ADD CONSTRAINT `training_ibfk_2` FOREIGN KEY (`organizationID`) REFERENCES `organization` (`organizationID`),
  ADD CONSTRAINT `training_ibfk_3` FOREIGN KEY (`supervisorID`) REFERENCES `supervisor` (`supervisorID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2019 at 02:00 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcomplaintlist`
--

CREATE TABLE `tblcomplaintlist` (
  `IDno` int(11) NOT NULL,
  `Description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomplaintlist`
--

INSERT INTO `tblcomplaintlist` (`IDno`, `Description`) VALUES
(0, 'Complaint Error 1'),
(0, 'Complaint Error 2'),
(0, 'Complaint Error 3'),
(0, 'Complaint Error 4'),
(0, 'Complaint Error 5'),
(0, 'Hardware Error'),
(0, 'Software Error');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `Idno` int(11) NOT NULL,
  `SubmitBy` varchar(50) DEFAULT NULL,
  `SubmitDate` varchar(50) DEFAULT '',
  `TicNo` varchar(50) NOT NULL,
  `Summary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `IDno` int(6) UNSIGNED ZEROFILL NOT NULL,
  `c_complaint` text NOT NULL,
  `c_type` varchar(50) NOT NULL,
  `c_level` varchar(50) NOT NULL,
  `c_rcvby` varchar(50) NOT NULL,
  `c_RcvDate` datetime NOT NULL,
  `c_atmID` varchar(50) NOT NULL,
  `c_repby` varchar(50) NOT NULL,
  `c_RepVia` varchar(50) NOT NULL,
  `c_Priority` varchar(50) NOT NULL,
  `c_PersonAssign` varchar(50) NOT NULL,
  `c_AssignDate` datetime NOT NULL,
  `c_Status` varchar(50) NOT NULL,
  `c_Target` date NOT NULL,
  `Modby` varchar(50) NOT NULL,
  `ModDate` datetime NOT NULL,
  `LastMod` varchar(50) NOT NULL,
  `LasDate` datetime NOT NULL,
  `c_diagnosis` text NOT NULL,
  `c_action` text NOT NULL,
  `c_response` datetime NOT NULL,
  `c_resolution` datetime NOT NULL,
  `c_errCode` varchar(50) NOT NULL,
  `c_chest` varchar(50) NOT NULL,
  `c_Screen` varchar(50) NOT NULL,
  `Dispatchby` varchar(50) NOT NULL,
  `Dispatchdate` datetime NOT NULL,
  `bypass` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_errcode`
--

CREATE TABLE `tbl_errcode` (
  `ErrCode` varchar(10) NOT NULL,
  `ErrDesc` text NOT NULL,
  `ErrAction` text NOT NULL,
  `Reserve` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loc`
--

CREATE TABLE `tbl_loc` (
  `Terminal_ID` varchar(20) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `Site` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Contact_No` varchar(50) NOT NULL,
  `Contact_Person` varchar(100) NOT NULL,
  `Location` varchar(50) NOT NULL,
  `Brand` varchar(50) NOT NULL,
  `LocSLA` varchar(50) NOT NULL,
  `SLA` varchar(50) NOT NULL,
  `Opening` time NOT NULL,
  `Closing` time NOT NULL,
  `VIP` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_loc`
--

INSERT INTO `tbl_loc` (`Terminal_ID`, `Model`, `Site`, `Address`, `City`, `Category`, `Contact_No`, `Contact_Person`, `Location`, `Brand`, `LocSLA`, `SLA`, `Opening`, `Closing`, `VIP`) VALUES
('0000', 'Bank_1', 'Site_1', 'Address_1', 'City_1', '', '', '', 'Offsite', 'Brand_1', 'Metro Manila', '2', '08:00:00', '17:00:00', ''),
('0001', 'Bank_2', 'Site_2', 'Address_2', 'City_2', '', '', '', 'Offsite', 'Brand_2', 'Metro Manila', '2', '07:00:00', '16:00:00', ''),
('0002', 'Bank_3', 'Site_3', 'Address_3', 'City_3', '', '', '', 'Onsite', 'Brand_2', 'Metro Manila', '2', '09:00:00', '18:00:00', ''),
('0003', 'Bank_4', 'Site_4', 'Address_4', 'City_4', '', '', '', 'Offsite', 'Brand_4', 'Province - South', '3', '08:30:00', '17:30:00', ''),
('0004', 'Bank_5', 'Site_5', 'Address_5', 'City_5', '', '', '', 'Offsite', 'Brand_5', 'Province - North', '3', '08:00:00', '17:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `Idno` int(6) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`Idno`, `Name`) VALUES
(1, 'ATM Hardware'),
(2, 'ATM Software'),
(3, 'TELCOM'),
(4, 'Cashout');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `IDno` int(3) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `pass_word` varchar(255) NOT NULL,
  `email_add` varchar(50) NOT NULL,
  `user_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`IDno`, `user_name`, `full_name`, `pass_word`, `email_add`, `user_level`) VALUES
(49, 'admin', 'Alvin Raquem', '$2y$12$Nmg1dDRTV0REWTBmSXFEVOnt.AnFBErq4RxyLHx3W1Pg34QfjT4xS', 'raquem.alvin@gmail.com', 'admin'),
(50, 'alvinuser', 'Alvin Raquem', '$2y$12$TVpNN3N6TWFqSHI4eWRHeOI11tgd1Aam1p79J6suZeRzWy991xfq.', 'raquem.alvin@gmail.com', 'user'),
(51, 'alvinteller', 'Alvin Raquem', '$2y$12$bVRXdXBiVloweXNCck5Hb.7VIqpv0PCnau6DdtVeqWCWYUQB/rjyC', 'raquem.alvin@gmail.com', 'teller'),
(52, 'alvintech', 'Alvin Raquem', '$2y$12$c3gwUjdOVTIrbGdwVkM5aOu6D3R75U3fXCHpi2J3tEPELHo3Lz3xS', 'raquem.alvin@gmail.com', 'technician');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`Idno`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`IDno`);

--
-- Indexes for table `tbl_loc`
--
ALTER TABLE `tbl_loc`
  ADD PRIMARY KEY (`Terminal_ID`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`Idno`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`IDno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `Idno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `IDno` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `Idno` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `IDno` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

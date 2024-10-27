-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 08:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcatalog`
--

CREATE TABLE `tblcatalog` (
  `p_cid` int(128) NOT NULL,
  `p_cname` varchar(255) NOT NULL,
  `p_csemester` varchar(128) NOT NULL,
  `p_cseats` int(16) NOT NULL,
  `p_cfilled` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcatalog`
--

INSERT INTO `tblcatalog` (`p_cid`, `p_cname`, `p_csemester`, `p_cseats`, `p_cfilled`) VALUES
(1, 'Algebra 101', 'Fall', 30, 0),
(2, 'Algebra 101', 'Spring', 30, 0),
(3, 'Writing I', 'Fall', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblenrollment`
--

CREATE TABLE `tblenrollment` (
  `p_id` int(128) NOT NULL,
  `p_cid` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `p_id` int(128) NOT NULL,
  `p_email` varchar(255) NOT NULL,
  `p_password` varchar(16) NOT NULL,
  `p_fname` varchar(16) NOT NULL,
  `p_lname` varchar(16) NOT NULL,
  `p_address` varchar(255) NOT NULL,
  `p_phone` varchar(16) NOT NULL,
  `p_role` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`p_id`, `p_email`, `p_password`, `p_fname`, `p_lname`, `p_address`, `p_phone`, `p_role`) VALUES
(7, 'bmaggsjr@comcast.net', 'passme', 'William', 'Maggs', '7008 NE 57th Street', '3602819999', 'admin'),
(8, 'bmaggsjr@comcast.net', 'passme', 'William', 'Maggs', '7008 NE 57th Street', '3602819999', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `twaitlist`
--

CREATE TABLE `twaitlist` (
  `p_id` int(128) NOT NULL,
  `p_cid` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcatalog`
--
ALTER TABLE `tblcatalog`
  ADD PRIMARY KEY (`p_cid`);

--
-- Indexes for table `tblenrollment`
--
ALTER TABLE `tblenrollment`
  ADD KEY `p_id` (`p_id`),
  ADD KEY `p_cid` (`p_cid`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `twaitlist`
--
ALTER TABLE `twaitlist`
  ADD KEY `p_id` (`p_id`),
  ADD KEY `p_cid` (`p_cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcatalog`
--
ALTER TABLE `tblcatalog`
  MODIFY `p_cid` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `p_id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblenrollment`
--
ALTER TABLE `tblenrollment`
  ADD CONSTRAINT `tblenrollment_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `tbluser` (`p_id`),
  ADD CONSTRAINT `tblenrollment_ibfk_2` FOREIGN KEY (`p_cid`) REFERENCES `tblcatalog` (`p_cid`);

--
-- Constraints for table `twaitlist`
--
ALTER TABLE `twaitlist`
  ADD CONSTRAINT `twaitlist_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `tbluser` (`p_id`),
  ADD CONSTRAINT `twaitlist_ibfk_2` FOREIGN KEY (`p_cid`) REFERENCES `tblcatalog` (`p_cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

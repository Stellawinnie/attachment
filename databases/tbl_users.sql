-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2017 at 02:11 PM
-- Server version: 5.7.15
-- PHP Version: 7.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gcitest`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userPhone` int(12) DEFAULT NULL,
  `loginType` varchar(100) DEFAULT 'user',
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `users` (`userID`, `userName`, `userEmail`, `userPass`, `userPhone`, `loginType`,  `userStatus`, `tokenCode`) VALUES
(1, 'beja', 'beja.emmanuel@yahoo.com', '202cb962ac59075b964b07152d234b70', 712121212, 'admin', 'Y', '365f7971f66f9795f2d83733fb5b5c4e'),
(10, 'Erick', 'erickmwexh@gmail.com', '25d55ad283aa400af464c76d713c07ad', 712121212, 'user', 'Y', 'fc992b2e5879c5b90906b4dc4feb1ba3'),
(15, 'Kathryn', 'kathiekim95@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 754321456, 'user', 'Y', '4afacd16d7ccb34049c699f4c60269cf'),
(16, 'Harison ', 'gitau.h.mwangi@gmail.com', '79ea9d0859596035e7ca7a35a455e2ef', 701247794, 'user', 'Y', '9487dd70d39df0f7f432b22454ba6f25'),
(17, 'Emmanuel', 'beja.emmanuel@gmail.com', '202cb962ac59075b964b07152d234b70', 712991415, 'company', 'Y', '565991da4b857d281b1d73766e91c1f6'),
(18, 'Felex', 'felokemboi10@gmail.com', '07a8d34bcc99e08ff30f583927d1833d', 722116291, 'company', 'Y', '9066728a477fdbcd90d42120707d924e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

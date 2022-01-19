-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2021 at 06:04 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptpedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `exc_limit`
--

CREATE TABLE `exc_limit` (
  `limit_id` int(5) NOT NULL,
  `frm` int(5) NOT NULL,
  `t` int(5) NOT NULL,
  `rebook_limit` int(5) NOT NULL,
  `submitter` int(32) NOT NULL,
  `submit_timestamp` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exc_limit`
--

INSERT INTO `exc_limit` (`limit_id`, `frm`, `t`, `rebook_limit`, `submitter`, `submit_timestamp`) VALUES
(28, 6, 10, 1, 152, 1628004117),
(29, 10, 14, 2, 152, 1628004127),
(30, 14, 18, 2, 152, 1628004138),
(31, 18, 22, 4, 152, 1628004150),
(32, 22, 26, 4, 152, 1628004162),
(33, 26, 30, 6, 152, 1628004190),
(34, 30, 34, 6, 152, 1628004201),
(35, 34, 38, 8, 152, 1628004230),
(36, 38, 42, 8, 152, 1628004252),
(37, 42, 46, 10, 152, 1628004285),
(38, 46, 50, 10, 152, 1628004300),
(39, 50, 54, 12, 152, 1628004316),
(40, 54, 58, 12, 152, 1628004333),
(41, 58, 62, 14, 152, 1628004448),
(42, 62, 66, 14, 152, 1628004504),
(43, 66, 70, 16, 152, 1628004520),
(44, 70, 74, 16, 152, 1628004606),
(45, 74, 78, 18, 152, 1628004684),
(46, 78, 82, 18, 152, 1628004695);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exc_limit`
--
ALTER TABLE `exc_limit`
  ADD PRIMARY KEY (`limit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exc_limit`
--
ALTER TABLE `exc_limit`
  MODIFY `limit_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

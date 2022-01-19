-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2021 at 12:50 AM
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
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(50) NOT NULL,
  `note` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `submitter` int(32) DEFAULT NULL,
  `submit_timestamp` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `note`, `submitter`, `submit_timestamp`) VALUES
(1, ' has spent (23432) L.E. for(werewr)', 325, 1630880117),
(2, ' has spent (23432) L.E. for(werewr)', 325, 1630880117),
(3, ' has spent (23432) L.E. for(werewr)', 325, 1630880117),
(4, ' has spent (300) L.E. for(حساب شهر نوفمبر)', 325, 1630881195),
(5, ' has spent (300) L.E. for(حساب شهر نوفمبر)', 325, 1630881195),
(6, ' has spent (300) L.E. for(حساب شهر نوفمبر)', 325, 1630881195),
(7, ' has spent (300) L.E. for(حساب شهر نوفمبر)', 325, 1630881195),
(8, ' has spent (300) L.E. for(حساب شهر نوفمبر)', 325, 1630881195),
(9, 'Ibrahim Salem has spent (300) L.E. for(حساب شهر نوفمبر)', 325, 1630881195);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

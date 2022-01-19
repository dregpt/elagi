-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2021 at 01:31 PM
-- Server version: 5.7.35-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.8

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
-- Table structure for table `prv`
--

CREATE TABLE `prv` (
  `prv_id` int(3) NOT NULL,
  `prv_nm` varchar(200) NOT NULL,
  `prv_cd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prv`
--

INSERT INTO `prv` (`prv_id`, `prv_nm`, `prv_cd`) VALUES
(1, 'Administrator', 'Admin'),
(2, 'Moderator', 'Mdr'),
(3, 'Secretary', 'Sec'),
(4, 'Therapist', 'Thrp'),
(5, 'Case', 'Case'),
(6, 'Worker', 'Wrkr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prv`
--
ALTER TABLE `prv`
  ADD PRIMARY KEY (`prv_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

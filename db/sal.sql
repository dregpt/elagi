-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2021 at 07:21 PM
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
-- Table structure for table `sal`
--

CREATE TABLE `sal` (
  `usr_id` int(32) NOT NULL,
  `sal` int(12) NOT NULL DEFAULT 0,
  `reg_bonus` int(12) NOT NULL DEFAULT 0,
  `bonus` int(12) NOT NULL DEFAULT 0,
  `deduction` int(12) NOT NULL DEFAULT 0,
  `perc_revnue` int(12) NOT NULL DEFAULT 0,
  `taken_cost` int(12) NOT NULL DEFAULT 0,
  `taken_perc` int(12) NOT NULL DEFAULT 0,
  `taken_bonus` int(12) NOT NULL DEFAULT 0,
  `submit_timestamp` int(64) DEFAULT NULL,
  `submitter` int(32) DEFAULT NULL,
  `srv_percent` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `taken_services` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sal`
--

INSERT INTO `sal` (`usr_id`, `sal`, `reg_bonus`, `bonus`, `deduction`, `perc_revnue`, `taken_cost`, `taken_perc`, `taken_bonus`, `submit_timestamp`, `submitter`, `srv_percent`, `taken_services`) VALUES
(46, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(218, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(219, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(220, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(221, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(222, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(223, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(224, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(225, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(226, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(227, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(254, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(255, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(256, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(257, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(258, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(275, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(276, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(277, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(278, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(279, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(280, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(281, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(282, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(283, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(284, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(285, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(287, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(293, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(305, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(306, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(311, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(314, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(315, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(325, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(326, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(327, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(343, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(347, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(348, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(349, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(350, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(353, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(355, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(356, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sal`
--
ALTER TABLE `sal`
  ADD PRIMARY KEY (`usr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

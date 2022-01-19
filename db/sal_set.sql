-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2021 at 01:48 AM
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
-- Table structure for table `sal_set`
--

CREATE TABLE `sal_set` (
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
  `rat_by` int(2) NOT NULL DEFAULT 0,
  `srv_percent` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '0',
  `taken_services` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sal_set`
--

INSERT INTO `sal_set` (`usr_id`, `sal`, `reg_bonus`, `bonus`, `deduction`, `perc_revnue`, `taken_cost`, `taken_perc`, `taken_bonus`, `submit_timestamp`, `submitter`, `rat_by`, `srv_percent`, `taken_services`) VALUES
(0, 1600, 0, 0, 0, 0, 0, 0, 0, 1631481169, 325, 0, '0', '0'),
(46, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(218, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(219, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(220, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(221, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(222, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(223, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(224, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(225, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(226, 1600, 5, 0, 0, 0, 0, 0, 0, 1631489736, 325, 1, 'PT6,P11,SS1', 'AD'),
(227, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(254, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(255, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(256, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(257, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(258, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(275, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(276, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(277, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(278, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(279, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(280, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(281, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(282, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(283, 0, 0, 0, 0, 0, 0, 0, 0, 1631490024, 325, 0, 'PT1,P11', 'AD'),
(284, 0, 0, 0, 0, 0, 0, 0, 0, 1631489748, 325, 0, 'PT1,P12', '0'),
(285, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(287, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(305, 0, 0, 0, 0, 0, 0, 0, 0, 1631489120, 325, 1, '0', '0'),
(311, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(314, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(315, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(325, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(326, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(327, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(343, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0'),
(348, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sal_set`
--
ALTER TABLE `sal_set`
  ADD PRIMARY KEY (`usr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

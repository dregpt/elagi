-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2021 at 01:10 AM
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
-- Table structure for table `trig`
--

CREATE TABLE `trig` (
  `trig_id` int(11) NOT NULL,
  `trig_nm` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bonus` int(9) DEFAULT 0,
  `penalty` int(9) DEFAULT 0,
  `thr_min` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `thr_max` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `trig_reset` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trig_act` int(3) DEFAULT 0,
  `submit_timestamp` int(64) DEFAULT NULL,
  `submitter` int(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trig`
--

INSERT INTO `trig` (`trig_id`, `trig_nm`, `detail`, `bonus`, `penalty`, `thr_min`, `thr_max`, `trig_reset`, `trig_act`, `submit_timestamp`, `submitter`) VALUES
(7, 'Bonus 1% for less than 3 times per month', '1%  bonus from basic salary when behavior not happened more than 2 times a month ', 1, 0, '0', '2', 'month', 0, 1631937086, 325),
(8, 'Bonus 4% for no behavior per month', '4% bonus from basic salary when behavior not happened within a month ', 4, 0, '0', '0', 'month', 0, 1631937405, 325),
(9, 'Penalty 4% for more than 14 times per year', 'Deduction of a day work salary per month when a behavior repeated more than 14 times per year. ', 0, 4, '14', 'unlimited', 'year', 0, 1632005863, 325),
(10, 'Penalty 2% for more than 2 times', ' Deduction of 2% from the basic salary (half day work salary) if a behavior repeated more than 2 times a month', 0, 2, '2', 'unlimited', 'month', 0, 1631937208, 325),
(11, '30 fine for incidence', ' Penalty of 30 L.E. for behavior incidence', 0, 30, '1', 'unlimited', 'month', 1, 1631938030, 325);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trig`
--
ALTER TABLE `trig`
  ADD PRIMARY KEY (`trig_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trig`
--
ALTER TABLE `trig`
  MODIFY `trig_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

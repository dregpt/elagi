-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2021 at 01:09 AM
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
-- Table structure for table `behaviors`
--

CREATE TABLE `behaviors` (
  `behav_id` int(32) NOT NULL,
  `behav_nm` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trigs` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `submit_timestamp` int(64) DEFAULT NULL,
  `submitter` int(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `behaviors`
--

INSERT INTO `behaviors` (`behav_id`, `behav_nm`, `detail`, `trigs`, `submit_timestamp`, `submitter`) VALUES
(1, 'Uniform penalty', ' 30 L.E fine for not wearing uniform for one time.', '11', 1632002244, 325),
(6, 'Delay with excuse', 'Delay with filling excuse form and tilling the manager. if this type of delay not more than two times per month , the worker will get 1% bonus from his basic month salary.', '7', 1632005332, 325),
(7, 'Regular day-off', ' Regular day-off with filling day-off form before its date by at least one day. the allowed times for this behavior is not more than two times per month and 14 days per year. 4% bonus form basic month salary is granted when this behavior is not happened at the same month. a 4% penalty from the basic salary is deducted every time the behavior happens more than 14 times per year.', '8,9', 1632005896, 325);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `behaviors`
--
ALTER TABLE `behaviors`
  ADD PRIMARY KEY (`behav_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `behaviors`
--
ALTER TABLE `behaviors`
  MODIFY `behav_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2021 at 01:55 AM
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
-- Table structure for table `rat_categ`
--

CREATE TABLE `rat_categ` (
  `rat_id` int(5) NOT NULL,
  `rat_nm` varchar(50) DEFAULT NULL,
  `rat_cd` varchar(10) DEFAULT NULL,
  `rat` int(6) DEFAULT 0,
  `detail` varchar(1024) DEFAULT NULL,
  `submitter` int(32) DEFAULT NULL,
  `submit_timestamp` int(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rat_categ`
--

INSERT INTO `rat_categ` (`rat_id`, `rat_nm`, `rat_cd`, `rat`, `detail`, `submitter`, `submit_timestamp`) VALUES
(13, 'E', 'E', 30, '                                - Physical therapy trainee with at least 1 year experience in pediatric rehabilitation.<br />\r\n- Graduated with more than 6 months experience in pediatric rehabilitation.<br />\r\n- At least one year experience at Elagi center.', 325, 1631749621),
(12, 'F', 'F', 27, ' - Student trainee &gt; 3 months.', 325, 1631742694),
(11, 'G', 'G', 25, '                                - Student trainee &lt; 3 months.', 325, 1631749721),
(14, 'D', 'D', 33, ' - Graduated with more than one year experience in pediatric rehabilitation.<br />\r\n- At least two years experience at Elagi center.', 325, 1631742947),
(15, 'C', 'C', 35, ' - Graduated one year after PT trainee year with at least one year experience in pediatric rehabilitation.<br />\r\n- At least 3 years experience at Elagi center.', 325, 1631743118),
(16, 'B', 'B', 38, '- Graduated 2 years after PT trainee years with at least 2 years in pediatric rehabilitation.<br />\r\n- At least 4 years experience at Elagi center.', 325, 1631743294),
(17, 'A', 'A', 40, '- Graduated 5 years after PT trainee year with at least 3 years experience in pediatric rehabilitation.<br />\r\n- Has Ms.c. of physical therapy with at least 3 years experience in pediatric rehabilitation.<br />\r\n- At least 6 years experience at Elagi center or more. ', 325, 1631743462);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rat_categ`
--
ALTER TABLE `rat_categ`
  ADD PRIMARY KEY (`rat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rat_categ`
--
ALTER TABLE `rat_categ`
  MODIFY `rat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

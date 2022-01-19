-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 04, 2021 at 07:41 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(8) NOT NULL AUTO_INCREMENT,
  `usrnm` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `eml` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `pswrd` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `frst_nm` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lst_nm` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `actv` int(1) NOT NULL DEFAULT 0,
  `prv` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`usr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usrnm`, `eml`, `pswrd`, `frst_nm`, `lst_nm`, `actv`, `prv`) VALUES
(1, 'dregpt', 'dregpt@gmail.com', 'password', 'Ibrahim', 'Salem', 0, 1),
(2, 'sec', 'sec@gmial.com', 'password', 'Menna', 'Elsayyed', 0, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

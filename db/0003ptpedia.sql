-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2021 at 09:33 PM
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
(3, 'Therapist', 'Thrp'),
(4, 'Worker', 'Wrkr'),
(5, 'Case', 'Case');

-- --------------------------------------------------------

--
-- Table structure for table `rat_categ`
--

CREATE TABLE `rat_categ` (
  `rat_catg_id` int(3) NOT NULL,
  `rat_catg_nm` varchar(50) NOT NULL,
  `rat` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rat_categ`
--

INSERT INTO `rat_categ` (`rat_catg_id`, `rat_catg_nm`, `rat`) VALUES
(1, 'F = 25', 25),
(2, 'E = 27', 27),
(3, 'D = 30', 30),
(4, 'C = 33', 33),
(5, 'B = 35', 35),
(6, 'A = 38', 38);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `srv_id` int(11) NOT NULL,
  `srv_nm` varchar(200) NOT NULL,
  `srv_cd` varchar(5) NOT NULL,
  `srv_hr` varchar(5) NOT NULL,
  `srv_sngl_price` int(6) NOT NULL,
  `srv_rglr_price` int(6) NOT NULL,
  `excuse_fn` int(5) NOT NULL,
  `absence_fn` int(5) NOT NULL,
  `srv_ordr` int(5) NOT NULL,
  `submitter` int(15) NOT NULL,
  `submit_timestamp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ses`
--

CREATE TABLE `ses` (
  `ses_id` int(32) NOT NULL,
  `cas_id` int(32) NOT NULL,
  `thrp_id` int(32) NOT NULL,
  `srv_cd` varchar(5) NOT NULL,
  `ses_day` varchar(32) NOT NULL,
  `ses_rf_tm` varchar(100) DEFAULT NULL,
  `ses_rc_frm` int(100) DEFAULT NULL,
  `ses_rc_to` int(100) DEFAULT NULL,
  `rebook_call_tm` int(100) DEFAULT NULL,
  `taken` int(2) NOT NULL DEFAULT 0,
  `excuse` int(2) NOT NULL DEFAULT 0,
  `absence` int(2) NOT NULL DEFAULT 0,
  `cancel` int(2) NOT NULL DEFAULT 0,
  `rebook` int(2) NOT NULL DEFAULT 0,
  `nt` int(2) DEFAULT NULL,
  `note` varchar(1024) DEFAULT NULL,
  `submitter` int(23) NOT NULL,
  `submit_timestamp` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seset`
--

CREATE TABLE `seset` (
  `seset_id` int(32) NOT NULL,
  `case_id` int(32) NOT NULL,
  `submitter` int(32) NOT NULL,
  `submit_timestamp` int(15) NOT NULL,
  `PT_sngl_price` int(5) NOT NULL DEFAULT 150,
  `PT_rglr_price` int(5) NOT NULL DEFAULT 120,
  `PT` int(5) NOT NULL DEFAULT 0,
  `PT_tm_Sat` varchar(15) DEFAULT NULL,
  `PT_tm_Sun` varchar(15) DEFAULT NULL,
  `PT_tm_Mon` varchar(15) DEFAULT NULL,
  `PT_tm_Tue` varchar(15) DEFAULT NULL,
  `PT_tm_Wed` varchar(15) DEFAULT NULL,
  `PT_tm_Thu` varchar(15) DEFAULT NULL,
  `PT_tm_Fri` varchar(15) DEFAULT NULL,
  `SS_sngl_price` int(5) NOT NULL DEFAULT 150,
  `SS_rglr_price` int(5) NOT NULL DEFAULT 120,
  `SS` int(5) NOT NULL DEFAULT 0,
  `SS_tm_Sat` varchar(15) DEFAULT NULL,
  `SS_tm_Sun` varchar(15) DEFAULT NULL,
  `SS_tm_Mon` varchar(15) DEFAULT NULL,
  `SS_tm_Tue` varchar(15) DEFAULT NULL,
  `SS_tm_Wed` varchar(15) DEFAULT NULL,
  `SS_tm_Thu` varchar(15) DEFAULT NULL,
  `SS_tm_Fri` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `tm_id` int(11) NOT NULL,
  `tm_val` varchar(30) DEFAULT NULL,
  `tm_lbl` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `times`
--

INSERT INTO `times` (`tm_id`, `tm_val`, `tm_lbl`) VALUES
(14, '00:00', NULL),
(15, '08:00', '8:00     AM'),
(16, '08:30', '8:30 AM'),
(17, '09:00', '9:00 AM'),
(18, '09:30', '9:30 AM'),
(19, '10:00', '10:00 AM'),
(20, '10:30', '10:30 AM'),
(21, '11:00', '11:00 AM'),
(22, '11:30', '11:30 AM'),
(23, '12:00', '12:00 PM'),
(24, '12:30', '12:30 PM'),
(25, '13:00', '1:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_id` int(8) NOT NULL,
  `eml` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `pswrd` varchar(32) COLLATE utf8_unicode_ci DEFAULT '0',
  `frst_nm` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scnd_nm` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thrd_nm` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lst_nm` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fthr_wrk` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mthr_nm` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mthr_wrk` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ph1` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ph2` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_id` int(32) DEFAULT 0,
  `referral` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dof` varchar(32) COLLATE utf8_unicode_ci DEFAULT '0',
  `dob` varchar(32) COLLATE utf8_unicode_ci DEFAULT '0',
  `dow` varchar(32) COLLATE utf8_unicode_ci DEFAULT '0',
  `usr_catg` int(50) NOT NULL DEFAULT 0,
  `fxd_sal` int(2) NOT NULL DEFAULT 0,
  `sal` int(6) DEFAULT NULL,
  `rat_sal` int(2) NOT NULL DEFAULT 0,
  `rat_catg` int(50) NOT NULL DEFAULT 0,
  `rat_by` int(2) NOT NULL DEFAULT 0,
  `actv` int(1) NOT NULL DEFAULT 0,
  `prtct` int(2) NOT NULL DEFAULT 0,
  `prv` int(2) NOT NULL DEFAULT 5,
  `submit_timestamp` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `submitter` int(50) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `eml`, `pswrd`, `frst_nm`, `scnd_nm`, `thrd_nm`, `lst_nm`, `fthr_wrk`, `mthr_nm`, `mthr_wrk`, `address`, `ph1`, `ph2`, `file_id`, `referral`, `dof`, `dob`, `dow`, `usr_catg`, `fxd_sal`, `sal`, `rat_sal`, `rat_catg`, `rat_by`, `actv`, `prtct`, `prv`, `submit_timestamp`, `submitter`) VALUES
(36, 'Dr.Ramykasem88@hotmail.com', 'password', 'Ramy', 'Mohammed', '', 'Kassem', '', '', '', '', '00201060110', '', 0, '', '0', '0', '1507586400', 9, 0, 0, 0, 0, 0, 1, 0, 2, '2147483647', 0),
(46, 'menna@gmail.com', 'pass', 'Menna', '', '', 'Elsayyed', '', '', '', '', '56554674567', '', 0, '', '0', '0', '0', 5, 0, 0, 0, 0, 0, 0, 0, 2, '2147483647', 35),
(48, 'yara@gmail.com', 'pass', 'Yara', '', '', 'Sabry', '', '', '', '', '64757674567', '', 0, '', '0', '0', '0', 8, 0, 0, 0, 0, 0, 0, 0, 2, '2147483647', 36),
(49, 'hamed@gmail.com', 'pass', 'Hamed', '', '', 'Ali', '', '', '', '', '45634635634', '', 0, '', '0', '0', '0', 3, 0, 0, 0, 0, 0, 0, 0, 3, '2147483647', 36),
(55, 'haneen@gmail.com', 'pass', 'Haneen', '', '', 'Ahmed', '', '', '', '', '34872598635', '', 0, '', '0', '0', '0', 2, 0, 0, 0, 0, 0, 0, 0, 3, '2147483647', 35),
(58, 'ahmdelsayyed@gmail.com', 'pass', 'Ahmed', 'Ali', 'Mohsen', 'Elsayyed', '', '', '', '', '39240567398', '', 0, '', '0', '-3600', '0', 1, 0, 0, 0, 0, 0, 0, 0, 3, '1613561229', 36),
(59, 'elsayyed@gmail.com', 'pass', 'Elsayyed', '', '', 'Essam', '', '', '', '', '98768768796', '', 0, '', '0', '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 3, '2147483647', 35),
(60, 'abdelhady@gmail.com', 'pass', 'Ahmed', '', '', 'Abdelahdy', '', '', '', '', '83947653289', '', 0, '', '0', '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 3, '2147483647', 35),
(62, 'hadeer@gmail.com', 'pass', 'Hadeer', 'Eid', 'Ahmed', 'Ahmed', '', '', '', '', '34523533457', '', 0, '', '0', '-3600', '0', 1, 0, 0, 0, 0, 0, 0, 0, 3, '1613578353', 36),
(63, 'bahgat@gmial.com', 'pass', 'Eman', 'Mahmod', 'Raed', 'Bahgat', '', '', '', '', '23849756387', '', 0, '', '0', '-3600', '0', 2, 1, 200, 1, 2, 1, 0, 0, 3, '1613577257', 36),
(115, 'dregpt@gmail.com', 'password', 'Ibrahim', NULL, NULL, 'Salem', NULL, NULL, NULL, NULL, '01112720079', '01203577155', 0, NULL, '0', '563151600', '0', 9, 0, 0, 0, 0, 0, 1, 1, 1, '1613498460', 36),
(117, 'omnia@gmail.com', '0', 'Omnia', 'Mostafa', 'Ali', 'Mahmoud', 'engineer', 'Manal Ali', 'housework', 'zelzal', '01023948755', '01208473525', 17122, '', '1511305200', '1460584800', '0', 7, 0, NULL, 0, 0, 0, 0, 0, 5, '1613513367', 36);

-- --------------------------------------------------------

--
-- Table structure for table `user_categ`
--

CREATE TABLE `user_categ` (
  `usr_catg_id` int(50) NOT NULL,
  `usr_catg_name` varchar(1024) NOT NULL,
  `usr_catg_cod` varchar(20) NOT NULL,
  `usr_catg_prv` int(2) NOT NULL,
  `submitter` int(50) NOT NULL,
  `submit_timestamp` int(20) NOT NULL,
  `def` int(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_categ`
--

INSERT INTO `user_categ` (`usr_catg_id`, `usr_catg_name`, `usr_catg_cod`, `usr_catg_prv`, `submitter`, `submit_timestamp`, `def`) VALUES
(1, 'Physical Therapist', 'PTist', 3, 0, 0, 1),
(2, 'Occupational Therapist', 'OTist', 3, 0, 0, 1),
(3, 'Speech Therapist', 'SPist', 3, 0, 0, 1),
(4, 'Special Educator', 'Edutor', 3, 0, 0, 1),
(5, 'Secretary', 'Scrtry', 2, 0, 0, 1),
(6, 'Worker', 'Wrkr', 4, 0, 0, 1),
(7, 'Case', 'Case', 5, 0, 0, 1),
(8, 'Moderator', 'Mdrtr', 2, 0, 0, 1),
(9, 'Admin', 'Admin', 1, 0, 0, 1),
(10, 'Hydrotherapist', 'Hydis', 3, 35, 1613318033, 0),
(13, 'Ortotist', 'Orth', 3, 35, 1613324745, 0),
(14, 'Psychologist', 'Psyc', 3, 35, 1613324764, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prv`
--
ALTER TABLE `prv`
  ADD PRIMARY KEY (`prv_id`);

--
-- Indexes for table `rat_categ`
--
ALTER TABLE `rat_categ`
  ADD PRIMARY KEY (`rat_catg_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`srv_id`);

--
-- Indexes for table `ses`
--
ALTER TABLE `ses`
  ADD PRIMARY KEY (`ses_id`);

--
-- Indexes for table `seset`
--
ALTER TABLE `seset`
  ADD PRIMARY KEY (`seset_id`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`tm_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- Indexes for table `user_categ`
--
ALTER TABLE `user_categ`
  ADD PRIMARY KEY (`usr_catg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rat_categ`
--
ALTER TABLE `rat_categ`
  MODIFY `rat_catg_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `srv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `ses`
--
ALTER TABLE `ses`
  MODIFY `ses_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3790;

--
-- AUTO_INCREMENT for table `seset`
--
ALTER TABLE `seset`
  MODIFY `seset_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `user_categ`
--
ALTER TABLE `user_categ`
  MODIFY `usr_catg_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 09:25 PM
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
  `srv_hr` int(5) NOT NULL,
  `srv_sngl_price` int(6) NOT NULL,
  `srv_rglr_price` int(6) NOT NULL,
  `excuse_fn` int(5) NOT NULL,
  `absence_fn` int(5) NOT NULL,
  `srv_ordr` int(5) NOT NULL,
  `submitter` int(15) NOT NULL,
  `submit_timestamp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`srv_id`, `srv_nm`, `srv_cd`, `srv_hr`, `srv_sngl_price`, `srv_rglr_price`, `excuse_fn`, `absence_fn`, `srv_ordr`, `submitter`, `submit_timestamp`) VALUES
(96, 'Physical Therapy', 'PT', 90, 150, 120, 30, 60, 10, 115, 1615489821),
(97, 'Static Suspension', 'SS', 60, 120, 90, 30, 45, 20, 115, 1615489846),
(98, 'Speech Therapy', 'SP', 30, 150, 120, 30, 60, 30, 115, 1615567046);

-- --------------------------------------------------------

--
-- Table structure for table `ses`
--

CREATE TABLE `ses` (
  `ses_id` int(32) NOT NULL,
  `cas_id` int(32) DEFAULT NULL,
  `thrp_id` int(32) DEFAULT NULL,
  `srv_cd` varchar(5) DEFAULT NULL,
  `ses_day` varchar(32) DEFAULT NULL,
  `ses_rc_day` varchar(100) DEFAULT NULL,
  `ses_rf_tm` varchar(100) DEFAULT NULL,
  `ses_rc_strt` varchar(100) DEFAULT NULL,
  `ses_rc_end` varchar(100) DEFAULT NULL,
  `attend_tm` varchar(100) DEFAULT NULL,
  `stat` int(5) NOT NULL DEFAULT 0,
  `nt` int(2) DEFAULT NULL,
  `note` varchar(1024) DEFAULT NULL,
  `submitter` int(23) DEFAULT NULL,
  `submit_timestamp` int(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ses`
--

INSERT INTO `ses` (`ses_id`, `cas_id`, `thrp_id`, `srv_cd`, `ses_day`, `ses_rc_day`, `ses_rf_tm`, `ses_rc_strt`, `ses_rc_end`, `attend_tm`, `stat`, `nt`, `note`, `submitter`, `submit_timestamp`) VALUES
(3900, 133, 48, 'PT', '2021-04-27', NULL, '18:00', NULL, NULL, NULL, 0, NULL, NULL, 46, NULL),
(3899, 133, 48, 'PT', '2021-04-20', NULL, '18:00', NULL, NULL, NULL, 1, NULL, NULL, 46, NULL),
(3898, 133, 55, 'PT', '2021-04-13', NULL, '18:00', NULL, NULL, NULL, 1, NULL, NULL, 46, NULL),
(3897, 133, NULL, 'PT', '2021-04-06', NULL, '18:00', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(3896, 133, NULL, 'PT', '2021-04-25', NULL, '17:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3895, 133, NULL, 'PT', '2021-04-18', NULL, '17:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3894, 133, NULL, 'PT', '2021-04-11', NULL, '17:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3893, 133, NULL, 'PT', '2021-04-04', NULL, '17:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3892, 132, NULL, 'SS', '2021-04-28', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3891, 132, NULL, 'PT', '2021-04-28', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3890, 132, NULL, 'SS', '2021-04-21', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3889, 132, NULL, 'PT', '2021-04-21', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3888, 132, NULL, 'SS', '2021-04-14', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3887, 132, NULL, 'PT', '2021-04-14', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3886, 132, NULL, 'SS', '2021-04-07', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3885, 132, NULL, 'PT', '2021-04-07', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3884, 132, NULL, 'SS', '2021-04-26', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3883, 132, NULL, 'PT', '2021-04-26', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3882, 132, NULL, 'SS', '2021-04-19', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3881, 132, NULL, 'PT', '2021-04-19', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3880, 132, NULL, 'SS', '2021-04-12', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3879, 132, NULL, 'PT', '2021-04-12', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3878, 132, NULL, 'SS', '2021-04-05', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3877, 132, NULL, 'PT', '2021-04-05', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3876, 132, NULL, 'SS', '2021-04-24', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3875, 132, NULL, 'PT', '2021-04-24', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3874, 132, NULL, 'SS', '2021-04-17', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3873, 132, NULL, 'PT', '2021-04-17', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3872, 132, NULL, 'SS', '2021-04-10', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3871, 132, NULL, 'PT', '2021-04-10', NULL, '11:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3870, 132, NULL, 'SS', '2021-04-03', NULL, '12:30', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3869, 132, NULL, 'PT', '2021-04-03', NULL, '11:00', '', '', '', 1, NULL, NULL, 115, 1615566883),
(3901, 134, 49, 'SP', '2021-04-03', NULL, '09:00', '09:05', '09:30', '08:50', 1, NULL, NULL, 115, 1615568719),
(3902, 134, 63, 'SP', '2021-04-10', NULL, '09:00', '', '', '10:00', 2, NULL, 'اعتذار مع وجود الدكتور', 115, 1615573534),
(3903, 134, NULL, 'SP', '2021-04-17', NULL, '09:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3904, 134, NULL, 'SP', '2021-04-24', NULL, '09:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3905, 134, 36, 'SP', '2021-04-05', NULL, '12:00', '12:12', '13:28', '12:10', 1, NULL, NULL, 115, 1615568727),
(3906, 134, NULL, 'SP', '2021-04-12', NULL, '12:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3907, 134, NULL, 'SP', '2021-04-19', NULL, '12:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3908, 134, NULL, 'SP', '2021-04-26', NULL, '12:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3909, 134, NULL, 'SP', '2021-04-07', NULL, '15:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3910, 134, NULL, 'SP', '2021-04-14', NULL, '15:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3911, 134, NULL, 'SP', '2021-04-21', NULL, '15:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3912, 134, NULL, 'SP', '2021-04-28', NULL, '15:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3913, 135, 58, 'PT', '2021-04-04', '2021-04-04', '19:00', '19:07', '20:25', '18:55', 1, NULL, '', 115, 1615575967),
(3914, 135, 62, 'PT', '2021-04-11', '2021-04-11', '19:00', '', '', '', 3, NULL, '', 115, 1615577213),
(3915, 135, 0, 'PT', '2021-04-18', '2021-04-18', '19:00', '', '', '', 4, NULL, '', 115, 1615579306),
(3916, 135, NULL, 'PT', '2021-04-25', '2021-04-25', '19:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3917, 135, 0, 'PT', '2021-04-07', '2021-04-06', '17:00', '', '', '17:00', 2, NULL, '', 115, 1615575878),
(3918, 135, 60, 'PT', '2021-04-14', '2021-04-14', '17:00', '16:55', '18:35', '16:45', 6, NULL, '', 115, 1615580401),
(3919, 135, 59, 'SS', '2021-04-21', '2021-04-22', '17:00', '17:02', '18:05', '17:00', 6, NULL, '', 115, 1615580556),
(3920, 135, NULL, 'PT', '2021-04-28', '2021-04-28', '17:00', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

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
  `SS_sngl_price` int(5) NOT NULL DEFAULT 120,
  `SS_rglr_price` int(5) NOT NULL DEFAULT 90,
  `SS` int(5) NOT NULL DEFAULT 0,
  `SS_tm_Sat` varchar(15) DEFAULT NULL,
  `SS_tm_Sun` varchar(15) DEFAULT NULL,
  `SS_tm_Mon` varchar(15) DEFAULT NULL,
  `SS_tm_Tue` varchar(15) DEFAULT NULL,
  `SS_tm_Wed` varchar(15) DEFAULT NULL,
  `SS_tm_Thu` varchar(15) DEFAULT NULL,
  `SS_tm_Fri` varchar(15) DEFAULT NULL,
  `SP_sngl_price` int(5) NOT NULL DEFAULT 150,
  `SP_rglr_price` int(5) NOT NULL DEFAULT 120,
  `SP` int(5) NOT NULL DEFAULT 0,
  `SP_tm_Sat` varchar(15) DEFAULT NULL,
  `SP_tm_Sun` varchar(15) DEFAULT NULL,
  `SP_tm_Mon` varchar(15) DEFAULT NULL,
  `SP_tm_Tue` varchar(15) DEFAULT NULL,
  `SP_tm_Wed` varchar(15) DEFAULT NULL,
  `SP_tm_Thu` varchar(15) DEFAULT NULL,
  `SP_tm_Fri` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seset`
--

INSERT INTO `seset` (`seset_id`, `case_id`, `submitter`, `submit_timestamp`, `PT_sngl_price`, `PT_rglr_price`, `PT`, `PT_tm_Sat`, `PT_tm_Sun`, `PT_tm_Mon`, `PT_tm_Tue`, `PT_tm_Wed`, `PT_tm_Thu`, `PT_tm_Fri`, `SS_sngl_price`, `SS_rglr_price`, `SS`, `SS_tm_Sat`, `SS_tm_Sun`, `SS_tm_Mon`, `SS_tm_Tue`, `SS_tm_Wed`, `SS_tm_Thu`, `SS_tm_Fri`, `SP_sngl_price`, `SP_rglr_price`, `SP`, `SP_tm_Sat`, `SP_tm_Sun`, `SP_tm_Mon`, `SP_tm_Tue`, `SP_tm_Wed`, `SP_tm_Thu`, `SP_tm_Fri`) VALUES
(59, 132, 115, 1615489955, 150, 120, 0, '11:00', '', '11:00', '', '11:00', '', '', 120, 90, 0, '12:30', '', '12:30', '', '12:30', '', '', 150, 120, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 133, 115, 1615490019, 150, 120, 0, '', '17:00', '', '18:00', '', '', '', 120, 90, 0, '', '', '', '', '', '', '', 150, 120, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 134, 115, 1615567251, 150, 120, 0, '', '', '', '', '', '', '', 120, 90, 0, '', '', '', '', '', '', '', 150, 120, 0, '09:00', '', '12:00', '', '15:00', '', ''),
(62, 135, 115, 1615575615, 150, 120, 0, '', '19:00', '', '', '17:00', '', '', 120, 90, 0, '', '', '', '', '', '', '', 150, 120, 0, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ses_stat`
--

CREATE TABLE `ses_stat` (
  `stat_id` int(5) NOT NULL DEFAULT 0,
  `stat_nm` varchar(32) NOT NULL,
  `stat_det` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ses_stat`
--

INSERT INTO `ses_stat` (`stat_id`, `stat_nm`, `stat_det`) VALUES
(0, 'Waiting session', 'Session is booked before the start of the month.'),
(1, 'Taken session', 'Session is taken by the case in its regular time.'),
(2, 'Excused session', 'Session is excused and not taken in its regular time.'),
(3, 'Absent session', 'The case neither taken the session in its regular time nor excused for attending the session. '),
(4, 'Cancelled session', 'The center excused for the case for attending the session.'),
(5, 'Waiting re-book', 'This session is re-booked by the case and waiting for take.'),
(6, 'Taken re-book', 'The re-booked session is taken by the case. '),
(7, 'Excused re-book', 'The re-booked session is excused by the case again (this session can\'t be re-booked again!)'),
(8, 'Absent re-book', 'The re-booked session is not attended by the case without excuse (this session can\'t be re-booked again!)'),
(9, 'Cancelled re-book', 'The re-booked session is cancelled by the center (this session could be re-booked again)');

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
(132, 'oiuiou@iuoiuio', '0', 'Ahmed', 'Ali', 'Mohammed', 'Hussein', 'jkljlk;j', 'L;kjl;lkj', 'oiuiuu', 'oiuiou', '89787656754', '78678678678', 87687, '', '1581285600', '1581285600', '0', 7, 0, NULL, 0, 0, 0, 0, 0, 5, '1615449294', 115),
(133, 'jlkjlkjkl@kjkljk', '0', 'Ahmed', 'Ali', 'Mohammed', 'Ryad', 'lkjlkj', 'Kljkljkl', 'lkjlkjlkj', 'lkjlkjjklj', '56546435345', '45354355667', 89986, '', '1581285600', '1581285600', '0', 7, 0, NULL, 0, 0, 0, 0, 0, 5, '1615449393', 115),
(134, 'iuhiuhiuh@iuhiuh', '0', 'Mohammed', 'Abdelmawla', 'Ateyya', 'Radwan', 'kgoitrno', 'Atyyat', 'inoinion', 'inionion', '78678678687', '87678678676', 32432, '', '1581372000', '1581372000', '0', 7, 0, NULL, 0, 0, 0, 0, 0, 5, '1615567119', 115),
(135, 'pokpokop@k', '0', 'Salma', 'Ahmed', 'Ali', 'Sayyed', 'fawzy', 'Manal', 'poipokpo', 'pokpok', '96875456465', '54646546545', 65465, '', '1581372000', '1581372000', '0', 7, 0, NULL, 0, 0, 0, 0, 0, 5, '1615575544', 115);

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
-- Indexes for table `ses_stat`
--
ALTER TABLE `ses_stat`
  ADD PRIMARY KEY (`stat_id`);

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
  MODIFY `srv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `ses`
--
ALTER TABLE `ses`
  MODIFY `ses_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3921;

--
-- AUTO_INCREMENT for table `seset`
--
ALTER TABLE `seset`
  MODIFY `seset_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `user_categ`
--
ALTER TABLE `user_categ`
  MODIFY `usr_catg_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 18, 2016 at 04:48 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_schooledge`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_class`
--

CREATE TABLE `tb_class` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `division_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_class`
--

INSERT INTO `tb_class` (`id`, `name`, `division_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'K 1', 12, 1, 0, '2016-09-18 09:20:38', '0000-00-00 00:00:00'),
(2, 'K 111', 12, 1, 0, '2016-09-18 09:20:52', '0000-00-00 00:00:00'),
(3, 'K IV', 12, 1, 0, '2016-09-18 09:21:11', '0000-00-00 00:00:00'),
(4, 'K V', 12, 1, 0, '2016-09-18 09:21:26', '0000-00-00 00:00:00'),
(5, 'K-1', 12, 1, 0, '2016-09-17 04:46:07', '0000-00-00 00:00:00'),
(6, 'K-2', 12, 1, 0, '2016-09-17 04:46:32', '0000-00-00 00:00:00'),
(7, 'Nursery', 12, 1, 0, '2016-09-17 04:46:51', '0000-00-00 00:00:00'),
(8, 'Pre-1', 12, 1, 0, '2016-09-17 04:47:03', '0000-00-00 00:00:00'),
(9, 'Grade 1', 11, 1, 0, '2016-09-17 04:47:17', '0000-00-00 00:00:00'),
(10, 'Grade 2', 11, 1, 0, '2016-09-17 04:47:39', '0000-00-00 00:00:00'),
(11, 'Grade 4', 11, 1, 1, '2016-09-17 04:47:49', '0000-00-00 00:00:00'),
(12, 'Grade 3', 11, 1, 0, '2016-09-17 04:47:58', '0000-00-00 00:00:00'),
(13, 'Grade 5', 11, 1, 0, '2016-09-17 04:48:43', '0000-00-00 00:00:00'),
(14, 'Grade 6', 11, 1, 0, '2016-09-17 04:49:06', '0000-00-00 00:00:00'),
(15, 'Grade 7', 10, 1, 0, '2016-09-17 04:49:38', '0000-00-00 00:00:00'),
(16, 'Grade 8', 10, 1, 1, '2016-09-17 04:49:47', '0000-00-00 00:00:00'),
(17, 'Grade 9', 11, 1, 0, '2016-09-17 04:52:27', '0000-00-00 00:00:00'),
(18, 'Grade 10', 9, 1, 1, '2016-09-17 04:56:03', '0000-00-00 00:00:00'),
(19, 'Grade 11', 9, 1, 0, '2016-09-17 04:57:45', '0000-00-00 00:00:00'),
(20, 'Grade 12', 9, 1, 0, '2016-09-17 04:58:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_classes_schedule`
--

CREATE TABLE `tb_classes_schedule` (
  `id` int(11) NOT NULL COMMENT '11',
  `day_of_week` varchar(20) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_classes_schedule`
--

INSERT INTO `tb_classes_schedule` (`id`, `day_of_week`, `subject_id`, `class_id`, `period_id`, `year_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(8, '1', 6, 15, 1, 2, 1, 0, '2016-09-18 10:51:39', '0000-00-00 00:00:00'),
(9, '2', 7, 15, 1, 2, 1, 0, '2016-09-18 11:16:36', '0000-00-00 00:00:00'),
(10, '5', 6, 15, 1, 2, 1, 0, '2016-09-18 11:18:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_division`
--

CREATE TABLE `tb_division` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_division`
--

INSERT INTO `tb_division` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(9, 'Senior High', 1, 0, '2016-09-17 04:43:57', '0000-00-00 00:00:00'),
(10, 'Junior High', 1, 0, '2016-09-17 04:44:15', '0000-00-00 00:00:00'),
(11, 'Elementary', 1, 1, '2016-09-17 04:44:42', '0000-00-00 00:00:00'),
(12, 'Kingergarten', 1, 0, '2016-09-17 04:45:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `venue` varchar(100) NOT NULL,
  `year_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_event`
--

INSERT INTO `tb_event` (`id`, `title`, `body`, `venue`, `year_id`, `created_by`, `updated_by`, `start_datetime`, `end_datetime`, `created_at`, `updated_at`) VALUES
(1, 'independence Day', 'Annual Independence Day (Urdu: ??? ??????; Yaum-e ?z?d?), observed annually on 14 August, is a national holiday in Pakistan. It commemorates the day when Pakistan achieved independence and was declared a sovereign nation following the end of the British Raj in 1947.', 'Raj Hall', 0, 1, 1, '2016-08-14 09:55:22', '2016-08-14 19:35:22', '2016-08-23 09:03:35', '2016-08-23 09:03:35'),
(2, 'event 1', 'event 2', 'event 3', 2, 1, 0, '2016-09-15 22:35:07', '2016-09-16 04:35:07', NULL, NULL),
(3, 'E 1122', 'testing', 'Johar town', 1, 1, 0, '2016-09-15 22:45:20', '2016-09-16 04:45:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_grade`
--

CREATE TABLE `tb_grade` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `first_term` double NOT NULL,
  `second_term` double NOT NULL,
  `third_term` double NOT NULL,
  `first_exam` double NOT NULL,
  `first_avg` double NOT NULL,
  `four_term` double NOT NULL,
  `fifth_term` double NOT NULL,
  `sixth_term` double NOT NULL,
  `second_exam` double NOT NULL,
  `second_avg` double NOT NULL,
  `final` double NOT NULL,
  `year_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_grade`
--

INSERT INTO `tb_grade` (`id`, `class_id`, `subject_id`, `student_id`, `first_term`, `second_term`, `third_term`, `first_exam`, `first_avg`, `four_term`, `fifth_term`, `sixth_term`, `second_exam`, `second_avg`, `final`, `year_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 15, 6, 6, 0, 0, 0, 0, 40, 0, 0, 0, 0, 40, 40, 2, 0, 0, '2016-09-17 16:52:23', '0000-00-00 00:00:00'),
(5, 15, 6, 8, 0, 0, 0, 0, 90, 0, 0, 0, 0, 90, 90, 2, 0, 0, '2016-09-17 16:52:23', '0000-00-00 00:00:00'),
(6, 16, 7, 7, 0, 0, 0, 0, 80.78, 0, 0, 0, 0, 0, 0, 2, 0, 0, '2016-09-17 16:53:51', '0000-00-00 00:00:00'),
(7, 15, 7, 8, 0, 0, 0, 0, 80, 0, 0, 0, 0, 80, 80, 2, 0, 0, '2016-09-17 16:53:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_grade_sheet`
--

CREATE TABLE `tb_grade_sheet` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_group`
--

CREATE TABLE `tb_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `data_access` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_group`
--

INSERT INTO `tb_group` (`id`, `name`, `data_access`) VALUES
(1, 'Admin', '["1","1","1","1","1","1","1","1","1","1","1","1","1","1","1"]'),
(2, 'Principal', '["1","1","1","1","1","1","1","1","1","1","1","1","1","1","1"]'),
(3, 'Registrar', '["1","1","1","1","1","1","1","1","1","1","1","1","1","1","1"]'),
(4, 'Finance Officer', '["1","1","1","1","1","1","1","1","1","1","1","1","1","1","1"]'),
(5, 'Teacher', '["1","1","1","1","1","1","1","1","1","1","1","1","1","1","1"]'),
(6, 'Student', '["1","1","0","1","1","1","1","1","1","1","1","1","1","1","1"]'),
(7, 'Parents', '["1","1","0","0","0","0","0","0","0","1","1","0","0","0","1"]');

-- --------------------------------------------------------

--
-- Table structure for table `tb_group_access`
--

CREATE TABLE `tb_group_access` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `data_access` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_group_access`
--

INSERT INTO `tb_group_access` (`id`, `group_id`, `module_id`, `data_access`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-14 20:18:19', NULL),
(2, 1, 2, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-14 20:19:38', NULL),
(3, 1, 3, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-22 11:18:59', '2016-08-22 11:18:59'),
(4, 1, 4, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-22 11:18:59', '2016-08-22 11:18:59'),
(5, 1, 5, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-22 11:19:21', '2016-08-22 11:19:21'),
(6, 1, 6, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-22 12:02:15', '2016-08-22 12:02:15'),
(7, 1, 7, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-23 10:58:16', '2016-08-23 10:58:16'),
(8, 1, 8, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-23 11:30:24', '2016-08-23 11:30:24'),
(9, 1, 9, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-23 12:39:17', '2016-08-23 12:39:17'),
(10, 1, 10, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-29 15:56:45', '2016-08-29 15:56:45'),
(11, 1, 11, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-29 16:16:14', '2016-08-29 16:16:14'),
(12, 1, 12, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-08-29 16:17:49', '2016-08-29 16:17:49'),
(13, 2, 1, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":0,"is_remove":0,"is_add":0}', '2016-09-07 10:22:01', '2016-09-07 10:22:01'),
(14, 3, 1, '{"is_global":"1","is_view":"1","is_detail":"1","is_edit":"1","is_remove":"1","is_add":"1"}', '2016-09-07 10:22:01', NULL),
(15, 3, 0, '{"is_global":"1","is_view":"1"}', '2016-09-08 06:52:26', NULL),
(16, 1, 13, '{"is_global":"1","is_view":"1","is_detail":0,"is_edit":0,"is_remove":0,"is_add":0}', '2016-09-08 06:55:05', NULL),
(17, 1, 14, '{"is_global":"1","is_view":0,"is_detail":0,"is_edit":0,"is_remove":0,"is_add":0}', '2016-09-08 06:55:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_module`
--

CREATE TABLE `tb_module` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_module`
--

INSERT INTO `tb_module` (`id`, `name`) VALUES
(1, 'student'),
(2, 'teacher'),
(3, 'parents'),
(4, 'class'),
(5, 'division'),
(6, 'class'),
(7, 'subject'),
(8, 'calender'),
(9, 'news'),
(10, 'event'),
(11, 'gradebook'),
(12, 'finance'),
(13, 'setting'),
(14, 'media'),
(15, 'grade');

-- --------------------------------------------------------

--
-- Table structure for table `tb_news`
--

CREATE TABLE `tb_news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `year_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_news`
--

INSERT INTO `tb_news` (`id`, `title`, `body`, `category`, `status`, `year_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'Sports', 0, 1, 1, 0, '2016-09-15 17:11:23', '0000-00-00 00:00:00'),
(2, 'nw 2', 'jgjggj', 'Information', 0, 2, 1, 0, '2016-09-15 17:13:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_parent`
--

CREATE TABLE `tb_parent` (
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `community` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `relation` varchar(50) NOT NULL,
  `occupcation` varchar(250) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_parent`
--

INSERT INTO `tb_parent` (`parent_id`, `user_id`, `gender`, `community`, `city`, `country`, `nationality`, `relation`, `occupcation`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 14, 2, 'Muslim', 'London', 'UK', 'UK', 'Father', 'Business', 1, 1, '2016-09-15 18:14:03', '0000-00-00 00:00:00'),
(6, 15, 1, 'Lahore', 'Lahore', 'Pakistan', 'Pakistan', 'Brother', 'Business', 1, 0, '2016-09-16 13:13:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment`
--

CREATE TABLE `tb_payment` (
  `id` int(11) NOT NULL,
  `no` varchar(50) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `due` double NOT NULL,
  `amount_in_words` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `year_id` int(11) NOT NULL,
  `received_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_payment`
--

INSERT INTO `tb_payment` (`id`, `no`, `student_id`, `class_id`, `amount`, `due`, `amount_in_words`, `purpose`, `status`, `year_id`, `received_date`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '707357', 10, 10, 2000, 0, 'Two thousand', '200', 1, 0, '2016-09-16 04:15:15', 1, 1, '2016-09-16 04:03:48', '2016-09-16 04:08:15'),
(2, '139381', 10, 10, 200, 0, 'Two Hundard', 'March Month Fees', 1, 0, '2016-09-16 15:18:46', 1, 1, '2016-09-16 15:18:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_period`
--

CREATE TABLE `tb_period` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `break` tinyint(1) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_period`
--

INSERT INTO `tb_period` (`id`, `name`, `break`, `start_time`, `end_time`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Period 1', 0, '03:18:33', '09:43:50', 1, 1, '2016-08-23 11:23:30', '2016-08-23 11:23:30'),
(2, 'Period 2', 0, '01:00:00', '01:00:00', 1, 1, '2016-08-23 11:40:34', '2016-08-23 11:40:34'),
(3, 'Break', 1, '00:00:00', '00:00:00', 1, 1, '2016-09-15 17:16:39', '0000-00-00 00:00:00'),
(4, 'Period 4', 0, '10:30:00', '10:30:00', 1, 0, '2016-09-15 17:17:11', '0000-00-00 00:00:00'),
(5, 'Period 5', 0, '09:00:00', '09:30:00', 1, 0, '2016-09-16 15:15:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_school`
--

CREATE TABLE `tb_school` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_school`
--

INSERT INTO `tb_school` (`id`, `name`, `year`, `created_by`, `updated_by`, `created_at`, `update_at`) VALUES
(1, 'Year 1', '2014/2015', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Year 2', '2015/2016', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE `tb_setting` (
  `logo` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `date_format` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_students`
--

CREATE TABLE `tb_students` (
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `community` varchar(100) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(50) NOT NULL,
  `register_date` date NOT NULL,
  `county_of_origin` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_students`
--

INSERT INTO `tb_students` (`student_id`, `parent_id`, `class_id`, `user_id`, `status`, `gender`, `community`, `religion`, `city`, `country`, `date_of_birth`, `nationality`, `register_date`, `county_of_origin`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 5, 14, 17, 1, 1, 'Lahore', 'Islam', 'Lahore', 'lahore', '2016-09-16', 'Musliam', '2016-09-06', 'Pakistan', 1, 1, '2016-09-16 15:13:05', '0000-00-00 00:00:00'),
(6, 5, 15, 18, 1, 1, 'Muslim', 'Islam', 'Lahore', 'Pakistan', '2015-09-17', 'Pakistani', '2016-09-16', 'Lahore', 1, 0, '2016-09-17 10:26:44', '0000-00-00 00:00:00'),
(7, 6, 15, 19, 1, 1, 'Muslim', 'Islam', 'Lahore', 'Pakistan', '2013-07-08', 'Pakistani', '2016-09-17', 'Lahore', 1, 0, '2016-09-17 10:36:05', '0000-00-00 00:00:00'),
(8, 5, 15, 20, 1, 1, 'Muslim', 'Islam', 'Lahore', 'Pakistan', '2016-09-17', 'Pakistani', '2016-09-17', 'Punjab', 1, 0, '2016-09-17 10:38:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_student_class`
--

CREATE TABLE `tb_student_class` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_student_class`
--

INSERT INTO `tb_student_class` (`id`, `student_id`, `class_id`, `year_id`, `status`) VALUES
(3, 6, 15, 2, 0),
(4, 7, 16, 2, 0),
(5, 8, 15, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_subject`
--

CREATE TABLE `tb_subject` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_subject`
--

INSERT INTO `tb_subject` (`id`, `name`, `class_id`, `teacher_id`, `status`, `year_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, 'English', 15, 1, 0, 2, 1, 0, '2016-09-17 11:19:46', '0000-00-00 00:00:00'),
(7, 'Mathematics', 15, 1, 0, 2, 1, 0, '2016-09-17 16:52:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_teachers`
--

CREATE TABLE `tb_teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `community` varchar(100) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(50) NOT NULL,
  `county_of_origin` varchar(50) NOT NULL,
  `hire_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_teachers`
--

INSERT INTO `tb_teachers` (`id`, `user_id`, `status`, `gender`, `community`, `religion`, `city`, `country`, `date_of_birth`, `nationality`, `county_of_origin`, `hire_date`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 16, 1, 2, 'muslim', '', 'Lahore', 'Pakistan', '2016-09-14', 'Pakistan', '', '2016-09-14', 1, 1, '2016-09-16 14:11:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `mobile_number` varchar(25) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `group_id`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `status`, `mobile_number`, `phone_number`, `avatar`, `remember_token`, `created_by`, `updated_by`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hafiz', 'Shahid', 'Junaid', 'admin@schooledge.com', '$2y$10$JGFXoabQMJbeGz6PNF1MoOsgNSIj07PH.LKvUFhxiqBkgwc7I2HgC', 1, '3354886493', '3354886493', 'test', 'KcKDeimh3QjIGbnK6mcKJ61eMVX13gor7g6Ay1FaZOv86Ffkjd54g4d7ht3O', 0, 1, '2016-09-18 09:04:42', '2016-08-14 04:09:21', '2016-09-18 04:04:40'),
(3, 1, 'test', 'test', 'test', 'test@schooledge.com', '123456', 0, '+923354886493', '3354886493', '', '', 1, 0, '0000-00-00 00:00:00', '2016-09-15 04:53:23', '0000-00-00 00:00:00'),
(4, 2, 'Sam', '', 'Cern', 'principal@schooledge.com', '$2y$10$JGFXoabQMJbeGz6PNF1MoOsgNSIj07PH.LKvUFhxiqBkgwc7I2HgC', 1, '03241234567', '0423733883', 'Principle', 'XGfEXHXM6OVi2q0JQR1zcgqyAeqLTuu47SZUciMTwIeOWa19oqBBiZZRmDUJ', 0, 1, '2016-09-14 19:37:08', '2016-08-14 04:09:21', '2016-09-14 14:46:48'),
(5, 3, 'katrine', '', 'Ram', 'registrar@schooledge.com', '$2y$10$JGFXoabQMJbeGz6PNF1MoOsgNSIj07PH.LKvUFhxiqBkgwc7I2HgC', 1, '03214567890', '0423733883', 'Registrar', 'catiKvewQty4szi1ibVg2D0AzwIGoHJOJU89unR8uOjL0m92k4U8ocuCfHJm', 0, 1, '2016-09-14 19:36:09', '2016-08-14 04:09:21', '2016-09-14 14:36:14'),
(6, 4, 'Rambo', '', 'russ', 'finance@schooledge.com', '$2y$10$JGFXoabQMJbeGz6PNF1MoOsgNSIj07PH.LKvUFhxiqBkgwc7I2HgC', 1, '0321454689', '0423736543', 'Finance', 'L6flA97pysguuV76I4ym8dEnSkck71cw94Cms0HcoqGKUjcXDflFUMRncQOi', 0, 1, '2016-09-14 19:35:39', '2016-08-14 04:09:21', '2016-09-14 14:35:50'),
(14, 7, 'con', 'john ', 'lipsa', 'parent@schooledge.com', '', 1, '268283663', '2689277927', '', '', 1, 1, '0000-00-00 00:00:00', '2016-09-15 18:14:03', '0000-00-00 00:00:00'),
(15, 7, 'Muhamamnd', 'Hassan', 'Ali', 'parent1@schooledge.com', '', 1, '+923354886493', '3354886493', '', '', 1, 0, '0000-00-00 00:00:00', '2016-09-16 13:13:35', '0000-00-00 00:00:00'),
(16, 5, 'Majeed', 'Anwer', 'Saba', 'teacher1@schooledge.com', '$2y$10$jKghnRARPwkAy6qx4JYOZeaxlttTLgIEn5PDKk2oqfNe2y6ZUejsC', 1, '+923354886493', '3354886493', 'upload/images/20160916140907.png', 'YEU3WSrluAa7Od4dE4ZA7uN1O7j89QbiLJNxgNaTCkbKsXU0J3V7PhavrGU9', 1, 1, '2016-09-16 14:11:45', '2016-09-16 14:11:09', '2016-09-16 09:12:06'),
(17, 6, 'Hafiz', 'Junaid', 'Bilal', 'student10@schooledge.com', '$2y$10$eUaGiDEwnGaXNo5wOY4EeeoqpzoWPLT0EUhzfZXaG8vkYuhPelWom', 1, '333-4444-3333', '333-4444-3333', 'upload/images/20160916151155.png', '', 1, 1, '0000-00-00 00:00:00', '2016-09-16 15:13:05', '0000-00-00 00:00:00'),
(18, 6, 'Muhamamnd', 'Rehman', 'Abdul', 'student11@gmail.com', '$2y$10$VS3BGiXN9kwBbrqaexUf0OwjnjmmzEIOl0V47arPHGJoqjSR6N/cy', 1, '223-2222-3333', '226-2777-9999', '', '', 1, 0, '0000-00-00 00:00:00', '2016-09-17 10:26:44', '0000-00-00 00:00:00'),
(19, 6, 'ALi', 'Waqas', 'Muhamman', 'student12@schooledge.com', '$2y$10$ECztLT2lQQiOP9118ZfaQ.irea7cJhMFPVdfv7Bx7KLLxnnIm8DSK', 1, '223-2222-3333', '233-3333-2222', '', '', 1, 0, '0000-00-00 00:00:00', '2016-09-17 10:36:05', '0000-00-00 00:00:00'),
(20, 6, 'Javaid', 'Hassam', 'Rana', 'student13@schooledge.com', '$2y$10$Xhpe5CpQJ4I0TpIRNCxXYu9WoCGIDs/3Cr.xUFQHxEUqcJhKchu36', 1, '223-2222-3333', '233-3333-2222', '', '', 1, 0, '0000-00-00 00:00:00', '2016-09-17 10:38:46', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_class`
--
ALTER TABLE `tb_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_classes_schedule`
--
ALTER TABLE `tb_classes_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_division`
--
ALTER TABLE `tb_division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_grade`
--
ALTER TABLE `tb_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_grade_sheet`
--
ALTER TABLE `tb_grade_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_group`
--
ALTER TABLE `tb_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_group_access`
--
ALTER TABLE `tb_group_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_module`
--
ALTER TABLE `tb_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_news`
--
ALTER TABLE `tb_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_parent`
--
ALTER TABLE `tb_parent`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_period`
--
ALTER TABLE `tb_period`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_school`
--
ALTER TABLE `tb_school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_students`
--
ALTER TABLE `tb_students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tb_student_class`
--
ALTER TABLE `tb_student_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_subject`
--
ALTER TABLE `tb_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_teachers`
--
ALTER TABLE `tb_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_class`
--
ALTER TABLE `tb_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tb_classes_schedule`
--
ALTER TABLE `tb_classes_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '11',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_division`
--
ALTER TABLE `tb_division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_grade`
--
ALTER TABLE `tb_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_grade_sheet`
--
ALTER TABLE `tb_grade_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_group`
--
ALTER TABLE `tb_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_group_access`
--
ALTER TABLE `tb_group_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tb_module`
--
ALTER TABLE `tb_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_news`
--
ALTER TABLE `tb_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_parent`
--
ALTER TABLE `tb_parent`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_period`
--
ALTER TABLE `tb_period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_school`
--
ALTER TABLE `tb_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_students`
--
ALTER TABLE `tb_students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_student_class`
--
ALTER TABLE `tb_student_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_subject`
--
ALTER TABLE `tb_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_teachers`
--
ALTER TABLE `tb_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

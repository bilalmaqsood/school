-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2016 at 09:58 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slack`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_class`
--

DROP TABLE IF EXISTS `tb_class`;
CREATE TABLE IF NOT EXISTS `tb_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `division_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_class`
--

INSERT INTO `tb_class` (`id`, `name`, `division_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '9th', 1, 0, 0, '2016-08-22 11:28:15', '2016-08-22 11:28:15'),
(2, 'Pre-I', 2, 1, 0, '2016-08-23 17:01:21', '2016-08-23 17:01:21'),
(3, 'Nursery', 2, 1, 0, '2016-08-23 17:01:29', '2016-08-23 17:01:21'),
(4, 'K-I', 2, 1, 0, '2016-08-23 17:01:39', '2016-08-23 17:01:21'),
(5, 'K-II', 2, 1, 0, '2016-08-23 17:01:50', '2016-08-23 17:01:21'),
(6, 'Grade I', 3, 1, 0, '2016-08-23 17:02:07', '2016-08-23 17:01:21'),
(7, 'Grade 2', 3, 1, 0, '2016-08-23 17:02:20', '2016-08-23 17:01:21'),
(8, 'Grade 7', 4, 1, 0, '2016-08-23 17:02:39', '2016-08-23 17:01:21'),
(9, 'Grade 10', 5, 1, 0, '2016-08-23 17:02:53', '2016-08-23 17:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_classes_schedule`
--

DROP TABLE IF EXISTS `tb_classes_schedule`;
CREATE TABLE IF NOT EXISTS `tb_classes_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '11',
  `day_of_week` varchar(20) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_classes_schedule`
--

INSERT INTO `tb_classes_schedule` (`id`, `day_of_week`, `subject_id`, `period_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'tuesday', 1, 2, 1, 0, '2016-08-23 13:03:40', '2016-08-23 17:01:21'),
(2, 'monday', 1, 2, 1, 0, '2016-08-23 17:10:56', '2016-08-23 17:01:21'),
(3, 'wednesday', 2, 1, 1, 1, '2016-08-23 17:12:50', '2016-08-23 17:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_division`
--

DROP TABLE IF EXISTS `tb_division`;
CREATE TABLE IF NOT EXISTS `tb_division` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_division`
--

INSERT INTO `tb_division` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Kindergarten', 1, 1, '2016-08-23 17:00:02', '2016-08-23 17:00:02'),
(3, 'Elementary', 1, 0, '2016-08-23 17:00:23', '2016-08-23 17:00:23'),
(4, 'Junior High', 1, 0, '2016-08-23 17:00:31', '2016-08-23 17:00:31'),
(5, 'Senior High', 1, 0, '2016-08-23 17:00:43', '2016-08-23 17:00:43'),
(6, 'Alumni', 1, 0, '2016-08-23 17:00:55', '2016-08-23 17:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

DROP TABLE IF EXISTS `tb_event`;
CREATE TABLE IF NOT EXISTS `tb_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `venue` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_event`
--

INSERT INTO `tb_event` (`id`, `title`, `body`, `venue`, `created_by`, `updated_by`, `start_datetime`, `end_datetime`, `created_at`, `updated_at`) VALUES
(1, 'independence Day', 'Annual Independence Day (Urdu: ??? ??????; Yaum-e ?z?d?), observed annually on 14 August, is a national holiday in Pakistan. It commemorates the day when Pakistan achieved independence and was declared a sovereign nation following the end of the British Raj in 1947.', 'Raj Hall', 1, 1, '2016-08-14 09:55:22', '2016-08-14 19:35:22', '2016-08-23 09:03:35', '2016-08-23 09:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_grade`
--

DROP TABLE IF EXISTS `tb_grade`;
CREATE TABLE IF NOT EXISTS `tb_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `first_term` double DEFAULT NULL,
  `second_term` double DEFAULT NULL,
  `third_term` double DEFAULT NULL,
  `first_exam` double DEFAULT NULL,
  `first_avg` double DEFAULT NULL,
  `four_term` double DEFAULT NULL,
  `fifth_term` double DEFAULT NULL,
  `sixth_term` double DEFAULT NULL,
  `second_exam` double DEFAULT NULL,
  `second_avg` double NOT NULL,
  `final` double DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_grade`
--

INSERT INTO `tb_grade` (`id`, `subject_id`, `student_id`, `first_term`, `second_term`, `third_term`, `first_exam`, `first_avg`, `four_term`, `fifth_term`, `sixth_term`, `second_exam`, `second_avg`, `final`, `created_by`, `updated_by`, `created_at`, `update_at`) VALUES
(1, 2, 1, 90, 80, 85, 90, 80, 85, 80, 90, 95, 0, 89, 1, 1, '2016-08-31 06:54:51', '2016-08-31 06:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_grade_sheet`
--

DROP TABLE IF EXISTS `tb_grade_sheet`;
CREATE TABLE IF NOT EXISTS `tb_grade_sheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_group`
--

DROP TABLE IF EXISTS `tb_group`;
CREATE TABLE IF NOT EXISTS `tb_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_group`
--

INSERT INTO `tb_group` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Principal'),
(3, 'Registrar'),
(4, 'Finance Officer'),
(5, 'Teacher'),
(6, 'Student'),
(7, 'Parents');

-- --------------------------------------------------------

--
-- Table structure for table `tb_group_access`
--

DROP TABLE IF EXISTS `tb_group_access`;
CREATE TABLE IF NOT EXISTS `tb_group_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `data_access` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_group_access`
--

INSERT INTO `tb_group_access` (`id`, `group_id`, `module_id`, `data_access`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-14 20:18:19', NULL),
(2, 1, 2, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-14 20:19:38', NULL),
(3, 1, 3, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-22 11:18:59', '2016-08-22 11:18:59'),
(4, 1, 4, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-22 11:18:59', '2016-08-22 11:18:59'),
(5, 1, 5, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-22 11:19:21', '2016-08-22 11:19:21'),
(6, 1, 6, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-22 12:02:15', '2016-08-22 12:02:15'),
(7, 1, 7, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-23 10:58:16', '2016-08-23 10:58:16'),
(8, 1, 8, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-23 11:30:24', '2016-08-23 11:30:24'),
(9, 1, 9, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-23 12:39:17', '2016-08-23 12:39:17'),
(10, 1, 10, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-29 15:56:45', '2016-08-29 15:56:45'),
(11, 1, 11, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-29 16:16:14', '2016-08-29 16:16:14'),
(12, 1, 12, '{"is_global":"1","is_view":"1","is_detail":"1","is_add":"1","is_edit":"1","is_remove":"1","is_excel":"1"}', '2016-08-29 16:17:49', '2016-08-29 16:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `tb_module`
--

DROP TABLE IF EXISTS `tb_module`;
CREATE TABLE IF NOT EXISTS `tb_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_module`
--

INSERT INTO `tb_module` (`id`, `name`) VALUES
(1, 'student'),
(2, 'teacher'),
(3, 'division'),
(4, 'class'),
(5, 'subject'),
(6, 'event'),
(7, 'news'),
(8, 'period'),
(9, 'schedule'),
(10, 'parents'),
(11, 'gradebook'),
(12, 'grade');

-- --------------------------------------------------------

--
-- Table structure for table `tb_news`
--

DROP TABLE IF EXISTS `tb_news`;
CREATE TABLE IF NOT EXISTS `tb_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_parent`
--

DROP TABLE IF EXISTS `tb_parent`;
CREATE TABLE IF NOT EXISTS `tb_parent` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `community` varchar(100) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `county_of_origin` varchar(50) NOT NULL,
  `occupcation` varchar(250) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment`
--

DROP TABLE IF EXISTS `tb_payment`;
CREATE TABLE IF NOT EXISTS `tb_payment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `due_amount` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_period`
--

DROP TABLE IF EXISTS `tb_period`;
CREATE TABLE IF NOT EXISTS `tb_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_period`
--

INSERT INTO `tb_period` (`id`, `name`, `start_time`, `end_time`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Period 1', '03:18:33', '09:43:50', 1, 1, '2016-08-23 11:23:30', '2016-08-23 11:23:30'),
(2, 'Period 2', '03:18:29', '09:43:50', 1, 0, '2016-08-23 11:40:34', '2016-08-23 11:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

DROP TABLE IF EXISTS `tb_setting`;
CREATE TABLE IF NOT EXISTS `tb_setting` (
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

DROP TABLE IF EXISTS `tb_students`;
CREATE TABLE IF NOT EXISTS `tb_students` (
  `id` int(11) NOT NULL,
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
  `county_of_origin` varchar(50) NOT NULL,
  `register_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_students`
--

INSERT INTO `tb_students` (`id`, `class_id`, `user_id`, `status`, `gender`, `community`, `religion`, `city`, `country`, `date_of_birth`, `nationality`, `county_of_origin`, `register_date`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(0, 1, 3, 1, 0, 'Muslims', 'Muslim', 'Bombay', 'India', '2001-12-29', 'Indian', 'Bombay', '2016-06-15', 1, 1, '2016-09-05 09:32:10', '2016-09-05 09:32:10'),
(1, 1, 2, 0, 0, 'test', 'Islam', 'Lahore', 'Pakistan', '2009-10-10', 'Pakistani', 'Lahore', '1999-01-10', 1, 1, '2016-08-28 19:02:06', '2016-08-28 19:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_student_class`
--

DROP TABLE IF EXISTS `tb_student_class`;
CREATE TABLE IF NOT EXISTS `tb_student_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `year` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_student_class`
--

INSERT INTO `tb_student_class` (`id`, `student_id`, `class_id`, `year`) VALUES
(1, 1, 1, '2016'),
(2, 1, 2, '2016');

-- --------------------------------------------------------

--
-- Table structure for table `tb_subject`
--

DROP TABLE IF EXISTS `tb_subject`;
CREATE TABLE IF NOT EXISTS `tb_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_subject`
--

INSERT INTO `tb_subject` (`id`, `name`, `class_id`, `teacher_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Math', 2, 3, 0, 0, 0, '2016-08-20 10:49:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_teacher`
--

DROP TABLE IF EXISTS `tb_teacher`;
CREATE TABLE IF NOT EXISTS `tb_teacher` (
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
  `register_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `group_id`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `status`, `mobile_number`, `phone_number`, `avatar`, `remember_token`, `created_by`, `updated_by`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mario', '', 'John', 'admin@schooledge.com', '$2y$10$JGFXoabQMJbeGz6PNF1MoOsgNSIj07PH.LKvUFhxiqBkgwc7I2HgC', 1, '03245643214', '0423452671', 'test', 'UQblKBAZ9wFijyphnJngwpNLSXHg6fwiTccrIHEfM9WoYUKtQX6kyBqB4gMt', 0, 1, '2016-09-05 09:48:11', '2016-08-14 04:09:21', '2016-09-05 04:47:08'),
(2, 6, 'Davis', 'Baksh', 'Haroon', 'ali@gmail.com', '$2y$10$JGFXoabQMJbeGz6PNF1MoOsgNSIj07PH.LKvUFhxiqBkgwc7I2HgC', 1, '03245643214', '0423452671', '7', '9OgReSB71uE92qXnjP6vLbw7kfcgTf6VXVbJCRvNw4bjSYytOtulNAl0CgC4', 1, 1, '2016-09-05 09:35:15', '2016-09-04 17:26:34', '2016-09-05 04:35:48'),
(3, 1, 'Mario', '1', 'Li', 'mario@gmail.com', '$2y$10$JGFXoabQMJbeGz6PNF1MoOsgNSIj07PH.LKvUFhxiqBkgwc7I2HgC', 1, '0324563214', '048755665525', 'test', 'BWFKlo9lgvRygX0HyJV6dkQAWoX5sR4iyGHdJtDGs5gdY2G1VYgOM5WBMi8b', 1, 1, '2016-09-05 09:36:18', '2016-09-05 09:32:10', '2016-09-05 04:36:36');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Aug 13, 2016 at 11:00 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schooledge`
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_classes_schedule`
--

CREATE TABLE `tb_classes_schedule` (
  `id` int(11) NOT NULL COMMENT '11',
  `day_of_week` varchar(20) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `venue` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_grade`
--

CREATE TABLE `tb_grade` (
  `id` int(11) NOT NULL,
  `first_term` double DEFAULT NULL,
  `second_term` double DEFAULT NULL,
  `third_term` double DEFAULT NULL,
  `first_exam` double DEFAULT NULL,
  `first_avg` double DEFAULT NULL,
  `four_term` double DEFAULT NULL,
  `fifth_term` double DEFAULT NULL,
  `sixth_term` double DEFAULT NULL,
  `second_exam` double DEFAULT NULL,
  `second_avg` double DEFAULT NULL,
  `final` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_group`
--

CREATE TABLE `tb_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_group_access`
--

CREATE TABLE `tb_group_access` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `data_access` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_module`
--

CREATE TABLE `tb_module` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_period`
--

CREATE TABLE `tb_period` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `period_time_from` datetime NOT NULL,
  `period_time_to` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `tb_student_class`
--

CREATE TABLE `tb_student_class` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_subject`
--

CREATE TABLE `tb_subject` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `mobile_number` varchar(25) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `occupcation` varchar(50) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `county_of_origin` varchar(50) NOT NULL,
  `register_date` datetime NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_division`
--

CREATE TABLE `td_division` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `tb_period`
--
ALTER TABLE `tb_period`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_division`
--
ALTER TABLE `td_division`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_class`
--
ALTER TABLE `tb_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_classes_schedule`
--
ALTER TABLE `tb_classes_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '11';
--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_grade`
--
ALTER TABLE `tb_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_grade_sheet`
--
ALTER TABLE `tb_grade_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_group`
--
ALTER TABLE `tb_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_group_access`
--
ALTER TABLE `tb_group_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_module`
--
ALTER TABLE `tb_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_news`
--
ALTER TABLE `tb_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_period`
--
ALTER TABLE `tb_period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_student_class`
--
ALTER TABLE `tb_student_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_subject`
--
ALTER TABLE `tb_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `td_division`
--
ALTER TABLE `td_division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

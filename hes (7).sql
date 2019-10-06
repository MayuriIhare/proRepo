-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2019 at 03:51 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hes`
--

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
CREATE TABLE IF NOT EXISTS `forms` (
  `form_id` bigint(255) NOT NULL,
  `roll_number` bigint(255) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) NOT NULL,
  `form_number` varchar(255) DEFAULT NULL,
  `semester` varchar(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `category_of_the_examinee` varchar(255) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `enrollment_num` varchar(255) DEFAULT NULL,
  `subject1_cod` varchar(255) NOT NULL,
  `subject2_cod` varchar(255) NOT NULL,
  `subject3_cod` varchar(255) NOT NULL,
  `subject4_cod` varchar(255) NOT NULL,
  `subject5_cod` varchar(255) NOT NULL,
  `subject6_cod` varchar(255) NOT NULL,
  `subject7_cod` varchar(255) NOT NULL,
  `subject8_cod` varchar(255) NOT NULL,
  `form_fill_date` varchar(255) NOT NULL,
  `exam_year` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`roll_number`),
  UNIQUE KEY `form_id` (`form_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

DROP TABLE IF EXISTS `marks`;
CREATE TABLE IF NOT EXISTS `marks` (
  `mark_id` bigint(255) NOT NULL AUTO_INCREMENT,
  `roll_number` varchar(255) NOT NULL,
  `subject1_cod` varchar(255) DEFAULT NULL,
  `subject1_marks` varchar(255) DEFAULT NULL,
  `subject2_cod` varchar(255) DEFAULT NULL,
  `subject2_marks` varchar(255) DEFAULT NULL,
  `subject3_cod` varchar(255) DEFAULT NULL,
  `subject3_marks` varchar(255) DEFAULT NULL,
  `subject4_cod` varchar(255) DEFAULT NULL,
  `subject4_marks` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Active',
  `marks_for` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mark_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int(255) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `designation` varchar(255) NOT NULL DEFAULT 'staff',
  `class_inchage` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'InActive',
  PRIMARY KEY (`staff_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `email`, `mobile`, `password`, `designation`, `class_inchage`, `status`) VALUES
(3, 'Vivek Gandhewar', 'vivekgandhewar@jdiet.ac.in', '9405999041', '123', 'HOD', NULL, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(255) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) DEFAULT NULL,
  `student_address` varchar(500) DEFAULT NULL,
  `student_email` varchar(255) DEFAULT NULL,
  `student_mobile` varchar(255) DEFAULT NULL,
  `student_dob` varchar(255) DEFAULT NULL,
  `student_branch` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `student_gender` varchar(255) DEFAULT NULL,
  `cast_category` varchar(255) DEFAULT NULL,
  `adhar_num` varchar(255) DEFAULT NULL,
  `fathers_full_name` varchar(255) DEFAULT NULL,
  `mothers_full_name` varchar(255) DEFAULT NULL,
  `parent_mobile` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(500) DEFAULT NULL,
  `signature_pic` varchar(500) DEFAULT NULL,
  `pnr` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'InActive',
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `pnr` (`pnr`),
  UNIQUE KEY `adhar_num` (`adhar_num`),
  UNIQUE KEY `student_mobile` (`student_mobile`),
  UNIQUE KEY `student_email` (`student_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(255) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL DEFAULT 'Group A',
  `semester` varchar(255) NOT NULL DEFAULT 'SEM I',
  `subject_name` varchar(255) DEFAULT NULL,
  `subject_code` varchar(255) DEFAULT NULL,
  `credit` varchar(255) DEFAULT '5',
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `group_name`, `semester`, `subject_name`, `subject_code`, `credit`, `status`) VALUES
(4, 'Group A', 'SEM I', 'Engineering Mathematics-I', '1301 1A1', '5', 'Active'),
(5, 'Group B', 'SEM II', 'Engineering Mathematics-I', '1301 1A1', '5', 'Active'),
(6, 'Group A', 'SEM I', 'Engineering Physics', '1302 1A2', '5', 'Active'),
(7, 'Group B', 'SEM II', 'Engineering Physics', '1302 1A2', '5', 'Active'),
(8, 'Group A', 'SEM I', 'Engineering Mechanics', '1303 1A3', '5', 'Active'),
(9, 'Group B', 'SEM II', 'Engineering Mechanics', '1303 1A3', '5', 'Active'),
(10, 'Group A', 'SEM I', 'Engineering Drawing ', '1304 1A4', '5', 'Active'),
(11, 'Group B', 'SEM II', 'Engineering Drawing ', '1304 1A4', '5', 'Active'),
(12, 'Group A', 'SEM I', 'Workshop-I (Practical)', '1305 1A5', '5', 'Active'),
(13, 'Group B', 'SEM II', 'Workshop-I (Practical)', '1305 1A5', '5', 'Active'),
(14, 'Group A', 'SEM I', 'Engineering Physics (Practical)', '1306 1A6', '5', 'Active'),
(15, 'Group B', 'SEM II', 'Engineering Physics (Practical)', '1306 1A6', '5', 'Active'),
(16, 'Group A', 'SEM I', 'Engineering Mechanics (Practical)', '1307 1A7', '5', 'Active'),
(17, 'Group B', 'SEM II', 'Engineering Mechanics (Practical)', '1307 1A7', '5', 'Active'),
(18, 'Group A', 'SEM I', 'Engineering Drawing (Practical)', '1308 1A8', '5', 'Active'),
(19, 'Group B', 'SEM II', 'Engineering Drawing (Practical)', '1308 1A8', '5', 'Active'),
(20, 'Group B', 'SEM I', 'ENGINEERING MATHEMATICS-II', '10086', '5', 'Active'),
(21, 'Group A', 'SEM II', 'ENGINEERING MATHEMATICS-II', '10086', '5', 'Active'),
(22, 'Group B', 'SEM I', 'ENGINEERING CHEMISTRY', '10087', '5', 'Active'),
(23, 'Group A', 'SEM II', 'ENGINEERING CHEMISTRY', '10087', '5', 'Active'),
(24, 'Group B', 'SEM I', 'COMPUTER PROGRAMMING', '10088', '5', 'Active'),
(25, 'Group A', 'SEM II', 'COMPUTER PROGRAMMING', '10088', '5', 'Active'),
(26, 'Group B', 'SEM I', 'ELECTRICAL ENGINEERING', '10089', '5', 'Active'),
(27, 'Group A', 'SEM II', 'ELECTRICAL ENGINEERING', '10089', '5', 'Active'),
(28, 'Group B', 'SEM I', 'WORKSHOP-II (PRACTICAL)', '10094', '5', 'Active'),
(29, 'Group A', 'SEM II', 'WORKSHOP-II (PRACTICAL)', '10094', '5', 'Active'),
(30, 'Group B', 'SEM I', 'ENGINEERING CHEMISTRY (PRACTICAL)', '10095', '5', 'Active'),
(31, 'Group A', 'SEM II', 'ENGINEERING CHEMISTRY (PRACTICAL)', '10095', '5', 'Active'),
(32, 'Group B', 'SEM I', 'COMPUTER PROGRAMMING (PRACTICAL)', '10096', '5', 'Active'),
(33, 'Group A', 'SEM II', 'COMPUTER PROGRAMMING (PRACTICAL)', '10096', '5', 'Active'),
(34, 'Group B', 'SEM I', 'ELECTRICAL ENGINEERING (PRACTICAL)', '10097', '5', 'Active'),
(35, 'Group A', 'SEM II', 'ELECTRICAL ENGINEERING (PRACTICAL)', '10097', '5', 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

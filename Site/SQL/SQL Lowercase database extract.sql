-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2022 at 05:58 PM
-- Server version: 8.0.28
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `Name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Street_Number` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `Street_Name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Postcode` varchar(8) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`Name`, `Street_Number`, `Street_Name`, `Postcode`) VALUES
('Main Building', '1', 'Mold Road', 'LL11 2AW');

-- --------------------------------------------------------

--
-- Table structure for table `deadlines`
--

CREATE TABLE `deadlines` (
  `Id` int NOT NULL,
  `Module_Id` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Date` datetime NOT NULL,
  `Weight` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `Moodle_Link` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deadlines`
--

INSERT INTO `deadlines` (`Id`, `Module_Id`, `Name`, `Date`, `Weight`, `Moodle_Link`) VALUES
(1, 'COM539', 'asdasdas', '2022-05-18 16:16:01', '', ''),
(2, 'COM539', 'das', '2022-05-03 16:34:00', '12', ''),
(3, 'COM539', 'assignment 1', '2022-05-16 16:35:00', '45', '');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `Name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Code` varchar(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Managed_By` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`Name`, `Code`, `Managed_By`, `Description`) VALUES
('Business', 'BUS', 'Leszek Balcerowicz', ''),
('Computing', 'COM', 'John Doe', ''),
('Education', 'EDU', 'Alex Neill', ''),
('Media', 'MED', 'Merylin Coff', ''),
('Psychology', 'PSY', 'Alex Neill', ''),
('Science', 'SCI', 'Yin Bush', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Id` int NOT NULL,
  `Module` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Room` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Time_From` time NOT NULL,
  `Time_To` time NOT NULL,
  `Description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Group` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`Id`, `Module`, `Room`, `Type`, `Date`, `Time_From`, `Time_To`, `Description`, `Group`) VALUES
(1, 'COM553', 'C124', 'Seminar', '2022-01-31', '13:00:00', '14:00:00', '  ', NULL),
(2, 'COM553', 'C124', 'Seminar', '2022-02-07', '13:00:00', '14:00:00', '  ', NULL),
(3, 'COM553', 'C124', 'Seminar', '2022-02-14', '13:00:00', '14:00:00', '  ', NULL),
(4, 'COM553', 'C124', 'Seminar', '2022-02-21', '13:00:00', '14:00:00', '  ', NULL),
(5, 'COM553', 'C124', 'Seminar', '2022-02-28', '13:00:00', '14:00:00', '  ', NULL),
(6, 'COM553', 'C124', 'Seminar', '2022-03-07', '13:00:00', '14:00:00', '  ', NULL),
(7, 'COM553', 'C124', 'Seminar', '2022-03-14', '13:00:00', '14:00:00', '  ', NULL),
(8, 'COM553', 'C124', 'Seminar', '2022-03-21', '13:00:00', '14:00:00', '  ', NULL),
(9, 'COM553', 'C124', 'Seminar', '2022-03-28', '13:00:00', '14:00:00', '  ', NULL),
(10, 'COM553', 'C124', 'Seminar', '2022-04-04', '13:00:00', '14:00:00', '  ', NULL),
(11, 'COM553', 'C124', 'Seminar', '2022-04-25', '13:00:00', '14:00:00', '  ', NULL),
(12, 'COM553', 'C124', 'Seminar', '2022-05-02', '13:00:00', '14:00:00', '  ', NULL),
(13, 'COM553', 'C124', 'Seminar', '2022-05-09', '13:00:00', '14:00:00', '  ', NULL),
(14, 'COM553', 'B117', 'Tutorials', '2022-01-31', '14:00:00', '16:00:00', '  ', NULL),
(15, 'COM553', 'B117', 'Tutorials', '2022-02-07', '14:00:00', '16:00:00', '  ', NULL),
(16, 'COM553', 'B117', 'Tutorials', '2022-02-14', '14:00:00', '16:00:00', '  ', NULL),
(17, 'COM553', 'B117', 'Tutorials', '2022-02-21', '14:00:00', '16:00:00', '  ', NULL),
(18, 'COM553', 'B117', 'Tutorials', '2022-02-28', '14:00:00', '16:00:00', '  ', NULL),
(19, 'COM553', 'B117', 'Tutorials', '2022-03-07', '14:00:00', '16:00:00', '  ', NULL),
(20, 'COM553', 'B117', 'Tutorials', '2022-03-14', '14:00:00', '16:00:00', '  ', NULL),
(21, 'COM553', 'B117', 'Tutorials', '2022-03-21', '14:00:00', '16:00:00', '  ', NULL),
(22, 'COM553', 'B117', 'Tutorials', '2022-03-28', '14:00:00', '16:00:00', '  ', NULL),
(23, 'COM553', 'B117', 'Tutorials', '2022-04-04', '14:00:00', '16:00:00', '  ', NULL),
(24, 'COM553', 'B117', 'Tutorials', '2022-04-25', '14:00:00', '16:00:00', '  ', NULL),
(25, 'COM553', 'B117', 'Tutorials', '2022-05-02', '14:00:00', '16:00:00', '  ', NULL),
(26, 'COM553', 'B117', 'Tutorials', '2022-05-09', '14:00:00', '16:00:00', '  ', NULL),
(27, 'COM545', 'B118', 'Seminar', '2022-02-01', '09:00:00', '11:00:00', '  ', NULL),
(28, 'COM545', 'B118', 'Seminar', '2022-02-08', '09:00:00', '11:00:00', '  ', NULL),
(29, 'COM545', 'B118', 'Seminar', '2022-02-15', '09:00:00', '11:00:00', '  ', NULL),
(30, 'COM545', 'B118', 'Seminar', '2022-02-22', '09:00:00', '11:00:00', '  ', NULL),
(31, 'COM545', 'B118', 'Seminar', '2022-03-01', '09:00:00', '11:00:00', '  ', NULL),
(32, 'COM545', 'B118', 'Seminar', '2022-03-08', '09:00:00', '11:00:00', '  ', NULL),
(33, 'COM545', 'B118', 'Seminar', '2022-03-15', '09:00:00', '11:00:00', '  ', NULL),
(34, 'COM545', 'B118', 'Seminar', '2022-03-22', '09:00:00', '11:00:00', '  ', NULL),
(35, 'COM545', 'B118', 'Seminar', '2022-03-29', '09:00:00', '11:00:00', '  ', NULL),
(36, 'COM545', 'B118', 'Seminar', '2022-04-05', '09:00:00', '11:00:00', '  ', NULL),
(37, 'COM545', 'B118', 'Seminar', '2022-04-26', '09:00:00', '11:00:00', '  ', NULL),
(38, 'COM545', 'B118', 'Seminar', '2022-05-03', '09:00:00', '11:00:00', '  ', NULL),
(39, 'COM545', 'B118', 'Seminar', '2022-05-10', '09:00:00', '11:00:00', '  ', NULL),
(40, 'COM545', 'B117', 'Practical', '2022-02-01', '11:00:00', '13:00:00', '  ', NULL),
(41, 'COM545', 'B117', 'Practical', '2022-02-08', '11:00:00', '13:00:00', '  ', NULL),
(42, 'COM545', 'B117', 'Practical', '2022-02-15', '11:00:00', '13:00:00', '  ', NULL),
(43, 'COM545', 'B117', 'Practical', '2022-02-22', '11:00:00', '13:00:00', '  ', NULL),
(44, 'COM545', 'B117', 'Practical', '2022-03-01', '11:00:00', '13:00:00', '  ', NULL),
(45, 'COM545', 'B117', 'Practical', '2022-03-08', '11:00:00', '13:00:00', '  ', NULL),
(46, 'COM545', 'B117', 'Practical', '2022-03-15', '11:00:00', '13:00:00', '  ', NULL),
(47, 'COM545', 'B117', 'Practical', '2022-03-22', '11:00:00', '13:00:00', '  ', NULL),
(48, 'COM545', 'B117', 'Practical', '2022-03-29', '11:00:00', '13:00:00', '  ', NULL),
(49, 'COM545', 'B117', 'Practical', '2022-04-05', '11:00:00', '13:00:00', '  ', NULL),
(50, 'COM545', 'B117', 'Practical', '2022-04-26', '11:00:00', '13:00:00', '  ', NULL),
(51, 'COM545', 'B117', 'Practical', '2022-05-03', '11:00:00', '13:00:00', '  ', NULL),
(52, 'COM545', 'B117', 'Practical', '2022-05-10', '11:00:00', '13:00:00', '  ', NULL),
(53, 'COM540', 'B119', 'Practical', '2022-02-01', '13:00:00', '16:00:00', '  ', NULL),
(54, 'COM540', 'B119', 'Practical', '2022-02-08', '13:00:00', '16:00:00', '  ', NULL),
(55, 'COM540', 'B119', 'Practical', '2022-02-15', '13:00:00', '16:00:00', '  ', NULL),
(56, 'COM540', 'B119', 'Practical', '2022-02-22', '13:00:00', '16:00:00', '  ', NULL),
(57, 'COM540', 'B119', 'Practical', '2022-03-01', '13:00:00', '16:00:00', '  ', NULL),
(58, 'COM540', 'B119', 'Practical', '2022-03-08', '13:00:00', '16:00:00', '  ', NULL),
(59, 'COM540', 'B119', 'Practical', '2022-03-15', '13:00:00', '16:00:00', '  ', NULL),
(60, 'COM540', 'B119', 'Practical', '2022-03-22', '13:00:00', '16:00:00', '  ', NULL),
(61, 'COM540', 'B119', 'Practical', '2022-03-29', '13:00:00', '16:00:00', '  ', NULL),
(62, 'COM540', 'B119', 'Practical', '2022-04-05', '13:00:00', '16:00:00', '  ', NULL),
(63, 'COM540', 'B119', 'Practical', '2022-04-26', '13:00:00', '16:00:00', '  ', NULL),
(64, 'COM540', 'B119', 'Practical', '2022-05-03', '13:00:00', '16:00:00', '  ', NULL),
(65, 'COM540', 'B119', 'Practical', '2022-05-10', '13:00:00', '16:00:00', '  ', NULL),
(66, 'COM540', 'B119', 'Self-Directed Study', '2022-02-01', '16:00:00', '17:00:00', '  ', NULL),
(67, 'COM540', 'B119', 'Self-Directed Study', '2022-02-08', '16:00:00', '17:00:00', '  ', NULL),
(68, 'COM540', 'B119', 'Self-Directed Study', '2022-02-15', '16:00:00', '17:00:00', '  ', NULL),
(69, 'COM540', 'B119', 'Self-Directed Study', '2022-02-22', '16:00:00', '17:00:00', '  ', NULL),
(70, 'COM540', 'B119', 'Self-Directed Study', '2022-03-01', '16:00:00', '17:00:00', '  ', NULL),
(71, 'COM540', 'B119', 'Self-Directed Study', '2022-03-08', '16:00:00', '17:00:00', '  ', NULL),
(72, 'COM540', 'B119', 'Self-Directed Study', '2022-03-15', '16:00:00', '17:00:00', '  ', NULL),
(73, 'COM540', 'B119', 'Self-Directed Study', '2022-03-22', '16:00:00', '17:00:00', '  ', NULL),
(74, 'COM540', 'B119', 'Self-Directed Study', '2022-03-29', '16:00:00', '17:00:00', '  ', NULL),
(75, 'COM540', 'B119', 'Self-Directed Study', '2022-04-05', '16:00:00', '17:00:00', '  ', NULL),
(76, 'COM540', 'B119', 'Self-Directed Study', '2022-04-26', '16:00:00', '17:00:00', '  ', NULL),
(77, 'COM540', 'B119', 'Self-Directed Study', '2022-05-03', '16:00:00', '17:00:00', '  ', NULL),
(78, 'COM540', 'B119', 'Self-Directed Study', '2022-05-10', '16:00:00', '17:00:00', '  ', NULL),
(92, 'COM545', 'B118', 'Seminar', '2022-02-02', '09:00:00', '11:00:00', '  ', NULL),
(93, 'COM545', 'B118', 'Seminar', '2022-02-09', '09:00:00', '11:00:00', '  ', NULL),
(94, 'COM545', 'B118', 'Seminar', '2022-02-16', '09:00:00', '11:00:00', '  ', NULL),
(95, 'COM545', 'B118', 'Seminar', '2022-02-23', '09:00:00', '11:00:00', '  ', NULL),
(96, 'COM545', 'B118', 'Seminar', '2022-03-02', '09:00:00', '11:00:00', '  ', NULL),
(97, 'COM545', 'B118', 'Seminar', '2022-03-09', '09:00:00', '11:00:00', '  ', NULL),
(98, 'COM545', 'B118', 'Seminar', '2022-03-16', '09:00:00', '11:00:00', '  ', NULL),
(99, 'COM545', 'B118', 'Seminar', '2022-03-23', '09:00:00', '11:00:00', '  ', NULL),
(100, 'COM545', 'B118', 'Seminar', '2022-03-30', '09:00:00', '11:00:00', '  ', NULL),
(101, 'COM545', 'B118', 'Seminar', '2022-04-06', '09:00:00', '11:00:00', '  ', NULL),
(102, 'COM545', 'B118', 'Seminar', '2022-04-27', '09:00:00', '11:00:00', '  ', NULL),
(103, 'COM545', 'B118', 'Seminar', '2022-05-04', '09:00:00', '11:00:00', '  ', NULL),
(104, 'COM545', 'B118', 'Seminar', '2022-05-11', '09:00:00', '11:00:00', '  ', NULL),
(105, 'COM553', 'C124', 'Exam', '2022-05-09', '09:00:00', '09:00:00', '  ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `Id` int NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Date_From` date NOT NULL,
  `Date_To` date NOT NULL,
  `Description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`Id`, `Name`, `Date_From`, `Date_To`, `Description`) VALUES
(1, 'Easter Break', '2022-04-11', '2022-04-24', 'Two weeks off for easter holidays in semester 2');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers_assignment`
--

CREATE TABLE `lecturers_assignment` (
  `Id` int NOT NULL,
  `Lecturer` varchar(13) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Module` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers_assignment`
--

INSERT INTO `lecturers_assignment` (`Id`, `Lecturer`, `Module`) VALUES
(1, '2384923019287', 'COM539'),
(2, '2384923019287', 'COM545'),
(3, '2384923019287', 'COM553');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `Id` int NOT NULL,
  `Username` varchar(13) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`Id`, `Username`, `Password`) VALUES
(1, '2384923019287', '1234'),
(2, 'admin', 'admin'),
(3, 'root', 'mysql'),
(4, 'S19005373', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `Id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Moodle_Link` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`Id`, `Name`, `Description`, `Moodle_Link`) VALUES
('COM537', 'Applied Programming', '  ', 'https://moodle.glyndwr.ac.uk/course/view.php?id=36930'),
('COM539', 'Data Structures and Algorithms', 'Maths module', 'https://moodle.glyndwr.ac.uk/course/view.php?id=35178'),
('COM540', 'Databases and Web-based Information Systems', '', 'https://moodle.glyndwr.ac.uk/course/view.php?id=35179'),
('COM545', 'Responsible Computing', '', 'https://moodle.glyndwr.ac.uk/course/view.php?id=35184'),
('COM553', 'Group Project', '', 'https://moodle.glyndwr.ac.uk/course/view.php?id=39159'),
('COM556', 'User Experience Design', '  ', 'https://moodle.glyndwr.ac.uk/course/view.php?id=35195');

-- --------------------------------------------------------

--
-- Table structure for table `module_assignment`
--

CREATE TABLE `module_assignment` (
  `Id` int NOT NULL,
  `Programme` int DEFAULT NULL,
  `Module` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Semester` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_assignment`
--

INSERT INTO `module_assignment` (`Id`, `Programme`, `Module`, `Semester`) VALUES
(1, 1, 'COM539', 1),
(2, 1, 'COM540', 2),
(3, 1, 'COM553', 2),
(4, 1, 'COM545', 2),
(5, 1, 'COM537', 1),
(6, 1, 'COM556', 1);

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `Id` int NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Degree` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `Department` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Level` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `Type` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`Id`, `Name`, `Degree`, `Department`, `Level`, `Type`, `Start_Date`, `End_Date`, `Description`) VALUES
(1, 'Computer Science', 'BSc (Hons)', 'Computing', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(2, 'Computing', 'BSc (Hons)', 'Computing', '4', 'Full Time', '2021-09-20', '2022-07-01', ''),
(3, 'Computer Game Development', 'BSc (Hons)', 'Computing', '4', 'Full Time', '2021-09-20', '2022-07-01', ''),
(4, 'Computer Network & Security', 'BSc (Hons)', 'Computing', '6', 'Part Time', '2021-09-20', '2022-07-01', ''),
(5, 'Construction Management', 'BSc (Hons)', 'Computing', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(8, 'Forensic Science', 'BSc (Hons)', 'Science', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(9, 'Biochemistry', 'BSc (Hons)', 'Science', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(10, 'Media Production', 'BSc (Hons)', 'Media', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(11, 'Television Production', 'BSc (Hons)', 'Media', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(12, 'Law and Business', 'BSc (Hons)', 'Business', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(13, 'Marketing and Business', 'BSc (Hons)', 'Business', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(14, 'Education', 'BSc (Hons)', 'Education', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(15, 'Primary Education with QTS', 'BSc (Hons)', 'Education', '5', 'Full Time', '2021-09-20', '2022-07-01', '');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `Id` int NOT NULL,
  `User_Id` varchar(13) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Status` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`Id`, `User_Id`, `Type`, `Description`, `Status`) VALUES
(1, '2384923019287', 'Room', 'dasdasda', 0),
(3, '2384923019287', 'Room', 'I\'d like to request a room change', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `Id` int NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Access_Level` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `Description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Id`, `Name`, `Access_Level`, `Description`) VALUES
(1, 'Root', '0', 'Root access, full control over servers and database'),
(2, 'Admin', '1', 'Admin, access to database'),
(3, 'Lecturer', '3', 'User, requests allowed'),
(4, 'Undergraduate Student', '4', 'User, restricted access');

-- --------------------------------------------------------

--
-- Table structure for table `role_assignment`
--

CREATE TABLE `role_assignment` (
  `Id` int NOT NULL,
  `Role` int DEFAULT NULL,
  `User` varchar(13) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_assignment`
--

INSERT INTO `role_assignment` (`Id`, `Role`, `User`) VALUES
(1, 4, 'S19005373'),
(2, 3, '2384923019287'),
(3, 1, 'root'),
(4, 2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `Number` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `Building` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Number_Of_Seats` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Equipment` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Section` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`Number`, `Building`, `Number_Of_Seats`, `Type`, `Equipment`, `Section`) VALUES
('A102', 'Main Building', '65', 'Lecture Room', '', 'A'),
('B115', 'Main Building', '35', 'Lecture Room', '', 'B'),
('B117', 'Main Building', '25', 'PC Room', 'Projector, 20 pc\'s', 'B'),
('B118', 'Main Building', '60', 'Lecture Room', 'Projector', 'B'),
('B119', 'Main Building', '25', 'PC Room', 'Projector, 20 pcs', 'B'),
('C124', 'Main Building', '60', 'Lecture Room', 'Projector', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `Id` int NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Year` varchar(8) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`Id`, `Start_Date`, `End_Date`, `Year`, `Name`) VALUES
(1, '2021-09-20', '2022-01-28', '21/22', 'Semester 1'),
(2, '2022-01-31', '2022-05-15', '21/22', 'Semester 2'),
(3, '2022-09-20', '2023-01-28', '22/23', 'Semester 1'),
(4, '2023-01-31', '2023-05-15', '22/23', 'Semester 2');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `User` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `Color_Scheme` char(1) COLLATE utf8mb4_general_ci DEFAULT '1',
  `Notifications` char(1) COLLATE utf8mb4_general_ci DEFAULT '1',
  `Default_View` char(1) COLLATE utf8mb4_general_ci DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`User`, `Color_Scheme`, `Notifications`, `Default_View`) VALUES
('S19005373', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `student_enrolment`
--

CREATE TABLE `student_enrolment` (
  `Id` int NOT NULL,
  `Student` varchar(13) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Programme` int DEFAULT NULL,
  `Date_Enrolled` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Date_Finished` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_enrolment`
--

INSERT INTO `student_enrolment` (`Id`, `Student`, `Programme`, `Date_Enrolled`, `Date_Finished`) VALUES
(1, 'S19005373', 1, '2022-05-02 13:38:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_group`
--

CREATE TABLE `student_group` (
  `Id` int NOT NULL,
  `Module` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `User` varchar(13) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Group_Name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `First_Name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Surname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Title` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Gender` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Birth_Date` date NOT NULL,
  `Priv_Email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Uni_Email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Telephone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Next_Of_Kin` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Street_Number` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `Street_Name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Postcode` varchar(8) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `First_Name`, `Surname`, `Title`, `Gender`, `Birth_Date`, `Priv_Email`, `Uni_Email`, `Telephone`, `Next_Of_Kin`, `Street_Number`, `Street_Name`, `Postcode`) VALUES
('1084955013287', 'Terri', 'Davies', 'Mrs', 'Female', '1982-12-01', 'terri.d@gmail.com', 't.davies@mail.glyndwr.ac.uk', '+4407923426783', 'Husband, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('1386523224287', 'Will', 'Rogers', 'Mr', 'Male', '1987-08-15', 'will.rogers@gmail.com', 'r.will@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('2384923019287', 'Mark', 'Lewis', 'Mr', 'Male', '1986-10-01', 'lewis.mark69@gmail.com', 'm.lewis@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('6549923016287', 'Neil', 'Pickles', 'Mr', 'Male', '1976-11-21', 'n.pickles@gmail.com', 'n.pickle@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('7384429399287', 'Regan', 'Williams', 'Mr', 'Male', '1988-10-24', 'reg.williams@gmail.com', 'r.williams@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('7789001019287', 'Susan', 'Liggett', 'Mrs', 'Female', '1990-03-31', 'susan.liggett@gmail.com', 's.liggett@mail.glyndwr.ac.uk', '+4407923426783', 'Husband, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('admin', 'admin', 'user', 'Mr', 'Male', '1991-11-21', 'dawidolesko@gmail.com', 'S19005373@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('root', 'Root', 'User', '', '', '1991-11-21', 'dawidolesko@gmail.com', 'root@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S18001921', 'Tammy', 'Jones', 'Mr', 'Male', '1981-09-22', 't.jones@gmail.com', 'S18001921@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S18002131', 'Celeste', 'Star', 'Mrs', 'Female', '1976-12-24', 'c.star@gmail.com', 'S18002131@mail.glyndwr.ac.uk', '+4407923426783', 'Husband, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19001784', 'Misha', 'Cardenas', 'Mrs', 'Female', '1993-07-05', 'm.cardenas@gmail.com', 'S19001784@mail.glyndwr.ac.uk', '+4407923426783', 'Husband, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19002171', 'Johnathan', 'Haslsall', 'Mr', 'Male', '1989-10-20', 'j.halsall@gmail.com', 'S19002171@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19002485', 'Jessica', 'Muirhead', 'Mrs', 'Female', '1978-02-08', 'j.muirhead@gmail.com', 'S19002485@mail.glyndwr.ac.uk', '+4407923426783', 'Husband, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19002584', 'Matthew', 'Halliday', 'Mr', 'Male', '1995-11-17', 'm.halliday@gmail.com', 'S19002584@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19002861', 'Anthony', 'Goff', 'Mr', 'Male', '1981-01-21', 'a.goff@gmail.com', 'S19002861@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19005373', 'Dawid', 'Olesko', 'Mr', 'Male', '1991-11-21', 'dawidolesko@gmail.com', 'S19005373@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S20000868', 'Huseyin', 'Ucur', 'Mr', 'Male', '2000-07-02', 'h.ucur@gmail.com', 'S20000868@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S20001713', 'Greig', 'Emmesis', 'Mr', 'Male', '2000-06-29', 'g.emmesis@gmail.com', 'S20001713@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S20002863', 'Christopher', 'Thomas', 'Mr', 'Male', '2000-12-01', 'ch.thomas@gmail.com', 'S20002863@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM');

-- --------------------------------------------------------

--
-- Table structure for table `user_events`
--

CREATE TABLE `user_events` (
  `Id` int NOT NULL,
  `User` varchar(13) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time_From` time NOT NULL,
  `Time_To` time NOT NULL,
  `Description` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_events`
--

INSERT INTO `user_events` (`Id`, `User`, `Name`, `Date`, `Time_From`, `Time_To`, `Description`) VALUES
(1, 'S19005373', 'dasd', '2022-05-05', '09:00:00', '10:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `deadlines`
--
ALTER TABLE `deadlines`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Module_Id` (`Module_Id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Room` (`Room`),
  ADD KEY `Group` (`Group`),
  ADD KEY `Module` (`Module`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `lecturers_assignment`
--
ALTER TABLE `lecturers_assignment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Module` (`Module`),
  ADD KEY `Lecturer` (`Lecturer`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `module_assignment`
--
ALTER TABLE `module_assignment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Programme` (`Programme`),
  ADD KEY `Semester` (`Semester`),
  ADD KEY `Module` (`Module`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Department` (`Department`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Type` (`Type`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `role_assignment`
--
ALTER TABLE `role_assignment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Role` (`Role`),
  ADD KEY `User` (`User`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`Number`,`Building`),
  ADD KEY `Building` (`Building`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`User`);

--
-- Indexes for table `student_enrolment`
--
ALTER TABLE `student_enrolment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Student` (`Student`),
  ADD KEY `Programme` (`Programme`);

--
-- Indexes for table `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Module` (`Module`),
  ADD KEY `User` (`User`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_events`
--
ALTER TABLE `user_events`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User` (`User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deadlines`
--
ALTER TABLE `deadlines`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lecturers_assignment`
--
ALTER TABLE `lecturers_assignment`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module_assignment`
--
ALTER TABLE `module_assignment`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_assignment`
--
ALTER TABLE `role_assignment`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_enrolment`
--
ALTER TABLE `student_enrolment`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_group`
--
ALTER TABLE `student_group`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_events`
--
ALTER TABLE `user_events`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deadlines`
--
ALTER TABLE `deadlines`
  ADD CONSTRAINT `deadlines_ibfk_1` FOREIGN KEY (`Module_Id`) REFERENCES `modules` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`Module`) REFERENCES `modules` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`Room`) REFERENCES `rooms` (`Number`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`Group`) REFERENCES `student_group` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `lecturers_assignment`
--
ALTER TABLE `lecturers_assignment`
  ADD CONSTRAINT `lecturers_assignment_ibfk_1` FOREIGN KEY (`Module`) REFERENCES `modules` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lecturers_assignment_ibfk_2` FOREIGN KEY (`Lecturer`) REFERENCES `users` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `logins_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `users` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `module_assignment`
--
ALTER TABLE `module_assignment`
  ADD CONSTRAINT `module_assignment_ibfk_1` FOREIGN KEY (`Programme`) REFERENCES `programmes` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `module_assignment_ibfk_2` FOREIGN KEY (`Semester`) REFERENCES `semesters` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `module_assignment_ibfk_3` FOREIGN KEY (`Module`) REFERENCES `modules` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `programmes`
--
ALTER TABLE `programmes`
  ADD CONSTRAINT `programmes_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `departments` (`Name`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `users` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `role_assignment`
--
ALTER TABLE `role_assignment`
  ADD CONSTRAINT `role_assignment_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `roles` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_assignment_ibfk_2` FOREIGN KEY (`User`) REFERENCES `users` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`Building`) REFERENCES `buildings` (`Name`) ON DELETE CASCADE;

--
-- Constraints for table `student_enrolment`
--
ALTER TABLE `student_enrolment`
  ADD CONSTRAINT `student_enrolment_ibfk_1` FOREIGN KEY (`Student`) REFERENCES `users` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_enrolment_ibfk_2` FOREIGN KEY (`Programme`) REFERENCES `programmes` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `student_group`
--
ALTER TABLE `student_group`
  ADD CONSTRAINT `student_group_ibfk_1` FOREIGN KEY (`Module`) REFERENCES `modules` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_group_ibfk_2` FOREIGN KEY (`User`) REFERENCES `users` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `user_events`
--
ALTER TABLE `user_events`
  ADD CONSTRAINT `user_events_ibfk_1` FOREIGN KEY (`User`) REFERENCES `users` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

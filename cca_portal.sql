-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2023 at 05:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cca_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` bigint(20) NOT NULL,
  `year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `year`, `semester`, `is_active`) VALUES
(1, '2021-2022', '1st', 0),
(2, '2021-2022', '2nd', 0),
(3, '2021-2022', 'Summer', 0),
(4, '2022-2023', '1st', 0),
(5, '2022-2023', '2nd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `accomplishment_reports`
--

CREATE TABLE `accomplishment_reports` (
  `id` int(11) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `coverage` varchar(255) NOT NULL,
  `accomplishments` longtext NOT NULL,
  `submitted` date NOT NULL,
  `academic_year` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accomplishment_reports`
--

INSERT INTO `accomplishment_reports` (`id`, `faculty`, `reference_number`, `coverage`, `accomplishments`, `submitted`, `academic_year`) VALUES
(1, '1', 'CCA-9876', 'June 12-16', 'Completed research on AI applications in healthcare and presented findings at a conference. Assisted in developing a new software module for data analysis.', '2023-06-17', 5),
(2, '2', 'CCA-8765', 'June 12-16', 'Delivered lectures on information retrieval techniques to undergraduate students. Provided guidance and support to students during office hours.', '2023-06-17', 5),
(3, '3', 'CCA-7654', 'June 12-16', 'Published a research paper on renewable energy technologies in a reputable journal. Conducted experiments to optimize solar cell performance.', '2023-06-17', 5),
(4, '4', 'CCA-6543', 'June 12-16', 'Developed a new marketing campaign for a client, resulting in a 15% increase in customer engagement. Attended a professional development workshop on digital advertising strategies.', '2023-06-17', 5),
(5, '5', 'CCA-5432', 'June 12-16', 'Collaborated with a team to design and implement a database management system for a large-scale project. Conducted performance testing and optimized query execution.', '2023-06-17', 5),
(6, '6', 'CCA-4321', 'June 12-16', 'Assisted in organizing a national conference on environmental sustainability. Presented a poster on water conservation methods at the conference.', '2023-06-17', 5),
(7, '7', 'CCA-3210', 'June 12-16', 'Led a team of software developers in the successful deployment of a web application for a client. Conducted code reviews and provided technical guidance to team members.', '2023-06-17', 5),
(8, '8', 'CCA-2109', 'June 12-16', 'Developed and delivered a workshop on data visualization techniques to graduate students. Collaborated with faculty members on a research project focusing on data analytics.', '2023-06-17', 5),
(9, '9', 'CCA-1098', 'June 12-16', 'Received a research grant for studying the effects of climate change on biodiversity. Conducted field surveys and collected data for analysis.', '2023-06-17', 5),
(10, '10', 'CCA-0987', 'June 12-16', 'Designed and implemented a user interface for a mobile application. Conducted usability testing and incorporated user feedback for iterative improvements.', '2023-06-17', 5);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `academic_year` bigint(20) NOT NULL,
  `institute` bigint(20) NOT NULL,
  `course` bigint(20) NOT NULL,
  `subject` bigint(20) NOT NULL,
  `section` bigint(20) NOT NULL,
  `faculty` bigint(20) DEFAULT NULL,
  `synch_day` varchar(255) NOT NULL,
  `synch_time` time NOT NULL,
  `synch_duration` int(11) NOT NULL,
  `synch_room` bigint(20) NOT NULL,
  `asynch_day` varchar(255) DEFAULT NULL,
  `asynch_time` time DEFAULT NULL,
  `asynch_duration` int(11) NOT NULL,
  `asynch_room` bigint(20) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `remarks` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_code`, `academic_year`, `institute`, `course`, `subject`, `section`, `faculty`, `synch_day`, `synch_time`, `synch_duration`, `synch_room`, `asynch_day`, `asynch_time`, `asynch_duration`, `asynch_room`, `status`, `remarks`) VALUES
(87, 'C006', 5, 3, 9, 10, 2, 4, 'Monday', '06:30:00', 3, 5, 'Tuesday', '09:30:00', 3, 4, 'Dropped', NULL),
(88, 'C007', 5, 3, 9, 2, 2, 2, 'Friday', '09:30:00', 3, 5, 'Saturday', '09:30:00', 3, 4, 'Dropped', NULL),
(89, 'C008', 5, 3, 9, 3, 2, 1, 'Saturday', '12:30:00', 3, 5, 'Wednesday', '09:30:00', 3, 4, 'Dropped', NULL),
(90, 'C009', 5, 3, 9, 5, 2, 8, 'Monday', '16:00:00', 3, 5, 'Thursday', '12:30:00', 3, 4, 'Dropped', NULL),
(91, 'C0011', 5, 3, 9, 1, 2, 9, 'Friday', '12:30:00', 3, 5, 'Monday', '12:30:00', 3, 4, 'Dropped', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `id` bigint(20) NOT NULL,
  `student` bigint(20) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `academics` int(11) NOT NULL DEFAULT 1,
  `library` int(11) NOT NULL DEFAULT 1,
  `registrar` int(11) NOT NULL DEFAULT 1,
  `remarks` varchar(255) DEFAULT NULL,
  `academic_year` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clearance`
--

INSERT INTO `clearance` (`id`, `student`, `reference_number`, `academics`, `library`, `registrar`, `remarks`, `academic_year`, `status`) VALUES
(17, 17, '20-0001', 0, 0, 0, NULL, 5, 0),
(18, 18, '20-0002', 0, 0, 0, NULL, 5, 0),
(19, 19, '20-0003', 0, 0, 0, NULL, 5, 0),
(20, 20, '20-0004', 0, 0, 0, NULL, 5, 0),
(21, 21, '20-0005', 0, 0, 0, NULL, 5, 0),
(22, 22, '20-0006', 0, 0, 0, NULL, 5, 0),
(23, 23, '20-0007', 0, 0, 0, NULL, 5, 0),
(24, 24, '20-0008', 0, 0, 0, NULL, 5, 0),
(25, 25, '20-0009', 0, 0, 0, NULL, 5, 0),
(26, 26, '20-0010', 0, 0, 0, NULL, 5, 0),
(27, 27, '20-0011', 0, 0, 0, NULL, 5, 0),
(28, 28, '20-0012', 0, 0, 0, NULL, 5, 0),
(29, 29, '20-0013', 0, 0, 0, NULL, 5, 0),
(30, 30, '20-0014', 0, 0, 0, NULL, 5, 0),
(31, 31, '20-0015', 0, 0, 0, NULL, 5, 0),
(32, 32, '20-0016', 0, 0, 0, NULL, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `section_prefix` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_title`, `institute`, `section_prefix`) VALUES
(1, 'BSA', 'Bachelor of Science in Accountancy', 'IBM', 'A'),
(2, 'BSE', 'Bachelor of Science in Entrepreneurship', 'IBM', 'E'),
(3, 'BSTM', 'Bachelor of Science in Tourism Management', 'IBM', 'T'),
(4, 'BSCS', 'Bachelor of Science in Computer Science', 'ICSLIS', 'C'),
(5, 'ACT', 'Associate in Computer Technology', 'ICSLIS', 'ACT'),
(6, 'BSIS', 'Bachelor of Science in Information Systems', 'ICSLIS', 'I'),
(7, 'BLIS', 'Bachelor of Library and Information Science', 'ICSLIS', 'L'),
(8, 'BSM', 'Bachelor of Science in Mathematics', 'IEAS', 'M'),
(9, 'BSNE', 'Bachelor of Special Needs Education', 'IEAS', 'BSNE'),
(10, 'BSP', 'Bachelor of Science in Psychology', 'IEAS', 'PSYCH'),
(11, 'BPE', 'Bachelor of Physical Education', 'IEAS', 'BPE'),
(12, 'BTVTED', 'Bachelor of Technical Vocational Teacher Education', 'IEAS', 'TE'),
(13, 'BAELS', 'Bachelor of Arts in English Language Studies', 'IEAS', 'BAELS');

-- --------------------------------------------------------

--
-- Table structure for table `dtr_reports`
--

CREATE TABLE `dtr_reports` (
  `id` bigint(20) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `day` varchar(255) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `total_hours` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dtr_reports`
--

INSERT INTO `dtr_reports` (`id`, `faculty`, `reference_number`, `date`, `day`, `time_in`, `time_out`, `status`, `total_hours`, `remarks`) VALUES
(1, '1', 'CCA-9876', '2023-06-10', 'Friday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(2, '1', 'CCA-9876', '2023-06-11', 'Saturday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(3, '1', 'CCA-9876', '2023-06-12', 'Sunday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(4, '2', 'CCA-8765', '2023-06-10', 'Friday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(5, '2', 'CCA-8765', '2023-06-11', 'Saturday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(6, '2', 'CCA-8765', '2023-06-12', 'Sunday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(7, '3', 'CCA-7654', '2023-06-10', 'Friday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(8, '3', 'CCA-7654', '2023-06-11', 'Saturday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(9, '3', 'CCA-7654', '2023-06-12', 'Sunday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(10, '4', 'CCA-6543', '2023-06-10', 'Friday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(11, '4', 'CCA-6543', '2023-06-11', 'Saturday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(12, '4', 'CCA-6543', '2023-06-12', 'Sunday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(13, '5', 'CCA-5432', '2023-06-10', 'Friday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(14, '5', 'CCA-5432', '2023-06-11', 'Saturday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(15, '5', 'CCA-5432', '2023-06-12', 'Sunday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(16, '6', 'CCA-4321', '2023-06-10', 'Friday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(17, '6', 'CCA-4321', '2023-06-11', 'Saturday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(18, '6', 'CCA-4321', '2023-06-12', 'Sunday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(19, '7', 'CCA-3210', '2023-06-10', 'Friday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(20, '7', 'CCA-3210', '2023-06-11', 'Saturday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(21, '7', 'CCA-3210', '2023-06-12', 'Sunday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(22, '8', 'CCA-2109', '2023-06-10', 'Friday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(23, '8', 'CCA-2109', '2023-06-11', 'Saturday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(24, '8', 'CCA-2109', '2023-06-12', 'Sunday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(25, '9', 'CCA-1098', '2023-06-10', 'Friday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(26, '9', 'CCA-1098', '2023-06-11', 'Saturday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(27, '9', 'CCA-1098', '2023-06-12', 'Sunday', '08:00:00', '17:00:00', 'Completed', 8, NULL),
(28, '10', 'CCA-0987', '2023-06-10', 'Friday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(29, '10', 'CCA-0987', '2023-06-11', 'Saturday', '08:00:00', '12:00:00', 'Completed', 4, NULL),
(30, '10', 'CCA-0987', '2023-06-12', 'Sunday', '08:00:00', '12:00:00', 'Completed', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_reports`
--

CREATE TABLE `evaluation_reports` (
  `id` bigint(20) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `vpaa` float DEFAULT NULL,
  `dean` float DEFAULT NULL,
  `coordinator` float DEFAULT NULL,
  `student` float DEFAULT NULL,
  `peer` float DEFAULT NULL,
  `self` float DEFAULT NULL,
  `overall` float DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `academic_year` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_reports`
--

INSERT INTO `evaluation_reports` (`id`, `faculty`, `reference_number`, `vpaa`, `dean`, `coordinator`, `student`, `peer`, `self`, `overall`, `remarks`, `academic_year`) VALUES
(1, '1', 'CCA-9876', 4.5, 4.8, 4.75, 4.9, 4.85, 4.75, 4.75, 'Good performance', 5),
(2, '2', 'CCA-8765', 4.9, 4.7, 4.8, 4.95, 4.75, 4.8, 4.8, 'Satisfactory performance', 5),
(3, '3', 'CCA-7654', 4.8, 4.9, 4.85, 4.75, 4.8, 4.85, 4.85, 'Excellent performance', 5),
(4, '4', 'CCA-6543', 4.75, 4.8, 4.9, 4.85, 4.75, 4.8, 4.8, 'Satisfactory performance', 5),
(5, '5', 'CCA-5432', 4.85, 4.75, 4.8, 4.9, 4.85, 4.75, 4.75, 'Good performance', 5),
(6, '6', 'CCA-4321', 4.7, 4.85, 4.75, 4.8, 4.9, 4.85, 4.85, 'Excellent performance', 5),
(7, '7', 'CCA-3210', 4.75, 4.9, 4.85, 4.75, 4.8, 4.9, 4.9, 'Good performance', 5),
(8, '8', 'CCA-2109', 4.95, 4.8, 4.9, 4.85, 4.75, 4.8, 4.8, 'Satisfactory performance', 5),
(9, '9', 'CCA-1098', 4.8, 4.75, 4.8, 4.9, 4.85, 4.75, 4.75, 'Excellent performance', 5),
(10, '10', 'CCA-0987', 4.85, 4.9, 4.75, 4.8, 4.75, 4.9, 4.9, 'Good performance', 5);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` bigint(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `firstname`, `lastname`, `middlename`, `suffix`, `institute`, `reference_number`, `type`) VALUES
(5, 'Jon', 'Dela Cruz', NULL, NULL, 'ICSLIS', 'CCA23_CJD0003', 'COS Part Time'),
(6, 'Jones', 'Hernandez', NULL, NULL, 'IEAS', 'CCA23_EJH0001', 'COS Full Time'),
(7, 'Keith', 'Guzman', 'Lumbang', NULL, 'IBM', 'CCA23_BKG0002', 'Plantilla Permanent'),
(8, 'Sally', 'Delos Santos', 'Juco', 'Sr.', 'IBM', 'CCA23_BSD0003', 'Plantilla Temporary');

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` bigint(20) NOT NULL,
  `institute_code` varchar(255) NOT NULL,
  `institute_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `institute_code`, `institute_name`) VALUES
(1, 'IBM', 'Institute of Business and Management'),
(2, 'ICSLIS', 'Institute of Computing Studies and Library Information Science'),
(3, 'IEAS', 'Institute of Education, Arts and Sciences'),
(4, 'MISSO', 'Multimedia and Information Systems Services Office'),
(5, 'NTPs', 'Non Teaching Personnels');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_code` varchar(255) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_code`, `room_name`, `type`, `location`, `status`) VALUES
(1, 'L201', 'Lecture Room 1', 'Lecture', 'Main Building', 'Available'),
(2, 'L202', 'Lecture Room 2', 'Lecture', 'Main Building', 'Available'),
(3, 'CLAB1', 'Computer Lab 1', 'Laboratory', 'Main Building', 'Available'),
(4, 'KLAB1', 'Kitchen Lab 1', 'Laboratory', 'Main Building', 'Available'),
(5, 'GYM', 'Gymnasium', 'Lecture', 'Gymnasium', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) NOT NULL,
  `section` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_level` int(255) NOT NULL,
  `adviser` varchar(255) DEFAULT NULL,
  `academic_year` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section`, `course`, `year_level`, `adviser`, `academic_year`) VALUES
(1, 'I401', 'BSIS', 4, NULL, 5),
(2, 'I402', 'BSIS', 4, NULL, 5),
(3, 'L401', 'BLIS', 4, NULL, 5),
(4, 'L402', 'BLIS', 4, NULL, 5),
(6, 'C402', 'BSCS', 4, NULL, 5),
(7, 'A401', 'BSA', 4, NULL, 5),
(8, 'A402', 'BSA', 4, NULL, 5),
(9, 'A403', 'BSA', 4, NULL, 5),
(10, 'A404', 'BSA', 4, NULL, 5),
(11, 'A105', 'BSA', 1, NULL, 5),
(13, 'A106', 'BSA', 1, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `course` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `year_level` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `academic_year` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `reference_number`, `firstname`, `lastname`, `middlename`, `suffix`, `course`, `section`, `year_level`, `type`, `academic_year`) VALUES
(17, '20-0001', 'John', 'Doe', 'Michael', 'Jr', 'BSIS', 'I402', 4, 'Regular', 5),
(18, '20-0002', 'Jane', 'Smith', 'Marie', NULL, 'BSCS', 'C402', 4, 'Irregular', 5),
(19, '20-0003', 'Robert', 'Johnson', 'Lee', NULL, 'BLIS', 'L402', 4, 'Irregular', 4),
(20, '20-0004', 'Emily', 'Anderson', 'Grace', NULL, 'BSA', 'A402', 4, 'Regular', 5),
(21, '20-0005', 'Michael', 'Davis', 'Peter', NULL, 'BSIS', 'I402', 4, 'Regular', 5),
(22, '20-0006', 'Jessica', 'Taylor', 'Ann', NULL, 'BSCS', 'C402', 4, 'Regular', 4),
(23, '20-0007', 'William', 'Wilson', 'Thomas', NULL, 'BLIS', 'L402', 4, 'Regular', 4),
(24, '20-0008', 'Sophia', 'Miller', 'Elizabeth', NULL, 'BSA', 'A402', 4, 'Regular', 5),
(25, '20-0009', 'David', 'Moore', 'Daniel', NULL, 'BSIS', 'I402', 4, 'Regular', 5),
(26, '20-0010', 'Olivia', 'Anderson', 'Emma', NULL, 'BSCS', 'C402', 4, 'Regular', 5),
(27, '20-0011', 'James', 'Johnson', 'Andrew', NULL, 'BLIS', 'L402', 4, 'Regular', 4),
(28, '20-0012', 'Ava', 'Williams', 'Isabella', NULL, 'BSA', 'A402', 4, 'Irregular', 5),
(29, '20-0013', 'John', 'Davis', 'Samuel', NULL, 'BSIS', 'I402', 4, 'Regular', 5),
(30, '20-0014', 'Emma', 'Brown', 'Grace', NULL, 'BSCS', 'C402', 4, 'Regular', 4),
(31, '20-0015', 'Daniel', 'Taylor', 'Michael', NULL, 'BLIS', 'L402', 4, 'Regular', 5),
(32, '20-0016', 'Sophia', 'Jones', 'Elizabeth', NULL, 'BSA', 'A402', 4, 'Regular', 5);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_title` varchar(255) NOT NULL,
  `lecture_hours` int(11) NOT NULL,
  `laboratory_hours` int(11) NOT NULL,
  `credited_units` int(11) NOT NULL,
  `prerequisite(s)` varchar(255) DEFAULT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject_title`, `lecture_hours`, `laboratory_hours`, `credited_units`, `prerequisite(s)`, `year`) VALUES
(1, 'MATH101', 'College Algebra', 3, 0, 3, NULL, 1),
(2, 'ENG102', 'English Composition', 3, 0, 3, NULL, 1),
(3, 'CHEM201', 'General Chemistry', 2, 3, 4, NULL, 2),
(4, 'BIO301', 'Biology 1', 3, 1, 4, NULL, 3),
(5, 'PHYS101', 'Physics 1', 3, 2, 4, NULL, 1),
(6, 'HIST202', 'World History', 3, 0, 3, NULL, 2),
(7, 'PSYC301', 'Introduction to Psychology', 3, 0, 3, NULL, 3),
(8, 'ARTS103', 'Introduction to Visual Arts', 2, 1, 3, NULL, 1),
(9, 'COMP401', 'Computer Programming', 3, 2, 4, 'CHEM201', 4),
(10, 'SOC101', 'Introduction to Sociology', 3, 0, 3, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` bigint(20) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `institute` varchar(255) NOT NULL,
  `course` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `initial_password` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `current_login` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `avatar`, `firstname`, `lastname`, `middlename`, `suffix`, `institute`, `course`, `email`, `username`, `initial_password`, `password`, `role`, `last_login`, `current_login`, `is_active`) VALUES
(1, 'cca-avatar.png', 'Admin', 'CCA', NULL, NULL, 'MISSO', NULL, 'CCA-Admin@cca.edu.ph', 'CCA-Admin', 'changed', '$2y$10$AGkdHZZGPoAupwxfbpWTx.ardK0dew/gNzV3prryRB15AlA8tX2uC', 'Admin', '2023-07-02 14:36:52', '2023-07-02 21:10:35', 1),
(25, 'cca-avatar.png', 'IBM', 'Dean', NULL, NULL, 'IBM', NULL, 'ibmdean@cca.edu.ph', 'IBM-Dean', 'changed', '$2y$10$a8qypk3s7wqeI7mLRl.ik.FmB.gXqYxYQPgqmxTayR4kwQsqQzbn.', 'Dean', '2023-06-04 20:47:04', '2023-06-04 20:47:04', 1),
(26, 'cca-avatar.png', 'ICSLIS', 'Dean', NULL, NULL, 'ICSLIS', NULL, 'icslisdean@cca.edu.ph', 'ICSLIS-Dean', 'changed', '$2y$10$XrEVl3lGO5GZ0rYh/ndgfuHLcHFJU0whI7a7W06KZVa83F1HMa6SG', 'Dean', '2023-06-04 20:47:13', '2023-06-04 20:47:13', 1),
(27, 'cca-avatar.png', 'IEAS', 'Dean', NULL, NULL, 'IEAS', NULL, 'ieasdean@cca.edu.ph', 'IEAS-Dean', 'changed', '$2y$10$XOxk2Vmvh1dNd30C9kepy.XUl50HZLNKBTDacTukK7Sm3up4Ak..C', 'Dean', '2023-06-04 20:47:26', '2023-06-04 20:47:26', 1),
(34, 'avatar.png', 'Wendell', 'Gueco', 'Cortez', NULL, 'ICSLIS', 'BSIS', NULL, 'CCA23_WG0000', 'changed', '$2y$10$N.o2TwgZ3ZFq8lUitoOKseubtBsnZMU/zY.K7ennUzpp5uTw7wGHW', 'Student', '2023-06-10 22:07:55', '2023-06-10 22:08:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` bigint(20) NOT NULL,
  `user` bigint(20) NOT NULL,
  `action` varchar(255) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user`, `action`, `item_type`, `item`, `details`, `date_time`) VALUES
(1, 1, 'Added', 'product', '237', 'User added a new item', '2023-06-04 22:22:45'),
(2, 11, 'Deleted', 'order', '125', 'User deleted an order', '2023-06-04 22:22:45'),
(3, 24, 'Edited', 'profile', '389', 'User edited their profile', '2023-06-04 22:22:45'),
(4, 25, 'Added', 'product', '42', 'User added a new item', '2023-06-04 22:22:45'),
(5, 26, 'Deleted', 'order', '481', 'User deleted an order', '2023-06-04 22:22:45'),
(6, 27, 'Edited', 'profile', '267', 'User edited their profile', '2023-06-04 22:22:45'),
(7, 1, 'Added', 'product', '555', 'User added a new item', '2023-06-04 22:22:45'),
(8, 11, 'Deleted', 'order', '777', 'User deleted an order', '2023-06-04 22:22:45'),
(9, 24, 'Edited', 'profile', '999', 'User edited their profile', '2023-06-04 22:22:45'),
(10, 25, 'Added', 'product', '111', 'User added a new item', '2023-06-04 22:22:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accomplishment_reports`
--
ALTER TABLE `accomplishment_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_code` (`class_code`),
  ADD KEY `academic_year` (`academic_year`),
  ADD KEY `institute` (`institute`);

--
-- Indexes for table `clearance`
--
ALTER TABLE `clearance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student` (`student`),
  ADD KEY `academic_year` (`academic_year`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `dtr_reports`
--
ALTER TABLE `dtr_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_reports`
--
ALTER TABLE `evaluation_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference_number` (`reference_number`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `institutes_code` (`institute_code`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_code` (`room_code`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference_number` (`reference_number`),
  ADD KEY `academic_year` (`academic_year`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `accomplishment_reports`
--
ALTER TABLE `accomplishment_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `clearance`
--
ALTER TABLE `clearance`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dtr_reports`
--
ALTER TABLE `dtr_reports`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `evaluation_reports`
--
ALTER TABLE `evaluation_reports`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`academic_year`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`institute`) REFERENCES `institutes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clearance`
--
ALTER TABLE `clearance`
  ADD CONSTRAINT `clearance_ibfk_1` FOREIGN KEY (`student`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clearance_ibfk_2` FOREIGN KEY (`academic_year`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`academic_year`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`academic_year`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 02:36 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finetech`
--

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`id`, `name`, `contact`, `email`, `address`, `link`) VALUES
(2, 'finetech', '123423432', 'fsad', 'sahiwal', 'https://www.youtube.com/watch?v=KKmkHQkIb7o&list=RDMM&index=20');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` varchar(1100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `duration` varchar(110) NOT NULL,
  `fee` int(11) NOT NULL,
  `tutor` varchar(1100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `detail`, `gender`, `duration`, `fee`, `tutor`) VALUES
(1, 'Web-Development', 'CSS,HTML,PHP,JS', 'Male & Female both', 'Six Months', 50000, 'Rao Umar Dilshad'),
(14, 'Digital Marketing', 'SEO,FB Ads etc', 'Male & Female both', 'Three Months', 25000, 'Rao Umar');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `salary` int(100) NOT NULL,
  `paid` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `doj` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `dol` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `image`, `department`, `salary`, `paid`, `email`, `contact`, `cnic`, `dob`, `doj`, `status`, `dol`, `gender`, `address`) VALUES
(15, 'Zain Bhinder', '', 'Digital Marketing', 0, 0, '1111111', '11111111', '11111111', '1111-11-11', '1111-11-11', 'Dropped', '', 'Male', 'Near Informatics College,Chichawatni'),
(16, 'Zain Bhinder', '', 'Digital Marketing', 12222222, 111111, '1111111', '+9211111111', '11111111', '1111-11-11', '1111-11-11', 'Left', '', 'Male', 'Near Informatics College,Chichawatni'),
(18, 'Zain Bhinder', '', 'Web-Development', 12121212, 0, 'jani@gmail.com', '+923132312323', '2312312323123', '2023-11-11', '2023-11-17', 'Joined', '', 'Male', 'Near Informatics College,Chichawatni'),
(23, 'Zain Bhinder', '../images/uploads/Screenshot 2023-09-29 182731.jpg', 'Digital Marketing', 1111, 0, 'abd@gmail.com', '+92222222', '36501-2927614', '1111-11-11', '1111-11-11', 'Joined', '', 'Male', 'Near Informatics College,Chichawatni');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE `employee_attendance` (
  `id` int(255) NOT NULL,
  `employee_id` int(255) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `department` varchar(1000) NOT NULL,
  `cnic` varchar(1000) NOT NULL,
  `gender` varchar(1000) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_attendance`
--

INSERT INTO `employee_attendance` (`id`, `employee_id`, `name`, `department`, `cnic`, `gender`, `attendance_date`, `attendance_status`) VALUES
(1, 0, 'Muhammad Zain Iftikhar', 'Web-Development', '211222222222222', 'Male', '2023-11-16', 'Absent'),
(2, 0, 'Faizan Imran', 'Web-Development', '0', 'Male', '2023-11-15', 'Present'),
(3, 0, 'Hanan', 'Web-Development', '3650164289575', 'Male', '2023-11-15', 'Present'),
(4, 0, 'Muhammad Zain Iftikhar', 'Web-Development', '211222222222222', 'Male', '2023-11-15', 'Absent'),
(12, 0, 'Faizan Imran', 'Web-Development', '0', 'Male', '2023-11-16', 'Absent'),
(14, 0, 'Hanan', 'Web-Development', '3650164289575', 'Male', '2023-11-16', 'Absent'),
(21, 1, 'Muhammad Zain Iftikhar', 'Web-Development', '211222222222222', 'Male', '2023-11-17', 'Absent'),
(22, 12, 'Faizan Imran', 'Web-Development', '0', 'Male', '2023-11-17', 'Absent'),
(23, 14, 'Hanan', 'Web-Development', '3650164289575', 'Male', '2023-11-17', 'Absent'),
(24, 1, 'Muhammad Zain Iftikhar', 'Web-Development', '211222222222222', 'Male', '2023-11-21', 'Present'),
(25, 12, 'Faizan Imran', 'Web-Development', '0', 'Male', '2023-11-21', 'Present'),
(26, 14, 'Hanan', 'Web-Development', '3650164289575', 'Male', '2023-11-21', 'Present'),
(27, 18, 'Zain Bhinder', 'Web-Development', '2312312323123', 'Male', '2023-11-29', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_name`, `category`, `date`) VALUES
(1, '20000', 'LAB', '2023-01-14'),
(3, '1', 'LAB', '2023-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `category_name`) VALUES
(2, 'Rental'),
(4, 'LAB');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(255) NOT NULL,
  `income_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `income_name`, `category`, `date`) VALUES
(1, '10', 'oy hoy', '2023-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `income_categories`
--

CREATE TABLE `income_categories` (
  `id` int(255) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income_categories`
--

INSERT INTO `income_categories` (`id`, `category_name`) VALUES
(1, 'Free Lancing le loo'),
(2, 'oy hoy');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `author`, `link`) VALUES
(3, 'dicussion', 'cdfvsd', 'wxcwsc', 'https://www.youtube.com/watch?v=aFOs4o2yP3E&list=PLhw4qe90tyASMSkLhHYNCzrO4e6s0wsl0&index=4');

-- --------------------------------------------------------

--
-- Table structure for table `seminars`
--

CREATE TABLE `seminars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `invites` int(255) NOT NULL,
  `present` int(255) NOT NULL,
  `cheif_guest` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seminars`
--

INSERT INTO `seminars` (`id`, `name`, `date`, `time`, `location`, `description`, `invites`, `present`, `cheif_guest`) VALUES
(7, 'asda', '1111-11-11', '05:32:00', 's', 'f', 121, 1, 'Zain Jutt G');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `course` varchar(100) NOT NULL,
  `fees` int(100) NOT NULL,
  `paid` int(100) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `doa` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `doc` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `image`, `course`, `fees`, `paid`, `contact`, `email`, `cnic`, `dob`, `doa`, `status`, `doc`, `gender`, `address`) VALUES
(32, 'Muhammad Zain Iftikhar', '', 'Web-Development', 44500, 10000, '3222222222', 'jani@gmail.com', '3421213231453', '1111-11-11', '2222-11-13', 'enrolled', '', 'Female', 'Near Informatics College,Chichawatni'),
(33, 'Muhammad Zain Iftikhar', '', 'Web-Development', 44500, 0, '3222222222', 'jani@gmail.com', '3421213231453', '1111-11-11', '2222-11-13', 'enrolled', '', 'Female', 'Near Informatics College,Chichawatni'),
(35, 'Muhammad Zain Iftikhar', '', 'Web-Development', 44500, 0, '+923222222222', 'jani@gmail.com', '3421213231453', '1111-11-11', '2222-11-13', 'enrolled', '', 'Female', 'Near Informatics College,Chichawatni'),
(36, 'Muhammad Zain Iftikhar', '', 'Web-Development', 44500, 0, '+813444444666', 'jani@gmail.com', '3421213231453', '1111-11-11', '2222-11-13', 'Dropped', '2023-11-30', 'Female', 'Near Informatics College,Chichawatni'),
(37, 'Hanan', '', 'Digital Marketing', 22250, 0, '+923359840263', 'abd@gmail.com', '3650113477414', '2023-11-11', '2023-12-02', 'Enrolled', '', 'Male', 'Near Informatics College,Chichawatni'),
(38, 'Zain Jutt', '', 'Digital Marketing', 22250, 0, '+923359840263', 'abd@gmail.com', '36501-2927614', '2023-12-02', '2023-12-15', 'Enrolled', '', 'Male', 'Near Informatics College,Chichawatni'),
(39, 'Zain Bhinder', '../images/uploads/WhatsApp Image 2023-11-29 at 00.21.42_d7ff2751.jpg', 'Digital Marketing', 22250, 0, '+92+92+923359840263', 'abd@gmail.com', '3421213231453', '1111-11-11', '1111-11-11', 'Enrolled', '', 'Male', 'Near Informatics College,Chichawatni');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `course` varchar(255) NOT NULL,
  `cnic` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `attendance_date` date DEFAULT NULL,
  `attendance_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `student_id`, `name`, `course`, `cnic`, `gender`, `attendance_date`, `attendance_status`) VALUES
(71, 37, 'Hanan', 'Digital Marketing', '3650113477414', 'Male', '2023-11-30', 'Absent'),
(72, 32, 'Muhammad Zain Iftikhar', 'Web-Development', '3421213231453', 'Female', '2023-11-30', 'Absent'),
(73, 33, 'Muhammad Zain Iftikhar', 'Web-Development', '3421213231453', 'Female', '2023-11-30', 'Absent'),
(74, 35, 'Muhammad Zain Iftikhar', 'Web-Development', '3421213231453', 'Female', '2023-11-30', 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cnic` int(255) NOT NULL,
  `contact` int(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `name`, `cnic`, `contact`, `email`, `password`, `role`, `course`) VALUES
(1, 'admin', 0, 0, 'admin@gmail.com', '123', 'Admin', ''),
(10, 'Muhammad Zain Iftikhar', 2147483647, 33323222, 'jani@gmail.com', 'asdf', 'Admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_categories`
--
ALTER TABLE `income_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seminars`
--
ALTER TABLE `seminars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income_categories`
--
ALTER TABLE `income_categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seminars`
--
ALTER TABLE `seminars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

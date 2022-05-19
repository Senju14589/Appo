-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2022 at 08:58 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appoin`
--

-- --------------------------------------------------------

--
-- Table structure for table `csadmin`
--

CREATE TABLE `csadmin` (
  `number` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `nf_time` time DEFAULT NULL,
  `ag_time` time DEFAULT NULL,
  `total_time` varchar(21) DEFAULT NULL,
  `time_card` time DEFAULT NULL,
  `patient_status` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csadmin`
--

INSERT INTO `csadmin` (`number`, `date`, `phonenumber`, `nf_time`, `ag_time`, `total_time`, `time_card`, `patient_status`) VALUES
(1, '2022-05-11 00:00:00', '0643469907', '13:45:17', '03:32:27', 'รับทราบแล้ว', '13:53:14', '00:07:57'),
(2, '2022-05-11 00:00:00', '0951919459', '10:28:38', '00:15:40', 'ยังไม่รับทราบ', NULL, NULL),
(3, '2022-05-11 00:00:00', '0991172201', NULL, '10:13:09', 'ยังไม่รับทราบ', NULL, NULL),
(4, '2022-05-11 00:00:00', '0856225477', NULL, '10:13:21', 'ยังไม่รับทราบ', NULL, NULL),
(5, '2022-05-11 00:00:00', '0612345678', NULL, '10:13:29', 'ยังไม่รับทราบ', NULL, NULL),
(6, '2022-05-11 00:00:00', '0694321990', NULL, '10:13:42', 'ยังไม่รับทราบ', NULL, NULL),
(7, '2022-05-11 00:00:00', '0884356789', NULL, '10:13:53', 'ยังไม่รับทราบ', NULL, NULL),
(8, '2022-05-11 00:00:00', '0913456772', NULL, '10:14:06', 'ยังไม่รับทราบ', NULL, NULL),
(9, '2022-05-11 00:00:00', '0921667788', NULL, '10:14:16', 'ยังไม่รับทราบ', NULL, NULL),
(10, '2022-05-11 00:00:00', '0659998888', NULL, '10:14:38', 'ยังไม่รับทราบ', NULL, NULL),
(11, '2022-05-11 00:00:00', '0803945672', NULL, '10:15:04', 'ยังไม่รับทราบ', NULL, NULL),
(12, '2022-05-11 00:00:00', '0984335965', NULL, '10:15:46', 'ยังไม่รับทราบ', NULL, NULL),
(13, '2022-05-11 00:00:00', '0876543321', NULL, '10:15:57', 'ยังไม่รับทราบ', NULL, NULL),
(14, '2022-05-11 00:00:00', '0891234560', NULL, '10:16:11', 'ยังไม่รับทราบ', NULL, NULL),
(15, '2022-05-11 00:00:00', '0610077700', NULL, '10:19:26', 'ยังไม่รับทราบ', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `csadmin`
--
ALTER TABLE `csadmin`
  ADD PRIMARY KEY (`number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `csadmin`
--
ALTER TABLE `csadmin`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

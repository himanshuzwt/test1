-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 06:56 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(5) NOT NULL,
  `event_name` varchar(250) NOT NULL,
  `event_start_date` date NOT NULL,
  `event_repeat_number` int(5) NOT NULL,
  `event_repeat_duration` enum('day','week','month','yeaar') NOT NULL,
  `event_end_type` varchar(20) NOT NULL,
  `event_end_date` date DEFAULT NULL,
  `event_occurance` int(5) DEFAULT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `event_name`, `event_start_date`, `event_repeat_number`, `event_repeat_duration`, `event_end_type`, `event_end_date`, `event_occurance`, `create_date`, `update_date`) VALUES
(1, 'test 1', '2022-04-01', 4, 'day', 'with_end_date', '2022-04-30', 0, '2022-04-03', '2022-04-03'),
(2, 'test 2', '2022-04-01', 4, 'day', 'with_occrance', '2022-04-30', 4, '2022-04-03', '2022-04-03'),
(4, 'test 5', '2022-04-01', 1, 'week', 'with_end_date', '2022-04-30', 0, '2022-04-03', '2022-04-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

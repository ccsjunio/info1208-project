-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 13, 2020 at 02:58 AM
-- Server version: 10.0.38-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `info1208_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `FOO`
--

CREATE TABLE `FOO` (
  `id` int(11) NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `FOO`
--

INSERT INTO `FOO` (`id`, `name`) VALUES
(2, 'test'),
(3, 'test'),
(4, 'updated'),
(5, 'test'),
(6, 'test'),
(7, 'test'),
(8, 'test'),
(9, 'test'),
(10, 'test'),
(11, 'test'),
(12, 'test'),
(13, 'test'),
(14, 'test'),
(15, 'test'),
(16, 'test'),
(17, 'test'),
(18, 'test'),
(19, 'test'),
(20, 'test'),
(21, 'test'),
(22, 'test'),
(23, 'test'),
(24, 'test'),
(25, 'test'),
(26, 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `FOO`
--
ALTER TABLE `FOO`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `FOO`
--
ALTER TABLE `FOO`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

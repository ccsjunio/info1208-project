-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 14, 2020 at 07:55 PM
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
-- Table structure for table `tbMovieFromUser`
--

DROP TABLE IF EXISTS `tbMovieFromUser`;
CREATE TABLE `tbMovieFromUser` (
  `id` int(11) NOT NULL,
  `sName` varchar(100) NOT NULL,
  `tsCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbMovieFromUser`
--

INSERT INTO `tbMovieFromUser` (`id`, `sName`, `tsCreation`) VALUES
(1, 'The Shawshank Redemption', '2020-04-13 18:00:27'),
(2, ' The Godfather', '2020-04-13 18:00:27'),
(3, 'The Godfather: Part II', '2020-04-13 18:01:05'),
(4, 'The Dark Knight', '2020-04-13 18:01:05'),
(5, '12 Angry Men', '2020-04-13 18:01:31'),
(6, 'Schindler\'s List ', '2020-04-13 18:01:31'),
(10, 'teste', '2020-04-14 02:16:03'),
(11, 'teste 2', '2020-04-14 02:16:14'),
(12, '       ', '2020-04-14 02:18:38'),
(13, 'test 4', '2020-04-14 02:22:45'),
(14, 'test 4', '2020-04-14 02:23:19'),
(15, 'test 5', '2020-04-14 02:23:49'),
(16, 'test 5', '2020-04-14 02:24:54'),
(17, 'test 5', '2020-04-14 02:25:20'),
(18, 'test6', '2020-04-14 02:26:52'),
(19, 'gtgtgtgtgt', '2020-04-14 02:28:11'),
(20, 'test', '2020-04-14 02:39:56'),
(21, 'trhh', '2020-04-14 02:40:02'),
(22, 'gtgtgt', '2020-04-14 02:40:08'),
(23, '11111', '2020-04-14 02:44:27'),
(24, '2222', '2020-04-14 02:44:36'),
(25, '333333', '2020-04-14 02:44:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbMovieFromUser`
--
ALTER TABLE `tbMovieFromUser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbMovieFromUser`
--
ALTER TABLE `tbMovieFromUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

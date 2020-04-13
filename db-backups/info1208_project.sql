-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 13, 2020 at 07:42 PM
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
CREATE DATABASE IF NOT EXISTS `info1208_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `info1208_project`;

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
(6, 'Schindler\'s List ', '2020-04-13 18:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbMovieRating`
--

DROP TABLE IF EXISTS `tbMovieRating`;
CREATE TABLE `tbMovieRating` (
  `id` int(11) NOT NULL,
  `idMovieFromUser` int(11) NOT NULL,
  `iRating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbMovieRating`
--

INSERT INTO `tbMovieRating` (`id`, `idMovieFromUser`, `iRating`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 5),
(4, 4, 8),
(5, 5, 1),
(6, 6, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbMovieFromUser`
--
ALTER TABLE `tbMovieFromUser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbMovieRating`
--
ALTER TABLE `tbMovieRating`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbMovieFromUser`
--
ALTER TABLE `tbMovieFromUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbMovieRating`
--
ALTER TABLE `tbMovieRating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2019 at 09:13 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_conferinta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(5) NOT NULL,
  `nume` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `parola` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nume`, `email`, `parola`) VALUES
(1, 'liviu', 'liviu_xp@yahoo.com', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'ics', 'aaaa', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `anunt`
--

CREATE TABLE `anunt` (
  `id` int(5) NOT NULL,
  `data` date NOT NULL,
  `mesaj` varchar(1054) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anunt`
--

INSERT INTO `anunt` (`id`, `data`, `mesaj`) VALUES
(1, '2011-07-15', 'Full paper submission'),
(2, '2011-08-01', 'Notification of acceptance'),
(3, '2011-08-10', 'Final (camera-ready) paper submission'),
(4, '2011-09-01', 'Conference date');

-- --------------------------------------------------------

--
-- Table structure for table `participanti`
--

CREATE TABLE `participanti` (
  `id` int(5) NOT NULL,
  `nume` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `telefon` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participanti`
--

INSERT INTO `participanti` (`id`, `nume`, `email`, `telefon`) VALUES
(1, 'Liviu Ics', 'liviu_xp@yahoo.com', 1722222222),
(2, '321313', 'alex@gmail.com', 2147483647),
(4, 's21312321321', 'asdas', 2147483647),
(5, 'ganaaa312', 'tttttt', 2147483647),
(6, 'alin', '312312', 1722222222),
(9, 'aaa', '11', 722222222),
(13, 'Alexandru Ion', 'ion@yahoo.com', 722222222),
(14, '<h1>aaa</h1>', 'aa@yahoo.com', 722222222),
(15, 'John\'A', 'john@gmail.com', 722343212);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anunt`
--
ALTER TABLE `anunt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participanti`
--
ALTER TABLE `participanti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anunt`
--
ALTER TABLE `anunt`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `participanti`
--
ALTER TABLE `participanti`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

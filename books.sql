-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 08:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(2000) NOT NULL,
  `author` varchar(2000) NOT NULL,
  `publisher` varchar(2000) NOT NULL,
  `descr` varchar(5000) NOT NULL,
  `category` varchar(100) NOT NULL,
  `datePublished` date NOT NULL,
  `isbn` varchar(17) NOT NULL,
  `img` longblob NOT NULL,
  `imgPath` varchar(5000) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publisher`, `descr`, `category`, `datePublished`, `isbn`, `img`, `imgPath`, `isArchived`) VALUES
(1, 'fafwa', 'fwafwafwa', 'fawfafaw', 'fwafawfaw', 'biography', '2024-12-19', '21521512521412412', 0x61616161612e6a7067, 'F:/Coding 3/wst-php/uploads/aaaaa.jpg', 0),
(2, 'fwafaw', 'fwafaw', '2rfaf2', 'awfaf2darf', 'autobiography', '2024-12-19', '3124-123-321-42-1', 0x33663833383830612d666432372d346262392d386335612d6465643338623836613330312e6a7067, 'F:/Coding 3/wst-php/uploads/3f83880a-fd27-4bb9-8c5a-ded38b86a301.jpg', 0),
(3, 'asdasdasdasd', 'fwaaaa', 'fafwafwa', 'fawfwaf', 'non-fiction', '2024-12-19', '3124-123-321-42-9', 0x73616e6472656e70617373706f72742e706e67, 'F:/Coding 3/wst-php/uploads/sandrenpassport.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

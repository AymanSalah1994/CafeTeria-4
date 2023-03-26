-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2023 at 01:37 AM
-- Server version: 8.0.32-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdoTest`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `RoomNumber` varchar(50) NOT NULL,
  `ext` int NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `name`, `email`, `password`, `RoomNumber`, `ext`, `image`) VALUES
(205817444, 'Samy JOJOJO', 'samy@gmail.com', '12345qwe', '', 0, 'users/205817444.jpg'),
(469552748, 'Ayman Update', 'ayman@gmail.com', '12345qwe', '', 0, 'users/469552748.jpg'),
(1164857416, 'Ayman RRS ', 'ayman@gmail.com', '123qweas', 'Cloud', 23, 'users/1164857416.jpg'),
(1315490426, 'DDD', 'ayman.1551.salah@gmail.com', '123qweas', 'Application 1', 34, 'users/1315490426.jpg'),
(1386711705, 'DDD', 'ayman.1551.salah@gmail.com', '123qweas', 'Application 1', 34, 'users/1386711705.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

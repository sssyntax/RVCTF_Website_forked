-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2022 at 12:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctfdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `difficulty` tinyint(4) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `solution` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `title`, `author`, `points`, `difficulty`, `category`, `description`, `solution`) VALUES
(1, 'testing', 'zhongbob', 69, 1, 'Forensics', 'I am in deep levels of pain', '123'),
(2, '1', '1', 1, 1, '1', '1', '96e173e55c7eb1edbe72b0a436915190db675d8a'),
(3, 'a', 'a', 60, 0, 'forensics', 'a', '02cf13ba6ad8abcb048e531de70fee0ae6a5bdff'),
(4, 'testing', 'zhongbob', 69, 2, 'Forensics', 'I am in deep levels of pain', '123'),
(5, 'testing', 'zhongbob', 69, 1, 'Forensics', 'I am in deep levels of pain', '123'),
(6, 'aa', 'a', 69, 0, 'Forensics', 'aadada', 'a34e9cf8da7548eedba9bb52708cc84fc2e2f221'),
(7, 'dada', 'dada', 69, 0, 'Forensics', 'dadadada', '4b51b18fa511de0f2457ee5a2476b96c10613167'),
(8, 'dada', 'dada', 69, 0, 'Forensics', 'adada', 'c92236ae0de8f9b75a09a8ab9f653070f924be3b'),
(9, 'a', 'a', 69, 0, 'Forensics', 'a', 'a7633fdcef488104c60365429f3561ce7835450f'),
(10, 'a', 'a', 60, 0, 'Forensics', 'da', 'a7633fdcef488104c60365429f3561ce7835450f'),
(11, 'a', 'a', 60, 0, 'Forensics', 'dadadada', 'a7633fdcef488104c60365429f3561ce7835450f'),
(12, 'a', 'a', 69, 0, 'Forensics', 'd', 'a7633fdcef488104c60365429f3561ce7835450f'),
(13, '1', '2', 3, 0, 'Forensics', '4', '3da6f1b21872868b0acc10611250a223a0fc5423');

-- --------------------------------------------------------

--
-- Table structure for table `completedchallenges`
--

CREATE TABLE `completedchallenges` (
  `completionid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `challengeid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loginattempts`
--

CREATE TABLE `loginattempts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loginattempts`
--

INSERT INTO `loginattempts` (`id`, `userid`, `timestamp`) VALUES
(3, 0, 1659767693),
(4, 0, 1659767701),
(5, 0, 1659767763);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `teamid` int(11) NOT NULL,
  `teamname` varchar(255) NOT NULL,
  `teampassword` varchar(255) NOT NULL,
  `teammates` text NOT NULL,
  `teamleader` varchar(320) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`teamid`, `teamname`, `teampassword`, `teammates`, `teamleader`, `points`) VALUES
(3, 'Zhongbob Team', '$2y$10$zRf9uDI3SfaOEnqW/18oneqN18Ph.AP9cOVV2HQSPBI6vkyvFlYAK', '[\"czhongding@gmail.com\"]', 'czhongding@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(255) NOT NULL,
  `teamname` varchar(255) DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `teamname`, `points`, `admin`) VALUES
(1, 'czhongding@gmail.com', '$2y$10$Es8DXHt0nr54YuIigP1CCuE.RY6wNsSBkGASwwLYib2/hfJYCTnJ2', 'Zhongbob Team', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completedchallenges`
--
ALTER TABLE `completedchallenges`
  ADD PRIMARY KEY (`completionid`);

--
-- Indexes for table `loginattempts`
--
ALTER TABLE `loginattempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`teamid`),
  ADD UNIQUE KEY `teamname` (`teamname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `completedchallenges`
--
ALTER TABLE `completedchallenges`
  MODIFY `completionid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loginattempts`
--
ALTER TABLE `loginattempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `teamid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

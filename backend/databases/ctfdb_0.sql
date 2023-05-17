-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 03:26 PM
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
(13, '1', '2', 3, 0, 'Forensics', '4', '3da6f1b21872868b0acc10611250a223a0fc5423'),
(14, 'your mom', 'me', 69, 0, 'Forensics', 'fuck you', 'b3d68079cfb8c8d3bee8575bd172b290e843711b'),
(15, '你妈妈', 'me', 69, 0, 'PWN', '', '79af5839c42aa970923018f5a1c2b5bad56234d9'),
(16, 'JP', 'Me', 69, 0, 'Reverse Engineering', 'The answer is JP', '846400caf36e29558d2fb4cafdf1ccc706917b5c');

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

--
-- Dumping data for table `completedchallenges`
--

INSERT INTO `completedchallenges` (`completionid`, `userid`, `challengeid`, `timestamp`) VALUES
(64, 23, 15, 1660581136),
(69, 23, 16, 1660583423);

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
(3, 'Zhongbob Team', '$2y$10$zRf9uDI3SfaOEnqW/18oneqN18Ph.AP9cOVV2HQSPBI6vkyvFlYAK', '[\"czhongding@gmail.com\"]', 'czhongding@gmail.com', 0),
(11, 'ilyJP', '$2y$10$.xgdzMHLtcQp5YkjUgnH/.JtjhayjoWnzigsrAEHI9dglnGV3JjG.', '[\"nqheng@gmail.com\",\"ngqiheng952@gmail.com\"]', 'nqheng@gmail.com', 0),
(12, 'test@gmail.com', '$2y$10$9gfoJBTTE3sBQvxou5rd7.8jFnpSIx5znSOnRY2SlrUehWqN3OPG2', '[\"test@gmail.com\"]', 'test@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `ctf_users` (
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

INSERT INTO `ctf_users` (`id`, `email`, `password`, `teamname`, `points`, `admin`) VALUES
(1, 'czhongding@gmail.com', '$2y$10$Es8DXHt0nr54YuIigP1CCuE.RY6wNsSBkGASwwLYib2/hfJYCTnJ2', 'Zhongbob Team', 0, 1),
(23, 'nqheng@gmail.com', '$2y$10$fFiO5KhoZoNBBESmPBk4oOH6HsDuaXPkdQ/EdCSlbZllbsudk7.3S', 'ilyJP', 4692, 1),
(24, 'ngqiheng952@gmail.com', '$2y$10$JyZ.eLoO7sJ5cjChqmEsl.6Wm2NlKpm2R2QfyK9TM.HzjVhqw0TO.', 'ilyJP', 69, 0),
(25, 'test@gmail.com', '$2y$10$SLNoU6bUuZ4jn48f7mhxue3C/iLhxH6CiMmohl1xFiWYCP9zFhnZO', 'test@gmail.com', 0, 0);

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
ALTER TABLE `ctf_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `completedchallenges`
--
ALTER TABLE `completedchallenges`
  MODIFY `completionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `loginattempts`
--
ALTER TABLE `loginattempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `teamid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `ctf_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

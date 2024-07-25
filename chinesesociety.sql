-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 01:17 PM
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
-- Database: `chinesesociety`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  `pp` varchar(255) DEFAULT 'default-pp.png',
  `phone` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `name`, `email`, `password`, `about`, `pp`, `phone`, `nationality`, `gender`) VALUES
(1, 'Chaw Chun Jia', 'chawchunjia@gmail.com', 'e99a18c428cb38d5f260853678922e03', NULL, 'default-pp.png', NULL, NULL, NULL),
(2, 'Chun Wen', 'chunwen@gmail.com', 'bbde378f429d90aadcbdba1da3c0aa2b', NULL, 'default-pp.png', NULL, NULL, NULL),
(3, 'Jun Kang', 'junkang@gmail.com', '4519ae61ad4460c2cc04e56ef30512b2', '', 'default-pp.png', '', '', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventID` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `eventDate` date NOT NULL,
  `eventTime` time NOT NULL,
  `seatAvailability` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `title`, `description`, `eventDate`, `eventTime`, `seatAvailability`, `image`) VALUES
(1, 'Dragon Boat Festival Celebration', 'Activities including:\r\n- Zongzi Making Workshops\r\n- Zongzi Tasting Sessions\r\n- Cultural Performance', '2024-06-10', '20:00:00', 0, 'event1.jpg'),
(2, 'Chinese New Year Celebration', 'Activities including:\r\n- Lion Dance\r\n- Lao Sang Ceremony\r\n- CNY Buffet!', '2024-01-02', '21:00:00', 45, 'event2.jpg'),
(3, 'Mid Autumn Festival Celebration', 'Activities including:\r\n- Lantern Parade\r\n- Mooncake Testing Sessions\r\n- Story of Chang e', '2024-09-17', '20:21:00', 46, 'event3.jpg'),
(4, 'Visit Old Folks Home', 'Location: Pearl Care Nursing Home', '2024-06-10', '20:21:00', 49, 'event9.png'),
(5, 'Visit Orphanage', 'Location: Rumah Anak Yatim Shifa', '2024-11-09', '20:21:00', 49, 'event10.jpg'),
(6, 'Feed the Homeless', 'Location: around Pasar Seni', '2024-08-12', '20:21:00', 49, 'event11.jpg'),
(7, 'Debate Competition', 'Theme:\r\n- Can long-distance relationships work?\r\n- Are the rich or the poor more responsible for environmental damages?', '2024-07-07', '20:21:00', 50, 'event12.png'),
(8, 'Singing Competition', 'Unleash your voice in the spotlight!\r\n*No participation fee is required!', '2024-07-14', '20:21:00', 50, 'event13.jpg'),
(9, 'Chinese Calligraphy Competition', 'Showcase your mastery of brushwork here!\r\n*No participation fee is required!', '2024-02-08', '20:21:00', 50, 'event5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_user`
--

CREATE TABLE `event_user` (
  `eventID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_user`
--

INSERT INTO `event_user` (`eventID`, `userID`) VALUES
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(3, 3),
(5, 2),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  `studentID` varchar(10) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `programme` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `pp` varchar(255) NOT NULL DEFAULT 'default-pp.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `email`, `password`, `about`, `studentID`, `phone`, `gender`, `programme`, `nationality`, `pp`) VALUES
(1, 'Chaw Chun Jia', 'chunjia@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'helo im Chun Jia from focs', '2302733', 1116326494, 'M', 'Diploma in IT', 'Malaysia', 'ccj.png'),
(2, 'Er Zhi Ying', 'zhiying@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'Hello ', '2302763', 163281185, 'M', 'Diploma in Advertising', 'malaysia', 'WhatsApp Image 2024-04-23 at 20.14.28_bf729fb8.jpg'),
(3, 'Goh Chun Wen', 'chunwen@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'helo i love ooi jun kang im gay', '2302211', 1116326494, 'M', 'Diploma in IT', 'Bangla', '919016374162781626-removebg-preview.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `event_user`
--
ALTER TABLE `event_user`
  ADD PRIMARY KEY (`eventID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `event_user_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`),
  ADD CONSTRAINT `event_user_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

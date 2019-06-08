-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2019 at 06:10 PM
-- Server version: 5.6.28-log
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `strivven-sql`
--

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `userId`, `email`, `date`) VALUES
(1, 1, 'usera1@yahoo.com', '2019-06-07 00:00:00'),
(2, 1, 'usera2@yahoo.com', '2019-06-08 00:00:00'),
(3, 1, 'usera3@yahoo.com', '2019-06-08 00:00:00'),
(4, 1, 'usera4@yahoo.com', '2019-06-08 00:00:00'),
(5, 2, 'userb1@yahoo.com', '2019-06-08 00:00:00'),
(6, 3, 'userc1@yahoo.com', '2019-06-08 00:00:00'),
(7, 4, 'userd1@yahoo.com', '2019-06-08 00:00:00'),
(8, 4, 'userd2@yahoo.com', '2019-06-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `email_primary`
--

CREATE TABLE IF NOT EXISTS `email_primary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `emailId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `email_primary`
--

INSERT INTO `email_primary` (`id`, `userId`, `emailId`) VALUES
(1, 1, 1),
(2, 2, 5),
(3, 3, 6),
(4, 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `usage_log`
--

CREATE TABLE IF NOT EXISTS `usage_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionKey` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `login` datetime NOT NULL,
  `logout` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `usage_log`
--

INSERT INTO `usage_log` (`id`, `sessionKey`, `userId`, `login`, `logout`) VALUES
(1, 'abced1', 1, '2019-05-13 07:00:00', '2019-05-13 08:00:00'),
(2, 'abcde2', 1, '2019-05-29 04:00:00', '2019-05-29 05:00:00'),
(3, 'abcde3', 1, '2019-06-01 12:00:00', '2019-06-01 14:00:00'),
(4, 'fghij1', 2, '2019-06-04 14:00:00', '2019-06-04 16:00:00'),
(5, 'fhijk2', 2, '2019-06-06 18:00:00', '2019-06-06 19:00:00'),
(6, 'lmnop1', 3, '2019-05-07 07:00:00', '2019-05-07 08:00:00'),
(7, 'qrstu1', 4, '2019-05-23 08:00:00', '2019-05-23 10:00:00'),
(8, 'qrstu2', 4, '2019-05-29 06:00:00', '2019-05-29 13:00:00'),
(9, 'qrstu3', 4, '2019-06-01 08:00:00', '2019-06-01 16:00:00'),
(10, 'qrstu4', 4, '2019-06-04 11:00:00', '2019-06-04 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(255) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fName`, `lName`, `age`, `admin`, `date`) VALUES
(1, 'User', 'A', 21, 1, '2019-06-08 00:00:00'),
(2, 'User', 'B', 34, 0, '2019-06-07 00:00:00'),
(3, 'User', 'C', 56, 0, '2019-06-04 00:00:00'),
(4, 'User', 'D', 27, 1, '2019-06-06 00:00:00'),
(5, 'User', 'E', 44, 0, '2019-06-07 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2017 at 04:09 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `willl__games`
--

CREATE TABLE IF NOT EXISTS `willl__games` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `md5` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `willl__games`
--

INSERT INTO `willl__games` (`id`, `title`, `description`, `md5`) VALUES
(1, 'Grand Theft Auto V', 'et spil der handler om at køre folk ned og skyde løs.', '535FACDE642C14CFAB73A91C06756EAE'),
(2, 'get to the other side', 'et sødt lille spil bygget til nettet.', 'MD5 Was not generated.');


-- --------------------------------------------------------

--
-- Table structure for table `willl__betatesters`
--

CREATE TABLE IF NOT EXISTS `willl__betatesters` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `willl__betatesters`
--

INSERT INTO `willl__betatesters` (`id`, `username`, `email`) VALUES
(1, 'username', 'email');

-- --------------------------------------------------------

--
-- Table structure for table `willl__developers`
--

CREATE TABLE IF NOT EXISTS `willl__developers` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(254) NOT NULL,
  `developer_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `willl__developers`
--

INSERT INTO `willl__developers` (`id`, `first_name`, `last_name`, `email`, `developer_id`) VALUES
(1, 'Anders', 'Hansen', 'Ah@example.com', '01a09h16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

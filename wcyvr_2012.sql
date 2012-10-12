-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2012 at 07:25 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wcyvr_2012`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Bio` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Handle` varchar(255) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Demo table for 2012 WordCamp Vancouver' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`UserId`, `Name`, `Bio`, `Location`, `Handle`) VALUES
(1, 'Ben Lobaugh', 'WordPress developer and sailing connoisseur', 'Seattle, WA', 'blobaugh'),
(2, 'Grant Landram', 'WordPress business development consultant', 'Bellevue, WA', 'GrantLandram'),
(3, 'Tanner Moushey', 'Superior theme and front end development', 'Everett,WA', 'tanner');

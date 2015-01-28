-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2013 at 07:57 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coodle`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dateCreated` int(11) NOT NULL,
  `dateUpdated` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `countries`
--


-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE IF NOT EXISTS `families` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `familyName` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `primaryMember` int(11) NOT NULL,
  `dateCreated` int(11) NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `dateUpdated` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `families`
--


-- --------------------------------------------------------

--
-- Table structure for table `familymembers`
--

CREATE TABLE IF NOT EXISTS `familymembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `dobD` int(2) DEFAULT NULL,
  `dobM` int(2) DEFAULT NULL,
  `dobY` int(4) DEFAULT NULL,
  `maritalStatus` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `stateID` int(11) DEFAULT NULL,
  `countryID` int(11) DEFAULT NULL,
  `dateCreated` int(11) NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `dateUpdated` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `familymembers`
--

INSERT INTO `familymembers` (`id`, `firstName`, `middleName`, `lastName`, `sex`, `dobD`, `dobM`, `dobY`, `maritalStatus`, `email`, `phone`, `address1`, `address2`, `postcode`, `stateID`, `countryID`, `dateCreated`, `updatedBy`, `dateUpdated`, `status`) VALUES
(1, 'Michael', NULL, 'Fasipe', NULL, NULL, NULL, NULL, NULL, 'fasipemichael@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, 1385659334, NULL, NULL, 2),
(2, 'Simon', NULL, 'Jolley', 'male', NULL, NULL, NULL, 1, 'simon@coodle.com', NULL, NULL, NULL, NULL, NULL, NULL, 1385663982, NULL, NULL, 2),
(3, 'Keith', NULL, 'Mayor', 'male', NULL, NULL, NULL, 2, 'keith@coodle.com', NULL, NULL, NULL, NULL, NULL, NULL, 1385664044, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `familymember_family`
--

CREATE TABLE IF NOT EXISTS `familymember_family` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `familyMemberID` int(11) NOT NULL,
  `familyID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `familymember_family`
--


-- --------------------------------------------------------

--
-- Table structure for table `messagelog`
--

CREATE TABLE IF NOT EXISTS `messagelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messageID` int(11) NOT NULL,
  `statusType` int(11) NOT NULL,
  `logDate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `messagelog`
--


-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderID` int(11) NOT NULL,
  `recepientID` int(11) NOT NULL,
  `message` text NOT NULL,
  `flag` int(11) NOT NULL,
  `dateCreated` int(11) NOT NULL,
  `dateLastUpdated` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `countryID` int(11) NOT NULL,
  `dateCreated` int(11) NOT NULL,
  `dateUpdated` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `states`
--


-- --------------------------------------------------------

--
-- Table structure for table `taskcategories`
--

CREATE TABLE IF NOT EXISTS `taskcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` int(11) NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `dateUpdated` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `taskcategories`
--


-- --------------------------------------------------------

--
-- Table structure for table `taskpriorities`
--

CREATE TABLE IF NOT EXISTS `taskpriorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `dateCreated` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `dateUpdated` int(11) DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `taskpriorities`
--


-- --------------------------------------------------------

--
-- Table structure for table `taskrepititions`
--

CREATE TABLE IF NOT EXISTS `taskrepititions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` int(11) NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `dateUpdated` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `taskrepititions`
--


-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `notes` text,
  `categoryID` int(11) NOT NULL,
  `dueDate` int(11) NOT NULL,
  `completionDate` int(11) DEFAULT NULL,
  `flag` int(2) NOT NULL,
  `repeatID` int(11) NOT NULL,
  `repeatFrom` int(11) DEFAULT NULL,
  `dateCreated` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `assignedTo` int(11) NOT NULL,
  `dateUpdated` int(11) DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tasks`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `familyMemberID` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dateCreated` int(11) NOT NULL,
  `dateUpdated` int(11) DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `familyMemberID` (`familyMemberID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `familyMemberID`, `password`, `dateCreated`, `dateUpdated`, `updatedBy`, `status`) VALUES
(1, 1, '42f749ade7f9e195bf475f37a44cafcb', 1385659334, NULL, NULL, 2),
(2, 2, '42f749ade7f9e195bf475f37a44cafcb', 1385663982, NULL, NULL, 2),
(3, 3, '42f749ade7f9e195bf475f37a44cafcb', 1385664044, NULL, NULL, 2);

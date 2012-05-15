-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2012 at 12:08 PM
-- Server version: 5.5.23
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id`, `name`) VALUES
(8, 'All'),
(1, 'Saw'),
(2, 'Saw 2'),
(3, 'Saw 3'),
(7, 'Saw 3D'),
(4, 'Saw 4'),
(5, 'Saw 5'),
(6, 'Saw 6');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `name`, `role_id`) VALUES
(1, 'John Kramer', 1),
(2, 'Adam Stanheight', 1),
(3, 'Alison Gordon', 1),
(4, 'Diana Gordon', 1),
(5, 'Allison Kerry', 2),
(6, 'Amanda Young', 6),
(7, 'Carla Song', 3),
(8, 'David Tapp', 2),
(9, 'Donnie Greco', 1),
(10, 'Jeff Ridenhour', 1),
(11, 'Doctor Lawrence Gordon', 3),
(12, 'Mark Wilson', 1),
(13, 'Paul Leahy', 1),
(14, 'Steven Sing', 2),
(15, 'Zep Hindle', 3);

-- --------------------------------------------------------

--
-- Table structure for table `rels_people_films`
--

CREATE TABLE IF NOT EXISTS `rels_people_films` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `person_id` tinyint(4) NOT NULL,
  `film_id` tinyint(4) NOT NULL,
  `flashback_only` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_person_id` (`person_id`),
  KEY `FK_filmid` (`film_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Dumping data for table `rels_people_films`
--

INSERT INTO `rels_people_films` (`id`, `person_id`, `film_id`, `flashback_only`) VALUES
(1, 1, 1, 0),
(3, 2, 1, 0),
(4, 3, 1, 0),
(5, 4, 1, 0),
(6, 5, 1, 0),
(7, 6, 1, 0),
(8, 7, 1, 0),
(9, 8, 1, 0),
(10, 9, 1, 0),
(11, 10, 1, 0),
(12, 11, 1, 0),
(13, 12, 1, 0),
(14, 13, 1, 0),
(15, 14, 1, 0),
(16, 15, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rels_people_people`
--

CREATE TABLE IF NOT EXISTS `rels_people_people` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `person_a_id` tinyint(4) NOT NULL,
  `person_b_id` tinyint(4) NOT NULL,
  `film_id` tinyint(4) NOT NULL,
  `weight` float NOT NULL,
  `flashback` tinyint(1) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_film_id` (`film_id`),
  KEY `FK_person_a_id` (`person_a_id`),
  KEY `FK_person_b_id` (`person_b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rels_people_statuses`
--

CREATE TABLE IF NOT EXISTS `rels_people_statuses` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `person_id` tinyint(4) NOT NULL,
  `status_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Civilian'),
(6, 'Criminal'),
(3, 'Health Care'),
(5, 'Health Insurance'),
(4, 'Law'),
(2, 'Police');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Dead'),
(4, 'Game participant'),
(3, 'Jigsaw recruit'),
(2, 'Jigsaw victim');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `FK_people_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rels_people_films`
--
ALTER TABLE `rels_people_films`
  ADD CONSTRAINT `FK_rels_p2f_film_id` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rels_p2f_person_id` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rels_people_people`
--
ALTER TABLE `rels_people_people`
  ADD CONSTRAINT `FK_rels_p2p_person_b_id` FOREIGN KEY (`person_b_id`) REFERENCES `people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rels_p2p_film_id` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rels_p2p_person_a_id` FOREIGN KEY (`person_a_id`) REFERENCES `people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

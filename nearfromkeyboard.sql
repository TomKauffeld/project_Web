-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: nearfromkeyboard.mysql.db
-- Generation Time: May 01, 2018 at 05:33 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nearfromkeyboard`
--
CREATE DATABASE IF NOT EXISTS `nearfromkeyboard` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `nearfromkeyboard`;

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` varchar(100) NOT NULL,
  `post` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `body` varchar(2000) NOT NULL,
  `time` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post` (`post`),
  KEY `author` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE IF NOT EXISTS `blog_post` (
  `id` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(2000) NOT NULL,
  `time` bigint(20) NOT NULL,
  `image` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_category`
--

DROP TABLE IF EXISTS `blog_post_category`;
CREATE TABLE IF NOT EXISTS `blog_post_category` (
  `post` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`post`,`category`),
  KEY `post` (`post`),
  KEY `category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_user`
--

DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE IF NOT EXISTS `blog_user` (
  `id` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `adminLvL` int(11) NOT NULL,
  `password` varchar(300) NOT NULL,
  `time` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `adminLvL` (`adminLvL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD CONSTRAINT `blog_comment_ibfk_1` FOREIGN KEY (`author`) REFERENCES `blog_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_comment_ibfk_2` FOREIGN KEY (`post`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`author`) REFERENCES `blog_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_post_category`
--
ALTER TABLE `blog_post_category`
  ADD CONSTRAINT `blog_post_category_ibfk_1` FOREIGN KEY (`category`) REFERENCES `blog_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_post_category_ibfk_2` FOREIGN KEY (`post`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

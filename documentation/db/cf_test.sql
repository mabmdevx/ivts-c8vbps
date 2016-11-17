-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2016 at 08:48 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cloudflare_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE IF NOT EXISTS `certificates` (
  `certificate_id` int(10) NOT NULL AUTO_INCREMENT,
  `certificate_customer_id` int(11) NOT NULL,
  `certificate_key` text NOT NULL,
  `certificate_body` text NOT NULL,
  `certificate_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`certificate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`certificate_id`, `certificate_customer_id`, `certificate_key`, `certificate_body`, `certificate_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'D1bODANC2uI1JqxW5YEi', 'D1bODANC2uI1JqxW5YEiD1bODANC2uI1JqxW5YEiD1bODANC2uI1JqxW5YEiD1bODANC2uI1JqxW5YEi', 0, '2016-11-17 00:00:00', '2016-11-17 19:37:01'),
(2, 1, 'C3YAD7UA2hgn7qEDF9zA', 'C3YAD7UA2hgn7qEDF9zAC3YAD7UA2hgn7qEDF9zAC3YAD7UA2hgn7qEDF9zAC3YAD7UA2hgn7qEDF9zA', 1, '2016-11-17 00:00:00', '2016-11-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@test.com', '2016-11-17 18:13:01', '2016-11-17 18:13:01'),
(2, 'Jack Ross', 'jross@test.com', '2016-11-17 00:00:00', '2016-11-17 00:00:00'),
(3, 'test', 'test@test.com', '2016-11-17 18:16:09', '2016-11-17 18:16:09'),
(4, 'test', 'test@test.com', '2016-11-17 18:16:47', '2016-11-17 18:16:47'),
(5, 'test', 'test@test.com', '2016-11-17 18:18:22', '2016-11-17 18:18:22'),
(6, 'test', 'test@test.com', '2016-11-17 18:19:21', '2016-11-17 18:19:21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

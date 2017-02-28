-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Feb 19, 2016 at 06:20 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `last_name` text NOT NULL,
  `first_name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `credit_card_num` text NOT NULL,
  `credit_card_expiry_date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `last_name`, `first_name`, `email`, `password`, `credit_card_num`, `credit_card_expiry_date`) VALUES
(1, 'Mostafa', 'Abdullah', 'theabdullahem@gmail.com', 'qqqqqq', '9834674398753487', '12/2030'),
(2, 'Bill	', 'Gates', 'bill.gates@microsoft.com', 'aaaaaa', '1928364817389475', '09/2029'),
(3, 'Jackie', 'Chan', 'jc@company.com', 'qqqqqq', '36492273909461275', '10/2030'),
(4, 'Elon', 'Musk', 'elon@paypal.com', 'qqqqqq', '8364829506913745', '02/2020'),
(5, 'Bob', 'Bobby', 'bob@gmail.com', '123abc', '1234567890987654', '7/2029'),
(6, 'M', 'Ace', 'iace@gmail.com', '123abc', '1234567890987654', '7/2020');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `sub_total` decimal(6,0) NOT NULL,
  `hst` decimal(6,0) NOT NULL,
  `total_cost` decimal(6,0) NOT NULL,
  `customer_id` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_ibfk_1` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date`, `time`, `sub_total`, `hst`, `total_cost`, `customer_id`) VALUES
(1, '2015-08-02', '17:29:34', 34, 4, 38, 2),
(2, '2016-02-19', '17:31:02', 18, 2, 20, 4);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `seat` text NOT NULL,
  `price` decimal(4,0) NOT NULL,
  `order_id` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `seat`, `price`, `order_id`) VALUES
(1, 'A1', 20, 0),
(2, 'A2', 20, 0),
(3, 'A3', 20, 1),
(4, 'A4', 20, 0),
(5, 'B1', 18, 2),
(6, 'B2', 18, 0),
(7, 'B3', 18, 0),
(8, 'B4', 18, 0),
(9, 'C1', 16, 0),
(10, 'C2', 16, 0),
(11, 'C3', 16, 0),
(12, 'C4', 16, 0),
(13, 'D1', 14, 1),
(14, 'D2', 14, 0),
(15, 'D3', 14, 0),
(16, 'D4', 14, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

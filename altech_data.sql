-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 11, 2024 at 12:31 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `altech`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2a$12$o2jAjufsDAgCn9/L8qJ3Me6h6Gc5mz0/1BIxW7q0Vnpb3WBNPpqg6');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `comment`, `created_at`) VALUES
(1, 2, 'the phone has a nice camera', '2024-08-10 17:04:56');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form_submissions`
--

DROP TABLE IF EXISTS `contact_form_submissions`;
CREATE TABLE IF NOT EXISTS `contact_form_submissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `submission_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_form_submissions`
--

INSERT INTO `contact_form_submissions` (`id`, `name`, `email`, `subject`, `message`, `submission_date`) VALUES
(1, 'brian', 'brianlupasa14@gmail.com', '15 promax', 'are the phones available', '2024-08-10 13:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `email`, `product_id`, `quantity`, `order_date`) VALUES
(1, 'gerald', 'gerald@gmail.com', 0, 20, '2024-08-10 13:03:53'),
(2, 'gerald', 'gerald@gmail.com', 0, 20, '2024-08-10 17:19:42'),
(3, 'steve', 'sautusteve@gmail.com', 9, 20, '2024-08-10 18:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(5, 'dell laptop', 'dell laptops', 6000.00, 'images/laptop.webp'),
(2, 'iphone', '15 promax', 12000.00, 'images/phone.jfif'),
(3, 'sumsung battery', 'strong buttery', 100.00, 'images/battery.jfif'),
(4, 'powerbank', 'phone and any lectrical power bank', 250.00, 'images/power bank.jfif'),
(6, 'headsets', 'blutooth', 100.00, 'images/headsets.jfif'),
(7, 'cables', 'fast cables', 50.00, 'images/cables.jfif'),
(8, 'speakers', 'sudah', 250.00, 'images/speakers.jfif'),
(9, ' MEMORY CARD', '32GB MEMORY CARD', 70.00, 'images/samusang phone.jpg'),
(10, ' EARSETS', 'IPHNOE EARSETS', 250.00, 'images/iphone earsets.jpg'),
(11, 'CABLES', 'HDMI CABLES', 100.00, 'images/hdmi cable.jpg'),
(12, 'protector', 'FULL GLUE SCREEN PROTECTOR', 50.00, 'images/screen protector.jfif'),
(13, 'flash disk', 'toshiba flash disk', 260.00, 'images/toshiba flash.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

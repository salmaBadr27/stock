-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2018 at 01:07 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'salma', '202cb962ac59075b964b07152d234b70'),
(2, 'salma', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category` int(11) DEFAULT NULL,
  `category_image` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `parent_category`, `category_image`, `category_description`) VALUES
(49, 'جمبرى', NULL, 'backend/img/category/zQyHvm5dBVYet9ixLCzo.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` int(20) DEFAULT '500',
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `client_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `code`, `client_name`, `client_description`) VALUES
(69, 25, 'salma badr', 'ttttttttttt'),
(72, 26, 'ccccccc', 'c'),
(70, 27, 'yasser', 'developper'),
(71, 28, 'malek', 'artist'),
(73, 500, 'cash', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_initial_qty` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_unit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `code`, `item_name`, `item_price`, `item_image`, `item_initial_qty`, `item_unit`, `category_id`) VALUES
(22, '255', 'جمبرى مقشر', '200', 'backend/img/items/Cdm3TDvUM94B9ge6bnRK.jpg', '20', 'kg', 49),
(23, '256', 'جمبرى كبير', '200', 'backend/img/items/VEjCn7OBXD3dwtEw173R.jpg', '20', 'kg', 49),
(25, '277', 'shrimp', '200', 'backend/img/items/VEjCn7OBXD3dwtEw173R.jpg', '20', 'كرتونه', 49);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

DROP TABLE IF EXISTS `item_category`;
CREATE TABLE IF NOT EXISTS `item_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `item_id`, `category_id`) VALUES
(3, 66, 49);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_10_21_132252_create_admin_table', 1),
(2, '2018_10_22_071447_create_items_table', 2),
(3, '2018_10_22_073031_create_categories_table', 3),
(4, '2018_10_22_103148_create_client_table', 4),
(5, '2018_10_22_112447_create_supplier_table', 5),
(6, '2018_10_23_075707_create_orders_table', 6),
(7, '2018_10_23_080025_create_orders_item_table', 7),
(8, '2018_10_29_080306_create_item_category_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_date` date NOT NULL,
  `order_no` int(50) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `order_no`, `client_id`) VALUES
(114, '2018-10-15', 55, 69),
(116, '2018-10-15', 5955585, 70),
(117, '2018-10-19', 23288, 69),
(118, '2018-10-19', NULL, 69);

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

DROP TABLE IF EXISTS `orders_item`;
CREATE TABLE IF NOT EXISTS `orders_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`order_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`order_item_id`, `id`, `item_id`, `code`, `quantity`, `unit`) VALUES
(45, 114, 22, '255', '1', 'kg'),
(46, 115, 22, '255', '3', 'كرتونه'),
(47, 116, 22, '255', '545', 'kg'),
(48, 116, 23, '255', '4545', 'كرتونه'),
(49, 117, 22, '255', '22', 'kg'),
(50, 117, 25, '277', '20', 'كرتونه'),
(51, 118, 22, '255', '20', 'kg'),
(52, 118, 23, '256', '20', 'كرتونه'),
(53, 118, 25, '277', '20', 'kg'),
(54, 119, 22, '255', '20', 'kg'),
(55, 119, 23, '256', '20', 'kg'),
(56, 119, 25, '277', '20', 'كرتونه'),
(57, 120, 22, '255', '20', 'kg');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_description`) VALUES
(1, 'salma badr', 'developper');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

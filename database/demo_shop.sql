-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2018 at 07:06 AM
-- Server version: 5.6.37-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demo_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tt_category`
--

CREATE TABLE IF NOT EXISTS `tt_category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(0) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_at` varchar(15) NOT NULL,
  `update_at` varchar(15) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_order`
--

CREATE TABLE IF NOT EXISTS `tt_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `create_at` varchar(15) NOT NULL,
  `update_at` varchar(15) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tt_order_product`
--

CREATE TABLE IF NOT EXISTS `tt_order_product` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `count` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_product`
--

CREATE TABLE IF NOT EXISTS `tt_product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `tag` varchar(500) DEFAULT NULL,
  `image` varchar(0) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `viewed` int(11) DEFAULT '0',
  `create_at` varchar(15) NOT NULL,
  `update_at` varchar(15) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_product_attribute`
--

CREATE TABLE IF NOT EXISTS `tt_product_attribute` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `decription` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_product_image`
--

CREATE TABLE IF NOT EXISTS `tt_product_image` (
  `product_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_product_sale`
--

CREATE TABLE IF NOT EXISTS `tt_product_sale` (
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `from_at` varchar(255) DEFAULT NULL,
  `to_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_product_size`
--

CREATE TABLE IF NOT EXISTS `tt_product_size` (
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `count` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_product_to_category`
--

CREATE TABLE IF NOT EXISTS `tt_product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_setting`
--

CREATE TABLE IF NOT EXISTS `tt_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `json` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tt_setting`
--

INSERT INTO `tt_setting` (`setting_id`, `code`, `key`, `value`, `json`) VALUES
(32, 'config', 'config_name', 'TaiTT''s Shop', 0),
(33, 'config', 'config_owner', 'TaiTT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tt_size`
--

CREATE TABLE IF NOT EXISTS `tt_size` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tt_user`
--

CREATE TABLE IF NOT EXISTS `tt_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_at` varchar(15) DEFAULT NULL,
  `update_at` varchar(15) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tt_user`
--

INSERT INTO `tt_user` (`user_id`, `user_group_id`, `username`, `password`, `status`, `create_at`, `update_at`) VALUES
(1, 1, 'taitt', 'a3f0bec59cebeb60553ec80bbfd5dfdf', 1, '1512386860', '1512386860');

-- --------------------------------------------------------

--
-- Table structure for table `tt_user_group`
--

CREATE TABLE IF NOT EXISTS `tt_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `permission` text,
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tt_user_group`
--

INSERT INTO `tt_user_group` (`user_group_id`, `name`, `permission`) VALUES
(1, 'admin', '{"access":["common\\/dashboard","user\\/user_group_form","user\\/user_group_list"],"modify":["common\\/dashboard","user\\/user_group_form","user\\/user_group_list"]}'),
(2, 'demo', '{"access":["common\\/dashboard","setting\\/setting","user\\/user_group_form","user\\/user_group_list"]}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

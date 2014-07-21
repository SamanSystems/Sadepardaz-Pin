-- phpMyAdmin SQL Dump
-- version 3.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2010 at 11:22 AM
-- Server version: 5.1.45
-- PHP Version: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `chico_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `online_onlinetrans`
--

CREATE TABLE IF NOT EXISTS `online_onlinetrans` (
`id` varchar(36) COLLATE utf8_persian_ci NOT NULL,
`name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
`email` varchar(60) COLLATE utf8_persian_ci NOT NULL,
`mobile_tel` varchar(50) COLLATE utf8_persian_ci NOT NULL,
`desc` varchar(255) COLLATE utf8_persian_ci NOT NULL,
`au` varchar(50) COLLATE utf8_persian_ci NOT NULL,
`pincode_id` varchar(36) COLLATE utf8_persian_ci NOT NULL,
`product_id` int(11) NOT NULL,
`amount` varchar(100) COLLATE utf8_persian_ci NOT NULL,
`date` int(11) NOT NULL,
`status` tinyint(4) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `online_onlinetrans`
--

INSERT INTO `online_onlinetrans` (`id`, `name`, `email`, `mobile_tel`, `desc`, `au`, `pincode_id`, `amount`, `date`, `status`) VALUES
('4c48b5da-0d20-4d34-a44a-3524ad2d4a4c', '', '', '', ' (به منظور خريد محصول: شارژ همراه اول 5000 تومانی)', '-2', '', '5000', 1279833562, 0),
('4c625d0d-b97c-4703-819e-7598ad2d4a4c', 'علی اميری', 'amiri27@gmail.com', '', 'تست تراکنش با مرچنت (به منظور خريد محصول: شارژ ايرانسل 2000 تومانی)', '-2', '', '2000', 1281514765, 0),
('4c625f1a-b178-450d-a72d-777dad2d4a4c', 'علی اميری', 'amiri27@gmail.com', '', 'تست تراکنش با مرچنت (به منظور خريد محصول: شارژ ايرانسل 2000 تومانی)', '4c625f9b-74d4-4941-8e93-0de36a9c8b43', '', '2000', 1281515290, 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_pincodes`
--

CREATE TABLE IF NOT EXISTS `online_pincodes` (
`id` varchar(36) COLLATE utf8_persian_ci NOT NULL,
`product_id` int(11) NOT NULL,
`pin1` text COLLATE utf8_persian_ci NOT NULL,
`pin2` text COLLATE utf8_persian_ci NOT NULL,
`add_date` int(11) NOT NULL,
`status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '-1 locked by admin ,0 not used, 1 published, 2 locked by buyer',
UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `online_pincodes`
--

INSERT INTO `online_pincodes` (`id`, `product_id`, `pin1`, `pin2`, `add_date`, `status`) VALUES
('4c5808a1-12b0-49a9-8391-5f10ad2d4a4c', 1, 'SVJBTjY2OTAyMzQ2NzY3MzI4NA==', 'SVJBTjI2OTAyMzQ2NzY3MzI4NA==', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_products`
--

CREATE TABLE IF NOT EXISTS `online_products` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(70) COLLATE utf8_persian_ci NOT NULL,
`description` varchar(255) COLLATE utf8_persian_ci NOT NULL,
`url` varchar(255) COLLATE utf8_persian_ci NOT NULL,
`price` int(11) NOT NULL,
`publish_order` int(11) NOT NULL DEFAULT '0',
`publish` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 pubish, 0 dont publish',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `online_products`
--

INSERT INTO `online_products` (`id`, `name`, `description`, `url`, `price`, `publish_order`, `publish`) VALUES
(1, 'شارژ ايرانسل 2000 تومانی', 'شارژ ايرانسل 2000 تومانی', '', 2000, 1, 1),
(2, 'شارژ همراه اول 2000 تومانی', 'شارژ همراه اول 2000 تومانی', '', 2000, 2, 1),
(3, 'شارژ تاليا 2000 تومانی', 'شارژ تاليا 2000 تومانی', '', 2000, 3, 1),
(4, 'شارژ ايرانسل 5000 تومانی', 'شارژ ايرانسل 5000 تومانی', '', 5000, 4, 1),
(5, 'شارژ همراه اول 5000 تومانی', 'شارژ همراه اول 5000 تومانی', '', 5000, 5, 1),
(6, 'شارژ تاليا 5000 تومانی', 'شارژ تاليا 5000 تومانی', '', 5000, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `online_settings`
--

CREATE TABLE IF NOT EXISTS `online_settings` (
`id` int(11) NOT NULL,
`name` varchar(150) COLLATE utf8_persian_ci NOT NULL,
`address` text COLLATE utf8_persian_ci NOT NULL,
`phonenum` varchar(50) COLLATE utf8_persian_ci NOT NULL,
`desc` text COLLATE utf8_persian_ci NOT NULL,
`mail_address` varchar(30) COLLATE utf8_persian_ci NOT NULL,
`mail_title` varchar(30) COLLATE utf8_persian_ci NOT NULL,
`send_email` tinyint(1) NOT NULL,
`website` varchar(60) COLLATE utf8_persian_ci NOT NULL,
`pin` varchar(36) COLLATE utf8_persian_ci NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `online_settings`
--

INSERT INTO `online_settings` (`id`, `name`, `address`, `phonenum`, `desc`, `mail_address`, `mail_title`, `send_email`, `website`, `pin`) VALUES
(1, 'چی کو دات آی آر', '', '', 'وبسايت فروش آنلاين کارت شارژ ايرانسل، همراه اول و تاليا', 'info@yousitename.com', 'چی کو دات آی آر', 1, 'http://www.chico.ir', '4c625e59-538c-44ae-9eee-5eaaae8e8897');

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE IF NOT EXISTS `online_users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`email` varchar(35) COLLATE utf8_persian_ci NOT NULL,
`password` varchar(255) COLLATE utf8_persian_ci NOT NULL,
`name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
`role` tinyint(4) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`id`, `email`, `password`, `name`, `role`) VALUES
(1, 'you@yoursite.com', '130a4c96a6f4fa86f4a7f781224c1cf04d0d80a9', 'مدير سايت', 4);
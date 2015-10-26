-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2015 at 08:42 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `olalaco_websajt`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `today_menu` tinyint(1) NOT NULL,
  `menu` tinyint(1) NOT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `title`, `description`, `image_url`, `price`, `today_menu`, `menu`, `staff_id`) VALUES
(1, 'Pizza mala', 'Pizza mala - precnik 10cm', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5205.jpg', '100.00', 1, 0, NULL),
(3, 'Krilca', 'Krilca 1kg', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '750.00', 1, 1, NULL),
(4, 'Krilca mala', 'Krilca malo pakovanje - 500g', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '500.00', 1, 1, NULL),
(5, 'Å½itarice', 'Å½itarice svih vrsta', '', '100.00', 0, 0, NULL),
(6, 'Å½itarice', 'Å½itarice svih vrsta', 'http://localhost/olala/orders/photo/user/images1.jpg', '1000.00', 0, 1, NULL),
(9, 'Krilca extra big', 'Ogromna krilca 3kg', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '2000.00', 0, 1, NULL),
(10, 'Pizza velika', 'Pizza velika 30cm precnik', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5207.jpg', '300.00', 0, 1, NULL),
(11, 'Hrana', 'Hrana hrana hrana', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '120.00', 0, 1, NULL),
(12, 'Krilca mala ddd', 'Krilca malaaaaa', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '120.00', 0, 1, NULL),
(14, 'Krilcaaa bbbb2', 'bbb bbbb2', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '120.00', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_item` tinyint(1) DEFAULT NULL,
  `is_photo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `title`, `description`, `is_item`, `is_photo`) VALUES
(1, 'Indian_Spices.jpg', 'Photo from Africaaa aaaaa aaaaaa', 1, 0),
(2, 'Indian_Spices.jpg', 'Photo from Africaaa vvvvvv 2222', 1, 0),
(3, 'images1.jpg', '', 1, 0),
(4, '800px-CuisineSouthAfrica.jpg', '', 1, 0),
(5, '800px-Jerk_chicken_plate.jpg', '', 1, 0),
(6, 'images1.jpg', '', NULL, NULL),
(7, 'DSC00762.jpg', '', NULL, NULL),
(8, 'DSC00760.jpg', '', NULL, NULL),
(9, 'DSC00758.jpg', '', NULL, NULL),
(10, 'WIN_2.JPG', '', NULL, NULL),
(11, 'WIN_20150818_101756 - Copy.JPG', '', NULL, NULL),
(12, '12042624_10208243286106162_406343339549300320_n.jpg', '', NULL, NULL),
(13, '12042624.jpg', '', NULL, NULL),
(14, '12042624.jpg', '', NULL, NULL),
(15, '12042624.jpg', '', NULL, NULL),
(16, '2015-08-11.jpg', '', NULL, NULL),
(17, '11857553.jpg', '', NULL, NULL),
(18, '11857553.jpg', '', NULL, NULL),
(19, '11834673_10205614200249200_3656359246805702891_o.jpg', '', NULL, NULL),
(20, 'Dafed.jpg', '', NULL, NULL),
(21, '110620131357.jpg', '', NULL, NULL),
(22, 'loft.jpg', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL,
  `work_place` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `work_place`, `salary`, `is_admin`, `user_id`) VALUES
(7, '1', '1.00', 1, 9),
(9, 'korisnik', '0.00', 0, 11),
(27, '', '0.00', 0, 34);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jbg` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwd` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mphone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_staff` tinyint(1) DEFAULT NULL,
  `image_url` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `checkuser_id` bigint(20) NOT NULL,
  `enabled` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `secname`, `jbg`, `adress`, `city`, `email`, `passwd`, `phone`, `mphone`, `is_staff`, `image_url`, `photo_id`, `checkuser_id`, `enabled`) VALUES
(9, 'Goran Hotmail', 'SubiÄ‡', '', 'VojvoÄ‘anska 14, IV, 28', 'Novi Sad', 'gsubic@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', 1, 'http://localhost/olala/orders/photo/user/110620131357.jpg', 21, 0, 1),
(11, 'Ivan', 'FixnoIme', '', NULL, NULL, 'ivandermanov@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', 0, 'http://localhost/olala/orders/photo/user/11857553.jpg', 17, 0, NULL),
(34, 'Goran Ya', 'Subic', '456', 'Vojvodjanska', 'NS', 'gsubic@yahoo.com', '202cb962ac59075b964b07152d234b70', '021', '065', 0, 'http://localhost/olala/orders/photo/user/loft.jpg', 22, 259413434711, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userorder`
--

CREATE TABLE IF NOT EXISTS `userorder` (
  `id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `orderstatus` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkorder_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `started` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userorder`
--

INSERT INTO `userorder` (`id`, `order_date`, `orderstatus`, `checkorder_id`, `started`, `finished`, `user_id`) VALUES
(3, '2015-10-03 01:50:34', 'nije', NULL, '2015-10-03 01:50:34', '2015-10-03 01:50:34', 9),
(4, '2015-10-03 01:53:19', 'nije', NULL, '2015-10-03 01:53:19', '2015-10-03 01:53:19', 9),
(5, '2015-10-03 01:54:45', 'nije', NULL, '2015-10-03 01:54:45', '2015-10-03 01:54:45', 9),
(6, '2015-10-03 01:55:38', 'nije', NULL, '2015-10-03 01:55:38', '2015-10-03 01:55:38', 9),
(7, '2015-10-03 01:56:21', 'nije', NULL, '2015-10-03 01:56:21', '2015-10-03 01:56:21', 9),
(8, '2015-10-03 02:01:16', 'nije', NULL, '2015-10-03 02:01:16', '2015-10-03 02:01:16', 9),
(9, '2015-10-03 02:05:12', 'nije', NULL, '2015-10-03 02:05:12', '2015-10-03 02:05:12', 9),
(10, '2015-10-03 02:08:48', 'nije', NULL, '2015-10-03 02:08:48', '2015-10-03 02:08:48', 13),
(11, '2015-10-03 02:10:20', 'Potvrđeno', '111', '2015-10-03 02:10:20', '2015-10-03 02:10:20', 11),
(12, '2015-10-03 02:13:03', 'nije', NULL, '2015-10-03 02:13:03', '2015-10-03 02:13:03', 11),
(13, '2015-10-03 02:15:23', 'nije', NULL, '2015-10-03 02:15:23', '2015-10-03 02:15:23', 11),
(14, '2015-10-03 02:16:05', 'nije', '539341458879', '2015-10-03 02:16:05', '2015-10-03 02:16:05', 11),
(15, '2015-10-03 02:16:52', 'nije', NULL, '2015-10-03 02:16:52', '2015-10-03 02:16:52', 11),
(16, '2015-10-03 02:17:16', 'nije', NULL, '2015-10-03 02:17:16', '2015-10-03 02:17:16', 11),
(17, '2015-10-03 02:31:39', 'nije', NULL, '2015-10-03 02:31:39', '2015-10-03 02:31:39', 11),
(18, '2015-10-03 02:33:21', 'nije', NULL, '2015-10-03 02:33:21', '2015-10-03 02:33:21', 9),
(19, '2015-10-03 03:20:21', 'nije', NULL, '2015-10-03 03:20:21', '2015-10-03 03:20:21', 12),
(20, '2015-10-03 03:21:28', 'nije', NULL, '2015-10-03 03:21:28', '2015-10-03 03:21:28', 11),
(21, '2015-10-03 03:24:39', 'nije', NULL, '2015-10-03 03:24:39', '2015-10-03 03:24:39', 11),
(22, '2015-10-03 03:25:42', 'nije', NULL, '2015-10-03 03:25:42', '2015-10-03 03:25:42', 9),
(23, '2015-10-03 03:27:26', 'nije', NULL, '2015-10-03 03:27:26', '2015-10-03 03:27:26', 9),
(24, '2015-10-03 03:29:18', 'nije', NULL, '2015-10-03 03:29:18', '2015-10-03 03:29:18', 12),
(25, '2015-10-03 03:41:41', 'nije', NULL, '2015-10-03 03:41:41', '2015-10-03 03:41:41', 12),
(26, '2015-10-03 03:43:24', 'nije', NULL, '2015-10-03 03:43:24', '2015-10-03 03:43:24', 12),
(27, '2015-10-03 03:47:35', 'nije', NULL, '2015-10-03 03:47:35', '2015-10-03 03:47:35', 9),
(28, '2015-10-03 03:52:37', 'nije', NULL, '2015-10-03 03:52:37', '2015-10-03 03:52:37', 11),
(29, '2015-10-03 03:57:46', 'nije', NULL, '2015-10-03 03:57:46', '2015-10-03 03:57:46', 9),
(31, '2015-10-05 23:11:02', 'nije', NULL, '2015-10-05 23:11:02', '2015-10-05 23:11:02', 9),
(32, '2015-10-05 23:14:09', 'nije', NULL, '2015-10-05 23:14:09', '2015-10-05 23:14:09', 9),
(33, '2015-10-05 23:18:20', 'nije', NULL, '2015-10-05 23:18:20', '2015-10-05 23:18:20', 9),
(34, '2015-10-05 23:24:41', 'nije', NULL, '2015-10-05 23:24:41', '2015-10-05 23:24:41', 9),
(35, '2015-10-05 23:33:43', 'nije', NULL, '2015-10-05 23:33:43', '2015-10-05 23:33:43', 9),
(36, '2015-10-05 23:36:42', 'nije', NULL, '2015-10-05 23:36:42', '2015-10-05 23:36:42', 9),
(37, '2015-10-06 00:11:51', 'nije', NULL, '2015-10-06 00:11:51', '2015-10-06 00:11:51', 9),
(38, '2015-10-06 00:14:39', 'nije', NULL, '2015-10-06 00:14:39', '2015-10-06 00:14:39', 9),
(39, '2015-10-06 00:16:31', 'nije', NULL, '2015-10-06 00:16:31', '2015-10-06 00:16:31', 9),
(40, '2015-10-06 00:19:22', 'nije', NULL, '2015-10-06 00:19:22', '2015-10-06 00:19:22', 9),
(41, '2015-10-06 00:22:20', 'nije', NULL, '2015-10-06 00:22:20', '2015-10-06 00:22:20', 9),
(42, '2015-10-06 00:56:11', 'nije', NULL, '2015-10-06 00:56:11', '2015-10-06 00:56:11', 9),
(43, '2015-10-06 00:58:28', 'nije', NULL, '2015-10-06 00:58:28', '2015-10-06 00:58:28', 9),
(44, '2015-10-06 01:02:03', 'nije', '2222', '2015-10-06 01:02:03', '2015-10-06 01:02:03', 9),
(45, '2015-10-06 01:08:54', 'nije', NULL, '2015-10-06 01:08:54', '2015-10-06 01:08:54', 9),
(46, '2015-10-06 01:13:43', 'nije', NULL, '2015-10-06 01:13:43', '2015-10-06 01:13:43', 9),
(47, '2015-10-06 01:15:31', 'nije', NULL, '2015-10-06 01:15:31', '2015-10-06 01:15:31', 9),
(48, '2015-10-06 01:17:44', 'nije', NULL, '2015-10-06 01:17:44', '2015-10-06 01:17:44', 9),
(49, '2015-10-06 01:26:56', 'nije', NULL, '2015-10-06 01:26:56', '2015-10-06 01:26:56', 9),
(50, '2015-10-06 01:29:33', 'nije', NULL, '2015-10-06 01:29:33', '2015-10-06 01:29:33', 9),
(51, '2015-10-06 01:31:03', 'nije', NULL, '2015-10-06 01:31:03', '2015-10-06 01:31:03', 9),
(52, '2015-10-06 01:33:30', 'nije', NULL, '2015-10-06 01:33:30', '2015-10-06 01:33:30', 9),
(53, '2015-10-06 01:35:02', 'nije', NULL, '2015-10-06 01:35:02', '2015-10-06 01:35:02', 9),
(54, '2015-10-06 01:37:36', 'nije', NULL, '2015-10-06 01:37:36', '2015-10-06 01:37:36', 9),
(55, '2015-10-06 01:38:14', 'nije', NULL, '2015-10-06 01:38:14', '2015-10-06 01:38:14', 9),
(56, '2015-10-06 01:39:43', 'nije', NULL, '2015-10-06 01:39:43', '2015-10-06 01:39:43', 9),
(57, '2015-10-06 01:42:41', 'nije', NULL, '2015-10-06 01:42:41', '2015-10-06 01:42:41', 9),
(58, '2015-10-06 01:44:09', 'nije', '963235840447', '2015-10-06 01:44:09', '2015-10-06 01:44:09', 9),
(59, '2015-10-06 01:46:49', 'Otkazano', '858515932333', '2015-10-06 01:46:49', '2015-10-06 01:46:49', 9),
(60, '2015-10-06 01:48:18', 'nije', NULL, '2015-10-06 01:48:18', '2015-10-06 01:48:18', 9),
(61, '2015-10-06 01:48:53', 'nije', '369166138447', '2015-10-06 01:48:53', '2015-10-06 01:48:53', 9),
(62, '2015-10-06 01:48:55', 'nije', '230466275040', '2015-10-06 01:48:55', '2015-10-06 01:48:55', 9),
(63, '2015-10-06 01:50:27', 'PotvrÄ‘eno', '841346376112', '2015-10-06 01:50:27', '2015-10-06 01:50:27', 9),
(64, '2015-10-06 01:53:55', 'nije', NULL, '2015-10-06 01:53:55', '2015-10-06 01:53:55', 9),
(65, '2015-10-06 01:54:33', 'nije', NULL, '2015-10-06 01:54:33', '2015-10-06 01:54:33', 9),
(66, '2015-10-06 01:56:11', 'Otkazano', '154886645375', '2015-10-06 01:56:11', '2015-10-06 01:56:11', 9),
(67, '2015-10-06 11:10:56', 'nije', NULL, '2015-10-06 11:10:56', '2015-10-06 11:10:56', 9),
(68, '2015-10-06 11:16:38', 'PotvrÄ‘eno', '967566857584', '2015-10-06 11:16:38', '2015-10-06 11:16:38', 9),
(69, '2015-10-06 11:20:23', 'nije', NULL, '2015-10-06 11:20:23', '2015-10-06 11:20:23', 9),
(70, '2015-10-06 11:21:25', 'nije', NULL, '2015-10-06 11:21:25', '2015-10-06 11:21:25', 9),
(71, '2015-10-06 11:24:55', 'PotvrÄ‘eno', '212637124963', '2015-10-06 11:24:55', '2015-10-06 11:24:55', 9),
(72, '2015-10-07 15:34:40', 'PotvrÄ‘eno', '222577235903', '2015-10-07 15:37:07', '2015-10-07 15:36:24', 9),
(73, '2015-10-07 23:46:04', 'PotvrÄ‘eno', '888927340686', '2015-10-07 23:46:41', NULL, 16),
(74, '2015-10-08 01:19:34', 'nije', '779017497869', NULL, NULL, 9),
(75, '2015-10-08 12:43:30', 'PotvrÄ‘eno', '856127586408', '2015-10-08 12:44:36', NULL, 9),
(76, '2015-10-08 12:47:28', 'nije', '521337626578', NULL, NULL, 9),
(77, '2015-10-08 12:51:28', 'nije', '326397747971', NULL, NULL, 9),
(78, '2015-10-08 12:53:46', 'nije', '276877899020', NULL, NULL, 20),
(79, '2015-10-08 13:12:21', 'PotvrÄ‘eno', '412097998000', '2015-10-08 13:12:43', NULL, 16),
(80, '2015-10-08 19:01:57', 'PotvrÄ‘eno', '581228013904', '2015-10-08 19:02:18', NULL, 28),
(81, '2015-10-08 20:21:49', 'PotvrÄ‘eno', '34942819966', '2015-10-08 20:22:14', NULL, 29),
(82, '2015-10-08 22:57:00', 'PotvrÄ‘eno', '212278247487', '2015-10-08 22:57:14', NULL, 34),
(83, '2015-10-11 18:45:49', 'nije', '17540835245', NULL, NULL, 34),
(84, '2015-10-11 18:59:24', 'PotvrÄ‘eno', '250278434183', '2015-10-11 18:59:45', NULL, 34),
(85, '2015-10-11 19:58:00', 'Otkazano', '663838519367', '2015-10-11 19:58:24', '2015-10-11 20:01:19', 35);

-- --------------------------------------------------------

--
-- Table structure for table `userorder_item`
--

CREATE TABLE IF NOT EXISTS `userorder_item` (
  `item_id` int(11) NOT NULL,
  `userorder_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userorder_item`
--

INSERT INTO `userorder_item` (`item_id`, `userorder_id`, `quantity`, `price`) VALUES
(3, 3, 2, '750.00'),
(3, 4, 2, '750.00'),
(3, 5, 2, '750.00'),
(3, 6, 2, '750.00'),
(3, 7, 2, '750.00'),
(6, 8, 4, '1000.00'),
(10, 8, 3, '300.00'),
(11, 8, 1, '120.00'),
(6, 9, 4, '1000.00'),
(10, 9, 3, '300.00'),
(11, 9, 1, '120.00'),
(3, 10, 1, '750.00'),
(4, 10, 5, '500.00'),
(9, 11, 3, '2000.00'),
(11, 11, 5, '120.00'),
(3, 12, 3, '750.00'),
(9, 12, 4, '2000.00'),
(12, 12, 2, '120.00'),
(14, 12, 3, '120.00'),
(3, 13, 3, '750.00'),
(9, 13, 4, '2000.00'),
(12, 13, 2, '120.00'),
(14, 13, 3, '120.00'),
(3, 14, 3, '750.00'),
(9, 14, 4, '2000.00'),
(12, 14, 2, '120.00'),
(14, 14, 3, '120.00'),
(3, 15, 3, '750.00'),
(9, 15, 4, '2000.00'),
(12, 15, 2, '120.00'),
(14, 15, 3, '120.00'),
(3, 16, 3, '750.00'),
(9, 16, 4, '2000.00'),
(12, 16, 2, '120.00'),
(14, 16, 3, '120.00'),
(3, 17, 2, '750.00'),
(4, 17, 1, '500.00'),
(4, 18, 10, '500.00'),
(3, 19, 1, '750.00'),
(4, 19, 2, '500.00'),
(4, 20, 2, '500.00'),
(9, 20, 3, '2000.00'),
(4, 21, 2, '500.00'),
(9, 21, 3, '2000.00'),
(3, 22, 1, '750.00'),
(4, 22, 2, '500.00'),
(3, 23, 1, '750.00'),
(4, 23, 2, '500.00'),
(3, 24, 2, '750.00'),
(4, 24, 3, '500.00'),
(3, 25, 1, '750.00'),
(4, 26, 1, '500.00'),
(4, 27, 1, '500.00'),
(9, 27, 3, '2000.00'),
(10, 27, 3, '300.00'),
(3, 28, 2, '750.00'),
(4, 28, 1, '500.00'),
(6, 28, 1, '1000.00'),
(10, 28, 3, '300.00'),
(3, 29, 1, '750.00'),
(4, 29, 2, '500.00'),
(6, 29, 3, '1000.00'),
(3, 34, 1, '750.00'),
(4, 34, 1, '500.00'),
(3, 35, 1, '750.00'),
(4, 35, 3, '500.00'),
(9, 35, 1, '2000.00'),
(3, 36, 2, '750.00'),
(6, 36, 1, '1000.00'),
(9, 36, 2, '2000.00'),
(3, 37, 1, '750.00'),
(4, 37, 1, '500.00'),
(6, 37, 1, '1000.00'),
(9, 37, 1, '2000.00'),
(3, 38, 1, '750.00'),
(4, 38, 1, '500.00'),
(6, 38, 1, '1000.00'),
(9, 38, 1, '2000.00'),
(3, 39, 1, '750.00'),
(4, 39, 1, '500.00'),
(6, 39, 1, '1000.00'),
(9, 39, 1, '2000.00'),
(3, 40, 1, '750.00'),
(4, 40, 1, '500.00'),
(6, 40, 1, '1000.00'),
(9, 40, 1, '2000.00'),
(3, 41, 1, '750.00'),
(4, 41, 4, '500.00'),
(3, 42, 1, '750.00'),
(4, 42, 4, '500.00'),
(3, 43, 1, '750.00'),
(6, 43, 1, '1000.00'),
(9, 43, 1, '2000.00'),
(3, 44, 1, '750.00'),
(6, 44, 2, '1000.00'),
(9, 44, 1, '2000.00'),
(3, 45, 1, '750.00'),
(6, 45, 2, '1000.00'),
(9, 45, 3, '2000.00'),
(3, 46, 1, '750.00'),
(4, 46, 2, '500.00'),
(3, 47, 1, '750.00'),
(6, 47, 2, '1000.00'),
(9, 47, 1, '2000.00'),
(3, 48, 1, '750.00'),
(4, 48, 2, '500.00'),
(9, 48, 1, '2000.00'),
(3, 49, 1, '750.00'),
(6, 49, 2, '1000.00'),
(9, 49, 3, '2000.00'),
(3, 50, 1, '750.00'),
(6, 50, 2, '1000.00'),
(9, 50, 3, '2000.00'),
(3, 51, 1, '750.00'),
(6, 51, 2, '1000.00'),
(9, 51, 3, '2000.00'),
(3, 52, 1, '750.00'),
(6, 52, 2, '1000.00'),
(9, 52, 3, '2000.00'),
(3, 58, 1, '750.00'),
(4, 58, 1, '500.00'),
(3, 59, 1, '750.00'),
(4, 59, 1, '500.00'),
(3, 61, 1, '750.00'),
(4, 61, 1, '500.00'),
(3, 62, 1, '750.00'),
(4, 62, 1, '500.00'),
(3, 63, 1, '750.00'),
(4, 63, 1, '500.00'),
(3, 66, 1, '750.00'),
(6, 66, 2, '1000.00'),
(9, 66, 1, '2000.00'),
(3, 68, 1, '750.00'),
(4, 68, 3, '500.00'),
(3, 71, 3, '750.00'),
(4, 71, 1, '500.00'),
(3, 72, 1, '750.00'),
(4, 72, 1, '500.00'),
(3, 73, 1, '750.00'),
(6, 73, 2, '1000.00'),
(9, 73, 1, '2000.00'),
(3, 74, 1, '750.00'),
(4, 74, 2, '500.00'),
(11, 74, 3, '120.00'),
(3, 75, 1, '750.00'),
(4, 75, 2, '500.00'),
(9, 75, 3, '2000.00'),
(3, 76, 1, '750.00'),
(4, 76, 2, '500.00'),
(6, 76, 2, '1000.00'),
(3, 77, 2, '750.00'),
(4, 77, 1, '500.00'),
(6, 77, 1, '1000.00'),
(10, 77, 2, '300.00'),
(4, 78, 2, '500.00'),
(6, 78, 1, '1000.00'),
(10, 78, 1, '300.00'),
(3, 79, 2, '750.00'),
(4, 79, 1, '500.00'),
(3, 80, 1, '750.00'),
(4, 80, 2, '500.00'),
(3, 81, 1, '750.00'),
(6, 81, 2, '1000.00'),
(10, 81, 3, '300.00'),
(3, 82, 1, '750.00'),
(4, 82, 2, '500.00'),
(3, 83, 1, '750.00'),
(4, 83, 2, '500.00'),
(6, 83, 1, '1000.00'),
(3, 84, 2, '750.00'),
(4, 84, 3, '500.00'),
(6, 84, 4, '1000.00'),
(3, 85, 1, '750.00'),
(4, 85, 2, '500.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`), ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD KEY `photo_id` (`photo_id`);

--
-- Indexes for table `userorder`
--
ALTER TABLE `userorder`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `checkorder_id` (`checkorder_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userorder_item`
--
ALTER TABLE `userorder_item`
  ADD KEY `item_id` (`item_id`), ADD KEY `order_id` (`userorder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `userorder`
--
ALTER TABLE `userorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

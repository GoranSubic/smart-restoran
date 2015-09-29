-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2015 at 03:28 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
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
(6, 'Å½itarice', 'Å½itarice svih vrsta', 'http://localhost/smart2015/restoran/img/Indian_Spices.jpg', '1000.00', 0, 1, NULL),
(9, 'Krilca extra big', 'Ogromna krilca 3kg', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '2000.00', 0, 1, NULL),
(10, 'Pizza velika', 'Pizza velika 30cm precnik', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5207.jpg', '300.00', 0, 1, NULL),
(11, 'Hrana', 'Hrana hrana hrana', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '120.00', 0, 1, NULL),
(12, 'Krilca mala ddd', 'Krilca malaaaaa', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '120.00', 0, 1, NULL),
(13, 'Krilcaaa bbbb', 'bbb bbbb', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '120.00', 0, 1, NULL),
(14, 'Krilcaaa bbbb2', 'bbb bbbb2', 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', '120.00', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `title`, `description`) VALUES
(1, 'Indian_Spices.jpg', ''),
(2, 'Indian_Spices.jpg', ''),
(3, 'images1.jpg', ''),
(4, '800px-CuisineSouthAfrica.jpg', ''),
(5, '800px-Jerk_chicken_plate.jpg', ''),
(6, 'images1.jpg', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `work_place`, `salary`, `is_admin`, `user_id`) VALUES
(1, 'Kuhinji', '1005.00', 1, 1),
(2, 'Kuhinji', '1000.00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jbg` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwd` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mphone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_staff` tinyint(1) DEFAULT NULL,
  `image_url` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `secname`, `jbg`, `email`, `passwd`, `phone`, `mphone`, `is_staff`, `image_url`, `photo_id`) VALUES
(1, 'Goran', 'FixnoIme', '123', 'gsubic@gmail.com', '123', '021', '065', 1, 'http://localhost/smart2015/smart-restoran/photo/user/images1.jpg', 6),
(2, 'Goran2', 'FixnoIme', '12322', 'gsubic@gmail.com', '2222', '021222', '065222', 1, 'http://www.olala.co.rs/wp-content/uploads/2015/02/SC_5208.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userorder`
--

CREATE TABLE IF NOT EXISTS `userorder` (
  `id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `started` datetime NOT NULL,
  `finished` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userorder_item`
--

CREATE TABLE IF NOT EXISTS `userorder_item` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Indexes for table `userorder`
--
ALTER TABLE `userorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userorder_item`
--
ALTER TABLE `userorder_item`
  ADD KEY `item_id` (`item_id`),
  ADD KEY `order_id` (`order_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `userorder`
--
ALTER TABLE `userorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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

--
-- Constraints for table `userorder`
--
ALTER TABLE `userorder`
  ADD CONSTRAINT `userorder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `userorder_item`
--
ALTER TABLE `userorder_item`
  ADD CONSTRAINT `userorder_item_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `userorder_item_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `userorder` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

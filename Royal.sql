-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2024 at 06:14 PM
-- Server version: 8.0.36-0ubuntu0.23.10.1
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pal_event`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `gallery_item_id` int DEFAULT NULL,
  `price` float NOT NULL DEFAULT '0',
  `amount_op1` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `gallery_item_id`, `price`, `amount_op1`) VALUES
(16, 6, 7, 44, 22),
(17, 6, 1, 3, 3),
(18, 8, 11, 4, 3),
(19, 8, 12, 5, 3),
(20, 8, 13, 77, 3),
(21, 8, 7, 44, 1),
(22, 8, 12, 0, 1),
(23, 8, 12, 0, 1),
(24, 8, 12, 0, 1),
(25, 8, 12, 0, 1),
(26, 8, 12, 0, 1),
(27, 8, 12, 0, 1),
(28, 8, 12, 0, 1),
(29, 8, 11, 0, 1),
(30, 8, 10, 0, 1),
(31, 8, 10, 0, 1),
(32, 8, 13, 0, 1),
(33, 8, 12, 0, 1),
(34, 8, 11, 0, 1),
(35, 8, 10, 0, 1),
(36, 8, 2, 0, 1),
(37, 8, 7, 44, 1),
(38, 8, 1, 0, 1),
(39, 8, 10, 0, 1),
(40, 8, 15, 0, 1),
(41, 8, 16, 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_attachment`
--

CREATE TABLE `gallery_attachment` (
  `id` int NOT NULL,
  `description` text,
  `file_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'image or video',
  `item_id` int DEFAULT NULL,
  `row_deleted` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `gallery_attachment`
--

INSERT INTO `gallery_attachment` (`id`, `description`, `file_name`, `item_id`, `row_deleted`) VALUES
(1, 'محادثات', '1280684637_file_upload_1714062967.png', 17, 0),
(2, 'serwetrwet', '1544077970_file_upload_1714063145.webm', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items`
--

CREATE TABLE `gallery_items` (
  `id` int NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `price` float DEFAULT '0',
  `description` text,
  `file_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'image or video',
  `category_id` int DEFAULT NULL,
  `row_deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `gallery_items`
--

INSERT INTO `gallery_items` (`id`, `name`, `price`, `description`, `file_name`, `category_id`, `row_deleted`) VALUES
(1, 'شاشات', 0, NULL, '', 1, 0),
(2, 'ممرات', 0, NULL, '545489458_file_upload_1703696688.png', 1, 0),
(3, 'دانس فلورd', 0, NULL, '1187825423_file_upload_1703689915.png', 2, 0),
(4, 'دانس فلورg', 0, NULL, '1187825423_file_upload_1703689915.png', 2, 0),
(5, 'شاشات', 0, NULL, '', 1, 0),
(6, 'ممرات', 0, NULL, '545489458_file_upload_1703696688.png', 1, 0),
(7, 'دانس فلورet4y4', 44, 'dfdf dfhfd dddddsdfhdfdf dfhfd dfhsdfhdfdf dfhfd dfhsdfhdfdf dfhfd dfhsdfhdfdf dfhfd dfhsdfhdfdf dfhfd dfhsdfh', '1187825423_file_upload_1703689915.png', 2, 0),
(8, 'دانس فلورeeee', 0, NULL, '1187825423_file_upload_1703689915.png', 2, 0),
(9, 'شاشات', 0, 'محادثات  محادثات  محادثات  محادثات  محادثات  محادثات  محادثات  محادثات  ', '', 1, 0),
(10, 'شاشات', 0, NULL, '', 1, 0),
(11, 'ممرات', 0, NULL, '545489458_file_upload_1703696688.png', 1, 0),
(12, 'ممرات', 0, NULL, '545489458_file_upload_1703696688.png', 1, 0),
(13, 'page home', 0, NULL, '640090229_file_upload_1703937010.mp4', 2, 0),
(14, NULL, 0, NULL, NULL, 1, 0),
(15, '235 يبليبل ', 0, 'سيبلسي', '', 1, 0),
(16, 'سيلسيل سيلسيل', 34, 'يبل يبيبايبا', NULL, 1, 0),
(17, 'يييييييي', 0, 'ييييي', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items_categories`
--

CREATE TABLE `gallery_items_categories` (
  `id` int NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `row_deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `gallery_items_categories`
--

INSERT INTO `gallery_items_categories` (`id`, `category_name`, `row_deleted`) VALUES
(1, 'شاشات', 0),
(2, 'دانس فلور', 0),
(3, 'asd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `transaction_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `recipient_name` varchar(100) DEFAULT NULL COMMENT 'اسم المستلم',
  `recipient_phone` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `recipient_address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `response` int NOT NULL DEFAULT '0' COMMENT '0.wait 1.accept 2.reject',
  `row_deleted` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `transaction_datetime`, `user_id`, `recipient_name`, `recipient_phone`, `recipient_address`, `response`, `row_deleted`) VALUES
(1, '2024-04-08 03:10:38', 6, 'sdfsdag', 'dgasdg', 'asdgas', 0, 1),
(2, '2024-04-08 03:11:10', 6, 'sdfsdag', 'dgasdg', 'asdgas', 0, 0),
(3, '2024-04-08 03:11:15', 6, 'wetweqtqwet', 'qweyqw', 'eyqweyqwey', 0, 0),
(4, '2024-04-08 03:11:16', 6, 'wetweqtqwet', 'qweyqw', 'eyqweyqwey', 0, 0),
(5, '2024-04-08 03:11:18', 6, 'wetweqtqwet', 'qweyqw', 'eyqweyqwey', 0, 0),
(6, '2024-04-08 03:11:18', 6, 'wetweqtqwet', 'qweyqw', 'eyqweyqwey', 0, 0),
(7, '2024-04-08 03:11:41', 6, 'wetweqtqwet', 'qweyqw', 'eyqweyqwey', 0, 1),
(8, '2024-04-08 03:11:42', 6, 'wetweqtqwet', 'qweyqw', 'eyqweyqwey', 0, 1),
(9, '2024-04-08 03:12:31', 6, 'ertwertyqwey', 'wqetqwet', 'weqy', 0, 1),
(10, '2024-04-08 04:34:38', 6, 'dsafasgas', 'gasgasgasg', 'asgasg', 2, 0),
(11, '2024-04-08 04:39:02', 6, 'ali', 'ali', 'alo', 1, 0),
(12, '2024-04-08 04:40:13', 6, 'df', 'df', 'df', 2, 0),
(13, '2024-04-08 05:09:29', 6, '452346', '3462346', '234626', 1, 0),
(14, '2024-04-21 18:12:08', 8, 's', 's', 's', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `gallery_item_id` int DEFAULT NULL,
  `price` float NOT NULL DEFAULT '0',
  `amount_op1` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `gallery_item_id`, `price`, `amount_op1`) VALUES
(1, 10, 11, 0, 1),
(2, 10, 7, 0, 1),
(3, 10, 11, 0, 1),
(4, 10, 7, 0, 1),
(5, 10, 7, 0, 1),
(6, 11, 11, 0, 1),
(7, 11, 7, 0, 1),
(8, 11, 11, 0, 1),
(9, 11, 7, 0, 1),
(10, 11, 7, 0, 1),
(11, 12, 7, 44, 1),
(12, 12, 1, 0, 1),
(13, 13, 7, 44, 22),
(14, 13, 1, 0, 3),
(15, 14, 11, 4, 3),
(16, 14, 12, 5, 3),
(17, 14, 13, 77, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `loginname` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `user_type` int DEFAULT NULL COMMENT '1.admin 2.customer',
  `row_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `address`, `phone`, `loginname`, `password`, `user_type`, `row_deleted`) VALUES
(1, 'admin', NULL, NULL, 'admin', '0c7540eb7e65b553ec1ba6b20de79608', 1, 0),
(2, 'aaaa', NULL, NULL, 'aaa', 'd5d849bdba01233f855b16da071127ae', 1, 0),
(3, 'c', '3456346346', '562457457', 'c', 'e4580e1569bfa4b721763ba590ea34fc', 2, 0),
(4, 'v', NULL, NULL, 'v', '791dd97fda69b6f7237114db1a5ade5c', 1, 0),
(5, 'h', 'h', 'h', 'h', '7737e30ff1df1a730bdaef495847f567', 2, 0),
(6, 'cc', 'cc', 'cc', 'cc', '86f0df443bf4127d8aa6432a914a0616', 2, 0),
(7, 'hh', 'hh', 'hh', 'hh', 'b5c7de7b2d5f0e424490bab368a091f1', 2, 0),
(8, 'ccc', 'ccc', 'ccc', 'ccc', '085001698122db5c27c174d2302c1c44', 2, 0),
(9, 'c1', 'c1', 'c1', 'c1', '421bff845e2494112ff820a6416b7366', 2, 0),
(10, 'sdfgasdgasdg', 'sdfgsdfgsdfg', '35235', 'sdfsdg', '36091e5151bfdb5f8572f5e30cd2933c', 2, 0),
(20, 'asgsdag', 'sdagasdg', 'sdgasdg', 'sdagasdg', 'fdcc50b61dc532d15108957e71f5bc9e', 2, 0),
(21, 'g', 'g', 'g', 'g', 'fdcc50b61dc532d15108957e71f5bc9e', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_agent_ip`
--

CREATE TABLE `user_agent_ip` (
  `id` int NOT NULL,
  `insert_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_agent` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `ip` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `request_type` int DEFAULT NULL COMMENT '1.signup 2.order'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_agent_ip`
--

INSERT INTO `user_agent_ip` (`id`, `insert_datetime`, `user_agent`, `ip`, `hash`, `request_type`) VALUES
(1, '2024-02-02 23:27:54', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '::1', 'f8a80c28831e9b61d5937e93ef49259d', NULL),
(2, '2024-02-02 23:38:41', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '::1', 'f8a80c28831e9b61d5937e93ef49259d', NULL),
(3, '2024-02-02 23:44:06', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '::1', 'f8a80c28831e9b61d5937e93ef49259d', NULL),
(4, '2024-02-04 15:37:54', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '::1', 'f8a80c28831e9b61d5937e93ef49259d', 2),
(5, '2024-02-04 15:42:56', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '::1', 'f8a80c28831e9b61d5937e93ef49259d', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_user_id` (`user_id`),
  ADD KEY `fk_cart_gallery_item_id` (`gallery_item_id`);

--
-- Indexes for table `gallery_attachment`
--
ALTER TABLE `gallery_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gallery_items_category_id` (`category_id`);

--
-- Indexes for table `gallery_items_categories`
--
ALTER TABLE `gallery_items_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user_id` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_detail_order_id` (`order_id`),
  ADD KEY `fk_order_detail_gallery_item_id` (`gallery_item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginname` (`loginname`);

--
-- Indexes for table `user_agent_ip`
--
ALTER TABLE `user_agent_ip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `gallery_attachment`
--
ALTER TABLE `gallery_attachment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery_items`
--
ALTER TABLE `gallery_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gallery_items_categories`
--
ALTER TABLE `gallery_items_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_agent_ip`
--
ALTER TABLE `user_agent_ip`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_gallery_item_id` FOREIGN KEY (`gallery_item_id`) REFERENCES `gallery_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD CONSTRAINT `fk_gallery_items_category_id` FOREIGN KEY (`category_id`) REFERENCES `gallery_items_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_order_detail_gallery_item_id` FOREIGN KEY (`gallery_item_id`) REFERENCES `gallery_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_order_detail_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

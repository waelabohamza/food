-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2020 at 11:49 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_photo` varchar(255) NOT NULL,
  `cat_type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_photo`, `cat_type`) VALUES
(18, 'سلطات', '1.png', 0),
(19, 'وجبات غربية', '2.png', 0),
(22, 'عصائر', '5.png', 0),
(23, 'marcedes', '10.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_size` int(11) NOT NULL DEFAULT '1',
  `item_price` float NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_time_delivery` int(11) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_cat` int(11) NOT NULL,
  `item_res` int(11) NOT NULL,
  `item_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_size`, `item_price`, `item_description`, `item_time_delivery`, `item_image`, `item_cat`, `item_res`, `item_active`) VALUES
(19, 'ستيك مشوي', 1, 11.212, 'هنا يتم وضع وصف مختر للمنتج', 0, '22.jpg', 19, 1, 1),
(20, 'سلطة خضاs', 1, 12.343, 'هنا يتم وضع وصف مختر للمنتج', 0, '33.jpg', 19, 1, 1),
(23, 'لحوم باردة', 1, 21.232, 'هنا يتم وضع وصف مختر للمنتج', 0, '11.jpg', 18, 1, 1),
(24, 'chiken', 1, 20.233, 'sdasd s dsd ', 30, '33.jpg', 18, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `orders_users` int(11) NOT NULL,
  `orders_res` int(11) NOT NULL,
  `orders_description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `orders_lat` double NOT NULL,
  `orders_long` double NOT NULL,
  `orders_address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `orders_date` datetime NOT NULL,
  `orders_total` float NOT NULL,
  `orders_status` tinyint(4) NOT NULL,
  `orders_delivery` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `orders_users`, `orders_res`, `orders_description`, `orders_lat`, `orders_long`, `orders_address`, `orders_date`, `orders_total`, `orders_status`, `orders_delivery`) VALUES
(83, 9, 3, 'تجربة', 33.6366068, 36.2947808, 'تجربة', '2020-12-03 11:39:58', 40.233, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderstaxi`
--

CREATE TABLE `orderstaxi` (
  `orderstaxi_id` int(11) NOT NULL,
  `orderstaxi_user` int(11) NOT NULL,
  `orderstaxi_taxi` int(11) NOT NULL,
  `orderstaxi_lat` float NOT NULL,
  `orderstaxi_long` float NOT NULL,
  `orderstaxi_lat_dest` float NOT NULL,
  `orderstaxi_long_dest` float NOT NULL,
  `orderstaxi_price` float NOT NULL,
  `orderstaxi_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orderstaxi_distancekm` float NOT NULL,
  `orderstaxi_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderstaxi`
--

INSERT INTO `orderstaxi` (`orderstaxi_id`, `orderstaxi_user`, `orderstaxi_taxi`, `orderstaxi_lat`, `orderstaxi_long`, `orderstaxi_lat_dest`, `orderstaxi_long_dest`, `orderstaxi_price`, `orderstaxi_date`, `orderstaxi_distancekm`, `orderstaxi_status`) VALUES
(9, 9, 6, 33.6366, 36.2948, 33.4083, 36.3138, 1220.51, '2020-12-03 11:46:22', 39.017, 3),
(10, 9, 6, 33.6366, 36.2948, 33.5127, 36.2919, 789.26, '2020-12-04 15:30:35', 24.642, 0),
(11, 9, 6, 33.6366, 36.2948, 33.4917, 36.1941, 1036.07, '2020-12-04 15:31:28', 32.869, 0),
(12, 9, 6, 33.6366, 36.2948, 33.4444, 36.3795, 882.26, '2020-12-04 15:39:17', 27.742, 0),
(13, 9, 6, 33.6366, 36.2948, 33.3584, 36.2311, 1342.7, '2020-12-04 16:02:20', 43.09, 0),
(14, 9, 6, 33.6366, 36.2948, 33.5747, 36.3091, 317.57, '2020-12-04 16:04:16', 8.919, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL,
  `details_order` int(11) NOT NULL,
  `details_item` int(11) NOT NULL,
  `details_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_details`
--

INSERT INTO `orders_details` (`id`, `details_order`, `details_item`, `details_quantity`) VALUES
(35, 83, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `res_id` int(11) NOT NULL,
  `res_name` varchar(255) NOT NULL,
  `res_password` varchar(255) NOT NULL,
  `res_email` varchar(255) NOT NULL,
  `res_phone` int(11) NOT NULL,
  `res_type` varchar(255) NOT NULL,
  `res_description` varchar(255) NOT NULL,
  `res_time_delivery` int(11) NOT NULL,
  `res_price_delivery` float NOT NULL,
  `res_image` varchar(255) NOT NULL,
  `res_lisence` varchar(255) NOT NULL,
  `res_country` varchar(255) NOT NULL,
  `res_area` varchar(255) NOT NULL DEFAULT '0',
  `res_street` varchar(255) NOT NULL,
  `res_lat` double NOT NULL DEFAULT '0',
  `res_lon` double NOT NULL DEFAULT '0',
  `res_approve` int(11) NOT NULL DEFAULT '0',
  `res_balance` float NOT NULL DEFAULT '0',
  `res_token` varchar(255) NOT NULL,
  `res_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`res_id`, `res_name`, `res_password`, `res_email`, `res_phone`, `res_type`, `res_description`, `res_time_delivery`, `res_price_delivery`, `res_image`, `res_lisence`, `res_country`, `res_area`, `res_street`, `res_lat`, `res_lon`, `res_approve`, `res_balance`, `res_token`, `res_active`) VALUES
(1, 'wael', 'wael', 'wael@gmail.com', 343434, 'وجبات غربية', 'dsfsdfsdfdsfdsfsdf', 53, 10, 'fiveguys.jpg', 'lisence5.jpg', 'Lebanon', 'Bqaa Safrin', 'Unnamed Road', 33.806221827166375, 35.84205664694309, 1, 390.676, 'ekGbCTXcSOesEw_Z5xXzWr:APA91bFeiLGaqKe1AxvpgjYHBgMFer94_1Bh8kaqKrzX4vLcYrKLJN3co_UgP5vA3H9RcHm-MNwuHsXN9aP1mQHXZ_b-fWqJLrwAbHYlws71YZyz8uxON4Nef0F7-XgNv1tJADzyCMC-', 1),
(2, 'pizzahut', 'pizzhut', 'pizzhut@gmail.com', 2323, 'دجاج مقلي', 'جميع انواع البيتزا', 30, 0, 'pizzahut.jpg', 'lisence1.jpg', 'Lebanon', 'Bqaa Safrin', '', 34.06369, 35.8810317, 1, 0, '', 1),
(3, 'kfc', 'kfcc', 'kfc@gmail.com', 22344, 'دجاج مقلي', 'دجاج مقلي', 30, 20, 'kfc.jpg', 'lisence2.jpg', 'Lebanon', 'Bqaa Safrin', '', 34.06369, 35.8810317, 1, 5901.96, '', 1),
(4, 'mcdonald', 'mcdonald', 'mcdonald@gmail.com', 75332, 'دجاج مقلي', 'وجبات غربية', 30, 0, 'mcdonalds.jpg', 'lisence3.jpg', 'Lebanon', 'Bqaa Safrin', '', 34.06369, 35.8810317, 1, 0, '', 1),
(5, 'fiveguys', 'fiveguys', 'fiveguys@gmail.com', 53434, 'دجاج مقلي', 'وجبات غربية', 30, 0, 'fiveguys.jpg', 'lisence4.jpg', 'Lebanon', 'Bqaa Safrin', '', 34.06369, 35.8810317, 1, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `school` varchar(255) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `school`, `lat`, `lng`) VALUES
(1, 'التل', 33.606, 36.3135),
(2, 'معربا', 33.5752, 36.296),
(3, 'دمشق ', 33.5148, 36.3084),
(4, 'درعا', 32.5931, 36.1223),
(5, 'كسوة', 33.3627, 36.2448),
(6, 'صدينايا', 33.6909, 36.379),
(7, 'معره', 33.6758, 36.3454);

-- --------------------------------------------------------

--
-- Table structure for table `taxi`
--

CREATE TABLE `taxi` (
  `taxi_id` int(11) NOT NULL,
  `taxi_username` varchar(255) NOT NULL,
  `taxi_email` varchar(255) NOT NULL,
  `taxi_password` varchar(255) NOT NULL,
  `taxi_phone` int(11) NOT NULL,
  `taxi_cat` int(11) NOT NULL,
  `taxi_imageuser` varchar(255) NOT NULL,
  `taxi_model` varchar(255) NOT NULL,
  `taxi_year` int(11) NOT NULL,
  `taxi_licence` varchar(255) NOT NULL,
  `taxi_description` varchar(255) NOT NULL,
  `taxi_lat` float NOT NULL,
  `taxi_long` float NOT NULL,
  `taxi_image` varchar(255) NOT NULL,
  `taxi_approve` tinyint(4) NOT NULL DEFAULT '0',
  `taxi_price` float NOT NULL,
  `taxi_mincharge` float NOT NULL,
  `taxi_balance` float NOT NULL,
  `taxi_status` tinyint(4) NOT NULL DEFAULT '0',
  `taxi_active` tinyint(4) NOT NULL DEFAULT '1',
  `taxi_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taxi`
--

INSERT INTO `taxi` (`taxi_id`, `taxi_username`, `taxi_email`, `taxi_password`, `taxi_phone`, `taxi_cat`, `taxi_imageuser`, `taxi_model`, `taxi_year`, `taxi_licence`, `taxi_description`, `taxi_lat`, `taxi_long`, `taxi_image`, `taxi_approve`, `taxi_price`, `taxi_mincharge`, `taxi_balance`, `taxi_status`, `taxi_active`, `taxi_token`) VALUES
(6, 'merft', 'merft@gmail.com', 'merft', 26663636, 23, '1646image_picker8293040523567100888.jpg', 'lada', 2015, '1864scaled_image_picker6835554702791314245.jpg', 'aaaaaaaaaaa', 33.6366, 36.2948, '1.jpg', 1, 30, 50, 317.57, 0, 1, 'd08H_qbsRTetsyMvMAuZUt:APA91bEOVbRZAzUdnxHcHzUOhnR4ujcLvl5AX_BMEamfGguydOThaGH90J5xHV0JcGC9BBNNezFkrESGV4_z97aOaGivEhE8EmBwugrmj1J3lRS6NzHway9r2PR_DBZ1NVAQYm1eav3_'),
(7, 'hhhh', 'ff@vv.con', 'rhrrhrh', 554428836, 0, '1828scaled_image_picker524985497942818623.jpg', '', 0, '', '', 23, 23, '', 0, 0, 0, 0, 0, 1, ''),
(9, 'gggggg', 'dg@gs.cd', '777666', 7363736, 23, '1674image_picker2240080299937419601.jpg', 'bbdhd', 1019, '1734scaled_image_picker7043171242623919236.jpg', 'aaaaaaaaaaa', 0, 0, '1818scaled_image_picker4596576888382415399.jpg', 0, 0, 0, 0, 0, 1, ''),
(10, 'tttttt', 'dddadmin@gmail.com', 'admin', 6776777, 23, '1203image_picker5965372225939215957.jpg', '2262', 22, '1860scaled_image_picker3011539919522572356.jpg', 'aaaaaaaaaaa', 0, 0, '1262scaled_image_picker1246948241743932992.jpg', 0, 0, 0, 0, 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tokenres`
--

CREATE TABLE `tokenres` (
  `tokenres_id` int(11) NOT NULL,
  `tokenres_res` int(11) NOT NULL,
  `tokenres_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tokentaxi`
--

CREATE TABLE `tokentaxi` (
  `tokentaxi_id` int(11) NOT NULL,
  `tokentaxi_token` varchar(255) NOT NULL,
  `tokentaxi_taxi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tokenusers`
--

CREATE TABLE `tokenusers` (
  `tokenusers_id` int(11) NOT NULL,
  `tokenusers_token` varchar(255) NOT NULL,
  `tokenusers_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_balance` float NOT NULL DEFAULT '0',
  `user_image` varchar(255) NOT NULL,
  `verfiycode` mediumint(9) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `delivery_res` int(11) NOT NULL DEFAULT '0',
  `user_token` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `user_phone`, `user_balance`, `user_image`, `verfiycode`, `role`, `delivery_res`, `user_token`, `active`) VALUES
(9, 'wael', 'wael', 'wael@gmail.com', 32423, 339.73, 'avatar.png', 0, 0, 0, 'd_DvxMAURPWxp4pKhO9BAG:APA91bHjQ_k5QHZwUFtRiHeafXnlRH29lBvCA_ERGXaUVfQ6WbYqZz-gAWsRbXEv7NHsAXmPgv7eCnrNwVF9wVg_ikokNJXRmMKhAu8sPTLlEG6UzyaCw_67kFEMGPfwurJcaUYxtgac', 0),
(14, 'basel', 'basel', 'basel@gmail.com', 11122, 0, 'image_picker4480479662992251446.jpg', 0, 3, 1, 'cX7jbn7zQHaq4E8_yv390c:APA91bGO6f4VyLWekzCNQMIsL4tPzC2_CnjdSTemLgnfxrWFc9e-PbF43gsNXZUO9Gtr-9R7VmaC7wLyPEbUVRyAEuI8i3GbBiZNS1prk7l2yOJvMI72q30LiGTpdjJpqm5KBLyGCv_1', 0),
(16, 'merft', 'merft', 'merft@gmail.com', 232323, 0, '1224image_picker4515170018689992742.jpg', 0, 4, 1, 'sdfsdfsdf23fwefsdfsdf', 0),
(18, 'admin', 'admin', 'admin@gmail.com', 0, 0, '', 0, 1, 0, 'fKZDCgF-SdusJD2KQPMchW:APA91bFKh1eAS3VUgJwWX8V_bbU2DCr9RR05nkupwe2hULvQIqa5kSyTm0ZVRbiSjDWd9_aEEph3YRYpSv1TW1w_FP8QbeXTZrOb4dKrmYlcD6tdowC_RdsmNhLTCj4FVWatd0nqpAfI', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `items_ibfk_1` (`item_cat`),
  ADD KEY `item_res` (`item_res`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `orders_users` (`orders_users`),
  ADD KEY `orders_res` (`orders_res`);

--
-- Indexes for table `orderstaxi`
--
ALTER TABLE `orderstaxi`
  ADD PRIMARY KEY (`orderstaxi_id`),
  ADD KEY `orderstaxi_user` (`orderstaxi_user`),
  ADD KEY `orderstaxi_taxi` (`orderstaxi_taxi`);

--
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `details_item` (`details_item`),
  ADD KEY `details_order` (`details_order`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`res_id`),
  ADD UNIQUE KEY `res_email` (`res_email`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxi`
--
ALTER TABLE `taxi`
  ADD PRIMARY KEY (`taxi_id`),
  ADD KEY `taxi_cat` (`taxi_cat`);

--
-- Indexes for table `tokenres`
--
ALTER TABLE `tokenres`
  ADD PRIMARY KEY (`tokenres_id`),
  ADD KEY `tokenres_res` (`tokenres_res`);

--
-- Indexes for table `tokentaxi`
--
ALTER TABLE `tokentaxi`
  ADD PRIMARY KEY (`tokentaxi_id`),
  ADD KEY `tokentaxi_taxi` (`tokentaxi_taxi`);

--
-- Indexes for table `tokenusers`
--
ALTER TABLE `tokenusers`
  ADD PRIMARY KEY (`tokenusers_id`),
  ADD KEY `tokenusers_user` (`tokenusers_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_phone` (`user_phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `orderstaxi`
--
ALTER TABLE `orderstaxi`
  MODIFY `orderstaxi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `taxi`
--
ALTER TABLE `taxi`
  MODIFY `taxi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tokenres`
--
ALTER TABLE `tokenres`
  MODIFY `tokenres_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokentaxi`
--
ALTER TABLE `tokentaxi`
  MODIFY `tokentaxi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokenusers`
--
ALTER TABLE `tokenusers`
  MODIFY `tokenusers_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`item_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`item_res`) REFERENCES `restaurants` (`res_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`orders_users`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`orders_res`) REFERENCES `restaurants` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderstaxi`
--
ALTER TABLE `orderstaxi`
  ADD CONSTRAINT `orderstaxi_ibfk_1` FOREIGN KEY (`orderstaxi_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderstaxi_ibfk_2` FOREIGN KEY (`orderstaxi_taxi`) REFERENCES `taxi` (`taxi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `orders_details_ibfk_1` FOREIGN KEY (`details_item`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_details_ibfk_2` FOREIGN KEY (`details_order`) REFERENCES `orders` (`orders_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tokenres`
--
ALTER TABLE `tokenres`
  ADD CONSTRAINT `tokenres_ibfk_1` FOREIGN KEY (`tokenres_res`) REFERENCES `restaurants` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tokentaxi`
--
ALTER TABLE `tokentaxi`
  ADD CONSTRAINT `tokentaxi_ibfk_1` FOREIGN KEY (`tokentaxi_taxi`) REFERENCES `taxi` (`taxi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tokenusers`
--
ALTER TABLE `tokenusers`
  ADD CONSTRAINT `tokenusers_ibfk_1` FOREIGN KEY (`tokenusers_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

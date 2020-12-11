-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 04:01 PM
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
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `message_title` varchar(255) NOT NULL,
  `message_body` varchar(255) NOT NULL,
  `message_cat` tinyint(4) NOT NULL,
  `message_sid` int(11) NOT NULL DEFAULT '0',
  `message_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `message_title`, `message_body`, `message_cat`, `message_sid`, `message_time`) VALUES
(26, 'صباح الخير', 'تم ازالة التعليقات السابقة', 1, 1, '2020-12-11 12:52:58'),
(27, 'اااا', 'اااا', 0, 6, '2020-12-11 12:56:16');

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
(83, 9, 3, 'تجربة', 33.6366068, 36.2947808, 'تجربة', '2020-12-03 11:39:58', 40.233, 0, 0),
(84, 9, 1, 'تجربة', 33.6366059, 36.2947836, 'تجربة', '2020-12-06 21:20:51', 31.232, 3, 14);

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
(13, 9, 6, 33.6366, 36.2948, 33.3584, 36.2311, 1342.7, '2020-12-04 16:02:20', 43.09, 3),
(14, 9, 6, 33.6366, 36.2948, 33.5747, 36.3091, 317.57, '2020-12-04 16:04:16', 8.919, 0),
(15, 9, 6, 33.6366, 36.2948, 33.6349, 36.2892, 71.3, '2020-12-07 22:18:38', 0.71, 1),
(16, 9, 6, 33.6366, 36.2948, 33.6372, 36.2981, 67.79, '2020-12-07 22:21:13', 0.593, 3),
(17, 9, 6, 33.6366, 36.2948, 33.6366, 36.2939, 0.0444, '2020-12-08 22:34:59', 0.144, 0);

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
(35, 83, 24, 1),
(36, 84, 23, 1);

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
  `res_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`res_id`, `res_name`, `res_password`, `res_email`, `res_phone`, `res_type`, `res_description`, `res_time_delivery`, `res_price_delivery`, `res_image`, `res_lisence`, `res_country`, `res_area`, `res_street`, `res_lat`, `res_lon`, `res_approve`, `res_balance`, `res_active`) VALUES
(1, 'rest\r\n', 'rest', 'rest@gmail.com', 343434, 'وجبات غربية', 'dsfsdfsdfdsfdsfsdf', 53, 10, 'fiveguys.jpg', 'lisence5.jpg', 'Lebanon', 'Bqaa Safrin', 'Unnamed Road', 33.806221827166375, 35.84205664694309, 1, 421.908, 1),
(2, 'pizzahut', 'pizzhut', 'pizzhut@gmail.com', 2323, 'دجاج مقلي', 'جميع انواع البيتزا', 30, 0, 'pizzahut.jpg', 'lisence1.jpg', 'Lebanon', 'Bqaa Safrin', '', 34.06369, 35.8810317, 1, 0, 1),
(3, 'kfc', 'kfcc', 'kfc@gmail.com', 22344, 'دجاج مقلي', 'دجاج مقلي', 30, 20, 'kfc.jpg', 'lisence2.jpg', 'Lebanon', 'Bqaa Safrin', '', 34.06369, 35.8810317, 1, 5901.96, 1),
(4, 'mcdonald', 'mcdonald', 'mcdonald@gmail.com', 75332, 'دجاج مقلي', 'وجبات غربية', 30, 0, 'mcdonalds.jpg', 'lisence3.jpg', 'Lebanon', 'Bqaa Safrin', '', 34.06369, 35.8810317, 1, 0, 1);

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
(6, 'taxi', 'taxi@gmail.com', 'taxi', 1111, 23, 'image_picker6555251922085966750.jpg', 'lada', 2015, '1864scaled_image_picker6835554702791314245.jpg', 'aaaaaaaaaaa', 33.6365, 36.2948, '1.jpg', 1, 0.1, 0.03, 456.704, 0, 1, 'd08H_qbsRTetsyMvMAuZUt:APA91bEOVbRZAzUdnxHcHzUOhnR4ujcLvl5AX_BMEamfGguydOThaGH90J5xHV0JcGC9BBNNezFkrESGV4_z97aOaGivEhE8EmBwugrmj1J3lRS6NzHway9r2PR_DBZ1NVAQYm1eav3_'),
(7, 'wael', 'wael@gmail.com', 'wael', 5842171, 0, '1828scaled_image_picker524985497942818623.jpg', '', 0, '', '', 23, 23, '', 0, 0, 0, 0, 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tokenres`
--

CREATE TABLE `tokenres` (
  `tokenres_id` int(11) NOT NULL,
  `tokenres_res` int(11) NOT NULL,
  `tokenres_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokenres`
--

INSERT INTO `tokenres` (`tokenres_id`, `tokenres_res`, `tokenres_token`) VALUES
(1, 1, 'fHOjr6yOTlScn7hsqndhbU:APA91bGVmewROjfke5ttqVcnj7Hk_HAHeut1YeNWVthTIMu6ypZf5cH3MgUsbw1ZL5WBrxIM0OCeEpRLHPZigWJFZc14u_heX8PAizUnH8od-X2LE_I4obragG4pJBQaovZe4bLAtEbU');

-- --------------------------------------------------------

--
-- Table structure for table `tokentaxi`
--

CREATE TABLE `tokentaxi` (
  `tokentaxi_id` int(11) NOT NULL,
  `tokentaxi_token` varchar(255) NOT NULL,
  `tokentaxi_taxi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokentaxi`
--

INSERT INTO `tokentaxi` (`tokentaxi_id`, `tokentaxi_token`, `tokentaxi_taxi`) VALUES
(3, 'eOp9dvhqRX6IWtja_S-wsr:APA91bGd9IQAa6NRdUBmWgCTjjxyoXsG36LiJt11gJYCbvfmgc5ShdMmWyWGRJkAj3og3cdIg48BPsJiUblJQJT9kAUVvjY3wC-yXp2YigJnQNsZ-JI6PvFvM25BOi7H4ZSKa3NF1E39', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tokenusers`
--

CREATE TABLE `tokenusers` (
  `tokenusers_id` int(11) NOT NULL,
  `tokenusers_token` varchar(255) NOT NULL,
  `tokenusers_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokenusers`
--

INSERT INTO `tokenusers` (`tokenusers_id`, `tokenusers_token`, `tokenusers_user`) VALUES
(6, 'e4GxRewSRD-ttmCa6m_hMX:APA91bHnefK6LsXW1HRBETpTTdz5RG4NuPbOffXflT2XmFi0t-tkm73L9qeEWSiNnpRwEoKpc7zLTaFKbdi18S1lS-69kqJcjkQGrKfcRXRTcC2DQpuW9IDgGdX_3SlWxUhj1vrA253y', 14),
(8, 'cqesTr1RS8mIozs18HIFmH:APA91bERfWrPunllvjiACwq-xFq83LVUhKwlYwFDitl2wmD6-PTjzKIR4Xbay4lqFCp4AbzDBSWiOCL6ssHrvLNndMZIHV-zPh7FRE2bdMkgyiwb88pdAAMLMSg9AunY_DHLNrzPGPrV', 9),
(12, 'd_cUmLRySquq3Nrd8QY09C:APA91bFL38wnhgXnKIl1U_ssUD1VEJeaxUNvnXPh_xEsAwOghqVvNBFN93NMsUAw9KDNbt5H5iWmspKhCvfd9fUBATYsG5oaxaCHkb_JfvIrKV6DRsHHcGVfHb0HlWqvJSNTGzKHRF_0', 9),
(13, 'dy1ckeGLQfee9AS7Qn6D3s:APA91bGnKRfnHMCiKbP3aTRgv3Gnw1YsSNGqu0qxTjXzvquPDOuk1gUMP7KuzoVqzoa5kkiFBXqMjMN-Ewine1R4TGi-ZC5s99EXT_MvbF8l7kM2lMcBGIq4QiB3XnpPju2wxy12y7Xm', 18),
(15, 'fQz-xCBpTjWGHqVSByoA0r:APA91bFO_vdpSR2e6mLwOvbaDqxVkOin-hcwdwaAy6VBbRnWFtsfmfG9ybuslYgLcg1lMB1NNzri7huV81A9L8IcRYk2nyDVbm2yesbR2ZHpE9ntRhjIgeUL65_HOkRE5wN8xvZQuwgC', 18),
(17, 'dgxuCPuoQpK6EL6vgnnysJ:APA91bG5D0fx4jBElRiYyj11ap-5HL2a-JYqnsZi0dmHw2OSbe0EOR2WDAQfNHW_7J4USM4uSH1jkvFJZbMsw5wHVAZLfq7_EQy9sH_70iYfm-PHvGIYPc4ehDmMijiuMExJpcGCO04O', 9),
(18, 'cJYckLziSr2uuiDgBhuRJk:APA91bFjQnE5v3eNhZkTEqzdL0_9Gax4rwA1UbOfr2OlUzfp64LhlCd8zHnfKs55c-Op8oCyB7zxowlNkbBwk0GiG3vlRm_HdcC-Jn_lJnG39sirJfp8_oSxJMDs0D7kq4vT9I5LaQfx', 9);

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
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `user_phone`, `user_balance`, `user_image`, `verfiycode`, `role`, `delivery_res`, `active`) VALUES
(9, 'wael', 'wael', 'wael@gmail.com', 32423, 136.364, 'image_picker7097442396910198098.jpg', 0, 0, 0, 0),
(14, 'delivery', 'delivery', 'delivery@gmail.com', 11122, 1033, 'image_picker4480479662992251446.jpg', 0, 3, 1, 0),
(16, 'merft', 'merft', 'merft@gmail.com', 232323, 0, '1224image_picker4515170018689992742.jpg', 0, 3, 7, 0),
(18, 'admin', 'admin', 'admin@gmail.com', 0, 0, '', 0, 1, 0, 0);

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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

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
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `orderstaxi`
--
ALTER TABLE `orderstaxi`
  MODIFY `orderstaxi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `taxi`
--
ALTER TABLE `taxi`
  MODIFY `taxi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tokenres`
--
ALTER TABLE `tokenres`
  MODIFY `tokenres_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tokentaxi`
--
ALTER TABLE `tokentaxi`
  MODIFY `tokentaxi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tokenusers`
--
ALTER TABLE `tokenusers`
  MODIFY `tokenusers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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

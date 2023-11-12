-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 05:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novatech`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `member_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`member_id`, `product_id`) VALUES
(3, 3),
(0, 1),
(0, 2),
(0, 3),
(2, 1),
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(10) UNSIGNED NOT NULL,
  `member_name` char(50) NOT NULL,
  `member_email` char(50) NOT NULL,
  `member_contact` int(11) NOT NULL,
  `member_password` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_name`, `member_email`, `member_contact`, `member_password`) VALUES
(0, 'admin', 'admin', 0, 'admin'),
(1, 'testone', 'test01@gmail.com', 88888888, '0ebfbadc8eb323262c3095350f44e9c7'),
(2, 'testtwo', 'test02@gmail.com', 88883333, 'e8f45e4474e9b49b903d903459074eeb'),
(3, 'testthree', 'test03@gmail.com', 81234321, 'b5ec68c29c130b9e3d84701c0982af26'),
(4, 'testfour', 'test04@gmail.com', 88835555, 'b48d1ceec06d0dfa8c989fc85f072075'),
(5, 'testfive', 'test05@gmail.com', 88858885, 'a2fc6105e2bbdf03f0c80d68054c344c');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `batch_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_name` varchar(100) NOT NULL,
  `order_email` varchar(100) NOT NULL,
  `order_contact` varchar(100) NOT NULL,
  `order_address` varchar(100) NOT NULL,
  `order_total_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`batch_id`, `order_id`, `member_id`, `product_id`, `order_qty`, `order_name`, `order_email`, `order_contact`, `order_address`, `order_total_price`) VALUES
(1, 1, 1, 1, 1, 'testone', 'test01@gmail.com', '88888888', 'abc', 1690.11),
(1, 2, 1, 3, 10, 'testone', 'test01@gmail.com', '88888888', 'abc', 20893),
(2, 3, 1, 3, 3, 'testing', 'test01@gmail.com', '88888888', 'abc23', 6267.9),
(2, 4, 1, 9, 2, 'testing', 'test01@gmail.com', '88888888', 'abc23', 644.98),
(2, 5, 1, 12, 1, 'testing', 'test01@gmail.com', '88888888', 'abc23', 1299),
(3, 6, 2, 1, 50, 'testing', 'test02@gmail.com', '88888888', 'abc', 84505.5),
(4, 7, 4, 1, 49, 'testone', 'abc@gmail.com', '88883333', 'ab', 82815.39),
(5, 8, 5, 1, 1, 'testing', 'test01@gmail.com', '88888888', 'abc', 1690.11),
(6, 9, 2, 5, 4, 'testing', 'abc@gmail.com', '88888888', 'abc', 6956),
(7, 10, 1, 2, 3, 'testing', 'test01@gmail.com', '88888888', '32 Nanyang', 4749),
(7, 11, 1, 8, 1, 'testing', 'test01@gmail.com', '88888888', '32 Nanyang', 2725);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` char(100) NOT NULL,
  `product_price` double NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_subcat` char(15) NOT NULL,
  `product_discount` double DEFAULT NULL,
  `product_stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_category`, `product_subcat`, `product_discount`, `product_stock`) VALUES
(1, 'APPLE MACBOOK AIR 15\"', 1899, 1, 'MACBOOK', 11, 0),
(2, 'ASUS VIVOBOOK X1405ZA-LY104W', 1583, 1, 'LAPTOP', 0, 97),
(3, 'SAMSUNG S23 Ultra 12+1TB-CREAM SM-S918', 2458, 2, 'PHONE', 15, 87),
(4, 'APPLE IPHONE 15 512GB BLUE MTPG3ZP/A', 1779, 2, 'PHONE', 5, 100),
(5, 'GARMIN SMART WATCH ENDURO 2 (GM-010-02754-13)', 1739, 2, 'WEARABLES', 0, 96),
(6, 'SONY OLED TV XR-48A90K', 4037, 3, 'TV', 0, 100),
(7, 'SAMSUNG OLED TV QA65S95BAKXXS', 5449, 3, 'TV', 0, 100),
(8, 'SONY SOUND BAR HT-A9', 2725, 3, 'SOUND SYSTEM', 0, 99),
(9, 'APPLE AIRPODS PRO (2ND GENERATION) WITH MAGSAFE CASE (USB-C) MTJV3ZA/A', 362.35, 3, 'HEADPHONES', 11, 98),
(10, 'DYSON RECHARGEABLE VAC V12S DETECT SLIM', 1299, 4, 'VACUUM CLEANER', 0, 100),
(11, 'DAIKIN SINGLE SPLIT CTKM25VVMG/MKM50VVMG', 2349, 4, 'AIR CONDITIONER', 0, 100),
(12, 'ECOVACS ROBOTIC VACUUM DEEBOT T20 OMNI', 1299, 4, 'VACUUM CLEANER', 0, 99);

-- --------------------------------------------------------

--
-- Table structure for table `product_desc`
--

CREATE TABLE `product_desc` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_desc` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_desc`
--

INSERT INTO `product_desc` (`product_id`, `product_desc`) VALUES
(1, 'The 15-inch MacBook Air is impossibly thin and has a stunning Liquid Retina display. Supercharged by the M2 chip — and with up to 18 hours of battery life — it delivers incredible performance in an ultra-portable design.'),
(2, 'Turn everyday tasks into something special with Vivobook 14 (X1404ZA-AM170W), your essential tool for getting things done easier, anywhere. It’s completely user-friendly too, with its 180° lay-flat hinge and physical webcam shield.'),
(3, 'Please visit https://www.samsung.com/sg/smartphones/galaxy-s23/ for more information'),
(4, 'iPhone 15 brings you Dynamic Island, a 48MP Main camera and USB-C — all in a durable colour-infused glass and aluminium design.'),
(5, 'Get solar charging that provides extra-long GPS battery life to help you outlast your next ultrarace, plus power-saving positional accuracy and built-in mapping to help you find your way.'),
(6, 'This amazing 4K Full Array LED TV powered by Cognitive Processor XR™ delivers intense contrast. A newly designed local dimming structure brings scenes vividly to life. Now available at Harvey Norman.'),
(7, 'Please visit https://www.samsung.com/sg/tvs/oled-tv/s95b-65-inch-oled-4k-smart-tv-qa65s95bakxxs/ for more information'),
(8, 'Sony Home Theatre featured with 360 Spatial Sound that adapts to your environment.Our revolutionary 360 Spatial Sound Mapping technology creates up to twelve phantom speakers from just four real speakers. '),
(9, 'AirPods Pro feature up to 2x more Active Noise Cancellation,1 Transparency mode and now Adaptive Audio, 2 which automatically tailors the noise control for you to provide the best listening experience across different environments and interactions throughout the day.'),
(10, 'Deep cleaning power. Now washes hard floors. All in one machine. Submarine™ wet roller head, Fluffy Optic™ cleaner head, Hair Screw Tool, Combination Tool, Crevice Tool, Charger, Wand clip, Wall dock'),
(11, 'Standard Installation – Upon purchase made, our authorized installer will contact you to advise on earliest installation dates. (within 2 weeks) Express Installation – Installation within 7 days is available, subject to charges from $150 onwards.'),
(12, 'Ozmo Tubro Mopping, Auto Hotwater Washing For Mopping Pad, Hot Air Drying, Auto 9mm Mop Lift up, 3D Mapping');

-- --------------------------------------------------------

--
-- Table structure for table `product_specs`
--

CREATE TABLE `product_specs` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `specs_1` varchar(500) DEFAULT NULL,
  `specs_2` varchar(500) DEFAULT NULL,
  `specs_3` varchar(500) DEFAULT NULL,
  `specs_4` varchar(500) DEFAULT NULL,
  `specs_5` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_specs`
--

INSERT INTO `product_specs` (`product_id`, `specs_1`, `specs_2`, `specs_3`, `specs_4`, `specs_5`) VALUES
(1, 'Processor Type: M2', 'Storage Capacity: 256GB', '15 Inch Display 2880x1864', '1.51kg, 1.15 x 34.04 x 23.76 (H x W x D cm) ', '12 Months Warranty'),
(2, 'Processor Model: Intel® Core™ i5-1235U', 'Storage Capacity:512GB with 8GB RAM', '14 Inch Display 1920x1080', '1.4kg', '24 Months Warranty'),
(3, 'Memory: 8GB RAM', 'Storage Capacity:8GB', '12 Months Warranty', '0', '0'),
(4, 'Color : Blue', 'Storage Capacity:512GB', '0', '0', '0'),
(5, 'Model: Enduro 2 (02754-13)', '0', '0', '0', '0'),
(6, 'Screen Size: 65\" 4K Ultra HD', 'Bluetooth v4.2 + WiFi + Ethernet(LAN)', '4 Ticks Energy Efficiency', '25kg, 86.1 x 144.5 x 34.5 (H x W x D cm)', '0'),
(7, 'Screen Size: 65\" 4K Ultra HD', 'WiFi + Ethernet(LAN)', '4 Ticks Energy Efficiency', '29kg, 89.44 x 144.35 x 26.79 (H x W x D cm)', '36 Months Warranty'),
(8, 'HDMI 1/1(eARC/ARC)', 'USB Type A', 'Wireless Ready IEEE802.11 a/b/g/n/ac', 'Dolby Atmos', '0'),
(9, '0', '0', '0', '0', '0'),
(10, 'Color: Yellow/Nickel', '3.1 kg with 25.7cm length and 124.7cm height', '0', '0', '0'),
(11, '0', '0', '0', '0', '0'),
(12, 'Battery Life: 260 Mins', 'Suction Power: 6000', 'Power Consumption: 45W', 'Charge-up Time: 6.5 hours', '0');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `reviews_total` int(11) DEFAULT NULL,
  `reviews_qty` int(11) DEFAULT NULL,
  `reviews` decimal(2,1) GENERATED ALWAYS AS (if(`reviews_qty` > 0,`reviews_total` / `reviews_qty`,0)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`product_id`, `reviews_total`, `reviews_qty`) VALUES
(1, 16, 4),
(2, 0, 0),
(3, 13, 3),
(4, 3, 1),
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 4, 1),
(9, 0, 0),
(10, 4, 1),
(11, 9, 2),
(12, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews_ind`
--

CREATE TABLE `reviews_ind` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `reviews_name` varchar(50) NOT NULL,
  `reviews_email` varchar(100) NOT NULL,
  `reviews_message` varchar(1000) NOT NULL,
  `reviews_rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews_ind`
--

INSERT INTO `reviews_ind` (`review_id`, `member_id`, `product_id`, `reviews_name`, `reviews_email`, `reviews_message`, `reviews_rating`) VALUES
(1, 1, 1, 'testone', 'test01@gmail.com', 'Horrible', 1),
(2, 1, 3, 'testone', 'test01@gmail.com', 'Fav Phone', 5),
(3, 1, 4, 'testone', 'test01@gmail.com', 'Normal only', 3),
(4, 1, 8, 'testing', 'test01@gmail.com', 'abc', 4),
(5, 2, 1, 'testing', 'test02@gmail.com', 'Best', 5),
(6, 2, 3, 'testing', 'test01@gmail.com', 'abc', 4),
(7, 2, 10, 'testing', 'test01@gmail.com', 'abc', 4),
(8, 3, 1, 'testing', 'test03@gmail.com', 'abc', 5),
(9, 3, 3, 'testing', 'test01@gmail.com', 'abc', 4),
(10, 4, 1, 'teststes', 'test04@gmail.com', 'abc', 5),
(11, 2, 11, 'testing', 'abc@gmail.com', 'abc', 5),
(12, 1, 11, 'testone', 'test01@gmail.com', 'abc', 4);

-- --------------------------------------------------------

--
-- Table structure for table `total_sales`
--

CREATE TABLE `total_sales` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `total_price` double DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_sales`
--

INSERT INTO `total_sales` (`product_id`, `total_price`, `total_qty`) VALUES
(1, 170701.11, 101),
(2, 4749, 3),
(3, 27160.9, 13),
(4, 0, 0),
(5, 6956, 4),
(6, 0, 0),
(7, 0, 0),
(8, 2725, 1),
(9, 644.98, 2),
(10, 0, 0),
(11, 0, 0),
(12, 1299, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `member_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`member_id`, `product_id`) VALUES
(1, 1),
(1, 5),
(1, 4),
(2, 3),
(2, 1),
(2, 4),
(2, 10),
(2, 5),
(3, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `member_id` (`member_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_desc`
--
ALTER TABLE `product_desc`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_specs`
--
ALTER TABLE `product_specs`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reviews_ind`
--
ALTER TABLE `reviews_ind`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `total_sales`
--
ALTER TABLE `total_sales`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD KEY `member_id` (`member_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_desc`
--
ALTER TABLE `product_desc`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_specs`
--
ALTER TABLE `product_specs`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews_ind`
--
ALTER TABLE `reviews_ind`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `total_sales`
--
ALTER TABLE `total_sales`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

--
-- Constraints for table `product_desc`
--
ALTER TABLE `product_desc`
  ADD CONSTRAINT `product_desc_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `product_specs`
--
ALTER TABLE `product_specs`
  ADD CONSTRAINT `product_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `reviews_ind`
--
ALTER TABLE `reviews_ind`
  ADD CONSTRAINT `reviews_ind_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `reviews_ind_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

--
-- Constraints for table `total_sales`
--
ALTER TABLE `total_sales`
  ADD CONSTRAINT `total_sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

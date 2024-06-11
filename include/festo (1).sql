-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 03:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `festo`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `food_id` int(20) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `food_title` varchar(255) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(25) NOT NULL,
  `total` double(10,2) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `confirm_order`
--

CREATE TABLE `confirm_order` (
  `order_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int(12) NOT NULL,
  `address` varchar(500) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `total_foods` varchar(500) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL DEFAULT 'pending',
  `date` varchar(20) NOT NULL,
  `total_price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirm_order`
--

INSERT INTO `confirm_order` (`order_id`, `user_id`, `name`, `email`, `number`, `address`, `payment_method`, `total_foods`, `order_date`, `payment_status`, `date`, `total_price`) VALUES
(51, 4, 'Haseeb Raja', 'haseebrajputhaseebullah474@gmail.com', 2147483647, 'Azam Town Street 10, Karachi , Sindh, Pakistan - 425414', 'cash on delivery', ' Beaf Biryani  #1kg, x (1) ', '04-Mar-2024', 'completed', '04.03.2024', 600.00);

-- --------------------------------------------------------

--
-- Table structure for table `food_cat`
--

CREATE TABLE `food_cat` (
  `cat_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_details`
--

CREATE TABLE `food_details` (
  `food_id` int(255) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_title` varchar(255) NOT NULL,
  `sub_cat_id` int(255) NOT NULL,
  `food_price` int(255) NOT NULL,
  `food_img` text NOT NULL,
  `food_category` varchar(255) NOT NULL,
  `food_discription` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_details`
--

INSERT INTO `food_details` (`food_id`, `food_name`, `food_title`, `sub_cat_id`, `food_price`, `food_img`, `food_category`, `food_discription`) VALUES
(66, 'Beaf Biryani ', '1kg', 0, 600, 'dehli-ki-sada-biryani-recipe-main-photo.jpg', 'Fast food.', 'extra masala with raita and salat'),
(67, 'zinger buger', 'Medium size', 0, 520, '190416-chicken-burger-082-1556204252.jpg', 'Fast food.', 'The Zinger Burger features a spicy, seasoned chicken patty nestled in a soft bun, complemented by fresh lettuce and a zesty sauce for a bold and flavorful fast-food experience. Optional additions like cheese, tomato, and pickles add layers of texture and taste.');

-- --------------------------------------------------------

--
-- Table structure for table `food_sub_cat`
--

CREATE TABLE `food_sub_cat` (
  `sub_cat_id` int(255) NOT NULL,
  `sub_cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_sub_cat`
--

INSERT INTO `food_sub_cat` (`sub_cat_id`, `sub_cat_name`) VALUES
(18, 'Fast food.'),
(19, 'Fast casual.'),
(20, 'Casual dining / Slow Casual.'),
(21, 'Premium casual.'),
(22, 'Family style.'),
(23, 'Fine dining.'),
(24, 'chickken'),
(25, 'Cheeze'),
(26, 'Beef');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `number` int(20) NOT NULL,
  `msg` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`id`, `user_id`, `name`, `email`, `number`, `msg`, `date`) VALUES
(16, 0, 'Haseeb Raja', 'haseebrajputhaseebul', 2147483647, 'asdfghfjhdfd', '2024-03-08 12:18:39'),
(18, 0, 'Haseeb Raja Raja Has', 'haseebrajaraja28@gma', 2147483647, 'HELOOOOOOOOOOOOOOOOOOOOOOOO', '2024-03-08 12:35:44'),
(19, 0, 'Developer Raja', 'haseebrajaraja28@gma', 2147483647, 'heyyyyyyyyyyyyyyyyyyyyy', '2024-03-08 12:36:11'),
(21, 0, 'Usman', 'nexsilyl@gmail.com', 596496, 'kytttttttttttttttttttttttttttttttttttttttttt', '2024-03-08 12:37:47'),
(24, 0, 'NEXS', 'nexsilyl@gmail.com', 2541, 'gggggggggggggggggggggggggg', '2024-03-08 12:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(225) NOT NULL,
  `user_id` int(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pincode` int(6) NOT NULL,
  `book` varchar(50) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `payment_status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `city`, `state`, `country`, `pincode`, `book`, `unit_price`, `quantity`, `sub_total`, `payment_status`) VALUES
(0, 51, 'yey', '747hfh', 'eyy', 'tutututu', 6546, 'yukuyk', 56778.00, 1, 56778.00, 'completed'),
(0, 51, 'yey', '747hfh', 'eyy', 'tutututu', 6546, 'Don Quixote by Migue', 2555.00, 6, 15330.00, 'pending'),
(0, 51, 'yey', 'yery', 'eyy', 'erge', 0, 'yukuyk', 56778.00, 1, 56778.00, 'pending'),
(0, 51, 'hrth', 'hrt', 'hrth', ' 6y', 0, 'Don Quixote by Migue', 2555.00, 1, 2555.00, 'pending'),
(0, 51, 'hrthgerg', 'hrtgeg', 'hrthgeg', ' 6ygege', 0, 'Don Quixote by Migue', 2555.00, 1, 2555.00, 'pending'),
(0, 51, 'hrthgerg', '747hfh', 'hgfyj', ' 6ygege', 0, 'fhb', 5124.00, 1, 5124.00, 'pending'),
(0, 51, 'yey', 'yery', 'hgfyj', 'erge', 0, 'Don Quixote by Migue', 2555.00, 1, 2555.00, 'pending'),
(0, 51, '4747', '747hfh', 'hrthgeg', 'tutututu', 6546, 'Don Quixote by Migue', 2555.00, 1, 2555.00, 'pending'),
(0, 51, '4747', '747hfh', 'hrthgeg', 'tutututu', 6546, 'Don Quixote by Migue', 2555.00, 1, 2555.00, 'pending'),
(0, 51, 'hrthgerg', '747hfh', 'eyy', 'wfrwerfw', 0, 'Don Quixote by Migue', 2555.00, 1, 2555.00, 'pending'),
(21, 51, '4747', '747hfh', 'hgfyj', 'yey', 6546, 'Don Quixote by Migue', 2555.00, 1, 2555.00, 'pending'),
(21, 51, '4747', '747hfh', 'hgfyj', 'yey', 6546, 'yukuyk', 56778.00, 1, 56778.00, 'pending'),
(24, 51, 'hrthgerg', '747hfh', 'eyy', 'tutututu', 6546, 'grwe', 45.00, 1, 45.00, 'pending'),
(24, 51, 'hrthgerg', '747hfh', 'eyy', 'tutututu', 6546, 'yukuyk', 56778.00, 1, 56778.00, 'pending'),
(24, 51, 'hrthgerg', '747hfh', 'eyy', 'tutututu', 6546, 'pawan', 4141471.00, 1, 4141471.00, 'pending'),
(24, 51, 'hrthgerg', '747hfh', 'eyy', 'tutututu', 6546, 'pawan', 25252.00, 1, 25252.00, 'pending'),
(24, 51, 'hrthgerg', '747hfh', 'eyy', 'tutututu', 6546, 'fhb', 5124.00, 1, 5124.00, 'pending'),
(24, 51, 'hrthgerg', '747hfh', 'eyy', 'tutututu', 6546, 'Don Quixote by Migue', 2000.00, 1, 2000.00, 'pending'),
(24, 51, 'hrthgerg', '747hfh', 'eyy', 'tutututu', 6546, 'Don Quixote by Migue', 2555.00, 1, 2555.00, 'pending'),
(25, 51, 'f3f3', 'f34f', 'f3f', 'f3f', 0, 'pawan', 122.00, 1, 122.00, 'pending'),
(26, 51, 'brtbr', 'brtb', 'brt', 'bb', 0, 'pawan', 4141471.00, 1, 4141471.00, 'pending'),
(27, 51, 'nttnnht', 'nfnfghn', 'nghngh', 'ghng', 0, 'pawan', 122.00, 1, 122.00, 'pending'),
(27, 51, 'nttnnht', 'nfnfghn', 'nghngh', 'ghng', 0, 'yukuyk', 6545.00, 1, 6545.00, 'pending'),
(27, 51, 'nttnnht', 'nfnfghn', 'nghngh', 'ghng', 0, 'yukuyk', 56778.00, 1, 56778.00, 'pending'),
(28, 51, 'wtwtw', 'twet', 'wtwet', 'twet', 0, 'pawan', 122.00, 4, 488.00, 'pending'),
(29, 51, 'hrthgerg', '747hfh', 'hrthgeg', 'tutututu', 6546, 'Don Quixote by Migue', 2000.00, 1, 2000.00, 'pending'),
(29, 51, 'hrthgerg', '747hfh', 'hrthgeg', 'tutututu', 6546, 'v xvx', 45645.00, 1, 45645.00, 'pending'),
(29, 51, 'hrthgerg', '747hfh', 'hrthgeg', 'tutututu', 6546, 'fhb', 5124.00, 4, 20496.00, 'pending'),
(30, 51, 'hrthgerg', 'hrtgeg', 'hrthgeg', '85*94', 0, 'v xvx', 45645.00, 1, 45645.00, 'pending'),
(30, 51, 'hrthgerg', 'hrtgeg', 'hrthgeg', '85*94', 0, 'pawan', 122.00, 1, 122.00, 'pending'),
(31, 51, 'yey', 'brtb', 'hrthgeg', ' 6ygege', 6546, 'pawan', 122.00, 1, 122.00, 'pending'),
(31, 51, 'yey', 'brtb', 'hrthgeg', ' 6ygege', 6546, 'yukuyk', 6545.00, 1, 6545.00, 'pending'),
(31, 51, 'yey', 'brtb', 'hrthgeg', ' 6ygege', 6546, 'sdfsd', 435.00, 1, 435.00, 'pending'),
(32, 51, 'hrthgerg', '747hfh', 'brt', ' ygege', 6546, 'iuji', 5425.00, 1, 5425.00, 'pending'),
(32, 51, 'hrthgerg', '747hfh', 'brt', ' ygege', 6546, 'Ray Bearer', 999.00, 1, 999.00, 'pending'),
(35, 4, 'house no 24', 'Karachi ', 'sindhi', 'pakistan', 71514, 'chicken tikka', 300.00, 3, 900.00, 'pending'),
(36, 4, 'egr', 'Karachi ', 'dfd', 'fdfa', 443, 'Alo Meat', 220.00, 1, 220.00, 'pending'),
(36, 4, 'egr', 'Karachi ', 'dfd', 'fdfa', 443, 'Sada Biryani', 200.00, 1, 200.00, 'pending'),
(36, 4, 'egr', 'Karachi ', 'dfd', 'fdfa', 443, 'Chikken Diryani', 280.00, 0, 0.00, 'pending'),
(36, 4, 'egr', 'Karachi ', 'dfd', 'fdfa', 443, 'Chikken Diryani', 280.00, 0, 0.00, 'pending'),
(37, 4, 'Azam Town Street 10', 'Karachi ', 'Sindh', 'Pakistan', 584, 'Alo Meat', 220.00, 1, 220.00, 'pending'),
(48, 4, 'Azam Town Street 10', 'Karachi ', 'Sindh', 'Pakistan', 54356, 'Kheer', 450.00, 5, 2250.00, 'pending'),
(49, 4, 'Azam Town Street 10', 'Karachi ', 'Sindh', 'Pakistan', 54652, 'Passta', 300.00, 1, 300.00, 'pending'),
(50, 4, 'Azam Town Street 10', 'Karachi ', 'Sindh', 'Pakistan', 1845, 'Alo Meat', 220.00, 1, 220.00, 'pending'),
(51, 4, 'Azam Town Street 10', 'Karachi ', 'Sindh', 'Pakistan', 425414, 'Beaf Biryani ', 600.00, 1, 600.00, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_type`) VALUES
(4, 'Usman', 'nexsilyl@gmail.com', '12345', 'User'),
(8, 'Daryo aizumi', 'daryoaizumi@gmail.com', '12345', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confirm_order`
--
ALTER TABLE `confirm_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `food_details`
--
ALTER TABLE `food_details`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `food_sub_cat`
--
ALTER TABLE `food_sub_cat`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `confirm_order`
--
ALTER TABLE `confirm_order`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `food_details`
--
ALTER TABLE `food_details`
  MODIFY `food_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `food_sub_cat`
--
ALTER TABLE `food_sub_cat`
  MODIFY `sub_cat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

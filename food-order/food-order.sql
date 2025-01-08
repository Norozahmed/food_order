-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 03:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(13, 'Noroz Ahmed', 'noroz', 'a591024321c5e2bdbd23ed35f0574dde'),
(16, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(17, 'Zeerak Ahmed', 'zeerak', 'f1981e4bd8a0d6d8462016d2fc6276b3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(250) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(9, 'burger', 'burgerr.jpeg', 'NO', 'on'),
(13, 'pizza', 'pizza.jpeg', 'NO', 'on'),
(15, 'biryani', 'download.jpeg', 'NO', 'on'),
(16, 'shawrma', 'sawrma.jpeg', 'NO', 'on'),
(18, 'Pizza', 'menu-pizza.jpg', 'Yes', 'on'),
(19, 'Biryani', 'bieyaniMenu.webp', 'Yes', 'on'),
(21, 'Burger', 'burgeMenu.jpg', 'Yes', 'on'),
(22, 'Chicken burger', 'burger.jpg', 'NO', 'Yes'),
(23, 'Beef Burger', 'menu-burger.jpg', 'No', 'Yes'),
(24, 'Momo', 'momo.jpg', 'No', 'Yes'),
(25, 'Pizza', 'pizza.jpg', 'No', 'Yes'),
(26, 'Ch Momo', 'menu-momo.jpg', 'No', 'Yes'),
(27, 'La Pizza', 'pizza.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image_name` varchar(250) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(8, 'Biryani', 'chicken biryani', 500, 'Food-Name-4202.jpeg', 22, 'Yes', 'Yes'),
(9, 'Burger', 'Zinger burger', 350, 'Food-Name-5819.jpeg', 22, 'Yes', 'Yes'),
(10, 'Shawarma', 'omani shawarma', 300, 'Food-Name-751.jpeg', 22, 'Yes', 'Yes'),
(11, 'Pizza', 'la pizza', 900, 'Food-Name-6050.jpeg', 25, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `total` varchar(250) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(3, 'Biryani', 500.00, 3.00, '1500', '2024-03-20 03:16:42', 'Delivered', 'noroz', '03198959595', 'nb@gmail.com', 'stewrtwr'),
(4, 'Biryani', 500.00, 3.00, '1500', '2024-03-20 03:21:47', 'On Delivery', 'John Frank', '03198959595', 'john@gmail.com', 'new york'),
(5, 'Shawarma', 300.00, 6.00, '1800', '2024-03-20 03:23:52', 'Ordered', 'Shoaib Baloch', '03198959595', 'sbaloch@gmail.com', 'saadah'),
(6, 'Burger', 350.00, 1.00, '350', '2024-03-21 03:03:08', 'Cancelled', 'ahmed', '03243433564', 'ah@gmail.com', 'seeb'),
(7, 'Shawarma', 300.00, 7.00, '2100', '2024-03-21 03:21:37', 'Ordered', 'balach', '03198959595', 'balach@gmail.com', 'Main salalah'),
(8, 'Biryani', 500.00, 1.00, '500', '2024-10-01 06:45:43', 'Ordered', 'allah nizar', '57546747', 'grfjh@gmail.vom', 'salalah'),
(9, 'Shawarma', 300.00, 1.00, '300', '2025-01-08 02:38:13', 'Ordered', 'Jja', '23425425', 'nbb@gmail.com', 'sdad, sdsa, dsda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

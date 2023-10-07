-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2023 at 07:47 PM
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
-- Database: `Scandiweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_table`
--

CREATE TABLE `book_table` (
  `book_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `weight` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_table`
--

INSERT INTO `book_table` (`book_id`, `product_id`, `weight`) VALUES
(23, 58, 213.00),
(25, 68, 213.00),
(26, 74, 213.00);

-- --------------------------------------------------------

--
-- Table structure for table `dvd_table`
--

CREATE TABLE `dvd_table` (
  `dvd_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `size` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dvd_table`
--

INSERT INTO `dvd_table` (`dvd_id`, `product_id`, `size`) VALUES
(27, 62, 123.00),
(30, 65, 123.00),
(31, 66, 123.00),
(32, 67, 213.00),
(33, 69, 213.00),
(34, 70, 213.00),
(35, 71, 123.00),
(36, 72, 123.00),
(37, 73, 123.00);

-- --------------------------------------------------------

--
-- Table structure for table `furniture_table`
--

CREATE TABLE `furniture_table` (
  `furniture_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `length` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_type` enum('DVD','Book','Furniture') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `sku`, `name`, `price`, `product_type`) VALUES
(58, 'Test', 'qwe', 123.00, 'Book'),
(62, 'Test', 'qwe', 132.00, 'DVD'),
(65, 'Test', 'qwe', 132.00, 'DVD'),
(66, 'Test', 'qwe', 213.00, 'DVD'),
(67, '123', '213', 213.00, 'DVD'),
(68, 'Test', 'test', 213.00, 'Book'),
(69, 'Test', 'test', 213.00, 'DVD'),
(70, 'Test', 'test', 213.00, 'DVD'),
(71, 'Test', '13', 213.00, 'DVD'),
(72, 'Test', '13', 213.00, 'DVD'),
(73, 'Test', '213', 213.00, 'DVD'),
(74, 'Test', '213', 213.00, 'Book');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_table`
--
ALTER TABLE `book_table`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `BookFK` (`product_id`);

--
-- Indexes for table `dvd_table`
--
ALTER TABLE `dvd_table`
  ADD PRIMARY KEY (`dvd_id`),
  ADD KEY `DVDFK` (`product_id`);

--
-- Indexes for table `furniture_table`
--
ALTER TABLE `furniture_table`
  ADD PRIMARY KEY (`furniture_id`),
  ADD KEY `FurnitureFK` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_table`
--
ALTER TABLE `book_table`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `dvd_table`
--
ALTER TABLE `dvd_table`
  MODIFY `dvd_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `furniture_table`
--
ALTER TABLE `furniture_table`
  MODIFY `furniture_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_table`
--
ALTER TABLE `book_table`
  ADD CONSTRAINT `BookFK` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `dvd_table`
--
ALTER TABLE `dvd_table`
  ADD CONSTRAINT `DVDFK` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `furniture_table`
--
ALTER TABLE `furniture_table`
  ADD CONSTRAINT `FurnitureFK` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

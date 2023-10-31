-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2021 at 10:50 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--
DROP DATABASE IF EXISTS `shop_db`;
CREATE DATABASE IF NOT EXISTS `shop_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci;
USE `shop_db`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `users`;
-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_persian_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `orderdate` date NOT NULL,
  `pro_code` int(10) NOT NULL,
  `pro_qty` int(10) NOT NULL,
  `pro_price` float NOT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_persian_ci NOT NULL,
  `address` varchar(400) COLLATE utf8mb4_persian_ci NOT NULL,
  `trackcode` varchar(24) COLLATE utf8mb4_persian_ci NOT NULL,
  `state` int(1) NOT NULL,
  `detail` varchar(200) COLLATE utf8mb4_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_code` int(10) NOT NULL,
  `pro_name` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL,
  `pro_qty` int(10) NOT NULL,
  `pro_price` float NOT NULL,
  `pro_image` varchar(80) COLLATE utf8mb4_persian_ci NOT NULL,
  `pro_detail` text COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_code`, `pro_name`, `pro_qty`, `pro_price`, `pro_image`, `pro_detail`) VALUES
(1, ' محصول آزمایشی شماره 1', 15, 7500, '1.png', 'توضیحات 1 توضیح'),
(2, 'محصول آزمایشی شماره 2', 60, 5000, '2.png', 'توضیحات 2 توضیح دوم توضیحات 2 توضیح دوم توضیحات 2 توضیح دوم توضیحات 2 توضیح دوم توضیحات 2 توضیح دوم ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `realname` varchar(80) COLLATE utf8mb4_persian_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_persian_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_persian_ci NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`realname`, `username`, `password`, `email`, `type`) VALUES
('مدیریت', 'admin', '123', 'admin@medu.ir', 1),
('علی محمدی', 'ali', 'ali', 'ali@gmail.com', 0),
('مهدی عسکرپور', 'mahdiaskarpoor1383', '09131963894000', 'mahdiaskarpoor1383@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1041;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

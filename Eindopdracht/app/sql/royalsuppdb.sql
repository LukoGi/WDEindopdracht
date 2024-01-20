-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 20, 2024 at 11:23 PM
-- Server version: 11.1.2-MariaDB-1:11.1.2+maria~ubu2204
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `royalsuppsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created_at`) VALUES
(2, 3, '2024-01-18 20:38:21'),
(3, 3, '2024-01-18 20:47:30'),
(4, 3, '2024-01-18 20:48:22'),
(5, 3, '2024-01-18 20:49:28'),
(6, 3, '2024-01-18 20:51:11'),
(7, 3, '2024-01-18 20:51:29'),
(8, 11, '2024-01-18 21:03:15'),
(9, 3, '2024-01-19 18:16:38'),
(10, 12, '2024-01-19 18:40:24'),
(11, 12, '2024-01-19 18:40:43'),
(12, 13, '2024-01-19 18:42:22'),
(13, 13, '2024-01-19 18:42:37'),
(14, 14, '2024-01-19 18:45:45'),
(15, 14, '2024-01-19 18:45:59'),
(16, 15, '2024-01-19 18:47:24'),
(17, 15, '2024-01-19 18:53:26'),
(18, 16, '2024-01-19 18:58:34'),
(19, 16, '2024-01-19 19:00:09'),
(20, NULL, '2024-01-20 20:24:48'),
(21, NULL, '2024-01-20 20:27:21'),
(22, 15, '2024-01-20 20:44:52'),
(23, 15, '2024-01-20 20:56:58'),
(24, 8, '2024-01-20 22:09:40'),
(25, 18, '2024-01-20 22:10:29'),
(26, NULL, '2024-01-20 22:14:04'),
(27, 18, '2024-01-20 22:14:25'),
(28, NULL, '2024-01-20 22:14:44'),
(29, NULL, '2024-01-20 23:20:57'),
(30, 19, '2024-01-20 23:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`) VALUES
(1, 2, 7),
(2, 2, 7),
(3, 3, 8),
(4, 4, 8),
(5, 4, 9),
(6, 5, 8),
(7, 5, 10),
(8, 6, 7),
(9, 6, 7),
(10, 6, 8),
(11, 7, 9),
(12, 7, 8),
(13, 8, 7),
(14, 8, 8),
(15, 8, 10),
(16, 9, 7),
(17, 9, 8),
(18, 10, 7),
(19, 10, 8),
(20, 11, 8),
(21, 11, 9),
(22, 12, 7),
(23, 12, 9),
(24, 12, 10),
(25, 13, 8),
(26, 13, 7),
(27, 14, 8),
(28, 14, 8),
(29, 14, 7),
(30, 15, 7),
(31, 15, 10),
(32, 16, 7),
(33, 16, 8),
(35, 17, 10),
(37, 18, 7),
(38, 19, 7),
(39, 20, 8),
(40, 20, 9),
(41, 21, 8),
(42, 21, 9),
(43, 22, 9),
(44, 23, 7),
(45, 24, 7),
(46, 24, 9),
(48, 25, 7),
(49, 25, 8),
(50, 26, 7),
(51, 27, 7),
(55, 29, 8),
(56, 30, 8),
(57, 30, 9);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `description`, `category`, `image`) VALUES
(7, 'Alpha Pre-Workout (600 g)', 29.99, 'It\'s time to give your body an extra boost before even stepping into the gym. Our Alpha Pre-Workout, your new secret weapon, is best enjoyed with 2 scoops before your workout for optimal results.', 'Pre-Workout', 'https://static.thcdn.com/images/large/original//productimg/1600/1600/12941041-5364888103955603.jpg'),
(8, 'Impact Whey Protein (250 g)', 10.99, 'Impact Whey Protein, a long-standing favorite. A convenient shake for ample protein throughout the day, ensuring you feel and perform at your best. One scoop daily is recommended for optimal results.', 'Protein Essentials', 'https://static.thcdn.com/images/large/webp//productimg/1600/1600/10530943-1224889444460882.jpg'),
(9, 'ZMA Capsules (90 Capsules)', 21.99, 'ZMA: Zinc, magnesium, and vitamin B6 blend for overall health. Boosts testosterone levels. Ideal for daily use, whether you\'re in the gym or on the field. Take one capsule daily for optimal benefits.', 'Mineral Boost', 'https://static.thcdn.com/images/large/webp//productimg/1600/1600/10529452-5084907332039314.jpg'),
(10, 'Creatine Powder (100 g)', 8.99, 'Our scientifically proven creatine powder enhances physical performance by increasing strength. For optimal results, it\'s recommended to take 3g before your training.', 'Strength Enhancement', 'https://static.thcdn.com/images/large/webp/productimg/1600/1600/10530050-9574620647469231.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'Lol', '$2y$10$oNUz.Gmp7XM4AfnZNgrL/OdUEQJxN2diS5tjwy9p8egfHz5u8yC/i'),
(4, 'Loko', '$2y$10$5lC33ZdCw/uZURBF4LEEP.6nH04dX5VJU98A9bR.gsrmcCkNATVr6'),
(5, 'Momo', '$2y$10$mPj9SlJEvTOXPKTUTjzLu.n5frlg3Jfc1zP/RweQhRwI.heKwTIEe'),
(8, 'admin', '$2y$10$x0W0goau7oL/hXyLhDUKtOlEMKNnFKh9aJONI.OIaIP7CMWWUSzwO'),
(10, 'za', '$2y$10$svb3y1xgRMxk8LXZaZmMwOotkL0kVBZf1iEDk3gv3l/SavB7Vqk..'),
(11, 'o', '$2y$10$.yWV4EIA9.SZeb6jA0SmFeRmabQ/Yq2UWaJ2BjI0CWrZZPnNvunJC'),
(12, 'odwk', '$2y$10$GdbPZ/e4I9Gqu6AgzWoT.updKgM.edIMoys0bJmwAXRp11XOlLJyO'),
(13, 'ok', '$2y$10$osEQ/NrBUNdudBRM25K0KONUIIwZrTOlVvZoeCbn7zfqtAHeTtAJG'),
(14, 'da', '$2y$10$GvuB/szvDygtOL5e.wuH2.q0OmSA9/oGu.AKq52f4Lpl.EjNJ/cOO'),
(15, 'wd', '$2y$10$pa7lCbDCAT9/xqP7KeHyve2TUd3zO729sdvC/5yaVz55LsXUUnrym'),
(16, 'oki', '$2y$10$u38tg5IqB6Ud0CO0pckLKusoT7tZhPJKzitUx1QYbR1B3sn42z30m'),
(18, 'test', '$2y$10$KUlAI6xWgfHtKSuK41HaAOe6nQogrJUPstzWQLWq9SCeq38nGiolu'),
(19, 'testo', '$2y$10$1z2rXLbEqPixhVjD6jZJ9eYA43FAAHuMxxlVpMV26ByO0nL7gkrlm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orders_products` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orderitems_orders` (`order_id`),
  ADD KEY `FK_orderitems_products` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_products` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `FK_orderitems_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `FK_orderitems_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 08:02 PM
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
-- Database: `agro_pangan_maju`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `address` text DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Menunggu Konfirmasi',
  `tracking_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `address`, `payment_method`, `status`, `tracking_info`) VALUES
(1, 1, '2025-04-08 21:02:07', 'jalan kaki', 'Transfer Bank', 'Dikirim', 'cakung KHBN'),
(2, 1, '2025-04-08 16:09:55', 'aaaaa', 'cod', 'Diproses', NULL),
(3, 1, '2025-04-08 16:10:30', 'AaAA', 'transfer', 'Menunggu Pembayaran', NULL),
(4, 1, '2025-04-08 16:14:45', 'jalan jalan', 'transfer', 'Menunggu Pembayaran', NULL),
(5, 1, '2025-04-08 16:18:18', 'dfsdrfs', 'cod', 'Diproses', NULL),
(6, 1, '2025-04-08 16:24:01', 'anjay mabar', 'transfer', 'Menunggu Pembayaran', NULL),
(7, 2, '2025-04-08 19:56:01', 'hfxghdghd', 'cod', 'Diproses', NULL),
(8, 1, '2025-04-09 06:42:47', 'asasassa', 'transfer', 'Dikirim', 'DI JALAN JALAN'),
(9, 1, '2025-04-11 14:59:32', 'xccxzcxzczx', 'transfer', 'Dibatalkan', ''),
(10, 1, '2025-04-12 13:48:01', 'dfsdfdf', 'cod', 'Diproses', NULL),
(11, 1, '2025-04-12 15:29:14', 'dukuh atas', 'transfer', 'Menunggu Pembayaran', NULL),
(12, 1, '2025-04-12 15:34:24', 'test', 'transfer', 'Menunggu Pembayaran', NULL),
(13, 1, '2025-04-18 16:29:51', 'sdsds', 'transfer', 'Menunggu Pembayaran', NULL),
(14, 1, '2025-04-18 16:39:37', 'sfdsdsd', 'cod', 'Diproses', NULL),
(15, 1, '2025-04-18 16:50:28', 'dsdsdsds', 'transfer', 'Menunggu Pembayaran', NULL),
(16, 1, '2025-04-18 16:50:46', 'sdsdsdsdsdsd', 'transfer', 'Menunggu Pembayaran', NULL),
(17, 1, '2025-04-18 16:53:55', 'dss', 'transfer', 'Menunggu Pembayaran', NULL),
(18, 1, '2025-04-18 17:05:30', 'halimun', 'transfer', 'Menunggu Pembayaran', NULL),
(19, 1, '2025-04-19 06:41:46', 'hjghjgj', 'transfer', 'Menunggu Pembayaran', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 2, 1, NULL),
(2, 1, 3, 1, NULL),
(3, 1, 1, 8, NULL),
(4, 2, 1, 1, 120000.00),
(5, 2, 2, 2, 45000.00),
(6, 4, 1, 1, 120000.00),
(7, 4, 2, 1, 45000.00),
(8, 5, 1, 1, 120000.00),
(9, 5, 2, 1, 45000.00),
(10, 6, 1, 1, 120000.00),
(11, 6, 2, 1, 45000.00),
(12, 6, 3, 1, 90000.00),
(13, 7, 1, 4, 120000.00),
(14, 8, 1, 1, 120000.00),
(15, 8, 2, 1, 45000.00),
(16, 9, 1, 1, 120000.00),
(17, 10, 1, 12, 120000.00),
(18, 10, 2, 1, 45000.00),
(19, 10, 3, 1, 90000.00),
(21, 11, 2, 4, 45000.00),
(22, 11, 3, 1, 90000.00),
(23, 12, 2, 1, 45000.00),
(24, 12, 3, 1, 90000.00),
(25, 13, 1, 1, 99999999.99),
(26, 13, 2, 1, 45000.00),
(27, 13, 3, 1, 90000.00),
(28, 14, 2, 1, 45000.00),
(29, 14, 3, 1, 90000.00),
(30, 15, 2, 1, 45000.00),
(31, 16, 2, 1, 45000.00),
(32, 17, 2, 1, 45000.00),
(33, 18, 1, 3, 99999999.99),
(34, 19, 16, 2, 100000.00),
(35, 19, 2, 1, 45000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Daging Sapi Premium', 'Daging sapi kualitas ekspor, segar dan halal', 1200000000, 'uploads/67fa4a176c378_daging1.png'),
(2, 'ayam', 'Fillet ayam tanpa tulang, siap masak', 45000, 'uploads/67fa49f62aef2_ging gung.png'),
(3, 'Daging Kambing Muda', 'Kambing muda segar cocok untuk sate', 90000, 'uploads/67fa49ec3358c_daging2.png'),
(16, 'daging ayam', 'paha ayam', 100000, 'uploads/67fa73edb36e8_daging1.png');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(10) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `password`, `role`) VALUES
(1, 'dimas', 'admin', 'raihanzakym@gmail.com', '089508050186', '$2y$10$a5EircPiMoeCNs7a.rVOLOUJdB2xOmkxoB2ijCa5U6FXkiKFwBIR.', 'user'),
(2, 'raihan zaky', 'raihan', 'raihanzakym@gmail.com', '089508050186', '$2y$10$IQZ1r7Q4N9ArTx2SqMr5XegRl.dO7EklwjcY/Brgox1rxKwJ9nypy', 'admin'),
(5, 'Admin Aja', 'adminn', 'admin@example.com', '081234567890', '$2y$10$ZrYz1E0TymkNZZrMP.jZYeUczfRBP6s1xkUOmTo81hFWR3q2Kwvq6', 'admin'),
(6, 'raihan zaky', 'han', '123@gmail.com', '2413245', '$2y$10$P8E9ZvKboJOlhpi4jTdBQOcXOMx3IdTWLkpBuHa8K1qXJhigD7.ra', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

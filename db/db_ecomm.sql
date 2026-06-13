-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2026 at 03:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Administrator', 'admin@domio.com', '$2y$10$JQO3GyFdj8Hw2G3ItHYWI.uJcSqahNq7NBdYI.M69XAZ6kSkjPbYq', '2026-06-12 20:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `selected` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `selected`) VALUES
(1, 5, 14, 5, '2026-06-11 16:46:32', 1),
(2, 5, 10, 2, '2026-06-11 17:26:02', 1),
(3, 5, 9, 1, '2026-06-11 17:59:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `email`, `phone`, `address`, `total`, `payment_method`, `status`, `created_at`) VALUES
(1, 1, 'Danisa Arwanti', 'danisa@gmail.com', '081234567890', 'Jl. Palmerah Barat No. 10, Jakarta', 520.00, 'Bank Transfer', 'pending', '2026-06-13 11:38:28');

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

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `description`, `created_at`) VALUES
(2, 'Mika Armchair', 'Living Room', 185.00, 'assets/images/shop/livingroom/mika-armchair.svg', 'Modern armchair', '2026-06-11 12:23:46'),
(3, 'Mika Sectional Sofa', 'Living Room', 799.00, 'assets/images/shop/livingroom/mika-sofa.svg', 'Comfortable sectional sofa', '2026-06-11 12:23:46'),
(4, 'Sora Velvet Ottoman', 'Living Room', 120.00, 'assets/images/shop/livingroom/sore-velvet.svg', 'Elegant velvet ottoman', '2026-06-11 12:23:46'),
(5, 'Taro Jute Rug', 'Living Room', 85.00, 'assets/images/shop/livingroom/jute-rug.svg', 'Natural jute rug', '2026-06-11 12:23:46'),
(6, 'Dara Mirror', 'Living Room', 110.00, 'assets/images/shop/livingroom/dara-mirror.svg', 'Decorative mirror', '2026-06-11 12:23:46'),
(7, 'Nami Side Table', 'Bedroom', 89.00, 'assets/images/shop/bedroom/nami-table.svg', 'Minimalist side table', '2026-06-11 12:23:46'),
(8, 'Rumi Wardrobe', 'Bedroom', 450.00, 'assets/images/shop/bedroom/rumi-wardrobe.svg', 'Large wardrobe', '2026-06-11 12:23:46'),
(9, 'Nami Bed Frame', 'Bedroom', 550.95, 'assets/images/shop/bedroom/nami-bed.svg', 'Modern bed frame', '2026-06-11 12:23:46'),
(10, 'Zora Desk Lamp', 'Workspace', 45.00, 'assets/images/shop/workspace/zora-lamp.svg', 'Desk lamp', '2026-06-11 12:23:46'),
(11, 'Kala Working Desk', 'Workspace', 320.00, 'assets/images/shop/workspace/kala-desk.svg', 'Working desk', '2026-06-11 12:23:46'),
(12, 'Sora Table Lamp', 'Workspace', 45.00, 'assets/images/shop/workspace/sora-lamp.svg', 'Table lamp', '2026-06-11 12:23:46'),
(13, 'Finn Dining Table', 'Dining', 520.00, 'assets/images/shop/dining/finn-table.svg', 'Dining table', '2026-06-11 12:23:46'),
(14, 'Mika Spoon Set', 'Dining', 44.00, 'assets/images/shop/dining/mika-spoon.svg', 'Spoon set', '2026-06-11 12:23:46'),
(15, 'Kala High Sideboard', 'Dining', 450.00, 'assets/images/shop/uploads/1781339082-Kala High Sideboard.png', 'new products', '2026-06-13 08:24:42'),
(16, 'Lune Duvet Cover', 'Bedroom', 89.00, 'assets/images/shop/uploads/1781339859-Lune Duvet Cover.png', 'New Products', '2026-06-13 08:37:39'),
(17, 'Kora Lounge Chair', 'Bedroom', 320.00, 'assets/images/shop/uploads/1781340219-Kora Lounge Chair.png', 'New Products', '2026-06-13 08:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-05-13 17:06:19'),
(4, 'danisa', 'danisa16@gmail.com', '$2y$10$Gt7Dr7ccUueZc/j2EEyp8OeRpH3z1Cfr3f1DK0mc4pnaFbtOIdalS', '2026-05-19 06:46:42'),
(5, 'danisa', 'danisaarwanti16@gmail.com', '$2y$10$WwJ0PI/vx8m0zNJZH6Vi9.dUELV3bl0aj/MQBdqsxzTA5OyGlSqaO', '2026-06-11 16:10:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_user` (`user_id`),
  ADD KEY `fk_cart_product` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderitems_order` (`order_id`),
  ADD KEY `fk_orderitems_product` (`product_id`);

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
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_orderitems_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_orderitems_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

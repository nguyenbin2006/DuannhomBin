-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 24, 2025 lúc 06:16 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duannhombin`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`) VALUES
(5, 50, 3, 1, '2025-04-21 06:13:34'),
(7, 50, 4, 1, '2025-04-21 06:28:54'),
(8, 50, 5, 1, '2025-04-21 08:16:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` varchar(100) DEFAULT 'Đặt hàng',
  `total_amount` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `category`, `created_at`, `stock`) VALUES
(1, 'Vợt Yonex Astrox 99 Pro', 2900000.00, 'astrox99.jpg', 'Vợt chuyên công cao cấp của Yonex', 'Tấn công', '2025-04-05 13:42:29', 100),
(2, 'Vợt Lining Turbo Charging 75', 1850000.00, 'turbo75.jpg', 'Vợt cân bằng, dễ chơi, phù hợp người mới', 'Cân bằng', '2025-04-05 13:42:29', 100),
(3, 'Vợt Victor Brave Sword 12', 2150000.00, 'bs12.jpg', 'Vợt phòng thủ nhẹ tay, linh hoạt', 'Phòng thủ', '2025-04-05 13:42:29', 100),
(4, 'Vợt NanoFlare 1000Z', 5050000.00, 'nanoflare1000z.png\r\n', NULL, NULL, '2025-04-05 14:31:40', 100),
(5, 'Vợt Yonex Arcsaber-0-Clear', 650000.00, 'yonexarcsaber_0_clear.png', NULL, NULL, '2025-04-05 14:37:22', 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `created_at`, `role`) VALUES
(1, '', 'binnguyen', '123', 'nguyentanbin2006@gmail.com', '2025-04-08 10:33:44', 'user'),
(2, '', 'admin', 'admin', 'admin@gmail.com', '2025-04-09 11:48:44', 'admin'),
(8, '', NULL, '$2y$10$/Ffuod.70iiblQnihtAq4OitilxGElME5TD/hGkhxd3F/cy0F/3TC', NULL, '2025-04-09 11:59:00', 'user'),
(9, '', NULL, '$2y$10$q2M.YHUnDkLQ99mV3o8s8OBBqcjngesBDqyT/siSRK/JhEeHt4i9O', NULL, '2025-04-09 11:59:01', 'user'),
(10, '', NULL, '$2y$10$hhIUSFwR4BZQWbUsc2SdROQZIL9OzMVhyXORZdYoZzst0iGUar76G', NULL, '2025-04-09 11:59:01', 'user'),
(11, '', NULL, '$2y$10$5NKXaNKUAz1KGx7/YqCQoeOk/65cfltBQv5FGqpu9fKb6zU4chlGO', NULL, '2025-04-09 11:59:01', 'user'),
(12, '', NULL, '$2y$10$NJdQz0CMcanPaknZM9HL7.fZR3x6e4JYpOWaX0gY3/rmcd9CQvf6.', NULL, '2025-04-09 11:59:01', 'user'),
(13, '', NULL, '$2y$10$qad1yoWr5zfwbq3tSfipE.WdIxPM90qe8IYvxtexw5aOOQqlvBeOm', NULL, '2025-04-09 11:59:01', 'user'),
(14, '', NULL, '$2y$10$p7G3L0K0wLLA.Ku5.CAjJ.MRlqP6zZPF4ZKpWfS5auxZzFjzNQKHq', NULL, '2025-04-09 11:59:01', 'user'),
(15, '', NULL, '$2y$10$UluYZ2gFh5G7g5sxUET9FeHAfaEA9bAzBnviCKnHCDauB5tCb4AsK', NULL, '2025-04-09 11:59:01', 'user'),
(16, '', NULL, '$2y$10$sYZB0ZcFqb8sG/Xb6Q5k7.dr.dAstC4pUExnknulynqMuKjljjuY2', NULL, '2025-04-09 11:59:01', 'user'),
(17, '', NULL, '$2y$10$shEqUpHd0J6AnsG/Pj.xoe2DlsP/GclpFtfBtyD06yJN4ooR1m8f2', NULL, '2025-04-09 11:59:01', 'user'),
(18, '', NULL, '$2y$10$j4U6zIEcI1iv6xr8E9.aH.EocjP5T.a17G8KjzpdLvAPXdkNKKd5m', NULL, '2025-04-09 11:59:01', 'user'),
(19, '', NULL, '$2y$10$nQqc1QAeR4LxaLIeSfMKzOeOCQcOybSzYKWWJD.w9FVxVlHdYHDI2', NULL, '2025-04-09 11:59:01', 'user'),
(20, '', NULL, '$2y$10$Ckw5YC2JlbkAXgcYRBwxwu41xSoRWQn0FBWaDrJZO2JlY2jvAuwj.', NULL, '2025-04-09 11:59:01', 'user'),
(21, '', NULL, '$2y$10$Vgr/nD4jKZMss9MwFaPlYOgSesb8y.uH63nmEhg51pr1n8Moy4lHC', NULL, '2025-04-09 11:59:02', 'user'),
(22, '', NULL, '$2y$10$E.sbj.Yoow.DtOimRb0yYe0exrp0zdkQXsefdsgsC4WZSIsIaNwmW', NULL, '2025-04-09 11:59:02', 'user'),
(23, '', NULL, '$2y$10$HU1ylu6Xjp3fto3FYbSQzOlikYoG7H175v5pOes2Uqn/LVkJzen2W', NULL, '2025-04-09 11:59:02', 'user'),
(24, '', NULL, '$2y$10$v4BooCl2iW1eAzu3OvjyqO3yDV5omKi39CaohtU9FU0qdx2xCo5lC', NULL, '2025-04-09 11:59:02', 'user'),
(25, '', NULL, '$2y$10$dDv8.YhEIZwci4gF/ou3jOfjdQAwbZ/8jjNAFvbFdGE.6q8ZXOvIi', NULL, '2025-04-09 11:59:02', 'user'),
(26, '', NULL, '$2y$10$auFBkH0gGG7MKnpdk4o0FOUKDpR7D78iaV4nzH6BYTkeN34.Upega', NULL, '2025-04-09 11:59:02', 'user'),
(27, '', NULL, '$2y$10$toxhYj8M1dLpEt9sgsSc5e0sOyFHfaWALf1jNZVTxx.NSKL4FT.ny', NULL, '2025-04-09 11:59:02', 'user'),
(28, '', NULL, '$2y$10$ninYbDfPW.38/RqI/beeyOBBZQ6He0uGSHe7TUWNOuYbsMdX9JTAq', NULL, '2025-04-09 11:59:03', 'user'),
(29, '', NULL, '$2y$10$7mGwCBVMeRzRu7CR5KOhW.JX/xwqJTY62TC/buFwh8HAlWLlPFGFu', NULL, '2025-04-09 11:59:03', 'user'),
(30, '', NULL, '$2y$10$W1twpsul.DAaUJ1zERlrM.TLjKZkjtABYU9sbgJCoeJlutx/t3XNC', NULL, '2025-04-09 11:59:03', 'user'),
(31, '', NULL, '$2y$10$v4wDjInPGaMl5Kx2EFmO/eUDMi7E4R19YmzOvq/bv/LLoftxcDuBy', NULL, '2025-04-09 11:59:03', 'user'),
(32, '', NULL, '$2y$10$OkNM6/7YmhUtu8iuF.Ghyu/iA24S1aSOnNAAkv.Rnx6itTyIJDHoO', NULL, '2025-04-09 11:59:04', 'user'),
(33, '', NULL, '$2y$10$Xj2QSxGxr4dQFjRRoQkutecQiEKL62dc7K8U4LJpewPOpshLelso6', NULL, '2025-04-09 11:59:04', 'user'),
(34, '', NULL, '$2y$10$6J1.sLgtpblOJjAXcqdhneQKCu/vuId1Fcnl9f1QuG75RJVS9LYXS', NULL, '2025-04-09 11:59:04', 'user'),
(35, '', NULL, '$2y$10$2PVytjoB/xT2.METujG5BetIW5nC9IW5Tp5IzxGTalxTBTkuzzTyG', NULL, '2025-04-09 11:59:04', 'user'),
(36, '', NULL, '$2y$10$AJqTc7yjMyM.0hBkLXHdneOl/bV9oCQRhiRXrNMAuRq2sxhyYomz2', NULL, '2025-04-09 11:59:04', 'user'),
(37, '', NULL, '$2y$10$sgcJA8qsKmSc9r1E6tGk4usm3OzlshNnZ5V9g39JNQn7NEbfkDXZO', NULL, '2025-04-09 11:59:04', 'user'),
(38, '', NULL, '$2y$10$p6y9k9G4yQ.lluqE17bs9OI9yqVSd2tYkrz5OAzqFxI8ptjksm9gi', NULL, '2025-04-09 11:59:04', 'user'),
(39, '', NULL, '$2y$10$PfrVx.OR2aFKnC70zR0AJuM1JBICtXae7gQDMmgTjJBFdQNjdBesy', NULL, '2025-04-09 11:59:04', 'user'),
(40, '', NULL, '$2y$10$kQAcB2ARx6zvaRQEiHIyw.FXnK1akx68WIto9yIHtypUFGHgobnXK', NULL, '2025-04-09 11:59:04', 'user'),
(41, '', NULL, '$2y$10$JjTQ7V6x/Fy6RdpWPtSuSeqDq6XBMFhg8kX.myYU6RnXm7Wkumr0.', NULL, '2025-04-09 11:59:04', 'user'),
(42, '', NULL, '$2y$10$Ry9SmOuiJxyyAEUDZdsnwuiMSODesyyQtXhkoOK/8qiKAEJaaprfC', NULL, '2025-04-09 11:59:04', 'user'),
(43, '', NULL, '$2y$10$476Hrw3b7PJZM/eeK9x3weSXeacaZc0Y.9konTzB.yDh91utR8DC.', NULL, '2025-04-09 11:59:04', 'user'),
(44, '', NULL, '$2y$10$m5ZYASJyuD/8jg2xAce60.QN4DZqiX9LhRBElwVsaDRU8D/1f6pmK', NULL, '2025-04-09 11:59:05', 'user'),
(45, '', NULL, '$2y$10$qrsSlWaF9MFFDwL.HrrJROgZTujP/0YHRBSlHkXVDBvMIW/jUFUxS', NULL, '2025-04-09 11:59:05', 'user'),
(46, '', NULL, '$2y$10$qRrqd8gZMhq9rKx0QfygyOCj7GWqK8tdCENbKLrHAQdajeE96C.1m', NULL, '2025-04-09 11:59:05', 'user'),
(47, '', NULL, '$2y$10$.hRnB5ppg0fq6hDJgFKahuSVE2NGH6.aQtq35oJhqDm8bhZGSglPq', NULL, '2025-04-09 11:59:05', 'user'),
(48, '', NULL, '$2y$10$OoCh1EKbOP5YEMMneeutPu/UwUDnSSDrKQ7Ho7q6mLPD3pZuSP47q', NULL, '2025-04-09 11:59:14', 'user'),
(49, '', NULL, '$2y$10$N1EKgVdwCZiQthMJ4H6enuLtGqkzD7uZd5bTLmHgsb.I7sKL5.Mq2', NULL, '2025-04-09 12:03:29', 'user'),
(50, '', NULL, '$2y$10$ftZ1N/rKUD03V/OmNrEZDurtLZus28sUe/f2e.akO7Onh6O1Nc29a', 'bin123@gmail.com', '2025-04-15 10:19:32', 'user'),
(51, '', NULL, '$2y$10$ZyyHHUbwqJ4z042Q7YfgKOtgDmg1quBfrCbOkjDqhtl9uKKBLnb6.', 'bin', '2025-04-16 14:48:44', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

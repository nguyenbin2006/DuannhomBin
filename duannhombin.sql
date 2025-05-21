-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 21, 2025 lúc 08:18 AM
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
(50, 56, 2, 2, '2025-05-10 07:17:31');

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
  `total_amount` decimal(12,2) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `status`, `total_amount`, `phone`, `email`, `address`) VALUES
(25, 57, '2025-05-08 10:53:02', 'Đã giao', 14250000.00, '0903997282', 'bin@gmail.com', 'dsfdsfdf'),
(27, 59, '2025-05-17 16:05:43', 'Đã giao', 4150000.00, '0123456789', '123@gmail.com', 'thành phố Hồ Chí Minh');

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

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(41, 25, 3, 3, 2150000.00),
(42, 25, 5, 3, 650000.00),
(43, 25, 8, 4, 1000000.00),
(44, 25, 2, 1, 1850000.00),
(47, 27, 11, 1, 4150000.00);

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
(2, 'Vợt Lining Turbo Charging 75', 1850000.00, 'turbo75.jpg', 'Vợt cân bằng, dễ chơi, phù hợp người mới', 'Cân bằng', '2025-04-05 13:42:29', 100),
(3, 'Vợt Victor Brave Sword 12', 2150000.00, 'bs12.jpg', 'Vợt phòng thủ nhẹ tay, linh hoạt', 'Phòng thủ', '2025-04-05 13:42:29', 100),
(4, 'Vợt NanoFlare 1000Z', 5050000.00, 'nanoflare1000z.png\r\n', NULL, NULL, '2025-04-05 14:31:40', 100),
(5, 'Vợt Yonex Arcsaber-0-Clear', 650000.00, 'yonexarcsaber_0_clear.png', NULL, NULL, '2025-04-05 14:37:22', 100),
(8, 'Vợt Yonex-Nanoflare-800', 1000000.00, 'yonex-nanoflare-800.jpg', NULL, NULL, '2025-04-28 08:45:14', 50),
(11, 'Vợt Cầu Lông Victor Thruster Ryuga II Pro CPS', 4150000.00, '1746672194_vot-cau-long-victor-thruster-ryuga-ii-pro-cps-ma-taiwan.jpg', 'Thương hiệu: Victor\r\n\r\n- Độ cứng: Cứng\r\n\r\n- Điểm Swing: 92kg/cm2\r\n\r\n- Độ cân bằng: 304 +-1mm\r\n\r\n- Chiều dài tổng thể: 675mm\r\n\r\n- Khung vợt: High Resilience Modulus Graphite+HARD CORED TECHNOLOGY\r\n\r\n- Đũa vợt: High Resilience Modulus Graphite+PYROFIL+ 6.6 SHAFT\r\n\r\n- Trọng lượng: 4U/G6, 3U/G5\r\n\r\n- Sức căng tối đa: 4U  ≦ 31 lbs (14 Kg), 3U  ≦ 32 lbs (14,5 Kg)', 'Victor', '2025-08-04 17:00:00', 50),
(12, 'Vợt Cầu Lông Victor Thruster Ryuga Metallic CPS', 4050000.00, '1746672345_vot-cau-long-victor-thruster-ryuga-metallic-cps-ma-taiwan.jpg', '- Thương hiệu: Victor\r\n\r\n- Độ cứng: Cứng\r\n\r\n- Vật liệu khung: High Resilience Modulus Graphite + Hardcore Technology + Metallic Carbon Fiber\r\n\r\n- Vật liệu trục: High ResilienceModulusGraphite + PYROFIL + 6.8 SHAFT\r\n\r\n- Điểm cân bằng: 305 mm ( Nặng đầu)\r\n\r\n- Chiều dài vợt: 675mm\r\n\r\n- Điểm swing weight: 91,8 kg/cm2 \r\n\r\n- Sức căng tối đa: 32lbs ( 14,5 kg)\r\n\r\n- Trọng lượng: 3U, 4U\r\n\r\n- Đường kính đũa: 6,8mm\r\n\r\n- Chu vi cán vợt: G5', 'Victor', '2025-05-07 17:00:00', 50),
(14, 'Vợt cầu lông Lining Woods N90', 5049000.00, '1746672738_vot-cau-long-lining-woods-n90-noi-dia-trung_1741051062.jpg', '- Độ cứng: Trung bình.\r\n\r\n- Khung vợt: Carbon Fiber\r\n\r\n- Thân vợt:  Carbon Fiber\r\n\r\n- Trọng lượng: 4U\r\n\r\n- Chu vi cán vợt: S2\r\n\r\n- Sức căng tối đa: 30LBS \r\n\r\n- Điểm cân bằng: 304 mm\r\n\r\n- Màu sắc: Đỏ/ Đen.\r\n\r\n-Công nghệ áp dụng: \r\n+DYNAMIN-OPT-IMUM FRAME: Tất cả các thiết kế tối ưu hóa vòng cải thiện cấu trúc cơ khí vợt cho hệ thống tấn công và phòng thủ hiệu quả hơn.\r\n+ AEROTEC BEAM SYSTEM: Dựa trên hệ thống chùm aerotec, hỗ trợ tính toán tiên tiến và thu thập dữ liệu thực hành, cấu trúc và hình dạng của phần khung vợt có hệ số cản cực thấp và cường độ cao, tạo nên hiệu suất của người chơi trong pha đánh khác nhau.\r\n+ UHB SHAFT: Công nghệ tiên tiến kết hợp với dữ liệu thực được thu thập từ thực tiễn của người chơi, hiệu suất trục tối ưu hóa thông qua cải tiến liên tục', 'Lining', '2025-05-07 21:52:18', 10),
(15, 'Vợt cầu lông Lining Bladex 500', 2250000.00, '1746673464_vot-cau-long-lining-bladex-500-trang-3_1714081490.jpg', '- Khung vợt: CARBON FIBER\r\n\r\n- Độ cứng đũa: Cứng\r\n\r\n- Điểm cân bằng: 295mm\r\n\r\n- Trọng lượng: 3U/ 4U\r\n\r\n- Đường kính đũa: 6.8mm (Trung bình)\r\n\r\n- Chiều dài tổng thể vợt: 675mm\r\n\r\n- Điểm swing weight: 4U 84 kg/cm2  \r\n\r\n                                  3U 87 kg/cm2\r\n\r\n- Chu vi cán vợt: 3UG5\r\n\r\n4UG6\r\n\r\n- Sức căng tối đa: 28LBS (12,7kg)', 'Lining', '2025-05-07 22:04:24', 10),
(16, 'Vợt cầu lông Lining Tectonic 9', 3990000.00, '1746676168_vot-cau-long-lining-tectonic-9-noi-dia-trung_1727380094.jpg', '- Độ cứng: Cứng\r\n\r\n- Chất liệu: Sợi carbon T1100G\r\n\r\n- Trọng lượng: 3U - 4U - 5U\r\n\r\n- Điểm cân bằng: 3U (300mm); 4U (305mm); 5U (310mm)\r\n\r\n- Chu vi cán vợt: S2 (G5)\r\n\r\n- Chiều dài vợt: 675mm\r\n\r\n- Chiều dài cán vợt: 200mm\r\n\r\n- Điểm swing weight: 5U 84,6 kg/cm2 \r\n\r\n                                  4U 87,4 kg/cm2\r\n\r\n                                  3U 90,2 kg/cm2 \r\n\r\n- Sức căng: Dọc 26-30 lbs, ngang 28-32 lbs (Tối đa 13,6kg)\r\n\r\n- Màu sắc: Trắng Đen', 'Lining', '2025-05-07 22:49:28', 23),
(17, 'Vợt cầu lông Lining Aeronaut 7000B', 4050000.00, '1746681302_vot-cau-long-lining-aeronaut-7000b-noi-dia-trung_1727380332.jpg', '- Độ cứng: Trung bình\r\n\r\n- Chất liệu: Military Grade Carbon Fiber\r\n\r\n- Trọng lượng: 87g (W3)\r\n\r\n- Điểm cân bằng: 298mm (Hơi nặng đầu)\r\n\r\n- Chu vi cán vợt: S1 (G6)\r\n\r\n- Chiều dài vợt: 675mm\r\n\r\n- Chiều dài cán vợt: 210mm (Cán dài)\r\n\r\n- Sức căng: Dọc 26-30 lbs, ngang 28-32 lbs (Tối đa 13,6kg)\r\n\r\n- Màu sắc: Xanh Dương phối Đen', 'Lining', '2025-05-08 00:15:02', 25),
(18, 'Vợt Cầu Lông Mizuno Acrospeed 8', 3150000.00, '1746681423_vot-cau-long-mizuno-acrospeed-8-trang-vang-chinh-hang_1737139247.jpg', '- Điểm cân bằng: Hơi nhẹ đầu\r\n\r\n- Độ cứng: Dẻo\r\n\r\n- Chất liệu: Japan HM Graphite , Graphite\r\n\r\n- Trọng lượng: 4U\r\n\r\n- Chu vi cán vợt: G6\r\n\r\n- Sức căng tối đa: 18 - 25 lbs\r\n\r\n- Chiều dài vợt: 675 mm', 'Mizuno', '2025-05-08 00:17:03', 65),
(19, 'Vợt cầu lông Mizuno Altius 5.1 Kinryũ', 3640000.00, '1746681516_vot-cau-long-mizuno-altius-5-1-kinryu-vang-nau-trang-chinh-hang_1728703334.jpg', '- Thương hiệu: Mizuno\r\n\r\n- Độ cứng đũa: Cứng\r\n\r\n- Điểm cân bằng: Nặng đầu\r\n\r\n- Chất liệu: Japan HMG T46\r\n\r\n- Chiều dài: 675 mm\r\n\r\n- Trọng lượng: 4U\r\n\r\n- Cán cầm: G5\r\n\r\n- Mức căng tối đa: 30 LBS', 'Mizuno', '2025-05-08 00:18:36', 10),
(20, 'Vợt cầu lông Mizuno Acrospeed 001 - Đen xanh vàng chính hãng', 4900000.00, '1746681639_1746681601_1746681423_vot-cau-long-mizuno-acrospeed-8-trang-vang-chinh-hang_1737139247.jpg', '- Độ cứng: Trung bình\r\n\r\n- Chất liệu: High – Elasticity Graphite + Graphite, VA Polymer, 4T carbon\r\n\r\n- Trọng lượng: 4U\r\n\r\n- Chu vi cán vợt: G6\r\n\r\n- Sức căng tối đa: 28LBS\r\n\r\n- Điểm cân bằng: 300mm +/- 3\r\n\r\n- Màu sắc: Đen xanh vàng', 'Mizuno', '2025-05-08 00:20:01', 2),
(21, 'Vợt cầu lông Mizuno Fortius 55 Strive', 3842000.00, '1746681719_vot-cau-long-mizuno-fortius-55-strive-xanh-nau-nhat-chinh-hang_1728702443.jpg', '- Thương hiệu: Mizuno\r\n\r\n- Độ cứng đũa: Cứng\r\n\r\n- Điểm cân bằng: Nặng đầu\r\n\r\n- Chất liệu: Japan HMG T46\r\n\r\n- Chiều dài: 675 mm\r\n\r\n- Trọng lượng: 4U\r\n\r\n- Cán cầm: G5\r\n\r\n- Mức căng tối đa: 30 LBS', 'Mizuno', '2025-05-08 00:21:59', 4),
(22, 'Vợt cầu lông Apacs Fantala Pro 101', 2500000.00, '1746681792_vot-cau-long-apacs-fantala-pro-101-chinh-hang_1718132206.jpg', '- Thương hiệu: Apacs\r\n\r\n- Chất liệu khung vợt: 40 Tonne Japan Graphite  + T-Throat\r\n\r\n- Chất liệu thân vợt: 50 Tonne Japan Graphite\r\n\r\n- Trọng lượng: 4U (84 ± 2g)  \r\n\r\n- Điểm cân bằng: 295 ± 3mm \r\n\r\n- Độ cứng: Trung Bình\r\n\r\n- Sức căng tối đa: 38 LBS \r\n\r\n- Đường kính đũa vợt: 6.6mm\r\n\r\n- Hệ thống 76 lỗ gen tiêu chuẩn', 'Apacs', '2025-05-08 00:23:12', 6),
(23, 'Vợt cầu lông Apacs Ziggler LHI Pro III', 2300000.00, '1746682035_vot-cau-long-apacs-ziggler-lhi-pro-iii-chinh-hang_1708998005.jpg', '- Thương hiệu: Apacs\r\n\r\n- Chất liệu khung vợt: 30 Tonne Japan HM Graphite + T-THROAT\r\n\r\n- Chất liệu thân vợt: 50 Tonne Japan Graphite\r\n\r\n- Trọng lượng: 85 ± 2g\r\n\r\n- Điểm cân bằng: 300 ± 3mm (Head Heavy)\r\n\r\n- Độ cứng đũa: 8.0 - Trung bình ( Medium Stiff)\r\n\r\n- Sức căng tối đa: 38 LBS \r\n\r\n- Màu sắc: Đen\r\n\r\n- Đường kính đũa vợt: 6.2mm (Ultra Slim Shaft)\r\n\r\n- Hệ thống 76 lỗ gen tiêu chuẩn', 'Apacs', '2025-05-08 00:27:15', 6),
(24, 'Vợt cầu lông Apacs Versus Pro New', 2400000.00, '1746682101_vot-cau-long-apacs-versus-pro-new-chinh-hang_1709065816.jpg', '- Thương hiệu: Apacs\r\n\r\n- Chất liệu khung vợt: 30 Tonne Japan HM Graphite + T-THROAT\r\n\r\n- Chất liệu thân vợt: 50 Tonne Japan Graphite\r\n\r\n- Trọng lượng: 3U (86 ± 3g)  \r\n\r\n- Điểm cân bằng: 305 ± 3mm (Head Heavy)\r\n\r\n- Độ dẻo: 7,5 - Cứng (Stiff)\r\n\r\n- Sức căng tối đa: 38 LBS \r\n\r\n- Màu sắc: Trắng phối Xanh Dương\r\n\r\n- Đường kính đũa vợt: 6.2mm\r\n\r\n- Hệ thống 76 lỗ gen tiêu chuẩn', 'Apacs', '2025-05-08 00:28:21', 46),
(25, 'Vợt cầu lông Lining Calibar 900B', 4690000.00, '1746682450_vot-cau-long-lining-calibar-900b-chinh-hang-5.jpg', '- Độ cứng: Trung bình. \r\n\r\n- Chất liệu: Military Grade Carbon Fiber\r\n\r\n- Điểm cân bằng: 292 mm (Cân Bằng)\r\n\r\n- Chiều dài vợt: 675mm \r\n\r\n- Chiều dài cán vợt: 200mm\r\n\r\n- Điểm swing weight: 87 kg/cm2\r\n\r\n- Trọng lượng: 3U\r\n\r\n- Chu vi cán vợt: S2 (G5)\r\n\r\n- Sức căng tối đa: 32LBS', 'Lining', '2025-05-08 00:34:10', 2),
(26, 'Vợt cầu lông VNB V88 xanh chính hãng', 638000.00, '1746682525_vot-cau-long-vnb-v88-xanh-chinh-hang-1.jpg', '- Độ cứng: Cứng trung bình\r\n\r\n- Khung vợt: Carbon High Modulus Graphite Carbon\r\n\r\n- Thân vợt: Carbon High Modulus Graphite Carbon\r\n\r\n- Trọng lượng: 4U (82+-2gr).\r\n\r\n- Điểm cân bằng: 300+-3mm\r\n\r\n- Chiều dài tổng thể: 675 mm\r\n\r\n- Điểm swing weight: 84,4 kg/cm2 \r\n\r\n- Chu vi cán vợt: G5\r\n\r\n- Sức căng tối đa: 30 (13.6) LBS\r\n\r\n- Màu sắc: Đen phối Xanh Dương', 'VNB', '2025-05-08 00:35:25', 100),
(27, 'Vợt cầu lông Proace Sabre 28', 2000000.00, '1747192397_vot-cau-long-proace-sabre-28-chinh-hang_1735505440 (1).jpg', '- Thương hiệu: Pro Ace\r\n\r\n- Khung vợt: HM Graphite + Carbon nanotube\r\n\r\n- Đũa vợt: HM Graphite + Carbon nanotube\r\n\r\n- Độ cứng: Cứng\r\n\r\n- Điểm cân bằng: Cân bằng\r\n\r\n- Trọng lượng / Cán cầm: 4U / G2 (~G4 Yonex)\r\n\r\n- Độ dài vợt: 675mm\r\n\r\n- Mức căng: 9-15kg', 'Proace', '2025-05-13 22:13:17', 23),
(28, 'Vợt cầu lông Proace Sniper 1000 chính hãng', 2000000.00, '1747192584_vot-cau-long-proace-sniper-1000-chinh-hang-1.jpg', '- Thương hiệu: PROACE\r\n\r\n- Xuất xứ: Anh\r\n\r\n- Trọng lượng: 4U ~ 83g\r\n\r\n- Chu vi cán cầm: G2\r\n\r\n- Đường kính đũa vợt: 7mm\r\n\r\n- Chất liệu vợt cầu lông PROACE: High Modulus Graphite\r\n\r\n- Độ dẻo: cứng\r\n\r\n- Màu sắc: Vàng đồng nhạt + Bạc\r\n\r\n- Mức căng khuyến nghị tối đa: 26 lbs ~ 12kg ', 'Proace', '2025-05-13 22:16:24', 34),
(29, 'Vợt cầu lông Proace Ultra Focus 3 ', 678000.00, '1747192710_vot-cau-long-proace-ultra-focus-3-xam-1.jpg', 'Thương hiệu \r\n\r\nProace\r\n\r\nTrọng lượng\r\n\r\n83g (4U)\r\n\r\nChất liệu\r\n\r\nHigh Modulus Graphite\r\n\r\nĐộ cứng\r\n\r\nDẻo\r\n\r\nMàu sắc\r\n\r\nXám\r\n\r\nĐiểm cân bằng - Nặng đầu\r\n\r\n305mm \r\n\r\nMức căng tối đa\r\n\r\n13,5 kg\r\n\r\nLối chơi\r\n\r\ncông thủ toàn diện', '', '2025-05-13 22:18:30', 34),
(30, 'Vợt Cầu Lông Proace Abs-Power 1800', 4900000.00, '1747192895_vot-cau-long-proace-abs-power-1800-cam-chinh-hang_1737504757.jpg', '- Thương hiệu: Proace\r\n\r\n- Chất liệu khung vợt: M40X+High Resilient Carbon Fiber \r\n\r\n- Chất liệu thân vợt: Carbon Nano Tube\r\n\r\n- Độ cứng: Trung bình\r\n\r\n- Trọng lượng vợt: 4U\r\n\r\n- Chu vi cán cầm: G2\r\n\r\n- Mức căng dây: 9 - 15kg', 'Proace', '2025-05-13 22:21:35', 23),
(31, 'Vợt cầu lông Proace TGR 1000 New', 1124000.00, '1747192978_vot-cau-long-proace-tgr-1000-new-1.jpg', '- Độ cứng: Trung bình. \r\n\r\n- Khung vợt: High Modulus Graphite\r\n\r\n- Thân vợt: High Modulus Graphite \r\n\r\n- Trọng lượng: 3U\r\n\r\n- Chu vi cán vợt: G2 (G4)\r\n\r\n- Sức căng tối đa: 26 LBS (11.79 kg)\r\n\r\n- Điểm cân bằng: Nặng đầu.\r\n\r\n- Màu sắc: Cam/ Đen.\r\n\r\n- Sản xuất: Anh Quốc. ', 'Proace', '2025-05-13 22:22:58', 23),
(32, 'Vợt Cầu Lông Proace Feather 5 ', 1950000.00, '1747193068_vot-cau-long-proace-feather-5-1.jpg', '- Độ cứng: Trung bình.\r\n\r\n- Khung vợt: Cacbon Graphite\r\n\r\n- Thân vợt: Cacbon Graphite\r\n\r\n- Trọng lượng: 5U (75- 79g)\r\n\r\n- Chu vi cán vợt: G2\r\n\r\n- Sức căng tối đa:  9-12kg\r\n\r\n- Màu sắc: Đen/ Tím.', 'Proace', '2025-05-13 22:24:28', 6),
(33, 'Vợt Cầu Lông Proace ABS 1500 chính hãng', 3600000.00, '1747193117_vot-cau-long-proace-abs-1500-1.jpg', '- Độ cứng: Trung bình\r\n\r\n- Khung vợt: Carbon Graphite\r\n\r\n- Thân vợt: Carbon Graphite\r\n\r\n- Trọng lượng: 3U (86-88g) ,\r\n\r\n                        4U (84-86g)\r\n\r\n- Chu vi cán vợt: 3U G2\r\n\r\n                           4U G2 \r\n\r\n- Sức căng tối đa: 9 - 12kg\r\n\r\n- Màu sắc: Trắng', 'Proace', '2025-05-13 22:25:17', 89),
(34, 'Vợt Cầu Lông Proace Focus 300', 960000.00, '1747195206_vot-cau-long-proace-focus-300-xanh-la_1728591039.jpg', '- Độ cứng: Trung bình. \r\n\r\n- Khung vợt:  Graphite\r\n\r\n- Thân vợt: Graphite \r\n\r\n- Trọng lượng: 3U, 4U\r\n\r\n- Chu vi cán vợt: G2\r\n\r\n- Sức căng tối đa: 24 LBS (10.89kg)\r\n\r\n- Điểm cân bằng: Cân bằng ', 'Proace', '2025-05-13 23:00:06', 23),
(35, 'Vợt Cầu Lông Proace Stroke 318', 850000.00, '1747195324_vot-cau-long-proace-stroke-318-1.jpg', '- Độ cứng: Trung bình\r\n\r\n- Khung vợt: Hi-Modulus Graphite.\r\n\r\n- Thân vợt: Hi-Modulus Carbon Graphite.\r\n\r\n- Trọng lượng: 3U (86-88g)\r\n\r\n                        4U (84-86g)\r\n\r\n- Chu vi cán vợt: 3U G2  ,\r\n\r\n                           4U G2\r\n\r\n- Sức căng tối đa: 9-15kg\r\n\r\n- Màu sắc:Đỏ/ Trắng.', 'Proace', '2025-05-13 23:01:04', 23),
(36, 'Vợt cầu lông Proace Titanium 9', 2000000.00, '1747195401_vot-cau-long-proace-titanium-9-chinh-hang-4.jpg', '- Độ cứng: Trung bình.\r\n\r\n- Khung vợt:  Graphite\r\n\r\n- Thân vợt: Graphite \r\n\r\n- Trọng lượng: 3U, 4U\r\n\r\n- Chu vi cán vợt: G5\r\n\r\n- Sức căng tối đa: 15 Kg\r\n\r\n- Điểm cân bằng: Cân bằng\r\n\r\n- Màu sắc: Xanh Navy phối Đen và Trắng', 'Proace', '2025-05-13 23:03:21', 83);

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
  `role` varchar(50) DEFAULT 'user',
  `full_name` varchar(255) NOT NULL DEFAULT '',
  `address` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `created_at`, `role`, `full_name`, `address`) VALUES
(56, '', 'binnguyen', '$2y$10$FDuyFVhFoPXYQqY3DVLTn.QzbwotvgQ1V/Hs1OGXsRpxw9e0f9VZm', 'binnguyen@gmail.com', '2025-04-29 11:33:51', 'user', '', ''),
(57, '', 'tanbin123', '$2y$10$219cUoqj54H76Ndba1p1PevFvfNHV.IPpRJJ9yeh/wAyn02W6QKqq', 'tanbin123@gmail.com', '2025-05-01 14:22:08', 'user', '', ''),
(59, '', '123', '$2y$10$iLD/dYRlPq8/iBOUHXVBJegPh9UQpiXuehlaRl9BhhKNIqDseHxNm', '123@gmail.com', '2025-05-17 16:04:52', 'user', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2016 at 07:39 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quan_ly_go`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id` int(10) UNSIGNED NOT NULL,
  `donhang_id` int(10) UNSIGNED NOT NULL,
  `vatdung_id` int(10) UNSIGNED NOT NULL,
  `so_luong` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id`, `donhang_id`, `vatdung_id`, `so_luong`, `created_at`, `updated_at`) VALUES
(2, 5, 1, 2, '2016-06-24 21:30:02', '2016-06-24 21:30:02'),
(3, 6, 2, 2, '2016-06-24 21:31:37', '2016-06-24 21:31:37'),
(4, 7, 2, 0, '2016-06-24 21:32:37', '2016-06-24 21:32:37'),
(6, 9, 1, 2, '2016-06-24 22:27:23', '2016-06-24 22:27:23'),
(8, 11, 1, 3, '2016-06-24 22:28:57', '2016-06-24 22:28:57'),
(12, 15, 1, 2, '2016-06-24 22:40:58', '2016-06-24 22:40:58'),
(14, 17, 1, 2, '2016-06-24 23:32:24', '2016-06-24 23:32:24'),
(15, 18, 1, 2, '2016-06-24 23:37:26', '2016-06-24 23:37:26'),
(16, 19, 1, 2, '2016-06-25 00:01:12', '2016-06-25 00:01:12'),
(17, 20, 1, 1, '2016-06-25 00:06:03', '2016-06-25 00:06:03'),
(18, 21, 1, 2, '2016-06-25 00:08:33', '2016-06-25 00:08:33'),
(19, 22, 1, 2, '2016-06-25 00:08:50', '2016-06-25 00:08:50'),
(20, 23, 1, 2, '2016-06-25 00:14:02', '2016-06-25 00:14:02'),
(21, 24, 1, 2, '2016-06-25 00:17:12', '2016-06-25 00:17:12'),
(22, 25, 1, 1, '2016-06-25 00:18:41', '2016-06-25 00:18:41'),
(23, 26, 1, 1, '2016-06-25 00:19:33', '2016-06-25 00:19:33'),
(24, 27, 1, 1, '2016-06-25 00:19:38', '2016-06-25 00:19:38'),
(25, 28, 1, 1, '2016-06-25 00:19:58', '2016-06-25 00:19:58'),
(26, 28, 2, 2, '2016-06-25 00:19:58', '2016-06-25 00:19:58'),
(27, 29, 1, 1, '2016-06-25 00:22:34', '2016-06-25 00:22:34'),
(28, 29, 1, 1, '2016-06-25 00:22:34', '2016-06-25 00:22:34'),
(29, 29, 1, 1, '2016-06-25 00:22:34', '2016-06-25 00:22:34'),
(32, 2, 1, 2, '2016-06-25 01:33:34', '2016-06-25 01:33:34'),
(33, 2, 2, 3, '2016-06-25 01:33:34', '2016-06-25 01:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_vat_dung`
--

CREATE TABLE `chi_tiet_vat_dung` (
  `id` int(10) UNSIGNED NOT NULL,
  `vatdung_id` int(10) UNSIGNED NOT NULL,
  `vatlieu_id` int(10) UNSIGNED NOT NULL,
  `so_luong` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chi_tiet_vat_dung`
--

INSERT INTO `chi_tiet_vat_dung` (`id`, `vatdung_id`, `vatlieu_id`, `so_luong`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 12, '2016-06-24 21:20:10', '2016-06-24 21:20:10'),
(3, 2, 2, 13, '2016-06-24 21:20:10', '2016-06-24 21:20:10'),
(4, 3, 1, 2, '2016-06-25 00:13:23', '2016-06-25 00:13:23'),
(5, 3, 2, 3, '2016-06-25 00:13:23', '2016-06-25 00:13:23'),
(6, 4, 1, 2, '2016-06-25 00:39:43', '2016-06-25 00:39:43'),
(7, 1, 1, 2, '2016-06-25 01:29:34', '2016-06-25 01:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int(10) UNSIGNED NOT NULL,
  `ma_don_hang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `khach_hang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nguoi_tao_don` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id`, `ma_don_hang`, `khach_hang`, `nguoi_tao_don`, `mo_ta`, `trang_thai`, `created_at`, `updated_at`) VALUES
(2, 'DH2', 'Lê Huy Thông', 'Lê Kim Anh', '', 0, '2016-06-24 21:21:45', '2016-06-24 21:21:45'),
(5, 'DH5', 'Le ju in ', 'Lê Kim Anh', '', 0, '2016-06-24 21:30:02', '2016-06-24 21:30:02'),
(6, 'DH6', 'kim anh', 'Lê Kim Anh', '', 0, '2016-06-24 21:31:37', '2016-06-24 21:31:37'),
(7, 'DH7', 'kim anh', 'Lê Kim Anh', '', 0, '2016-06-24 21:32:37', '2016-06-24 21:32:37'),
(8, 'DH8', 'as', 'Lê Kim Anh', '', 0, '2016-06-24 21:47:58', '2016-06-24 21:47:58'),
(9, 'DH9', 'aaaa', 'Lê Kim Anh', '', 0, '2016-06-24 22:27:22', '2016-06-24 22:27:22'),
(10, 'DH10', 'aaaa', 'Lê Kim Anh', '', 0, '2016-06-24 22:27:39', '2016-06-24 22:27:39'),
(11, 'DH11', 'aaaa', 'Lê Kim Anh', '', 0, '2016-06-24 22:28:57', '2016-06-24 22:28:57'),
(12, 'DH12', '1de', 'Lê Kim Anh', '', 0, '2016-06-24 22:30:11', '2016-06-24 22:30:11'),
(13, 'DH13', '1de', 'Lê Kim Anh', '', 0, '2016-06-24 22:30:35', '2016-06-24 22:30:35'),
(14, 'DH14', 'anh', 'Lê Kim Anh', '', 0, '2016-06-24 22:40:48', '2016-06-24 22:40:48'),
(15, 'DH15', 'anh', 'Lê Kim Anh', '', 0, '2016-06-24 22:40:58', '2016-06-24 22:40:58'),
(16, 'DH16', 'as', 'Lê Kim Anh', '', 0, '2016-06-24 22:47:47', '2016-06-24 22:47:47'),
(17, 'DH17', 'anh', 'Lê Kim Anh', '', 0, '2016-06-24 23:32:24', '2016-06-24 23:32:24'),
(18, 'DH18', 'anh', 'Lê Kim Anh', '', 0, '2016-06-24 23:37:26', '2016-06-24 23:37:26'),
(19, 'DH19', 'anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:01:12', '2016-06-25 00:01:12'),
(20, 'DH20', 'anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:06:03', '2016-06-25 00:06:03'),
(21, 'DH21', 'anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:08:33', '2016-06-25 00:08:33'),
(22, 'DH22', 'anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:08:50', '2016-06-25 00:08:50'),
(23, 'DH23', 'kim anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:14:02', '2016-06-25 00:14:02'),
(24, 'DH24', 'kim anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:17:12', '2016-06-25 00:17:12'),
(25, 'DH25', 'anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:18:41', '2016-06-25 00:18:41'),
(26, 'DH26', 'anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:19:33', '2016-06-25 00:19:33'),
(27, 'DH27', 'anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:19:38', '2016-06-25 00:19:38'),
(28, 'DH28', 'anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:19:58', '2016-06-25 00:19:58'),
(29, 'DH29', 'anh', 'Lê Kim Anh', '', 0, '2016-06-25 00:22:34', '2016-06-25 00:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_06_22_193019_DonHang', 1),
('2016_06_22_200816_HangHoa', 1),
('2016_06_22_210207_NguyenLieu', 1),
('2016_06_22_210518_ChiTietDonHang', 1),
('2016_06_23_155936_DonHang', 2),
('2016_06_23_160623_VatDung', 2),
('2016_06_23_161039_VatLieu', 2),
('2016_06_23_162733_ChiTietDonHang', 2),
('2016_06_23_163635_ChiTietVatDung', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vat_dung`
--

CREATE TABLE `vat_dung` (
  `id` int(10) UNSIGNED NOT NULL,
  `ma_vat_dung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vat_dung`
--

INSERT INTO `vat_dung` (`id`, `ma_vat_dung`, `ten`, `mo_ta`, `created_at`, `updated_at`) VALUES
(1, 'VD1', 'giường', '', '2016-06-24 21:19:54', '2016-06-24 21:19:54'),
(2, 'VD2', 'tủ nhật', '', '2016-06-24 21:20:09', '2016-06-24 21:20:09'),
(3, 'VD3', 'bàn', '', '2016-06-25 00:13:23', '2016-06-25 00:13:23'),
(4, 'VD4', 'ghế', '', '2016-06-25 00:39:42', '2016-06-25 00:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `vat_lieu`
--

CREATE TABLE `vat_lieu` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_ma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rong` double NOT NULL,
  `dai` double NOT NULL,
  `cao` double NOT NULL,
  `don_gia` double NOT NULL,
  `chat_lieu` int(11) NOT NULL,
  `yeu_cau` int(11) NOT NULL,
  `mo_ta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vat_lieu`
--

INSERT INTO `vat_lieu` (`id`, `ten_ma`, `ten`, `rong`, `dai`, `cao`, `don_gia`, `chat_lieu`, `yeu_cau`, `mo_ta`, `created_at`, `updated_at`) VALUES
(1, 'VL1', 'thanh dọc', 1, 100, 1, 12000, 2, 1, '', '2016-06-24 21:19:11', '2016-06-24 21:19:11'),
(2, 'VL2', 'thanh giằng', 12, 11, 1, 12000, 1, 1, '', '2016-06-24 21:19:36', '2016-06-24 21:19:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_don_hang_donhang_id_foreign` (`donhang_id`),
  ADD KEY `chi_tiet_don_hang_vatdung_id_foreign` (`vatdung_id`);

--
-- Indexes for table `chi_tiet_vat_dung`
--
ALTER TABLE `chi_tiet_vat_dung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_vat_dung_vatdung_id_foreign` (`vatdung_id`),
  ADD KEY `chi_tiet_vat_dung_vatlieu_id_foreign` (`vatlieu_id`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vat_dung`
--
ALTER TABLE `vat_dung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vat_lieu`
--
ALTER TABLE `vat_lieu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `chi_tiet_vat_dung`
--
ALTER TABLE `chi_tiet_vat_dung`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `vat_dung`
--
ALTER TABLE `vat_dung`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vat_lieu`
--
ALTER TABLE `vat_lieu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_donhang_id_foreign` FOREIGN KEY (`donhang_id`) REFERENCES `don_hang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_don_hang_vatdung_id_foreign` FOREIGN KEY (`vatdung_id`) REFERENCES `vat_dung` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chi_tiet_vat_dung`
--
ALTER TABLE `chi_tiet_vat_dung`
  ADD CONSTRAINT `chi_tiet_vat_dung_vatdung_id_foreign` FOREIGN KEY (`vatdung_id`) REFERENCES `vat_dung` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_vat_dung_vatlieu_id_foreign` FOREIGN KEY (`vatlieu_id`) REFERENCES `vat_lieu` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

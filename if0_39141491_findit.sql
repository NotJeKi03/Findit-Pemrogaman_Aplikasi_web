-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql112.infinityfree.com
-- Generation Time: Jun 25, 2025 at 12:25 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39141491_findit`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `email`, `password`, `Status`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'admin'),
(2, 'user', 'user@gmail.com', 'user', NULL),
(3, 'Tania', 'tania@gmail.com', '12345', NULL),
(5, 'nca', 'caca@gmail.com', 'yayaya', NULL),
(6, 'lala', 'lala@gmail.com', '2222', NULL),
(7, 'Master', 'Masterr@gmail.com', '123', NULL),
(8, 'Ironman', 'IronMan@gmail.com', '1234', NULL),
(9, 'Fulan', 'fulanbinfulan@gmail.com', '1234', NULL),
(10, 'Muh. Surya', 'surya@gmail.com', 'Surya', NULL),
(11, 'cici', 'ci@gmail.com', '12', NULL),
(13, 'akmal', 'akmal@akmal.akmal', 'akmal@akmal.akmal', NULL),
(14, 'vania ', 'vaniamelia1213@gmail.com', 'van1202', NULL),
(15, 'muhammad naufal', 'naufal12@gmail.com', '12345akusiapa', NULL),
(16, 'muhammad nasikin', 'nasikin13@gmail.com', 'nasikin12345', NULL),
(18, 'Safiul Rifki', 'Msafiulrifki@gamail.com', 'yyyyyyyyyyyyyyy', NULL),
(19, 'Defa Augista Montaine Dhanarto Putera', 'defaputra505@gmail.com', '12345678', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_barang`
--

CREATE TABLE `daftar_barang` (
  `id` int(11) NOT NULL,
  `jenis_laporan` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `nomor_penghubung` varchar(20) NOT NULL,
  `deskripsi_barang` text DEFAULT NULL,
  `foto1` varchar(255) DEFAULT NULL,
  `foto2` varchar(255) DEFAULT NULL,
  `foto3` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `lokasi_kejadian` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_barang`
--

INSERT INTO `daftar_barang` (`id`, `jenis_laporan`, `nama_barang`, `nomor_penghubung`, `deskripsi_barang`, `foto1`, `foto2`, `foto3`, `created_at`, `lokasi_kejadian`, `user_id`) VALUES
(26, 'Hilang', 'laptop acer', '+6208654832131', 'laptop merek acer hitam', '/uploads/img1-itemID26.jpeg', NULL, NULL, '2025-06-09 16:43:34', 'untid', 2),
(27, 'Hilang', 'laptop asus', '+6208654832131', 'laptop merek asus vivobook putih', '/uploads/img1-itemID27.webp', NULL, NULL, '2025-06-09 16:44:16', 'untid', 2),
(28, 'Ditemukan', 'laptop lenovo', '+6208654832131', 'laptop merek asus vivobook putih', '/uploads/img1-itemID28.jpg', NULL, NULL, '2025-06-09 16:44:41', 'untid', 2),
(29, 'Hilang', 'HP vivo', '+629381223123', 'dadsdadasdas', '/uploads/img1-itemID29.webp', NULL, NULL, '2025-06-09 16:45:13', 'pakelan', 2),
(30, 'Hilang', 'HP samsum', '+629381223123', 'dadsdadasdas', '/uploads/img1-itemID30.jpg', NULL, NULL, '2025-06-09 16:45:34', 'pakelan', 2),
(31, 'Hilang', 'contoh', '+62847354821234', 'contohcontohcontohcontohcontohcontohcontohcontohcontohcontohcontohcontohcontoh', '/uploads/img1-itemID31.jpeg', '/uploads/img2-itemID31.jpg', '/uploads/img3-itemID31.jpg', '2025-06-10 04:43:22', 'contoh', 2),
(32, 'Hilang', 'Halo Jek', '+6277612255666', 'Adadeh', '/uploads/img1-itemID32.jpg', NULL, NULL, '2025-06-11 05:58:43', 'Mertoyudan ', 2),
(34, 'Ditemukan', 'tas', '+62085879623295', 'TAs bewarna pink', '/uploads/img1-itemID34.jpg', NULL, NULL, '2025-06-21 14:25:31', 'Magelang', 14),
(36, 'Hilang', 'Dompet', '628572726543', 'Dompet Kulit Warna Hitam', '/uploads/img1-itemID36.jpg', NULL, NULL, '2025-06-22 11:55:43', 'Potrobangsan', 10),
(37, 'Hilang', 'ASUS ROG G 16', '+6285600410652', 'Laptop ASUS ROG', '/uploads/img1-itemID37.webp', NULL, NULL, '2025-06-24 09:10:46', 'UNTIDAR ', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  ADD CONSTRAINT `daftar_barang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

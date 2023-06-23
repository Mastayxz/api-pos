-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 04:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `gbl_user`
--

CREATE TABLE `gbl_user` (
  `id_user` int(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gbl_user`
--

INSERT INTO `gbl_user` (`id_user`, `nama`, `email`, `password`) VALUES
(1, 'Genta', 'gentaarimbawa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `pos_barang`
--

CREATE TABLE `pos_barang` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(100) NOT NULL,
  `nama_barang` varchar(110) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_barang`
--

INSERT INTO `pos_barang` (`id_barang`, `id_kategori`, `nama_barang`, `harga`, `stok`, `catatan`, `aktif`, `tgl_input`) VALUES
(2, 2, 'Quecker', 10000, 5, 'Sereal', 1, '2023-05-22 08:57:27'),
(3, 1, 'Susu UHT', 15000, 15, 'Coklat', 1, '2023-05-22 09:01:50'),
(4, 3, 'CloseUp', 4000, 10, 'Pasta Gigi', 0, '2023-05-22 09:04:40'),
(5, 2, 'Citato', 5000, 20, 'snack', 1, '2023-05-22 09:16:19'),
(14, 2, 'lays', 3000, 10, 'snack', 1, '2023-06-12 09:46:29'),
(15, 2, 'Taro', 5000, 20, 'snack', 1, '2023-06-19 08:46:30'),
(16, 1, 'le mineral', 3000, 10, 'air mineral', 1, '2023-06-19 08:55:31'),
(17, 2, 'lays', 3000, 10, 'snack', 1, '2023-06-19 10:41:33'),
(18, 2, 'energen', 20000, 10, 'sereal', 1, '2023-06-19 10:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `pos_kategori`
--

CREATE TABLE `pos_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_kategori`
--

INSERT INTO `pos_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'minuman'),
(2, 'makanan'),
(3, 'alat mandi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gbl_user`
--
ALTER TABLE `gbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `pos_barang`
--
ALTER TABLE `pos_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `pos_kategori`
--
ALTER TABLE `pos_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gbl_user`
--
ALTER TABLE `gbl_user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pos_barang`
--
ALTER TABLE `pos_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pos_kategori`
--
ALTER TABLE `pos_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

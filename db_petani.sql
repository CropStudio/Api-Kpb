-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2019 at 07:10 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petani_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `anak`
--

CREATE TABLE `anak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anak`
--

INSERT INTO `anak` (`id`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'NAMA', '2019-07-18', 'JENIS_KELAMIN', 1, NULL, '2019-07-18 07:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `jatah`
--

CREATE TABLE `jatah` (
  `id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_pupuk` int(11) DEFAULT NULL,
  `id_poktan` int(11) DEFAULT NULL,
  `id_petani` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jatah`
--

INSERT INTO `jatah` (`id`, `jumlah`, `id_pupuk`, `id_poktan`, `id_petani`, `created_at`, `updated_at`) VALUES
(4, 1200, 1, 2, 2, '2019-07-18 04:58:02', '2019-07-18 05:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `petani`
--

CREATE TABLE `petani` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `komoditas` varchar(100) DEFAULT NULL,
  `luas_lahan` varchar(50) DEFAULT NULL,
  `id_user` int(100) DEFAULT NULL,
  `id_poktan` int(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petani`
--

INSERT INTO `petani` (`id`, `nik`, `nama`, `jenis_kelamin`, `komoditas`, `luas_lahan`, `id_user`, `id_poktan`, `created_at`, `updated_at`) VALUES
(1, 'NIK', 'Coks', 'JENIS_KELAMIN', 'KOMODITAS\r\n', '1', 2, 2, NULL, '2019-07-19 04:07:00'),
(2, '234', 'efdeswf', 'Laki-Laki', 'awdaw', '23', NULL, NULL, '2019-07-19 04:07:26', '2019-07-19 04:07:26'),
(4, '324324', 'awdawda', 'Perempuan', 'awdawd', '232', NULL, 2, '2019-07-19 09:31:41', '2019-07-19 09:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `poktan`
--

CREATE TABLE `poktan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `desa` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poktan`
--

INSERT INTO `poktan` (`id`, `nama`, `kabupaten`, `kecamatan`, `desa`, `created_at`, `updated_at`) VALUES
(2, 'Poktan Coks', 'KABUPATEN', 'KECAMATAN', 'DESA', NULL, '2019-07-18 06:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `pupuk`
--

CREATE TABLE `pupuk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pupuk`
--

INSERT INTO `pupuk` (`id`, `nama`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'NAMA aja', 'JENIS', NULL, '2019-07-18 07:21:19'),
(3, 'pup', 'eek', '2019-07-18 07:21:38', '2019-07-18 07:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `role` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ktp` varchar(100) DEFAULT NULL,
  `kartukeluarga` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `nama`, `no_hp`, `role`, `password`, `token`, `ktp`, `kartukeluarga`, `created_at`, `updated_at`) VALUES
(2, '1234567', 'wahyuu', '1234', 2, '$2y$10$FAzozlPS0J9rPGZ94xxJKOzVhq6869E.uJU2j8Zl275dRy6zQvEYC', NULL, NULL, NULL, '2019-07-19 03:40:37', '2019-07-19 03:41:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anak`
--
ALTER TABLE `anak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jatah`
--
ALTER TABLE `jatah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petani`
--
ALTER TABLE `petani`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poktan`
--
ALTER TABLE `poktan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pupuk`
--
ALTER TABLE `pupuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anak`
--
ALTER TABLE `anak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jatah`
--
ALTER TABLE `jatah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `petani`
--
ALTER TABLE `petani`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `poktan`
--
ALTER TABLE `poktan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pupuk`
--
ALTER TABLE `pupuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

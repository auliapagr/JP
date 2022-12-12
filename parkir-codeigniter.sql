-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2022 at 02:57 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir-codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `jenis_kendaraan` varchar(15) NOT NULL,
  `nomor_polisi` varchar(8) NOT NULL,
  `tanggal_jam_masuk` datetime NOT NULL,
  `tanggal_jam_keluar` datetime NOT NULL,
  `biaya` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `jenis_kendaraan`, `nomor_polisi`, `tanggal_jam_masuk`, `tanggal_jam_keluar`, `biaya`) VALUES
(5, 'Mobil', 'B1212TQT', '2020-07-07 17:43:07', '2020-07-07 18:55:59', 3000),
(7, 'Mobil', 'B1234TAT', '2020-07-07 20:50:38', '2020-07-07 18:52:55', 3000),
(8, 'Motor', 'B0000RQR', '2020-07-07 18:53:22', '2020-07-07 18:53:43', 1500),
(10, 'Motor', 'B1111QWQ', '2020-07-08 03:32:15', '2020-07-08 03:32:39', 1500),
(11, 'Motor', 'A9090QQQ', '2020-07-08 04:45:59', '2020-07-08 04:46:27', 1500),
(12, 'Mobil', 'B1131IOP', '2020-07-08 04:52:19', '2020-07-08 04:52:43', 3000),
(13, 'Mobil', 'Q123QWQ', '2020-07-08 04:58:25', '2020-07-08 04:58:47', 3000),
(15, 'Mobil', 'V4444TWT', '2020-07-08 09:14:15', '2020-07-08 09:14:49', 3000),
(20, 'Mobil', 'B4450TCT', '2020-07-08 09:40:03', '2020-07-08 10:28:54', 3000),
(21, 'Mobil', 'B8080YWY', '2020-07-08 10:03:45', '2020-07-08 10:14:43', 3000),
(22, 'Motor', 'Q9090RRQ', '2020-07-08 10:25:13', '2020-07-08 10:25:55', 1500),
(23, 'Mobil', 'A2323QQQ', '2020-07-08 12:40:36', '2020-07-08 12:41:30', 3000),
(24, 'Mobil', 'Q9090EEQ', '2020-07-08 15:12:20', '2020-07-08 15:13:32', 3000),
(25, 'Motor', 'M7878QWE', '2020-07-08 15:12:42', '2020-07-08 15:14:14', 1500),
(26, 'Mobil', 'B3210TCT', '2022-12-10 16:12:20', '2022-12-10 16:16:12', 3000),
(27, 'Motor', 'T3467KJ', '2022-12-10 16:30:42', '2022-12-10 16:32:32', 1500),
(28, 'Motor', 'T1999NV', '2022-12-10 16:35:23', '2022-12-10 16:35:55', 1500),
(29, 'Mobil', 'T1911KV', '2022-12-11 09:16:14', '2022-12-11 09:16:47', 3000),
(31, 'Mobil', 'B1234NT', '2022-12-11 11:19:16', '2022-12-11 11:20:08', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `image`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$8A9wpBmo.45ZCDyM1o6wOOHbK5LPMcN2lsE2hQzx4OFPi.thnGp8u', 'images.png', 1, 1, 1669564385),
(2, 'Admin2', 'admin2@gmail.com', '$2y$10$VFf3QLUI3YfFD/SGD7Q5WOAtwg0KJPka.o1FhuVMjJhiPq3.nd9nS', 'default.jpg', 1, 1, 1669564385),
(3, 'Devyta', 'devyta@gmail.com', '$2y$10$JnrLCZzGT4gHKtcseBsHHeCh9mc6FrbqCU0uSvYdjdgvhz9uD6RiW', 'image.png', 1, 1, 1670770196);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

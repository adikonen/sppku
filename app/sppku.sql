-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2023 at 12:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppku`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `findByUsername` (IN `in_username` VARCHAR(50))   SELECT * FROM pengguna WHERE username = in_username$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `kompetensi_keahlian`) VALUES
(1, 'X RPL', 'Rekayasa Perangkat Lunak');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `nominal` int NOT NULL,
  `tahun_ajaran` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `nominal`, `tahun_ajaran`) VALUES
(1, 200000, 2020),
(2, 250000, 2021),
(3, 275000, 2022),
(4, 300000, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `role`) VALUES
(2, 'admin', '$2y$10$LhD5fkIoktE4JPdQ120N8eItthV.3O8Wu9BnWEqt1D9ygrU9kK7Xu', 1),
(8, 'hajigunawan', '$2y$10$K1L7jYTua8YbypgP1z463.D0oMNHu4KlaaHzpl7j/amFcvGcDB8vi', 2),
(9, '1', '$2y$10$ckysKbEozoN3z/ys87OavewcrP1SmyPDiMaQbL5RM1FHqPdoO/eYK', 3),
(10, '2', '$2y$10$w7Sc9gws1CW7sxMzlf1Bi.NGI9X007P4Ja3EQbuIefCCifzTxpXw6', 3),
(14, '1', '$2y$10$4eTCc6o1PdyF8tg.Vrfrkun5G9uuppG8kKNMHkinwu0JezHmVbTna', 3),
(15, '2', '$2y$10$5XlQHHBUZTEpQISk7N7giukTkc.RCFO7vkz3sTLN89yg50sjFCop2', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pengguna_petugas_view`
-- (See below for the actual view)
--
CREATE TABLE `pengguna_petugas_view` (
`id` int
,`nama_petugas` varchar(50)
,`pengguna_id` int
,`role` int
,`username` varchar(50)
,`password` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pengguna_siswa_view`
-- (See below for the actual view)
--
CREATE TABLE `pengguna_siswa_view` (
`id` int
,`nis` varchar(10)
,`nisn` varchar(20)
,`nama_siswa` varchar(50)
,`telepon` varchar(14)
,`alamat` varchar(255)
,`tahun_mulai` int
,`kelas_id` int
,`pengguna_id` int
,`pembayaran_id` int
,`role` int
,`username` varchar(50)
,`password` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `pengguna_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `pengguna_id`) VALUES
(1, 'admin sistem', 2),
(2, 'Haji Gunawan S.Pd', 8);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `telepon` varchar(14) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tahun_mulai` int NOT NULL,
  `sudah_lunas` tinyint(1) NOT NULL DEFAULT '0',
  `kelas_id` int NOT NULL,
  `pengguna_id` int NOT NULL,
  `pembayaran_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nisn`, `nama_siswa`, `telepon`, `alamat`, `tahun_mulai`, `sudah_lunas`, `kelas_id`, `pengguna_id`, `pembayaran_id`) VALUES
(6, '1', '15001228444', 'addy konen', '0895342551277', 'Jalan Padang Gria No 17', 2020, 1, 1, 9, 3),
(7, '2', '15119220212', 'I Made Palguna Widiarsana', '087332112773', 'Jalan Tangkuban Perahu', 2020, 0, 1, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `bulan_dibayar` int NOT NULL,
  `tahun_dibayar` int NOT NULL,
  `tanggal_bayar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `siswa_id` int NOT NULL,
  `petugas_id` int NOT NULL,
  `pembayaran_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `bulan_dibayar`, `tahun_dibayar`, `tanggal_bayar`, `siswa_id`, `petugas_id`, `pembayaran_id`) VALUES
(97, 7, 2020, '2023-03-14 08:34:53', 6, 1, 1),
(98, 8, 2020, '2023-03-15 08:34:55', 6, 1, 1),
(99, 9, 2020, '2023-03-19 08:34:57', 6, 1, 1),
(100, 10, 2020, '2023-03-21 08:34:59', 6, 1, 1),
(101, 11, 2020, '2023-03-24 08:34:59', 6, 1, 1),
(102, 12, 2020, '2023-03-24 08:34:59', 6, 1, 1),
(103, 1, 2020, '2023-03-24 08:34:59', 6, 1, 1),
(104, 2, 2020, '2023-03-24 08:34:59', 6, 1, 1),
(105, 3, 2020, '2023-03-24 08:34:59', 6, 1, 1),
(106, 4, 2020, '2023-03-24 08:34:59', 6, 1, 1),
(107, 5, 2020, '2023-03-24 08:34:59', 6, 1, 1),
(108, 6, 2020, '2023-03-24 08:34:59', 6, 1, 1),
(109, 7, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(110, 8, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(111, 9, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(112, 10, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(113, 11, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(114, 12, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(115, 1, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(116, 2, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(117, 3, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(118, 4, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(119, 5, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(120, 6, 2021, '2023-03-24 08:34:59', 6, 1, 2),
(121, 7, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(122, 8, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(123, 9, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(124, 10, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(125, 11, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(126, 12, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(127, 1, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(128, 2, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(129, 3, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(130, 4, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(131, 5, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(132, 6, 2022, '2023-03-24 08:34:59', 6, 1, 3),
(133, 7, 2020, '2023-04-18 08:39:23', 7, 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi_pembayaran_view`
-- (See below for the actual view)
--
CREATE TABLE `transaksi_pembayaran_view` (
`id` int
,`bulan_dibayar` int
,`tahun_dibayar` int
,`tanggal_bayar` datetime
,`siswa_id` int
,`petugas_id` int
,`pembayaran_id` int
,`nominal` int
,`tahun_ajaran` int
);

-- --------------------------------------------------------

--
-- Structure for view `pengguna_petugas_view`
--
DROP TABLE IF EXISTS `pengguna_petugas_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pengguna_petugas_view`  AS SELECT `petugas`.`id` AS `id`, `petugas`.`nama_petugas` AS `nama_petugas`, `petugas`.`pengguna_id` AS `pengguna_id`, `pengguna`.`role` AS `role`, `pengguna`.`username` AS `username`, `pengguna`.`password` AS `password` FROM (`petugas` join `pengguna` on((`petugas`.`pengguna_id` = `pengguna`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `pengguna_siswa_view`
--
DROP TABLE IF EXISTS `pengguna_siswa_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pengguna_siswa_view`  AS SELECT `siswa`.`id` AS `id`, `siswa`.`nis` AS `nis`, `siswa`.`nisn` AS `nisn`, `siswa`.`nama_siswa` AS `nama_siswa`, `siswa`.`telepon` AS `telepon`, `siswa`.`alamat` AS `alamat`, `siswa`.`tahun_mulai` AS `tahun_mulai`, `siswa`.`kelas_id` AS `kelas_id`, `siswa`.`pengguna_id` AS `pengguna_id`, `siswa`.`pembayaran_id` AS `pembayaran_id`, `pengguna`.`role` AS `role`, `pengguna`.`username` AS `username`, `pengguna`.`password` AS `password` FROM (`siswa` join `pengguna` on((`siswa`.`pengguna_id` = `pengguna`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `transaksi_pembayaran_view`
--
DROP TABLE IF EXISTS `transaksi_pembayaran_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_pembayaran_view`  AS SELECT `transaksi`.`id` AS `id`, `transaksi`.`bulan_dibayar` AS `bulan_dibayar`, `transaksi`.`tahun_dibayar` AS `tahun_dibayar`, `transaksi`.`tanggal_bayar` AS `tanggal_bayar`, `transaksi`.`siswa_id` AS `siswa_id`, `transaksi`.`petugas_id` AS `petugas_id`, `transaksi`.`pembayaran_id` AS `pembayaran_id`, `pembayaran`.`nominal` AS `nominal`, `pembayaran`.`tahun_ajaran` AS `tahun_ajaran` FROM (`transaksi` join `pembayaran` on((`pembayaran`.`id` = `transaksi`.`pembayaran_id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengguna_id` (`pengguna_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengguna_id` (`pengguna_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `pembayaran_id` (`pembayaran_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_id` (`pembayaran_id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `petugas_id` (`petugas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

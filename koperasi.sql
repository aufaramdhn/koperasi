-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 12:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_pinjam`
--

CREATE TABLE `konfirmasi_pinjam` (
  `id_konfirmasi_pinjam` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `tgl_konfirmasi` datetime NOT NULL,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konfirmasi_pinjam`
--

INSERT INTO `konfirmasi_pinjam` (`id_konfirmasi_pinjam`, `id_pinjam`, `tgl_konfirmasi`, `expired`) VALUES
(1, 1, '2023-02-07 13:01:30', '2023-05-08 13:01:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ambil_simpan`
--

CREATE TABLE `tbl_ambil_simpan` (
  `id_ambil_simpan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_ambil` int(11) NOT NULL,
  `status_ambil` varchar(25) NOT NULL DEFAULT 'pending',
  `tgl_ambil` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ambil_simpan`
--

INSERT INTO `tbl_ambil_simpan` (`id_ambil_simpan`, `id_user`, `jumlah_ambil`, `status_ambil`, `tgl_ambil`) VALUES
(1, 2, 1000000, 'konfirmasi', '2023-02-07 09:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bunga`
--

CREATE TABLE `tbl_bunga` (
  `id_bunga` int(11) NOT NULL,
  `bunga` int(11) NOT NULL,
  `bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bunga`
--

INSERT INTO `tbl_bunga` (`id_bunga`, `bunga`, `bulan`) VALUES
(1, 1, 1),
(2, 3, 3),
(3, 8, 6),
(4, 14, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `no_pembayaran` int(11) NOT NULL,
  `method_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `no_pembayaran`, `method_pembayaran`) VALUES
(1, 809865479, 'BCA'),
(2, 890238523, 'MANDIRI'),
(4, 987347234, 'DANA'),
(5, 984234123, 'OVO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengembalian`
--

CREATE TABLE `tbl_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_konfirmasi_pinjam` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `jumlah_pengembalian` bigint(20) NOT NULL,
  `pengembalian_ke` int(11) NOT NULL,
  `bukti_pengembalian` longtext NOT NULL,
  `tgl_pengembalian` datetime NOT NULL,
  `status_pengembalian` varchar(25) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pengembalian`
--

INSERT INTO `tbl_pengembalian` (`id_pengembalian`, `id_konfirmasi_pinjam`, `id_pembayaran`, `jumlah_pengembalian`, `pengembalian_ke`, `bukti_pengembalian`, `tgl_pengembalian`, `status_pengembalian`) VALUES
(1, 1, 2, 433333, 1, 'f7.png', '2023-02-07 13:03:37', 'pending'),
(2, 1, 2, 433333, 2, 'f1.png', '2023-02-07 16:06:30', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_bunga` int(11) NOT NULL,
  `jumlah_pinjam` varchar(100) NOT NULL,
  `riba` int(11) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `status_pinjam` varchar(25) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `id_user`, `id_bunga`, `jumlah_pinjam`, `riba`, `tgl_pinjam`, `status_pinjam`) VALUES
(1, 2, 2, '1300000', 300000, '2023-02-07 13:01:30', 'pengembalian');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_simpan`
--

CREATE TABLE `tbl_simpan` (
  `id_simpan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `jumlah_simpan` int(11) NOT NULL,
  `bukti_simpan` longtext NOT NULL,
  `tgl_simpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_simpan` varchar(25) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_simpan`
--

INSERT INTO `tbl_simpan` (`id_simpan`, `id_user`, `id_pembayaran`, `jumlah_simpan`, `bukti_simpan`, `tgl_simpan`, `status_simpan`) VALUES
(1, 2, 0, 1000000, 'f3.png', '2023-02-07 06:00:45', 'konfirmasi'),
(2, 2, 0, 3000000, 'f3.png', '2023-02-07 06:00:49', 'konfirmasi'),
(3, 2, 0, 2000000, 'f3.png', '2023-02-07 06:00:53', 'konfirmasi'),
(4, 2, 0, 1000000, 'f3.png', '2023-02-07 06:00:57', 'konfirmasi'),
(5, 2, 0, 1000000, 'f1.png', '2023-02-07 05:46:29', 'pending'),
(6, 2, 0, 1000000, 'f3.png', '2023-02-07 05:47:05', 'pending'),
(7, 2, 0, 1000000, 'f3.png', '2023-02-07 05:58:28', 'pending'),
(8, 2, 4, 1000000, 'f3.png', '2023-02-07 05:59:40', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nik` int(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rekening` int(11) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `alamat` longtext NOT NULL,
  `img` longtext NOT NULL,
  `level` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nik`, `nama`, `email`, `password`, `rekening`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `pekerjaan`, `telp`, `alamat`, `img`, `level`, `created_at`) VALUES
(1, 0, 'Aufa Ramadhan', 'aufa@gmail.com', '123', 0, '', '0000-00-00', '', '', '', '081398057408', '', '', 'admin', '2022-11-28 06:02:31'),
(2, 0, 'Aninda Fitri Litasni', 'aninda@gmail.com', '123', 0, 'Bogor', '2022-11-28', 'Perempuan', 'Islam', 'CEO', '081398057408', 'GBJ', 'f3.png', 'user', '2023-02-03 11:57:00'),
(3, 0, 'Adi Saputra', 'adi@gmail.com', '123', 0, 'Bogor', '0000-00-00', 'Laki-laki', 'Islam', 'CEO', '08912834123', 'GBJ', '', 'user', '2022-12-28 01:44:12'),
(4, 0, 'Albert Enstein', 'albert@gmail.com', '123', 0, 'Bogor', '0000-00-00', 'Laki-laki', 'Islam', 'CEO', '08972314234', 'GBJ', '', 'user', '2022-12-28 01:44:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konfirmasi_pinjam`
--
ALTER TABLE `konfirmasi_pinjam`
  ADD PRIMARY KEY (`id_konfirmasi_pinjam`),
  ADD KEY `id_pinjam` (`id_pinjam`);

--
-- Indexes for table `tbl_ambil_simpan`
--
ALTER TABLE `tbl_ambil_simpan`
  ADD PRIMARY KEY (`id_ambil_simpan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_bunga`
--
ALTER TABLE `tbl_bunga`
  ADD PRIMARY KEY (`id_bunga`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_konfirmasi_peminjaman` (`id_konfirmasi_pinjam`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_bunga` (`id_bunga`);

--
-- Indexes for table `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  ADD PRIMARY KEY (`id_simpan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konfirmasi_pinjam`
--
ALTER TABLE `konfirmasi_pinjam`
  MODIFY `id_konfirmasi_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_ambil_simpan`
--
ALTER TABLE `tbl_ambil_simpan`
  MODIFY `id_ambil_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_bunga`
--
ALTER TABLE `tbl_bunga`
  MODIFY `id_bunga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  MODIFY `id_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

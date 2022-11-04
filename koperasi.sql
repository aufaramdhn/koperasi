-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2022 pada 06.59
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

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
-- Struktur dari tabel `konfirmasi_pinjam`
--

CREATE TABLE `konfirmasi_pinjam` (
  `id_konfirmasi_pinjam` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `tgl_konfirmasi` datetime NOT NULL,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konfirmasi_pinjam`
--

INSERT INTO `konfirmasi_pinjam` (`id_konfirmasi_pinjam`, `id_pinjam`, `tgl_konfirmasi`, `expired`) VALUES
(1, 1, '2022-11-03 12:32:14', '2022-11-01 12:32:14'),
(2, 3, '2022-11-03 15:07:11', '2022-12-03 15:07:11'),
(3, 5, '2022-11-03 15:08:22', '2022-12-03 15:08:22'),
(4, 7, '2022-11-03 19:51:12', '2022-11-03 19:51:12'),
(5, 8, '2022-11-04 06:43:52', '2022-12-04 06:43:52'),
(6, 9, '2022-11-04 10:40:50', '2022-12-04 10:40:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengembalian`
--

CREATE TABLE `tbl_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_konfirmasi_pinjam` int(11) NOT NULL,
  `jumlah_pengembalian` bigint(20) NOT NULL,
  `tgl_pengembalian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengembalian`
--

INSERT INTO `tbl_pengembalian` (`id_pengembalian`, `id_konfirmasi_pinjam`, `jumlah_pengembalian`, `tgl_pengembalian`) VALUES
(3, 1, 2200000, '2022-11-03 12:41:05'),
(4, 4, 1700000, '2022-11-03 19:59:16'),
(5, 4, 1700000, '2022-11-03 20:02:09'),
(6, 4, 1700000, '2022-11-03 20:02:43'),
(7, 4, 1700000, '2022-11-03 20:03:19'),
(8, 4, 1700000, '2022-11-03 20:03:32'),
(9, 4, 1700000, '2022-11-04 06:35:35'),
(10, 4, 1700000, '2022-11-04 06:40:26'),
(11, 4, 1700000, '2022-11-04 06:41:13'),
(12, 4, 1700000, '2022-11-04 06:41:40'),
(13, 4, 1700000, '2022-11-04 06:43:20'),
(14, 5, 2500000, '2022-11-04 06:44:12'),
(15, 5, 2500000, '2022-11-04 06:44:27'),
(16, 5, 2500000, '2022-11-04 06:48:19'),
(17, 5, 2500000, '2022-11-04 06:48:58'),
(18, 5, 2500000, '2022-11-04 06:49:06'),
(19, 4, 1700000, '2022-11-04 06:51:33'),
(20, 4, 1700000, '2022-11-04 06:51:44'),
(21, 4, 1700000, '2022-11-04 06:51:48'),
(22, 4, 1700000, '2022-11-04 06:52:08'),
(23, 4, 1700000, '2022-11-04 06:52:19'),
(24, 4, 1500000, '2022-11-04 06:52:19'),
(25, 4, 1700000, '2022-11-04 06:52:44'),
(26, 4, 1500000, '2022-11-04 06:52:44'),
(27, 4, 1700000, '2022-11-04 08:51:30'),
(28, 4, 1500000, '2022-11-04 08:51:30'),
(29, 4, 1700000, '2022-11-04 10:05:00'),
(30, 4, 1500000, '2022-11-04 10:05:00'),
(31, 4, 1700000, '2022-11-04 10:18:28'),
(32, 4, 1500000, '2022-11-04 10:18:28'),
(33, 4, 1700000, '2022-11-04 10:19:09'),
(34, 4, 1500000, '2022-11-04 10:19:09'),
(35, 4, 1700000, '2022-11-04 10:20:21'),
(36, 4, 1500000, '2022-11-04 10:20:21'),
(37, 4, 1700000, '2022-11-04 10:22:11'),
(38, 4, 1500000, '2022-11-04 10:22:11'),
(39, 4, 1700000, '2022-11-04 10:30:12'),
(40, 4, 1500000, '2022-11-04 10:30:12'),
(41, 6, 1500000, '2022-11-04 10:41:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_pinjam` varchar(100) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `id_user`, `jumlah_pinjam`, `tgl_pinjam`, `status`) VALUES
(2, 2, '1500000', '2022-11-03 15:01:22', 'pengembalian'),
(7, 2, '1500000', '2022-11-03 19:51:01', 'pengembalian'),
(8, 2, '2500000', '2022-11-04 06:43:26', 'pengembalian'),
(9, 2, '1500000', '2022-11-04 10:40:41', 'pengembalian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_simpan`
--

CREATE TABLE `tbl_simpan` (
  `id_simpan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_simpan` int(11) NOT NULL,
  `tgl_simpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_simpan`
--

INSERT INTO `tbl_simpan` (`id_simpan`, `id_user`, `jumlah_simpan`, `tgl_simpan`) VALUES
(1, 2, 1500000, '2022-11-03 03:34:53'),
(3, 2, 1500000, '2022-11-03 05:54:53'),
(6, 2, 2000000, '2022-11-03 05:55:30'),
(7, 2, 1500000, '2022-11-03 07:58:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `alamat` longtext NOT NULL,
  `level` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `email`, `password`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `pekerjaan`, `telp`, `alamat`, `level`, `created_at`) VALUES
(1, 'Aufa Ramadhan', 'aufa@gmail.com', '123', 'Bogor', '2004-11-08', 'Laki', 'Islam', 'CEO', '081398057408', 'GBJ', 'admin', '2022-11-03 03:22:36'),
(2, 'User', 'user@gmail.com', '123', 'Bogor', '2004-11-08', 'Laki', 'Islam', 'CEO', '081398057408', 'GBJ', 'user', '2022-11-03 05:29:34');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `konfirmasi_pinjam`
--
ALTER TABLE `konfirmasi_pinjam`
  ADD PRIMARY KEY (`id_konfirmasi_pinjam`),
  ADD KEY `id_pinjam` (`id_pinjam`);

--
-- Indeks untuk tabel `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_konfirmasi_peminjaman` (`id_konfirmasi_pinjam`);

--
-- Indeks untuk tabel `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  ADD PRIMARY KEY (`id_simpan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `konfirmasi_pinjam`
--
ALTER TABLE `konfirmasi_pinjam`
  MODIFY `id_konfirmasi_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  MODIFY `id_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

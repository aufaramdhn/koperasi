-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2022 pada 14.05
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
(10, 27, '2022-10-30 12:45:00', '2022-11-30 00:00:00'),
(11, 28, '2022-10-30 13:26:12', '2022-10-29 00:00:00'),
(12, 29, '2022-10-30 13:26:14', '2022-09-30 00:00:00'),
(13, 36, '2022-10-31 08:27:25', '2022-09-30 08:27:25'),
(14, 37, '2022-10-31 08:38:14', '2022-11-30 08:38:14');

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
(30, 0, '120000', '2022-10-30 19:31:29', 'pending'),
(31, 0, '123213', '2022-10-30 19:31:51', 'pending'),
(32, 0, '1231412', '2022-10-30 19:32:26', 'pending');

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
(45, 1, 150000, '2022-11-02 12:29:17'),
(46, 0, 1500000, '2022-11-02 12:32:15'),
(47, 0, 150000, '2022-11-02 12:32:28'),
(48, 0, 1231231, '2022-11-02 12:33:11'),
(49, 0, 1231313, '2022-11-02 12:33:14'),
(50, 0, 1599999, '2022-11-02 12:33:42'),
(51, 0, 1500000, '2022-11-02 12:34:10'),
(52, 0, 1500000, '2022-11-02 12:34:16'),
(53, 0, 1500000, '2022-11-02 12:34:24'),
(54, 0, 1400000, '2022-11-02 12:34:59'),
(55, 0, 150000, '2022-11-02 12:35:36'),
(56, 0, 1509000, '2022-11-02 12:36:59'),
(57, 0, 1423123, '2022-11-02 12:37:14'),
(58, 0, 150000, '2022-11-02 12:42:17'),
(59, 0, 150000, '2022-11-02 12:42:38'),
(60, 0, 150000, '2022-11-02 12:42:47'),
(61, 3, 1500000, '2022-11-02 12:44:42'),
(62, 3, 1500000, '2022-11-02 12:44:47'),
(63, 3, 1500000, '2022-11-02 12:45:03'),
(64, 1, 0, '2022-11-02 12:45:23'),
(65, 1, 150000, '2022-11-02 12:45:28'),
(66, 1, 150000, '2022-11-02 12:45:46'),
(67, 3, 0, '2022-11-02 12:47:40'),
(68, 1, 0, '2022-11-02 12:47:44'),
(69, 0, 150000, '2022-11-02 12:52:44'),
(70, 0, 150000, '2022-11-02 12:53:17'),
(71, 0, 150000, '2022-11-02 12:53:40'),
(72, 0, 1500000, '2022-11-02 12:54:31'),
(73, 0, 1600000, '2022-11-02 12:54:45'),
(74, 0, 1600000, '2022-11-02 12:55:58'),
(75, 0, 14, '2022-11-02 12:57:20'),
(76, 0, 14, '2022-11-02 12:57:52'),
(77, 0, 14, '2022-11-02 12:58:08');

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
  `tgl_lahir` varchar(100) NOT NULL,
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
(1, 'Mirza El Fandi', 'mirza@gmail.com', '987', 'Bogor', '2004-08-11', 'LK', 'islam', 'CEO', '08912384123', 'AAA', 'admin', '2022-11-01 03:17:23'),
(3, 'Adi Saputra', 'adi@gmail.com', '123', 'Bogor', '2005-03-11', 'LAKIK', 'islam', 'CEO', '08123948123', 'GBJ', 'user', '2022-10-31 23:31:23');

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
  MODIFY `id_konfirmasi_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  MODIFY `id_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

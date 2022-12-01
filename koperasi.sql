-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2022 pada 11.44
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
(1, 1, '2022-12-01 10:28:11', '2023-05-30 06:50:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bunga`
--

CREATE TABLE `tbl_bunga` (
  `id_bunga` int(11) NOT NULL,
  `bunga` int(11) NOT NULL,
  `bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_bunga`
--

INSERT INTO `tbl_bunga` (`id_bunga`, `bunga`, `bulan`) VALUES
(1, 1, 1),
(2, 3, 3),
(3, 8, 6),
(4, 14, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengembalian`
--

CREATE TABLE `tbl_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_konfirmasi_pinjam` int(11) NOT NULL,
  `jumlah_pengembalian` bigint(20) NOT NULL,
  `pengembalian_ke` int(11) NOT NULL,
  `bukti_pengembalian` longtext NOT NULL,
  `tgl_pengembalian` datetime NOT NULL,
  `status_pengembalian` varchar(25) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengembalian`
--

INSERT INTO `tbl_pengembalian` (`id_pengembalian`, `id_konfirmasi_pinjam`, `jumlah_pengembalian`, `pengembalian_ke`, `bukti_pengembalian`, `tgl_pengembalian`, `status_pengembalian`) VALUES
(1, 1, 300000, 1, '', '2022-12-01 06:50:37', 'konfirmasi'),
(2, 1, 300000, 1, '', '2022-12-01 06:53:18', 'konfirmasi'),
(3, 1, 300000, 1, '21d2a2a1-e325-4c01-b500-595cc91cec6c_169.jpg', '2022-12-01 06:54:37', 'konfirmasi'),
(4, 1, 300000, 2, '', '2022-12-01 10:25:25', 'konfirmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_bunga` int(11) NOT NULL,
  `jumlah_pinjam` varchar(100) NOT NULL,
  `riba` int(11) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `status_pinjam` varchar(25) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `id_user`, `id_bunga`, `jumlah_pinjam`, `riba`, `tgl_pinjam`, `status_pinjam`) VALUES
(1, 2, 3, '1800000', 800000, '2022-12-01 06:50:00', 'konfirmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_simpan`
--

CREATE TABLE `tbl_simpan` (
  `id_simpan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_simpan` int(11) NOT NULL,
  `bukti_simpan` longtext NOT NULL,
  `tgl_simpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_simpan` varchar(25) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_simpan`
--

INSERT INTO `tbl_simpan` (`id_simpan`, `id_user`, `jumlah_simpan`, `bukti_simpan`, `tgl_simpan`, `status_simpan`) VALUES
(1, 2, 1000000, 'koperasi.sql', '2022-11-30 23:44:56', 'konfirmasi'),
(2, 2, 1000000, 'Jobsheet_Praktek_RPL_XII.pdf', '2022-11-30 23:45:00', 'konfirmasi'),
(3, 2, 1000000, 'Basis_Data_Aufa_Ramadhan_XIIRPL.doc', '2022-11-30 23:45:03', 'konfirmasi'),
(4, 2, 1000000, 'Beige and Black Simple & Modern Project Timeline Presentation (1).pptx', '2022-11-30 23:45:08', 'konfirmasi');

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
(1, 'Aufa Ramadhan', 'aufa@gmail.com', '123', '', '0000-00-00', '', '', '', '081398057408', '', 'admin', '2022-11-28 06:02:31'),
(2, 'Aninda Fitri Litasni', 'aninda@gmail.com', '123', 'Bogor', '2022-11-28', 'Perempuan', 'Islam', 'CEO', '081398057408', 'Cicadas', 'user', '2022-11-28 06:03:22'),
(3, 'Adi Saputra', 'adi@gmail.com', '123', '', '0000-00-00', '', '', '', '08912834123', '', 'user', '2022-11-28 05:49:24'),
(4, 'Albert Enstein', 'albert@gmail.com', '123', '', '0000-00-00', '', '', '', '08972314234', '', 'user', '2022-11-28 05:50:21');

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
-- Indeks untuk tabel `tbl_bunga`
--
ALTER TABLE `tbl_bunga`
  ADD PRIMARY KEY (`id_bunga`);

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
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_bunga` (`id_bunga`);

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
  MODIFY `id_konfirmasi_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_bunga`
--
ALTER TABLE `tbl_bunga`
  MODIFY `id_bunga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  MODIFY `id_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

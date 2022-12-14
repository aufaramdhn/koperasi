-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2023 pada 12.21
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.2.0

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ambil_simpan`
--

CREATE TABLE `tbl_ambil_simpan` (
  `id_ambil_simpan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_simpan` int(11) NOT NULL,
  `ambil_simpan` int(11) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'pending',
  `tgl_ambil` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 2, 1000000, 'pngwing.com (2).png', '2022-12-28 01:54:16', 'pending'),
(2, 2, 1000000, 'pngwing.com (2).png', '2022-12-28 01:59:18', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nik` int(25) NOT NULL,
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

INSERT INTO `tbl_user` (`id_user`, `nik`, `nama`, `email`, `password`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `pekerjaan`, `telp`, `alamat`, `level`, `created_at`) VALUES
(1, 0, 'Aufa Ramadhan', 'aufa@gmail.com', '123', '', '0000-00-00', '', '', '', '081398057408', '', 'admin', '2022-11-28 06:02:31'),
(2, 0, 'Aninda Fitri Litasni', 'aninda@gmail.com', '123', 'Bogor', '2022-11-28', 'Perempuan', 'Islam', 'CEO', '081398057408', 'Cicadas', 'user', '2022-11-28 06:03:22'),
(3, 0, 'Adi Saputra', 'adi@gmail.com', '123', 'Bogor', '0000-00-00', 'Laki-laki', 'Islam', 'CEO', '08912834123', 'GBJ', 'user', '2022-12-28 01:44:12'),
(4, 0, 'Albert Enstein', 'albert@gmail.com', '123', 'Bogor', '0000-00-00', 'Laki-laki', 'Islam', 'CEO', '08972314234', 'GBJ', 'user', '2022-12-28 01:44:15');

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
-- Indeks untuk tabel `tbl_ambil_simpan`
--
ALTER TABLE `tbl_ambil_simpan`
  ADD PRIMARY KEY (`id_ambil_simpan`),
  ADD KEY `id_user` (`id_user`);

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
  MODIFY `id_konfirmasi_pinjam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_ambil_simpan`
--
ALTER TABLE `tbl_ambil_simpan`
  MODIFY `id_ambil_simpan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_bunga`
--
ALTER TABLE `tbl_bunga`
  MODIFY `id_bunga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  MODIFY `id_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `konfirmasi_pinjam`
--
ALTER TABLE `konfirmasi_pinjam`
  ADD CONSTRAINT `konfirmasi_pinjam_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `tbl_pinjam` (`id_pinjam`);

--
-- Ketidakleluasaan untuk tabel `tbl_ambil_simpan`
--
ALTER TABLE `tbl_ambil_simpan`
  ADD CONSTRAINT `tbl_ambil_simpan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD CONSTRAINT `tbl_pengembalian_ibfk_1` FOREIGN KEY (`id_konfirmasi_pinjam`) REFERENCES `konfirmasi_pinjam` (`id_konfirmasi_pinjam`);

--
-- Ketidakleluasaan untuk tabel `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD CONSTRAINT `tbl_pinjam_ibfk_1` FOREIGN KEY (`id_bunga`) REFERENCES `tbl_bunga` (`id_bunga`),
  ADD CONSTRAINT `tbl_pinjam_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  ADD CONSTRAINT `tbl_simpan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

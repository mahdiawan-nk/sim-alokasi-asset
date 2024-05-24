-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Bulan Mei 2024 pada 09.28
-- Versi server: 8.0.30
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app-bps`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `level` int NOT NULL COMMENT '1:admin 2:petugas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`, `level`) VALUES
(1, 'Administrators', 'admins@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(5, 'operator', 'operator@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int NOT NULL,
  `nik` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi_kerja` int NOT NULL,
  `jabatan` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `departement` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `hapus` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komputer`
--

CREATE TABLE `komputer` (
  `id` int NOT NULL,
  `type` enum('LAPTOP','DESKTOP') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `serial_number` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` int NOT NULL,
  `hapus` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komputer_transaksi`
--

CREATE TABLE `komputer_transaksi` (
  `id` int NOT NULL,
  `id_komputer` int NOT NULL,
  `karyawan_id` int NOT NULL,
  `waktu_pemakaian` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `file_ba` varchar(120) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int NOT NULL,
  `lokasi` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `hapus` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `phone`
--

CREATE TABLE `phone` (
  `id` int NOT NULL,
  `ext` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `serial_number` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `mac_address` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` int NOT NULL,
  `hapus` int NOT NULL DEFAULT '0',
  `type` varchar(15) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `phone_transaksi`
--

CREATE TABLE `phone_transaksi` (
  `id` int NOT NULL,
  `id_phone` int NOT NULL,
  `karyawan_id` int NOT NULL,
  `waktu_pemakaian` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_ba` varchar(120) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `radio`
--

CREATE TABLE `radio` (
  `id` int NOT NULL,
  `kode_id` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `reg_perangkat` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `brand_name` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `model_radio` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `type_radio` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` int NOT NULL,
  `detail_lokasi` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `hapus` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `radio_transaksi`
--

CREATE TABLE `radio_transaksi` (
  `id` int NOT NULL,
  `id_radio` int NOT NULL,
  `karyawan_id` int NOT NULL,
  `waktu_pemakaian` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_ba` varchar(120) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komputer`
--
ALTER TABLE `komputer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komputer_transaksi`
--
ALTER TABLE `komputer_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `phone_transaksi`
--
ALTER TABLE `phone_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `radio`
--
ALTER TABLE `radio`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `radio_transaksi`
--
ALTER TABLE `radio_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `komputer`
--
ALTER TABLE `komputer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `komputer_transaksi`
--
ALTER TABLE `komputer_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `phone_transaksi`
--
ALTER TABLE `phone_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `radio`
--
ALTER TABLE `radio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `radio_transaksi`
--
ALTER TABLE `radio_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

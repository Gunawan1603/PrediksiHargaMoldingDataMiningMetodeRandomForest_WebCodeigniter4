-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Waktu pembuatan: 10 Des 2023 pada 17.48
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_ngproduksi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `iuran`
--

CREATE TABLE `iuran` (
  `idIuran` int(11) NOT NULL,
  `idKaryawan` int(11) NOT NULL,
  `keterangan` tinytext NOT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `iuran`
--

INSERT INTO `iuran` (`idIuran`, `idKaryawan`, `keterangan`, `tanggal`, `bulan`, `tahun`, `jumlah`) VALUES
(1, 1, 'Bayar Bulan Februari', 2, 1, 2022, '120000'),
(2, 1, 'Bayaarr April', 7, 4, 2022, '200000'),
(4, 14, 'sdfsd', 12, 7, 2022, '300100');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `idKaryawan` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `namaKaryawan` varchar(200) NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `alamat` tinytext NOT NULL,
  `noHp` varchar(15) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`idKaryawan`, `nik`, `namaKaryawan`, `kelamin`, `alamat`, `noHp`, `status`) VALUES
(0, '123456', 'Samsul', 'L', 'Jl. Teratai 9', '08119288777', 0),
(11, '99131201003', 'Rega', 'L', 'Jl. Sulawesi', '003', 1),
(15, '99131201007', 'Iswati', 'P', 'Jl. Sulawesi', '007', 1),
(16, '99131201008', 'Setiawan', 'L', 'Jl. Kamboja', '008', 1),
(19, '99131201011', 'Gunawam', 'L', 'Jl. teratai', '08111928091', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ngproduk`
--

CREATE TABLE `ngproduk` (
  `idProduk` varchar(50) NOT NULL,
  `qty` int(20) NOT NULL,
  `ng` varchar(50) NOT NULL,
  `namapelapor` varchar(200) NOT NULL,
  `bagian` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idProduk` int(11) NOT NULL,
  `kodeproduk` varchar(2) NOT NULL,
  `noproduk` varchar(50) NOT NULL,
  `model` varchar(20) NOT NULL,
  `namaproduk` varchar(50) NOT NULL,
  `customer` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idProduk`, `kodeproduk`, `noproduk`, `model`, `namaproduk`, `customer`) VALUES
(1, 'PJ', '4183', 'GLEE', 'HOLDER HARDNESS OPT', 'EPSON-TENMA'),
(2, 'PJ', '4266', 'KAWAI', 'CHASIS', 'HONORIS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(200) DEFAULT NULL,
  `user_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_created_at`, `role`) VALUES
(2, 'bagus', 'bagus@mail.com', '$2y$10$TMxGhxMRDhBYz/iaz9jeiOBJVaSVG9OobWIb4HMmI/flZHH3YPjd2', '2023-11-25 18:14:15', 'user'),
(13, 'gunawan', 'gunawan@mail.com', '$2y$10$L3iTp1e6s7hh/w3t2/6N3eR/oI.KJ8u0LuX2V/r.c5siJAC3JRi5i', '2023-12-10 14:55:41', 'admin'),
(14, 'rudi', 'rudi@mail.com', '$2y$10$iDgU5mxj3iSo5qHDqlGi4e6iWUAWeNi1lfbYE6OcesR/laBMwtEbe', '2023-12-10 15:08:53', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `iuran`
--
ALTER TABLE `iuran`
  ADD PRIMARY KEY (`idIuran`),
  ADD KEY `idKaryawan` (`idKaryawan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`idKaryawan`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idProduk`),
  ADD UNIQUE KEY `noproduk` (`noproduk`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `iuran`
--
ALTER TABLE `iuran`
  MODIFY `idIuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `idProduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

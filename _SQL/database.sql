-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jul 2022 pada 02.17
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
-- Database: `project_famgath`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pin`
--

CREATE TABLE `pin` (
  `id` int(11) NOT NULL,
  `lng` text NOT NULL,
  `lnt` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pin`
--

INSERT INTO `pin` (`id`, `lng`, `lnt`, `nama`, `user_name`) VALUES
(4, '110.36272552885475', '-7.774177503960388', 'Test Lokasi Dulu!', 'xxx'),
(5, '110.32410171904127', '-7.769755306521986', 'x', 'xxx'),
(7, '110.38469818510583', '-7.785913109638017', 'KampusKoe', 'user'),
(8, '110.35963562407034', '-7.805471721836753', 'RumahSiA', 'user'),
(9, '110.35225418486112', '-7.796627940842512', 'New Home', 'redok'),
(10, '110.35482696288972', '-7.779824239061753', 'New Maker', 'user'),
(12, '110.31980804199156', '-7.778463586201369', 'NewTest', 'user'),
(13, '110.4032354711897', '-7.788668375014268', 'Lasto', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'user', '$2y$10$F3fq5sBloxOlu8PnZ/Hi6ePNFm0aC1dj.01PVCbR23Q0KjnnkTRaO'),
(2, 'redok', '$2y$10$oLJB1sQrw8jIDK5V7rbtV.6iOoNm1EVtcZnihoGaKU9Lls1bzZCnC'),
(4, 'x', '$2y$10$Dtu8sNAgDS56/guOXZiAs.EWobSALa7gPaBYcriRrM7sjmvVDzfya');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pin`
--
ALTER TABLE `pin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pin`
--
ALTER TABLE `pin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

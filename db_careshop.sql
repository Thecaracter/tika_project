-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2023 pada 02.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_careshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `customerid` int(15) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `phone_number` double DEFAULT NULL,
  `role` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`customerid`, `name`, `username`, `email`, `password`, `phone_number`, `role`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$kHtgzAn2EqHaJEEF3oqfOuEyks36ps.VDF7rQVgrEloJxmviyxZYy', 8883662780, 1),
(2, 'anjay', 'anjay', 'anjay@gmail.com', '$2y$10$jEtFtBGU8lEFllbksuEB..X4SH7JjRxwA2Wxt/QSWPtTcqyerhQUG', 8831278123, 2),
(3, 'rizqi', 'rizqi', 'rizqi@gmail.com', '$2y$10$Ch.DojINv3NONfmChRt7R.sCs3adi3R/0FXbzsTSHhchtkdU2Vn/6', 8883662780, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_order`
--

CREATE TABLE `detail_order` (
  `id_detailorder` int(11) NOT NULL,
  `orderid` varchar(15) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_order`
--

INSERT INTO `detail_order` (`id_detailorder`, `orderid`, `produk_id`, `jumlah`) VALUES
(18, 'ODR0001', 8, 2),
(19, 'ODR0004', 8, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(15) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `name`) VALUES
(1, 'food'),
(2, 'care');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `order_id` varchar(15) NOT NULL,
  `orderdate` date DEFAULT NULL,
  `customerid` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `total_bayar` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`order_id`, `orderdate`, `customerid`, `alamat`, `total_bayar`) VALUES
('ODR0001', '2023-12-11', 2, 'jl mantap', 100000),
('ODR0003', '2023-12-11', 3, 'jl mantap', 100000),
('ODR0004', '2023-12-11', 3, 'jl mantap', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(15) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `harga` int(15) DEFAULT NULL,
  `kategori_id` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`produk_id`, `name`, `harga`, `kategori_id`) VALUES
(8, 'pakan kucing', 50000, 1),
(9, 'anjay', 50000, 2),
(19, 'asa', 60000, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indeks untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id_detailorder`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `orderid` (`orderid`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customerid` (`customerid`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id_detailorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `detail_order_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`produk_id`),
  ADD CONSTRAINT `detail_order_ibfk_3` FOREIGN KEY (`orderid`) REFERENCES `order` (`order_id`);

--
-- Ketidakleluasaan untuk tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_3` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

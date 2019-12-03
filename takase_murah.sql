-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2019 at 01:27 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `takase_murah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(2, 'admin', '$2y$10$c/s4BfSI8sg7/Xb6Rr0ktOlHwECrf3DrtAktMuCV.KqCrbcPZbv0u', 'admin baru'),
(3, 'nama', '$2y$10$.CugYA.4ttqGjP8g4y9VQe9gObILDWfPHX2JH1eGBgntoufamAHxe', 'nama lengkap');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(255) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Manado', 20000),
(2, 'Bitung', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telp_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telp_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'sarifudin@gamil.com', 'sarifudin', 'sarifudin abjul', '082291204493', ''),
(2, 'ramadan@gmail.com', 'password', 'Ramadan abjul', '08123123123', 'Boroko timur Dusun III kecamatan Kaidipang, kabupaten bolaang Mongondow utara'),
(4, 'murcun@gmail.com', '123', 'murcun', '08123456789', 'boroko timur dusun 2 bolugo '),
(5, 'nia@gmail.com', '123', 'nia', '00989', 'boroko dusun 3');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `foto_bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `foto_bukti`) VALUES
(22, 53, 'sarifudin', 'BNI', 620000, '2019-12-01', '5de2ba4d1d8be-01122019.jpg'),
(23, 67, 'nia', 'bca', 100000, '2019-12-03', '5de53f44a9cde-03122019.jpg'),
(24, 69, 'sarifudin', 'bank', 720000, '03-12-2019/01:10:55', '5de5459fdbc6a-03122019.jpeg'),
(25, 70, 'sarif', 'bri', 1220000, '03-12-2019/01:15:43', '5de546bf13e92-03122019.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(59, 4, 1, '2019-11-30', 1070000, 'Manado', 20000, 'murcun punya ini ', 'pending', ''),
(60, 4, 2, '2019-11-30', 475000, 'Bitung', 25000, 'bitung', 'pending', ''),
(61, 4, 1, '2019-11-30', 1320000, 'Manado', 20000, 'boroko timur dusun III', 'LUNAS', ''),
(62, 4, 1, '2019-12-01', 620000, 'Manado', 20000, 'Jl.sarion nommor 123', 'LUNAS', ''),
(63, 2, 2, '2019-12-01', 1225000, 'Bitung', 25000, 'JL.wangurer', 'LUNAS', ''),
(67, 5, 1, '2019-12-03', 620000, 'Manado', 20000, 'asasd', 'LUNAS', 'satudua123'),
(68, 5, 1, '2019-12-03', 620000, 'Manado', 20000, 'okeoke', 'LUNAS', ''),
(69, 1, 1, '2019-12-03', 720000, 'Manado', 20000, 'boroko city', 'LUNAS', 'ASDF123'),
(70, 1, 1, '2019-12-03', 1220000, 'Manado', 20000, 'manado city', 'barang dikirim', 'FDSA123');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `nama`, `harga`, `berat`, `subberat`, `subharga`, `jumlah`) VALUES
(60, 58, 24, 'Sepatu 2', 450000, 10000, 10000, 450000, 1),
(61, 0, 23, 'Sepatu 1', 600000, 100, 200, 1200000, 2),
(62, 59, 23, 'Sepatu 1', 600000, 100, 100, 600000, 1),
(63, 59, 24, 'Sepatu 2', 450000, 10000, 10000, 450000, 1),
(64, 0, 26, 'Sepatu 4', 750000, 150, 150, 750000, 1),
(65, 60, 24, 'Sepatu 2', 450000, 10000, 10000, 450000, 1),
(66, 61, 25, 'Sepatu 3', 650000, 100, 200, 1300000, 2),
(67, 62, 23, 'Sepatu 1', 600000, 100, 100, 600000, 1),
(68, 63, 23, 'Sepatu 1', 600000, 100, 200, 1200000, 2),
(69, 64, 25, 'Sepatu 3', 650000, 100, 200, 1300000, 2),
(70, 65, 24, 'Sepatu 2', 450000, 10000, 30000, 1350000, 3),
(71, 66, 27, 'sepatu 5', 200000, 100, 100, 200000, 1),
(72, 0, 23, 'Sepatu 1', 600000, 100, 100, 600000, 1),
(73, 0, 28, 'Sepatu 6', 400000, 100, 100, 400000, 1),
(74, 0, 23, 'Sepatu 1', 600000, 100, 100, 600000, 1),
(75, 0, 24, 'Sepatu 2', 450000, 10000, 10000, 450000, 1),
(76, 0, 23, 'Sepatu 1', 600000, 100, 100, 600000, 1),
(77, 0, 23, 'Sepatu 1', 600000, 100, 200, 1200000, 2),
(78, 0, 26, 'Sepatu 4', 750000, 150, 150, 750000, 1),
(79, 0, 29, 'Sepatu Tujuh', 300000, 100, 100, 300000, 1),
(80, 67, 23, 'Sepatu 1', 600000, 100, 100, 600000, 1),
(81, 68, 23, 'Sepatu 1', 600000, 100, 100, 600000, 1),
(82, 69, 28, 'Sepatu 6', 400000, 100, 100, 400000, 1),
(83, 69, 29, 'Sepatu Tujuh', 300000, 100, 100, 300000, 1),
(84, 70, 23, 'Sepatu 1', 600000, 100, 200, 1200000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(23, 'Sepatu 1', 600000, 100, '5de524153463b.jpg', 'Sepatu kulit baru harga terjangkau', 3),
(24, 'Sepatu 2', 450000, 10000, '5de5241de2621.jpeg', 'Sepatu Olahraga terbaru ', 1),
(25, 'Sepatu 3', 650000, 100, '5de52426b4a58.jpeg', 'sepatu merek baru', 3),
(26, 'Sepatu 4', 750000, 150, '5de52431124ee.jpg', 'Sepatu kulit asli ', 4),
(27, 'sepatu 5', 200000, 100, '5de5243dcb545.jpg', 'kulit sapi asli', 6),
(28, 'Sepatu 6', 400000, 100, '5de524695d19c.jpg', 'bahan asli kulit nyamuk', 3),
(29, 'Sepatu Tujuh', 300000, 100, '5de5248fbedd2.jpeg', 'barang anti air', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

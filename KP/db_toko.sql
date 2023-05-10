-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 04:19 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga_beli` varchar(255) NOT NULL,
  `harga_jual` varchar(255) NOT NULL,
  `satuan_barang` varchar(255) NOT NULL,
  `stok` text NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `tgl_update` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `id_barang`, `id_kategori`, `nama_barang`, `deskripsi`, `harga_beli`, `harga_jual`, `satuan_barang`, `stok`, `tgl_input`, `tgl_update`) VALUES
(16, 'BR001', 8, 'F1 - French Vanilla', '', '301482', '561000', 'Bottle', '8', '30 December 2022, 21:59', '6 January 2023, 21:02'),
(17, 'BR002', 8, 'F1 - Cookies &amp; Cream', '', '301482', '561000', 'Bottle', '8', '30 December 2022, 22:00', '6 January 2023, 21:02'),
(18, 'BR003', 8, 'F1 - Dutch Chocolate', '', '301482', '561000', 'Bottle', '7', '30 December 2022, 22:01', '5 January 2023, 0:36'),
(20, 'BR004', 8, 'F1 - Mint Chocolate', '', '301482', '561000', 'Bottle', '7', '4 January 2023, 23:18', '5 January 2023, 0:36'),
(21, 'BR005', 8, 'F1 - Wild Berry', '', '301482', '561000', 'Bottle', '8', '4 January 2023, 23:20', '19 January 2023, 5:11'),
(24, 'BR006', 9, 'whey protein 12lbs ', '', '1000000', '1300000', 'kaleng', '12', '19 January 2023, 9:31', NULL),
(25, 'BR007', 12, 'F1 - Dutch Chocolate 500gr', '', '432222', '866544', 'kaleng', '12', '24 January 2023, 15:25', '30 January 2023, 12:34'),
(26, 'BR008', 8, 'F1 - French Brown Sugar', '', '799866', '808876', 'Bottle', '12', '31 January 2023, 14:49', NULL),
(27, 'BR009', 9, 'F1 - French Vanillas', 'rasa vanila enak banget', '20000', '30000', 'Bottle', '10', '31 January 2023, 15:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `tgl_input`) VALUES
(8, 'F1-Formula 11', '30 December 2022, 15:17'),
(9, 'Protein Powder', '30 December 2022, 15:17'),
(10, 'Perawatan Tubuh', '30 December 2022, 15:20'),
(11, 'Rangkaian Produk Teh', '30 December 2022, 19:40'),
(12, 'Nutrisi Sesuai Target', '30 December 2022, 19:41'),
(13, 'Herbal Aloe', '30 December 2022, 19:41'),
(14, 'Produk Kaya Serat', '30 December 2022, 19:41'),
(15, 'Herballife Skin', '30 December 2022, 19:42');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `id_member` varchar(10) NOT NULL,
  `nm_member` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `alamat_member` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `NIK` text NOT NULL,
  `leveljabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `id_member`, `nm_member`, `username`, `pass`, `alamat_member`, `telepon`, `email`, `NIK`, `leveljabatan`) VALUES
(1, 'UR001', 'anto', 'admin', '123', 'surabaya', '089618173609', 'admin@gmail.com', '12314121', 'admin'),
(2, 'UR002', 'budi', 'kasir', '1234', 'surabaya', '08328472982', 'kasir@gmail.com', '2029384', 'kasir'),
(10, 'UR003', 'yanti', 'manager', '12345', 'surabaya', '08237642928', 'manager@gmail.com', '123948749', 'manager'),
(12, 'UR004', 'Reynaldi Julianto', 'reynaldi', '11111', 'Sambongan IV/11', '2312321424', 'reynaldijulianto18@gmail.com', '2313132', 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id` int(11) NOT NULL,
  `id_nota` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_member` varchar(20) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL,
  `periode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id`, `id_nota`, `id_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`, `periode`) VALUES
(8, 'N001', 'BR001', 'UR002', '1', '561000', '18 January 2023, 14:36', '01-2023'),
(9, 'N001', 'BR003', 'UR002', '1', '561000', '18 January 2023, 14:36', '01-2023'),
(10, 'N002', 'BR004', 'UR002', '1', '561000', '18 January 2023, 14:39', '01-2023'),
(11, 'N002', 'BR005', 'UR002', '1', '561000', '18 January 2023, 14:39', '01-2023'),
(12, 'N003', 'BR002', 'UR002', '1', '561000', '18 January 2023, 17:40', '01-2023'),
(13, 'N003', 'BR005', 'UR002', '1', '561000', '18 January 2023, 17:40', '01-2023'),
(15, 'N004', 'BR004', 'UR002', '1', '561000', '19 January 2023, 3:02', '01-2023'),
(16, 'N005', 'BR005', 'UR004', '2', '1122000', '19 January 2023, 3:04', '01-2023'),
(17, 'N005', 'BR003', 'UR004', '1', '561000', '19 January 2023, 3:04', '01-2023'),
(18, 'N006', 'BR002', 'UR002', '1', '561000', '19 January 2023, 3:08', '01-2023'),
(19, 'N007', 'BR002', 'UR002', '1', '561000', '19 January 2023, 3:08', '01-2023'),
(20, 'N008', 'BR002', 'UR002', '1', '561000', '19 January 2023, 3:08', '01-2023'),
(21, 'N009', 'BR001', 'UR002', '1', '561000', '19 January 2023, 3:38', '01-2023'),
(22, 'N010', 'BR005', 'UR002', '1', '561000', '19 January 2023, 8:38', '01-2023'),
(23, 'N011', 'BR005', 'UR002', '1', '561000', '19 January 2023, 8:38', '01-2023'),
(24, 'N012', 'BR005', 'UR002', '1', '561000', '19 January 2023, 8:38', '01-2023'),
(25, 'N013', 'BR005', 'UR002', '1', '561000', '19 January 2023, 8:38', '01-2023'),
(26, 'N014', 'BR003', 'UR002', '1', '561000', '19 January 2023, 8:57', '01-2023'),
(27, 'N015', 'BR003', 'UR002', '1', '561000', '19 January 2023, 9:01', '01-2023'),
(28, 'N016', 'BR001', 'UR002', '1', '561000', '19 January 2023, 9:25', '01-2023'),
(29, 'N017', 'BR006', 'UR002', '1', '1300000', '19 January 2023, 9:32', '01-2023'),
(30, 'N018', 'BR006', 'UR002', '2', '2600000', '19 January 2023, 9:41', '01-2023'),
(31, 'N019', 'BR006', 'UR002', '1', '1300000', '19 January 2023, 9:44', '01-2023'),
(32, 'N020', 'BR006', 'UR002', '1', '1300000', '19 January 2023, 9:46', '01-2023'),
(33, 'N021', 'BR006', 'UR002', '1', '1300000', '19 January 2023, 9:46', '01-2023'),
(34, 'N022', 'BR006', 'UR002', '1', '1300000', '19 January 2023, 9:57', '01-2023'),
(35, 'N023', 'BR004', 'UR002', '1', '561000', '19 January 2023, 9:58', '01-2023'),
(36, 'N023', 'BR006', 'UR002', '1', '1300000', '19 January 2023, 9:58', '01-2023');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_member` varchar(20) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`) VALUES
(156, 'BR003', 'UR002', '1', '561000', '1 February 2023, 11:43');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL,
  `tlp` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `tlp`, `nama_pemilik`, `image`) VALUES
(1, 'KLUB NUTRISI', 'Babatan Mukti C-16', '081803278585', 'Atma Yudha Sandi', 'assets\\img\\kp.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`) USING HASH;

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

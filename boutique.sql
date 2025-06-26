-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 10:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boutique`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `Id_Inventaris` int(11) NOT NULL,
  `Id_Produk` int(11) NOT NULL,
  `Kuantitas_Produk` int(11) NOT NULL,
  `Tanggal_Masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`Id_Inventaris`, `Id_Produk`, `Kuantitas_Produk`, `Tanggal_Masuk`) VALUES
(1, 1, 150, '2025-06-26'),
(2, 2, 50, '2024-01-15'),
(3, 3, 30, '2024-01-20'),
(4, 4, 20, '2024-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `Id_Karyawan` int(11) NOT NULL,
  `Nama_Karyawan` varchar(100) NOT NULL,
  `Nomor_Telepon` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`Id_Karyawan`, `Nama_Karyawan`, `Nomor_Telepon`, `Email`, `Alamat`) VALUES
(1, 'Sari Lestari', '081298765432', 'sari.lestari@example.com', 'Jl. Mawar No. 20, Jakarta'),
(2, 'Agus Haryanto', '082198765432', 'agus.haryanto@example.com', 'Jl. Anggrek No. 12, Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `Id_MetodePembayaran` int(11) NOT NULL,
  `Nama_Metode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`Id_MetodePembayaran`, `Nama_Metode`) VALUES
(1, 'Tunai'),
(2, 'Transfer Bank'),
(3, 'E-Wallet');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `Id_Customer` int(11) NOT NULL,
  `Nama_Customer` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Nomor_Telepon` varchar(20) DEFAULT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`Id_Customer`, `Nama_Customer`, `Email`, `Nomor_Telepon`, `Alamat`) VALUES
(1, 'Ani Wijaya', 'ani.wijaya@example.com', '081234567890', 'Jl. Melati No. 15, Jakarta'),
(2, 'Budi Santoso', 'budi.santoso@example.com', '082345678901', 'Jl. Kenanga No. 8, Bandung'),
(3, 'Djoko sambung', 'Djoko@gmail.com', '08123423453', 'Jalan Rumah Setan no 10');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `Id_Produk` int(11) NOT NULL,
  `Nama_Produk` varchar(100) NOT NULL,
  `Id_size` int(11) DEFAULT NULL,
  `Id_Supplier` int(11) DEFAULT NULL,
  `Harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`Id_Produk`, `Nama_Produk`, `Id_size`, `Id_Supplier`, `Harga`) VALUES
(1, 'Kaos Polos Putih', 2, 1, 80000.00),
(2, 'Kemeja Batik', 3, 2, 250000.00),
(3, 'Jaket Denim', 4, 1, 350000.00),
(4, 'Gaun Pesta', 3, 2, 450000.00);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `Id_size` int(11) NOT NULL,
  `Size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`Id_size`, `Size`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Id_Supplier` int(11) NOT NULL,
  `Nama_Supplier` varchar(100) NOT NULL,
  `Nomor_Telepon` varchar(20) DEFAULT NULL,
  `Email_Perusahaan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Id_Supplier`, `Nama_Supplier`, `Nomor_Telepon`, `Email_Perusahaan`) VALUES
(1, 'PT Busana Jaya', '021-5551234', 'contact@busanajaya.co.id'),
(2, 'CV Fashionindo', '021-5559876', 'info@fashionindo.com');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `Id_Transaksi` int(11) NOT NULL,
  `Tanggal_Transaksi` date NOT NULL,
  `Nama_Customer` varchar(100) DEFAULT NULL,
  `No_Telp` varchar(30) DEFAULT NULL,
  `Id_Customer` int(11) DEFAULT NULL,
  `Id_MetodePembayaran` int(11) NOT NULL,
  `Id_Karyawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`Id_Transaksi`, `Tanggal_Transaksi`, `Nama_Customer`, `No_Telp`, `Id_Customer`, `Id_MetodePembayaran`, `Id_Karyawan`) VALUES
(9, '2025-06-26', 'jawa', '4575686796', NULL, 2, 1),
(10, '2025-06-26', NULL, NULL, 3, 2, 2),
(11, '2025-06-26', 'ad', '356456454', NULL, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `Id_Detail` int(11) NOT NULL,
  `Id_Transaksi` int(11) NOT NULL,
  `Id_Produk` int(11) NOT NULL,
  `Id_Size` int(11) DEFAULT NULL,
  `Jumlah_Produk` int(11) NOT NULL,
  `Harga_Satuan` decimal(12,2) NOT NULL,
  `Subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`Id_Detail`, `Id_Transaksi`, `Id_Produk`, `Id_Size`, `Jumlah_Produk`, `Harga_Satuan`, `Subtotal`) VALUES
(12, 10, 4, 2, 1, 450000.00, 450000.00),
(13, 10, 2, 4, 13, 250000.00, 3250000.00),
(14, 11, 4, 3, 1, 450000.00, 450000.00);

-- --------------------------------------------------------

--
-- Table structure for table `username`
--

CREATE TABLE `username` (
  `Id_user` int(11) NOT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `username`
--

INSERT INTO `username` (`Id_user`, `Username`, `Password`) VALUES
(1, 'Admin', 'Admin#1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`Id_Inventaris`),
  ADD KEY `Id_Produk` (`Id_Produk`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`Id_Karyawan`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`Id_MetodePembayaran`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`Id_Customer`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`Id_Produk`),
  ADD KEY `Id_size` (`Id_size`),
  ADD KEY `Id_Supplier` (`Id_Supplier`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`Id_size`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Id_Supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`Id_Transaksi`),
  ADD KEY `Id_Customer` (`Id_Customer`),
  ADD KEY `Id_MetodePembayaran` (`Id_MetodePembayaran`),
  ADD KEY `Id_Karyawan` (`Id_Karyawan`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`Id_Detail`),
  ADD KEY `Id_Transaksi` (`Id_Transaksi`),
  ADD KEY `Id_Produk` (`Id_Produk`),
  ADD KEY `fk_size` (`Id_Size`);

--
-- Indexes for table `username`
--
ALTER TABLE `username`
  ADD PRIMARY KEY (`Id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `Id_Inventaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `Id_Karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `Id_MetodePembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `Id_Customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `Id_Produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `Id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `Id_Supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `Id_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `Id_Detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `username`
--
ALTER TABLE `username`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `inventaris_ibfk_1` FOREIGN KEY (`Id_Produk`) REFERENCES `produk` (`Id_Produk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`Id_size`) REFERENCES `size` (`Id_size`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`Id_Supplier`) REFERENCES `supplier` (`Id_Supplier`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`Id_Customer`) REFERENCES `pelanggan` (`Id_Customer`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`Id_MetodePembayaran`) REFERENCES `metode_pembayaran` (`Id_MetodePembayaran`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`Id_Karyawan`) REFERENCES `karyawan` (`Id_Karyawan`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `fk_size` FOREIGN KEY (`Id_Size`) REFERENCES `size` (`Id_size`),
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`Id_Transaksi`) REFERENCES `transaksi` (`Id_Transaksi`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`Id_Produk`) REFERENCES `produk` (`Id_Produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

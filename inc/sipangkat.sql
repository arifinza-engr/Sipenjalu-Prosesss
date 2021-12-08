-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 01:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipangkat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis`
--

INSERT INTO `tb_jenis` (`id_jenis`, `jenis`) VALUES
(3, 'Perbaikan Lampu Jalan'),
(6, 'Penambahan Lampu Jalan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengadu`
--

CREATE TABLE `tb_pengadu` (
  `id_pengadu` varchar(50) NOT NULL,
  `nama_pengadu` varchar(30) NOT NULL,
  `jekel` enum('Laki-Laki','Perempuan') NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengadu`
--

INSERT INTO `tb_pengadu` (`id_pengadu`, `nama_pengadu`, `jekel`, `no_hp`, `alamat`) VALUES
('111fae3b-cce3-4ce9-b115-6f31717826cc', 'Masyarakat', 'Laki-Laki', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaduan`
--

CREATE TABLE `tb_pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `no_telpon` varchar(100) NOT NULL,
  `jenis` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(300) NOT NULL,
  `waktu_aduan` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Proses',
  `tanggapan` text DEFAULT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengaduan`
--

INSERT INTO `tb_pengaduan` (`id_pengaduan`, `judul`, `no_telpon`, `jenis`, `alamat`, `keterangan`, `foto`, `waktu_aduan`, `status`, `tanggapan`, `author`) VALUES
(17, 'Poni', '0821813645164', 6, 'Jl. Manunggo no. 25, Beji, Pemalang', 'Disini gelap, sering terjadi kecelakaan', 'DARK_evil_horror_spooky_creepy_scary_2560x1600.jpg', '2021-11-28 18:33:45', 'Proses', NULL, '111fae3b-cce3-4ce9-b115-6f31717826cc'),
(18, 'Warni', '087789987653', 3, 'Jl. Purbaya no. 25, Surajaya, Pemalang', 'Butuh perbaikan lampu', '727047.png', '2021-11-28 18:45:26', 'Selesai', 'selesai kami perbaiki', '111fae3b-cce3-4ce9-b115-6f31717826cc'),
(19, 'Starlast', '0895676543454', 3, 'Jl. Manunggo no. 25, Wanarejan, Pemalang', 'Lampu jalan mati dari 2 hari yang lalu', 'dragonball_w3840_h1080_cw3840_ch1080.png', '2021-11-29 23:40:19', 'Proses', NULL, '111fae3b-cce3-4ce9-b115-6f31717826cc'),
(25, 'Sasa', '08767443243315', 3, 'Jl. Santadiharja no. 23, Sewaka, Pemalang', 'segeraaa', '90279.jpg', '2021-12-07 16:40:14', 'Proses', NULL, '111fae3b-cce3-4ce9-b115-6f31717826cc'),
(31, 'Sonia', '0897545466311', 3, 'Jl. Manunggo no. 25, Sungapan, Taman', 'segeraa', 'macOS.jpg', '2021-12-08 06:26:54', 'Proses', NULL, '111fae3b-cce3-4ce9-b115-6f31717826cc');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` varchar(50) NOT NULL,
  `nama_pengguna` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('Administrator','Petugas','Pengadu') NOT NULL DEFAULT 'Pengadu',
  `grup` enum('A','B') NOT NULL DEFAULT 'B'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`, `grup`) VALUES
('111fae3b-cce3-4ce9-b115-6f31717826cc', 'Masyarakat', 'pengadu', '123', 'Pengadu', 'B'),
('5351949a-6598-11eb-96e0-60eb69a13690', 'Reffrains', 'petugas', '123', 'Petugas', 'A'),
('766b07b7-658e-11eb-96e0-60eb69a13690', 'Finza', 'admin', '123', 'Administrator', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tb_telegram`
--

CREATE TABLE `tb_telegram` (
  `id_telegram` varchar(5) NOT NULL,
  `user` varchar(20) NOT NULL,
  `id_chat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_telegram`
--

INSERT INTO `tb_telegram` (`id_telegram`, `user`, `id_chat`) VALUES
('tL9', 'Akun Telegram Admin', '974984241');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `tb_pengadu`
--
ALTER TABLE `tb_pengadu`
  ADD PRIMARY KEY (`id_pengadu`);

--
-- Indexes for table `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `jenis` (`jenis`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tb_telegram`
--
ALTER TABLE `tb_telegram`
  ADD PRIMARY KEY (`id_telegram`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD CONSTRAINT `tb_pengaduan_ibfk_1` FOREIGN KEY (`jenis`) REFERENCES `tb_jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengaduan_ibfk_2` FOREIGN KEY (`author`) REFERENCES `tb_pengadu` (`id_pengadu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

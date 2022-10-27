-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2022 at 11:59 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spio`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id` bigint(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `file_arsip` varchar(255) NOT NULL,
  `tgl_kerjasama` date NOT NULL,
  `tgl_kadaluarsa` date NOT NULL,
  `catatan` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `nip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `arsip`
--
DELIMITER $$
CREATE TRIGGER `after_arsip_insert` AFTER INSERT ON `arsip` FOR EACH ROW BEGIN
INSERT INTO arsip_audit
SET aksi = 'insert',
id = NEW.id,
judul = NEW.judul,
jenis = NEW.jenis,
file_arsip = NEW.file_arsip,
tanggal_audit = NOW(),
tgl_kerjasama = NEW.tgl_kerjasama,
tgl_kadaluarsa = NEW.tgl_kadaluarsa,
catatan = NEW.catatan,
nip = NEW.nip;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_arsip_delete` BEFORE DELETE ON `arsip` FOR EACH ROW BEGIN
INSERT INTO arsip_audit
SET aksi = 'delete',
id = OLD.id,
judul = OLD.judul,
jenis = OLD.jenis,
file_arsip = OLD.file_arsip,
tanggal_audit = NOW(),
tgl_kerjasama = OLD.tgl_kerjasama,
tgl_kadaluarsa = OLD.tgl_kadaluarsa,
catatan = OLD.catatan,
nip = OLD.nip;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `arsip_audit`
--

CREATE TABLE `arsip_audit` (
  `no` bigint(10) NOT NULL,
  `id` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `file_arsip` varchar(255) NOT NULL,
  `tanggal_audit` datetime DEFAULT NULL,
  `tgl_kerjasama` date NOT NULL,
  `tgl_kadaluarsa` date NOT NULL,
  `catatan` text NOT NULL,
  `aksi` varchar(50) DEFAULT NULL,
  `nip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `draft`
--

CREATE TABLE `draft` (
  `id` bigint(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `file_draft` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `catatan` text DEFAULT NULL,
  `id_pemeriksa` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `nip` varchar(255) NOT NULL,
  `id_mitra` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `draft`
--

INSERT INTO `draft` (`id`, `judul`, `jenis`, `file_draft`, `status`, `catatan`, `id_pemeriksa`, `created_at`, `updated_at`, `deleted_at`, `nip`, `id_mitra`) VALUES
(1, 'test', 'MoU', 'jurnal (1).pdf', 'Pending', '', '112022-09-04 01:12:03pm', '2022-09-04', '2022-09-04', NULL, '12323-1', 0);

--
-- Triggers `draft`
--
DELIMITER $$
CREATE TRIGGER `after_draft_insert` AFTER INSERT ON `draft` FOR EACH ROW BEGIN
INSERT INTO draft_audit
SET aksi = 'insert',
id = NEW.id,
judul = NEW.judul,
jenis = NEW.jenis,
tanggal_audit = NOW(),
status = NEW.status,
file_draft = NEW.file_draft,
catatan = NEW.catatan,
id_pemeriksa = NEW.id_pemeriksa,
nip = NEW.nip;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_draft_delete` BEFORE DELETE ON `draft` FOR EACH ROW BEGIN
INSERT INTO draft_audit
SET aksi = 'delete',
id = OLD.id,
judul = OLD.judul,
jenis = OLD.jenis,
tanggal_audit = NOW(),
status = OLD.status,
file_draft = OLD.file_draft,
catatan = OLD.catatan,
id_pemeriksa = OLD.id_pemeriksa,
nip = OLD.nip;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_draft_update` AFTER UPDATE ON `draft` FOR EACH ROW BEGIN 
INSERT INTO draft_audit
SET aksi = 'update',
id = NEW.id,
judul = NEW.judul,
jenis = NEW.jenis,
tanggal_audit = NOW(),
status = NEW.status,
file_draft = NEW.file_draft,
catatan = NEW.catatan,
id_pemeriksa = NEW.id_pemeriksa,
nip = NEW.nip;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `draft_audit`
--

CREATE TABLE `draft_audit` (
  `no` bigint(10) NOT NULL,
  `id` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `file_draft` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `tanggal_audit` datetime DEFAULT NULL,
  `id_pemeriksa` int(10) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `aksi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `draft_audit`
--

INSERT INTO `draft_audit` (`no`, `id`, `judul`, `jenis`, `file_draft`, `catatan`, `status`, `tanggal_audit`, `id_pemeriksa`, `nip`, `aksi`) VALUES
(1, 1, 'test', 'MoU', 'jurnal (1).pdf', '', 'Pending', '2022-09-04 13:12:03', 112022, '12323-1', 'insert');

-- --------------------------------------------------------

--
-- Table structure for table `file_draft`
--

CREATE TABLE `file_draft` (
  `no` bigint(255) NOT NULL,
  `id_file` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history_arsip`
--

CREATE TABLE `history_arsip` (
  `id` bigint(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `file_arsip` varchar(255) NOT NULL,
  `tgl_kerjasama` date NOT NULL,
  `tgl_kadaluarsa` date NOT NULL,
  `catatan` text NOT NULL,
  `created_at` date NOT NULL,
  `nip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history_draft`
--

CREATE TABLE `history_draft` (
  `id` bigint(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `file_draft` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `id_pemeriksa` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `nip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history_pemeriksa`
--

CREATE TABLE `history_pemeriksa` (
  `no` bigint(20) NOT NULL,
  `id_pemeriksa` varchar(255) NOT NULL,
  `status_pemeriksa` varchar(255) NOT NULL,
  `nip_pemeriksa` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tgl_ubah_status` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id` bigint(255) NOT NULL,
  `nama_mitra` varchar(255) NOT NULL,
  `nama_pic` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `jenis_mitra` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `kategori_mitra` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksa`
--

CREATE TABLE `pemeriksa` (
  `no` bigint(20) NOT NULL,
  `id_pemeriksa` varchar(255) NOT NULL,
  `status_pemeriksa` varchar(255) NOT NULL,
  `nip_pemeriksa` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `catatan_pemeriksa` text DEFAULT NULL,
  `tgl_ubah_status` date DEFAULT NULL,
  `roles` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemeriksa`
--

INSERT INTO `pemeriksa` (`no`, `id_pemeriksa`, `status_pemeriksa`, `nip_pemeriksa`, `file`, `catatan_pemeriksa`, `tgl_ubah_status`, `roles`) VALUES
(1, '112022-09-04 01:12:03pm', 'Pending', '12323-10', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jobdesk` varchar(50) NOT NULL,
  `fakultas` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nip`, `nama`, `jenis_kelamin`, `username`, `email`, `password`, `jobdesk`, `fakultas`, `deleted_at`) VALUES
('1', 'Admin', 'Laki-laki', 'admin', 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin', NULL, NULL),
('12323-1', 'spio', 'Laki-laki', 'spio', 'spio@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'SPIO', NULL, NULL),
('12323-10', 'pemeriksa1', 'Laki-laki', 'pemeriksa1', 'pemeriksa1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Pemeriksa', NULL, NULL),
('12323-3', 'dekan', 'Laki-laki', 'dekan', 'dekan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Dekan', 'Fakultas Ilmu Terapan', NULL),
('12323-4', 'adminis', 'Laki-laki', 'adminis', 'adminisitrasi@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrasi', 'Fakultas Ilmu Terapan', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_iduser` (`nip`);

--
-- Indexes for table `arsip_audit`
--
ALTER TABLE `arsip_audit`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `draft`
--
ALTER TABLE `draft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kduser` (`nip`);

--
-- Indexes for table `draft_audit`
--
ALTER TABLE `draft_audit`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `file_draft`
--
ALTER TABLE `file_draft`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `history_arsip`
--
ALTER TABLE `history_arsip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idusers` (`nip`);

--
-- Indexes for table `history_draft`
--
ALTER TABLE `history_draft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kdusers` (`nip`);

--
-- Indexes for table `history_pemeriksa`
--
ALTER TABLE `history_pemeriksa`
  ADD PRIMARY KEY (`no`),
  ADD KEY `fk_nip_pemeriksa` (`nip_pemeriksa`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemeriksa`
--
ALTER TABLE `pemeriksa`
  ADD PRIMARY KEY (`no`),
  ADD KEY `fk_nip` (`nip_pemeriksa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `arsip_audit`
--
ALTER TABLE `arsip_audit`
  MODIFY `no` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `draft`
--
ALTER TABLE `draft`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `draft_audit`
--
ALTER TABLE `draft_audit`
  MODIFY `no` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `file_draft`
--
ALTER TABLE `file_draft`
  MODIFY `no` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_arsip`
--
ALTER TABLE `history_arsip`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_draft`
--
ALTER TABLE `history_draft`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_pemeriksa`
--
ALTER TABLE `history_pemeriksa`
  MODIFY `no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeriksa`
--
ALTER TABLE `pemeriksa`
  MODIFY `no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`nip`) REFERENCES `user` (`nip`);

--
-- Constraints for table `draft`
--
ALTER TABLE `draft`
  ADD CONSTRAINT `fk_kduser` FOREIGN KEY (`nip`) REFERENCES `user` (`nip`);

--
-- Constraints for table `history_arsip`
--
ALTER TABLE `history_arsip`
  ADD CONSTRAINT `fk_idusers` FOREIGN KEY (`nip`) REFERENCES `user` (`nip`);

--
-- Constraints for table `history_draft`
--
ALTER TABLE `history_draft`
  ADD CONSTRAINT `fk_kdusers` FOREIGN KEY (`nip`) REFERENCES `user` (`nip`);

--
-- Constraints for table `history_pemeriksa`
--
ALTER TABLE `history_pemeriksa`
  ADD CONSTRAINT `fk_nip_pemeriksa` FOREIGN KEY (`nip_pemeriksa`) REFERENCES `user` (`nip`);

--
-- Constraints for table `pemeriksa`
--
ALTER TABLE `pemeriksa`
  ADD CONSTRAINT `fk_nip` FOREIGN KEY (`nip_pemeriksa`) REFERENCES `user` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

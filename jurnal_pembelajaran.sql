-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 09:22 PM
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
-- Database: `jurnal_pembelajaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(11) NOT NULL,
  `nama_bulan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nama_bulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_hadir`
--

CREATE TABLE `daftar_hadir` (
  `id_daftar_hadir` int(11) NOT NULL,
  `hari_tanggal` date NOT NULL,
  `nama_siswa` int(11) NOT NULL,
  `nama_kelas` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_hadir`
--

INSERT INTO `daftar_hadir` (`id_daftar_hadir`, `hari_tanggal`, `nama_siswa`, `nama_kelas`, `keterangan`) VALUES
(39, '2025-01-16', 12, 64, 'hadir'),
(40, '2025-01-16', 13, 64, 'sakit'),
(41, '2025-01-16', 14, 64, 'ijin'),
(42, '2025-01-16', 15, 65, 'alpa'),
(43, '2025-01-16', 16, 65, 'alpa');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Admin'),
(2, 'Guru'),
(3, 'Kepala Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_kelas`
--

CREATE TABLE `jurnal_kelas` (
  `jurnal_id` int(11) NOT NULL,
  `nama_kelas` int(11) NOT NULL,
  `hari_tanggal` date NOT NULL,
  `jam_ke` varchar(255) NOT NULL,
  `nama_lengkap` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `uraian_materi` varchar(255) NOT NULL,
  `media_pembelajaran` varchar(255) NOT NULL,
  `keterangan` enum('Selesai','Belum Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurnal_kelas`
--

INSERT INTO `jurnal_kelas` (`jurnal_id`, `nama_kelas`, `hari_tanggal`, `jam_ke`, `nama_lengkap`, `mapel`, `uraian_materi`, `media_pembelajaran`, `keterangan`) VALUES
(49, 64, '2025-01-16', '1-3', 18, 11, 'Huruf Jepang', 'Presentasi', 'Selesai'),
(50, 65, '2025-01-16', '5-6', 18, 11, 'Huruf Jepang', 'Presentasi', 'Belum Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `wali_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `wali_kelas`) VALUES
(64, 'VII A', 18),
(65, 'VII B', 19);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(10, 'Seni Budaya'),
(11, 'Bahasa Jepang');

-- --------------------------------------------------------

--
-- Table structure for table `pembelajaran`
--

CREATE TABLE `pembelajaran` (
  `id_pembelajaran` int(11) NOT NULL,
  `pengguna` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelajaran`
--

INSERT INTO `pembelajaran` (`id_pembelajaran`, `pengguna`, `mapel`, `kelas`) VALUES
(7, 18, 11, 64),
(8, 18, 11, 65),
(9, 19, 10, 64);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nip_nik` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` enum('Admin','Guru','Kepala Sekolah') NOT NULL,
  `ttd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nip_nik`, `nama_lengkap`, `username`, `password`, `jabatan`, `ttd`) VALUES
(17, '1', 'Admin', 'admin', 'admin', 'Admin', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAADICAYAAADGFbfiAAAAAXNSR0IArs4c6QAAFvlJREFUeF7tnXvo/9ccx1+7YHOL3KZso8ilMEWstoZGQ7lkyopcSrYkE9pYDMtsUaxo+4cRMiHzh0tRaLTRckkxURiF3Js7w/fZ9304v/M75/0+7/N5n/flcx7v+u7y/b7P7fE67/M853VuxxgPBCAAAQhAoIDAMQVhCAIBC'),
(18, '123', 'Guru 1', 'g1', 'g1', 'Guru', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAADICAYAAADGFbfiAAAAAXNSR0IArs4c6QAABxZJREFUeF7t1bENAAAIwzD6/9P8kNnsXSyk7BwBAgQIEAgCCxsTAgQIECBwAuIJCBAgQCAJCEhiMyJAgAABAfEDBAgQIJAEBCSxGREgQICAgPgBAgQIEEgCApLYjAgQIEBAQPwAAQIECCQBAUlsRgQIECAgIH6AAAECBJKAg'),
(19, '2', 'Guru 2', 'g2', 'g2', 'Guru', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAADICAYAAADGFbfiAAAAAXNSR0IArs4c6QAABxZJREFUeF7t1bENAAAIwzD6/9P8kNnsXSyk7BwBAgQIEAgCCxsTAgQIECBwAuIJCBAgQCAJCEhiMyJAgAABAfEDBAgQIJAEBCSxGREgQICAgPgBAgQIEEgCApLYjAgQIEBAQPwAAQIECCQBAUlsRgQIECAgIH6AAAECBJKAg'),
(20, '123123', 'Kepala Sekolah', 'ks', 'ks', 'Kepala Sekolah', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAADICAYAAADGFbfiAAAAAXNSR0IArs4c6QAAEEpJREFUeF7t3b2rLVcZB+A3XQqLCCIpLqigaKlgqcSghSCihYVdtFMsFCFYXtMpWMRCsJEkWKhgoYWVwjXgHxAL0ULQEEGFgCmDhXjesBdMJrPP3rPOWfOx5tlwOSd371mz1vOu7N+d78fCiwABAgQIVAg8VrGMRQgQIECAQ');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(255) DEFAULT NULL,
  `alamat_sekolah` varchar(255) DEFAULT NULL,
  `kepala_sekolah` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id`, `nama_sekolah`, `alamat_sekolah`, `kepala_sekolah`, `nip`) VALUES
(1, 'SMP Negeri 14 Pekalongan', 'Jl. Letjend Soeprapto No. 2 Pekalongan, Kertoharjo, Kec. Pekalongan Selatan, Kota Pekalongan', 'Runtut Wijiasih, S.Pd.', '196707031989031010');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` varchar(255) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn`, `nis`, `nama_siswa`, `kelas`) VALUES
(12, '1111', '1111', 'AAAA', 64),
(13, '2222', '2222', 'BBBB', 64),
(14, '3333', '3333', 'CCCC', 64),
(15, '123123', '123', 'QQQQ', 65),
(16, '321321', '321', 'WWWW', 65);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `daftar_hadir`
--
ALTER TABLE `daftar_hadir`
  ADD PRIMARY KEY (`id_daftar_hadir`),
  ADD KEY `fk_6` (`nama_kelas`),
  ADD KEY `fk_7` (`nama_siswa`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jurnal_kelas`
--
ALTER TABLE `jurnal_kelas`
  ADD PRIMARY KEY (`jurnal_id`),
  ADD KEY `fk_8` (`nama_kelas`),
  ADD KEY `fk_9` (`mapel`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `fk_1` (`wali_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `pembelajaran`
--
ALTER TABLE `pembelajaran`
  ADD PRIMARY KEY (`id_pembelajaran`),
  ADD KEY `fk_3` (`kelas`),
  ADD KEY `fk_4` (`mapel`),
  ADD KEY `fk_5` (`pengguna`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`) USING BTREE;

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `fk_2` (`kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_hadir`
--
ALTER TABLE `daftar_hadir`
  MODIFY `id_daftar_hadir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurnal_kelas`
--
ALTER TABLE `jurnal_kelas`
  MODIFY `jurnal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembelajaran`
--
ALTER TABLE `pembelajaran`
  MODIFY `id_pembelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_hadir`
--
ALTER TABLE `daftar_hadir`
  ADD CONSTRAINT `fk_6` FOREIGN KEY (`nama_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `fk_7` FOREIGN KEY (`nama_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `jurnal_kelas`
--
ALTER TABLE `jurnal_kelas`
  ADD CONSTRAINT `fk_8` FOREIGN KEY (`nama_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `fk_9` FOREIGN KEY (`mapel`) REFERENCES `mapel` (`id_mapel`);

--
-- Constraints for table `pembelajaran`
--
ALTER TABLE `pembelajaran`
  ADD CONSTRAINT `fk_3` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `fk_4` FOREIGN KEY (`mapel`) REFERENCES `mapel` (`id_mapel`),
  ADD CONSTRAINT `fk_5` FOREIGN KEY (`pengguna`) REFERENCES `pengguna` (`id_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

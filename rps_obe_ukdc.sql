-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2026 at 10:50 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rps_obe_ukdc`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_kajian`
--

CREATE TABLE `bahan_kajian` (
  `id` bigint NOT NULL,
  `kode_bahan_kajian` varchar(20) DEFAULT NULL,
  `nama_bahan_kajian` varchar(150) DEFAULT NULL,
  `deskripsi` text,
  `prodi_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bk_mk`
--

CREATE TABLE `bk_mk` (
  `id` bigint NOT NULL,
  `bk_id` bigint DEFAULT NULL,
  `mk_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cpl`
--

CREATE TABLE `cpl` (
  `id` bigint NOT NULL,
  `kode_cpl` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `kurikulum_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cpl_bk`
--

CREATE TABLE `cpl_bk` (
  `id` bigint NOT NULL,
  `cpl_id` bigint DEFAULT NULL,
  `bk_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cpl_mk`
--

CREATE TABLE `cpl_mk` (
  `id` bigint NOT NULL,
  `cpl_id` bigint DEFAULT NULL,
  `mk_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cpl_pl`
--

CREATE TABLE `cpl_pl` (
  `id` bigint NOT NULL,
  `cpl_id` bigint DEFAULT NULL,
  `pl_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cpmk`
--

CREATE TABLE `cpmk` (
  `id` bigint NOT NULL,
  `rps_id` bigint DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` bigint NOT NULL,
  `NIP` varchar(100) DEFAULT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  `nidn` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `prodi_id` bigint DEFAULT NULL,
  `fakultas_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` bigint NOT NULL,
  `nama_fakultas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indikator_cpl`
--

CREATE TABLE `indikator_cpl` (
  `id` bigint NOT NULL,
  `cpl_id` bigint DEFAULT NULL,
  `kode_indikator` varchar(10) DEFAULT NULL,
  `deskripsi` text,
  `bobot` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indikator_mk`
--

CREATE TABLE `indikator_mk` (
  `id` bigint NOT NULL,
  `cpl_id` bigint DEFAULT NULL,
  `kode_indikator` varchar(10) DEFAULT NULL,
  `deskripsi` text,
  `bobot` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indikator_penilaian`
--

CREATE TABLE `indikator_penilaian` (
  `id` bigint NOT NULL,
  `penilaian_id` bigint DEFAULT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kaprodi`
--

CREATE TABLE `kaprodi` (
  `id` bigint NOT NULL,
  `fakultas_id` bigint NOT NULL,
  `prodi_id` bigint NOT NULL,
  `tahun` year NOT NULL,
  `nama_kaprodi` varchar(150) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id` bigint NOT NULL,
  `prodi_id` bigint DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` bigint NOT NULL,
  `kode_mk` varchar(100) DEFAULT NULL,
  `nama_mk` varchar(150) DEFAULT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` bigint NOT NULL,
  `rps_id` bigint DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint NOT NULL,
  `rps_id` bigint DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mk_dosen`
--

CREATE TABLE `mk_dosen` (
  `id` bigint NOT NULL,
  `mk_id` bigint DEFAULT NULL,
  `dosen_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mk_prasyarat`
--

CREATE TABLE `mk_prasyarat` (
  `id` bigint NOT NULL,
  `mk_id` bigint DEFAULT NULL,
  `prasyarat_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `role` enum('admin','kaprodi','dosen') DEFAULT NULL,
  `STATUS` enum('AKTIF','NONAKTIF') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` bigint NOT NULL,
  `rps_id` bigint DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `bobot` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyusunan_mk`
--

CREATE TABLE `penyusunan_mk` (
  `id` bigint NOT NULL,
  `mk_id` bigint DEFAULT NULL,
  `SKS` int DEFAULT NULL,
  `Kategori` enum('Wajib','pilihan') DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `pertemuan`
--

CREATE TABLE `pertemuan` (
  `id` bigint NOT NULL,
  `rps_id` bigint DEFAULT NULL,
  `minggu` int DEFAULT NULL,
  `materi` text,
  `metode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` bigint NOT NULL,
  `fakultas_id` bigint DEFAULT NULL,
  `nama_prodi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profil_lulusan`
--

CREATE TABLE `profil_lulusan` (
  `id` bigint NOT NULL,
  `kode_pl` varchar(10) DEFAULT NULL,
  `deskripsi` text,
  `kurikulum_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pustaka`
--

CREATE TABLE `pustaka` (
  `id` bigint NOT NULL,
  `rps_id` bigint DEFAULT NULL,
  `referensi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rps`
--

CREATE TABLE `rps` (
  `id` bigint NOT NULL,
  `mk_id` bigint DEFAULT NULL,
  `dosen_id` bigint DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `set_prodi`
--

CREATE TABLE `set_prodi` (
  `id` bigint NOT NULL,
  `fakultas_id` bigint DEFAULT NULL,
  `prodi_id` bigint DEFAULT NULL,
  `kurikulum_id` bigint DEFAULT NULL,
  `tahun_aktif` varchar(10) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_cpmk`
--

CREATE TABLE `sub_cpmk` (
  `id` bigint NOT NULL,
  `cpmk_id` bigint DEFAULT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `bk_mk`
--
ALTER TABLE `bk_mk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cpl`
--
ALTER TABLE `cpl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kurikulum_id` (`kurikulum_id`);

--
-- Indexes for table `cpl_bk`
--
ALTER TABLE `cpl_bk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cpl_mk`
--
ALTER TABLE `cpl_mk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cpl_pl`
--
ALTER TABLE `cpl_pl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cpmk`
--
ALTER TABLE `cpmk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rps_id` (`rps_id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indikator_cpl`
--
ALTER TABLE `indikator_cpl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpl_id` (`cpl_id`);

--
-- Indexes for table `indikator_mk`
--
ALTER TABLE `indikator_mk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpl_id` (`cpl_id`);

--
-- Indexes for table `indikator_penilaian`
--
ALTER TABLE `indikator_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_id` (`penilaian_id`);

--
-- Indexes for table `kaprodi`
--
ALTER TABLE `kaprodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rps_id` (`rps_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rps_id` (`rps_id`);

--
-- Indexes for table `mk_dosen`
--
ALTER TABLE `mk_dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mk_id` (`mk_id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `mk_prasyarat`
--
ALTER TABLE `mk_prasyarat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mk_id` (`mk_id`),
  ADD KEY `prasyarat_id` (`prasyarat_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rps_id` (`rps_id`);

--
-- Indexes for table `penyusunan_mk`
--
ALTER TABLE `penyusunan_mk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mk_id` (`mk_id`);

--
-- Indexes for table `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rps_id` (`rps_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`fakultas_id`);

--
-- Indexes for table `profil_lulusan`
--
ALTER TABLE `profil_lulusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kurikulum_id` (`kurikulum_id`);

--
-- Indexes for table `pustaka`
--
ALTER TABLE `pustaka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rps_id` (`rps_id`);

--
-- Indexes for table `rps`
--
ALTER TABLE `rps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mk_id` (`mk_id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `set_prodi`
--
ALTER TABLE `set_prodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`fakultas_id`),
  ADD KEY `prodi_id` (`prodi_id`),
  ADD KEY `kurikulum_id` (`kurikulum_id`);

--
-- Indexes for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpmk_id` (`cpmk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bk_mk`
--
ALTER TABLE `bk_mk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cpl`
--
ALTER TABLE `cpl`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cpl_bk`
--
ALTER TABLE `cpl_bk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cpl_mk`
--
ALTER TABLE `cpl_mk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cpl_pl`
--
ALTER TABLE `cpl_pl`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cpmk`
--
ALTER TABLE `cpmk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indikator_cpl`
--
ALTER TABLE `indikator_cpl`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indikator_mk`
--
ALTER TABLE `indikator_mk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indikator_penilaian`
--
ALTER TABLE `indikator_penilaian`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kaprodi`
--
ALTER TABLE `kaprodi`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mk_dosen`
--
ALTER TABLE `mk_dosen`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mk_prasyarat`
--
ALTER TABLE `mk_prasyarat`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyusunan_mk`
--
ALTER TABLE `penyusunan_mk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pertemuan`
--
ALTER TABLE `pertemuan`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profil_lulusan`
--
ALTER TABLE `profil_lulusan`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pustaka`
--
ALTER TABLE `pustaka`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rps`
--
ALTER TABLE `rps`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `set_prodi`
--
ALTER TABLE `set_prodi`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  ADD CONSTRAINT `bahan_kajian_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);

--
-- Constraints for table `cpl`
--
ALTER TABLE `cpl`
  ADD CONSTRAINT `cpl_ibfk_1` FOREIGN KEY (`kurikulum_id`) REFERENCES `kurikulum` (`id`);

--
-- Constraints for table `cpmk`
--
ALTER TABLE `cpmk`
  ADD CONSTRAINT `cpmk_ibfk_1` FOREIGN KEY (`rps_id`) REFERENCES `rps` (`id`);

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);

--
-- Constraints for table `indikator_cpl`
--
ALTER TABLE `indikator_cpl`
  ADD CONSTRAINT `indikator_cpl_ibfk_1` FOREIGN KEY (`cpl_id`) REFERENCES `cpl` (`id`);

--
-- Constraints for table `indikator_mk`
--
ALTER TABLE `indikator_mk`
  ADD CONSTRAINT `indikator_mk_ibfk_1` FOREIGN KEY (`cpl_id`) REFERENCES `cpl` (`id`);

--
-- Constraints for table `indikator_penilaian`
--
ALTER TABLE `indikator_penilaian`
  ADD CONSTRAINT `indikator_penilaian_ibfk_1` FOREIGN KEY (`penilaian_id`) REFERENCES `penilaian` (`id`);

--
-- Constraints for table `kaprodi`
--
ALTER TABLE `kaprodi`
  ADD CONSTRAINT `kaprodi_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);

--
-- Constraints for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD CONSTRAINT `kurikulum_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`rps_id`) REFERENCES `rps` (`id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`rps_id`) REFERENCES `rps` (`id`);

--
-- Constraints for table `mk_dosen`
--
ALTER TABLE `mk_dosen`
  ADD CONSTRAINT `mk_dosen_ibfk_1` FOREIGN KEY (`mk_id`) REFERENCES `mata_kuliah` (`id`),
  ADD CONSTRAINT `mk_dosen_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`);

--
-- Constraints for table `mk_prasyarat`
--
ALTER TABLE `mk_prasyarat`
  ADD CONSTRAINT `mk_prasyarat_ibfk_1` FOREIGN KEY (`mk_id`) REFERENCES `mata_kuliah` (`id`),
  ADD CONSTRAINT `mk_prasyarat_ibfk_2` FOREIGN KEY (`prasyarat_id`) REFERENCES `mata_kuliah` (`id`);

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`rps_id`) REFERENCES `rps` (`id`);

--
-- Constraints for table `penyusunan_mk`
--
ALTER TABLE `penyusunan_mk`
  ADD CONSTRAINT `penyusunan_mk_ibfk_1` FOREIGN KEY (`mk_id`) REFERENCES `mata_kuliah` (`id`);

--
-- Constraints for table `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD CONSTRAINT `pertemuan_ibfk_1` FOREIGN KEY (`rps_id`) REFERENCES `rps` (`id`);

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`);

--
-- Constraints for table `profil_lulusan`
--
ALTER TABLE `profil_lulusan`
  ADD CONSTRAINT `profil_lulusan_ibfk_1` FOREIGN KEY (`kurikulum_id`) REFERENCES `kurikulum` (`id`);

--
-- Constraints for table `pustaka`
--
ALTER TABLE `pustaka`
  ADD CONSTRAINT `pustaka_ibfk_1` FOREIGN KEY (`rps_id`) REFERENCES `rps` (`id`);

--
-- Constraints for table `rps`
--
ALTER TABLE `rps`
  ADD CONSTRAINT `rps_ibfk_1` FOREIGN KEY (`mk_id`) REFERENCES `mata_kuliah` (`id`),
  ADD CONSTRAINT `rps_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`);

--
-- Constraints for table `set_prodi`
--
ALTER TABLE `set_prodi`
  ADD CONSTRAINT `set_prodi_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`),
  ADD CONSTRAINT `set_prodi_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`),
  ADD CONSTRAINT `set_prodi_ibfk_3` FOREIGN KEY (`kurikulum_id`) REFERENCES `kurikulum` (`id`);

--
-- Constraints for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  ADD CONSTRAINT `sub_cpmk_ibfk_1` FOREIGN KEY (`cpmk_id`) REFERENCES `cpmk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

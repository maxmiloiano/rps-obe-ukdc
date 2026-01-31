-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 31, 2026 at 03:05 PM
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
  `kurikulum_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bahan_kajian`
--

INSERT INTO `bahan_kajian` (`id`, `kode_bahan_kajian`, `nama_bahan_kajian`, `deskripsi`, `kurikulum_id`, `created_at`, `updated_at`) VALUES
(10, 'BK -01', 'Computer Networks', 'Mempelajari Dasar-Dasar tentang Jaringan Komputer', 2, '2026-01-18 09:13:34', '2026-01-18 09:13:34'),
(11, 'BK-02', 'User Experience Design', '-', 2, '2026-01-22 06:59:46', '2026-01-22 06:59:46'),
(12, 'BK-03', 'Project Management', '-', 2, '2026-01-22 07:03:47', '2026-01-22 07:03:47'),
(13, 'BK-04', 'Security Policy dan Manajemen', '-', 2, '2026-01-22 07:07:52', '2026-01-22 07:07:52'),
(14, 'BK-05', 'Keamanan Teknologi', '-', 2, '2026-01-22 07:08:42', '2026-01-22 07:08:42'),
(15, 'BK-06', 'Data dan Informasi Manajemen', '-', 2, '2026-01-22 07:10:13', '2026-01-22 07:10:13'),
(16, 'BK-07', 'Deteksi objek dan Evaluasi', '-', 2, '2026-01-22 07:12:08', '2026-01-22 07:12:08'),
(17, 'BK-08', 'dmfmkmdfcjm', '-', 2, '2026-01-22 07:13:29', '2026-01-22 07:13:29'),
(18, 'BK-09', 'Ekstraksi fitur CNN', '-', 2, '2026-01-22 07:15:23', '2026-01-22 07:15:23');

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
  `kurikulum_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cpl`
--

INSERT INTO `cpl` (`id`, `kode_cpl`, `deskripsi`, `kurikulum_id`, `created_at`, `updated_at`) VALUES
(26, 'CPL-01', 'SJVDJJFJIJDJNJ', 2, '2026-01-16 03:38:14', '2026-01-16 03:38:14'),
(27, 'CPL-02', 'Mampu menguasai Mata kuliah dengan baik', 2, '2026-01-16 03:39:03', '2026-01-30 02:33:33'),
(28, 'CPL-03', 'LPDCKCMKMKKM', 2, '2026-01-16 03:39:18', '2026-01-16 03:39:18'),
(29, 'CPL-04', 'DCMKMKKMDCKMKM', 2, '2026-01-16 03:39:27', '2026-01-16 03:39:27'),
(30, 'CPL-05', 'S MDCMMDMCM', 2, '2026-01-16 03:39:37', '2026-01-16 03:39:37'),
(42, 'CPL-06', 'VFMKKIDMK MKM', 2, '2026-01-22 07:18:41', '2026-01-22 07:18:41'),
(43, 'CPL-07', 'UUJJJJNHYGHYHU', 2, '2026-01-22 07:20:02', '2026-01-22 07:20:02'),
(44, 'CPL-08', 'HUYHUJIIIJI', 2, '2026-01-22 07:20:22', '2026-01-22 07:20:22'),
(45, 'CPL-09', 'JIJJIKIKIKIK', 2, '2026-01-22 07:20:47', '2026-01-22 07:20:47');

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
  `nip_nik` varchar(30) DEFAULT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  `nidn` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `prodi_id` bigint DEFAULT NULL,
  `fakultas_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nip_nik`, `nama_dosen`, `nidn`, `email`, `prodi_id`, `fakultas_id`, `created_at`, `updated_at`) VALUES
(4, '123244', 'Yosefina Finsensia Riti', '76655566', 'yosefina.riti@ukdc.ac.id', 1, 3, '2026-01-11 15:22:22', '2026-01-11 15:22:22'),
(5, '28382992', 'Yulia', '76655566', 'yulia@ukdc.ac.id', 1, 3, '2026-01-11 16:17:58', '2026-01-11 16:17:58'),
(6, '0610500', 'Andre Hartanto S.Kom', '2134557907654', 'andre.hartanto@ukdc.ac.id', 1, 3, '2026-01-13 12:21:22', '2026-01-13 12:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` bigint NOT NULL,
  `kode_fakultas` varchar(10) DEFAULT NULL,
  `nama_fakultas` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `kode_fakultas`, `nama_fakultas`, `created_at`, `updated_at`) VALUES
(3, 'FT', 'Fakultas Teknik', '2026-01-09 00:22:19', '2026-01-09 00:22:19'),
(4, 'FE', 'Fakultas Ekonomi dan Bisnis', '2026-01-09 00:36:50', '2026-01-12 01:57:27'),
(5, 'FH', 'Fakultas Hukum', '2026-01-09 04:18:55', '2026-01-09 04:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `indikator_cpl`
--

CREATE TABLE `indikator_cpl` (
  `id` bigint NOT NULL,
  `cpl_id` bigint DEFAULT NULL,
  `kode_indikator` varchar(10) DEFAULT NULL,
  `deskripsi` text,
  `bobot` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `indikator_cpl`
--

INSERT INTO `indikator_cpl` (`id`, `cpl_id`, `kode_indikator`, `deskripsi`, `bobot`, `created_at`, `updated_at`) VALUES
(11, 26, 'IK 01', 'Mampu Menguasai Computer', 50, '2026-01-18 09:11:33', '2026-01-18 09:11:33'),
(12, 26, 'IK 02', 'Mampu Mempelajari Dasar-dasar Computer', 50, '2026-01-18 09:12:02', '2026-01-18 09:12:02'),
(19, 27, 'IK 12', 'UYHJHHJBJHJHHJ', 20, '2026-01-30 07:03:35', '2026-01-30 07:03:35'),
(20, 27, 'IK 13', 'KDKKDSKK', 50, '2026-01-30 07:04:39', '2026-01-30 07:04:39'),
(21, 27, 'IK 14', 'KSKDSDC', 30, '2026-01-30 07:04:55', '2026-01-30 07:04:55'),
(22, 28, 'IK 15', 'SDCJCVJFJVF', 20, '2026-01-30 09:54:02', '2026-01-30 09:54:02'),
(23, 28, 'IK 16', 'JDCJJCJIVJIJIVJI', 20, '2026-01-30 09:54:19', '2026-01-30 09:54:19'),
(24, 28, 'IK 17', 'SJNCNJDCNJVJVJ', 60, '2026-01-30 09:54:38', '2026-01-30 09:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `indikator_mk`
--

CREATE TABLE `indikator_mk` (
  `id` bigint NOT NULL,
  `indikator_cpl_id` bigint NOT NULL,
  `mk_id` bigint NOT NULL,
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

--
-- Dumping data for table `kaprodi`
--

INSERT INTO `kaprodi` (`id`, `fakultas_id`, `prodi_id`, `tahun`, `nama_kaprodi`, `nip`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 2026, 'Yulia', '28382992', '2026-01-11 06:33:28', '2026-01-12 01:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id` bigint NOT NULL,
  `prodi_id` bigint DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kurikulum`
--

INSERT INTO `kurikulum` (`id`, `prodi_id`, `tahun`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 2025, 'aktif', '2026-01-14 07:59:06', '2026-01-14 07:59:06');

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

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `kode_mk`, `nama_mk`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'IF24704', 'Computer Vision', 'Mempelajari Tentang Deteksi objek', '2026-01-18 07:51:11', '2026-01-18 09:15:18'),
(3, 'IF24701', 'PEMROGRAMAN JARINGAN', '-', '2026-01-22 10:20:15', '2026-01-22 10:20:15'),
(4, 'IF24705', 'PENERAPAN KECERDASAN BUATAN', '-', '2026-01-22 10:50:01', '2026-01-22 10:50:01'),
(5, 'IF24706', 'PENGUJIAN PERANGKAT LUNAK', '-', '2026-01-22 10:50:39', '2026-01-22 10:50:39'),
(6, 'IF24304', 'PEMROGRAMAN WEB', '-', '2026-01-23 01:54:25', '2026-01-23 01:54:25'),
(7, 'IF24101', 'ALPRO 1', 'Mempelajari Algoritma Pemrograman', '2026-01-28 08:02:52', '2026-01-28 08:02:52'),
(8, 'IF24102', 'ALPRO 2', 'Mempelajari Algoritma Pemrograman 2', '2026-01-28 08:03:49', '2026-01-28 08:03:49'),
(9, 'IF24103', 'BASIS DATA', 'Mempelajari mengenai data', '2026-01-28 08:05:52', '2026-01-28 08:05:52'),
(10, 'IF19104', 'Organisasi Komputer', 'Mempelajari mengenai komponen yang ada di Komputer', '2026-01-28 08:10:03', '2026-01-28 08:10:03'),
(11, 'UN18001', 'AGAMA', 'Mempelajari Pendidikan Agama mengenai Keagamaan sebagai orang katolik', '2026-01-28 08:13:58', '2026-01-28 08:13:58');

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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mk_dosen`
--

CREATE TABLE `mk_dosen` (
  `id` bigint NOT NULL,
  `mk_id` bigint DEFAULT NULL,
  `dosen_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mk_prasyarat`
--

CREATE TABLE `mk_prasyarat` (
  `id` bigint NOT NULL,
  `mk_id` bigint DEFAULT NULL,
  `prasyarat_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mk_prasyarat`
--

INSERT INTO `mk_prasyarat` (`id`, `mk_id`, `prasyarat_id`, `created_at`, `updated_at`) VALUES
(5, 3, 10, '2026-01-30 00:14:14', '2026-01-30 00:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `status` enum('AKTIF','NONAKTIF') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `email`, `password`, `nama_lengkap`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin@ukdc.ac.id', '$2y$12$J0Cse1DZls3Tf6lpDFMn7ub/vqp19Z2vqRcZaApbnWVxHG.hGc/Xq', 'admin', 'admin', 'AKTIF', '2026-01-08 11:16:14', '2026-01-08 23:20:14'),
(2, 'yosefina.riti@ukdc.ac.id', '$2y$12$EqsRr8tPTa0LUJSTG3jLKuQNTwq8soDJTH8gct48/735vglKalVzG', 'Fency', 'dosen', 'AKTIF', '2026-01-09 22:36:44', '2026-01-09 22:36:44'),
(3, 'yulia@ukdc.ac.id', '$2y$12$/hsbyFwi0cODpL7BFUQLjOQP7ESOI23xJ6BBDuO0jTk7yPF6rMSrG', 'Yulia', 'kaprodi', 'AKTIF', '2026-01-11 00:43:25', '2026-01-11 00:43:25'),
(4, 'andre.hartanto@ukdc.ac.id', '$2y$12$EmO7Ofst3HgAHlZWOjN2cOR34Ro0jzHLqVBoUCkJAGNRuJlKe33di', 'Andre Hartanto', 'dosen', 'AKTIF', '2026-01-13 05:14:02', '2026-01-13 05:14:02');

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
  `Kategori` enum('wajib','pilihan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `penyusunan_mk`
--

INSERT INTO `penyusunan_mk` (`id`, `mk_id`, `SKS`, `Kategori`, `semester`, `created_at`, `updated_at`) VALUES
(22, 10, 3, 'wajib', 1, '2026-01-28 23:30:55', '2026-01-28 23:31:42'),
(23, 7, 3, 'wajib', 1, '2026-01-28 23:30:55', '2026-01-28 23:31:42'),
(24, 9, 3, 'wajib', 3, '2026-01-28 23:30:55', '2026-01-28 23:31:42'),
(25, 6, 3, 'wajib', 3, '2026-01-28 23:30:55', '2026-01-28 23:31:42'),
(26, 3, 3, 'wajib', 7, '2026-01-28 23:30:55', '2026-01-28 23:31:42'),
(27, 1, 3, 'wajib', 7, '2026-01-28 23:30:55', '2026-01-28 23:31:42'),
(28, 4, 3, 'pilihan', 7, '2026-01-28 23:30:55', '2026-01-28 23:31:42'),
(29, 5, 3, 'wajib', 7, '2026-01-28 23:30:55', '2026-01-28 23:31:42'),
(30, 11, 2, 'wajib', 1, '2026-01-28 23:30:55', '2026-01-28 23:31:42'),
(31, 8, 3, 'wajib', 2, '2026-01-28 23:31:42', '2026-01-28 23:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `nama_prodi` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `fakultas_id`, `nama_prodi`, `created_at`, `updated_at`) VALUES
(1, 3, 'Informatika', '2026-01-09 05:04:23', '2026-01-09 05:05:40'),
(6, 3, 'Arsitektur', '2026-01-09 05:11:02', '2026-01-09 05:11:02'),
(9, 4, 'Akuntansi', '2026-01-11 08:01:57', '2026-01-12 02:02:19'),
(11, 4, 'Manajemen Pemasaran', '2026-01-31 03:25:33', '2026-01-31 03:25:33'),
(12, 5, 'Hukum', '2026-01-31 04:02:58', '2026-01-31 04:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `profil_lulusan`
--

CREATE TABLE `profil_lulusan` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_pl` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `kurikulum_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profil_lulusan`
--

INSERT INTO `profil_lulusan` (`id`, `kode_pl`, `deskripsi`, `kurikulum_id`, `created_at`, `updated_at`) VALUES
(12, 'PL-01', 'Lulusan mampu berkarya', 2, '2026-01-14 23:34:10', '2026-01-14 23:34:10'),
(13, 'PL-02', 'jndsjmjdcmkmksmkmk', 2, '2026-01-14 23:34:10', '2026-01-14 23:34:10'),
(24, 'PL-03', 'kdskcmmdck', 2, '2026-01-21 06:57:39', '2026-01-21 06:57:39'),
(25, 'PL-04', 'mkxmkkmdcmk', 2, '2026-01-21 06:57:58', '2026-01-21 06:57:58'),
(26, 'PL-05', 'SJVFMKMVMK', 2, '2026-01-21 06:58:10', '2026-01-21 06:58:10');

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
-- Table structure for table `set_prodi_tahun`
--

CREATE TABLE `set_prodi_tahun` (
  `id` bigint NOT NULL,
  `fakultas_id` bigint NOT NULL,
  `prodi_id` bigint NOT NULL,
  `tahun_kurikulum` year NOT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `set_prodi_tahun`
--

INSERT INTO `set_prodi_tahun` (`id`, `fakultas_id`, `prodi_id`, `tahun_kurikulum`, `status`, `created_at`, `updated_at`) VALUES
(5, 3, 1, 2024, 'Nonaktif', '2026-01-14 06:45:11', '2026-01-14 07:59:06'),
(6, 3, 1, 2025, 'Aktif', '2026-01-14 07:59:06', '2026-01-14 07:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cpmk`
--

CREATE TABLE `sub_cpmk` (
  `id` bigint NOT NULL,
  `cpmk_id` bigint DEFAULT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bahan_kajian_kurikulum` (`kurikulum_id`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
  ADD KEY `indikator_cpl_id` (`indikator_cpl_id`),
  ADD KEY `mk_id` (`mk_id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `set_prodi_tahun`
--
ALTER TABLE `set_prodi_tahun`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`fakultas_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpmk_id` (`cpmk_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bk_mk`
--
ALTER TABLE `bk_mk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cpl`
--
ALTER TABLE `cpl`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `cpl_bk`
--
ALTER TABLE `cpl_bk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cpl_mk`
--
ALTER TABLE `cpl_mk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cpl_pl`
--
ALTER TABLE `cpl_pl`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cpmk`
--
ALTER TABLE `cpmk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `indikator_cpl`
--
ALTER TABLE `indikator_cpl`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `indikator_mk`
--
ALTER TABLE `indikator_mk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `indikator_penilaian`
--
ALTER TABLE `indikator_penilaian`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kaprodi`
--
ALTER TABLE `kaprodi`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mk_dosen`
--
ALTER TABLE `mk_dosen`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mk_prasyarat`
--
ALTER TABLE `mk_prasyarat`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pertemuan`
--
ALTER TABLE `pertemuan`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `profil_lulusan`
--
ALTER TABLE `profil_lulusan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
-- AUTO_INCREMENT for table `set_prodi_tahun`
--
ALTER TABLE `set_prodi_tahun`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  ADD CONSTRAINT `fk_bahan_kajian_kurikulum` FOREIGN KEY (`kurikulum_id`) REFERENCES `kurikulum` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `indikator_mk_ibfk_1` FOREIGN KEY (`indikator_cpl_id`) REFERENCES `indikator_cpl` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `indikator_mk_ibfk_2` FOREIGN KEY (`mk_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `set_prodi_tahun`
--
ALTER TABLE `set_prodi_tahun`
  ADD CONSTRAINT `set_prodi_tahun_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`),
  ADD CONSTRAINT `set_prodi_tahun_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`);

--
-- Constraints for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  ADD CONSTRAINT `sub_cpmk_ibfk_1` FOREIGN KEY (`cpmk_id`) REFERENCES `cpmk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 10, 2025 at 01:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sianjab`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_detail_uraian_tugas_stafs`
--

CREATE TABLE `data_detail_uraian_tugas_stafs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_uraian_tugas_tusi` bigint UNSIGNED NOT NULL,
  `uraian_tugas_staf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abk_ideal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abk_berlebih` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_pendukung_sebelumnya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_pendukung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_data_pendukung_sebelumnya` enum('link','file') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_data_pendukung` enum('link','file') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('belum','sudah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `catatan_mahasiswa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_skpds`
--

CREATE TABLE `data_skpds` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_skpd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_staf_utamas`
--

CREATE TABLE `data_staf_utamas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_skpd` bigint UNSIGNED NOT NULL,
  `nomenklatur_jabatan_struktural` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_uraian_tugas_stafs`
--

CREATE TABLE `data_uraian_tugas_stafs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `abk_ideal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abk_berlebih` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_eksisting` int NOT NULL,
  `pns` int UNSIGNED NOT NULL DEFAULT '0',
  `non_pns` int UNSIGNED NOT NULL DEFAULT '0',
  `pppk` int UNSIGNED NOT NULL DEFAULT '0',
  `cpns` int UNSIGNED NOT NULL DEFAULT '0',
  `pemenuhan_pegawai` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_05_8_062352_create_data_skpds_table', 1),
(2, '2014_06_09_150229_create_data_staf_utamas_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2025_06_09_142557_create_tugas_dan_fungsis_table', 1),
(8, '2025_06_09_152910_create_data_uraian_tugas_stafs_table', 1),
(9, '2025_06_09_153248_create_uraian_tugas_dan_tusis_table', 1),
(10, '2025_06_09_153423_create_data_detail_uraian_tugas_stafs_table', 1),
(11, '2025_06_23_143232_create_rincian_tugas_staf_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rincian_tugas_staf`
--

CREATE TABLE `rincian_tugas_staf` (
  `id` bigint UNSIGNED NOT NULL,
  `detail_uraian_tugas_staf_id` bigint UNSIGNED NOT NULL,
  `hasil_kerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_hasil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` int NOT NULL,
  `frekuensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` int NOT NULL,
  `waktu_penyelesaian` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_dan_fungsis`
--

CREATE TABLE `tugas_dan_fungsis` (
  `id` bigint UNSIGNED NOT NULL,
  `tusi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_tusi` int NOT NULL,
  `nama_jabatan_permempan_45` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_jabatan_permempan_41` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uraian_tugas_dan_tusis`
--

CREATE TABLE `uraian_tugas_dan_tusis` (
  `id` bigint UNSIGNED NOT NULL,
  `id_tusi` bigint UNSIGNED NOT NULL,
  `id_uraian_tugas_staf` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `id_staf_utama` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user','kepala','mahasiswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_staf` enum('fungsional','pelaksana','penunjang') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_perangkat_daerah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_detail_uraian_tugas_stafs`
--
ALTER TABLE `data_detail_uraian_tugas_stafs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_detail_uraian_tugas_stafs_id_uraian_tugas_tusi_foreign` (`id_uraian_tugas_tusi`);

--
-- Indexes for table `data_skpds`
--
ALTER TABLE `data_skpds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_skpds_nama_skpd_unique` (`nama_skpd`);

--
-- Indexes for table `data_staf_utamas`
--
ALTER TABLE `data_staf_utamas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_staf_utamas_id_skpd_foreign` (`id_skpd`);

--
-- Indexes for table `data_uraian_tugas_stafs`
--
ALTER TABLE `data_uraian_tugas_stafs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_uraian_tugas_stafs_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rincian_tugas_staf`
--
ALTER TABLE `rincian_tugas_staf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rincian_tugas_staf_detail_uraian_tugas_staf_id_foreign` (`detail_uraian_tugas_staf_id`);

--
-- Indexes for table `tugas_dan_fungsis`
--
ALTER TABLE `tugas_dan_fungsis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tugas_dan_fungsis_code_tusi_unique` (`code_tusi`);

--
-- Indexes for table `uraian_tugas_dan_tusis`
--
ALTER TABLE `uraian_tugas_dan_tusis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uraian_tugas_dan_tusis_id_tusi_foreign` (`id_tusi`),
  ADD KEY `uraian_tugas_dan_tusis_id_uraian_tugas_staf_foreign` (`id_uraian_tugas_staf`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_id_staf_utama_foreign` (`id_staf_utama`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_detail_uraian_tugas_stafs`
--
ALTER TABLE `data_detail_uraian_tugas_stafs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_skpds`
--
ALTER TABLE `data_skpds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_staf_utamas`
--
ALTER TABLE `data_staf_utamas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_uraian_tugas_stafs`
--
ALTER TABLE `data_uraian_tugas_stafs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rincian_tugas_staf`
--
ALTER TABLE `rincian_tugas_staf`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas_dan_fungsis`
--
ALTER TABLE `tugas_dan_fungsis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uraian_tugas_dan_tusis`
--
ALTER TABLE `uraian_tugas_dan_tusis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_detail_uraian_tugas_stafs`
--
ALTER TABLE `data_detail_uraian_tugas_stafs`
  ADD CONSTRAINT `data_detail_uraian_tugas_stafs_id_uraian_tugas_tusi_foreign` FOREIGN KEY (`id_uraian_tugas_tusi`) REFERENCES `uraian_tugas_dan_tusis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_staf_utamas`
--
ALTER TABLE `data_staf_utamas`
  ADD CONSTRAINT `data_staf_utamas_id_skpd_foreign` FOREIGN KEY (`id_skpd`) REFERENCES `data_skpds` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_uraian_tugas_stafs`
--
ALTER TABLE `data_uraian_tugas_stafs`
  ADD CONSTRAINT `data_uraian_tugas_stafs_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rincian_tugas_staf`
--
ALTER TABLE `rincian_tugas_staf`
  ADD CONSTRAINT `rincian_tugas_staf_detail_uraian_tugas_staf_id_foreign` FOREIGN KEY (`detail_uraian_tugas_staf_id`) REFERENCES `data_detail_uraian_tugas_stafs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `uraian_tugas_dan_tusis`
--
ALTER TABLE `uraian_tugas_dan_tusis`
  ADD CONSTRAINT `uraian_tugas_dan_tusis_id_tusi_foreign` FOREIGN KEY (`id_tusi`) REFERENCES `tugas_dan_fungsis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `uraian_tugas_dan_tusis_id_uraian_tugas_staf_foreign` FOREIGN KEY (`id_uraian_tugas_staf`) REFERENCES `data_uraian_tugas_stafs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_staf_utama_foreign` FOREIGN KEY (`id_staf_utama`) REFERENCES `data_staf_utamas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

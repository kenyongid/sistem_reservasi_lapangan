-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 31, 2026 at 05:46 AM
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
-- Database: `booking_sport`
--

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
-- Table structure for table `jenis_olahraga`
--

CREATE TABLE `jenis_olahraga` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_olahraga`
--

INSERT INTO `jenis_olahraga` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Padel', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(2, 'Mini Soccer', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(3, 'Badminton', '2026-08-30 07:12:04', '2026-08-30 07:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis_olahraga_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_per_jam` decimal(12,2) NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id`, `jenis_olahraga_id`, `nama`, `gambar`, `harga_per_jam`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Padel Court 1', 'lapangan/pmRGVB9tvsq4B5nesiUOBirt6IYQwu1ouwLQatJh.jpg', '150000.00', 'aktif', '2026-08-30 07:12:04', '2026-08-30 12:50:28'),
(2, 1, 'Padel Court 5', 'lapangan/axcQ1K9qsHDTxylYUmrGDncXWFMlrQ3XixOSWXmD.jpg', '150000.00', 'aktif', '2026-08-30 07:12:04', '2026-08-30 12:41:32'),
(3, 2, 'Mini Soccer Field 1', 'lapangan/qLrBct8kxjniP4thgdkisiXtlBneWNPoAlxrfUiP.jpg', '350000.00', 'aktif', '2026-08-30 07:12:04', '2026-08-30 12:59:08'),
(4, 3, 'Badminton Court 1', 'lapangan/uDgnV4N56qZO7qcrqimp7QqLtRQXxr8rLNPkZThP.jpg', '75000.00', 'aktif', '2026-08-30 07:12:04', '2026-08-30 12:59:35'),
(5, 3, 'Badminton Court 2', 'lapangan/9ZkKlnkRleaaKqBBfNw5UiG7oTRFcmCbd2bgR1Xq.jpg', '75000.00', 'aktif', '2026-08-30 07:12:04', '2026-08-30 12:59:43'),
(6, 2, 'Mini Soccer Field 5', 'lapangan/eLEbjo0tgLlAbIMTknGfy7BBH5tkr90pvyIcAIVv.jpg', '350000.00', 'aktif', '2026-08-30 18:32:16', '2026-08-30 19:15:26');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_08_30_020930_create_jenis_olahraga_table', 1),
(6, '2026_08_30_020931_create_lapangan_table', 1),
(7, '2026_08_30_022006_create_slot_waktu_table', 1),
(8, '2026_08_30_022031_create_reservasi_tabel', 1),
(9, '2026_08_30_193205_add_gambar_to_lapangan_table', 2),
(10, '2026_08_30_213323_add_data_pemesan_to_reservasi_table', 3);

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
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_reservasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `lapangan_id` bigint UNSIGNED NOT NULL,
  `slot_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id`, `kode_reservasi`, `user_id`, `nama`, `email`, `telepon`, `catatan`, `lapangan_id`, `slot_id`, `tanggal`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(1, 'RSV-JFZBBWPG', 1, '', '', '', NULL, 2, 52, '2026-08-31', '150000.00', 'Disetujui', '2026-08-30 07:19:19', '2026-08-30 13:03:13'),
(2, 'RSV-IWW5MZ5K', 1, '', '', '', NULL, 2, 8, '2026-08-31', '150000.00', 'Ditolak', '2026-08-30 14:31:53', '2026-08-30 14:38:53'),
(3, 'RSV-BVWQNVRQ', 1, 'Fadhil Raihan', 'reyhanfadil555@gmail.com', '082282316873', '12345', 2, 7, '2026-08-31', '150000.00', 'Menunggu', '2026-08-30 14:39:53', '2026-08-30 14:39:53'),
(4, 'RSV-AFSVFGFI', 1, 'Fadhil Raihan', 'reyhanfadil555@gmail.com', '082282316873', 'qqq', 3, 3, '2026-08-30', '350000.00', 'Ditolak', '2026-08-30 14:50:57', '2026-08-30 14:52:51'),
(5, 'RSV-XFM8ACVI', 1, 'Fadhil Raihan', 'reyhanfadil555@gmail.com', '082282316873', '123', 5, 2, '2026-08-30', '75000.00', 'Disetujui', '2026-08-30 14:51:29', '2026-08-30 14:52:44'),
(6, 'RSV-3SECFVJL', 1, 'Reyhan Fadil', 'reyhanfadil555@gmail.com', '082282316873', '11', 5, 1, '2026-08-30', '75000.00', 'Menunggu', '2026-08-30 14:51:51', '2026-08-30 14:51:51'),
(7, 'RSV-80SHKN3R', 1, 'Fadhil Raihan', 'reyhanfadil555@gmail.com', '082282316873', NULL, 6, 2, '2026-09-02', '350000.00', 'Disetujui', '2026-08-30 19:14:28', '2026-08-30 19:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `slot_waktu`
--

CREATE TABLE `slot_waktu` (
  `id` bigint UNSIGNED NOT NULL,
  `lapangan_id` bigint UNSIGNED NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slot_waktu`
--

INSERT INTO `slot_waktu` (`id`, `lapangan_id`, `jam_mulai`, `jam_selesai`, `created_at`, `updated_at`) VALUES
(1, 1, '08:00:00', '09:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(2, 1, '09:00:00', '10:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(3, 1, '10:00:00', '11:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(4, 1, '11:00:00', '12:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(5, 1, '13:00:00', '14:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(6, 1, '14:00:00', '15:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(7, 1, '15:00:00', '16:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(8, 1, '16:00:00', '17:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(9, 1, '17:00:00', '18:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(10, 1, '18:00:00', '19:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(11, 1, '19:00:00', '20:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(12, 1, '20:00:00', '21:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(13, 2, '08:00:00', '09:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(14, 2, '09:00:00', '10:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(15, 2, '10:00:00', '11:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(16, 2, '11:00:00', '12:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(17, 2, '13:00:00', '14:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(18, 2, '14:00:00', '15:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(19, 2, '15:00:00', '16:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(20, 2, '16:00:00', '17:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(21, 2, '17:00:00', '18:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(22, 2, '18:00:00', '19:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(23, 2, '19:00:00', '20:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(24, 2, '20:00:00', '21:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(25, 3, '08:00:00', '09:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(26, 3, '09:00:00', '10:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(27, 3, '10:00:00', '11:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(28, 3, '11:00:00', '12:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(29, 3, '13:00:00', '14:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(30, 3, '14:00:00', '15:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(31, 3, '15:00:00', '16:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(32, 3, '16:00:00', '17:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(33, 3, '17:00:00', '18:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(34, 3, '18:00:00', '19:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(35, 3, '19:00:00', '20:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(36, 3, '20:00:00', '21:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(37, 4, '08:00:00', '09:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(38, 4, '09:00:00', '10:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(39, 4, '10:00:00', '11:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(40, 4, '11:00:00', '12:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(41, 4, '13:00:00', '14:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(42, 4, '14:00:00', '15:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(43, 4, '15:00:00', '16:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(44, 4, '16:00:00', '17:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(45, 4, '17:00:00', '18:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(46, 4, '18:00:00', '19:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(47, 4, '19:00:00', '20:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(48, 4, '20:00:00', '21:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(49, 5, '08:00:00', '09:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(50, 5, '09:00:00', '10:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(51, 5, '10:00:00', '11:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(52, 5, '11:00:00', '12:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(53, 5, '13:00:00', '14:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(54, 5, '14:00:00', '15:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(55, 5, '15:00:00', '16:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(56, 5, '16:00:00', '17:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(57, 5, '17:00:00', '18:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(58, 5, '18:00:00', '19:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(59, 5, '19:00:00', '20:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(60, 5, '20:00:00', '21:00:00', '2026-08-30 07:12:04', '2026-08-30 07:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `no_telepon`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin SportSpace', 'admin@sportspace.test', '$2y$12$lvJunS2M2zRxxhz7izGY2uXfPZlC2aTmBXUcltjTtcQylXEvxnCva', '081234567890', 'admin', '2026-08-30 07:12:04', '2026-08-30 07:12:04'),
(2, 'Andi Pratama', 'andi@sportspace.test', '$2y$12$u7eV4k9Q73hCuA1M/uPZ.OLCSyIQX3oJaTAoQNFQoAlk2Wva9LMmC', '081298765432', 'user', '2026-08-30 07:12:04', '2026-08-30 07:12:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_olahraga`
--
ALTER TABLE `jenis_olahraga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lapangan_jenis_olahraga_id_foreign` (`jenis_olahraga_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservasi_kode_reservasi_unique` (`kode_reservasi`),
  ADD KEY `reservasi_user_id_foreign` (`user_id`),
  ADD KEY `reservasi_lapangan_id_foreign` (`lapangan_id`),
  ADD KEY `reservasi_slot_id_foreign` (`slot_id`);

--
-- Indexes for table `slot_waktu`
--
ALTER TABLE `slot_waktu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slot_waktu_lapangan_id_jam_mulai_jam_selesai_unique` (`lapangan_id`,`jam_mulai`,`jam_selesai`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_olahraga`
--
ALTER TABLE `jenis_olahraga`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `slot_waktu`
--
ALTER TABLE `slot_waktu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD CONSTRAINT `lapangan_jenis_olahraga_id_foreign` FOREIGN KEY (`jenis_olahraga_id`) REFERENCES `jenis_olahraga` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `reservasi_lapangan_id_foreign` FOREIGN KEY (`lapangan_id`) REFERENCES `lapangan` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `reservasi_slot_id_foreign` FOREIGN KEY (`slot_id`) REFERENCES `slot_waktu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `reservasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `slot_waktu`
--
ALTER TABLE `slot_waktu`
  ADD CONSTRAINT `slot_waktu_lapangan_id_foreign` FOREIGN KEY (`lapangan_id`) REFERENCES `lapangan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

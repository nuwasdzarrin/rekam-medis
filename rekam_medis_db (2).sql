-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 18, 2023 at 06:16 AM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekam_medis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `user_id`, `nip`, `nama`, `no_hp`, `alamat`, `poli`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 'Dimas', '0987654321', NULL, 'Gigi dan Mulut', 1, '2023-11-17 16:15:25', '2023-11-17 16:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `icds`
--

CREATE TABLE `icds` (
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `icds`
--

INSERT INTO `icds` (`code`, `name_id`, `name_en`, `created_at`, `updated_at`) VALUES
('PE', 'Pemeriksaan', 'inspection', '2023-11-17 23:56:03', '2023-11-17 23:56:03'),
('PR', 'Perencanaan', 'Planning', '2023-11-17 23:56:28', '2023-11-17 23:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_gigi`
--

CREATE TABLE `kondisi_gigi` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(61, '2014_10_12_000000_create_users_table', 1),
(62, '2014_10_12_100000_create_password_resets_table', 1),
(63, '2019_08_19_000000_create_failed_jobs_table', 1),
(64, '2023_05_13_033136_create_pasien_table', 1),
(65, '2023_05_13_033149_create_dokter_table', 1),
(66, '2023_05_13_033209_create_obat_table', 1),
(67, '2023_05_13_033252_create_rekam_table', 1),
(68, '2023_05_17_021102_create_poli_table', 1),
(69, '2023_05_18_235916_create_pengeluaran_obat_table', 1),
(70, '2023_05_19_233941_create_notifications_table', 1),
(71, '2023_05_20_133306_create_rekam_gigi_table', 1),
(72, '2023_05_20_163802_create_tindakan_table', 1),
(73, '2023_05_21_141004_create_kondisi_gigi_table', 1),
(74, '2023_05_21_141055_create_icds_table', 1),
(75, '2023_07_13_101007_create_rekam_diagnosa_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('03408504-1d28-4e43-b476-0703f5f6c794', 'App\\Notifications\\RekamUpdateNotification', 'App\\User', 3, '{\"id_rekam\":1,\"no_rekam\":\"REG#202311171\",\"created_at\":\"2023-11-17T15:21:50.000000Z\",\"id_pasien\":1,\"nama_pasien\":\"Pasien 1\",\"message\":\"Pasien Pasien 1, silahkan diproses\"}', '2023-11-17 16:25:26', '2023-11-17 16:22:42', '2023-11-17 16:25:26'),
('6eea1352-75f2-46ee-95ef-a9f73195d317', 'App\\Notifications\\RekamUpdateNotification', 'App\\User', 3, '{\"id_rekam\":2,\"no_rekam\":\"REG#202311171\",\"created_at\":\"2023-11-17T15:24:09.000000Z\",\"id_pasien\":1,\"nama_pasien\":\"Pasien 1\",\"message\":\"Pasien Pasien 1, silahkan diproses\"}', '2023-11-17 16:25:26', '2023-11-17 16:24:40', '2023-11-17 16:25:26'),
('b44b5059-8c96-4a45-a6d6-b881e798fd67', 'App\\Notifications\\RekamUpdateNotification', 'App\\User', 3, '{\"id_rekam\":3,\"no_rekam\":\"REG#202311183\",\"created_at\":\"2023-11-17T22:29:21.000000Z\",\"id_pasien\":3,\"nama_pasien\":\"Caca Marica\",\"message\":\"Pasien Caca Marica, silahkan diproses\"}', NULL, '2023-11-17 23:58:22', '2023-11-17 23:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` bigint UNSIGNED NOT NULL,
  `kd_obat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `is_bpjs` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `kd_obat`, `nama`, `satuan`, `stok`, `foto`, `harga`, `is_bpjs`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'OS', 'Obat Sakit', 'pcx', 7, NULL, 5000, 1, '2023-11-17 16:29:16', '2023-11-18 00:14:20', NULL),
(2, 'OB', 'Obat Bedah', 'pcs', 99, NULL, 320000, 1, '2023-11-18 00:00:07', '2023-11-18 00:14:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` bigint UNSIGNED NOT NULL,
  `no_rm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmp_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` enum('Laki-Laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_lengkap` longtext COLLATE utf8mb4_unicode_ci,
  `kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kodepos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Islam',
  `status_menikah` enum('Menikah','Belum Menikah','Janda','Duda') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kewarganegaraan` enum('WNI','WNA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cara_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum/Mandiri',
  `no_bpjs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alergi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `no_rm`, `nama`, `tmp_lahir`, `tgl_lahir`, `jk`, `alamat_lengkap`, `kelurahan`, `kecamatan`, `kabupaten`, `kodepos`, `agama`, `status_menikah`, `pendidikan`, `pekerjaan`, `kewarganegaraan`, `no_hp`, `cara_bayar`, `no_bpjs`, `alergi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'DD-01', 'Pasien 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', NULL, NULL, NULL, 'WNI', NULL, 'Umum/Mandiri', NULL, NULL, '2023-11-17 16:04:13', '2023-11-17 16:04:13', NULL),
(2, 'DB-02', 'Bana Saja', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, NULL, NULL, NULL, 'Belum Menikah', NULL, NULL, 'WNI', '086543', 'Umum/Mandiri', '3521118887', NULL, '2023-11-17 23:27:48', '2023-11-17 23:27:48', NULL),
(3, 'AC-01', 'Caca Marica', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, NULL, NULL, 'Belum Menikah', NULL, NULL, 'WNI', '08127766', 'Umum/Mandiri', '35233546', NULL, '2023-11-17 23:28:48', '2023-11-17 23:28:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_obat`
--

CREATE TABLE `pengeluaran_obat` (
  `id` bigint UNSIGNED NOT NULL,
  `rekam_id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `obat_id` int NOT NULL,
  `jumlah` int NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `subtotal` int NOT NULL DEFAULT '0',
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeluaran_obat`
--

INSERT INTO `pengeluaran_obat` (`id`, `rekam_id`, `pasien_id`, `obat_id`, `jumlah`, `satuan`, `harga`, `subtotal`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 3, 1, 3, NULL, 5000, 15000, 'diminum 1 hari 3 kali', '2023-11-18 00:14:20', '2023-11-18 00:14:20', NULL),
(2, 3, 3, 2, 1, NULL, 320000, 320000, '1x 1', '2023-11-18 00:14:20', '2023-11-18 00:14:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gigi dan Mulut', 1, '2023-11-17 16:04:13', '2023-11-17 16:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `rekam`
--

CREATE TABLE `rekam` (
  `id` bigint UNSIGNED NOT NULL,
  `no_rekam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_rekam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_id` int UNSIGNED NOT NULL,
  `dokter_id` int UNSIGNED NOT NULL,
  `poli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keluhan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemeriksaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biaya_pemeriksaan` int NOT NULL DEFAULT '0',
  `biaya_tindakan` int NOT NULL DEFAULT '0',
  `biaya_obat` int NOT NULL DEFAULT '0',
  `total_biaya` int NOT NULL DEFAULT '0',
  `cara_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `petugas_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekam`
--

INSERT INTO `rekam` (`id`, `no_rekam`, `tgl_rekam`, `pasien_id`, `dokter_id`, `poli`, `keluhan`, `pemeriksaan`, `diagnosa`, `tindakan`, `biaya_pemeriksaan`, `biaya_tindakan`, `biaya_obat`, `total_biaya`, `cara_bayar`, `status`, `petugas_id`, `created_at`, `updated_at`) VALUES
(1, 'REG#202311171', '2023-11-17', 1, 1, 'Gigi dan Mulut', 'sakit', '<p>lala</p>', NULL, '<p>planing</p>', 0, 0, 0, 0, 'Umum/Mandiri', 5, 1, '2023-11-17 16:21:50', '2023-11-17 16:23:13'),
(2, 'REG#202311171', '2023-11-17', 1, 1, 'Gigi dan Mulut', 'pusing', '<p>cek darah</p>\r\n\r\n<p>nya</p>', NULL, '<p>suntik</p>', 0, 0, 0, 0, 'Umum/Mandiri', 5, 1, '2023-11-17 16:24:09', '2023-11-17 16:29:45'),
(3, 'REG#202311183', '2023-11-18', 3, 1, 'Gigi dan Mulut', 'Nyeri gigi geraham belakang', '<p>Lihat pertumbuhan gigi bungsu</p>', NULL, '<p>Bedah gusi</p>', 0, 0, 0, 0, 'Umum/Mandiri', 5, 1, '2023-11-17 23:29:21', '2023-11-18 00:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_diagnosa`
--

CREATE TABLE `rekam_diagnosa` (
  `id` bigint UNSIGNED NOT NULL,
  `rekam_id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `diagnosa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekam_diagnosa`
--

INSERT INTO `rekam_diagnosa` (`id`, `rekam_id`, `pasien_id`, `diagnosa`, `created_at`, `updated_at`) VALUES
(2, 3, 3, 'PR', '2023-11-17 23:57:14', '2023-11-17 23:57:14'),
(3, 3, 3, 'PE', '2023-11-17 23:57:20', '2023-11-17 23:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_gigi`
--

CREATE TABLE `rekam_gigi` (
  `id` bigint UNSIGNED NOT NULL,
  `rekam_id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `elemen_gigi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemeriksaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `id` bigint UNSIGNED NOT NULL,
  `poli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`id`, `poli`, `kode`, `nama`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Gigi dan Mulut', 'KC', 'Kulit Cerdas', 3000, '2023-11-17 16:27:03', '2023-11-17 16:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL DEFAULT '1' COMMENT '\n            1 => Admin\n            2 => Petugas Registrasi\n            3 => Dokter\n            4 => Petugas Obat\n            ',
  `status` int NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '08123456789', 'admin@admin.com', NULL, '$2y$10$80nFNa8uGbtyjHy5.fTxB.Q0FobskScGjgmPCfbub1dFE27aPMxku', 1, 1, 'mspo9TMTx6J8Nauy3QfskgjBW43yrTBtDgQbLw8CQ6EnM0eLaKYFi3WGb3Ep', '2023-11-17 16:04:13', '2023-11-17 16:04:13'),
(3, 'Dimas', '0987654321', 'dimas@dimas.com', NULL, '$2y$10$UFTmrmCXomHgmhSvwbeYOe3iAHl0zVdwt6LY83l09rXS.twuUhVcK', 3, 1, 'A84MLzuspDpvjA2UaQQ7eQIVnCJTbUz0mjmZy9oiyBLKhELDMlxiGmeOpp9R', '2023-11-17 16:15:25', '2023-11-17 16:15:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icds`
--
ALTER TABLE `icds`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `kondisi_gigi`
--
ALTER TABLE `kondisi_gigi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengeluaran_obat`
--
ALTER TABLE `pengeluaran_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam`
--
ALTER TABLE `rekam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_diagnosa`
--
ALTER TABLE `rekam_diagnosa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_gigi`
--
ALTER TABLE `rekam_gigi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kondisi_gigi`
--
ALTER TABLE `kondisi_gigi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengeluaran_obat`
--
ALTER TABLE `pengeluaran_obat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekam`
--
ALTER TABLE `rekam`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekam_diagnosa`
--
ALTER TABLE `rekam_diagnosa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekam_gigi`
--
ALTER TABLE `rekam_gigi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

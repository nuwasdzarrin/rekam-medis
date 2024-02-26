-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 26 Feb 2024 pada 08.16
-- Versi server: 8.0.36-0ubuntu0.22.04.1
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekam_medis_empty_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
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
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `user_id`, `nip`, `nama`, `no_hp`, `alamat`, `poli`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Dimas', '0987654321', NULL, '1', 1, '2024-01-21 13:21:34', '2024-01-21 13:21:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `icds`
--

CREATE TABLE `icds` (
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_gigi`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(21, '2014_10_12_000000_create_users_table', 1),
(22, '2014_10_12_100000_create_password_resets_table', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2023_05_13_033136_create_pasien_table', 1),
(25, '2023_05_13_033149_create_dokter_table', 1),
(26, '2023_05_13_033209_create_obat_table', 1),
(27, '2023_05_17_021102_create_poli_table', 1),
(28, '2023_05_18_235916_create_pengeluaran_obat_table', 1),
(29, '2023_05_19_233941_create_notifications_table', 1),
(30, '2023_05_20_163802_create_tindakan_table', 1),
(31, '2023_05_21_141004_create_kondisi_gigi_table', 1),
(32, '2023_05_21_141055_create_icds_table', 1),
(33, '2023_06_13_033252_create_rekam_table', 1),
(34, '2023_06_20_133306_create_rekam_gigi_table', 1),
(35, '2023_07_13_101007_create_rekam_diagnosa_table', 1),
(36, '2023_11_25_204100_create_rekam_umums_table', 1),
(37, '2023_11_25_204113_create_rekam_radiologis_table', 1),
(38, '2023_11_25_212042_create_rekam_odontograms_table', 1),
(39, '2023_11_26_134241_create_rekam_tindakans_table', 1),
(40, '2023_11_26_134529_create_rekam_reseps_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
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
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `kd_obat`, `nama`, `satuan`, `stok`, `foto`, `harga`, `is_bpjs`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'OK', 'Obat OB', 'pcs', 2, NULL, 2000, 1, '2024-02-19 00:30:08', '2024-02-25 17:02:56', NULL),
(2, 'OB', 'Obat Batuk', 'pcs', 22, NULL, 7500, 1, '2024-02-22 16:19:52', '2024-02-25 17:06:08', NULL),
(3, 'OC', 'Obat Cacar', 'pcx', 7, NULL, 24000, 1, '2024-02-22 16:20:11', '2024-02-22 17:31:21', NULL),
(4, 'KO', 'Kulit Or', 'PRD', 10, NULL, 1200, 1, '2024-02-22 16:20:38', '2024-02-22 16:31:50', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` bigint UNSIGNED NOT NULL,
  `no_rm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medical_record_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `no_rm`, `medical_record_id`, `nama`, `tmp_lahir`, `tgl_lahir`, `jk`, `alamat_lengkap`, `kelurahan`, `kecamatan`, `kabupaten`, `kodepos`, `agama`, `status_menikah`, `pendidikan`, `pekerjaan`, `kewarganegaraan`, `no_hp`, `cara_bayar`, `no_bpjs`, `alergi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 'D0013', 'FLH/250224', 'First Ludin Hida', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'WNI', '092324', 'Umum/Mandiri', NULL, NULL, '2024-02-22 15:57:28', '2024-02-25 15:50:52', NULL),
(14, 'A0014', 'CM/250224', 'Cucu Marico', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'WNI', '08232143', 'Umum/Mandiri', NULL, NULL, '2024-02-22 15:57:59', '2024-02-25 15:50:52', NULL),
(15, 'D0015', 'DS/250224', 'Domo Sam', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'WNI', '082321', 'Umum/Mandiri', NULL, NULL, '2024-02-22 15:58:10', '2024-02-25 15:50:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran_obat`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gigi dan Mulut', 1, '2024-01-21 13:21:34', '2024-01-21 13:21:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam`
--

CREATE TABLE `rekam` (
  `id` bigint UNSIGNED NOT NULL,
  `pasien_id` int UNSIGNED NOT NULL,
  `dokter_id` int UNSIGNED NOT NULL,
  `petugas_id` int UNSIGNED NOT NULL,
  `poli_id` int NOT NULL,
  `tgl_rekam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya_tindakan` int NOT NULL DEFAULT '0',
  `biaya_resep` int NOT NULL DEFAULT '0',
  `diskon` int NOT NULL DEFAULT '0',
  `jumlah_uang` int NOT NULL DEFAULT '0',
  `tipe_pasien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cara_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekam`
--

INSERT INTO `rekam` (`id`, `pasien_id`, `dokter_id`, `petugas_id`, `poli_id`, `tgl_rekam`, `biaya_tindakan`, `biaya_resep`, `diskon`, `jumlah_uang`, `tipe_pasien`, `cara_bayar`, `platform_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(10, 14, 1, 1, 1, '2024-02-18', 20000, 4000, 0, 24000, 'Umum/Mandiri', 'non_tunai', 'QRSI', 5, '2024-02-22 15:58:21', '2024-02-22 15:59:16'),
(11, 13, 1, 1, 1, '2024-02-21', 0, 21400, 0, 21400, 'Umum/Mandiri', 'non_tunai', 'Qris', 5, '2024-02-22 15:58:39', '2024-02-25 17:00:53'),
(12, 14, 1, 1, 1, '2024-02-18', 40000, 46500, 0, 86500, 'Umum/Mandiri', 'non_tunai', 'TF BRIS', 5, '2024-02-22 15:59:27', '2024-02-25 17:01:13'),
(13, 15, 1, 1, 1, '2024-02-26', 20000, 2000, 0, 22000, 'Umum/Mandiri', 'non_tunai', 'Qris', 5, '2024-02-25 17:00:31', '2024-02-25 17:03:04'),
(14, 14, 1, 1, 1, '2024-02-26', 15000, 7500, 0, 22500, 'Umum/Mandiri', 'non_tunai', 'TF BRIS', 5, '2024-02-25 17:01:28', '2024-02-25 17:03:41'),
(15, 13, 1, 1, 1, '2024-02-26', 89000, 7500, 0, 96500, 'Umum/Mandiri', 'non_tunai', 'TF BRIS', 5, '2024-02-25 17:01:43', '2024-02-25 17:04:14'),
(16, 14, 1, 1, 1, '2024-02-21', 20000, 7500, 0, 27500, 'Umum/Mandiri', 'non_tunai', 'Qris', 5, '2024-02-25 17:04:35', '2024-02-25 17:06:17'),
(17, 13, 1, 1, 1, '2024-02-18', 0, 0, 0, 0, 'Umum/Mandiri', NULL, NULL, 1, '2024-02-25 17:04:58', '2024-02-25 17:04:58'),
(18, 15, 1, 1, 1, '2024-02-21', 0, 0, 0, 0, 'Umum/Mandiri', NULL, NULL, 1, '2024-02-25 17:05:17', '2024-02-25 17:05:17'),
(19, 14, 1, 1, 1, '2024-02-18', 0, 0, 0, 0, 'Umum/Mandiri', NULL, NULL, 1, '2024-02-25 17:06:53', '2024-02-25 17:06:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_diagnosis`
--

CREATE TABLE `rekam_diagnosis` (
  `id` bigint UNSIGNED NOT NULL,
  `rekam_id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `diagnosa_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosa_sekunder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosa_tambahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terapi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edukasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekam_diagnosis`
--

INSERT INTO `rekam_diagnosis` (`id`, `rekam_id`, `pasien_id`, `diagnosa_utama`, `diagnosa_sekunder`, `diagnosa_tambahan`, `terapi`, `edukasi`, `created_at`, `updated_at`) VALUES
(1, 5, 8, 'salah makan', NULL, NULL, NULL, NULL, '2024-02-01 17:29:00', '2024-02-01 17:29:00'),
(2, 10, 14, 'salah makan', NULL, NULL, NULL, NULL, '2024-02-22 15:58:58', '2024-02-22 15:58:58'),
(3, 13, 15, 'salah makan', NULL, NULL, NULL, NULL, '2024-02-25 17:02:47', '2024-02-25 17:02:47'),
(4, 14, 14, 'salah minum', NULL, NULL, NULL, NULL, '2024-02-25 17:03:23', '2024-02-25 17:03:23'),
(5, 15, 13, 'Cedera Lidah', NULL, NULL, NULL, NULL, '2024-02-25 17:03:56', '2024-02-25 17:03:56'),
(6, 16, 14, 'salah makan', NULL, NULL, NULL, NULL, '2024-02-25 17:06:01', '2024-02-25 17:06:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_gigi`
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
-- Struktur dari tabel `rekam_odontograms`
--

CREATE TABLE `rekam_odontograms` (
  `id` bigint UNSIGNED NOT NULL,
  `rekam_id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `ur_11` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_12` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_13` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_14` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_15` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_16` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_17` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ur_18` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_21` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_22` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_23` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_24` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_25` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_26` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_27` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ul_28` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ll_31` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ll_32` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ll_33` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ll_34` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ll_35` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ll_36` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ll_37` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ll_38` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lr_41` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lr_42` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lr_43` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lr_44` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lr_45` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lr_46` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lr_47` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lr_48` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_file_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekam_odontograms`
--

INSERT INTO `rekam_odontograms` (`id`, `rekam_id`, `pasien_id`, `ur_11`, `ur_12`, `ur_13`, `ur_14`, `ur_15`, `ur_16`, `ur_17`, `ur_18`, `ul_21`, `ul_22`, `ul_23`, `ul_24`, `ul_25`, `ul_26`, `ul_27`, `ul_28`, `ll_31`, `ll_32`, `ll_33`, `ll_34`, `ll_35`, `ll_36`, `ll_37`, `ll_38`, `lr_41`, `lr_42`, `lr_43`, `lr_44`, `lr_45`, `lr_46`, `lr_47`, `lr_48`, `additional_file`, `additional_file_1`, `created_at`, `updated_at`) VALUES
(1, 5, 8, 'Kanan atas normal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Normal Sekali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-01 17:27:59', '2024-02-01 17:28:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_radiologis`
--

CREATE TABLE `rekam_radiologis` (
  `id` bigint UNSIGNED NOT NULL,
  `rekam_id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `tipe_muka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profil_muka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relasi_bibir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garis_median_ra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garis_median_rb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_normal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_keluhan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_riwayat_tmd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_kelainan_lain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_oklusi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_torus_palatinus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_torus_mandibularis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_palatum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_diastema` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_gigi_anomali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_dmf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmj_lain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opg_jumlah_gigi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opg_impaksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opg_posisi_m3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opg_karies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opg_tmj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opg_lainnya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_sna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_snb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_anb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_relasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_ira_irb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_ira_na` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_ira_sn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_ira_mp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sf_go_angle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekam_radiologis`
--

INSERT INTO `rekam_radiologis` (`id`, `rekam_id`, `pasien_id`, `tipe_muka`, `profil_muka`, `relasi_bibir`, `garis_median_ra`, `garis_median_rb`, `tmj_normal`, `tmj_keluhan`, `tmj_riwayat_tmd`, `tmj_kelainan_lain`, `tmj_oklusi`, `tmj_torus_palatinus`, `tmj_torus_mandibularis`, `tmj_palatum`, `tmj_diastema`, `tmj_gigi_anomali`, `tmj_dmf`, `tmj_lain`, `opg_jumlah_gigi`, `opg_impaksi`, `opg_posisi_m3`, `opg_karies`, `opg_tmj`, `opg_lainnya`, `sf_sna`, `sf_snb`, `sf_anb`, `sf_relasi`, `sf_ira_irb`, `sf_ira_na`, `sf_ira_sn`, `sf_ira_mp`, `sf_go_angle`, `created_at`, `updated_at`) VALUES
(1, 5, 8, 'Lonj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-01 17:27:52', '2024-02-01 17:27:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_reseps`
--

CREATE TABLE `rekam_reseps` (
  `id` bigint UNSIGNED NOT NULL,
  `rekam_id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `obat_id` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_satuan` int DEFAULT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekam_reseps`
--

INSERT INTO `rekam_reseps` (`id`, `rekam_id`, `pasien_id`, `obat_id`, `nama`, `harga_satuan`, `satuan`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 5, 8, 1, 'Obat OB', 2000, 'pcs', 2, '2024-02-19 00:30:23', '2024-02-19 00:30:23'),
(2, 10, 14, 1, 'Obat OB', 2000, 'pcs', 2, '2024-02-22 15:59:06', '2024-02-22 15:59:06'),
(4, 11, 13, 2, 'Obat Batuk', 7500, 'pcs', 2, '2024-02-22 16:31:28', '2024-02-22 16:31:28'),
(5, 11, 13, 1, 'Obat OB', 2000, 'pcs', 2, '2024-02-22 16:31:45', '2024-02-22 16:31:45'),
(6, 11, 13, 4, 'Kulit Or', 1200, 'PRD', 2, '2024-02-22 16:31:50', '2024-02-22 16:31:50'),
(7, 12, 14, 2, 'Obat Batuk', 7500, 'pcs', 3, '2024-02-22 17:31:09', '2024-02-22 17:31:09'),
(8, 12, 14, 3, 'Obat Cacar', 24000, 'pcx', 1, '2024-02-22 17:31:21', '2024-02-22 17:31:21'),
(9, 13, 15, 1, 'Obat OB', 2000, 'pcs', 1, '2024-02-25 17:02:56', '2024-02-25 17:02:56'),
(10, 14, 14, 2, 'Obat Batuk', 7500, 'pcs', 1, '2024-02-25 17:03:32', '2024-02-25 17:03:32'),
(11, 15, 13, 2, 'Obat Batuk', 7500, 'pcs', 1, '2024-02-25 17:04:05', '2024-02-25 17:04:05'),
(12, 16, 14, 2, 'Obat Batuk', 7500, 'pcs', 1, '2024-02-25 17:06:08', '2024-02-25 17:06:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_tindakans`
--

CREATE TABLE `rekam_tindakans` (
  `id` bigint UNSIGNED NOT NULL,
  `rekam_id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `tindakan_id` int NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekam_tindakans`
--

INSERT INTO `rekam_tindakans` (`id`, `rekam_id`, `pasien_id`, `tindakan_id`, `kode`, `nama`, `harga`, `created_at`, `updated_at`) VALUES
(1, 5, 8, 1, 'PEM', 'Pemeriksaan', 20000, '2024-02-19 00:30:17', '2024-02-19 00:30:17'),
(2, 10, 14, 1, 'PEM', 'Pemeriksaan', 20000, '2024-02-22 15:59:01', '2024-02-22 15:59:01'),
(3, 12, 14, 1, 'PEM', 'Pemeriksaan', 20000, '2024-02-22 17:33:46', '2024-02-22 17:33:46'),
(4, 12, 14, 1, 'PEM', 'Pemeriksaan', 20000, '2024-02-22 17:33:49', '2024-02-22 17:33:49'),
(5, 13, 15, 1, 'PEM', 'Pemeriksaan', 20000, '2024-02-25 17:02:50', '2024-02-25 17:02:50'),
(6, 14, 14, 2, 'SU', 'Suntik', 15000, '2024-02-25 17:03:27', '2024-02-25 17:03:27'),
(7, 15, 13, 3, 'CA', 'Cabut', 89000, '2024-02-25 17:03:59', '2024-02-25 17:03:59'),
(8, 16, 14, 1, 'PEM', 'Pemeriksaan', 20000, '2024-02-25 17:06:04', '2024-02-25 17:06:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_umums`
--

CREATE TABLE `rekam_umums` (
  `id` bigint UNSIGNED NOT NULL,
  `rekam_id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `keluhan_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keluhan_tambahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nadi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suhu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pernafasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tekanan_darah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinggi_badan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat_badan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelainan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penyakit_penyerta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alergi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oral_habit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekam_umums`
--

INSERT INTO `rekam_umums` (`id`, `rekam_id`, `pasien_id`, `keluhan_utama`, `keluhan_tambahan`, `nadi`, `suhu`, `pernafasan`, `tekanan_darah`, `tinggi_badan`, `berat_badan`, `kelainan`, `penyakit_penyerta`, `alergi`, `oral_habit`, `created_at`, `updated_at`) VALUES
(1, 5, 8, 'Sakit gigi atas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-01 17:24:38', '2024-02-01 17:24:38'),
(2, 10, 14, 'sakit gigi geraham', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-22 15:58:49', '2024-02-22 15:58:49'),
(3, 13, 15, 'sakit gigi geraham', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-25 17:02:37', '2024-02-25 17:02:37'),
(4, 14, 14, 'sakit gigi geraham', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-25 17:03:15', '2024-02-25 17:03:15'),
(5, 15, 13, 'sakit gigi geraham la', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-25 17:03:50', '2024-02-25 17:03:50'),
(6, 16, 14, 'sakit gigi geraham la', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-25 17:05:55', '2024-02-25 17:05:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tindakan`
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
-- Dumping data untuk tabel `tindakan`
--

INSERT INTO `tindakan` (`id`, `poli`, `kode`, `nama`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Gigi dan Mulut', 'PEM', 'Pemeriksaan', 20000, '2024-02-19 00:29:41', '2024-02-19 00:29:41'),
(2, 'Gigi dan Mulut', 'SU', 'Suntik', 15000, '2024-02-22 16:20:54', '2024-02-22 16:20:54'),
(3, 'Gigi dan Mulut', 'CA', 'Cabut', 89000, '2024-02-22 16:21:05', '2024-02-22 16:21:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '08123456789', 'admin@admin.com', NULL, '$2y$10$h8GXhtSBs002gikUQzaRtuYb7cQb0UaYauN/eSTFh3rp94s4lRMrm', 1, 1, 'EvCf0yFD9xefL0OUXJFjGSQ7BzHSUkk3In8fobLSnnyYvCWDcyq8bJaZ05XH', '2024-01-21 13:21:34', '2024-01-21 13:21:34'),
(2, 'Dimas', '0987654321', 'dimas@dimas.com', NULL, '$2y$10$FkoMUov5ZdERzznzq2Qte.5hAodTVCgW5rKA3Bl/F.aHhsgT4dBOO', 3, 1, '7VSRrWorGEitS7Ajkgf617LVPbVjpCXPilKU4DCZIxeVZplpiaYGaOP4JLSo', '2024-01-21 13:21:34', '2024-01-21 13:21:34');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `icds`
--
ALTER TABLE `icds`
  ADD PRIMARY KEY (`code`);

--
-- Indeks untuk tabel `kondisi_gigi`
--
ALTER TABLE `kondisi_gigi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pengeluaran_obat`
--
ALTER TABLE `pengeluaran_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekam`
--
ALTER TABLE `rekam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekam_diagnosis`
--
ALTER TABLE `rekam_diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekam_gigi`
--
ALTER TABLE `rekam_gigi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekam_odontograms`
--
ALTER TABLE `rekam_odontograms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekam_radiologis`
--
ALTER TABLE `rekam_radiologis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekam_reseps`
--
ALTER TABLE `rekam_reseps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekam_tindakans`
--
ALTER TABLE `rekam_tindakans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekam_umums`
--
ALTER TABLE `rekam_umums`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kondisi_gigi`
--
ALTER TABLE `kondisi_gigi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran_obat`
--
ALTER TABLE `pengeluaran_obat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rekam`
--
ALTER TABLE `rekam`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `rekam_diagnosis`
--
ALTER TABLE `rekam_diagnosis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `rekam_gigi`
--
ALTER TABLE `rekam_gigi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekam_odontograms`
--
ALTER TABLE `rekam_odontograms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rekam_radiologis`
--
ALTER TABLE `rekam_radiologis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rekam_reseps`
--
ALTER TABLE `rekam_reseps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `rekam_tindakans`
--
ALTER TABLE `rekam_tindakans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rekam_umums`
--
ALTER TABLE `rekam_umums`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

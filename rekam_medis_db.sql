-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2023 at 06:48 AM
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
(76, '2023_05_17_021102_create_poli_table', 2),
(77, '2023_05_18_235916_create_pengeluaran_obat_table', 2),
(78, '2023_05_19_233941_create_notifications_table', 2),
(79, '2023_05_20_163802_create_tindakan_table', 2),
(80, '2023_05_21_141004_create_kondisi_gigi_table', 2),
(81, '2023_05_21_141055_create_icds_table', 2),
(82, '2023_06_13_033252_create_rekam_table', 2),
(83, '2023_06_20_133306_create_rekam_gigi_table', 2),
(84, '2023_07_13_101007_create_rekam_diagnosa_table', 2),
(85, '2023_11_25_204100_create_rekam_umums_table', 2),
(86, '2023_11_25_204113_create_rekam_radiologis_table', 2),
(87, '2023_11_25_212042_create_rekam_odontograms_table', 2),
(88, '2023_11_26_134241_create_rekam_tindakans_table', 2),
(89, '2023_11_26_134529_create_rekam_reseps_table', 2);

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
(2, 'DB-02', 'Bana Saja', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, NULL, NULL, NULL, 'Belum Menikah', NULL, NULL, 'WNI', '086543', 'Umum/Mandiri', '3521118887', NULL, '2023-11-17 23:27:48', '2023-11-17 23:27:48', NULL);

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
(1, 'Gigi dan Mulut', 1, '2023-11-30 15:27:34', '2023-11-30 15:27:34');

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
  `petugas_id` int UNSIGNED NOT NULL,
  `poli_id` int NOT NULL,
  `biaya_tindakan` int NOT NULL DEFAULT '0',
  `biaya_resep` int NOT NULL DEFAULT '0',
  `diskon` int NOT NULL DEFAULT '0',
  `cara_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uang` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekam`
--

INSERT INTO `rekam` (`id`, `no_rekam`, `tgl_rekam`, `pasien_id`, `dokter_id`, `petugas_id`, `poli_id`, `biaya_tindakan`, `biaya_resep`, `diskon`, `cara_bayar`, `uang`, `status`, `created_at`, `updated_at`) VALUES
(1, 'REG#202311302', '2023-11-30', 2, 1, 1, 1, 0, 0, 0, 'Umum/Mandiri', 0, 1, '2023-11-30 15:27:44', '2023-11-30 15:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_diagnosis`
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
-- Dumping data for table `rekam_diagnosis`
--

INSERT INTO `rekam_diagnosis` (`id`, `rekam_id`, `pasien_id`, `diagnosa_utama`, `diagnosa_sekunder`, `diagnosa_tambahan`, `terapi`, `edukasi`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'salah makan', 'tambah makanan berat mulu', 'tambahannya ini lagi', 'makan bubur aja yaa', 'jaga kesehatan gigi', '2023-12-02 00:31:13', '2023-12-02 00:31:52');

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
-- Table structure for table `rekam_odontograms`
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekam_odontograms`
--

INSERT INTO `rekam_odontograms` (`id`, `rekam_id`, `pasien_id`, `ur_11`, `ur_12`, `ur_13`, `ur_14`, `ur_15`, `ur_16`, `ur_17`, `ur_18`, `ul_21`, `ul_22`, `ul_23`, `ul_24`, `ul_25`, `ul_26`, `ul_27`, `ul_28`, `ll_31`, `ll_32`, `ll_33`, `ll_34`, `ll_35`, `ll_36`, `ll_37`, `ll_38`, `lr_41`, `lr_42`, `lr_43`, `lr_44`, `lr_45`, `lr_46`, `lr_47`, `lr_48`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Kanan atas normal', 'normal juga', '99% norma;', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'paling bontot juga normal', '2023-12-02 00:26:54', '2023-12-02 00:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_radiologis`
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
-- Dumping data for table `rekam_radiologis`
--

INSERT INTO `rekam_radiologis` (`id`, `rekam_id`, `pasien_id`, `tipe_muka`, `profil_muka`, `relasi_bibir`, `garis_median_ra`, `garis_median_rb`, `tmj_normal`, `tmj_keluhan`, `tmj_riwayat_tmd`, `tmj_kelainan_lain`, `tmj_oklusi`, `tmj_torus_palatinus`, `tmj_torus_mandibularis`, `tmj_palatum`, `tmj_diastema`, `tmj_gigi_anomali`, `tmj_dmf`, `tmj_lain`, `opg_jumlah_gigi`, `opg_impaksi`, `opg_posisi_m3`, `opg_karies`, `opg_tmj`, `opg_lainnya`, `sf_sna`, `sf_snb`, `sf_anb`, `sf_relasi`, `sf_ira_irb`, `sf_ira_na`, `sf_ira_sn`, `sf_ira_mp`, `sf_go_angle`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Normal saja', 'Lonjong keren', 'seimbang gaes', 'Pas di tengah RA', 'Agak ke samping RB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-01 23:47:07', '2023-12-02 00:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_reseps`
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

-- --------------------------------------------------------

--
-- Table structure for table `rekam_tindakans`
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

-- --------------------------------------------------------

--
-- Table structure for table `rekam_umums`
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
-- Dumping data for table `rekam_umums`
--

INSERT INTO `rekam_umums` (`id`, `rekam_id`, `pasien_id`, `keluhan_utama`, `keluhan_tambahan`, `nadi`, `suhu`, `pernafasan`, `tekanan_darah`, `tinggi_badan`, `berat_badan`, `kelainan`, `penyakit_penyerta`, `alergi`, `oral_habit`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'sakit gigi geraham-nya sama dengan tiga', 'gigi depan mau copot loo yaa', 'baik dan normal', '90', NULL, '160', '170', '60', NULL, 'anemia, dan neh', 'alergi panas', NULL, '2023-12-01 00:15:57', '2023-12-02 00:19:52');

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
(1, 'Admin', '08123456789', 'admin@admin.com', NULL, '$2y$10$80nFNa8uGbtyjHy5.fTxB.Q0FobskScGjgmPCfbub1dFE27aPMxku', 1, 1, 'QxJAQZiDc4QHANt3wOJtiZxZQl6T4BluUpJU4wo8VN8AlfDvApIU7KBoGHO8', '2023-11-17 16:04:13', '2023-11-17 16:04:13'),
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
-- Indexes for table `rekam_diagnosis`
--
ALTER TABLE `rekam_diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_gigi`
--
ALTER TABLE `rekam_gigi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_odontograms`
--
ALTER TABLE `rekam_odontograms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_radiologis`
--
ALTER TABLE `rekam_radiologis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_reseps`
--
ALTER TABLE `rekam_reseps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_tindakans`
--
ALTER TABLE `rekam_tindakans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_umums`
--
ALTER TABLE `rekam_umums`
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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengeluaran_obat`
--
ALTER TABLE `pengeluaran_obat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekam`
--
ALTER TABLE `rekam`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekam_diagnosis`
--
ALTER TABLE `rekam_diagnosis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekam_gigi`
--
ALTER TABLE `rekam_gigi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekam_odontograms`
--
ALTER TABLE `rekam_odontograms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekam_radiologis`
--
ALTER TABLE `rekam_radiologis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekam_reseps`
--
ALTER TABLE `rekam_reseps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekam_tindakans`
--
ALTER TABLE `rekam_tindakans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekam_umums`
--
ALTER TABLE `rekam_umums`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

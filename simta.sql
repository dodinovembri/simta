-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2020 at 03:42 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simta`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `angkatan` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bidang_ilmu`
--

CREATE TABLE `bidang_ilmu` (
  `id` int(10) UNSIGNED NOT NULL,
  `bidang_ilmu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ceklis_syarat_ta_1`
--

CREATE TABLE `ceklis_syarat_ta_1` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ceklis_syarat_ta_2`
--

CREATE TABLE `ceklis_syarat_ta_2` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_bidang_ilmu` int(10) UNSIGNED NOT NULL,
  `verified_login` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_pembimbing`
--

CREATE TABLE `dosen_pembimbing` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_status_penguji` int(11) NOT NULL DEFAULT '1',
  `ket` text COLLATE utf8_unicode_ci,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_pembimbing_history`
--

CREATE TABLE `dosen_pembimbing_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_status_agree` int(11) NOT NULL DEFAULT '1',
  `ket` text COLLATE utf8_unicode_ci,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_penguji_ta_1`
--

CREATE TABLE `history_penguji_ta_1` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status_penguji` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_agree_penguji` int(11) NOT NULL DEFAULT '0',
  `ket` text COLLATE utf8_unicode_ci,
  `jadwal` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_penguji_ta_2`
--

CREATE TABLE `history_penguji_ta_2` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status_penguji` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_agree_penguji` int(11) NOT NULL DEFAULT '0',
  `ket` text COLLATE utf8_unicode_ci,
  `jadwal` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(10) UNSIGNED NOT NULL,
  `jurusan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status_aktif` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nip_pa` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_kkt_file` int(11) NOT NULL DEFAULT '0',
  `id_angkatan` int(10) UNSIGNED NOT NULL,
  `id_jurusan` int(10) UNSIGNED NOT NULL,
  `status_aktif` int(11) NOT NULL DEFAULT '1',
  `verified_login` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mhs_history_ta`
--

CREATE TABLE `mhs_history_ta` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_status_ta` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mhs_kkt_file`
--

CREATE TABLE `mhs_kkt_file` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kp_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `krs_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transkrip_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_sks_tempuh` int(11) NOT NULL,
  `jumlah_sks_transkrip` int(11) NOT NULL,
  `total_sks` int(11) NOT NULL,
  `ket` text COLLATE utf8_unicode_ci,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mhs_kkt_file_history`
--

CREATE TABLE `mhs_kkt_file_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kp_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `krs_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `transkrip_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_sks_tempuh` int(11) NOT NULL,
  `jumlah_sks_transkrip` int(11) NOT NULL,
  `total_sks` int(11) NOT NULL,
  `ket` text COLLATE utf8_unicode_ci,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mhs_perpanjang_sempro`
--

CREATE TABLE `mhs_perpanjang_sempro` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_topik_ta` int(11) NOT NULL,
  `judul_ta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_status_agree_perpanjang` int(11) NOT NULL DEFAULT '1',
  `file_perpanjang` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ket` text COLLATE utf8_unicode_ci,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mhs_perpanjang_sempro_history`
--

CREATE TABLE `mhs_perpanjang_sempro_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_topik_ta` int(11) NOT NULL,
  `judul_ta` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_status_agree_perpanjang` int(11) NOT NULL DEFAULT '1',
  `file_perpanjang` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ket` text COLLATE utf8_unicode_ci,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mhs_perpanjang_ta_2`
--

CREATE TABLE `mhs_perpanjang_ta_2` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_topik_ta` int(11) NOT NULL,
  `judul_ta` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_status_agree_perpanjang` int(11) NOT NULL DEFAULT '1',
  `file_perpanjang` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ket` text COLLATE utf8_unicode_ci,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mhs_perpanjang_ta_2_history`
--

CREATE TABLE `mhs_perpanjang_ta_2_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_topik_ta` int(11) NOT NULL,
  `judul_ta` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_status_agree_perpanjang` int(11) NOT NULL DEFAULT '1',
  `file_perpanjang` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ket` text COLLATE utf8_unicode_ci,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mhs_sk_ta`
--

CREATE TABLE `mhs_sk_ta` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_sk_ta` date NOT NULL,
  `sk_ta_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_sk_ta_type` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mhs_topik_ta`
--

CREATE TABLE `mhs_topik_ta` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_topik_ta` int(11) NOT NULL,
  `judul_ta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_status_agree_topik` int(11) NOT NULL DEFAULT '1',
  `file_konsultasi` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ket` text COLLATE utf8_unicode_ci,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2020_01_04_143748_create_ceklis_syarat_ta_1', 1),
('2020_01_05_021426_create_ceklis_syarat_ta_2', 1),
('2020_01_05_021507_create_history_penguji_t_2', 1),
('2020_01_05_021520_create_history_penguji_t_1', 1),
('2020_01_05_021540_create_penguji_t_1', 1),
('2020_01_05_021553_create_penguji_t_2', 1),
('2020_01_05_021629_create_status_ta_2', 1),
('2020_01_05_021640_create_status_ta_1', 1),
('2020_01_05_021739_create_ta_2_history', 1),
('2020_01_05_021753_create_ta_1_history', 1),
('2020_01_05_021809_create_ta_1', 1),
('2020_01_05_021829_create_ta_2', 1),
('2020_01_05_021909_create_mhs_kkt_file_history', 1),
('2020_01_05_021932_create_mhs_kkt_file', 1),
('2020_01_05_022003_create_mhs_history_ta', 1),
('2020_01_05_022109_create_status_ta', 1),
('2020_01_05_022132_create_angkatan', 1),
('2020_01_05_022153_create_jurusan', 1),
('2020_01_05_022213_create_mhs', 1),
('2020_01_05_022244_create_status_agree_pembimbing', 1),
('2020_01_05_022311_create_dosen_pembimbing', 1),
('2020_01_05_022347_create_status_agree_topik', 1),
('2020_01_05_022413_create_mhs_topik_ta', 1),
('2020_01_05_022445_create_user_group', 1),
('2020_01_05_022522_create_sk_ta_type', 1),
('2020_01_05_022601_create_dosen_pembimbing_history', 1),
('2020_01_05_022643_create_mhs_sk_ta', 1),
('2020_01_05_022701_create_dosen', 1),
('2020_01_05_022733_create_topik_ta_history', 1),
('2020_01_05_022810_create_bidang_ilmu', 1),
('2020_01_05_022835_create_sk_ta_history', 1),
('2020_01_08_153737_add_role_id_to_users_table', 2),
('2020_01_08_154525_create_user_role', 3),
('2020_01_09_003453_create_user_roles_table', 4),
('2020_01_12_123452_rename_email_to_nim', 5),
('2020_01_15_010101_Roles_table_migration', 6),
('2020_01_18_092648_create_topik_ta', 7),
('2020_01_19_145217_add_nip_pa', 8),
('2020_01_19_154652_create_table_mhs_perpanjang_sempro', 9),
('2020_01_19_154917_create_table_mhs_perpanjang_sempro_history', 9),
('2020_01_19_155434_rename_file_konsultasi', 10),
('2020_01_19_155520_rename_file_konsultasi', 11),
('2020_01_19_155520_rename_file_konsultasi_history', 12),
('2020_01_31_092934_create_table_mhs_perpanjang_ta_2', 12),
('2020_01_31_093018_create_table_mhs_perpanjang_ta_2_history', 12),
('2020_01_31_102634_create_mhs_perpanjang_ta_2s_table', 13),
('2020_01_31_102808_create_mhs_perpanjang_ta_2_histories_table', 13),
('2020_01_31_103441_renameFileKonsultasi', 13),
('2020_01_31_103759_renameFilekonsultasiHistory', 13),
('2020_02_05_181054_add_cloumn_tanggal', 14),
('2020_02_05_181428_change_data_type_column_jadwal', 15),
('2020_02_05_181619_add_cloumn_tanggal', 16),
('2020_02_08_151723_create_table_notifications', 17),
('2020_02_08_152836_create_notifications_models_table', 18),
('2020_02_08_162611_add_some_column_at_notifications', 19),
('2020_02_12_103337_add_tgltota_2', 20),
('2020_02_12_103420_add_tgltota_2history', 20),
('2020_03_16_214426_AddPhotoColumn', 21),
('2020_03_17_071526_AddColumnPhoto', 21);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `identity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penguji_ta_1`
--

CREATE TABLE `penguji_ta_1` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status_penguji` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_agree_penguji` int(11) NOT NULL DEFAULT '0',
  `ket` text COLLATE utf8_unicode_ci,
  `jadwal` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penguji_ta_2`
--

CREATE TABLE `penguji_ta_2` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status_penguji` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_agree_penguji` int(11) NOT NULL DEFAULT '0',
  `ket` text COLLATE utf8_unicode_ci,
  `jadwal` datetime DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '', '2020-01-15 10:14:31', '2020-01-15 10:14:31'),
(2, 'Pengelola', '', '2020-01-15 10:14:31', '2020-01-15 10:14:31'),
(3, 'Dosen', '', '2020-01-15 10:14:31', '2020-01-15 10:14:31'),
(4, 'Mahasiswa', '', '2020-01-15 10:14:32', '2020-01-15 10:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `sk_ta_history`
--

CREATE TABLE `sk_ta_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_sk_ta` date NOT NULL,
  `sk_ta_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_sk_ta_type` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_ta_type`
--

CREATE TABLE `sk_ta_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `sk_ta_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ta_1`
--

CREATE TABLE `ta_1` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jadwal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_status_ta_1` int(11) NOT NULL DEFAULT '1',
  `ruangan` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ta_1_history`
--

CREATE TABLE `ta_1_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jadwal` datetime DEFAULT NULL,
  `id_status_ta_1` int(11) NOT NULL DEFAULT '1',
  `ruangan` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ta_2`
--

CREATE TABLE `ta_2` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jadwal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_status_ta_2` int(11) NOT NULL DEFAULT '1',
  `ruangan` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ta_2_history`
--

CREATE TABLE `ta_2_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jadwal` datetime DEFAULT NULL,
  `id_status_ta_2` int(11) NOT NULL DEFAULT '1',
  `ruangan` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topik_ta`
--

CREATE TABLE `topik_ta` (
  `id` int(10) UNSIGNED NOT NULL,
  `topik_ta` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topik_ta_history`
--

CREATE TABLE `topik_ta_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_topik_ta` int(11) NOT NULL,
  `judul_ta` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_status_agree_topik` int(11) NOT NULL DEFAULT '1',
  `file_konsultasi` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ket` text COLLATE utf8_unicode_ci,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `role_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 1, '$2y$10$/BkdcBbZngWXjulSoPqmhOam/aMS.hXfz/rIz3gzO.OphoaOfDxzq', 'gLNYnLEPhv9g68sdHsdLLk5h0rkgvmLFbCTa0In7UB1MuwDf3iN28sNvttPQ', '2020-01-06 23:53:29', '2020-03-19 01:29:07'),
(2, 'Pengelola', 'pengelola', 2, '$2y$10$GY/4N.rcxpdlpqOfv0dzf.RIpsgX6tvJvFzpwJKMNe0DOCFTD762S', 'FOB9cacALLz5KjFLzM4doBaqDXVD9JQXwOEPB8chesEX9JtoQrENcOyhziu5', '2020-01-06 23:53:29', '2020-03-19 01:26:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidang_ilmu`
--
ALTER TABLE `bidang_ilmu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ceklis_syarat_ta_1`
--
ALTER TABLE `ceklis_syarat_ta_1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file_name` (`file_name`);

--
-- Indexes for table `ceklis_syarat_ta_2`
--
ALTER TABLE `ceklis_syarat_ta_2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file_name` (`file_name`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `id_bidang_ilmu` (`id_bidang_ilmu`);

--
-- Indexes for table `dosen_pembimbing`
--
ALTER TABLE `dosen_pembimbing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen_pembimbing_history`
--
ALTER TABLE `dosen_pembimbing_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_penguji_ta_1`
--
ALTER TABLE `history_penguji_ta_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_penguji_ta_2`
--
ALTER TABLE `history_penguji_ta_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip_pa` (`nip_pa`),
  ADD KEY `id_angkatan` (`id_angkatan`),
  ADD KEY `id_jurusan` (`id_jurusan`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `mhs_history_ta`
--
ALTER TABLE `mhs_history_ta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs_kkt_file`
--
ALTER TABLE `mhs_kkt_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `mhs_kkt_file_history`
--
ALTER TABLE `mhs_kkt_file_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs_perpanjang_sempro`
--
ALTER TABLE `mhs_perpanjang_sempro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs_perpanjang_sempro_history`
--
ALTER TABLE `mhs_perpanjang_sempro_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs_perpanjang_ta_2`
--
ALTER TABLE `mhs_perpanjang_ta_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs_perpanjang_ta_2_history`
--
ALTER TABLE `mhs_perpanjang_ta_2_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs_sk_ta`
--
ALTER TABLE `mhs_sk_ta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs_topik_ta`
--
ALTER TABLE `mhs_topik_ta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `penguji_ta_1`
--
ALTER TABLE `penguji_ta_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penguji_ta_2`
--
ALTER TABLE `penguji_ta_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sk_ta_history`
--
ALTER TABLE `sk_ta_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sk_ta_type`
--
ALTER TABLE `sk_ta_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_1`
--
ALTER TABLE `ta_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_1_history`
--
ALTER TABLE `ta_1_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_2`
--
ALTER TABLE `ta_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_2_history`
--
ALTER TABLE `ta_2_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topik_ta`
--
ALTER TABLE `topik_ta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topik_ta_history`
--
ALTER TABLE `topik_ta_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bidang_ilmu`
--
ALTER TABLE `bidang_ilmu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ceklis_syarat_ta_1`
--
ALTER TABLE `ceklis_syarat_ta_1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ceklis_syarat_ta_2`
--
ALTER TABLE `ceklis_syarat_ta_2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dosen_pembimbing`
--
ALTER TABLE `dosen_pembimbing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dosen_pembimbing_history`
--
ALTER TABLE `dosen_pembimbing_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `history_penguji_ta_1`
--
ALTER TABLE `history_penguji_ta_1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `history_penguji_ta_2`
--
ALTER TABLE `history_penguji_ta_2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mhs_history_ta`
--
ALTER TABLE `mhs_history_ta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mhs_kkt_file`
--
ALTER TABLE `mhs_kkt_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mhs_kkt_file_history`
--
ALTER TABLE `mhs_kkt_file_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mhs_perpanjang_sempro`
--
ALTER TABLE `mhs_perpanjang_sempro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mhs_perpanjang_sempro_history`
--
ALTER TABLE `mhs_perpanjang_sempro_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mhs_perpanjang_ta_2`
--
ALTER TABLE `mhs_perpanjang_ta_2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mhs_perpanjang_ta_2_history`
--
ALTER TABLE `mhs_perpanjang_ta_2_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mhs_sk_ta`
--
ALTER TABLE `mhs_sk_ta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mhs_topik_ta`
--
ALTER TABLE `mhs_topik_ta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penguji_ta_1`
--
ALTER TABLE `penguji_ta_1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penguji_ta_2`
--
ALTER TABLE `penguji_ta_2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sk_ta_history`
--
ALTER TABLE `sk_ta_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sk_ta_type`
--
ALTER TABLE `sk_ta_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ta_1`
--
ALTER TABLE `ta_1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ta_1_history`
--
ALTER TABLE `ta_1_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ta_2`
--
ALTER TABLE `ta_2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ta_2_history`
--
ALTER TABLE `ta_2_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topik_ta`
--
ALTER TABLE `topik_ta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topik_ta_history`
--
ALTER TABLE `topik_ta_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`id_bidang_ilmu`) REFERENCES `bidang_ilmu` (`id`);

--
-- Constraints for table `mhs`
--
ALTER TABLE `mhs`
  ADD CONSTRAINT `mhs_ibfk_1` FOREIGN KEY (`nip_pa`) REFERENCES `dosen` (`nip`),
  ADD CONSTRAINT `mhs_ibfk_2` FOREIGN KEY (`id_angkatan`) REFERENCES `angkatan` (`id`),
  ADD CONSTRAINT `mhs_ibfk_3` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id`);

--
-- Constraints for table `mhs_kkt_file`
--
ALTER TABLE `mhs_kkt_file`
  ADD CONSTRAINT `mhs_kkt_file_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mhs` (`nim`) ON UPDATE CASCADE;

--
-- Constraints for table `mhs_topik_ta`
--
ALTER TABLE `mhs_topik_ta`
  ADD CONSTRAINT `mhs_topik_ta_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mhs` (`nim`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

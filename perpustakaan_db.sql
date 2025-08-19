-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table perpustakaan_db.anggota
CREATE TABLE IF NOT EXISTS `anggota` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kelas_id` bigint unsigned DEFAULT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `anggota_nis_unique` (`nis`),
  KEY `anggota_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `anggota_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.anggota: ~2 rows (approximately)
INSERT INTO `anggota` (`id`, `kelas_id`, `nis`, `nama`, `jenis_kelamin`, `alamat`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 4, '19207123', 'Dava', 'Laki-laki', 'Jl. Kebenaran', '2025-08-08 10:19:00', '2025-08-08 10:19:00', NULL),
	(2, 6, '19207007', 'Dimas', 'Laki-laki', 'Jalan menuju surga', '2025-08-08 10:20:34', '2025-08-08 10:20:34', NULL),
	(3, 2, '19207098', 'hatake', 'Laki-laki', 'jl konoha', '2025-08-17 16:29:10', '2025-08-17 16:29:10', NULL);

-- Dumping structure for table perpustakaan_db.buku
CREATE TABLE IF NOT EXISTS `buku` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint unsigned DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int NOT NULL,
  `jumlah` int NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `buku_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `buku_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.buku: ~2 rows (approximately)
INSERT INTO `buku` (`id`, `kategori_id`, `judul`, `penulis`, `penerbit`, `tahun`, `jumlah`, `cover`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'Menjaga kebersihan', 'Hirokagawa', 'Nakatomo', 2024, 20, 'buku/01K25AYF3XN25MQ5SJST4J3SGZ.png', '2025-08-08 10:16:36', '2025-08-08 10:16:36', NULL),
	(2, 2, 'ensiklopedia', 'anjani', 'liza', 2024, 25, 'buku/01K25B0YVFF5JQZ3ZF2SV24KT9.jpg', '2025-08-08 10:17:58', '2025-08-08 10:17:58', NULL),
	(3, 3, 'One Piece ', 'Masdim', 'Nakatomo', 2025, 15, 'buku/01K2QF0V0JM4EENZ10JBDV902V.jpg', '2025-08-15 11:14:08', '2025-08-15 11:14:08', NULL);

-- Dumping structure for table perpustakaan_db.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.cache: ~5 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel_cache_livewire-rate-limiter:965a43fa7337ce0d1fc664eb662e3e161ddca656', 'i:1;', 1755624297),
	('laravel_cache_livewire-rate-limiter:965a43fa7337ce0d1fc664eb662e3e161ddca656:timer', 'i:1755624297;', 1755624297),
	('laravel_cache_livewire-rate-limiter:b2e27631fcaf1687ed6c07b2fff99eefc8b9c99a', 'i:3;', 1755626328),
	('laravel_cache_livewire-rate-limiter:b2e27631fcaf1687ed6c07b2fff99eefc8b9c99a:timer', 'i:1755626328;', 1755626328),
	('laravel_cache_spatie.permission.cache', 'a:3:{s:5:"alias";a:0:{}s:11:"permissions";a:0:{}s:5:"roles";a:0:{}}', 1755712629),
	('perpustakaan_sdn_tugu_utara_14_pagi_cache_livewire-rate-limiter:965a43fa7337ce0d1fc664eb662e3e161ddca656', 'i:1;', 1755629388),
	('perpustakaan_sdn_tugu_utara_14_pagi_cache_livewire-rate-limiter:965a43fa7337ce0d1fc664eb662e3e161ddca656:timer', 'i:1755629388;', 1755629388),
	('perpustakaan_sdn_tugu_utara_14_pagi_cache_livewire-rate-limiter:b2e27631fcaf1687ed6c07b2fff99eefc8b9c99a', 'i:1;', 1755629419),
	('perpustakaan_sdn_tugu_utara_14_pagi_cache_livewire-rate-limiter:b2e27631fcaf1687ed6c07b2fff99eefc8b9c99a:timer', 'i:1755629419;', 1755629419),
	('perpustakaan_sdn_tugu_utara_14_pagi_cache_spatie.permission.cache', 'a:3:{s:5:"alias";a:0:{}s:11:"permissions";a:0:{}s:5:"roles";a:0:{}}', 1755715729);

-- Dumping structure for table perpustakaan_db.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.cache_locks: ~0 rows (approximately)

-- Dumping structure for table perpustakaan_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table perpustakaan_db.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.jobs: ~0 rows (approximately)

-- Dumping structure for table perpustakaan_db.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.job_batches: ~0 rows (approximately)

-- Dumping structure for table perpustakaan_db.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori_nama_unique` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.kategori: ~2 rows (approximately)
INSERT INTO `kategori` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Fiksi', '2025-08-08 10:10:05', '2025-08-08 10:10:05', NULL),
	(2, 'Non Fiksi', '2025-08-08 10:10:05', '2025-08-08 10:10:05', NULL),
	(3, 'Anime', '2025-08-15 11:11:59', '2025-08-15 11:11:59', NULL);

-- Dumping structure for table perpustakaan_db.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kelas_kode_unique` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.kelas: ~6 rows (approximately)
INSERT INTO `kelas` (`id`, `kode`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'I', 'Satu', '2025-08-08 10:10:05', '2025-08-08 10:10:05', NULL),
	(2, 'II', 'Dua', '2025-08-08 10:10:05', '2025-08-08 10:10:05', NULL),
	(3, 'III', 'Tiga', '2025-08-08 10:10:05', '2025-08-08 10:10:05', NULL),
	(4, 'IV', 'Empat', '2025-08-08 10:10:05', '2025-08-08 10:10:05', NULL),
	(5, 'V', 'Lima', '2025-08-08 10:10:05', '2025-08-08 10:10:05', NULL),
	(6, 'VI', 'Enam', '2025-08-08 10:10:05', '2025-08-08 10:10:05', NULL);

-- Dumping structure for table perpustakaan_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.migrations: ~13 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_06_20_150937_create_kelas_table', 1),
	(5, '2025_06_20_150944_create_kategori_table', 1),
	(6, '2025_06_20_234126_create_anggota_table', 1),
	(7, '2025_06_20_235955_create_buku_table', 1),
	(8, '2025_06_21_002933_create_peminjaman_table', 1),
	(9, '2025_06_22_000000_create_pengembalians_table', 1),
	(10, '2025_07_30_172246_remove_nomor_transaksi_from_pengembalians_table', 1),
	(11, '2025_08_03_135738_create_permission_tables', 1),
	(12, '2025_08_03_183151_create_siswas_table', 1),
	(13, '2025_08_17_223824_create_pustakawans_table', 2),
	(15, '2025_06_22_000000_create_pengembalian_table', 3);

-- Dumping structure for table perpustakaan_db.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table perpustakaan_db.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.model_has_roles: ~2 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(1, 'App\\Models\\User', 6),
	(2, 'App\\Models\\User', 9);

-- Dumping structure for table perpustakaan_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table perpustakaan_db.peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `anggota_id` bigint unsigned DEFAULT NULL,
  `buku_id` bigint unsigned DEFAULT NULL,
  `petugas_id` bigint unsigned DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `peminjaman_anggota_id_foreign` (`anggota_id`),
  KEY `peminjaman_buku_id_foreign` (`buku_id`),
  KEY `peminjaman_petugas_id_foreign` (`petugas_id`),
  CONSTRAINT `peminjaman_anggota_id_foreign` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`) ON DELETE SET NULL,
  CONSTRAINT `peminjaman_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE SET NULL,
  CONSTRAINT `peminjaman_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.peminjaman: ~2 rows (approximately)
INSERT INTO `peminjaman` (`id`, `anggota_id`, `buku_id`, `petugas_id`, `tanggal_pinjam`, `tanggal_kembali`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 1, '2025-08-08', '2025-08-09', '2025-08-08 10:21:21', '2025-08-08 10:21:21', NULL),
	(2, 2, 2, 1, '2025-08-08', '2025-08-09', '2025-08-08 10:21:43', '2025-08-08 10:21:43', NULL),
	(3, 2, 1, 1, '2025-08-08', '2025-08-09', '2025-08-08 10:23:05', '2025-08-08 10:23:05', NULL),
	(4, 2, 3, 1, '2025-08-15', '2025-08-16', '2025-08-15 11:14:53', '2025-08-15 11:14:53', NULL);

-- Dumping structure for table perpustakaan_db.pengembalian
CREATE TABLE IF NOT EXISTS `pengembalian` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `peminjaman_id` bigint unsigned NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `denda` decimal(10,2) DEFAULT '0.00',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengembalian_peminjaman_id_foreign` (`peminjaman_id`),
  CONSTRAINT `pengembalian_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.pengembalian: ~0 rows (approximately)
INSERT INTO `pengembalian` (`id`, `peminjaman_id`, `tanggal_kembali`, `tanggal_pengembalian`, `status`, `denda`, `catatan`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 4, '2025-08-16', '2025-08-19', 'Terlambat', -3000.00, NULL, '2025-08-19 10:22:54', '2025-08-19 10:22:54', NULL);

-- Dumping structure for table perpustakaan_db.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.permissions: ~0 rows (approximately)

-- Dumping structure for table perpustakaan_db.pustakawans
CREATE TABLE IF NOT EXISTS `pustakawans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.pustakawans: ~0 rows (approximately)

-- Dumping structure for table perpustakaan_db.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'pustakawan', 'web', '2025-08-10 01:09:52', '2025-08-10 01:09:52'),
	(2, 'admin', 'web', '2025-08-10 01:31:03', '2025-08-10 01:31:03');

-- Dumping structure for table perpustakaan_db.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.role_has_permissions: ~0 rows (approximately)

-- Dumping structure for table perpustakaan_db.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.sessions: ~26 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('8RNQBD4jWdmbmyLjrweH1CrHYQakjQb1bIxPmJfc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiT1FNYkF2MFRXa2d0OG9CSE1MckJ6RUMwMDZrc0FMVURxeUpXNm5WRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755621785),
	('fWpT1WWMCy5VYYbNTycrrL1ne6RklTfPEvxnzwFK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZjE5OE1nbUtoZjBRampialoxVkNFbmdpM0M3TlRLd2hvbWNldnFsUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755621805),
	('gUkiYCEV8MpXTo1qQssXnZKPlaioEl3lNQYAJ6o0', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiQ2FpYkM4TlZQWXlIeEFPeWFPMUlnNVhDZDV2SVltSUpUUHNSSjlCeSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ5OiJodHRwOi8vcGVycHVzdGFrYWFuLXNkLnRlc3QvcHVzdGFrYXdhbi9wZW1pbmphbWFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTk6InBhc3N3b3JkX2hhc2hfYWRtaW4iO3M6NjA6IiQyeSQxMiRMbmNOVlpvS0tuNmhsMkF6TXYyNERPOGFKQWlNSDBaektHUXhWT09ReTJ1ODgwbWhrbFVBVyI7czo4OiJmaWxhbWVudCI7YTowOnt9czo1NzoibG9naW5fcHVzdGFrYXdhbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7czoyNDoicGFzc3dvcmRfaGFzaF9wdXN0YWthd2FuIjtzOjYwOiIkMnkkMTIkZkhzQ0dqQ01kYTdOVGsxU0drc2lYdTI5NmNxZE8wek96OXNsVE1JYmdqWENDb0tpVGQzOXkiO30=', 1755628705),
	('jemUE3Sd1fVnAno25djn7xJzuac1ejUz6mWZYS0H', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGtueWUzbVg4MTNOb0hzdFZwYkxYRkZsZEpkQnA3Nldqd09lYzJDOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9wZXJwdXN0YWthYW4tc2QudGVzdC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755621789),
	('l36vc88phRzPgndjP5DL8ZmWElW40Muzzq4U2JHy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNFB3RHVwTGdtbExtZ0o3cm42aEFPemZjSW9JZ0p5b1NVY1p3cFBxdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755621727),
	('npBZSrhbgtvmFaudyIxr2JpXgHeCNvRJcQ9vjvsc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3pUeEpTRGhiOFFPTEJHbTFYU2ZHa3ZIbUh3YjlMZlI2WThaeDE4MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9wZXJwdXN0YWthYW4tc2QudGVzdC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755621775),
	('oKchifOMAkqBTZX3OC6l1rTFW2ogSv2fTuiPX74G', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVlZ4dXJZR1lEbDJvMzBzQkI1dkp0VXJIRENoR29VdFZaOFBVYk9ZTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9wZXJwdXN0YWthYW4tc2QudGVzdC9hZG1pbi9wZW1pbmphbWFuIjt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTk6InBhc3N3b3JkX2hhc2hfYWRtaW4iO3M6NjA6IiQyeSQxMiRMbmNOVlpvS0tuNmhsMkF6TXYyNERPOGFKQWlNSDBaektHUXhWT09ReTJ1ODgwbWhrbFVBVyI7fQ==', 1755629104),
	('RgIBfSlnGiIm3qrMSebserfo3Ber3UMUAYAcEtfm', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoialdXQTVOMGt2S2c5QnhDcEhjN0x5OUVRQWdKN0JIVzRMYUJDMjNsbiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vcGVycHVzdGFrYWFuLXNkLnRlc3QvcHVzdGFrYXdhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE5OiJwYXNzd29yZF9oYXNoX2FkbWluIjtzOjYwOiIkMnkkMTIkTG5jTlZab0tLbjZobDJBek12MjRETzhhSkFpTUgwWnpLR1F4Vk9PUXkydTg4MG1oa2xVQVciO3M6NTc6ImxvZ2luX3B1c3Rha2F3YW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O3M6MjQ6InBhc3N3b3JkX2hhc2hfcHVzdGFrYXdhbiI7czo2MDoiJDJ5JDEyJGZIc0NHakNNZGE3TlRrMVNHa3NpWHUyOTZjcWRPMHpPejlzbFRNSWJnalhDQ29LaVRkMzl5Ijt9', 1755629388),
	('SmOleAzMldPWztPohjkVb33HwLxyVahNKm88aTCG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSnB6M0VxVUVnUUFTMmlTMmN5bXRTSVVGRVIzazhRMDdyRzhvdGE4ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9wZXJwdXN0YWthYW4tc2QudGVzdC9wdXN0YWthd2FuL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755621807);

-- Dumping structure for table perpustakaan_db.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswa_nis_unique` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.siswa: ~0 rows (approximately)

-- Dumping structure for table perpustakaan_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan_db.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Admin', 'anjani@gmail.com', NULL, '$2y$12$LncNVZoKKn6hl2AzMv24DO8aJAiMH0ZzKGQxVOOQy2u880mhklUAW', 'MrZduZhIzuEdTZUGLxl5kM8lpVe3HAzsJj7czAINuHeXJ6rkKez5bcS1lrPe', '2025-08-08 10:10:05', '2025-08-08 10:10:05', NULL),
	(6, 'Pustakawan', 'pustakawan@example.com', NULL, '$2y$12$fHsCGjCMda7NTk1SGksiXu296cqdO0zOz9slTMIbgjXCCoKiTd39y', 'TPGebWAS6tblAcD3mcu9XJmzJ7upgluUd6aXe6pUrlA3LFBx6vZwVPAhsWTM', '2025-08-10 01:35:42', '2025-08-10 01:35:42', NULL),
	(9, 'Administrator', 'admin@example.com', NULL, '$2y$12$DeJIOn2GcyJkThGdxm7fwOpWiIRaWaK4iX4NRtwLosQx7mk45pKEm', NULL, '2025-08-17 16:16:01', '2025-08-17 16:16:01', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 8.0.30 : Database - hibouhik_data
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hibouhik_data` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `hibouhik_data`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tupoksi` longtext COLLATE utf8mb4_unicode_ci,
  `nama_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visi` longtext COLLATE utf8mb4_unicode_ci,
  `misi` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`user_id`,`logo`,`tupoksi`,`nama_organisasi`,`visi`,`misi`,`created_at`,`updated_at`) values 
(1,38,NULL,NULL,'kesiswaan','kerja kerja kerja','kerja kerja kerja','2024-12-30 06:35:13','2024-12-30 06:35:13'),
(2,0,'file-logo/SnoXZ4hFOHl6hmsK6LY8POhx51vL2OBfQWZIM0m7.png',NULL,'bem','Menjadikan BEM Politeknik Harapan Bersama Sebagai Wadah Untuk Mewujudkan Mahasiswa yang Cerah (Cerdas, Religius, Aktif, & Harmonis)','Menjadikan BEM Politeknik Harapan Bersama Sebagai Wadah Untuk Mewujudkan Mahasiswa yang Cerah (Cerdas, Religius, Aktif, & Harmonis)','2024-12-30 06:35:13','2025-06-13 05:55:53'),
(3,0,'file-logo/6A2kGKnRQmjunsPjSgHTGjW57wQ1nKQWnaByS4hL.png',NULL,'bpm','BPM KM PHB adalah \"Mewujudkan Lembaga Perwakilan Mahasiswa yang inovatif, aspiratif, dan berintegritas berasaskan pancasila\"','(1) Menampung dan menyalurkan aspirasi mahasiswa yang bersifat membangun. (2) Mengawasi dan mengevaluasi kinerja KM PHB','2024-12-30 19:40:06','2025-01-01 18:27:22'),
(4,0,NULL,NULL,'hmp perhotelan',NULL,NULL,'2024-12-30 19:40:54','2024-12-30 19:40:54'),
(5,41,'file-logo/4QlIN5pn0pr6RfDHUXAO7OxkjE08Wd6Gg1OBxaMF.png',NULL,'hmp ti','Menjadikan Himpunan Mahasiswa Teknik Informatika yang Unggul, Aktif, Inovatif, dan Inspiratif dalam mendorong Pengembangan Sumber Daya Mahasiswa','(1) Menyediakan wadah untuk menggali potensi inovasi dan kreativitas mahasiswa. (2) Mendorong pemberdayaan mahasiswa dalam pengembangan soft skill. (3) Memperkuat rasa kebersamaan dan kekeluargaan antar mahasiswa.','2024-12-30 19:41:46','2024-12-30 19:44:35'),
(6,0,NULL,NULL,'hmp teknik mesin',NULL,NULL,'2025-01-01 18:16:45','2025-01-01 18:16:45'),
(7,0,NULL,NULL,'hmp akuntansi',NULL,NULL,'2025-01-01 18:17:11','2025-01-01 18:17:11'),
(8,0,NULL,NULL,'hmp asp',NULL,NULL,'2025-01-01 18:17:39','2025-01-01 18:20:51'),
(9,0,NULL,NULL,'hmp teknik elektronika',NULL,NULL,'2025-01-01 18:18:08','2025-01-01 18:18:08'),
(10,0,NULL,NULL,'hmp kebidanan',NULL,NULL,'2025-01-01 18:18:35','2025-01-01 18:18:35'),
(11,0,NULL,NULL,'hmp farmasi',NULL,NULL,'2025-01-01 18:19:04','2025-01-01 18:19:04'),
(12,0,NULL,NULL,'hmp teknik komputer',NULL,NULL,'2025-01-01 18:19:30','2025-01-01 18:19:30'),
(13,0,NULL,NULL,'hmp dkv',NULL,NULL,'2025-01-01 18:19:47','2025-01-01 18:19:47'),
(14,0,NULL,NULL,'UKM Basket',NULL,NULL,'2025-07-21 02:17:27','2025-07-21 02:17:27');

/*Table structure for table `agendas` */

DROP TABLE IF EXISTS `agendas`;

CREATE TABLE `agendas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_organisasi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tempat_kegiatan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lpj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agendas_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `agendas` */

insert  into `agendas`(`id`,`nama_kegiatan`,`nama_organisasi`,`slug`,`keterangan`,`tanggal_mulai`,`tempat_kegiatan`,`gambar`,`proposal`,`lpj`,`created_at`,`updated_at`) values 
(1,'Seminar mental Health','bem','seminar-mental-health-2','Dilaksanakan Seminar mental health yang merupakan kolaborasi antara FKMPI dengan BEM KM PHB yang bertempat di Politeknik Harapan Bersama, Seminar ini bertujuan agar anak muda terutama para mahasiswa bisa lebih sadar tentang kesehatan mental di era digital seperti saat ini','2024-08-24','Aula','file-gambar/XSKDdTJV151APtm6prrqHiVc0AewT1pR9GIevjwC.jpg','file-proposal/1PF6VsHTxh8gVPcBaj08m0v9wPvM7GgtNHoQYZFh.pdf','file-lpj/aA5Jmu23JlGJNDqhi4VYYiqZP2JnBShUn2BG1LWS.pdf','2024-12-30 19:22:05','2024-12-30 19:22:18'),
(2,'Inforsary 12 Teknik Informatika','hmp ti','inforsary-12-teknik-informatika-2','INFORSARY 12- Teknik Informatika, Kegiatan ini bukan hanya sekedar perayaan, tetapi juga momen penuh inspirasi, kreativitas, dan kolaborasi. Mulai games seru, hingga kebersamaan luar biasa, semuanya menjadi bukti bahwa keluarga besar teknik informatika terus tumbuh dan berkembang','2024-11-16','Sport Center','file-gambar/Rqwyi1EuM9oFXJY3t5ihyXS0iy4UGqP1MqZZh7LT.jpg','file-proposal/Tv9TS9kOTNdcszePdiye0GloRoVSpgS6LudR97bd.pdf','file-lpj/sNOlKphFzBwKfnERO2YkuhwTIPqSfYK1Px32BAUp.pdf','2025-01-09 18:19:57','2025-07-20 15:21:42'),
(5,'Serah Terima Jabatan','hmp ti','serah-terima-jabatan-2','Dilaksanakan Seminar mental health yang merupakan kolaborasi antara','2026-01-01','Aula','file-gambar/TrHANI90bUeMAyHHOPzv8s9GvJr4hazmEh7p9ACx.png','file-proposal/Jk4MRZTSxRzmoH8o5pwsyLoJhFF5gc7mP77YEzjB.pdf',NULL,'2025-07-21 01:59:44','2025-07-21 02:01:40'),
(6,'Seminar mental Health','hmp ti','seminar-mental-health','Dilaksanakan Seminar mental health yang merupakan kolaborasi antara','2025-04-22','Aula','file-gambar/qOpGZYL9ZaHAoWKchj0jIaIPUcYBG9YnLtoN3g4h.png','file-proposal/u048o46YHig1TUnO5xrppSddcIMeHE19ZxKri9fJ.pdf',NULL,'2025-07-21 02:07:57','2025-07-21 02:07:57'),
(7,'Inventaris','hmp ti','inventaris','INFORSARY 12- Teknik Informatika, Kegiatan ini bukan hanya sekedar perayaan, tetapi juga momen penuh inspirasi, kreativitas, dan kolaborasi. Mulai games seru, hingga kebersamaan luar biasa, semuanya menjadi bukti bahwa keluarga besar teknik informatika terus tumbuh dan berkembang','2025-07-22','Aula','file-gambar/JIpmxvMD6W8lsEYwtgolBVUlfMgK98WUAaqXqil3.png','file-proposal/3tpv4vQbnEWtQk6W0KeviutDenjDAxswiWEu8OUx.pdf','file-lpj/qF2iQZEcGY2WKVlkaRDSmOo21FbHaMG306bkFyvk.pdf','2025-07-21 12:50:31','2025-07-21 12:53:21');

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `semester` varchar(2) DEFAULT NULL,
  `nomor` varchar(50) DEFAULT NULL,
  `nama_organisasi` varchar(255) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `ktm` varchar(255) DEFAULT NULL,
  `riwayat_studi` varchar(255) DEFAULT NULL,
  `sertif` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tempat_wawancara` varchar(255) DEFAULT NULL,
  `tgl_wawancara` varchar(255) DEFAULT NULL,
  `jam_wawancara` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `anggota` */

insert  into `anggota`(`id`,`user_id`,`nim`,`prodi`,`semester`,`nomor`,`nama_organisasi`,`jabatan`,`ktm`,`riwayat_studi`,`sertif`,`status`,`keterangan`,`tempat_wawancara`,`tgl_wawancara`,`jam_wawancara`) values 
(1,37,'21041003','D3 Teknik Komputer','4','089694589276','hmp ti','Sekertaris',NULL,NULL,NULL,'aktif',NULL,NULL,NULL,NULL);

/*Table structure for table `anggota_agenda` */

DROP TABLE IF EXISTS `anggota_agenda`;

CREATE TABLE `anggota_agenda` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `agenda_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anggota_agenda_user_id_foreign` (`user_id`),
  KEY `anggota_agenda_agenda_id_foreign` (`agenda_id`),
  CONSTRAINT `anggota_agenda_agenda_id_foreign` FOREIGN KEY (`agenda_id`) REFERENCES `agendas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `anggota_agenda_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `anggota_agenda` */

insert  into `anggota_agenda`(`id`,`user_id`,`agenda_id`,`created_at`,`updated_at`) values 
(3,36,7,NULL,NULL),
(4,37,7,NULL,NULL),
(5,37,6,NULL,NULL);

/*Table structure for table `brand_image` */

DROP TABLE IF EXISTS `brand_image`;

CREATE TABLE `brand_image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `brand_image` */

insert  into `brand_image`(`id`,`path`,`created_at`) values 
(1,'file-logo/wyh8SoFS7f4R62cGZ4ByFIQnlGHP62PKTEvOv2GW.png','2025-07-24 05:54:52');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
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

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2014_10_12_100000_create_password_resets_table',1),
(4,'2019_08_19_000000_create_failed_jobs_table',1),
(5,'2019_12_14_000001_create_personal_access_tokens_table',1),
(6,'2024_07_17_004845_create_agendas_table',1),
(7,'2024_08_28_140802_create_rutins_table',1),
(8,'2024_11_30_050516_create_admin_table',1),
(9,'2024_11_30_122555_create_anggota_agenda_table',1),
(10,'2024_12_18_043142_create_riwayat_table',1);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `riwayat` */

DROP TABLE IF EXISTS `riwayat`;

CREATE TABLE `riwayat` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisasi_tujuan` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `riwayat_user_id_foreign` (`user_id`),
  CONSTRAINT `riwayat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `riwayat` */

insert  into `riwayat`(`id`,`user_id`,`status`,`organisasi_tujuan`,`keterangan`,`created_at`,`updated_at`) values 
(53,36,'Lolos Ke Wawancara','hmp ti','Congrats','2025-07-21 12:48:41','2025-07-21 12:48:41'),
(54,36,'aktif','hmp ti','Congrats','2025-07-21 12:49:01','2025-07-21 12:49:01');

/*Table structure for table `rutins` */

DROP TABLE IF EXISTS `rutins`;

CREATE TABLE `rutins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `hari` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_kegiatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rutins` */

insert  into `rutins`(`id`,`hari`,`unit`,`tempat_kegiatan`,`created_at`,`updated_at`) values 
(1,'Sabtu','UKM PEC','Gedung D Lab. Bahasa','2024-12-30 19:07:26','2024-12-30 19:07:26'),
(2,'Sabtu','UKM Semata','Gedung D','2024-12-30 19:12:55','2024-12-30 19:12:55'),
(3,'Sabtu','UKM Musik','Sekretariat Ormawa UKM Musik','2024-12-30 19:13:58','2024-12-30 19:13:58'),
(4,'Sabtu','UKM Karate','Depan Asrama dan SC','2024-12-30 19:15:23','2024-12-30 19:15:23'),
(5,'Rabu','UKM Pencak Silat','Depan Asrama dan SC','2024-12-30 19:16:05','2024-12-30 19:16:05'),
(6,'Sabtu','UKM Robotika','Gedung B','2024-12-30 19:16:42','2024-12-30 19:16:42'),
(7,'Sabtu','UKM Tari','Sport Center','2024-12-30 19:17:20','2024-12-30 19:17:20'),
(8,'Sabtu','UKM Formasi','Masjid','2024-12-30 19:17:47','2024-12-30 19:17:47'),
(9,'Sabtu','UKM Rana9','Sport Center','2024-12-30 19:18:11','2024-12-30 19:18:11'),
(10,'Selasa dan Jumat','UKM Basket','Sport Center','2024-12-30 19:18:42','2025-06-12 23:45:38'),
(11,'Rabu','UKM Futsal','Sport Center','2024-12-30 19:19:30','2024-12-30 19:19:30'),
(12,'Sabtu','UKM Popala','Sekretariat Ormawa UKM Popala','2024-12-30 19:19:59','2024-12-30 19:19:59'),
(13,'Sabtu','UKM Teater','Sport Center','2024-12-30 19:20:20','2024-12-30 19:20:20');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`role`,`name`,`foto`,`email_verified_at`,`remember_token`,`created_at`,`updated_at`) values 
(36,'akunjb17@gmail.com','$2y$10$07IpALHq8vh/Gouexq.mXOoWikEGs53lx5Jvs7mz7s.oSbUGSPmF6','user','Muhammad Haidar Rasyiq','file-foto/hhw7VDe0Wk3T3Fh40lxPlj6retvA9DSmHOjDZ3Ab.png','2025-07-21 12:45:37',NULL,'2025-07-21 12:44:12','2025-07-21 12:49:01'),
(37,'luffy@gmail.com','$2y$10$.TrILt66.rh0PK05FDASpu7cOcjctLAVTcDqJK.dITmUkwwDCAMMm','user','ego',NULL,'2025-07-21 12:45:37',NULL,'2025-07-23 05:25:10','2025-07-23 05:25:10'),
(38,'super@gmail.com','$2y$10$alv3lHgl3efZa5T291ENUuovUl.A8egOWtA26H.CR9N8tBDcPf2Aq','super_admin','mas super admin',NULL,'2025-07-21 12:45:37',NULL,'2025-07-23 05:25:10','2025-07-23 05:25:10'),
(41,'hmpti@gmail.com','$2y$10$PEDNLkLkmIWJe4WKCM7NreZ5AwnhNr8gdGJ3qzRZRGISid/nWe4sC','admin','Hima Prodi Teknik Informatika','file-logo/4QlIN5pn0pr6RfDHUXAO7OxkjE08Wd6Gg1OBxaMF.png','2025-07-21 12:45:37',NULL,'2025-07-23 05:25:10','2025-07-23 05:25:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

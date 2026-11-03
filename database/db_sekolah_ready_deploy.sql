-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: db_sekolah
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `db_sekolah`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `db_sekolah` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_sekolah`;

--
-- Table structure for table `agendas`
--

DROP TABLE IF EXISTS `agendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agendas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organizer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agendas_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendas`
--

LOCK TABLES `agendas` WRITE;
/*!40000 ALTER TABLE `agendas` DISABLE KEYS */;
INSERT INTO `agendas` VALUES (1,'Penilaian Akhir Semester (PAS) Genap','penilaian-akhir-semester-pas-genap','2026-11-12','2026-11-19','07.30 - 12.00 WIB','Seluruh Ruang Kelas X, XI, dan XII','Tim Kurikulum','Peserta didik wajib membawa kartu peserta ujian dan alat tulis lengkap.',1,'2026-10-29 13:26:57','2026-10-29 13:26:57'),(2,'Wisuda Purnawiyata & Pelepasan Alumni Angkatan 2026','wisuda-purnawiyata-pelepasan-alumni-angkatan-2026','2026-12-03',NULL,'08.00 - Selesai WIB','Grand Ballroom Gedung Serbaguna','Panitia Wisuda','Acara serah terima kelulusan siswa kepada orang tua wali murid.',1,'2026-10-29 13:26:57','2026-10-29 13:26:57');
/*!40000 ALTER TABLE `agendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku_non_teks`
--

DROP TABLE IF EXISTS `buku_non_teks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buku_non_teks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Buku Pengayaan Pengetahuan',
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_extension` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pdf',
  `file_size` bigint unsigned NOT NULL DEFAULT '0',
  `download_count` int unsigned NOT NULL DEFAULT '0',
  `synopsis` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `buku_non_teks_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku_non_teks`
--

LOCK TABLES `buku_non_teks` WRITE;
/*!40000 ALTER TABLE `buku_non_teks` DISABLE KEYS */;
INSERT INTO `buku_non_teks` VALUES (1,'Ensiklopedia Sains dan Ekosistem Hayati Indonesia','ensiklopedia-sains-dan-ekosistem-hayati-indonesia','Pengayaan Pengetahuan','Dr. Hendra Wijaya & Tim Biologi','Pustaka Cendekia Mandiri','2024','978-602-1234-01-2','https://images.unsplash.com/photo-1532012164546-f432f2e3777a?w=600&auto=format&fit=crop&q=80','buku-non-teks/ensiklopedia-sains.pdf','pdf',5600000,137,'Buku pengayaan sains yang mengupas keanekaragaman flora dan fauna kepulauan Nusantara, interaksi ekosistem tropis, serta tantangan konservasi lingkungan modern yang dikemas dengan bahasa populer dan ilustrasi berwarna untuk memperkaya wawasan peserta didik.',1,'2026-11-02 04:17:32','2026-11-03 03:32:56'),(2,'Membangun Karakter Pelajar Pancasila: Pemimpin Muda Masa Depan','membangun-karakter-pelajar-pancasila-pemimpin-muda','Pengayaan Kepribadian','Prof. Anisa Rahmawati, M.Pd.','Erlangga Literasi Karakter','2025','978-602-5432-88-9','https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&auto=format&fit=crop&q=80','buku-non-teks/karakter-pelajar-pancasila.pdf','pdf',3400000,215,'Panduan inspiratif bagi peserta didik untuk menanamkan integritas, empati, resiliensi, dan kepemimpinan inklusif dalam dinamika kehidupan berorganisasi, pergaulan sehat, dan bermasyarakat.',1,'2026-11-02 04:17:32','2026-11-02 04:17:32'),(3,'Jejak Langkah Menembus Cakrawala: Antologi Puisi & Cerpen Remaja','jejak-langkah-menembus-cakrawala-antologi-sastra','Sastra & Fiksi','Komunitas Literasi Siswa SMA','Balai Bahasa & Sastra Pelajar','2024','978-623-7890-11-4','https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600&auto=format&fit=crop&q=80','buku-non-teks/antologi-puisi-cerpen.pdf','pdf',2100000,94,'Kumpulan karya sastra terbaik hasil kreasi siswa berprestasi yang menggambarkan refleksi perjalanan masa remaja, persahabatan, kecintaan pada tanah air, dan tekad menggapai cita-cita setinggi langit.',1,'2026-11-02 04:17:32','2026-11-02 04:17:32'),(4,'Panduan Praktis Desain Grafis & Pemrograman Web untuk Pemula','panduan-praktis-desain-grafis-pemrograman-web','Keterampilan / Vokasi','Bagus Setyawan, S.Kom.','Informatika Kreatif Edukasi','2025','978-623-4567-33-0','https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&auto=format&fit=crop&q=80','buku-non-teks/panduan-desain-web.pdf','pdf',4800000,176,'Buku panduan kecakapan abad 21 yang memandu siswa langkah demi langkah memahami logika pemrograman dasar, desain visual modern, dan implementasi proyek kreatif digital secara aplikatif dan mandiri.',1,'2026-11-02 04:17:32','2026-11-02 04:17:32'),(5,'Contoh Buku Nonteks dari SLB C Danyang PWDD','contoh-buku-nonteks-dari-slb-c-danyang-pwdd','Buku Pengayaan Pengetahuan','Anggara Aditya Kurniawan','Teguh Karya','2025','978-634-00-0093-1','buku-cover/1IlHEYEPcg4rRO1PKG0fgBVRQjNlZ6abkGrPbkNe.png','buku-non-teks/Pendidikan Jasmani, Olahraga, dan Kesehatan untuk SMAMASMKMAK Kelas XII.pdf','pdf',0,0,'Lorem Ipsum',1,'2026-11-02 04:57:30','2026-11-02 04:57:30');
/*!40000 ALTER TABLE `buku_non_teks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Prestasi Siswa','prestasi-siswa',NULL,'2026-10-29 13:26:56','2026-10-29 13:26:56'),(2,'Akademik & Kurikulum','akademik',NULL,'2026-10-29 13:26:56','2026-10-29 13:26:56'),(3,'Pengumuman Resmi','pengumuman',NULL,'2026-10-29 13:26:56','2026-10-29 13:26:56');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `downloads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_extension` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pdf',
  `file_size` bigint unsigned NOT NULL DEFAULT '0',
  `download_count` bigint unsigned NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `downloads_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloads`
--

LOCK TABLES `downloads` WRITE;
/*!40000 ALTER TABLE `downloads` DISABLE KEYS */;
INSERT INTO `downloads` VALUES (1,'Kalender Pendidikan Tahun Ajaran 2026/2027','kalender-pendidikan-tahun-ajaran-20262027','Panduan Akademik','downloads/kalender-pendidikan-2026.pdf','pdf',768000,318,'Jadwal masuk sekolah, libur semester, dan agenda ujian sekolah.',1,'2026-10-29 13:26:57','2026-11-03 03:32:44'),(2,'Buku Panduan Teknis PPDB Jalur Zonasi & Prestasi','buku-panduan-teknis-ppdb-jalur-zonasi-prestasi','Formulir','downloads/panduan-ppdb-2026.pdf','pdf',1280000,613,'Petunjuk lengkap pengisian berkas persyaratan dan tata cara verifikasi fisik.',1,'2026-10-29 13:26:57','2026-10-29 14:06:21');
/*!40000 ALTER TABLE `downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extracurriculars`
--

DROP TABLE IF EXISTS `extracurriculars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extracurriculars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coach` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `extracurriculars_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extracurriculars`
--

LOCK TABLES `extracurriculars` WRITE;
/*!40000 ALTER TABLE `extracurriculars` DISABLE KEYS */;
INSERT INTO `extracurriculars` VALUES (1,'Robotik & Kecerdasan Buatan','robotik-kecerdasan-buatan','Rina Kartika, S.Kom.','Jumat, 15.00 - 17.00 WIB','Mempelajari mikroprosesor Arduino, IoT, dan pemrograman robot untuk kompetisi nasional.','https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=800&auto=format&fit=crop',1,1,'2026-10-29 13:26:57','2026-10-29 13:26:57'),(2,'Paskibraka Satya Wira','paskibraka-satya-wira','Bambang Pamungkas','Sabtu, 08.00 - 11.00 WIB','Melatih kedisiplinan baris-berbaris, kepemimpinan, dan etika kebangsaan.','https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?q=80&w=800&auto=format&fit=crop',1,2,'2026-10-29 13:26:57','2026-10-29 13:26:57'),(3,'Klub Basket & Futsal','klub-basket-futsal','Coach Hendra Wijaya','Selasa & Kamis, 16.00 WIB','Pembinaan atlet cabang olahraga tim dengan pelatih berlisensi nasional.','https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=800&auto=format&fit=crop',1,3,'2026-10-29 13:26:57','2026-10-29 13:26:57'),(4,'Paduan Suara & Musik Etnik','paduan-suara-musik-etnik','Dewi Lestari, S.Sn.','Rabu, 15.30 - 17.30 WIB','Pengembangan bakat seni tarik suara dan instrumen musik tradisional.','https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=800&auto=format&fit=crop',1,4,'2026-10-29 13:26:57','2026-10-29 13:26:57');
/*!40000 ALTER TABLE `extracurriculars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum',
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'Kapan pendaftaran PPDB tahun ajaran baru dibuka?','Pendaftaran dibuka secara daring sesuai jadwal yang telah ditentukan. Anda dapat memantau jadwal hitung mundur dan pengumuman resmi di halaman PPDB pada menu navigasi.','PPDB',1,1,'2026-10-29 13:26:57','2026-10-29 13:26:57'),(2,'Dokumen apa saja yang wajib disiapkan untuk pendaftaran online?','Dokumen yang perlu disiapkan antara lain: Pas Foto formal 3x4, Scan/Foto Kartu Keluarga (KK), Scan Akta Kelahiran, dan Ijazah atau Surat Keterangan Lulus (SKL) sementara.','PPDB',2,1,'2026-10-29 13:26:57','2026-10-29 13:26:57'),(3,'Apakah sekolah menyediakan program beasiswa untuk siswa berprestasi?','Ya, kami menyediakan beasiswa prestasi akademik maupun non-akademik, serta program beasiswa afirmasi bagi peserta didik yang memenuhi kriteria kelayakan panitia.','Akademik',3,1,'2026-10-29 13:26:57','2026-10-29 13:26:57');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('photo','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'photo',
  `album` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum',
  `media_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'Upacara Peringatan Hari Pendidikan Nasional','photo','Kegiatan Resmi','gallery/glRFNB6eb1FlwDARo8TBQyF5KZHlzkUm8CohM7m7.jpg',NULL,'Khidmat upacara pengibaran bendera merah putih dengan pakaian adat nusantara.',1,1,'2026-10-29 13:26:57','2026-11-02 04:47:51'),(2,'Pameran Karya Inovasi Sains & Teknologi Siswa','photo','Karya Siswa','gallery/MvhNeqKJRPtz7I88nB8nlDZ9wRQ9Y2mg7KTPtVPB.webp',NULL,'Demonstrasi proyek teknologi ramah lingkungan dan robot otomatisasi.',1,2,'2026-10-29 13:26:57','2026-11-02 04:49:40'),(3,'Profil Singkat & Tur Virtual Kampus Sekolah','video','Video Profil',NULL,'https://youtu.be/_oPydAB6Ec0?si=j2PAAMCqph2tdgkC','Jelajahi setiap sudut fasilitas belajar dan aktivitas siswa melalui video tur.',1,3,'2026-10-29 13:26:57','2026-11-02 04:50:41');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `graduations`
--

DROP TABLE IF EXISTS `graduations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `graduations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `class_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('lulus','tidak_lulus','tertunda') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lulus',
  `average_score` decimal(5,2) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `graduations_academic_year_nisn_unique` (`academic_year`,`nisn`),
  KEY `graduations_nisn_index` (`nisn`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graduations`
--

LOCK TABLES `graduations` WRITE;
/*!40000 ALTER TABLE `graduations` DISABLE KEYS */;
INSERT INTO `graduations` VALUES (1,'2025/2026','0059876543','01-001-042-9','Sarah Putri Anindya','2008-04-12','XII MIPA 1','lulus',92.40,'Selamat ananda Sarah Putri Anindya! Anda lulus dengan predikat Sangat Memuaskan. Surat Keterangan Lulus (SKL) dapat diambil di ruang TU mulai Senin pukul 08.00 WIB.','2026-10-29 13:26:57','2026-10-29 14:24:24'),(2,'2025/2026','0051122334','01-001-088-3','Reza Pratama','2008-09-25','XII IPS 2','lulus',86.10,'Selamat, Anda dinyatakan LULUS. Harap menyelesaikan pengembalian buku perpustakaan sebelum cap tiga jari.','2026-10-29 13:26:57','2026-10-29 14:24:24');
/*!40000 ALTER TABLE `graduations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hero_slides`
--

DROP TABLE IF EXISTS `hero_slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hero_slides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cta_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_cta_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_cta_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hero_slides`
--

LOCK TABLES `hero_slides` WRITE;
/*!40000 ALTER TABLE `hero_slides` DISABLE KEYS */;
INSERT INTO `hero_slides` VALUES (1,'Mewujudkan Generasi Emas Berkarakter dan Berprestasi Dunia','Pendidikan berstandar unggul dengan fasilitas modern, pengajar berkompeten, dan kurikulum adaptif masa depan.','hero-slides/Kw56Fb7IkjSleOxzIsXz5KFk7UPpHNfi2QfHm7xb.jpg','Daftar PPDB Online','/ppdb','Jelajahi Profil','/halaman/visi-dan-misi',1,1,'2026-10-29 13:26:56','2026-11-02 04:45:29'),(2,'Inovasi Sains, Seni, dan Prestasi Olahraga Tanpa Batas','Dukung potensi setiap anak melalui lebih dari 20 cabang ekstrakurikuler dan laboratorium terakreditasi.','hero-slides/0XmDx5rWrvNhWDmYJkEKOfxOZVkRDV3TWAzWNWtC.jpg','Lihat Ekstrakurikuler','/#ekskul',NULL,NULL,2,1,'2026-10-29 13:26:56','2026-11-02 04:45:50');
/*!40000 ALTER TABLE `hero_slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lpjs`
--

DROP TABLE IF EXISTS `lpjs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lpjs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dana BOS / BOSP',
  `fiscal_year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_extension` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pdf',
  `file_size` bigint unsigned NOT NULL DEFAULT '0',
  `download_count` int unsigned NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lpjs_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lpjs`
--

LOCK TABLES `lpjs` WRITE;
/*!40000 ALTER TABLE `lpjs` DISABLE KEYS */;
INSERT INTO `lpjs` VALUES (1,'Laporan Pertanggungjawaban Realisasi Dana BOS Reguler Tahap I & II Tahun Anggaran 2025/2026','lpj-bos-reguler-tahap-1-2-ta-2025-2026','Dana BOS','2025/2026','lpj/lpj-bos-reguler-2025-2026.pdf','pdf',2450000,93,'Laporan rekapitulasi penerimaan dan pembelanjaan dana BOS Reguler untuk sarana prasarana, operasional pembelajaran, dan gaji tenaga kependidikan.',1,'2026-11-02 04:17:32','2026-11-03 03:32:55'),(2,'Laporan Pertanggungjawaban Dana BOS Kinerja & Sekolah Penggerak Tahun Anggaran 2024/2025','lpj-bos-kinerja-sekolah-penggerak-2024-2025','Dana BOS','2024/2025','lpj/lpj-bos-kinerja-2024-2025.pdf','pdf',1820000,142,'Laporan pertanggungjawaban program sekolah penggerak, digitalisasi kelas, dan apresiasi capaian mutu pendidikan nasional.',1,'2026-11-02 04:17:32','2026-11-02 04:17:32'),(3,'LPJ Kegiatan Masa Pengenalan Lingkungan Sekolah (MPLS) dan Kemah Pramuka 2025','lpj-kegiatan-mpls-dan-kemah-pramuka-2025','Kegiatan Siswa','2025/2026','lpj/lpj-kegiatan-mpls-kemah-2025.pdf','pdf',3200000,53,'Laporan komprehensif pertanggungjawaban anggaran, dokumentasi, dan evaluasi kegiatan penyambutan siswa baru tahun ajaran 2025/2026.',1,'2026-11-02 04:17:32','2026-11-02 04:17:32'),(4,'Laporan Keuangan & Akuntabilitas Dana Komite Sekolah Semester Ganjil 2025/2026','lpj-keuangan-dana-komite-ganjil-2025-2026','Komite Sekolah','2025/2026','lpj/lpj-komite-ganjil-2025-2026.pdf','pdf',1420000,98,'Laporan transparansi partisipasi orang tua/wali murid melalui Komite Sekolah untuk pemeliharaan sarana ibadah dan ekstrakurikuler unggulan.',1,'2026-11-02 04:17:32','2026-11-02 04:17:32');
/*!40000 ALTER TABLE `lpjs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_01_01_000003_create_permission_tables',2),(5,'2024_01_01_000004_create_settings_table',2),(6,'2024_01_01_000005_create_navigations_table',2),(7,'2024_01_01_000006_create_posts_categories_tags_tables',2),(8,'2024_01_01_000007_create_teachers_table',2),(9,'2024_01_01_000008_create_extracurriculars_table',2),(10,'2024_01_01_000009_create_galleries_table',2),(11,'2024_01_01_000010_create_downloads_table',2),(12,'2024_01_01_000011_create_agendas_table',2),(13,'2024_01_01_000012_create_hero_slides_table',2),(14,'2024_01_01_000013_create_testimonials_faqs_pages_tables',2),(15,'2024_01_01_000014_create_ppdb_registrations_table',2),(16,'2024_01_01_000015_create_graduations_table',2),(17,'2024_01_01_999999_create_general_settings',2),(18,'2026_10_29_202815_create_media_table',3),(19,'2026_11_02_110000_create_lpj_and_buku_non_teks_tables',4),(20,'2026_11_03_000000_add_accreditation_and_stats_to_general_settings',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(3,'App\\Models\\User',2),(2,'App\\Models\\User',3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `navigations`
--

DROP TABLE IF EXISTS `navigations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `navigations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `type` enum('header','footer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'header',
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `navigations_parent_id_foreign` (`parent_id`),
  CONSTRAINT `navigations_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `navigations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navigations`
--

LOCK TABLES `navigations` WRITE;
/*!40000 ALTER TABLE `navigations` DISABLE KEYS */;
INSERT INTO `navigations` VALUES (17,NULL,'Profil Sekolah',NULL,NULL,'_self','header',1,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(18,17,'Sejarah Sekolah','/halaman/sejarah-sekolah',NULL,'_self','header',1,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(19,17,'Visi & Misi','/halaman/visi-dan-misi',NULL,'_self','header',2,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(20,17,'Fasilitas Kampus','/halaman/fasilitas-kampus',NULL,'_self','header',3,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(21,17,'Tata Tertib','/halaman/tata-tertib-sekolah',NULL,'_self','header',4,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(22,17,'Guru & Staf',NULL,'teachers.index','_self','header',5,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(23,NULL,'Kesiswaan',NULL,NULL,'_self','header',2,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(24,23,'Ekstrakurikuler',NULL,'extracurriculars.index','_self','header',1,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(25,23,'Agenda & Kegiatan',NULL,'agenda.index','_self','header',2,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(26,23,'Galeri Foto & Video',NULL,'gallery.index','_self','header',3,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(27,NULL,'Informasi',NULL,NULL,'_self','header',3,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(28,27,'Warta & Berita',NULL,'posts.index','_self','header',1,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(29,27,'Pusat Unduhan Dokumen',NULL,'downloads.index','_self','header',2,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(30,NULL,'Kontak',NULL,'contact','_self','header',4,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(31,NULL,'Visi & Misi','/halaman/visi-dan-misi',NULL,'_self','footer',1,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(32,NULL,'Fasilitas Kampus','/halaman/fasilitas-kampus',NULL,'_self','footer',2,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(33,NULL,'Tata Tertib Siswa','/halaman/tata-tertib-sekolah',NULL,'_self','footer',3,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(34,NULL,'Kebijakan Privasi','#',NULL,'_self','footer',4,1,'2026-10-29 16:34:21','2026-10-29 16:34:21'),(35,27,'Laporan LPJ','/lpj','lpj.index','_self','header',3,1,'2026-11-02 04:17:32','2026-11-02 04:17:32'),(36,27,'Buku Nonteks','/buku-non-teks','buku-non-teks.index','_self','header',4,1,'2026-11-02 04:17:32','2026-11-02 04:17:32');
/*!40000 ALTER TABLE `navigations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Visi dan Misi','visi-dan-misi','<h2>Visi Sekolah</h2><p>Mewujudkan lembaga pendidikan yang berprestasi tinggi, berwawasan global, unggul dalam teknologi dan riset, serta berpijak pada nilai-nilai luhur kepribadian bangsa.</p><h2>Misi Sekolah</h2><ol><li>Menyelenggarakan proses pembelajaran yang inovatif, kreatif, dan berpusat pada peserta didik.</li><li>Mengembangkan potensi bakat akademik dan non-akademik peserta didik secara optimal.</li><li>Membina karakter jujur, disiplin, toleran, serta cinta lingkungan hidup.</li><li>Memperkuat pemanfaatan teknologi digital dalam ekosistem pembelajaran modern.</li></ol>',NULL,'Visi dan Misi','Visi SekolahMewujudkan lembaga pendidikan yang berprestasi tinggi, berwawasan global, unggul dalam teknologi dan riset, serta berpijak pada nilai-nilai luhur ke...',1,'2026-10-29 13:26:56','2026-10-29 13:26:56'),(2,'Sejarah Sekolah','sejarah-sekolah','<p>Didirikan pada tahun 1985, sekolah kami bermula dari komitmen para tokoh pendidikan untuk menghadirkan institusi pendidikan bermutu tinggi bagi masyarakat. Seiring berjalannya waktu, sekolah kami terus berkembang menjadi salah satu sekolah rujukan nasional dengan ratusan medali olimpiade sains dan ribuan alumni yang tersebar di perguruan tinggi ternama serta dunia industri terkemuka.</p>',NULL,'Sejarah Sekolah','Didirikan pada tahun 1985, sekolah kami bermula dari komitmen para tokoh pendidikan untuk menghadirkan institusi pendidikan bermutu tinggi bagi masyarakat. Seir...',1,'2026-10-29 13:26:56','2026-10-29 13:26:56'),(3,'Fasilitas Kampus','fasilitas-kampus','<p>Sekolah kami menyediakan sarana dan prasarana penunjang belajar berstandar tinggi:</p><ul><li>Laboratorium Komputer & AI berspesifikasi tinggi</li><li>Laboratorium Kimia, Fisika, dan Biologi modern</li><li>Perpustakaan Digital dengan ribuan e-book dan jurnal</li><li>Lapangan Olahraga Terbuka (Futsal, Basket, Voli)</li><li>Aula Serbaguna berkapasitas 1.000 orang</li><li>Studio Musik dan Ruang Kesenian</li><li>Kantin Sehat dan Masjid Sekolah</li></ul>',NULL,'Fasilitas Kampus','Sekolah kami menyediakan sarana dan prasarana penunjang belajar berstandar tinggi:Laboratorium Komputer & AI berspesifikasi tinggiLaboratorium Kimia, Fisika, da...',1,'2026-10-29 13:26:56','2026-10-29 13:26:56'),(4,'Tata Tertib Sekolah','tata-tertib-sekolah','<p>Tata tertib peserta didik dirancang untuk membentuk kebiasaan disiplin, tanggung jawab, dan saling menghargai sesama warga sekolah. Seluruh siswa diharapkan hadir tepat waktu pukul 06.45 WIB, mengenakan seragam rapi sesuai jadwal, serta menjaga kebersihan lingkungan kampus.</p>',NULL,'Tata Tertib Sekolah','Tata tertib peserta didik dirancang untuk membentuk kebiasaan disiplin, tanggung jawab, dan saling menghargai sesama warga sekolah. Seluruh siswa diharapkan had...',1,'2026-10-29 13:26:56','2026-10-29 13:26:56');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tag` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint unsigned NOT NULL,
  `tag_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_tag_post_id_tag_id_unique` (`post_id`,`tag_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tag`
--

LOCK TABLES `post_tag` WRITE;
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
INSERT INTO `post_tag` VALUES (1,1,1),(2,1,3),(3,2,2);
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_count` bigint unsigned NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_user_id_foreign` (`user_id`),
  KEY `posts_category_id_foreign` (`category_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,1,'Siswa SLB Negeri Grobogan Raih Medali Emas Olimpiade Sains Nasional (OSN) 2026','siswa-slb-negeri-grobogan-raih-medali-emas-olimpiade-sains-nasional-osn-2026','Kabar membanggakan datang dari ananda Muhammad Farhan yang sukses mempersembahkan medali emas bidang Fisika pada ajang OSN tingkat Nasional.','<p>Prestasi gemilang kembali ditorehkan oleh siswa kami dalam ajang Olimpiade Sains Nasional (OSN) tahun 2026. Muhammad Farhan, siswa kelas XI MIPA 1, berhasil menyabet medali emas dalam kompetisi bergengsi bidang Fisika setelah melalui seleksi ketat dari tingkat kota hingga nasional.</p><p>Kepala Sekolah menyampaikan apresiasi setinggi-tingginya kepada ananda Farhan serta guru pembina olimpiade sains yang telah gigih mendampingi selama masa karantina dan pelatihan intensif.</p>','posts/MsTdgv2zioe8sywljGQrs8BlTIZOhupXxMqnwZcv.jpg',225,1,'2026-10-27 13:26:56','Siswa SMA Negeri 1 Raih Medali Emas Olimpiade Sains Nasional (OSN) 2026','Kabar membanggakan datang dari ananda Muhammad Farhan yang sukses mempersembahkan medali emas bidang Fisika pada ajang OSN tingkat Nasional.','2026-10-29 13:26:56','2026-11-03 03:32:45'),(2,1,3,'Sosialisasi Pendaftaran Peserta Didik Baru (PPDB) Tahun Ajaran 2026/2027','sosialisasi-pendaftaran-ppdb-2026','Pendaftaran PPDB resmi dibuka daring. Simak syarat administrasi, alur pendaftaran, dan jadwal penting berikut.','<p>Panitia Penerimaan Peserta Didik Baru (PPDB) mengumumkan bahwa pendaftaran untuk tahun ajaran baru telah resmi dibuka secara online melalui portal website sekolah.</p><p>Calon siswa dapat mengisi formulir multi-step dan mengunggah berkas persyaratan tanpa perlu mengantre fisik di sekolah pada tahap pendaftaran awal.</p>',NULL,389,1,'2026-10-24 13:26:56','Sosialisasi Pendaftaran Peserta Didik Baru (PPDB) Tahun Ajaran 2026/2027','Pendaftaran PPDB resmi dibuka daring. Simak syarat administrasi, alur pendaftaran, dan jadwal penting berikut.','2026-10-29 13:26:56','2026-10-29 13:26:56'),(3,1,2,'Workshop Pembelajaran Berbasis AI dan Penguatan Literasi Digital Siswa','workshop-ai-dan-literasi-digital','Pelatihan literasi kecerdasan buatan etis diselenggarakan untuk membekali siswa dengan keterampilan teknologi abad 21.','<p>Dalam rangka menyiapkan generasi masa depan yang melek teknologi, sekolah mengadakan lokakarya komprehensif mengenai pemanfaatan AI secara bertanggung jawab untuk riset dan kreativitas belajar siswa.</p>',NULL,89,1,'2026-10-21 13:26:57','Workshop Pembelajaran Berbasis AI dan Penguatan Literasi Digital Siswa','Pelatihan literasi kecerdasan buatan etis diselenggarakan untuk membekali siswa dengan keterampilan teknologi abad 21.','2026-10-29 13:26:57','2026-11-02 04:55:09');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ppdb_registrations`
--

DROP TABLE IF EXISTS `ppdb_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ppdb_registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_income` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_school_address` text COLLATE utf8mb4_unicode_ci,
  `average_score` decimal(5,2) DEFAULT NULL,
  `chosen_major` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_birth_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_report_or_diploma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','verified','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ppdb_registrations_registration_number_unique` (`registration_number`),
  KEY `ppdb_registrations_nisn_index` (`nisn`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ppdb_registrations`
--

LOCK TABLES `ppdb_registrations` WRITE;
/*!40000 ALTER TABLE `ppdb_registrations` DISABLE KEYS */;
INSERT INTO `ppdb_registrations` VALUES (1,'PPDB-2026-0001','2026/2027','Dimas Arya Saputra','0081234567','3171012345670001','L','Jakarta','2010-08-17','Islam','Jl. Kebayoran Lama No. 12, Jakarta Selatan','081298765432','Budi Saputra',NULL,'Dewi Anggraini',NULL,NULL,'081211223344','SMP Negeri 19 Jakarta',NULL,88.75,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'verified','Berkas lengkap dan telah diverifikasi oleh tim panitia.','2026-10-29 13:26:57','2026-10-29 13:26:57'),(2,'PPDB-2026-0002','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 13:53:05','2026-10-29 13:53:05'),(3,'PPDB-2026-0003','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 13:53:58','2026-10-29 13:53:58'),(4,'PPDB-2026-0004','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:00:35','2026-10-29 14:00:35'),(5,'PPDB-2026-0005','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:01:49','2026-10-29 14:01:49'),(6,'PPDB-2026-0006','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:03:01','2026-10-29 14:03:01'),(7,'PPDB-2026-0007','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:12:56','2026-10-29 14:12:56'),(8,'PPDB-2026-0008','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:14:10','2026-10-29 14:14:10'),(9,'PPDB-2026-0009','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:26:20','2026-10-29 14:26:20'),(10,'PPDB-2026-0010','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:26:41','2026-10-29 14:26:41'),(11,'PPDB-2026-0011','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:28:54','2026-10-29 14:28:54'),(12,'PPDB-2026-0012','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:29:59','2026-10-29 14:29:59'),(13,'PPDB-2026-0013','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:37:06','2026-10-29 14:37:06'),(14,'PPDB-2026-0014','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 14:37:57','2026-10-29 14:37:57'),(15,'PPDB-2026-0015','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 15:05:28','2026-10-29 15:05:28'),(16,'PPDB-2026-0016','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 15:19:02','2026-10-29 15:19:02'),(17,'PPDB-2026-0017','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 15:19:34','2026-10-29 15:19:34'),(18,'PPDB-2026-0018','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 15:21:01','2026-10-29 15:21:01'),(19,'PPDB-2026-0019','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 16:37:57','2026-10-29 16:37:57'),(20,'PPDB-2026-0020','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 17:08:20','2026-10-29 17:08:20'),(21,'PPDB-2026-0021','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-29 17:10:30','2026-10-29 17:10:30'),(22,'PPDB-2026-0022','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 14:27:56','2026-10-30 14:27:56'),(23,'PPDB-2026-0023','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 14:28:09','2026-10-30 14:28:09'),(24,'PPDB-2026-0024','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 14:29:33','2026-10-30 14:29:33'),(25,'PPDB-2026-0025','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 15:40:49','2026-10-30 15:40:49'),(26,'PPDB-2026-0026','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 16:02:02','2026-10-30 16:02:02'),(27,'PPDB-2026-0027','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 16:53:44','2026-10-30 16:53:44'),(28,'PPDB-2026-0028','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 16:57:44','2026-10-30 16:57:44'),(29,'PPDB-2026-0029','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 17:14:24','2026-10-30 17:14:24'),(30,'PPDB-2026-0030','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 17:53:22','2026-10-30 17:53:22'),(31,'PPDB-2026-0031','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 17:53:31','2026-10-30 17:53:31'),(32,'PPDB-2026-0032','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-10-30 18:12:33','2026-10-30 18:12:33'),(33,'PPDB-2026-0033','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-02 03:08:15','2026-11-02 03:08:15'),(34,'PPDB-2026-0034','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-02 03:24:01','2026-11-02 03:24:01'),(35,'PPDB-2026-0035','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-02 03:29:28','2026-11-02 03:29:28'),(36,'PPDB-2026-0036','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-02 03:33:28','2026-11-02 03:33:28'),(37,'PPDB-2026-0037','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-02 04:09:23','2026-11-02 04:09:23'),(38,'PPDB-2026-0038','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-02 04:18:51','2026-11-02 04:18:51'),(39,'PPDB-2026-0039','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-02 04:20:16','2026-11-02 04:20:16'),(40,'PPDB-2026-0040','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-02 04:44:40','2026-11-02 04:44:40'),(41,'PPDB-2026-0041','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-02 06:57:20','2026-11-02 06:57:20'),(42,'PPDB-2026-0042','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-03 01:42:09','2026-11-03 01:42:09'),(43,'PPDB-2026-0043','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-03 02:09:13','2026-11-03 02:09:13'),(44,'PPDB-2026-0044','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-03 02:28:13','2026-11-03 02:28:13'),(45,'PPDB-2026-0045','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-03 03:05:47','2026-11-03 03:05:47'),(46,'PPDB-2026-0046','2026/2027','Budi Santoso','1234567890','','L','Jakarta','2010-05-15','Islam','Jl. Merdeka No. 45 Jakarta Pusat','081234567890','Agus Santoso','','Siti Rahma','','< Rp 3.000.000','081298765432','SMP Negeri 1 Jakarta','',NULL,'MIPA (Matematika & IPA)',NULL,NULL,NULL,NULL,'pending',NULL,'2026-11-03 03:32:54','2026-11-03 03:32:54');
/*!40000 ALTER TABLE `ppdb_registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','web','2026-10-29 13:26:55','2026-10-29 13:26:55'),(2,'Admin Web','web','2026-10-29 13:26:55','2026-10-29 13:26:55'),(3,'Admin PPDB','web','2026-10-29 13:26:55','2026-10-29 13:26:55');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `payload` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_group_name_unique` (`group`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2719 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'general','school_name',0,'\"SLB Negeri Grobogan\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(2,'general','npsn',0,'\"20361280\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(3,'general','school_level',0,'\"SLB\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(4,'general','tagline',0,'\"Cerdas, Berkarakter, Berakhlak Mulia\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(5,'general','principal_name',0,'\"Sudarni, S.Pd\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(6,'general','principal_nip',0,'\"19710000000000\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(7,'general','principal_speech',0,'\"<p>Selamat datang di situs resmi SLB Negeri Grobogan. Kami berkomitmen untuk menyelenggarakan pendidikan berkualitas tinggi yang mengedepankan pembinaan karakter, kecerdasan intelektual, serta keterampilan abad 21.</p><p>Melalui portal ini, kami berharap dapat memberikan kemudahan akses informasi bagi seluruh peserta didik, wali murid, alumni, dan masyarakat luas.</p>\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(8,'general','principal_photo',0,'null','2026-10-29 13:26:47','2026-11-03 03:32:51'),(9,'general','logo_light',0,'null','2026-10-29 13:26:47','2026-11-03 03:32:51'),(10,'general','logo_dark',0,'null','2026-10-29 13:26:47','2026-11-03 03:32:51'),(11,'general','favicon',0,'null','2026-10-29 13:26:47','2026-11-03 03:32:51'),(12,'general','primary_color',0,'\"#1E3A8A\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(13,'general','secondary_color',0,'\"#0284C7\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(14,'general','accent_color',0,'\"#F59E0B\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(15,'general','address',0,'\"Jl. Pendidikan Karakter No. 100 Jakarta\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(16,'general','phone',0,'\"(021) 7890123\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(17,'general','whatsapp',0,'\"6281234567890\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(18,'general','email',0,'\"info@sekolah.sch.id\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(19,'general','maps_embed',0,'\"<iframe src=\\\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15837.190495549155!2d110.77184695000001!3d-7.0914579!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70bd2d9ec1ce41%3A0xbd654b0ee9f8a974!2sSLB%20Negeri%20Grobogan!5e0!3m2!1sid!2sid!4v1793370079065!5m2!1sid!2sid\\\" width=\\\"600\\\" height=\\\"450\\\" style=\\\"border:0;\\\" allowfullscreen=\\\"\\\" loading=\\\"lazy\\\" referrerpolicy=\\\"strict-origin-when-cross-origin\\\"></iframe>\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(20,'general','facebook_url',0,'\"https://facebook.com/slbngrobogan\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(21,'general','instagram_url',0,'\"https://instagram.com/slbngrobogan\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(22,'general','youtube_url',0,'\"https://youtube.com/@slbngrobogan2842\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(23,'general','tiktok_url',0,'\"https://tiktok.com/@slbngrobogan\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(24,'general','enable_hero_slider',0,'true','2026-10-29 13:26:47','2026-11-03 03:32:51'),(25,'general','enable_principal_speech',0,'true','2026-10-29 13:26:47','2026-11-03 03:32:51'),(26,'general','enable_school_stats',0,'true','2026-10-29 13:26:47','2026-11-03 03:32:51'),(27,'general','enable_latest_posts',0,'true','2026-10-29 13:26:47','2026-11-03 03:32:51'),(28,'general','enable_extracurriculars',0,'true','2026-10-29 13:26:47','2026-11-03 03:32:51'),(29,'general','enable_gallery',0,'true','2026-10-29 13:26:47','2026-11-03 03:32:51'),(30,'general','enable_testimonials',0,'true','2026-10-29 13:26:47','2026-11-03 03:32:51'),(31,'general','enable_faq',0,'true','2026-10-29 13:26:47','2026-11-03 03:32:51'),(32,'general','ppdb_is_active',0,'true','2026-10-29 13:26:47','2026-11-03 03:32:51'),(33,'general','ppdb_academic_year',0,'\"2026/2027\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(34,'general','ppdb_start_date',0,'\"2026-05-01\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(35,'general','ppdb_end_date',0,'\"2026-07-15\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(36,'general','ppdb_announcement',0,'\"Pendaftaran PPDB Jalur Zonasi, Afirmasi, dan Prestasi telah dibuka!\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(37,'general','graduation_is_active',0,'true','2026-10-29 13:26:47','2026-11-03 03:32:51'),(38,'general','graduation_academic_year',0,'\"2025/2026\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(39,'general','graduation_announcement_datetime',0,'\"2026-05-05 10:00:00\"','2026-10-29 13:26:47','2026-11-03 03:32:51'),(2068,'general','accreditation',0,'\"A (Unggul)\"','2026-11-03 02:05:10','2026-11-03 03:32:51'),(2069,'general','accreditation_body',0,'\"BAN-S/M\"','2026-11-03 02:05:10','2026-11-03 03:32:51'),(2070,'general','curriculum',0,'\"Kurikulum Merdeka\"','2026-11-03 02:05:10','2026-11-03 03:32:51'),(2071,'general','total_students',0,'159','2026-11-03 02:05:10','2026-11-03 03:32:51'),(2072,'general','total_teachers',0,'26','2026-11-03 02:05:10','2026-11-03 03:32:51'),(2073,'general','total_classes',0,'32','2026-11-03 02:05:10','2026-11-03 03:32:51'),(2074,'general','total_alumni',0,'500','2026-11-03 02:05:10','2026-11-03 03:32:51');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Olimpiade Sains','olimpiade-sains','2026-10-29 13:26:56','2026-10-29 13:26:56'),(2,'PPDB','ppdb','2026-10-29 13:26:56','2026-10-29 13:26:56'),(3,'Kegiatan Siswa','kegiatan-siswa','2026-10-29 13:26:56','2026-10-29 13:26:56');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nuptk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('guru','tendik') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'guru',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (1,'Sudarni, S.Pd','197100000000',NULL,'Kepala Sekolah',NULL,'guru','teachers/YUJkjVCf0TYTdDxyNObLOg9xGQs8PGMCXGBgCZE6.jpg','0812345678','email@slbngrobogan.sch.id','Lorem Ipsum',1,1,'2026-10-29 13:26:57','2026-11-02 04:54:25'),(2,'Dra. Hj. Nurjanah, M.Si.','19780210 200301 2 004',NULL,'Wakil Kepala Sekolah (Kurikulum)','Fisika','guru',NULL,NULL,NULL,NULL,2,1,'2026-10-29 13:26:57','2026-10-29 13:26:57'),(3,'Ahmad Fauzi, S.Pd., Gr.','19890415 201502 1 003',NULL,'Waka Kesiswaan & Pembina OSIS','Matematika Peminatan','guru',NULL,NULL,NULL,NULL,3,1,'2026-10-29 13:26:57','2026-10-29 13:26:57'),(4,'Rina Kartika, S.Kom.','19921104 201801 2 005',NULL,'Guru Informatika & Laboran AI','Informatika & Pemrograman','guru',NULL,NULL,NULL,NULL,4,1,'2026-10-29 13:26:57','2026-10-29 13:26:57'),(5,'Bambang Sudrajat, S.Sos.','19840819 200903 1 005',NULL,'Kepala Tata Usaha (TU)',NULL,'tendik',NULL,NULL,NULL,NULL,5,1,'2026-10-29 13:26:57','2026-10-29 13:26:57');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint unsigned NOT NULL DEFAULT '5',
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'dr. Andika Pratama, Sp.A.','Alumni Angkatan 2012 - Dokter Spesialis Anak RSCM','Dasar disiplin, integritas, dan rasa ingin tahu yang saya dapatkan selama menimba ilmu di sekolah ini menjadi modal utama keberhasilan saya menempuh pendidikan kedokteran.',NULL,5,1,1,'2026-10-29 13:26:57','2026-10-29 13:26:57'),(2,'Ir. Maya Safitri, M.T.','Alumni Angkatan 2016 - Software Engineer di Tech Unicorn','Fasilitas laboratorium komputer yang sangat memadai dan bimbingan guru yang suportif membuka jalan bagi karir saya di industri teknologi informasi modern.',NULL,5,2,1,'2026-10-29 13:26:57','2026-10-29 13:26:57');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Administrator','admin@sekolah.sch.id',NULL,'$2y$04$iJgo2RY37QczQ0JOF4j05uHlztmCqHcvyXFLw/8rUnBgAeG7kF/5S',NULL,'mQiFyNRANDCSdXbMZsbCq3BbQtoAryVxKY1UCRulqqlLksb3vydnTW1WUzYe','2026-10-29 13:26:56','2026-11-03 01:42:03'),(2,'Panitia PPDB','ppdb@sekolah.sch.id',NULL,'$2y$12$wRBe9UZU1ohpNDGU3RYNGuRkzssehD3WYXToJmF2tBdGeW48QEp2e',NULL,NULL,'2026-10-29 13:26:56','2026-10-29 13:26:56'),(3,'Admin Pengelola Web','adminweb@sekolah.sch.id',NULL,'$2y$12$nqSwP9gQP47xuI8chdTNDuoAz9ZsED4aGOdPXmrP5buTJdc6tZGJC',NULL,NULL,'2026-11-03 03:00:53','2026-11-03 03:00:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_sekolah'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-03 10:33:15

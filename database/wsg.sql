-- MySQL dump 10.13  Distrib 8.0.27, for macos11 (arm64)
--
-- Host: 127.0.0.1    Database: laravel
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purpose` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` bigint unsigned NOT NULL DEFAULT '999',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` json DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `blockable_id` bigint unsigned NOT NULL,
  `blockable_type` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (1,NULL,999,'{\"de\":\"Patientenklientel\"}','{\"de\": \"<ul><li>Jedes Geschlecht</li><li>Prä- oder postmenopausal</li><li>mit invasivem, unbehandeltem triple negativem Brustkrebs</li><li>&nbsp;Niedriges bis mittleres klinisches Rezidivrisiko (Stadium I und II)</li></ul><p><br></p>\"}',1,1,'App\\Models\\Study','2025-03-10 22:54:09','2025-03-10 22:54:41'),(2,NULL,999,'{\"de\":\"Studiendesign\"}','{\"de\": \"<ul><li>Multizentrisch</li><li>Interventionell, Phase II</li><li>Zweiarmig randomisiert</li><li>Prospektiv</li><li>offen, kontrolliert</li></ul><p><br></p>\"}',1,1,'App\\Models\\Study','2025-03-10 22:54:34','2025-03-10 22:54:34'),(3,NULL,999,'{\"de\":\"Studienziele\"}','{\"de\": \"<p>Ziel der ADAPT-TN-III Studie ist es, eine gut verträgliche und hochwirksame deeskalierte Therapie bei frühem triple negativen Brustkrebs zu untersuchen, mit dem Ziel, länger dauernde und toxischere Behandlungen zu vermeiden. Es wird untersucht, ob die Kombinationstherapie von Sacituzumab Govitecan + Pembrolizumab eine höhere Rate an pathologischer Komplettremission erreicht als die Therapie mit Sacituzumab Govitecan alleine. Weiterhin wird das 3-Jahres-Überleben in beiden Armen im Vergleich zu historischen Kontrollen untersucht.</p>\"}',1,1,'App\\Models\\Study','2025-03-10 22:55:39','2025-03-10 22:55:39'),(4,NULL,999,'{\"de\":\"Patientenklientel\"}','{\"de\": \"<p>Patientinnen mit frühem Brustkrebs in verschiedenen Subgruppen (jeweils eigene Substudie): 1) HR+/HER2- 2) HR+/HER2+ (triple positive) 3) HR-/HER2+ 4) HR-/HER2- (triple negative) 5) Elderly Die Substudien 2) bis 5) sind bereits abgeschlossen, inklusive Follow-Up. Die HR+/HER 2- Substudie befindet sich bezüglich der Chemotherapie-Fragestellung aktuell im Follow-Up</p>\"}',1,2,'App\\Models\\Study','2025-03-10 22:58:25','2025-03-10 22:58:25'),(5,NULL,999,'{\"de\":\"Studiendesign\"}','{\"de\": \"<p>Prospektive, multizentrische, randomisierte Phase III Studie</p>\"}',1,2,'App\\Models\\Study','2025-03-10 23:00:09','2025-03-10 23:00:09'),(6,NULL,999,'{\"de\":\"Studienziele\"}','{\"de\": \"<p>In der ADAPT Studie werden sowohl die persönlichen Risikofaktoren als auch das vorhergesagte Therapieansprechen berücksichtigt, um jeder Patientin eine individuelle, optimierte Therapie anbieten zu können. Ziele der Studie sind die Untersuchung der Wirksamkeit und der Verträglichkeit der verabreichten Therapien sowie die Verteilung der Risikoprofile.</p>\"}',1,2,'App\\Models\\Study','2025-03-10 23:01:18','2025-03-10 23:01:18');
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `breezy_sessions`
--

DROP TABLE IF EXISTS `breezy_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `breezy_sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `authenticatable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authenticatable_id` bigint unsigned NOT NULL,
  `panel_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `expires_at` timestamp NULL DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `breezy_sessions_authenticatable_type_authenticatable_id_index` (`authenticatable_type`,`authenticatable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `breezy_sessions`
--

LOCK TABLES `breezy_sessions` WRITE;
/*!40000 ALTER TABLE `breezy_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `breezy_sessions` ENABLE KEYS */;
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
-- Table structure for table `centres`
--

DROP TABLE IF EXISTS `centres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `centres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `centre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `geocode` json DEFAULT NULL,
  `leader` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leader_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` json DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centres`
--

LOCK TABLES `centres` WRITE;
/*!40000 ALTER TABLE `centres` DISABLE KEYS */;
INSERT INTO `centres` VALUES (10,'Ev. Krankenhaus Bethesda Mönchengladbach','Brustzentrum / Senologie','Ludwig-Weber-Straße 15, 41061 Mönchengladbach',NULL,'Prof. Dr. med. Oleg Gluz','{\"de\":\"Chefarzt\",\"en\":\"\"}','{\"de\": \"Kompetente und kurzfristige Diagnose und Behandlung aller Veränderungen der Brust. Behandlung aller gut- und bösartigen Erkrankungen der Brust bei Frauen und Männern.\", \"en\": \"\"}','https://www.johanniter.de/johanniter-kliniken/ev-krankenhaus-bethesda-moenchengladbach/zentren/brustzentrum-/-senologie/','+49 2161 981-2330',NULL,1,'2025-03-10 23:35:03','2025-03-10 23:35:50'),(13,'LMU Klinikum','Brustzentrum','Ziemssenstr. 1, 80336 München',NULL,'Prof. Dr. med. Nadia Harbeck','{\"de\":\"Leitung Brustzentrum und Onkologische Tagesklinik der Frauenklinik der Universität München\",\"en\":\"\"}','{\"en\": \"\"}','https://www.lmu-klinikum.de/brustzentrum','089 4400-34650','brustzentrum@med.uni-muenchen.de',1,'2025-03-10 23:40:32','2025-03-10 23:41:23');
/*!40000 ALTER TABLE `centres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `change_logs`
--

DROP TABLE IF EXISTS `change_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `change_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `change_logs`
--

LOCK TABLES `change_logs` WRITE;
/*!40000 ALTER TABLE `change_logs` DISABLE KEYS */;
INSERT INTO `change_logs` VALUES (1,'post',1,'created','2025-03-10 22:42:25','2025-03-10 22:42:25'),(2,'image',1,'created','2025-03-10 22:42:25','2025-03-10 22:42:25'),(3,'image',2,'created','2025-03-10 22:42:25','2025-03-10 22:42:25'),(4,'page',1,'created','2025-03-10 22:51:09','2025-03-10 22:51:09'),(5,'page',2,'created','2025-03-10 22:52:29','2025-03-10 22:52:29'),(6,'study',1,'created','2025-03-10 22:53:41','2025-03-10 22:53:41'),(7,'image',3,'created','2025-03-10 22:53:41','2025-03-10 22:53:41'),(8,'block',1,'created','2025-03-10 22:54:09','2025-03-10 22:54:09'),(9,'block',2,'created','2025-03-10 22:54:34','2025-03-10 22:54:34'),(10,'block',1,'updated','2025-03-10 22:54:41','2025-03-10 22:54:41'),(11,'image',4,'created','2025-03-10 22:55:07','2025-03-10 22:55:07'),(12,'block',3,'created','2025-03-10 22:55:39','2025-03-10 22:55:39'),(13,'study',1,'updated','2025-03-10 22:55:59','2025-03-10 22:55:59'),(14,'study',2,'created','2025-03-10 22:57:40','2025-03-10 22:57:40'),(15,'image',5,'created','2025-03-10 22:57:40','2025-03-10 22:57:40'),(16,'block',4,'created','2025-03-10 22:58:25','2025-03-10 22:58:25'),(17,'block',5,'created','2025-03-10 23:00:09','2025-03-10 23:00:09'),(18,'image',6,'created','2025-03-10 23:00:09','2025-03-10 23:00:09'),(19,'image',6,'updated','2025-03-10 23:00:22','2025-03-10 23:00:22'),(20,'block',6,'created','2025-03-10 23:01:18','2025-03-10 23:01:18'),(21,'team',1,'created','2025-03-10 23:10:34','2025-03-10 23:10:34'),(22,'image',7,'created','2025-03-10 23:10:34','2025-03-10 23:10:34'),(23,'image',7,'updated','2025-03-10 23:10:54','2025-03-10 23:10:54'),(24,'team',2,'created','2025-03-10 23:12:29','2025-03-10 23:12:29'),(25,'image',8,'created','2025-03-10 23:12:29','2025-03-10 23:12:29'),(26,'team',1,'updated','2025-03-10 23:16:58','2025-03-10 23:16:58'),(27,'team',1,'updated','2025-03-10 23:17:09','2025-03-10 23:17:09'),(28,'team',2,'updated','2025-03-10 23:17:12','2025-03-10 23:17:12'),(29,'team',2,'updated','2025-03-10 23:17:13','2025-03-10 23:17:13'),(30,'team',1,'updated','2025-03-10 23:22:56','2025-03-10 23:22:56'),(31,'team',2,'updated','2025-03-10 23:22:58','2025-03-10 23:22:58'),(32,'centre',1,'deleted','2025-03-10 23:35:39','2025-03-10 23:35:39'),(33,'centre',2,'deleted','2025-03-10 23:35:39','2025-03-10 23:35:39'),(34,'centre',3,'deleted','2025-03-10 23:35:39','2025-03-10 23:35:39'),(35,'centre',4,'deleted','2025-03-10 23:35:39','2025-03-10 23:35:39'),(36,'centre',5,'deleted','2025-03-10 23:35:39','2025-03-10 23:35:39'),(37,'centre',6,'deleted','2025-03-10 23:35:39','2025-03-10 23:35:39'),(38,'centre',7,'deleted','2025-03-10 23:35:39','2025-03-10 23:35:39'),(39,'centre',8,'deleted','2025-03-10 23:35:39','2025-03-10 23:35:39'),(40,'centre',9,'deleted','2025-03-10 23:35:39','2025-03-10 23:35:39'),(41,'centre',11,'deleted','2025-03-10 23:40:45','2025-03-10 23:40:45'),(42,'centre',12,'deleted','2025-03-10 23:40:45','2025-03-10 23:40:45');
/*!40000 ALTER TABLE `change_logs` ENABLE KEYS */;
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
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cockpit_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int unsigned NOT NULL DEFAULT '0',
  `meta` json DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `imageable_id` bigint unsigned NOT NULL,
  `imageable_type` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,NULL,'{\"de\":\"post/brustkrebsmonatoktober/oleg2-1-1741642945.jpg\"}','image',0,NULL,1,1,'App\\Models\\Post','2025-03-10 22:42:25','2025-03-10 22:42:25'),(2,NULL,'{\"de\":\"post/brustkrebsmonatoktober/wsg-operational-leadership-team-1024x683-1741642945.jpg\"}','image',0,NULL,1,1,'App\\Models\\Post','2025-03-10 22:42:25','2025-03-10 22:42:25'),(3,NULL,'{\"de\":\"study/adapt-tn-iii/logo/adapt-tn-iii-300x183-1741643621.jpg\"}','image',0,NULL,1,1,'App\\Models\\Study','2025-03-10 22:53:41','2025-03-10 22:53:41'),(4,NULL,'{\"de\":\"study/adapt-tn-iii/de/adapt-tn-iii-design-1741643707.png\"}','image',0,NULL,1,2,'App\\Models\\Block','2025-03-10 22:55:07','2025-03-10 22:55:07'),(5,NULL,'{\"de\":\"study/adapt/logo/adapt-logo-300x186-1741643860.png\"}','image',0,NULL,1,2,'App\\Models\\Study','2025-03-10 22:57:40','2025-03-10 22:57:40'),(6,NULL,'{\"de\":\"study/adapt/de/adapt-umbrella-design-1741644022.png\"}','image',0,NULL,1,5,'App\\Models\\Block','2025-03-10 23:00:09','2025-03-10 23:00:22'),(7,NULL,'{\"de\":\"team/prof-dr-med-ulrike-nitz/nitz-ulrike-1741644654.jpg\"}','portrait',0,NULL,1,1,'App\\Models\\Team','2025-03-10 23:10:34','2025-03-10 23:10:54'),(8,NULL,'{\"de\":\"team/prof-dr-med-nadia-harbeck/harbeck-1741644749.jpg\"}','portrait',0,NULL,1,2,'App\\Models\\Team','2025-03-10 23:12:29','2025-03-10 23:12:29');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2022_12_14_083707_create_settings_table',1),(5,'2024_06_15_120923_create_permission_tables',1),(6,'2024_06_15_121554_create_breezy_sessions_table',1),(7,'2024_06_15_144218_create_images_table',1),(8,'2024_07_10_130340_create_pages_table',1),(9,'2024_07_11_112517_create_agentur_settings',1),(10,'2024_07_11_154658_create_changes_table',1),(11,'2024_07_11_171905_create_personal_access_tokens_table',1),(12,'2024_11_17_150649_create_studies_table',1),(13,'2024_11_29_180050_create_blocks_table',1),(14,'2024_11_30_224936_create_posts_table',1),(15,'2024_12_07_110658_create_teams_table',1),(16,'2024_12_07_115633_create_units_table',1),(17,'2024_12_08_111629_create_centres_table',1),(18,'2024_12_08_123110_create_study_centre_table',1),(19,'2025_03_07_221623_create_company_contact',2);
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
INSERT INTO `model_has_roles` VALUES (2,'App\\Models\\User',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sort` bigint unsigned NOT NULL DEFAULT '999',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` json DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,999,'{\"de\":\"Impressum\"}','{\"de\":\"impressum\"}','{\"de\": \"<h3><strong>Diese Website wird betrieben von:</strong></h3><p>WSG - Westdeutsche Studiengruppe GmbH<br>Fliethstraße 112-114</p><p>41061 Mönchengladbach</p><h3><strong>Kontakt</strong></h3><p>Fon: +49 (0) 2161 56623 0<br>Fax: +49 (0) 2161 56623 19</p><p>Email: wsg@wsg-online.com<br>Internet: www.wsg-online.com</p><h3><strong>Geschäftsführung | Representative and CEO:</strong></h3><p>Annette Schürmann</p><h3><strong>Handelsregistereintrag | Company registration number:</strong></h3><p>HRB 12062<br>Amtsgericht Mönchengladbach</p><h3><strong>Umsatzsteuer ID | Sales tax identification number according to §27a Umsatzsteuergesetz:</strong></h3><p>DE254707395</p><h3><strong>Verantwortlich für Inhalte nach | Responsible for content:</strong></h3><p>Annette Schürmann</p><h3><strong>Rechtliche Hinweise</strong></h3><p>Die WSG versucht alle Informationen auf ihren Internetseiten fehlerfrei und aktuell zu halten. Dennoch kann für den Inhalt keine Haftung übernommen werden. Auch auf den Inhalt und die Gestaltung verlinkter Internetseiten haben wir keinen Einfluss.</p><p>Deshalb distanzieren wir uns hiermit ausdrücklich von allen Inhalten aller verlinkten Internetseiten auf unserer Homepage und machen uns deren Inhalte nicht zueigen.</p><p>Diese Erklärung gilt für alle auf der www.wsg-online.com aufgeführten externen Links!</p><p><br></p>\"}',NULL,1,'2025-03-10 22:51:09','2025-03-10 22:51:09'),(2,999,'{\"de\":\"Datenschutzerklärung\"}','{\"de\":\"datenschutzerklarung\"}','{\"de\": \"<p>Datenschutz und Datensicherheit für die Kunden und Partner der Westdeutschen Studiengruppe wie auch von Interessenten und Nutzern unseres Webauftrittes haben für unsere Geschäftsleitung einen hohen Stellenwert. Transparenz bezüglich der Verarbeitung Ihrer personenbezogenen Daten wie auch der Schutz Ihrer Daten sind uns daher besonders wichtig.<br>Mit dieser Datenschutzerklärung informieren wir Sie, wie bei der Nutzung unserer Internetseiten Daten zu Ihrer Person erhoben und verarbeitet.</p><h3><strong>Verantwortlich für die Bearbeitung</strong></h3><p>Westdeutsche Studiengruppe<br>Annette Schürmann<br>Geschäftsführer / General Manager<br>Wallstraße 10<br>41061 Mönchengladbach<br>Germany</p><p>FON + 49 (0) 2161. 5 66 23-0</p><h3><strong>Datenschutzbeauftragter</strong></h3><p>Marc Brooks<br>Rheinsichtweg 8<br>8274 Tägerwilen<br>Schweiz<br>datenschutz@wsg-online.com</p><h3><strong>Was sind personenbezogene Daten?</strong></h3><p>Personenbezogene Daten sind alle Informationen, die sich auf eine identifizierte oder identifizierbare natürliche Person beziehen. Entscheidend ist also, ob durch die erhobenen Daten ein Bezug zu Personen hergestellt werden kann. Darunter fallen Informationen wie z.B. Ihr Name, Ihre Anschrift, Ihre Telefon­nummer, Mailadresse. Informationen, die nicht direkt mit Ihrer wirklichen Identität in Verbindung gebracht werden - wie z.B. favorisierte Webseiten oder Anzahl der Nutzer einer Seite - sind keine personenbezogenen Daten.</p><h3><strong>Wie erheben oder verarbeiten wir Daten zu Ihrer Person?</strong></h3><p>Wenn Sie unsere Webseite besuchen, machen Sie keine Angaben zu Ihrer Person. Personenbezogene Daten werden nur erhoben, wenn Sie uns diese im Rahmen Ihres Besuchs unseres Internetauftritts freiwillig mitteilen.</p><h3><strong>Wie nutzen wir Daten zu Ihrer Person, wie geben wir sie weiter?</strong></h3><p>Wenn Sie uns Nachrichten zuschicken, werden Ihre persönlichen Daten nur insoweit gesammelt, als es für eine Antwort erforderlich ist. Die E-Mail wird unverschlüsselt übermittelt. Die von Ihnen zur Verfügung gestellten persönlichen Daten verwenden wir ausschließlich zum Zweck der technischen Administration der Webseiten und zur Erfüllung Ihrer Wünsche und Anforderungen, also in der Regel zur Beantwortung Ihrer Anfrage. Nur soweit Sie uns zuvor Ihre Einwilligung erteilt haben bzw. wenn Sie - soweit gesetzliche Regelungen dies vorsehen - keinen Widerspruch eingelegt haben, nutzen wir diese Daten auch für Umfragen, Informationszwecke und statistische Zwecke. Eine Weitergabe, Verkauf oder sonstige Übermittlung Ihrer personenbezogenen Daten an Dritte erfolgt nicht, es sei denn, dass dies zum Zwecke von Vertragsabwicklungen erforderlich ist oder Sie ausdrücklich eingewilligt haben. Eine erteilte Einwilligung kann mit Wirkung für die Zukunft jederzeit widerrufen werden.</p><p>Diese Webseite verwendet Google Maps API, um geographische Informationen visuell darzustellen. Bei der Nutzung von Google Maps werden von Google auch Daten über die Nutzung der Kartenfunktionen durch Besucher erhoben, verarbeitet und genutzt.&nbsp;</p><h3><strong>Wie lange bleiben Ihre Daten gespeichert?</strong></h3><p>Grundsätzlich speichern wir alle personenbezogenen Daten von Ihnen solange wie es nötig ist den jeweiligen Zweck zu erfüllen, z.B. bei Anfragen bis zur Erledigung, bei Newslettern bis Sie den Newsletter wieder abbestellen. Ist eine längere Speicherung gesetzlich notwendig, erfolgt die Speicherung in diesem Rahmen. Sollten Sie nicht mehr wünschen, dass wir Ihre Daten nutzen, so kommen wir dieser Bitte natürlich umgehend nach. Sie können dazu Sie jederzeit über die E-Mail wsg@wsg-online.com mit uns in Verbindung treten.</p><h3><strong>Wann werden Ihre Daten gelöscht?</strong></h3><p>Wir löschen die personenbezogenen Daten wenn Sie ihre Einwilligung zur Speicherung widerrufen, wenn wir die Daten nicht mehr brauchen um den vorgesehenen Zweck zu erfüllen oder wenn die Speicherung aus sonstigen gesetzlichen Gründen unzulässig ist.</p><h3><strong>Was tun wir für die Sicherheit der Verarbeitung?</strong></h3><p>Diese Seite nutzt aus Sicherheitsgründen eine SSL-bzw. TLS-Verschlüsselung. Sie erkennen die verschlüsselte Verbindung daran, an dem Schloss-Symbol in Ihrer Browserzeile und/oder daran, dass die Adresszeile des Browsers von \\\"http://\\\" auf \\\"https://\\\" wechselt. Wenn die SSL- bzw. TLS-Verschlüsselung aktiviert ist, können die Daten, die Sie an uns übermitteln, nicht von Dritten mitgelesen werden. Sollten Sie mit unserem Unternehmen über E-Mail in Kontakt treten wollen, weisen wir darauf hin, dass die Vertraulichkeit der übermittelten Informationen nicht gewährleistet ist. Der Inhalt von E-Mails könnte von Dritten eingesehen werden. Wir empfehlen Ihnen daher, uns vertrauliche Informationen ausschließlich über den Postweg zukommen zu lassen.</p><h3><strong>Einsatz von Cookies</strong></h3><p>Im Rahmen Ihres Besuchs auf unseren Seiten verwenden wir sogenannte Cookies. Cookies richten auf Ihrem Rechner keinen Schaden an und enthalten keine Viren. Cookies dienen dazu, unser Angebot nutzerfreundlicher, effektiver und sicherer zu machen. Cookies sind kleine Textdateien, die auf Ihrem Rechner abgelegt werden und die Ihr Browser speichert.</p><h3>Folgende Cookies werden gesetzt:</h3><p>Server-Cookies für die Nutzung des Webauftritts: Sie werden nach Ende Ihres Besuchs automatisch gelöscht (so genannte „Sitzungs-Cookies“) Google-Cookies im Rahmen von Google Analytics: Gemäß Google-Policy - Siehe <a href=\\\"http://www.google.com/intl/de/policies/privacy\\\">http://www.google.com/intl/de/policies/privacy</a> Sie können Ihren Browser so einstellen, dass Sie über das Setzen von Cookies informiert werden und Cookies nur im Einzelfall erlauben, die Annahme von Cookies für bestimmte Fälle oder generell ausschließen sowie das automatische Löschen der Cookies beim Schließen des Browser aktivieren. Bei der Deaktivierung von Cookies kann die Funktionalität unserer Website eingeschränkt sein.</p><p>Der Websitebetreiber hat ein berechtigtes Interesse an der Speicherung von Cookies zur technisch fehlerfreien und optimierten Bereitstellung seiner Dienste.</p><h3><strong>Newsletter</strong></h3><h3>Newsletter­daten</h3><p>Wenn Sie den auf der Website angebotenen Newsletter beziehen möchten, benötigen wir von Ihnen eine E-Mail-Adresse sowie Informationen, welche uns die Überprüfung gestatten, dass Sie der Inhaber der angegebenen E-Mail-Adresse und mit dem Empfang des Newsletters einverstanden sind. Weitere Daten werden nicht bzw. nur auf freiwilliger Basis erhoben. Für die Abwicklung der Newsletter nutzen wir Newsletterdiensteanbieter, die nachfolgend beschrieben werden.</p><h3>MailPoet</h3><p>Diese Website nutzt MailPoet für den Versand von Newslettern. Anbieter ist die Aut O’Mattic A8C Ireland Ltd., Business Centre, No.1 Lower Mayor Street, International Financial Services Centre, Dublin 1, Irland, deren Mutterunternehmen in den USA sitzt (nachfolgend MailPoet).</p><p>MailPoet ist ein Dienst, mit dem u.a. der Versand von Newslettern organisiert und analysiert werden kann. Die von Ihnen zum Zwecke des Newsletterbezugs eingegeben Daten werden auf unseren Servern gespeichert aber über die Server von MailPoet versandt, sodass MailPoet Ihre newsletterbezogenen Daten verarbeitet (MailPoet Sending Service). Details finden Sie hier: <a href=\\\"https://account.mailpoet.com/\\\">https://account.mailpoet.com/</a>.</p><h3>Datenanalyse durch MailPoet</h3><p>Mit Hilfe von MailPoet ist es uns möglich, unsere Newsletter-Kampagnen zu analysieren. So können wir z. B. sehen, ob eine Newsletter-Nachricht geöffnet wurde und welche Links ggf. angeklickt wurden. Auf diese Weise können wir u.a. feststellen, welche Links besonders oft angeklickt wurden.</p><p>MailPoet ermöglicht es uns auch, die Newsletter-Empfänger anhand verschiedener Kategorien zu unterteilen („clustern”). Dabei lassen sich die Newsletterempfänger z. B. nach Alter, Geschlecht oder Wohnort unterteilen. Auf diese Weise lassen sich die Newsletter besser an die jeweiligen Zielgruppen anpassen. Wenn Sie keine Analyse durch MailPoet wollen, müssen Sie den Newsletter abbestellen. Hierfür stellen wir in jeder Newsletternachricht einen entsprechenden Link zur Verfügung.</p><p>Ausführliche Informationen zu den Funktionen von MailPoet entnehmen Sie folgendem Link: <a href=\\\"https://account.mailpoet.com/\\\">https://account.mailpoet.com/</a> und <a href=\\\"https://www.mailpoet.com/mailpoet-features/\\\">https://www.mailpoet.com/mailpoet-features/</a>.</p><p>Die Datenschutzerklärung von MailPoet finden Sie unter: <a href=\\\"https://www.mailpoet.com/privacy-notice/\\\">https://www.mailpoet.com/privacy-notice/</a>.</p><h3>Rechtsgrundlage</h3><p>Die Datenverarbeitung erfolgt auf Grundlage Ihrer Einwilligung (Art. 6 Abs. 1 lit. a DSGVO). Sie können diese Einwilligung jederzeit für die Zukunft widerrufen.</p><p>Die Datenübertragung in die USA wird auf die Standardvertragsklauseln der EU-Kommission gestützt. Details finden Sie hier: <a href=\\\"https://automattic.com/de/privacy/\\\">https://automattic.com/de/privacy/</a>.</p><h3>Speicherdauer</h3><p>Die von Ihnen zum Zwecke des Newsletter-Bezugs bei uns hinterlegten Daten werden von uns bis zu Ihrer Austragung aus dem Newsletter bei uns gespeichert und nach der Abbestellung des Newsletters aus der Newsletterverteilerliste oder nach Zweckfortfall gelöscht. Wir behalten uns vor, E-Mail-Adressen aus unserem Newsletterverteiler nach eigenem Ermessen im Rahmen unseres berechtigten Interesses nach Art. 6 Abs. 1 lit. f DSGVO zu löschen oder zu sperren. Daten, die zu anderen Zwecken bei uns gespeichert wurden, bleiben hiervon unberührt.</p><p>Nach Ihrer Austragung aus der Newsletterverteilerliste wird Ihre E-Mail-Adresse bei uns ggf. in einer Blacklist gespeichert, sofern dies zur Verhinderung künftiger Mailings erforderlich ist. Die Daten aus der Blacklist werden nur für diesen Zweck verwendet und nicht mit anderen Daten zusammengeführt. Dies dient sowohl Ihrem Interesse als auch unserem Interesse an der Einhaltung der gesetzlichen Vorgaben beim Versand von Newslettern (berechtigtes Interesse im Sinne des Art. 6 Abs. 1 lit. f DSGVO). Die Speicherung in der Blacklist ist zeitlich nicht befristet. Sie können der Speicherung widersprechen, sofern Ihre Interessen unser berechtigtes Interesse überwiegen.</p><h3><strong>Das sind Ihre Datenschutzrechte</strong></h3><p>Sie haben im Rahmen der geltenden gesetzlichen Bestimmungen jederzeit das Recht auf unentgeltliche Auskunft über Ihre gespeicherten personenbezogenen Daten, deren Herkunft und mögliche Empfänger und den Zweck der Datenverarbeitung (Art. 15 DSGVO) und ggf. ein Recht auf Berichtigung unrichtiger Daten Art. 16 DSGVO), Löschung dieser Daten (Art. 17 DSGVO) das Recht auf Einschränkung der Verarbeitung nach Art. 18 DSGVO, auf Widerspruch (Art. 21 DSGVO) sowie das Recht auf Datenübertragbarkeit von Ihnen bereitgestellter Daten nach Art. 20 DSGVO). Beim Auskunftsrecht und beim Löschungsrecht gelten die Einschränkungen nach §§ 34 und 35 BDSG. Darüber hinaus steht Ihnen im Falle datenschutzrechtlicher Verstöße ein Beschwerderecht bei der zuständigen Aufsichtsbehörde zu (Art. 77 DSGVO i.V.m. §19 BDSG). Die zuständige Aufsichtsbehörde in datenschutzrechtlichen Fragen ist der Landesbeauftragte für Datenschutz und Informationsfreiheit Nordrhein-Westfalen, Kavalleriestraße 2-4, 40213 Düsseldorf, Deutschland, Telefon: +49 211 384240, <a href=\\\"https://www.ldi.nrw.de/\\\">https://www.ldi.nrw.de/</a>.</p><h3><strong>Wie Sie gegebene Einwilligungen zur Datenverarbeitung widerrufen können?</strong></h3><p>In manchen Fällen ist die Verarbeitung ihrer Daten nur mit Ihrer ausdrücklichen Einwilligung möglich. Sie können eine bereits erteilte Einwilligung jederzeit widerrufen. Dazu reicht eine formlose Mitteilung per E-Mail an uns. Die Rechtmäßigkeit der bis zum Widerruf erfolgten Datenverarbeitung bleibt vom Widerruf unberührt.</p><h3><strong>Kontakt bei Fragen, Beschwerden, Geltendmachung ihrer Rechte</strong></h3><p>Sie können sich jederzeit bei Fragen, Beschwerden oder Geltendmachung Ihrer Datenschutzrechte über die E-Mail datenschutz@wsg-online.com mit uns melden.</p>\"}',NULL,1,'2025-03-10 22:52:29','2025-03-10 22:52:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view_role','web','2025-03-07 21:47:20','2025-03-07 21:47:20'),(2,'view_any_role','web','2025-03-07 21:47:20','2025-03-07 21:47:20'),(3,'create_role','web','2025-03-07 21:47:20','2025-03-07 21:47:20'),(4,'update_role','web','2025-03-07 21:47:20','2025-03-07 21:47:20'),(5,'delete_role','web','2025-03-07 21:47:20','2025-03-07 21:47:20'),(6,'delete_any_role','web','2025-03-07 21:47:20','2025-03-07 21:47:20'),(7,'view_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(8,'view_any_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(9,'create_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(10,'update_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(11,'restore_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(12,'restore_any_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(13,'replicate_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(14,'reorder_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(15,'delete_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(16,'delete_any_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(17,'force_delete_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(18,'force_delete_any_centre','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(19,'view_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(20,'view_any_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(21,'create_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(22,'update_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(23,'restore_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(24,'restore_any_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(25,'replicate_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(26,'reorder_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(27,'delete_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(28,'delete_any_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(29,'force_delete_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(30,'force_delete_any_page','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(31,'view_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(32,'view_any_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(33,'create_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(34,'update_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(35,'restore_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(36,'restore_any_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(37,'replicate_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(38,'reorder_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(39,'delete_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(40,'delete_any_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(41,'force_delete_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(42,'force_delete_any_post','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(43,'view_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(44,'view_any_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(45,'create_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(46,'update_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(47,'restore_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(48,'restore_any_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(49,'replicate_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(50,'reorder_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(51,'delete_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(52,'delete_any_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(53,'force_delete_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(54,'force_delete_any_study','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(55,'view_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(56,'view_any_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(57,'create_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(58,'update_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(59,'restore_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(60,'restore_any_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(61,'replicate_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(62,'reorder_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(63,'delete_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(64,'delete_any_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(65,'force_delete_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(66,'force_delete_any_team','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(67,'view_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(68,'view_any_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(69,'create_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(70,'update_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(71,'restore_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(72,'restore_any_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(73,'replicate_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(74,'reorder_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(75,'delete_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(76,'delete_any_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(77,'force_delete_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(78,'force_delete_any_unit','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(79,'view_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(80,'view_any_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(81,'create_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(82,'update_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(83,'restore_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(84,'restore_any_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(85,'replicate_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(86,'reorder_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(87,'delete_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(88,'delete_any_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(89,'force_delete_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23'),(90,'force_delete_any_user','web','2025-03-07 21:48:23','2025-03-07 21:48:23');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` set('event','blog') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` json DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'{\"de\":\"#Brustkrebsmonatoktober\"}','{\"de\":\"brustkrebsmonatoktober\"}','event','{\"de\": \"<p>Das WSG-Team ist sehr dankbar für die unschätzbaren Beiträge unserer Zentren und der Patienten, die an unseren verschiedenen Studienprotokollen teilnehmen. Die Daten zeigen weiterhin, dass diese Bemühungen einen bedeutenden Beitrag bei der Verbesserung der Behandlungsmöglichkeiten für Brustkrebspatientinnen leisten. Wir hatten kürzlich das Privileg, die Ergebnisse der WSG-TP-II-Studie auf der ESMO vorzustellen und über die Fortschritte zu berichten, die wir in diesem wichtigen Bereich machen.</p><p>Da unsere Organisation als Reaktion auf neue Studien und wissenschaftliche Möglichkeiten weiter wächst, freuen wir uns, zwei wichtige Neuzugänge in unserem operativen Führungsteam bekannt zu geben. <a href=\\\"https://www.linkedin.com/in/kerstin-k%C3%BChn-wache-56631090/\\\"><span style=\\\"text-decoration: underline;\\\">Kerstin Kühn-Wache</span></a> ist als Leiterin des Qualitätsmanagements zu uns gestoßen und bringt aus ihrer Tätigkeit in der Biotech-Branche umfangreiche Erfahrungen in der klinischen Forschung und Qualitätssicherung mit. <a href=\\\"https://www.linkedin.com/in/christopherschlebusch/\\\"><span style=\\\"text-decoration: underline;\\\">Christopher Schlebusch</span></a> als Head of Project Delivery&nbsp; bringt über zwei Jahrzehnte Führungserfahrung im Umfeld der TOP-5 CROs mit. Wir freuen uns auf ihren Beitrag bei der operativen Führung und die kontinuierlichen Fortschritte bei unserer Mission, die Brustkrebsbehandlung für die Patienten zu verbessern.<br><br>Das WSG Operational Leadership-Team (v.l.n.r.): <a href=\\\"https://www.linkedin.com/in/annette-schuermann-0268354/\\\"><span style=\\\"text-decoration: underline;\\\">Annette Schuermann</span></a> (General Manager), <a href=\\\"https://www.linkedin.com/in/michael-st%C3%A4dele-655916113/\\\"><span style=\\\"text-decoration: underline;\\\">Michael Städele</span></a> (Business Development), <a href=\\\"https://www.linkedin.com/in/kerstin-k%C3%BChn-wache-56631090/\\\"><span style=\\\"text-decoration: underline;\\\">Kerstin Kühn-Wache</span></a> (QM), <a href=\\\"https://www.linkedin.com/in/stefan-l-b16a43160/\\\"><span style=\\\"text-decoration: underline;\\\">Stefan Lenzen</span></a> (Finance &amp; HR), Bettina Bonn (Clinical Operations), <a href=\\\"https://www.linkedin.com/in/dr-marlen-breuer-021026163/\\\"><span style=\\\"text-decoration: underline;\\\">Marlen Breuer</span></a> (Data Management), <a href=\\\"https://www.linkedin.com/in/anja-brascho%C3%9F-41090158/\\\"><span style=\\\"text-decoration: underline;\\\">Anja Braschoß</span></a> (Regulatory, Safety &amp; Medical), <a href=\\\"https://www.linkedin.com/in/christopherschlebusch/\\\"><span style=\\\"text-decoration: underline;\\\">Christopher Schlebusch</span></a> (Project Delivery).&nbsp;</p>\"}',NULL,1,'2025-03-10 22:42:25','2025-03-10 22:42:25');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
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
INSERT INTO `role_has_permissions` VALUES (1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(44,2),(45,2),(46,2),(47,2),(48,2),(49,2),(50,2),(51,2),(52,2),(53,2),(54,2),(55,2),(56,2),(57,2),(58,2),(59,2),(60,2),(61,2),(62,2),(63,2),(64,2),(65,2),(66,2),(67,2),(68,2),(69,2),(70,2),(71,2),(72,2),(73,2),(74,2),(75,2),(76,2),(77,2),(78,2),(79,2),(80,2),(81,2),(82,2),(83,2),(84,2),(85,2),(86,2),(87,2),(88,2),(89,2),(90,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'panel_user','web','2025-03-07 17:33:54','2025-03-07 17:33:54'),(2,'super_admin','web','2025-03-07 21:34:01','2025-03-07 21:34:01');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'company','email',0,'\"wsg@wsg-online.com\"','2025-03-07 22:24:12','2025-03-07 22:24:12'),(2,'company','fon',0,'\"+ 49 (0) 2161 5 66 23-0\"','2025-03-07 22:24:12','2025-03-07 22:24:12'),(3,'company','address',0,'\"Fliethstraße 112-114\\n41061 Mönchengladbach\\nGermany\"','2025-03-07 22:24:12','2025-03-07 22:24:12'),(4,'company','workhours',0,'\"Montags bis Donnerstags: 9 - 16 Uhr\\nFreitags: 9 - 14 Uhr\"','2025-03-07 22:24:12','2025-03-07 22:24:12'),(5,'company','linkedin',0,'\"https://www.linkedin.com/company/westdeutsche-studiengruppe-gmbh/\"','2025-03-07 22:24:12','2025-03-07 22:24:12'),(6,'company','instagram',0,'\"https://instagram.com/wsg_online\"','2025-03-07 22:24:12','2025-03-07 22:24:12');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studies`
--

DROP TABLE IF EXISTS `studies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `shortcode` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` set('recruiting','followup') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` json DEFAULT NULL,
  `sort` bigint unsigned NOT NULL DEFAULT '999',
  `published_at` datetime DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studies`
--

LOCK TABLES `studies` WRITE;
/*!40000 ALTER TABLE `studies` DISABLE KEYS */;
INSERT INTO `studies` VALUES (1,'ADAPT-TN-III','adapt-tn-iii','{\"de\":\"NeoAdjuvante, an Dynamischen Markern Adjustierte, Personalisierte Therapie mit Sacituzumab Govitecan im Vergleich zu Sacituzumab Govitecan + Pembrolizumab in frühem, triple-negativem Brustkrebs mit niedrigem Rezidivrisiko\"}','recruiting',NULL,999,'2025-03-10 22:55:00',1,'2025-03-10 22:53:41','2025-03-10 22:55:59'),(2,'ADAPT','adapt','{\"de\":\"Adjuvante, an dynamischen Tumormarkern orientierte, personalisierte Therapie bei Brustkrebs im frühen Stadium, bei der die Risikoeinschätzung und die Vorhersage des Therapieansprechens optimiert wird\"}','followup',NULL,999,NULL,1,'2025-03-10 22:57:40','2025-03-10 22:57:40');
/*!40000 ALTER TABLE `studies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `study_centre`
--

DROP TABLE IF EXISTS `study_centre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `study_centre` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `study_id` bigint unsigned NOT NULL,
  `centre_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `study_centre`
--

LOCK TABLES `study_centre` WRITE;
/*!40000 ALTER TABLE `study_centre` DISABLE KEYS */;
INSERT INTO `study_centre` VALUES (1,2,10,NULL,NULL),(2,1,10,NULL,NULL),(3,2,13,NULL,NULL);
/*!40000 ALTER TABLE `study_centre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` json NOT NULL,
  `description` json DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_id` bigint unsigned NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `sort` bigint unsigned NOT NULL DEFAULT '999',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Prof. Dr. med. Ulrike Nitz','prof-dr-med-ulrike-nitz','{\"de\":\"Director Organisation\"}','{\"de\": \"Gründerin der WSG und bis Januar 2023 Leiterin des Brustzentrums Niederrhein in Mönchengladbach\"}','{\"de\": \"<p>Frau Professorin Dr. med. Ulrike Anneliese Nitz ist Chefärztin des Brustzentrums<br>Niederrhein am EVK Bethesda Mönchengladbach. Nach dem Medizinstudium an<br>der Freien Universität Brüssel, Belgien und der GHS Essen absolvierte sie ihre<br>Ausbildung zur Frauenärztin am St.-Josef-Spital Hagen, an der Frauenklinik der<br>Heinrich-Heine-Universität in Düsseldorf, am Brustzentrum der städtischen<br>Kliniken Düsseldorf und am Brustzentrum Luisenkrankenhaus Düsseldorf. Von<br>2005- 2007 hat sie das Brustzentrum der Universitätsfrauenklinik Düsseldorf<br>geleitet und dort 1996 die Westdeutsche Studiengruppe WSG gegründet und<br>aufgebaut. Seit 2000 ist sie APL Professorin für Frauenheilkunde an der HeinrichHeine –Universität Düsseldorf. Sie ist Gründungsmitglied der AGO Ovar<br>Studiengruppe und der AGO Kommission Mamma.<br>Frau Professorin Nitz ist seit 1995 Leiterin verschiedener klinischer Studien zum<br>Mammakarzinom: AM 01, AM 02, EC-DOC, Ara Plus, ICE, Mindact, planB, ADAPT,<br>Neo-Predict-HER2. Als Autorin zeichnet sie verantwortlich für über 50<br>Publikationen in Fachzeitschriften (peer-reviewed) und Büchern sowie mehr als<br>60 internationale Kongressbeiträge.</p>\"}',NULL,NULL,1,1,999,1,'2025-03-10 23:10:34','2025-03-10 23:22:56'),(2,'Prof. Dr. med. Nadia Harbeck','prof-dr-med-nadia-harbeck','{\"de\":\"Director Publication\"}','{\"de\": \"Leiterin des Brustzentrums des LMU Klinikums in München\"}','{\"de\": \"<p>Frau Professorin Dr. med. Nadia Harbeck leitet das Brustzentrum und die onkologische<br>Tagesklinik der Frauenklinik der Ludwig-Maximilians-Universität München (LMU). Sie ist<br>Professorin für Konservative Onkologie an der LMU München. Ihre Facharztausbildung<br>absolvierte sie an der Frauenklinik der Technischen Universität München, ihr<br>Medizinstudium an der LMU München. Vor ihrer Berufung an die LMU München leitete sie<br>von 2009–2011 das Brustzentrum an der Universität zu Köln.</p><p><br>Frau Professorin Harbeck ist Mitglied der AGO Kommission Mamma, die jährlich die<br>evidenzbasierten AGO Empfehlungen zur Diagnostik und Therapie des Mammakarzinoms<br>herausgibt (www.ago-online.de). Sie ist Co-Director der Westdeutschen Studiengruppe WSG<br>(www.wsg-online.com). Von 2009-2015 war sie Mitglied des Executive Boards der EORTC<br>und Chair der EORTC Translational Research Division. Professorin Harbeck ist Studienleiterin<br>und Mitglied von Steering Committees vieler nationaler und internationaler<br>Mammakarzinom-Studien mit einem Schwerpunkt auf neuen zielgerichteten Substanzen.<br>Ihre translationale Forschung hat den Schwerpunkt prognostische und prädiktive Faktoren<br>beim Mammakarzinom und anderen soliden Tumoren. Sie hat ein starkes Interesse an<br>eHealth und hat CANKADO, ein internationales digitales Patiententagebuch, mitentwickelt<br>(www.cankado.com).</p><p><br>Frau Professorin Harbeck ist Autorin von mehr als 480 Publikationen in peer-reviewed<br>Journals (h-index 82) und coordinating editor-in-chief der Fachzeitschrift Breast Care (Karger<br>Verlag). Sie ist Mitglied zahlreicher internationaler Konsensuskonferenzen zum<br>Mammakarzinom wie ABC (advanced breast cancer), BCY (breast cancer in young women)<br>und der St. Gallen Konsensuskonferenz zum frühen Mammakarzinom.</p><p><br>Für ihre klinisch-translationale Forschung wurde Frau Prof. Harbeck mit zahlreichen Preisen<br>ausgezeichnet; unter anderem erhielt sie 2001 den ASCO Fellowship Merit Award für das<br>beste eingereichte Abstract und einen AACR-Preis, 2002 den Schmidt-Matthiesen-Preis der<br>AGO, 2012 den Claudia von Schilling Preis, 2015 den Bayerischen Krebspatientenpreis. 2008<br>hielt sie die Eröffnungsrede der 6. Europäischen Brustkrebs Konferenz (Emmanuel van der<br>Schueren Lecture), 2020 wurde sie mit dem ESMO Lifetime Achievement Award geehrt.</p>\"}',NULL,NULL,1,1,999,1,'2025-03-10 23:12:29','2025-03-10 23:22:58');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` bigint unsigned NOT NULL DEFAULT '999',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'{\"de\":\"Medical Directors\"}',999,1,'2025-03-10 23:03:29','2025-03-10 23:03:29');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'rainer','rbickel@bitdesign.de',NULL,'$2y$12$aJbBWP9hgC32Mjq9nfIH3e.tBexNdq9C9sgPbZ3mQGTK5dzHRiMAq',NULL,'2025-03-07 21:34:01','2025-03-07 21:34:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-11  0:03:45

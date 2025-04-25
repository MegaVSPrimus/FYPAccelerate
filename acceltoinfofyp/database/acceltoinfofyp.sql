-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: acceltoinfofyp
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
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
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Formula 1','formula-1','2025-03-01 12:03:16','2025-03-01 12:03:16'),(2,'Formula 2','formula-2','2025-03-01 12:03:32','2025-03-01 12:03:32'),(3,'Formula 3','formula_3','2025-03-04 10:23:08','2025-03-04 10:23:08'),(4,'F1 Academy','f1_academy','2025-03-04 10:23:08','2025-03-04 10:23:08'),(5,'News','news','2025-03-04 10:23:08','2025-03-04 10:23:08');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `forum_post_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,5,1,'Test Comment','2025-01-31 10:56:27','2025-01-31 10:56:27'),(2,5,4,'I agree. This has to happen.','2025-01-31 11:00:25','2025-01-31 11:00:25'),(3,5,1,'Test Comment 2','2025-02-06 08:23:57','2025-02-06 08:23:57'),(4,5,2,'hi','2025-04-17 08:26:56','2025-04-17 08:26:56');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver_stats`
--

DROP TABLE IF EXISTS `driver_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `driver_stats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` bigint(20) unsigned NOT NULL,
  `number_of_wins` int(11) NOT NULL DEFAULT 0,
  `points_scored` int(11) NOT NULL DEFAULT 0,
  `number_of_races` int(11) NOT NULL DEFAULT 0,
  `number_of_podiums` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driver_stats_driver_id_foreign` (`driver_id`),
  CONSTRAINT `driver_stats_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver_stats`
--

LOCK TABLES `driver_stats` WRITE;
/*!40000 ALTER TABLE `driver_stats` DISABLE KEYS */;
INSERT INTO `driver_stats` VALUES (2,30,21,499,194,112,'2025-03-13 20:55:02','2025-03-13 20:55:02'),(3,15,3,100,150,5,'2025-04-08 11:22:22','2025-04-22 18:56:09'),(4,16,0,0,5,0,'2025-04-08 11:22:22','2025-04-20 10:35:29'),(5,17,0,0,0,0,'2025-04-08 11:22:22','2025-04-08 11:22:22'),(7,19,0,0,0,0,'2025-04-08 11:22:22','2025-04-08 11:22:22'),(8,20,0,0,0,0,'2025-04-08 11:22:22','2025-04-08 11:22:22'),(9,21,0,0,0,0,'2025-04-08 11:22:22','2025-04-08 11:22:22'),(10,22,0,0,0,0,'2025-04-08 11:22:22','2025-04-08 11:22:22'),(11,23,0,0,0,0,'2025-04-08 11:22:22','2025-04-08 11:22:22'),(12,24,0,0,0,0,'2025-04-08 11:22:22','2025-04-08 11:22:22'),(13,25,0,0,0,0,'2025-04-08 11:22:22','2025-04-08 11:22:22'),(14,31,0,0,0,0,'2025-04-14 19:39:30','2025-04-14 19:39:30'),(15,32,0,0,0,0,'2025-04-14 19:39:30','2025-04-14 19:39:30'),(16,33,0,0,0,0,'2025-04-14 19:39:30','2025-04-14 19:39:30'),(17,34,0,0,0,0,'2025-04-14 19:39:30','2025-04-14 19:39:30'),(18,35,0,0,0,0,'2025-04-14 19:39:30','2025-04-14 19:39:30'),(19,36,0,0,0,0,'2025-04-14 19:39:30','2025-04-14 19:39:30'),(20,37,0,0,0,0,'2025-04-14 19:39:31','2025-04-14 19:39:31'),(21,38,0,0,0,0,'2025-04-15 11:25:15','2025-04-15 11:25:15');
/*!40000 ALTER TABLE `driver_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drivers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `team` varchar(255) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` VALUES (15,'2025-02-18 10:39:25','2025-04-17 10:30:24','George Russell','Mercedes AMG Petronas',NULL),(16,'2025-02-18 10:39:40','2025-04-20 10:29:40','Antonelli','Mercedes AMG Petronas',NULL),(17,'2025-02-18 10:39:52','2025-03-19 11:17:58','Lewis Hamilton','Scudaria Ferrari HP',NULL),(19,'2025-02-18 10:40:21','2025-02-18 10:40:21','Lando Norris','McLaren',NULL),(20,'2025-02-18 10:40:39','2025-02-18 10:40:39','Fernando Alonso','Aston Martin',NULL),(21,'2025-02-18 10:40:50','2025-02-18 10:40:50','Lance Stroll','Aston Martin',NULL),(22,'2025-02-18 10:41:00','2025-02-18 10:41:00','Pierre Gasly','Alpine',NULL),(23,'2025-02-18 10:41:09','2025-02-18 10:41:09','Jack Doohan','Alpine',NULL),(24,'2025-02-18 10:41:20','2025-02-18 10:41:20','Esteban Ocon','Haas',NULL),(25,'2025-02-18 10:41:29','2025-02-18 10:41:29','Oliver Bearman','Haas',NULL),(30,'2025-03-13 20:55:02','2025-03-13 20:55:02','Max Verstappen','Red Bull Racing',NULL),(31,'2025-04-14 19:38:05','2025-04-14 19:38:05','Yuki Tsunoda','Red Bull Racing',NULL),(32,'2025-04-14 19:38:21','2025-04-14 19:38:21','Gabriel Bortoleto','Stake F1 Team Kick Sauber',NULL),(33,'2025-04-14 19:38:34','2025-04-14 19:38:34','Nico Hulkenberg','Stake F1 Team Kick Sauber',NULL),(34,'2025-04-14 19:38:45','2025-04-14 19:38:45','Carlos Sainz','Atlassian Williams Racing',NULL),(35,'2025-04-14 19:38:57','2025-04-14 19:38:57','Alex Albon','Atlassian Williams Racing',NULL),(36,'2025-04-14 19:39:14','2025-04-14 19:39:14','Isack Hadjar','Visa Cash App Racing Bulls',NULL),(37,'2025-04-14 19:39:27','2025-04-14 19:39:27','Liam Lawson','Visa Cash App Racing Bulls',NULL),(38,'2025-04-14 19:40:20','2025-04-14 19:40:20','Oscar Piastri','McLaren',NULL);
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `fantasy_points`
--

DROP TABLE IF EXISTS `fantasy_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fantasy_points` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fantasy_team_id` bigint(20) unsigned NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fantasy_points_fantasy_team_id_foreign` (`fantasy_team_id`),
  CONSTRAINT `fantasy_points_fantasy_team_id_foreign` FOREIGN KEY (`fantasy_team_id`) REFERENCES `fantasy_teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fantasy_points`
--

LOCK TABLES `fantasy_points` WRITE;
/*!40000 ALTER TABLE `fantasy_points` DISABLE KEYS */;
/*!40000 ALTER TABLE `fantasy_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fantasy_team_drivers`
--

DROP TABLE IF EXISTS `fantasy_team_drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fantasy_team_drivers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fantasy_team_id` bigint(20) unsigned NOT NULL,
  `driver_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fantasy_team_drivers_fantasy_team_id_foreign` (`fantasy_team_id`),
  KEY `fantasy_team_drivers_driver_id_foreign` (`driver_id`),
  CONSTRAINT `fantasy_team_drivers_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fantasy_team_drivers_fantasy_team_id_foreign` FOREIGN KEY (`fantasy_team_id`) REFERENCES `fantasy_teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fantasy_team_drivers`
--

LOCK TABLES `fantasy_team_drivers` WRITE;
/*!40000 ALTER TABLE `fantasy_team_drivers` DISABLE KEYS */;
INSERT INTO `fantasy_team_drivers` VALUES (13,1,15,NULL,NULL),(14,1,16,NULL,NULL);
/*!40000 ALTER TABLE `fantasy_team_drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fantasy_team_teams`
--

DROP TABLE IF EXISTS `fantasy_team_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fantasy_team_teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fantasy_team_id` bigint(20) unsigned NOT NULL,
  `team_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fantasy_team_teams_fantasy_team_id_foreign` (`fantasy_team_id`),
  KEY `fantasy_team_teams_team_id_foreign` (`team_id`),
  CONSTRAINT `fantasy_team_teams_fantasy_team_id_foreign` FOREIGN KEY (`fantasy_team_id`) REFERENCES `fantasy_teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fantasy_team_teams_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fantasy_team_teams`
--

LOCK TABLES `fantasy_team_teams` WRITE;
/*!40000 ALTER TABLE `fantasy_team_teams` DISABLE KEYS */;
INSERT INTO `fantasy_team_teams` VALUES (16,1,3,NULL,NULL),(17,1,4,NULL,NULL);
/*!40000 ALTER TABLE `fantasy_team_teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fantasy_teams`
--

DROP TABLE IF EXISTS `fantasy_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fantasy_teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fantasy_teams_user_id_foreign` (`user_id`),
  CONSTRAINT `fantasy_teams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fantasy_teams`
--

LOCK TABLES `fantasy_teams` WRITE;
/*!40000 ALTER TABLE `fantasy_teams` DISABLE KEYS */;
INSERT INTO `fantasy_teams` VALUES (1,'My Fantasy Team',5,'2025-04-14 08:09:12','2025-04-14 08:09:12'),(2,'My Fantasy Team',7,'2025-04-18 09:04:34','2025-04-18 09:04:34');
/*!40000 ALTER TABLE `fantasy_teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_category_id_foreign` (`category_id`),
  CONSTRAINT `forum_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum`
--

LOCK TABLES `forum` WRITE;
/*!40000 ALTER TABLE `forum` DISABLE KEYS */;
INSERT INTO `forum` VALUES (4,NULL,'2025-01-19 15:43:59','2025-01-19 15:43:59','F2 Predictions','Champion: Dunne',NULL),(5,NULL,'2025-01-22 11:51:59','2025-01-22 11:51:59','Leclerc and Hamilton','HAMILTON IN A FERRARI',NULL),(6,NULL,'2025-01-22 12:35:35','2025-01-22 12:35:35','Formula 3 Predictions','Champion: Noel Leon',NULL),(7,5,'2025-03-04 10:36:21','2025-03-26 11:31:24','BREAKING: Lawson','2','forum_images/gszk1gEqfnk1QCd89BGngClsOpIA892oVSyCIhRa.jpg'),(8,5,'2025-03-04 12:21:28','2025-03-04 12:21:28','2','3',NULL),(9,5,'2025-03-05 21:10:18','2025-03-05 21:10:18','BREAKING: MANSELL IS OUT','MANSELL IS OUT',NULL),(10,5,'2025-03-05 21:22:50','2025-03-05 21:22:50','t','2',NULL),(11,1,'2025-03-19 11:49:49','2025-03-19 11:49:49','V10 engines to return?','Formula One is considering a return to V10s',NULL),(12,5,'2025-03-20 19:01:32','2025-03-20 19:01:32','test123','123',NULL),(13,5,'2025-03-20 19:04:45','2025-03-20 19:04:45','test123','1223344',NULL),(14,5,'2025-03-20 19:51:39','2025-03-20 19:51:39','w','e',NULL),(15,1,'2025-04-07 19:52:31','2025-04-07 19:52:31','Verstappen Dominates in Japan!','Inside result from the dutchman!',NULL),(16,1,'2025-04-08 05:29:35','2025-04-08 05:29:35','1','2',NULL),(17,1,'2025-04-08 05:36:02','2025-04-08 05:36:02','test','1',NULL);
/*!40000 ALTER TABLE `forum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pathNew` varchar(255) DEFAULT NULL,
  `forumid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (9,'Max Verstappen',NULL,'2025-02-26 12:30:24','2025-02-26 12:30:24','images/1740573024.jpg',NULL),(11,'logo',NULL,'2025-03-01 15:42:59','2025-03-01 15:42:59','images/1740843778.png',NULL),(15,'Lewis Hamilton',NULL,'2025-03-19 11:13:14','2025-03-19 11:13:14','images/1742382793.jpg',NULL),(16,'Red Bull',NULL,'2025-03-19 17:56:20','2025-03-19 17:56:20','images/1742406980.png',NULL),(17,'kieran',NULL,'2025-03-19 21:59:52','2025-03-19 21:59:52','images/1742421592.png',NULL),(20,'Andrea Kimi Antonelli',NULL,'2025-04-08 05:13:09','2025-04-08 05:13:09','images/1744092789.jpg',NULL),(21,'George Russell',NULL,'2025-04-08 05:16:13','2025-04-08 05:16:13','images/1744092973.jpg',NULL),(24,'Mega',NULL,'2025-04-20 11:31:59','2025-04-20 11:31:59','images/1745152319.jpg',NULL);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_01_17_110652_create_forum_table',2),(5,'2025_01_06_201258_create_drivers_table',3),(7,'2025_01_30_135654_add_is_admin_to_users_table',4),(8,'2025_01_31_064455_create_teams_table',5),(10,'2025_01_31_074843_add_timestamps_to_teams_table',6),(11,'2025_01_31_104013_create_comments_table',7),(12,'2025_02_21_060627_create_images_table',7),(13,'2025_02_21_063457_modify_images_table',8),(14,'2025_02_25_122559_create_fantasy_teams_table',9),(15,'2025_02_25_122727_create_fantasy_team_drivers_table',9),(16,'2025_02_25_122748_create_fantasy_points_table',9),(17,'2025_03_01_093719_create_categories_table',10),(18,'2025_03_01_093903_add_category_id_to_posts_table',11),(21,'2025_03_04_122554_add_image_to_forum_posts_table',12),(22,'2025_03_13_203336_create_driver_stats_table',12),(23,'2025_03_26_113004_add_image_to_forum_table',13),(24,'2025_04_14_101115_create_fantasy_team_teams_table',14),(25,'2025_04_14_200921_create_points_table',15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `points` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pointable_type` varchar(255) NOT NULL,
  `pointable_id` bigint(20) unsigned NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `points_pointable_type_pointable_id_index` (`pointable_type`,`pointable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `points`
--

LOCK TABLES `points` WRITE;
/*!40000 ALTER TABLE `points` DISABLE KEYS */;
INSERT INTO `points` VALUES (1,'App\\Models\\Driver',15,10,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(2,'App\\Models\\Driver',16,5,'2025-04-14 19:16:56','2025-04-14 19:34:48'),(3,'App\\Models\\Driver',17,2,'2025-04-14 19:16:56','2025-04-14 19:34:48'),(4,'App\\Models\\Driver',18,0,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(5,'App\\Models\\Driver',19,0,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(6,'App\\Models\\Driver',20,0,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(7,'App\\Models\\Driver',21,0,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(8,'App\\Models\\Driver',22,0,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(9,'App\\Models\\Driver',23,0,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(10,'App\\Models\\Driver',24,0,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(11,'App\\Models\\Driver',25,0,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(12,'App\\Models\\Driver',30,0,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(13,'App\\Models\\Team',3,0,'2025-04-14 19:16:56','2025-04-14 19:16:56'),(14,'App\\Models\\Team',4,10,'2025-04-14 19:16:56','2025-04-14 19:28:33');
/*!40000 ALTER TABLE `points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
INSERT INTO `sessions` VALUES ('8Hj760lPoTtLXSU4pBt9dQ9N0hlcKy33ojLr2UTj',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3ZraG5JVWFOQXQ4bVNNclZnVDFaalJqd3M1NllxY2NlYTVrOUtLSSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745508996),('jDluC9DiNFsT7lfN7icJfMGiH8NSTV22M8KIzNIl',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNXZFT1FkZkRPOXBicERTd25BcUlmWmdLUENJSmQ4eXkwVE94OXQ0RCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745491828),('ntJ6Ksh4zjQAoSP9xywlOfELGDS8YsTe3SYJpggA',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidXJUZGk2cTNsSUVBb1FYRDlwYVpzTmhVZzN2bUVnVFZROE1wQ2hIZCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo3NzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3RlYW1zLzQ/X3Rva2VuPXVyVGRpNnEzbElFQW9RWEQ5cGFac05oVWczdm1FZ1RWUThNcENoSGQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1745353726),('OpMI48VCvZhKIBpKZOg3wwXEOO0fMo6obRz3RbWa',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVlBoSVlMQnc1UTh4NlBDZnk3S1Y5bHJKU0RCTkZ6cnZwR1V6MkRGSyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2dhbGxlcnkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1745397756),('qap7VCDYd39bnBVFQjyKt9F7300SXSBMM8oV5BoY',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRjRHb3lYS1MwaFk0WVpBTEdPazdoT05laHU1UnN5eENLektMeUpDNiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3BvaW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1745407653);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `team_principal` varchar(255) NOT NULL,
  `engine_supplier` varchar(255) NOT NULL,
  `constructors_championships` varchar(255) NOT NULL,
  `driver1` bigint(20) unsigned DEFAULT NULL,
  `driver2` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_driver1_foreign` (`driver1`),
  KEY `teams_driver2_foreign` (`driver2`),
  CONSTRAINT `teams_driver1_foreign` FOREIGN KEY (`driver1`) REFERENCES `drivers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `teams_driver2_foreign` FOREIGN KEY (`driver2`) REFERENCES `drivers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (3,'Red Bull','Christian Horner','Honda','7',NULL,NULL,NULL,'2025-03-19 11:37:26'),(4,'Mercedes AMG Petronas','Toto Wolff','Mercedes','8',NULL,NULL,'2025-03-02 13:38:32','2025-04-20 10:42:22'),(7,'Scudaria Ferrari HP','Vasseur','Ferrari','13',NULL,NULL,'2025-04-20 10:46:26','2025-04-20 10:46:26'),(9,'McLaren','Andrea Stella','Mercedes','4',NULL,NULL,'2025-04-20 10:47:10','2025-04-20 10:47:10'),(10,'Aston Martin','Mike Krack','Mercedes','6',NULL,NULL,'2025-04-20 10:47:36','2025-04-20 10:47:36'),(11,'Alpine','Ollie Oakes','Alpine','2',NULL,NULL,'2025-04-20 10:47:53','2025-04-20 10:47:53');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Kieran','kieran@test.com',1,NULL,'$2y$12$qxY16pxFLsPjZkEfZ5L4u.iefA9ARpBvpSPoPjl8U01B1FQHu3RRu',NULL,'2025-01-18 12:29:54','2025-02-06 08:24:14'),(2,'Kieran','test@test.com',0,NULL,'$2y$12$nlgD0nwtzkpBAyh1PEaR1.lAb.MQI3l4A3l3Nir3QEZqbcW9hZFmm',NULL,'2025-01-19 16:31:29','2025-04-22 18:59:21'),(3,'Kieran','kieranmd007@gmail.com',1,NULL,'$2y$12$XKEUiDHdaeGPqyJ2sJD4M.Il6CzpoCCM2wqXimg9JFKrQoGCDrypO',NULL,'2025-01-22 10:21:40','2025-01-31 11:00:34'),(4,'kieran','kmd@gmail.com',0,NULL,'$2y$12$j3XWYrqoYo.IfYphij4lZORfITXjnjC.9QSr7TRNt28x2qlT6adfG',NULL,'2025-01-27 13:29:26','2025-01-27 13:29:26'),(5,'Mega','admin@kieran.ie',1,NULL,'$2y$12$RM.EwDZiM1o7FnONfVYbkO3sRYctftOiWcRHZRRCQA1zUvEn0.gs2','RCSk8mJKYlVEnqNJ7BdDO3WascDFLR6gK4UGufIxYPCrUo6XW8L018rsqrPf','2025-01-28 11:59:11','2025-04-20 11:32:01'),(6,'Gary','gbarlow@gmail.com',0,NULL,'$2y$12$0qveo2k.NdOl.QvA/COq9u3v4sz457x5NYsYMFS6SyXdvHQsZlpjq',NULL,'2025-04-15 11:28:51','2025-04-15 11:28:51'),(7,'Kieran','kieranmd009@gmail.com',0,NULL,'$2y$12$uFPHG9eyhzE8DITxPuEkH.DhCNjpmlvfi3U2nyByT5nzM1k95svcG',NULL,'2025-04-18 09:03:55','2025-04-18 09:03:55');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-25  9:51:45

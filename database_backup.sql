-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: site_dp_back
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.24.04.1

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
-- Table structure for table `321312_links`
--

DROP TABLE IF EXISTS `321312_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `321312_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `321312_links`
--

LOCK TABLES `321312_links` WRITE;
/*!40000 ALTER TABLE `321312_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `321312_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `321312_requirements`
--

DROP TABLE IF EXISTS `321312_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `321312_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `321312_requirements`
--

LOCK TABLES `321312_requirements` WRITE;
/*!40000 ALTER TABLE `321312_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `321312_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `321312_timelines`
--

DROP TABLE IF EXISTS `321312_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `321312_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `321312_timelines`
--

LOCK TABLES `321312_timelines` WRITE;
/*!40000 ALTER TABLE `321312_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `321312_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `321312_topics`
--

DROP TABLE IF EXISTS `321312_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `321312_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `321312_topics`
--

LOCK TABLES `321312_topics` WRITE;
/*!40000 ALTER TABLE `321312_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `321312_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `321321_links`
--

DROP TABLE IF EXISTS `321321_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `321321_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `321321_links`
--

LOCK TABLES `321321_links` WRITE;
/*!40000 ALTER TABLE `321321_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `321321_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `321321_requirements`
--

DROP TABLE IF EXISTS `321321_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `321321_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `321321_requirements`
--

LOCK TABLES `321321_requirements` WRITE;
/*!40000 ALTER TABLE `321321_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `321321_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `321321_timelines`
--

DROP TABLE IF EXISTS `321321_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `321321_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `321321_timelines`
--

LOCK TABLES `321321_timelines` WRITE;
/*!40000 ALTER TABLE `321321_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `321321_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `321321_topics`
--

DROP TABLE IF EXISTS `321321_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `321321_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `321321_topics`
--

LOCK TABLES `321321_topics` WRITE;
/*!40000 ALTER TABLE `321321_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `321321_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumni` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni`
--

LOCK TABLES `alumni` WRITE;
/*!40000 ALTER TABLE `alumni` DISABLE KEYS */;
INSERT INTO `alumni` VALUES (1,'Super Admin',2021,'Студент','alumni/01JXT3P6MPQGDQVVP8F1W2HR7F.gif','2025-06-15 15:35:19','2025-06-15 15:35:19'),(2,'222',2021,'222','alumni/01JXT3S4JTQ7PPM8GWK72CSHGA.gif','2025-06-15 15:36:56','2025-06-15 15:36:56');
/*!40000 ALTER TABLE `alumni` ENABLE KEYS */;
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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `news_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_news_id_foreign` (`news_id`),
  KEY `comments_parent_id_foreign` (`parent_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,NULL,NULL,'тест','тест',0,'2025-06-15 17:56:36','2025-06-15 17:56:36'),(2,1,NULL,1,'21321','3213213',0,'2025-06-15 18:01:23','2025-06-15 18:01:23'),(3,1,NULL,NULL,'тмист','тмстмс',0,'2025-06-15 18:24:39','2025-06-15 18:24:39'),(4,1,NULL,1,'віфвіф','віфвіфвіф',0,'2025-06-15 18:25:35','2025-06-15 18:25:35'),(7,1,6,NULL,NULL,'Це тестовий коментар від авторизованого користувача. Дуже цікава новина про заміну масла!',0,'2025-06-18 02:12:13','2025-06-18 02:12:13'),(8,1,6,NULL,NULL,'Ще один коментар для перевірки відображення. Чудово, що студенти беруть участь у практичних роботах.',0,'2025-06-18 02:12:13','2025-06-18 02:12:13'),(9,1,6,NULL,NULL,'Це новий коментар від авторизованого користувача. Дуже корисна інформація про технічне обслуговування!',0,'2025-06-18 02:13:25','2025-06-18 02:13:25'),(10,1,6,1,NULL,'Повністю погоджуюся з вашим коментарем! Практичний досвід дуже важливий.',0,'2025-06-18 02:13:25','2025-06-18 02:13:25'),(13,3,5,NULL,NULL,'Текстіфв',0,'2025-06-18 02:25:22','2025-06-18 02:25:22'),(14,3,5,13,NULL,'віфвфі',0,'2025-06-18 02:26:28','2025-06-18 02:26:28'),(15,1,6,NULL,NULL,'🔧 Дуже корисна інформація про заміну масла! Як студент автомобільного відділення, можу сказати, що такі практичні заняття дуже важливі для нашого навчання. 👨‍🎓',0,'2025-06-18 02:32:44','2025-06-18 02:32:44'),(16,1,6,NULL,NULL,'💡 Чи можна було б додати відео процесу? Було б цікаво побачити весь процес заміни масла крок за кроком.',0,'2025-06-18 02:32:44','2025-06-18 02:32:44'),(17,3,5,13,NULL,'dsadsadas',0,'2025-06-18 02:35:53','2025-06-18 02:35:53'),(18,3,5,13,NULL,'dsadsa',0,'2025-06-18 02:36:21','2025-06-18 02:36:21'),(19,1,6,NULL,NULL,'Дуже цікава стаття про заміну масла! У нас в коледжі теж проводять такі практичні заняття.',0,'2025-06-18 02:40:12','2025-06-18 02:40:12'),(20,1,6,19,NULL,'Так, практичні заняття дуже важливі для майбутніх механіків.',0,'2025-06-18 02:40:12','2025-06-18 02:40:12'),(21,1,6,20,NULL,'Повністю згоден! Без практики теорія мало що дає.',0,'2025-06-18 02:40:12','2025-06-18 02:40:12'),(22,1,6,19,NULL,'А які ще практичні роботи проводяться в коледжі?',0,'2025-06-18 02:40:12','2025-06-18 02:40:12'),(23,1,6,22,NULL,'Це відповідь третього рівня! Дискусія стає дуже цікавою.',0,'2025-06-18 02:42:02','2025-06-18 02:42:02'),(24,3,5,14,NULL,'Привіт',0,'2025-06-18 02:45:43','2025-06-18 02:45:43'),(25,3,5,NULL,NULL,'Тест',0,'2025-06-18 02:45:51','2025-06-18 02:45:51'),(26,3,5,NULL,NULL,'2222',0,'2025-06-18 02:46:09','2025-06-18 02:46:09'),(27,3,1,24,NULL,'dsadsadsa',0,'2025-06-18 13:17:39','2025-06-18 13:17:39');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_info`
--

DROP TABLE IF EXISTS `contact_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_info` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_info`
--

LOCK TABLES `contact_info` WRITE;
/*!40000 ALTER TABLE `contact_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_infos`
--

DROP TABLE IF EXISTS `contact_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_infos`
--

LOCK TABLES `contact_infos` WRITE;
/*!40000 ALTER TABLE `contact_infos` DISABLE KEYS */;
INSERT INTO `contact_infos` VALUES (1,'test','1-(555)-555-5555','admin@admin.com','віфвіфжлдвроафщзідшращіф','2025-06-15 19:23:41','2025-06-15 19:23:41');
/*!40000 ALTER TABLE `contact_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_settings`
--

DROP TABLE IF EXISTS `contact_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contact_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_settings`
--

LOCK TABLES `contact_settings` WRITE;
/*!40000 ALTER TABLE `contact_settings` DISABLE KEYS */;
INSERT INTO `contact_settings` VALUES (1,'organization_name','Циклова комісія програмування та інформаційних технологій','text','contact','Назва організації','Повна назва організації',1,'2025-06-17 16:21:22','2025-06-17 16:21:22'),(2,'phone','+38 (0312) 61-33-45','tel','contact','Телефон','Основний телефон для зв\'язку',2,'2025-06-17 16:21:22','2025-06-17 20:31:46'),(3,'email','collegepit@uzhnu.ua','email','contact','Email','Основний email для зв\'язку',3,'2025-06-17 16:21:22','2025-06-17 20:31:46'),(4,'address_street','вул. Українська, 19','text','address','Вулиця та номер будинку','Адреса розташування',4,'2025-06-17 16:21:22','2025-06-17 20:31:46'),(5,'address_city','м. Ужгород','text','address','Місто','Місто розташування',5,'2025-06-17 16:21:22','2025-06-17 16:21:22'),(6,'address_region','Закарпатська область','text','address','Область','Область розташування',6,'2025-06-17 16:21:22','2025-06-17 16:21:22'),(7,'address_postal_code','88000','text','address','Поштовий індекс','Поштовий індекс',7,'2025-06-17 16:21:22','2025-06-17 16:21:22'),(8,'map_latitude','48.6134116','coordinates','map','Широта','Координати широти для Google Maps',8,'2025-06-17 16:21:22','2025-06-17 20:31:46'),(9,'map_longitude','22.3066565','coordinates','map','Довгота','Координати довготи для Google Maps',9,'2025-06-17 16:21:22','2025-06-17 20:31:46'),(10,'map_zoom','15','number','map','Масштаб карти','Рівень масштабування карти (1-20)',10,'2025-06-17 16:21:22','2025-06-17 16:21:22'),(11,'google_maps_api_key','YOUR_API_KEY','text','map','Google Maps API ключ','API ключ для Google Maps',11,'2025-06-17 16:21:22','2025-06-17 16:21:22');
/*!40000 ALTER TABLE `contact_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_values`
--

DROP TABLE IF EXISTS `core_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_values`
--

LOCK TABLES `core_values` WRITE;
/*!40000 ALTER TABLE `core_values` DISABLE KEYS */;
INSERT INTO `core_values` VALUES (1,'Test','test','core_values/01JXT8TAHY00XD8AQ3N6VJQFAE.jpg','2025-06-15 17:04:57','2025-06-15 17:04:57');
/*!40000 ALTER TABLE `core_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_requirements`
--

DROP TABLE IF EXISTS `course_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_requirements_topic_id_foreign` (`topic_id`),
  CONSTRAINT `course_requirements_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `course_topics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_requirements`
--

LOCK TABLES `course_requirements` WRITE;
/*!40000 ALTER TABLE `course_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_topics`
--

DROP TABLE IF EXISTS `course_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_topics`
--

LOCK TABLES `course_topics` WRITE;
/*!40000 ALTER TABLE `course_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursework_applications`
--

DROP TABLE IF EXISTS `coursework_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coursework_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposed_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursework_applications`
--

LOCK TABLES `coursework_applications` WRITE;
/*!40000 ALTER TABLE `coursework_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `coursework_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursework_approveds`
--

DROP TABLE IF EXISTS `coursework_approveds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coursework_approveds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('approved','in_progress','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `approved_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursework_approveds`
--

LOCK TABLES `coursework_approveds` WRITE;
/*!40000 ALTER TABLE `coursework_approveds` DISABLE KEYS */;
INSERT INTO `coursework_approveds` VALUES (1,1,'Коваленко Олексій','kovalenko@example.com','Іванов І.І.','approved','2025-06-16','2025-06-16 12:22:49','2025-06-16 12:22:49'),(2,2,'Шевченко Марія','shevchenko@example.com','Петров П.П.','in_progress','2025-05-17','2025-06-16 12:22:49','2025-06-16 12:22:49');
/*!40000 ALTER TABLE `coursework_approveds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursework_consultations`
--

DROP TABLE IF EXISTS `coursework_consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coursework_consultations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursework_consultations`
--

LOCK TABLES `coursework_consultations` WRITE;
/*!40000 ALTER TABLE `coursework_consultations` DISABLE KEYS */;
INSERT INTO `coursework_consultations` VALUES (1,'Іванов І.І.','2025-06-23','10:00:00','Аудиторія 201','Консультація з веб-розробки','2025-06-16 12:22:49','2025-06-16 12:22:49'),(2,'Петров П.П.','2025-06-30','14:00:00','Аудиторія 305','Обговорення бізнес-процесів','2025-06-16 12:22:49','2025-06-16 12:22:49');
/*!40000 ALTER TABLE `coursework_consultations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursework_links`
--

DROP TABLE IF EXISTS `coursework_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coursework_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('resource','documentation','example','tool') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'resource',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursework_links`
--

LOCK TABLES `coursework_links` WRITE;
/*!40000 ALTER TABLE `coursework_links` DISABLE KEYS */;
INSERT INTO `coursework_links` VALUES (1,1,'https://laravel.com/docs','Документація Laravel','documentation','2025-06-16 12:22:49','2025-06-16 12:22:49'),(2,1,'https://reactjs.org/','React.js офіційний сайт','documentation','2025-06-16 12:22:49','2025-06-16 12:22:49'),(3,NULL,'https://github.com/','GitHub - система контролю версій','tool','2025-06-16 12:22:49','2025-06-16 12:22:49');
/*!40000 ALTER TABLE `coursework_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursework_requirements`
--

DROP TABLE IF EXISTS `coursework_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coursework_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursework_requirements`
--

LOCK TABLES `coursework_requirements` WRITE;
/*!40000 ALTER TABLE `coursework_requirements` DISABLE KEYS */;
INSERT INTO `coursework_requirements` VALUES (1,1,'Знання основ веб-розробки (HTML, CSS, JavaScript)','high','2025-06-16 12:22:49','2025-06-16 12:22:49'),(2,1,'Досвід роботи з фреймворками (Laravel, React)','medium','2025-06-16 12:22:49','2025-06-16 12:22:49'),(3,2,'Розуміння бізнес-процесів','high','2025-06-16 12:22:49','2025-06-16 12:22:49');
/*!40000 ALTER TABLE `coursework_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursework_timelines`
--

DROP TABLE IF EXISTS `coursework_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coursework_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursework_timelines`
--

LOCK TABLES `coursework_timelines` WRITE;
/*!40000 ALTER TABLE `coursework_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `coursework_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursework_topics`
--

DROP TABLE IF EXISTS `coursework_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coursework_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hours` int DEFAULT NULL,
  `type` enum('lecture','practical','lab','project') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'practical',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursework_topics`
--

LOCK TABLES `coursework_topics` WRITE;
/*!40000 ALTER TABLE `coursework_topics` DISABLE KEYS */;
INSERT INTO `coursework_topics` VALUES (1,'Розробка веб-додатку для управління проектами','Створення повнофункціонального веб-додатку з використанням сучасних технологій','Іванов І.І.',120,'project','2025-06-16 12:22:49','2025-06-16 12:22:49'),(2,'Система автоматизації бізнес-процесів','Аналіз та автоматизація основних бізнес-процесів підприємства','Петров П.П.',100,'practical','2025-06-16 12:22:49','2025-06-16 12:22:49'),(3,'Мобільний додаток для електронної комерції','Розробка мобільного додатку для онлайн-торгівлі','Сидоров С.С.',150,'project','2025-06-16 12:22:49','2025-06-16 12:22:49');
/*!40000 ALTER TABLE `coursework_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diploma_applications`
--

DROP TABLE IF EXISTS `diploma_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diploma_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposed_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diploma_applications`
--

LOCK TABLES `diploma_applications` WRITE;
/*!40000 ALTER TABLE `diploma_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `diploma_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diploma_approveds`
--

DROP TABLE IF EXISTS `diploma_approveds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diploma_approveds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('approved','in_progress','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `approved_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diploma_approveds`
--

LOCK TABLES `diploma_approveds` WRITE;
/*!40000 ALTER TABLE `diploma_approveds` DISABLE KEYS */;
/*!40000 ALTER TABLE `diploma_approveds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diploma_consultations`
--

DROP TABLE IF EXISTS `diploma_consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diploma_consultations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diploma_consultations`
--

LOCK TABLES `diploma_consultations` WRITE;
/*!40000 ALTER TABLE `diploma_consultations` DISABLE KEYS */;
/*!40000 ALTER TABLE `diploma_consultations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diploma_timelines`
--

DROP TABLE IF EXISTS `diploma_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diploma_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diploma_timelines`
--

LOCK TABLES `diploma_timelines` WRITE;
/*!40000 ALTER TABLE `diploma_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `diploma_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsadsa_links`
--

DROP TABLE IF EXISTS `dsadsa_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsadsa_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsadsa_links`
--

LOCK TABLES `dsadsa_links` WRITE;
/*!40000 ALTER TABLE `dsadsa_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsadsa_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsadsa_requirements`
--

DROP TABLE IF EXISTS `dsadsa_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsadsa_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsadsa_requirements`
--

LOCK TABLES `dsadsa_requirements` WRITE;
/*!40000 ALTER TABLE `dsadsa_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsadsa_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsadsa_timelines`
--

DROP TABLE IF EXISTS `dsadsa_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsadsa_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsadsa_timelines`
--

LOCK TABLES `dsadsa_timelines` WRITE;
/*!40000 ALTER TABLE `dsadsa_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsadsa_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsadsa_topics`
--

DROP TABLE IF EXISTS `dsadsa_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsadsa_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsadsa_topics`
--

LOCK TABLES `dsadsa_topics` WRITE;
/*!40000 ALTER TABLE `dsadsa_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsadsa_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsadsadsa_approveds`
--

DROP TABLE IF EXISTS `dsadsadsa_approveds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsadsadsa_approveds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsadsadsa_approveds`
--

LOCK TABLES `dsadsadsa_approveds` WRITE;
/*!40000 ALTER TABLE `dsadsadsa_approveds` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsadsadsa_approveds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsadsadsa_consultations`
--

DROP TABLE IF EXISTS `dsadsadsa_consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsadsadsa_consultations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsadsadsa_consultations`
--

LOCK TABLES `dsadsadsa_consultations` WRITE;
/*!40000 ALTER TABLE `dsadsadsa_consultations` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsadsadsa_consultations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsadsadsa_links`
--

DROP TABLE IF EXISTS `dsadsadsa_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsadsadsa_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsadsadsa_links`
--

LOCK TABLES `dsadsadsa_links` WRITE;
/*!40000 ALTER TABLE `dsadsadsa_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsadsadsa_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsadsadsa_requirements`
--

DROP TABLE IF EXISTS `dsadsadsa_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsadsadsa_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsadsadsa_requirements`
--

LOCK TABLES `dsadsadsa_requirements` WRITE;
/*!40000 ALTER TABLE `dsadsadsa_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsadsadsa_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsadsadsa_timelines`
--

DROP TABLE IF EXISTS `dsadsadsa_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsadsadsa_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsadsadsa_timelines`
--

LOCK TABLES `dsadsadsa_timelines` WRITE;
/*!40000 ALTER TABLE `dsadsadsa_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsadsadsa_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsadsadsa_topics`
--

DROP TABLE IF EXISTS `dsadsadsa_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsadsadsa_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsadsadsa_topics`
--

LOCK TABLES `dsadsadsa_topics` WRITE;
/*!40000 ALTER TABLE `dsadsadsa_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsadsadsa_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educational_categories`
--

DROP TABLE IF EXISTS `educational_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `educational_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#3498db',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `educational_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educational_categories`
--

LOCK TABLES `educational_categories` WRITE;
/*!40000 ALTER TABLE `educational_categories` DISABLE KEYS */;
INSERT INTO `educational_categories` VALUES (1,'Загальна підготовка','general','Дисципліни загальної підготовки','#3498db','📚',1,0,'2025-06-18 11:26:45','2025-06-18 11:26:45'),(2,'Професійна підготовка','professional','Професійні дисципліни','#e74c3c','🔧',1,0,'2025-06-18 11:26:46','2025-06-18 11:26:46'),(3,'Практична підготовка','practical','Практичні курси та лабораторії','#27ae60','⚙️',1,0,'2025-06-18 11:26:46','2025-06-18 11:26:46'),(4,'Спеціалізація','specialization','Спеціалізовані курси','#9b59b6','🎯',1,0,'2025-06-18 11:26:46','2025-06-18 11:26:46');
/*!40000 ALTER TABLE `educational_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educational_components`
--

DROP TABLE IF EXISTS `educational_components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `educational_components` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectives` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `learning_outcomes` json NOT NULL,
  `assessment_methods` json NOT NULL,
  `literature` json NOT NULL,
  `methodical_materials` json DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credits` int NOT NULL,
  `hours_total` int NOT NULL,
  `hours_lectures` int NOT NULL,
  `hours_practical` int NOT NULL,
  `hours_laboratory` int NOT NULL,
  `hours_independent` int NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `educational_components_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educational_components`
--

LOCK TABLES `educational_components` WRITE;
/*!40000 ALTER TABLE `educational_components` DISABLE KEYS */;
INSERT INTO `educational_components` VALUES (1,'Основи програмування','ІТ-101','Курс знайомить студентів з основними концепціями програмування, алгоритмічним мисленням та базовими структурами даних.','Метою курсу є формування у студентів базових навичок програмування, розуміння принципів алгоритмізації та вміння розв\'язувати прикладні задачі за допомогою програмних засобів.','<h3>Модуль 1: Вступ до програмування</h3><ul><li>Історія програмування</li><li>Мови програмування</li><li>Середовища розробки</li></ul><h3>Модуль 2: Алгоритми та структури даних</h3><ul><li>Базові алгоритми</li><li>Масиви та списки</li><li>Сортування та пошук</li></ul>','[\"Розуміння основних концепцій програмування\", \"Вміння створювати прості програми\", \"Знання базових алгоритмів\", \"Навички роботи з IDE\"]','[\"Лабораторні роботи (40%)\", \"Контрольні роботи (30%)\", \"Екзамен (30%)\"]','[{\"type\": \"Основна\", \"year\": \"2023\", \"title\": \"Основи програмування на Python\", \"author\": \"Іванов І.І.\", \"publisher\": \"Техніка\"}, {\"type\": \"Основна\", \"year\": \"2022\", \"title\": \"Алгоритми та структури даних\", \"author\": \"Петров П.П.\", \"publisher\": \"Освіта\"}, {\"type\": \"Додаткова\", \"year\": \"2024\", \"title\": \"Практичне програмування\", \"author\": \"Сидоров С.С.\", \"publisher\": \"Знання\"}]','[{\"url\": \"https://example.com/lab-instructions.pdf\", \"type\": \"Методичні вказівки\", \"year\": \"2024\", \"title\": \"Методичні вказівки до лабораторних робіт з основ програмування\", \"author\": \"Коваленко О.В.\", \"description\": \"Детальні інструкції для виконання лабораторних робіт, включаючи приклади коду та завдання для самостійної роботи.\"}, {\"url\": \"https://example.com/lectures.zip\", \"type\": \"Презентації\", \"year\": \"2024\", \"title\": \"Презентації лекцій\", \"author\": \"Коваленко О.В.\", \"description\": \"Слайди лекцій з основних тем курсу: змінні, цикли, функції, масиви.\"}, {\"url\": \"https://example.com/tasks.pdf\", \"type\": \"Збірник завдань\", \"year\": \"2023\", \"title\": \"Збірник практичних завдань\", \"author\": \"Коваленко О.В.\", \"description\": \"Додаткові завдання для закріплення матеріалу з різними рівнями складності.\"}]','professional',5,150,30,45,45,30,'1','Коваленко О.В.','kovalenko@uzhnu.edu.ua','educational-components/programming.svg','[{\"day\": \"Понеділок\", \"room\": \"201\", \"time\": \"08:30-10:05\", \"type\": \"Лекція\"}, {\"day\": \"Середа\", \"room\": \"Комп. клас 1\", \"time\": \"10:25-12:00\", \"type\": \"Лабораторна\"}, {\"day\": \"П\'ятниця\", \"room\": \"203\", \"time\": \"12:20-13:55\", \"type\": \"Практична\"}]',1,0,'2025-06-18 11:27:13','2025-06-18 13:04:16'),(2,'Математичний аналіз','МАТ-101','Фундаментальний курс математики, що вивчає границі, похідні, інтеграли та їх застосування.','Формування математичного мислення, вивчення основ диференціального та інтегрального числення.','<h3>Розділ 1: Границі та неперервність</h3><p>Вивчення понять границі функції, неперервності та їх властивостей.</p><h3>Розділ 2: Диференціальне числення</h3><p>Похідна функції, правила диференціювання, застосування похідних.</p>','[\"Обчислення границь функцій\", \"Знаходження похідних\", \"Дослідження функцій\", \"Розв\'язування прикладних задач\"]','[\"Модульні контролі (50%)\", \"Екзамен (50%)\"]','[{\"type\": \"Основна\", \"year\": \"2020\", \"title\": \"Математичний аналіз\", \"author\": \"Фіхтенгольц Г.М.\", \"publisher\": \"Вища школа\"}, {\"type\": \"Основна\", \"year\": \"2021\", \"title\": \"Збірник задач з математичного аналізу\", \"author\": \"Демидович Б.П.\", \"publisher\": \"Наука\"}, {\"type\": \"Додаткова\", \"year\": \"2019\", \"title\": \"Диференціальне та інтегральне числення\", \"author\": \"Кудрявцев Л.Д.\", \"publisher\": \"Дрофа\"}]','[{\"url\": \"https://example.com/math-lectures.pdf\", \"type\": \"Курс лекцій\", \"year\": \"2024\", \"title\": \"Курс лекцій з математичного аналізу\", \"author\": \"Сидоренко М.П.\", \"description\": \"Повний курс лекцій з теорії границь, похідних та інтегралів.\"}, {\"url\": \"https://example.com/math-practice.pdf\", \"type\": \"Практикум\", \"year\": \"2023\", \"title\": \"Практикум з розв\'язування задач\", \"author\": \"Сидоренко М.П.\", \"description\": \"Методичний посібник з детальними розв\'язками типових задач.\"}]','general',6,180,60,60,0,60,'1','Сидоренко М.П.','sidorenko@uzhnu.edu.ua','educational-components/01JY1FQ851JW8C7PPY2ANB59KE.jpg','[{\"day\": \"Понеділок\", \"room\": \"223\", \"time\": \"08:30-15:00\", \"type\": \"Лекція\"}]',1,0,'2025-06-18 11:27:13','2025-06-18 13:04:38'),(3,'Тестовий предмет','TEST-001','Тестовий опис','Тестові цілі','Тестовий зміст предмету','[\"Результат 1\", \"Результат 2\"]','[\"Екзамен 50%\", \"Контрольна 30%\"]','[]','[{\"url\": \"https://example.com/test.pdf\", \"type\": \"Методичні вказівки\", \"year\": \"2024\", \"title\": \"Тестовий матеріал\", \"author\": \"Тестовий автор\", \"description\": \"Тестовий опис\"}]','general',3,90,30,30,30,30,'1',NULL,NULL,NULL,'[]',1,0,'2025-06-18 12:58:23','2025-06-18 12:58:23');
/*!40000 ALTER TABLE `educational_components` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educational_programs`
--

DROP TABLE IF EXISTS `educational_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `educational_programs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectives` text COLLATE utf8mb4_unicode_ci,
  `competencies` json DEFAULT NULL,
  `learning_outcomes` json DEFAULT NULL,
  `admission_requirements` text COLLATE utf8mb4_unicode_ci,
  `duration_years` int NOT NULL DEFAULT '4',
  `credits_total` int NOT NULL DEFAULT '240',
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `career_prospects` text COLLATE utf8mb4_unicode_ci,
  `curriculum` json DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `educational_programs_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educational_programs`
--

LOCK TABLES `educational_programs` WRITE;
/*!40000 ALTER TABLE `educational_programs` DISABLE KEYS */;
INSERT INTO `educational_programs` VALUES (1,'Комп\'ютерна інженерія','123 Комп\'ютерна інженерія','Освітньо-професійна програма підготовки бакалаврів з комп\'ютерної інженерії','Підготовка висококваліфікованих фахівців у галузі комп\'ютерної інженерії','[{\"code\": \"ПК-1\", \"description\": \"Здатність проектувати та розробляти програмне забезпечення\"}, {\"code\": \"ПК-2\", \"description\": \"Здатність адмініструвати комп\'ютерні системи та мережі\"}]','[{\"code\": \"ПРН-1\", \"description\": \"Знати основи програмування та алгоритмізації\"}, {\"code\": \"ПРН-2\", \"description\": \"Вміти проектувати та розробляти програмні системи\"}]','Повна загальна середня освіта, ЗНО з математики та української мови',4,240,'Бакалавр з комп\'ютерної інженерії','Програміст, системний адміністратор, інженер-програміст, аналітик','[]','educational-programs/01JY1M6T5H1WDSBV660DSR2FRT.jpg',1,0,'2025-06-18 13:29:46','2025-06-18 13:38:42'),(2,'Інформаційні технології','126 Інформаційні технології','Освітньо-професійна програма підготовки бакалаврів з інформаційних технологій','Підготовка фахівців у галузі ІТ','[{\"code\": \"ПК-1\", \"description\": \"Здатність розробляти ІТ-рішення\"}]','[{\"code\": \"ПРН-1\", \"description\": \"Знати основи ІТ\"}]','Повна загальна середня освіта',4,240,'Бакалавр з інформаційних технологій','ІТ-спеціаліст, розробник, аналітик',NULL,NULL,1,0,'2025-06-18 13:43:55','2025-06-18 13:43:55');
/*!40000 ALTER TABLE `educational_programs` ENABLE KEYS */;
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
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES (1,'Test','test','gallery/01JXZBER5D28GSGWR0ZQDVAZFP.jpg',0,1,'general','2025-06-17 16:27:16','2025-06-17 16:27:16'),(2,'gerbb','gfeafdsadas','gallery/01JXZBFX15JKTAJN3SSY07W76W.png',0,1,'general','2025-06-17 16:27:54','2025-06-17 16:27:54'),(3,'Test','dsaasd','gallery/01JXZBGXFS27YJEMQ9KQ6NHB0P.jpg',0,1,'classroom','2025-06-17 16:28:27','2025-06-17 16:28:27');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_images`
--

LOCK TABLES `gallery_images` WRITE;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
INSERT INTO `gallery_images` VALUES (1,'gallery_images/01JXT2Q2SFPT80E8XJ2H8HJJY5.png','2025-06-15 15:18:20','2025-06-15 15:18:20');
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `graduates`
--

DROP TABLE IF EXISTS `graduates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `graduates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `graduation_year` year NOT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `achievements` text COLLATE utf8mb4_unicode_ci,
  `current_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testimonial` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graduates`
--

LOCK TABLES `graduates` WRITE;
/*!40000 ALTER TABLE `graduates` DISABLE KEYS */;
INSERT INTO `graduates` VALUES (1,'Володимир ','Сподарик',NULL,'Комп\'ютерні науки',2023,'graduates/01JY2VVMC02X9J5AAAC8M7KHD2.jpg','Розробив інноваційний алгоритм машинного навчання. Переможець хакатону TechCrunch 2023.','Senior Software Developer','Google Ukraine','oleksandr.petrenko@gmail.com',NULL,'https://linkedin.com/in/oleksandr-petrenko','Навчання в коледжі дало мені міцну основу для кар\'єри в IT. Викладачі завжди підтримували та надихали на нові досягнення.',1,1,1,'2025-06-19 01:03:23','2025-06-19 01:20:07'),(2,'Марія','Коваленко','Олександрівна','Економіка підприємства',2022,NULL,'Сертифікований фінансовий аналітик (CFA). Автор 5 наукових публікацій з економіки.','Financial Analyst','KPMG','maria.kovalenko@kpmg.com',NULL,'https://linkedin.com/in/maria-kovalenko','Коледж навчив мене не тільки теорії, але й практичним навичкам, які я використовую щодня в роботі.',1,1,2,'2025-06-19 01:03:23','2025-06-19 01:03:23'),(3,'Дмитро','Сидоренко','Васильович','Маркетинг',2021,NULL,'Збільшив продажі компанії на 150%. Лауреат премії \"Маркетолог року 2023\".','Marketing Director','Rozetka','dmytro.sydorenko@rozetka.ua',NULL,NULL,'Практичний підхід до навчання в коледжі допоміг мені швидко адаптуватися в професійному середовищі.',0,1,3,'2025-06-19 01:03:23','2025-06-19 01:03:23'),(4,'Анна','Мельник','Петрівна','Дизайн',2024,NULL,'Дизайнер мобільного додатку з 1М+ завантажень. Переможець конкурсу молодих дизайнерів.','UX/UI Designer','Grammarly','anna.melnyk@grammarly.com',NULL,'https://linkedin.com/in/anna-melnyk','Викладачі коледжу допомогли мені розкрити творчий потенціал та знайти свій стиль в дизайні.',1,1,4,'2025-06-19 01:03:23','2025-06-19 01:03:23'),(5,'Віктор','Бондаренко','Миколайович','Комп\'ютерні науки',2020,NULL,'Керівник команди з 15 розробників. Ментор для молодих спеціалістів.','Tech Lead','Epam Systems','viktor.bondarenko@epam.com',NULL,NULL,'Коледж дав мені не тільки технічні знання, але й навички роботи в команді.',0,1,5,'2025-06-19 01:03:23','2025-06-19 01:03:23');
/*!40000 ALTER TABLE `graduates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_events`
--

DROP TABLE IF EXISTS `history_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history_events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_year` year NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_events`
--

LOCK TABLES `history_events` WRITE;
/*!40000 ALTER TABLE `history_events` DISABLE KEYS */;
INSERT INTO `history_events` VALUES (1,2012,'22122',1,'2025-06-15 16:57:51','2025-06-15 16:57:51');
/*!40000 ALTER TABLE `history_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructors`
--

DROP TABLE IF EXISTS `instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructors`
--

LOCK TABLES `instructors` WRITE;
/*!40000 ALTER TABLE `instructors` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructors` ENABLE KEYS */;
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
-- Table structure for table `kur_links`
--

DROP TABLE IF EXISTS `kur_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kur_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kur_links`
--

LOCK TABLES `kur_links` WRITE;
/*!40000 ALTER TABLE `kur_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `kur_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kur_requirements`
--

DROP TABLE IF EXISTS `kur_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kur_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kur_requirements`
--

LOCK TABLES `kur_requirements` WRITE;
/*!40000 ALTER TABLE `kur_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `kur_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kur_timelines`
--

DROP TABLE IF EXISTS `kur_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kur_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kur_timelines`
--

LOCK TABLES `kur_timelines` WRITE;
/*!40000 ALTER TABLE `kur_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `kur_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kur_topics`
--

DROP TABLE IF EXISTS `kur_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kur_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kur_topics`
--

LOCK TABLES `kur_topics` WRITE;
/*!40000 ALTER TABLE `kur_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `kur_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak23_links`
--

DROP TABLE IF EXISTS `kursak23_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak23_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak23_links`
--

LOCK TABLES `kursak23_links` WRITE;
/*!40000 ALTER TABLE `kursak23_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak23_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak23_requirements`
--

DROP TABLE IF EXISTS `kursak23_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak23_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak23_requirements`
--

LOCK TABLES `kursak23_requirements` WRITE;
/*!40000 ALTER TABLE `kursak23_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak23_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak23_timelines`
--

DROP TABLE IF EXISTS `kursak23_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak23_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak23_timelines`
--

LOCK TABLES `kursak23_timelines` WRITE;
/*!40000 ALTER TABLE `kursak23_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak23_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak23_topics`
--

DROP TABLE IF EXISTS `kursak23_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak23_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak23_topics`
--

LOCK TABLES `kursak23_topics` WRITE;
/*!40000 ALTER TABLE `kursak23_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak23_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak2_links`
--

DROP TABLE IF EXISTS `kursak2_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak2_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak2_links`
--

LOCK TABLES `kursak2_links` WRITE;
/*!40000 ALTER TABLE `kursak2_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak2_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak2_requirements`
--

DROP TABLE IF EXISTS `kursak2_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak2_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak2_requirements`
--

LOCK TABLES `kursak2_requirements` WRITE;
/*!40000 ALTER TABLE `kursak2_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak2_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak2_timelines`
--

DROP TABLE IF EXISTS `kursak2_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak2_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak2_timelines`
--

LOCK TABLES `kursak2_timelines` WRITE;
/*!40000 ALTER TABLE `kursak2_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak2_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak2_topics`
--

DROP TABLE IF EXISTS `kursak2_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak2_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak2_topics`
--

LOCK TABLES `kursak2_topics` WRITE;
/*!40000 ALTER TABLE `kursak2_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak2_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak_links`
--

DROP TABLE IF EXISTS `kursak_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak_links`
--

LOCK TABLES `kursak_links` WRITE;
/*!40000 ALTER TABLE `kursak_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak_requirements`
--

DROP TABLE IF EXISTS `kursak_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak_requirements`
--

LOCK TABLES `kursak_requirements` WRITE;
/*!40000 ALTER TABLE `kursak_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak_timelines`
--

DROP TABLE IF EXISTS `kursak_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak_timelines`
--

LOCK TABLES `kursak_timelines` WRITE;
/*!40000 ALTER TABLE `kursak_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursak_topics`
--

DROP TABLE IF EXISTS `kursak_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursak_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursak_topics`
--

LOCK TABLES `kursak_topics` WRITE;
/*!40000 ALTER TABLE `kursak_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursak_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `news_id` bigint unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `likes_news_id_ip_address_unique` (`news_id`,`ip_address`),
  CONSTRAINT `likes_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (9,3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-18 13:13:40','2025-06-18 13:13:40');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(5,'2025_05_26_134618_create_services_table',2),(6,'2025_05_26_135829_create_roles_table',3),(7,'2025_05_26_135840_create_role_user_table',3),(8,'2025_06_15_092444_create_contact_info_table',4),(9,'2025_06_15_092526_create_partners_table',4),(10,'2025_06_15_092604_create_gallery_images_table',4),(11,'2025_06_15_092634_create_news_table',4),(12,'2025_06_15_092656_create_posts_table',4),(13,'2025_06_15_092712_create_team_members_table',4),(25,'2025_06_15_092735_create_history_events_table',5),(26,'2025_06_15_092806_create_core_values_table',5),(27,'2025_06_15_092858_create_alumni_table',5),(28,'2025_06_15_092913_create_testimonials_table',5),(29,'2025_06_15_092931_create_practice_modules_table',5),(30,'2025_06_15_092951_create_practice_schedule_table',5),(31,'2025_06_15_093006_create_practice_resources_table',5),(32,'2025_06_15_093023_create_course_topics_table',5),(35,'2025_06_15_093054_create_course_requirements_table',6),(36,'2025_06_15_093239_create_diploma_topics_table',6),(38,'2025_06_15_093257_create_diploma_requirements_table',7),(39,'2025_06_15_093336_create_diploma_timeline_table',8),(40,'2025_06_15_093359_create_diploma_links_table',9),(41,'2025_06_15_093421_create_program_overview_table',9),(42,'2025_06_15_093452_create_instructors_table',9),(43,'2025_06_15_093529_create_faq_table',9),(44,'2025_06_15_093543_create_survey_categories_table',9),(45,'2025_06_15_093558_create_survey_responses_table',9),(46,'2025_06_15_174536_create_comments_table',10),(47,'2025_06_15_180915_add_views_to_news_table',11),(48,'2025_06_15_183041_add_content_to_news_table',12),(49,'2025_06_15_183056_create_news_images_table',12),(50,'2025_06_15_183300_add_gallery_to_news_table',13),(51,'2025_06_15_184656_add_attachments_to_news_table',14),(52,'2025_06_15_190816_create_contact_infos_table',15),(53,'2025_06_15_191056_update_contact_info_table',16),(55,'2025_06_15_200155_create_practical_categories_table',17),(56,'2025_06_16_005804_create_test_approveds_table',18),(57,'2025_06_16_005804_create_test_consultations_table',19),(58,'2025_06_16_013219_create_test2_approveds_table',20),(59,'2025_06_16_013220_create_test2_consultations_table',21),(60,'2025_06_16_013337_create_dsadsadsa_approveds_table',22),(61,'2025_06_16_013337_create_dsadsadsa_consultations_table',23),(62,'2025_06_16_120644_add_content_to_practical_categories_table',24),(63,'2025_06_16_122627_create_practical_topics_table',25),(64,'2025_06_16_122705_create_practical_requirements_table',25),(65,'2025_06_16_122733_create_practical_timelines_table',25),(66,'2025_06_16_122810_create_practical_links_table',25),(67,'2025_06_16_122838_create_practical_approveds_table',25),(68,'2025_06_16_122945_create_practical_consultations_table',25),(69,'2025_06_16_123007_create_practical_applications_table',25),(70,'2025_06_16_130900_remove_type_from_practical_topics_table',26),(71,'2025_06_17_123949_create_practical_topic_supervisors_table',27),(72,'2025_06_17_124024_create_practical_topic_stages_table',28),(73,'2025_06_17_124111_create_practical_topic_resources_table',29),(74,'2025_06_16_130958_create_practical_approved_topics_table',30),(75,'2025_06_17_130058_drop_unnecessary_practical_tables',30),(76,'2025_06_17_130214_enhance_practical_topics_table',30),(77,'2025_06_17_130242_create_student_applications_table',30),(78,'2025_06_17_140852_update_student_applications_for_topic_selection',31),(79,'2025_06_17_142801_add_google_auth_fields_to_users_table',32),(80,'2025_06_17_143441_add_teacher_id_to_practical_topics_table',33),(81,'2025_06_17_161419_create_gallery_table',34),(82,'2025_06_17_161537_create_contact_settings_table',34),(83,'2025_06_18_001507_add_category_to_news_table',35),(84,'2025_06_18_004357_create_likes_table',36),(85,'2025_06_18_020653_add_user_id_to_comments_table',37),(86,'2025_06_18_111947_create_educational_components_table',38),(87,'2025_06_18_112100_create_educational_categories_table',38),(88,'2025_06_18_123426_add_methodical_materials_to_educational_components_table',39),(89,'2025_06_18_132003_create_educational_programs_table',40),(90,'2025_06_18_132018_create_surveys_table',40),(91,'2025_06_18_231436_update_survey_responses_table_for_surveys',41),(92,'2025_06_19_005415_create_graduates_table',42);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'news',
  `gallery` json DEFAULT NULL,
  `attachments` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Заміна масла','2025-06-15','news/01JXT2R0RSF5PAC7XY09S2P4ZJ.gif','test','2025-06-15 15:18:50','2025-06-18 02:46:35',76,'<p>Сьогодні відбулася планова заміна масла в автомобільному парку коледжу.</p>\n\n<h3>Основні роботи:</h3>\n<ul>\n    <li>Заміна моторного масла</li>\n    <li>Заміна масляного фільтра</li>\n    <li>Перевірка рівня технічних рідин</li>\n    <li>Діагностика двигуна</li>\n</ul>\n\n<p>Роботи виконувалися студентами групи АТ-21 під керівництвом викладача <strong>Іванова І.І.</strong></p>\n\n<blockquote>\n    <p>Регулярне технічне обслуговування автомобілів є запорукою їх надійної роботи та безпеки на дорозі.</p>\n</blockquote>\n\n<p>Наступне планове ТО заплановано на <em>25 червня 2025 року</em>.</p>','events','[{\"name\": \"Процес заміни масла\", \"path\": \"gallery/oil-change-1.jpg\"}, {\"name\": \"Новий масляний фільтр\", \"path\": \"gallery/oil-filter.jpg\"}, {\"name\": \"Результат роботи\", \"path\": \"gallery/oil-change-result.jpg\"}]','[{\"name\": \"Звіт про ТО.pdf\", \"path\": \"attachments/maintenance-report.pdf\"}, {\"name\": \"Інструкція з ТО.docx\", \"path\": \"attachments/maintenance-guide.docx\"}]'),(2,'Модернізація лабораторії','2025-06-16','news/01JXTDNG6CNV59PEC2DFWV8QBP.jpg','https://github.com/RIcKoTB','2025-06-15 18:29:42','2025-06-18 02:46:51',19,'<p>У нашому коледжі завершилася модернізація лабораторії автомобільної техніки.</p>\n\n<h2>Нове обладнання:</h2>\n<ul>\n    <li><strong>Діагностичний стенд</strong> - для комп\'ютерної діагностики автомобілів</li>\n    <li><strong>Підйомник гідравлічний</strong> - для зручного доступу до днища автомобіля</li>\n    <li><strong>Компресор повітряний</strong> - для пневматичного інструменту</li>\n    <li><strong>Набір спеціального інструменту</strong> - для ремонту сучасних автомобілів</li>\n</ul>\n\n<h3>Переваги нового обладнання:</h3>\n<blockquote>\n    <p>Сучасне обладнання дозволить студентам отримувати практичні навички роботи з новітніми технологіями автомобільної галузі.</p>\n</blockquote>\n\n<p>Лабораторія буде використовуватися для проведення практичних занять з дисциплін:</p>\n<ol>\n    <li>Технічне обслуговування автомобілів</li>\n    <li>Діагностика автомобільних систем</li>\n    <li>Ремонт двигунів внутрішнього згоряння</li>\n    <li>Електрообладнання автомобілів</li>\n</ol>\n\n<p>Офіційне відкриття модернізованої лабораторії заплановано на <em>20 червня 2025 року</em>.</p>','achievements','[{\"name\": \"Діагностичний стенд\", \"path\": \"gallery/diagnostic-stand.jpg\"}, {\"name\": \"Гідравлічний підйомник\", \"path\": \"gallery/hydraulic-lift.jpg\"}, {\"name\": \"Загальний вигляд лабораторії\", \"path\": \"gallery/lab-overview.jpg\"}]','[{\"name\": \"Технічні характеристики обладнання.pdf\", \"path\": \"attachments/equipment-specs.pdf\"}, {\"name\": \"План занять у лабораторії.docx\", \"path\": \"attachments/lab-schedule.docx\"}]'),(3,'Набір на курси підвищення кваліфікації','2025-06-17','news/01JXTF369JRE8FQHFRPA8R7ZFC.jpg','https://github.com/RIcKoTB','2025-06-15 18:54:39','2025-06-19 00:05:04',99,'<h1>📢 Оголошення про набір</h1><p>Ужгородський коледж інформаційних технологій оголошує набір на <strong>курси підвищення кваліфікації</strong> для працівників автомобільної галузі.</p><h2>Доступні програми:</h2><h3>🔧 Діагностика сучасних автомобілів</h3><ul><li>Тривалість: 40 годин</li><li>Вартість: 3000 грн</li><li>Формат: очно-дистанційний</li></ul><h3>⚡ Електрообладнання гібридних автомобілів</h3><ul><li>Тривалість: 60 годин</li><li>Вартість: 4500 грн</li><li>Формат: очний</li></ul><h3>🛠️ Ремонт двигунів Euro-6</h3><ul><li>Тривалість: 50 годин</li><li>Вартість: 3800 грн</li><li>Формат: очний</li></ul><blockquote><strong>Увага!</strong> Для учасників курсів передбачені знижки при групових заявках (від 5 осіб - знижка 10%).</blockquote><h2>📋 Умови участі:<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;фото-2.jpg&quot;,&quot;filesize&quot;:60246,&quot;height&quot;:450,&quot;href&quot;:&quot;http://127.0.0.1:8000/storage/cTbBbttcpdWCUlBh6YcnC4gHX0Is2LTgSz6rMLzC.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/storage/cTbBbttcpdWCUlBh6YcnC4gHX0Is2LTgSz6rMLzC.jpg&quot;,&quot;width&quot;:800}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"http://127.0.0.1:8000/storage/cTbBbttcpdWCUlBh6YcnC4gHX0Is2LTgSz6rMLzC.jpg\"><img src=\"http://127.0.0.1:8000/storage/cTbBbttcpdWCUlBh6YcnC4gHX0Is2LTgSz6rMLzC.jpg\" width=\"800\" height=\"450\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">фото-2.jpg</span> <span class=\"attachment__size\">58.83 KB</span></figcaption></a></figure></h2><ul><li>Наявність середньої спеціальної або вищої освіти</li><li>Досвід роботи в автомобільній галузі від 1 року</li><li>Подання заявки до 30 червня 2025 року</li></ul><p>За додатковою інформацією звертайтеся за телефоном: <strong>(0312) 61-33-45</strong></p>','announcements','[]','[{\"file\": \"news/files/topics_coursework_2025-06-17.xlsx\", \"title\": \"Топік файл\", \"description\": null}]');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_images`
--

DROP TABLE IF EXISTS `news_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `news_id` bigint unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_images_news_id_foreign` (`news_id`),
  CONSTRAINT `news_images_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_images`
--

LOCK TABLES `news_images` WRITE;
/*!40000 ALTER TABLE `news_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `posts` VALUES (1,'Test','2025-06-15','posts/01JXTBFGXVSNCPD2DX3ZX1S89Z.gif','https://github.com/RIcKoTB','2025-06-15 17:51:29','2025-06-15 17:51:29');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practical_approved_topics`
--

DROP TABLE IF EXISTS `practical_approved_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `practical_approved_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practical_approved_topics`
--

LOCK TABLES `practical_approved_topics` WRITE;
/*!40000 ALTER TABLE `practical_approved_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `practical_approved_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practical_categories`
--

DROP TABLE IF EXISTS `practical_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `practical_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `practical_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practical_categories`
--

LOCK TABLES `practical_categories` WRITE;
/*!40000 ALTER TABLE `practical_categories` DISABLE KEYS */;
INSERT INTO `practical_categories` VALUES (47,'Курсові роботи','coursework','<p>Курсові роботи є важливою частиною навчального процесу.</p>','2025-06-16 12:37:52','2025-06-16 12:37:52'),(48,'test','test','<p>test</p>','2025-06-16 13:04:36','2025-06-16 13:04:36');
/*!40000 ALTER TABLE `practical_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practical_topics`
--

DROP TABLE IF EXISTS `practical_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `practical_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_bio` text COLLATE utf8mb4_unicode_ci,
  `stages` json DEFAULT NULL,
  `resources` json DEFAULT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `consultations` json DEFAULT NULL,
  `hours` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `practical_topics_category_id_foreign` (`category_id`),
  KEY `practical_topics_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `practical_topics_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `practical_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `practical_topics_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practical_topics`
--

LOCK TABLES `practical_topics` WRITE;
/*!40000 ALTER TABLE `practical_topics` DISABLE KEYS */;
INSERT INTO `practical_topics` VALUES (1,47,NULL,'Розробка веб-додатку','Створення сучасного веб-додатку','Іванов І.І.','Іванов Іван Іванович','Доцент кафедри інформаційних технологій','ivanov@university.edu','+380501234567','Кандидат технічних наук, досвід роботи 15 років у сфері веб-розробки та баз даних.','[{\"title\": \"Аналіз вимог та планування\", \"status\": \"completed\", \"end_date\": \"2025-07-01\", \"start_date\": \"2025-06-17\", \"description\": \"Детальний аналіз технічних вимог, вибір технологій та складання плану роботи\"}, {\"title\": \"Розробка архітектури системи\", \"status\": \"in_progress\", \"end_date\": \"2025-07-15\", \"start_date\": \"2025-07-01\", \"description\": \"Проектування архітектури додатку, створення діаграм та схем\"}, {\"title\": \"Реалізація функціоналу\", \"status\": \"pending\", \"end_date\": \"2025-08-12\", \"start_date\": \"2025-07-15\", \"description\": \"Програмування основного функціоналу додатку\"}]','[{\"url\": \"https://laravel.com/docs\", \"type\": \"link\", \"title\": \"Документація Laravel\", \"description\": \"Офіційна документація фреймворку Laravel\", \"is_required\": true}, {\"url\": \"https://example.com/course\", \"type\": \"video\", \"title\": \"Курс з веб-розробки\", \"description\": \"Відеокурс з основ сучасної веб-розробки\", \"is_required\": false}]','Знання HTML, CSS, JavaScript, PHP. Базові навички роботи з базами даних MySQL. Вміння працювати з Git.','[{\"notes\": \"Консультація з веб-розробки\", \"teacher\": \"Іванов І.І.\", \"datetime\": \"2025-06-24 10:00:00\", \"location\": \"Аудиторія 201\"}]',120,1,'2025-06-16 12:37:52','2025-06-17 13:12:34'),(2,47,NULL,'Test','test','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,200,1,'2025-06-16 13:03:05','2025-06-16 13:03:05'),(3,48,NULL,'testtt','test','teste',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2222,1,'2025-06-16 13:04:57','2025-06-16 13:04:57');
/*!40000 ALTER TABLE `practical_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practice_modules`
--

DROP TABLE IF EXISTS `practice_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `practice_modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module_type` enum('lab','project','internship') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practice_modules`
--

LOCK TABLES `practice_modules` WRITE;
/*!40000 ALTER TABLE `practice_modules` DISABLE KEYS */;
/*!40000 ALTER TABLE `practice_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practice_resources`
--

DROP TABLE IF EXISTS `practice_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `practice_resources` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practice_resources`
--

LOCK TABLES `practice_resources` WRITE;
/*!40000 ALTER TABLE `practice_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `practice_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practice_schedule`
--

DROP TABLE IF EXISTS `practice_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `practice_schedule` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `practice_schedule_module_id_foreign` (`module_id`),
  CONSTRAINT `practice_schedule_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `practice_modules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practice_schedule`
--

LOCK TABLES `practice_schedule` WRITE;
/*!40000 ALTER TABLE `practice_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `practice_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prakt_links`
--

DROP TABLE IF EXISTS `prakt_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prakt_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prakt_links`
--

LOCK TABLES `prakt_links` WRITE;
/*!40000 ALTER TABLE `prakt_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `prakt_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prakt_requirements`
--

DROP TABLE IF EXISTS `prakt_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prakt_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prakt_requirements`
--

LOCK TABLES `prakt_requirements` WRITE;
/*!40000 ALTER TABLE `prakt_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `prakt_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prakt_timelines`
--

DROP TABLE IF EXISTS `prakt_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prakt_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prakt_timelines`
--

LOCK TABLES `prakt_timelines` WRITE;
/*!40000 ALTER TABLE `prakt_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `prakt_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prakt_topics`
--

DROP TABLE IF EXISTS `prakt_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prakt_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prakt_topics`
--

LOCK TABLES `prakt_topics` WRITE;
/*!40000 ALTER TABLE `prakt_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `prakt_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_overview`
--

DROP TABLE IF EXISTS `program_overview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program_overview` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_overview`
--

LOCK TABLES `program_overview` WRITE;
/*!40000 ALTER TABLE `program_overview` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_overview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `role_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1),(2,1),(3,1),(6,2);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
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
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'2222','222','[\"services\", \"users\"]','2025-05-26 14:05:00','2025-05-26 14:05:36'),(2,'Super Admin','super-admin','[\"*\", \"services\", \"users\"]','2025-05-26 14:15:49','2025-05-26 14:17:13'),(3,'test','t3est','[\"services\", \"users\"]','2025-05-26 14:27:31','2025-05-26 14:27:31'),(6,'test111','t3est2','[\"services\", \"users\"]','2025-05-26 16:24:01','2025-05-26 16:32:35'),(7,'Викладач','Mentor','[\"roles\", \"users\"]','2025-06-19 01:40:00','2025-06-19 01:40:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sasasa_links`
--

DROP TABLE IF EXISTS `sasasa_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sasasa_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sasasa_links`
--

LOCK TABLES `sasasa_links` WRITE;
/*!40000 ALTER TABLE `sasasa_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `sasasa_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sasasa_requirements`
--

DROP TABLE IF EXISTS `sasasa_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sasasa_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sasasa_requirements`
--

LOCK TABLES `sasasa_requirements` WRITE;
/*!40000 ALTER TABLE `sasasa_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `sasasa_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sasasa_timelines`
--

DROP TABLE IF EXISTS `sasasa_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sasasa_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sasasa_timelines`
--

LOCK TABLES `sasasa_timelines` WRITE;
/*!40000 ALTER TABLE `sasasa_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `sasasa_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sasasa_topics`
--

DROP TABLE IF EXISTS `sasasa_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sasasa_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sasasa_topics`
--

LOCK TABLES `sasasa_topics` WRITE;
/*!40000 ALTER TABLE `sasasa_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `sasasa_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'222111','222',222.00,'2025-05-26 13:49:17','2025-05-26 13:49:25'),(4,'2221112','11',11.00,'2025-05-26 16:44:49','2025-05-26 16:44:49');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('1jOferp2trKrL5YiSho1YEUrFjgWejEuw6wkxEFi',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaTJDanhKTHozSElZdDZxTlVtTVRydENGUXRlTWczT2M3QlJSWHdFMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiQ3bW5uYWdKNjFuTUdSaS9OVUl5NDd1VjRzZy5Bd24wQ3l5QkdWT3g4TE5xUzQ4SHhrZHJyVyI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==',1750298774),('7AD6vomlTFyuKpZyoVudSFMgi0jl5L4y1N5XK1iT',NULL,'127.0.0.1','Mozilla/5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1g0UnhIck5rbDFFR21zbEh1YVRLa3NvYUIzb05sZGNBTEx3M29UUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdXJ2ZXlzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1750291942),('7yRLDhtvWUm0gtQAIJAMG8XkSDAjEfcrtukwvEq8',NULL,'127.0.0.1','Mozilla/5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkFXMTd4UWZDNDlIdTVhT0hYaVdWYXB2Z2dTeUJMNmlEWjNtbzBUdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdXJ2ZXlzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1750291934),('82POEoLLgqx7TEvHHRBjBSABRZBdIE8IGx59g0uD',NULL,'127.0.0.1','curl/8.5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFRWNHJER0tVS0FNUWZNT2lEelA2M1dnOTJNV3B6S0hJRnkxMHNlYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90ZXN0LXN1cnZleXMtZGVidWciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1750292097),('8cgqhuzzOtc3DZZlWEiMhFdTDXhmxDJ0GwnVQ3Rb',NULL,'127.0.0.1','Mozilla/5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUxtZFhEaURjNkRJUHlGekplNWJ6bTBJc0ZVTGFhbjlSSWZKUWZmTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdXJ2ZXlzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1750292633),('9cuSxTkNdR6Z9TDgqKZn7riQLCvNz1UOhikVLGKC',NULL,'127.0.0.1','Mozilla/5.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWGY2NmJSTmZNYjJrUm5tdkRpc0QyM3JMNUs5SE5RYnFxYXJPQjRIaiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3N1cnZleXMvMSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvc3VydmV5cy8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1750289492),('Bvv616cDcgFfRLBnvOkyo8aoC0RVMqxaVItssC4V',NULL,'127.0.0.1','Mozilla/5.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSnVmUVNzaUxlVWdHcDZMWE5pRUtnTGpUaldMZVhuSGdiZFlvellFVSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3N1cnZleXMvMSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvc3VydmV5cy8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1750289901),('EkcXBZ4MMO6Ph6WsB5qsL6Icao2S7FbP1cV4b0X2',NULL,'127.0.0.1','Mozilla/5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSnBqeGJDTTJ0cmhFRFRCbGxJcWM5SjczdW8yU1EzU2xsUHlQd2JrUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ncmFkdWF0ZXMvMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1750295053),('kpwuaXBOsJbNEDgB3GPS5LtueQN9tPYVUFF19DrW',NULL,'127.0.0.1','Mozilla/5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXk3elNxbXJSUW1jUGdITUl6eGt0WWt6NHNud3NFbTJ6STc5ODh4bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdXJ2ZXlzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1750289474),('mfq8YZOOtsuGrJIVmLyy2FrfhDDojUYE9UJnoJyg',NULL,'127.0.0.1','Mozilla/5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVhiNnVpaDU0dDlJMFNZQ01WQkpOaHJ5cjA5VUhBS2RybHR5SW9UNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdXJ2ZXlzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1750292036),('MiFdbrTliEcY9rsce5pFztiRhlL0Cmr7ORgrjL9u',NULL,'127.0.0.1','Mozilla/5.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMFRqSXl0NEJ5QUZlaDhMRUNxMVhIRWpJMFFSc3dmMjJmd2lnVzFYOSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1750296852),('n3wtuwTULwLPbwl7lvstBqXCDYMLdpLwTZ7wjBev',NULL,'127.0.0.1','Mozilla/5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiemVod2kwdXB1OHZIdG5qdjlha2ZIMmVFQXpUNmsyNkVHMzJqRnEyMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdXJ2ZXlzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1750296125),('PdsGHB3p9LcMWM2JQ1NVZBMg8yzPUnuWK4BVR6O8',1,'127.0.0.1','Mozilla/5.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUms5cWV1WnpOTENGa0s0cmZXUlRhUVBOYUFIMzFlQlY2Y2xsdGg3dyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3Rlc3Qtc3VydmV5LzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1750289968),('PXHUBJQdjpAVXyqZi4rnm3eTcdooVbw5F4EOd6eV',NULL,'127.0.0.1','Mozilla/5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHRUWmF3OVZ2Z1F2cnZLSFBGMzNLeVBXRjRVbHhkM056S2phUTV4byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ncmFkdWF0ZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1750295034),('W49g62e4cOA88drgPtY42vZlgymsGymy1lXsgtEE',1,'127.0.0.1','Mozilla/5.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicWZya2JLZGNTWDByR1gzYUo2c0FUbEZhNzVVTnczME9oYW51VzNlWSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3Rlc3Qtc3VydmV5LzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1750289945),('ZBkpX3LkyAfXUX7CyGSRJvCpPd3Yf8gxw6Io97sT',1,'127.0.0.1','Mozilla/5.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRGsxUVgzcDNYOUJHb3BFZk1WRzNNWGtnb2pRakNYQjE3TnlGdjFhQiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3Rlc3Qtc3VydmV5LXNob3cvMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1750292661);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_applications`
--

DROP TABLE IF EXISTS `student_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `topic_id` bigint unsigned NOT NULL,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motivation` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_applications_category_id_foreign` (`category_id`),
  KEY `student_applications_topic_id_foreign` (`topic_id`),
  CONSTRAINT `student_applications_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `practical_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_applications_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `practical_topics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_applications`
--

LOCK TABLES `student_applications` WRITE;
/*!40000 ALTER TABLE `student_applications` DISABLE KEYS */;
INSERT INTO `student_applications` VALUES (1,47,1,'Коваленко Олексій','kovalenko@example.com','+380671234567','ІТ-21','Хочу працювати над цією темою, маю досвід роботи з Laravel','approved',NULL,'2025-06-17 13:12:34','2025-06-17 13:12:34','2025-06-17 13:12:34'),(2,47,1,'Петренко Марія','petrenko@example.com','+380501234567','ІТ-21','Хочу працювати над цією темою, оскільки маю досвід роботи з Laravel та цікавлюся веб-розробкою. Вивчав фреймворк самостійно, створював невеликі проекти. Сподіваюся поглибити знання та отримати практичний досвід роботи з реальними завданнями.','approved',NULL,'2025-06-17 14:16:24','2025-06-17 14:16:24','2025-06-17 14:16:24'),(3,47,1,'Іваненко Олексій','ivanenko@example.com','+380671234567','ІТ-22','Дуже цікавлюся цією темою, маю базові знання PHP та хочу розвиватися в напрямку веб-розробки. Готовий витрачати багато часу на вивчення та практику.','pending',NULL,NULL,'2025-06-17 14:16:24','2025-06-17 14:16:24');
/*!40000 ALTER TABLE `student_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_categories`
--

DROP TABLE IF EXISTS `survey_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `survey_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_categories`
--

LOCK TABLES `survey_categories` WRITE;
/*!40000 ALTER TABLE `survey_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_responses`
--

DROP TABLE IF EXISTS `survey_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `survey_responses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `survey_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `answers` json NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `survey_responses_survey_id_foreign` (`survey_id`),
  KEY `survey_responses_user_id_foreign` (`user_id`),
  CONSTRAINT `survey_responses_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE,
  CONSTRAINT `survey_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_responses`
--

LOCK TABLES `survey_responses` WRITE;
/*!40000 ALTER TABLE `survey_responses` DISABLE KEYS */;
INSERT INTO `survey_responses` VALUES (1,'2025-06-18 23:15:50','2025-06-18 23:15:50',1,1,'[\"5\", [\"Програмування\", \"Математика\"], \"Дуже гарний коледж, рекомендую всім!\"]','127.0.0.1','Test Browser'),(3,'2025-06-19 00:27:06','2025-06-19 00:27:06',2,5,'[\"4 курс\", \"5\", [\"Програмування\"], \"Так\", \"Відмінно\", \"222222\", \"Іван Сергійович Леньовський\"]','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36');
/*!40000 ALTER TABLE `survey_responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `surveys` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `questions` json NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '1',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `target_audience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thank_you_message` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (1,'Оцінка якості освітніх послуг','Опитування студентів щодо якості освітніх послуг коледжу','[{\"type\": \"rating\", \"question\": \"Як ви оцінюєте якість викладання в коледжі?\", \"required\": true}, {\"type\": \"checkbox\", \"options\": [\"Програмування\", \"Математика\", \"Фізика\", \"Англійська мова\", \"Інше\"], \"question\": \"Які предмети вам найбільше подобаються?\", \"required\": false}, {\"type\": \"textarea\", \"question\": \"Ваші пропозиції щодо покращення навчального процесу\", \"required\": false}]',1,1,NULL,NULL,'Студенти','Дякуємо за участь в опитуванні! Ваші відповіді допоможуть нам покращити якість освіти.',0,'2025-06-18 13:29:59','2025-06-18 13:29:59'),(2,'Опитування про навчальний процес','Детальне опитування студентів про якість навчального процесу та освітніх послуг','[{\"type\": \"select\", \"options\": [\"1 курс\", \"2 курс\", \"3 курс\", \"4 курс\"], \"question\": \"Ваш курс навчання\", \"required\": true}, {\"type\": \"rating\", \"question\": \"Як ви оцінюєте якість викладання в коледжі?\", \"required\": true}, {\"type\": \"checkbox\", \"options\": [\"Програмування\", \"Математика\", \"Фізика\", \"Англійська мова\", \"Історія\", \"Інше\"], \"question\": \"Які предмети вам найбільше подобаються?\", \"required\": false}, {\"type\": \"yes_no\", \"question\": \"Чи задоволені ви матеріально-технічною базою коледжу?\", \"required\": true}, {\"type\": \"radio\", \"options\": [\"Відмінно\", \"Добре\", \"Задовільно\", \"Незадовільно\", \"Не користуюся\"], \"question\": \"Оцініть роботу бібліотеки\", \"required\": false}, {\"type\": \"textarea\", \"question\": \"Ваші пропозиції щодо покращення навчального процесу\", \"required\": false}, {\"type\": \"text\", \"question\": \"Ваше ім\'я (необов\'язково)\", \"required\": false}]',1,1,NULL,NULL,'Студенти','Дякуємо за детальні відповіді! Ваша думка дуже важлива для покращення якості освіти в нашому коледжі.',0,'2025-06-18 13:51:21','2025-06-18 13:51:21');
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` VALUES (1,'Super Admin','Студент','team_members/01JXT4G12C1J8CMD7WZ8R725WZ.gif','2025-06-15 15:49:26','2025-06-15 15:49:26'),(2,'Верещагін','Викладач','team_members/01JXT7E0YFNBQZM4EAJBNR25J3.png','2025-06-15 16:40:46','2025-06-15 16:40:46'),(3,'test','test','team_members/01JXT7EFB1KEWAYDP65H88PA89.gif','2025-06-15 16:41:01','2025-06-15 16:41:01'),(4,'321','321','team_members/01JXT7ESQM776MHWM0FWX376V3.gif','2025-06-15 16:41:11','2025-06-15 16:41:11');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test2_approveds`
--

DROP TABLE IF EXISTS `test2_approveds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test2_approveds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test2_approveds`
--

LOCK TABLES `test2_approveds` WRITE;
/*!40000 ALTER TABLE `test2_approveds` DISABLE KEYS */;
/*!40000 ALTER TABLE `test2_approveds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test2_consultations`
--

DROP TABLE IF EXISTS `test2_consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test2_consultations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test2_consultations`
--

LOCK TABLES `test2_consultations` WRITE;
/*!40000 ALTER TABLE `test2_consultations` DISABLE KEYS */;
/*!40000 ALTER TABLE `test2_consultations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test2_links`
--

DROP TABLE IF EXISTS `test2_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test2_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test2_links`
--

LOCK TABLES `test2_links` WRITE;
/*!40000 ALTER TABLE `test2_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `test2_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test2_requirements`
--

DROP TABLE IF EXISTS `test2_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test2_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test2_requirements`
--

LOCK TABLES `test2_requirements` WRITE;
/*!40000 ALTER TABLE `test2_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `test2_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test2_timelines`
--

DROP TABLE IF EXISTS `test2_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test2_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test2_timelines`
--

LOCK TABLES `test2_timelines` WRITE;
/*!40000 ALTER TABLE `test2_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `test2_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test2_topics`
--

DROP TABLE IF EXISTS `test2_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test2_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test2_topics`
--

LOCK TABLES `test2_topics` WRITE;
/*!40000 ALTER TABLE `test2_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `test2_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test33_links`
--

DROP TABLE IF EXISTS `test33_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test33_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test33_links`
--

LOCK TABLES `test33_links` WRITE;
/*!40000 ALTER TABLE `test33_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `test33_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test33_requirements`
--

DROP TABLE IF EXISTS `test33_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test33_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test33_requirements`
--

LOCK TABLES `test33_requirements` WRITE;
/*!40000 ALTER TABLE `test33_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `test33_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test33_timelines`
--

DROP TABLE IF EXISTS `test33_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test33_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test33_timelines`
--

LOCK TABLES `test33_timelines` WRITE;
/*!40000 ALTER TABLE `test33_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `test33_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test33_topics`
--

DROP TABLE IF EXISTS `test33_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test33_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test33_topics`
--

LOCK TABLES `test33_topics` WRITE;
/*!40000 ALTER TABLE `test33_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `test33_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_approveds`
--

DROP TABLE IF EXISTS `test_approveds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_approveds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_approveds`
--

LOCK TABLES `test_approveds` WRITE;
/*!40000 ALTER TABLE `test_approveds` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_approveds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_consultations`
--

DROP TABLE IF EXISTS `test_consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_consultations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_consultations`
--

LOCK TABLES `test_consultations` WRITE;
/*!40000 ALTER TABLE `test_consultations` DISABLE KEYS */;
INSERT INTO `test_consultations` VALUES (1,'2025-06-16 01:03:27','2025-06-16 01:03:27');
/*!40000 ALTER TABLE `test_consultations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_links`
--

DROP TABLE IF EXISTS `test_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_links`
--

LOCK TABLES `test_links` WRITE;
/*!40000 ALTER TABLE `test_links` DISABLE KEYS */;
INSERT INTO `test_links` VALUES (1,1,'https://github.com/RIcKoTB','ChatGPH','2025-06-16 00:29:45','2025-06-16 00:29:45');
/*!40000 ALTER TABLE `test_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_requirements`
--

DROP TABLE IF EXISTS `test_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_requirements`
--

LOCK TABLES `test_requirements` WRITE;
/*!40000 ALTER TABLE `test_requirements` DISABLE KEYS */;
INSERT INTO `test_requirements` VALUES (1,1,'fasfsasfa','2025-06-16 00:29:51','2025-06-16 00:29:51');
/*!40000 ALTER TABLE `test_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_timelines`
--

DROP TABLE IF EXISTS `test_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_timelines`
--

LOCK TABLES `test_timelines` WRITE;
/*!40000 ALTER TABLE `test_timelines` DISABLE KEYS */;
INSERT INTO `test_timelines` VALUES (1,1,'2025-06-18','2','dsadsadsa','2025-06-16 00:30:01','2025-06-16 00:30:01');
/*!40000 ALTER TABLE `test_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_topics`
--

DROP TABLE IF EXISTS `test_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_topics`
--

LOCK TABLES `test_topics` WRITE;
/*!40000 ALTER TABLE `test_topics` DISABLE KEYS */;
INSERT INTO `test_topics` VALUES (1,'Test','test','test','2025-06-16 00:29:28','2025-06-16 00:29:28');
/*!40000 ALTER TABLE `test_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `alumni_id` bigint unsigned NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `testimonials_alumni_id_foreign` (`alumni_id`),
  CONSTRAINT `testimonials_alumni_id_foreign` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,1,'Good\n','2025-06-15 15:38:01','2025-06-15 15:38:01');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trest3_links`
--

DROP TABLE IF EXISTS `trest3_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trest3_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trest3_links`
--

LOCK TABLES `trest3_links` WRITE;
/*!40000 ALTER TABLE `trest3_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `trest3_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trest3_requirements`
--

DROP TABLE IF EXISTS `trest3_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trest3_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trest3_requirements`
--

LOCK TABLES `trest3_requirements` WRITE;
/*!40000 ALTER TABLE `trest3_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `trest3_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trest3_timelines`
--

DROP TABLE IF EXISTS `trest3_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trest3_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trest3_timelines`
--

LOCK TABLES `trest3_timelines` WRITE;
/*!40000 ALTER TABLE `trest3_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `trest3_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trest3_topics`
--

DROP TABLE IF EXISTS `trest3_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trest3_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trest3_topics`
--

LOCK TABLES `trest3_topics` WRITE;
/*!40000 ALTER TABLE `trest3_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `trest3_topics` ENABLE KEYS */;
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
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_google_id_unique` (`google_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@admin.com',NULL,'$2y$12$7mnnagJ61nMGRi/NUIy47uV4sg.Awn0CyyBGVOx8LNqS48HxkdrrW','9VNNHZEWYUl5M9oZgBjmi4CDIehM8DL6HEgz9qpAnIHfSYYLcmuBHrMYwJOx','2025-05-26 13:48:57','2025-05-26 14:33:00',NULL,NULL,'student',NULL,NULL),(2,'222','222@gmail.com',NULL,'$2y$12$yXLzrjBfKEtTFqvWDJHKGOiBbD0IHzicwQ13E3SW2NW7/ptYCXzRG',NULL,'2025-05-26 16:11:05','2025-05-26 16:24:28',NULL,NULL,'student',NULL,NULL),(3,'Іванов Іван Іванович','ivanov@ezhnu.edu.ua',NULL,NULL,NULL,'2025-06-17 14:36:32','2025-06-17 14:36:32',NULL,NULL,'teacher',NULL,NULL),(4,'Петрова Марія Петрівна','petrova@ezhnu.edu.ua',NULL,NULL,NULL,'2025-06-17 14:36:32','2025-06-17 14:36:32',NULL,NULL,'teacher',NULL,NULL),(5,'Іван Сергійович Леньовський','c.lenovskyi.ivan@student.uzhnu.edu.ua',NULL,NULL,NULL,'2025-06-17 15:19:53','2025-06-17 15:19:53','104977454649479922260','https://lh3.googleusercontent.com/a/ACg8ocIYd_fxsCj716Gb7KauTQw2P3SkcFwfxignNrUE41fl4olHsQ=s96-c','student',NULL,NULL),(6,'Тестовий Студент','test@student.uzhnu.edu.ua',NULL,NULL,NULL,'2025-06-17 15:22:09','2025-06-17 15:22:09',NULL,NULL,'student','ІТ-21','+380501234567'),(7,'Іван Петренко','ivan.petrenko@student.uzhnu.edu.ua','2025-06-18 23:15:35','$2y$12$gRxmC1SAHe3yoCPOrzw1eOXhqELUuFFeIh.QmHHi6GOP2xRf2Z1Qq',NULL,'2025-06-18 23:15:35','2025-06-18 23:15:35',NULL,NULL,'student',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `выфвыф_links`
--

DROP TABLE IF EXISTS `выфвыф_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `выфвыф_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `выфвыф_links`
--

LOCK TABLES `выфвыф_links` WRITE;
/*!40000 ALTER TABLE `выфвыф_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `выфвыф_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `выфвыф_requirements`
--

DROP TABLE IF EXISTS `выфвыф_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `выфвыф_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `выфвыф_requirements`
--

LOCK TABLES `выфвыф_requirements` WRITE;
/*!40000 ALTER TABLE `выфвыф_requirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `выфвыф_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `выфвыф_timelines`
--

DROP TABLE IF EXISTS `выфвыф_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `выфвыф_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `выфвыф_timelines`
--

LOCK TABLES `выфвыф_timelines` WRITE;
/*!40000 ALTER TABLE `выфвыф_timelines` DISABLE KEYS */;
/*!40000 ALTER TABLE `выфвыф_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `выфвыф_topics`
--

DROP TABLE IF EXISTS `выфвыф_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `выфвыф_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `выфвыф_topics`
--

LOCK TABLES `выфвыф_topics` WRITE;
/*!40000 ALTER TABLE `выфвыф_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `выфвыф_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'site_dp_back'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-19  2:07:41

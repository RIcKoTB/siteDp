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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3','i:1;',1750312401),('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer','i:1750312401;',1750312401);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `news_id`, `user_id`, `parent_id`, `author_name`, `content`, `views`, `created_at`, `updated_at`) VALUES (1,1,NULL,NULL,'тест','тест',0,'2025-06-15 17:56:36','2025-06-15 17:56:36'),(2,1,NULL,1,'21321','3213213',0,'2025-06-15 18:01:23','2025-06-15 18:01:23'),(3,1,NULL,NULL,'тмист','тмстмс',0,'2025-06-15 18:24:39','2025-06-15 18:24:39'),(4,1,NULL,1,'віфвіф','віфвіфвіф',0,'2025-06-15 18:25:35','2025-06-15 18:25:35'),(7,1,6,NULL,NULL,'Це тестовий коментар від авторизованого користувача. Дуже цікава новина про заміну масла!',0,'2025-06-18 02:12:13','2025-06-18 02:12:13'),(8,1,6,NULL,NULL,'Ще один коментар для перевірки відображення. Чудово, що студенти беруть участь у практичних роботах.',0,'2025-06-18 02:12:13','2025-06-18 02:12:13'),(9,1,6,NULL,NULL,'Це новий коментар від авторизованого користувача. Дуже корисна інформація про технічне обслуговування!',0,'2025-06-18 02:13:25','2025-06-18 02:13:25'),(10,1,6,1,NULL,'Повністю погоджуюся з вашим коментарем! Практичний досвід дуже важливий.',0,'2025-06-18 02:13:25','2025-06-18 02:13:25'),(13,3,5,NULL,NULL,'Текстіфв',0,'2025-06-18 02:25:22','2025-06-18 02:25:22'),(14,3,5,13,NULL,'віфвфі',0,'2025-06-18 02:26:28','2025-06-18 02:26:28'),(15,1,6,NULL,NULL,'🔧 Дуже корисна інформація про заміну масла! Як студент автомобільного відділення, можу сказати, що такі практичні заняття дуже важливі для нашого навчання. 👨‍🎓',0,'2025-06-18 02:32:44','2025-06-18 02:32:44'),(16,1,6,NULL,NULL,'💡 Чи можна було б додати відео процесу? Було б цікаво побачити весь процес заміни масла крок за кроком.',0,'2025-06-18 02:32:44','2025-06-18 02:32:44'),(17,3,5,13,NULL,'dsadsadas',0,'2025-06-18 02:35:53','2025-06-18 02:35:53'),(18,3,5,13,NULL,'dsadsa',0,'2025-06-18 02:36:21','2025-06-18 02:36:21'),(19,1,6,NULL,NULL,'Дуже цікава стаття про заміну масла! У нас в коледжі теж проводять такі практичні заняття.',0,'2025-06-18 02:40:12','2025-06-18 02:40:12'),(20,1,6,19,NULL,'Так, практичні заняття дуже важливі для майбутніх механіків.',0,'2025-06-18 02:40:12','2025-06-18 02:40:12'),(21,1,6,20,NULL,'Повністю згоден! Без практики теорія мало що дає.',0,'2025-06-18 02:40:12','2025-06-18 02:40:12'),(22,1,6,19,NULL,'А які ще практичні роботи проводяться в коледжі?',0,'2025-06-18 02:40:12','2025-06-18 02:40:12'),(23,1,6,22,NULL,'Це відповідь третього рівня! Дискусія стає дуже цікавою.',0,'2025-06-18 02:42:02','2025-06-18 02:42:02'),(24,3,5,14,NULL,'Привіт',0,'2025-06-18 02:45:43','2025-06-18 02:45:43'),(25,3,5,NULL,NULL,'Тест',0,'2025-06-18 02:45:51','2025-06-18 02:45:51'),(26,3,5,NULL,NULL,'2222',0,'2025-06-18 02:46:09','2025-06-18 02:46:09'),(27,3,1,24,NULL,'dsadsadsa',0,'2025-06-18 13:17:39','2025-06-18 13:17:39'),(31,1,7,NULL,'Тестовий Студент 1','Дуже цікава новина!',0,'2025-06-19 06:03:34','2025-06-19 06:03:34'),(32,1,8,NULL,'Тестовий Студент 2','Коли буде наступна подія?',0,'2025-06-19 06:03:34','2025-06-19 06:03:34'),(33,4,1,NULL,'admin','Чудова ініціатива!',0,'2025-06-19 06:03:34','2025-06-19 06:03:34'),(34,5,9,NULL,'Тестовий Студент 3','Хочу взяти участь у конкурсі!',0,'2025-06-19 06:03:34','2025-06-19 06:03:34');
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
INSERT INTO `contact_infos` (`id`, `name`, `phone`, `email`, `message`, `created_at`, `updated_at`) VALUES (1,'test','1-(555)-555-5555','admin@admin.com','віфвіфжлдвроафщзідшращіф','2025-06-15 19:23:41','2025-06-15 19:23:41');
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
INSERT INTO `contact_settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (1,'organization_name','Циклова комісія програмування та інформаційних технологій','text','contact','Назва організації','Повна назва організації',1,'2025-06-17 16:21:22','2025-06-17 16:21:22'),(2,'phone','+38 (0312) 61-33-45','tel','contact','Телефон','Основний телефон для зв\'язку',2,'2025-06-17 16:21:22','2025-06-17 20:31:46'),(3,'email','collegepit@uzhnu.ua','email','contact','Email','Основний email для зв\'язку',3,'2025-06-17 16:21:22','2025-06-17 20:31:46'),(4,'address_street','вул. Українська, 19','text','address','Вулиця та номер будинку','Адреса розташування',4,'2025-06-17 16:21:22','2025-06-17 20:31:46'),(5,'address_city','м. Ужгород','text','address','Місто','Місто розташування',5,'2025-06-17 16:21:22','2025-06-17 16:21:22'),(6,'address_region','Закарпатська область','text','address','Область','Область розташування',6,'2025-06-17 16:21:22','2025-06-17 16:21:22'),(7,'address_postal_code','88000','text','address','Поштовий індекс','Поштовий індекс',7,'2025-06-17 16:21:22','2025-06-17 16:21:22'),(8,'map_latitude','48.6134116','coordinates','map','Широта','Координати широти для Google Maps',8,'2025-06-17 16:21:22','2025-06-17 20:31:46'),(9,'map_longitude','22.3066565','coordinates','map','Довгота','Координати довготи для Google Maps',9,'2025-06-17 16:21:22','2025-06-17 20:31:46'),(10,'map_zoom','15','number','map','Масштаб карти','Рівень масштабування карти (1-20)',10,'2025-06-17 16:21:22','2025-06-17 16:21:22'),(11,'google_maps_api_key','YOUR_API_KEY','text','map','Google Maps API ключ','API ключ для Google Maps',11,'2025-06-17 16:21:22','2025-06-17 16:21:22');
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
INSERT INTO `core_values` (`id`, `title`, `description`, `img_path`, `created_at`, `updated_at`) VALUES (1,'Test','test','core_values/01JXT8TAHY00XD8AQ3N6VJQFAE.jpg','2025-06-15 17:04:57','2025-06-15 17:04:57');
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
INSERT INTO `educational_categories` (`id`, `name`, `slug`, `description`, `color`, `icon`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (1,'Загальна підготовка','general','Дисципліни загальної підготовки','#3498db','📚',1,0,'2025-06-18 11:26:45','2025-06-18 11:26:45'),(2,'Професійна підготовка','professional','Професійні дисципліни','#e74c3c','🔧',1,0,'2025-06-18 11:26:46','2025-06-18 11:26:46'),(3,'Практична підготовка','practical','Практичні курси та лабораторії','#27ae60','⚙️',1,0,'2025-06-18 11:26:46','2025-06-18 11:26:46'),(4,'Спеціалізація','specialization','Спеціалізовані курси','#9b59b6','🎯',1,0,'2025-06-18 11:26:46','2025-06-18 11:26:46');
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
INSERT INTO `educational_components` (`id`, `title`, `code`, `description`, `objectives`, `content`, `learning_outcomes`, `assessment_methods`, `literature`, `methodical_materials`, `category`, `credits`, `hours_total`, `hours_lectures`, `hours_practical`, `hours_laboratory`, `hours_independent`, `semester`, `teacher_name`, `teacher_email`, `image_url`, `schedule`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (1,'Основи програмування','ІТ-101','Курс знайомить студентів з основними концепціями програмування, алгоритмічним мисленням та базовими структурами даних.','Метою курсу є формування у студентів базових навичок програмування, розуміння принципів алгоритмізації та вміння розв\'язувати прикладні задачі за допомогою програмних засобів.','<h3>Модуль 1: Вступ до програмування</h3><ul><li>Історія програмування</li><li>Мови програмування</li><li>Середовища розробки</li></ul><h3>Модуль 2: Алгоритми та структури даних</h3><ul><li>Базові алгоритми</li><li>Масиви та списки</li><li>Сортування та пошук</li></ul>','[\"Розуміння основних концепцій програмування\", \"Вміння створювати прості програми\", \"Знання базових алгоритмів\", \"Навички роботи з IDE\"]','[\"Лабораторні роботи (40%)\", \"Контрольні роботи (30%)\", \"Екзамен (30%)\"]','[{\"type\": \"Основна\", \"year\": \"2023\", \"title\": \"Основи програмування на Python\", \"author\": \"Іванов І.І.\", \"publisher\": \"Техніка\"}, {\"type\": \"Основна\", \"year\": \"2022\", \"title\": \"Алгоритми та структури даних\", \"author\": \"Петров П.П.\", \"publisher\": \"Освіта\"}, {\"type\": \"Додаткова\", \"year\": \"2024\", \"title\": \"Практичне програмування\", \"author\": \"Сидоров С.С.\", \"publisher\": \"Знання\"}]','[{\"url\": \"https://example.com/lab-instructions.pdf\", \"type\": \"Методичні вказівки\", \"year\": \"2024\", \"title\": \"Методичні вказівки до лабораторних робіт з основ програмування\", \"author\": \"Коваленко О.В.\", \"description\": \"Детальні інструкції для виконання лабораторних робіт, включаючи приклади коду та завдання для самостійної роботи.\"}, {\"url\": \"https://example.com/lectures.zip\", \"type\": \"Презентації\", \"year\": \"2024\", \"title\": \"Презентації лекцій\", \"author\": \"Коваленко О.В.\", \"description\": \"Слайди лекцій з основних тем курсу: змінні, цикли, функції, масиви.\"}, {\"url\": \"https://example.com/tasks.pdf\", \"type\": \"Збірник завдань\", \"year\": \"2023\", \"title\": \"Збірник практичних завдань\", \"author\": \"Коваленко О.В.\", \"description\": \"Додаткові завдання для закріплення матеріалу з різними рівнями складності.\"}]','professional',5,150,30,45,45,30,'1','Коваленко О.В.','kovalenko@uzhnu.edu.ua','educational-components/programming.svg','[{\"day\": \"Понеділок\", \"room\": \"201\", \"time\": \"08:30-10:05\", \"type\": \"Лекція\"}, {\"day\": \"Середа\", \"room\": \"Комп. клас 1\", \"time\": \"10:25-12:00\", \"type\": \"Лабораторна\"}, {\"day\": \"П\'ятниця\", \"room\": \"203\", \"time\": \"12:20-13:55\", \"type\": \"Практична\"}]',1,0,'2025-06-18 11:27:13','2025-06-18 13:04:16'),(2,'Математичний аналіз','МАТ-101','Фундаментальний курс математики, що вивчає границі, похідні, інтеграли та їх застосування.','Формування математичного мислення, вивчення основ диференціального та інтегрального числення.','<h3>Розділ 1: Границі та неперервність</h3><p>Вивчення понять границі функції, неперервності та їх властивостей.</p><h3>Розділ 2: Диференціальне числення</h3><p>Похідна функції, правила диференціювання, застосування похідних.</p>','[\"Обчислення границь функцій\", \"Знаходження похідних\", \"Дослідження функцій\", \"Розв\'язування прикладних задач\"]','[\"Модульні контролі (50%)\", \"Екзамен (50%)\"]','[{\"type\": \"Основна\", \"year\": \"2020\", \"title\": \"Математичний аналіз\", \"author\": \"Фіхтенгольц Г.М.\", \"publisher\": \"Вища школа\"}, {\"type\": \"Основна\", \"year\": \"2021\", \"title\": \"Збірник задач з математичного аналізу\", \"author\": \"Демидович Б.П.\", \"publisher\": \"Наука\"}, {\"type\": \"Додаткова\", \"year\": \"2019\", \"title\": \"Диференціальне та інтегральне числення\", \"author\": \"Кудрявцев Л.Д.\", \"publisher\": \"Дрофа\"}]','[{\"url\": \"https://example.com/math-lectures.pdf\", \"type\": \"Курс лекцій\", \"year\": \"2024\", \"title\": \"Курс лекцій з математичного аналізу\", \"author\": \"Сидоренко М.П.\", \"description\": \"Повний курс лекцій з теорії границь, похідних та інтегралів.\"}, {\"url\": \"https://example.com/math-practice.pdf\", \"type\": \"Практикум\", \"year\": \"2023\", \"title\": \"Практикум з розв\'язування задач\", \"author\": \"Сидоренко М.П.\", \"description\": \"Методичний посібник з детальними розв\'язками типових задач.\"}]','general',6,180,60,60,0,60,'1','Сидоренко М.П.','sidorenko@uzhnu.edu.ua','educational-components/01JY1FQ851JW8C7PPY2ANB59KE.jpg','[{\"day\": \"Понеділок\", \"room\": \"223\", \"time\": \"08:30-15:00\", \"type\": \"Лекція\"}]',1,0,'2025-06-18 11:27:13','2025-06-18 13:04:38'),(3,'Тестовий предмет','TEST-001','Тестовий опис','Тестові цілі','Тестовий зміст предмету','[\"Результат 1\", \"Результат 2\"]','[\"Екзамен 50%\", \"Контрольна 30%\"]','[]','[{\"url\": \"https://example.com/test.pdf\", \"type\": \"Методичні вказівки\", \"year\": \"2024\", \"title\": \"Тестовий матеріал\", \"author\": \"Тестовий автор\", \"description\": \"Тестовий опис\"}]','general',3,90,30,30,30,30,'1',NULL,NULL,NULL,'[]',1,0,'2025-06-18 12:58:23','2025-06-18 12:58:23');
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
INSERT INTO `educational_programs` (`id`, `title`, `code`, `description`, `objectives`, `competencies`, `learning_outcomes`, `admission_requirements`, `duration_years`, `credits_total`, `qualification`, `career_prospects`, `curriculum`, `image_url`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (1,'Комп\'ютерна інженерія','123 Комп\'ютерна інженерія','Освітньо-професійна програма підготовки бакалаврів з комп\'ютерної інженерії','Підготовка висококваліфікованих фахівців у галузі комп\'ютерної інженерії','[{\"code\": \"ПК-1\", \"description\": \"Здатність проектувати та розробляти програмне забезпечення\"}, {\"code\": \"ПК-2\", \"description\": \"Здатність адмініструвати комп\'ютерні системи та мережі\"}]','[{\"code\": \"ПРН-1\", \"description\": \"Знати основи програмування та алгоритмізації\"}, {\"code\": \"ПРН-2\", \"description\": \"Вміти проектувати та розробляти програмні системи\"}]','Повна загальна середня освіта, ЗНО з математики та української мови',4,240,'Бакалавр з комп\'ютерної інженерії','Програміст, системний адміністратор, інженер-програміст, аналітик','[]','educational-programs/01JY1M6T5H1WDSBV660DSR2FRT.jpg',1,0,'2025-06-18 13:29:46','2025-06-18 13:38:42'),(2,'Інформаційні технології','126 Інформаційні технології','Освітньо-професійна програма підготовки бакалаврів з інформаційних технологій','Підготовка фахівців у галузі ІТ','[{\"code\": \"ПК-1\", \"description\": \"Здатність розробляти ІТ-рішення\"}]','[{\"code\": \"ПРН-1\", \"description\": \"Знати основи ІТ\"}]','Повна загальна середня освіта',4,240,'Бакалавр з інформаційних технологій','ІТ-спеціаліст, розробник, аналітик',NULL,NULL,1,0,'2025-06-18 13:43:55','2025-06-18 13:43:55');
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
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` (`id`, `title`, `description`, `image_path`, `sort_order`, `is_active`, `category`, `created_at`, `updated_at`) VALUES (1,'Test','test','gallery/01JXZBER5D28GSGWR0ZQDVAZFP.jpg',0,1,'general','2025-06-17 16:27:16','2025-06-17 16:27:16'),(2,'gerbb','gfeafdsadas','gallery/01JXZBFX15JKTAJN3SSY07W76W.png',0,1,'general','2025-06-17 16:27:54','2025-06-17 16:27:54'),(3,'Test','dsaasd','gallery/01JXZBGXFS27YJEMQ9KQ6NHB0P.jpg',0,1,'classroom','2025-06-17 16:28:27','2025-06-17 16:28:27'),(4,'Навчальний процес','Студенти під час занять','gallery/students-learning.jpg',1,1,'education','2025-06-19 06:03:34','2025-06-19 06:03:34'),(5,'Лабораторія','Нова комп\'ютерна лабораторія','gallery/computer-lab.jpg',2,1,'facilities','2025-06-19 06:03:34','2025-06-19 06:03:34'),(6,'Випуск 2024','Урочиста церемонія випуску','gallery/graduation-2024.jpg',3,1,'events','2025-06-19 06:03:34','2025-06-19 06:03:34'),(7,'Конференція','Студентська наукова конференція','gallery/conference.jpg',4,1,'events','2025-06-19 06:03:34','2025-06-19 06:03:34');
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
INSERT INTO `gallery_images` (`id`, `img_path`, `created_at`, `updated_at`) VALUES (1,'gallery_images/01JXT2Q2SFPT80E8XJ2H8HJJY5.png','2025-06-15 15:18:20','2025-06-15 15:18:20');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graduates`
--

LOCK TABLES `graduates` WRITE;
/*!40000 ALTER TABLE `graduates` DISABLE KEYS */;
INSERT INTO `graduates` (`id`, `first_name`, `last_name`, `middle_name`, `specialty`, `graduation_year`, `photo_url`, `achievements`, `current_position`, `company`, `contact_email`, `contact_phone`, `linkedin_url`, `testimonial`, `is_featured`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (1,'Володимир ','Сподарик',NULL,'Комп\'ютерні науки',2023,'graduates/01JY2VVMC02X9J5AAAC8M7KHD2.jpg','Розробив інноваційний алгоритм машинного навчання. Переможець хакатону TechCrunch 2023.','Senior Software Developer','Google Ukraine','oleksandr.petrenko@gmail.com',NULL,'https://linkedin.com/in/oleksandr-petrenko','Навчання в коледжі дало мені міцну основу для кар\'єри в IT. Викладачі завжди підтримували та надихали на нові досягнення.',1,1,1,'2025-06-19 01:03:23','2025-06-19 01:20:07'),(2,'Марія','Коваленко','Олександрівна','Економіка підприємства',2022,NULL,'Сертифікований фінансовий аналітик (CFA). Автор 5 наукових публікацій з економіки.','Financial Analyst','KPMG','maria.kovalenko@kpmg.com',NULL,'https://linkedin.com/in/maria-kovalenko','Коледж навчив мене не тільки теорії, але й практичним навичкам, які я використовую щодня в роботі.',1,1,2,'2025-06-19 01:03:23','2025-06-19 01:03:23'),(3,'Дмитро','Сидоренко','Васильович','Маркетинг',2021,NULL,'Збільшив продажі компанії на 150%. Лауреат премії \"Маркетолог року 2023\".','Marketing Director','Rozetka','dmytro.sydorenko@rozetka.ua',NULL,NULL,'Практичний підхід до навчання в коледжі допоміг мені швидко адаптуватися в професійному середовищі.',0,1,3,'2025-06-19 01:03:23','2025-06-19 01:03:23'),(4,'Анна','Мельник','Петрівна','Дизайн',2024,NULL,'Дизайнер мобільного додатку з 1М+ завантажень. Переможець конкурсу молодих дизайнерів.','UX/UI Designer','Grammarly','anna.melnyk@grammarly.com',NULL,'https://linkedin.com/in/anna-melnyk','Викладачі коледжу допомогли мені розкрити творчий потенціал та знайти свій стиль в дизайні.',1,1,4,'2025-06-19 01:03:23','2025-06-19 01:03:23'),(5,'Віктор','Бондаренко','Миколайович','Комп\'ютерні науки',2020,NULL,'Керівник команди з 15 розробників. Ментор для молодих спеціалістів.','Tech Lead','Epam Systems','viktor.bondarenko@epam.com',NULL,NULL,'Коледж дав мені не тільки технічні знання, але й навички роботи в команді.',0,1,5,'2025-06-19 01:03:23','2025-06-19 01:03:23'),(6,'Олександр','Петренко','Іванович','Комп\'ютерні науки',2023,NULL,'Розробив інноваційний алгоритм машинного навчання. Переможець хакатону TechCrunch 2023.','Senior Software Developer','Google Ukraine','oleksandr.petrenko@gmail.com',NULL,'https://linkedin.com/in/oleksandr-petrenko','Навчання в коледжі дало мені міцну основу для кар\'єри в IT. Викладачі завжди підтримували та надихали на нові досягнення.',1,1,1,'2025-06-19 02:59:17','2025-06-19 02:59:17'),(7,'Марія','Коваленко','Олександрівна','Економіка підприємства',2022,NULL,'Сертифікований фінансовий аналітик (CFA). Автор 5 наукових публікацій з економіки.','Financial Analyst','KPMG','maria.kovalenko@kpmg.com',NULL,'https://linkedin.com/in/maria-kovalenko','Коледж навчив мене не тільки теорії, але й практичним навичкам, які я використовую щодня в роботі.',1,1,2,'2025-06-19 02:59:17','2025-06-19 02:59:17'),(8,'Дмитро','Сидоренко','Васильович','Маркетинг',2021,NULL,'Збільшив продажі компанії на 150%. Лауреат премії \"Маркетолог року 2023\".','Marketing Director','Rozetka','dmytro.sydorenko@rozetka.ua',NULL,NULL,'Практичний підхід до навчання в коледжі допоміг мені швидко адаптуватися в професійному середовищі.',0,1,3,'2025-06-19 02:59:17','2025-06-19 02:59:17'),(9,'Анна','Мельник','Петрівна','Дизайн',2024,NULL,'Дизайнер мобільного додатку з 1М+ завантажень. Переможець конкурсу молодих дизайнерів.','UX/UI Designer','Grammarly','anna.melnyk@grammarly.com',NULL,'https://linkedin.com/in/anna-melnyk','Викладачі коледжу допомогли мені розкрити творчий потенціал та знайти свій стиль в дизайні.',1,1,4,'2025-06-19 02:59:17','2025-06-19 02:59:17'),(10,'Віктор','Бондаренко','Миколайович','Комп\'ютерні науки',2020,NULL,'Керівник команди з 15 розробників. Ментор для молодих спеціалістів.','Tech Lead','Epam Systems','viktor.bondarenko@epam.com',NULL,NULL,'Коледж дав мені не тільки технічні знання, але й навички роботи в команді.',0,1,5,'2025-06-19 02:59:17','2025-06-19 02:59:17');
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
INSERT INTO `history_events` (`id`, `event_year`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES (1,2012,'22122',1,'2025-06-15 16:57:51','2025-06-15 16:57:51');
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `likes` (`id`, `news_id`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES (9,3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-18 13:13:40','2025-06-18 13:13:40');
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
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(5,'2025_05_26_134618_create_services_table',2),(6,'2025_05_26_135829_create_roles_table',3),(7,'2025_05_26_135840_create_role_user_table',3),(8,'2025_06_15_092526_create_partners_table',1),(9,'2025_06_15_092634_create_news_table',1),(10,'2025_06_15_092656_create_posts_table',1),(11,'2025_06_15_092712_create_team_members_table',1),(12,'2025_06_15_092735_create_history_events_table',1),(13,'2025_06_15_092806_create_core_values_table',1),(14,'2025_06_15_092858_create_alumni_table',1),(15,'2025_06_15_092913_create_testimonials_table',1),(16,'2025_06_15_174536_create_comments_table',1),(17,'2025_06_15_180915_add_views_to_news_table',1),(18,'2025_06_15_183041_add_content_to_news_table',1),(19,'2025_06_15_183300_add_gallery_to_news_table',1),(20,'2025_06_15_184656_add_attachments_to_news_table',1),(21,'2025_06_15_191056_update_contact_info_table',1),(22,'2025_06_15_200155_create_practical_categories_table',1),(23,'2025_06_16_120644_add_content_to_practical_categories_table',1),(24,'2025_06_16_122627_create_practical_topics_table',1),(25,'2025_06_17_130242_create_student_applications_table',1),(26,'2025_06_17_140852_update_student_applications_for_topic_selection',1),(27,'2025_06_17_142801_add_google_auth_fields_to_users_table',1),(28,'2025_06_17_143441_add_teacher_id_to_practical_topics_table',1),(29,'2025_06_17_161419_create_gallery_table',1),(30,'2025_06_17_161537_create_contact_settings_table',1),(31,'2025_06_18_001507_add_category_to_news_table',1),(32,'2025_06_18_004357_create_likes_table',1),(33,'2025_06_18_020653_add_user_id_to_comments_table',1),(34,'2025_06_18_111947_create_educational_components_table',1),(35,'2025_06_18_112100_create_educational_categories_table',1),(36,'2025_06_18_123426_add_methodical_materials_to_educational_components_table',1),(37,'2025_06_18_132003_create_educational_programs_table',1),(38,'2025_06_18_132018_create_surveys_table',1),(39,'2025_06_18_231436_update_survey_responses_table_for_surveys',1),(40,'2025_06_19_005415_create_graduates_table',1),(41,'2025_06_19_035347_add_completed_at_to_survey_responses_table',1),(42,'2025_06_19_054319_recreate_practical_topics_table_if_missing',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `title`, `date`, `img_path`, `url`, `created_at`, `updated_at`, `views`, `content`, `category`, `gallery`, `attachments`) VALUES (1,'Заміна масла','2025-06-15','news/01JXT2R0RSF5PAC7XY09S2P4ZJ.gif','test','2025-06-15 15:18:50','2025-06-18 02:46:35',76,'<p>Сьогодні відбулася планова заміна масла в автомобільному парку коледжу.</p>\n\n<h3>Основні роботи:</h3>\n<ul>\n    <li>Заміна моторного масла</li>\n    <li>Заміна масляного фільтра</li>\n    <li>Перевірка рівня технічних рідин</li>\n    <li>Діагностика двигуна</li>\n</ul>\n\n<p>Роботи виконувалися студентами групи АТ-21 під керівництвом викладача <strong>Іванова І.І.</strong></p>\n\n<blockquote>\n    <p>Регулярне технічне обслуговування автомобілів є запорукою їх надійної роботи та безпеки на дорозі.</p>\n</blockquote>\n\n<p>Наступне планове ТО заплановано на <em>25 червня 2025 року</em>.</p>','events','[{\"name\": \"Процес заміни масла\", \"path\": \"gallery/oil-change-1.jpg\"}, {\"name\": \"Новий масляний фільтр\", \"path\": \"gallery/oil-filter.jpg\"}, {\"name\": \"Результат роботи\", \"path\": \"gallery/oil-change-result.jpg\"}]','[{\"name\": \"Звіт про ТО.pdf\", \"path\": \"attachments/maintenance-report.pdf\"}, {\"name\": \"Інструкція з ТО.docx\", \"path\": \"attachments/maintenance-guide.docx\"}]'),(2,'Модернізація лабораторії','2025-06-16','news/01JXTDNG6CNV59PEC2DFWV8QBP.jpg','https://github.com/RIcKoTB','2025-06-15 18:29:42','2025-06-18 02:46:51',19,'<p>У нашому коледжі завершилася модернізація лабораторії автомобільної техніки.</p>\n\n<h2>Нове обладнання:</h2>\n<ul>\n    <li><strong>Діагностичний стенд</strong> - для комп\'ютерної діагностики автомобілів</li>\n    <li><strong>Підйомник гідравлічний</strong> - для зручного доступу до днища автомобіля</li>\n    <li><strong>Компресор повітряний</strong> - для пневматичного інструменту</li>\n    <li><strong>Набір спеціального інструменту</strong> - для ремонту сучасних автомобілів</li>\n</ul>\n\n<h3>Переваги нового обладнання:</h3>\n<blockquote>\n    <p>Сучасне обладнання дозволить студентам отримувати практичні навички роботи з новітніми технологіями автомобільної галузі.</p>\n</blockquote>\n\n<p>Лабораторія буде використовуватися для проведення практичних занять з дисциплін:</p>\n<ol>\n    <li>Технічне обслуговування автомобілів</li>\n    <li>Діагностика автомобільних систем</li>\n    <li>Ремонт двигунів внутрішнього згоряння</li>\n    <li>Електрообладнання автомобілів</li>\n</ol>\n\n<p>Офіційне відкриття модернізованої лабораторії заплановано на <em>20 червня 2025 року</em>.</p>','achievements','[{\"name\": \"Діагностичний стенд\", \"path\": \"gallery/diagnostic-stand.jpg\"}, {\"name\": \"Гідравлічний підйомник\", \"path\": \"gallery/hydraulic-lift.jpg\"}, {\"name\": \"Загальний вигляд лабораторії\", \"path\": \"gallery/lab-overview.jpg\"}]','[{\"name\": \"Технічні характеристики обладнання.pdf\", \"path\": \"attachments/equipment-specs.pdf\"}, {\"name\": \"План занять у лабораторії.docx\", \"path\": \"attachments/lab-schedule.docx\"}]'),(3,'Набір на курси підвищення кваліфікації','2025-06-17','news/01JXTF369JRE8FQHFRPA8R7ZFC.jpg','https://github.com/RIcKoTB','2025-06-15 18:54:39','2025-06-19 03:09:07',100,'<h1>📢 Оголошення про набір</h1><p>Ужгородський коледж інформаційних технологій оголошує набір на <strong>курси підвищення кваліфікації</strong> для працівників автомобільної галузі.</p><h2>Доступні програми:</h2><h3>🔧 Діагностика сучасних автомобілів</h3><ul><li>Тривалість: 40 годин</li><li>Вартість: 3000 грн</li><li>Формат: очно-дистанційний</li></ul><h3>⚡ Електрообладнання гібридних автомобілів</h3><ul><li>Тривалість: 60 годин</li><li>Вартість: 4500 грн</li><li>Формат: очний</li></ul><h3>🛠️ Ремонт двигунів Euro-6</h3><ul><li>Тривалість: 50 годин</li><li>Вартість: 3800 грн</li><li>Формат: очний</li></ul><blockquote><strong>Увага!</strong> Для учасників курсів передбачені знижки при групових заявках (від 5 осіб - знижка 10%).</blockquote><h2>📋 Умови участі:<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;фото-2.jpg&quot;,&quot;filesize&quot;:60246,&quot;height&quot;:450,&quot;href&quot;:&quot;http://127.0.0.1:8000/storage/cTbBbttcpdWCUlBh6YcnC4gHX0Is2LTgSz6rMLzC.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/storage/cTbBbttcpdWCUlBh6YcnC4gHX0Is2LTgSz6rMLzC.jpg&quot;,&quot;width&quot;:800}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"http://127.0.0.1:8000/storage/cTbBbttcpdWCUlBh6YcnC4gHX0Is2LTgSz6rMLzC.jpg\"><img src=\"http://127.0.0.1:8000/storage/cTbBbttcpdWCUlBh6YcnC4gHX0Is2LTgSz6rMLzC.jpg\" width=\"800\" height=\"450\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">фото-2.jpg</span> <span class=\"attachment__size\">58.83 KB</span></figcaption></a></figure></h2><ul><li>Наявність середньої спеціальної або вищої освіти</li><li>Досвід роботи в автомобільній галузі від 1 року</li><li>Подання заявки до 30 червня 2025 року</li></ul><p>За додатковою інформацією звертайтеся за телефоном: <strong>(0312) 61-33-45</strong></p>','announcements','[]','[{\"file\": \"news/files/topics_coursework_2025-06-17.xlsx\", \"title\": \"Топік файл\", \"description\": null}]'),(4,'Відкриття нової лабораторії','2025-06-19','news/lab-opening.jpg','lab-opening','2025-06-19 06:03:34','2025-06-19 06:03:34',15,'<p>Сьогодні відбулося урочисте відкриття нової комп\'ютерної лабораторії.</p><p>Лабораторія обладнана сучасними комп\'ютерами та програмним забезпеченням для навчання студентів.</p>','events',NULL,NULL),(5,'Конкурс студентських проєктів','2025-06-18','news/contest.jpg','student-contest','2025-06-19 06:03:34','2025-06-19 06:03:34',32,'<p>Оголошується конкурс на кращий студентський IT-проєкт.</p><p>Переможці отримають цінні призи та можливість стажування в IT-компаніях.</p>','announcements',NULL,NULL);
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
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `posts` (`id`, `title`, `date`, `img_path`, `url`, `created_at`, `updated_at`) VALUES (1,'Test','2025-06-15','posts/01JXTBFGXVSNCPD2DX3ZX1S89Z.gif','https://github.com/RIcKoTB','2025-06-15 17:51:29','2025-06-15 17:51:29');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practical_categories`
--

LOCK TABLES `practical_categories` WRITE;
/*!40000 ALTER TABLE `practical_categories` DISABLE KEYS */;
INSERT INTO `practical_categories` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`) VALUES (47,'Курсові роботи','coursework','<p>Курсові роботи є важливою частиною навчального процесу.</p>','2025-06-16 12:37:52','2025-06-16 12:37:52'),(49,'Дипломні роботи','diploma-works','Дипломні роботи для студентів випускних курсів','2025-06-19 06:02:08','2025-06-19 06:02:08'),(50,'Лабораторні роботи','laboratory-works','Лабораторні роботи з різних дисциплін','2025-06-19 06:02:08','2025-06-19 06:02:08'),(51,'Проєктні роботи','project-works','Командні та індивідуальні проєкти','2025-06-19 06:02:08','2025-06-19 06:02:08');
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
  `hours` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `supervisor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_bio` text COLLATE utf8mb4_unicode_ci,
  `stages` json DEFAULT NULL,
  `resources` json DEFAULT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `consultations` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `practical_topics_category_id_foreign` (`category_id`),
  KEY `practical_topics_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `practical_topics_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `practical_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `practical_topics_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practical_topics`
--

LOCK TABLES `practical_topics` WRITE;
/*!40000 ALTER TABLE `practical_topics` DISABLE KEYS */;
INSERT INTO `practical_topics` (`id`, `category_id`, `teacher_id`, `title`, `description`, `teacher`, `hours`, `is_active`, `supervisor_name`, `supervisor_position`, `supervisor_email`, `supervisor_phone`, `supervisor_bio`, `stages`, `resources`, `requirements`, `consultations`, `created_at`, `updated_at`) VALUES (4,47,3,'Розробка веб-додатків на Laravel','Створення повнофункціонального веб-додатку з використанням фреймворку Laravel','Іванов Іван Іванович',40,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-19 05:42:13','2025-06-19 05:42:13'),(5,47,4,'Мобільна розробка на Flutter','Розробка крос-платформенного мобільного додатку','Петрова Марія Петрівна',35,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-19 05:42:13','2025-06-19 05:42:13'),(7,47,3,'Розробка системи управління контентом','Створення CMS на базі Laravel з адмін панеллю','Іванов Іван Іванович',45,1,'Іванов Іван Іванович','Доцент кафедри ІТ','ivanov@uzhnu.edu.ua','+380312345678','Досвідчений викладач з 10-річним стажем у веб-розробці','[{\"title\": \"Створення бази даних\", \"status\": \"pending\", \"end_date\": \"2025-06-21\", \"start_date\": \"2025-06-18\", \"description\": \"Створення бд\"}]','[{\"url\": \"https://console.cloud.google.com/auth/clients/610511702245-2sae3o2m4m07ca5h164q2v4i3jooue0v.apps.googleusercontent.com?authuser=4&inv=1&invt=Ab0ghA&project=mydp-463214\", \"type\": \"link\", \"title\": \"Гугл апі\", \"description\": \"гугл апі авторизація\", \"is_required\": true}]','Знання PHP, Laravel, MySQL, HTML, CSS, JavaScript','[{\"notes\": null, \"teacher\": \"Іванов\", \"datetime\": \"2025-06-20 09:07:33\", \"location\": \"121 аудиторія\"}]','2025-06-19 06:01:09','2025-06-19 06:07:41'),(8,47,4,'Мобільний додаток для навчання','Розробка освітнього мобільного додатку на Flutter','Петрова Марія Петрівна',50,1,'Петрова Марія Петрівна','Старший викладач','petrova@uzhnu.edu.ua','+380312345679','Спеціаліст з мобільної розробки та UX/UI дизайну',NULL,NULL,'Знання Dart, Flutter, Firebase, основи дизайну',NULL,'2025-06-19 06:01:09','2025-06-19 06:01:09'),(10,47,6,'E-commerce платформа','Розробка інтернет-магазину з системою оплати','Коваленко Олена Василівна',55,1,'Коваленко Олена Василівна','Викладач-методист','kovalenko@uzhnu.edu.ua','+380312345681','Спеціаліст з електронної комерції та веб-технологій',NULL,NULL,'Знання PHP, JavaScript, платіжних систем, SEO',NULL,'2025-06-19 06:01:09','2025-06-19 06:01:09'),(11,47,3,'Система управління бібліотекою','Розробка веб-додатку для управління бібліотечним фондом з можливістю пошуку, бронювання та видачі книг','Іванов Іван Іванович',40,1,'Іванов Іван Іванович','Доцент кафедри ІТ','ivanov@uzhnu.edu.ua','+380312345678','Досвідчений викладач з 10-річним стажем у веб-розробці. Спеціалізується на Laravel, Vue.js та базах даних.','[{\"stage\": \"Аналіз вимог\", \"duration\": \"1 тиждень\", \"description\": \"Збір та аналіз функціональних вимог\"}, {\"stage\": \"Проектування БД\", \"duration\": \"1 тиждень\", \"description\": \"Створення схеми бази даних\"}, {\"stage\": \"Backend розробка\", \"duration\": \"3 тижні\", \"description\": \"Розробка API та бізнес-логіки\"}, {\"stage\": \"Frontend розробка\", \"duration\": \"2 тижні\", \"description\": \"Створення користувацького інтерфейсу\"}, {\"stage\": \"Тестування\", \"duration\": \"1 тиждень\", \"description\": \"Функціональне та інтеграційне тестування\"}]','[{\"url\": \"https://laravel.com/docs\", \"type\": \"documentation\", \"title\": \"Laravel Documentation\"}, {\"url\": \"https://vuejs.org/guide/\", \"type\": \"documentation\", \"title\": \"Vue.js Guide\"}, {\"url\": \"https://dev.mysql.com/doc/\", \"type\": \"tutorial\", \"title\": \"MySQL Tutorial\"}, {\"url\": \"https://getbootstrap.com/docs/5.0/components/\", \"type\": \"reference\", \"title\": \"Bootstrap Components\"}]','Знання PHP, Laravel, MySQL, HTML, CSS, JavaScript, Vue.js. Базові знання Git та принципів MVC.','[{\"date\": \"2025-07-01\", \"time\": \"10:00\", \"topic\": \"Обговорення технічного завдання\"}, {\"date\": \"2025-07-08\", \"time\": \"10:00\", \"topic\": \"Перевірка прогресу розробки\"}, {\"date\": \"2025-07-15\", \"time\": \"10:00\", \"topic\": \"Демонстрація проміжних результатів\"}, {\"date\": \"2025-07-22\", \"time\": \"10:00\", \"topic\": \"Фінальна презентація\"}]','2025-06-19 06:10:30','2025-06-19 06:10:30'),(12,47,4,'Мобільний додаток для замовлення їжі','Розробка мобільного додатку на Flutter для замовлення їжі з ресторанів з інтеграцією платіжних систем','Петрова Марія Петрівна',45,1,'Петрова Марія Петрівна','Старший викладач','petrova@uzhnu.edu.ua','+380312345679','Спеціаліст з мобільної розробки та UX/UI дизайну. Має досвід роботи з Flutter, Firebase та мобільними платформами.','[{\"stage\": \"UI/UX дизайн\", \"duration\": \"1 тиждень\", \"description\": \"Створення макетів та прототипів\"}, {\"stage\": \"Налаштування проекту\", \"duration\": \"3 дні\", \"description\": \"Ініціалізація Flutter проекту\"}, {\"stage\": \"Розробка екранів\", \"duration\": \"3 тижні\", \"description\": \"Створення всіх екранів додатку\"}, {\"stage\": \"Інтеграція API\", \"duration\": \"1 тиждень\", \"description\": \"Підключення до backend сервісів\"}, {\"stage\": \"Тестування на пристроях\", \"duration\": \"1 тиждень\", \"description\": \"Тестування на Android та iOS\"}]','[{\"url\": \"https://flutter.dev/docs\", \"type\": \"documentation\", \"title\": \"Flutter Documentation\"}, {\"url\": \"https://dart.dev/guides/language/language-tour\", \"type\": \"tutorial\", \"title\": \"Dart Language Tour\"}, {\"url\": \"https://firebase.flutter.dev/\", \"type\": \"integration\", \"title\": \"Firebase for Flutter\"}, {\"url\": \"https://material.io/design\", \"type\": \"design\", \"title\": \"Material Design\"}]','Знання Dart, Flutter, Firebase, основи мобільної розробки, принципи Material Design та Human Interface Guidelines.','[{\"date\": \"2025-07-02\", \"time\": \"14:00\", \"topic\": \"Планування архітектури додатку\"}, {\"date\": \"2025-07-09\", \"time\": \"14:00\", \"topic\": \"Огляд UI/UX рішень\"}, {\"date\": \"2025-07-16\", \"time\": \"14:00\", \"topic\": \"Тестування функціоналу\"}, {\"date\": \"2025-07-23\", \"time\": \"14:00\", \"topic\": \"Підготовка до релізу\"}]','2025-06-19 06:10:30','2025-06-19 06:10:30'),(13,47,5,'Система моніторингу мережевої безпеки','Розробка системи для моніторингу та аналізу мережевого трафіку з виявленням потенційних загроз','Сидоров Сергій Сергійович',50,1,'Сидоров Сергій Сергійович','Кандидат технічних наук','sidorov@uzhnu.edu.ua','+380312345680','Експерт з кібербезпеки та захисту інформації. Має досвід роботи з системами виявлення вторгнень та аналізу трафіку.','[{\"stage\": \"Дослідження загроз\", \"duration\": \"1 тиждень\", \"description\": \"Аналіз сучасних кіберзагроз\"}, {\"stage\": \"Вибір технологій\", \"duration\": \"3 дні\", \"description\": \"Обґрунтування технічного стеку\"}, {\"stage\": \"Розробка модулів\", \"duration\": \"4 тижні\", \"description\": \"Створення компонентів системи\"}, {\"stage\": \"Інтеграція та налаштування\", \"duration\": \"1 тиждень\", \"description\": \"Об\'єднання модулів\"}, {\"stage\": \"Тестування безпеки\", \"duration\": \"1 тиждень\", \"description\": \"Перевірка ефективності системи\"}]','[{\"url\": \"https://owasp.org/\", \"type\": \"security\", \"title\": \"OWASP Security Guide\"}, {\"url\": \"https://www.wireshark.org/docs/\", \"type\": \"tool\", \"title\": \"Wireshark Documentation\"}, {\"url\": \"https://pypi.org/search/?q=security\", \"type\": \"library\", \"title\": \"Python Security Libraries\"}, {\"url\": \"https://www.cisco.com/c/en/us/solutions/enterprise-networks/\", \"type\": \"theory\", \"title\": \"Network Security Fundamentals\"}]','Знання Python, мережевих протоколів, основ кібербезпеки, Linux, SQL. Розуміння принципів роботи IDS/IPS систем.','[{\"date\": \"2025-07-03\", \"time\": \"16:00\", \"topic\": \"Обговорення архітектури системи\"}, {\"date\": \"2025-07-10\", \"time\": \"16:00\", \"topic\": \"Перевірка алгоритмів виявлення\"}, {\"date\": \"2025-07-17\", \"time\": \"16:00\", \"topic\": \"Тестування на реальних даних\"}, {\"date\": \"2025-07-24\", \"time\": \"16:00\", \"topic\": \"Презентація результатів\"}]','2025-06-19 06:10:30','2025-06-19 06:10:30'),(14,47,6,'CRM система для малого бізнесу','Розробка системи управління взаємовідносинами з клієнтами з модулями продажів, маркетингу та підтримки','Коваленко Олена Василівна',42,1,'Коваленко Олена Василівна','Викладач-методист','kovalenko@uzhnu.edu.ua','+380312345681','Спеціаліст з бізнес-аналітики та розробки корпоративних систем. Має досвід впровадження CRM рішень.','[{\"stage\": \"Бізнес-аналіз\", \"duration\": \"1 тиждень\", \"description\": \"Дослідження потреб малого бізнесу\"}, {\"stage\": \"Проектування системи\", \"duration\": \"1 тиждень\", \"description\": \"Створення архітектури CRM\"}, {\"stage\": \"Розробка модулів\", \"duration\": \"3 тижні\", \"description\": \"Реалізація функціональних модулів\"}, {\"stage\": \"Інтеграція та тестування\", \"duration\": \"1 тиждень\", \"description\": \"Об\'єднання компонентів\"}, {\"stage\": \"Документація\", \"duration\": \"1 тиждень\", \"description\": \"Створення користувацької документації\"}]','[{\"url\": \"https://www.salesforce.com/resources/articles/crm/\", \"type\": \"guide\", \"title\": \"CRM Best Practices\"}, {\"url\": \"https://laravel.com/docs/8.x\", \"type\": \"tutorial\", \"title\": \"Laravel CRM Tutorial\"}, {\"url\": \"https://www.lucidchart.com/pages/database-diagram/database-design\", \"type\": \"design\", \"title\": \"Database Design for CRM\"}, {\"url\": \"https://restfulapi.net/\", \"type\": \"integration\", \"title\": \"API Integration Guide\"}]','Знання PHP, Laravel, MySQL, JavaScript, REST API. Розуміння бізнес-процесів та принципів CRM систем.','[{\"date\": \"2025-07-04\", \"time\": \"11:00\", \"topic\": \"Аналіз вимог до CRM\"}, {\"date\": \"2025-07-11\", \"time\": \"11:00\", \"topic\": \"Огляд прототипу\"}, {\"date\": \"2025-07-18\", \"time\": \"11:00\", \"topic\": \"Тестування з користувачами\"}, {\"date\": \"2025-07-25\", \"time\": \"11:00\", \"topic\": \"Фінальна демонстрація\"}]','2025-06-19 06:10:30','2025-06-19 06:10:30'),(15,47,3,'Платформа для онлайн навчання','Створення LMS (Learning Management System) з відеолекціями, тестуванням та системою оцінювання','Іванов Іван Іванович',48,1,'Іванов Іван Іванович','Доцент кафедри ІТ','ivanov@uzhnu.edu.ua','+380312345678','Досвідчений викладач з 10-річним стажем у веб-розробці. Спеціалізується на Laravel, Vue.js та базах даних.','[{\"stage\": \"Аналіз існуючих LMS\", \"duration\": \"1 тиждень\", \"description\": \"Дослідження Moodle, Canvas та інших\"}, {\"stage\": \"Проектування архітектури\", \"duration\": \"1 тиждень\", \"description\": \"Планування структури системи\"}, {\"stage\": \"Розробка ядра\", \"duration\": \"2 тижні\", \"description\": \"Базовий функціонал платформи\"}, {\"stage\": \"Модуль відео\", \"duration\": \"1 тиждень\", \"description\": \"Інтеграція відеоплеєра\"}, {\"stage\": \"Система тестування\", \"duration\": \"1 тиждень\", \"description\": \"Створення конструктора тестів\"}, {\"stage\": \"Фінальне тестування\", \"duration\": \"1 тиждень\", \"description\": \"Комплексне тестування системи\"}]','[{\"url\": \"https://docs.moodle.org/\", \"type\": \"reference\", \"title\": \"Moodle Documentation\"}, {\"url\": \"https://videojs.com/\", \"type\": \"library\", \"title\": \"Video.js Player\"}, {\"url\": \"https://laravel.com/docs/broadcasting\", \"type\": \"feature\", \"title\": \"Laravel Broadcasting\"}, {\"url\": \"https://www.edtechmagazine.com/\", \"type\": \"research\", \"title\": \"Educational Technology Trends\"}]','Знання PHP, Laravel, MySQL, JavaScript, Vue.js, основи педагогіки та методики навчання.','[{\"date\": \"2025-07-05\", \"time\": \"09:00\", \"topic\": \"Планування функціоналу LMS\"}, {\"date\": \"2025-07-12\", \"time\": \"09:00\", \"topic\": \"Демонстрація прототипу\"}, {\"date\": \"2025-07-19\", \"time\": \"09:00\", \"topic\": \"Тестування з викладачами\"}, {\"date\": \"2025-07-26\", \"time\": \"09:00\", \"topic\": \"Захист проекту\"}]','2025-06-19 06:10:30','2025-06-19 06:10:30'),(16,49,3,'Штучний інтелект для аналізу медичних зображень','Розробка системи машинного навчання для діагностики захворювань на основі рентгенівських знімків та МРТ','Іванов Іван Іванович',80,1,'Іванов Іван Іванович','Доцент кафедри ІТ','ivanov@uzhnu.edu.ua','+380312345678','Досвідчений викладач з 10-річним стажем у веб-розробці та машинному навчанні. Спеціалізується на Python, TensorFlow та комп\'ютерному зорі.','[{\"stage\": \"Дослідження предметної області\", \"duration\": \"2 тижні\", \"description\": \"Вивчення медичної діагностики та існуючих рішень\"}, {\"stage\": \"Збір та підготовка даних\", \"duration\": \"3 тижні\", \"description\": \"Формування датасету медичних зображень\"}, {\"stage\": \"Розробка моделі\", \"duration\": \"4 тижні\", \"description\": \"Створення та навчання нейронної мережі\"}, {\"stage\": \"Веб-інтерфейс\", \"duration\": \"2 тижні\", \"description\": \"Розробка користувацького інтерфейсу\"}, {\"stage\": \"Тестування та валідація\", \"duration\": \"2 тижні\", \"description\": \"Перевірка точності діагностики\"}, {\"stage\": \"Документація та захист\", \"duration\": \"2 тижні\", \"description\": \"Підготовка дипломної роботи\"}]','[{\"url\": \"https://www.tensorflow.org/tutorials/images\", \"type\": \"tutorial\", \"title\": \"TensorFlow Medical Imaging\"}, {\"url\": \"https://www.kaggle.com/datasets?search=medical+imaging\", \"type\": \"dataset\", \"title\": \"Medical Image Datasets\"}, {\"url\": \"https://opencv.org/\", \"type\": \"library\", \"title\": \"OpenCV Documentation\"}, {\"url\": \"https://arxiv.org/list/cs.CV/recent\", \"type\": \"research\", \"title\": \"Medical AI Research Papers\"}]','Знання Python, TensorFlow/PyTorch, OpenCV, математичної статистики, основ медицини. Досвід роботи з великими даними.','[{\"date\": \"2025-07-07\", \"time\": \"10:00\", \"topic\": \"Планування дослідження\"}, {\"date\": \"2025-07-21\", \"time\": \"10:00\", \"topic\": \"Огляд датасету та моделі\"}, {\"date\": \"2025-08-04\", \"time\": \"10:00\", \"topic\": \"Проміжні результати навчання\"}, {\"date\": \"2025-08-18\", \"time\": \"10:00\", \"topic\": \"Тестування системи\"}, {\"date\": \"2025-09-01\", \"time\": \"10:00\", \"topic\": \"Підготовка до захисту\"}]','2025-06-19 06:11:24','2025-06-19 06:11:24'),(17,49,4,'Блокчейн платформа для електронного голосування','Створення децентралізованої системи електронного голосування з використанням технології блокчейн','Петрова Марія Петрівна',85,1,'Петрова Марія Петрівна','Старший викладач','petrova@uzhnu.edu.ua','+380312345679','Спеціаліст з блокчейн технологій та криптографії. Має досвід розробки децентралізованих додатків.','[{\"stage\": \"Дослідження блокчейн технологій\", \"duration\": \"2 тижні\", \"description\": \"Вивчення Ethereum, Solidity, Web3\"}, {\"stage\": \"Проектування архітектури\", \"duration\": \"2 тижні\", \"description\": \"Планування смарт-контрактів\"}, {\"stage\": \"Розробка смарт-контрактів\", \"duration\": \"4 тижні\", \"description\": \"Програмування логіки голосування\"}, {\"stage\": \"Frontend додаток\", \"duration\": \"3 тижні\", \"description\": \"Веб-інтерфейс для голосування\"}, {\"stage\": \"Тестування безпеки\", \"duration\": \"2 тижні\", \"description\": \"Аудит смарт-контрактів\"}, {\"stage\": \"Демонстрація та захист\", \"duration\": \"2 тижні\", \"description\": \"Підготовка презентації\"}]','[{\"url\": \"https://docs.soliditylang.org/\", \"type\": \"documentation\", \"title\": \"Solidity Documentation\"}, {\"url\": \"https://web3js.readthedocs.io/\", \"type\": \"library\", \"title\": \"Web3.js Guide\"}, {\"url\": \"https://ethereum.org/en/developers/\", \"type\": \"platform\", \"title\": \"Ethereum Development\"}, {\"url\": \"https://consensys.github.io/smart-contract-best-practices/\", \"type\": \"security\", \"title\": \"Blockchain Security\"}]','Знання JavaScript, Solidity, Web3.js, криптографії, принципів блокчейн. Розуміння децентралізованих систем.','[{\"date\": \"2025-07-08\", \"time\": \"14:00\", \"topic\": \"Архітектура блокчейн системи\"}, {\"date\": \"2025-07-22\", \"time\": \"14:00\", \"topic\": \"Огляд смарт-контрактів\"}, {\"date\": \"2025-08-05\", \"time\": \"14:00\", \"topic\": \"Тестування на тестнеті\"}, {\"date\": \"2025-08-19\", \"time\": \"14:00\", \"topic\": \"Аудит безпеки\"}, {\"date\": \"2025-09-02\", \"time\": \"14:00\", \"topic\": \"Фінальна демонстрація\"}]','2025-06-19 06:11:24','2025-06-19 06:11:24'),(18,49,5,'Система виявлення кіберзагроз в реальному часі','Розробка комплексної системи для виявлення та протидії кіберзагрозам з використанням машинного навчання','Сидоров Сергій Сергійович',90,1,'Сидоров Сергій Сергійович','Кандидат технічних наук','sidorov@uzhnu.edu.ua','+380312345680','Експерт з кібербезпеки та захисту інформації. Має досвід роботи з системами виявлення вторгнень та машинним навчанням.','[{\"stage\": \"Аналіз кіберзагроз\", \"duration\": \"3 тижні\", \"description\": \"Дослідження сучасних атак та методів захисту\"}, {\"stage\": \"Збір даних про загрози\", \"duration\": \"2 тижні\", \"description\": \"Формування датасету для навчання\"}, {\"stage\": \"Розробка ML моделей\", \"duration\": \"4 тижні\", \"description\": \"Створення алгоритмів виявлення\"}, {\"stage\": \"Система моніторингу\", \"duration\": \"3 тижні\", \"description\": \"Розробка real-time аналізатора\"}, {\"stage\": \"Інтеграція та тестування\", \"duration\": \"2 тижні\", \"description\": \"Об\'єднання компонентів\"}, {\"stage\": \"Валідація та документація\", \"duration\": \"2 тижні\", \"description\": \"Перевірка ефективності системи\"}]','[{\"url\": \"https://attack.mitre.org/\", \"type\": \"framework\", \"title\": \"MITRE ATT&CK Framework\"}, {\"url\": \"https://scikit-learn.org/\", \"type\": \"library\", \"title\": \"Scikit-learn for Security\"}, {\"url\": \"https://www.sans.org/white-papers/\", \"type\": \"research\", \"title\": \"Network Security Monitoring\"}, {\"url\": \"https://www.misp-project.org/\", \"type\": \"data\", \"title\": \"Threat Intelligence Feeds\"}]','Знання Python, машинного навчання, мережевих протоколів, систем виявлення вторгнень, криптографії та пентестингу.','[{\"date\": \"2025-07-09\", \"time\": \"16:00\", \"topic\": \"Планування дослідження загроз\"}, {\"date\": \"2025-07-23\", \"time\": \"16:00\", \"topic\": \"Огляд ML моделей\"}, {\"date\": \"2025-08-06\", \"time\": \"16:00\", \"topic\": \"Тестування виявлення атак\"}, {\"date\": \"2025-08-20\", \"time\": \"16:00\", \"topic\": \"Оцінка ефективності\"}, {\"date\": \"2025-09-03\", \"time\": \"16:00\", \"topic\": \"Підготовка до захисту\"}]','2025-06-19 06:11:24','2025-06-19 06:11:24'),(19,49,6,'IoT платформа для розумного міста','Створення комплексної IoT платформи для управління інфраструктурою розумного міста','Коваленко Олена Василівна',88,1,'Коваленко Олена Василівна','Викладач-методист','kovalenko@uzhnu.edu.ua','+380312345681','Спеціаліст з IoT технологій та розподілених систем. Має досвід роботи з мікроконтролерами та хмарними платформами.','[{\"stage\": \"Дослідження IoT архітектури\", \"duration\": \"2 тижні\", \"description\": \"Вивчення протоколів та платформ\"}, {\"stage\": \"Проектування системи\", \"duration\": \"2 тижні\", \"description\": \"Планування архітектури платформи\"}, {\"stage\": \"Розробка сенсорної мережі\", \"duration\": \"3 тижні\", \"description\": \"Програмування мікроконтролерів\"}, {\"stage\": \"Backend платформа\", \"duration\": \"4 тижні\", \"description\": \"Створення серверної частини\"}, {\"stage\": \"Dashboard та аналітика\", \"duration\": \"3 тижні\", \"description\": \"Веб-інтерфейс для моніторингу\"}, {\"stage\": \"Тестування та оптимізація\", \"duration\": \"2 тижні\", \"description\": \"Перевірка продуктивності\"}]','[{\"url\": \"https://www.arduino.cc/reference/\", \"type\": \"hardware\", \"title\": \"Arduino Documentation\"}, {\"url\": \"https://mqtt.org/\", \"type\": \"protocol\", \"title\": \"MQTT Protocol Guide\"}, {\"url\": \"https://aws.amazon.com/iot-core/\", \"type\": \"cloud\", \"title\": \"AWS IoT Core\"}, {\"url\": \"https://lora-alliance.org/\", \"type\": \"network\", \"title\": \"LoRaWAN Specification\"}]','Знання C/C++, Python, MQTT, LoRaWAN, мікроконтролерів Arduino/ESP32, хмарних платформ AWS/Azure.','[{\"date\": \"2025-07-10\", \"time\": \"11:00\", \"topic\": \"Планування IoT архітектури\"}, {\"date\": \"2025-07-24\", \"time\": \"11:00\", \"topic\": \"Демонстрація сенсорів\"}, {\"date\": \"2025-08-07\", \"time\": \"11:00\", \"topic\": \"Тестування платформи\"}, {\"date\": \"2025-08-21\", \"time\": \"11:00\", \"topic\": \"Аналітика та візуалізація\"}, {\"date\": \"2025-09-04\", \"time\": \"11:00\", \"topic\": \"Фінальна презентація\"}]','2025-06-19 06:11:24','2025-06-19 06:11:24'),(20,50,3,'Основи веб-розробки з HTML/CSS/JS','Практичне вивчення основ фронтенд розробки через створення інтерактивних веб-сторінок','Іванов Іван Іванович',20,1,'Іванов Іван Іванович','Доцент кафедри ІТ','ivanov@uzhnu.edu.ua','+380312345678','Досвідчений викладач з 10-річним стажем у веб-розробці.','[{\"stage\": \"HTML структура\", \"duration\": \"2 заняття\", \"description\": \"Створення семантичної розмітки\"}, {\"stage\": \"CSS стилізація\", \"duration\": \"3 заняття\", \"description\": \"Оформлення та адаптивність\"}, {\"stage\": \"JavaScript інтерактивність\", \"duration\": \"3 заняття\", \"description\": \"Додавання динамічної поведінки\"}, {\"stage\": \"Фінальний проект\", \"duration\": \"2 заняття\", \"description\": \"Створення повноцінного сайту\"}]','[{\"url\": \"https://developer.mozilla.org/\", \"type\": \"documentation\", \"title\": \"MDN Web Docs\"}, {\"url\": \"https://www.w3schools.com/\", \"type\": \"tutorial\", \"title\": \"W3Schools Tutorials\"}, {\"url\": \"https://css-tricks.com/snippets/css/complete-guide-grid/\", \"type\": \"guide\", \"title\": \"CSS Grid Guide\"}, {\"url\": \"https://javascript.info/\", \"type\": \"tutorial\", \"title\": \"JavaScript.info\"}]','Базові знання комп\'ютера, текстового редактора. Бажано знання англійської мови на рівні читання технічної документації.','[{\"date\": \"2025-07-01\", \"time\": \"08:00\", \"topic\": \"Вступ до веб-технологій\"}, {\"date\": \"2025-07-08\", \"time\": \"08:00\", \"topic\": \"Робота з CSS\"}, {\"date\": \"2025-07-15\", \"time\": \"08:00\", \"topic\": \"JavaScript основи\"}, {\"date\": \"2025-07-22\", \"time\": \"08:00\", \"topic\": \"Захист проектів\"}]','2025-06-19 06:12:18','2025-06-19 06:12:18'),(21,50,4,'Розробка мобільних додатків на Flutter','Практичний курс створення крос-платформенних мобільних додатків','Петрова Марія Петрівна',25,1,'Петрова Марія Петрівна','Старший викладач','petrova@uzhnu.edu.ua','+380312345679','Спеціаліст з мобільної розробки та UX/UI дизайну.','[{\"stage\": \"Налаштування середовища\", \"duration\": \"1 заняття\", \"description\": \"Встановлення Flutter SDK\"}, {\"stage\": \"Основи Dart\", \"duration\": \"2 заняття\", \"description\": \"Вивчення мови програмування\"}, {\"stage\": \"Створення UI\", \"duration\": \"3 заняття\", \"description\": \"Робота з віджетами Flutter\"}, {\"stage\": \"Стан та навігація\", \"duration\": \"2 заняття\", \"description\": \"Управління станом додатку\"}, {\"stage\": \"Фінальний додаток\", \"duration\": \"2 заняття\", \"description\": \"Створення повноцінного додатку\"}]','[{\"url\": \"https://flutter.dev/docs\", \"type\": \"documentation\", \"title\": \"Flutter Documentation\"}, {\"url\": \"https://dart.dev/guides/language/language-tour\", \"type\": \"tutorial\", \"title\": \"Dart Language Tour\"}, {\"url\": \"https://flutter.dev/docs/development/ui/widgets\", \"type\": \"reference\", \"title\": \"Flutter Widget Catalog\"}, {\"url\": \"https://material.io/design\", \"type\": \"design\", \"title\": \"Material Design\"}]','Базові знання програмування (бажано Java, C++ або JavaScript). Розуміння ООП принципів.','[{\"date\": \"2025-07-02\", \"time\": \"10:00\", \"topic\": \"Знайомство з Flutter\"}, {\"date\": \"2025-07-09\", \"time\": \"10:00\", \"topic\": \"Робота з віджетами\"}, {\"date\": \"2025-07-16\", \"time\": \"10:00\", \"topic\": \"Управління станом\"}, {\"date\": \"2025-07-23\", \"time\": \"10:00\", \"topic\": \"Презентація додатків\"}]','2025-06-19 06:12:18','2025-06-19 06:12:18'),(22,50,5,'Основи кібербезпеки та пентестингу','Практичне вивчення методів тестування на проникнення та захисту інформаційних систем','Сидоров Сергій Сергійович',30,1,'Сидоров Сергій Сергійович','Кандидат технічних наук','sidorov@uzhnu.edu.ua','+380312345680','Експерт з кібербезпеки та захисту інформації.','[{\"stage\": \"Основи інформаційної безпеки\", \"duration\": \"2 заняття\", \"description\": \"Теоретичні основи кібербезпеки\"}, {\"stage\": \"Сканування мереж\", \"duration\": \"2 заняття\", \"description\": \"Використання Nmap та інших інструментів\"}, {\"stage\": \"Веб-уразливості\", \"duration\": \"3 заняття\", \"description\": \"OWASP Top 10, SQL ін\'єкції\"}, {\"stage\": \"Соціальна інженерія\", \"duration\": \"1 заняття\", \"description\": \"Методи психологічного впливу\"}, {\"stage\": \"Захист систем\", \"duration\": \"2 заняття\", \"description\": \"Методи протидії атакам\"}]','[{\"url\": \"https://owasp.org/www-project-web-security-testing-guide/\", \"type\": \"guide\", \"title\": \"OWASP Testing Guide\"}, {\"url\": \"https://www.kali.org/tools/\", \"type\": \"tools\", \"title\": \"Kali Linux Tools\"}, {\"url\": \"https://docs.metasploit.com/\", \"type\": \"framework\", \"title\": \"Metasploit Documentation\"}, {\"url\": \"https://www.nist.gov/cyberframework\", \"type\": \"standard\", \"title\": \"NIST Cybersecurity Framework\"}]','Базові знання мереж, операційних систем Linux/Windows. Розуміння основ програмування.','[{\"date\": \"2025-07-03\", \"time\": \"14:00\", \"topic\": \"Введення в пентестинг\"}, {\"date\": \"2025-07-10\", \"time\": \"14:00\", \"topic\": \"Практика сканування\"}, {\"date\": \"2025-07-17\", \"time\": \"14:00\", \"topic\": \"Експлуатація уразливостей\"}, {\"date\": \"2025-07-24\", \"time\": \"14:00\", \"topic\": \"Звіт про тестування\"}]','2025-06-19 06:12:18','2025-06-19 06:12:18'),(23,50,6,'Бази даних та SQL','Практичне вивчення проектування баз даних та написання SQL запитів','Коваленко Олена Василівна',22,1,'Коваленко Олена Василівна','Викладач-методист','kovalenko@uzhnu.edu.ua','+380312345681','Спеціаліст з баз даних та бізнес-аналітики.','[{\"stage\": \"Основи реляційних БД\", \"duration\": \"2 заняття\", \"description\": \"Теорія нормалізації та ER-діаграми\"}, {\"stage\": \"Створення таблиць\", \"duration\": \"2 заняття\", \"description\": \"DDL команди та типи даних\"}, {\"stage\": \"Запити SELECT\", \"duration\": \"3 заняття\", \"description\": \"Вибірка даних та з\'єднання таблиць\"}, {\"stage\": \"Модифікація даних\", \"duration\": \"2 заняття\", \"description\": \"INSERT, UPDATE, DELETE операції\"}, {\"stage\": \"Індекси та оптимізація\", \"duration\": \"2 заняття\", \"description\": \"Покращення продуктивності запитів\"}]','[{\"url\": \"https://dev.mysql.com/doc/\", \"type\": \"documentation\", \"title\": \"MySQL Documentation\"}, {\"url\": \"https://www.w3schools.com/sql/\", \"type\": \"tutorial\", \"title\": \"SQL Tutorial\"}, {\"url\": \"https://www.lucidchart.com/pages/database-diagram\", \"type\": \"guide\", \"title\": \"Database Design Guide\"}, {\"url\": \"https://www.postgresql.org/docs/\", \"type\": \"documentation\", \"title\": \"PostgreSQL Tutorial\"}]','Базові знання математики та логіки. Розуміння основ інформатики.','[{\"date\": \"2025-07-04\", \"time\": \"12:00\", \"topic\": \"Проектування БД\"}, {\"date\": \"2025-07-11\", \"time\": \"12:00\", \"topic\": \"Складні запити\"}, {\"date\": \"2025-07-18\", \"time\": \"12:00\", \"topic\": \"Оптимізація\"}, {\"date\": \"2025-07-25\", \"time\": \"12:00\", \"topic\": \"Фінальний проект\"}]','2025-06-19 06:12:18','2025-06-19 06:12:18'),(24,50,3,'Python для початківців','Вивчення основ програмування на мові Python через практичні завдання','Іванов Іван Іванович',24,1,'Іванов Іван Іванович','Доцент кафедри ІТ','ivanov@uzhnu.edu.ua','+380312345678','Досвідчений викладач з 10-річним стажем у веб-розробці.','[{\"stage\": \"Синтаксис Python\", \"duration\": \"2 заняття\", \"description\": \"Змінні, типи даних, операції\"}, {\"stage\": \"Структури управління\", \"duration\": \"2 заняття\", \"description\": \"Умови, цикли, функції\"}, {\"stage\": \"Структури даних\", \"duration\": \"2 заняття\", \"description\": \"Списки, словники, множини\"}, {\"stage\": \"Робота з файлами\", \"duration\": \"2 заняття\", \"description\": \"Читання та запис файлів\"}, {\"stage\": \"Проект\", \"duration\": \"2 заняття\", \"description\": \"Створення консольного додатку\"}]','[{\"url\": \"https://docs.python.org/3/tutorial/\", \"type\": \"tutorial\", \"title\": \"Python.org Tutorial\"}, {\"url\": \"https://realpython.com/\", \"type\": \"tutorial\", \"title\": \"Real Python\"}, {\"url\": \"https://pypi.org/\", \"type\": \"library\", \"title\": \"Python Package Index\"}, {\"url\": \"https://automatetheboringstuff.com/\", \"type\": \"book\", \"title\": \"Automate the Boring Stuff\"}]','Базові знання комп\'ютера. Логічне мислення. Бажання вчитися програмувати.','[{\"date\": \"2025-07-05\", \"time\": \"16:00\", \"topic\": \"Основи Python\"}, {\"date\": \"2025-07-12\", \"time\": \"16:00\", \"topic\": \"Функції та модулі\"}, {\"date\": \"2025-07-19\", \"time\": \"16:00\", \"topic\": \"Робота з даними\"}, {\"date\": \"2025-07-26\", \"time\": \"16:00\", \"topic\": \"Захист проектів\"}]','2025-06-19 06:12:18','2025-06-19 06:12:18'),(25,51,3,'Розумний дім на базі IoT','Командний проект створення системи автоматизації будинку з використанням IoT пристроїв','Іванов Іван Іванович',60,1,'Іванов Іван Іванович','Доцент кафедри ІТ','ivanov@uzhnu.edu.ua','+380312345678','Досвідчений викладач з 10-річним стажем у веб-розробці та IoT.','[{\"stage\": \"Планування проекту\", \"duration\": \"1 тиждень\", \"description\": \"Розподіл ролей та завдань у команді\"}, {\"stage\": \"Дослідження технологій\", \"duration\": \"1 тиждень\", \"description\": \"Вивчення IoT протоколів та пристроїв\"}, {\"stage\": \"Прототипування\", \"duration\": \"2 тижні\", \"description\": \"Створення MVP системи\"}, {\"stage\": \"Розробка компонентів\", \"duration\": \"4 тижні\", \"description\": \"Паралельна робота над модулями\"}, {\"stage\": \"Інтеграція\", \"duration\": \"1 тиждень\", \"description\": \"Об\'єднання всіх компонентів\"}, {\"stage\": \"Тестування та демо\", \"duration\": \"1 тиждень\", \"description\": \"Фінальне тестування та презентація\"}]','[{\"url\": \"https://create.arduino.cc/projecthub\", \"type\": \"projects\", \"title\": \"Arduino Project Hub\"}, {\"url\": \"https://www.home-assistant.io/\", \"type\": \"platform\", \"title\": \"Home Assistant\"}, {\"url\": \"https://mosquitto.org/\", \"type\": \"infrastructure\", \"title\": \"MQTT Broker Setup\"}, {\"url\": \"https://docs.espressif.com/\", \"type\": \"hardware\", \"title\": \"ESP32 Documentation\"}]','Знання C/C++, Python, основ електроніки. Навички командної роботи. Досвід роботи з мікроконтролерами.','[{\"date\": \"2025-07-07\", \"time\": \"09:00\", \"topic\": \"Кікофф проекту\"}, {\"date\": \"2025-07-14\", \"time\": \"09:00\", \"topic\": \"Огляд прототипу\"}, {\"date\": \"2025-07-28\", \"time\": \"09:00\", \"topic\": \"Проміжна демонстрація\"}, {\"date\": \"2025-08-11\", \"time\": \"09:00\", \"topic\": \"Фінальна презентація\"}]','2025-06-19 06:13:20','2025-06-19 06:13:20'),(26,51,4,'Стартап: Мобільний додаток для екології','Створення бізнес-проекту мобільного додатку для моніторингу екологічного стану','Петрова Марія Петрівна',55,1,'Петрова Марія Петрівна','Старший викладач','petrova@uzhnu.edu.ua','+380312345679','Спеціаліст з мобільної розробки та стартап-методології.','[{\"stage\": \"Бізнес-модель\", \"duration\": \"1 тиждень\", \"description\": \"Розробка Canvas моделі\"}, {\"stage\": \"Дослідження ринку\", \"duration\": \"1 тиждень\", \"description\": \"Аналіз конкурентів та цільової аудиторії\"}, {\"stage\": \"MVP розробка\", \"duration\": \"3 тижні\", \"description\": \"Створення мінімального продукту\"}, {\"stage\": \"Тестування з користувачами\", \"duration\": \"1 тиждень\", \"description\": \"Збір фідбеку від потенційних користувачів\"}, {\"stage\": \"Доопрацювання\", \"duration\": \"2 тижні\", \"description\": \"Покращення на основі фідбеку\"}, {\"stage\": \"Презентація інвесторам\", \"duration\": \"1 тиждень\", \"description\": \"Підготовка пітчу для інвесторів\"}]','[{\"url\": \"http://theleanstartup.com/\", \"type\": \"methodology\", \"title\": \"Lean Startup Methodology\"}, {\"url\": \"https://www.strategyzer.com/canvas\", \"type\": \"tool\", \"title\": \"Business Model Canvas\"}, {\"url\": \"https://flutter.dev/\", \"type\": \"technology\", \"title\": \"Flutter for Startups\"}, {\"url\": \"https://www.epa.gov/developers\", \"type\": \"data\", \"title\": \"Environmental APIs\"}]','Знання мобільної розробки, основ бізнесу, маркетингу. Креативність та підприємницькі навички.','[{\"date\": \"2025-07-08\", \"time\": \"11:00\", \"topic\": \"Бізнес-планування\"}, {\"date\": \"2025-07-15\", \"time\": \"11:00\", \"topic\": \"Прогрес розробки\"}, {\"date\": \"2025-07-29\", \"time\": \"11:00\", \"topic\": \"Тестування з користувачами\"}, {\"date\": \"2025-08-12\", \"time\": \"11:00\", \"topic\": \"Пітч інвесторам\"}]','2025-06-19 06:13:20','2025-06-19 06:13:20'),(27,51,5,'Кіберполігон для навчання','Створення віртуального середовища для практики кібербезпеки та етичного хакінгу','Сидоров Сергій Сергійович',65,1,'Сидоров Сергій Сергійович','Кандидат технічних наук','sidorov@uzhnu.edu.ua','+380312345680','Експерт з кібербезпеки та захисту інформації.','[{\"stage\": \"Архітектура полігону\", \"duration\": \"1 тиждень\", \"description\": \"Планування віртуальної інфраструктури\"}, {\"stage\": \"Налаштування VM\", \"duration\": \"2 тижні\", \"description\": \"Створення віртуальних машин\"}, {\"stage\": \"Сценарії атак\", \"duration\": \"2 тижні\", \"description\": \"Розробка навчальних завдань\"}, {\"stage\": \"Система моніторингу\", \"duration\": \"2 тижні\", \"description\": \"Створення dashboard для викладачів\"}, {\"stage\": \"Тестування сценаріїв\", \"duration\": \"1 тиждень\", \"description\": \"Перевірка всіх завдань\"}, {\"stage\": \"Документація\", \"duration\": \"1 тиждень\", \"description\": \"Створення інструкцій для користувачів\"}]','[{\"url\": \"https://www.virtualbox.org/manual/\", \"type\": \"virtualization\", \"title\": \"VirtualBox Documentation\"}, {\"url\": \"https://metasploit.help.rapid7.com/docs/metasploitable-2\", \"type\": \"vulnerable-system\", \"title\": \"Metasploitable\"}, {\"url\": \"https://dvwa.co.uk/\", \"type\": \"web-app\", \"title\": \"DVWA\"}, {\"url\": \"https://www.sans.org/white-papers/\", \"type\": \"research\", \"title\": \"Cyber Range Design\"}]','Знання віртуалізації, мережевих технологій, операційних систем Linux/Windows, основ кібербезпеки.','[{\"date\": \"2025-07-09\", \"time\": \"13:00\", \"topic\": \"Планування інфраструктури\"}, {\"date\": \"2025-07-16\", \"time\": \"13:00\", \"topic\": \"Демонстрація VM\"}, {\"date\": \"2025-07-30\", \"time\": \"13:00\", \"topic\": \"Тестування сценаріїв\"}, {\"date\": \"2025-08-13\", \"time\": \"13:00\", \"topic\": \"Фінальна демонстрація\"}]','2025-06-19 06:13:20','2025-06-19 06:13:20'),(28,51,6,'Платформа для фрілансерів','Розробка веб-платформи для з\'єднання замовників та виконавців фріланс проектів','Коваленко Олена Василівна',58,1,'Коваленко Олена Василівна','Викладач-методист','kovalenko@uzhnu.edu.ua','+380312345681','Спеціаліст з веб-розробки та електронної комерції.','[{\"stage\": \"Аналіз конкурентів\", \"duration\": \"1 тиждень\", \"description\": \"Дослідження Upwork, Freelancer та інших\"}, {\"stage\": \"UX/UI дизайн\", \"duration\": \"2 тижні\", \"description\": \"Створення дизайну платформи\"}, {\"stage\": \"Backend розробка\", \"duration\": \"3 тижні\", \"description\": \"API та бізнес-логіка\"}, {\"stage\": \"Frontend розробка\", \"duration\": \"2 тижні\", \"description\": \"Користувацький інтерфейс\"}, {\"stage\": \"Платіжна система\", \"duration\": \"1 тиждень\", \"description\": \"Інтеграція платежів\"}, {\"stage\": \"Тестування та запуск\", \"duration\": \"1 тиждень\", \"description\": \"Фінальне тестування\"}]','[{\"url\": \"https://laravel.com/docs\", \"type\": \"framework\", \"title\": \"Laravel Documentation\"}, {\"url\": \"https://stripe.com/docs/api\", \"type\": \"payment\", \"title\": \"Stripe API\"}, {\"url\": \"https://vuejs.org/guide/\", \"type\": \"frontend\", \"title\": \"Vue.js Guide\"}, {\"url\": \"https://dribbble.com/tags/freelance_platform\", \"type\": \"design\", \"title\": \"Freelance Platform Design\"}]','Знання PHP, Laravel, JavaScript, Vue.js, MySQL. Розуміння бізнес-процесів фрілансу.','[{\"date\": \"2025-07-10\", \"time\": \"15:00\", \"topic\": \"Планування функціоналу\"}, {\"date\": \"2025-07-17\", \"time\": \"15:00\", \"topic\": \"Огляд дизайну\"}, {\"date\": \"2025-07-31\", \"time\": \"15:00\", \"topic\": \"Демонстрація MVP\"}, {\"date\": \"2025-08-14\", \"time\": \"15:00\", \"topic\": \"Презентація платформи\"}]','2025-06-19 06:13:20','2025-06-19 06:13:20'),(29,51,3,'Система управління університетом','Комплексна ERP система для управління навчальним процесом університету','Іванов Іван Іванович',70,1,'Іванов Іван Іванович','Доцент кафедри ІТ','ivanov@uzhnu.edu.ua','+380312345678','Досвідчений викладач з 10-річним стажем у веб-розробці.','[{\"stage\": \"Аналіз бізнес-процесів\", \"duration\": \"2 тижні\", \"description\": \"Дослідження процесів університету\"}, {\"stage\": \"Проектування архітектури\", \"duration\": \"1 тиждень\", \"description\": \"Планування системної архітектури\"}, {\"stage\": \"Розробка модулів\", \"duration\": \"5 тижнів\", \"description\": \"Створення функціональних модулів\"}, {\"stage\": \"Інтеграція модулів\", \"duration\": \"1 тиждень\", \"description\": \"Об\'єднання всіх компонентів\"}, {\"stage\": \"Тестування\", \"duration\": \"1 тиждень\", \"description\": \"Комплексне тестування системи\"}, {\"stage\": \"Впровадження\", \"duration\": \"1 тиждень\", \"description\": \"Демонстрація та навчання користувачів\"}]','[{\"url\": \"https://www.odoo.com/documentation\", \"type\": \"reference\", \"title\": \"ERP System Design\"}, {\"url\": \"https://www.capterra.com/student-information-systems-software/\", \"type\": \"market-research\", \"title\": \"University Management Systems\"}, {\"url\": \"https://nwidart.com/laravel-modules/\", \"type\": \"architecture\", \"title\": \"Laravel Modules\"}, {\"url\": \"https://www.martinfowler.com/eaaCatalog/\", \"type\": \"patterns\", \"title\": \"Database Design Patterns\"}]','Знання PHP, Laravel, MySQL, JavaScript. Розуміння бізнес-процесів освітніх закладів.','[{\"date\": \"2025-07-11\", \"time\": \"08:00\", \"topic\": \"Кікофф та планування\"}, {\"date\": \"2025-07-25\", \"time\": \"08:00\", \"topic\": \"Огляд архітектури\"}, {\"date\": \"2025-08-08\", \"time\": \"08:00\", \"topic\": \"Демонстрація модулів\"}, {\"date\": \"2025-08-22\", \"time\": \"08:00\", \"topic\": \"Фінальна презентація\"}]','2025-06-19 06:13:20','2025-06-19 06:13:20');
/*!40000 ALTER TABLE `practical_topics` ENABLE KEYS */;
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
INSERT INTO `role_user` (`role_id`, `user_id`) VALUES (1,1),(2,1),(3,1),(6,2);
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `slug`, `permissions`, `created_at`, `updated_at`) VALUES (1,'2222','222','[\"services\", \"users\"]','2025-05-26 14:05:00','2025-05-26 14:05:36'),(2,'Super Admin','super-admin','[\"*\", \"services\", \"users\"]','2025-05-26 14:15:49','2025-05-26 14:17:13'),(3,'test','t3est','[\"services\", \"users\"]','2025-05-26 14:27:31','2025-05-26 14:27:31'),(6,'test111','t3est2','[\"services\", \"users\"]','2025-05-26 16:24:01','2025-05-26 16:32:35');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `services` (`id`, `name`, `description`, `price`, `created_at`, `updated_at`) VALUES (1,'222111','222',222.00,'2025-05-26 13:49:17','2025-05-26 13:49:25'),(4,'2221112','11',11.00,'2025-05-26 16:44:49','2025-05-26 16:44:49');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('GevwqiRwsRpKVk3vS45XSIZXQqlphFixss9yLEnu',11,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicXFWUzN2djVEY2wxUXJZYTh0U29UZjJaMlVOd3c3QlUxejV6bTh6SyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO30=',1750316342);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_applications`
--

LOCK TABLES `student_applications` WRITE;
/*!40000 ALTER TABLE `student_applications` DISABLE KEYS */;
INSERT INTO `student_applications` (`id`, `category_id`, `topic_id`, `student_name`, `student_email`, `student_phone`, `student_group`, `motivation`, `status`, `admin_notes`, `approved_at`, `created_at`, `updated_at`) VALUES (1,47,1,'Коваленко Олексій','kovalenko@example.com','+380671234567','ІТ-21','Хочу працювати над цією темою, маю досвід роботи з Laravel','approved',NULL,'2025-06-17 13:12:34','2025-06-17 13:12:34','2025-06-17 13:12:34'),(2,47,1,'Петренко Марія','petrenko@example.com','+380501234567','ІТ-21','Хочу працювати над цією темою, оскільки маю досвід роботи з Laravel та цікавлюся веб-розробкою. Вивчав фреймворк самостійно, створював невеликі проекти. Сподіваюся поглибити знання та отримати практичний досвід роботи з реальними завданнями.','approved',NULL,'2025-06-17 14:16:24','2025-06-17 14:16:24','2025-06-17 14:16:24'),(3,47,1,'Іваненко Олексій','ivanenko@example.com','+380671234567','ІТ-22','Дуже цікавлюся цією темою, маю базові знання PHP та хочу розвиватися в напрямку веб-розробки. Готовий витрачати багато часу на вивчення та практику.','pending',NULL,NULL,'2025-06-17 14:16:24','2025-06-17 14:16:24'),(4,47,4,'Тестовий Студент 1','student1@student.uzhnu.edu.ua','+380501234567','ІТ-21','Хочу розробити CMS для навчального закладу','approved',NULL,NULL,'2025-06-19 06:01:51','2025-06-19 06:01:51'),(5,47,5,'Тестовий Студент 2','student2@student.uzhnu.edu.ua','+380501234568','ІТ-22','Цікавлюся мобільною розробкою','pending',NULL,NULL,'2025-06-19 06:01:51','2025-06-19 06:01:51'),(7,47,7,'222','222@gmail.com',NULL,'ІТ-21','Хочу створити інтернет-магазин','pending',NULL,NULL,'2025-06-19 06:01:51','2025-06-19 06:01:51'),(8,49,17,'Іван Сергійович Леньовський','c.lenovskyi.ivan@student.uzhnu.edu.ua','0667987920','41','Бо мені любиться дшлівфразщшпіфщзшарфіжщшолраіфщзжшраіфщзшлраіфжщлшраіфщжзлшроаіфщшрафі','pending',NULL,NULL,'2025-06-19 06:58:20','2025-06-19 06:58:20');
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
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survey_responses_survey_id_foreign` (`survey_id`),
  KEY `survey_responses_user_id_foreign` (`user_id`),
  CONSTRAINT `survey_responses_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE,
  CONSTRAINT `survey_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_responses`
--

LOCK TABLES `survey_responses` WRITE;
/*!40000 ALTER TABLE `survey_responses` DISABLE KEYS */;
INSERT INTO `survey_responses` (`id`, `created_at`, `updated_at`, `survey_id`, `user_id`, `answers`, `ip_address`, `user_agent`, `completed_at`) VALUES (1,'2025-06-18 23:15:50','2025-06-18 23:15:50',1,1,'[\"5\", [\"Програмування\", \"Математика\"], \"Дуже гарний коледж, рекомендую всім!\"]','127.0.0.1','Test Browser',NULL),(3,'2025-06-19 00:27:06','2025-06-19 00:27:06',2,5,'[\"4 курс\", \"5\", [\"Програмування\"], \"Так\", \"Відмінно\", \"222222\", \"Іван Сергійович Леньовський\"]','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36',NULL),(4,'2025-06-19 03:55:53','2025-06-19 03:55:53',1,1,'[\"Дуже подобається!\", \"5\"]','127.0.0.1','Test Browser','2025-06-19 03:55:53'),(5,'2025-06-19 03:56:24','2025-06-19 03:56:24',3,5,'[\"222\", \"5\"]','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-19 03:56:24'),(7,'2025-06-19 04:19:40','2025-06-19 04:19:40',3,1,'[\"321\", \"5\"]','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-06-19 04:19:40'),(8,'2025-06-19 06:04:31','2025-06-19 06:04:31',1,7,'{\"0\": \"Добре\", \"1\": \"Так\", \"2\": \"Більше практичних завдань з реальними проєктами\"}',NULL,NULL,'2025-06-19 06:04:31'),(9,'2025-06-19 06:04:31','2025-06-19 06:04:31',1,8,'{\"0\": \"Відмінно\", \"1\": \"Частково\", \"2\": \"Все чудово, продовжуйте в тому ж дусі\"}',NULL,NULL,'2025-06-19 06:04:31'),(10,'2025-06-19 06:04:31','2025-06-19 06:04:31',2,9,'{\"0\": \"Так\", \"1\": [\"Викладачі\", \"Практичні заняття\"], \"2\": \"Дуже подобається навчатися тут\"}',NULL,NULL,'2025-06-19 06:04:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` (`id`, `title`, `description`, `questions`, `is_active`, `is_anonymous`, `start_date`, `end_date`, `target_audience`, `thank_you_message`, `sort_order`, `created_at`, `updated_at`) VALUES (1,'Оцінка якості освітніх послуг','Опитування студентів щодо якості освітніх послуг коледжу','[{\"type\": \"rating\", \"question\": \"Як ви оцінюєте якість викладання в коледжі?\", \"required\": true}, {\"type\": \"checkbox\", \"options\": [\"Програмування\", \"Математика\", \"Фізика\", \"Англійська мова\", \"Інше\"], \"question\": \"Які предмети вам найбільше подобаються?\", \"required\": false}, {\"type\": \"textarea\", \"question\": \"Ваші пропозиції щодо покращення навчального процесу\", \"required\": false}]',1,1,NULL,NULL,'Студенти','Дякуємо за участь в опитуванні! Ваші відповіді допоможуть нам покращити якість освіти.',0,'2025-06-18 13:29:59','2025-06-18 13:29:59'),(2,'Опитування про навчальний процес','Детальне опитування студентів про якість навчального процесу та освітніх послуг','[{\"type\": \"select\", \"options\": [\"1 курс\", \"2 курс\", \"3 курс\", \"4 курс\"], \"question\": \"Ваш курс навчання\", \"required\": true}, {\"type\": \"rating\", \"question\": \"Як ви оцінюєте якість викладання в коледжі?\", \"required\": true}, {\"type\": \"checkbox\", \"options\": [\"Програмування\", \"Математика\", \"Фізика\", \"Англійська мова\", \"Історія\", \"Інше\"], \"question\": \"Які предмети вам найбільше подобаються?\", \"required\": false}, {\"type\": \"yes_no\", \"question\": \"Чи задоволені ви матеріально-технічною базою коледжу?\", \"required\": true}, {\"type\": \"radio\", \"options\": [\"Відмінно\", \"Добре\", \"Задовільно\", \"Незадовільно\", \"Не користуюся\"], \"question\": \"Оцініть роботу бібліотеки\", \"required\": false}, {\"type\": \"textarea\", \"question\": \"Ваші пропозиції щодо покращення навчального процесу\", \"required\": false}, {\"type\": \"text\", \"question\": \"Ваше ім\'я (необов\'язково)\", \"required\": false}]',1,1,NULL,NULL,'Студенти','Дякуємо за детальні відповіді! Ваша думка дуже важлива для покращення якості освіти в нашому коледжі.',0,'2025-06-18 13:51:21','2025-06-18 13:51:21'),(3,'Test','test','[{\"type\": \"text\", \"question\": \"test\", \"required\": false}, {\"type\": \"rating\", \"question\": \"test\", \"required\": false}]',1,1,'2025-06-17 06:26:11','2025-06-20 06:26:15','Студенти','Дякуємо за участь в опитуванні! Ваші відповіді допоможуть нам покращити якість освіти.',0,'2025-06-19 03:26:35','2025-06-19 03:27:14'),(4,'Оцінка якості навчання','Опитування студентів про якість освітніх послуг','[{\"type\": \"radio\", \"options\": [\"Відмінно\", \"Добре\", \"Задовільно\", \"Незадовільно\"], \"question\": \"Як ви оцінюєте якість викладання?\"}, {\"type\": \"radio\", \"options\": [\"Так\", \"Ні\", \"Частково\"], \"question\": \"Чи достатньо практичних занять?\"}, {\"type\": \"textarea\", \"question\": \"Ваші пропозиції щодо покращення навчального процесу\"}]',1,1,NULL,NULL,NULL,NULL,0,'2025-06-19 06:03:55','2025-06-19 06:03:55'),(5,'Зворотний зв\'язок про коледж','Загальне опитування про роботу коледжу','[{\"type\": \"radio\", \"options\": [\"Так\", \"Ні\", \"Можливо\"], \"question\": \"Чи рекомендували б ви наш коледж друзям?\"}, {\"type\": \"checkbox\", \"options\": [\"Викладачі\", \"Матеріальна база\", \"Атмосфера\", \"Практичні заняття\"], \"question\": \"Що вам найбільше подобається в коледжі?\"}, {\"type\": \"textarea\", \"question\": \"Додаткові коментарі\"}]',1,1,NULL,NULL,NULL,NULL,0,'2025-06-19 06:03:55','2025-06-19 06:03:55'),(6,'Оцінка якості навчання','Опитування студентів про якість освітніх послуг','[{\"type\": \"radio\", \"options\": [\"Відмінно\", \"Добре\", \"Задовільно\", \"Незадовільно\"], \"question\": \"Як ви оцінюєте якість викладання?\"}, {\"type\": \"radio\", \"options\": [\"Так\", \"Ні\", \"Частково\"], \"question\": \"Чи достатньо практичних занять?\"}, {\"type\": \"textarea\", \"question\": \"Ваші пропозиції щодо покращення навчального процесу\"}]',1,1,NULL,NULL,NULL,NULL,0,'2025-06-19 06:04:31','2025-06-19 06:04:31'),(7,'Зворотний зв\'язок про коледж','Загальне опитування про роботу коледжу','[{\"type\": \"radio\", \"options\": [\"Так\", \"Ні\", \"Можливо\"], \"question\": \"Чи рекомендували б ви наш коледж друзям?\"}, {\"type\": \"checkbox\", \"options\": [\"Викладачі\", \"Матеріальна база\", \"Атмосфера\", \"Практичні заняття\"], \"question\": \"Що вам найбільше подобається в коледжі?\"}, {\"type\": \"textarea\", \"question\": \"Додаткові коментарі\"}]',1,1,NULL,NULL,NULL,NULL,0,'2025-06-19 06:04:31','2025-06-19 06:04:31');
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
INSERT INTO `team_members` (`id`, `name`, `role`, `img_path`, `created_at`, `updated_at`) VALUES (1,'Super Admin','Студент','team_members/01JXT4G12C1J8CMD7WZ8R725WZ.gif','2025-06-15 15:49:26','2025-06-15 15:49:26'),(2,'Верещагін','Викладач','team_members/01JXT7E0YFNBQZM4EAJBNR25J3.png','2025-06-15 16:40:46','2025-06-15 16:40:46'),(3,'test','test','team_members/01JXT7EFB1KEWAYDP65H88PA89.gif','2025-06-15 16:41:01','2025-06-15 16:41:01'),(4,'321','321','team_members/01JXT7ESQM776MHWM0FWX376V3.gif','2025-06-15 16:41:11','2025-06-15 16:41:11');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
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
INSERT INTO `test_consultations` (`id`, `created_at`, `updated_at`) VALUES (1,'2025-06-16 01:03:27','2025-06-16 01:03:27');
/*!40000 ALTER TABLE `test_consultations` ENABLE KEYS */;
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
INSERT INTO `testimonials` (`id`, `alumni_id`, `text`, `created_at`, `updated_at`) VALUES (1,1,'Good\n','2025-06-15 15:38:01','2025-06-15 15:38:01');
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'student',
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `google_id`, `avatar`, `group`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES (1,'admin','admin@admin.com',NULL,'$2y$12$7mnnagJ61nMGRi/NUIy47uV4sg.Awn0CyyBGVOx8LNqS48HxkdrrW','admin',NULL,NULL,NULL,NULL,'NkLvWvJSLbWKRLVouj0UHmlWG4BlYtLYuUWLO4kEpSUfVQJzmlcOu6Cgu3qA','2025-05-26 13:48:57','2025-05-26 14:33:00'),(2,'222','222@gmail.com',NULL,'$2y$12$yXLzrjBfKEtTFqvWDJHKGOiBbD0IHzicwQ13E3SW2NW7/ptYCXzRG','student',NULL,NULL,'ІТ-21',NULL,NULL,'2025-05-26 16:11:05','2025-05-26 16:24:28'),(3,'Іванов Іван Іванович','ivanov@uzhnu.edu.ua',NULL,'$2y$12$7mnnagJ61nMGRi/NUIy47uV4sg.Awn0CyyBGVOx8LNqS48HxkdrrW','teacher',NULL,NULL,NULL,NULL,NULL,'2025-06-19 06:00:47','2025-06-19 06:00:47'),(4,'Петрова Марія Петрівна','petrova@uzhnu.edu.ua',NULL,'$2y$12$7mnnagJ61nMGRi/NUIy47uV4sg.Awn0CyyBGVOx8LNqS48HxkdrrW','teacher',NULL,NULL,NULL,NULL,NULL,'2025-06-19 06:00:47','2025-06-19 06:00:47'),(5,'Сидоров Сергій Сергійович','sidorov@uzhnu.edu.ua',NULL,'$2y$12$7mnnagJ61nMGRi/NUIy47uV4sg.Awn0CyyBGVOx8LNqS48HxkdrrW','teacher',NULL,NULL,NULL,NULL,NULL,'2025-06-19 06:00:47','2025-06-19 06:00:47'),(6,'Коваленко Олена Василівна','kovalenko@uzhnu.edu.ua',NULL,'$2y$12$7mnnagJ61nMGRi/NUIy47uV4sg.Awn0CyyBGVOx8LNqS48HxkdrrW','teacher',NULL,NULL,NULL,NULL,NULL,'2025-06-19 06:00:47','2025-06-19 06:00:47'),(7,'Тестовий Студент 1','student1@student.uzhnu.edu.ua',NULL,'$2y$12$7mnnagJ61nMGRi/NUIy47uV4sg.Awn0CyyBGVOx8LNqS48HxkdrrW','student',NULL,NULL,'ІТ-21','+380501234567',NULL,'2025-06-19 06:00:47','2025-06-19 06:00:47'),(8,'Тестовий Студент 2','student2@student.uzhnu.edu.ua',NULL,'$2y$12$7mnnagJ61nMGRi/NUIy47uV4sg.Awn0CyyBGVOx8LNqS48HxkdrrW','student',NULL,NULL,'ІТ-22','+380501234568',NULL,'2025-06-19 06:00:47','2025-06-19 06:00:47'),(9,'Тестовий Студент 3','student3@student.uzhnu.edu.ua',NULL,'$2y$12$7mnnagJ61nMGRi/NUIy47uV4sg.Awn0CyyBGVOx8LNqS48HxkdrrW','student',NULL,NULL,'ІТ-21','+380501234569',NULL,'2025-06-19 06:00:47','2025-06-19 06:00:47'),(11,'Іван Сергійович Леньовський','c.lenovskyi.ivan@student.uzhnu.edu.ua',NULL,NULL,'student','104977454649479922260','https://lh3.googleusercontent.com/a/ACg8ocIYd_fxsCj716Gb7KauTQw2P3SkcFwfxignNrUE41fl4olHsQ=s96-c',NULL,NULL,NULL,'2025-06-19 06:57:48','2025-06-19 06:57:48');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
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

-- Dump completed on 2025-06-19  7:00:02

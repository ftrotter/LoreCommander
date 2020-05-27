-- MySQL dump 10.16  Distrib 10.2.15-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: _zermelo_config
-- ------------------------------------------------------
-- Server version	10.2.15-MariaDB-10.2.15+maria~xenial-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_09_06_190440_create_meta',1),(2,'2019_03_11_095512_create_sockets_and_wrenches',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket`
--

DROP TABLE IF EXISTS `socket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wrench_id` int(11) NOT NULL,
  `socket_value` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `socket_label` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default_socket` tinyint(1) NOT NULL,
  `socketsource_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socket`
--

LOCK TABLES `socket` WRITE;
/*!40000 ALTER TABLE `socket` DISABLE KEYS */;
INSERT INTO `socket` VALUES (1,1,'jobTitle LIKE \'%engineer%\'','engineer',1,0,NULL,NULL),(2,1,'jobTitle LIKE \'%doctor%\'','doctor',0,0,NULL,NULL),(3,2,'stateProvince IN (\'TX\', \'CA\', \'FL\', \'NY\')','Large States (TX, FL, NY, CA)',1,0,NULL,NULL),(4,3,'DURC_northwind_data.order_2019','2019 data',1,0,NULL,NULL),(5,3,'DURC_northwind_data.order_2018','2018 data',0,0,NULL,NULL),(6,3,'DURC_northwind_data.order_2017','2017 data',0,0,NULL,NULL);
/*!40000 ALTER TABLE `socket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_user`
--

DROP TABLE IF EXISTS `socket_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socket_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `wrench_id` int(11) NOT NULL,
  `current_chosen_socket_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socket_user`
--

LOCK TABLES `socket_user` WRITE;
/*!40000 ALTER TABLE `socket_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `socket_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socketsource`
--

DROP TABLE IF EXISTS `socketsource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socketsource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `socketsource_name` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socketsource`
--

LOCK TABLES `socketsource` WRITE;
/*!40000 ALTER TABLE `socketsource` DISABLE KEYS */;
/*!40000 ALTER TABLE `socketsource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wrench`
--

DROP TABLE IF EXISTS `wrench`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wrench` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wrench_lookup_string` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wrench_label` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wrench`
--

LOCK TABLES `wrench` WRITE;
/*!40000 ALTER TABLE `wrench` DISABLE KEYS */;
INSERT INTO `wrench` VALUES (1,'DURC_job_title_filter','DURC_job_title_filter',NULL,NULL),(2,'DURC_big_state_filter','DURC_big_state_filter',NULL,NULL),(3,'DURC_order_year_db_table','DURC_order_year_db_table',NULL,NULL);
/*!40000 ALTER TABLE `wrench` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zermelo_meta`
--

DROP TABLE IF EXISTS `zermelo_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zermelo_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zermelo_meta`
--

LOCK TABLES `zermelo_meta` WRITE;
/*!40000 ALTER TABLE `zermelo_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `zermelo_meta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-27 13:38:13

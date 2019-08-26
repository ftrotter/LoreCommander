-- MySQL dump 10.16  Distrib 10.2.15-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: lore
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
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `last_name` (`last_name`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (1,'Liliana','Vess','2019-06-12 14:24:57','2019-06-12 04:27:20'),(2,'Ajani','Goldmane','2019-06-12 14:24:57','2019-06-12 04:30:49'),(3,'Aminatou','','2019-06-12 14:24:57','2019-06-12 04:31:17'),(4,'Angrath','','2019-06-12 14:24:57','2019-06-12 04:31:33'),(5,'Arlinn','Kord','2019-06-12 14:24:57','2019-06-12 04:31:48'),(6,'Ashiok','','2019-06-12 14:24:57','2019-06-12 04:32:28'),(7,'Chandra','Nalaar','2019-06-12 14:24:57','2019-06-12 04:33:01'),(8,'Dack','Fayden','2019-06-12 14:24:57','2019-06-12 04:33:16'),(9,'Daretti','','2019-06-12 14:24:57','2019-06-12 04:33:28'),(10,'Davreil','','2019-06-12 14:24:57','2019-06-12 04:33:48'),(11,'Domri','Rade','2019-06-12 14:24:57','2019-06-12 04:34:29'),(12,'Dovin','Baan','2019-06-12 14:24:57','2019-06-12 04:34:43'),(13,'Elspeth','Tirel','2019-06-12 14:24:57','2019-06-12 04:35:09'),(14,'Estrid','','2019-06-12 14:24:57','2019-06-12 04:36:02'),(15,'Freyalise','','2019-06-12 14:24:57','2019-06-12 04:36:15'),(16,'Garruk','Wildspeaker','2019-06-12 14:24:57','2019-06-12 04:36:32'),(17,'Gideon','Jura','2019-06-12 14:24:57','2019-06-12 04:37:28'),(18,'Huatli','','2019-06-12 14:24:57','2019-06-12 04:38:00'),(19,'Jace','Beleren','2019-06-12 14:24:57','2019-06-12 04:38:43'),(20,'Jaya','Ballard','2019-06-12 14:24:57','2019-06-12 04:39:32'),(21,'Jiang','Yanggu','2019-06-12 14:24:57','2019-06-12 04:39:53'),(22,'Karn','','2019-06-12 14:24:57','2019-06-12 04:40:18'),(23,'Kasmina','','2019-06-12 14:24:57','2019-06-12 04:41:17'),(24,'Kaya','','2019-06-12 14:24:57','2019-06-12 04:41:24'),(25,'Kiora','','2019-06-12 14:24:57','2019-06-12 04:41:40'),(26,'Koth','','2019-06-12 14:24:57','2019-06-12 04:41:51'),(27,'Kytheon','','2019-06-12 14:24:57','2019-06-12 04:42:21'),(28,'Lord','Windgrace','2019-06-12 14:24:57','2019-06-12 04:42:45'),(29,'Mu','Yanling','2019-06-12 14:24:57','2019-06-12 04:42:53'),(30,'Nahiri','','2019-06-12 14:24:57','2019-06-12 04:44:56'),(31,'Narset','','2019-06-12 14:24:57','2019-06-12 04:45:20'),(32,'Nicol','Bolas','2019-06-12 14:24:57','2019-06-12 04:45:36'),(33,'Nissa','Revane','2019-06-12 14:24:57','2019-06-12 04:46:02'),(34,'Ob','Nixilis','2019-06-12 14:24:57','2019-06-12 04:46:46'),(35,'Ral','Zarek','2019-06-12 14:24:57','2019-06-12 04:47:28'),(36,'Rowan','Kenrith','2019-06-12 14:24:57','2019-06-12 04:47:44'),(37,'Saheeli','Rai','2019-06-12 14:24:57','2019-06-12 04:47:58'),(38,'Samut','','2019-06-12 14:24:57','2019-06-12 04:48:19'),(39,'Sarkhan','Vol','2019-06-12 14:24:57','2019-06-12 04:48:47'),(40,'Serra','','2019-06-12 14:24:57','2019-06-12 04:48:56'),(41,'Sorin','Markov','2019-06-12 14:24:57','2019-06-12 04:49:16'),(42,'Tamiyo','','2019-06-12 14:24:57','2019-06-12 04:50:39'),(43,'Teferi','','2019-06-12 14:24:57','2019-06-12 04:50:56'),(44,'Teyo','','2019-06-12 14:24:57','2019-06-12 04:51:11'),(45,'Tezzeret','','2019-06-12 14:24:57','2019-06-12 04:52:12'),(46,'Tibalt','','2019-06-12 14:24:57','2019-06-12 04:52:30'),(47,'Ugin','','2019-06-12 14:24:57','2019-06-12 04:52:41'),(48,'Urza','','2019-06-12 14:24:57','2019-06-12 04:52:54'),(49,'Venser','','2019-06-12 14:24:57','2019-06-12 04:53:13'),(50,'Vivien','Reid','2019-06-12 14:24:57','2019-06-12 04:53:27'),(51,'Vraska','','2019-06-12 14:24:57','2019-06-12 04:54:24'),(52,'Will','Kenrith','2019-06-12 14:24:57','2019-06-12 04:54:39'),(53,'Wrenn','','2019-06-12 14:24:57','2019-06-12 04:55:06'),(54,'Xenagos','','2019-06-12 14:24:57','2019-06-12 04:55:16');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-25 21:49:04

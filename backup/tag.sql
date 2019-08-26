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
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  `is_directed` tinyint(1) NOT NULL DEFAULT 0,
  `excludes_tag_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`tag_name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'Enemy',0,2,'2019-06-12 05:02:12','2019-06-12 05:02:12'),(2,'Ally',0,1,'2019-06-12 05:02:12','2019-06-12 05:02:12'),(3,'Mutual Fear',0,0,'2019-08-25 19:18:56','2019-08-25 19:19:30'),(4,'Primary Affinity',0,5,'2019-08-25 19:20:04','2019-08-25 19:20:04'),(5,'Secondary Affinity',0,4,'2019-08-25 19:20:22','2019-08-25 19:20:22'),(6,'Friendship',0,0,'2019-08-25 19:20:41','2019-08-25 19:20:41'),(7,'Rivals',0,0,'2019-08-25 19:34:50','2019-08-25 19:34:50'),(8,'Hatred',0,0,'2019-08-25 19:34:59','2019-08-25 19:34:59'),(9,'Mutual Envy',0,0,'2019-08-25 19:35:29','2019-08-25 19:35:29'),(10,'Romance',0,0,'2019-08-25 19:35:29','2019-08-25 19:35:29');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-25 21:48:33

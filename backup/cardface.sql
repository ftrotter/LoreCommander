-- MariaDB dump 10.19  Distrib 10.5.15-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: lore
-- ------------------------------------------------------
-- Server version	10.5.15-MariaDB-1:10.5.15+maria~focal

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cardface`
--

DROP TABLE IF EXISTS `cardface`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cardface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `cardface_index` int(11) NOT NULL,
  `illustration_id` varchar(255) NOT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `color_identity` varchar(255) DEFAULT NULL,
  `flavor_text` varchar(1000) DEFAULT NULL,
  `image_uri` varchar(255) DEFAULT NULL,
  `mana_cost` varchar(255) DEFAULT NULL,
  `cmc` decimal(10,2) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `oracle_text` varchar(2000) DEFAULT NULL,
  `power` varchar(255) DEFAULT NULL,
  `toughness` varchar(255) DEFAULT NULL,
  `type_line` varchar(255) NOT NULL,
  `border_color` varchar(255) NOT NULL,
  `image_uri_art_crop` varchar(500) DEFAULT 'NULL',
  `image_hash_art_crop` varchar(32) DEFAULT 'NULL',
  `image_uri_small` varchar(500) DEFAULT NULL,
  `image_hash_small` varchar(32) DEFAULT NULL,
  `image_uri_normal` varchar(500) DEFAULT NULL,
  `image_hash_normal` varchar(32) DEFAULT NULL,
  `image_uri_large` varchar(500) DEFAULT NULL,
  `image_hash_large` varchar(32) DEFAULT NULL,
  `image_uri_png` varchar(500) DEFAULT NULL,
  `image_hash_png` varchar(32) DEFAULT NULL,
  `image_uri_border_crop` varchar(500) DEFAULT NULL,
  `image_hash_border_crop` varchar(32) DEFAULT NULL,
  `is_foil` tinyint(1) NOT NULL DEFAULT 0,
  `is_nonfoil` tinyint(1) NOT NULL DEFAULT 0,
  `is_oversized` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_green` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_red` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_blue` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_black` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_white` tinyint(1) NOT NULL DEFAULT 0,
  `is_colorless` tinyint(1) NOT NULL DEFAULT 0,
  `color_count` int(11) NOT NULL DEFAULT 0,
  `is_color_identity_green` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_identity_red` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_identity_blue` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_identity_black` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_identity_white` tinyint(1) NOT NULL DEFAULT 0,
  `color_identity_count` int(11) NOT NULL DEFAULT 0,
  `is_snow` tinyint(1) NOT NULL DEFAULT 0,
  `has_phyrexian_mana` tinyint(1) NOT NULL DEFAULT 0,
  `for_fulltext_search` varchar(2000) DEFAULT '''''',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`card_id`),
  KEY `is_color_green` (`is_color_green`),
  KEY `is_color_red` (`is_color_red`),
  KEY `is_color_blue` (`is_color_blue`),
  KEY `is_color_black` (`is_color_black`),
  KEY `is_color_white` (`is_color_white`),
  KEY `is_colorless` (`is_colorless`),
  FULLTEXT KEY `artist` (`artist`),
  FULLTEXT KEY `flavor_text` (`flavor_text`),
  FULLTEXT KEY `oracle_text` (`oracle_text`),
  FULLTEXT KEY `type_line` (`type_line`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `for_fulltext_search` (`for_fulltext_search`)
) ENGINE=MyISAM AUTO_INCREMENT=137381 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-31 22:19:44

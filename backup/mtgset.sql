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
-- Table structure for table `mtgset`
--

DROP TABLE IF EXISTS `mtgset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mtgset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scryfall_id` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `mtgo_code` varchar(255) DEFAULT NULL,
  `arena_code` varchar(255) DEFAULT NULL,
  `tcgplayer_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `set_type` varchar(255) NOT NULL,
  `released_at` date DEFAULT NULL,
  `block_code` varchar(255) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  `parent_set_code` varchar(255) DEFAULT NULL,
  `card_count` int(11) NOT NULL,
  `is_digital` tinyint(1) NOT NULL,
  `is_foil_only` tinyint(1) NOT NULL,
  `is_nonfoil_only` tinyint(1) DEFAULT NULL,
  `scryfall_uri` varchar(255) NOT NULL,
  `mtgset_uri` varchar(255) NOT NULL,
  `icon_svg_uri` varchar(255) NOT NULL,
  `search_uri` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `scryfall_id` (`scryfall_id`)
) ENGINE=MyISAM AUTO_INCREMENT=744 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-01  5:38:06

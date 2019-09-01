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
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scryfall_id` varchar(255) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `oracle_id` varchar(255) NOT NULL,
  `rulings_uri` varchar(255) NOT NULL,
  `scryfall_web_uri` varchar(255) NOT NULL,
  `scryfall_api_uri` varchar(255) NOT NULL,
  `layout` varchar(50) NOT NULL,
  `rarity` varchar(50) NOT NULL,
  `released_at` varchar(50) NOT NULL,
  `set_name` varchar(255) NOT NULL,
  `set_type` int(255) NOT NULL,
  `mtgset_id` int(11) NOT NULL,
  `variation_of_scryfall_id` varchar(255) DEFAULT 'NULL',
  `edhrec_rank` int(11) DEFAULT 0,
  `is_promo` tinyint(1) NOT NULL,
  `is_reserved` tinyint(1) DEFAULT NULL,
  `is_story_spotlight` tinyint(1) NOT NULL DEFAULT 0,
  `is_reprint` int(11) NOT NULL DEFAULT 0,
  `is_variation` tinyint(1) NOT NULL DEFAULT 0,
  `is_game_paper` tinyint(1) NOT NULL DEFAULT 0,
  `is_game_mtgo` tinyint(1) NOT NULL DEFAULT 0,
  `is_game_arena` tinyint(1) NOT NULL DEFAULT 0,
  `legal_oldschool` tinyint(1) NOT NULL DEFAULT 0,
  `legal_duel` tinyint(1) NOT NULL DEFAULT 0,
  `legal_commander` tinyint(1) NOT NULL DEFAULT 0,
  `legal_brawl` tinyint(1) NOT NULL DEFAULT 0,
  `legal_penny` tinyint(1) NOT NULL DEFAULT 0,
  `legal_vintage` tinyint(1) NOT NULL DEFAULT 0,
  `legal_pauper` tinyint(1) NOT NULL DEFAULT 0,
  `legal_legacy` tinyint(1) NOT NULL DEFAULT 0,
  `legal_modern` tinyint(1) NOT NULL DEFAULT 0,
  `legal_frontier` tinyint(1) NOT NULL DEFAULT 0,
  `legal_future` tinyint(1) NOT NULL DEFAULT 0,
  `legal_standard` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `scryfall_id` (`scryfall_id`,`mtgset_id`),
  KEY `set_name` (`set_name`),
  KEY `is_story_spotlight` (`is_story_spotlight`),
  KEY `is_game_paper` (`is_game_paper`),
  KEY `is_game_mtgo` (`is_game_mtgo`),
  KEY `is_game_arena` (`is_game_arena`),
  KEY `legal_commander` (`legal_commander`),
  KEY `legal_penny` (`legal_penny`),
  KEY `legal_modern` (`legal_modern`),
  KEY `legal_standard` (`legal_standard`)
) ENGINE=MyISAM AUTO_INCREMENT=44290 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-01  5:54:11

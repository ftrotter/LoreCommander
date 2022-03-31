/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `powertoughsource` (
  `scryfall_web_uri` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cmc` decimal(10,2) DEFAULT NULL,
  `power` decimal(10,0) DEFAULT NULL,
  `toughness` decimal(10,0) DEFAULT NULL,
  `power_plus_toughness` decimal(11,0) DEFAULT NULL,
  `is_color_identity_green` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_identity_red` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_identity_blue` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_identity_black` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_identity_white` tinyint(1) NOT NULL DEFAULT 0,
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

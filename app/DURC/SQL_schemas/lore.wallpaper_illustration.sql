/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallpaper_illustration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wallpaper_name` varchar(190) DEFAULT NULL,
  `wallpaper_id` int(11) DEFAULT NULL,
  `illustration_id` varchar(190) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

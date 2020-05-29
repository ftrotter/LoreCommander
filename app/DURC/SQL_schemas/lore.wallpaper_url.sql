/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallpaper_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wallpaper_id` int(11) NOT NULL,
  `wallpaper_url_name` varchar(190) NOT NULL,
  `wallpaper_url` varchar(190) NOT NULL,
  `is_highest_resolution` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `wallpaper_url` (`wallpaper_url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

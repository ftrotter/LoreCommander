/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallpaper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `art_name` varchar(190) DEFAULT NULL,
  `set_name` varchar(190) DEFAULT NULL,
  `art_release_date` datetime DEFAULT NULL,
  `author_name` varchar(190) NOT NULL,
  `illustration_id` varchar(190) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `art_name` (`art_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

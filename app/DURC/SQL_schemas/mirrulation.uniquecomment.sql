/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uniquecomment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `simplified_comment_text_md5` varchar(33) DEFAULT NULL,
  `simplified_comment_text` longtext NOT NULL,
  `comment_count` bigint(21) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `simplified_comment_text_md5` (`simplified_comment_text_md5`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

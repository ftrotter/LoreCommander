/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentId` varchar(100) NOT NULL,
  `comment_on_documentId` varchar(50) NOT NULL,
  `comment_date_text` varchar(50) NOT NULL,
  `comment_date` datetime DEFAULT NULL,
  `comment_text` longtext NOT NULL,
  `simplified_comment_text` longtext NOT NULL,
  `simplified_comment_text_md5` varchar(33) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `commentId` (`commentId`),
  KEY `md5 index` (`simplified_comment_text_md5`),
  FULLTEXT KEY `full_on_comment_index` (`comment_text`),
  FULLTEXT KEY `simplified_comment_text` (`simplified_comment_text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_cluster` (
  `unique_comment_id` int(11) NOT NULL,
  `other_unique_comment_id` int(11) NOT NULL,
  `score` decimal(7,5) NOT NULL,
  `diff_text` text DEFAULT NULL,
  PRIMARY KEY (`unique_comment_id`,`other_unique_comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

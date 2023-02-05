/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vspack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vspack_name` varchar(255) NOT NULL,
  `vspack_wizards_url` varchar(2000) NOT NULL,
  `vspack_wiki_url` varchar(2000) NOT NULL,
  `vspack_img_url` varchar(2000) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

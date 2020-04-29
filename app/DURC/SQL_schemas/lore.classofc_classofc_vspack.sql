/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classofc_classofc_vspack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classofc_id` int(11) NOT NULL,
  `second_classofc_id` int(11) NOT NULL,
  `vspack_id` int(11) NOT NULL,
  `is_bulk_linker` tinyint(1) NOT NULL DEFAULT 0,
  `link_note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `classofc_id` (`classofc_id`,`second_classofc_id`,`vspack_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

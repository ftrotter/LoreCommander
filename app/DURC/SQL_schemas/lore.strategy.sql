/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `strategy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strategy_name` varchar(255) NOT NULL,
  `strategy_description` varchar(2000) NOT NULL,
  `strategy_url` varchar(500) NOT NULL,
  `wincon_cardface_id` int(11) DEFAULT NULL,
  `WOTC_rule_reference` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

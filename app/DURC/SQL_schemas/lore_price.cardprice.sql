/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cardprice` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `scryfall_id` varchar(255) NOT NULL,
  `pricetype_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `card_id` (`card_id`),
  KEY `created_at` (`created_at`),
  KEY `card_id_2` (`card_id`,`pricetype_id`,`price`),
  KEY `pricetype_id` (`pricetype_id`,`price`),
  KEY `card_id_3` (`card_id`,`pricetype_id`),
  KEY `card_id_4` (`card_id`,`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

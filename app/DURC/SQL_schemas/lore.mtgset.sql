/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mtgset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scryfall_id` varchar(255) NOT NULL,
  `code` varchar(5) NOT NULL,
  `mtgo_code` varchar(255) DEFAULT NULL,
  `tcgplayer_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `set_type` varchar(255) NOT NULL,
  `released_at` varchar(255) NOT NULL,
  `block_code` varchar(255) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  `parent_set_code` varchar(255) DEFAULT NULL,
  `card_count` int(11) NOT NULL,
  `is_digital` tinyint(1) NOT NULL,
  `is_foil_only` tinyint(1) NOT NULL,
  `scryfall_uri` varchar(255) NOT NULL,
  `mtgset_uri` varchar(255) NOT NULL,
  `icon_svg_uri` varchar(255) NOT NULL,
  `search_uri` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `scryfall_id` (`scryfall_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

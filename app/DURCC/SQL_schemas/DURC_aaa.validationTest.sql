/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `validationTest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_tinyIntTrueFalse` tinyint(1) NOT NULL,
  `has_tinyIntTrueFalse` tinyint(1) NOT NULL,
  `thisDecimal` decimal(10,3) NOT NULL,
  `thisFloat` float NOT NULL,
  `thisDouble` double NOT NULL,
  `this_url` varchar(255) NOT NULL,
  `this_uuid` varchar(255) NOT NULL,
  `this_alpha` varchar(255) NOT NULL,
  `this_alpha_dash` varchar(255) NOT NULL,
  `this_alpha_num` varchar(255) NOT NULL,
  `this_email` varchar(255) NOT NULL,
  `this_ipv4` varchar(255) NOT NULL,
  `this_ipv6` varchar(255) NOT NULL,
  `this_json` varchar(1000) NOT NULL,
  `this_timezone` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uniquecomment_decomposed` (
  `node` varchar(255) DEFAULT NULL,
  `node_name` varchar(255) DEFAULT NULL,
  `node_type` varchar(255) DEFAULT NULL,
  `esse_id` int(11) NOT NULL,
  KEY `node` (`node`,`esse_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

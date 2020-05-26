/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_default_date` (
  `id` int(11) NOT NULL,
  `datetime_none` datetime NOT NULL,
  `date_none` date NOT NULL,
  `datetime_current` datetime NOT NULL DEFAULT current_timestamp(),
  `date_current` varchar(255) DEFAULT 'Current timestamp not supported for date',
  `datetime_null` datetime DEFAULT NULL,
  `date_null` date DEFAULT NULL,
  `datetime_defined` datetime NOT NULL DEFAULT '2000-01-01 01:23:45',
  `date_defined` date NOT NULL DEFAULT '2000-01-01',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_null_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `null_var` varchar(255) DEFAULT NULL,
  `non_null_var_def` varchar(255) NOT NULL,
  `non_null_var_no_def` varchar(255) DEFAULT NULL,
  `nullable_w_default` varchar(255) DEFAULT 'THIS IS THE DEFAULT',
  `non_null_default` varchar(255) NOT NULL DEFAULT 'I CANNOT BE NULL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

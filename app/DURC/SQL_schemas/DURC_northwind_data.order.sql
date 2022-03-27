/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `orderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `shippedDate` datetime DEFAULT NULL,
  `shipper_id` int(11) DEFAULT NULL,
  `shipName` varchar(50) DEFAULT NULL,
  `shipAddress` longtext DEFAULT NULL,
  `shipCity` varchar(50) DEFAULT NULL,
  `shipStateProvince` varchar(50) DEFAULT NULL,
  `shipZipPostalCode` varchar(50) DEFAULT NULL,
  `shipCountryRegion` varchar(50) DEFAULT NULL,
  `shippingFee` decimal(19,4) DEFAULT 0.0000,
  `taxes` decimal(19,4) DEFAULT 0.0000,
  `paymentType` varchar(50) DEFAULT NULL,
  `paidDate` datetime DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `taxRate` double DEFAULT 0,
  `taxStatus_id` tinyint(4) DEFAULT NULL,
  `status_id` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `employee_id` (`employee_id`),
  KEY `id` (`id`),
  KEY `shipper_id` (`shipper_id`),
  KEY `taxStatus` (`taxStatus_id`),
  KEY `shipZipPostalCode` (`shipZipPostalCode`),
  KEY `fkOrderOrderStatus1` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

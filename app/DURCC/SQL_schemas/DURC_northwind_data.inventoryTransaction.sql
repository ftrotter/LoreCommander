/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventoryTransaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transactionType` tinyint(4) NOT NULL,
  `transactionCreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `transactionModifiedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchaseOrder_id` int(11) DEFAULT NULL,
  `customerOrder_id` int(11) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customerOrder_id` (`customerOrder_id`),
  KEY `product_id` (`product_id`),
  KEY `purchaseOrder_id` (`purchaseOrder_id`),
  KEY `transactionType` (`transactionType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

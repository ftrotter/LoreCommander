/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderDetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` decimal(18,4) NOT NULL DEFAULT 0.0000,
  `unitPrice` decimal(19,4) DEFAULT 0.0000,
  `discount` double NOT NULL DEFAULT 0,
  `status_id` int(11) DEFAULT NULL,
  `dateAllocated` datetime DEFAULT NULL,
  `PurchaseOrder_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `inventory_id` (`inventory_id`),
  KEY `product_id` (`product_id`),
  KEY `purchaseOrder_id` (`PurchaseOrder_id`),
  KEY `fkOrderDetailOrder1_idx` (`order_id`),
  KEY `fkOrderDetailOrderDetailStatus1_idx` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

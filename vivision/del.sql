DROP TABLE IF EXISTS `tabMak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tabMak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` float NOT NULL,
  `longi` float NOT NULL,
  `city` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `virtual` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabMak`
--

LOCK TABLES `tabMak` WRITE;
/*!40000 ALTER TABLE `tabMak` DISABLE KEYS */;
INSERT INTO `tabMak` VALUES (1,39.4393,-9.20652,'Caldas da Rainha',1),(2,38.6933,-9.3304,'Lisboa - Oeiras',1),(3,39.2278,-8.75702,'Santarém',1),(4,39.7599,-8.83686,'Leiria',1),(5,41.1621,-8.65697,'Porto',1),(6,41.5473,-8.44644,'Braga',1),(7,37.0918,-7.9365,'Faro',1);
/*!40000 ALTER TABLE `tabMak` ENABLE KEYS */;
UNLOCK TABLES;

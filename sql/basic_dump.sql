-- MySQL dump 10.13  Distrib 5.6.23, for Win32 (x86)
--
-- Host: localhost    Database: oet2
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `pwhash` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `active` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `arrivelogs`
--

DROP TABLE IF EXISTS `arrivelogs`;
/*!50001 DROP VIEW IF EXISTS `arrivelogs`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `arrivelogs` AS SELECT 
 1 AS `routeid`,
 1 AS `routepointid`,
 1 AS `stoptime`,
 1 AS `stopnr`,
 1 AS `logtime`,
 1 AS `name`,
 1 AS `lat`,
 1 AS `lon`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `busstops`
--

DROP TABLE IF EXISTS `busstops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `busstops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lon` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_busstops_name` (`name`(10)),
  KEY `idx_busstops_lat` (`lat`),
  KEY `idx_busstops_lon` (`lon`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `busstops`
--

LOCK TABLES `busstops` WRITE;
/*!40000 ALTER TABLE `busstops` DISABLE KEYS */;
INSERT INTO `busstops` VALUES (3,'Großwilfersdorf Postamt',47.0774,15.9946),(4,'Hainfeld b. Fürstenfeld',47.0745,15.974),(5,'Neudorf b. Ilz Bundesstraße',47.0833,15.943),(6,'Ilz Hauptplatz',47.0865,15.9273),(7,'Dörfl b. Ilz',47.0903,15.9101),(8,'Mutzenfeld Bundesstraße/Abzw Ort',47.089,15.8956),(9,'Nestelbach im Ilztal Marterer',47.0914,15.8817),(10,'Bla',1,2),(11,'Stop1',15,13),(12,'Stop1',15.1,13.07),(13,'Stop2',15.1,13.07),(14,'Stop3',15.07,13.09),(15,'Stop3',15.07,13.09),(16,'stop4',15.1,13.1),(17,'stop4',15.1,13.1),(18,'1',1,1),(19,'6',2,3);
/*!40000 ALTER TABLE `busstops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drivelogs`
--

DROP TABLE IF EXISTS `drivelogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drivelogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `routeid` int(11) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lon` float DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `loggerid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_drivelogs_routes` (`routeid`),
  KEY `fk_drivelogs_loggers` (`loggerid`),
  KEY `idx_drivelogs_logtime` (`logtime`),
  CONSTRAINT `fk_drivelogs_loggers` FOREIGN KEY (`loggerid`) REFERENCES `loggers` (`id`),
  CONSTRAINT `fk_drivelogs_routes` FOREIGN KEY (`routeid`) REFERENCES `routes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivelogs`
--

LOCK TABLES `drivelogs` WRITE;
/*!40000 ALTER TABLE `drivelogs` DISABLE KEYS */;
INSERT INTO `drivelogs` VALUES (6,2,47.058,15.4436,'2015-03-12 19:49:22',1),(7,2,47.058,15.4436,'2015-03-12 19:49:32',1),(8,2,47.0916,15.8813,'2015-03-12 19:49:46',1),(9,2,47.0912,15.8829,'2015-03-12 19:49:56',1),(10,2,47.0908,15.8852,'2015-03-12 19:50:06',1),(11,2,47.0903,15.8872,'2015-03-12 19:50:16',1),(12,2,47.0899,15.8895,'2015-03-12 19:50:26',1),(13,2,47.0898,15.8902,'2015-03-12 19:50:36',1),(14,2,47.0895,15.8917,'2015-03-12 19:50:46',1),(15,2,47.0891,15.8948,'2015-03-12 19:50:56',1),(16,2,47.0891,15.8954,'2015-03-12 19:51:06',1),(17,2,47.0891,15.8954,'2015-03-12 19:51:16',1),(18,2,47.0892,15.8983,'2015-03-12 19:51:26',1),(19,2,47.0894,15.901,'2015-03-12 19:51:36',1),(20,2,47.0903,15.9039,'2015-03-12 19:51:46',1),(21,2,47.0909,15.9068,'2015-03-12 19:51:56',1),(22,2,47.0906,15.9091,'2015-03-12 19:52:06',1),(23,2,47.0905,15.9094,'2015-03-12 19:52:16',1),(24,2,47.0905,15.9094,'2015-03-12 19:52:26',1),(25,2,47.0899,15.9112,'2015-03-12 19:52:36',1),(26,2,47.089,15.9136,'2015-03-12 19:52:46',1),(27,2,47.0879,15.9157,'2015-03-12 19:52:56',1),(28,2,47.0872,15.9178,'2015-03-12 19:53:06',1),(29,2,47.0871,15.922,'2015-03-12 19:53:17',1),(30,2,47.087,15.9219,'2015-03-12 19:53:26',1);
/*!40000 ALTER TABLE `drivelogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loggers`
--

DROP TABLE IF EXISTS `loggers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loggers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `pwhash` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `active` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loggers`
--

LOCK TABLES `loggers` WRITE;
/*!40000 ALTER TABLE `loggers` DISABLE KEYS */;
INSERT INTO `loggers` VALUES (1,'test','7110eda4d09e062aa5e4a390b0a572ac0d2c0220','test@oeffitrack.com','Y');
/*!40000 ALTER TABLE `loggers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routelogs`
--

DROP TABLE IF EXISTS `routelogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `routelogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `routepointid` int(11) DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lon` float DEFAULT NULL,
  `loggerid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_routelogs_routepoints` (`routepointid`),
  KEY `idx_routelogs_logtime` (`logtime`),
  CONSTRAINT `fk_routelogs_routepoints` FOREIGN KEY (`routepointid`) REFERENCES `routepoints` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routelogs`
--

LOCK TABLES `routelogs` WRITE;
/*!40000 ALTER TABLE `routelogs` DISABLE KEYS */;
INSERT INTO `routelogs` VALUES (2,1,'2015-03-12 19:49:46',47.0916,15.8813,1),(3,2,'2015-03-12 19:51:06',47.0891,15.8954,1),(4,3,'2015-03-12 19:52:16',47.0905,15.9094,1);
/*!40000 ALTER TABLE `routelogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routepoints`
--

DROP TABLE IF EXISTS `routepoints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `routepoints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `routeid` int(11) DEFAULT NULL,
  `busstopid` int(11) DEFAULT NULL,
  `stopnr` int(11) DEFAULT NULL,
  `stoptime` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_stopnr_routeid` (`routeid`,`stopnr`),
  KEY `fk_routepoints_busstops` (`busstopid`),
  CONSTRAINT `fk_routepoints_busstops` FOREIGN KEY (`busstopid`) REFERENCES `busstops` (`id`),
  CONSTRAINT `fk_routepoints_routes` FOREIGN KEY (`routeid`) REFERENCES `routes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routepoints`
--

LOCK TABLES `routepoints` WRITE;
/*!40000 ALTER TABLE `routepoints` DISABLE KEYS */;
INSERT INTO `routepoints` VALUES (1,2,9,1,'09:10:00'),(2,2,8,2,'09:12:00'),(3,2,7,3,'09:14:00'),(4,2,6,4,'09:15:00'),(5,2,5,5,'09:16:00'),(6,2,4,6,'09:18:00'),(7,2,3,7,'09:20:00');
/*!40000 ALTER TABLE `routepoints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes`
--

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` VALUES (2,'Nestelbach-Großwilfersdorf');
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `routestations`
--

DROP TABLE IF EXISTS `routestations`;
/*!50001 DROP VIEW IF EXISTS `routestations`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `routestations` AS SELECT 
 1 AS `routepointid`,
 1 AS `stopnr`,
 1 AS `stoptime`,
 1 AS `routeid`,
 1 AS `name`,
 1 AS `lat`,
 1 AS `lon`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `arrivelogs`
--

/*!50001 DROP VIEW IF EXISTS `arrivelogs`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `arrivelogs` AS select `rp`.`routeid` AS `routeid`,`rp`.`id` AS `routepointid`,`rp`.`stoptime` AS `stoptime`,`rp`.`stopnr` AS `stopnr`,`rl`.`logtime` AS `logtime`,`bs`.`name` AS `name`,`bs`.`lat` AS `lat`,`bs`.`lon` AS `lon` from ((`routelogs` `rl` join `routepoints` `rp`) join `busstops` `bs`) where ((`rl`.`routepointid` = `rp`.`id`) and (`rp`.`busstopid` = `bs`.`id`)) order by `rp`.`routeid`,`rp`.`stopnr` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `routestations`
--

/*!50001 DROP VIEW IF EXISTS `routestations`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `routestations` AS select `rp`.`id` AS `routepointid`,`rp`.`stopnr` AS `stopnr`,`rp`.`stoptime` AS `stoptime`,`rp`.`routeid` AS `routeid`,`bs`.`name` AS `name`,`bs`.`lat` AS `lat`,`bs`.`lon` AS `lon` from (`routepoints` `rp` join `busstops` `bs`) where (`rp`.`busstopid` = `bs`.`id`) order by `rp`.`routeid`,`rp`.`stopnr` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-18 21:39:59

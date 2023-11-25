-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: heyagri
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `planting_dates`
--

DROP TABLE IF EXISTS `planting_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planting_dates` (
  `plant_id` int NOT NULL,
  `date_id` int NOT NULL,
  `days_difference` varchar(255) DEFAULT NULL,
  `days_to_start` date DEFAULT NULL,
  `days_to_end` date DEFAULT NULL,
  PRIMARY KEY (`plant_id`,`date_id`),
  KEY `date_id` (`date_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planting_dates`
--

LOCK TABLES `planting_dates` WRITE;
/*!40000 ALTER TABLE `planting_dates` DISABLE KEYS */;
INSERT INTO `planting_dates` VALUES (2,1,'15','2023-01-01','2023-01-16'),(2,2,'30','2023-01-16','2023-02-15'),(3,1,'15','2023-02-01','2023-02-16'),(3,2,'30','2023-02-16','2023-03-18'),(4,1,'15','2023-03-01','2023-03-16'),(4,2,'30','2023-03-16','2023-04-15'),(5,1,'15','2023-04-01','2023-04-16'),(5,2,'30','2023-04-16','2023-05-16'),(17,1,'15','2023-05-01','2023-05-16'),(17,2,'30','2023-05-16','2023-06-15'),(33,1,'15','2023-06-01','2023-06-16'),(33,2,'30','2023-06-16','2023-07-16'),(42,1,'15','2023-07-01','2023-07-16'),(42,2,'30','2023-07-16','2023-08-15'),(43,1,'15','2023-08-01','2023-08-16'),(43,2,'30','2023-08-16','2023-09-15'),(49,1,'15','2023-09-01','2023-09-16'),(49,2,'30','2023-09-16','2023-10-16'),(51,1,'15','2023-10-01','2023-10-16'),(51,2,'30','2023-10-16','2023-11-15');
/*!40000 ALTER TABLE `planting_dates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-25 11:24:41

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
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `image_id` int NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `image_section` varchar(255) DEFAULT NULL,
  `plant_id` int DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `plant_id` (`plant_id`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`plant_id`) REFERENCES `plants_id` (`plant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'db_img/basil_adult.jpg','adulte',2),(2,'db_img/basil_baby.jpg','baby',2),(3,'db_img/basil_watering.jpg','watering',2),(4,'db_img/basil_harvest.jpg','harvest',2),(5,'db_img/beans_adult.jpg','adulte',3),(6,'db_img/beans_baby.jpg','baby',3),(7,'db_img/beans_watering.jpg','watering',3),(8,'db_img/beans_harvest.jpg','harvest',3),(9,'db_img/bell_pepper_adult.jpg','adulte',4),(10,'db_img/bell_pepper_baby.jpg','baby',4),(11,'db_img/bell_pepper_watering.jpg','watering',4),(12,'db_img/bell_pepper_harvest.jpg','harvest',4),(13,'db_img/borage_adult.jpg','adulte',5),(14,'db_img/borage_baby.jpg','baby',5),(15,'db_img/borage_watering.jpg','watering',5),(16,'db_img/borage_harvest.jpg','harvest',5),(17,'db_img/cucumber_adult.jpg','adulte',17),(18,'db_img/cucumber_baby.jpg','baby',17),(19,'db_img/cucumber_watering.jpg','watering',17),(20,'db_img/cucumber_harvest.jpg','harvest',17),(21,'db_img/nasturtium_adult.jpg','adulte',33),(22,'db_img/nasturtium_baby.jpg','baby',33),(23,'db_img/nasturtium_watering.jpg','watering',33),(24,'db_img/nasturtium_harvest.jpg','harvest',33),(25,'db_img/red_leaf_lettuce_adult.jpg','adulte',42),(26,'db_img/red_leaf_lettuce_baby.jpg','baby',42),(27,'db_img/red_leaf_lettuce_watering.webp','watering',42),(28,'db_img/red_leaf_lettuce_harvest.jpg','harvest',42),(29,'db_img/rosemary_adult.jpg','adulte',43),(30,'db_img/rosemary_baby.jpg','baby',43),(31,'db_img/rosemary_watering.jpg','watering',43),(32,'db_img/rosemary_harvest.jpg','harvest',43),(33,'db_img/swiss_chard_adult.jpg','adulte',49),(34,'db_img/swiss_chard_baby.jpg','baby',49),(35,'db_img/swiss_chard_watering.jpg','watering',49),(36,'db_img/swiss_chard_harvest.jpg','harvest',49),(37,'db_img/tomato_adult.jpg','adulte',51),(38,'db_img/tomato_baby.jpg','baby',51),(39,'db_img/tomato_watering.jpg','watering',51),(40,'db_img/tomato_harvest.jpg','harvest',51);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
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

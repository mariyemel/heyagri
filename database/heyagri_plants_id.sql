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
-- Table structure for table `plants_id`
--

DROP TABLE IF EXISTS `plants_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plants_id` (
  `plant_id` int NOT NULL,
  `plant_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`plant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plants_id`
--

LOCK TABLES `plants_id` WRITE;
/*!40000 ALTER TABLE `plants_id` DISABLE KEYS */;
INSERT INTO `plants_id` VALUES (1,'Asparagus'),(2,'Basil'),(3,'Beans'),(4,'Bell Pepper'),(5,'Borage'),(6,'Broccoli'),(7,'Brussels Sprouts'),(8,'Cabbage'),(9,'Calendula'),(10,'Carrot'),(11,'Cauliflower'),(12,'Celery'),(13,'Chamomile'),(14,'Chives'),(15,'Cilantro'),(16,'Corn'),(17,'Cucumber'),(18,'Dill'),(19,'Eggplant'),(20,'Fennel'),(21,'Fruit Trees'),(22,'Garlic'),(23,'Kale'),(24,'Kohlrabi'),(25,'Lavender'),(26,'Leeks'),(27,'Lemon balm'),(28,'Lettuce'),(29,'Marigold'),(30,'Marjoram'),(31,'Melon'),(32,'Mint'),(33,'Nasturtium'),(34,'Onion'),(35,'Oregano'),(36,'Parsley'),(37,'Peas'),(38,'Peppers'),(39,'Potato'),(40,'Pumpkins'),(41,'Radishes'),(42,'Red Leaf Lettuce'),(43,'Rosemary'),(44,'Sage'),(45,'Spinach'),(46,'Squash'),(47,'Strawberries'),(48,'Sunflowers'),(49,'Swiss Chard'),(50,'Thyme'),(51,'Tomato'),(52,'Walnuts'),(53,'Zucchini');
/*!40000 ALTER TABLE `plants_id` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-25 11:24:40

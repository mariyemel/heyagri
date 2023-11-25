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
-- Table structure for table `pest_diseases`
--

DROP TABLE IF EXISTS `pest_diseases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pest_diseases` (
  `pest_id` int NOT NULL,
  `pest_name` varchar(255) NOT NULL,
  `pest_description` text,
  PRIMARY KEY (`pest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pest_diseases`
--

LOCK TABLES `pest_diseases` WRITE;
/*!40000 ALTER TABLE `pest_diseases` DISABLE KEYS */;
INSERT INTO `pest_diseases` VALUES (1,'Aphid','Small sap-sucking insects that can cause damage to plants.'),(2,'Whitefly','Small, winged insects that feed on the undersides of plant leaves.'),(3,'Spider Mite','Tiny spiders that cause yellowing of leaves.'),(4,'Fungal Gnats','Small insects that thrive in moist soil conditions.'),(5,'Thrips','Slender insects that feed on many types of plants.'),(6,'Caterpillar','The larval stage of butterflies and moths.'),(7,'Slugs','Gastropods that eat leaves and can cause plant damage.'),(8,'Snails','Similar to slugs, but with a shell, known to eat plant material.'),(9,'Leafminer','Insects that create tunnels in leaves.'),(10,'Beetle','Hard-shelled insects that can eat leaves and roots.');
/*!40000 ALTER TABLE `pest_diseases` ENABLE KEYS */;
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

-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: epignosis
-- ------------------------------------------------------
-- Server version	8.0.20-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `submit_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `reason` text,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,'2020-06-18 10:43:55','2020-08-20 00:00:00','2020-08-30 00:00:00','Other','approved',2),(2,'2020-06-18 10:43:58','2020-08-20 00:00:00','2020-08-30 00:00:00','Other','approved',2),(3,'2020-06-18 10:44:17','2020-06-19 00:00:00','2020-06-19 00:00:00',NULL,'approved',4),(4,'2020-06-18 10:45:03','2020-06-26 00:00:00','2020-06-19 00:00:00',NULL,'approved',2),(5,'2020-06-18 10:46:31','2020-06-19 00:00:00','2020-06-27 00:00:00','asdasdasd','approved',2),(6,'2020-06-18 11:01:18','2020-06-27 00:00:00','2020-06-19 00:00:00','asdasd','approved',2),(7,'2020-06-18 11:16:00','2020-06-17 00:00:00','2020-06-27 00:00:00','asdasdasd','approved',2),(8,'2020-06-18 11:17:53','2020-06-17 00:00:00','2020-06-20 00:00:00','asdasdasd','approved',2),(9,'2020-06-18 11:19:45','2020-06-17 00:00:00','2020-06-20 00:00:00','asdasdasd','approved',4),(10,'2020-06-18 11:42:05','2020-06-19 00:00:00','2020-06-25 00:00:00','test test','approved',2),(11,'2020-06-18 11:43:26','2020-06-17 00:00:00','2020-06-20 00:00:00','asdasdasd','approved',2),(12,'2020-06-18 11:53:58','2020-06-19 00:00:00','2020-06-30 00:00:00','illness','approved',2),(13,'2020-06-18 11:55:18','2020-06-26 00:00:00','2020-06-27 00:00:00','asdasdasd','approved',2),(14,'2020-06-18 12:01:11','2020-06-26 00:00:00','2020-06-30 00:00:00','qweqweqwe','approved',2),(15,'2020-06-18 12:04:43','2020-06-17 00:00:00','2020-06-30 00:00:00','asdasdasd','approved',2),(16,'2020-06-18 12:37:00','2020-06-25 00:00:00','2020-06-27 00:00:00','asdasd','pending',2),(17,'2020-06-18 12:37:34','2020-06-25 00:00:00','2020-06-27 00:00:00','asdasd','pending',2),(18,'2020-06-18 12:37:37','2020-06-25 00:00:00','2020-06-27 00:00:00','asdasdasfsf','pending',2),(19,'2020-06-18 12:37:49','2020-06-25 00:00:00','2020-06-27 00:00:00','asdasdasfsf','pending',2),(20,'2020-06-18 12:38:21','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','pending',2),(21,'2020-06-18 12:38:37','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','pending',2),(22,'2020-06-18 12:38:54','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','pending',2),(23,'2020-06-18 12:38:57','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','pending',2),(24,'2020-06-18 12:39:03','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','pending',2),(25,'2020-06-18 12:39:16','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','pending',2),(26,'2020-06-18 12:39:20','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','pending',2),(27,'2020-06-18 12:39:48','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','approved',2),(28,'2020-06-18 12:40:15','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','pending',2),(29,'2020-06-18 12:40:36','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','approved',2),(30,'2020-06-18 12:41:04','2020-06-18 00:00:00','2020-06-26 00:00:00','asf','pending',2),(31,'2020-06-18 12:42:35','2020-06-18 00:00:00','2020-06-27 00:00:00','asd','pending',2),(32,'2020-06-18 12:46:20','2020-06-17 00:00:00','2020-07-29 00:00:00','tra','pending',2),(33,'2020-06-18 12:51:27','2020-06-17 00:00:00','2020-06-27 00:00:00','asdasdasd','pending',2),(34,'2020-06-18 12:53:11','2020-06-10 00:00:00','2020-08-21 00:00:00','asfasf','approved',2),(35,'2020-06-18 13:00:57','2020-06-05 00:00:00','2020-06-26 00:00:00','asfasf','pending',2);
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'george','iliadis','geoili@gmail.com','$2y$10$.V0sqmkZ9gXlTkO86j5Y9uK3/D1103lfOogpp501RSJvW/VIMjnES',1),(2,'testakis','testopoulos','testakis@gmail.com','$2y$10$ES566QaF.Ijn4PJx.Jpd1udiEbq4LA1rMMoEN9Ufpl6KiZYnvIG46',0),(4,'Obelix','Asterix','test@gmail.com','$2y$10$pP34/H.eeGxN/Rcue7mx3uq6/wodmLVl0ELNKElb7A1llscx2jj6S',0),(6,'someone','else','someone@else.com','$2y$10$VquhY2iilaAD251loDSicuR5yeOs6vMKI6fd1RAt6uYnfkWaSbu1i',0),(7,'testuser','testuser','testuser@gmail.com','$2y$10$4cAkgTJO8r3.TkUPjdFrT.106f124OwB6ybQtEjEfapxkudsv5nmC',0),(8,'testuser1','testuser1','testuser1@gmail.com','$2y$10$gjawkQ8ciHkJT4yMNyFaS..rmNV/0VVkl/lxejAiqcrORKUjhv.j6',0),(9,'babis25','proinbabis5','proinbabi5s@gmail.com','$2y$10$VNr8C3nx9hesK.HgoUrkk.ChuGTgFpvJnv6DRt3krohqP8rh1b5Eu',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-18 14:43:44

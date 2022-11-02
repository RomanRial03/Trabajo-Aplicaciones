-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: barberia
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `disponibilidad`
--
CREATE DATABASE `barberia` /*!40100 DEFAULT CHARACTER SET utf8 */;
use barberia;

DROP TABLE IF EXISTS `disponibilidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disponibilidad` (
  `dia` int(11) NOT NULL,
  `hora_real` datetime NOT NULL,
  PRIMARY KEY (`dia`,`hora_real`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disponibilidad`
--

LOCK TABLES `disponibilidad` WRITE;
/*!40000 ALTER TABLE `disponibilidad` DISABLE KEYS */;
INSERT INTO `disponibilidad` VALUES (0,'2000-01-05 00:00:00'),(1,'2000-01-05 15:00:00'),(1,'2000-01-05 15:45:00'),(1,'2000-01-05 16:30:00'),(1,'2000-01-05 17:15:00'),(1,'2000-01-05 18:00:00'),(1,'2000-01-05 18:45:00'),(1,'2000-01-05 19:30:00'),(1,'2000-01-05 20:15:00'),(1,'2000-01-05 21:00:00'),(2,'2000-01-05 19:00:00'),(2,'2000-01-05 19:45:00'),(2,'2000-01-05 20:30:00'),(3,'2000-01-05 19:00:00'),(3,'2000-01-05 19:45:00'),(3,'2000-01-05 20:30:00'),(4,'2000-01-05 19:00:00'),(4,'2000-01-05 19:45:00'),(4,'2000-01-05 20:30:00'),(5,'2000-01-05 17:00:00'),(5,'2000-01-05 17:45:00'),(5,'2000-01-05 18:30:00'),(5,'2000-01-05 19:15:00'),(5,'2000-01-05 20:00:00');
/*!40000 ALTER TABLE `disponibilidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocupados`
--

DROP TABLE IF EXISTS `ocupados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocupados` (
  `fechayhora` datetime NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`fechayhora`),
  KEY `ocupados_usuarios_idx` (`id_usuario`),
  CONSTRAINT `ocupados_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocupados`
--

LOCK TABLES `ocupados` WRITE;
/*!40000 ALTER TABLE `ocupados` DISABLE KEYS */;
/*!40000 ALTER TABLE `ocupados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo_electronico` varchar(70) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'macaco','Klein','lologre@asdsada','0'),(5,'manito','prueba','hola@asd','0'),(6,'Hugo','Klein','hugo@klein.com','1234'),(7,'Hugo','Klein','hugo@klein.com','1234'),(8,'Hugo','Klein','hugo@klein.com.2','1234'),(9,'Hugo','Klein','hugo@klein.com.3','1234'),(10,'Hugo','Klein','hugo@klein.comasdasd','0'),(11,'macaco','Klein','macaco@sadas','0'),(12,'hugo','klein','xxxx','1234'),(13,'hugo','klein','xxxxx','1234'),(14,'34324','342342342','24234233','23423'),(15,'4444','dfgdfg','','0'),(16,'dfgyh','sdfgsdfg','sdfgsdfgs','0'),(17,'sadfsda','fasdfsdafasd','fsdafsdafasd','0'),(18,'sdfasd','fasdasdfasdf','fasd','0'),(19,'asdfsdf','sdfdsfds','fsdfsdfsd','0'),(20,'sdfg','fsdsdf','sdfsdf','0'),(21,'sdfsd','sdfsdf','sdfsdfsd','0'),(22,'asdfsda','fsadfsd','fsdfsd','0'),(23,'dfgdfgdf','dfgfdgg','dfgdfgdf','0'),(24,'asdfasdf','asdasdfasd','fasasdffd','0'),(25,'dxfsdf','sfsdfsdfd','sdfsdfsdf','0'),(26,'sdfdsdfsadf','fasdfasd','asdfasdfasd','0'),(27,'sdfasdfa','sdfasdfasd','fasdfasdfas','0'),(28,'asdfasdf','asdfasdf','afasdfasdds','0'),(29,'dddd','df','fdfdf','0'),(30,'asdfasd','fasdfasdf','asdfasdf','0'),(31,'sdf','fsdfsdfsdfsd','sdfdsfsdf','0'),(32,'hugo','klein','hhh','0'),(33,'sadfasdf','asdfasdfasd','hhhdf','0'),(34,'sadfsdfsd','sdfsdfds','xxx','0'),(35,'dfsdfsd','fsdfsdf','sdfsddd','0'),(36,'dfgdfgdf','gdfgdfgdf','gdfdfgdfg','0'),(37,'dfgdfsgsdf','gsdfgsdf','gsdfgsdfg','0'),(38,'dzxfbv','xcvxcv','nvcbn','0'),(39,'sadfsadf','asdfasdf','sadfsadf','0'),(40,'sdfsadf','sadfasdf','afasdfsdds','0'),(41,'sdfsadf','sadfasdf','sdfsdfsdfsd','0'),(42,'sdfsadf','sadfasdf','sdfsdfsdfsdfsdafsd','0'),(43,'sdfsadf','sadfasdf','sdfsdfsdfsdfsdafsdsdf asdfsed af','0'),(44,'asdfasedf','fsdfg','q','0');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-02  0:44:45

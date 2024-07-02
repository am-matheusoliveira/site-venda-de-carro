

DROP DATABASE IF EXISTS cfb_veiculos;

CREATE DATABASE cfb_veiculos
DEFAULT CHARACTER SET utf8mb4
DEFAULT COLLATE utf8mb4_general_ci;

USE cfb_veiculos;

-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: cfb_veiculos
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `tb_carros`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_carros` (
  `id_carro` int NOT NULL AUTO_INCREMENT,
  `id_marca` int NOT NULL,
  `id_modelo` int NOT NULL,
  `id_modelo_versao` int NOT NULL,
  `versao` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ano_fab` int NOT NULL,
  `ano_mod` int NOT NULL,
  `obs` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `valor` float NOT NULL,
  `foto1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `min3` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `min4` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `opc1` int DEFAULT NULL,
  `opc2` int DEFAULT NULL,
  `opc3` int DEFAULT NULL,
  `vendido` int DEFAULT NULL,
  `bloqueado` int DEFAULT NULL,
  `qtd_visitas` int DEFAULT NULL,
  PRIMARY KEY (`id_carro`),
  KEY `fk_tb_carros_tb_marcas` (`id_marca`),
  KEY `fk_tb_carros_tb_modelos` (`id_modelo`),
  KEY `fk_tb_carros_tb_modelo_versoes` (`id_modelo_versao`),
  CONSTRAINT `fk_tb_carros_tb_marcas` FOREIGN KEY (`id_marca`) REFERENCES `tb_marcas` (`id_marca`),
  CONSTRAINT `fk_tb_carros_tb_modelo_versoes` FOREIGN KEY (`id_modelo_versao`) REFERENCES `tb_modelo_versoes` (`id_modelo_versao`),
  CONSTRAINT `fk_tb_carros_tb_modelos` FOREIGN KEY (`id_modelo`) REFERENCES `tb_modelos` (`id_modelo`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_carros`
--

LOCK TABLES `tb_carros` WRITE;
/*!40000 ALTER TABLE `tb_carros` DISABLE KEYS */;
INSERT INTO `tb_carros` VALUES (49,24,27,23,'2015',2015,2015,'Zero KM',150000,'../CARROS/6185dc4e5cda8.jpg','../CARROS/6185dc4e2917c.jpg','../CARROS/mini_6185dc4e5cda8.jpg','../CARROS/mini_6185dc4e2917c.jpg',1,1,1,0,0,39),(50,24,27,24,'2015',2015,2015,'Zero KM',150000,'../CARROS/6185dc4e5cda8.jpg','../CARROS/6185dc4e2917c.jpg','../CARROS/mini_6185dc4e5cda8.jpg','../CARROS/mini_6185dc4e2917c.jpg',1,1,1,0,0,12),(99,38,35,31,'2015',2015,2015,'Zero KM',150000,'../CARROS/618697dbb20b8.jpg','../CARROS/618697dbe7c19.jpg','../CARROS/mini_618697ee7b1eb.jpg','../CARROS/mini_618697ee4086a.jpg',1,1,1,0,0,44),(100,38,35,32,'2015',2015,2015,'Zero KM',150000,'../CARROS/618697dbb20b8.jpg','../CARROS/618697dbe7c19.jpg','../CARROS/mini_618697ee7b1eb.jpg','../CARROS/mini_618697ee4086a.jpg',1,1,1,0,0,22),(155,45,5,4,'2017',2016,2015,'Nada a declarar',78000,'../CARROS/6682d91d216df.jpg','../CARROS/6682d91d49f0e.jpg','../CARROS/mini_6682d91d216df.jpg','../CARROS/mini_6682d91d49f0e.jpg',1,1,1,0,0,NULL),(156,24,27,24,'2013',2012,2010,'Nenhuma OBS',235000,'../CARROS/668303be34eb9.jpg','../CARROS/668303be4e4f0.jpg','../CARROS/mini_668303be34eb9.jpg','../CARROS/mini_668303be4e4f0.jpg',1,1,1,0,0,NULL);
/*!40000 ALTER TABLE `tb_carros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_colaboradores`
--

DROP TABLE IF EXISTS `tb_colaboradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_colaboradores` (
  `id_colaborador` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `acesso` enum('ATIVO','DESLIGADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_colaborador`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_colaboradores`
--

LOCK TABLES `tb_colaboradores` WRITE;
/*!40000 ALTER TABLE `tb_colaboradores` DISABLE KEYS */;
INSERT INTO `tb_colaboradores` VALUES (1,'Matheus Oliveira','me.matheusoliveira','d1afdb3a899f85437d344304c3b71644','ATIVO'),(31,'Marinho Senhor Leal','me.marinho','de6e41ede0ff5158c3c389819cd8ef50','ATIVO'),(32,'Marinho da Rede Globo','me.marinho','7e09e83a3a720378f1004fa394fd0e74','ATIVO'),(33,'Marinho Mercante','me.marinho','67f23f0985627d7cad816cbd257e419c','ATIVO'),(36,'Marinho diferente','me.marinho','0c661acc7c5122064d80cc29a92c0480','ATIVO'),(38,'Marinho eu sou lindo','me.marinho','a360b5547fe3a9c8e240daf8ba757ee6','ATIVO'),(40,'Marinho Marinho Marinho','me.marinho','1c48657dbe16e0ef6316704a9b0e0000','ATIVO'),(45,'Marinho de Oliveira','me.marinho','83dc75b8a6d298f5218ad042a6cf8b9e','ATIVO');
/*!40000 ALTER TABLE `tb_colaboradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_marcas`
--

DROP TABLE IF EXISTS `tb_marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_marcas` (
  `id_marca` int NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_marcas`
--

LOCK TABLES `tb_marcas` WRITE;
/*!40000 ALTER TABLE `tb_marcas` DISABLE KEYS */;
INSERT INTO `tb_marcas` VALUES (22,'RENAULT'),(23,'FORD'),(24,'TOYOTA'),(25,'VOLKSWAGEN'),(26,'HONDA'),(27,'HYUNDAI'),(28,'NISSAN'),(29,'CHEVROLET'),(37,'FIAT'),(38,'BMW'),(45,'KIA');
/*!40000 ALTER TABLE `tb_marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_modelo_versoes`
--

DROP TABLE IF EXISTS `tb_modelo_versoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_modelo_versoes` (
  `id_modelo_versao` int NOT NULL AUTO_INCREMENT,
  `modelo_versao` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_modelo` int DEFAULT NULL,
  PRIMARY KEY (`id_modelo_versao`),
  KEY `id_modelo` (`id_modelo`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_modelo_versoes`
--

LOCK TABLES `tb_modelo_versoes` WRITE;
/*!40000 ALTER TABLE `tb_modelo_versoes` DISABLE KEYS */;
INSERT INTO `tb_modelo_versoes` VALUES (1,'FLUENCE',2),(2,'PICANTO',3),(3,'SOL',4),(4,'CERATO',5),(5,'RANGE',6),(6,'FUSION',7),(7,'FOCUS',8),(8,'EDGE',9),(9,'KWID',10),(10,'T-CROSS',11),(11,'JETTA',12),(12,'PASSAT',13),(13,'320I',14),(14,'ARGO',15),(15,'PUNTO',16),(16,'MOBI',17),(17,'CRUZE',18),(18,'COBALT',19),(19,'S10',20),(20,'VECTRA',21),(21,'CIVIC',22),(22,'CITY',24),(23,'HILUX SW-4',27),(24,'HILUX',27),(25,'VERSA',28),(26,'SENTRA',29),(27,'MARCH',30),(28,'GT-R',31),(29,'LEAF',32),(30,'BMW X5',33),(31,'BMW SÉRIE 1',35),(32,'BMW SÉRIE 3',35),(33,'SANDERO',36),(34,'STEPWAY',37),(35,'LOGAN',38),(36,'SANTA FE',39),(37,'TUCSON',40),(38,'CRETA',41),(39,'IX 35',42),(40,'HB 20',43),(41,'AZERA',44),(42,'ELANTRA',45),(43,'SONATA',46),(44,'TOYOTA CAMRY',47),(45,'RAV 4',48),(46,'YARIS',49),(47,'PRIUS',50),(48,'ETIOS',51),(49,'COROLLA CROS',52),(50,'COROLLA',53),(51,'CR-V',54),(52,'FIT',55),(53,'ACCORD',56),(54,'HR-V',57),(55,'WR-V',58),(56,'POLO',59),(57,'GOL',60),(58,'NIVUS',61),(59,'FOX',62),(60,'VIRTUS',63),(61,'DOBLó',64),(62,'CRONOS',65),(63,'UNO',66),(64,'SIENA',67),(65,'CAMARO',68),(66,'ONIX',69),(67,'EQUINOX',70),(68,'TRAILBLAZER',71),(69,'TRACKER',72),(70,'SPIN',73),(71,'SPORTAGE',74),(72,'RIO',75),(73,'SORENTO',76),(74,'STINGER',77),(75,'GRAND CARNIVAL',78);
/*!40000 ALTER TABLE `tb_modelo_versoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_modelos`
--

DROP TABLE IF EXISTS `tb_modelos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_modelos` (
  `id_modelo` int NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_marca` int NOT NULL,
  PRIMARY KEY (`id_modelo`),
  KEY `fk_tb_modelos_tb_marcas` (`id_marca`),
  CONSTRAINT `fk_tb_modelos_tb_marcas` FOREIGN KEY (`id_marca`) REFERENCES `tb_marcas` (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_modelos`
--

LOCK TABLES `tb_modelos` WRITE;
/*!40000 ALTER TABLE `tb_modelos` DISABLE KEYS */;
INSERT INTO `tb_modelos` VALUES (2,'FLUENCE',22),(3,'PICANTO',45),(4,'SOL',45),(5,'CERATO',45),(6,'RANGE',23),(7,'FUSION',23),(8,'FOCUS',23),(9,'EDGE',23),(10,'KWID',22),(11,'T-CROSS',25),(12,'JETTA',25),(13,'PASSAT',25),(14,'320I',38),(15,'ARGO',37),(16,'PUNTO',37),(17,'MOBI',37),(18,'CRUZE',29),(19,'COBALT',29),(20,'S10',29),(21,'VECTRA',29),(22,'CIVIC',26),(24,'CITY',26),(27,'HILUX',24),(28,'VERSA',28),(29,'SENTRA',28),(30,'MARCH',28),(31,'GT-R',28),(32,'LEAF',28),(33,'BMW X5',38),(35,'BMW SÉRIE',38),(36,'SANDERO',22),(37,'STEPWAY',22),(38,'LOGAN',22),(39,'SANTA FE',27),(40,'TUCSON',27),(41,'CRETA',27),(42,'IX 35',27),(43,'HB 20',27),(44,'AZERA',27),(45,'ELANTRA',27),(46,'SONATA',27),(47,'TOYOTA CAMRY',24),(48,'RAV 4',24),(49,'YARIS',24),(50,'PRIUS',24),(51,'ETIOS',24),(52,'COROLLA CROS',24),(53,'COROLLA',24),(54,'CR-V',26),(55,'FIT',26),(56,'ACCORD',26),(57,'HR-V',26),(58,'WR-V',26),(59,'POLO',25),(60,'GOL',25),(61,'NIVUS',25),(62,'FOX',25),(63,'VIRTUS',25),(64,'DOBLó',37),(65,'CRONOS',37),(66,'UNO',37),(67,'SIENA',37),(68,'CAMARO',29),(69,'ONIX',29),(70,'EQUINOX',29),(71,'TRAILBLAZER',29),(72,'TRACKER',29),(73,'SPIN',29),(74,'SPORTAGE',45),(75,'RIO',45),(76,'SORENTO',45),(77,'STINGER',45),(78,'GRAND CARNIVAL',45);
/*!40000 ALTER TABLE `tb_modelos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-01 22:51:42

ALTER TABLE tb_modelo_versoes
ADD CONSTRAINT fk_tb_modelo_versoes_tb_modelos FOREIGN KEY(id_modelo) REFERENCES tb_modelos(id_modelo);
-- MySQL dump 10.16  Distrib 10.1.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: life_timeline
-- ------------------------------------------------------
-- Server version	10.1.13-MariaDB

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
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` int(11) NOT NULL,
  `who` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Walk on the moon',14230,'Neil Armstrong','history','',''),(2,'Oldest living person dies',44724,'Jeanne Calment','death','',''),(3,'Publish \'Looking for Alaska\'',10053,'John Green','books','',''),(4,'Publish paper on Special Relativity',9692,'Albert Einstein','science','',''),(5,'Buddy Holly dies',8184,'Buddy Holly','death','',''),(6,'Become president of the United States',17336,'Barack Obama','history','',''),(7,'Publish \'A Game of Thrones\'',17482,'George R. R. Martin','books','',''),(8,'Break the world record 100 meter sprint',7954,'Usain Bolt','sport','',''),(9,'Release \'Purple Haze\'',8876,'Jimi Hendrix','music','',''),(10,'Publish \'On the Origin of Species\'',18547,'Charles Darwin','science','',''),(11,'Become Queen of England',9422,'Elizabeth II','history','',''),(12,'Be crowned Emperor of France',12635,'Napoleon','history','',''),(13,'Become Pope',27845,'Pope Francis','history','',''),(14,'Become World Chess Champion',10769,'Bobby Fischer','sport','',''),(15,'Be defeated at chess by Deep Blue',11991,'Garry Kasparov','history','',''),(16,'Jimi Hendrix dies',10157,'Jimi Hendrix','death','',''),(17,'Publish \'Harry Potter and the Philosopher\'s Stone\'',11653,'J. K. Rowling','books','',''),(18,'Publish \'Harry Potter and the Deathly Hallows\'',15330,'J. K. Rowling','books','',''),(19,'Record \'Blowin\' in the Wind\'',7716,'Bob Dylan','music','',''),(20,'Direct \'Reservior Dogs\'',10527,'Quentin Tarantino','film','',''),(21,'Be born',0,'You','','',''),(22,'Direct \'The Godfather\'',12031,'Francis Ford Coppola','film','',''),(23,'Direct \'Whiplash\'',10589,'Damien Chazelle','film','',''),(24,'Direct \'Citizen Kane\'',9492,'Orson Welles','film','',''),(25,'Robin Williams dies',23032,'Robin Williams','death','',''),(26,'Publish \'The Martian\'',15215,'Andy Weir','books','',''),(27,'Publish \'Ulysses\'',14609,'James Joyce','books','',''),(28,'Become World Heavyweight Boxing Champion',8074,'Muhammad Ali','sport','',''),(29,'Publish the Principia',16253,'Isaac Newton','science','',''),(30,'Go to space (again)',28277,'John Glenn','science','',''),(31,'Become the first person in space',9896,'Yuri Gagarin','science','',''),(32,'Publish \'Infinite Jest\'',12398,'David Foster Wallace','books','',''),(33,'Publish \'The Hitchhiker\'s Guide to the Galaxy\'',10076,'Douglas Adams','books','',''),(34,'Create the first web page',13208,'Tim Berners-Lee','science','',''),(35,'Build/fly the first airplane',13393,'Wilbur Wright (sorry Orville)','science','',''),(36,'Create Mario',10462,'Shigeru Miyamoto','history','',''),(37,'Record the first film footage',17214,'Louis Le Prince','science','',''),(38,'Alexander the Great dies',12043,'Alexander the Great','death','',''),(39,'Present \'Experiments on Plant Hybridization\'',15544,'Gregor Mendel','science','',''),(40,'Release \'Seven Nation Army\'',10103,'Jack White','music','',''),(41,'Record \'What a Wonderful World\'',24118,'Louis Armstrong','music','',''),(42,'Publish \'The Grapes of Wrath\'',11553,'John Steinbeck','books','',''),(43,'Direct \'The Shawshank Redemption\'',13009,'Frank Darabont','film','','');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-05 12:20:13

-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hrapp
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `empNo` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `hireDate` date NOT NULL,
  `birthDate` date NOT NULL,
  `designation` varchar(100) NOT NULL,
  `salary` decimal(15,2) NOT NULL,
  `deptNo` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`empNo`),
  UNIQUE KEY `email_unique` (`email`),
  KEY `deptNo` (`deptNo`),
  CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`deptNo`) REFERENCES `departments` (`deptNo`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Steven','Kings','steven.king@chessable.org','5157654321','1987-06-17','1957-06-17','Software Enginner',24000.00,6,'2021-03-29 00:51:02'),(2,'Neena','Kochhar','neena.kochhar@chessable.org','5157654321','1989-09-21','1959-09-21','IT Analyst',17000.00,6,'2021-03-29 00:51:02'),(3,'Lex','De Haan','lex.de haan@chessable.org','5157654321','1993-01-13','1963-01-13','Manager',17000.00,1,'2021-03-29 00:51:02'),(4,'Alexander','Hunold','alexander.hunold@chessable.org','5907654321','1990-01-03','1960-01-03','Manager',9000.00,2,'2021-03-29 00:51:02'),(5,'Bruce','Ernst','bruce.ernst@chessable.org','5907654321','1991-05-21','1961-05-21','Manager',6000.00,3,'2021-03-29 00:51:03'),(6,'David','Austin','david.austin@chessable.org','5907654321','1997-06-25','1967-06-25','Manager',4800.00,4,'2021-03-29 00:51:03'),(7,'Valli','Pataballa','valli.pataballa@chessable.org','5907654321','1998-02-05','1968-02-05','Manager',4800.00,5,'2021-03-29 00:51:03'),(8,'Diana','Lorentz','diana.lorentz@chessable.org','5907654321','1999-02-07','1969-02-07','Manager',4200.00,7,'2021-03-29 00:51:03'),(9,'Nancy','Greenberg','nancy.greenberg@chessable.org','5157654321','1994-08-17','1964-08-17','Manager',12000.00,8,'2021-03-29 00:51:04'),(10,'Daniel','Faviet','daniel.faviet@chessable.org','5157654321','1994-08-16','1964-08-16','Manager',9000.00,9,'2021-03-29 00:51:04'),(11,'John','Chen','john.chen@chessable.org','5157654321','1997-09-28','1967-09-28','Manager',8200.00,10,'2021-03-29 00:51:04'),(12,'Ismael','Sciarra','ismael.sciarra@chessable.org','5157654321','1997-09-30','1967-09-30','Manager',7700.00,11,'2021-03-29 00:51:04'),(13,'Jose Manuel','Urman','jose manuel.urman@chessable.org','5157654321','1998-03-07','1968-03-07','Manager',7800.00,1,'2021-03-29 00:51:05'),(14,'Luis','Popp','luis.popp@chessable.org','5157654321','1999-12-07','1969-12-07','Manager',60000.00,2,'2021-03-29 00:51:05'),(15,'Den','Raphaely','den.raphaely@chessable.org','5157654321','1994-12-07','1964-12-07','Manager',55000.00,2,'2021-03-29 00:51:05'),(16,'Alexander','Khoo','alexander.khoo@chessable.org','5157654321','1995-05-18','1965-05-18','Manager',51000.00,4,'2021-03-29 00:51:05'),(17,'Shelli','Baida','shelli.baida@chessable.org','5157654321','1997-12-24','1967-12-24','Manager',52000.00,4,'2021-03-29 00:51:06'),(18,'Sigal','Tobias','sigal.tobias@chessable.org','5157654321','1997-07-24','1967-07-24','Manager',53000.00,7,'2021-03-29 00:51:06'),(19,'Guy','Himuro','guy.himuro@chessable.org','5157654321','1998-11-15','1968-11-15','IT Analyst',2600.00,6,'2021-03-29 00:51:06'),(20,'Karen','Colmenares','karen.colmenares@chessable.org','5157654321','1999-08-10','1969-08-10','IT Analyst',2500.00,6,'2021-03-29 00:51:06'),(21,'Matthew','Weiss','matthew.weiss@chessable.org','6507654321','1996-07-18','1966-07-18','IT Analyst',8000.00,6,'2021-03-29 00:51:06'),(22,'Adam','Fripp','adam.fripp@chessable.org','6507654321','1997-04-10','1967-04-10','IT Analyst',8200.00,6,'2021-03-29 00:51:07'),(23,'Payam','Kaufling','payam.kaufling@chessable.org','6507654321','1995-05-01','1965-05-01','IT Analyst',7900.00,6,'2021-03-29 00:51:07'),(24,'Shanta','Vollman','shanta.vollman@chessable.org','6507654321','1997-10-10','1967-10-10','IT Analyst',6500.00,6,'2021-03-29 00:51:07'),(25,'Irene','Mikkilineni','irene.mikkilineni@chessable.org','6507654321','1998-09-28','1968-09-28','IT Analyst',2700.00,6,'2021-03-29 00:51:08'),(26,'John','Russell','john.russell@chessable.org',NULL,'1996-10-01','1966-10-01','IT Analyst',14000.00,6,'2021-03-29 00:51:08'),(27,'Karen','Partners','karen.partners@chessable.org',NULL,'1997-01-05','1967-01-05','IT Analyst',13500.00,6,'2021-03-29 00:51:08'),(28,'Jonathon','Taylor','jonathon.taylor@chessable.org',NULL,'1998-03-24','1968-03-24','IT Analyst',8600.00,6,'2021-03-29 00:51:08'),(29,'Jack','Livingston','jack.livingston@chessable.org',NULL,'1998-04-23','1968-04-23','IT Analyst',8400.00,6,'2021-03-29 00:51:08'),(30,'Kimberely','Grant','kimberely.grant@chessable.org',NULL,'1999-05-24','1969-05-24','Software Enginner',7000.00,6,'2021-03-29 00:51:09'),(31,'Charles','Johnson','charles.johnson@chessable.org',NULL,'2000-01-04','1970-01-04','Software Enginner',6200.00,6,'2021-03-29 00:51:09'),(32,'Sarah','Bell','sarah.bell@chessable.org','6507654321','1996-02-04','1966-02-04','Software Enginner',4000.00,6,'2021-03-29 00:51:09'),(33,'Britney','Everett','britney.everett@chessable.org','6507654321','1997-03-03','1967-03-03','Architect',3900.00,5,'2021-03-29 00:51:10'),(34,'Jennifer','Whalen','jennifer.whalen@chessable.org','5157654321','1987-09-17','1957-09-17','Architect',4400.00,4,'2021-03-29 00:51:10'),(35,'Michael','Hartstein','michael.hartstein@chessable.org','5157654321','1996-02-17','1966-02-17','Architect',13000.00,3,'2021-03-29 00:51:10'),(36,'Pat','Fay','pat.fay@chessable.org','6037654321','1997-08-17','1967-08-17','Architect',6000.00,2,'2021-03-29 00:51:11'),(37,'Susan','Mavris','susan.mavris@chessable.org','5157654321','1994-06-07','1964-06-07','Architect',6500.00,4,'2021-03-29 00:51:11'),(38,'Hermann','Baer','hermann.baer@chessable.org','5157654321','1994-06-07','1964-06-07','Architect',10000.00,7,'2021-03-29 00:51:11'),(39,'Shelley','Higgins','shelley.higgins@chessable.org','5157654321','1994-06-07','1964-06-07','Architect',12000.00,11,'2021-03-29 00:51:11'),(40,'William','Gietz','william.gietz@chessable.org','5157654321','1994-06-07','1964-06-07','Architect',8300.00,11,'2021-03-29 00:51:12'),(55,'Test','Test','test@chessable.org','78867','2021-03-26','2021-02-28','sdsds',234223.00,6,'2021-03-29 13:48:53');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-29 14:28:38

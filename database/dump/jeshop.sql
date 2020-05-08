-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: jeshop
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-1:10.3.22+maria~bionic

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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'HP'),(2,'Samsung'),(3,'Apple'),(4,'Sony'),(5,'LG'),(6,'Cloth Brand');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_title` varchar(200) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `qty` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `total_amt` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (1,1,'0',0,'Samsung Dous 2','samsung mobile.jpg',1,5000,5000),(2,2,'0',0,'iPhone 5s','iphone mobile.jpg',1,25000,25000);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Electronics'),(2,'Ladies Wears'),(3,'Mens Wear'),(4,'Kids Wear'),(5,'Furnitures'),(6,'Home Appliances'),(7,'Electronics Gadgets');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(100) NOT NULL AUTO_INCREMENT,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,2,'Samsung Dous 2',5000,'Samsung Dous 2 sgh ','samsung mobile.jpg','samsung mobile electronics'),(2,1,3,'iPhone 5s',25000,'iphone 5s','iphone mobile.jpg','mobile iphone apple'),(3,1,3,'iPad',30000,'ipad apple brand','ipad.jpg','apple ipad tablet'),(4,1,3,'iPhone 6s',32000,'Apple iPhone ','iphone.jpg','iphone apple mobile'),(5,1,2,'iPad 2',10000,'samsung ipad','ipad 2.jpg','ipad tablet samsung'),(6,1,1,'Hp Laptop r series',35000,'Hp Red and Black combination Laptop','k2-_ed8b8f8d-e696-4a96-8ce9-d78246f10ed1.v1.jpg-bc204bdaebb10e709a997a8bb4518156dfa6e3ed-optim-450x450.jpg','hp laptop '),(7,1,1,'Laptop Pavillion',50000,'Laptop Hp Pavillion','12039452_525963140912391_6353341236808813360_n.png','Laptop Hp Pavillion'),(8,1,4,'Sony',40000,'Sony Mobile','sony mobile.jpg','sony mobile'),(9,1,3,'iPhone New',12000,'iphone','white iphone.png','iphone apple mobile'),(10,2,6,'Red Ladies dress',1000,'red dress for girls','red dress.jpg','red dress '),(11,2,6,'Blue Heave dress',1200,'Blue dress','images.jpg','blue dress cloths'),(12,2,6,'Ladies Casual Cloths',1500,'ladies casual summer two colors pleted','7475-ladies-casual-dresses-summer-two-colors-pleated.jpg','girl dress cloths casual'),(13,2,6,'SpringAutumnDress',1200,'girls dress','Spring-Autumn-Winter-Young-Ladies-Casual-Wool-Dress-Women-s-One-Piece-Dresse-Dating-Clothes-Medium.jpg_640x640.jpg','girl dress'),(14,2,6,'Casual Dress',1400,'girl dress','download.jpg','ladies cloths girl'),(15,2,6,'Formal Look',1500,'girl dress','shutterstock_203611819.jpg','ladies wears dress girl'),(16,3,6,'Sweter for men',600,'2012-Winter-Sweater-for-Men-for-better-outlook','2012-Winter-Sweater-for-Men-for-better-outlook.jpg','black sweter cloth winter'),(17,3,6,'Gents formal',1000,'gents formal look','gents-formal-250x250.jpg','gents wear cloths'),(19,3,6,'Formal Coat',3000,'ad','images (1).jpg','coat blazer gents'),(20,3,6,'Mens Sweeter',1600,'jg','Winter-fashion-men-burst-sweater.png','sweeter gents '),(21,3,6,'T shirt',800,'ssds','IN-Mens-Apparel-Voodoo-Tiles-09._V333872612_.jpg','formal t shirt black'),(22,4,6,'Yellow T shirt ',1300,'yello t shirt with pant','1.0x0.jpg','kids yellow t shirt'),(23,4,6,'Girls cloths',1900,'sadsf','GirlsClothing_Widgets.jpg','formal kids wear dress'),(24,4,6,'Blue T shirt',700,'g','images.jpg','kids dress'),(25,4,6,'Yellow girls dress',750,'as','images (3).jpg','yellow kids dress'),(26,4,6,'Skyblue dress',650,'nbk','kids-wear-121.jpg','skyblue kids dress'),(27,4,6,'Formal look',690,'sd','image28.jpg','formal kids dress'),(32,5,0,'Book Shelf',2500,'book shelf','furniture-book-shelf-250x250.jpg','book shelf furniture'),(33,6,2,'Refrigerator',35000,'Refrigerator','CT_WM_BTS-BTC-AppliancesHome_20150723.jpg','refrigerator samsung'),(34,6,4,'Emergency Light',1000,'Emergency Light','emergency light.JPG','emergency light'),(35,6,0,'Vaccum Cleaner',6000,'Vaccum Cleaner','images (2).jpg','Vaccum Cleaner'),(36,6,5,'Iron',1500,'gj','iron.JPG','iron'),(37,6,5,'LED TV',20000,'LED TV','images (4).jpg','led tv lg'),(38,6,4,'Microwave Oven',3500,'Microwave Oven','images.jpg','Microwave Oven'),(39,6,5,'Mixer Grinder',2500,'Mixer Grinder','singer-mixer-grinder-mg-46-medium_4bfa018096c25dec7ba0af40662856ef.jpg','Mixer Grinder'),(40,2,6,'Formal girls dress',3000,'Formal girls dress','girl-walking.jpg','ladies'),(45,1,2,'Samsung Galaxy Note 3',10000,'0','samsung_galaxy_note3_note3neo.JPG','samsung galaxy Note 3 neo'),(46,1,2,'Samsung Galaxy Note 3',10000,'','samsung_galaxy_note3_note3neo.JPG','samsung galxaxy note 3 neo');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'demo','demo','demo@gmal.com','12345','123456789','Kolkata','VIP Road'),(2,'Rizwan','Khan','rizwankhan.august16@gmail.com','25f9e794323b453885f5181f1b624d0b','9832268432','Hutton Road','Kolkata'),(3,'Rizwan','Khan','salmankhan@gmail.com','25f9e794323b453885f5181f1b624d0b','8389080182','Hutton Road','Asansol');
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

-- Dump completed on 2020-05-06  4:41:15

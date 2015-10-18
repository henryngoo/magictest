# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.13)
# Database: magictest
# Generation Time: 2015-10-18 11:43:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('Female','Male','Other') COLLATE utf8_unicode_ci DEFAULT 'Other',
  `birthday` date DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('Customer','User','Admin') COLLATE utf8_unicode_ci DEFAULT 'User',
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` enum('General','Business') COLLATE utf8_unicode_ci DEFAULT 'General',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `name`, `email`, `gender`, `birthday`, `password`, `role`, `phone`, `address1`, `address2`, `city`, `zip`, `state`, `company`, `confirmation_code`, `confirmed`, `created`, `modified`, `type`)
VALUES
	(3,'Phuong','Ngo',NULL,'fuongit1@gmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'16e0a8c4cb550558',0,'2015-10-18 16:56:41','2015-10-18 17:31:06','General'),
	(4,'Henry','Ngo',NULL,'fuongngo@hotmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'455e31eaa9262ae3',0,'2015-10-18 17:00:56','2015-10-18 17:00:56','General'),
	(5,'Henry','Ngo',NULL,'fuongngo1@hotmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'5fed69cb6b16bc01',0,'2015-10-18 17:03:01','2015-10-18 17:03:01','General'),
	(6,'Phuong','Ngo',NULL,'fuongit2@gmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'7380136f8103d438',0,'2015-10-18 17:31:15','2015-10-18 17:32:47','General'),
	(7,'Phuong','Ngo',NULL,'fuongit@gmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6640cd3271031e90',1,'2015-10-18 17:33:01','2015-10-18 17:37:43','General'),
	(8,'Phuong','Ngo',NULL,'fuongit6@gmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,'MagicGroup','785b7703e96cb266',0,'2015-10-18 18:14:49','2015-10-18 18:14:49','Business'),
	(9,'Phuong','Ngo',NULL,'fuongit9@gmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,'Facebook','f44e997437b6e5ff',0,'2015-10-18 18:17:24','2015-10-18 18:17:24','General'),
	(10,'Le','Phong',NULL,'fuongit4@gmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,'Yahoo','07e29c0fe81d586d',0,'2015-10-18 18:18:14','2015-10-18 18:18:14','Business'),
	(11,'Clark','Ken',NULL,'fuongit88@gmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,'Google','d62a4cf9dd7da436',0,'2015-10-18 18:19:01','2015-10-18 18:19:01','Business'),
	(12,'John','Lee',NULL,'fuongit77@gmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,'Twitter','e4ce9ce3b8c311f3',0,'2015-10-18 18:20:01','2015-10-18 18:20:01','Business'),
	(13,'Ken','Max',NULL,'fuongit23@gmail.com','Other',NULL,'16d7a4fca7442dda3ad93c9a726597e4','User',NULL,NULL,NULL,NULL,NULL,NULL,'Apple','de3441afdb4ad2ff',1,'2015-10-18 18:27:48','2015-10-18 18:28:37','Business');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

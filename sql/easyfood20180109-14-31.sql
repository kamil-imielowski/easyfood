# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.44-0ubuntu0.14.04.1)
# Database: easyfood
# Generation Time: 2018-01-09 13:31:38 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street` text COLLATE utf8_polish_ci NOT NULL,
  `postcode` varchar(20) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `city` text COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `state` varchar(11) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;

INSERT INTO `orders` (`id`, `restaurer_id`, `user_id`, `street`, `postcode`, `city`, `date`, `total_price`, `state`)
VALUES
	(3,1,1,'Mariacka 32','41-100','Katowice','2018-01-08 09:46:26',20.00,'pending'),
	(4,1,1,'Stalowa 16','41-500','Chorzów','2018-01-08 13:52:33',7.00,'pending'),
	(5,8,1,'Mariacka 32','41-100','Katowice','2018-01-09 12:50:20',31.30,'complited');

/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orders_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders_details`;

CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `orders_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `orders_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

LOCK TABLES `orders_details` WRITE;
/*!40000 ALTER TABLE `orders_details` DISABLE KEYS */;

INSERT INTO `orders_details` (`id`, `product_id`, `order_id`, `quantity`, `price`)
VALUES
	(8,2,3,3,6.00),
	(9,1,3,2,1.00),
	(10,2,4,1,6.00),
	(11,1,4,1,1.00),
	(12,4,5,1,15.00),
	(13,6,5,1,16.30);

/*!40000 ALTER TABLE `orders_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `user_id`, `name`, `description`, `price`, `created_date`, `updated_date`, `state`)
VALUES
	(1,1,'assad','sad',1.00,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),
	(2,1,'asdasdasd','dasas',6.00,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),
	(3,8,'Pizza Margherita','z mozzarellą',13.00,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),
	(4,8,'Pizza Margherita A\'la Feta','z serem feta',15.00,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),
	(5,8,'Pizza Roku 1998','z bekonem, karczochami i oliwkami',14.60,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),
	(6,8,'Pizza Ekstrawagancka','z bekonem, salami, pieczarkami i szparagami',16.30,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),
	(7,8,'Pizza Blue Ocean','z krewetkami, małżami, tuńczykiem i oliwkami',18.30,'0000-00-00 00:00:00','0000-00-00 00:00:00',0);

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` enum('user','restaurateur','admin') COLLATE utf8_polish_ci NOT NULL DEFAULT 'user',
  `email` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `pass` varchar(32) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `firstname` varchar(200) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `lastname` varchar(200) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `street` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `postcode` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `phone` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `map_lat` float NOT NULL,
  `map_lng` float NOT NULL,
  `date_add` datetime DEFAULT NULL,
  `state` enum('on','off','del','banned','moderate','on_verify') COLLATE utf8_polish_ci NOT NULL DEFAULT 'on',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=DYNAMIC;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `user_type`, `email`, `pass`, `firstname`, `lastname`, `street`, `postcode`, `city`, `phone`, `map_lat`, `map_lng`, `date_add`, `state`)
VALUES
	(1,'user','user@test.pl','0cc175b9c0f1b6a831c399e269772661','Jan','Kowalski','Mariacka 32','41-100','Katowice','123123123',50.3354,18.9398,NULL,'on'),
	(3,'restaurateur','r@test.pl','4b43b0aee35624cd95b910189b3dc231','Restauracja','','Bogucicka 14a','40-287','Katowice','123123123',50.2609,19.0432,'2018-01-05 08:35:29','on'),
	(4,'restaurateur','r1@o2.pl','a8f5f167f44f4964e6c998dee827110c','Viet-Long Będzińska','','Będzińska 18','41-200','Sosnowiec','23232342',50.2941,19.1304,'2018-01-09 12:30:03','on'),
	(5,'restaurateur','r3@o2.pl','c99a11a53a3748269e3f86d7ac38df11','Kuchnia Orientalna Mai Mai','','Gliwicka 139','40-857','Katowice','42323232',50.2665,18.9954,'2018-01-09 12:31:08','on'),
	(6,'restaurateur','r4@o2.pl','7815696ecbf1c96e6894b779456d330e','Maxi Pizza','','Katowicka 67','41-600','Świętochłowice','32 282 12 32',50.2851,18.9333,'2018-01-09 12:32:02','on'),
	(7,'restaurateur','r5@o2.pl','7815696ecbf1c96e6894b779456d330e','Zahir Kebab','','Podgórna 2','41-902','Bytom','32 233 23 22',50.3487,18.9223,'2018-01-09 12:33:02','on'),
	(8,'restaurateur','r6@o2.pl','7815696ecbf1c96e6894b779456d330e','Pizzeria Diavolo','','Stefana Batorego 48','41-506','Chorzów','504 221 423',50.2676,18.9367,'2018-01-09 12:33:50','on'),
	(9,'restaurateur','r7@o2.pl','7815696ecbf1c96e6894b779456d330e','Tanio ale dobrze Truchana','','Truchana 28','41-500','Chorzów','789 232 133',50.296,18.9462,'2018-01-09 12:34:37','on'),
	(11,'admin','admin@test.pl','0cc175b9c0f1b6a831c399e269772661','Jan','Kowalski','Mariacka 32','41-100','Katowice','123123123',50.3354,18.9398,NULL,'on');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_logging
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_logging`;

CREATE TABLE `users_logging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_log` datetime DEFAULT NULL,
  `date_last_reload` datetime DEFAULT NULL,
  `count_reloads` int(11) NOT NULL DEFAULT '0',
  `login` varchar(200) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `ip` char(15) COLLATE utf8_polish_ci DEFAULT NULL,
  `hostname` char(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `system` char(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `state` enum('in','out','','wrong_lp','blocked') COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  CONSTRAINT `users_logging_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=DYNAMIC;

LOCK TABLES `users_logging` WRITE;
/*!40000 ALTER TABLE `users_logging` DISABLE KEYS */;

INSERT INTO `users_logging` (`id`, `date_log`, `date_last_reload`, `count_reloads`, `login`, `user_id`, `ip`, `hostname`, `system`, `state`)
VALUES
	(1,'2017-12-08 13:12:09',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in');

/*!40000 ALTER TABLE `users_logging` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

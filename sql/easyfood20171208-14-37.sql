# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.44-0ubuntu0.14.04.1)
# Database: easyfood
# Generation Time: 2017-12-08 13:37:16 +0000
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
  `user_type` enum('user','restaurateur','admin') COLLATE utf8_polish_ci NOT NULL DEFAULT 'user',
  `email` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `pass` varchar(32) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `firstname` varchar(200) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `lastname` varchar(200) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `city` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `postcode` varchar(20) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `street` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `nip_number` varchar(40) COLLATE utf8_polish_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `fax` varchar(55) COLLATE utf8_polish_ci NOT NULL,
  `state` enum('on','off','del','banned','moderate','on_verify') COLLATE utf8_polish_ci NOT NULL DEFAULT 'on',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `user_type`, `email`, `pass`, `firstname`, `lastname`, `city`, `postcode`, `street`, `nip_number`, `phone`, `fax`, `state`)
VALUES
	(1,'user','test','0cc175b9c0f1b6a831c399e269772661','Jan','Kowalski','Katowice','41-100','Mariacka 32',NULL,'123123123','','on');

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
  KEY `idx_user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

LOCK TABLES `users_logging` WRITE;
/*!40000 ALTER TABLE `users_logging` DISABLE KEYS */;

INSERT INTO `users_logging` (`id`, `date_log`, `date_last_reload`, `count_reloads`, `login`, `user_id`, `ip`, `hostname`, `system`, `state`)
VALUES
	(1,'2017-12-08 13:12:09',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(2,'2017-12-08 13:13:13',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(3,'2017-12-08 13:13:13',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(4,'2017-12-08 13:13:16',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(5,'2017-12-08 13:13:17',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(6,'2017-12-08 13:13:17',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(7,'2017-12-08 13:13:18',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(8,'2017-12-08 13:15:08',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(9,'2017-12-08 13:15:09',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(10,'2017-12-08 13:15:53',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(11,'2017-12-08 13:18:27',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(12,'2017-12-08 13:18:28',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(13,'2017-12-08 13:18:46',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(14,'2017-12-08 13:18:47',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(15,'2017-12-08 13:18:48',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(16,'2017-12-08 13:18:48',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(17,'2017-12-08 13:18:49',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(18,'2017-12-08 13:18:49',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(19,'2017-12-08 13:19:01',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in'),
	(20,'2017-12-08 13:19:01',NULL,0,'test',1,'10.0.0.1','10.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36','in');

/*!40000 ALTER TABLE `users_logging` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

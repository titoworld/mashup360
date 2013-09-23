# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: mysql.farrepuche.com (MySQL 5.1.56-log)
# Database: mashup360
# Generation Time: 2013-09-22 23:37:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table POIs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `POIs`;

CREATE TABLE `POIs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `POI_name` varchar(50) DEFAULT NULL,
  `POI_description` varchar(250) DEFAULT NULL,
  `POI_telefon` varchar(20) DEFAULT NULL,
  `POI_email` varchar(50) DEFAULT NULL,
  `POI_postal` varchar(100) DEFAULT NULL,
  `POI_ciutat` varchar(50) DEFAULT NULL,
  `POI_codi_postal` varchar(11) DEFAULT NULL,
  `POI_web` varchar(100) DEFAULT NULL,
  `POI_latitude` varchar(10) DEFAULT NULL,
  `POI_longitude` varchar(10) DEFAULT NULL,
  `POI_360url` varchar(100) DEFAULT NULL,
  `POI_mini_logo` varchar(50) DEFAULT NULL,
  `POI_id` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `POIs` WRITE;
/*!40000 ALTER TABLE `POIs` DISABLE KEYS */;

INSERT INTO `POIs` (`id`, `POI_name`, `POI_description`, `POI_telefon`, `POI_email`, `POI_postal`, `POI_ciutat`, `POI_codi_postal`, `POI_web`, `POI_latitude`, `POI_longitude`, `POI_360url`, `POI_mini_logo`, `POI_id`)
VALUES
	(1,'La Llotja','la llotja descripcio','973221155','teatredelallotja@paeria.es','Avenida de Tortosa 4','Lleida','25005','http://www.lallotjadelleida.cat/',NULL,NULL,'https://googledrive.com/host/0Bxv48jdysarPV1hfemJWUTVOR0E/vtour/tour.html','lallotja.png','A00000'),
	(2,'Restaurante QR Café','qr descripcio','973193651','info@qrcafe.cat','Parque científico y tecnológico de Gardeny, s/n','Lleida','25071','http://www.qrcafe.cat/',NULL,NULL,'https://googledrive.com/host/0Bxv48jdysarPUlo4aFNpSHBTQjg/06/06-qr.html',NULL,'A00001'),
	(3,'Restaurant Caminito','caminito decripcio','973836176','info@restaurantcaminitolleida.com','Carrer Joc de la Bola 24 ','Lleida','25006','http://www.restaurantcaminitolleida.com/',NULL,NULL,'https://googledrive.com/host/0Bxv48jdysarPaUZhdzVSbFVwMnM/caminito%20in/caminito_in.html',NULL,'A00002'),
	(4,'L\'Antiquari tapes de mercat','l\'antiquari descripcio','973225149','menjarbe@lantiquaritapes.cat','Gran Passeig de Ronda 92','Lleida','25006','http://www.lantiquaritapes.cat/',NULL,NULL,'https://googledrive.com/host/0Bxv48jdysarPX054SXNFX2VmUVE/restaurant%20lantiquari/antiquari.html',NULL,'A00003');

/*!40000 ALTER TABLE `POIs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table publicKey
# ------------------------------------------------------------

DROP TABLE IF EXISTS `publicKey`;

CREATE TABLE `publicKey` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(256) DEFAULT NULL,
  `lastLogin` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `publicKey` WRITE;
/*!40000 ALTER TABLE `publicKey` DISABLE KEYS */;

INSERT INTO `publicKey` (`id`, `token`, `lastLogin`)
VALUES
	(1,'443ac6aa70d1df6e85b9f84ac8bb5abfc57c194c','2013-09-23 01:34:04');

/*!40000 ALTER TABLE `publicKey` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table usuaris
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuaris`;

CREATE TABLE `usuaris` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_usuari` varchar(25) DEFAULT NULL,
  `clau_acces` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tipus_usuari` varchar(10) DEFAULT NULL,
  `token` varchar(64) DEFAULT NULL,
  `tokenExpire` varchar(50) DEFAULT NULL,
  `lastLogin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `usuaris` WRITE;
/*!40000 ALTER TABLE `usuaris` DISABLE KEYS */;

INSERT INTO `usuaris` (`id`, `nom_usuari`, `clau_acces`, `email`, `tipus_usuari`, `token`, `tokenExpire`, `lastLogin`)
VALUES
	(1,'albert','albert','albertfarre@gmail.com','admin','2941f1de236541d2a9890bdad4466b5f','2013-09-23 00:10:06 ','2013-09-23 01:34:04'),
	(2,'usuari1','usuari1','usuari1@usuari1.com','normal','b3f21f863db3c75a1da646e80bbfad2f','2013-09-22 22:27:48 ','2013-09-22 22:12:48'),
	(3,'usuari2','usuari2','usuari2@usuari2.com','normal',NULL,NULL,NULL);

/*!40000 ALTER TABLE `usuaris` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

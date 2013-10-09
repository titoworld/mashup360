# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: mysql.farrepuche.com (MySQL 5.1.56-log)
# Database: mashup360
# Generation Time: 2013-10-09 23:13:27 +0000
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
  `POI_description` text,
  `POI_telefon` varchar(20) DEFAULT NULL,
  `POI_email` varchar(50) DEFAULT NULL,
  `POI_postal` varchar(100) DEFAULT NULL,
  `POI_ciutat` varchar(50) DEFAULT NULL,
  `POI_codi_postal` varchar(11) DEFAULT NULL,
  `POI_web` varchar(100) DEFAULT NULL,
  `POI_latitude` varchar(10) DEFAULT NULL,
  `POI_longitude` varchar(10) DEFAULT NULL,
  `POI_360url` varchar(100) DEFAULT NULL,
  `POI_360url2` varchar(100) DEFAULT NULL,
  `POI_mini_logo` varchar(50) DEFAULT NULL,
  `POI_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

LOCK TABLES `POIs` WRITE;
/*!40000 ALTER TABLE `POIs` DISABLE KEYS */;

INSERT INTO `POIs` (`id`, `POI_name`, `POI_description`, `POI_telefon`, `POI_email`, `POI_postal`, `POI_ciutat`, `POI_codi_postal`, `POI_web`, `POI_latitude`, `POI_longitude`, `POI_360url`, `POI_360url2`, `POI_mini_logo`, `POI_id`)
VALUES
	(31,'Restaurant El Café Dels Artistes de Lleida','-','973 22 48 58','-','Avinguad de Balàfia, 6, Lleida, 25005','lleida','25003','http://www.elcafedelsartistesdelleida.com','41.629751','0.623894','http://uploads.farrepuche.com/360POIView/POI_1381345848','v','','POI_1381345848'),
	(30,'Creperia Flash','-','973 22 18 40','creperia@creperiaflash.com','Avda Alcalde Porqueres 5, Lleida, 25005','lleida','25003','http://www.creperiaflash.com','41.6210716','0.6227279','http://uploads.farrepuche.com/360POIView/POI_1381345673',NULL,'','POI_1381345673'),
	(29,'Cal Ricard','-','973 23 69 40','info@calricard.com','Matí Gralla, 6, Lleida, 25005','lleida','25003','http://www.calricard.com','41.6260573','0.6294394','http://uploads.farrepuche.com/360POIView/POI_1381345590',NULL,'','POI_1381345590'),
	(24,'La Llotja','-','973221155','teatredelallotja@paeria.es','Avenida de Tortosa 4, Lleida','lleida','25003','www.lallotjadelleida.cat','41.6192746','0.6368894','http://uploads.farrepuche.com/360POIView/POI_1381343144',NULL,'','POI_1381343144'),
	(25,'Restaurant QR Café','-','973193651','info@qrcafe.cat','Parc científic i tecnològico de Gardeny, s/n, Lleida, 25071','lleida','25003','http://www.qrcafe.cat/','41.6082','0.6117361','http://uploads.farrepuche.com/360POIView/POI_1381343426',NULL,'','POI_1381343426'),
	(26,'Restaurant Caminito ','-','973836176','info@restaurantcaminitolleida.com','Carrer Joc de la Bola, 24, Lleida, 25006','lleida','25003','http://www.restaurantcaminitolleida.com/','41.6184295','0.6099639','http://uploads.farrepuche.com/360POIView/POI_1381344184',NULL,'','POI_1381344184'),
	(27,'L\'Antiquari tapes de mercat','-','973 22 51 49','menjarbe@lantiquaritapes.cat','Gran Passeig de Ronda, 92, Lleida, 25006','lleida','25003','http://www.l\'antiquaritapes.cat/','41.6198125','0.6157427','http://uploads.farrepuche.com/360POIView/POI_1381344464',NULL,'','POI_1381344464'),
	(28,'Restaurante Ke\'m D Fer S.C.P.','-','973 24 20 57','kdf-ba@restaurantkemdfer.com','Calle Baró d\'Eroles, 4, Lleida, 25008','lleida','25003','http://www.restaurantkemdfer.com','41.6198125','0.6157427','http://uploads.farrepuche.com/360POIView/POI_1381344721',NULL,'','POI_1381344721'),
	(32,'Restaurant Genial','-','973 24 14 71','info@genialrestaurant.com','Avinguda de Navarra, 1, Lleida, 25006','lleida','25003','http://www.genialrestaurant.com','41.6221482','0.6168658','http://uploads.farrepuche.com/360POIView/POI_1381345958',NULL,'','POI_1381345958'),
	(33,'El Celler del Roser','-','973 23 90 70 - 609 4','info@cellerdelroser.com','C/ Cavallers, 24, Lleida, 25002','lleida','25003','http://www.cellerdelroser.com','41.6140864','0.6241889','http://uploads.farrepuche.com/360POIView/POI_1381346087',NULL,'','POI_1381346087'),
	(34,'La Masia','-','973 23 42 24','info@restaurantlamasia-lleida.com','C/Democràcia, 16, Lleida, 25007','lleida','25003','http://www.elcafedelsartistesdelleida.com/','41.6193445','0.6298587','http://uploads.farrepuche.com/360POIView/POI_1381346427',NULL,'','POI_1381346427'),
	(35,'Restaurant Un','-','973 24 28 98','info@espaiun.com','Serra de Prades, 6, Lleida, 25006','lleida','25003','http://www.espaiun.com','41.6200525','0.618458','http://uploads.farrepuche.com/360POIView/POI_1381346705',NULL,'','POI_1381346705'),
	(36,'Penya Blau-Grana Som un Sentiment/Bar Elena','-','973 26 56 39','-','Carrer Bisbe Ruano, 24, Lleida, 25006','lleida','25003','http://www.somunsentiment.cat/','41.6170367','0.6172943','http://uploads.farrepuche.com/360POIView/POI_1381346787',NULL,'','POI_1381346787'),
	(37,'Bokados- BOK2','-','973 27 89 67','-','Acadèmia, 36, Lleida, 25002','lleida','25003','http://bok-dos.blogspot.com.es/','41.6106109','0.617523','http://uploads.farrepuche.com/360POIView/POI_1381346861',NULL,'','POI_1381346861'),
	(38,'Restaurant Aggio','-','973 26 61 55','toni-mf62@hotmail.com','Calle Templers, 3, Lleida, 25002','lleida','25003','http://www.restaurantaggio.com/','41.6105237','0.6171885','http://uploads.farrepuche.com/360POIView/POI_1381347081',NULL,'','POI_1381347081'),
	(39,'Restaurante Click','-','973 28 20 02 - 649 8','restaurantclick@gmail.com','Calle Academia 40, Lleida, 25002','lleida','25003','http://restauranteclick.multiespaciosweb.com/','41.6101881','0.6171938','http://uploads.farrepuche.com/360POIView/POI_1381347148',NULL,'','POI_1381347148'),
	(40,'Lo Caragol Restaurant','-','973 22 54 04','-','Carrer Sant Hilari 38, Lleida, 25008','lleida','25003','http://www.locaragol.cat/','41.624971','0.6199869','http://uploads.farrepuche.com/360POIView/POI_1381347234',NULL,'','POI_1381347234'),
	(41,'Cap i Cua','-','973 28 01 83','-','Acadèmia, 35, Lleida, 25002','lleida','25003','-','41.6104594','0.6176608','http://uploads.farrepuche.com/360POIView/POI_1381347341',NULL,'','POI_1381347341'),
	(42,'Cafetería La Bambola','-','973 220 921','lasbambolalleida@hotmail.com','Avinguda Doctor Fleming, Lleida, 25006','lleida','25003','www.labambolalleida.com/','41.6203483','0.6142117','http://uploads.farrepuche.com/360POIView/POI_1381347406',NULL,'','POI_1381347406'),
	(43,'Institut Josep Lladonosa','-','973 23 95 31','iesjoseplladonosa@iesjoseplladonosa.org','Plaça Maria Rubies S/N (Pardinyes), Lleida, 25005','lleida','25003','www.iesjoseplladonosa.org/','41.6225639','0.6372861','http://uploads.farrepuche.com/360POIView/POI_1381347475',NULL,'','POI_1381347475'),
	(44,'Mr garson S.C.P.','-','973 234 948','-','Calle Valenti Almirall 2, LLeida,  25004','lleida','25003','www.citiservi.es/lleida/mr-garson-s-c-p-lleida__968134_148.html','41.6211915','0.6263263','http://uploads.farrepuche.com/360POIView/POI_1381347555',NULL,'','POI_1381347555'),
	(45,'Perruqueria Antonieta','-','973 24 11 16','-','Prat de la Riba, 70, Lleida, 25004','lleida','25003','haypeluquerias.com/perruqueria-antonieta/lleida/id133433','41.6218354','0.6263644','http://uploads.farrepuche.com/360POIView/POI_1381347639',NULL,'','POI_1381347639'),
	(46,'L´Enrenou','-','973 83 35 45','-','Carrer del Corregidor Escofet, 77, Lleida, 25005','lleida','25003','-','41.6291832','0.6288081','http://uploads.farrepuche.com/360POIView/POI_1381347705',NULL,'','POI_1381347705'),
	(47,'Bar de Tapes El Lago','-','973 24 76 19','Lago.bardetapas@hotmail.es','Passeig de Ronda, 159, Lleida, 25008','lleida','25003','https://www.facebook.com/pages/Bar-de-Tapes-El-Lago/289100271118645','41.6231574','0.6196302','http://uploads.farrepuche.com/360POIView/POI_1381347800',NULL,'','POI_1381347800'),
	(48,'Bar Gilda','-','973 272 037','bargilda@hotmail.es','C/ Rei s/n, Lleida, 25006','lleida','25003','https://www.facebook.com/pages/Bar-Gilda/131571836946897','41.6385653','0.6279217','http://uploads.farrepuche.com/360POIView/POI_1381347918',NULL,'','POI_1381347918'),
	(49,'Paradis','-','973 27 2 795','-','Joan Baget, 20, Lleida, 25003','lleida','25003','www.reservarestaurantes.com/restaurantes/ficha/36210__Paradis--Lleida','41.6166477','0.619238','http://uploads.farrepuche.com/360POIView/POI_1381347987',NULL,'','POI_1381347987'),
	(50,'Sweet Fifties','-','973 25 49 17','info@sweetfifties.cat','Avinguda del Bisbe Ruano, 1, Lleida, 25006','lleida','25003','http://www.sweetfifties.cat/','41.6182916','0.6188264','http://uploads.farrepuche.com/360POIView/POI_1381348105',NULL,'','POI_1381348105'),
	(51,'Pizzeria La Trattoria Italiana','-','973 22 08 41','-','Serra del Cadí, 7, Lleida, 25006','lleida','25003','https://www.facebook.com/pages/Pizzeria-La-Trattoria-Italiana/215988776006','41.6205497','0.6177799','http://uploads.farrepuche.com/360POIView/POI_1381348166',NULL,'','POI_1381348166'),
	(52,'Tube','-','973 27 09 57','-','Av. Blondel, 13, Lleida, 25002','lleida','25003','www.cylex-espana.es/lleida/tube-12067619.html','41.612395','0.623811','http://uploads.farrepuche.com/360POIView/POI_1381348230',NULL,'','POI_1381348230'),
	(53,'Restaurant Vaporetto','-','973 24 00 25','-','Magí Morera, 59, Lleida, 25006','lleida','25003','es-la.facebook.com/restaurantvaporetto','41.6204915','0.6181861','http://uploads.farrepuche.com/360POIView/POI_1381348309',NULL,'','POI_1381348309'),
	(54,'Ziving','-','973 72 51 11 //973 7','-','Bisbe Ruano, 2 (Pl. Ricard Vinyes), Lleida, 25006','lleida','25003','ziving.net/','41.6182566','0.6144953','http://uploads.farrepuche.com/360POIView/POI_1381348360',NULL,'','POI_1381348360'),
	(55,'Raffel Pages','-','973 27 04 26','-','Torres de Sanuy, 11, Lleida, 25006','lleida','25003','http://www.raffelpages.com/','41.6179344','0.618581','http://uploads.farrepuche.com/360POIView/POI_1381348428',NULL,'','POI_1381348428'),
	(56,'Joieria Torres','-','973 22 36 05','-','Bisbe Ruano, 3, Lleida, 25006','lleida','25003','joyeria-torres-en--lleida.com/','41.6182105','0.6187356','http://uploads.farrepuche.com/360POIView/POI_1381348539',NULL,'','POI_1381348539'),
	(57,'Duch','-','973 24 91 45','-','Alcalde Rovira Roure, 13, Lleida, 25006','lleida','25003','www.duchlleida.com/','41.6209561','0.6181189','http://uploads.farrepuche.com/360POIView/POI_1381348591',NULL,'','POI_1381348591'),
	(58,'Ilargi','-','973 22 37 56','-','Torres de Sanui, 24, Lleida, 25006','lleida','25003','-','41.618078','0.6187974','http://uploads.farrepuche.com/360POIView/POI_1381348650',NULL,'','POI_1381348650'),
	(59,'Carnisseria Maria Begué','-','973 24 55 38','-','Torres de Sanui 32, Lleida, 25006','lleida','25003','http://www.mariabegue.com/catala/index.html','41.6181954','0.6183033','http://uploads.farrepuche.com/360POIView/POI_1381348737',NULL,'','POI_1381348737'),
	(60,'Carnisseria Maria Begué','-','973 23 42 35','-','Princep de Viana 83, Lleida, 25008','lleida','25003','-','41.6243166','0.6247641','http://uploads.farrepuche.com/360POIView/POI_1381348810',NULL,'','POI_1381348810'),
	(61,'Carnisseria Maria Begué','-','973 24 67 15','-','Plaça Noguerola 8, Lleida, 25007','lleida','25003','-','41.6189082','0.6323836','http://uploads.farrepuche.com/360POIView/POI_1381348870',NULL,'','POI_1381348870'),
	(62,'Cantonada 6','-','973 23 03 74','cantonada6simo@gmail.com','Bisbe Ruano, 6, Lleida, 25006','lleida','25003','-','41.6182403','0.618389','http://uploads.farrepuche.com/360POIView/POI_1381348921',NULL,'','POI_1381348921'),
	(63,'Federoptics Bellera','-','973 27 45 45','bellera@federopticos.com','Vallcalent, 28, Lleida, 25006','lleida','25003','www.federopticos.com/','41.6176117','0.6177536','http://uploads.farrepuche.com/360POIView/POI_1381349001',NULL,'','POI_1381349001'),
	(64,'OMAC','-','0.10','infocit@paeria.cat','Pl. Paeria, 11, Lleida, 25007','lleida','25003','omac.paeria.es/','41.614965','0.6268625','http://uploads.farrepuche.com/360POIView/POI_1381349060',NULL,'','POI_1381349060'),
	(65,'OGAT','-','010(*)','ofgestio@paeria.cat','Av. Blondel, 16, Lleida, 25002','lleida','25003','economia.paeria.es/area-economica/ogat','41.6140417','0.6262116','http://uploads.farrepuche.com/360POIView/POI_1381349140',NULL,'','POI_1381349140'),
	(66,'Magical Media','-','973 27 29 22','magical@magical.cat','Parc de Gardeny, Edifici CeDiCo, 1a Planta, Lleida,  25071','lleida','25003','www.magical.cat/','41.6175899','0.6200146','http://uploads.farrepuche.com/360POIView/POI_1381349214',NULL,'','POI_1381349214'),
	(67,'Viver d\'Empreses','-','973 23 81 43','cie@consorci.org','Parc Científic i Tecnològic, 23A, Lleida, 25071','lleida','25003','consorci.paeria.es/viver.php','41.6082','0.6117361','http://uploads.farrepuche.com/360POIView/POI_1381349282',NULL,'','POI_1381349282'),
	(68,'Viver d\'Empreses: Sagaris','-','973 27 49 96','info@sagaris.cat','Centre d’Iniciatives Empresarials Oficina 13, Edificio 26, Lleida, 25071','lleida','25003','www.sagaris.cat','41.6175899','0.6200146','http://uploads.farrepuche.com/360POIView/POI_1381349349',NULL,'','POI_1381349349'),
	(69,'Viver d\'Emp. Federació Allem','-','973 28 32 26','-','Edifici 23-A del Parc de Gardeny, Oficina número 19, Lleida, 25071','lleida','25003','www.allem.cat/','41.6082','0.6117361','http://uploads.farrepuche.com/360POIView/POI_1381349443',NULL,'','POI_1381349443'),
	(70,'CeDiCo','-','973 27 29 22','parc@pcital.es','Parc de Gardeny, Edifici CeDiCo 1a. planta, Lleida, 25071','lleida','25003','http://www.pcital.com/sobre-el-pcital/galeria/cedico/view','41.6082','0.6117361','http://uploads.farrepuche.com/360POIView/POI_1381349507',NULL,'','POI_1381349507'),
	(71,'Magical Mèdia','-','973 27 29 22','magical@magical.cat','Parc de Gardeny, Edifici CeDiCo, 1a Planta, Lleida, 25071','lleida','25003','http://www.magical.cat/','41.6082','0.6117361','http://uploads.farrepuche.com/360POIView/POI_1381349574',NULL,'','POI_1381349574'),
	(72,'Lleida Liquid Galaxy','-','973 27 29 22','parc@pcital.es','Parc de Gardeny, Edifici CeDiCo 1a. planta, Lleida, 25071','lleida','25003','http://www.pcital.biz/noticias/lleida-liquid-galaxy-primer-proyecto-de-realidad-aumentada-con-tecnol','41.6082','0.6117361','http://uploads.farrepuche.com/360POIView/POI_1381349662',NULL,'','POI_1381349662'),
	(73,'Lleida Drone','-','-','lleidadrone@gmail.com','Lleida','lleida','25003','www.lleidadrone.com/','41.6082','0.6117361','http://uploads.farrepuche.com/360POIView/POI_1381349742',NULL,'','POI_1381349742');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `publicKey` WRITE;
/*!40000 ALTER TABLE `publicKey` DISABLE KEYS */;

INSERT INTO `publicKey` (`id`, `token`, `lastLogin`)
VALUES
	(1,'6a038802cb1b487fe32024fb9a917c3506850158','2013-10-09 20:21:56');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `usuaris` WRITE;
/*!40000 ALTER TABLE `usuaris` DISABLE KEYS */;

INSERT INTO `usuaris` (`id`, `nom_usuari`, `clau_acces`, `email`, `tipus_usuari`, `token`, `tokenExpire`, `lastLogin`)
VALUES
	(1,'albert','albert','albertfarre@gmail.com','admin','e47e7144609c35095b62e94db85e2210','2013-09-23 00:10:06 ','2013-10-09 20:21:56'),
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

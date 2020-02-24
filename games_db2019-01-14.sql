# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Värd: localhost (MySQL 5.7.23)
# Databas: games_db
# Genereringstid: 2019-01-14 00:58:09 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Tabelldump game
# ------------------------------------------------------------

DROP TABLE IF EXISTS `game`;

CREATE TABLE `game` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(75) NOT NULL DEFAULT '',
  `developer` varchar(75) DEFAULT NULL,
  `publisher` varchar(75) DEFAULT NULL,
  `release_year` int(4) NOT NULL,
  `genre` varchar(75) DEFAULT NULL,
  `mode` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;

INSERT INTO `game` (`id`, `title`, `developer`, `publisher`, `release_year`, `genre`, `mode`)
VALUES
	(35,'Fallout 4','Bethesda Game Studios','Bethesda Softworks',2015,'Action role-playing','Single-player'),
	(38,'Far Cry 3','Ubisoft Montreal','Ubisoft',2012,'Action-adventure','Single-player, Multiplayer'),
	(39,'Far Cry 4','Ubisoft Montreal','Ubisoft',2014,'Action-adventure','Single-player, Multiplayer'),
	(40,'Far Cry Primal','Ubisoft Montreal','Ubisoft',2016,'Action-adventure','Single-player, Multiplayer'),
	(41,'Far Cry 5','Ubisoft Montreal','Ubisoft',2018,'Action-adventure','Single-player, Multiplayer'),
	(42,'Rise of the Tomb Raider ','Crystal Dynamics','Square Enix',2015,'Action-adventure','Single-player'),
	(43,'Stardew Valley','ConcernedApe','Chucklefish',2016,'Simulation','Single-player, Multiplayer'),
	(44,'Diablo 3','Blizzard Entertainment','Blizzard Entertainment',2012,'Hack and slash','Single-player, Multiplayer'),
	(45,'Layers of Fear','Bloober Team','Aspyr',2016,'Psychological horror','Single-player'),
	(46,'The Long Dark','Hinterland Studio','Hinterland Studio',2017,'Survival','Single-player'),
	(47,'Red Dead Redemption 2','Rockstar Studios','Rockstar Games',2018,'Action-adventure','Single-player, Multiplayer'),
	(48,'Tom Clancy\'s The Division','Massive Entertainment','Ubisoft',2016,'Action role-playing','Multiplayer'),
	(49,'The Sims 4','The Sims Studio','Electronic Arts',2014,'Simulation','Single-player'),
	(50,'Planet Coaster','Frontier Developments','Frontier Developments',2016,'Construction and management simulation','Single-player'),
	(51,'Life is stange','Dontnod Entertainment','Square Enix',2015,'Graphic adventure','Single-player'),
	(52,'Life is stange: Before the storm','Dontnod Entertainment','Square Enix',2018,'Graphic adventure','Single-player'),
	(53,'Cities: Skylines','Colossal Order','Paradox Interactive',2015,'Construction and management simulation','Single-player'),
	(54,'Detroit: Become human','Quantic Dream','Sony Interactive Entertainment',2018,'Adventure','Single-player'),
	(55,'The Last Of Us','Naughty Dog','Sony Computer Entertainment',2013,'Action-adventure','Single-player, Multiplayer'),
	(56,'Uncharted: Drake\'s Fortune','Naughty Dog','Sony Interactive Entertainment',2007,'Action-adventure','Single-player, Multiplayer'),
	(57,'Uncharted: The Lost Legacy','Naughty Dog','Sony Interactive Entertainment',2017,'Action-adventure','Single-player, Multiplayer'),
	(58,'Uncharted 2: Among Thieves','Naughty Dog','Sony Computer Entertainment',2009,'Action-adventure','Single-player, Multiplayer'),
	(59,'Uncharted 3: Drake\'s Deception','Naughty Dog','Sony Computer Entertainment',2011,'Action-adventure','Single-player, Multiplayer'),
	(60,'Final Fantasy XV','Square Enix Business Division 2','Square Enix',2016,'Action role-playing','Single-player'),
	(61,'Final Fantasy VII','Square','Square Enix',1997,'Role-playing','Single-player'),
	(62,'Ni no Kuni II: Revenant Kingdom','Level-5','Bandai Namco Entertainment',2018,'Action role-playing','Single-player');

/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;


# Tabelldump gameversion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gameversion`;

CREATE TABLE `gameversion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` int(11) unsigned NOT NULL,
  `platform_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gv_game` (`game_id`),
  KEY `fk_gv_platform` (`platform_id`),
  CONSTRAINT `fk_gv_game` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  CONSTRAINT `fk_gv_platform` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gameversion` WRITE;
/*!40000 ALTER TABLE `gameversion` DISABLE KEYS */;

INSERT INTO `gameversion` (`id`, `game_id`, `platform_id`)
VALUES
	(4,35,6),
	(5,35,8),
	(6,35,5),
	(7,38,6),
	(8,38,3),
	(9,38,4),
	(10,38,7),
	(11,38,8),
	(12,39,6),
	(13,39,3),
	(14,39,4),
	(15,39,7),
	(16,39,8),
	(17,40,6),
	(18,40,5),
	(19,40,8),
	(20,41,6),
	(21,41,5),
	(22,41,8),
	(23,42,6),
	(24,42,7),
	(25,42,8),
	(26,42,5),
	(27,42,2),
	(28,42,1),
	(29,43,6),
	(30,43,2),
	(32,43,5),
	(33,43,1),
	(34,43,8),
	(35,43,3),
	(36,43,9),
	(37,44,6),
	(38,44,2),
	(39,44,4),
	(40,44,5),
	(41,44,7),
	(42,44,8),
	(43,44,3),
	(44,45,6),
	(45,45,1),
	(46,45,2),
	(47,45,5),
	(48,45,8),
	(49,45,3),
	(50,46,6),
	(51,46,1),
	(52,46,2),
	(53,46,5),
	(54,46,8),
	(55,47,5),
	(56,47,8),
	(57,48,6),
	(58,48,5),
	(59,48,8),
	(60,49,6),
	(61,49,2),
	(62,49,8),
	(63,49,5),
	(64,50,6),
	(65,51,6),
	(66,51,1),
	(67,51,2),
	(68,51,4),
	(69,51,5),
	(70,51,7),
	(71,51,8),
	(72,52,6),
	(73,52,1),
	(74,52,2),
	(75,52,5),
	(76,52,8),
	(77,53,6),
	(78,53,1),
	(79,53,2),
	(80,53,8),
	(81,53,5),
	(82,53,3),
	(83,54,5),
	(84,56,4),
	(85,56,5),
	(86,55,4),
	(87,57,5),
	(88,58,4),
	(89,58,5),
	(90,59,4),
	(91,59,5),
	(92,61,5),
	(93,61,6),
	(94,61,8),
	(95,61,3),
	(96,60,8),
	(97,60,6),
	(98,60,5),
	(99,62,6),
	(100,62,5);

/*!40000 ALTER TABLE `gameversion` ENABLE KEYS */;
UNLOCK TABLES;


# Tabelldump platform
# ------------------------------------------------------------

DROP TABLE IF EXISTS `platform`;

CREATE TABLE `platform` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `platform` WRITE;
/*!40000 ALTER TABLE `platform` DISABLE KEYS */;

INSERT INTO `platform` (`id`, `name`)
VALUES
	(1,'Linux'),
	(2,'Mac'),
	(3,'Nintendo Swich'),
	(4,'Playstation 3'),
	(5,'Playstation 4'),
	(6,'Windows'),
	(7,'Xbox 360'),
	(8,'Xbox One'),
	(9,'Playstation Vita');

/*!40000 ALTER TABLE `platform` ENABLE KEYS */;
UNLOCK TABLES;


# Tabelldump user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`)
VALUES
	(1,'Lisa','Wetterberg','happycat'),
	(2,'Agnes','Vidal','happydog'),
	(3,'Shinji','Hashimoto','sadpanda'),
	(4,'Amy','Hennig','ladybird');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Tabelldump usergameversion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usergameversion`;

CREATE TABLE `usergameversion` (
  `user_id` int(11) unsigned NOT NULL,
  `gameversion_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`gameversion_id`),
  KEY `fk_uvg_gameversion` (`gameversion_id`),
  CONSTRAINT `fk_ugv_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_uvg_gameversion` FOREIGN KEY (`gameversion_id`) REFERENCES `gameversion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `usergameversion` WRITE;
/*!40000 ALTER TABLE `usergameversion` DISABLE KEYS */;

INSERT INTO `usergameversion` (`user_id`, `gameversion_id`)
VALUES
	(2,5),
	(3,6),
	(4,10),
	(2,11),
	(2,16),
	(2,19),
	(2,22),
	(3,23),
	(2,25),
	(1,29),
	(1,30),
	(2,30),
	(3,35),
	(1,37),
	(1,38),
	(2,38),
	(3,40),
	(2,46),
	(4,48),
	(3,49),
	(2,52),
	(2,56),
	(4,56),
	(2,59),
	(4,59),
	(1,60),
	(1,61),
	(2,61),
	(4,62),
	(1,64),
	(1,65),
	(1,67),
	(4,70),
	(1,72),
	(1,74),
	(1,77),
	(1,79),
	(1,83),
	(4,88),
	(4,90),
	(3,95),
	(3,98),
	(3,100);

/*!40000 ALTER TABLE `usergameversion` ENABLE KEYS */;
UNLOCK TABLES;


# Tabelldump userplatform
# ------------------------------------------------------------

DROP TABLE IF EXISTS `userplatform`;

CREATE TABLE `userplatform` (
  `user_id` int(11) unsigned NOT NULL,
  `platform_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`platform_id`),
  KEY `fk_up_platform` (`platform_id`),
  CONSTRAINT `fk_up_platform` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`),
  CONSTRAINT `fk_up_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `userplatform` WRITE;
/*!40000 ALTER TABLE `userplatform` DISABLE KEYS */;

INSERT INTO `userplatform` (`user_id`, `platform_id`)
VALUES
	(1,2),
	(2,2),
	(3,3),
	(4,4),
	(1,5),
	(3,5),
	(1,6),
	(3,6),
	(4,7),
	(2,8),
	(4,8);

/*!40000 ALTER TABLE `userplatform` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

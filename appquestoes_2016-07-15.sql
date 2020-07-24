# ************************************************************
# Sequel Pro SQL dump
# Versão 4500
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.21)
# Base de Dados: appquestoes
# Tempo de Geração: 2016-07-15 11:55:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela audit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `audit`;

CREATE TABLE `audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createdAt` datetime DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `query` text,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `audit` WRITE;
/*!40000 ALTER TABLE `audit` DISABLE KEYS */;

INSERT INTO `audit` (`id`, `createdAt`, `usuario_id`, `query`, `url`)
VALUES
	(56,'2016-07-14 12:19:59',1,'INSERT INTO `menus` (`descricao`, `url`, `icone`, `createdAt`) VALUES (\'Configurações\', \'[removed];\', \'fa fa-cogs\', \'2016-07-14 12:19:59\')','http://localhost/appquestoes/menus/criar'),
	(57,'2016-07-14 12:20:21',1,'INSERT INTO `menus` (`menus_id`, `descricao`, `url`, `icone`, `createdAt`) VALUES (\'6\', \'Menus\', \'/menus\', \'fa fa-list\', \'2016-07-14 12:20:21\')','http://localhost/appquestoes/menus/criar'),
	(58,'2016-07-14 12:20:42',1,'INSERT INTO `menus` (`menus_id`, `descricao`, `url`, `icone`, `createdAt`) VALUES (\'6\', \'Usuarios\', \'/usuarios\', \'fa fa-user\', \'2016-07-14 12:20:42\')','http://localhost/appquestoes/menus/criar'),
	(59,'2016-07-14 12:21:01',1,'INSERT INTO `menus` (`descricao`, `url`, `icone`, `createdAt`) VALUES (\'Perfis de Acesso\', \'/perfis\', \'fa fa-group\', \'2016-07-14 12:21:01\')','http://localhost/appquestoes/menus/criar'),
	(60,'2016-07-14 12:21:26',1,'INSERT INTO `perfis` (`descricao`, `createdAt`) VALUES (\'Administrador\', \'2016-07-14 12:21:26\')','http://localhost/appquestoes/perfis/criar'),
	(61,'2016-07-14 12:21:26',1,'INSERT INTO `perfis_menus` (`menus_id`, `perfis_id`) VALUES (\'6\', 2)','http://localhost/appquestoes/perfis/criar'),
	(62,'2016-07-14 12:21:26',1,'INSERT INTO `perfis_menus` (`menus_id`, `perfis_id`) VALUES (\'7\', 2)','http://localhost/appquestoes/perfis/criar'),
	(63,'2016-07-14 12:21:26',1,'INSERT INTO `perfis_menus` (`menus_id`, `perfis_id`) VALUES (\'8\', 2)','http://localhost/appquestoes/perfis/criar'),
	(64,'2016-07-14 12:21:27',1,'INSERT INTO `perfis_menus` (`menus_id`, `perfis_id`) VALUES (\'9\', 2)','http://localhost/appquestoes/perfis/criar'),
	(65,'2016-07-14 12:21:47',1,'UPDATE `menus` SET `id` = \'9\', `menus_id` = \'6\', `descricao` = \'Perfis de Acesso\', `url` = \'/perfis\', `icone` = \'fa fa-group\', `updatedAt` = \'2016-07-14 12:21:47\' WHERE `id` =  \'9\'','http://localhost/appquestoes/menus/editar/9'),
	(66,'2016-07-14 12:22:10',1,'INSERT INTO `usuarios` (`usuario`, `nome`, `email`, `senha`, `createdAt`) VALUES (\'umeduardo\', \'Eduardo Fortes\', \'umeduardo@gmail.com\', \'qod/AO5erJUQXDMUbNhjSYpEYO9O6EJGMMrU995gfhH2bv9wEiDwnquAmZotolFeBVQOoJ18zUGl7yvVCSuD9w==\', \'2016-07-14 12:22:10\')','http://localhost/appquestoes/usuarios/criar'),
	(67,'2016-07-14 12:22:10',1,'INSERT INTO `usuarios_perfis` (`usuarios_id`, `perfis_id`) VALUES (2, \'2\')','http://localhost/appquestoes/usuarios/criar');

/*!40000 ALTER TABLE `audit` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela bancas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bancas`;

CREATE TABLE `bancas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump da tabela ci_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(45) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(11) unsigned NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`),
  KEY `last_actvity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump da tabela clientes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_empresa` varchar(100) NOT NULL,
  `nome_responsavel` varchar(100) NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `telefone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `configuracoes` text,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump da tabela menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menus_id` int(11) DEFAULT NULL,
  `descricao` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL,
  `icone` varchar(45) NOT NULL,
  `createdAt` varchar(45) NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_menus_menus1_idx` (`menus_id`),
  CONSTRAINT `fk_menus_menus1` FOREIGN KEY (`menus_id`) REFERENCES `menus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;

INSERT INTO `menus` (`id`, `menus_id`, `descricao`, `url`, `icone`, `createdAt`, `updatedAt`)
VALUES
	(6,NULL,'Configurações','[removed];','fa fa-cogs','2016-07-14 12:19:59',NULL),
	(7,6,'Menus','/menus','fa fa-list','2016-07-14 12:20:21',NULL),
	(8,6,'Usuarios','/usuarios','fa fa-user','2016-07-14 12:20:42',NULL),
	(9,6,'Perfis de Acesso','/perfis','fa fa-group','2016-07-14 12:21:01','2016-07-14 12:21:47');

/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela perfis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `perfis`;

CREATE TABLE `perfis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `perfis` WRITE;
/*!40000 ALTER TABLE `perfis` DISABLE KEYS */;

INSERT INTO `perfis` (`id`, `descricao`, `createdAt`, `updatedAt`)
VALUES
	(2,'Administrador','2016-07-14 12:21:26',NULL);

/*!40000 ALTER TABLE `perfis` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela perfis_menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `perfis_menus`;

CREATE TABLE `perfis_menus` (
  `perfis_id` int(11) NOT NULL,
  `menus_id` int(11) NOT NULL,
  PRIMARY KEY (`perfis_id`,`menus_id`),
  KEY `fk_perfis_has_menus_menus1_idx` (`menus_id`),
  KEY `fk_perfis_has_menus_perfis1_idx` (`perfis_id`),
  CONSTRAINT `fk_perfis_has_menus_menus1` FOREIGN KEY (`menus_id`) REFERENCES `menus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfis_has_menus_perfis1` FOREIGN KEY (`perfis_id`) REFERENCES `perfis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `perfis_menus` WRITE;
/*!40000 ALTER TABLE `perfis_menus` DISABLE KEYS */;

INSERT INTO `perfis_menus` (`perfis_id`, `menus_id`)
VALUES
	(2,6),
	(2,7),
	(2,8),
	(2,9);

/*!40000 ALTER TABLE `perfis_menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `senha` varchar(250) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_usuarios_clientes1_idx` (`clientes_id`),
  CONSTRAINT `fk_usuarios_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

INSERT INTO `usuarios` (`id`, `usuario`, `nome`, `email`, `telefone`, `senha`, `createdAt`, `updatedAt`, `clientes_id`, `principal`)
VALUES
	(2,'umeduardo','Eduardo Fortes','umeduardo@gmail.com',NULL,'qod/AO5erJUQXDMUbNhjSYpEYO9O6EJGMMrU995gfhH2bv9wEiDwnquAmZotolFeBVQOoJ18zUGl7yvVCSuD9w==','2016-07-14 12:22:10',NULL,NULL,0);

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela usuarios_perfis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios_perfis`;

CREATE TABLE `usuarios_perfis` (
  `usuarios_id` int(11) NOT NULL,
  `perfis_id` int(11) NOT NULL,
  PRIMARY KEY (`usuarios_id`,`perfis_id`),
  KEY `fk_usuarios_has_perfis_perfis1_idx` (`perfis_id`),
  KEY `fk_usuarios_has_perfis_usuarios1_idx` (`usuarios_id`),
  CONSTRAINT `fk_usuarios_has_perfis_perfis1` FOREIGN KEY (`perfis_id`) REFERENCES `perfis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_perfis_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `usuarios_perfis` WRITE;
/*!40000 ALTER TABLE `usuarios_perfis` DISABLE KEYS */;

INSERT INTO `usuarios_perfis` (`usuarios_id`, `perfis_id`)
VALUES
	(2,2);

/*!40000 ALTER TABLE `usuarios_perfis` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- Servidor:                     172.17.10.115
-- Versão do servidor:           5.6.24-0ubuntu2 - (Ubuntu)
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para escola
CREATE DATABASE IF NOT EXISTS `escola` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `escola`;


-- Copiando estrutura para tabela escola.alunos
CREATE TABLE IF NOT EXISTS `alunos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nota` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela escola.alunos: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `alunos` DISABLE KEYS */;
INSERT INTO `alunos` (`id`, `nome`, `nota`) VALUES
	(1, 'Roger', 8),
	(3, 'Marlon', 4),
	(8, 'Silvia Santos', 10),
	(10, 'Regina', 7),
	(14, 'Marcos', 9),
	(16, 'Gisele', 5),
	(19, 'Leandra', 3),
	(35, 'GregÃ³rio', 7);
/*!40000 ALTER TABLE `alunos` ENABLE KEYS */;


-- Copiando estrutura para tabela escola.confirm
CREATE TABLE IF NOT EXISTS `confirm` (
  `id_confirm` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nm_key` varchar(50) NOT NULL,
  `nm_email` varchar(50) NOT NULL,
  `nm_type` varchar(50) NOT NULL COMMENT 'C (Confirm) or R (Reset)',
  `dt_create` date NOT NULL,
  PRIMARY KEY (`id_confirm`),
  KEY `FK_confirm_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela escola.confirm: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `confirm` DISABLE KEYS */;
INSERT INTO `confirm` (`id_confirm`, `id_user`, `nm_key`, `nm_email`, `nm_type`, `dt_create`) VALUES
	(112, 174, '18b3c96b620d7ccab1e84dd9e44bb386', 'roger.bastida@gmail.com', 'C', '2016-03-21'),
	(113, 175, 'fac8e8282100e4203dae2f0389142a5b', 'roger.bastida2@gmail.com', 'C', '2016-03-21');
/*!40000 ALTER TABLE `confirm` ENABLE KEYS */;


-- Copiando estrutura para tabela escola.status
CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `nm_name` varchar(50) NOT NULL,
  `nm_description` varchar(50) NOT NULL,
  `is_synced` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela escola.status: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id_status`, `nm_name`, `nm_description`, `is_synced`) VALUES
	(1, 'Active', 'Any record', 0),
	(2, 'Inactive', 'Any record', 0),
	(3, 'Confirmed', 'Registration', 0),
	(4, 'Selected', 'Tracker', 0),
	(5, 'Read', 'Inbox/Alert', 0),
	(6, 'Unread', 'Inbox/Alert', 0),
	(7, 'Flagged', 'User', 0),
	(8, 'Banned', 'User', 0),
	(9, 'Expired', 'Subscription', 0),
	(10, 'Done', 'To-Do', 0),
	(11, 'Deleted', 'Any record', 0),
	(12, 'Unconfirmed', 'Registration', 0);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;


-- Copiando estrutura para tabela escola.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `nm_username` varchar(50) NOT NULL,
  `nm_password` varchar(50) NOT NULL,
  `nm_email` varchar(50) NOT NULL,
  `id_user_role` int(5) NOT NULL COMMENT 'Ref. User Role',
  `dt_create` datetime NOT NULL,
  `dt_update` datetime NOT NULL,
  `id_status` int(5) NOT NULL COMMENT 'Ref.  Status',
  `dt_subscribe` datetime NOT NULL,
  `dt_expire` datetime NOT NULL,
  `is_synced` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `FK_user_user_role` (`id_user_role`),
  KEY `FK_user_status` (`id_status`),
  CONSTRAINT `FK_user_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`),
  CONSTRAINT `FK_user_user_role` FOREIGN KEY (`id_user_role`) REFERENCES `user_role` (`id_user_role`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela escola.user: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `nm_username`, `nm_password`, `nm_email`, `id_user_role`, `dt_create`, `dt_update`, `id_status`, `dt_subscribe`, `dt_expire`, `is_synced`) VALUES
	(174, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'roger.bastida@gmail.com', 2, '2016-03-21 00:00:00', '2016-03-21 00:00:00', 1, '2016-03-21 00:00:00', '2116-03-21 00:00:00', 0),
	(175, 'carlinhos', 'e96f91c1add09226031216515993006a', 'roger.bastida2@gmail.com', 2, '2016-03-21 00:00:00', '2016-03-21 00:00:00', 1, '2016-03-21 00:00:00', '2116-03-21 00:00:00', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Copiando estrutura para tabela escola.user_permission
CREATE TABLE IF NOT EXISTS `user_permission` (
  `id_user_permission` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL COMMENT 'Ref. User Role',
  `dt_create` datetime NOT NULL,
  `dt_update` datetime NOT NULL,
  `id_status` int(11) NOT NULL COMMENT 'Ref.  Status',
  `dt_subscribe` datetime NOT NULL,
  `dt_expire` datetime NOT NULL,
  `is_synced` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user_permission`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela escola.user_permission: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `user_permission` DISABLE KEYS */;
INSERT INTO `user_permission` (`id_user_permission`, `id_user`, `dt_create`, `dt_update`, `id_status`, `dt_subscribe`, `dt_expire`, `is_synced`) VALUES
	(39, 2, '2015-10-09 00:00:00', '2015-10-09 00:00:00', 1, '2015-10-09 00:00:00', '2115-10-09 00:00:00', 0);
/*!40000 ALTER TABLE `user_permission` ENABLE KEYS */;


-- Copiando estrutura para tabela escola.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `id_user_role` int(11) NOT NULL AUTO_INCREMENT,
  `nm_name` varchar(50) NOT NULL,
  `is_synced` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user_role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela escola.user_role: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`id_user_role`, `nm_name`, `is_synced`) VALUES
	(1, 'ADMIN', NULL),
	(2, 'FREE', NULL),
	(3, 'FREEDOM', NULL),
	(4, 'TRIAL', NULL),
	(5, 'PREMIUM', NULL);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


-- Copiando estrutura para tabela escola.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela escola.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `password`) VALUES
	(22, 'ROGER', 'teste'),
	(23, 'ROGER', 'admin');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

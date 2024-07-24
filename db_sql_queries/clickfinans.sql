-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para clickfinans
CREATE DATABASE IF NOT EXISTS `clickfinans` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `clickfinans`;

-- Copiando estrutura para tabela clickfinans.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  `cat_usuario_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_fk_idx` (`cat_usuario_fk`),
  CONSTRAINT `cat_usuario_fk` FOREIGN KEY (`cat_usuario_fk`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela clickfinans.categoria: ~10 rows (aproximadamente)
INSERT INTO `categoria` (`id`, `descricao`, `cat_usuario_fk`) VALUES
	(1, 'super mercado', 1),
	(5, 'educação/treinamento', 1),
	(6, 'luz', 1),
	(7, 'agua', 1),
	(8, 'vestuario', 1),
	(11, 'lazer', 1),
	(14, 'investimentos', 1),
	(16, 'internet/telefone', 1),
	(17, 'outros', 1),
	(18, 'bar/restaurante', 1);

-- Copiando estrutura para tabela clickfinans.despesa
CREATE TABLE IF NOT EXISTS `despesa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  `categoria_fk` int(11) DEFAULT NULL,
  `dt_despesa` date NOT NULL,
  `usuario_fk` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_fk_idx` (`categoria_fk`),
  KEY `usuario_fk` (`usuario_fk`),
  CONSTRAINT `categoria_fk` FOREIGN KEY (`categoria_fk`) REFERENCES `categoria` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `usuario_fk` FOREIGN KEY (`usuario_fk`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela clickfinans.despesa: ~12 rows (aproximadamente)
INSERT INTO `despesa` (`id`, `descricao`, `valor`, `categoria_fk`, `dt_despesa`, `usuario_fk`) VALUES
	(16, 'cta net', 99.9, 16, '2023-01-01', 1),
	(17, 'compras supermercado', 31.72, 1, '2023-01-02', 1),
	(18, 'compras supermercado', 17.86, 1, '2023-01-04', 1),
	(19, 'compras supermercado', 12.97, 1, '2023-01-05', 1),
	(20, 'soro fisiológico', 4.99, NULL, '2023-01-06', 1),
	(21, 'compras supermercado', 20.52, 1, '2023-01-07', 1),
	(22, 'agua mineral ', 3, 11, '2023-01-07', 1),
	(23, 'agua mineral ', 3, 11, '2023-01-08', 1),
	(24, 'almoço no direct', 35.1, 18, '2023-01-10', 1),
	(25, 'compras supermercado', 24.75, 1, '2023-01-11', 1),
	(26, 'compras supermercado', 9.24, 1, '2023-01-12', 1),
	(27, 'cerveja skol', 3.89, 1, '2023-11-10', 1);

-- Copiando estrutura para view clickfinans.expense_view
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `expense_view` (
	`desp_id` INT(11) NOT NULL,
	`descricao` VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	`valor` FLOAT NOT NULL,
	`cat_id` INT(11) NULL,
	`categoria` VARCHAR(45) NULL COLLATE 'utf8_unicode_ci',
	`dt_despesa` DATE NOT NULL,
	`user_id` INT(11) NULL,
	`user_nome` VARCHAR(40) NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

-- Copiando estrutura para tabela clickfinans.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `img_path` varchar(50) DEFAULT NULL,
  `dt_cadastro` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela clickfinans.usuario: ~1 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `nome`, `email`, `password`, `img_path`, `dt_cadastro`) VALUES
	(1, 'rodrigo', 'rod@email.net', '$2y$10$6diA4W4yIGtGje6V.c1.cuJFJqls7fpoZKNo6Di62BX/jT3MGIIee', 'images/profile/rod.jpg', '2022-12-09');

-- Copiando estrutura para view clickfinans.expense_view
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `expense_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `expense_view` AS SELECT
       d.id as desp_id, 
       d.descricao as descricao,
       d.valor as valor,
       c.id AS cat_id,
       c.descricao as categoria,
       d.dt_despesa as dt_despesa,
       u.id as user_id,
       u.nome as user_nome
       
       FROM
     despesa d
      LEFT JOIN categoria c ON d.categoria_fk = c.id
      LEFT JOIN usuario u ON d.usuario_fk = u.id
  ORDER BY  d.dt_despesa DESC ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6957
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bd_tienda
CREATE DATABASE IF NOT EXISTS `bd_tienda` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bd_tienda`;

-- Volcando estructura para tabla bd_tienda.accesos
CREATE TABLE IF NOT EXISTS `accesos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) DEFAULT NULL,
  `pass` varchar(250) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `correcto` tinyint(4) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bd_tienda.accesos: ~60 rows (aproximadamente)
DELETE FROM `accesos`;
INSERT INTO `accesos` (`id`, `email`, `pass`, `ip`, `correcto`, `fecha`) VALUES
	(1, NULL, NULL, NULL, 1, '2024-12-16 18:22:38'),
	(3, NULL, '0000', '::1', 1, '2024-12-18 18:32:55'),
	(4, NULL, '0000', '::1', 1, '2024-12-18 19:02:34'),
	(5, NULL, '0000', '::1', 1, '2024-12-19 17:52:04'),
	(6, NULL, '1111', '::1', 1, '2024-12-19 17:54:34'),
	(7, NULL, '0000', '::1', 1, '2024-12-19 18:52:04'),
	(8, NULL, '0000', '::1', 1, '2024-12-19 18:52:29'),
	(9, NULL, '0000', '::1', 1, '2024-12-19 18:59:33'),
	(10, NULL, '0000', '::1', 1, '2024-12-19 19:01:19'),
	(11, NULL, '1111', '::1', 1, '2024-12-19 19:55:11'),
	(12, NULL, '1111', '::1', 1, '2024-12-19 19:57:00'),
	(13, NULL, '0000', '::1', 1, '2024-12-19 19:57:12'),
	(14, NULL, '0000', '::1', 1, '2024-12-19 20:13:26'),
	(15, NULL, '1111', '::1', 1, '2024-12-19 20:13:36'),
	(16, NULL, '1111', '::1', 1, '2024-12-19 20:14:56'),
	(17, NULL, '1111', '::1', 1, '2024-12-19 20:17:55'),
	(18, NULL, '0000', '::1', 1, '2024-12-20 16:02:34'),
	(19, NULL, '1111', '::1', 1, '2024-12-20 16:09:03'),
	(20, NULL, '0000', '::1', 1, '2024-12-20 16:17:15'),
	(21, NULL, '0000', '::1', 1, '2025-01-07 15:58:34'),
	(22, NULL, '0000', '::1', 1, '2025-01-07 17:11:07'),
	(23, NULL, '0000', '::1', 0, '2025-01-07 17:12:08'),
	(24, NULL, '0000', '::1', 1, '2025-01-07 17:12:14'),
	(25, NULL, '0000', '::1', 1, '2025-01-07 18:23:27'),
	(26, NULL, '0000', '::1', 1, '2025-01-07 18:26:57'),
	(27, NULL, '0000', '::1', 1, '2025-01-07 18:34:34'),
	(28, NULL, '1', '::1', 0, '2025-01-07 18:39:23'),
	(29, NULL, '0000', '::1', 0, '2025-01-07 18:59:01'),
	(30, NULL, '0000', '::1', 0, '2025-01-07 18:59:06'),
	(31, NULL, '0000', '::1', 0, '2025-01-07 18:59:15'),
	(32, NULL, '0000', '::1', 0, '2025-01-07 18:59:24'),
	(33, 'juan@fempa.com', '0000', '::1', 1, '2025-01-07 19:01:57'),
	(34, 'juan@gmail.com', '1111', '::1', 1, '2025-01-07 19:03:06'),
	(35, 'juan@fempa.com', '0000', '::1', 1, '2025-01-07 19:03:16'),
	(36, 'juan@fempa.com', '0000', '::1', 1, '2025-01-07 19:04:31'),
	(37, 'juan@fempa.com', '0000', '::1', 1, '2025-01-07 19:05:24'),
	(38, 'juan@fempa.com', '0000', '::1', 1, '2025-01-15 19:12:54'),
	(39, 'juan@fempa.com', '0000', '::1', 1, '2025-01-20 19:02:19'),
	(40, 'juan@fempa.com', '0000', '::1', 1, '2025-01-21 16:08:37'),
	(41, 'juan@fempa.com', '000', '::1', 0, '2025-01-21 20:57:27'),
	(42, 'juan@fempa.com', '0000', '::1', 1, '2025-01-21 20:57:33'),
	(43, 'juan@fempa.com', '0000', '::1', 1, '2025-01-22 16:19:18'),
	(44, 'Juan', '123', '::1', 0, '2025-01-22 18:17:33'),
	(45, 'juan@fempa.com', '0000', '::1', 1, '2025-01-22 18:17:43'),
	(46, 'juan@fempa.com', '1111', '::1', 0, '2025-02-05 18:46:46'),
	(47, 'juan@fempa.com', '0000', '::1', 0, '2025-02-05 18:50:17'),
	(48, 'juan@fempa.com', '1111', '::1', 0, '2025-02-05 18:50:26'),
	(49, 'Alejandro', '1111', '::1', 0, '2025-02-05 18:51:05'),
	(50, 'alejandro@gmail.com', '1111', '::1', 1, '2025-02-05 18:51:37'),
	(51, 'alejandro@gmail.com', '1111', '::1', 1, '2025-02-06 20:32:14'),
	(52, 'tab@gmail.com', '1111', '::1', 0, '2025-02-11 15:50:15'),
	(53, 'tab@gmail.com', '1111', '::1', 0, '2025-02-11 15:50:20'),
	(54, 'tab@gmail.com', '0000', '::1', 0, '2025-02-11 15:51:03'),
	(55, 'tab@gmail.com', '1111', '::1', 0, '2025-02-11 15:51:10'),
	(56, 'admin@gmail.com', '1111', '::1', 1, '2025-02-11 15:52:20'),
	(57, 'tab@gmail.com', '1111', '::1', 0, '2025-02-11 19:44:07'),
	(58, 'admin@gmail.com', '1111', '::1', 1, '2025-02-11 19:44:18'),
	(59, 'admin@gmail.com', '1111', '::1', 1, '2025-02-11 19:46:05'),
	(60, 'tab@gmail.com', '1111', '::1', 0, '2025-02-12 15:49:31'),
	(61, 'admin@gmail.com', '1111', '::1', 1, '2025-02-12 15:49:36'),
	(62, 'admin@gmail.com', '1111', '::1', 1, '2025-02-12 19:38:49');

-- Volcando estructura para tabla bd_tienda.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bd_tienda.categorias: ~3 rows (aproximadamente)
DELETE FROM `categorias`;
INSERT INTO `categorias` (`nombre`) VALUES
	('hombre'),
	('mujer'),
	('ofertas');

-- Volcando estructura para tabla bd_tienda.detalles_pedido
CREATE TABLE IF NOT EXISTS `detalles_pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido-id` (`id_pedido`),
  KEY `producto-id` (`id_producto`),
  CONSTRAINT `pedido-id` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `producto-id` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bd_tienda.detalles_pedido: ~16 rows (aproximadamente)
DELETE FROM `detalles_pedido`;
INSERT INTO `detalles_pedido` (`id_pedido`, `id_producto`, `id`, `cantidad`) VALUES
	(4, 4, 1, 1),
	(4, 4, 2, 1),
	(5, 5, 3, 1),
	(6, 6, 4, 1),
	(6, 6, 5, 1),
	(6, 6, 6, 1),
	(6, 6, 7, 1),
	(6, 6, 8, 1),
	(6, 6, 9, 1),
	(6, 6, 10, 1),
	(6, 6, 11, 1),
	(6, 6, 12, 1),
	(6, 6, 13, 1),
	(6, 6, 14, 1),
	(6, 6, 15, 1),
	(6, 6, 16, 1),
	(7, 1, 17, 1),
	(7, 5, 18, 1),
	(7, 5, 19, 1),
	(7, 5, 20, 1),
	(7, 8, 21, 1),
	(7, 7, 22, 1),
	(7, 8, 23, 1);

-- Volcando estructura para tabla bd_tienda.fotos
CREATE TABLE IF NOT EXISTS `fotos` (
  `ruta` varchar(500) DEFAULT NULL,
  `id_producto` int(11) NOT NULL,
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `fotos-productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bd_tienda.fotos: ~13 rows (aproximadamente)
DELETE FROM `fotos`;
INSERT INTO `fotos` (`ruta`, `id_producto`) VALUES
	('img/cazadora_negra.jpg', 1),
	('img/camisa.jpg', 2),
	('img/camiseta.jpg', 3),
	('img/blanco.jpg', 4),
	('img/pantalones_azules.jpg', 5),
	('img/pantalones_blancos.jpg', 6),
	('img/cazadora_negra_m.jpg', 7),
	('img/jeans_negros_m.jpg', 8),
	('img/falda_negra_m.jpg', 9),
	('img/blusa_blanca_m.jpg', 10),
	('img/vestido_blanco_m.jpg', 11),
	('img/678fd486ae2d5_vestidonegromu.png', 12),
	('img/678fd47049ed9_pantalonesnegros.jpg', 14);

-- Volcando estructura para tabla bd_tienda.frases
CREATE TABLE IF NOT EXISTS `frases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frase` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bd_tienda.frases: ~0 rows (aproximadamente)
DELETE FROM `frases`;

-- Volcando estructura para tabla bd_tienda.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(20,6) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario-pedido` (`id_usuario`),
  CONSTRAINT `usuario-pedido` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bd_tienda.pedidos: ~3 rows (aproximadamente)
DELETE FROM `pedidos`;
INSERT INTO `pedidos` (`id`, `total`, `fecha`, `id_usuario`) VALUES
	(4, 58.990000, '2025-02-11 18:47:09', 'admin@gmail.com'),
	(5, 39.000000, '2025-02-11 18:48:23', 'admin@gmail.com'),
	(6, 458.980000, '2025-02-11 18:52:37', 'admin@gmail.com'),
	(7, 198.940000, '2025-02-12 18:05:41', 'admin@gmail.com');

-- Volcando estructura para tabla bd_tienda.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `tiene_oferta` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `desc_larga` varchar(250) DEFAULT NULL,
  `precio` decimal(20,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prod-cat` (`categoria`),
  CONSTRAINT `prod-cat` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`nombre`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bd_tienda.productos: ~13 rows (aproximadamente)
DELETE FROM `productos`;
INSERT INTO `productos` (`id`, `nombre`, `categoria`, `tiene_oferta`, `descripcion`, `desc_larga`, `precio`) VALUES
	(1, 'Cazadora Negra', 'hombre', NULL, 'Cazadora negra', 'Cazadora negra para hombre con forro interior', 39.00),
	(2, 'Camisa', 'hombre', NULL, 'Camisa cuadros', 'Camisa de cuadros para hombre casual', 19.99),
	(3, 'Camiseta Calavera', 'hombre', NULL, 'Camiseta calavera', 'Camiseta de calavera azul-negro', 9.99),
	(4, 'Suéter Blanco', 'hombre', NULL, 'Suéter blanco', 'Suéter blanco con cremallera y cuello alto para hombre', 19.99),
	(5, 'Pantalones Azules', 'hombre', NULL, 'Pantalones azules', 'Pantalones azules anchos y cómodos para hombre', 19.99),
	(6, 'Pantalones Blancos', 'hombre', NULL, 'Pantalones blancos', 'Pantalones blancos o grises anchos con tela cómoda', 19.99),
	(7, 'Cazadora Negra', 'mujer', NULL, 'Cazadora negra', 'Cazadora negra para mujer con forro interior', 39.99),
	(8, 'Jeans Negros', 'mujer', NULL, 'Pantalones negros', 'Jeans negros para mujer ajustados con final suelto', 29.99),
	(9, 'Falda de Cuero', 'mujer', NULL, 'Falda de cuero', 'Falda de cuero negra con tejido de animal maltratado', 19.99),
	(10, 'Blusa Blanca', 'mujer', NULL, 'Blusa blanca', 'Blusa blanca perfecta para trabajar en oficina', 17.99),
	(11, 'Vestido Blanco', 'mujer', NULL, 'Vestido blanco de fiesta', 'Vestido blanco para irte de fiesta pareciendo pija', 49.99),
	(12, 'Vestido negro de fiesta', 'ofertas', NULL, 'Vestido negro de fiesta.', 'Lo mismo pero en negro', 49.00),
	(14, 'Pantalones negros', 'ofertas', '1', 'Pantalones negros', 'Son negros, sí.', 19.00);

-- Volcando estructura para tabla bd_tienda.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `nombre` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cp` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `rol` char(50) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bd_tienda.usuarios: ~10 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`nombre`, `pass`, `email`, `telefono`, `direccion`, `cp`, `provincia`, `rol`) VALUES
	('11', '$2y$10$/J5s2DUF5tquNG9aQlrope9HShovc8OsKw2/TXtHPgA.EuT2Ls1Nm', '111@gmail.com', '1', '11', '11', '111', 'usuario'),
	('2', '$2y$10$e1GwOgngJYg9gr/7OtadiucMMiSeLKgFOu8UuozRPd7xLYK6VQA5a', '2@gmail.com', '2', '2', '2', '2', 'usuario'),
	('Admin', '1111', 'admin@gmail.com', '1', '11', '1', '1', 'admin'),
	('juan', '1111', 'juan@gmail.com', '111111111', '11', '11', '11', 'usuario'),
	('Juan Carlos', '1111', 'juancarlos@gmail.com', '11111111111', '111', '111', '111', 'usuario'),
	('Juan Manuel', '1111', 'juanmanuel@gmail.com', '11111111111', '111', '111', '111', 'usuario'),
	('Juan Pablo', '1111', 'juanpablo@gmail.com', '11111111111', '111', '111', '111', 'usuario'),
	('Juan Peter', '1111', 'juanpeter@gmail.com', '11111111111', '111', '111', '111', 'usuario'),
	('Juan victor', '1111', 'juanvictor@gmail.com', '11111111111', '111', '111', '111', 'usuario'),
	('nan', '$2y$10$6W9rffSVYwZjua2kegN/ZOdcD2SMIQcJFo3Mui6jkv7VYEm0W4G0C', 'nan@gmail.com', 'nana', 'nana', 'nana', 'nana', 'usuario');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

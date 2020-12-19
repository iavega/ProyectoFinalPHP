-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `Subastas`;


DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `producto` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `costo_base` float NOT NULL,
  `precio_actual` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `productos` (`id`, `id_usuario`, `producto`, `descripcion`, `costo_base`, `precio_actual`) VALUES
(1,	1,	'Dell Latitude 3410',	'Intel Core i5-10210U a 1.6GHz, 8GB DDR4, 256GB SSD, 14 \" HD, Windows 10 Pro 64-bits Español, 1Y, Negro',	750,	750),
(2,	1,	'Asus M509DA-BR736',	'AMD Ryzen 7 3700U a 2.3GHz, 15.6\" HD, 8GB DDR4, 512GB SSD, WiFi, Bluetooth, Webcam, Windows 10 Pro, Español',	745,	745),
(3,	1,	'Lenovo IdeaPad Slim 1-14ast-05',	'AMD A6-9220e a 1.6GHz, 14.0\", 4GB DDR4, 64GB eMMC, Bluetooth, Webcam, Windows 10 Home 64-bit, Inglés, Gris',	329,	329),
(4,	1,	'HP 14-dq0002dx',	'Intel Celeron N4020 a 1.1Ghz, 14\" HD, 4GB DDR4, 64GB eMMC, WiFi, Webcam, Bluetooth, Windows 10 Home 64bits, Inglés, Blanco + Office 365 Personal 1- Año',	339,	339),
(5,	1,	'HP 14-DK0076NR',	'AMD Dual-Core A4-9125 a 2.3Ghz, 14\" HD, 4GB DDR4, 64GB eMMC, WiFi, Webcam, Bluetooth, Windows 10 Home 64bits, Inglés, Gris + Office 365 Personal 1- Año',	374,	374);

DROP TABLE IF EXISTS `pujas`;
CREATE TABLE `pujas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_productos` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_productos` (`id_productos`),
  KEY `id_usuarios` (`id_usuarios`),
  CONSTRAINT `pujas_ibfk_1` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id`),
  CONSTRAINT `pujas_ibfk_2` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pujas` (`id`, `id_productos`, `id_usuarios`, `cantidad`) VALUES
(1,	1,	1,	1400),
(2,	1,	1,	1500),
(3,	1,	1,	1600),
(4,	1,	1,	1800);

DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `token` varchar(250) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `expirate` bigint(20) NOT NULL,
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `token_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `token` (`token`, `usuario_id`, `expirate`) VALUES
('5fdd3c2f9cda9',	1,	202012182455);

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `password`) VALUES
(1,	'iam',	'vega',	'vegaiam11@gmail.com',	'qwerty');

-- 2020-12-18 23:41:50
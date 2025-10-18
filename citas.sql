-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-10-2025 a las 19:00:33
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE IF NOT EXISTS `citas` (
  `id_cita` bigint NOT NULL AUTO_INCREMENT,
  `id_profesional` bigint NOT NULL,
  `id_usuario` bigint NOT NULL,
  `id_estado` bigint NOT NULL,
  `consulta` varchar(500) NOT NULL,
  `fecha_agendada` datetime NOT NULL,
  PRIMARY KEY (`id_cita`),
  KEY `id_profesional` (`id_profesional`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_profesional`, `id_usuario`, `id_estado`, `consulta`, `fecha_agendada`) VALUES
(1, 1, 1, 2, 'dolor de cabeza', '2025-10-14 14:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE IF NOT EXISTS `especialidades` (
  `id_especialidad` bigint NOT NULL AUTO_INCREMENT,
  `especialidad` varchar(30) NOT NULL,
  PRIMARY KEY (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id_especialidad`, `especialidad`) VALUES
(1, 'Medico'),
(2, 'Psicologo'),
(3, 'Abogado'),
(4, 'Instructor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `id_estado` bigint NOT NULL AUTO_INCREMENT,
  `estado` varchar(30) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'Cancelada'),
(2, 'Confirmada'),
(3, 'Terminada'),
(4, 'Aplazada'),
(5, 'En espera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional_especialidad`
--

DROP TABLE IF EXISTS `profesional_especialidad`;
CREATE TABLE IF NOT EXISTS `profesional_especialidad` (
  `id_profesional` bigint NOT NULL AUTO_INCREMENT,
  `id_user_rol` bigint NOT NULL,
  `id_especialidad` bigint NOT NULL,
  PRIMARY KEY (`id_profesional`),
  KEY `id_user_rol` (`id_user_rol`),
  KEY `id_especialidad` (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `profesional_especialidad`
--

INSERT INTO `profesional_especialidad` (`id_profesional`, `id_user_rol`, `id_especialidad`) VALUES
(1, 2, 3),
(2, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` bigint NOT NULL AUTO_INCREMENT,
  `rol` varchar(20) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Profesional'),
(3, 'Usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_user` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(14) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `name`, `email`, `phone`) VALUES
(1, 'Santiago Villarreal Maya', 'santiago@gmail.com', '3147688358'),
(2, 'Yeiner Parra Rincon', 'yeinerparrarincon23456789@gmail.com', '3124565468'),
(3, 'Oscar Saenz Leyva', 'oscar@gmail.com', '31245678097'),
(4, 'Mauiricio Ramon Sagastuy', 'sagastuy@gmail.com', '3123453334'),
(5, 'Mauiricio Ramon Sagastuy', 'sagastuy@gmail.com', '3123453334'),
(6, 'louren camila', 'louren@gmail.com', '12331334541'),
(11, 'Darly Marroquin', 'yeinerparrarincon123456789@gmail.com', '31245654689');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_rol`
--

DROP TABLE IF EXISTS `usuarios_rol`;
CREATE TABLE IF NOT EXISTS `usuarios_rol` (
  `id_user_role` bigint NOT NULL AUTO_INCREMENT,
  `id_user` bigint NOT NULL,
  `id_rol` bigint NOT NULL,
  PRIMARY KEY (`id_user_role`),
  KEY `id_user` (`id_user`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios_rol`
--

INSERT INTO `usuarios_rol` (`id_user_role`, `id_user`, `id_rol`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 5, 3),
(4, 6, 2),
(9, 11, 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_profesional`) REFERENCES `profesional_especialidad` (`id_profesional`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesional_especialidad`
--
ALTER TABLE `profesional_especialidad`
  ADD CONSTRAINT `profesional_especialidad_ibfk_1` FOREIGN KEY (`id_user_rol`) REFERENCES `usuarios_rol` (`id_user_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesional_especialidad_ibfk_2` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_rol`
--
ALTER TABLE `usuarios_rol`
  ADD CONSTRAINT `usuarios_rol_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_rol_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

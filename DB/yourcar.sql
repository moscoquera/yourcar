-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2013 a las 19:25:56
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `yourcar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
  `dueno` varchar(45) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`dueno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccionvehiculo`
--

CREATE TABLE IF NOT EXISTS `direccionvehiculo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `franquiciatarjeta`
--

CREATE TABLE IF NOT EXISTS `franquiciatarjeta` (
  `id` int(11) NOT NULL,
  `nombe` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frenosvehiculo`
--

CREATE TABLE IF NOT EXISTS `frenosvehiculo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero_usuarios`
--

CREATE TABLE IF NOT EXISTS `genero_usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

CREATE TABLE IF NOT EXISTS `informacion` (
  `nombre` varchar(50) NOT NULL,
  `valor` varchar(4500) DEFAULT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos`
--

CREATE TABLE IF NOT EXISTS `mantenimientos` (
  `id` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `Descripcion` varchar(4500) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `valor` int(32) DEFAULT NULL,
  `vehiculo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tipomantenimiento_idx` (`tipo`),
  KEY `fk_vehiculo_idx` (`vehiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `id` int(11) NOT NULL,
  `comprobante` varchar(256) NOT NULL,
  `aprobada` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `potencialesclientes`
--

CREATE TABLE IF NOT EXISTS `potencialesclientes` (
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `id` int(11) NOT NULL,
  `usuarioid` varchar(45) NOT NULL,
  `placavehiculo` varchar(45) NOT NULL,
  `precio` int(32) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_idx` (`usuarioid`),
  KEY `fk_vehiculo_idx` (`placavehiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolusuarios`
--

CREATE TABLE IF NOT EXISTS `rolusuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `rolusuarios`
--

INSERT INTO `rolusuarios` (`id`, `nombre`) VALUES
(1, 'administrador tecnico'),
(2, 'administrador de empresa'),
(3, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomantenimiento`
--

CREATE TABLE IF NOT EXISTS `tipomantenimiento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre`) VALUES
(0, 'cedula');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

CREATE TABLE IF NOT EXISTS `tipo_usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`id`, `nombre`) VALUES
(0, 'persona natural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `nick` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `tipo_doc` int(11) NOT NULL,
  `ndocumento` varchar(20) NOT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL,
  `tiposangre` varchar(3) DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`nick`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `ndocumento_UNIQUE` (`ndocumento`),
  KEY `adminrolid_idx` (`rol_id`),
  KEY `tipo_doc_idx` (`tipo_doc`),
  KEY `genero_idx` (`genero`),
  KEY `tipo_usuario_idx` (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nick`, `email`, `nombres`, `password`, `rol_id`, `tipo_doc`, `ndocumento`, `fechanacimiento`, `pais`, `ciudad`, `tiposangre`, `genero`, `tipo`) VALUES
('admin', 'ojalapasemoslabsoft@gmail.com', 'administrador tecnico', '21232f297a57a5a743894a0e4a801fc3', 1, 0, '0', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `placa` varchar(7) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `cilindriaje` int(11) NOT NULL,
  `frenos` int(11) NOT NULL,
  `direccion` int(11) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `npasajeros` int(11) NOT NULL,
  `fechasoat` date DEFAULT NULL,
  `fechaseguro` date DEFAULT NULL,
  `fecharevision` date DEFAULT NULL,
  `tarifa` int(32) NOT NULL,
  `garantia` int(32) NOT NULL,
  PRIMARY KEY (`placa`),
  KEY `fk_frenos_idx` (`frenos`),
  KEY `fk_direccion_idx` (`direccion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voucher`
--

CREATE TABLE IF NOT EXISTS `voucher` (
  `id` int(11) NOT NULL,
  `doccliente` varchar(20) NOT NULL,
  `franquicia` int(11) NOT NULL,
  `numvoucher` int(32) NOT NULL,
  `codverificacion` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `nuntarjeta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_doccliente_idx` (`doccliente`),
  KEY `fk_franq_idx` (`franquicia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `dueno_contacto` FOREIGN KEY (`dueno`) REFERENCES `usuarios` (`nick`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  ADD CONSTRAINT `fk_tipomantenimiento` FOREIGN KEY (`tipo`) REFERENCES `tipomantenimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehiculo` FOREIGN KEY (`vehiculo`) REFERENCES `vehiculo` (`placa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_dueno` FOREIGN KEY (`id`) REFERENCES `reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_usuarioReserva` FOREIGN KEY (`usuarioid`) REFERENCES `usuarios` (`nick`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehiculoReserva` FOREIGN KEY (`placavehiculo`) REFERENCES `vehiculo` (`placa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `genero` FOREIGN KEY (`genero`) REFERENCES `genero_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_usuario` FOREIGN KEY (`tipo`) REFERENCES `tipo_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_id` FOREIGN KEY (`rol_id`) REFERENCES `rolusuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_doc` FOREIGN KEY (`tipo_doc`) REFERENCES `tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `fk_frenos` FOREIGN KEY (`frenos`) REFERENCES `frenosvehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_direccion` FOREIGN KEY (`direccion`) REFERENCES `direccionvehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `voucher`
--
ALTER TABLE `voucher`
  ADD CONSTRAINT `fk_doccliente` FOREIGN KEY (`doccliente`) REFERENCES `usuarios` (`ndocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_franq` FOREIGN KEY (`franquicia`) REFERENCES `franquiciatarjeta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

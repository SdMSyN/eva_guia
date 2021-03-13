-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2021 a las 13:15:06
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eva_guia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacionCtTipo`
--

CREATE TABLE `notificacionCtTipo` (
  `id_notificacionCtTipo` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notificacionCtTipo`
--

INSERT INTO `notificacionCtTipo` (`id_notificacionCtTipo`, `tipo`) VALUES
(1, 'Comunicado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacionRlAvisoAlumno`
--

CREATE TABLE `notificacionRlAvisoAlumno` (
  `id_notificacionRlAvisoAlumno` int(11) NOT NULL,
  `id_notificacionTrAviso` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `enterado` tinyint(4) DEFAULT NULL,
  `fecha_enterado` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacionTrAviso`
--

CREATE TABLE `notificacionTrAviso` (
  `id_notificacionTrAviso` int(11) NOT NULL,
  `id_notificacionCtTipo` int(11) NOT NULL,
  `id_banco_escuelas` int(11) NOT NULL,
  `aviso` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `notificacionCtTipo`
--
ALTER TABLE `notificacionCtTipo`
  ADD PRIMARY KEY (`id_notificacionCtTipo`);

--
-- Indices de la tabla `notificacionRlAvisoAlumno`
--
ALTER TABLE `notificacionRlAvisoAlumno`
  ADD PRIMARY KEY (`id_notificacionRlAvisoAlumno`);

--
-- Indices de la tabla `notificacionTrAviso`
--
ALTER TABLE `notificacionTrAviso`
  ADD PRIMARY KEY (`id_notificacionTrAviso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notificacionCtTipo`
--
ALTER TABLE `notificacionCtTipo`
  MODIFY `id_notificacionCtTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `notificacionRlAvisoAlumno`
--
ALTER TABLE `notificacionRlAvisoAlumno`
  MODIFY `id_notificacionRlAvisoAlumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `notificacionTrAviso`
--
ALTER TABLE `notificacionTrAviso`
  MODIFY `id_notificacionTrAviso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

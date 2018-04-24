-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2017 a las 23:45:58
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `eva_guia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_material_apoyo`
--

CREATE TABLE IF NOT EXISTS `banco_material_apoyo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `enlace` varchar(250) NOT NULL,
  `banco_eje_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_score_ejercicios`
--

CREATE TABLE IF NOT EXISTS `bitacora_score_ejercicios` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `creado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_score_examenes`
--

CREATE TABLE IF NOT EXISTS `bitacora_score_examenes` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `creado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banco_material_apoyo`
--
ALTER TABLE `banco_material_apoyo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bitacora_score_ejercicios`
--
ALTER TABLE `bitacora_score_ejercicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bitacora_score_examenes`
--
ALTER TABLE `bitacora_score_examenes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banco_material_apoyo`
--
ALTER TABLE `banco_material_apoyo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `bitacora_score_ejercicios`
--
ALTER TABLE `bitacora_score_ejercicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `bitacora_score_examenes`
--
ALTER TABLE `bitacora_score_examenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

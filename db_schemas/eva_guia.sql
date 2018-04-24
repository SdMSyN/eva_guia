-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2016 a las 01:51:24
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
-- Estructura de tabla para la tabla `banco_ejes`
--

CREATE TABLE IF NOT EXISTS `banco_ejes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `banco_materia_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_materias`
--

CREATE TABLE IF NOT EXISTS `banco_materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `banco_nivel_escolar_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_niveles`
--

CREATE TABLE IF NOT EXISTS `banco_niveles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `banco_eje_id` int(11) NOT NULL,
  `superior_id` int(11) DEFAULT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_niveles_escolares`
--

CREATE TABLE IF NOT EXISTS `banco_niveles_escolares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_preguntas`
--

CREATE TABLE IF NOT EXISTS `banco_preguntas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `archivo` varchar(50) DEFAULT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_respuestas`
--

CREATE TABLE IF NOT EXISTS `banco_respuestas` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `archivo` varchar(100) DEFAULT NULL,
  `correcta` int(11) NOT NULL,
  `banco_pregunta_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eje_respuestas_tmp`
--

CREATE TABLE IF NOT EXISTS `eje_respuestas_tmp` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `banco_pregunta_id` int(11) NOT NULL,
  `banco_respuesta_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exa_respuestas_tmp`
--

CREATE TABLE IF NOT EXISTS `exa_respuestas_tmp` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `banco_pregunta_id` int(11) NOT NULL,
  `banco_respuesta_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `score_ejercicios`
--

CREATE TABLE IF NOT EXISTS `score_ejercicios` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `num_intentos` int(11) NOT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `score_examenes`
--

CREATE TABLE IF NOT EXISTS `score_examenes` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `num_intentos` int(11) NOT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `informacion_id` int(11) NOT NULL,
  `banco_nivel_escolar_id` int(11) DEFAULT NULL,
  `perfil_id` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_informacion`
--

CREATE TABLE IF NOT EXISTS `usuarios_informacion` (
  `id` int(11) NOT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `colonia` varchar(50) DEFAULT NULL,
  `municipio` varchar(50) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `correo` varchar(75) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `foto_perfil` varchar(50) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_perfil`
--

CREATE TABLE IF NOT EXISTS `usuarios_perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banco_ejes`
--
ALTER TABLE `banco_ejes`
  ADD PRIMARY KEY (`id`), ADD KEY `banco_materia_id` (`banco_materia_id`);

--
-- Indices de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  ADD PRIMARY KEY (`id`), ADD KEY `banco_nivel_escolar_id` (`banco_nivel_escolar_id`);

--
-- Indices de la tabla `banco_niveles`
--
ALTER TABLE `banco_niveles`
  ADD PRIMARY KEY (`id`), ADD KEY `banco_eje_id` (`banco_eje_id`), ADD KEY `superior_id` (`superior_id`);

--
-- Indices de la tabla `banco_niveles_escolares`
--
ALTER TABLE `banco_niveles_escolares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
  ADD PRIMARY KEY (`id`), ADD KEY `banco_nivel_id` (`banco_nivel_id`);

--
-- Indices de la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
  ADD PRIMARY KEY (`id`), ADD KEY `banco_pregunta_id` (`banco_pregunta_id`);

--
-- Indices de la tabla `eje_respuestas_tmp`
--
ALTER TABLE `eje_respuestas_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `exa_respuestas_tmp`
--
ALTER TABLE `exa_respuestas_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `score_ejercicios`
--
ALTER TABLE `score_ejercicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `score_examenes`
--
ALTER TABLE `score_examenes`
  ADD PRIMARY KEY (`id`), ADD KEY `estudiante_id` (`estudiante_id`), ADD KEY `banco_nivel_id` (`banco_nivel_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`), ADD KEY `informacion_id` (`informacion_id`), ADD KEY `banco_nivel_escolar_id` (`banco_nivel_escolar_id`), ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_perfil`
--
ALTER TABLE `usuarios_perfil`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banco_ejes`
--
ALTER TABLE `banco_ejes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `banco_niveles`
--
ALTER TABLE `banco_niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `banco_niveles_escolares`
--
ALTER TABLE `banco_niveles_escolares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `eje_respuestas_tmp`
--
ALTER TABLE `eje_respuestas_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `exa_respuestas_tmp`
--
ALTER TABLE `exa_respuestas_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `score_ejercicios`
--
ALTER TABLE `score_ejercicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `score_examenes`
--
ALTER TABLE `score_examenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuarios_perfil`
--
ALTER TABLE `usuarios_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `banco_ejes`
--
ALTER TABLE `banco_ejes`
ADD CONSTRAINT `banco_ejes_ibfk_1` FOREIGN KEY (`banco_materia_id`) REFERENCES `banco_materias` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
ADD CONSTRAINT `banco_materias_ibfk_1` FOREIGN KEY (`banco_nivel_escolar_id`) REFERENCES `banco_niveles_escolares` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `banco_niveles`
--
ALTER TABLE `banco_niveles`
ADD CONSTRAINT `banco_niveles_ibfk_1` FOREIGN KEY (`banco_eje_id`) REFERENCES `banco_ejes` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `banco_niveles_ibfk_2` FOREIGN KEY (`superior_id`) REFERENCES `banco_niveles` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
ADD CONSTRAINT `banco_preguntas_ibfk_1` FOREIGN KEY (`banco_nivel_id`) REFERENCES `banco_niveles` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
ADD CONSTRAINT `banco_respuestas_ibfk_1` FOREIGN KEY (`banco_pregunta_id`) REFERENCES `banco_preguntas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `score_examenes`
--
ALTER TABLE `score_examenes`
ADD CONSTRAINT `score_examenes_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `score_examenes_ibfk_2` FOREIGN KEY (`banco_nivel_id`) REFERENCES `banco_niveles` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`informacion_id`) REFERENCES `usuarios_informacion` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`banco_nivel_escolar_id`) REFERENCES `banco_niveles_escolares` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`perfil_id`) REFERENCES `usuarios_perfil` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

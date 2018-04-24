-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-07-2017 a las 17:25:06
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_ejes`
--

INSERT INTO `banco_ejes` (`id`, `nombre`, `banco_materia_id`, `creado`) VALUES
(1, 'AritmÃ©tica', 2, '2016-11-28'),
(2, 'GeometrÃ­a', 2, '2016-12-02'),
(3, 'ComprensiÃ³n lectora', 1, '2016-12-02'),
(4, 'Relaciones', 1, '2016-12-02'),
(5, 'Eje 1', 3, '2017-03-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_escuelas`
--

CREATE TABLE IF NOT EXISTS `banco_escuelas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_escuelas`
--

INSERT INTO `banco_escuelas` (`id`, `nombre`) VALUES
(1, 'Tec. 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_materias`
--

CREATE TABLE IF NOT EXISTS `banco_materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `banco_nivel_escolar_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_materias`
--

INSERT INTO `banco_materias` (`id`, `nombre`, `banco_nivel_escolar_id`, `creado`) VALUES
(1, 'EspaÃ±ol', 1, '2016-11-28'),
(2, 'MatemÃ¡ticas', 1, '2016-11-28'),
(3, 'EspaÃ±ol Prepa', 2, '2017-03-03'),
(4, 'MatemÃ¡ticas Prepa', 2, '2017-03-03');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_niveles`
--

INSERT INTO `banco_niveles` (`id`, `nombre`, `banco_eje_id`, `superior_id`, `creado`) VALUES
(1, 'Nivel 1', 1, NULL, '2016-11-29'),
(2, 'Nivel 2', 1, 1, '2016-12-01'),
(3, 'Nivel 1 geo', 2, NULL, '2016-12-02'),
(4, 'Nivel 2 geo', 2, 3, '2016-12-02'),
(5, 'Nivel  3 geo', 2, 4, '2016-12-02'),
(6, 'CL Nivel 1', 3, NULL, '2016-12-02'),
(7, 'Rel. 1', 4, NULL, '2016-12-02'),
(8, 'Rel. 2', 4, 7, '2016-12-02'),
(9, 'Esp 2, Nivel 1', 5, NULL, '2017-03-03'),
(10, 'Esp 2, Nivel 2', 5, 9, '2017-03-03'),
(11, 'Esp 2, Nivel 3', 5, 10, '2017-03-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_niveles_escolares`
--

CREATE TABLE IF NOT EXISTS `banco_niveles_escolares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_niveles_escolares`
--

INSERT INTO `banco_niveles_escolares` (`id`, `nombre`, `creado`) VALUES
(1, 'Secundaria', '2016-11-27'),
(2, 'Preparatoria', '2017-03-03');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_preguntas`
--

INSERT INTO `banco_preguntas` (`id`, `nombre`, `archivo`, `banco_nivel_id`, `activo`, `creado`) VALUES
(4, 'Pregunta simple', NULL, 1, 1, '2016-12-01'),
(5, 'Pregunta con imagen', 'admin_idPreg_5.jpg', 1, 1, '2016-12-01'),
(6, 'Pregunta simple y respuestas con imagen', NULL, 1, 1, '2016-12-01'),
(7, 'Pregunta con audio', 'admin_idPreg_7.mp3', 2, 1, '2016-12-01'),
(8, 'Pregunta con imagen y respuestas igual', 'admin_idPreg_8.png', 1, 1, '2016-12-01'),
(9, 'Pregunta con audio', 'admin_idPreg_9.mp3', 2, 1, '2016-12-01'),
(10, 'Â¿CuÃ¡nto es 2*3*0?', NULL, 2, 1, '2016-12-14'),
(11, 'Continua la secuencia 0, 1, 1, 2, 3, 5, 8, 13, 21...', NULL, 2, 1, '2016-12-14'),
(12, 'Pregunta uno de prueba', NULL, 9, 1, '2017-03-07'),
(13, 'Pregunta 2 de prueba', NULL, 9, 1, '2017-03-07');

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_respuestas`
--

INSERT INTO `banco_respuestas` (`id`, `nombre`, `archivo`, `correcta`, `banco_pregunta_id`, `creado`) VALUES
(8, 'respuesta simple 1', NULL, 0, 4, '2016-12-01'),
(9, 'respuesta simple 2', NULL, 1, 4, '2016-12-01'),
(10, 'respuesta pregunta con img 1', NULL, 1, 5, '2016-12-01'),
(11, 'respuesta pregunta con img 2', NULL, 0, 5, '2016-12-01'),
(12, 'resp con img 1', 'admin_idPreg_6_resp_0.png', 0, 6, '2016-12-01'),
(13, 'resp con img 2', 'admin_idPreg_6_resp_1.jpg', 0, 6, '2016-12-01'),
(14, 'resp con img 3', 'admin_idPreg_6_resp_2.jpg', 1, 6, '2016-12-01'),
(15, 'resp simple 1', NULL, 1, 7, '2016-12-01'),
(16, 'resp simple 2', NULL, 0, 7, '2016-12-01'),
(17, 'img1', 'admin_idPreg_8_resp_0.jpg', 0, 8, '2016-12-01'),
(18, 'img2', 'admin_idPreg_8_resp_1.jpg', 1, 8, '2016-12-01'),
(19, 'img3', 'admin_idPreg_8_resp_2.jpg', 0, 8, '2016-12-01'),
(20, 'resp audio 1', NULL, 1, 9, '2016-12-01'),
(21, 'resp audio 2', NULL, 0, 9, '2016-12-01'),
(22, '0', NULL, 1, 10, '2016-12-14'),
(23, '6', NULL, 0, 10, '2016-12-14'),
(24, '5', NULL, 0, 10, '2016-12-14'),
(25, '11', NULL, 0, 11, '2016-12-14'),
(26, '34', NULL, 1, 11, '2016-12-14'),
(27, '0', NULL, 0, 11, '2016-12-14'),
(28, 'Respuesta 1', NULL, 1, 12, '2017-03-07'),
(29, 'Respuesta 2', NULL, 0, 12, '2017-03-07'),
(30, 'Respuesta 2.1', NULL, 0, 13, '2017-03-07'),
(31, 'Respuesta 2.2', NULL, 1, 13, '2017-03-07');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Volcado de datos para la tabla `score_ejercicios`
--

INSERT INTO `score_ejercicios` (`id`, `estudiante_id`, `score`, `banco_nivel_id`, `num_intentos`, `creado`, `actualizado`) VALUES
(1, 2, 1, 1, 7, '2016-12-09 00:00:00', '2016-12-13 19:54:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `score_examenes`
--

INSERT INTO `score_examenes` (`id`, `estudiante_id`, `score`, `banco_nivel_id`, `num_intentos`, `creado`, `actualizado`) VALUES
(1, 2, 7, 3, 1, '2016-12-04 00:00:00', '2016-12-04 00:00:00'),
(2, 2, 2, 1, 6, '2016-12-06 00:00:00', '2016-12-13 19:53:00'),
(3, 2, 0, 6, 1, '2017-01-09 00:00:00', '2017-01-09 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `user`, `pass`, `clave`, `informacion_id`, `banco_nivel_escolar_id`, `perfil_id`, `activo`, `creado`, `actualizado`) VALUES
(1, 'Admin', 'admin', 'admin', 'admin', 1, NULL, 1, 1, '2016-11-27', '2016-11-27'),
(2, 'Luigi PÃ©rez Calzada', 'est', 'est', 'lperezc1', 2, 1, 3, 1, '2016-12-01', '2016-12-01'),
(4, 'Moran Cruz Enrique', 'emoranc3', '02af07ab8a', 'emoranc3', 4, 1, 3, 1, '2016-12-01', '2016-12-01'),
(5, 'studiant e e', 'estudiante4', 'f83d13844f', 'estudiante4', 5, 1, 3, 0, '2016-12-01', '2016-12-01'),
(6, 'Estudiante', 'secu0', '4263304658', 'secu0', 6, 1, 3, 1, '2017-01-29', '2017-01-29'),
(7, 'Estudiante', 'secu1', '7947717863', 'secu1', 7, 1, 3, 0, '2017-01-29', '2017-01-29'),
(8, 'Estudiante', 'secu2', '8330473358', 'secu2', 8, 1, 3, 0, '2017-01-29', '2017-01-29'),
(9, 'Estudiante', 'secu3', '9000339466', 'secu3', 9, 1, 3, 0, '2017-01-29', '2017-01-29'),
(10, 'Estudiante', 'secu4', '2884657967', 'secu4', 10, 1, 3, 0, '2017-01-29', '2017-01-29'),
(11, 'Estudiante', 'secu5', '2297385215', 'secu5', 11, 1, 3, 0, '2017-01-29', '2017-01-29'),
(12, 'Estudiante', 'secu6', '6970803186', 'secu6', 12, 1, 3, 0, '2017-01-29', '2017-01-29'),
(13, 'Estudiante', 'secu7', '5251893918', 'secu7', 13, 1, 3, 0, '2017-01-29', '2017-01-29'),
(14, 'Estudiante', 'secu8', '3452697350', 'secu8', 14, 1, 3, 0, '2017-01-29', '2017-01-29'),
(15, 'Estudiante', 'secu9', '8544137122', 'secu9', 15, 1, 3, 0, '2017-01-29', '2017-01-29'),
(16, 'prepa prepa prepa', 'prepa', 'prepa', 'pprepap15', 16, 2, 3, 1, '2017-03-03', '2017-03-03');

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
  `escuela_id` int(11) DEFAULT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_informacion`
--

INSERT INTO `usuarios_informacion` (`id`, `calle`, `numero`, `colonia`, `municipio`, `cp`, `estado`, `telefono`, `celular`, `correo`, `facebook`, `twitter`, `foto_perfil`, `escuela_id`, `creado`, `actualizado`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', 1, '2016-11-27', '2016-11-27'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2461231894', 'brosnake@hotmail.com', NULL, NULL, 'eva.jpg', 1, '2016-12-01', '2017-01-11'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', 1, '2016-12-01', '2016-12-01'),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', 1, '2016-12-01', '2016-12-01'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-01-29', '2017-01-29'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-01-29', '2017-01-29'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-01-29', '2017-01-29'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-01-29', '2017-01-29'),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-01-29', '2017-01-29'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-01-29', '2017-01-29'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-01-29', '2017-01-29'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-01-29', '2017-01-29'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-01-29', '2017-01-29'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-01-29', '2017-01-29'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', NULL, '2017-03-03', '2017-03-03');

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
-- Volcado de datos para la tabla `usuarios_perfil`
--

INSERT INTO `usuarios_perfil` (`id`, `nombre`, `creado`) VALUES
(1, 'Administrador', '2016-11-27'),
(2, 'Capturista', '2016-11-27'),
(3, 'Estudiante', '2016-11-27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banco_ejes`
--
ALTER TABLE `banco_ejes`
  ADD PRIMARY KEY (`id`), ADD KEY `banco_materia_id` (`banco_materia_id`);

--
-- Indices de la tabla `banco_escuelas`
--
ALTER TABLE `banco_escuelas`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`), ADD KEY `escuela_id` (`escuela_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `banco_escuelas`
--
ALTER TABLE `banco_escuelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `banco_niveles`
--
ALTER TABLE `banco_niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `banco_niveles_escolares`
--
ALTER TABLE `banco_niveles_escolares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `eje_respuestas_tmp`
--
ALTER TABLE `eje_respuestas_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `exa_respuestas_tmp`
--
ALTER TABLE `exa_respuestas_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `score_ejercicios`
--
ALTER TABLE `score_ejercicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `score_examenes`
--
ALTER TABLE `score_examenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
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

--
-- Filtros para la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
ADD CONSTRAINT `usuarios_informacion_ibfk_1` FOREIGN KEY (`escuela_id`) REFERENCES `banco_escuelas` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

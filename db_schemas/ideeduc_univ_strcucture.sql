-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-01-2021 a las 13:41:22
-- Versión del servidor: 5.7.32-cll-lve
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ideeduc_univ`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_ejes`
--

CREATE TABLE `banco_ejes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `banco_materia_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_escuelas`
--

CREATE TABLE `banco_escuelas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_material_apoyo`
--

CREATE TABLE `banco_material_apoyo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `enlace` varchar(250) NOT NULL,
  `banco_eje_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_materias`
--

CREATE TABLE `banco_materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `banco_nivel_escolar_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_niveles`
--

CREATE TABLE `banco_niveles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `banco_eje_id` int(11) NOT NULL,
  `superior_id` int(11) DEFAULT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_niveles_escolares`
--

CREATE TABLE `banco_niveles_escolares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_preguntas`
--

CREATE TABLE `banco_preguntas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `archivo` varchar(50) DEFAULT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_respuestas`
--

CREATE TABLE `banco_respuestas` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `archivo` varchar(100) DEFAULT NULL,
  `correcta` int(11) NOT NULL,
  `banco_pregunta_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_score_ejercicios`
--

CREATE TABLE `bitacora_score_ejercicios` (
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

CREATE TABLE `bitacora_score_examenes` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `creado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eje_respuestas_tmp`
--

CREATE TABLE `eje_respuestas_tmp` (
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

CREATE TABLE `exa_respuestas_tmp` (
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

CREATE TABLE `score_ejercicios` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `num_intentos` int(11) NOT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `score_examenes`
--

CREATE TABLE `score_examenes` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `banco_nivel_id` int(11) NOT NULL,
  `num_intentos` int(11) NOT NULL,
  `creado` datetime NOT NULL,
  `actualizado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `curp` varchar(18) DEFAULT NULL,
  `informacion_id` int(11) NOT NULL,
  `banco_nivel_escolar_id` int(11) DEFAULT NULL,
  `perfil_id` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_informacion`
--

CREATE TABLE `usuarios_informacion` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_perfil`
--

CREATE TABLE `usuarios_perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banco_ejes`
--
ALTER TABLE `banco_ejes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_materia_id` (`banco_materia_id`);

--
-- Indices de la tabla `banco_escuelas`
--
ALTER TABLE `banco_escuelas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco_material_apoyo`
--
ALTER TABLE `banco_material_apoyo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_nivel_escolar_id` (`banco_nivel_escolar_id`);

--
-- Indices de la tabla `banco_niveles`
--
ALTER TABLE `banco_niveles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_eje_id` (`banco_eje_id`),
  ADD KEY `superior_id` (`superior_id`);

--
-- Indices de la tabla `banco_niveles_escolares`
--
ALTER TABLE `banco_niveles_escolares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_nivel_id` (`banco_nivel_id`);

--
-- Indices de la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_pregunta_id` (`banco_pregunta_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiante_id` (`estudiante_id`),
  ADD KEY `banco_nivel_id` (`banco_nivel_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informacion_id` (`informacion_id`),
  ADD KEY `banco_nivel_escolar_id` (`banco_nivel_escolar_id`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `escuela_id` (`escuela_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `banco_escuelas`
--
ALTER TABLE `banco_escuelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `banco_material_apoyo`
--
ALTER TABLE `banco_material_apoyo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `banco_niveles`
--
ALTER TABLE `banco_niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `banco_niveles_escolares`
--
ALTER TABLE `banco_niveles_escolares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `score_examenes`
--
ALTER TABLE `score_examenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_perfil`
--
ALTER TABLE `usuarios_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

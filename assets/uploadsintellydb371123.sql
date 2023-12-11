-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2023 a las 03:54:24
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `intellydb3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(3) NOT NULL,
  `nom_empresa` varchar(30) NOT NULL,
  `giro_empresa` varchar(30) NOT NULL,
  `logotipo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nom_empresa`, `giro_empresa`, `logotipo`) VALUES
(1, 'Proint ', 'Todo a tu alcance ', ''),
(2, 'Adidas', 'Venta y producción de alzado, ', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(3) NOT NULL,
  `nombre_grupo` varchar(30) NOT NULL,
  `id_empresa` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre_grupo`, `id_empresa`) VALUES
(1, 'Mantenimiento', 1),
(2, 'Limpieza', 2),
(3, 'asfasf', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `id_miembro` int(3) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido_pat` varchar(30) NOT NULL,
  `apellido_mat` varchar(30) NOT NULL,
  `telefono` int(10) NOT NULL,
  `id_grupo` int(3) NOT NULL,
  `id_empresa` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id_miembro`, `nombre`, `apellido_pat`, `apellido_mat`, `telefono`, `id_grupo`, `id_empresa`) VALUES
(1, 'Luis Eduardo ', 'Martinez ', 'Jimenez', 1234564478, 1, 1),
(2, 'Arturo', 'Garcia', 'Pagaza', 1234564478, 2, 2),
(3, 'Ramiro', 'Camacho', 'Colin', 1234566778, 2, 2),
(4, 'Pablo Cesar', 'Selva', 'Contreras', 1234564478, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_tarea`
--

CREATE TABLE `status_tarea` (
  `id_tarea` int(3) NOT NULL,
  `id_grupo` int(3) NOT NULL,
  `comentarios` varchar(50) NOT NULL,
  `archivos` blob NOT NULL,
  `estatus_Tarea` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(3) NOT NULL,
  `nom_tarea` varchar(30) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `id_miembro` int(3) NOT NULL,
  `id_grupo` int(3) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `archivo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `fk_empresa` (`id_empresa`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id_miembro`);

--
-- Indices de la tabla `status_tarea`
--
ALTER TABLE `status_tarea`
  ADD UNIQUE KEY `id_tarea` (`id_tarea`),
  ADD UNIQUE KEY `id_grupo` (`id_grupo`),
  ADD UNIQUE KEY `estatus_Tarea` (`estatus_Tarea`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_miembro` (`id_miembro`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id_miembro` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD CONSTRAINT `miembros_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `miembros_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `status_tarea`
--
ALTER TABLE `status_tarea`
  ADD CONSTRAINT `status_tarea_ibfk_1` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`id_miembro`) REFERENCES `miembros` (`id_miembro`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

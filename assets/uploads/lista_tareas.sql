-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2023 a las 00:01:16
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empleado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_tareas`
--

CREATE TABLE `lista_tareas` (
  `id` int(30) NOT NULL,
  `task` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `employee_id` int(30) NOT NULL,
  `due_date` date NOT NULL,
  `completed` date NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=pending, 1=on-progress,3=Completed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `archivo` text NOT NULL,
  `importancia` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista_tareas`
--

INSERT INTO `lista_tareas` (`id`, `task`, `description`, `employee_id`, `due_date`, `completed`, `status`, `date_created`, `archivo`, `importancia`) VALUES
(6, 'asdads', 'qqqq', 4, '2023-11-13', '0000-00-00', 2, '2023-11-12 18:43:45', '', 0),
(7, 'Crear un login para el sistema delfin', '&lt;p&gt;el login deber&aacute; tener los siguientes elementos:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Correo electr&oacute;nico&lt;/li&gt;&lt;li&gt;Contrase&ntilde;a&lt;/li&gt;&lt;li&gt;Captcha&lt;/li&gt;&lt;/ul&gt;', 4, '2023-11-13', '0000-00-00', 2, '2023-11-12 23:17:40', '', 0),
(12, 'aa', 'aa', 5, '2023-11-22', '0000-00-00', 0, '2023-11-23 18:57:44', '', 0),
(13, 'Crear un login para el sistema delfin', 'aaaa', 7, '2023-11-23', '0000-00-00', 0, '2023-11-23 18:58:45', '', 0),
(14, 'asdads', 'asasas', 10, '2023-12-08', '0000-00-00', 0, '2023-12-07 19:32:38', '', 0),
(15, 'Crear un login para el sistema delfin', '													', 10, '2023-12-20', '0000-00-00', 1, '2023-12-07 21:26:27', '', 0),
(16, 'asdads', 'sadad', 10, '2023-12-08', '0000-00-00', 2, '2023-12-08 00:42:03', '', 0),
(17, 'Crear un login para el sistema delfin', 'asdad', 10, '2023-12-08', '0000-00-00', 0, '2023-12-08 00:54:14', '', 0),
(18, 'hacer un reporte del sistema de tickets', 'asdad', 10, '2023-12-08', '0000-00-00', 0, '2023-12-08 01:22:05', '', 0),
(20, 'asdads', '													', 10, '2023-12-10', '0000-00-00', 0, '2023-12-10 16:40:21', '', 0),
(21, 'Crear un login para el sistema delfin', 'asdfafa', 10, '2023-12-10', '0000-00-00', 0, '2023-12-10 16:41:59', '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lista_tareas`
--
ALTER TABLE `lista_tareas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lista_tareas`
--
ALTER TABLE `lista_tareas`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-11-2023 a las 02:15:28
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `monitoreo_aerososa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aeropuertos`
--

CREATE TABLE `aeropuertos` (
  `id` int NOT NULL,
  `aeropuerto` varchar(50) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `latitud` varchar(100) NOT NULL,
  `longitud` varchar(100) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `creado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuarioc` int NOT NULL,
  `usuariom` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `aeropuertos`
--

INSERT INTO `aeropuertos` (`id`, `aeropuerto`, `codigo`, `latitud`, `longitud`, `estado`, `creado`, `modificado`, `usuarioc`, `usuariom`) VALUES
(1, 'Golosón', 'MHLC', '-86.85161098644396', '15.7455516705524', 1, '2023-11-15 14:49:55', '2023-11-16 10:27:22', 1, 1),
(2, 'Juan Manuel Gálvez', 'MHRO', '16.32780364805754', '-86.52604081840059', 1, '2023-11-15 14:57:39', '2023-11-16 10:13:36', 1, 1),
(3, 'Toncontín', 'MHTG', '14.065042666127688', '-87.21782384431958', 1, '2023-11-15 15:21:23', NULL, 1, NULL),
(4, 'Ramón Villeda Morales', 'MHLM', '15.540562772969317', '-87.92767725964556', 1, '2023-11-15 15:22:39', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `creado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuarioc` int NOT NULL,
  `usuariom` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `ciudad`, `estado`, `creado`, `modificado`, `usuarioc`, `usuariom`) VALUES
(5, 'La Ceiba', 1, '2023-11-01 16:21:00', '2023-11-06 16:18:33', 1, 1),
(6, 'Tegucigalpa', 1, '2023-11-01 16:21:00', '2023-11-06 18:21:42', 1, 1),
(7, 'San Pedro Sula', 1, '2023-11-07 15:42:35', '2023-11-08 09:04:15', 1, 1),
(8, 'Roatán', 1, '2023-11-07 15:47:48', '2023-11-08 09:04:16', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id` int NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `creado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuarioc` int NOT NULL,
  `usuariom` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `tipo`, `estado`, `creado`, `modificado`, `usuarioc`, `usuariom`) VALUES
(1, 'Permanente', 1, '2023-11-13 14:30:12', '2023-11-15 11:35:16', 1, 1),
(2, 'Temporal', 1, '2023-11-13 14:30:54', '2023-11-15 11:37:43', 1, 1),
(3, 'Por Servicios', 1, '2023-11-15 11:38:42', '2023-11-15 13:56:05', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `creado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuarioc` int NOT NULL,
  `usuariom` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `creado`, `modificado`, `usuarioc`, `usuariom`) VALUES
(1, 'Recursos Humanos', 1, '2023-11-01 10:18:53', '2023-11-17 09:50:27', 1, 1),
(2, 'Mantenimiento', 1, '2023-11-11 10:42:27', '2023-11-17 09:50:34', 1, 1),
(6, 'Sistemas', 1, '2023-11-15 11:37:12', '2023-11-17 09:50:43', 1, 1),
(7, 'Contabilidad', 1, '2023-11-15 11:37:19', '2023-11-17 09:50:50', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fecha_nacimiento` varchar(50) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `id_depto` int NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `id_estacion` int NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `id_contrato` int NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `creado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuarioc` int NOT NULL,
  `usuariom` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellido`, `telefono`, `correo`, `fecha_nacimiento`, `direccion`, `id_depto`, `cargo`, `id_estacion`, `fecha_ingreso`, `id_contrato`, `estado`, `creado`, `modificado`, `usuarioc`, `usuariom`) VALUES
(1, 'Nuzly Abigail', ' Argueta Munguia', '98847109', 'abiargueta8@gmail.com', '16/02/2001', 'Calle Principal, Bo. Nuevo, El Porvenir, Atlántida', 1, 'Auxiliar de Soporte Técnico', 1, '2023-11-01 09:25:30', 1, 1, '2023-11-01 09:25:30', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estaciones`
--

CREATE TABLE `estaciones` (
  `id` int NOT NULL,
  `estacion` varchar(50) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `modificado` datetime DEFAULT NULL,
  `creado` datetime NOT NULL,
  `usuarioc` int NOT NULL,
  `usuariom` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estaciones`
--

INSERT INTO `estaciones` (`id`, `estacion`, `estado`, `modificado`, `creado`, `usuarioc`, `usuariom`) VALUES
(1, 'Aeropuerto', 1, '2023-11-08 09:05:00', '2023-11-07 16:58:43', 1, 1),
(2, 'Oficina Centro', 1, '2023-11-08 09:04:58', '2023-11-08 09:02:02', 1, 1),
(3, 'Carga', 1, '2023-11-08 21:30:21', '2023-11-08 09:02:37', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int NOT NULL,
  `rol` varchar(50) NOT NULL,
  `estado` int DEFAULT '1',
  `creado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `usuarioc` int NOT NULL,
  `usuariom` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`, `estado`, `creado`, `modificado`, `usuarioc`, `usuariom`) VALUES
(1, 'Admin', 1, '2023-11-01 16:21:22', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `id_empleado` int NOT NULL,
  `id_rol` int NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `reset_password` int NOT NULL DEFAULT '0',
  `fotografia` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `creado` datetime NOT NULL,
  `modificado` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `usuarioc` int NOT NULL,
  `usuariom` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_empleado`, `id_rol`, `usuario`, `contrasena`, `reset_password`, `fotografia`, `estado`, `creado`, `modificado`, `last_login`, `usuarioc`, `usuariom`) VALUES
(1, 1, 0, 'admin', '1234', 0, '', 1, '2023-11-01 09:28:54', NULL, '2023-11-18 08:42:55', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aeropuertos`
--
ALTER TABLE `aeropuertos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estaciones`
--
ALTER TABLE `estaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aeropuertos`
--
ALTER TABLE `aeropuertos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estaciones`
--
ALTER TABLE `estaciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

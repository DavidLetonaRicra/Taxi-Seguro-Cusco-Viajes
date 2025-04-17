-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2025 a las 07:42:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taxi_seguro_cusco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_admin`, `nombre`, `usuario`, `clave`) VALUES
(4, 'david letona ricra', 'david', '$2y$10$82FfxpKijc74c8wYWYbkxObK1mejfa1OSbF1uIKenr1tsRhd6tpv6'),
(5, 'maria letona ricra', 'maria', '$2y$10$hM3T5M0v9V3I9RIBdZbwu.pVMZILfhyGdKntU8RUo/sJq0ZEvlJUG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id_asignacion` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `id_conductor` int(11) NOT NULL,
  `fecha_asignacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombres`, `apellidos`, `telefono`, `email`, `password`, `fecha_registro`) VALUES
(1, 'david', 'letona', '915175051', 'dlrletonar@gmail.com', '$2y$10$rTATTXolnlRDV6zZdOsrweU6yi1HgBIF4n5TJmaABInSsUSqMKW6a', '2025-04-16 00:32:16'),
(2, 'maria', 'letona', '945784512', 'marialetonaricra@gmail.com', '$2y$10$eLDjDR.w5rETpj3Q6c7uoOGkhSzZNv0dzTwoIYbPzYKR7jX2F4yXK', '2025-04-16 00:34:35'),
(3, 'alex', 'ricra', '987451202', 'alexricra@gmail.com', '$2y$10$ZKlCnal2CBjECFAUqP0UXuAfnEAVSIuBapfOwmRj5qvef0V622lcS', '2025-04-16 00:55:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores`
--

CREATE TABLE `conductores` (
  `id_conductor` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `licencia_conducir` varchar(50) NOT NULL,
  `estado` enum('Disponible','Ocupado','Inactivo') DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `origen` varchar(255) NOT NULL,
  `destino` varchar(255) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `hora_reserva` time NOT NULL,
  `numero_personas` int(11) DEFAULT 1,
  `comentarios` text DEFAULT NULL,
  `estado` enum('Pendiente','Confirmada','Cancelada') DEFAULT 'Pendiente',
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_cliente`, `origen`, `destino`, `fecha_reserva`, `hora_reserva`, `numero_personas`, `comentarios`, `estado`, `fecha_creacion`) VALUES
(1, NULL, 'cusco', 'ollanta', '2025-04-24', '12:45:00', 2, 'hoaldada{dfasdf', 'Pendiente', '2025-04-16 11:37:50'),
(2, NULL, 'cusco', 'ollanta', '2025-04-19', '11:49:00', 2, 'asdfs', 'Pendiente', '2025-04-16 11:51:25'),
(3, NULL, 'calca', 'cusco', '2025-04-20', '11:55:00', 3, 'tengo perrito chihuahua, es pequeñito', 'Pendiente', '2025-04-16 11:52:15'),
(4, NULL, 'ticatica', 'avancay', '2025-04-19', '15:08:00', 2, 'tengo mueble pequeño', 'Pendiente', '2025-04-16 15:05:55'),
(5, NULL, 'Calle Garcilazo', 'Margen derecha e-5', '2025-04-19', '17:46:00', 3, 'necesito llevar un televisor de 40 pulgadas', 'Pendiente', '2025-04-16 17:43:32'),
(6, NULL, 'Ciudad de Cusco', 'Ciudad de Urubamba', '2025-04-27', '19:13:00', 4, 'viaje de campo, paseo familiar', 'Pendiente', '2025-04-16 19:11:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_reserva` (`id_reserva`),
  ADD KEY `id_conductor` (`id_conductor`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `conductores`
--
ALTER TABLE `conductores`
  ADD PRIMARY KEY (`id_conductor`),
  ADD UNIQUE KEY `licencia_conducir` (`licencia_conducir`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `conductores`
--
ALTER TABLE `conductores`
  MODIFY `id_conductor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id_reserva`) ON DELETE CASCADE,
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`id_conductor`) REFERENCES `conductores` (`id_conductor`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

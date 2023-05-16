-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2021 a las 17:54:49
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ganoderma`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `fecha` varchar(200) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `imagen` varchar(1000) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `categoria` varchar(200) NOT NULL,
  `fechaexp` varchar(200) NOT NULL,
  `descripcion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `fecha`, `nombre`, `imagen`, `cantidad`, `precio`, `categoria`, `fechaexp`, `descripcion`) VALUES
(49, '2021-10-14', ' Gano Cafe', '1634259122_capuchino.jpg', 50, 80000, 'cafe', '2023-09-29', 'Producto saludable'),
(51, '2021-10-14', 'Gano clasico', '1634259194_clasico.jpg', 40, 75000, 'cafe', '2023-04-11', 'Producto saludable sin azucar, para personas con diabetes.'),
(52, '2021-10-14', 'Ganoderma Excellium', '1634259304_capsulas1.jpg', 20, 180000, 'Capsulas', '2024-01-14', 'Mejor producto para su salud'),
(53, '2021-10-14', 'Gano Schokolade', '1634259405_chocolate.jpg', 10, 100000, 'chocolate', '2023-03-24', 'Producto 100% saludable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_admin`
--

CREATE TABLE `usuario_admin` (
  `identifier` int(10) DEFAULT NULL,
  `user` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `Nombre` text NOT NULL,
  `Apellido` varchar(30) NOT NULL,
  `Admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario_admin`
--

INSERT INTO `usuario_admin` (`identifier`, `user`, `password`, `Nombre`, `Apellido`, `Admin`) VALUES
(234, 'jorget', '1234', 'Jorge', 'Trillos', 1),
(123, 'Juanx', '1234', 'Juan', 'Trillos', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

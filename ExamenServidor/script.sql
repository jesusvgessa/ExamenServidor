-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-11-2021 a las 14:17:47
-- Versión del servidor: 8.0.27-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `animales`
--
CREATE DATABASE IF NOT EXISTS `lindavista` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lindavista`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viviendas`
--

CREATE TABLE `viviendas` (
  `id` int NOT NULL,
  `tipo` text NOT NULL,
  `zona` text NOT NULL,
  `direccion` text NOT NULL,
  `ndormitorios` text NOT NULL,
  `precio` decimal NOT NULL,
  `tamano` decimal NOT NULL,
  `extras` text NOT NULL,
  `foto` text NOT NULL,
  `observaciones` text NOT NULL
) ;

--
-- Volcado de datos para la tabla `viviendas`
--

INSERT INTO `viviendas` (`id`, `tipo`, `zona`, `direccion`, `ndormitorios`, `precio`, `tamano`, `extras`,`foto`, `observaciones`) VALUES
(1, 'Piso', 'Nervion', 'Santa Catalina', '1', 3000, 20, 'Piscina', 'noimage.jpeg', 'Mu bonito'),
(2, 'Chalet', 'Macarena', 'Santa Catalino', '4', 5000, 30, '', 'noimage.jpeg', 'Grande y preziozo');

--
-- Checks
--
ALTER TABLE viviendas ADD CONSTRAINT CHK_tipo CHECK(tipo='Piso' or tipo='Adosado' or tipo='Chalet' or tipo='Casa');
ALTER TABLE viviendas ADD CONSTRAINT CHK_zona CHECK(zona='Centro' or zona='Nervion' or zona='Triana' or zona='Aljarafe' or zona='Macarena');
ALTER TABLE viviendas ADD CONSTRAINT CHK_ndormitorios CHECK(ndormitorios='1' or ndormitorios='2' or ndormitorios='3' or ndormitorios='4' or ndormitorios='5');

--
-- Indices de la tabla `viviendas`
--
ALTER TABLE `viviendas`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `viviendas`
--
ALTER TABLE `viviendas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
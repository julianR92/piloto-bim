-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-09-2023 a las 19:53:30
-- Versión del servidor: 5.7.33
-- Versión de PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `id` bigint(20) NOT NULL,
  `cliente_id` bigint(20) NOT NULL,
  `valor` float NOT NULL,
  `medio_pago_id` bigint(20) DEFAULT NULL COMMENT 'id de la tabla medio de pago',
  `cuenta_pago_id` bigint(20) DEFAULT NULL COMMENT 'id de tabla cuenta de pago',
  `estado` enum('PENDIENTE','DISPONIBLE','APARTADO','GASTADO','DEVUELTO') COLLATE utf8_unicode_ci NOT NULL COMMENT 'pendiente, gastado,disponible,gastado',
  `verificado` int(1) DEFAULT NULL COMMENT 'Pago verificado',
  `referencia_pago` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'referencia de pago',
  `fecha_pago` date DEFAULT NULL COMMENT 'fecha de pago',
  `observaciones` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'observaciones',
  `id_pago` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`id`, `cliente_id`, `valor`, `medio_pago_id`, `cuenta_pago_id`, `estado`, `verificado`, `referencia_pago`, `fecha_pago`, `observaciones`, `id_pago`, `created_at`, `updated_at`) VALUES
(1, 1, 25000, 1, 1, 'GASTADO', 1, NULL, '2023-04-30', NULL, 5, '2023-04-30 17:15:00', '2023-04-30 17:18:20'),
(2, 2, 40000, 2, 2, 'GASTADO', 1, '123123', '2023-04-30', NULL, 6, '2023-04-30 17:16:19', '2023-09-15 15:11:04'),
(3, 1, 20000, 2, 2, 'GASTADO', 1, '123437892', '2023-08-15', NULL, 4, '2023-08-15 15:09:31', '2023-08-15 15:35:44'),
(4, 1, 30000, 2, 2, 'GASTADO', 1, '12312333', '2023-08-08', NULL, 13, '2023-08-15 15:09:31', '2023-09-21 10:41:32'),
(5, 2, 20000, 2, 2, 'GASTADO', 1, '3412132', '2023-08-15', NULL, 10, '2023-08-15 15:40:26', '2023-09-18 23:51:14'),
(6, 2, 50000, 1, 1, 'GASTADO', 1, NULL, '2023-09-18', NULL, 7, '2023-09-18 23:44:57', '2023-09-18 23:46:07'),
(7, 5, 70000, 1, 1, 'GASTADO', 1, NULL, '2023-09-19', NULL, 9, '2023-09-19 21:38:25', '2023-09-19 21:39:45'),
(8, 1, 70000, 1, 1, 'GASTADO', 1, NULL, '2023-09-19', NULL, 11, '2023-09-19 21:38:45', '2023-09-19 21:39:26'),
(9, 2, 20000, 1, 1, 'GASTADO', 1, NULL, '2023-09-19', NULL, 8, '2023-09-19 21:39:08', '2023-09-19 21:40:19'),
(10, 5, 25000, 1, 1, 'GASTADO', 1, NULL, '2023-09-21', NULL, 15, '2023-09-21 12:27:08', '2023-09-21 12:27:57'),
(11, 4, 40000, 2, 3, 'GASTADO', 1, '21312312312', '2023-09-21', NULL, 14, '2023-09-21 12:27:35', '2023-09-21 12:29:27'),
(12, 2, 25000, 1, 1, 'GASTADO', 1, NULL, '2023-09-21', NULL, 16, '2023-09-21 14:35:29', '2023-09-21 14:35:44'),
(13, 5, 20000, 2, 2, 'GASTADO', 1, '123123123123', '2023-09-21', NULL, 19, '2023-09-21 17:10:04', '2023-09-26 14:11:22'),
(14, 6, 200000, 1, 1, 'GASTADO', 1, NULL, '2023-09-01', 'loquisho', 18, '2023-09-26 00:53:35', '2023-09-26 14:05:56'),
(15, 6, 25000, 1, 1, 'GASTADO', 1, NULL, '2023-09-26', NULL, 17, '2023-09-26 00:56:03', '2023-09-26 00:56:27'),
(16, 5, 40000, 1, 1, 'GASTADO', 1, NULL, '2023-09-26', NULL, 21, '2023-09-26 14:10:36', '2023-09-26 14:40:28'),
(17, 4, 70000, 1, 1, 'GASTADO', 1, NULL, '2023-09-26', NULL, 20, '2023-09-26 14:15:12', '2023-09-26 14:15:38'),
(18, 6, 90000, 1, 1, 'DISPONIBLE', 1, NULL, '2023-09-01', NULL, NULL, '2023-09-26 14:23:35', '2023-09-26 14:23:35'),
(19, 3, 70000, 2, 2, 'GASTADO', 1, '12312333sss', '2023-09-26', NULL, 22, '2023-09-26 14:26:11', '2023-09-26 14:47:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adicional_profesional`
--

CREATE TABLE `adicional_profesional` (
  `id` bigint(20) NOT NULL,
  `profesional_id` bigint(20) NOT NULL COMMENT 'llave de la tabla profesionales',
  `adicional_id` bigint(20) NOT NULL COMMENT 'llave de la tabla pago_adicionales',
  `comision` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `porcentaje` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `adicional_profesional`
--

INSERT INTO `adicional_profesional` (`id`, `profesional_id`, `adicional_id`, `comision`, `fecha`, `porcentaje`, `created_at`, `updated_at`) VALUES
(1, 4, 6, 7000, '2023-09-20', '100%', '2023-09-20 16:16:30', '2023-09-20 16:16:30'),
(2, 4, 7, 7000, '2023-09-20', '100%', '2023-09-20 16:22:30', '2023-09-20 16:22:30'),
(3, 4, 8, 6000, '2023-09-20', '100%', '2023-09-20 16:23:26', '2023-09-20 16:23:26'),
(4, 4, 9, 7000, '2023-09-20', '100%', '2023-09-20 16:26:33', '2023-09-20 16:26:33'),
(6, 3, 11, 10000, '2023-09-20', '100%', '2023-09-20 16:35:27', '2023-09-20 16:35:27'),
(7, 4, 12, 7000, '2023-09-21', '100%', '2023-09-21 12:46:00', '2023-09-21 12:46:00'),
(8, 4, 13, 7000, '2023-09-21', '100%', '2023-09-21 14:23:33', '2023-09-21 14:23:33'),
(9, 2, 14, 6000, '2023-09-21', '100%', '2023-09-21 14:39:42', '2023-09-21 14:39:42'),
(10, 4, 15, 7000, '2023-09-21', '100%', '2023-09-21 16:12:31', '2023-09-21 16:12:31'),
(11, 3, 16, 6000, '2023-09-21', '100%', '2023-09-21 16:14:12', '2023-09-21 16:14:12'),
(12, 4, 17, 6000, '2023-09-21', '100%', '2023-09-21 16:15:07', '2023-09-21 16:15:07'),
(13, 3, 18, 6000, '2023-09-21', '100%', '2023-09-21 16:21:22', '2023-09-21 16:21:22'),
(14, 4, 19, 10000, '2023-09-21', '100%', '2023-09-21 16:23:10', '2023-09-21 16:23:10'),
(15, 3, 20, 7000, '2023-09-21', '100%', '2023-09-21 16:31:08', '2023-09-21 16:31:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_servicio_id` bigint(20) NOT NULL,
  `servicio_id` bigint(20) DEFAULT NULL,
  `cliente_id` bigint(20) DEFAULT NULL COMMENT 'llave foránea de clientes',
  `abono_id` bigint(20) DEFAULT NULL COMMENT 'llave foránea abonos',
  `estado` enum('DISPONIBLE','APLAZADO','AGENDADO','CANCELADO','FINALIZADO') COLLATE utf8_spanish_ci NOT NULL,
  `observacion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_pago` bigint(20) DEFAULT NULL COMMENT 'id de pago de procedimiento',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id`, `fecha`, `hora`, `tipo_servicio_id`, `servicio_id`, `cliente_id`, `abono_id`, `estado`, `observacion`, `id_pago`, `created_at`, `updated_at`) VALUES
(1, '2023-04-30', '8:00am', 3, 2, 2, 2, 'APLAZADO', 'EL CLIENTE APLAZO', NULL, '2023-04-30 17:16:45', '2023-04-30 17:18:52'),
(2, '2023-04-30', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(3, '2023-04-30', '11:00am', 3, 2, 1, 1, 'FINALIZADO', NULL, 5, '2023-04-30 17:16:45', '2023-04-30 17:18:20'),
(4, '2023-04-30', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(5, '2023-04-30', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(6, '2023-04-30', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(7, '2023-04-30', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(8, '2023-04-30', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(9, '2023-04-30', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(10, '2023-04-30', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(11, '2023-07-06', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:57', '2023-07-06 16:33:57'),
(12, '2023-07-06', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:57', '2023-07-06 16:33:57'),
(13, '2023-07-06', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:57', '2023-07-06 16:33:57'),
(14, '2023-07-06', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:57', '2023-07-06 16:33:57'),
(15, '2023-07-06', '8:00am', 3, 2, 2, 2, 'CANCELADO', 'CLIENTE CANCELA', NULL, '2023-07-06 16:33:57', '2023-09-15 12:32:18'),
(16, '2023-07-06', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:57', '2023-07-06 16:33:57'),
(17, '2023-07-06', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(18, '2023-07-06', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(19, '2023-07-06', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(20, '2023-07-07', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(21, '2023-07-07', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(22, '2023-07-07', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(23, '2023-07-07', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(24, '2023-07-07', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(25, '2023-07-07', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(26, '2023-07-07', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(27, '2023-07-07', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(28, '2023-07-07', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-07-06 16:33:58', '2023-07-06 16:33:58'),
(29, '2023-08-15', '8:00am', 3, 2, 1, 3, 'FINALIZADO', 'TIENE CABELLO IRRITADO', 4, '2023-08-15 14:55:58', '2023-08-15 15:35:44'),
(30, '2023-08-15', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(31, '2023-08-15', '8:00am', 3, 2, 2, 5, 'APLAZADO', 'NO PUDE IR', NULL, '2023-08-15 14:55:58', '2023-08-15 15:42:41'),
(32, '2023-08-15', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(33, '2023-08-15', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(34, '2023-08-15', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(35, '2023-08-15', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(36, '2023-08-15', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(37, '2023-08-16', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(38, '2023-08-16', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(39, '2023-08-16', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(40, '2023-08-16', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(41, '2023-08-16', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(42, '2023-08-16', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(43, '2023-08-16', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(44, '2023-08-16', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(45, '2023-08-17', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(46, '2023-08-17', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(47, '2023-08-17', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(48, '2023-08-17', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(49, '2023-08-17', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(50, '2023-08-17', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(51, '2023-08-17', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(52, '2023-08-17', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-08-15 14:55:58', '2023-08-15 14:55:58'),
(53, '2023-09-15', '8:00am', 3, 2, 2, 2, 'FINALIZADO', NULL, 6, '2023-09-15 15:10:42', '2023-09-15 15:11:04'),
(54, '2023-09-15', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-15 15:10:42', '2023-09-15 15:10:42'),
(55, '2023-09-18', '8:00am', 3, 3, 2, 6, 'FINALIZADO', NULL, 7, '2023-09-18 23:45:35', '2023-09-18 23:46:07'),
(56, '2023-09-18', '8:00am', 3, 4, 2, 5, 'FINALIZADO', NULL, 10, '2023-09-18 23:45:35', '2023-09-18 23:51:14'),
(57, '2023-09-18', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-18 23:45:35', '2023-09-18 23:45:35'),
(58, '2023-09-18', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-18 23:45:35', '2023-09-18 23:45:35'),
(59, '2023-09-18', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-18 23:45:35', '2023-09-18 23:45:35'),
(60, '2023-09-19', '8:00am', 3, 4, 2, 9, 'FINALIZADO', NULL, 8, '2023-09-19 21:37:50', '2023-09-19 21:40:19'),
(61, '2023-09-19', '8:00am', 3, 2, 5, 7, 'FINALIZADO', NULL, 9, '2023-09-19 21:37:50', '2023-09-19 21:39:45'),
(62, '2023-09-19', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-19 21:37:50', '2023-09-19 21:37:50'),
(63, '2023-09-19', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-19 21:37:50', '2023-09-19 21:37:50'),
(64, '2023-09-19', '8:00am', 3, 2, 1, 8, 'FINALIZADO', NULL, 11, '2023-09-19 21:37:50', '2023-09-19 21:39:26'),
(65, '2023-09-21', '8:00am', 3, 3, 1, 4, 'FINALIZADO', NULL, 13, '2023-09-21 10:40:08', '2023-09-21 10:41:32'),
(66, '2023-09-21', '8:00am', 3, 2, 5, 10, 'FINALIZADO', NULL, 15, '2023-09-21 10:40:08', '2023-09-21 12:27:57'),
(67, '2023-09-21', '8:00am', 3, 2, 2, 12, 'FINALIZADO', NULL, 16, '2023-09-21 10:40:08', '2023-09-21 14:35:44'),
(68, '2023-09-21', '8:00am', 3, 3, 4, 11, 'FINALIZADO', NULL, 14, '2023-09-21 10:40:08', '2023-09-21 12:29:27'),
(69, '2023-09-21', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-21 10:40:08', '2023-09-21 10:40:08'),
(70, '2023-09-26', '8:00am', 3, 2, 6, 15, 'FINALIZADO', NULL, 17, '2023-09-26 00:52:43', '2023-09-26 00:56:27'),
(71, '2023-09-26', '9:30am', 4, 6, 6, 14, 'FINALIZADO', NULL, 18, '2023-09-26 00:52:43', '2023-09-26 14:05:56'),
(72, '2023-09-26', '8:00am', 3, 2, 5, 13, 'FINALIZADO', NULL, 19, '2023-09-26 00:52:43', '2023-09-26 14:11:22'),
(73, '2023-09-26', '8:00am', 3, 2, 4, 17, 'FINALIZADO', NULL, 20, '2023-09-26 00:52:43', '2023-09-26 14:15:38'),
(74, '2023-09-26', '8:00am', 3, 2, 5, 16, 'FINALIZADO', NULL, 21, '2023-09-26 00:52:43', '2023-09-26 14:40:28'),
(75, '2023-09-26', '8:00am', 3, 2, 3, 19, 'FINALIZADO', NULL, 22, '2023-09-26 14:47:37', '2023-09-26 14:47:47'),
(76, '2023-09-26', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-26 14:47:37', '2023-09-26 14:47:37'),
(77, '2023-09-26', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-26 14:47:37', '2023-09-26 14:47:37'),
(78, '2023-09-26', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-26 14:47:37', '2023-09-26 14:47:37'),
(79, '2023-09-26', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, NULL, '2023-09-26 14:47:37', '2023-09-26 14:47:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'USUARIO QUE REALIZA LA ACCION',
  `correo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'CORREO DE USUARIO QUE REALIZA LA ACCION',
  `observaciones` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ACCION REALIZADA',
  `direccion_ip` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'DIRECCION IP',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `usuario`, `correo`, `observaciones`, `direccion_ip`, `created_at`, `updated_at`) VALUES
(1, 'Fabian', 'julianrincon9230@gmail.com', 'Actualizacion  de perfil de usuario julianrincon9230@gmail.com en la plataforma', '127.0.0.1', '2023-02-15 02:16:39', '2023-02-15 02:16:39'),
(2, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de rol PROFESIONAL en la plataforma', '127.0.0.1', '2023-02-15 02:25:05', '2023-02-15 02:25:05'),
(3, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de permiso ver-informacion en la plataforma', '127.0.0.1', '2023-02-15 02:25:42', '2023-02-15 02:25:42'),
(4, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de permiso servicios-profesionales en la plataforma', '127.0.0.1', '2023-02-15 02:26:04', '2023-02-15 02:26:04'),
(5, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de tipo de servicio Alisado en la plataforma', '127.0.0.1', '2023-02-15 04:19:23', '2023-02-15 04:19:23'),
(6, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de tipo de servicio Alisadoss en la plataforma', '127.0.0.1', '2023-02-15 04:22:19', '2023-02-15 04:22:19'),
(7, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de Tipo de Servicio Alisadoss en la plataforma', '127.0.0.1', '2023-02-15 04:23:41', '2023-02-15 04:23:41'),
(8, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de tipo de servicio Alisado en la plataforma', '127.0.0.1', '2023-02-15 04:23:53', '2023-02-15 04:23:53'),
(9, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de tipo de servicio Alisadoss en la plataforma', '127.0.0.1', '2023-02-15 04:24:58', '2023-02-15 04:24:58'),
(10, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de tipo de servicio Alisado en la plataforma', '127.0.0.1', '2023-02-15 04:25:12', '2023-02-15 04:25:12'),
(11, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de Tipo de Servicio Alisado en la plataforma', '127.0.0.1', '2023-02-15 04:25:16', '2023-02-15 04:25:16'),
(12, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de tipo de servicio Alisado en la plataforma', '127.0.0.1', '2023-02-15 04:25:31', '2023-02-15 04:25:31'),
(13, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de tipo de servicio Recuperacion en la plataforma', '127.0.0.1', '2023-03-24 02:39:08', '2023-03-24 02:39:08'),
(14, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio Botulinica en la plataforma', '127.0.0.1', '2023-03-24 15:17:28', '2023-03-24 15:17:28'),
(15, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio Botulinica en la plataforma', '127.0.0.1', '2023-03-24 15:26:22', '2023-03-24 15:26:22'),
(16, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio Botulinica en la plataforma', '127.0.0.1', '2023-03-24 15:26:36', '2023-03-24 15:26:36'),
(17, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio liso HD en la plataforma', '127.0.0.1', '2023-03-24 15:26:53', '2023-03-24 15:26:53'),
(18, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de Servicio Botulinica en la plataforma', '127.0.0.1', '2023-03-24 15:28:35', '2023-03-24 15:28:35'),
(19, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de talla XS en la plataforma', '127.0.0.1', '2023-03-24 16:06:13', '2023-03-24 16:06:13'),
(20, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de talla L en la plataforma', '127.0.0.1', '2023-03-24 16:06:24', '2023-03-24 16:06:24'),
(21, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de talla M en la plataforma', '127.0.0.1', '2023-03-24 16:12:54', '2023-03-24 16:12:54'),
(22, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de talla  en la plataforma', '127.0.0.1', '2023-03-24 16:13:07', '2023-03-24 16:13:07'),
(23, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 60000 en la plataforma', '127.0.0.1', '2023-03-24 17:28:17', '2023-03-24 17:28:17'),
(24, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 2000000 en la plataforma', '127.0.0.1', '2023-03-24 17:38:58', '2023-03-24 17:38:58'),
(25, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor 20000 en la plataforma', '127.0.0.1', '2023-03-24 17:55:47', '2023-03-24 17:55:47'),
(26, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor 600 en la plataforma', '127.0.0.1', '2023-03-24 18:00:35', '2023-03-24 18:00:35'),
(27, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor 7000 en la plataforma', '127.0.0.1', '2023-03-24 18:02:39', '2023-03-24 18:02:39'),
(28, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 45000 en la plataforma', '127.0.0.1', '2023-03-24 18:02:58', '2023-03-24 18:02:58'),
(29, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 7000 en la plataforma', '127.0.0.1', '2023-03-24 18:05:27', '2023-03-24 18:05:27'),
(30, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de precio 7000 en la plataforma', '127.0.0.1', '2023-03-24 18:05:47', '2023-03-24 18:05:47'),
(31, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de descuento PROMO GOLD en la plataforma', '127.0.0.1', '2023-03-25 16:16:37', '2023-03-25 16:16:37'),
(32, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de descuento PROMO MES MUJER en la plataforma', '127.0.0.1', '2023-03-25 16:16:53', '2023-03-25 16:16:53'),
(33, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio  en la plataforma', '127.0.0.1', '2023-03-25 16:17:39', '2023-03-25 16:17:39'),
(34, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio  en la plataforma', '127.0.0.1', '2023-03-25 16:17:45', '2023-03-25 16:17:45'),
(35, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio  en la plataforma', '127.0.0.1', '2023-03-25 16:17:52', '2023-03-25 16:17:52'),
(36, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio  en la plataforma', '127.0.0.1', '2023-03-25 16:18:00', '2023-03-25 16:18:00'),
(37, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de descuento PROMO MES MUJER en la plataforma', '127.0.0.1', '2023-03-25 16:18:39', '2023-03-25 16:18:39'),
(38, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de descuento PROMO MES MUJER en la plataforma', '127.0.0.1', '2023-03-25 16:19:56', '2023-03-25 16:19:56'),
(39, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de Profesional Fabian Hernandez en la plataforma', '127.0.0.1', '2023-03-28 04:17:18', '2023-03-28 04:17:18'),
(40, 'Julian', 'julianrincon9230@gmail.com', 'Actualización de Profesional Fabian Oswaldo Hernandez en la plataforma', '127.0.0.1', '2023-03-28 04:23:56', '2023-03-28 04:23:56'),
(41, 'Julian', 'julianrincon9230@gmail.com', 'Actualización de Profesional Fabian Oswaldo Hernandez en la plataforma', '127.0.0.1', '2023-03-28 04:24:16', '2023-03-28 04:24:16'),
(42, 'Julian', 'julianrincon9230@gmail.com', 'Actualización de Profesional Fabian Oswaldo Hernandez Murcia en la plataforma', '127.0.0.1', '2023-03-28 04:26:20', '2023-03-28 04:26:20'),
(43, 'Fabian Oswaldo', 'fabian.hernandez.murcia@gmail.com', 'Actualizacion  de perfil de usuario fabian.hernandez.murcia@gmail.com en la plataforma', '127.0.0.1', '2023-03-28 04:31:29', '2023-03-28 04:31:29'),
(44, 'Fabian', 'fabian.hernandez.murcia@gmail.com', 'Actualizacion de contraseña fabian.hernandez.murcia@gmail.com en la plataforma', '127.0.0.1', '2023-03-28 04:33:21', '2023-03-28 04:33:21'),
(45, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de rol PROFESIONAL en la plataforma', '127.0.0.1', '2023-03-28 04:36:19', '2023-03-28 04:36:19'),
(46, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de rol PROFESIONAL en la plataforma', '127.0.0.1', '2023-03-28 04:39:08', '2023-03-28 04:39:08'),
(47, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de profesional Fabian Oswaldo Hernandez Murcia en la plataforma', '127.0.0.1', '2023-03-28 04:40:37', '2023-03-28 04:40:37'),
(48, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de Profesional Fabian Oswaldo Hernandez Murcia en la plataforma', '127.0.0.1', '2023-03-28 04:47:23', '2023-03-28 04:47:23'),
(49, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de profesional Fabian Oswaldo Hernandez Murcia en la plataforma', '127.0.0.1', '2023-03-28 04:47:52', '2023-03-28 04:47:52'),
(50, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1098719559 en la plataforma', '127.0.0.1', '2023-04-12 16:58:43', '2023-04-12 16:58:43'),
(51, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 1098719559 en la plataforma', '127.0.0.1', '2023-04-12 17:14:04', '2023-04-12 17:14:04'),
(52, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1098699832 en la plataforma', '127.0.0.1', '2023-04-12 17:16:02', '2023-04-12 17:16:02'),
(53, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cliente 1098699832 en la plataforma', '127.0.0.1', '2023-04-12 17:19:41', '2023-04-12 17:19:41'),
(54, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1234567 en la plataforma', '127.0.0.1', '2023-04-12 17:20:36', '2023-04-12 17:20:36'),
(55, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cliente 1234567 en la plataforma', '127.0.0.1', '2023-04-12 17:22:16', '2023-04-12 17:22:16'),
(56, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1234567 en la plataforma', '127.0.0.1', '2023-04-12 17:22:47', '2023-04-12 17:22:47'),
(57, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cliente 1234567 en la plataforma', '127.0.0.1', '2023-04-12 17:29:59', '2023-04-12 17:29:59'),
(58, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1231231 en la plataforma', '127.0.0.1', '2023-04-12 17:30:30', '2023-04-12 17:30:30'),
(59, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cliente 1231231 en la plataforma', '127.0.0.1', '2023-04-12 17:32:02', '2023-04-12 17:32:02'),
(60, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 1098719559 en la plataforma', '127.0.0.1', '2023-04-12 17:33:21', '2023-04-12 17:33:21'),
(61, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1234567 en la plataforma', '127.0.0.1', '2023-04-12 17:38:12', '2023-04-12 17:38:12'),
(62, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cliente 1234567 en la plataforma', '127.0.0.1', '2023-04-12 17:39:26', '2023-04-12 17:39:26'),
(63, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 12132123 en la plataforma', '127.0.0.1', '2023-04-12 17:39:51', '2023-04-12 17:39:51'),
(64, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 123123123 en la plataforma', '127.0.0.1', '2023-04-12 17:42:33', '2023-04-12 17:42:33'),
(65, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 122222222 en la plataforma', '127.0.0.1', '2023-04-12 17:43:33', '2023-04-12 17:43:33'),
(66, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cliente 122222222 en la plataforma', '127.0.0.1', '2023-04-12 17:50:14', '2023-04-12 17:50:14'),
(67, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cliente 123123123 en la plataforma', '127.0.0.1', '2023-04-12 17:50:19', '2023-04-12 17:50:19'),
(68, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1098699832 en la plataforma', '127.0.0.1', '2023-04-12 17:51:17', '2023-04-12 17:51:17'),
(69, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cliente 1098699832 en la plataforma', '127.0.0.1', '2023-04-12 17:52:57', '2023-04-12 17:52:57'),
(70, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 10987195593 en la plataforma', '127.0.0.1', '2023-04-12 17:53:07', '2023-04-12 17:53:07'),
(71, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 222222 en la plataforma', '127.0.0.1', '2023-04-12 17:56:34', '2023-04-12 17:56:34'),
(72, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1098719559 en la plataforma', '127.0.0.1', '2023-04-12 18:00:38', '2023-04-12 18:00:38'),
(73, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1098699832 en la plataforma', '127.0.0.1', '2023-04-12 18:01:03', '2023-04-12 18:01:03'),
(74, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 1098699832 en la plataforma', '127.0.0.1', '2023-04-12 18:01:20', '2023-04-12 18:01:20'),
(75, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 13841854 en la plataforma', '127.0.0.1', '2023-04-12 18:24:21', '2023-04-12 18:24:21'),
(76, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 13841854 en la plataforma', '127.0.0.1', '2023-04-13 14:13:25', '2023-04-13 14:13:25'),
(77, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 13841854 en la plataforma', '127.0.0.1', '2023-04-13 14:18:59', '2023-04-13 14:18:59'),
(78, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 1 por valor de: 7000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-13 19:11:02', '2023-04-13 19:11:02'),
(79, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 2 por valor de: 7000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-04-13 19:13:16', '2023-04-13 19:13:16'),
(80, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 3 por valor de: 7000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-04-13 19:13:16', '2023-04-13 19:13:16'),
(81, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 4 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-13 19:20:02', '2023-04-13 19:20:02'),
(82, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 5 por valor de: 15000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-13 19:20:02', '2023-04-13 19:20:02'),
(83, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 6 por valor de: 400000 para el cliente: JULIAN RINCON', '127.0.0.1', '2023-04-15 00:17:07', '2023-04-15 00:17:07'),
(84, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 7 por valor de: 5000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-04-15 00:23:28', '2023-04-15 00:23:28'),
(85, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor 4500 en la plataforma', '127.0.0.1', '2023-04-17 15:53:16', '2023-04-17 15:53:16'),
(86, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 2000000 a cliente 3 en la plataforma', '127.0.0.1', '2023-04-17 16:23:05', '2023-04-17 16:23:05'),
(87, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 4por valor 20000 en la plataforma ', '127.0.0.1', '2023-04-17 16:25:26', '2023-04-17 16:25:26'),
(88, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 4por valor 40000 en la plataforma ', '127.0.0.1', '2023-04-17 16:25:43', '2023-04-17 16:25:43'),
(89, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 4por valor 40000 en la plataforma ', '127.0.0.1', '2023-04-17 16:26:36', '2023-04-17 16:26:36'),
(90, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 8por valor 2000000 en la plataforma ', '127.0.0.1', '2023-04-17 16:32:03', '2023-04-17 16:32:03'),
(91, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 8por valor 20000 en la plataforma ', '127.0.0.1', '2023-04-17 16:33:29', '2023-04-17 16:33:29'),
(92, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 8por valor 20000 en la plataforma ', '127.0.0.1', '2023-04-17 16:35:23', '2023-04-17 16:35:23'),
(93, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 8por valor 20000 en la plataforma ', '127.0.0.1', '2023-04-17 16:36:05', '2023-04-17 16:36:05'),
(94, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de abono 5 de valor 15000 en la plataforma', '127.0.0.1', '2023-04-17 16:38:29', '2023-04-17 16:38:29'),
(95, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 50000 a cliente 3 en la plataforma', '127.0.0.1', '2023-04-17 16:42:55', '2023-04-17 16:42:55'),
(96, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 9por valor 50000 en la plataforma ', '127.0.0.1', '2023-04-17 16:43:04', '2023-04-17 16:43:04'),
(97, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 9por valor 70000 en la plataforma ', '127.0.0.1', '2023-04-17 16:43:15', '2023-04-17 16:43:15'),
(98, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de abono 9 de valor 70000 en la plataforma', '127.0.0.1', '2023-04-17 16:43:21', '2023-04-17 16:43:21'),
(99, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 9 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-18 14:25:55', '2023-04-18 14:25:55'),
(100, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 10 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-18 14:25:55', '2023-04-18 14:25:55'),
(101, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 11 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-18 14:37:12', '2023-04-18 14:37:12'),
(102, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 12 por valor de: 7000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-18 14:37:12', '2023-04-18 14:37:12'),
(103, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 25000 a cliente 3 en la plataforma', '127.0.0.1', '2023-04-18 17:08:35', '2023-04-18 17:08:35'),
(104, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 13por valor 25000 en la plataforma ', '127.0.0.1', '2023-04-18 17:10:58', '2023-04-18 17:10:58'),
(105, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 13por valor 25000 en la plataforma ', '127.0.0.1', '2023-04-18 17:12:16', '2023-04-18 17:12:16'),
(106, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 7000 a cliente 3 en la plataforma', '127.0.0.1', '2023-04-18 17:12:32', '2023-04-18 17:12:32'),
(107, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 14 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:31:17', '2023-04-18 19:31:17'),
(108, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 14 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:31:25', '2023-04-18 19:31:25'),
(109, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 14 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:33:36', '2023-04-18 19:33:36'),
(110, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 12 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:33:45', '2023-04-18 19:33:45'),
(111, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 14 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:33:49', '2023-04-18 19:33:49'),
(112, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 14 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:52:22', '2023-04-18 19:52:22'),
(113, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 14 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:52:27', '2023-04-18 19:52:27'),
(114, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 8 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:52:48', '2023-04-18 19:52:48'),
(115, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 8 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:53:05', '2023-04-18 19:53:05'),
(116, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 12 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:53:09', '2023-04-18 19:53:09'),
(117, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 8 verificado en la plataforma', '127.0.0.1', '2023-04-18 19:56:28', '2023-04-18 19:56:28'),
(118, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 15 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-19 20:00:35', '2023-04-19 20:00:35'),
(119, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 16 por valor de: 25000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-19 20:00:35', '2023-04-19 20:00:35'),
(120, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 20000 a cliente 3 en la plataforma', '127.0.0.1', '2023-04-20 15:39:22', '2023-04-20 15:39:22'),
(121, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 16por valor 25000 en la plataforma ', '127.0.0.1', '2023-04-20 15:56:32', '2023-04-20 15:56:32'),
(122, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 1 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-20 16:06:48', '2023-04-20 16:06:48'),
(123, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 1 verificado en la plataforma', '127.0.0.1', '2023-04-20 16:08:43', '2023-04-20 16:08:43'),
(124, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 1 verificado en la plataforma', '127.0.0.1', '2023-04-20 16:10:26', '2023-04-20 16:10:26'),
(125, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 1 verificado en la plataforma', '127.0.0.1', '2023-04-20 16:12:31', '2023-04-20 16:12:31'),
(126, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 1 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-20 16:16:08', '2023-04-20 16:16:08'),
(127, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 2 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-20 16:16:08', '2023-04-20 16:16:08'),
(128, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 1 verificado en la plataforma', '127.0.0.1', '2023-04-20 16:17:07', '2023-04-20 16:17:07'),
(129, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de medio de pago EFECTIVO en la plataforma', '127.0.0.1', '2023-04-21 19:12:02', '2023-04-21 19:12:02'),
(130, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de medio de pago EFECTIVOSSS en la plataforma', '127.0.0.1', '2023-04-21 19:12:12', '2023-04-21 19:12:12'),
(131, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de medio de pago EFECTIVO en la plataforma', '127.0.0.1', '2023-04-21 19:12:21', '2023-04-21 19:12:21'),
(132, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de medio de pago TRANSFERENCIA en la plataforma', '127.0.0.1', '2023-04-21 19:14:43', '2023-04-21 19:14:43'),
(133, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de medio de Pago TRANSFERENCIA en la plataforma', '127.0.0.1', '2023-04-21 19:15:16', '2023-04-21 19:15:16'),
(134, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de medio de Pago EFECTIVO en la plataforma', '127.0.0.1', '2023-04-21 19:15:22', '2023-04-21 19:15:22'),
(135, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de medio de pago EFECTIVO en la plataforma', '127.0.0.1', '2023-04-21 19:20:21', '2023-04-21 19:20:21'),
(136, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de medio de pago TRANSFERENCIA en la plataforma', '127.0.0.1', '2023-04-21 19:20:27', '2023-04-21 19:20:27'),
(137, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cuenta de pago 0000000 en la plataforma', '127.0.0.1', '2023-04-21 20:03:22', '2023-04-21 20:03:22'),
(138, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cuenta de pago 3173639222 en la plataforma', '127.0.0.1', '2023-04-21 20:09:06', '2023-04-21 20:09:06'),
(139, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cuenta de pago 0000000 en la plataforma', '127.0.0.1', '2023-04-21 20:09:44', '2023-04-21 20:09:44'),
(140, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cuenta de pago 3173639222 en la plataforma', '127.0.0.1', '2023-04-21 20:09:49', '2023-04-21 20:09:49'),
(141, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cuenta de pago 0000000 en la plataforma', '127.0.0.1', '2023-04-21 20:11:14', '2023-04-21 20:11:14'),
(142, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cuenta de pago 3173639222 en la plataforma', '127.0.0.1', '2023-04-21 20:11:25', '2023-04-21 20:11:25'),
(143, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cuenta 3173639222 en la plataforma', '127.0.0.1', '2023-04-21 20:11:32', '2023-04-21 20:11:32'),
(144, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cuenta 3173639222 en la plataforma', '127.0.0.1', '2023-04-21 20:11:42', '2023-04-21 20:11:42'),
(145, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 1 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-23 19:49:31', '2023-04-23 19:49:31'),
(146, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 2 por valor de: 7000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-04-23 19:50:43', '2023-04-23 19:50:43'),
(147, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 3 por valor de: 25000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-04-23 19:50:43', '2023-04-23 19:50:43'),
(148, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 20000 a cliente 3 en la plataforma', '127.0.0.1', '2023-04-23 20:27:36', '2023-04-23 20:27:36'),
(149, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de abono 4 de valor 20000 en la plataforma', '127.0.0.1', '2023-04-23 20:28:06', '2023-04-23 20:28:06'),
(150, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 3 verificado en la plataforma', '127.0.0.1', '2023-04-23 20:37:10', '2023-04-23 20:37:10'),
(151, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 5 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-23 20:39:18', '2023-04-23 20:39:18'),
(152, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 6 por valor de: 2000000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-23 20:41:16', '2023-04-23 20:41:16'),
(153, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 7 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-23 20:42:20', '2023-04-23 20:42:20'),
(154, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 8 por valor de: 7000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-23 20:42:20', '2023-04-23 20:42:20'),
(155, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 1 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-23 20:47:08', '2023-04-23 20:47:08'),
(156, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 2 por valor de: 7000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-23 20:47:08', '2023-04-23 20:47:08'),
(157, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 3 por valor de: 20000 para el cliente: JAIRO AUGUSTO RINCON REY', '127.0.0.1', '2023-04-24 03:34:31', '2023-04-24 03:34:31'),
(158, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 4 por valor de: 20000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-04-25 15:42:32', '2023-04-25 15:42:32'),
(159, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 3por valor 40000 en la plataforma ', '127.0.0.1', '2023-04-25 16:34:03', '2023-04-25 16:34:03'),
(160, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 3por valor 3000 en la plataforma ', '127.0.0.1', '2023-04-25 16:34:22', '2023-04-25 16:34:22'),
(161, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 3por valor 3500 en la plataforma ', '127.0.0.1', '2023-04-25 16:35:22', '2023-04-25 16:35:22'),
(162, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 3por valor 4000 en la plataforma ', '127.0.0.1', '2023-04-25 16:37:56', '2023-04-25 16:37:56'),
(163, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 5 por valor de: 20000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-04-25 16:41:07', '2023-04-25 16:41:07'),
(164, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 6 por valor de: 25000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-04-25 16:46:10', '2023-04-25 16:46:10'),
(165, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 1por valor 5000 en la plataforma ', '127.0.0.1', '2023-04-25 16:58:39', '2023-04-25 16:58:39'),
(166, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio liso HD en la plataforma', '127.0.0.1', '2023-04-27 16:57:16', '2023-04-27 16:57:16'),
(167, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio Botulinica en la plataforma', '127.0.0.1', '2023-04-27 16:57:28', '2023-04-27 16:57:28'),
(168, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio HD + Botulinica en la plataforma', '127.0.0.1', '2023-04-27 16:57:49', '2023-04-27 16:57:49'),
(169, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio Brillo de Luna en la plataforma', '127.0.0.1', '2023-04-27 16:58:02', '2023-04-27 16:58:02'),
(170, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio Repolarizacion en la plataforma', '127.0.0.1', '2023-04-27 16:58:14', '2023-04-27 16:58:14'),
(171, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio ADN en la plataforma', '127.0.0.1', '2023-04-27 16:58:24', '2023-04-27 16:58:24'),
(172, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio Terapia Capilar en la plataforma', '127.0.0.1', '2023-04-27 16:58:48', '2023-04-27 16:58:48'),
(173, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio Curly en la plataforma', '127.0.0.1', '2023-04-27 16:59:08', '2023-04-27 16:59:08'),
(174, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de abono 6por valor 25000 en la plataforma ', '127.0.0.1', '2023-04-27 19:25:50', '2023-04-27 19:25:50'),
(175, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 5 verificado en la plataforma', '127.0.0.1', '2023-04-27 19:30:17', '2023-04-27 19:30:17'),
(176, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #1 al cliente 2 en la plataforma', '127.0.0.1', '2023-04-27 21:47:40', '2023-04-27 21:47:40'),
(177, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 4 verificado en la plataforma', '127.0.0.1', '2023-04-27 22:17:31', '2023-04-27 22:17:31'),
(178, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 3 verificado en la plataforma', '127.0.0.1', '2023-04-27 22:17:37', '2023-04-27 22:17:37'),
(179, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #3 al cliente 2 en la plataforma', '127.0.0.1', '2023-04-27 22:18:18', '2023-04-27 22:18:18'),
(180, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #1 al cliente 3 en la plataforma', '127.0.0.1', '2023-04-27 22:29:41', '2023-04-27 22:29:41'),
(181, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de calificacion BUENA en la plataforma', '127.0.0.1', '2023-04-30 17:32:00', '2023-04-30 17:32:00'),
(182, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de calificacion BUENA en la plataforma', '127.0.0.1', '2023-04-30 17:32:06', '2023-04-30 17:32:06'),
(183, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de calificacion BUENA en la plataforma', '127.0.0.1', '2023-04-30 17:32:18', '2023-04-30 17:32:18'),
(184, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de calificacion MALA en la plataforma', '127.0.0.1', '2023-04-30 17:32:29', '2023-04-30 17:32:29'),
(185, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de calificacion EXCELENTE en la plataforma', '127.0.0.1', '2023-04-30 17:35:51', '2023-04-30 17:35:51'),
(186, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de calificacion MUY BUENA en la plataforma', '127.0.0.1', '2023-04-30 17:36:01', '2023-04-30 17:36:01'),
(187, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de calificacion REGULAR en la plataforma', '127.0.0.1', '2023-04-30 17:36:16', '2023-04-30 17:36:16'),
(188, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de calificacion MALA en la plataforma', '127.0.0.1', '2023-04-30 17:36:25', '2023-04-30 17:36:25'),
(189, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de calificacion MUY MALA en la plataforma', '127.0.0.1', '2023-04-30 17:36:33', '2023-04-30 17:36:33'),
(190, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 13841854 en la plataforma', '127.0.0.1', '2023-04-30 17:46:41', '2023-04-30 17:46:41'),
(191, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 12345678 en la plataforma', '127.0.0.1', '2023-04-30 17:48:20', '2023-04-30 17:48:20'),
(192, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de cliente 12345678 en la plataforma', '127.0.0.1', '2023-04-30 17:49:56', '2023-04-30 17:49:56'),
(193, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 123123122122 en la plataforma', '127.0.0.1', '2023-04-30 17:50:43', '2023-04-30 17:50:43'),
(194, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 27790083 en la plataforma', '127.0.0.1', '2023-04-30 18:04:00', '2023-04-30 18:04:00'),
(195, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 27790083 en la plataforma', '127.0.0.1', '2023-04-30 18:04:10', '2023-04-30 18:04:10'),
(196, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 13841854 en la plataforma', '127.0.0.1', '2023-04-30 18:04:27', '2023-04-30 18:04:27'),
(197, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 1098719559 en la plataforma', '127.0.0.1', '2023-04-30 18:06:04', '2023-04-30 18:06:04'),
(198, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 1098699832 en la plataforma', '127.0.0.1', '2023-04-30 18:06:11', '2023-04-30 18:06:11'),
(199, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #1 al cliente 2 en la plataforma', '127.0.0.1', '2023-04-30 19:29:21', '2023-04-30 19:29:21'),
(200, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #3 al cliente 3 en la plataforma', '127.0.0.1', '2023-04-30 20:03:22', '2023-04-30 20:03:22'),
(201, 'Julian', 'julianrincon9230@gmail.com', 'Edicion de cita #1 en la plataforma cambia a estado: APLAZADO', '127.0.0.1', '2023-04-30 20:43:56', '2023-04-30 20:43:56'),
(202, 'Julian', 'julianrincon9230@gmail.com', 'Edicion de cita #3 en la plataforma cambia a estado: APLAZADO', '127.0.0.1', '2023-04-30 20:47:14', '2023-04-30 20:47:14'),
(203, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #2 al cliente 3 en la plataforma', '127.0.0.1', '2023-04-30 21:03:02', '2023-04-30 21:03:02'),
(204, 'Julian', 'julianrincon9230@gmail.com', 'Edicion de cita #2 en la plataforma cambia a estado: APLAZADO', '127.0.0.1', '2023-04-30 21:04:34', '2023-04-30 21:04:34'),
(205, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #4 al cliente 3 en la plataforma', '127.0.0.1', '2023-04-30 21:06:47', '2023-04-30 21:06:47'),
(206, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #16 al cliente 2 en la plataforma', '127.0.0.1', '2023-04-30 21:07:59', '2023-04-30 21:07:59'),
(207, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1098699832 en la plataforma', '127.0.0.1', '2023-04-30 22:14:32', '2023-04-30 22:14:32'),
(208, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 1 por valor de: 25000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-04-30 22:15:00', '2023-04-30 22:15:00'),
(209, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 123456 en la plataforma', '127.0.0.1', '2023-04-30 22:15:25', '2023-04-30 22:15:25'),
(210, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 1098699832 en la plataforma', '127.0.0.1', '2023-04-30 22:15:35', '2023-04-30 22:15:35'),
(211, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 2 por valor de: 40000 para el cliente: HEIDY DAYANA', '127.0.0.1', '2023-04-30 22:16:19', '2023-04-30 22:16:19'),
(212, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 2 verificado en la plataforma', '127.0.0.1', '2023-04-30 22:17:35', '2023-04-30 22:17:35'),
(213, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #1 al cliente 2 en la plataforma', '127.0.0.1', '2023-04-30 22:17:49', '2023-04-30 22:17:49'),
(214, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #3 al cliente 1 en la plataforma', '127.0.0.1', '2023-04-30 22:18:20', '2023-04-30 22:18:20'),
(215, 'Julian', 'julianrincon9230@gmail.com', 'Edicion de cita #1 en la plataforma cambia a estado: APLAZADO', '127.0.0.1', '2023-04-30 22:18:52', '2023-04-30 22:18:52'),
(216, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #15 al cliente 2 en la plataforma', '127.0.0.1', '2023-07-06 21:35:48', '2023-07-06 21:35:48'),
(217, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 3 por valor de: 25000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-08-15 20:09:31', '2023-08-15 20:09:31'),
(218, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 4 por valor de: 30000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-08-15 20:09:31', '2023-08-15 20:09:31'),
(219, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 3 verificado en la plataforma', '127.0.0.1', '2023-08-15 20:10:34', '2023-08-15 20:10:34'),
(220, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #29 al cliente 1 en la plataforma', '127.0.0.1', '2023-08-15 20:35:44', '2023-08-15 20:35:44'),
(221, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 5 por valor de: 20000 para el cliente: HEIDY DAYANA', '127.0.0.1', '2023-08-15 20:40:26', '2023-08-15 20:40:26'),
(222, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 5 verificado en la plataforma', '127.0.0.1', '2023-08-15 20:41:00', '2023-08-15 20:41:00'),
(223, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #31 al cliente 2 en la plataforma', '127.0.0.1', '2023-08-15 20:41:54', '2023-08-15 20:41:54'),
(224, 'Julian', 'julianrincon9230@gmail.com', 'Edicion de cita #31 en la plataforma cambia a estado: APLAZADO', '127.0.0.1', '2023-08-15 20:42:41', '2023-08-15 20:42:41'),
(225, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 400000 en la plataforma', '127.0.0.1', '2023-08-16 20:44:17', '2023-08-16 20:44:17'),
(226, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de precio 400000 en la plataforma', '127.0.0.1', '2023-08-16 20:45:18', '2023-08-16 20:45:18'),
(227, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 20000 en la plataforma', '127.0.0.1', '2023-08-16 20:45:31', '2023-08-16 20:45:31'),
(228, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de precio 20000 en la plataforma', '127.0.0.1', '2023-08-16 20:49:38', '2023-08-16 20:49:38'),
(229, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 25000 en la plataforma', '127.0.0.1', '2023-08-16 20:49:50', '2023-08-16 20:49:50'),
(230, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor 25000 en la plataforma', '127.0.0.1', '2023-08-16 20:51:29', '2023-08-16 20:51:29'),
(231, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de producto ADN en la plataforma', '127.0.0.1', '2023-08-17 02:29:40', '2023-08-17 02:29:40'),
(232, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de producto ADN en la plataforma', '127.0.0.1', '2023-08-17 02:32:50', '2023-08-17 02:32:50'),
(233, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de producto ADN 5000 en la plataforma', '127.0.0.1', '2023-08-17 02:33:07', '2023-08-17 02:33:07'),
(234, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de producto ADN 5000 en la plataforma', '127.0.0.1', '2023-08-17 02:33:38', '2023-08-17 02:33:38'),
(235, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de producto ADN 4000 en la plataforma', '127.0.0.1', '2023-08-17 02:34:57', '2023-08-17 02:34:57'),
(236, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor ADN 4000 en la plataforma', '127.0.0.1', '2023-08-17 02:35:07', '2023-08-17 02:35:07'),
(237, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de producto ADN 4000 en la plataforma', '127.0.0.1', '2023-08-17 02:35:29', '2023-08-17 02:35:29'),
(238, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de producto LISO HD en la plataforma', '127.0.0.1', '2023-08-17 02:37:40', '2023-08-17 02:37:40'),
(239, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor LISO HD en la plataforma', '127.0.0.1', '2023-08-17 02:37:49', '2023-08-17 02:37:49'),
(240, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de Profesional Fabian Oswaldo Hernandez Murcia en la plataforma', '127.0.0.1', '2023-08-24 20:49:27', '2023-08-24 20:49:27'),
(241, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 200 tipo de inventario STOCK en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-24 21:45:14', '2023-08-24 21:45:14'),
(242, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 200 tipo de inventario STOCK en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-24 21:45:31', '2023-08-24 21:45:31'),
(243, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 400 tipo de inventario STOCK en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-24 21:47:31', '2023-08-24 21:47:31'),
(244, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 20000 tipo de inventario ENTRADA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-24 21:48:17', '2023-08-24 21:48:17'),
(245, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 5000 tipo de inventario STOCK en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-25 03:32:48', '2023-08-25 03:32:48'),
(246, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 5000 tipo de inventario STOCK en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-27 17:01:03', '2023-08-27 17:01:03'),
(247, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 2000 tipo de inventario SALIDA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-27 17:03:43', '2023-08-27 17:03:43'),
(248, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 20000 tipo de inventario ENTRADA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-27 17:04:45', '2023-08-27 17:04:45'),
(249, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de inventario 2 en la plataforma', '127.0.0.1', '2023-08-27 17:10:53', '2023-08-27 17:10:53'),
(250, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 7000 tipo de inventario SALIDA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-27 17:27:05', '2023-08-27 17:27:05'),
(251, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 4000 tipo de inventario SALIDA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 03:58:03', '2023-08-28 03:58:03'),
(252, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 2000 tipo de inventario ENTRADA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 04:06:59', '2023-08-28 04:06:59'),
(253, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 12000 tipo de inventario CIERRE en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 05:14:23', '2023-08-28 05:14:23'),
(254, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 4000 tipo de inventario FALTANTE en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 05:14:23', '2023-08-28 05:14:23'),
(255, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de Profesional OLFER EFRAIN OLAYA en la plataforma', '127.0.0.1', '2023-08-28 13:21:18', '2023-08-28 13:21:18'),
(256, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de producto BOTULINICA 3000 en la plataforma', '127.0.0.1', '2023-08-28 13:22:51', '2023-08-28 13:22:51'),
(257, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 5 con valor de 40000 tipo de inventario STOCK en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 13:23:39', '2023-08-28 13:23:39'),
(258, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 5 con valor de 4000 tipo de inventario ENTRADA en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 13:24:00', '2023-08-28 13:24:00'),
(259, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 5 con valor de 1000 tipo de inventario SALIDA en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 13:24:16', '2023-08-28 13:24:16'),
(260, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 5 con valor de 5000 tipo de inventario CIERRE en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 13:44:01', '2023-08-28 13:44:01'),
(261, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 5 con valor de 38000 tipo de inventario FALTANTE en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 13:44:01', '2023-08-28 13:44:01'),
(262, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 1000 tipo de inventario STOCK en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 16:24:20', '2023-08-28 16:24:20'),
(263, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 500 tipo de inventario ENTRADA en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 16:24:38', '2023-08-28 16:24:38'),
(264, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 800 tipo de inventario SALIDA en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 16:25:02', '2023-08-28 16:25:02'),
(265, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 500 tipo de inventario CIERRE en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 16:25:39', '2023-08-28 16:25:39'),
(266, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 200 tipo de inventario FALTANTE en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 16:25:39', '2023-08-28 16:25:39'),
(267, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 2000 tipo de inventario STOCK en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:09:11', '2023-08-28 19:09:11'),
(268, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 500 tipo de inventario STOCK en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:09:34', '2023-08-28 19:09:34'),
(269, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 500 tipo de inventario ENTRADA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:09:56', '2023-08-28 19:09:56'),
(270, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 600 tipo de inventario SALIDA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:10:40', '2023-08-28 19:10:40'),
(271, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 2200 tipo de inventario CIERRE en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:11:24', '2023-08-28 19:11:24'),
(272, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de -300 tipo de inventario SOBRANTE en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:11:24', '2023-08-28 19:11:24'),
(273, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 3000 tipo de inventario STOCK en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:17:29', '2023-08-28 19:17:29'),
(274, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 7000 tipo de inventario ENTRADA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:18:05', '2023-08-28 19:18:05'),
(275, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 500 tipo de inventario SALIDA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:19:31', '2023-08-28 19:19:31'),
(276, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 10000 tipo de inventario CIERRE en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:20:04', '2023-08-28 19:20:04'),
(277, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 500 tipo de inventario FALTANTE en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:20:04', '2023-08-28 19:20:04'),
(278, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 5000 tipo de inventario STOCK en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:22:02', '2023-08-28 19:22:02'),
(279, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 4 con valor de 3000 tipo de inventario SALIDA en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:22:19', '2023-08-28 19:22:19'),
(280, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 2500 tipo de inventario CIERRE en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:22:51', '2023-08-28 19:22:51'),
(281, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 4 con valor de 500 tipo de inventario SOBRANTE en el en la plataforma al profesional con ID 1', '127.0.0.1', '2023-08-28 19:22:51', '2023-08-28 19:22:51'),
(282, 'Julian', 'julianrincon9230@gmail.com', 'Ingreso de  producto con ID: 5 con valor de 5000 tipo de inventario STOCK en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 19:26:54', '2023-08-28 19:26:54'),
(283, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 5 con valor de 5000 tipo de inventario CIERRE en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 21:04:56', '2023-08-28 21:04:56'),
(284, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de  producto con ID: 5 con valor de 0 tipo de inventario SOBRANTE en el en la plataforma al profesional con ID 2', '127.0.0.1', '2023-08-28 21:04:56', '2023-08-28 21:04:56'),
(285, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio x producto N° en la plataforma', '127.0.0.1', '2023-09-04 01:56:24', '2023-09-04 01:56:24'),
(286, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio x producto N° en la plataforma', '127.0.0.1', '2023-09-04 01:58:45', '2023-09-04 01:58:45'),
(287, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio x producto N° en la plataforma', '127.0.0.1', '2023-09-04 01:59:29', '2023-09-04 01:59:29'),
(288, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio x producto N° en la plataforma', '127.0.0.1', '2023-09-04 02:00:12', '2023-09-04 02:00:12'),
(289, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio x producto N° en la plataforma', '127.0.0.1', '2023-09-04 02:01:17', '2023-09-04 02:01:17'),
(290, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio x producto N° en la plataforma', '127.0.0.1', '2023-09-04 02:02:01', '2023-09-04 02:02:01'),
(291, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio x producto N° 2 en la plataforma', '127.0.0.1', '2023-09-04 02:11:29', '2023-09-04 02:11:29');
INSERT INTO `auditoria` (`id`, `usuario`, `correo`, `observaciones`, `direccion_ip`, `created_at`, `updated_at`) VALUES
(292, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de producto x servicio 2 en la plataforma', '127.0.0.1', '2023-09-04 02:11:47', '2023-09-04 02:11:47'),
(293, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 20000 en la plataforma', '127.0.0.1', '2023-09-04 02:43:11', '2023-09-04 02:43:11'),
(294, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso inventario en la plataforma', '127.0.0.1', '2023-09-11 03:40:04', '2023-09-11 03:40:04'),
(295, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso procedimientos en la plataforma', '127.0.0.1', '2023-09-11 03:40:27', '2023-09-11 03:40:27'),
(296, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 13841854 en la plataforma', '127.0.0.1', '2023-09-13 03:18:24', '2023-09-13 03:18:24'),
(297, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 27790008 en la plataforma', '127.0.0.1', '2023-09-13 03:21:24', '2023-09-13 03:21:24'),
(298, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 1098643625 en la plataforma', '127.0.0.1', '2023-09-13 03:22:38', '2023-09-13 03:22:38'),
(299, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 60000 en la plataforma', '127.0.0.1', '2023-09-14 15:48:34', '2023-09-14 15:48:34'),
(300, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de precio 60000 en la plataforma', '127.0.0.1', '2023-09-14 15:50:08', '2023-09-14 15:50:08'),
(301, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 25000 en la plataforma', '127.0.0.1', '2023-09-14 15:50:32', '2023-09-14 15:50:32'),
(302, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de precio 25000 en la plataforma', '127.0.0.1', '2023-09-14 15:53:07', '2023-09-14 15:53:07'),
(303, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 25000 en la plataforma', '127.0.0.1', '2023-09-14 15:53:52', '2023-09-14 15:53:52'),
(304, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio  en la plataforma', '127.0.0.1', '2023-09-15 04:09:31', '2023-09-15 04:09:31'),
(305, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio  en la plataforma', '127.0.0.1', '2023-09-15 04:09:37', '2023-09-15 04:09:37'),
(306, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de descuento MES DEL AMOR Y LA AMISTAD en la plataforma', '127.0.0.1', '2023-09-15 04:10:48', '2023-09-15 04:10:48'),
(307, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 200000 en la plataforma', '127.0.0.1', '2023-09-15 04:11:20', '2023-09-15 04:11:20'),
(308, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 150000 en la plataforma', '127.0.0.1', '2023-09-15 04:11:52', '2023-09-15 04:11:52'),
(309, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor 240000 en la plataforma', '127.0.0.1', '2023-09-15 04:12:07', '2023-09-15 04:12:07'),
(310, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor 50000 en la plataforma', '127.0.0.1', '2023-09-15 04:12:19', '2023-09-15 04:12:19'),
(311, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de precio 100000 en la plataforma', '127.0.0.1', '2023-09-15 04:12:39', '2023-09-15 04:12:39'),
(312, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor 140000 en la plataforma', '127.0.0.1', '2023-09-15 04:19:17', '2023-09-15 04:19:17'),
(313, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(314, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(315, 'Julian', 'julianrincon9230@gmail.com', 'Edicion de cita #15 en la plataforma cambia a estado: CANCELADO', '127.0.0.1', '2023-09-15 17:32:18', '2023-09-15 17:32:18'),
(316, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #53 al cliente 2 en la plataforma', '127.0.0.1', '2023-09-15 20:11:04', '2023-09-15 20:11:04'),
(317, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(318, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de Profesional Andrea Muñoz en la plataforma', '127.0.0.1', '2023-09-17 18:18:52', '2023-09-17 18:18:52'),
(319, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de Profesional LUZ MARINA VARGAS CAÑAS en la plataforma', '127.0.0.1', '2023-09-17 18:21:19', '2023-09-17 18:21:19'),
(320, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor LISO HD-PRODUCTO en la plataforma', '127.0.0.1', '2023-09-17 18:43:51', '2023-09-17 18:43:51'),
(321, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de valor BOTULINICA 3000-PRODUCTO en la plataforma', '127.0.0.1', '2023-09-17 18:44:01', '2023-09-17 18:44:01'),
(322, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio x producto N° en la plataforma', '127.0.0.1', '2023-09-17 18:45:06', '2023-09-17 18:45:06'),
(335, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida16 en  el producto semana', '127.0.0.1', '2023-09-19 02:12:31', '2023-09-19 02:12:31'),
(336, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida17 en  el producto semana', '127.0.0.1', '2023-09-19 02:12:31', '2023-09-19 02:12:31'),
(337, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de procedimiento profesional #5 en el procedimiento_profesional', '127.0.0.1', '2023-09-19 02:12:31', '2023-09-19 02:12:31'),
(338, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacio de pago de procedimiento # 6 en la plataforma a estado CERRADO', '127.0.0.1', '2023-09-19 02:12:31', '2023-09-19 02:12:31'),
(339, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 6 por valor de: 50000 para el cliente: HEIDY DAYANA', '127.0.0.1', '2023-09-19 04:44:57', '2023-09-19 04:44:57'),
(340, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #55 al cliente 2 en la plataforma', '127.0.0.1', '2023-09-19 04:46:07', '2023-09-19 04:46:07'),
(341, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(342, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio x producto N° en la plataforma', '127.0.0.1', '2023-09-19 04:48:02', '2023-09-19 04:48:02'),
(343, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida18 en  el producto semana', '127.0.0.1', '2023-09-19 04:48:39', '2023-09-19 04:48:39'),
(344, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de procedimiento profesional #6 en el procedimiento_profesional', '127.0.0.1', '2023-09-19 04:48:39', '2023-09-19 04:48:39'),
(345, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de procedimiento profesional #7 en el procedimiento_profesional', '127.0.0.1', '2023-09-19 04:48:39', '2023-09-19 04:48:39'),
(346, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacio de pago de procedimiento # 7 en la plataforma a estado CERRADO', '127.0.0.1', '2023-09-19 04:48:39', '2023-09-19 04:48:39'),
(347, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #56 al cliente 2 en la plataforma', '127.0.0.1', '2023-09-19 04:51:14', '2023-09-19 04:51:14'),
(348, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 7 por valor de: 70000 para el cliente: FABIANA HERNANDEZ', '127.0.0.1', '2023-09-20 02:38:25', '2023-09-20 02:38:25'),
(349, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 8 por valor de: 70000 para el cliente: ANDREA MUÑOZ', '127.0.0.1', '2023-09-20 02:38:45', '2023-09-20 02:38:45'),
(350, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 9 por valor de: 20000 para el cliente: HEIDY DAYANA', '127.0.0.1', '2023-09-20 02:39:08', '2023-09-20 02:39:08'),
(351, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #64 al cliente 1 en la plataforma', '127.0.0.1', '2023-09-20 02:39:26', '2023-09-20 02:39:26'),
(352, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #61 al cliente 5 en la plataforma', '127.0.0.1', '2023-09-20 02:39:45', '2023-09-20 02:39:45'),
(353, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #60 al cliente 2 en la plataforma', '127.0.0.1', '2023-09-20 02:40:19', '2023-09-20 02:40:19'),
(354, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(355, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(356, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(357, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida19 en  el producto semana', '127.0.0.1', '2023-09-20 02:44:49', '2023-09-20 02:44:49'),
(358, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de procedimiento profesional #8 en el procedimiento_profesional', '127.0.0.1', '2023-09-20 02:44:49', '2023-09-20 02:44:49'),
(359, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacio de pago de procedimiento # 10 en la plataforma a estado CERRADO', '127.0.0.1', '2023-09-20 02:44:49', '2023-09-20 02:44:49'),
(360, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida20 en  el producto semana', '127.0.0.1', '2023-09-20 02:45:26', '2023-09-20 02:45:26'),
(361, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de procedimiento profesional #9 en el procedimiento_profesional', '127.0.0.1', '2023-09-20 02:45:26', '2023-09-20 02:45:26'),
(362, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacio de pago de procedimiento # 5 en la plataforma a estado CERRADO', '127.0.0.1', '2023-09-20 02:45:26', '2023-09-20 02:45:26'),
(363, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida21 en  el producto semana', '127.0.0.1', '2023-09-20 02:45:58', '2023-09-20 02:45:58'),
(364, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida22 en  el producto semana', '127.0.0.1', '2023-09-20 02:45:58', '2023-09-20 02:45:58'),
(365, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de procedimiento profesional #10 en el procedimiento_profesional', '127.0.0.1', '2023-09-20 02:45:58', '2023-09-20 02:45:58'),
(366, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de procedimiento profesional #11 en el procedimiento_profesional', '127.0.0.1', '2023-09-20 02:45:58', '2023-09-20 02:45:58'),
(367, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacio de pago de procedimiento # 9 en la plataforma a estado CERRADO', '127.0.0.1', '2023-09-20 02:45:58', '2023-09-20 02:45:58'),
(368, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida23 en  el producto semana', '127.0.0.1', '2023-09-20 02:46:23', '2023-09-20 02:46:23'),
(369, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de procedimiento profesional #12 en el procedimiento_profesional', '127.0.0.1', '2023-09-20 02:46:23', '2023-09-20 02:46:23'),
(370, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacio de pago de procedimiento # 8 en la plataforma a estado CERRADO', '127.0.0.1', '2023-09-20 02:46:23', '2023-09-20 02:46:23'),
(371, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida24 en  el producto semana', '127.0.0.1', '2023-09-20 02:46:47', '2023-09-20 02:46:47'),
(372, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida25 en  el producto semana', '127.0.0.1', '2023-09-20 02:46:47', '2023-09-20 02:46:47'),
(373, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de procedimiento profesional #13 en el procedimiento_profesional', '127.0.0.1', '2023-09-20 02:46:47', '2023-09-20 02:46:47'),
(374, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacio de pago de procedimiento # 4 en la plataforma a estado CERRADO', '127.0.0.1', '2023-09-20 02:46:47', '2023-09-20 02:46:47'),
(375, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio adicional CORTE 3000 en la plataforma', '127.0.0.1', '2023-09-20 15:47:27', '2023-09-20 15:47:27'),
(376, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio Adicional 1 en la plataforma', '127.0.0.1', '2023-09-20 15:47:45', '2023-09-20 15:47:45'),
(377, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio adicional DESPUNTADA en la plataforma', '127.0.0.1', '2023-09-20 15:48:17', '2023-09-20 15:48:17'),
(378, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio adicional CORTE LOCO en la plataforma', '127.0.0.1', '2023-09-20 15:49:16', '2023-09-20 15:49:16'),
(379, 'Julian', 'julianrincon9230@gmail.com', 'Eliminación de servicio Adicional 3 en la plataforma', '127.0.0.1', '2023-09-20 15:49:25', '2023-09-20 15:49:25'),
(380, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(381, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(382, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(383, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(384, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(385, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(386, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de servicio adicional CORTE PLUS en la plataforma', '127.0.0.1', '2023-09-20 21:35:04', '2023-09-20 21:35:04'),
(387, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(388, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 4 verificado en la plataforma', '127.0.0.1', '2023-09-21 15:40:52', '2023-09-21 15:40:52'),
(389, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #65 al cliente 1 en la plataforma', '127.0.0.1', '2023-09-21 15:41:32', '2023-09-21 15:41:32'),
(390, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cuenta de pago 12414124 en la plataforma', '127.0.0.1', '2023-09-21 16:13:37', '2023-09-21 16:13:37'),
(391, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(392, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 10 por valor de: 25000 para el cliente: FABIANA HERNANDEZ', '127.0.0.1', '2023-09-21 17:27:08', '2023-09-21 17:27:08'),
(393, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 11 por valor de: 40000 para el cliente: DORIS VARGAS', '127.0.0.1', '2023-09-21 17:27:35', '2023-09-21 17:27:35'),
(394, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #66 al cliente 5 en la plataforma', '127.0.0.1', '2023-09-21 17:27:57', '2023-09-21 17:27:57'),
(395, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 11 verificado en la plataforma', '127.0.0.1', '2023-09-21 17:28:35', '2023-09-21 17:28:35'),
(396, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #68 al cliente 4 en la plataforma', '127.0.0.1', '2023-09-21 17:29:27', '2023-09-21 17:29:27'),
(397, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(398, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(399, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(400, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso procedimientos-adicional en la plataforma', '127.0.0.1', '2023-09-21 17:55:13', '2023-09-21 17:55:13'),
(401, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso procedimientos-cierre en la plataforma', '127.0.0.1', '2023-09-21 17:55:38', '2023-09-21 17:55:38'),
(402, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia  # 3 verificado en la plataforma', '127.0.0.1', '2023-09-21 19:22:11', '2023-09-21 19:22:11'),
(403, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia  # 1 verificado en la plataforma', '127.0.0.1', '2023-09-21 19:23:08', '2023-09-21 19:23:08'),
(404, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(405, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia  # 5 verificado en la plataforma', '127.0.0.1', '2023-09-21 19:30:14', '2023-09-21 19:30:14'),
(406, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia # 5 verificado en la plataforma', '127.0.0.1', '2023-09-21 19:31:25', '2023-09-21 19:31:25'),
(407, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia  # 5 verificado en la plataforma', '127.0.0.1', '2023-09-21 19:33:28', '2023-09-21 19:33:28'),
(408, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 12 por valor de: 25000 para el cliente: HEIDY DAYANA', '127.0.0.1', '2023-09-21 19:35:29', '2023-09-21 19:35:29'),
(409, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #67 al cliente 2 en la plataforma', '127.0.0.1', '2023-09-21 19:35:44', '2023-09-21 19:35:44'),
(410, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(411, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia  # 6 verificado en la plataforma', '127.0.0.1', '2023-09-21 19:39:05', '2023-09-21 19:39:05'),
(412, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(413, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia  # 7 verificado en la plataforma', '127.0.0.1', '2023-09-21 19:40:05', '2023-09-21 19:40:05'),
(414, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia # 7 verificado en la plataforma', '127.0.0.1', '2023-09-21 20:02:37', '2023-09-21 20:02:37'),
(415, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia  # 7 verificado en la plataforma', '127.0.0.1', '2023-09-21 20:03:22', '2023-09-21 20:03:22'),
(416, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso validacion-transferencias en la plataforma', '127.0.0.1', '2023-09-21 20:03:40', '2023-09-21 20:03:40'),
(417, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de rol ADMIN en la plataforma', '127.0.0.1', '2023-09-21 20:09:45', '2023-09-21 20:09:45'),
(418, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(419, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(420, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(421, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(422, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(423, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de servicios adicionales #  en la plataforma', '127.0.0.1', NULL, NULL),
(424, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de permiso cierre-caja en la plataforma', '127.0.0.1', '2023-09-21 21:37:57', '2023-09-21 21:37:57'),
(425, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 13 por valor de: 20000 para el cliente: FABIANA HERNANDEZ', '127.0.0.1', '2023-09-21 22:10:04', '2023-09-21 22:10:04'),
(426, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio  en la plataforma', '127.0.0.1', '2023-09-24 20:41:01', '2023-09-24 20:41:01'),
(427, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio  en la plataforma', '127.0.0.1', '2023-09-24 20:42:12', '2023-09-24 20:42:12'),
(428, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de servicio  en la plataforma', '127.0.0.1', '2023-09-24 20:42:29', '2023-09-24 20:42:29'),
(429, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de cliente 123456789 en la plataforma', '127.0.0.1', '2023-09-25 03:31:12', '2023-09-25 03:31:12'),
(430, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacion de cliente 123456789 en la plataforma', '127.0.0.1', '2023-09-25 03:31:51', '2023-09-25 03:31:51'),
(431, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 25000 a cliente 6 en la plataforma', '127.0.0.1', '2023-09-26 05:53:35', '2023-09-26 05:53:35'),
(432, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 13 verificado en la plataforma', '127.0.0.1', '2023-09-26 05:54:11', '2023-09-26 05:54:11'),
(433, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 15 por valor de: 25000 para el cliente: OLFERA OLAYA', '127.0.0.1', '2023-09-26 05:56:03', '2023-09-26 05:56:03'),
(434, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #70 al cliente 6 en la plataforma', '127.0.0.1', '2023-09-26 05:56:27', '2023-09-26 05:56:27'),
(435, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(436, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida26 en  el producto semana', '127.0.0.1', '2023-09-26 19:05:28', '2023-09-26 19:05:28'),
(437, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de salida27 en  el producto semana', '127.0.0.1', '2023-09-26 19:05:28', '2023-09-26 19:05:28'),
(438, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de procedimiento profesional #14 en el procedimiento_profesional', '127.0.0.1', '2023-09-26 19:05:28', '2023-09-26 19:05:28'),
(439, 'Julian', 'julianrincon9230@gmail.com', 'Actualizacio de pago de procedimiento # 17 en la plataforma a estado CERRADO', '127.0.0.1', '2023-09-26 19:05:28', '2023-09-26 19:05:28'),
(440, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #71 al cliente 6 en la plataforma', '127.0.0.1', '2023-09-26 19:05:57', '2023-09-26 19:05:57'),
(441, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(442, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 16 por valor de: 40000 para el cliente: FABIANA HERNANDEZ', '127.0.0.1', '2023-09-26 19:10:36', '2023-09-26 19:10:36'),
(443, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #72 al cliente 5 en la plataforma', '127.0.0.1', '2023-09-26 19:11:22', '2023-09-26 19:11:22'),
(444, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(445, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 17 por valor de: 70000 para el cliente: DORIS VARGAS', '127.0.0.1', '2023-09-26 19:15:12', '2023-09-26 19:15:12'),
(446, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #73 al cliente 4 en la plataforma', '127.0.0.1', '2023-09-26 19:15:38', '2023-09-26 19:15:38'),
(447, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(448, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 90000 a cliente 6 en la plataforma', '127.0.0.1', '2023-09-26 19:23:35', '2023-09-26 19:23:35'),
(449, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de abono 70000 a cliente 3 en la plataforma', '127.0.0.1', '2023-09-26 19:26:11', '2023-09-26 19:26:11'),
(450, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia  # 16 verificado en la plataforma', '127.0.0.1', '2023-09-26 19:27:00', '2023-09-26 19:27:00'),
(451, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia  # 14 verificado en la plataforma', '127.0.0.1', '2023-09-26 19:27:08', '2023-09-26 19:27:08'),
(452, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #74 al cliente 5 en la plataforma', '127.0.0.1', '2023-09-26 19:40:28', '2023-09-26 19:40:28'),
(453, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(454, 'Julian', 'julianrincon9230@gmail.com', 'Abono # 19 verificado en la plataforma', '127.0.0.1', '2023-09-26 19:46:01', '2023-09-26 19:46:01'),
(455, 'Julian', 'julianrincon9230@gmail.com', 'Asignacion de cita #75 al cliente 3 en la plataforma', '127.0.0.1', '2023-09-26 19:47:47', '2023-09-26 19:47:47'),
(456, 'Julian', 'julianrincon9230@gmail.com', 'Creacion de pago de procedimiento #  en la plataforma', '127.0.0.1', NULL, NULL),
(457, 'Julian', 'julianrincon9230@gmail.com', 'Transferencia  # 19 verificado en la plataforma', '127.0.0.1', '2023-09-26 19:49:04', '2023-09-26 19:49:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id` bigint(20) NOT NULL,
  `calificacion` varchar(100) NOT NULL COMMENT 'calificacion',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`id`, `calificacion`, `created_at`, `updated_at`) VALUES
(1, 'EXCELENTE', '2023-04-30 12:35:51', '2023-04-30 12:35:51'),
(2, 'MUY BUENA', '2023-04-30 12:36:01', '2023-04-30 12:36:01'),
(3, 'REGULAR', '2023-04-30 12:36:16', '2023-04-30 12:36:16'),
(4, 'MALA', '2023-04-30 12:36:25', '2023-04-30 12:36:25'),
(5, 'MUY MALA', '2023-04-30 12:36:33', '2023-04-30 12:36:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) NOT NULL,
  `documento` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'fecha de nacimiento',
  `whatsapp` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `instagram` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(2) NOT NULL,
  `observacion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `calificacion_id` bigint(20) DEFAULT NULL COMMENT 'id de calificacion id',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `documento`, `nombres`, `apellidos`, `telefono`, `fecha_nacimiento`, `whatsapp`, `instagram`, `direccion`, `estado`, `observacion`, `calificacion_id`, `created_at`, `updated_at`) VALUES
(1, '1098699832', 'ANDREA', 'MUÑOZ', '3166107397', '1991-02-03', NULL, NULL, NULL, 1, NULL, 4, '2023-04-30 17:14:32', '2023-04-30 17:15:35'),
(2, '123456', 'HEIDY', 'DAYANA', '3168706182', '1998-02-12', NULL, NULL, NULL, 1, NULL, 1, '2023-04-30 17:15:25', '2023-04-30 17:15:25'),
(3, '13841854', 'LUZ MARINA', 'VARGAS', '3168706182', '1995-03-03', '3168706182', NULL, NULL, 1, NULL, 1, '2023-09-12 22:18:24', '2023-09-12 22:18:24'),
(4, '27790008', 'DORIS', 'VARGAS', '3219080690', '1958-05-10', '3219080690', NULL, NULL, 1, NULL, 1, '2023-09-12 22:21:24', '2023-09-12 22:21:24'),
(5, '1098643625', 'FABIANA', 'HERNANDEZ', '3125178877', NULL, '3125178877', '@fabian9230', NULL, 1, 'un bello', 1, '2023-09-12 22:22:38', '2023-09-12 22:22:38'),
(6, '123456789', 'OLFERA', 'OLAYA', '3216173123', '1995-03-23', NULL, NULL, 'CARRERA 27 NO.54-10 APTO 2370', 1, NULL, 1, '2023-09-24 22:31:12', '2023-09-24 22:31:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_pago`
--

CREATE TABLE `cuentas_pago` (
  `id` bigint(20) NOT NULL,
  `medio_pago_id` bigint(20) NOT NULL COMMENT 'id tabla medio de pago',
  `entidad` varchar(50) DEFAULT NULL COMMENT 'entidad financiera',
  `numero_cuenta` varchar(50) DEFAULT NULL COMMENT '#cuenta',
  `estado` int(1) NOT NULL COMMENT 'estado de cuenta',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuentas_pago`
--

INSERT INTO `cuentas_pago` (`id`, `medio_pago_id`, `entidad`, `numero_cuenta`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'CAJA MENOR', '0000000', 1, '2023-04-21 15:11:14', '2023-04-21 15:11:14'),
(2, 2, 'NEQUI', '3173639222', 1, '2023-04-21 15:11:25', '2023-04-21 15:11:42'),
(3, 2, 'BANCOLOMBIA', '12414124', 1, '2023-09-21 11:13:37', '2023-09-21 11:13:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_productos`
--

CREATE TABLE `inventario_productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) NOT NULL,
  `tipo_transaccion` enum('STOCK','ENTRADA','SALIDA','DESCUADRE','CIERRE') NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `destino` varchar(20) NOT NULL COMMENT 'venta, oficina, online',
  `responsable` varchar(20) NOT NULL COMMENT 'cc interno o de cliente',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio_pago`
--

CREATE TABLE `medio_pago` (
  `id` bigint(20) NOT NULL,
  `medio_pago` varchar(30) NOT NULL COMMENT 'Medio de pago',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medio_pago`
--

INSERT INTO `medio_pago` (`id`, `medio_pago`, `created_at`, `updated_at`) VALUES
(1, 'EFECTIVO', '2023-04-21 14:20:21', '2023-04-21 14:20:21'),
(2, 'TRANSFERENCIA', '2023-04-21 14:20:27', '2023-04-21 14:20:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_09_06_185730_create_permission_tables', 2),
(5, '2022_09_08_143813_table_auditoria_create', 3),
(6, '2022_09_09_182849_table_users_softdeletes', 4),
(7, '2022_09_14_144632_create_table_areas_', 5),
(8, '2022_09_14_161821_create_campos_delete_areas', 6),
(9, '2022_09_14_170326_create_table_procesos', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_adicionales`
--

CREATE TABLE `pago_adicionales` (
  `id` bigint(20) NOT NULL,
  `cliente_id` bigint(20) NOT NULL COMMENT 'llave de la tabla clientes',
  `servicio_adicional_id` bigint(20) NOT NULL COMMENT 'llave de la tabla servicio adicional',
  `valor_pagar` decimal(10,0) NOT NULL,
  `comision` varchar(50) NOT NULL,
  `medio_pago` varchar(50) NOT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pago_adicionales`
--

INSERT INTO `pago_adicionales` (`id`, `cliente_id`, `servicio_adicional_id`, `valor_pagar`, `comision`, `medio_pago`, `observaciones`, `created_at`, `updated_at`) VALUES
(6, 2, 1, '35000', '7000', 'EFECTIVO', NULL, '2023-09-20 16:16:30', '2023-09-20 16:16:30'),
(7, 4, 1, '35000', '7000', 'SIN PAGO', NULL, '2023-09-20 16:22:30', '2023-09-20 16:22:30'),
(8, 2, 2, '40000', '6000', 'TRANSFERENCIA', NULL, '2023-09-20 16:23:26', '2023-09-20 16:23:26'),
(9, 2, 1, '35000', '7000', 'SIN PAGO', NULL, '2023-09-20 16:26:33', '2023-09-20 16:26:33'),
(11, 3, 4, '0', '10000', 'EFECTIVO', NULL, '2023-09-20 16:35:27', '2023-09-20 16:35:27'),
(12, 3, 1, '35000', '7000', 'EFECTIVO', NULL, '2023-09-21 12:46:00', '2023-09-21 12:46:00'),
(13, 2, 1, '35000', '7000', 'TRANSFERENCIA', NULL, '2023-09-21 14:23:33', '2023-09-21 14:23:33'),
(14, 3, 2, '40000', '6000', 'TRANSFERENCIA', NULL, '2023-09-21 14:39:42', '2023-09-21 14:39:42'),
(15, 4, 1, '35000', '7000', 'SIN-PAGO', NULL, '2023-09-21 16:12:31', '2023-09-21 16:12:31'),
(16, 3, 2, '40000', '6000', 'EFECTIVO', NULL, '2023-09-21 16:14:12', '2023-09-21 16:14:12'),
(17, 3, 2, '40000', '6000', 'SIN-PAGO', NULL, '2023-09-21 16:15:07', '2023-09-21 16:15:07'),
(18, 3, 2, '40000', '6000', 'EFECTIVO', NULL, '2023-09-21 16:21:22', '2023-09-21 16:21:22'),
(19, 3, 4, '0', '10000', 'SIN-PAGO', NULL, '2023-09-21 16:23:10', '2023-09-21 16:23:10'),
(20, 3, 1, '35000', '7000', 'EFECTIVO', NULL, '2023-09-21 16:31:08', '2023-09-21 16:31:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_procedimiento`
--

CREATE TABLE `pago_procedimiento` (
  `id` bigint(20) NOT NULL,
  `cliente_id` bigint(20) NOT NULL,
  `servicio_id` bigint(20) NOT NULL,
  `talla_id` bigint(20) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `planes_id` bigint(20) DEFAULT NULL,
  `abonos_id` bigint(20) NOT NULL,
  `valor_pagar` decimal(10,0) NOT NULL,
  `medio_pago` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'de tabla de medios de pago',
  `estado` enum('CERRADO','ABIERTO') COLLATE utf8_spanish_ci NOT NULL COMMENT 'ESTADO por default ABIERTO',
  `realizo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comision` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pago_procedimiento`
--

INSERT INTO `pago_procedimiento` (`id`, `cliente_id`, `servicio_id`, `talla_id`, `precio`, `planes_id`, `abonos_id`, `valor_pagar`, `medio_pago`, `estado`, `realizo`, `observaciones`, `comision`, `created_at`, `updated_at`) VALUES
(4, 1, 2, 1, '200000', 1, 3, '162000', 'EFECTIVO', 'CERRADO', 'Julian', 'Procedimiento cerrado en la plataforma', '50000', '2023-09-15 12:22:30', '2023-09-19 21:46:47'),
(5, 1, 3, 1, '140000', NULL, 1, '115000', 'EFECTIVO', 'CERRADO', 'Julian', 'Procedimiento cerrado en la plataforma', '30000', '2023-09-15 12:24:26', '2023-09-19 21:45:26'),
(6, 2, 2, 1, '200000', 1, 2, '144000', 'EFECTIVO', 'CERRADO', 'Julian', 'Procedimiento cerrado en la plataforma', '50000', '2023-09-15 15:11:59', '2023-09-18 21:12:31'),
(8, 2, 4, 1, '140000', NULL, 9, '120000', 'EFECTIVO', 'CERRADO', 'Julian', 'Procedimiento cerrado en la plataforma', '30000', '2023-09-19 21:42:48', '2023-09-19 21:46:23'),
(9, 5, 2, 1, '200000', NULL, 7, '130000', 'TRANSFERENCIA', 'CERRADO', 'Julian', 'Procedimiento cerrado en la plataforma', '50000', '2023-09-19 21:43:21', '2023-09-19 21:45:58'),
(10, 2, 4, 2, '100000', NULL, 5, '80000', 'TRANSFERENCIA', 'CERRADO', 'Julian', 'Procedimiento cerrado en la plataforma', '5000', '2023-09-19 21:43:53', '2023-09-19 21:44:49'),
(11, 1, 2, 1, '200000', 1, 8, '117000', 'EFECTIVO', 'ABIERTO', 'Julian', NULL, '50000', '2023-09-20 16:33:01', '2023-09-20 16:33:01'),
(13, 1, 3, 1, '50000', NULL, 4, '20000', 'TRANSFERENCIA', 'ABIERTO', 'Julian', NULL, '2500', '2023-09-21 12:24:14', '2023-09-21 12:24:14'),
(14, 4, 3, 1, '50000', NULL, 11, '10000', 'EFECTIVO', 'ABIERTO', 'Julian', NULL, '2500', '2023-09-21 12:30:59', '2023-09-21 12:30:59'),
(15, 5, 2, 1, '200000', NULL, 10, '175000', 'TRANSFERENCIA', 'ABIERTO', 'Julian', NULL, '50000', '2023-09-21 12:32:32', '2023-09-21 12:32:32'),
(16, 2, 2, 1, '200000', NULL, 12, '175000', 'TRANSFERENCIA', 'ABIERTO', 'Julian', NULL, '50000', '2023-09-21 14:38:47', '2023-09-21 14:38:47'),
(17, 6, 2, 1, '200000', NULL, 15, '157500', 'EFECTIVO', 'CERRADO', 'Julian', 'Procedimiento cerrado en la plataforma', '50000', '2023-09-26 14:02:22', '2023-09-26 14:05:28'),
(18, 6, 2, 1, '200000', NULL, 14, '0', 'EFECTIVO', 'ABIERTO', 'Julian', NULL, '50000', '2023-09-26 14:07:36', '2023-09-26 14:07:36'),
(19, 5, 2, 1, '200000', NULL, 13, '180000', 'TRANSFERENCIA', 'ABIERTO', 'Julian', NULL, '50000', '2023-09-26 14:12:04', '2023-09-26 14:12:04'),
(20, 4, 2, 1, '200000', NULL, 17, '117000', 'EFECTIVO', 'ABIERTO', 'Julian', NULL, '50000', '2023-09-26 14:16:21', '2023-09-26 14:16:21'),
(21, 5, 2, 1, '200000', NULL, 16, '160000', 'EFECTIVO', 'ABIERTO', 'Julian', NULL, '50000', '2023-09-26 14:42:58', '2023-09-26 14:42:58'),
(22, 3, 2, 1, '200000', NULL, 19, '130000', 'EFECTIVO', 'ABIERTO', 'Julian', NULL, '50000', '2023-09-26 14:48:46', '2023-09-26 14:48:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'control-total', 'web', '2022-09-09 16:48:54', '2022-09-20 04:34:01'),
(2, 'ver-usuarios', 'web', '2022-09-09 16:49:40', '2022-09-09 16:49:40'),
(3, 'editar-usuarios', 'web', '2022-09-09 16:49:51', '2022-09-09 16:49:51'),
(4, 'servicios-profesionales', 'web', '2022-09-09 16:50:33', '2023-02-15 02:26:04'),
(5, 'ver-informacion', 'web', '2022-12-02 00:59:00', '2023-02-15 02:25:42'),
(6, 'inventario', 'web', '2023-09-11 03:40:04', '2023-09-11 03:40:04'),
(7, 'procedimientos', 'web', '2023-09-11 03:40:27', '2023-09-11 03:40:27'),
(8, 'procedimientos-adicional', 'web', '2023-09-21 17:55:13', '2023-09-21 17:55:13'),
(9, 'procedimientos-cierre', 'web', '2023-09-21 17:55:38', '2023-09-21 17:55:38'),
(10, 'validacion-transferencias', 'web', '2023-09-21 20:03:40', '2023-09-21 20:03:40'),
(11, 'cierre-caja', 'web', '2023-09-21 21:37:57', '2023-09-21 21:37:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_dcto`
--

CREATE TABLE `planes_dcto` (
  `id` bigint(20) NOT NULL,
  `plan` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descuento` decimal(10,0) NOT NULL COMMENT 'porcentaje de descuento',
  `estado` tinyint(1) NOT NULL COMMENT 'estado del descuento para que aparezca en pantalla 1= activo, 0= inactivo',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `planes_dcto`
--

INSERT INTO `planes_dcto` (`id`, `plan`, `descuento`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'PROMO GOLDS', '10', 1, '2023-03-25 11:16:37', '2023-09-24 15:42:29'),
(3, 'PROMO MES MUJER', '40', 0, '2023-03-25 11:19:56', '2023-09-14 23:09:37'),
(4, 'MES DEL AMOR Y LA AMISTAD', '20', 1, '2023-09-14 23:10:48', '2023-09-14 23:10:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `id` bigint(20) NOT NULL,
  `servicio_id` bigint(20) NOT NULL,
  `talla_id` bigint(20) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `comision` decimal(10,0) DEFAULT NULL COMMENT 'valor de la comision',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id`, `servicio_id`, `talla_id`, `valor`, `comision`, `created_at`, `updated_at`) VALUES
(3, 3, 1, '50000', '2500', '2023-08-16 15:49:50', '2023-09-14 23:12:19'),
(4, 4, 1, '140000', '30000', '2023-09-03 21:43:11', '2023-09-14 23:19:17'),
(7, 3, 2, '240000', '2500', '2023-09-14 10:53:52', '2023-09-14 23:12:07'),
(8, 2, 1, '200000', '50000', '2023-09-14 23:11:20', '2023-09-14 23:11:20'),
(9, 2, 2, '150000', '15000', '2023-09-14 23:11:52', '2023-09-14 23:11:52'),
(10, 4, 2, '100000', '5000', '2023-09-14 23:12:39', '2023-09-14 23:12:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimiento_profesional`
--

CREATE TABLE `procedimiento_profesional` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) NOT NULL,
  `procedimiento_id` bigint(20) NOT NULL,
  `comision` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `porcentaje` varchar(50) DEFAULT NULL COMMENT 'identificar compartido??',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `procedimiento_profesional`
--

INSERT INTO `procedimiento_profesional` (`id`, `profesional_id`, `procedimiento_id`, `comision`, `fecha`, `porcentaje`, `created_at`, `updated_at`) VALUES
(5, 4, 6, 50000, '2023-09-18', '100%', '2023-09-18 21:12:31', '2023-09-18 21:12:31'),
(8, 4, 10, 5000, '2023-09-19', '100%', '2023-09-19 21:44:49', '2023-09-19 21:44:49'),
(9, 4, 5, 30000, '2023-09-19', '100%', '2023-09-19 21:45:26', '2023-09-19 21:45:26'),
(10, 4, 9, 25000, '2023-09-19', '50%', '2023-09-19 21:45:58', '2023-09-19 21:45:58'),
(11, 2, 9, 25000, '2023-09-19', '50%', '2023-09-19 21:45:58', '2023-09-19 21:45:58'),
(12, 2, 8, 30000, '2023-09-19', '100%', '2023-09-19 21:46:23', '2023-09-19 21:46:23'),
(13, 4, 4, 50000, '2023-09-19', '100%', '2023-09-19 21:46:47', '2023-09-19 21:46:47'),
(14, 4, 17, 50000, '2023-09-26', '100%', '2023-09-26 14:05:28', '2023-09-26 14:05:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `presentacion` varchar(20) NOT NULL,
  `valor_unitario` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `tipo`, `presentacion`, `valor_unitario`, `created_at`, `updated_at`) VALUES
(4, 'LISO HD-PRODUCTO', 'Professional', '400ML', 5000, '2023-08-16 21:37:40', '2023-09-17 13:43:51'),
(5, 'BOTULINICA 3000-PRODUCTO', 'Professional', '500ML', 50000, '2023-08-28 08:22:51', '2023-09-17 13:44:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_semana`
--

CREATE TABLE `producto_semana` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) NOT NULL,
  `tipo_transaccion` enum('STOCK','ENTRADA','SALIDA','CIERRE','FALTANTE','SOBRANTE') NOT NULL,
  `valor` int(11) NOT NULL COMMENT 'cantidad en gramos',
  `fecha` date NOT NULL,
  `procedimiento_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_semana`
--

INSERT INTO `producto_semana` (`id`, `producto_id`, `profesional_id`, `tipo_transaccion`, `valor`, `fecha`, `procedimiento_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'STOCK', 5000, '2023-08-28', NULL, '2023-08-28 14:22:02', '2023-08-28 14:22:02'),
(2, 4, 1, 'SALIDA', 3000, '2023-08-28', NULL, '2023-08-28 14:22:19', '2023-08-28 14:22:19'),
(3, 4, 1, 'CIERRE', 2500, '2023-08-28', NULL, '2023-08-28 14:22:51', '2023-08-28 14:22:51'),
(4, 4, 1, 'SOBRANTE', 500, '2023-08-28', NULL, '2023-08-28 14:22:51', '2023-08-28 14:22:51'),
(5, 5, 2, 'STOCK', 5000, '2023-08-28', NULL, '2023-08-28 14:26:54', '2023-08-28 14:26:54'),
(6, 5, 2, 'CIERRE', 5000, '2023-08-28', NULL, '2023-08-28 16:04:56', '2023-08-28 16:04:56'),
(7, 5, 2, 'SOBRANTE', 0, '2023-08-28', NULL, '2023-08-28 16:04:56', '2023-08-28 16:04:56'),
(16, 4, 4, 'SALIDA', 70, '2023-09-18', 6, '2023-09-18 21:12:31', '2023-09-18 21:12:31'),
(17, 5, 4, 'SALIDA', 70, '2023-09-18', 6, '2023-09-18 21:12:31', '2023-09-18 21:12:31'),
(19, 5, 4, 'SALIDA', 59, '2023-09-19', 10, '2023-09-19 21:44:49', '2023-09-19 21:44:49'),
(20, 5, 1, 'SALIDA', 50, '2023-09-19', 5, '2023-09-19 21:45:26', '2023-09-19 21:45:26'),
(21, 4, 1, 'SALIDA', 70, '2023-09-19', 9, '2023-09-19 21:45:58', '2023-09-19 21:45:58'),
(22, 5, 1, 'SALIDA', 70, '2023-09-19', 9, '2023-09-19 21:45:58', '2023-09-19 21:45:58'),
(23, 5, 2, 'SALIDA', 60, '2023-09-19', 8, '2023-09-19 21:46:23', '2023-09-19 21:46:23'),
(24, 4, 4, 'SALIDA', 50, '2023-09-19', 4, '2023-09-19 21:46:47', '2023-09-19 21:46:47'),
(25, 5, 4, 'SALIDA', 80, '2023-09-19', 4, '2023-09-19 21:46:47', '2023-09-19 21:46:47'),
(26, 4, 1, 'SALIDA', 50, '2023-09-26', 17, '2023-09-26 14:05:28', '2023-09-26 14:05:28'),
(27, 5, 1, 'SALIDA', 60, '2023-09-26', 17, '2023-09-26 14:05:28', '2023-09-26 14:05:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

CREATE TABLE `profesionales` (
  `id` bigint(20) NOT NULL,
  `documento` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombres` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesionales`
--

INSERT INTO `profesionales` (`id`, `documento`, `nombres`, `apellidos`, `correo`, `celular`, `direccion`, `cargo`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '1234567', 'Producto', 'Compartido', 'compartido@gmail.com', '3161231232', 'Calle 20 # 31-12', 'compartido', 6, '2023-08-24 15:49:27', '2023-08-24 15:49:27'),
(2, '1098765468', 'OLFER EFRAIN', 'OLAYA', 'olfer.olaya@hotmail.com', '3175024300', 'calle 20#12 -12', 'PRODUCT MANAGER', 7, '2023-08-28 08:21:18', '2023-08-28 08:21:18'),
(3, '1098699832', 'Andrea', 'Muñoz', 'andreawzoe@gmail.com', '3167823888', 'Cra 1 a casa 24', 'ESTILISTA', 8, '2023-09-17 13:18:52', '2023-09-17 13:18:52'),
(4, '27790083', 'LUZ MARINA', 'VARGAS CAÑAS', 'luz.mar.vargas@hotmail.com', '3003218560', 'cra 8w # 62 - 12', 'ESTILISTA', 9, '2023-09-17 13:21:19', '2023-09-17 13:21:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'SUPER-ADMIN', 'web', '2022-09-09 16:50:56', '2022-09-09 16:50:56'),
(2, 'ADMIN', 'web', '2022-09-09 16:51:10', '2022-09-09 16:51:10'),
(3, 'PROFESIONAL', 'web', '2023-02-15 02:25:05', '2023-02-15 02:25:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(3, 1),
(10, 2),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` bigint(20) NOT NULL,
  `tipo_servicio_id` bigint(20) NOT NULL,
  `servicio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `tipo_servicio_id`, `servicio`, `created_at`, `updated_at`) VALUES
(2, 3, 'liso HD', '2023-03-24 10:26:53', '2023-04-27 11:57:16'),
(3, 3, 'Botulinica', '2023-04-27 11:57:28', '2023-04-27 11:57:28'),
(4, 3, 'HD + Botulinica', '2023-04-27 11:57:49', '2023-04-27 11:57:49'),
(5, 3, 'Brillo de Luna', '2023-04-27 11:58:02', '2023-04-27 11:58:02'),
(6, 4, 'Repolarizacion', '2023-04-27 11:58:14', '2023-04-27 11:58:14'),
(7, 4, 'ADN', '2023-04-27 11:58:24', '2023-04-27 11:58:24'),
(8, 4, 'Terapia Capilar', '2023-04-27 11:58:48', '2023-04-27 11:58:48'),
(9, 4, 'Curly', '2023-04-27 11:59:08', '2023-04-27 11:59:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_adicionales`
--

CREATE TABLE `servicios_adicionales` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL COMMENT 'nombre del servicio',
  `valor` decimal(10,0) NOT NULL COMMENT 'valor del servicio',
  `comision` decimal(10,0) NOT NULL COMMENT 'comisión del servicio',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios_adicionales`
--

INSERT INTO `servicios_adicionales` (`id`, `nombre`, `valor`, `comision`, `created_at`, `updated_at`) VALUES
(1, 'CORTE 3000', '35000', '7000', '2023-09-20 10:47:27', '2023-09-20 10:47:45'),
(2, 'DESPUNTADA', '40000', '6000', '2023-09-20 10:48:17', '2023-09-20 10:48:17'),
(4, 'CORTE PLUS', '0', '10000', '2023-09-20 16:35:04', '2023-09-20 16:35:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_producto`
--

CREATE TABLE `servicio_producto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `servicio_id` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_producto`
--

INSERT INTO `servicio_producto` (`id`, `producto_id`, `servicio_id`, `cantidad`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 60, '2023-09-03 21:00:12', '2023-09-03 21:00:12'),
(3, 5, 2, 70, '2023-09-03 21:02:01', '2023-09-03 21:02:01'),
(4, 5, 4, 60, '2023-09-17 13:45:06', '2023-09-17 13:45:06'),
(5, 5, 3, 60, '2023-09-18 23:48:02', '2023-09-18 23:48:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `id` bigint(20) NOT NULL,
  `talla` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 's,m,l,xl,xxl',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`id`, `talla`, `created_at`, `updated_at`) VALUES
(1, 'XS', '2023-03-24 11:06:13', '2023-03-24 11:06:13'),
(2, 'L', '2023-03-24 11:06:24', '2023-03-24 11:06:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `id` bigint(20) NOT NULL,
  `tipo_servicio` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`id`, `tipo_servicio`, `created_at`, `updated_at`) VALUES
(3, 'Alisado', '2023-02-14 23:25:31', '2023-02-14 23:25:31'),
(4, 'Recuperacion', '2023-03-23 21:39:08', '2023-03-23 21:39:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencias_pago`
--

CREATE TABLE `transferencias_pago` (
  `id` bigint(20) NOT NULL,
  `cliente_id` bigint(20) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `medio_pago_id` bigint(20) DEFAULT NULL,
  `cuenta_pago_id` bigint(20) DEFAULT NULL,
  `referencia_pago` varchar(50) DEFAULT NULL,
  `fecha` date NOT NULL COMMENT 'fecha de pago',
  `id_pago` bigint(20) DEFAULT NULL COMMENT 'id de referencia puede ser de dos tablas depende del tipo',
  `tipo` enum('P','S') DEFAULT NULL COMMENT 'TIPO P PROCEDIMIENTOS S SERVICIO',
  `verificado` int(1) NOT NULL COMMENT 'casilla verificacion 1 o 0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transferencias_pago`
--

INSERT INTO `transferencias_pago` (`id`, `cliente_id`, `valor`, `medio_pago_id`, `cuenta_pago_id`, `referencia_pago`, `fecha`, `id_pago`, `tipo`, `verificado`, `created_at`, `updated_at`) VALUES
(1, 1, '20000', 2, 3, NULL, '2023-09-21', 13, 'P', 1, '2023-09-21 12:24:14', '2023-09-21 14:23:08'),
(2, 4, '10000', 1, 1, NULL, '2023-09-21', 14, 'P', 1, '2023-09-21 12:30:59', '2023-09-21 12:30:59'),
(3, 5, '175000', 2, 3, '12312333', '2023-09-21', 15, 'P', 1, '2023-09-21 12:32:32', '2023-09-21 14:22:11'),
(4, 3, '35000', 1, 1, NULL, '2023-09-01', 12, 'S', 1, '2023-09-21 12:46:00', '2023-09-21 12:46:00'),
(5, 2, '35000', 2, 2, NULL, '2023-09-01', 13, 'S', 1, '2023-09-21 14:23:33', '2023-09-21 14:33:28'),
(6, 2, '175000', 2, 2, NULL, '2023-09-21', 16, 'P', 1, '2023-09-21 14:38:47', '2023-09-21 14:39:05'),
(7, 3, '40000', 2, 3, '333333', '2023-09-01', 14, 'S', 1, '2023-09-21 14:39:42', '2023-09-21 15:03:22'),
(8, 3, '40000', 1, 1, NULL, '2023-09-01', 16, 'S', 1, '2023-09-21 16:14:12', '2023-09-21 16:14:12'),
(9, 3, '40000', 1, 1, NULL, '2023-09-21', 18, 'S', 1, '2023-09-21 16:21:22', '2023-09-21 16:21:22'),
(10, 3, '35000', 1, 1, NULL, '2023-09-01', 20, 'S', 1, '2023-09-21 16:31:08', '2023-09-21 16:31:08'),
(11, 6, '70000', 1, 1, NULL, '2023-09-26', 17, 'P', 1, '2023-09-26 14:02:22', '2023-09-26 14:02:22'),
(12, 6, '87500', 2, 3, NULL, '2023-09-26', 17, 'P', 1, '2023-09-26 14:02:22', '2023-09-26 14:02:22'),
(13, 6, '0', 1, 1, NULL, '2023-09-26', 18, 'P', 1, '2023-09-26 14:07:36', '2023-09-26 14:07:36'),
(14, 5, '180000', 2, 2, NULL, '2023-09-26', 19, 'P', 1, '2023-09-26 14:12:04', '2023-09-26 14:27:08'),
(15, 4, '100000', 1, 1, NULL, '2023-09-26', 20, 'P', 1, '2023-09-26 14:16:21', '2023-09-26 14:16:21'),
(16, 4, '17000', 2, 3, NULL, '2023-09-26', 20, 'P', 1, '2023-09-26 14:16:21', '2023-09-26 14:27:00'),
(17, 5, '160000', 1, 1, NULL, '2023-09-26', 21, 'P', 1, '2023-09-26 14:42:58', '2023-09-26 14:42:58'),
(18, 3, '100000', 1, 1, NULL, '2023-09-26', 22, 'P', 1, '2023-09-26 14:48:46', '2023-09-26 14:48:46'),
(19, 3, '30000', 2, 2, NULL, '2023-09-26', 22, 'P', 1, '2023-09-26 14:48:46', '2023-09-26 14:49:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(3) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` bigint(1) DEFAULT NULL COMMENT 'Estado del usuario\r\n',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `password`, `role_id`, `number`, `address`, `city`, `estado`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'User', NULL, 'ojrincon@bucaramanga.gov.co', '$2y$10$LueqldPmcKdhoK7I9uMZzOpTUUQ71fSUd/w2TNXlrw7TAEC3x6ExC', NULL, NULL, NULL, NULL, 0, NULL, 'VZRMC0PaCZTVY0F7wJxPqbwhCvf2hJ8FAjJO0bhQr6v6aJ2Jea0845dzg87n', NULL, '2022-09-09 23:36:09', '2022-09-09 23:36:09'),
(2, 'Julian', 'Rincon', 'Hombre', 'julianrincon9230@gmail.com', '$2y$10$f8.KTwlDO1e/X7I2LpmoC.zlpXiAPxPOP85zyq2MquTek1gJgoTK2', 1, '3219080690', 'calle 20 # 12-33', 'BUCARAMANGA', 1, NULL, 'fKkbUZJ8CrUYCZIuoPtMZPzcergLqQt3VA0OBMrAx7L0rXUApywraJUl5y4u', '2022-08-31 07:51:21', '2023-02-15 02:16:39', NULL),
(4, 'Richart', 'Reatiga', NULL, 'vitalfutclubbga@gmail.com', '$2y$10$f8.KTwlDO1e/X7I2LpmoC.zlpXiAPxPOP85zyq2MquTek1gJgoTK2', 2, '3166107397', NULL, 'BUCARAMANGA', 1, NULL, NULL, '2022-09-09 20:40:54', '2022-10-06 21:24:39', NULL),
(5, NULL, NULL, NULL, 'prueba@gmail.com', '$2y$10$bQXljGzuTp4EjLfE6USsxu7bH8BAo74catHE3Td4FHaK8gec8Jr9G', NULL, NULL, NULL, NULL, NULL, NULL, 'GAIhFifseJjtSPg6irliesC8BH7tubXeMsQm8UoRVHD4SXVFixixtYkWPe7V', '2023-03-30 13:28:56', '2023-03-30 13:28:56', NULL),
(6, 'Producto compartido', NULL, NULL, 'compartido@gmail.com', '$2y$10$ttU7k.8PAiRGR.R7Y2jMGe1.GZQN55.4iiWIelaTuceFcT6QAoXai', 3, '3161231232', NULL, 'BUCARAMANGA', 1, NULL, NULL, '2023-08-24 20:49:27', '2023-08-24 20:49:27', NULL),
(7, 'OLFER EFRAIN', 'OLAYA', NULL, 'olfer.olaya@hotmail.com', '$2y$10$h4jXRmKLVc9mcEmClJbS3OZTcPTkFBh0321M2w9fv5EYLl7F5eQ0q', 3, '3175024300', NULL, 'BUCARAMANGA', 1, NULL, NULL, '2023-08-28 13:21:18', '2023-08-28 13:21:18', NULL),
(8, 'Andrea', 'Muñoz', NULL, 'andreawzoe@gmail.com', '$2y$10$xEj1ZR4EWRACFXwlsbsllenNUZxSzxZc1juHAkqM4B013osoTeXJi', 3, '3167823888', NULL, 'BUCARAMANGA', 1, NULL, NULL, '2023-09-17 18:18:52', '2023-09-17 18:18:52', NULL),
(9, 'LUZ MARINA', 'VARGAS CAÑAS', NULL, 'luz.mar.vargas@hotmail.com', '$2y$10$/excWTNkCKugZJhoCk7kw.Oy0Z81qeeD7OigZOvhpLH79MHTSXM9C', 3, '3003218560', NULL, 'BUCARAMANGA', 1, NULL, NULL, '2023-09-17 18:21:19', '2023-09-17 18:21:19', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `valor_total` int(11) NOT NULL,
  `medio_pago` varchar(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_abono_cliente` (`cliente_id`),
  ADD KEY `medio_pago_id` (`medio_pago_id`),
  ADD KEY `cuenta_pago_id` (`cuenta_pago_id`);

--
-- Indices de la tabla `adicional_profesional`
--
ALTER TABLE `adicional_profesional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_adicional_pago` (`adicional_id`),
  ADD KEY `fk_adicional_profesional` (`profesional_id`);

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_age_tipo_serv` (`tipo_servicio_id`),
  ADD KEY `fk_age_serv` (`servicio_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `abono_id` (`abono_id`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_index_calificacion` (`calificacion_id`);

--
-- Indices de la tabla `cuentas_pago`
--
ALTER TABLE `cuentas_pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medio_pago` (`medio_pago_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medio_pago`
--
ALTER TABLE `medio_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `pago_adicionales`
--
ALTER TABLE `pago_adicionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_adicional` (`cliente_id`),
  ADD KEY `fk_servicio_adicional` (`servicio_adicional_id`);

--
-- Indices de la tabla `pago_procedimiento`
--
ALTER TABLE `pago_procedimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_pago` (`cliente_id`),
  ADD KEY `fk_servicio_pago` (`servicio_id`),
  ADD KEY `fk_talla_pago` (`talla_id`),
  ADD KEY `fk_abono_pago` (`abonos_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `planes_dcto`
--
ALTER TABLE `planes_dcto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_precios_servi` (`servicio_id`),
  ADD KEY `fk_precios_talla` (`talla_id`);

--
-- Indices de la tabla `procedimiento_profesional`
--
ALTER TABLE `procedimiento_profesional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prof_proc` (`procedimiento_id`),
  ADD KEY `fk_profe_proc` (`profesional_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_semana`
--
ALTER TABLE `producto_semana`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prod_semana` (`producto_id`),
  ADD KEY `fk_prod_prof` (`profesional_id`),
  ADD KEY `fk_prodsem_proced` (`procedimiento_id`);

--
-- Indices de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_serv` (`tipo_servicio_id`);

--
-- Indices de la tabla `servicios_adicionales`
--
ALTER TABLE `servicios_adicionales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio_producto`
--
ALTER TABLE `servicio_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_producto` (`producto_id`),
  ADD KEY `fk_servicio_id` (`servicio_id`) USING BTREE;

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transferencias_pago`
--
ALTER TABLE `transferencias_pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_trasferencia_cliente` (`cliente_id`),
  ADD KEY `fk_trasferencia_medio` (`medio_pago_id`),
  ADD KEY `fk_trasferencia_cuenta` (`cuenta_pago_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_unique` (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_remember_token_unique` (`remember_token`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `adicional_profesional`
--
ALTER TABLE `adicional_profesional`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=458;

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuentas_pago`
--
ALTER TABLE `cuentas_pago`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medio_pago`
--
ALTER TABLE `medio_pago`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pago_adicionales`
--
ALTER TABLE `pago_adicionales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pago_procedimiento`
--
ALTER TABLE `pago_procedimiento`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `planes_dcto`
--
ALTER TABLE `planes_dcto`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `procedimiento_profesional`
--
ALTER TABLE `procedimiento_profesional`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto_semana`
--
ALTER TABLE `producto_semana`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `servicios_adicionales`
--
ALTER TABLE `servicios_adicionales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicio_producto`
--
ALTER TABLE `servicio_producto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `transferencias_pago`
--
ALTER TABLE `transferencias_pago`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD CONSTRAINT `fk_abono_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_medio_cuentas_pago` FOREIGN KEY (`cuenta_pago_id`) REFERENCES `cuentas_pago` (`id`),
  ADD CONSTRAINT `fk_medio_pago` FOREIGN KEY (`medio_pago_id`) REFERENCES `medio_pago` (`id`);

--
-- Filtros para la tabla `adicional_profesional`
--
ALTER TABLE `adicional_profesional`
  ADD CONSTRAINT `fk_adicional_pago` FOREIGN KEY (`adicional_id`) REFERENCES `pago_adicionales` (`id`),
  ADD CONSTRAINT `fk_adicional_profesional` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`);

--
-- Filtros para la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`abono_id`) REFERENCES `abonos` (`id`),
  ADD CONSTRAINT `fk_age_serv` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_age_tipo_serv` FOREIGN KEY (`tipo_servicio_id`) REFERENCES `tipo_servicio` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_pago`
--
ALTER TABLE `cuentas_pago`
  ADD CONSTRAINT `fk_medio` FOREIGN KEY (`medio_pago_id`) REFERENCES `medio_pago` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pago_adicionales`
--
ALTER TABLE `pago_adicionales`
  ADD CONSTRAINT `fk_cliente_adicional_up` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_servicio_adicional` FOREIGN KEY (`servicio_adicional_id`) REFERENCES `servicios_adicionales` (`id`);

--
-- Filtros para la tabla `pago_procedimiento`
--
ALTER TABLE `pago_procedimiento`
  ADD CONSTRAINT `fk_abono_pago` FOREIGN KEY (`abonos_id`) REFERENCES `abonos` (`id`),
  ADD CONSTRAINT `fk_cliente_pago` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_servicio_pago` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `fk_talla_pago` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`);

--
-- Filtros para la tabla `precios`
--
ALTER TABLE `precios`
  ADD CONSTRAINT `fk_precios_servi` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_precios_talla` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `procedimiento_profesional`
--
ALTER TABLE `procedimiento_profesional`
  ADD CONSTRAINT `fk_prof_proc` FOREIGN KEY (`procedimiento_id`) REFERENCES `pago_procedimiento` (`id`),
  ADD CONSTRAINT `fk_profe_proc` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`);

--
-- Filtros para la tabla `producto_semana`
--
ALTER TABLE `producto_semana`
  ADD CONSTRAINT `fk_prod_prof` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`),
  ADD CONSTRAINT `fk_prod_semana` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `fk_prodsem_proced` FOREIGN KEY (`procedimiento_id`) REFERENCES `pago_procedimiento` (`id`);

--
-- Filtros para la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_tipo_serv` FOREIGN KEY (`tipo_servicio_id`) REFERENCES `tipo_servicio` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio_producto`
--
ALTER TABLE `servicio_producto`
  ADD CONSTRAINT `fk_producto_tipo` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `fk_tipo_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `transferencias_pago`
--
ALTER TABLE `transferencias_pago`
  ADD CONSTRAINT `fk_trasferencia_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_trasferencia_cuenta` FOREIGN KEY (`cuenta_pago_id`) REFERENCES `cuentas_pago` (`id`),
  ADD CONSTRAINT `fk_trasferencia_medio` FOREIGN KEY (`medio_pago_id`) REFERENCES `medio_pago` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

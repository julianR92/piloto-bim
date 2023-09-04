-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-05-2023 a las 13:36:02
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

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
(1, 1, 25000, 1, 1, 'APARTADO', 1, NULL, '2023-04-30', NULL, NULL, '2023-04-30 17:15:00', '2023-04-30 17:18:20'),
(2, 2, 40000, 2, 2, 'DISPONIBLE', 1, '123123', '2023-04-30', NULL, NULL, '2023-04-30 17:16:19', '2023-04-30 17:18:52');

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
  `estado` enum('DISPONIBLE','APLAZADO','AGENDADO','CANCELADO') COLLATE utf8_spanish_ci NOT NULL,
  `observacion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id`, `fecha`, `hora`, `tipo_servicio_id`, `servicio_id`, `cliente_id`, `abono_id`, `estado`, `observacion`, `created_at`, `updated_at`) VALUES
(1, '2023-04-30', '8:00am', 3, 2, 2, 2, 'APLAZADO', 'EL CLIENTE APLAZO', '2023-04-30 17:16:45', '2023-04-30 17:18:52'),
(2, '2023-04-30', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(3, '2023-04-30', '11:00am', 3, 2, 1, 1, 'AGENDADO', NULL, '2023-04-30 17:16:45', '2023-04-30 17:18:20'),
(4, '2023-04-30', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(5, '2023-04-30', '8:00am', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(6, '2023-04-30', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(7, '2023-04-30', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(8, '2023-04-30', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(9, '2023-04-30', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45'),
(10, '2023-04-30', '1:30pm', 3, NULL, NULL, NULL, 'DISPONIBLE', NULL, '2023-04-30 17:16:45', '2023-04-30 17:16:45');

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
(215, 'Julian', 'julianrincon9230@gmail.com', 'Edicion de cita #1 en la plataforma cambia a estado: APLAZADO', '127.0.0.1', '2023-04-30 22:18:52', '2023-04-30 22:18:52');

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
  `estado` int(2) NOT NULL,
  `observacion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `calificacion_id` bigint(20) DEFAULT NULL COMMENT 'id de calificacion id',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `documento`, `nombres`, `apellidos`, `telefono`, `fecha_nacimiento`, `whatsapp`, `instagram`, `estado`, `observacion`, `calificacion_id`, `created_at`, `updated_at`) VALUES
(1, '1098699832', 'ANDREA', 'MUÑOZ', '3166107397', '1991-02-03', NULL, NULL, 1, NULL, 4, '2023-04-30 17:14:32', '2023-04-30 17:15:35'),
(2, '123456', 'HEIDY', 'DAYANA', '3168706182', '1998-02-12', NULL, NULL, 1, NULL, 1, '2023-04-30 17:15:25', '2023-04-30 17:15:25');

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
(2, 2, 'NEQUI', '3173639222', 1, '2023-04-21 15:11:25', '2023-04-21 15:11:42');

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
(2, 'App\\Models\\User', 4);

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
  `planes_id` bigint(20) NOT NULL,
  `abonos_id` bigint(20) NOT NULL,
  `valor_pagar` decimal(10,0) NOT NULL,
  `medio_pago` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'de tabla de medios de pago',
  `realizo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `valor_comision` decimal(10,0) NOT NULL,
  `cantidad_alisado` decimal(10,0) DEFAULT NULL,
  `cantidad_recuperacion` decimal(10,0) DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(5, 'ver-informacion', 'web', '2022-12-02 00:59:00', '2023-02-15 02:25:42');

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
(1, 'PROMO GOLD', '40', 1, '2023-03-25 11:16:37', '2023-03-25 11:17:52'),
(3, 'PROMO MES MUJER', '40', 1, '2023-03-25 11:19:56', '2023-03-25 11:19:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `id` bigint(20) NOT NULL,
  `servicio_id` bigint(20) NOT NULL,
  `talla_id` bigint(20) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id`, `servicio_id`, `talla_id`, `valor`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '7000', '2023-03-24 12:28:17', '2023-03-24 13:02:39'),
(2, 2, 1, '20000', '2023-03-24 12:38:58', '2023-03-24 12:55:47'),
(3, 2, 1, '4500', '2023-03-24 13:02:58', '2023-04-17 10:53:16');

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
(2, 2),
(3, 2),
(4, 2),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salario`
--

CREATE TABLE `salario` (
  `id` bigint(20) NOT NULL,
  `procedimiento_id` bigint(20) DEFAULT NULL,
  `profesional_id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `nombre_cliente` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `porcentaje` decimal(10,0) DEFAULT NULL,
  `tipo_servicio` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'para saber si es corte u otro procedimiento',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(2, 'Julian', 'Rincon', 'Hombre', 'julianrincon9230@gmail.com', '$2y$10$f8.KTwlDO1e/X7I2LpmoC.zlpXiAPxPOP85zyq2MquTek1gJgoTK2', 1, '3219080690', 'calle 20 # 12-33', 'BUCARAMANGA', 1, NULL, 'WRTwg3rzmhGLupc3PbwhVmsBpMtFFchIvcpghnfKlKAJszPrljDPlm7wclpe', '2022-08-31 07:51:21', '2023-02-15 02:16:39', NULL),
(4, 'Julian', 'Rincon', NULL, 'vitalfutclubbga@gmail.com', '$2y$10$g5BAX2rOZCTw1.ay.HxEm.XrZsgYyT8i7/21o1PM3iSqehHIMmSbW', 2, '3166107397', NULL, 'BUCARAMANGA', 1, NULL, NULL, '2022-09-09 20:40:54', '2022-10-06 21:24:39', NULL),
(5, NULL, NULL, NULL, 'prueba@gmail.com', '$2y$10$bQXljGzuTp4EjLfE6USsxu7bH8BAo74catHE3Td4FHaK8gec8Jr9G', NULL, NULL, NULL, NULL, NULL, NULL, 'GAIhFifseJjtSPg6irliesC8BH7tubXeMsQm8UoRVHD4SXVFixixtYkWPe7V', '2023-03-30 13:28:56', '2023-03-30 13:28:56', NULL);

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
-- Indices de la tabla `pago_procedimiento`
--
ALTER TABLE `pago_procedimiento`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `salario`
--
ALTER TABLE `salario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_serv` (`tipo_servicio_id`);

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
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_unique` (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_remember_token_unique` (`remember_token`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cuentas_pago`
--
ALTER TABLE `cuentas_pago`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- AUTO_INCREMENT de la tabla `pago_procedimiento`
--
ALTER TABLE `pago_procedimiento`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `planes_dcto`
--
ALTER TABLE `planes_dcto`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salario`
--
ALTER TABLE `salario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Filtros para la tabla `precios`
--
ALTER TABLE `precios`
  ADD CONSTRAINT `fk_precios_servi` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_precios_talla` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`) ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

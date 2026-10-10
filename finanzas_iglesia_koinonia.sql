-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2026 a las 01:56:29
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
-- Base de datos: `finanzas_iglesia_koinonia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos_fijos`
--

CREATE TABLE `activos_fijos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `valor_compra` decimal(12,2) NOT NULL,
  `fecha_compra` date DEFAULT NULL,
  `vida_util_meses` int(11) DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'activo',
  `ubicacion` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `activos_fijos`
--

INSERT INTO `activos_fijos` (`id`, `nombre`, `codigo`, `categoria`, `valor_compra`, `fecha_compra`, `vida_util_meses`, `estado`, `ubicacion`, `descripcion`, `created_at`, `updated_at`) VALUES
(2, 'tv', '097657J', 'Electrodomésticos', 3600.00, '2024-04-04', 24, 'activo', '1ro de diciembre', 'gdgbgfghf', '2026-08-19 05:26:45', '2026-08-19 05:26:45'),
(3, 'Parlantes', NULL, 'Equipo de Sonido', 1500.00, '2021-06-09', 60, 'activo', NULL, 'los equipos funciona', '2026-09-23 05:32:15', '2026-09-23 05:32:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Caja General', 'Fondo principal de la iglesia', NULL, NULL),
(2, 'Escuela Dominical', 'Actividades para niños', NULL, NULL),
(3, 'Círculo de Oración', 'Fondo del grupo de oración', NULL, NULL),
(4, 'Grupo Juvenil', 'Jóvenes actuales', NULL, NULL),
(5, 'Jóvenes Antiguos', 'Ex integrantes del grupo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-gabrielconotiriamutari@gmail.com|172.22.19.30', 'i:1;', 1789001379),
('laravel-cache-gabrielconotiriamutari@gmail.com|172.22.19.30:timer', 'i:1789001379;', 1789001379);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` enum('ingreso','gasto') NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `tipo`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Diezmo', 'ingreso', 'Diezmos de los miembros', '2026-08-12 03:44:13', '2026-09-13 23:25:49'),
(2, 'Ofrenda Especiales', 'ingreso', 'Ofrenadas para proyectos especificos', '2026-08-12 03:46:48', '2026-09-13 23:29:59'),
(3, 'Ofrenda', 'ingreso', 'Ofrendas dominicales y regulares', '2026-08-12 03:47:39', '2026-09-13 23:31:05'),
(4, 'Donaciones', 'ingreso', 'Donaciones de visitantes', '2026-08-12 03:48:01', '2026-09-13 23:33:10'),
(5, 'Servicios Básicos', 'gasto', 'Luz, agua, internet, telefono', '2026-09-13 23:20:06', '2026-09-13 23:20:06'),
(6, 'Matenimiento', 'gasto', 'Reparaciones y mantenimiento del templo', '2026-09-13 23:22:06', '2026-09-13 23:22:06'),
(7, 'Ministerios', 'gasto', 'Gastos de ministerios y departamentos', '2026-09-13 23:23:52', '2026-09-13 23:23:52'),
(11, 'parto de solidario', 'ingreso', 'aporte del hermano', '2026-09-25 04:02:36', '2026-09-25 04:02:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `deuda_pendiente` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado_pago` enum('pagado','pendiente','parcial') NOT NULL DEFAULT 'pagado',
  `acreedor` varchar(255) DEFAULT NULL,
  `numero_comprobante` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `comprobante` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `categoria_id`, `area_id`, `monto`, `deuda_pendiente`, `estado_pago`, `acreedor`, `numero_comprobante`, `descripcion`, `created_at`, `updated_at`, `fecha_hora`, `comprobante`) VALUES
(1, 1, 1, 80.00, 0.00, 'pagado', NULL, NULL, 'toda la iglesia', '2026-08-12 03:50:51', '2026-08-12 03:50:51', '2026-09-16 20:22:08', NULL),
(2, 2, 4, 150.00, 0.00, 'pagado', NULL, NULL, 'Colaboracion para el hermano Matias', '2026-08-14 04:49:51', '2026-08-14 04:49:51', '2026-09-16 20:22:08', NULL),
(3, 7, NULL, 40.00, 0.00, 'pagado', NULL, NULL, 'Pilas para microfono', '2026-09-17 00:32:46', '2026-09-17 00:32:46', '2026-09-16 20:22:08', NULL),
(4, 6, 1, 1600.00, 0.00, 'pagado', NULL, NULL, 'Componentes para el teclado', '2026-09-17 00:51:05', '2026-09-17 00:51:05', '2026-09-16 20:22:08', NULL),
(5, 6, NULL, 60.00, 0.00, 'pagado', NULL, NULL, 'Pagos de telefonia', '2026-09-25 04:45:49', '2026-09-25 04:45:49', '2026-09-24 20:45:00', '575950'),
(6, 7, NULL, 70.00, 0.00, 'pagado', NULL, NULL, NULL, '2026-09-28 08:31:35', '2026-09-28 08:31:35', '2026-09-28 00:27:00', '7856756'),
(7, 5, NULL, 500.00, 0.00, 'pagado', NULL, NULL, NULL, '2026-09-28 08:36:28', '2026-09-28 08:36:28', '2026-09-28 00:36:00', '7909889'),
(8, 5, NULL, 700.00, 0.00, 'pagado', NULL, NULL, NULL, '2026-09-28 08:51:24', '2026-09-28 08:51:24', '2026-09-28 00:50:00', '897654');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `miembro_id` bigint(20) UNSIGNED DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `deuda_pendiente` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado_pago` enum('pagado','pendiente','parcial') NOT NULL DEFAULT 'pagado',
  `numero_comprobante` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `comprobante` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `categoria_id`, `area_id`, `miembro_id`, `monto`, `deuda_pendiente`, `estado_pago`, `numero_comprobante`, `descripcion`, `created_at`, `updated_at`, `fecha_hora`, `comprobante`) VALUES
(1, 1, 1, 7, 603.00, 0.00, 'pagado', NULL, 'toda la iglesia', '2026-08-12 03:48:59', '2026-09-17 06:13:24', '2026-09-16 20:20:00', NULL),
(2, 3, 1, NULL, 800.00, 0.00, 'pagado', NULL, 'La familia Moreno', '2026-08-12 03:58:31', '2026-08-12 03:58:31', '2026-09-16 20:20:37', NULL),
(3, 2, 3, NULL, 90.00, 0.00, 'pagado', NULL, 'De las hermanas del circulo de oracion', '2026-08-14 04:47:15', '2026-08-14 04:47:15', '2026-09-16 20:20:37', NULL),
(4, 1, 4, NULL, 30.00, 0.00, 'pagado', NULL, 'DFHGFGFGHF', '2026-09-04 06:03:30', '2026-09-04 06:03:30', '2026-09-16 20:20:37', NULL),
(5, 3, 1, NULL, 250.00, 0.00, 'pagado', NULL, 'ofrenda dominical', '2026-09-17 00:47:17', '2026-09-17 00:47:17', '2026-09-16 20:20:37', NULL),
(6, 1, 1, NULL, 100.00, 0.00, 'pagado', NULL, 'Nilo Cortez Puro', '2026-09-17 00:49:21', '2026-09-17 00:49:21', '2026-09-16 20:20:37', NULL),
(7, 3, NULL, NULL, 50.00, 0.00, 'pagado', NULL, NULL, '2026-09-17 08:01:57', '2026-09-17 08:01:57', '2026-09-16 23:53:00', NULL),
(8, 1, NULL, 4, 150.00, 0.00, 'pagado', NULL, NULL, '2026-09-17 08:02:48', '2026-09-17 08:02:48', '2026-09-17 00:02:00', NULL),
(9, 1, NULL, 7, 400.00, 0.00, 'pagado', NULL, NULL, '2026-09-17 23:03:37', '2026-09-17 23:03:37', '2026-09-17 15:02:00', NULL),
(10, 1, NULL, 3, 600.00, 0.00, 'pagado', NULL, NULL, '2026-09-24 03:57:20', '2026-09-24 03:57:20', '2026-09-23 19:56:00', NULL),
(12, 3, NULL, NULL, 150.00, 0.00, 'pagado', NULL, NULL, '2026-09-25 04:46:56', '2026-09-25 04:46:56', '2026-09-24 20:46:00', NULL),
(13, 1, NULL, 13, 400.00, 0.00, 'pagado', NULL, NULL, '2026-09-28 08:25:16', '2026-09-28 08:25:16', '2026-09-28 00:24:00', NULL),
(14, 3, NULL, NULL, 150.00, 0.00, 'pagado', NULL, NULL, '2026-09-28 08:26:50', '2026-09-28 08:26:50', '2026-09-28 00:26:00', NULL),
(15, 1, NULL, 7, 400.00, 0.00, 'pagado', NULL, NULL, '2026-09-28 08:34:27', '2026-09-28 08:34:27', '2026-09-28 00:33:00', NULL),
(16, 3, NULL, NULL, 150.00, 0.00, 'pagado', NULL, NULL, '2026-09-28 08:35:23', '2026-09-28 08:35:23', '2026-09-28 00:34:00', NULL),
(17, 1, NULL, 12, 150.00, 0.00, 'pagado', NULL, NULL, '2026-09-28 08:49:17', '2026-09-28 08:49:17', '2026-09-28 00:48:00', NULL),
(18, 3, NULL, NULL, 160.00, 0.00, 'pagado', NULL, NULL, '2026-09-28 08:50:19', '2026-09-28 08:50:19', '2026-09-28 00:49:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `ministerio` varchar(255) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id`, `nombre`, `apellido`, `nombre_completo`, `telefono`, `direccion`, `fecha_nacimiento`, `estado`, `ministerio`, `observacion`, `created_at`, `updated_at`) VALUES
(1, 'Luis', 'Cartagena Amutari', 'Luis Cartagena Amutari', '76895678', 'Av.- Rio Benicito N 23 B.- El Cerrito', '1997-03-30', 'activo', NULL, NULL, '2026-07-22 19:43:07', '2026-07-22 21:13:39'),
(2, 'Jesus', 'Martinez', 'Jesus Martinez', '78905645', 'Av. rio Manuripi', '1989-05-04', 'inactivo', NULL, NULL, '2026-07-22 21:23:19', '2026-07-22 21:23:51'),
(3, 'Diana', 'Marupa Ortiz', 'Diana Marupa Ortiz', '78905690', 'Barrio 1ro de Diciembre', '1990-02-12', 'activo', NULL, NULL, '2026-07-23 03:18:33', '2026-07-23 03:18:33'),
(4, 'Eloina', 'Cuani Amutari', 'Eloina Cuani Amutari', '78904567', 'Av. Toronja B. Tamarindo', '1990-03-12', 'activo', NULL, NULL, '2026-07-23 03:29:34', '2026-07-23 03:29:34'),
(5, 'Daniel', 'Moreno Perez', 'Daniel Moreno Perez', '69114474', 'B. Biocinica', '2003-05-06', 'inactivo', NULL, NULL, '2026-07-23 04:50:44', '2026-07-23 04:50:59'),
(6, 'Eliseo', 'Medrano', 'Eliseo Medrano', '78965045', 'B. 1ro de Diciembre', '1990-07-31', 'activo', NULL, NULL, '2026-08-12 04:05:03', '2026-08-12 04:05:03'),
(7, 'Javier', 'Daza Daza', 'Javier Daza Daza', '78905056', 'Av. Gabriel Rene Moreno', '1994-04-29', 'activo', NULL, NULL, '2026-08-15 01:51:26', '2026-08-15 01:51:26'),
(10, 'Juan', 'Camaconi', 'Juan Camaconi', '78906589', 'Av. toronja B. 1ro de Diciembre', '1990-08-19', 'activo', NULL, NULL, '2026-09-25 04:49:29', '2026-09-25 04:49:29'),
(11, 'Loyda', 'Cartagena Cuany', 'Loyda Cartagena Cuany', '79085690', 'Barrio Biocianica', '1991-02-20', 'activo', NULL, NULL, '2026-09-25 04:51:06', '2026-09-25 04:51:06'),
(12, 'Lucho', 'Sainz Salazar', 'Lucho Sainz Salazar', '70404560', 'Barrio Marconi', '1997-06-20', 'activo', NULL, NULL, '2026-09-25 04:52:44', '2026-09-25 04:52:44'),
(13, 'Clari', 'Yarari', 'Clari Yarari', '78906543', 'Barrio Unido', '2000-01-20', 'activo', NULL, NULL, '2026-09-25 04:53:51', '2026-09-25 04:53:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro_ministerio`
--

CREATE TABLE `miembro_ministerio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `miembro_id` bigint(20) UNSIGNED NOT NULL,
  `ministerio_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `miembro_ministerio`
--

INSERT INTO `miembro_ministerio` (`id`, `miembro_id`, `ministerio_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, NULL),
(2, 4, 2, NULL, NULL),
(3, 6, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_11_000448_create_miembros_table', 1),
(5, '2026_06_11_000511_create_categorias_table', 1),
(6, '2026_06_11_000525_create_ingresos_table', 1),
(7, '2026_06_11_000610_create_gastos_table', 1),
(8, '2026_06_13_022853_add_rol_to_users_table', 1),
(9, '2026_06_13_042505_crear_tabla_miembros_completa', 2),
(10, '2026_06_13_043146_modificar_tabla_miembros', 3),
(11, '2026_06_17_144959_crear_tabla_areas_final', 3),
(12, '2026_07_08_002112_agregar_area_a_tabla_ingresos', 3),
(13, '2026_07_08_013901_agregar_area_id_a_gastos_table', 3),
(14, '2026_07_22_155804_agregar_campos_nombre_estado_a_miembros_table', 3),
(15, '2026_07_22_160947_agregar_campos_nombre_apellido_estado_a_miembros', 3),
(16, '2026_07_22_173812_actualizar_estructura_ministerios', 4),
(18, '2026_08_19_003839_create_activos_fijos_table', 5),
(19, '2026_09_16_203051_hacer_area_id_opcional_en_gastos', 6),
(20, '2026_09_16_204034_hacer_area_id_opcional_en_ingresos', 7),
(21, '2026_09_17_001758_agregar_campos_fecha_hora_miembro_a_ingresos_y_gastos', 8),
(22, '2026_09_17_035501_quitar_campo_fecha_de_ingresos', 9),
(23, '2026_09_24_202600_quitar_columna_fecha_de_gastos', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ministerios`
--

CREATE TABLE `ministerios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `horario_reuniones` varchar(255) DEFAULT NULL,
  `lider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ministerios`
--

INSERT INTO `ministerios` (`id`, `nombre`, `descripcion`, `horario_reuniones`, `lider_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Circulo de Oración', 'Orar por todos los hermanos de la iglesia y todas las mersonas que necesiten oración.', 'Miercoles 18:00 PM', 3, 'activo', '2026-07-23 03:24:57', '2026-07-23 03:24:57'),
(2, 'joves', 'grupo de jovenes de la iglesia koinoni de Riberalta', 'Miercoles 18:00 PM', 3, 'activo', '2026-09-23 05:38:02', '2026-09-23 05:39:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Fqu1xaupbxwpjYitr6b3IG9QrhrJ5h4xVa0ynO5l', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoielI2OVpRSlZmSGZkeHQwNjJvWXdYTGtrY0JiemtaVDRsYjUwVDZmTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1790724215),
('VLWMTNSpjZIcgBDbgzrqXhPKNIpok2I2bMaRuigG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFVRUEZUTDlIQU5EbjlrVExnWTd2UkNUVnR0NTJQWlhWd2U5YmtkTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1790571709);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol` varchar(255) NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `rol`) VALUES
(1, 'Hermano Rimba', 'secretario@gmail.com', NULL, '$2y$12$GyOaKJc3ij4RSVoDfoaHNe9q00UV7U9o0d9Y6m9lTDLjGhp/iXnuO', NULL, '2026-07-22 18:57:32', '2026-09-17 01:26:11', 'secretario'),
(2, 'Gabriel Conotiri Amutari', 'gabrielconotiri@gmail.com', NULL, '$2y$12$4Oza2O3eRcLyyt9LpiwBPO4J.EIInVYSReY9cFrmJsUAK9Tc4F3jO', NULL, '2026-07-22 19:34:24', '2026-09-17 01:17:53', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activos_fijos`
--
ALTER TABLE `activos_fijos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gastos_categoria_id_foreign` (`categoria_id`),
  ADD KEY `gastos_area_id_foreign` (`area_id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingresos_categoria_id_foreign` (`categoria_id`),
  ADD KEY `ingresos_miembro_id_foreign` (`miembro_id`),
  ADD KEY `ingresos_area_id_foreign` (`area_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `miembro_ministerio`
--
ALTER TABLE `miembro_ministerio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `miembro_ministerio_miembro_id_foreign` (`miembro_id`),
  ADD KEY `miembro_ministerio_ministerio_id_foreign` (`ministerio_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ministerios`
--
ALTER TABLE `ministerios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ministerios_nombre_unique` (`nombre`),
  ADD KEY `ministerios_lider_id_foreign` (`lider_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activos_fijos`
--
ALTER TABLE `activos_fijos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `miembro_ministerio`
--
ALTER TABLE `miembro_ministerio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `ministerios`
--
ALTER TABLE `ministerios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `gastos_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `gastos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `ingresos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `ingresos_miembro_id_foreign` FOREIGN KEY (`miembro_id`) REFERENCES `miembros` (`id`);

--
-- Filtros para la tabla `miembro_ministerio`
--
ALTER TABLE `miembro_ministerio`
  ADD CONSTRAINT `miembro_ministerio_miembro_id_foreign` FOREIGN KEY (`miembro_id`) REFERENCES `miembros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `miembro_ministerio_ministerio_id_foreign` FOREIGN KEY (`ministerio_id`) REFERENCES `ministerios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ministerios`
--
ALTER TABLE `ministerios`
  ADD CONSTRAINT `ministerios_lider_id_foreign` FOREIGN KEY (`lider_id`) REFERENCES `miembros` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

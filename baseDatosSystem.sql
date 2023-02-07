-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2023 a las 11:00:16
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `system`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_color`) VALUES
(1, 'Almuerzos', '#d63384'),
(2, 'Bebidas', '#0dcaf0'),
(3, 'Desayunos', '#fd7e14'),
(4, 'Postres', '#0d6efd'),
(5, 'Servicios', '#dc3545');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventary`
--

CREATE TABLE `inventary` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_uni_metric` int(11) NOT NULL,
  `item_count` float NOT NULL,
  `item_create` datetime NOT NULL,
  `item_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventary`
--

INSERT INTO `inventary` (`item_id`, `item_name`, `item_category`, `item_uni_metric`, `item_count`, `item_create`, `item_status`) VALUES
(1, 'Trucha', 6, 3, 233, '2023-02-01 14:17:46', 1),
(2, 'Huevos', 2, 3, 0, '2023-02-06 20:01:44', 1),
(3, 'Mantequilla', 2, 2, 0, '2023-01-12 06:19:22', 1),
(4, 'Leche Liquida', 2, 1, 0, '2023-01-21 08:49:20', 1),
(5, 'Nata', 2, 2, 0, '2022-12-31 07:07:57', 1),
(6, 'Queso Blanco Duro', 2, 2, 0, '2023-01-19 02:26:00', 1),
(7, 'Aceite', 2, 1, 0, '2022-12-21 12:19:49', 1),
(8, 'Arroz', 2, 2, 3.6, '2023-01-25 11:25:29', 1),
(9, 'Pasta', 2, 2, 13, '2023-01-26 11:10:18', 1),
(10, 'Sal', 2, 2, 0, '2022-12-21 12:20:54', 1),
(11, 'Azúcar', 2, 2, 0.34, '2023-01-26 10:30:06', 1),
(12, 'Vinagre', 2, 1, 0, '2022-12-21 12:21:34', 1),
(13, 'Cacao en Polvo', 2, 2, 0.64, '2023-01-20 07:39:08', 1),
(14, 'Café', 2, 2, 1.51, '2023-01-20 05:00:11', 1),
(15, 'Salsa de Tomate', 2, 2, 0, '2022-12-21 12:24:53', 1),
(16, 'Mayonesa', 2, 2, 2, '2023-01-21 08:49:37', 1),
(17, 'Mostaza', 2, 2, 0, '2022-12-21 12:25:30', 1),
(18, 'Papelón', 2, 2, 8, '2023-01-26 11:13:15', 1),
(19, 'Harina de Trigo', 2, 2, 6, '2023-01-31 22:09:34', 1),
(20, 'Vainilla', 2, 1, 6, '2023-02-06 19:55:23', 1),
(21, 'Harina Pan', 2, 2, 9, '2023-02-04 19:28:04', 1),
(22, 'Orégano', 2, 2, 4, '2023-01-26 12:59:36', 1),
(23, 'Ajo', 3, 2, 0, '2022-12-21 12:28:23', 1),
(24, 'Cebolla', 3, 2, 0, '2022-12-21 12:28:47', 1),
(25, 'Tomate', 3, 2, 0, '2022-12-21 05:45:38', 1),
(26, 'Pimentón', 3, 2, 0, '2022-12-21 12:29:31', 1),
(27, 'Lechuga', 3, 2, 0, '2022-12-21 12:29:48', 1),
(28, 'Cilantro', 3, 2, 0, '2022-12-21 12:30:00', 1),
(29, 'Perejil', 3, 2, 0, '2023-01-12 06:19:33', 1),
(30, 'Papas', 3, 2, 0.01, '2023-02-07 00:05:36', 1),
(31, 'Plátanos', 3, 2, 47, '2023-01-26 08:51:12', 1),
(32, 'Cebollín', 3, 2, 0, '2023-01-10 10:31:33', 1),
(33, 'Ajo Porro', 3, 2, 0, '2022-12-21 12:34:02', 1),
(34, 'Repollo', 3, 2, 15, '2023-01-20 05:00:53', 1),
(35, 'Zanahoria', 3, 2, 10, '2023-01-20 05:00:43', 1),
(36, 'Remolacha', 3, 2, 0, '2022-12-21 12:35:33', 1),
(37, 'Limón', 11, 2, 0, '2022-12-21 12:38:32', 1),
(38, 'Fresa', 11, 2, 0, '2022-12-21 12:39:21', 1),
(39, 'Parchita', 11, 2, 0, '2022-12-21 12:40:06', 1),
(40, 'Guayaba', 11, 2, 0, '2022-12-21 12:40:28', 1),
(41, 'Melón', 11, 2, 2, '2023-01-30 05:03:12', 1),
(42, 'Lechosa ', 11, 2, 0, '2022-12-21 12:41:12', 1),
(43, 'Bicarbonato', 2, 2, 0, '2022-12-21 12:41:53', 1),
(44, 'Clavitos de Olor', 2, 2, 0, '2022-12-21 12:42:46', 1),
(45, 'Canela', 2, 2, 0, '2022-12-21 12:43:11', 1),
(46, 'Arvejas', 2, 2, 0, '2022-12-21 12:43:50', 1),
(47, 'Caraotas Negras', 2, 2, 4, '2023-02-06 19:55:34', 1),
(48, 'Caraotas Rojas', 2, 2, 0, '2023-01-02 11:56:35', 1),
(49, 'Caraotas Blancas', 2, 2, 0, '2023-01-30 06:42:18', 1),
(50, 'Pan de Hamburguesa', 2, 3, 15, '2023-01-26 12:07:34', 1),
(51, 'Cerveza Polar', 8, 3, 0, '2022-12-21 12:47:23', 1),
(52, 'Cerveza Polar light', 8, 3, 20, '2023-01-25 01:10:47', 1),
(53, 'Cerveza Solera', 8, 3, 0, '2022-12-21 12:48:30', 1),
(54, 'Agua Mineral 250ml', 9, 3, 0, '2022-12-21 12:49:10', 1),
(55, 'Agua Mineral 500ml', 9, 3, 0, '2022-12-21 12:49:51', 1),
(56, 'Malta 500ml', 9, 3, 0, '2022-12-21 12:50:29', 1),
(57, 'Pepsi', 9, 1, 2, '2023-02-02 16:52:30', 1),
(58, 'SevenUp', 9, 1, 0, '2022-12-21 12:51:14', 1),
(59, 'Frescolita', 9, 1, 0, '2022-12-21 12:51:26', 1),
(60, 'Jugo de Papelón', 9, 1, 0, '2022-12-21 12:52:26', 1),
(61, 'Milanesa', 5, 3, 0, '2022-12-21 02:20:18', 1),
(62, 'Picadillo', 5, 2, 0.07, '2023-01-25 10:20:16', 1),
(63, 'Pieza para Parrilla', 5, 3, 0, '2022-12-21 02:23:31', 1),
(64, 'Gallina', 5, 3, 12, '2023-01-22 12:06:17', 1),
(65, 'Solomo', 4, 5, 0, '2023-01-12 04:14:14', 1),
(66, 'Chorizo', 4, 3, 3, '2023-01-21 08:48:52', 1),
(67, 'Molida', 4, 2, 0, '2022-12-21 02:28:44', 1),
(68, 'Falda de Res', 4, 2, 0, '2022-12-21 05:43:11', 1),
(69, 'Costilla de Res', 4, 2, 0, '2022-12-21 02:29:30', 1),
(70, 'Costilla de Cochino', 4, 2, 0, '2022-12-21 02:29:43', 1),
(71, 'Pulpa de Cochino', 4, 2, 0, '2022-12-21 02:30:35', 1),
(72, 'Falda de Cochino', 4, 2, 0, '2022-12-21 02:31:15', 1),
(73, 'Muchacho Redondo', 4, 2, 0, '2022-12-21 02:32:50', 1),
(74, 'Bisteck de Res', 4, 2, 0, '2022-12-21 05:42:25', 1),
(75, 'Chuleta de Pernil', 4, 2, 0, '2022-12-21 02:33:38', 1),
(76, 'Chuleta de Res', 4, 2, 0, '2022-12-21 02:33:50', 1),
(77, 'Chuleta de Cochino', 4, 2, 0, '2022-12-21 02:34:03', 1),
(78, 'Chuleta Ahumada', 4, 2, 0, '2022-12-21 02:34:21', 1),
(79, 'Tocineta', 4, 2, 0, '2022-12-21 02:34:34', 1),
(80, 'Queso Blanco SemiDuro', 2, 2, 0.04, '2023-02-06 23:57:27', 1),
(81, 'Queso Parmesano', 2, 2, 2, '2023-01-26 11:16:13', 1),
(82, 'Mora', 11, 2, 0, '2022-12-21 02:37:55', 1),
(83, 'Naranja', 11, 2, 0, '2022-12-21 02:38:06', 1),
(92, 'Pollo Entero', 0, 0, 0, '2023-01-31 18:37:03', 1),
(93, 'Pollo Entero2', 0, 0, 0, '2023-01-31 18:39:14', 1),
(101, 'Refresco Pepsi 500ml', 9, 1, 48, '2023-02-02 16:53:16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventary_categories`
--

CREATE TABLE `inventary_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_color` varchar(7) NOT NULL,
  `category_ingredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventary_categories`
--

INSERT INTO `inventary_categories` (`category_id`, `category_name`, `category_color`, `category_ingredient`) VALUES
(1, 'Productos de Limpieza', '#0dcaf0', 0),
(2, 'Víveres', '#ffc107', 1),
(3, 'Hortalizas', '#8bc34a', 1),
(4, 'Carnes', '#e91e63', 1),
(5, 'Pollo', '#ffeb3b', 1),
(6, 'Pescados', '#ff9800', 1),
(7, 'Mobiliario', '#673ab7', 0),
(8, 'Bebidas Alcohólicas ', '#009688', 1),
(9, 'Bebidas No Alcohólicas', '#3f51b5', 1),
(11, 'Frutas', '#85b6ff', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventary_operations`
--

CREATE TABLE `inventary_operations` (
  `operation_id` int(11) NOT NULL,
  `operation_type` int(11) NOT NULL,
  `operation_item_id` varchar(50) NOT NULL,
  `operation_category` int(11) NOT NULL,
  `operation_unit` int(11) NOT NULL,
  `operation_count` float NOT NULL,
  `operation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventary_units`
--

CREATE TABLE `inventary_units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventary_units`
--

INSERT INTO `inventary_units` (`unit_id`, `unit_name`, `unit_type`) VALUES
(1, 'Litros', 'Lts'),
(2, 'Kilogramos', 'Kg'),
(3, 'Unidad', 'Unidad'),
(4, 'Caja', 'Caja'),
(5, 'Pieza', 'Piezas'),
(6, 'Porción', 'Porción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `facturationNumber` int(11) NOT NULL,
  `controlNumber` varchar(30) NOT NULL DEFAULT '0',
  `order_table_id` int(11) NOT NULL,
  `order_personal_document` varchar(10) NOT NULL,
  `order_list_inventary` text NOT NULL,
  `order_create` datetime DEFAULT NULL,
  `order_done` datetime DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `client_document` varchar(30) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_address` varchar(255) DEFAULT NULL,
  `client_phone_number` varchar(30) DEFAULT NULL,
  `order_price_dolar` float NOT NULL DEFAULT 0,
  `order_percent_iva` float NOT NULL,
  `subtotal` float NOT NULL,
  `totalfinal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`order_id`, `facturationNumber`, `controlNumber`, `order_table_id`, `order_personal_document`, `order_list_inventary`, `order_create`, `order_done`, `order_status`, `client_document`, `client_name`, `client_address`, `client_phone_number`, `order_price_dolar`, `order_percent_iva`, `subtotal`, `totalfinal`) VALUES
(1, 50001, '00-00050001', 4, '181117948', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-01 13:07:19', '2022-10-12 18:43:18', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 36, 36.576),
(2, 50002, '00-00050002', 4, '181117948', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-01 13:10:55', '2023-01-02 13:11:07', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 18, 18.288),
(3, 50003, '00-00050003', 3, '181117948', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/a4ae9425-a370-4516-ba51-2f3ce8a4bba9.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-01 13:16:29', '2022-12-01 13:16:29', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 606, 615.696),
(4, 50004, '00-00050004', 3, '22665281', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-01 13:16:42', '2023-02-01 13:16:48', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 18, 18.288),
(5, 50005, '00-00050005', 3, '22665281', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-01 13:31:52', '2022-11-01 13:31:52', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 18, 18.288),
(6, 50006, '00-00050006', 3, '22665281', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-01 13:33:02', '2023-02-01 13:33:02', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 18, 18.288),
(7, 50007, '00-00050007', 3, '22665281', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-01 13:56:35', '2022-10-11 13:56:35', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 36, 36.576),
(8, 50008, '00-00050008', 5, '181117948', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 13:57:54', '2023-02-02 13:57:54', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 15.05, 15.2908),
(9, 50009, '00-00050009', 3, '22665281', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 14:00:08', '2023-02-01 14:00:08', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 15.05, 15.2908),
(10, 50010, '00-00050010', 3, '22665281', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 14:01:01', '2023-02-01 14:01:01', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 15.05, 15.2908),
(11, 50011, '00-00050011', 3, '22665281', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 14:05:42', '2023-02-01 14:05:42', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 15.05, 15.2908),
(12, 50012, '00-00050012', 5, '181117948', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 14:06:05', '2023-02-01 14:06:05', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 45.15, 45.8724),
(13, 50013, '00-00050013', 3, '22665281', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 14:08:33', '2023-02-01 14:08:33', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 15.05, 15.2908),
(14, 50014, '00-00050014', 3, '22665281', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 14:10:40', '2023-02-01 14:10:40', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 15.05, 15.2908),
(15, 50015, '00-00050015', 3, '22665281', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 14:11:52', '2023-02-01 14:11:52', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 15.05, 15.2908),
(16, 50016, '00-00050016', 1, '22665281', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 14:12:56', '2023-02-01 14:12:56', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 30.1, 30.5816),
(17, 50017, '00-00050017', 3, '123', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 14:15:13', '2023-02-01 14:15:13', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 15.05, 15.2908),
(18, 50018, '00-00050018', 3, '22665281', '[{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-01 14:16:49', '2023-02-01 14:16:49', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 15.05, 15.2908),
(19, 50019, '00-00050019', 4, '22665281', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/7dae8051-2d1f-4178-8fce-c7dcd9411328.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}]}]', '2023-02-01 14:18:02', '2023-02-01 14:18:02', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 172, 174.752),
(20, 50020, '00-00050020', 2, '22665281', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/7dae8051-2d1f-4178-8fce-c7dcd9411328.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}]}]', '2023-02-01 14:18:54', '2023-02-01 14:18:54', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 172, 174.752),
(21, 50021, '00-00050021', 5, '22665281', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/7dae8051-2d1f-4178-8fce-c7dcd9411328.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}]}]', '2023-02-01 14:19:24', '2022-10-13 04:17:18', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 172, 174.752),
(22, 50022, '00-00050022', 4, '22665281', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/7dae8051-2d1f-4178-8fce-c7dcd9411328.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}]}]', '2023-02-01 14:20:06', '2023-02-01 14:20:06', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 344, 349.504),
(23, 50023, '00-00050023', 1, '22665281', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/7dae8051-2d1f-4178-8fce-c7dcd9411328.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}]}]', '2023-02-01 14:35:10', '2023-02-01 14:35:19', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.81, 16, 172, 174.752),
(24, 50024, '00-00050024', 5, '22665281', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-02 02:16:28', '2023-02-02 02:16:28', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.84, 16, 18, 18.288),
(25, 50025, '00-00050025', 4, '22665281', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/7dae8051-2d1f-4178-8fce-c7dcd9411328.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}]}]', '2023-02-02 15:44:16', '2023-02-02 15:44:16', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.84, 16, 172, 174.752),
(26, 50026, '00-00050026', 5, '22665281', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/7dae8051-2d1f-4178-8fce-c7dcd9411328.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25}]}]', '2023-02-02 16:28:18', '2023-02-02 16:28:18', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.86, 16, 344, 349.504),
(27, 50027, '00-00050027', 34, '22665281', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]},{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172.05,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/7dae8051-2d1f-4178-8fce-c7dcd9411328.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}]}]', '2023-02-02 16:36:51', '2023-02-02 16:37:15', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.86, 16, 208.05, 211.379),
(28, 50028, '00-00050028', 35, '16252662', '[{\"product_id\":\"1f2b144d-58fb-4e42-9e9d-6b4569\",\"product\":{\"product_id\":\"1f2b144d-58fb-4e42-9e9d-6b4569\",\"product_name\":\"Refresco Pepsi\",\"product_description\":\"Refresco en lata de 500ml Pepsi\",\"product_base_price\":50.11,\"product_category\":2,\"product_items\":[{\"item_id\":101,\"item_count\":0.5}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/297fab04-295d-4841-ae6b-7465838d09e9.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":4,\"product_items\":[{\"item_id\":101,\"item_count\":0.5}]},{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172.05,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/7dae8051-2d1f-4178-8fce-c7dcd9411328.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}]},{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/735a512a-9828-44c2-9b88-53d2ce7dafa0.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]},{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-02 17:03:26', '2023-02-02 17:03:56', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.89, 16, 405.54, 412.029),
(29, 50029, '00-00050029', 5, '16252662', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172.05,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/7dae8051-2d1f-4178-8fce-c7dcd9411328.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}]}]', '2023-02-02 21:54:35', '2023-02-02 21:54:41', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.89, 16, 172.05, 174.803),
(30, 50030, '00-00050030', 5, '181117948', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-02 23:23:36', '2023-02-02 23:23:36', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 18, 18.288),
(31, 50031, '00-00050031', 5, '16252662', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://localhost:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-04 19:09:04', '2023-02-04 19:09:13', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 36, 36.576),
(32, 50032, '00-00050032', 1, '181117948', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"http://192.168.0.1:8080/hrestbackend/api/images/productos/a4ae9425-a370-4516-ba51-2f3ce8a4bba9.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":6,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]},{\"product_id\":\"ef5288e9-2446-4759-9285-7555d1\",\"product\":{\"product_id\":\"ef5288e9-2446-4759-9285-7555d1\",\"product_name\":\"Pizca Andina\",\"product_description\":\"Sopa en base de leche típica del Estado Mérida.\",\"product_base_price\":7.01,\"product_category\":3,\"product_items\":[{\"item_id\":4,\"item_count\":0.1},{\"item_id\":30,\"item_count\":0.03}],\"product_photo\":\"http://192.168.0.1:8080/hrestbackend/api/images/productos/fe4c5329-a026-47b5-b06a-6bbf5ce5c961.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":12,\"product_items\":[{\"item_id\":4,\"item_count\":0.1},{\"item_id\":30,\"item_count\":0.03}]},{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://192.168.0.1:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-04 19:26:25', '2023-02-04 19:26:25', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.92, 16, 1314.12, 1335.15),
(33, 50033, '00-00050033', 2, '16252662', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://192.168.0.1:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-04 19:29:12', '2023-02-04 19:29:12', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 18, 18.288),
(35, 50035, '00-00050035', 34, '16252662', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"http://192.168.0.1:8080/hrestbackend/api/images/productos/c2a5a5c4-e32a-470f-9c02-66f9b6172949.png\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-05 15:31:23', '2023-02-05 15:31:23', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 36, 36.576),
(36, 50035, '00-00050035', 1, '16252662', '[{\"product_id\":\"ef5288e9-2446-4759-9285-7555d1\",\"product\":{\"product_id\":\"ef5288e9-2446-4759-9285-7555d1\",\"product_name\":\"Pizca Andina\",\"product_description\":\"Sopa en base de leche típica del Estado Mérida.\",\"product_base_price\":7.01,\"product_category\":3,\"product_items\":[{\"item_id\":4,\"item_count\":0.1},{\"item_id\":30,\"item_count\":0.04}],\"product_photo\":\"images/productos/0fbb9c3b-9dee-4679-b48f-9e51a286e678.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":4,\"item_count\":0.1},{\"item_id\":30,\"item_count\":0.04}]}]', '2023-02-05 22:27:39', '2023-02-05 22:27:45', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 7.01, 7.12216),
(37, 50036, '00-00050036', 35, '16252662', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"images/productos/e0e741e5-a236-4ef2-9f88-2738fa80f13d.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]},{\"product_id\":\"ef5288e9-2446-4759-9285-7555d1\",\"product\":{\"product_id\":\"ef5288e9-2446-4759-9285-7555d1\",\"product_name\":\"Pizca Andina\",\"product_description\":\"Sopa en base de leche típica del Estado Mérida.\",\"product_base_price\":7.01,\"product_category\":3,\"product_items\":[{\"item_id\":4,\"item_count\":0.1},{\"item_id\":30,\"item_count\":0.04}],\"product_photo\":\"images/productos/0fbb9c3b-9dee-4679-b48f-9e51a286e678.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":4,\"item_count\":0.1},{\"item_id\":30,\"item_count\":0.04}]}]', '2023-02-05 23:37:00', '2023-02-05 23:37:17', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 25.01, 25.4102),
(39, 50037, '00-00050037', 42, '16252662', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"images/productos/e0e741e5-a236-4ef2-9f88-2738fa80f13d.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]},{\"product_id\":\"ef5288e9-2446-4759-9285-7555d1\",\"product\":{\"product_id\":\"ef5288e9-2446-4759-9285-7555d1\",\"product_name\":\"Pizca Andina\",\"product_description\":\"Sopa en base de leche típica del Estado Mérida.\",\"product_base_price\":7.01,\"product_category\":3,\"product_items\":[{\"item_id\":4,\"item_count\":0.1},{\"item_id\":30,\"item_count\":0.04}],\"product_photo\":\"images/productos/0fbb9c3b-9dee-4679-b48f-9e51a286e678.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":4,\"item_count\":0.1},{\"item_id\":30,\"item_count\":0.04}]}]', '2023-02-06 15:02:31', '2023-02-06 15:03:29', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 25.01, 25.4102),
(40, 50038, '00-00050038', 42, '16252662', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"images/productos/e0e741e5-a236-4ef2-9f88-2738fa80f13d.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]}]', '2023-02-06 15:13:40', '2023-02-06 15:14:11', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 36, 36.576),
(41, 50039, '00-00050039', 42, '181117948', '[{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product\":{\"product_id\":\"3acaa2c1-0cc9-4951-aed9-e80346\",\"product_name\":\"Chocolate\",\"product_description\":\"Chocolate 100ml\",\"product_base_price\":18,\"product_category\":2,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}],\"product_photo\":\"images/productos/e0e741e5-a236-4ef2-9f88-2738fa80f13d.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]},{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 15:23:57', '2023-02-06 16:17:22', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.92, 16, 422, 428.752),
(42, 50040, '00-00050040', 43, '181117948', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":4,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 16:17:13', '2023-02-06 16:20:28', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 808, 820.928),
(43, 50041, '00-00050041', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 16:21:09', '2023-02-06 16:21:14', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 404, 410.464),
(44, 50042, '00-00050042', 42, '181117948', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 16:26:09', '2023-02-06 16:26:09', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 202, 205.232),
(45, 50043, '00-00050043', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 16:29:04', '2023-02-06 16:29:04', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 404, 410.464),
(46, 50045, '00-00050045', 38, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 16:29:18', '2023-02-06 16:29:36', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696),
(47, 50044, '00-00050044', 39, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 16:29:28', '2023-02-06 16:29:28', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696),
(48, 50046, '00-00050046', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":4,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 16:31:13', '2023-02-06 16:31:13', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 808, 820.928),
(49, 50047, '00-00050047', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 17:19:42', '2023-02-06 17:19:47', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 1010, 1026.16),
(50, 50049, '00-00050049', 43, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":4,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 17:20:32', '2023-02-06 17:20:58', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 808, 820.928),
(51, 50050, '00-00050050', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 17:20:40', '2023-02-06 17:21:11', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696),
(52, 50048, '00-00050048', 41, '181117948', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":4,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 17:20:50', '2023-02-06 17:20:50', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 808, 820.928),
(53, 50051, '00-00050051', 42, '181117948', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 17:22:38', '2023-02-06 17:22:43', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696),
(54, 50052, '00-00050052', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 17:31:42', '2023-02-06 17:31:47', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696),
(55, 50053, '00-00050053', 41, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 18:08:58', '2023-02-06 18:08:58', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696);
INSERT INTO `orders` (`order_id`, `facturationNumber`, `controlNumber`, `order_table_id`, `order_personal_document`, `order_list_inventary`, `order_create`, `order_done`, `order_status`, `client_document`, `client_name`, `client_address`, `client_phone_number`, `order_price_dolar`, `order_percent_iva`, `subtotal`, `totalfinal`) VALUES
(56, 50054, '00-00050054', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:01:00', '2023-02-06 19:01:10', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 404, 410.464),
(57, 50056, '00-00050056', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:01:00', '2023-02-06 19:04:55', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.92, 16, 404, 410.464),
(58, 50055, '00-00050055', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:04:27', '2023-02-06 19:04:27', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696),
(60, 50057, '00-00050057', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:09:07', '2023-02-06 19:09:07', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696),
(61, 50058, '00-00050058', 38, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:09:22', '2023-02-06 19:09:22', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 404, 410.464),
(62, 50059, '00-00050059', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:25:51', '2023-02-06 19:25:51', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696),
(63, 50060, '00-00050060', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:26:26', '2023-02-06 19:26:26', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.92, 16, 404, 410.464),
(64, 50061, '00-00050061', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":4,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:37:30', '2023-02-06 19:37:30', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 808, 820.928),
(65, 50063, '00-00050063', 41, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:37:39', '2023-02-06 19:39:42', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696),
(66, 50062, '00-00050062', 38, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:38:54', '2023-02-06 19:39:33', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 404, 410.464),
(67, 50064, '00-00050064', 39, '181117948', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:45:15', '2023-02-06 19:45:36', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 404, 410.464),
(68, 50065, '00-00050065', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 19:45:29', '2023-02-06 19:45:44', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.92, 16, 404, 410.464),
(69, 50066, '00-00050066', 42, '16252662', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172.05,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"images/productos/0c521094-ecdc-47f4-ae02-c3b17374424c.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}]}]', '2023-02-06 21:05:54', '2023-02-06 21:06:01', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.92, 16, 172.05, 174.803),
(70, 50067, '00-00050067', 41, '16252662', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172.05,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"images/productos/0c521094-ecdc-47f4-ae02-c3b17374424c.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}]}]', '2023-02-06 21:28:49', '2023-02-06 21:33:40', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 172.05, 174.803),
(71, 50068, '00-00050068', 41, '16252662', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172.05,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"images/productos/0c521094-ecdc-47f4-ae02-c3b17374424c.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":2,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}]},{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product\":{\"product_id\":\"ba9a500f-f284-4c8b-bcd1-bac108\",\"product_name\":\"Desayuno Mixto\",\"product_description\":\"2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata\",\"product_base_price\":15.05,\"product_category\":3,\"product_items\":[{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"images/productos/d3c4c634-5fa5-4d3a-9218-04c43389ee5e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":2,\"item_count\":1}]}]', '2023-02-06 22:23:33', '2023-02-06 22:29:55', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 359.15, 364.896),
(72, 50069, '00-00050069', 42, '181117948', '[{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product\":{\"product_id\":\"b6715d73-8ffa-48aa-9165-c07995\",\"product_name\":\"Trucha Al Ajillo\",\"product_description\":\"Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)\",\"product_base_price\":172.05,\"product_category\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}],\"product_photo\":\"images/productos/0c521094-ecdc-47f4-ae02-c3b17374424c.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}]}]', '2023-02-06 22:58:53', '2023-02-06 22:59:13', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 172.05, 174.803),
(73, 50070, '00-00050070', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 23:15:21', '2023-02-06 23:25:20', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.92, 16, 606, 615.696),
(74, 50072, '00-00050072', 43, '181117948', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 23:24:53', '2023-02-06 23:26:11', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 202, 205.232),
(75, 50071, '00-00050071', 38, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 23:25:10', '2023-02-06 23:25:29', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.92, 16, 202, 205.232),
(76, 50073, '00-00050073', 38, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":3,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 23:33:53', '2023-02-06 23:33:53', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.93, 16, 606, 615.696),
(77, 50074, '00-00050074', 42, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":10,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 23:38:13', '2023-02-06 23:38:13', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.93, 16, 2020, 2052.32),
(78, 50075, '00-00050075', 40, '181117948', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":8,\"product_items\":[{\"item_id\":30,\"item_count\":0.5}]}]', '2023-02-06 23:38:50', '2023-02-06 23:38:50', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.93, 16, 1616, 1641.86),
(79, 50076, '00-00050076', 38, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.49}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":30,\"item_count\":0.49}]}]', '2023-02-07 00:04:57', '2023-02-07 00:04:57', 1, 'NO CI NO RIF', 'CLIENTE GENERICO', 'NO APLICA', 'NO APLICA', 21.93, 16, 202, 205.232),
(80, 50077, '00-00050077', 39, '16252662', '[{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product\":{\"product_id\":\"bf9c97b9-e203-421a-aae3-13496d\",\"product_name\":\"Papas Fritas\",\"product_description\":\"Servicio de papas fritas de aproximadamente 500 gramos\",\"product_base_price\":202,\"product_category\":5,\"product_items\":[{\"item_id\":30,\"item_count\":0.49}],\"product_photo\":\"images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg\",\"product_photo_thumb\":\"\",\"product_status\":1},\"product_count\":1,\"product_items\":[{\"item_id\":30,\"item_count\":0.49}]}]', '2023-02-07 00:05:51', '2023-02-07 00:05:51', 1, 'INTERNO', 'PERSONAL', 'NO APLICA', 'NO APLICA', 21.93, 16, 202, 205.232);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personals`
--

CREATE TABLE `personals` (
  `personal_document` varchar(10) NOT NULL,
  `personal_alias` varchar(80) NOT NULL,
  `personal_name` varchar(255) NOT NULL,
  `personal_role` int(11) NOT NULL,
  `personal_photo` text NOT NULL,
  `personal_photo_thumb` text NOT NULL,
  `personal_status` int(11) NOT NULL DEFAULT 1,
  `personal_user` varchar(50) NOT NULL,
  `personal_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personals`
--

INSERT INTO `personals` (`personal_document`, `personal_alias`, `personal_name`, `personal_role`, `personal_photo`, `personal_photo_thumb`, `personal_status`, `personal_user`, `personal_password`) VALUES
('123', 'Any', 'Anisirkairin Gonzalez', 3, 'images/personal/c4d7a72d-32c4-4f1d-96f2-818068b7ad19.jpg', '', 1, '', ''),
('16252662', 'Malojillo', 'Héctor Pimentel', 5, 'images/personal/59a8e2d2-1b31-4720-b0cb-6f6005d84ff4.jpg', '', 1, '', ''),
('18111794', 'Ashly', 'Ashly Parra', 1, 'images/personal/9bc9fb66-c25b-44c2-9f74-28378baf1911.jpg', '', 1, '', ''),
('181117942', 'José', 'José Pimentel', 2, 'images/personal/d2a9bf1d-5c32-42f9-823a-dea2f11f9094.jpg', '', 1, '', ''),
('181117948', 'Rico', 'Santiago Pimentel', 5, 'images/personal/c2c490c4-3c1e-46eb-9ef1-1ad4a7b2002c.jpg', '', 1, '', ''),
('22665281', 'El Gordo', 'José Rodriguez', 4, 'images/personal/35da2f3f-a9d1-44ff-8fdc-c129dbcdeece.jpg', '', 1, 'mesero', '1234'),
('226652814', 'Angel', 'Angel Lozano', 6, 'images/personal/a5f4c9a7-9a34-4d57-a014-f8bc008f9368.jpg', '', 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_id` varchar(30) NOT NULL,
  `product_name` varchar(80) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_base_price` float NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_items` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `product_photo` varchar(255) NOT NULL,
  `product_photo_thumb` varchar(255) NOT NULL,
  `product_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_base_price`, `product_category`, `product_items`, `product_photo`, `product_photo_thumb`, `product_status`) VALUES
('3acaa2c1-0cc9-4951-aed9-e80346', 'Chocolate', 'Chocolate 100ml', 18, 2, '[{\"item_id\":13,\"item_count\":0.02},{\"item_id\":4,\"item_count\":0.13},{\"item_id\":11,\"item_count\":0.01}]', 'images/productos/e0e741e5-a236-4ef2-9f88-2738fa80f13d.jpg', '', 1),
('3cd42bd9-24ea-45a5-9de1-7ec6d6', 'Pollo Frito', 'Ración de pollo de aprox. 300grams, empanizado acompañado de papas fritas', 241.31, 1, '[{\"item_id\":62,\"item_count\":0.33},{\"item_id\":30,\"item_count\":0.16}]', 'images/productos/f1614ed0-54c3-4f6a-a34f-47115f3353b4.jpg', '', 1),
('697b09dc-6b5e-4999-8edb-fbb9e1', 'Solomo a la Brasa', 'Bisteck de solomo acompanado de dos servicios (Arroz , Ensalada)', 250, 1, '[{\"item_id\":65,\"item_count\":1},{\"item_id\":8,\"item_count\":0.05},{\"item_id\":34,\"item_count\":0.1},{\"item_id\":35,\"item_count\":0.1},{\"item_id\":16,\"item_count\":0.01}]', 'images/productos/3b0c6d69-6cc5-4a72-be6b-c7071e75458e.jpg', '', 1),
('a19f3dd8-1188-4a54-92ef-75662b', 'Café', 'Café 100ml', 7.15, 2, '[{\"item_id\":14,\"item_count\":0.01},{\"item_id\":11,\"item_count\":0.02},{\"item_id\":49,\"item_count\":1}]', 'images/productos/cd5b00ad-6e9f-4522-aeb3-32b7f94da31a.jpg', '', 1),
('b6715d73-8ffa-48aa-9165-c07995', 'Trucha Al Ajillo', 'Trucha en salsa de Ajo y Mantequilla con 2 contornos(arroz y papas fritas)', 172.05, 1, '[{\"item_id\":1,\"item_count\":1},{\"item_id\":30,\"item_count\":0.25},{\"item_id\":2,\"item_count\":1}]', 'images/productos/0c521094-ecdc-47f4-ae02-c3b17374424c.jpg', '', 1),
('ba9a500f-f284-4c8b-bcd1-bac108', 'Desayuno Mixto', '2 Arepas de trigo acompañadas de 1 huevo, 1 porción de Carne Mechada, 1 porción de Caraotas Negras, Queso Blanco y Nata', 15.05, 3, '[{\"item_id\":2,\"item_count\":1}]', 'images/productos/d3c4c634-5fa5-4d3a-9218-04c43389ee5e.jpg', '', 1),
('bd70f753-5a95-4b0c-8c35-c5be48', 'Trucha a la Meniere', 'Trucha preparada en salsa de Mantequilla y Perejil con 2 contornos(arroz y papas fritas)', 172, 1, '[{\"item_id\":1,\"item_count\":1},{\"item_id\":8,\"item_count\":0.03},{\"item_id\":3,\"item_count\":0.01},{\"item_id\":29,\"item_count\":0.01},{\"item_id\":30,\"item_count\":0.25}]', 'images/productos/50c682b4-4a88-46c2-800f-f7a1385c6fe9.jpg', '', 1),
('bf9c97b9-e203-421a-aae3-13496d', 'Papas Fritas', 'Servicio de papas fritas de aproximadamente 500 gramos', 202, 5, '[{\"item_id\":30,\"item_count\":0.49}]', 'images/productos/64b84a4a-f2b9-4071-9680-e393bc61845e.jpg', '', 1),
('bfc4b323-c303-4bee-b82b-8a44a9', 'Tajadas', 'Servicio de Tajadas de aproximadamente 500gramos acompañada de queso rayado', 340, 5, '[{\"item_id\":31,\"item_count\":0.5},{\"item_id\":2,\"item_count\":1},{\"item_id\":47,\"item_count\":1}]', 'images/productos/4f90765d-a749-40a9-9b24-4da1946f6f95.jpg', '', 1),
('ef5288e9-2446-4759-9285-7555d1', 'Pizca Andina', 'Sopa en base de leche típica del Estado Mérida.', 7.01, 3, '[{\"item_id\":4,\"item_count\":0.1},{\"item_id\":30,\"item_count\":0.04}]', 'images/productos/0fbb9c3b-9dee-4679-b48f-9e51a286e678.jpg', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_color` varchar(7) NOT NULL,
  `role_seller` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_color`, `role_seller`) VALUES
(1, 'Bartender', '#d63384', 0),
(2, 'Cocinero', '#0dcaf0', 0),
(3, 'Jardinero', '#dc3545', 0),
(4, 'Limpieza', '#0d6efd', 0),
(5, 'Mesonero', '#fd7e14', 1),
(6, 'Variado', '#ffc107', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `price_dollar` float NOT NULL,
  `percent_iva` float NOT NULL,
  `count_items_inventary` int(11) NOT NULL,
  `num_control` varchar(20) NOT NULL,
  `facturation_initial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `price_dollar`, `percent_iva`, `count_items_inventary`, `num_control`, `facturation_initial`) VALUES
(1, 21.93, 16, 25, '00-', 50000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tables`
--

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL,
  `table_name` varchar(80) NOT NULL,
  `table_status` int(11) NOT NULL,
  `table_active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tables`
--

INSERT INTO `tables` (`table_id`, `table_name`, `table_status`, `table_active`) VALUES
(38, 'Mesa 01', 1, 0),
(39, 'Mesa 02', 1, 0),
(40, 'Mesa 03', 1, 0),
(41, 'Mesa 04', 1, 0),
(42, 'Presidencial', 1, 0),
(43, 'Bajada 01', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` varchar(15) NOT NULL,
  `user_psw` varchar(40) NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `user_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_psw`, `user_name`, `user_photo`) VALUES
('admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrador', './user_photo.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indices de la tabla `inventary`
--
ALTER TABLE `inventary`
  ADD PRIMARY KEY (`item_id`);

--
-- Indices de la tabla `inventary_categories`
--
ALTER TABLE `inventary_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indices de la tabla `inventary_operations`
--
ALTER TABLE `inventary_operations`
  ADD PRIMARY KEY (`operation_id`);

--
-- Indices de la tabla `inventary_units`
--
ALTER TABLE `inventary_units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indices de la tabla `personals`
--
ALTER TABLE `personals`
  ADD PRIMARY KEY (`personal_document`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`),
  ADD UNIQUE KEY `table_name` (`table_name`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inventary`
--
ALTER TABLE `inventary`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `inventary_categories`
--
ALTER TABLE `inventary_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `inventary_operations`
--
ALTER TABLE `inventary_operations`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventary_units`
--
ALTER TABLE `inventary_units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

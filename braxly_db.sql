-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3305.0.0.1
-- Tiempo de generación: 21-06-2023 a las 01:47:13
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `braxly_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletas`
--

CREATE TABLE `boletas` (
  `bol_id` int(11) NOT NULL,
  `tra_id` int(11) NOT NULL,
  `bol_fech_emisión` date NOT NULL,
  `bol_monto_total` varchar(100) NOT NULL,
  `deco_info_compra` varchar(255) NOT NULL,
  `depe_id` int(11) NOT NULL,
  `bol_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `boletas`
--

INSERT INTO `boletas` (`bol_id`, `tra_id`, `bol_fech_emisión`, `bol_monto_total`, `deco_info_compra`, `depe_id`, `bol_estado`) VALUES
(1, 1, '2023-05-29', '100.00', 'Pago correctamente', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cli_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `cli_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cli_id`, `per_id`, `cli_estado`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `depe_id` int(11) NOT NULL,
  `ped_id` int(11) NOT NULL,
  `depe_estado` varchar(100) NOT NULL,
  `depe_fecha` date NOT NULL,
  `tipa_id` int(11) NOT NULL,
  `depe_num_mesa` varchar(100) NOT NULL,
  `deco_info_compra` varchar(100) NOT NULL,
  `tra_id` int(11) NOT NULL,
  `ticon_id` int(11) NOT NULL,
  `depe` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`depe_id`, `ped_id`, `depe_estado`, `depe_fecha`, `tipa_id`, `depe_num_mesa`, `deco_info_compra`, `tra_id`, `ticon_id`, `depe`) VALUES
(1, 1, 'En preparación', '2023-05-29', 2, '001', 'Se le enviara de cortesia ensalada de palta', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empr_id` int(11) NOT NULL,
  `empr_nombre` varchar(255) NOT NULL,
  `empr_telefono` varchar(100) NOT NULL,
  `empr_correo` varchar(100) NOT NULL,
  `empr_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empr_id`, `empr_nombre`, `empr_telefono`, `empr_correo`, `empr_estado`) VALUES
(1, 'Rincon Marino', '11111111', 'rinconmarino@gmail.com', 1),
(2, 'Pescaditos', '22222222', 'pescaditos@gmail.com', 1),
(3, 'La Gaviota', '33333333', 'lagaviota@gmail.com', 1),
(4, 'Terminal Marino', '444444444', 'terminalmarino@gmail.com', 1),
(5, 'Cevicheando', '55555555', 'pasqueando@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `inv_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prov_id` int(11) NOT NULL,
  `inv_tipo_movimiento` varchar(100) NOT NULL,
  `inv_cantidad` varchar(100) NOT NULL,
  `inv_fecha_ing` date NOT NULL,
  `inv_fecha_vencimiento` date NOT NULL,
  `sucu_id` int(11) NOT NULL,
  `inv_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`inv_id`, `prod_id`, `prov_id`, `inv_tipo_movimiento`, `inv_cantidad`, `inv_fecha_ing`, `inv_fecha_vencimiento`, `sucu_id`, `inv_estado`) VALUES
(2, 2, 1, 'Ingreso', '3', '2023-05-28', '2024-05-28', 1, 1),
(3, 1, 1, 'Retiro', '10-10-2023', '0000-00-00', '0000-00-00', 1, 1),
(4, 1, 1, 'Ingreso', '10-10-2023', '0000-00-00', '0000-00-00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ped_id` int(11) NOT NULL,
  `ped_num_pedido` int(11) NOT NULL,
  `ped_tipo_compra` varchar(100) NOT NULL,
  `ped_estado_pedido` varchar(100) NOT NULL,
  `ped_detalles` varchar(255) NOT NULL,
  `pla_id` int(11) NOT NULL,
  `cli_id` int(11) NOT NULL,
  `ped_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`ped_id`, `ped_num_pedido`, `ped_tipo_compra`, `ped_estado_pedido`, `ped_detalles`, `pla_id`, `cli_id`, `ped_estado`) VALUES
(1, 1, 'Consumo en el local', '1', 'Guarniciones:platano frito', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `per_id` int(11) NOT NULL,
  `per_nombres` varchar(255) NOT NULL,
  `per_apellidos` varchar(255) NOT NULL,
  `per_telefono` varchar(100) NOT NULL,
  `per_dni` varchar(100) NOT NULL,
  `per_correo` varchar(100) NOT NULL,
  `per_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`per_id`, `per_nombres`, `per_apellidos`, `per_telefono`, `per_dni`, `per_correo`, `per_estado`) VALUES
(1, 'Jose', 'Perez', '962822214', '74500061', 'jp@upeu.edu.pe', 1),
(2, 'Martin', 'Gato', '962882214', '74500515', 'mg@upeu.edu.pe', 1),
(3, 'Renato', 'Chavez', '96282213', '745123151', 'rc@upeu.edu.pe', 1),
(4, 'Jonatan', 'Frejol', '96282214', '74500125', 'jf@upeu.edu.pe', 1),
(5, 'Hernan', 'Barcos', '95282214', '74500015', 'hb@upeu.edu.pe', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `pla_id` int(11) NOT NULL,
  `pla_comida` varchar(100) NOT NULL,
  `pla_precio` varchar(100) NOT NULL,
  `pla_descrip` varchar(255) NOT NULL,
  `tico_id` int(11) NOT NULL,
  `sucu_id` int(11) NOT NULL,
  `pla_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`pla_id`, `pla_comida`, `pla_precio`, `pla_descrip`, `tico_id`, `sucu_id`, `pla_estado`) VALUES
(1, 'Ceviche de pescado', '30.00', 'Pescado, sal, limon y ajies. Emblema de nuestra cocina peruana', 1, 1, 1),
(2, 'Leche de tigre', '34.00', 'Fresco e irresistible concentrado de nuestro ceviche. ¡Tu mejor forma de empezar!', 1, 1, 1),
(3, 'Chilcano de pescado', '18.00', 'Caldo concentrado de pescado aromatizado con hierbas frescas. Disfrutelo con gotas de limón, canchita crocante y pizca de rocoto', 1, 1, 1),
(4, 'Wantan de pescado', '18.00', 'Pescado en aceite de ajonjolí envuelto en wantán', 1, 1, 1),
(5, 'Chupe de pescado', '46.00', 'Filetes de pescado frito en un caldo especial cocido a punto con zapallo, habas y queso fresco. ¡Una tradición de nuestra comida costeña!', 1, 1, 1),
(6, 'Coca Cola', '8', '1/2 Litro', 2, 1, 1),
(7, 'Cerveza Cristal personal', '10.00', 'Cerveza Cristal personal', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `prod_id` int(11) NOT NULL,
  `prod_nombre` varchar(100) NOT NULL,
  `prod_descripcion` varchar(255) NOT NULL,
  `prod_precio` varchar(50) NOT NULL,
  `tipr_id` int(11) NOT NULL,
  `prod_estado` varchar(100) NOT NULL,
  `prod_unidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`prod_id`, `prod_nombre`, `prod_descripcion`, `prod_precio`, `tipr_id`, `prod_estado`, `prod_unidad`) VALUES
(1, 'Gaseosa - Coca Cola', '', '50 S/.', 1, '1', '3'),
(2, 'Costal de arroz Leon', 'Costal de arroz Leon', '60.00', 2, '1', '60.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `prov_id` int(11) NOT NULL,
  `prov_nombre` varchar(100) NOT NULL,
  `prov_direccion` varchar(100) NOT NULL,
  `prov_telefono` varchar(100) NOT NULL,
  `prov_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`prov_id`, `prov_nombre`, `prov_direccion`, `prov_telefono`, `prov_estado`) VALUES
(1, 'Comercial El Sol', 'Jr. Los soles', '11111111', 1),
(2, 'Comercializadora Marthita', 'Jr. Los progresos', '22222222', 1),
(3, 'Pescaderia Los paichecitos', 'Jr. Los procesos', '333333333', 1),
(4, 'Venta Gasificada Los Coca Colas', 'Jr. Iquitos', '444444444', 1),
(5, 'Plastiqueria El rey', 'Jr. Miraflores', '555555555', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamos`
--

CREATE TABLE `reclamos` (
  `recl_id` int(11) NOT NULL,
  `recl_tipo_reclamo` varchar(100) NOT NULL,
  `recl_descrip` varchar(255) NOT NULL,
  `sucu_id` int(11) NOT NULL,
  `recl_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reclamos`
--

INSERT INTO `reclamos` (`recl_id`, `recl_tipo_reclamo`, `recl_descrip`, `sucu_id`, `recl_estado`) VALUES
(1, 'Atención al cliente', 'Demoro en atendernos, la comida fria y demoro en entregar la carta y el plato', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `reg_id` int(11) NOT NULL,
  `reg_nombres` varchar(255) NOT NULL,
  `reg_apellidos` varchar(255) NOT NULL,
  `reg_email` varchar(255) NOT NULL,
  `reg_clientes_id` varchar(255) NOT NULL,
  `reg_llave_secreta` varchar(255) NOT NULL,
  `reg_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`reg_id`, `reg_nombres`, `reg_apellidos`, `reg_email`, `reg_clientes_id`, `reg_llave_secreta`, `reg_estado`) VALUES
(1, 'Renzo', 'Upiachihua', 'ru@upeu.edu.pe', 'a2aa07adfhdfrexfhgdfhdferttgeVaTUezA8T.HF3knVN6KQ5LK0RsSpsKO', 'o2ao07odfhdfrexfhgdfhdferttgeHgk7T5uk04hkXSu0oFbgAdVwvLRmkvu', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `sucu_id` int(11) NOT NULL,
  `sucu_nombre` varchar(100) NOT NULL,
  `sucu_direccion` varchar(100) NOT NULL,
  `sucu_telefono` int(100) NOT NULL,
  `sucu_departamento` varchar(100) NOT NULL,
  `sucu_provincia` int(11) NOT NULL,
  `empr_id` int(11) NOT NULL,
  `sucu_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`sucu_id`, `sucu_nombre`, `sucu_direccion`, `sucu_telefono`, `sucu_departamento`, `sucu_provincia`, `empr_id`, `sucu_estado`) VALUES
(1, 'Rinconcito Marino - Tarapoto', 'Jr. Miraflores', 111111111, 'San Martin', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_admin`
--

CREATE TABLE `tipo_admin` (
  `tiad_id` int(11) NOT NULL,
  `tiad_nombre` varchar(100) NOT NULL,
  `tiad_descrip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_admin`
--

INSERT INTO `tipo_admin` (`tiad_id`, `tiad_nombre`, `tiad_descrip`) VALUES
(1, 'SuperAdmin', 'Tendra todos los permisos'),
(2, 'AdminEmpresa', 'Solo para una empresa'),
(3, 'AdminSucursal', 'Solo para un sucursal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comida`
--

CREATE TABLE `tipo_comida` (
  `tico_id` int(11) NOT NULL,
  `tico_nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_comida`
--

INSERT INTO `tipo_comida` (`tico_id`, `tico_nombre`) VALUES
(1, 'Plato de comida'),
(2, 'Refresco'),
(3, 'Bebida alcoholica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_consumo`
--

CREATE TABLE `tipo_consumo` (
  `ticon_id` int(11) NOT NULL,
  `ticon_consumo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_consumo`
--

INSERT INTO `tipo_consumo` (`ticon_id`, `ticon_consumo`) VALUES
(1, 'Consumo en el local'),
(2, 'Consumo exterior');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `tipa_id` int(11) NOT NULL,
  `tipa_pago` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`tipa_id`, `tipa_pago`) VALUES
(1, 'Tarjeta'),
(2, 'Contado'),
(3, 'Vuelto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `tipr_id` int(11) NOT NULL,
  `tipr_tipo` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`tipr_id`, `tipr_tipo`, `descripcion`) VALUES
(1, 'Bebidas', 'Todo tipo de producto que sean considerados bebidas'),
(2, 'Costal de arroz', 'Costal de arroz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_trabajador`
--

CREATE TABLE `tipo_trabajador` (
  `titra_id` int(11) NOT NULL,
  `titra_rol` varchar(100) NOT NULL,
  `titra_descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_trabajador`
--

INSERT INTO `tipo_trabajador` (`titra_id`, `titra_rol`, `titra_descripcion`) VALUES
(1, 'Mesero', 'Se encargara de atender al cliente fisicamente, virtualmente y telefonicamente'),
(2, 'Deliverysta', 'Encargado de llevar los pedidos mediante el delivery');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `tra_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `tra_sueldo` int(11) NOT NULL,
  `titra_id` int(11) NOT NULL,
  `sucu_id` int(11) NOT NULL,
  `tra_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`tra_id`, `per_id`, `tra_sueldo`, `titra_id`, `sucu_id`, `tra_estado`) VALUES
(1, 1, 1200, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `usu_usuario` varchar(100) NOT NULL,
  `usu_clave` varchar(100) NOT NULL,
  `tiad_id` int(11) NOT NULL,
  `empr_id` int(11) DEFAULT NULL,
  `sucu_id` int(11) DEFAULT NULL,
  `usu_estado` int(11) NOT NULL DEFAULT 1,
  `usu_nombres` varchar(255) NOT NULL,
  `usu_apellidos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_usuario`, `usu_clave`, `tiad_id`, `empr_id`, `sucu_id`, `usu_estado`, `usu_nombres`, `usu_apellidos`) VALUES
(2, 'usuario1', 'clave1', 1, NULL, NULL, 1, '', ''),
(3, 'usuario2', 'clave2', 2, 1, NULL, 1, '', ''),
(4, 'usuario3', 'clave3', 3, 1, 1, 1, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boletas`
--
ALTER TABLE `boletas`
  ADD PRIMARY KEY (`bol_id`),
  ADD KEY `tra_id` (`tra_id`),
  ADD KEY `depe_id` (`depe_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cli_id`),
  ADD KEY `per_id` (`per_id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`depe_id`),
  ADD KEY `tipa_id` (`tipa_id`),
  ADD KEY `tra_id` (`tra_id`),
  ADD KEY `ped_id` (`ped_id`),
  ADD KEY `ticon_id` (`ticon_id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empr_id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `prov_id` (`prov_id`),
  ADD KEY `sucu_id` (`sucu_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ped_id`),
  ADD KEY `pla_id` (`pla_id`),
  ADD KEY `cli_id` (`cli_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`per_id`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`pla_id`),
  ADD KEY `tico_id` (`tico_id`),
  ADD KEY `sucu_id` (`sucu_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `tipr_id` (`tipr_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`prov_id`);

--
-- Indices de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  ADD PRIMARY KEY (`recl_id`),
  ADD KEY `sucu_id` (`sucu_id`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`sucu_id`),
  ADD KEY `empr_id` (`empr_id`);

--
-- Indices de la tabla `tipo_admin`
--
ALTER TABLE `tipo_admin`
  ADD PRIMARY KEY (`tiad_id`);

--
-- Indices de la tabla `tipo_comida`
--
ALTER TABLE `tipo_comida`
  ADD PRIMARY KEY (`tico_id`);

--
-- Indices de la tabla `tipo_consumo`
--
ALTER TABLE `tipo_consumo`
  ADD PRIMARY KEY (`ticon_id`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`tipa_id`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`tipr_id`);

--
-- Indices de la tabla `tipo_trabajador`
--
ALTER TABLE `tipo_trabajador`
  ADD PRIMARY KEY (`titra_id`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`tra_id`),
  ADD KEY `sucu_id` (`sucu_id`),
  ADD KEY `per_id` (`per_id`),
  ADD KEY `titra_id` (`titra_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `tiad_id` (`tiad_id`),
  ADD KEY `empr_id` (`empr_id`),
  ADD KEY `sucu_id` (`sucu_id`),
  ADD KEY `tiad_id_2` (`tiad_id`),
  ADD KEY `tiad_id_3` (`tiad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boletas`
--
ALTER TABLE `boletas`
  MODIFY `bol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `depe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ped_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `pla_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `prov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  MODIFY `recl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `sucu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_admin`
--
ALTER TABLE `tipo_admin`
  MODIFY `tiad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_comida`
--
ALTER TABLE `tipo_comida`
  MODIFY `tico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_consumo`
--
ALTER TABLE `tipo_consumo`
  MODIFY `ticon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `tipa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `tipr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_trabajador`
--
ALTER TABLE `tipo_trabajador`
  MODIFY `titra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `tra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boletas`
--
ALTER TABLE `boletas`
  ADD CONSTRAINT `boletas_ibfk_1` FOREIGN KEY (`tra_id`) REFERENCES `trabajadores` (`tra_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `boletas_ibfk_2` FOREIGN KEY (`depe_id`) REFERENCES `detalle_pedido` (`depe_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`per_id`) REFERENCES `personas` (`per_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`ped_id`) REFERENCES `pedidos` (`ped_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`tipa_id`) REFERENCES `tipo_pago` (`tipa_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_3` FOREIGN KEY (`tra_id`) REFERENCES `trabajadores` (`tra_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_4` FOREIGN KEY (`ticon_id`) REFERENCES `tipo_consumo` (`ticon_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`prov_id`) REFERENCES `proveedores` (`prov_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `productos` (`prod_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_ibfk_3` FOREIGN KEY (`sucu_id`) REFERENCES `sucursal` (`sucu_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`pla_id`) REFERENCES `platos` (`pla_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`cli_id`) REFERENCES `clientes` (`cli_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `platos_ibfk_1` FOREIGN KEY (`sucu_id`) REFERENCES `sucursal` (`sucu_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `platos_ibfk_2` FOREIGN KEY (`tico_id`) REFERENCES `tipo_comida` (`tico_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`tipr_id`) REFERENCES `tipo_producto` (`tipr_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reclamos`
--
ALTER TABLE `reclamos`
  ADD CONSTRAINT `reclamos_ibfk_1` FOREIGN KEY (`sucu_id`) REFERENCES `sucursal` (`sucu_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`empr_id`) REFERENCES `empresa` (`empr_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD CONSTRAINT `trabajadores_ibfk_1` FOREIGN KEY (`titra_id`) REFERENCES `tipo_trabajador` (`titra_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trabajadores_ibfk_2` FOREIGN KEY (`per_id`) REFERENCES `personas` (`per_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trabajadores_ibfk_3` FOREIGN KEY (`sucu_id`) REFERENCES `sucursal` (`sucu_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tiad_id`) REFERENCES `tipo_admin` (`tiad_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`empr_id`) REFERENCES `empresa` (`empr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`sucu_id`) REFERENCES `sucursal` (`sucu_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

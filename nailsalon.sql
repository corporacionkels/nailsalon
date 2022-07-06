-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2022 a las 04:29:40
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nailsalon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(5) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `client_id` int(5) DEFAULT NULL,
  `employee_id` int(2) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time_expected` timestamp NULL DEFAULT NULL,
  `canceled` tinyint(1) NOT NULL DEFAULT 0,
  `cancellation_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barber_admin`
--

CREATE TABLE `barber_admin` (
  `admin_id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `barber_admin`
--

INSERT INTO `barber_admin` (`admin_id`, `username`, `email`, `full_name`, `password`) VALUES
(1, 'jairiidriss', 'jairiidriss@gmail.com', 'Idriss Jairi', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441'),
(2, 'admin', 'admin@gmail.com', 'administrador', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `client_id` int(5) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `client_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`client_id`, `first_name`, `last_name`, `phone_number`, `client_email`) VALUES
(44, 'maria', 'rodriguez', '4121367868', 'maria@gmail.com'),
(45, 'emilio', 'salaverria', '4121367868', 'salaverria1@gmail.com'),
(46, 'keyla', 'lastra', '4121367868', 'keyla_lastra@hotmail.com'),
(47, 'carolina', 'gonzalez', '4121367868', 'carolinagonzalez@hotmail.com'),
(48, '', '', '', ''),
(49, 'mariana', 'lopez', '7865387629', 'mariasalazar@gmail.com'),
(50, 'rosa', 'Salaverria', '7865387629', 'rosa_salaverria@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(2) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `phone_number`, `email`) VALUES
(5, 'maria', 'Linarez', '7865387629', 'marialinares@gmail.com'),
(6, 'Paola', 'Nuñez', '7865387629', 'Paolanuñez@gmail.com'),
(7, 'Emily', 'Tarantino', '7865387629', 'emilytarantino@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees_schedule`
--

CREATE TABLE `employees_schedule` (
  `id` int(5) NOT NULL,
  `employee_id` int(2) NOT NULL,
  `day_id` tinyint(1) NOT NULL,
  `from_hour` time NOT NULL,
  `to_hour` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employees_schedule`
--

INSERT INTO `employees_schedule` (`id`, `employee_id`, `day_id`, `from_hour`, `to_hour`) VALUES
(46, 6, 1, '10:00:00', '14:30:00'),
(47, 6, 2, '10:00:00', '15:00:00'),
(48, 6, 3, '10:00:00', '15:00:00'),
(49, 6, 4, '10:00:00', '15:00:00'),
(50, 6, 5, '10:00:00', '15:00:00'),
(51, 6, 6, '10:00:00', '16:00:00'),
(52, 6, 7, '10:00:00', '16:00:00'),
(53, 5, 1, '10:00:00', '14:30:00'),
(54, 5, 2, '10:00:00', '22:00:00'),
(55, 5, 3, '10:00:00', '16:00:00'),
(56, 7, 1, '10:00:00', '17:00:00'),
(57, 7, 2, '10:00:00', '17:00:00'),
(58, 7, 3, '10:00:00', '17:00:00'),
(59, 7, 4, '10:00:00', '17:00:00'),
(60, 7, 5, '10:00:00', '17:00:00'),
(61, 7, 6, '10:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `monto`) VALUES
(1, '5000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `service_id` int(5) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `service_description` varchar(255) NOT NULL,
  `service_price` decimal(10,2) NOT NULL,
  `service_duration` int(5) NOT NULL,
  `category_id` int(2) NOT NULL,
  `child_id` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_description`, `service_price`, `service_duration`, `category_id`, `child_id`) VALUES
(13, 'Manicure Esmaltado Semi Permanente', 'Esmaltado Semi Permanente', '15990.00', 90, 11, 13),
(14, 'Manicure Esmaltado Gel Permanente', 'Esmaltado  Gel Permanente', '19990.00', 90, 11, 13),
(15, 'Manicure Baño Gel', 'Baño Gel', '30990.00', 180, 11, 0),
(16, 'Manicure Extension Gel', 'Extension Gel', '46990.00', 180, 11, 0),
(17, 'Manicure Tratamiento IBX', 'Tratamiento IBX', '7990.00', 30, 11, 0),
(18, 'Manicure Parche Gel', 'Parche Gel', '3990.00', 30, 11, 0),
(19, 'Pedicure Embellecimiento de Pies', 'Embellecimiento de Pies', '16990.00', 180, 12, 0),
(20, 'Pedicure Esmaltado Semi Permanente', 'Esmaltado Semi Permanente', '18990.00', 180, 12, 0),
(21, 'Pedicure Esmaltado Gel (permanente)', 'Esmaltado Gel (permanente)', '22990.00', 180, 12, 0),
(22, 'Pedicure Parche Gel', 'Parche Gel', '4990.00', 30, 12, 0),
(23, 'Lifting de Pestañas', 'Pestañas', '29990.00', 30, 14, 0),
(24, 'Perfilado de Cejas', 'Cejas', '15990.00', 30, 14, 0),
(25, 'Laminado de Cejas', 'Cejas', '34990.00', 60, 14, 0),
(26, 'Limpieza Facial Profunda', 'Facial Profunda', '45990.00', 180, 14, 0),
(27, 'Masaje Reductivo (Abdomen , Contorno Brazos)', 'Masaje Reductivo', '28000.00', 60, 15, 0),
(28, 'Masaje Reductivo (Piernas y Gluteos)', 'Masaje Reductivo', '28000.00', 90, 15, 0),
(29, 'Masaje Reductivo (Cuerpo Completo)', 'Masaje Reductivo', '37000.00', 120, 15, 0),
(30, 'Masaje Relajacion 30min', 'Masaje Relajacion', '24990.00', 30, 15, 0),
(31, 'Manicure Embellecimiento de Manos', 'Embellecimiento de Manos', '12990.00', 60, 11, 0),
(32, 'Masaje Relajacion 60 min', 'Masaje Relajacion', '34990.00', 60, 15, 0),
(33, 'Masaje Drenaje 10 Sesiones', '10 Sesiones', '240000.00', 60, 15, 0),
(34, 'Diseño 1', 'Diseños 1', '4990.00', 30, 13, 0),
(35, 'Diseño 2', 'Diseños 2', '4990.00', 30, 13, 0),
(36, 'Diseño 3', 'Diseños 3', '4990.00', 30, 13, 0),
(37, 'Rebaje Normal', 'Rebaje Normal', '12000.00', 30, 15, 0),
(38, 'Rebaje full', 'Rebaje full', '25000.00', 30, 15, 0),
(39, 'Depilación Axila', 'Depilación Axila', '4000.00', 30, 15, 0),
(40, 'Depilacion Brazo Entero', 'Brazo Entero', '6990.00', 30, 15, 0),
(41, 'Depilación Pierna Completa', 'Pierna Completa', '7990.00', 30, 15, 0),
(42, 'Bronceado', 'Bronceado', '34990.00', 30, 15, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_booked`
--

CREATE TABLE `services_booked` (
  `appointment_id` int(5) DEFAULT NULL,
  `service_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_categories`
--

CREATE TABLE `service_categories` (
  `category_id` int(2) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `service_categories`
--

INSERT INTO `service_categories` (`category_id`, `category_name`) VALUES
(11, 'Manicure'),
(12, 'Pedicure'),
(13, 'Diseños'),
(14, 'Faciales'),
(15, 'Corporales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tempory_appoinments`
--

CREATE TABLE `tempory_appoinments` (
  `id` int(11) NOT NULL,
  `appoinments_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `complementary_id` int(11) NOT NULL DEFAULT 0,
  `child_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `FK_client_appointment` (`client_id`),
  ADD KEY `FK_employee_appointment` (`employee_id`);

--
-- Indices de la tabla `barber_admin`
--
ALTER TABLE `barber_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_email` (`client_email`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indices de la tabla `employees_schedule`
--
ALTER TABLE `employees_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_emp` (`employee_id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `FK_service_category` (`category_id`);

--
-- Indices de la tabla `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indices de la tabla `tempory_appoinments`
--
ALTER TABLE `tempory_appoinments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `barber_admin`
--
ALTER TABLE `barber_admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `employees_schedule`
--
ALTER TABLE `employees_schedule`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tempory_appoinments`
--
ALTER TABLE `tempory_appoinments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `employees_schedule`
--
ALTER TABLE `employees_schedule`
  ADD CONSTRAINT `FK_emp` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_service_category` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`category_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

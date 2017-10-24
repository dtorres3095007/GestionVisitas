-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2017 a las 16:29:01
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestionvisitas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_por_perfil`
--

CREATE TABLE `actividades_por_perfil` (
  `id` int(11) NOT NULL,
  `id_perfil` varchar(50) NOT NULL,
  `id_actividad` varchar(50) NOT NULL,
  `agrega` tinyint(1) DEFAULT '0',
  `elimina` tinyint(1) DEFAULT '0',
  `modifica` tinyint(1) DEFAULT '0',
  `amplia` tinyint(1) DEFAULT '0',
  `cambia_tabla` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades_por_perfil`
--

INSERT INTO `actividades_por_perfil` (`id`, `id_perfil`, `id_actividad`, `agrega`, `elimina`, `modifica`, `amplia`, `cambia_tabla`) VALUES
(1, 'Admin', 'Usuarios', 1, 1, 1, 1, 1),
(2, 'Admin', 'Parametros', 1, 1, 1, 1, 1),
(4, 'Admin', 'Visitantes', 1, 1, 1, 1, 1),
(5, 'Admin', 'Visitados', 1, 1, 1, 1, 1),
(6, 'Admin', 'ReservaVisita', 1, 1, 1, 1, 1),
(9, 'Admin', 'Visita', 1, 1, 1, 1, 1),
(10, 'Admin', 'ReportesVisitas', 1, 1, 1, 1, 1),
(11, 'Admin', 'Eventos', 1, 1, 1, 1, 1),
(12, 'Admin', 'Actividades_Perfil', 1, 1, 1, 1, 1),
(13, 'Admin', 'Personalizar_Menu', 1, 1, 1, 1, 1),
(16, 'SecreUser', 'ReservaVisita', 1, 1, 1, 0, 0),
(17, 'SecreUser', 'Eventos', 1, 1, 1, 0, 0),
(18, 'SecreUser', 'Visitantes', 1, 0, 0, 0, 0),
(19, 'VisitadoUser', 'Visitantes', 1, 0, 0, 0, 0),
(20, 'VisitadoUser', 'ReservaVisita', 1, 1, 1, 0, 0),
(21, 'VisitadoUser', 'Eventos', 1, 1, 1, 0, 0),
(22, 'UserRep', 'Visitantes', 1, 1, 1, 0, 0),
(23, 'UserRep', 'Visita', 1, 1, 1, 0, 0),
(24, 'UserRep', 'Visitados', 0, 0, 0, 0, 0),
(25, 'Admin', 'My_Perfil', 0, 0, 1, 1, 0),
(26, 'SecreUser', 'My_Perfil', 0, 0, 1, 1, 0),
(27, 'UserRep', 'My_Perfil', 0, 0, 1, 1, 0),
(28, 'Admin', 'Manejo_Versiones', 1, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `comentario` varchar(80) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_visita` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `comentario`, `id_usuario`, `id_visita`, `fecha`) VALUES
(1, 'fgtrhrsth', 1, 3, '2017-03-16 12:05:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Hora_Inicio` datetime NOT NULL,
  `Hora_Fin` datetime NOT NULL,
  `Duracion` text NOT NULL,
  `Estado_evento` varchar(30) NOT NULL DEFAULT 'EveReg',
  `Ubicacion` varchar(50) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `Cupos` int(11) DEFAULT NULL,
  `Preinscripcion` tinyint(1) DEFAULT '0',
  `Id_Usuario_Crea` int(11) NOT NULL DEFAULT '0',
  `Fecha_Creacion` datetime NOT NULL,
  `id_siru` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`Id`, `Nombre`, `Descripcion`, `Hora_Inicio`, `Hora_Fin`, `Duracion`, `Estado_evento`, `Ubicacion`, `Estado`, `Cupos`, `Preinscripcion`, `Id_Usuario_Crea`, `Fecha_Creacion`, `id_siru`) VALUES
(1, 'ReuniÃ³n planes de asignatura', 'Ninguna', '2017-03-15 16:30:00', '2017-03-15 20:00:00', '0:03:30:00 ', 'EveTer', 'Salon Oasis, Bloque 1', 1, 10000, 0, 1, '2017-03-15 08:18:48', 88295),
(2, 'CAPACITACION - NEGOCIOS VERDES - BIO EXPO 2017 ', 'Ninguna', '2017-03-15 08:00:00', '2017-03-15 12:00:00', '0:04:00:00 ', 'EveCur', 'Salon Oasis, Bloque 1', 1, 10000, 0, 3, '2017-03-15 08:20:03', 85736),
(3, 'SERVICIO CONSULTA ESPECIALIZADA', 'Ninguna', '2017-03-15 14:00:00', '2017-03-15 18:00:00', '0:04:00:00 ', 'EveReg', 'Sala 13, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:19', 75523),
(4, 'CapacitaciÃ³n Consulta Especializada', 'Ninguna', '2017-03-15 07:00:00', '2017-03-15 09:00:00', '0:02:00:00 ', 'EveCur', 'Sala 13, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:19', 87571),
(5, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 10:30:00', '0:04:00:00 ', 'EveCur', 'Sala 14, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:20', 80200),
(6, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 13:30:00', '2017-03-15 18:00:00', '0:04:30:00 ', 'EveReg', 'Sala 14, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:20', 80238),
(7, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 18:00:00', '0:11:30:00 ', 'EveCur', 'Sala 5, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:20', 80319),
(8, 'ESPACIO ABIERTO ING. INDUSTRIAL ', 'Ninguna', '2017-03-15 18:30:00', '2017-03-15 21:30:00', '0:03:00:00 ', 'EveReg', '2407, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:20', 85696),
(9, 'jornada de capacitaciÃ³n singapur', 'Ninguna', '2017-03-15 07:00:00', '2017-03-15 18:00:00', '0:11:00:00 ', 'EveCur', '2407, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:20', 77689),
(10, 'ESPACIO ABIERTO ING. INDUSTRIAL ', 'Ninguna', '2017-03-15 18:30:00', '2017-03-15 21:30:00', '0:03:00:00 ', 'EveReg', '2408, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:20', 85695),
(11, 'jornada de capacitaciÃ³n metodo singapur', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 18:00:00', '0:11:30:00 ', 'EveCur', '2408, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:20', 77838),
(12, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 18:00:00', '0:11:30:00 ', 'EveCur', 'Sala 6, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:20', 80438),
(13, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 10:30:00', '2017-03-15 12:00:00', '0:01:30:00 ', 'EveReg', 'Sala 7, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:20', 80520),
(14, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', 'Sala 9, Bloque 2', 1, 10000, 0, 0, '2017-03-15 08:33:20', 80030),
(15, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', '3201, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:20', 78513),
(16, 'asesoria cristian', 'Ninguna', '2017-03-15 14:30:00', '2017-03-15 16:30:00', '0:02:00:00 ', 'EveReg', '3301, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 87787),
(17, 'ASESORIA MARLON', 'Ninguna', '2017-03-15 09:30:00', '2017-03-15 11:30:00', '0:02:00:00 ', 'EveReg', '3301, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 87731),
(18, 'ASESORIA DAVID', 'Ninguna', '2017-03-15 08:30:00', '2017-03-15 10:30:00', '0:02:00:00 ', 'EveCur', '3302, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 87685),
(19, 'ASESORIA CARLOS ', 'Ninguna', '2017-03-15 13:30:00', '2017-03-15 16:00:00', '0:02:30:00 ', 'EveReg', '3303, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 87772),
(20, 'ASESORIA ELVIS', 'Ninguna', '2017-03-15 17:00:00', '2017-03-15 18:30:00', '0:01:30:00 ', 'EveReg', '3303, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 87797),
(21, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 18:00:00', '0:11:30:00 ', 'EveCur', '3407, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 78840),
(22, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', '3408, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 78922),
(23, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', '3409, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 79025),
(24, 'ASESORIA KENEDY', 'Ninguna', '2017-03-15 08:30:00', '2017-03-15 10:30:00', '0:02:00:00 ', 'EveCur', '3409, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 87695),
(25, 'ASESORIA JHON', 'Ninguna', '2017-03-15 10:30:00', '2017-03-15 12:00:00', '0:01:30:00 ', 'EveReg', '3409, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 87741),
(26, 'ASESORIA JULIANA ', 'Ninguna', '2017-03-15 17:30:00', '2017-03-15 18:30:00', '0:01:00:00 ', 'EveReg', '3410, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 87807),
(27, 'ASESORIA VICTOR', 'Ninguna', '2017-03-15 10:30:00', '2017-03-15 12:00:00', '0:01:30:00 ', 'EveReg', '3411, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:21', 87751),
(28, 'asesoria christian', 'Ninguna', '2017-03-15 14:00:00', '2017-03-15 15:30:00', '0:01:30:00 ', 'EveReg', '3411, Bloque 3', 1, 10000, 0, 0, '2017-03-15 08:33:22', 87762),
(29, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', '8401, Bloque 8', 1, 10000, 0, 0, '2017-03-15 08:33:22', 79252),
(30, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 18:00:00', '0:11:30:00 ', 'EveCur', '8402, Bloque 8', 1, 10000, 0, 0, '2017-03-15 08:33:22', 79333),
(31, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 18:00:00', '0:11:30:00 ', 'EveCur', '8403, Bloque 8', 1, 10000, 0, 0, '2017-03-15 08:33:22', 79436),
(32, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 18:00:00', '0:11:30:00 ', 'EveCur', '8502, Bloque 8', 1, 10000, 0, 0, '2017-03-15 08:33:22', 79561),
(33, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 12:00:00', '0:05:30:00 ', 'EveCur', '8503, Bloque 8', 1, 10000, 0, 0, '2017-03-15 08:33:22', 79664),
(34, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 12:00:00', '0:05:30:00 ', 'EveCur', '8504, Bloque 8', 1, 10000, 0, 0, '2017-03-15 08:33:22', 79745),
(35, 'REUNIÃ“N - LUISA CABALLERO', 'Ninguna', '2017-03-15 14:00:00', '2017-03-15 17:00:00', '0:03:00:00 ', 'EveReg', 'Sala 11, Bloque 8', 1, 10000, 0, 0, '2017-03-15 08:33:22', 88276),
(36, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', '9203, Bloque 9', 1, 10000, 0, 0, '2017-03-15 08:33:22', 80663),
(37, 'ReuniÃ³n de grupo estudiantil', 'Ninguna', '2017-03-15 15:00:00', '2017-03-15 16:30:00', '0:01:30:00 ', 'EveReg', '9302, Bloque 9', 1, 10000, 0, 0, '2017-03-15 08:33:22', 84042),
(38, 'ASESORIA NICOLAS', 'Ninguna', '2017-03-15 09:30:00', '2017-03-15 10:30:00', '0:01:00:00 ', 'EveReg', '9302, Bloque 9', 1, 10000, 0, 0, '2017-03-15 08:33:22', 87697),
(39, 'ReuniÃ³n de grupo estudiantil', 'Ninguna', '2017-03-15 10:00:00', '2017-03-15 11:30:00', '0:01:30:00 ', 'EveReg', '9303, Bloque 9', 1, 10000, 0, 0, '2017-03-15 08:33:22', 84058),
(40, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-15 12:00:00', '2017-03-15 18:00:00', '0:06:00:00 ', 'EveReg', '9303, Bloque 9', 1, 10000, 0, 0, '2017-03-15 08:33:22', 80814),
(41, 'ReuniÃ³n grupo Estudiantil a solas con JesÃºs', 'Ninguna', '2017-03-15 13:30:00', '2017-03-15 15:30:00', '0:02:00:00 ', 'EveReg', '9402, Bloque 9', 1, 10000, 0, 0, '2017-03-15 08:33:23', 84653),
(42, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', '9403, Bloque 9', 1, 10000, 0, 0, '2017-03-15 08:33:23', 81001),
(43, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', '9404, Bloque 9', 1, 10000, 0, 0, '2017-03-15 08:33:23', 81062),
(44, 'logistica foro Mujer y Deporte', 'Ninguna', '2017-03-15 14:00:00', '2017-03-15 18:30:00', '0:04:30:00 ', 'EveReg', '9202, Bloque 9', 1, 10000, 0, 0, '2017-03-15 08:33:23', 88175),
(45, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 18:00:00', '0:11:30:00 ', 'EveCur', 'E101, E', 1, 10000, 0, 0, '2017-03-15 08:33:23', 79835),
(46, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', 'E102, E', 1, 10000, 0, 0, '2017-03-15 08:33:23', 79934),
(47, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', 'E103, E', 1, 10000, 0, 0, '2017-03-15 08:33:23', 81105),
(48, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', 'E104, E', 1, 10000, 0, 0, '2017-03-15 08:33:23', 81126),
(49, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-15 12:30:00', '2017-03-15 18:00:00', '0:05:30:00 ', 'EveReg', 'E105, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 81147),
(50, 'Oferta AcadÃ©mica Multidiomas C-10', 'Ninguna', '2017-03-15 18:30:00', '2017-03-15 21:30:00', '0:03:00:00 ', 'EveReg', 'E107, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 86856),
(51, 'Oferta AcadÃ©mica', 'Ninguna', '2017-03-15 18:30:00', '2017-03-15 21:30:00', '0:03:00:00 ', 'EveReg', 'E108, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 55750),
(52, 'Bienestar Sena', 'Ninguna', '2017-03-15 14:00:00', '2017-03-15 17:00:00', '0:03:00:00 ', 'EveReg', 'E108, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 88013),
(53, 'Oferta AcadÃ©mica', 'Ninguna', '2017-03-15 18:30:00', '2017-03-15 21:30:00', '0:03:00:00 ', 'EveReg', 'E109, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 56053),
(54, 'jornada de capacitaciÃ³n singapur', 'Ninguna', '2017-03-15 14:30:00', '2017-03-15 18:30:00', '0:04:00:00 ', 'EveReg', 'E132, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 78255),
(55, 'jornada de capacitaciÃ³n singapur', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 11:30:00', '0:05:00:00 ', 'EveCur', 'E132, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 78254),
(56, 'Oferta AcadÃ©mica', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 21:30:00', '0:15:00:00 ', 'EveCur', 'E139, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 85277),
(57, 'jornada de capacitaciÃ³n singapur', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 18:00:00', '0:11:30:00 ', 'EveCur', 'E140, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 78277),
(58, 'Actividades Bienestar Estudiantil ', 'Ninguna', '2017-03-15 08:00:00', '2017-03-15 21:30:00', '0:13:30:00 ', 'EveCur', 'MOV001, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 81305),
(59, 'Actividades Bienestar Estudiantil', 'Ninguna', '2017-03-15 08:00:00', '2017-03-15 21:30:00', '0:13:30:00 ', 'EveCur', 'MOV002, E', 1, 10000, 0, 0, '2017-03-15 08:33:24', 81617),
(60, 'Actividades Bienestar Estudiantil', 'Ninguna', '2017-03-15 18:00:00', '2017-03-15 20:30:00', '0:02:30:00 ', 'EveReg', 'MOV005, E', 1, 10000, 0, 0, '2017-03-15 08:33:25', 83419),
(61, 'Actividades de Bienestar Estudiantil', 'Ninguna', '2017-03-15 08:30:00', '2017-03-15 18:00:00', '0:09:30:00 ', 'EveCur', 'MOV005, E', 1, 10000, 0, 0, '2017-03-15 08:33:25', 83273),
(62, 'Actividades Bienestar Estudiantil', 'Ninguna', '2017-03-15 08:30:00', '2017-03-15 18:30:00', '0:10:00:00 ', 'EveCur', 'MOV006, E', 1, 10000, 0, 0, '2017-03-15 08:33:25', 83353),
(63, 'ESPACIO ABIERTO PSICOLOGÃA', 'Ninguna', '2017-03-15 16:30:00', '2017-03-15 18:30:00', '0:02:00:00 ', 'EveReg', 'Coliseo de Competencias, X', 1, 10000, 0, 0, '2017-03-15 08:33:25', 84635),
(64, 'CONFERENCIA \"SOY MUJER\" ', 'Ninguna', '2017-03-15 14:30:00', '2017-03-15 16:30:00', '0:02:00:00 ', 'EveReg', 'Coliseo de Competencias, X', 1, 10000, 0, 0, '2017-03-15 08:33:25', 87301),
(65, 'CLASES DE BALONCESTO LIBRES Y SELECCION', 'Ninguna', '2017-03-15 12:00:00', '2017-03-15 15:00:00', '0:03:00:00 ', 'EveReg', 'Cancha Multiple, X', 1, 10000, 0, 0, '2017-03-15 08:33:25', 82453),
(66, 'CLASES DE BALONCESTO LIBRES Y SELECCION', 'Ninguna', '2017-03-15 19:00:00', '2017-03-15 21:00:00', '0:02:00:00 ', 'EveReg', 'Cancha Multiple, X', 1, 10000, 0, 0, '2017-03-15 08:33:25', 82492),
(67, 'TORNEO INTERNO', 'Ninguna', '2017-03-15 09:00:00', '2017-03-15 12:00:00', '0:03:00:00 ', 'EveReg', 'Cancha Multiple, X', 1, 10000, 0, 0, '2017-03-15 08:33:25', 83068),
(68, 'TORNEO INTERNO', 'Ninguna', '2017-03-15 15:00:00', '2017-03-15 19:00:00', '0:04:00:00 ', 'EveReg', 'Cancha Multiple, X', 1, 10000, 0, 0, '2017-03-15 08:33:25', 83095),
(69, 'ESPACIO ABIERTO ING. INDUSTRIAL ', 'Ninguna', '2017-03-15 09:00:00', '2017-03-15 12:30:00', '0:03:30:00 ', 'EveReg', 'sala de conferencias 1, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:25', 85697),
(70, 'Oferta AcadÃ©mica', 'Ninguna', '2017-03-15 14:30:00', '2017-03-15 18:30:00', '0:04:00:00 ', 'EveReg', 'sala 20, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:25', 85601),
(71, 'oferta academica', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 08:30:00', '0:02:00:00 ', 'EveTer', 'sala 20, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:25', 85551),
(72, 'CONTABILIDAD DE COSTOS ', 'Ninguna', '2017-03-15 18:30:00', '2017-03-15 21:30:00', '0:03:00:00 ', 'EveReg', 'sala 20, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:25', 86665),
(73, 'Curso Complementario EstadÃ­stica Aplicada', 'Ninguna', '2017-03-15 14:00:00', '2017-03-15 16:00:00', '0:02:00:00 ', 'EveReg', 'SALA 23, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:25', 83494),
(74, 'CapacitaciÃ³n para docentes para manejo de base de', 'Ninguna', '2017-03-15 15:30:00', '2017-03-15 17:00:00', '0:01:30:00 ', 'EveReg', 'sala 28, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:26', 88201),
(75, 'CapacitaciÃ³n para docentes para manejo de base de', 'Ninguna', '2017-03-15 10:00:00', '2017-03-15 12:00:00', '0:02:00:00 ', 'EveReg', 'sala 28, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:26', 88200),
(76, 'RECUPERACIÃ“N DE CLASES LUZ CHIVETTA', 'Ninguna', '2017-03-15 17:30:00', '2017-03-15 21:30:00', '0:04:00:00 ', 'EveReg', '11505, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:26', 88197),
(77, 'Clase Termodinamica', 'Ninguna', '2017-03-15 18:30:00', '2017-03-15 21:30:00', '0:03:00:00 ', 'EveReg', '11609, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:26', 85908),
(78, 'clase', 'Ninguna', '2017-03-15 06:30:00', '2017-03-15 12:30:00', '0:06:00:00 ', 'EveCur', '11705, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:26', 87517),
(79, 'LOGISTICA INTEGRAL', 'Ninguna', '2017-03-15 14:30:00', '2017-03-15 18:30:00', '0:04:00:00 ', 'EveReg', '11707, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:26', 86568),
(80, 'LogÃ­stica Integral', 'Ninguna', '2017-03-15 15:00:00', '2017-03-15 18:30:00', '0:03:30:00 ', 'EveReg', '11710, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:26', 87703),
(81, 'DANIEL CASTANEDA ', 'Ninguna', '2017-03-15 08:00:00', '2017-03-15 18:00:00', '0:10:00:00 ', 'EveCur', '11102, Bloque 11', 1, 10000, 0, 0, '2017-03-15 08:33:26', 87698),
(82, 'prueba', 'nonn', '2017-03-15 09:35:00', '2017-03-15 11:35:00', '0:02:00:00 ', 'EveTer', '90', 1, 500, 1, 1, '2017-03-15 08:37:48', NULL),
(83, 'GRUPOS FOCALES', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 16:00:00', '0:09:30:00 ', 'EveTer', 'Salon Oasis, Bloque 1', 1, 10000, 1, 0, '2017-03-16 09:45:03', 88320),
(84, 'clase de investigacion en arquitectura', 'Ninguna', '2017-03-16 09:30:00', '2017-03-16 12:30:00', '0:03:00:00 ', 'EveTer', 'Sala 14, Bloque 2', 1, 10000, 0, 0, '2017-03-16 09:45:03', 85493),
(85, 'CONSTRUCCIÃ“N TEXTUAL', 'Ninguna', '2017-03-16 10:30:00', '2017-03-16 12:30:00', '0:02:00:00 ', 'EveTer', 'Sala 13, Bloque 2', 1, 10000, 0, 0, '2017-03-16 09:45:03', 86017),
(86, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', 'Sala 5, Bloque 2', 1, 10000, 0, 0, '2017-03-16 09:45:03', 80341),
(87, 'jornada de capacitaciÃ³n singapur', 'Ninguna', '2017-03-16 07:00:00', '2017-03-16 18:00:00', '0:11:00:00 ', 'EveCur', '2407, Bloque 2', 1, 10000, 0, 0, '2017-03-16 09:45:04', 77690),
(88, 'SERVICIO CONSULTA ESPECIALIZADA', 'Ninguna', '2017-03-16 14:00:00', '2017-03-16 18:00:00', '0:04:00:00 ', 'EveCur', 'Sala 13, Bloque 2', 1, 10000, 0, 0, '2017-03-16 09:45:04', 75540),
(89, 'REUNIÃ“N PRIMER SEMESTRE', 'Ninguna', '2017-03-16 18:00:00', '2017-03-16 21:30:00', '0:03:30:00 ', 'EveReg', '2407, Bloque 2', 1, 10000, 0, 0, '2017-03-16 09:45:04', 88173),
(90, 'jornada de capacitaciÃ³n metodo singapur', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', '2408, Bloque 2', 1, 10000, 0, 0, '2017-03-16 09:45:04', 77839),
(91, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', 'Sala 6, Bloque 2', 1, 10000, 0, 0, '2017-03-16 09:45:04', 80460),
(92, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 13:30:00', '2017-03-16 18:00:00', '0:04:30:00 ', 'EveCur', 'Sala 9, Bloque 2', 1, 10000, 0, 0, '2017-03-16 09:45:04', 80178),
(93, 'Clase principios de diseÃ±o urbano', 'Ninguna', '2017-03-16 09:30:00', '2017-03-16 12:30:00', '0:03:00:00 ', 'EveTer', 'Sala 9, Bloque 2', 1, 10000, 0, 0, '2017-03-16 09:45:04', 88402),
(94, 'EVENTO MES DE LA MUJER-FERIA DE BELLEZA', 'Ninguna', '2017-03-16 08:00:00', '2017-03-16 10:00:00', '0:02:00:00 ', 'EveTer', '3202, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:04', 85824),
(95, 'EVENTO MES DE LA MUJER-FERIA DE BELLEZA', 'Ninguna', '2017-03-16 10:00:00', '2017-03-16 15:30:00', '0:05:30:00 ', 'EveTer', '3202, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:04', 85228),
(96, 'EVENTO MES DE LA MUJER-FERIA DE BELLEZA', 'Ninguna', '2017-03-16 08:00:00', '2017-03-16 15:30:00', '0:07:30:00 ', 'EveTer', '3207, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:04', 84963),
(97, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 18:00:00', '0:05:30:00 ', 'EveCur', '3201, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:04', 78522),
(98, 'EVENTO MES DE LA MUJER-FERIA DE BELLEZA', 'Ninguna', '2017-03-16 09:30:00', '2017-03-16 15:30:00', '0:06:00:00 ', 'EveTer', '3211, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:05', 86008),
(99, 'EVENTO MES DE LA MUJER-FERIA DE BELLEZA', 'Ninguna', '2017-03-16 09:00:00', '2017-03-16 16:30:00', '0:07:30:00 ', 'EveTer', '3301, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:05', 84964),
(100, 'EVENTO MES DE LA MUJER-FERIA DE BELLEZA', 'Ninguna', '2017-03-16 09:30:00', '2017-03-16 15:30:00', '0:06:00:00 ', 'EveTer', '3302, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:05', 84965),
(101, 'asesoria', 'Ninguna', '2017-03-16 16:00:00', '2017-03-16 17:30:00', '0:01:30:00 ', 'EveTer', '3302, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:05', 85860),
(102, 'EVENTO FERIA DE LA BELLEZA', 'Ninguna', '2017-03-16 08:00:00', '2017-03-16 09:30:00', '0:01:30:00 ', 'EveTer', '3302, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:05', 88364),
(103, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 18:00:00', '0:05:30:00 ', 'EveCur', '3303, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:05', 78698),
(104, 'ASESORIA ALONSO', 'Ninguna', '2017-03-16 09:30:00', '2017-03-16 11:30:00', '0:02:00:00 ', 'EveTer', '3303, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:05', 87837),
(105, 'induccion', 'Ninguna', '2017-03-16 09:30:00', '2017-03-16 12:00:00', '0:02:30:00 ', 'EveTer', '3304, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:06', 87863),
(106, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', '3407, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:06', 78862),
(107, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 18:30:00', '0:06:00:00 ', 'EveCur', '3409, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:06', 79047),
(108, 'ReuniÃ³n Estudiantil', 'Ninguna', '2017-03-16 16:00:00', '2017-03-16 18:00:00', '0:02:00:00 ', 'EveCur', '3410, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:06', 87853),
(109, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', '3411, Bloque 3', 1, 10000, 0, 0, '2017-03-16 09:45:06', 79171),
(110, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 18:00:00', '0:05:30:00 ', 'EveCur', '8401, Bloque 8', 1, 10000, 0, 0, '2017-03-16 09:45:06', 79273),
(111, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', '8402, Bloque 8', 1, 10000, 0, 0, '2017-03-16 09:45:06', 79355),
(112, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', '8403, Bloque 8', 1, 10000, 0, 0, '2017-03-16 09:45:06', 79458),
(113, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 12:00:00', '0:05:30:00 ', 'EveTer', '8404, Bloque 8', 1, 10000, 0, 0, '2017-03-16 09:45:06', 79502),
(114, 'ASESORIA ORLANDO', 'Ninguna', '2017-03-16 17:00:00', '2017-03-16 18:30:00', '0:01:30:00 ', 'EveCur', '8404, Bloque 8', 1, 10000, 0, 0, '2017-03-16 09:45:06', 87908),
(115, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', '8502, Bloque 8', 1, 10000, 0, 0, '2017-03-16 09:45:06', 79583),
(116, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', '8503, Bloque 8', 1, 10000, 0, 0, '2017-03-16 09:45:06', 79686),
(117, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 12:00:00', '0:05:30:00 ', 'EveTer', '8504, Bloque 8', 1, 10000, 0, 0, '2017-03-16 09:45:06', 79767),
(118, 'capacitaciÃ³n mendeli', 'Ninguna', '2017-03-16 09:00:00', '2017-03-16 12:30:00', '0:03:30:00 ', 'EveTer', 'Sala 12, Bloque 8', 1, 10000, 0, 0, '2017-03-16 09:45:06', 88390),
(119, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 18:00:00', '0:05:30:00 ', 'EveCur', '9203, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 80684),
(120, 'ASESORIA GUILLERMO', 'Ninguna', '2017-03-16 08:30:00', '2017-03-16 10:30:00', '0:02:00:00 ', 'EveTer', '9203, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 87827),
(121, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 18:00:00', '0:05:30:00 ', 'EveCur', '9301, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 80726),
(122, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-16 12:00:00', '2017-03-16 18:00:00', '0:06:00:00 ', 'EveCur', '9302, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 80768),
(123, 'ASESORIA INGRID', 'Ninguna', '2017-03-16 13:30:00', '2017-03-16 14:30:00', '0:01:00:00 ', 'EveTer', '9303, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 87866),
(124, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-16 15:30:00', '2017-03-16 18:00:00', '0:02:30:00 ', 'EveCur', '9303, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 80835),
(125, 'ASESORIA MARGARITA', 'Ninguna', '2017-03-16 16:30:00', '2017-03-16 18:00:00', '0:01:30:00 ', 'EveCur', '9304, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 87895),
(126, 'ReuniÃ³n grupo Estudiantil a solas con JesÃºs', 'Ninguna', '2017-03-16 13:30:00', '2017-03-16 15:30:00', '0:02:00:00 ', 'EveTer', '9402, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 84667),
(127, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 15:30:00', '0:03:00:00 ', 'EveTer', '9403, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 80980),
(128, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 18:00:00', '0:05:30:00 ', 'EveCur', '9404, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 81083),
(129, 'ACTIVIDAD FISICA', 'Ninguna', '2017-03-16 16:00:00', '2017-03-16 18:30:00', '0:02:30:00 ', 'EveCur', '9502, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 88366),
(130, 'TOMA DE MEDIDA UNIFORMES ', 'Ninguna', '2017-03-16 14:30:00', '2017-03-16 16:30:00', '0:02:00:00 ', 'EveTer', '9503, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:07', 88379),
(131, 'TOMA DE MEDIDA UNIFORMES ', 'Ninguna', '2017-03-16 14:30:00', '2017-03-16 16:30:00', '0:02:00:00 ', 'EveTer', '9504, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:08', 88380),
(132, 'ASESORIA LUIS', 'Ninguna', '2017-03-16 14:30:00', '2017-03-16 16:30:00', '0:02:00:00 ', 'EveTer', '9201, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:08', 87877),
(133, 'ASESORIA MAYELIN', 'Ninguna', '2017-03-16 16:30:00', '2017-03-16 18:30:00', '0:02:00:00 ', 'EveCur', '9201, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:08', 87918),
(134, 'Oferta Academica CUC - SENA ', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 18:00:00', '0:05:30:00 ', 'EveCur', '9202, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:08', 80607),
(135, 'ASESORIA JONATHAN', 'Ninguna', '2017-03-16 07:30:00', '2017-03-16 09:30:00', '0:02:00:00 ', 'EveTer', '9202, Bloque 9', 1, 10000, 0, 0, '2017-03-16 09:45:08', 87817),
(136, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 18:00:00', '0:05:30:00 ', 'EveCur', 'E101, E', 1, 10000, 0, 0, '2017-03-16 09:45:08', 79844),
(137, 'oferta academica CUC - SENA', 'Ninguna', '2017-03-16 12:30:00', '2017-03-16 18:00:00', '0:05:30:00 ', 'EveCur', 'E102, E', 1, 10000, 0, 0, '2017-03-16 09:45:08', 79943),
(138, 'Oferta AcadÃ©mica Multidiomas C-10', 'Ninguna', '2017-03-16 18:30:00', '2017-03-16 21:30:00', '0:03:00:00 ', 'EveReg', 'E107, E', 1, 10000, 0, 0, '2017-03-16 09:45:09', 86857),
(139, 'Oferta AcadÃ©mica', 'Ninguna', '2017-03-16 18:30:00', '2017-03-16 21:30:00', '0:03:00:00 ', 'EveReg', 'E108, E', 1, 10000, 0, 0, '2017-03-16 09:45:09', 55751),
(140, 'Oferta AcadÃ©mica', 'Ninguna', '2017-03-16 18:30:00', '2017-03-16 21:30:00', '0:03:00:00 ', 'EveReg', 'E109, E', 1, 10000, 0, 0, '2017-03-16 09:45:09', 56054),
(141, 'jornada de capacitaciÃ³n singapur', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', 'E132, E', 1, 10000, 0, 0, '2017-03-16 09:45:09', 78256),
(142, 'Oferta AcadÃ©mica', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 21:30:00', '0:15:00:00 ', 'EveCur', 'E139, E', 1, 10000, 0, 0, '2017-03-16 09:45:09', 85233),
(143, 'jornada de capacitaciÃ³n singapur', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 18:00:00', '0:11:30:00 ', 'EveCur', 'E140, E', 1, 10000, 0, 0, '2017-03-16 09:45:09', 78278),
(144, 'Actividades Bienestar Estudiantil ', 'Ninguna', '2017-03-16 08:00:00', '2017-03-16 21:30:00', '0:13:30:00 ', 'EveCur', 'MOV001, E', 1, 10000, 0, 0, '2017-03-16 09:45:09', 81306),
(145, 'Actividades Bienestar Estudiantil', 'Ninguna', '2017-03-16 08:00:00', '2017-03-16 21:30:00', '0:13:30:00 ', 'EveCur', 'MOV002, E', 1, 10000, 0, 0, '2017-03-16 09:45:09', 81632),
(146, 'MULTIDIOMAS', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 21:30:00', '0:15:00:00 ', 'EveCur', 'MOV003, E', 1, 10000, 0, 0, '2017-03-16 09:45:09', 75009),
(147, 'Actividades Bienestar Estudiantil', 'Ninguna', '2017-03-16 18:00:00', '2017-03-16 20:30:00', '0:02:30:00 ', 'EveReg', 'MOV005, E', 1, 10000, 0, 0, '2017-03-16 09:45:09', 83433),
(148, 'Actividades de Bienestar Estudiantil', 'Ninguna', '2017-03-16 08:30:00', '2017-03-16 18:00:00', '0:09:30:00 ', 'EveCur', 'MOV005, E', 1, 10000, 0, 0, '2017-03-16 09:45:10', 83274),
(149, 'Actividades Bienestar Estudiantil', 'Ninguna', '2017-03-16 08:30:00', '2017-03-16 18:30:00', '0:10:00:00 ', 'EveCur', 'MOV006, E', 1, 10000, 0, 0, '2017-03-16 09:45:10', 83354),
(150, 'CARLOS MEISEL TARDE', 'Ninguna', '2017-03-16 14:00:00', '2017-03-16 17:00:00', '0:03:00:00 ', 'EveTer', 'Coliseo de Competencias, X', 1, 10000, 0, 0, '2017-03-16 09:45:10', 88203),
(151, 'CARLOS MEISEL', 'Ninguna', '2017-03-16 07:30:00', '2017-03-16 11:30:00', '0:04:00:00 ', 'EveTer', 'Coliseo de Competencias, X', 1, 10000, 0, 0, '2017-03-16 09:45:10', 88202),
(152, 'evento jazmin chaverra', 'Ninguna', '2017-03-16 18:00:00', '2017-03-16 21:30:00', '0:03:30:00 ', 'EveReg', 'Coliseo de Competencias, X', 1, 10000, 0, 0, '2017-03-16 09:45:10', 77476),
(153, 'CLASES DE BALONCESTO LIBRES Y SELECCION', 'Ninguna', '2017-03-16 12:00:00', '2017-03-16 13:00:00', '0:01:00:00 ', 'EveTer', 'Cancha Multiple, X', 1, 10000, 0, 0, '2017-03-16 09:45:10', 82460),
(154, 'TORNEO INTERNO', 'Ninguna', '2017-03-16 09:00:00', '2017-03-16 12:00:00', '0:03:00:00 ', 'EveTer', 'Cancha Multiple, X', 1, 10000, 0, 0, '2017-03-16 09:45:10', 83108),
(155, 'TORNEO INTERNO', 'Ninguna', '2017-03-16 14:00:00', '2017-03-16 21:00:00', '0:07:00:00 ', 'EveCur', 'Cancha Multiple, X', 1, 10000, 0, 0, '2017-03-16 09:45:10', 83083),
(156, 'CURSO SEMILLEROS DE INVESTIGACIÃ“N', 'Ninguna', '2017-03-16 14:30:00', '2017-03-16 18:00:00', '0:03:30:00 ', 'EveCur', '10104, Bloque 10', 1, 10000, 0, 0, '2017-03-16 09:45:10', 86958),
(157, 'ESPACIO ABIERTO ELÃ‰CTRICA', 'Ninguna', '2017-03-16 09:00:00', '2017-03-16 12:30:00', '0:03:30:00 ', 'EveTer', 'sala de conferencias 1, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:10', 85698),
(158, 'REUNION DE PRACTICAS', 'Ninguna', '2017-03-16 18:00:00', '2017-03-16 20:00:00', '0:02:00:00 ', 'EveReg', 'sala de conferencias 1, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:10', 76767),
(159, 'JORNADA DE ACTUALIZACIÃ“N ACADÃ‰MICA PERSONA ENCAR', 'Ninguna', '2017-03-16 14:30:00', '2017-03-16 18:00:00', '0:03:30:00 ', 'EveCur', 'sala de conferencias 1, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:10', 82361),
(160, 'Capacitacion Opcion Atlantico', 'Ninguna', '2017-03-16 14:00:00', '2017-03-16 17:30:00', '0:03:30:00 ', 'EveTer', 'sala de conferencias 2, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:10', 77590),
(161, 'JORNADA DE ACTUALIZACIÃ“N ACADÃ‰MICA PERSONA A CAR', 'Ninguna', '2017-03-16 17:30:00', '2017-03-16 21:30:00', '0:04:00:00 ', 'EveCur', 'sala de conferencias 2, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:11', 77383),
(162, 'oferta academica', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 08:30:00', '0:02:00:00 ', 'EveTer', 'sala 20, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:11', 85567),
(163, 'Cursos Complementarios Bienestar', 'Ninguna', '2017-03-16 16:30:00', '2017-03-16 18:30:00', '0:02:00:00 ', 'EveCur', 'SALA 22, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:11', 81673),
(164, 'Curso Complementario EstadÃ­stica Aplicada', 'Ninguna', '2017-03-16 10:30:00', '2017-03-16 12:30:00', '0:02:00:00 ', 'EveTer', 'sala 25, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:11', 83507),
(165, 'Registro calificado ', 'Ninguna', '2017-03-16 09:00:00', '2017-03-16 13:00:00', '0:04:00:00 ', 'EveTer', 'sala 27, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:11', 88170),
(166, 'Registro calificado ', 'Ninguna', '2017-03-16 08:30:00', '2017-03-16 09:00:00', '0:00:30:00 ', 'EveTer', 'sala 27, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:11', 88171),
(167, 'REUNION DE CORDINADORES DE AREA ', 'Ninguna', '2017-03-16 15:00:00', '2017-03-16 16:00:00', '0:01:00:00 ', 'EveTer', '11410, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:11', 88369),
(168, 'RECUPERACIÃ“N DE CLASES LUZ CHIVETTA', 'Ninguna', '2017-03-16 17:30:00', '2017-03-16 21:30:00', '0:04:00:00 ', 'EveCur', '11505, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:11', 88198),
(169, 'CLASES MIGUEL MARCELES', 'Ninguna', '2017-03-16 06:30:00', '2017-03-16 08:30:00', '0:02:00:00 ', 'EveTer', '11506, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:11', 87520),
(170, 'actividad de quimica', 'Ninguna', '2017-03-16 18:30:00', '2017-03-16 21:30:00', '0:03:00:00 ', 'EveReg', '11710, Bloque 11', 1, 10000, 0, 0, '2017-03-16 09:45:12', 88391),
(171, 'PROYECTO DE INVESTIGACION', 'Ninguna', '2017-03-17 08:00:00', '2017-03-17 12:30:00', '0:04:30:00 ', 'EveReg', 'Salon Oasis, Bloque 1', 1, 10000, 0, 1, '2017-03-16 11:17:40', 88176);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`nombre`, `descripcion`, `estado`, `id`) VALUES
('Tipos de Identificacion', 'En este Parametro se Guardan los diferentes tipos de indentificacion que existan', 1, 1),
('Tipos de Ingreso', 'En este parametro se manejan los tipos de ingresos a la institucion', 1, 2),
('Departamentos', 'En este parametro se guardan los diferentes areas que existan en la institucion', 1, 3),
('Tipos de Estado', 'En este parametro se guardan lso estados que manejaran las visitas', 1, 4),
('Sanciones', 'En este parametro se guardan los tipos de sanciones que existan', 1, 5),
('Cargos', 'En este parametro se manejan los cargos que existan en la institucion ', 1, 6),
('Tipos de Personas', 'En este parametro se registran los categorias de cada personas', 1, 7),
('Tipos de Usuarios', 'En este parametro se guardan cada uno de los usuarios que maneje el sistema', 1, 8),
('Correos', 'Ninguna', 1, 9),
('Tipo de estado Eventos', 'Ninguna', 1, 10),
('Modulos', 'En este parametro se registran todos los modulos que maneja el sistema', 1, 11),
('\nParametros Generales', 'En este parametro se define la duracion que tendran las visitas registradas', 1, 12),
('Rutas', 'En este parametro se registran las rutas de cada una de las carpetas del software', 1, 13),
('Empresas', 'Niguna', 1, 14),
('Tipos Participantes', 'Ninguna', 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes`
--

CREATE TABLE `participantes` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_participante` int(11) NOT NULL,
  `EnEvento` tinyint(1) DEFAULT '0',
  `Hora_Ingreso` datetime DEFAULT '0000-00-00 00:00:00',
  `tipo_participante` int(11) NOT NULL,
  `placa_vehiculo` varchar(6) DEFAULT '------',
  `acompanantes` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `participantes`
--

INSERT INTO `participantes` (`id`, `id_evento`, `id_participante`, `EnEvento`, `Hora_Ingreso`, `tipo_participante`, `placa_vehiculo`, `acompanantes`) VALUES
(1, 84, 1, 1, '2017-03-16 12:02:33', 141, '------', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles_usuarios`
--

CREATE TABLE `perfiles_usuarios` (
  `id` int(11) NOT NULL,
  `id_perfil` varchar(20) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfiles_usuarios`
--

INSERT INTO `perfiles_usuarios` (`id`, `id_perfil`, `id_usuario`, `estado`) VALUES
(1, 'Admin', 1, 1),
(2, 'VisitadoUser', 1, 1),
(4, 'SecreUser', 1, 1),
(5, 'UserRep', 1, 1),
(6, 'VisitadoUser', 2, 1),
(7, 'UserRep', 3, 1),
(8, 'SecreUser', 4, 1),
(9, 'Admin', 0, 1),
(10, '54', 0, 1),
(11, 'VisitadoUser', 1, 1),
(12, 'Admin', 4, 1),
(13, 'UserRep', 4, 1),
(14, 'VisitadoUser', 4, 1),
(16, 'VisitadoUser', 3, 1),
(17, 'Admin', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sanciones_usuarios`
--

CREATE TABLE `sanciones_usuarios` (
  `Id` int(11) NOT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Id_Visitante` int(11) DEFAULT NULL,
  `Id_Sancion` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `id_tipo_persona` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`, `id_persona`, `estado`, `id_tipo_persona`) VALUES
(0, 'Admin', '68053af2923e00204c3ca7c6a3150cf7', 5, 1, 'tblvisitado'),
(1, 'dtorres15', '68053af2923e00204c3ca7c6a3150cf7', 1, 1, 'tblvisitado'),
(2, 'kate10', '68053af2923e00204c3ca7c6a3150cf7', 2, 0, 'tblvisitado'),
(3, 'kate10', '68053af2923e00204c3ca7c6a3150cf7', 2, 1, 'tblvisitado'),
(4, 'ocantill4', 'b59c67bf196a4758191e42f76670ceba', 4, 1, 'tblvisitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_parametros`
--

CREATE TABLE `valor_parametros` (
  `id` int(11) NOT NULL,
  `id_aux` varchar(30) DEFAULT NULL,
  `idParametro` int(11) NOT NULL,
  `valor` varchar(50) NOT NULL,
  `valorx` varchar(300) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `valory` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valor_parametros`
--

INSERT INTO `valor_parametros` (`id`, `id_aux`, `idParametro`, `valor`, `valorx`, `estado`, `valory`) VALUES
(1, 'tblvisitante', 7, 'Visitantes', 'Ninguna', 1, 'NULL\r'),
(42, 'tblvisitado', 7, ' Visitado', 'Ninguna', 1, 'NULL\r'),
(43, '', 1, 'Cedula de Ciudadania', 'Ninguna', 1, 'NULL\r'),
(44, '', 5, 'Ninguna', 'Sin sanciones', 1, 'NULL\r'),
(45, '', 2, 'Normal', 'Ningunaaaaaaa', 1, 'NULL\r'),
(46, '', 2, 'Visita Promocional', 'Para aquellos colegios o instituciones que se diri', 1, 'NULL\r'),
(47, 'VisiEsp', 4, 'En espera', 'Ninguna', 1, 'NULL\r'),
(48, 'VisiTer', 4, 'Terminada', 'Ninguna', 1, 'NULL\r'),
(51, '', 6, 'Auxiliar', 'Ninguna', 1, 'NULL\r'),
(52, '', 6, 'Jefe', 'Ninguna', 1, 'NULL\r'),
(53, 'Admin', 8, 'Administrador', 'Este Usuarios es quien administra el sistema', 1, 'NULL\r'),
(54, 'SecreUser', 8, 'Secretaria', 'Ninguna', 1, 'NULL\r'),
(55, 'VisitadoUser', 8, 'Visitado', 'Este perfil es para los trabajadores de la universidad', 1, 'NULL\r'),
(56, 'VisiRe', 4, 'Reservada', 'Visitas que se reservan', 1, 'NULL\r'),
(57, 'VisiCur', 4, 'En Curso', 'Las Visitas que ya iniciaron', 1, 'NULL\r'),
(58, 'VisiCancel', 4, 'Cancelada', 'Las Visitas que ya no seran efectuadas ', 1, 'NULL\r'),
(59, 'UserRep', 8, 'Recepcionista', 'Este usuario es la encarga de administrar las visitas', 1, 'NULL\r'),
(60, 'Oskr251110566', 9, 'ocantill4@cuc.edu.co', 'Este correo es el que le notifica a los visitados que tienen una visita', 1, 'NULL\r'),
(61, 'EveTer', 10, 'Terminado', 'Ninguna', 1, 'NULL\r'),
(62, 'EveCur', 10, 'En curso', 'Ninguna', 1, 'NULL\r'),
(67, 'Usuarios', 11, 'Modulo Usuarios', 'En este modulo se realizan todas las actividades referente a los usuarios', 1, 'glyphicon glyphicon-user\r'),
(68, 'Visitantes', 11, 'Modulo Visitantes', 'En este modulo se realizan todas las actividades referente a los visitantes', 1, 'glyphicon glyphicon-user\r'),
(69, 'Parametros', 11, 'Modulo Genericas', 'En este modulo se realizan todas las actividades referente a los genÃ©ricas del sistema', 1, 'glyphicon glyphicon-refresh\r'),
(70, 'Visita', 11, 'Modulo Visitas', 'En este modulo se realizan todas las actividades referente a las visitas', 1, 'glyphicon glyphicon-list-alt\r'),
(71, 'Visitados', 11, 'Modulo Visitados', 'En este modulo se realizan todas las actividades referente a los visitados', 1, 'glyphicon glyphicon-user\r'),
(72, 'ReservaVisita', 11, 'Modulo Reserva', 'En este modulo se realizan todas las actividades referente a la reserva de visitas', 1, 'glyphicon glyphicon-edit\r'),
(73, 'ReportesVisitas', 11, 'Modulo Reportes Visitas', 'En este modulo se realizan todas las actividades referente a los reportes de las visitas', 1, 'glyphicon glyphicon-tasks\r'),
(74, 'LimVisita', 12, '3', 'Este Parametro delimita el limite de duracion de las visitas registradas', 1, 'NULL\r'),
(77, 'EveReg', 10, 'Registrado', 'Ninguna', 1, 'NULL\r'),
(78, 'Actividades_Perfil', 11, 'Actividades por perfil', 'En este modulo se asignan las actividades y los permisos que tendran cada tipo de usuario', 1, 'glyphicon glyphicon-th\r'),
(79, 'Eventos', 11, 'Modulo Eventos', 'En este Modulo se administran todos los eventos', 1, 'glyphicon glyphicon-calendar\r'),
(80, 'Personalizar_Menu', 11, 'Personalizar Menu', 'En este modulo se personaliza los icono del menu', 1, 'glyphicon glyphicon-pencil\r'),
(81, '', 5, 'Sancionado', 'Persona Sancionada', 1, 'NULL\r'),
(83, 'EveCan', 10, 'Cancelado', 'Ninguna', 1, 'NULL\r'),
(89, 'Notifica', 12, 'no', 'Este parametro es el encargado de determinar si se notifica o no en el modulo de visitas', 1, 'NULL\r'),
(90, 'cuc', 3, 'ADMISIONES Y REGISTRO', 'BLOQUE 2 - PISO 2', 1, '\r'),
(91, 'cuc', 3, 'ALMACEN', 'BLOQUE 9 - PISO 1', 1, '\r'),
(92, 'cuc', 3, 'CALIDAD', 'BLOQUE 9 - PISO 2', 1, '\r'),
(93, 'cuc', 3, 'CIENCIAS BASICAS', 'BLOQUE 1 - PISO 4', 1, '\r'),
(94, 'cuc', 3, 'CIENCIAS ECONOMICAS', 'BLOQUE 3 - PISO 3', 1, '\r'),
(95, 'cuc', 3, 'COMPRAS', 'BLOQUE 6 - PISO 1', 1, '\r'),
(96, 'cuc', 3, 'COMUNICACIONES', 'BLOQUE 1 - PISO 2', 1, '\r'),
(97, 'cuc', 3, 'CONSULTORIO JURIDICO', 'Cra. 44 No 55 -05 ', 1, '\r'),
(98, 'cuc', 3, 'CONTABILIDAD', 'BLOQUE 1 - PISO 1', 1, '\r'),
(99, 'cuc', 3, 'CREDITOS', 'BLOQUE 2 - PISO 2', 1, '\r'),
(100, 'cuc', 3, 'CULTURA Y DEPORTES', 'BLOQUE 9 - PISO 2', 1, '\r'),
(101, 'cuc', 3, 'EDITORIAL EDUCOSTA', 'BLOQUE 5 - PISO 3', 1, '\r'),
(102, 'cuc', 3, 'FACULTAD DE ARQUITECTURA', 'BLOQUE 8 - PISO 2', 1, '\r'),
(103, 'cuc', 3, 'FACULTAD DE DERECHO', 'BLOQUE 3 - PISO 2', 1, '\r'),
(104, 'cuc', 3, 'FACULTAD DE INGENIERIAS', 'BLOQUE 1 - PISO 2', 1, '\r'),
(105, 'cuc', 3, 'FACULTAD DE PSICOLOGIA', 'BLOQUE 3 - PISO 4', 1, '\r'),
(106, 'cuc', 3, 'HUMANIDADES', 'BLOQUE 1 - PISO 3', 1, '\r'),
(107, 'cuc', 3, 'INTERNACIONALIZACION', 'BLOQUE 3', 1, '\r'),
(108, 'cuc', 3, 'PLANEACION', 'BLOQUE 1 - PISO 4', 1, '\r'),
(109, 'cuc', 3, 'POSGRADO', 'BLOQUE 11 - PISO 1', 1, '\r'),
(110, 'cuc', 3, 'RECTORIA', 'BLOQUE 1 - PISO 2', 1, '\r'),
(111, 'cuc', 3, 'RECURSOS EDUCATIVOS', 'BLOQUE 2 - PISO 1', 1, '\r'),
(112, 'cuc', 3, 'REVISORIA INTERNA', 'BLOQUE 1 - PISO 1', 1, '\r'),
(113, 'cuc', 3, 'SECRETARIA GENERAL', 'BLOQUE 1 - PISO 2', 1, '\r'),
(114, 'cuc', 3, 'SERVICIOS GENERALES / MANTENIMIENTO', 'BLOQUE 6 - PISO 1', 1, '\r'),
(115, 'cuc', 3, 'SISTEMAS', 'BLOQUE 2 - PISO 4', 1, '\r'),
(116, 'cuc', 3, 'TALENTO HUMANO', 'BLOQUE 3 - PISO 2', 1, '\r'),
(117, 'cuc', 3, 'TESORERIA', 'BLOQUE 1 - PISO 1', 1, '\r'),
(118, 'cuc', 3, 'UNIDAD DE PROMOCION', 'BLOQUE 2 - PISO 2', 1, '\r'),
(119, 'cuc', 3, 'VICERECTORIA ACADEMICA', 'BLOQUE 1 - PISO 1', 1, '\r'),
(120, 'cuc', 3, 'VICERECTORIA ADMINISTRATIVA', 'BLOQUE 1 - PISO 2', 1, '\r'),
(121, 'cuc', 3, 'VICERECTORIA BIENESTAR UNIVERSITARIO', 'BLOQUE 2 - PISO 1', 1, '\r'),
(122, 'cuc', 3, 'VICERECTORIA DE EXTENSION', 'BLOQUE 5 - PISO 2', 1, '\r'),
(123, 'cuc', 3, 'VICERECTORIA FINANCIERA', 'BLOQUE 1 - PISO 2', 1, '\r'),
(124, 'cuc', 3, 'VICERECTORIA INVESTIGACION', 'BLOQUE 1 - PISO 4', 1, '\r'),
(127, 'cuc', 3, 'ESTUDIANTES', 'estudiantes que dejan el carnet', 1, NULL),
(128, 'cuc', 3, 'EMPLEADOS', 'Empleados que dejan el carnet', 1, NULL),
(129, 'My_Perfil', 11, 'Modulo Personal', 'En este modulo el usuario puede administrar sus datos', 1, 'glyphicon glyphicon-wrench'),
(131, '../Imagenes', 13, 'Imagenes', 'En esta carpeta se guardan las imagenes que maneja el software', 1, NULL),
(132, '../estilos', 13, 'Archivos CSS y JS', 'En esta carpeta se manejan los archivos CSS y JS', 1, NULL),
(133, '../modulos', 13, 'Archivos Visuales', 'En esta ruta se guardan aquellos arquivos PHP  que tienen la parte visual(formularios)', 1, NULL),
(134, '../prueba', 13, 'prueba', 'n', 1, NULL),
(135, 'Manejo_Versiones', 11, 'Administrar Archivos', 'Eniks', 1, 'glyphicon glyphicon-download'),
(136, 'cuc', 14, 'Universidad de la costa', NULL, 1, NULL),
(137, 'cucl', 14, 'corporacion latinoamerica', NULL, 1, NULL),
(138, 'cucl', 3, 'prueba', 'cyc', 1, NULL),
(139, 'Guar_EV_Dia', 12, '2017-03-17', 'nignuna', 1, NULL),
(140, 'cucl', 3, 'otro', ' ff', 1, NULL),
(141, '', 12, 'Normal', 'n', 1, NULL),
(142, '', 15, 'Conferencista', 'Ninguna', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitados`
--

CREATE TABLE `visitados` (
  `Id` int(50) NOT NULL,
  `Identificacion` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Segundo_Nombre` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Apellido` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Segundo_Apellido` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Id_Departamento` int(10) NOT NULL,
  `Correo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Telefono` int(20) NOT NULL,
  `Id_TipoIdentificacion` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `cargo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `foto` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `visitados`
--

INSERT INTO `visitados` (`Id`, `Identificacion`, `Nombre`, `Segundo_Nombre`, `Apellido`, `Segundo_Apellido`, `Id_Departamento`, `Correo`, `Telefono`, `Id_TipoIdentificacion`, `estado`, `cargo`, `foto`) VALUES
(1, '2147483647', 'Damian', 'Antonio', 'Torres', 'Niebles', 115, 'dtorres15@cuc.edu.co', 0, 43, 1, '51', '1143454688.jpg'),
(2, '1143454688', 'Katerine', 'Patricia', 'Oquendo', 'Mirbent', 90, 'dtorres15@cuc.edu.co', 300320465, 43, 1, '51', 'Myfoto.png'),
(3, '78889', 'G', 'G', 'H', 'G', 90, 'dtorres15@cuc.edu.co', 30, 43, 1, '51', 'Myfoto.png'),
(4, '2147483647', 'OSCAR', 'EDUARDO', 'CANTILLO', 'MENCO', 90, 'dtorres15@cuc.edu.co', 1, 43, 1, '52', 'Myfoto.png'),
(5, '1000', 'ADMIN', 'ADMIN', 'ADMIN', 'ADMIN', 115, 'universidaddelacostacuc@cuc.edu.co', 10000, 43, 1, '51', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

CREATE TABLE `visitantes` (
  `id` int(11) NOT NULL,
  `identificacion` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `id_tipoIdentificacion` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Segundo_Nombre` varchar(30) COLLATE utf8_spanish2_ci DEFAULT '',
  `apellido` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Segundo_Apellido` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `celular` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `numPlacaCarro` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `Usuario_Registra` int(11) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`id`, `identificacion`, `id_tipoIdentificacion`, `nombre`, `Segundo_Nombre`, `apellido`, `Segundo_Apellido`, `celular`, `correo`, `foto`, `numPlacaCarro`, `estado`, `Usuario_Registra`, `Fecha_Creacion`) VALUES
(1, '1143454687', 43, 'Damian', '', 'Torres', 'Niebles', '', '', '1143454687999.jpg', NULL, 1, 1, '2017-02-06 21:18:09'),
(2, '7852', 43, 'Katerine', '', 'Oquendo', 'Miraben', '', '', '7852.jpg', NULL, 1, 1, '2017-02-06 21:19:08'),
(3, '78523', 43, 'Katerine', '', 'Oquendo', 'Miraben', '', '', '78523.jpg', NULL, 1, 1, '2017-02-06 21:20:42'),
(4, '11434545', 43, 'Damnian', '', 'Torres', 'Niebles', '', '', '11434545.jpg', NULL, 1, 1, '2017-02-06 21:22:00'),
(5, '852', 43, 'juan', '', 'perex', 'dia', '', '', '852.jpg', NULL, 1, 1, '2017-02-06 21:22:40'),
(6, '895', 43, 'y', '', 'y', 'y', '', '', '895.jpg', NULL, 1, 1, '2017-02-06 21:23:19'),
(7, '85522', 43, 'y', 'y', 'y', 'y', '', '', '85522.jpg', NULL, 1, 1, '2017-02-06 21:25:10'),
(8, '966', 43, 'p', 'p', 'gy', 'p', '', '', '966.jpg', NULL, 1, 1, '2017-02-06 21:25:59'),
(9, '898', 43, 'jh', 'h', 's', 'j', '', '', '898.jpg', NULL, 1, 1, '2017-02-06 21:28:17'),
(10, '54545', 43, 'u', 'u', 'u', 'u', '', '', '54545.jpg', NULL, 1, 1, '2017-02-06 21:29:01'),
(11, '114345468', 43, 'gh', 'g', 'Torr', 'h', '', '', '114345468.jpg', NULL, 1, 1, '2017-02-06 21:29:40'),
(12, '85222', 43, 'Damian', '', 'Torres', 'Niebles', '', '', '85222.jpg', NULL, 1, 1, '2017-02-06 21:30:16'),
(13, '9899', 43, 'jhj', '', 'kj', 'jh', '', '', '9899.jpg', NULL, 1, 1, '2017-02-06 21:30:47'),
(14, '104734831', 43, 'OSCAR', 'EDUARDO', 'CANTILLO', 'MENCO', '', 'o@d.c', '104734831.jpg', NULL, 1, 1, '2017-02-06 21:36:10'),
(15, '789456132', 43, 'DANIELA', '', 'GONZALEZ', 'MARTINEZ', '', '', '789456132.jpg', NULL, 1, 1, '2017-02-06 21:38:58'),
(16, '45', 43, 'g', '', 'hg', 'ghf', '', '', '45.jpg', NULL, 1, 1, '2017-02-06 21:52:02'),
(17, '1114345468', 43, 'HG', '', 'JHG', 'HG', '', '', '1114345468.jpg', NULL, 1, 1, '2017-02-06 22:37:06'),
(18, '4545', 43, 'J', 'J', 'J', 'J', '', '', '4545.jpg', NULL, 1, 1, '2017-02-06 22:37:35'),
(19, '112', 43, 'hg', '', 'h', 'ghg', '', '', '112.jpg', NULL, 1, 1, '2017-02-06 22:44:43'),
(20, '8888', 43, 'g', 'g', 'j', 'hg', '', '', '8888.jpg', NULL, 1, 1, '2017-02-06 22:45:09'),
(21, '888844', 43, 'h', 'h', 'j', 'h', '', '', '888844.jpg', NULL, 1, 1, '2017-02-06 22:45:32'),
(22, '888', 43, 'J', 'J', 'J', 'J', '', '', '888.jpg', NULL, 1, 1, '2017-02-06 22:46:30'),
(23, '545', 43, 'DD', '', 'HG', 'FGFDD', '', '', '545.jpg', NULL, 1, 1, '2017-02-06 22:47:53'),
(24, '54557', 43, 'F', 'F', 'G', 'FG', '', '', '54557.jpg', NULL, 1, 1, '2017-02-06 22:51:09'),
(25, '11111', 43, 'h', 'h', 'j', 'h', '', '', '11111.jpg', NULL, 1, 1, '2017-02-07 16:16:34'),
(26, '54', 43, 'HG', 'H', 'HG', 'HG', '54545545', '', '54.jpg', NULL, 1, 1, '2017-02-07 20:39:42'),
(27, '1143454688', 43, 'G', 'G', 'G', 'G', '', '', '11434546889.jpg', NULL, 1, 1, '2017-02-08 15:20:01'),
(28, '965', 43, 'H', 'HH', 'J', 'H', '', '', '965.jpg', NULL, 1, 1, '2017-02-09 22:11:23'),
(29, '1143454', 43, 'hv', 'hv', 'h', 'hv', '51', 'd@f.com', '1143454.jpg', NULL, 1, 1, '2017-03-10 22:27:51'),
(30, '8888654', 43, 'm', 'm', 'm', 'm', '1', 'd@f.com', '8888654.jpg', NULL, 1, 1, '2017-03-10 22:28:35'),
(31, '115454', 43, 'vgf', 'gf', 'g', 'h', '63', 'd@f.com', '115454.jpg', NULL, 1, 1, '2017-03-10 22:30:02'),
(32, '4', 43, 'hh', 'fe', 'j', 'h', '', '', '4.jpg', NULL, 1, 1, '2017-03-10 22:30:39'),
(33, '88', 43, 'se', 'fue', 'Sera', 'si', '', '', '88.jpg', NULL, 1, 1, '2017-03-10 22:42:21'),
(34, '98789', 43, 'ugh', 'f', 'k', 'uh', '', '', '98789.jpg', NULL, 1, 1, '2017-03-10 22:43:14'),
(35, '98789345', 43, 'g', 'g', 'j', 'gh', '', '', '98789345.jpg', NULL, 1, 1, '2017-03-10 22:45:12'),
(36, '9878934534', 43, 'g', 'g', 'j', 'gh', '', '', '987893453425.jpg', NULL, 1, 1, '2017-03-10 22:45:41'),
(37, '9878934534', 43, 'g', 'g', 'j', 'gh', '', '', '987893453425.jpg', NULL, 1, 1, '2017-03-10 22:51:27'),
(38, '9878934534', 43, 'g', 'g', 'j', 'gh', '', '', '987893453425.jpg', NULL, 1, 1, '2017-03-10 22:51:35'),
(39, '88955', 43, 'hd', 'g', 'espero que si ha', 'hdh', '', '', '88955.jpg', NULL, 1, 1, '2017-03-10 22:54:51'),
(40, '554', 43, 'g', 's', 'f', 'g', '', '', '554.jpg', NULL, 1, 1, '2017-03-10 22:55:30'),
(41, '875454', 43, 'h', 'd', 'j', 'h', '', '', '875454.jpg', NULL, 1, 3, '2017-03-10 22:59:46'),
(42, '654', 43, 'g', 'g', 'g', 'g', '', '', '654.jpg', NULL, 1, 3, '2017-03-10 23:00:06'),
(43, '6', 43, 'fwe', 'wef', 'ff', 'wef', '', '', '6.jpg', NULL, 1, 3, '2017-03-10 23:00:20'),
(44, '5', 43, 'h', 's', 'h', 'h', '', '', '5.jpg', NULL, 1, 1, '2017-03-10 23:03:34'),
(45, '5346326', 43, 'h', 's', 'h', 'h', '', '', '5346326.jpg', NULL, 1, 1, '2017-03-10 23:03:55'),
(46, '5454', 43, 'H', 'H', 'H', 'H', '', '', NULL, NULL, 1, 1, '2017-03-16 17:14:05'),
(47, '78777', 43, 'P', 'P', 'P', 'P', '', '', NULL, NULL, 1, 1, '2017-03-16 17:15:00'),
(48, '999', 43, 'll', 's', 'l', 'l', '', '', NULL, NULL, 1, 1, '2017-03-16 17:16:08'),
(49, '1143454545', 43, 'P', 'P', 'P', 'P', '', '', NULL, NULL, 1, 1, '2017-03-16 17:18:05'),
(50, '546', 43, 'g', 'g', 'gh', 'g', '', '', NULL, NULL, 1, 1, '2017-03-16 17:26:23'),
(51, '54568', 43, 'FF', 'F', 'G', 'G', '', '', NULL, NULL, 1, 1, '2017-03-16 17:30:36'),
(52, '545484', 43, 'F', 'F', 'F', 'F', '', '', NULL, NULL, 1, 1, '2017-03-16 17:30:55'),
(53, '95', 43, 'D', 'DD', 'F', 'D', '', '', NULL, NULL, 1, 1, '2017-03-16 17:31:41'),
(54, '1545454', 43, 'gh', 'gh', 'j', 'h', '', '', NULL, NULL, 1, 1, '2017-03-16 17:37:54'),
(55, '89', 43, 'fgf', 'cf', 'hg', 'g', '', '', NULL, NULL, 1, 1, '2017-03-16 17:38:36'),
(56, '1047355428', 43, 'CAROLAIN', 'YANIN', 'SALAS', 'TRUYOLL', '3008786518', 'CARITOPRINCESS02@HOTMAIL.COM', '1047355428.jpg', NULL, 1, 4, '2017-10-14 19:15:35'),
(57, '1047348314', 43, 'OSCAR', 'EDUARDO', 'CANTILLO', 'MENCO', '3015002529', 'oscantillomen@gmail.com', '1047348314.jpg', NULL, 1, 4, '2017-10-14 19:18:09'),
(58, '1140887017', 43, 'SHARONS', 'VANESSA', 'CABRERA', 'RODRIGUEZ', '3057696750', 'SHAK-0821@HOTMAIL.COM', '1140887017.jpg', NULL, 1, 4, '2017-10-24 01:00:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes_departamento`
--

CREATE TABLE `visitantes_departamento` (
  `Id` int(11) NOT NULL,
  `Id_Visitantes` int(11) NOT NULL,
  `Id_Departamento` int(11) NOT NULL,
  `HoraEntrada` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `HoraSalida` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `placa_visitante` varchar(6) NOT NULL DEFAULT '------',
  `Acompanantes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `visitantes_departamento`
--

INSERT INTO `visitantes_departamento` (`Id`, `Id_Visitantes`, `Id_Departamento`, `HoraEntrada`, `HoraSalida`, `placa_visitante`, `Acompanantes`) VALUES
(1, 1, 90, '2017-02-06 15:18:09', '0000-00-00 00:00:00', '------', 0),
(2, 2, 90, '2017-02-06 15:19:08', '0000-00-00 00:00:00', '11', 0),
(3, 3, 90, '2017-02-06 15:20:42', '0000-00-00 00:00:00', 'uyd585', 5),
(4, 4, 91, '2017-02-06 15:22:00', '0000-00-00 00:00:00', '------', 0),
(5, 5, 91, '2017-02-06 15:22:40', '0000-00-00 00:00:00', 'yud852', 0),
(6, 6, 92, '2017-02-06 15:23:19', '2017-02-06 15:37:15', '11', 0),
(7, 7, 90, '2017-02-06 15:25:10', '0000-00-00 00:00:00', '25', 0),
(8, 8, 90, '2017-02-06 15:25:59', '0000-00-00 00:00:00', '11', 0),
(9, 9, 90, '2017-02-06 15:28:17', '0000-00-00 00:00:00', '------', 0),
(10, 10, 90, '2017-02-06 15:29:01', '0000-00-00 00:00:00', '8crryu', 52),
(11, 11, 90, '2017-02-06 15:29:40', '0000-00-00 00:00:00', '------', 0),
(12, 12, 90, '2017-02-06 15:30:16', '0000-00-00 00:00:00', 'uiudd8', 0),
(13, 1, 90, '2017-02-06 15:31:10', '0000-00-00 00:00:00', '------', 0),
(14, 2, 90, '2017-02-06 15:31:47', '0000-00-00 00:00:00', '878dsd', 0),
(15, 14, 91, '2017-02-06 15:36:10', '2017-02-06 15:37:11', 'RDE369', 2),
(16, 15, 91, '2017-02-06 15:38:58', '0000-00-00 00:00:00', '------', 0),
(17, 16, 90, '2017-02-06 15:52:02', '0000-00-00 00:00:00', '------', 0),
(18, 18, 90, '2017-02-06 16:37:35', '0000-00-00 00:00:00', '------', 0),
(19, 19, 90, '2017-02-06 16:44:43', '0000-00-00 00:00:00', '------', 0),
(20, 20, 90, '2017-02-06 16:45:09', '0000-00-00 00:00:00', '------', 0),
(21, 21, 90, '2017-02-06 16:45:32', '0000-00-00 00:00:00', '------', 0),
(22, 22, 90, '2017-02-06 16:46:30', '0000-00-00 00:00:00', '------', 0),
(23, 23, 90, '2017-02-06 16:47:53', '0000-00-00 00:00:00', '------', 0),
(24, 24, 90, '2017-02-06 16:51:09', '0000-00-00 00:00:00', 'SSSSSS', 44),
(25, 25, 90, '2017-02-07 10:16:34', '0000-00-00 00:00:00', '------', 0),
(26, 11, 90, '2017-02-07 12:09:43', '0000-00-00 00:00:00', '------', 0),
(27, 1, 90, '2017-02-07 14:34:22', '0000-00-00 00:00:00', 'uyc258', 8),
(28, 1, 90, '2017-02-07 14:34:30', '0000-00-00 00:00:00', 'uyc258', 8),
(29, 1, 90, '2017-02-07 14:35:33', '0000-00-00 00:00:00', '------', 0),
(30, 11, 90, '2017-02-07 14:35:44', '0000-00-00 00:00:00', '------', 0),
(31, 26, 90, '2017-02-07 14:39:42', '0000-00-00 00:00:00', 'SSS888', 5),
(32, 27, 90, '2017-02-08 09:20:01', '0000-00-00 00:00:00', '------', 0),
(33, 28, 90, '2017-02-09 16:11:23', '2017-02-09 16:11:30', '------', 0),
(34, 1, 90, '2017-03-10 16:27:04', '0000-00-00 00:00:00', '------', 0),
(35, 32, 90, '2017-03-10 16:30:39', '0000-00-00 00:00:00', '------', 0),
(36, 32, 90, '2017-03-10 16:30:52', '0000-00-00 00:00:00', '------', 0),
(37, 56, 127, '2017-10-14 12:15:35', '0000-00-00 00:00:00', '------', 0),
(38, 56, 127, '2017-10-14 12:15:55', '0000-00-00 00:00:00', '------', 0),
(39, 56, 127, '2017-10-14 12:17:55', '0000-00-00 00:00:00', '------', 0),
(40, 57, 128, '2017-10-14 12:18:09', '0000-00-00 00:00:00', '------', 0),
(41, 56, 127, '2017-10-14 12:18:38', '0000-00-00 00:00:00', '------', 0),
(42, 56, 127, '2017-10-14 12:18:55', '0000-00-00 00:00:00', '------', 0),
(43, 57, 127, '2017-10-14 12:19:21', '0000-00-00 00:00:00', '------', 0),
(44, 56, 127, '2017-10-17 14:51:39', '0000-00-00 00:00:00', '------', 0),
(45, 57, 127, '2017-10-17 14:51:48', '0000-00-00 00:00:00', '------', 0),
(46, 57, 127, '2017-10-17 14:52:45', '0000-00-00 00:00:00', '------', 0),
(47, 56, 127, '2017-10-17 14:52:56', '0000-00-00 00:00:00', '------', 0),
(48, 57, 127, '2017-10-17 14:53:10', '0000-00-00 00:00:00', '------', 0),
(49, 57, 127, '2017-10-17 14:54:26', '0000-00-00 00:00:00', '------', 0),
(50, 57, 127, '2017-10-17 14:56:18', '0000-00-00 00:00:00', '------', 0),
(51, 57, 127, '2017-10-17 14:57:19', '0000-00-00 00:00:00', '------', 0),
(52, 57, 127, '2017-10-17 14:58:18', '0000-00-00 00:00:00', '------', 0),
(53, 57, 127, '2017-10-17 14:58:34', '0000-00-00 00:00:00', '------', 0),
(54, 57, 127, '2017-10-17 15:00:02', '0000-00-00 00:00:00', '------', 0),
(55, 57, 127, '2017-10-17 15:03:25', '0000-00-00 00:00:00', '------', 0),
(56, 57, 127, '2017-10-17 15:11:06', '0000-00-00 00:00:00', '------', 0),
(57, 57, 127, '2017-10-17 15:11:44', '0000-00-00 00:00:00', '------', 0),
(58, 57, 127, '2017-10-17 15:12:19', '0000-00-00 00:00:00', '------', 0),
(59, 57, 127, '2017-10-17 15:14:31', '0000-00-00 00:00:00', '------', 0),
(60, 57, 128, '2017-10-17 15:16:42', '0000-00-00 00:00:00', '------', 0),
(61, 56, 127, '2017-10-17 15:17:01', '0000-00-00 00:00:00', '------', 0),
(62, 27, 128, '2017-10-17 15:17:56', '0000-00-00 00:00:00', '------', 0),
(63, 57, 128, '2017-10-23 18:00:03', '0000-00-00 00:00:00', '------', 0),
(64, 58, 127, '2017-10-23 18:00:34', '0000-00-00 00:00:00', '------', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes_visitas`
--

CREATE TABLE `visitantes_visitas` (
  `Id` int(11) NOT NULL,
  `Id_Visitantes` int(11) NOT NULL,
  `Id_Visita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `visitantes_visitas`
--

INSERT INTO `visitantes_visitas` (`Id`, `Id_Visitantes`, `Id_Visita`) VALUES
(1, 1, 1),
(2, 0, 2),
(3, 2, 3),
(4, 2, 4),
(5, 4, 4),
(6, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `Id` int(10) NOT NULL,
  `Id_Visitado` int(10) NOT NULL,
  `Id_TipoIngreso` int(10) NOT NULL,
  `NumAcompanantes` int(10) DEFAULT NULL,
  `HoraEntrada` datetime DEFAULT NULL,
  `HoraSalida` datetime DEFAULT NULL,
  `DuracionVisita` time DEFAULT NULL,
  `Id_EstadoVisita` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Observaciones` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `NumeroCarnet` int(10) DEFAULT NULL,
  `Usuario_Registra` int(11) NOT NULL,
  `Fecha_Registro` datetime NOT NULL,
  `notificado` tinyint(1) NOT NULL DEFAULT '0',
  `Visita_Placa` varchar(6) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '------'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`Id`, `Id_Visitado`, `Id_TipoIngreso`, `NumAcompanantes`, `HoraEntrada`, `HoraSalida`, `DuracionVisita`, `Id_EstadoVisita`, `Observaciones`, `NumeroCarnet`, `Usuario_Registra`, `Fecha_Registro`, `notificado`, `Visita_Placa`) VALUES
(1, 2, 45, 0, '2017-03-10 17:00:00', '2017-03-11 16:05:00', '00:23:05', 'VisiTer', '', 123, 3, '2017-03-10 16:02:52', 0, '------'),
(2, 2, 45, 0, '2017-03-11 19:35:00', '2017-03-18 19:55:00', '07:00:20', 'VisiTer', 'voene kgnjargre', 123, 3, '2017-03-10 16:03:25', 0, '------'),
(3, 1, 45, 0, '2017-03-16 12:04:32', '2017-03-16 15:04:32', '00:03:00', 'VisiTer', '', 123, 1, '2017-03-16 12:04:32', 0, '------'),
(4, 3, 46, 0, '2017-03-16 12:05:01', '2017-03-16 15:05:01', '00:03:00', 'VisiTer', '', 123, 1, '2017-03-16 12:05:01', 0, '------');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades_por_perfil`
--
ALTER TABLE `actividades_por_perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_visita` (`id_visita`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Usuario_Crea` (`Id_Usuario_Crea`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_participante` (`id_participante`);

--
-- Indices de la tabla `perfiles_usuarios`
--
ALTER TABLE `perfiles_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `sanciones_usuarios`
--
ALTER TABLE `sanciones_usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valor_parametros`
--
ALTER TABLE `valor_parametros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idParametro` (`idParametro`);

--
-- Indices de la tabla `visitados`
--
ALTER TABLE `visitados`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Departamento` (`Id_Departamento`),
  ADD KEY `Id_Identificacion` (`Id_TipoIdentificacion`);

--
-- Indices de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipoIdentificacion` (`id_tipoIdentificacion`);

--
-- Indices de la tabla `visitantes_departamento`
--
ALTER TABLE `visitantes_departamento`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `visitantes_visitas`
--
ALTER TABLE `visitantes_visitas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Visitado` (`Id_Visitado`),
  ADD KEY `Id_TipoIngreso` (`Id_TipoIngreso`),
  ADD KEY `Id_EstadoVisita` (`Id_EstadoVisita`),
  ADD KEY `Usuario_Registra` (`Usuario_Registra`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades_por_perfil`
--
ALTER TABLE `actividades_por_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `perfiles_usuarios`
--
ALTER TABLE `perfiles_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `sanciones_usuarios`
--
ALTER TABLE `sanciones_usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `valor_parametros`
--
ALTER TABLE `valor_parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT de la tabla `visitados`
--
ALTER TABLE `visitados`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `visitantes_departamento`
--
ALTER TABLE `visitantes_departamento`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT de la tabla `visitantes_visitas`
--
ALTER TABLE `visitantes_visitas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_visita`) REFERENCES `visitas` (`Id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`Id_Usuario_Crea`) REFERENCES `usuarios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

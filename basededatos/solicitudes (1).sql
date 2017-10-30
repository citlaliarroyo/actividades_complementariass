-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2017 a las 19:01:42
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `solicitudes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `act_complementaria`
--

CREATE TABLE `act_complementaria` (
  `clave_act` int(11) NOT NULL,
  `nombre_act` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `act_complementaria`
--

INSERT INTO `act_complementaria` (`clave_act`, `nombre_act`) VALUES
(1, 'Tutorias'),
(2, 'Ajedrez'),
(3, 'Futbol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `clave_carrera` varchar(45) NOT NULL,
  `nombre_carrera` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`clave_carrera`, `nombre_carrera`) VALUES
('COPU-2010-205', 'Contador Publico'),
('IAGR-2010-214', 'Ingenieria en Agronomia'),
('IAMD-2010-213', 'Ingenieria en Administracion'),
('IINF-2010-220', 'Ingenieria en Informatica'),
('LADM-2010-234', 'Licenciatura en Administracion'),
('LBIO-2010-233', 'Licenciatura en Biologia'),
('SICO-2010-254', 'SISTEMAS DE COMPUTACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `ClaveDepa` varchar(45) NOT NULL,
  `nombre_depa` varchar(45) DEFAULT NULL,
  `trabajador_rfc` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`ClaveDepa`, `nombre_depa`, `trabajador_rfc`) VALUES
('1', 'SISTEMAS Y COMPUTACION', 'GOVL801204159'),
('2', 'DESARROLLO ACADEMICO', 'DORI23586'),
('3', 'RECURSOS HUMANOS', 'AVAM293458');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `No_control` int(11) NOT NULL,
  `nombre_estudiante` varchar(45) DEFAULT NULL,
  `apellido_paterno_estudiante` varchar(45) DEFAULT NULL,
  `apellido_materno_estudiante` varchar(45) DEFAULT NULL,
  `semestre` varchar(45) DEFAULT NULL,
  `carrera_clave_carrera` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`No_control`, `nombre_estudiante`, `apellido_paterno_estudiante`, `apellido_materno_estudiante`, `semestre`, `carrera_clave_carrera`) VALUES
(15930000, 'ALONDRA', 'JAIMES', 'GUTIERREZ', 'V', 'IINF-2010-220'),
(15930129, 'DANIEL', 'MACEDONIO', 'BEDOLLA', 'V', 'IINF-2010-220'),
(15930159, 'CITLALI', 'ARROYO', 'ROMERO', 'V', 'IINF-2010-220'),
(15930163, 'ALAN HENRY', 'ALCANTAR', 'MEDRANO', 'V', 'IINF-2010-220'),
(15930208, 'JORGE', 'ROQUE', 'PINEDA', 'V', 'IINF-2010-220');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituto`
--

CREATE TABLE `instituto` (
  `clave_instituto` varchar(45) NOT NULL,
  `nombre_instituto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `instituto`
--

INSERT INTO `instituto` (`clave_instituto`, `nombre_instituto`) VALUES
('1123ETDGH', 'INSTITUTO VICENTE GUERRERO'),
('12IT0005B', 'INSTITUTO TECNOLOGICO DE CIUDAD ALTAMIRANO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `rfc_instructor` varchar(45) NOT NULL,
  `nombre_instructor` varchar(45) DEFAULT NULL,
  `apellido_paterno_instructor` varchar(45) DEFAULT NULL,
  `apellido_materno_instructor` varchar(45) DEFAULT NULL,
  `act_complementaria_clave_act` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`rfc_instructor`, `nombre_instructor`, `apellido_paterno_instructor`, `apellido_materno_instructor`, `act_complementaria_clave_act`) VALUES
('DORI23586', 'ISMAEL', 'DOMINGUEZ', 'RUEDA', 3),
('GOVL801204159', 'LEONEL', 'GONZALEZ', 'VIDALES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `folio` int(11) NOT NULL,
  `asunto` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `instituto_clave_instituto` varchar(45) NOT NULL,
  `instructor_rfc_instructor` varchar(45) NOT NULL,
  `estudiante_No_control_estudiante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`folio`, `asunto`, `fecha`, `lugar`, `instituto_clave_instituto`, `instructor_rfc_instructor`, `estudiante_No_control_estudiante`) VALUES
(1, 'Inscripcion', '2017-10-24', 'Altamirano', '1123ETDGH', 'DORI23586', 15930159),
(2, 'Reinscripcion', '2017-08-23', 'Altamirano', '12IT0005B', 'GOVL801204159', 15930208);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `rfc_trabajador` varchar(45) NOT NULL,
  `nombre_trabajador` varchar(45) DEFAULT NULL,
  `apellido_paterno_trabajador` varchar(45) DEFAULT NULL,
  `apellido_materno_trabajador` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`rfc_trabajador`, `nombre_trabajador`, `apellido_paterno_trabajador`, `apellido_materno_trabajador`) VALUES
('AVAM293458', 'MARIA', 'AVILEZ', 'ANTUNEZ'),
('DORI23586', 'ISMAEL', 'DOMINGUEZ', 'RUEDA'),
('GOVL801204159', 'LEONEL', 'GONZALEZ', 'VIDALES');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `act_complementaria`
--
ALTER TABLE `act_complementaria`
  ADD PRIMARY KEY (`clave_act`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`clave_carrera`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`ClaveDepa`),
  ADD KEY `fk_departamento_trabajador1_idx` (`trabajador_rfc`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`No_control`,`carrera_clave_carrera`),
  ADD KEY `fk_estudiante_carrera1_idx` (`carrera_clave_carrera`);

--
-- Indices de la tabla `instituto`
--
ALTER TABLE `instituto`
  ADD PRIMARY KEY (`clave_instituto`);

--
-- Indices de la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`rfc_instructor`),
  ADD KEY `fk_instructor_act_complementaria_idx` (`act_complementaria_clave_act`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`folio`),
  ADD KEY `fk_solicitud_instituto1_idx` (`instituto_clave_instituto`),
  ADD KEY `fk_solicitud_instructor1_idx` (`instructor_rfc_instructor`),
  ADD KEY `fk_solicitud_estudiante1_idx` (`estudiante_No_control_estudiante`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`rfc_trabajador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `folio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_departamento_trabajador1` FOREIGN KEY (`trabajador_rfc`) REFERENCES `trabajador` (`rfc_trabajador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_estudiante_carrera1` FOREIGN KEY (`carrera_clave_carrera`) REFERENCES `carrera` (`clave_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `fk_instructor_act_complementaria` FOREIGN KEY (`act_complementaria_clave_act`) REFERENCES `act_complementaria` (`clave_act`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `fk_solicitud_estudiante1` FOREIGN KEY (`estudiante_No_control_estudiante`) REFERENCES `estudiante` (`No_control`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_instituto1` FOREIGN KEY (`instituto_clave_instituto`) REFERENCES `instituto` (`clave_instituto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_instructor1` FOREIGN KEY (`instructor_rfc_instructor`) REFERENCES `instructor` (`rfc_instructor`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

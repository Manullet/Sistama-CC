-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2023 a las 17:33:11
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_cc`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertObejtos` (IN `newObjeto` VARCHAR(255), IN `newDescripcion` VARCHAR(255), IN `newActualizado_Por` VARCHAR(255), IN `newCreado_Por` VARCHAR(255))   BEGIN
    DECLARE currentDate TIMESTAMP;
    SET currentDate = NOW();
 INSERT INTO objetos(Objeto, Descripcion, Actualizado_Por, Creado_Por, Fecha_Creacion,Fecha_Actualizacon, Status)
    VALUES (newObjeto , newDescripcion, newActualizado_Por, newCreado_Por, currentDate, currentDate,'Activo');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertPermisos` (IN `newId_rol` BIGINT(20), IN `newId_objetos` BIGINT(20), IN `newpermiso_eliminacion` VARCHAR(10), IN `newpermiso_actualizacion` VARCHAR(10), IN `newpermiso_consulta` VARCHAR(10), IN `newpermiso_insercion` VARCHAR(10), IN `newCreado_Por` BIGINT(20), IN `newEstado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP;  
    
    SET currentDate = NOW();  
    
    INSERT INTO permisos (Id_rol, Id_objetos, permiso_eliminacion, permiso_actualizacion, permiso_consulta, permiso_insercion, Creado_Por, Fecha_Creacion, Fecha_Actualizacion, Estado)
    VALUES (newId_rol, newId_objetos, newpermiso_eliminacion, newpermiso_actualizacion, newpermiso_consulta, newpermiso_insercion, newCreado_Por, currentDate, currentDate, newEstado );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertPreguntas` (IN `newPregunta` VARCHAR(255), IN `newActualizado_Por` VARCHAR(255), IN `newCreador_Por` VARCHAR(255))   BEGIN
    DECLARE currentDate TIMESTAMP;
    SET currentDate = NOW();
 INSERT INTO Preguntas (Pregunta, Actualizado_Por, Creador_Por, Fecha_Creacion, Fecha_Actualizacion)
    VALUES (newPregunta, newActualizado_Por, newCreador_Por, currentDate, currentDate);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRoles` (IN `newNombre` VARCHAR(255), IN `newDescripcion` VARCHAR(255))   BEGIN
    DECLARE currentDate TIMESTAMP;  
    SET currentDate = NOW();  
    
    INSERT INTO roles (Nombre, Descripcion, Creado_Por, Fecha_Creacion, Actualizado_Por, Fecha_Actualizacion, STATUS)
    VALUES (newNombre, newDescripcion, 1, currentDate, 1, currentDate, 'Activo');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUsuario` (IN `newNombre` VARCHAR(255), IN `newCorreo` VARCHAR(255), IN `newUsuario` VARCHAR(255), IN `newContraseña` VARCHAR(255))   BEGIN
    DECLARE currentDate TIMESTAMP;
    DECLARE estado VARCHAR(255);
  

    INSERT INTO `usuario`(`Id_rol`, `nombre_completo`, `correo`, `usuario`, `contrasena`, `Token`, `Fecha_Creacion`, `Actualizado_Por`, `Fecha_Actualizacion`, `Preguntas_Contestadas`, `Estado`, `Id_estado`, `Primera_Vez`, `Fecha_Vencimiento`, `Intentos_Preguntas`, `Preguntas_Correctas`, `Intentos_Fallidos`) 
    VALUES (1, `newNombre`, `newCorreo`, `newUsuario`, `newContraseña`, '', currentDate, '', currentDate, 1, 1, 1, 1, CURRENT_TIMESTAMP, 1, 1, 1);
END$$

CREATE DEFINER=`ppa`@`%` PROCEDURE `Sp_permiso_actualizar` (IN `ROL` INT, IN `OBJETO` INT)   BEGIN
START TRANSACTION;
IF NOT EXISTS (SELECT * FROM usuario u WHERE u.Id_rol = ROL) THEN
SET @m='EL TIPO DE ROL NO EXISTE';
SELECT @m;
ELSEIF NOT EXISTS (SELECT * FROM objetos ob WHERE ob.Id_objetos = OBJETO) THEN
SET @m='El objeto no existe';
SELECT @m;
ELSE
SELECT p.permiso_actualizacion
FROM permisos p
WHERE p.Id_rol = ROL
AND p.Id_objetos = OBJETO;
END IF;
COMMIT;
END$$

CREATE DEFINER=`ppa`@`%` PROCEDURE `Sp_permiso_eliminar` (IN `ROL` INT, IN `OBJETO` INT)   BEGIN
START TRANSACTION;
IF NOT EXISTS (SELECT * FROM usuario u WHERE u.Id_rol = ROL) THEN
SET @m='EL TIPO DE ROL NO EXISTE';
SELECT @m;
ELSEIF NOT EXISTS (SELECT * FROM objetos ob WHERE ob.Id_objetos = OBJETO) THEN
SET @m='El objeto no existe';
SELECT @m;
ELSE
SELECT p.permiso_eliminacion
FROM permisos p
WHERE p.Id_rol = ROL
AND p.Id_objetos = OBJETO;
END IF;
COMMIT;
END$$

CREATE DEFINER=`ppa`@`%` PROCEDURE `Sp_permiso_insertar` (IN `ROL` INT, IN `OBJETO` INT)   BEGIN
START TRANSACTION;
IF NOT EXISTS (SELECT * FROM usuario u WHERE u.Id_rol = ROL) THEN
SET @m='EL TIPO DE ROL NO EXISTE';
SELECT @m;
ELSEIF NOT EXISTS (SELECT * FROM objetos ob WHERE ob.Id_objetos = OBJETO) THEN
SET @m='El objeto no existe';
SELECT @m;
ELSE
SELECT p.permiso_insercion
FROM permisos p
WHERE p.Id_rol = ROL
AND p.Id_objetos = OBJETO;
END IF;
COMMIT;
END$$

CREATE DEFINER=`ppa`@`%` PROCEDURE `Sp_permiso_mostrar` (IN `ROL` INT, IN `OBJETO` INT)   BEGIN
START TRANSACTION;
IF NOT EXISTS (SELECT * FROM usuario u WHERE u.Id_rol = ROL) THEN
SET @m='EL TIPO DE ROL NO EXISTE';
SELECT @m;
ELSEIF NOT EXISTS (SELECT * FROM objetos ob WHERE ob.Id_objetos = OBJETO) THEN
SET @m='El objeto no existe';
SELECT @m;
ELSE
SELECT p.permiso_consultar
FROM permisos p
WHERE p.Id_rol = ROL
AND p.Id_objetos = OBJETO;
END IF;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateObjeto` (IN `newID_Objeto` BIGINT(20), IN `newObjeto` VARCHAR(255), IN `newDescripcion` VARCHAR(255), IN `newActualizado_Por` VARCHAR(255), IN `newCreado_Por` VARCHAR(255), IN `newStatus` VARCHAR(255))   BEGIN
    UPDATE objetos
    SET Objeto = newObjeto,
        Descripcion = newDescripcion,
        Actualizado_Por = newActualizado_Por,
        Creado_Por = newCreado_Por,
        Fecha_Actualizacon = CURRENT_TIMESTAMP,
        Status = newStatus
    WHERE Id_objetos = newID_Objeto;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePermiso` (IN `newId_Permisos` BIGINT(20), IN `newpermiso_eliminacion` VARCHAR(10), IN `newpermiso_actualizacion` VARCHAR(10), IN `newpermiso_consulta` VARCHAR(10), IN `newpermiso_insercion` VARCHAR(10), IN `newActualizado_Por` BIGINT(20), IN `newEstado` ENUM('ACTIVO','INACTIVO'))   BEGIN 
    UPDATE permisos
    SET permiso_eliminacion = newpermiso_eliminacion,
        permiso_actualizacion = newpermiso_actualizacion,
        permiso_consulta = newpermiso_consulta,
        permiso_insercion = newpermiso_insercion,
        Actualizado_Por = newActualizado_Por,
        Fecha_Actualizacion = CURRENT_TIMESTAMP,
        Estado = newEstado
        WHERE Id_Permisos = newId_Permisos;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePregunta` (IN `p_Id_pregunta` INT, IN `p_Pregunta` VARCHAR(255), IN `p_Actualizado_Por` VARCHAR(255))   BEGIN
    UPDATE Preguntas
    SET
        Pregunta = p_Pregunta,
        Actualizado_Por = p_Actualizado_Por
    WHERE Id_pregunta = p_Id_pregunta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateRole` (IN `newIdRol` BIGINT(20), IN `newNombre` VARCHAR(255), IN `newDescripcion` VARCHAR(255), IN `newStatus` VARCHAR(255))   BEGIN
    UPDATE roles
    SET Nombre = newNombre,
    	Descripcion = newDescripcion,
        STATUS = newStatus,
        Fecha_Actualizacion = CURRENT_TIMESTAMP
    WHERE Id_rol = newIdRol;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUsuario` (IN `newId_Usuario` BIGINT(20), IN `newNombre` VARCHAR(255), IN `newUsuario` VARCHAR(255), IN `newCorreo` VARCHAR(255), IN `newEstado` ENUM('ACTIVO','INACTIVO','PENDIENTE'))   BEGIN
    UPDATE usuario
    SET nombre_completo = newNombre,
         usuario= newUsuario,
         correo= newCorreo,
         Estado= newEstado,
        Fecha_Actualizacion = CURRENT_TIMESTAMP
    WHERE id = newId_Usuario;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

CREATE TABLE `bitacoras` (
  `Id_bitacoras` bigint(20) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Tabla` varchar(255) NOT NULL,
  `Accion` varchar(255) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `Id_objetos` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_permisos`
--

CREATE TABLE `model_permisos` (
  `Id_Permisos` bigint(20) NOT NULL,
  `Tipo_Modelo` varchar(255) NOT NULL,
  `Modelo_Id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_roles`
--

CREATE TABLE `model_roles` (
  `Rol_Id` bigint(20) NOT NULL,
  `Tipo_Modelo` varchar(255) NOT NULL,
  `Modelo_Id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetos`
--

CREATE TABLE `objetos` (
  `Id_objetos` bigint(20) NOT NULL,
  `Objeto` varchar(255) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `tipo_objeto` varchar(50) NOT NULL,
  `Creado_Por` bigint(20) NOT NULL,
  `Fecha_Creacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Actualizado_Por` bigint(20) NOT NULL,
  `Fecha_Actualizacon` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` enum('Activo','Inactivo','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `objetos`
--

INSERT INTO `objetos` (`Id_objetos`, `Objeto`, `Descripcion`, `tipo_objeto`, `Creado_Por`, `Fecha_Creacion`, `Actualizado_Por`, `Fecha_Actualizacon`, `Status`) VALUES
(1, 'login', 'inicio de sesion', 'pantalla', 1, '2023-10-18 06:32:23', 1, '2023-10-20 06:32:23', 'Activo'),
(5, 'Bienvenida', 'Pantalla de Bienvenida al Sistema', '', 1, '2023-10-28 17:07:38', 1, '2023-10-28 17:07:38', 'Activo'),
(7, 'Registro', 'Cambiar Contraseña', '', 1, '2023-10-29 09:31:12', 1, '2023-10-29 09:31:12', 'Activo'),
(9, '1', 'Mantenimiento', '', 1, '2023-10-29 10:40:33', 1, '2023-10-29 10:40:33', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `Id_parametros` bigint(20) NOT NULL,
  `id` bigint(20) NOT NULL,
  `Parametro` varchar(255) NOT NULL,
  `Valor` varchar(255) NOT NULL,
  `Fecha_Creacion` timestamp NULL DEFAULT NULL,
  `Fecha_Actualizacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`Id_parametros`, `id`, `Parametro`, `Valor`, `Fecha_Creacion`, `Fecha_Actualizacion`) VALUES
(2, 1, 'Intentos_Fallidos', '3', '2022-09-27 05:46:41', '2022-09-27 05:46:41'),
(3, 1, 'Admin_Preguntas', '2', '2022-10-17 21:11:00', NULL),
(4, 1, 'Vigencia_Usuario', '30', '2022-10-26 02:00:00', NULL),
(5, 1, 'Min_Contraseña', '5', '2022-10-26 02:00:00', NULL),
(6, 1, 'Max_Contraseña', '16', '2022-10-26 02:00:00', NULL),
(7, 1, 'Intentos_Preguntas', '3', '2022-10-26 02:00:00', NULL),
(8, 1, 'Min_Usuario', '5', '2022-10-26 13:00:00', NULL),
(12, 1, 'Max_Usuario', '15', '2022-11-22 00:39:05', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `Id_Permisos` bigint(20) NOT NULL,
  `Id_rol` bigint(20) NOT NULL,
  `Id_objetos` bigint(20) NOT NULL,
  `permiso_eliminacion` varchar(10) NOT NULL,
  `permiso_actualizacion` varchar(10) NOT NULL,
  `permiso_consulta` varchar(10) NOT NULL,
  `permiso_insercion` varchar(10) NOT NULL,
  `Creado_Por` bigint(20) NOT NULL,
  `Fecha_Creacion` timestamp NULL DEFAULT current_timestamp(),
  `Actualizado_Por` bigint(20) NOT NULL,
  `Fecha_Actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `Estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`Id_Permisos`, `Id_rol`, `Id_objetos`, `permiso_eliminacion`, `permiso_actualizacion`, `permiso_consulta`, `permiso_insercion`, `Creado_Por`, `Fecha_Creacion`, `Actualizado_Por`, `Fecha_Actualizacion`, `Estado`) VALUES
(1, 1, 1, 'SI', 'SI', 'SI', 'SI', 1, '2023-10-17 06:35:58', 1, '2023-10-19 06:35:58', 'ACTIVO'),
(57, 1, 1, 'NO', 'NO', 'NO', 'NO', 1, '2023-10-29 06:37:37', 1, '2023-10-29 07:27:12', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `Id_pregunta` bigint(20) NOT NULL,
  `Pregunta` varchar(255) NOT NULL,
  `Creador_Por` bigint(20) NOT NULL,
  `Fecha_Creacion` timestamp NULL DEFAULT current_timestamp(),
  `Actualizado_Por` bigint(20) NOT NULL,
  `Fecha_Actualizacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`Id_pregunta`, `Pregunta`, `Creador_Por`, `Fecha_Creacion`, `Actualizado_Por`, `Fecha_Actualizacion`) VALUES
(1, '¿Cuál es tu color favorito?', 1, '2023-10-11 03:45:08', 1, '2023-10-12 03:45:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperar_clave`
--

CREATE TABLE `recuperar_clave` (
  `Correo` varchar(255) NOT NULL,
  `Token` varchar(255) NOT NULL,
  `Fecha_Creacion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `Id_pregunta` bigint(20) NOT NULL,
  `Id_Usuario` bigint(20) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `Fecha_Creacion` timestamp NULL DEFAULT NULL,
  `Fecha_Actualizacion` timestamp NULL DEFAULT NULL,
  `Id_respuesta` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Id_rol` bigint(20) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` varchar(60) NOT NULL,
  `Creado_Por` bigint(20) NOT NULL,
  `Fecha_Creacion` timestamp NULL DEFAULT current_timestamp(),
  `Actualizado_Por` bigint(20) NOT NULL,
  `Fecha_Actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `STATUS` enum('ACTIVO','INACTIVO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id_rol`, `Nombre`, `Descripcion`, `Creado_Por`, `Fecha_Creacion`, `Actualizado_Por`, `Fecha_Actualizacion`, `STATUS`) VALUES
(1, 'ADMINISTRADOR', 'ADMIN', 1, '2023-10-17 06:01:16', 2, '2023-10-18 06:01:16', 'ACTIVO'),
(11, 'Profesor', 'Este rol es para que el profesor pueda hacer pruebas durante', 1, '2023-10-29 15:16:00', 1, '2023-10-29 15:16:00', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permisos`
--

CREATE TABLE `rol_permisos` (
  `id_permisos` bigint(20) DEFAULT NULL,
  `rol_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `Id_Sesion` varchar(255) NOT NULL,
  `Usuario_Id` bigint(20) DEFAULT NULL,
  `Direccion_Ip` varchar(45) DEFAULT NULL,
  `Usuario_Agente` text DEFAULT NULL,
  `Payload` text NOT NULL,
  `Ultima_Actividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias_especies`
--

CREATE TABLE `tbl_categorias_especies` (
  `id_categoria_especie` bigint(20) NOT NULL,
  `categoria_especie` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `modificado_por` bigint(20) NOT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL,
  `id_sector` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_categorias_especies`
--

INSERT INTO `tbl_categorias_especies` (`id_categoria_especie`, `categoria_especie`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `estado`, `id_sector`) VALUES
(1, 'GANADO', 'Ganado vacuno y porcino', 1, '2023-10-11 00:38:11', 2, '2023-10-14 00:38:11', 'INACTIVO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias_fichas`
--

CREATE TABLE `tbl_categorias_fichas` (
  `id_sector` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `categoria_ficha` varchar(45) NOT NULL,
  `codigo_categoria_ficha` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `hoja` varchar(45) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `formula` varchar(255) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `modificado_por` bigint(20) NOT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL,
  `id_ficha` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_categorias_fichas`
--

INSERT INTO `tbl_categorias_fichas` (`id_sector`, `id_categoria_ficha`, `categoria_ficha`, `codigo_categoria_ficha`, `descripcion`, `hoja`, `referencia`, `formula`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `estado`, `id_ficha`) VALUES
(1, 2, 'urea', 'asdhbdjhds', 'sjdbjkdbjsn', 'sdada', 'adadad', 'a*2', 1, '2023-10-12 17:47:50', 2, '2023-10-19 17:47:50', 'INACTIVO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_criterio_medicion`
--

CREATE TABLE `tbl_criterio_medicion` (
  `nivel_medicion` int(11) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `criterio_medicion` varchar(255) NOT NULL,
  `unidad_medicion` varchar(255) NOT NULL,
  `encabezado_segun_categoria` varchar(255) NOT NULL,
  `sigla` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `modificado_por` bigint(20) NOT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_criterio_medicion`
--

INSERT INTO `tbl_criterio_medicion` (`nivel_medicion`, `id_criterios_medicion`, `id_categoria_ficha`, `criterio_medicion`, `unidad_medicion`, `encabezado_segun_categoria`, `sigla`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `estado`) VALUES
(11, 1, 2, 'Gases de efecto invernadero criterio de medición', 'Kg', 'urea', 'asdff', 'Provoca cambio climático', 1, '2023-10-19 16:41:53', 2, '2023-10-23 16:41:53', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_especie`
--

CREATE TABLE `tbl_especie` (
  `id_sector` bigint(20) NOT NULL,
  `id_categoria_especie` bigint(20) NOT NULL,
  `id_especie` bigint(20) NOT NULL,
  `especie` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `modificado_por` bigint(20) NOT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_especie`
--

INSERT INTO `tbl_especie` (`id_sector`, `id_categoria_especie`, `id_especie`, `especie`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `estado`) VALUES
(1, 1, 1, 'Ganado Porcino ', 'Producen muchos gases de efecto invernadero', 1, '2023-10-13 01:01:01', 2, '2023-10-24 01:01:01', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_usuario`
--

CREATE TABLE `tbl_estado_usuario` (
  `id_estado` bigint(20) NOT NULL,
  `Estado` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_estado_usuario`
--

INSERT INTO `tbl_estado_usuario` (`id_estado`, `Estado`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO'),
(3, 'NUEVO'),
(4, 'BLOQUEADO ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fermentacion_estiercol`
--

CREATE TABLE `tbl_fermentacion_estiercol` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` int(11) NOT NULL,
  `id_fermentacion` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` date NOT NULL,
  `numero_ficha` int(11) NOT NULL,
  `id_categoria_especie` bigint(20) NOT NULL,
  `id_especie` bigint(20) NOT NULL,
  `categoria_medicion` varchar(45) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `cantidad_especie` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `sigla` varchar(45) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `modificado_por` bigint(20) NOT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_fermentacion_estiercol`
--

INSERT INTO `tbl_fermentacion_estiercol` (`id_ficha`, `id_categoria_ficha`, `nivel_medicion`, `id_fermentacion`, `id_sector`, `anio`, `numero_ficha`, `id_categoria_especie`, `id_especie`, `categoria_medicion`, `id_criterios_medicion`, `cantidad_especie`, `descripcion`, `sigla`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `estado`) VALUES
(1, 2, 123, 3, 1, '2023-10-23', 2, 1, 1, 'kg', 1, 23, 'Ganado porcino que causa gases de efecto invernadero', 'gp', 1, '2023-10-05 17:10:17', 2, '2023-10-24 17:10:17', 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fermentacion_estiercol_documentacion`
--

CREATE TABLE `tbl_fermentacion_estiercol_documentacion` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `id_fermentacion` bigint(20) NOT NULL,
  `descripcion_documentacion` varchar(255) NOT NULL,
  `url` varchar(45) NOT NULL,
  `carpeta` varchar(45) NOT NULL,
  `binario` binary(1) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `modificado_por` bigint(20) NOT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_fermentacion_estiercol_documentacion`
--

INSERT INTO `tbl_fermentacion_estiercol_documentacion` (`id_ficha`, `id_categoria_ficha`, `id_fermentacion`, `descripcion_documentacion`, `url`, `carpeta`, `binario`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `estado`) VALUES
(1, 2, 3, 'Reducir los gases de efecto invernadero para evitar los efectos del cambio climático', 'https', 'Fermentacion', 0x01, 'Fermentación Estiercol', 1, '2023-10-16 17:40:21', 2, '2023-10-23 17:40:21', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fichas`
--

CREATE TABLE `tbl_fichas` (
  `id_ficha` bigint(20) NOT NULL,
  `fecha_solicitud` timestamp NULL DEFAULT NULL,
  `anio_solicitud` timestamp NULL DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `modificado_por` bigint(20) NOT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL,
  `fecha_entrevista` timestamp NULL DEFAULT NULL,
  `nombre_encuentador` varchar(255) NOT NULL,
  `firma_productor` varchar(45) NOT NULL,
  `nombre_encuestador` varchar(255) NOT NULL,
  `firma_encuestador` varchar(45) NOT NULL,
  `nombre_supervisor` varchar(255) NOT NULL,
  `firma_supervisor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_fichas`
--

INSERT INTO `tbl_fichas` (`id_ficha`, `fecha_solicitud`, `anio_solicitud`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `estado`, `fecha_entrevista`, `nombre_encuentador`, `firma_productor`, `nombre_encuestador`, `firma_encuestador`, `nombre_supervisor`, `firma_supervisor`) VALUES
(1, '2023-10-11 17:26:30', '2016-10-28 17:26:30', 'Para los Gases de Efecto Invernadero', 1, '2023-10-03 17:26:30', 2, '2023-10-22 17:26:30', 'ACTIVO', '2023-10-04 17:26:30', 'Luis Aleman', 'jsgdjhgsdjgds', 'Roberto Peña', 'shvdjadshvjsd', 'Marco Isidro', 'cxvfdvc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_hist_contrasena`
--

CREATE TABLE `tbl_hist_contrasena` (
  `id_hist` bigint(20) NOT NULL,
  `id` bigint(20) NOT NULL,
  `contrasena` varchar(60) NOT NULL,
  `Creado_Por` varchar(50) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Actualizado_Por` varchar(50) DEFAULT NULL,
  `Fecha_Modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_parametros`
--

CREATE TABLE `tbl_parametros` (
  `id_parametros` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `parametro` varchar(30) NOT NULL,
  `valor` varchar(20) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Fecha_Modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_preguntas_usuario`
--

CREATE TABLE `tbl_preguntas_usuario` (
  `Id_Pregunta_U` bigint(20) NOT NULL,
  `Id_pregunta` bigint(20) NOT NULL,
  `id` bigint(20) DEFAULT NULL,
  `Respuestas` varchar(100) NOT NULL,
  `Creado_Por` varchar(80) DEFAULT NULL,
  `Fecha_Creacion` datetime DEFAULT NULL,
  `Modificado_Por` varchar(80) DEFAULT NULL,
  `Fecha_Modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_preguntas_usuario`
--

INSERT INTO `tbl_preguntas_usuario` (`Id_Pregunta_U`, `Id_pregunta`, `id`, `Respuestas`, `Creado_Por`, `Fecha_Creacion`, `Modificado_Por`, `Fecha_Modificacion`) VALUES
(1, 1, 1, 'Rojo', '1', '2023-10-27 22:53:34', '1', '2023-10-31 22:53:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sector`
--

CREATE TABLE `tbl_sector` (
  `id_sector` bigint(20) NOT NULL,
  `sector` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `modificado_por` bigint(20) NOT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_sector`
--

INSERT INTO `tbl_sector` (`id_sector`, `sector`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `estado`) VALUES
(1, 'urea', 'gas de efecto invernadero', 1, '2023-10-11 17:50:33', 2, '2023-10-25 17:50:33', 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `Token` varchar(100) DEFAULT NULL,
  `Fecha_Creacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `Preguntas_Contestadas` int(11) NOT NULL,
  `Estado` enum('ACTIVO','INACTIVO','PENDIENTE','') NOT NULL,
  `Primera_Vez` enum('SI','NO','','') NOT NULL,
  `Fecha_Vencimiento` timestamp NULL DEFAULT current_timestamp(),
  `Intentos_Preguntas` int(11) NOT NULL,
  `Preguntas_Correctas` int(11) DEFAULT NULL,
  `Id_rol` bigint(20) NOT NULL,
  `id_estado` bigint(20) NOT NULL,
  `Creado_Por` bigint(20) NOT NULL,
  `Actualizado_Por` bigint(20) NOT NULL,
  `Intentos_Fallidos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre_completo`, `correo`, `usuario`, `contrasena`, `Token`, `Fecha_Creacion`, `Fecha_Actualizacion`, `Preguntas_Contestadas`, `Estado`, `Primera_Vez`, `Fecha_Vencimiento`, `Intentos_Preguntas`, `Preguntas_Correctas`, `Id_rol`, `id_estado`, `Creado_Por`, `Actualizado_Por`, `Intentos_Fallidos`) VALUES
(1, 'josefina', 'josefina@gmail.com', 'josefinaABC', '', 'A', '2023-10-28 04:17:14', '2023-10-14 03:50:34', 0, 'ACTIVO', 'SI', '2023-11-01 03:50:34', 0, 0, 1, 3, 1, 1, 0),
(2, 'kike', 'kike@gmail.com', 'kikeE', '123', 'A', '2023-10-27 06:03:37', '2023-10-28 06:03:37', 0, 'ACTIVO', 'SI', '2023-10-31 06:03:37', 0, 0, 1, 1, 1, 1, 0),
(19, 'Profesordos', 'profesorABC@gmail.com', 'profesor', 'hola123', '', '2023-10-29 15:09:06', '2023-10-29 15:09:06', 1, 'ACTIVO', 'SI', '2023-10-29 15:04:47', 1, 1, 1, 1, 0, 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `objetos`
--
ALTER TABLE `objetos`
  ADD PRIMARY KEY (`Id_objetos`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`Id_parametros`),
  ADD KEY `Parametro_Usuario_id` (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`Id_Permisos`),
  ADD KEY `Permisos_Objeto` (`Id_objetos`),
  ADD KEY `Permisos_Rol` (`Id_rol`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`Id_pregunta`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id_rol`);

--
-- Indices de la tabla `tbl_categorias_especies`
--
ALTER TABLE `tbl_categorias_especies`
  ADD PRIMARY KEY (`id_categoria_especie`);

--
-- Indices de la tabla `tbl_categorias_fichas`
--
ALTER TABLE `tbl_categorias_fichas`
  ADD PRIMARY KEY (`id_sector`),
  ADD KEY `fk_id_ficha` (`id_ficha`);

--
-- Indices de la tabla `tbl_criterio_medicion`
--
ALTER TABLE `tbl_criterio_medicion`
  ADD PRIMARY KEY (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_especie`
--
ALTER TABLE `tbl_especie`
  ADD PRIMARY KEY (`id_especie`),
  ADD KEY `id_categoria_especie_idx` (`id_categoria_especie`);

--
-- Indices de la tabla `tbl_estado_usuario`
--
ALTER TABLE `tbl_estado_usuario`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `tbl_fermentacion_estiercol`
--
ALTER TABLE `tbl_fermentacion_estiercol`
  ADD PRIMARY KEY (`id_fermentacion`),
  ADD KEY `id_especie_idx` (`id_especie`);

--
-- Indices de la tabla `tbl_fermentacion_estiercol_documentacion`
--
ALTER TABLE `tbl_fermentacion_estiercol_documentacion`
  ADD PRIMARY KEY (`descripcion_documentacion`),
  ADD KEY `id_fermentacion_idx` (`id_fermentacion`);

--
-- Indices de la tabla `tbl_fichas`
--
ALTER TABLE `tbl_fichas`
  ADD PRIMARY KEY (`id_ficha`);

--
-- Indices de la tabla `tbl_hist_contrasena`
--
ALTER TABLE `tbl_hist_contrasena`
  ADD PRIMARY KEY (`id_hist`),
  ADD KEY `Hist_Usuario_id` (`id`);

--
-- Indices de la tabla `tbl_preguntas_usuario`
--
ALTER TABLE `tbl_preguntas_usuario`
  ADD PRIMARY KEY (`Id_Pregunta_U`),
  ADD KEY `Preguntas_idx` (`Id_pregunta`),
  ADD KEY `Preguntas_Usuario_idx` (`id`);

--
-- Indices de la tabla `tbl_sector`
--
ALTER TABLE `tbl_sector`
  ADD PRIMARY KEY (`sector`),
  ADD KEY `fk_id_sector` (`id_sector`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Estado` (`id_estado`),
  ADD KEY `Rol` (`Id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `objetos`
--
ALTER TABLE `objetos`
  MODIFY `Id_objetos` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `Id_parametros` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `Id_Permisos` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `Id_pregunta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_rol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_categorias_especies`
--
ALTER TABLE `tbl_categorias_especies`
  MODIFY `id_categoria_especie` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_fermentacion_estiercol`
--
ALTER TABLE `tbl_fermentacion_estiercol`
  MODIFY `id_fermentacion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_fichas`
--
ALTER TABLE `tbl_fichas`
  MODIFY `id_ficha` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD CONSTRAINT `Parametro_Usuario` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `Permisos_Objeto` FOREIGN KEY (`Id_objetos`) REFERENCES `objetos` (`Id_objetos`),
  ADD CONSTRAINT `Permisos_Rol` FOREIGN KEY (`Id_rol`) REFERENCES `roles` (`Id_rol`);

--
-- Filtros para la tabla `tbl_categorias_fichas`
--
ALTER TABLE `tbl_categorias_fichas`
  ADD CONSTRAINT `fk_id_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `tbl_fichas` (`id_ficha`);

--
-- Filtros para la tabla `tbl_especie`
--
ALTER TABLE `tbl_especie`
  ADD CONSTRAINT `id_categoria_especie` FOREIGN KEY (`id_categoria_especie`) REFERENCES `tbl_categorias_especies` (`id_categoria_especie`);

--
-- Filtros para la tabla `tbl_fermentacion_estiercol`
--
ALTER TABLE `tbl_fermentacion_estiercol`
  ADD CONSTRAINT `id_especie` FOREIGN KEY (`id_especie`) REFERENCES `tbl_especie` (`id_especie`);

--
-- Filtros para la tabla `tbl_fermentacion_estiercol_documentacion`
--
ALTER TABLE `tbl_fermentacion_estiercol_documentacion`
  ADD CONSTRAINT `id_fermentacion` FOREIGN KEY (`id_fermentacion`) REFERENCES `tbl_fermentacion_estiercol` (`id_fermentacion`);

--
-- Filtros para la tabla `tbl_preguntas_usuario`
--
ALTER TABLE `tbl_preguntas_usuario`
  ADD CONSTRAINT `Preguntas_P` FOREIGN KEY (`Id_pregunta`) REFERENCES `preguntas` (`Id_pregunta`),
  ADD CONSTRAINT `Preguntas_U` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `tbl_sector`
--
ALTER TABLE `tbl_sector`
  ADD CONSTRAINT `fk_id_sector` FOREIGN KEY (`id_sector`) REFERENCES `tbl_categorias_fichas` (`id_sector`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `Estado` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estado_usuario` (`id_estado`),
  ADD CONSTRAINT `Rol` FOREIGN KEY (`Id_rol`) REFERENCES `roles` (`Id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

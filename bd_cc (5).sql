-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2023 a las 18:31:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarCategoriaCultivo` (IN `p_id_cultivo` BIGINT, IN `p_cultivo` VARCHAR(255), IN `p_descripcion` VARCHAR(255), IN `p_modificado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO'), IN `p_id_ficha` BIGINT, IN `p_id_sector` BIGINT)   BEGIN
    -- Obtener la fecha y hora actual del sistema
    DECLARE currentDate TIMESTAMP;
    SET currentDate = NOW();

    -- Realizar la actualización en la tabla tbl_categorias_cultivo
    UPDATE tbl_categorias_cultivo
    SET cultivo = p_cultivo,
        descripcion = p_descripcion,
        modificado_por = p_modificado_por,
        fecha_modificacion = currentDate,
        estado = p_estado,
        id_ficha = p_id_ficha,
        id_sector = p_id_sector
    WHERE id_cultivo = p_id_cultivo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarCriterioMedicion` (IN `p_id_criterios_medicion` BIGINT, IN `p_nivel_medicion` INT, IN `p_id_categoria_ficha` BIGINT, IN `p_criterio_medicion` VARCHAR(255), IN `p_unidad_medicion` VARCHAR(255), IN `p_encabezado_segun_categoria` VARCHAR(255), IN `p_sigla` VARCHAR(45), IN `p_descripcion` VARCHAR(255), IN `p_modificado_por` VARCHAR(50), IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    -- Obtener la fecha y hora actual del sistema
    DECLARE currentDate TIMESTAMP;
    
    SET currentDate = NOW();

    -- Realizar la actualización en la tabla tbl_criterio_medicion
    UPDATE tbl_criterio_medicion
    SET
        nivel_medicion = p_nivel_medicion,
        id_categoria_ficha = p_id_categoria_ficha,
        criterio_medicion = p_criterio_medicion,
        unidad_medicion = p_unidad_medicion,
        encabezado_segun_categoria = p_encabezado_segun_categoria,
        sigla = p_sigla,
        descripcion = p_descripcion,
        modificado_por = p_modificado_por,
        fecha_modificacion = currentDate,
        estado = p_estado
    WHERE id_criterios_medicion = p_id_criterios_medicion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarCultivoMedicion` (IN `p_id_cultivos_medicion` BIGINT(20), IN `p_id_ficha` BIGINT(20), IN `p_id_categoria_ficha` BIGINT(20), IN `p_nivel_medicion` INT(20), IN `p_id_sector` BIGINT(20), IN `p_anio` INT(20), IN `p_numero_ficha` INT(20), IN `p_id_cultivo` BIGINT(20), IN `p_id_criterios_medicion` BIGINT(20), IN `p_total` INT(20), IN `p_sigla` VARCHAR(45), IN `p_descripcion` VARCHAR(255), IN `p_tipo_superficie` DECIMAL(10,3), IN `p_masa_combustible` DECIMAL(10,3), IN `p_factor_combustion` DECIMAL(10,3), IN `p_factor_emision_ch` DECIMAL(10,3), IN `p_factor_emision_co` DECIMAL(10,3), IN `p_factor_emision_n2o` DECIMAL(10,3), IN `p_factor_emision_nox` DECIMAL(10,3), IN `p_actualizado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO','',''))   BEGIN
    -- Obtener la fecha y hora actual del sistema
    DECLARE currentDate TIMESTAMP;
    DECLARE emision_ch DECIMAL(50,3);
    DECLARE emision_co DECIMAL(50,3);
    DECLARE emision_n2o DECIMAL(50,3);
    DECLARE emision_nox DECIMAL(50,3);

    SET currentDate = NOW();

    -- Realizar las operaciones
    SET emision_ch = p_tipo_superficie*p_masa_combustible*p_factor_combustion*(p_factor_emision_ch/1000);

SET emision_co = p_tipo_superficie * p_masa_combustible * p_factor_combustion * (p_factor_emision_co / 1000);
SET emision_n2o = p_tipo_superficie * p_masa_combustible * p_factor_combustion * (p_factor_emision_n2o / 1000);
SET emision_nox = p_tipo_superficie * p_masa_combustible * p_factor_combustion * (p_factor_emision_nox / 1000);

    -- Realizar la actualización en la tabla tbl_cultivos_medicion
    UPDATE tbl_cultivos_medicion
    SET
        id_ficha = p_id_ficha,
        id_categoria_ficha = p_id_categoria_ficha,
        nivel_medicion = p_nivel_medicion,
        id_sector = p_id_sector,
        anio = p_anio,
        numero_ficha = p_numero_ficha,
        id_cultivo = p_id_cultivo,
        id_criterios_medicion = p_id_criterios_medicion,
        total = p_total,
        sigla = p_sigla,
        descripcion = p_descripcion,
        tipo_superficie = p_tipo_superficie,
        masa_combustible = p_masa_combustible,
        factor_combustion = p_factor_combustion,
        factor_emision_ch = p_factor_emision_ch,
        factor_emision_co = p_factor_emision_co,
        factor_emision_n2o = p_factor_emision_n2o,
        factor_emision_nox = p_factor_emision_nox,
        emision_ch = emision_ch,
        emision_co = emision_co,
        emision_n2o = emision_n2o,
        emision_nox = emision_nox,
        actualizado_por = p_actualizado_por,
        fecha_actualizacion = CURRENT_TIMESTAMP,
        estado = p_estado
    WHERE id_cultivos_medicion = p_id_cultivos_medicion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarTipoCal` (IN `p_id_tipo_cal` BIGINT, IN `p_tipo_cal` VARCHAR(45), IN `p_id_sector` BIGINT, IN `p_descripcion` VARCHAR(255), IN `p_modificado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    -- Obtener la fecha y hora actual del sistema
    DECLARE currentDate TIMESTAMP;
    SET currentDate = NOW();

    -- Realizar la actualización en la tabla tbl_tipos_cal
    UPDATE tbl_tipos_cal_n
    SET tipo_cal = p_tipo_cal,
        id_sector = p_id_sector,
        descripcion = p_descripcion,
        modificado_por = p_modificado_por,
        fecha_actualizacion = currentDate,
        estado = p_estado
    WHERE id_tipo_cal = p_id_tipo_cal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarUsuario` (IN `p_id` BIGINT(20), IN `p_nombre_completo` VARCHAR(255), IN `p_correo` VARCHAR(255), IN `p_usuario` VARCHAR(255), IN `p_id_estado` BIGINT(20))   BEGIN
    UPDATE usuario
    SET
        nombre_completo = p_nombre_completo,
        correo = p_correo,
        usuario = p_usuario,
        id_estado = p_id_estado
    WHERE
        id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteGestionEstiercolFon` (IN `gestion_estiercol_fon_id` BIGINT)   BEGIN
    DELETE FROM tbl_gestion_mms_estiercol_fon WHERE id_gestion_estiercol_fon = gestion_estiercol_fon_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarSubcategoriaUrea` (IN `p_id_subcategoria_urea` BIGINT(20))   BEGIN
    DELETE FROM tbl_sub_categorias_urea WHERE id_subcategoria_urea = p_id_subcategoria_urea;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarSueloIndirecto` (IN `p_id_suelos_indirectos` INT)   BEGIN
    DELETE FROM tbl_suelos_indirectos WHERE id_suelos_indirectos = p_id_suelos_indirectos;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarSuelosIndirectos` (IN `p_id_suelos_indirectos` BIGINT(20))   BEGIN
    DELETE FROM tbl_suelos_indirectos WHERE id_suelos_indirectos = p_id_suelos_indirectos;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarUsuario` (IN `p_id_usuario` INT)   BEGIN
    DELETE FROM usuario WHERE id = p_id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarCategoriaCultivo` (IN `p_cultivo` VARCHAR(255), IN `p_descripcion` VARCHAR(255), IN `p_creado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO'), IN `p_id_ficha` BIGINT(20), IN `p_id_sector` BIGINT(20))   BEGIN
    -- Obtener la fecha y hora actual del sistema
    DECLARE currentDate TIMESTAMP;
    SET currentDate = NOW();

    -- Realizar la inserción en la tabla tbl_categorias_cultivo
    INSERT INTO tbl_categorias_cultivo (cultivo, descripcion, creado_por, fecha_creacion, modificado_por, fecha_modificacion, estado, id_ficha, id_sector)
    VALUES (p_cultivo, p_descripcion, p_creado_por, currentDate, p_creado_por, currentDate, p_estado, p_id_ficha, p_id_sector);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarDatosEstiercolN2OReporte` (IN `p_sistema` BIGINT, IN `p_especie` BIGINT, IN `p_cantidad_a` DECIMAL(10,5), IN `p_tasa_b` DECIMAL(10,5), IN `p_masa_c` DECIMAL(10,5), OUT `p_promedio_d` DECIMAL(10,5), IN `p_fraccion_e` DECIMAL(5,2), OUT `p_n_total_f` DECIMAL(10,5), OUT `p_factor_g` DECIMAL(10,5), OUT `p_emision_h` DECIMAL(10,5))   BEGIN
    -- Calcular promedio_d
    SET p_promedio_d = p_tasa_b * p_masa_c * 365 / 1000;

    -- Calcular F
    SET p_n_total_f = p_cantidad_a * p_promedio_d * p_n_total_f;

    -- Calcular H
    SET p_emision_h = p_factor_g * p_n_total_f  * 44 / 28; 
    
    INSERT INTO tbl_estiercol_n2o (
        id_sistema,
        id_especie,
        cantidad_a,
        tasa_b,
        masa_c,
        fraccion_e
    ) VALUES (
        p_sistema,
        p_especie,
        p_cantidad_a,
        p_tasa_b,
        p_masa_c,
        p_fraccion_e
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarFONReporte` (IN `sistema_id` BIGINT(20), IN `especie_id` BIGINT(20), IN `cantidad_a_val` FLOAT, IN `promedio_b_val` DECIMAL(10,5), IN `fraccion_c_val` DECIMAL(10,5), IN `cantidad_nitrogeno_d_val` DECIMAL(5,2), IN `cantidad_nitrogeno_e_val` DECIMAL(5,2), IN `cantidad_nitrogeno_f_val` DECIMAL(10,5))   BEGIN
    -- Calcular la operación
    DECLARE cantidad_g_val float;
    SET cantidad_g_val = cantidad_a_val * promedio_b_val * fraccion_c_val * cantidad_nitrogeno_e_val
                       + cantidad_a_val * fraccion_c_val * cantidad_nitrogeno_f_val;

    -- Insertar los valores en la tabla
    INSERT INTO tbl_fon (id_sistema, id_especie, cantidad_a, promedio_b, fraccion_c, cantidad_nitrogeno_d, cantidad_nitrogeno_e, cantidad_nitrogeno_f, cantidad_g)
    VALUES (sistema_id, especie_id, cantidad_a_val, promedio_b_val, fraccion_c_val, cantidad_nitrogeno_d_val, cantidad_nitrogeno_e_val, cantidad_nitrogeno_f_val, cantidad_g_val);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarGestionMMS` (IN `p_id_sector` BIGINT(20), IN `p_id_categoria_especie` BIGINT(20), IN `p_id_especie` BIGINT(20), IN `p_gestion_estiercol` VARCHAR(255), IN `p_sigla` VARCHAR(45), IN `p_descripcion` VARCHAR(255), IN `p_creado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN
  INSERT INTO tbl_gestion_mms_estiercol (
    id_sector,
    id_categoria_especie,
    id_especie,
    gestion_estiercol,
    sigla,
    descripcion,
    creado_por,
    fecha_creacion,
    actualizado_por,
    fecha_actualizacion,
    estado
  )
  VALUES (
    p_id_sector,
    p_id_categoria_especie,
    p_id_especie,
    p_gestion_estiercol,
    p_sigla,
    p_descripcion,
    p_creado_por,
    NOW(),
    p_creado_por,
    NOW(),
    p_estado
  );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarSub_urea` (IN `newcategoria_urea` VARCHAR(255), IN `newid_sector` BIGINT(20), IN `newdescripcion` VARCHAR(255), IN `newcreado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    
    DECLARE currentDate TIMESTAMP;
    SET currentDate = NOW();

    
    INSERT INTO tbl_sub_categorias_urea (categoria_urea, id_sector, descripcion, creado_por, fecha_creacion, actualizado_por ,fecha_actualizacion, estado)
    VALUES (newcategoria_urea, newid_sector, newdescripcion, newcreado_por, currentDate, newcreado_por ,currentDate, newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarTipoCal` (IN `p_tipo_cal` VARCHAR(50), IN `p_id_sector` BIGINT(20), IN `p_descripcion` VARCHAR(255), IN `p_creado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    -- Obtener la fecha y hora actual del sistema
    DECLARE currentDate TIMESTAMP;
    SET currentDate = NOW();

    -- Realizar la inserción en la tabla tbl_tipos_cal_n
    INSERT INTO tbl_tipos_cal_n (tipo_cal, id_sector, descripcion, creado_por, fecha_creacion, modificado_por, fecha_actualizacion, estado)
    VALUES (p_tipo_cal, p_id_sector, p_descripcion, p_creado_por, currentDate, p_creado_por, currentDate, p_estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarUsuario` (IN `p_nombre_completo` VARCHAR(255), IN `p_correo` VARCHAR(255), IN `p_usuario` VARCHAR(255), IN `p_contrasena` VARCHAR(255))   BEGIN
    INSERT INTO usuario (nombre_completo, correo, usuario, contrasena, Id_rol, id_estado)
    VALUES (p_nombre_completo, p_correo, p_usuario, p_contrasena, 2, 3);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCategoria_Especie` (IN `newid_sector` BIGINT(20), IN `newcategoria_especie` VARCHAR(255), IN `newdescripcion` VARCHAR(255), IN `newcreado_por` VARCHAR(50), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    
    SET currentDate = NOW(); 
    
    INSERT INTO tbl_categorias_especies (id_sector, categoria_especie, descripcion, creado_por, fecha_creacion, actualizado_por ,fecha_actualizacion, estado)
    VALUES (newid_sector, newcategoria_especie, newdescripcion, newcreado_por, currentDate, newcreado_por ,currentDate, newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCategoria_Ficha` (IN `newid_sector` BIGINT(20), IN `newid_ficha` BIGINT(20), IN `newcategoria_ficha` VARCHAR(20), IN `newcodigo_categoriaficha` VARCHAR(10), IN `newdescripcion` VARCHAR(255), IN `newhoja` VARCHAR(20), IN `newreferencia` VARCHAR(20), IN `newformula` VARCHAR(50), IN `newcreado_por` VARCHAR(50), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    
    SET currentDate = NOW(); 
    
    INSERT INTO tbl_categorias_fichas (id_sector, id_ficha, categoria_ficha, codigo_categoriaficha, descripcion, hoja, referencia, formula, creado_por, fecha_creacion, actualizado_por ,fecha_actualizacion, estado )
    VALUES (newid_sector, newid_ficha, newcategoria_ficha, newcodigo_categoriaficha, newdescripcion, newhoja, newreferencia, newformula, newcreado_por, currentDate, newcreado_por ,currentDate, newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCriterioMedicion` (IN `p_nivel_medicion` INT, IN `p_id_categoria_ficha` BIGINT, IN `p_criterio_medicion` VARCHAR(255), IN `p_unidad_medicion` VARCHAR(255), IN `p_encabezado_segun_categoria` VARCHAR(255), IN `p_sigla` VARCHAR(45), IN `p_descripcion` VARCHAR(255), IN `p_creado_por` VARCHAR(50), IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    -- Obtener la fecha y hora actual del sistema
    DECLARE currentDate TIMESTAMP; 
    
    SET currentDate = NOW(); 

    -- Realizar la inserción en la tabla tbl_criterio_medicion
    INSERT INTO tbl_criterio_medicion (nivel_medicion, id_categoria_ficha, criterio_medicion, unidad_medicion, encabezado_segun_categoria, sigla, descripcion, creado_por, fecha_creacion, modificado_por, fecha_modificacion, estado)
    VALUES (p_nivel_medicion, p_id_categoria_ficha, p_criterio_medicion, p_unidad_medicion, p_encabezado_segun_categoria, p_sigla, p_descripcion, p_creado_por, currentDate, p_creado_por, currentDate, p_estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCultivoMedicion` (IN `p_id_ficha` BIGINT(20), IN `p_id_categoria_ficha` BIGINT(20), IN `p_nivel_medicion` INT(20), IN `p_id_sector` BIGINT(20), IN `p_anio` INT(20), IN `p_numero_ficha` INT(20), IN `p_id_cultivo` BIGINT(20), IN `p_id_criterios_medicion` BIGINT(20), IN `p_total` INT(20), IN `p_sigla` VARCHAR(45), IN `p_descripcion` VARCHAR(255), IN `p_tipo_superficie` DECIMAL(10,3), IN `p_masa_combustible` DECIMAL(10,3), IN `p_factor_combustion` DECIMAL(10,3), IN `p_factor_emision_ch` DECIMAL(10,3), IN `p_factor_emision_co` DECIMAL(10,3), IN `p_factor_emision_n2o` DECIMAL(10,3), IN `p_factor_emision_nox` DECIMAL(10,3), IN `p_creado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO','',''))   BEGIN
    -- Obtener la fecha y hora actual del sistema
    DECLARE currentDate TIMESTAMP;
    DECLARE emision_ch DECIMAL(50,3);
    DECLARE emision_co DECIMAL(50,3);
    DECLARE emision_n2o DECIMAL(50,3);
    DECLARE emision_nox DECIMAL(50,3);

    SET currentDate = NOW();

    -- Realizar las operaciones
    SET emision_ch = p_tipo_superficie*p_masa_combustible*p_factor_combustion*(p_factor_emision_ch/1000);

SET emision_co = p_tipo_superficie*p_masa_combustible*p_factor_combustion*(p_factor_emision_co/1000);

SET emision_n2o= p_tipo_superficie*p_masa_combustible*p_factor_combustion*(p_factor_emision_n2o/1000);

SET emision_nox= p_tipo_superficie*p_masa_combustible*p_factor_combustion*(p_factor_emision_nox/1000);
   

    -- Realizar la inserción en la tabla tbl_cultivos_medicion
    INSERT INTO tbl_cultivos_medicion (
        id_ficha, id_categoria_ficha, nivel_medicion, id_sector, anio,
        numero_ficha, id_cultivo, id_criterios_medicion, total, sigla,
        descripcion, tipo_superficie, masa_combustible, factor_combustion ,factor_emision_ch, factor_emision_co, factor_emision_n2o, factor_emision_nox, emision_ch, emision_co, emision_n2o, emision_nox ,creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, estado
    )
    VALUES (
        p_id_ficha, p_id_categoria_ficha, p_nivel_medicion, p_id_sector, p_anio,
        p_numero_ficha, p_id_cultivo, p_id_criterios_medicion, p_total, p_sigla,
        p_descripcion, p_tipo_superficie, p_masa_combustible, p_factor_combustion ,p_factor_emision_ch, p_factor_emision_co, p_factor_emision_n2o, p_factor_emision_nox, emision_ch, emision_co, emision_n2o, emision_nox ,p_creado_por, currentDate, p_creado_por, currentDate, p_estado
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertEncalado_Medicion` (IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newnivel_medicion` INT(11), IN `newid_tipo_cal` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` INT(11), IN `newid_criterios_medicion` BIGINT(20), IN `newsigla` VARCHAR(20), IN `newdescripcion` VARCHAR(255), IN `newcodigo_categoria` VARCHAR(10), IN `newhoja` VARCHAR(50), IN `newreferencia` VARCHAR(100), IN `newcantidad_anual_pc` DECIMAL(10,1), IN `newfactor_pc` DECIMAL(10,3), IN `newcantidad_anual_dolomita` DECIMAL(10,1), IN `newfactor_dolomita` DECIMAL(10,3), IN `newcreado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP;
    DECLARE emision_co_pc DECIMAL(10,3);
    DECLARE emision_co_dolomita DECIMAL(10,3);
    
    SET currentDate = NOW(); 

    -- Realizar las operaciones
    IF newcantidad_anual_pc >= 0 AND newfactor_pc >= 0 THEN
        SET emision_co_pc = newcantidad_anual_pc * newfactor_pc * (44/12) / 1000;
    END IF;
    IF newcantidad_anual_dolomita >= 0 AND newfactor_dolomita >= 0 THEN
        SET emision_co_dolomita = newcantidad_anual_dolomita * newfactor_dolomita * (44/12) / 1000;
    END IF;

    -- Insertar en la tabla
    INSERT INTO tbl_encalado_medicion_n (
        id_ficha, id_categoria_ficha, nivel_medicion, id_tipo_cal, id_sector, anio, numero_ficha, id_criterios_medicion, sigla, descripcion, 
        codigo_categoria, hoja, referencia, cantidad_anual_pc, factor_pc, cantidad_anual_dolomita, factor_dolomita, emision_co_pc, emision_co_dolomita, creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, estado
    )
    VALUES (
        newid_ficha, newid_categoria_ficha, newnivel_medicion, newid_tipo_cal, newid_sector, newanio, newnumero_ficha, newid_criterios_medicion, newsigla,
        newdescripcion, newcodigo_categoria, newhoja, newreferencia, newcantidad_anual_pc, newfactor_pc, newcantidad_anual_dolomita, newfactor_dolomita, emision_co_pc, emision_co_dolomita, newcreado_por,
        currentDate, newcreado_por, currentDate, newestado
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertEspecie` (IN `newid_sector` BIGINT(20), IN `newid_categoria_especie` BIGINT(20), IN `newespecie` VARCHAR(255), IN `newdescripcion` VARCHAR(255), IN `newcreado_por` VARCHAR(50), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    
    SET currentDate = NOW(); 
    
    INSERT INTO tbl_especie (id_sector, id_categoria_especie, especie, descripcion, creado_por, fecha_creacion, actualizado_por ,fecha_actualizacion, estado )
    VALUES (newid_sector, newid_categoria_especie, newespecie, newdescripcion, newcreado_por, currentDate, newcreado_por ,currentDate, newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertFermentacion_Estiercol` (IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newnivel_medicion` VARCHAR(11), IN `newid_sector` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` INT(11), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newcategoria_medicion` VARCHAR(45), IN `newid_criterios_medicion` BIGINT(20), IN `newcantidad_especie` INT(11), IN `newdescripcion` VARCHAR(255), IN `newsigla` VARCHAR(45), IN `newcreado_por` VARCHAR(50), IN `newfactor_fermentacion` DECIMAL(50,0), IN `newfactor_estiercol` DECIMAL(50,0), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    DECLARE total_fermentacion DECIMAL(50,0);
    DECLARE total_estiercol DECIMAL(50,0);

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET total_fermentacion = (newcantidad_especie * newfactor_fermentacion) / POWER(10, 6);
    SET total_estiercol = (newcantidad_especie * newfactor_estiercol) / POWER(10, 6);

    -- Insertar en la tabla
    INSERT INTO tbl_fermentacion_estiercol (
        id_ficha, id_categoria_ficha, nivel_medicion, id_sector, anio, numero_ficha, 
        id_categoria_especie, id_especie, categoria_medicion, id_criterios_medicion, 
        cantidad_especie, descripcion, sigla, creado_por, fecha_creacion, 
        actualizado_por, fecha_actualizacion, factor_fermentacion, factor_estiercol ,total_fermentacion, total_estiercol, estado
    )
    VALUES (
        newid_ficha, newid_categoria_ficha, newnivel_medicion, newid_sector, newanio,
        newnumero_ficha, newid_categoria_especie, newid_especie, newcategoria_medicion,
        newid_criterios_medicion, newcantidad_especie, newdescripcion, newsigla, newcreado_por,
        currentDate, newcreado_por, currentDate, newfactor_fermentacion, newfactor_estiercol ,total_fermentacion, total_estiercol, newestado
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertFicha` (IN `newdescripcion` VARCHAR(255), IN `newcreado_por` VARCHAR(50), IN `newfecha_entrevista` TIMESTAMP, IN `newnombre_encuentador` VARCHAR(255), IN `newfirma_productor` VARCHAR(45), IN `newnombre_encuestador` VARCHAR(255), IN `newfirma_encuestador` VARCHAR(45), IN `newnombre_supervisor` VARCHAR(255), IN `newfirma_supervisor` VARCHAR(45), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    
    SET currentDate = NOW(); 
    
    INSERT INTO tbl_fichas (fecha_solicitud, anio_solicitud, descripcion, creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, fecha_entrevista, nombre_encuentador, firma_productor, nombre_encuestador, firma_encuestador, nombre_supervisor, firma_supervisor, estado )
    VALUES (currentDate, currentDate, newdescripcion, newcreado_por, currentDate, newcreado_por ,currentDate, newfecha_entrevista, newnombre_encuentador, newfirma_productor, newnombre_encuestador, newfirma_encuestador, newnombre_supervisor, newfirma_supervisor, newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertFPRP_Medicion` (IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newnivel_medicion` VARCHAR(10), IN `newid_gestion_estiercol_FPRP` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` INT(10), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newcategoria_medicion` VARCHAR(50), IN `newid_criterios_medicion` BIGINT(20), IN `newcantidad_especie` FLOAT, IN `newpromedio_anual_excrecion` DECIMAL(10,5), IN `newfraccion_excrecion_anual` DECIMAL(10,5), IN `newhoja` VARCHAR(100), IN `newreferencia` VARCHAR(255), IN `newdescripcion` VARCHAR(255), IN `newsigla` VARCHAR(20), IN `newcreado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    DECLARE emisiones_directas_FPRP FLOAT;

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET emisiones_directas_FPRP = (newcantidad_especie*newpromedio_anual_excrecion*newfraccion_excrecion_anual);

    -- Insertar en la tabla
    INSERT INTO tbl_estiercol_fprp_medicion_n (
        id_ficha, id_categoria_ficha, nivel_medicion, id_gestion_estiercol_FPRP, id_sector, anio, numero_ficha, id_categoria_especie, id_especie, categoria_medicion, id_criterios_medicion, cantidad_especie, promedio_anual_excrecion, fraccion_excrecion_anual, emisiones_directas_FPRP ,hoja, 
        referencia, descripcion, sigla, creado_por ,fecha_creacion, actualizado_por, fecha_actualizacion ,estado
    )
    VALUES (
        newid_ficha, newid_categoria_ficha, newnivel_medicion, newid_gestion_estiercol_FPRP, newid_sector,
        newanio, newnumero_ficha, newid_categoria_especie, newid_especie,
        newcategoria_medicion, newid_criterios_medicion, newcantidad_especie, newpromedio_anual_excrecion, newfraccion_excrecion_anual, emisiones_directas_FPRP, newhoja, newreferencia, newdescripcion, newsigla, newcreado_por, currentDate, newcreado_por, currentDate, newestado
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertGestionEstiercolFon` (IN `newid_sector` BIGINT(20), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newgestion_estiercol_mms` VARCHAR(100), IN `newsigla` VARCHAR(45), IN `newdescripcion` VARCHAR(255), IN `newcreado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP;
    SET currentDate = NOW(); 
    INSERT INTO tbl_gestion_mms_estiercol_fon( id_sector, id_categoria_especie, id_especie, gestion_estiercol_mms, sigla, descripcion, creado_por, fecha_creacion, actualizado_por ,fecha_actualizacion, estado )
    VALUES (newid_sector, newid_categoria_especie, newid_especie, newgestion_estiercol_mms, newsigla, newdescripcion, newcreado_por, currentDate, newcreado_por ,currentDate, newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertSector` (IN `newsector` VARCHAR(50), IN `newdescripcion` VARCHAR(255), IN `newcreado_por` VARCHAR(50), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    
    SET currentDate = NOW(); 
    
    INSERT INTO tbl_sector (sector, descripcion, creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, estado)
    VALUES (newsector, newdescripcion, newcreado_por, currentDate, newcreado_por, currentDate, newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertSuelosDirectos_Medicion` (IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newid_suelo_directo` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` INT(10), IN `newid_criterios_medicion` BIGINT(20), IN `newcodigo_categoria` VARCHAR(20), IN `newdescripcion_suelo` VARCHAR(100), IN `newsigla` VARCHAR(20), IN `newdescripcion_medicion` VARCHAR(255), IN `newcantidad_anual_n_formula` VARCHAR(50), IN `newcantidad_anual_n_dato` BIGINT(50), IN `newfactor_emision_formula` VARCHAR(50), IN `newfactor_emision_dato` DECIMAL(10,5), IN `newcreado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    DECLARE emisiones_directas_aportes FLOAT;

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET emisiones_directas_aportes = (newcantidad_anual_n_dato*newfactor_emision_dato*(44/28))*POWER(10,6);

    -- Insertar en la tabla
    INSERT INTO tbl_suelosdirectos_medicion (
        id_ficha, id_categoria_ficha, id_sector, id_suelo_directo, anio, numero_ficha, id_criterios_medicion, codigo_categoria, descripcion_suelo, sigla, descripcion_medicion, cantidad_anual_n_formula, cantidad_anual_n_dato, factor_emision_formula ,factor_emision_dato, emisiones_directas_aportes, creado_por, fecha_creacion ,actualizado_por, fecha_actualizacion, estado)

    VALUES (
        newid_ficha, newid_categoria_ficha, newid_sector, newid_suelo_directo, newanio, newnumero_ficha, newid_criterios_medicion, newcodigo_categoria, newdescripcion_suelo, newsigla, newdescripcion_medicion, newcantidad_anual_n_formula, newcantidad_anual_n_dato, newfactor_emision_formula, newfactor_emision_dato, emisiones_directas_aportes, newcreado_por, currentDate, newcreado_por, currentDate ,newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertSuelosIndirectos` (IN `newnombre_suelo` VARCHAR(45), IN `newid_sector` BIGINT(20), IN `newdescripcion` VARCHAR(255), IN `newcreado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
	DECLARE currentDate TIMESTAMP; 
    
    SET currentDate = NOW(); 

	INSERT INTO tbl_suelos_indirectos(nombre_suelo, id_sector, descripcion, creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, estado)
	VALUES (newnombre_suelo, newid_sector, newdescripcion, newcreado_por, currentDate, newcreado_por, currentDate, newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertTipoSuelo` (IN `newnombre_suelo` VARCHAR(45), IN `newid_sector` BIGINT(20), IN `newdescripcion` VARCHAR(255), IN `newcreado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
	DECLARE currentDate TIMESTAMP; 
    
    SET currentDate = NOW(); 
	INSERT INTO tbl_tipos_suelos_directos(nombre_suelo, id_sector, descripcion, creado_por, fecha_creacion, actualizado_por ,fecha_actualizacion, estado )
	VALUES (newnombre_suelo, newid_sector, newdescripcion, newcreado_por, currentDate, newcreado_por ,currentDate, newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUrea_Medicion` (IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newcodigo_categoria` VARCHAR(20), IN `newreferencia` VARCHAR(255), IN `newid_subcategoria_urea` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` VARCHAR(45), IN `newid_criterios_medicion` BIGINT(20), IN `newsigla` VARCHAR(20), IN `newdescripcion` VARCHAR(255), IN `newfertilizacion_urea` VARCHAR(45), IN `newfactor_urea` VARCHAR(50), IN `newcreado_por` VARCHAR(50), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    DECLARE emisiones_urea DECIMAL(10,3);

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET emisiones_urea = (newfertilizacion_urea * newfactor_urea* (44/12)/1000 ) ;

    -- Insertar en la tabla
    INSERT INTO tbl_urea_medicion (
        id_ficha, id_categoria_ficha, id_sector, codigo_categoria, referencia, id_subcategoria_urea, 
        anio, numero_ficha, id_criterios_medicion, sigla, 
        descripcion, fertilizacion_urea, factor_urea, emisiones_urea ,creado_por, fecha_creacion, actualizado_por, fecha_actualizacion ,estado)

    VALUES (
        newid_ficha, newid_categoria_ficha, newid_sector, newcodigo_categoria, newreferencia,
        newid_subcategoria_urea, newanio, newnumero_ficha, newid_criterios_medicion,
        newsigla, newdescripcion, newfertilizacion_urea, newfactor_urea, emisiones_urea, newcreado_por,
        currentDate, newcreado_por, currentDate, newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Estiercoln2o` (IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newnivel_medicion` VARCHAR(20), IN `newid_sector` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` INT(20), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newcategoria_medicion` VARCHAR(255), IN `newid_criterios_medicion` BIGINT(20), IN `newcantidad_especie` INT(20), IN `newsigla` VARCHAR(45), IN `newcreado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'), IN `newtasa_excrecion` DECIMAL(10,5), IN `newmasa_animal` DECIMAL(10,5), IN `newfraccion_excrecion` DECIMAL(5,2), IN `newfactor_emisiones_directas` DECIMAL(10,5), IN `newid_gestion_estiercol_mms` BIGINT(20))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    DECLARE promedio_anual_excrecion FLOAT;
    DECLARE n_total_excretado FLOAT;
    DECLARE emisiones_directas FLOAT;

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET promedio_anual_excrecion =  (newtasa_excrecion*newmasa_animal*365)/1000;
    SET n_total_excretado = newcantidad_especie*promedio_anual_excrecion*newfraccion_excrecion;
SET emisiones_directas = (n_total_excretado*newfactor_emisiones_directas)*(44/28);

    -- Insertar en la tabla
    INSERT INTO tbl_estiercol_n2o (
        id_ficha, id_categoria_ficha, nivel_medicion, id_sector, anio, numero_ficha, id_categoria_especie, id_especie, categoria_medicion, id_criterios_medicion, cantidad_especie, sigla, creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, estado, tasa_excrecion, masa_animal, promedio_anual_excrecion, fraccion_excrecion, n_total_excretado, factor_emisiones_directas, emision_directas, id_gestion_estiercol_mms
    )
    VALUES (
        newid_ficha, newid_categoria_ficha, newnivel_medicion, newid_sector, newanio, newnumero_ficha, newid_categoria_especie, newid_especie, newcategoria_medicion, newid_criterios_medicion, newcantidad_especie, newsigla, newcreado_por, currentDate, newcreado_por, currentDate, newestado, newtasa_excrecion, newmasa_animal, promedio_anual_excrecion, newfraccion_excrecion, n_total_excretado, newfactor_emisiones_directas, emisiones_directas, newid_gestion_estiercol_mms
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_FONMedicion` (IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newnivel_medicion` VARCHAR(20), IN `newid_sector` BIGINT(20), IN `newanio` INT(20), IN `newid_gestion_estiercol_mms` BIGINT(20), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newid_criterios_medicion` BIGINT(20), IN `newnumero_ficha` INT(20), IN `newcategoria_medicion` VARCHAR(50), IN `newcantidad_especie` FLOAT, IN `newpromedio_b` DECIMAL(10,5), IN `newfraccion_c` DECIMAL(10,5), IN `newcantidad_nitrogeno_d` DECIMAL(5,2), IN `newcantidad_nitrogeno_e` DECIMAL(5,2), IN `newcantidad_nitrogeno_f` DECIMAL(10,5), IN `newcreado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    DECLARE cantidad_g FLOAT;

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET cantidad_g = (newcantidad_especie*newpromedio_b*newfraccion_c*newcantidad_nitrogeno_e)+(newcantidad_especie*newfraccion_c*newcantidad_nitrogeno_f) ;

    -- Insertar en la tabla
    INSERT INTO tbl_fon (
        id_ficha, id_categoria_ficha, nivel_medicion, id_sector, anio, id_gestion_estiercol_mms, id_categoria_especie, id_especie, id_criterios_medicion, numero_ficha, categoria_medicion, cantidad_especie, promedio_b, fraccion_c, cantidad_nitrogeno_d, cantidad_nitrogeno_e, cantidad_nitrogeno_f, cantidad_g, creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, estado
    )
    VALUES (
        newid_ficha, newid_categoria_ficha, newnivel_medicion, newid_sector, newanio, newid_gestion_estiercol_mms, newid_categoria_especie, newid_especie, newid_criterios_medicion, newnumero_ficha, newcategoria_medicion, newcantidad_especie, newpromedio_b, newfraccion_c, newcantidad_nitrogeno_d, newcantidad_nitrogeno_e, newcantidad_nitrogeno_f, cantidad_g, newcreado_por, currentDate, newcreado_por, currentDate, newestado
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_FPRP` (IN `newid_sector` BIGINT(20), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newgestion_estiercol_FPRP` VARCHAR(255), IN `newsigla` VARCHAR(20), IN `newdescripcion` VARCHAR(255), IN `newcreado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    
    SET currentDate = NOW(); 
    
    INSERT INTO tbl_estiercol_fprp_n (id_sector, id_categoria_especie, id_especie, gestion_estiercol_FPRP, sigla, descripcion, creado_por, fecha_creacion , actualizado_por, fecha_actualizacion, estado )
    VALUES (newid_sector, newid_categoria_especie, newid_especie, newgestion_estiercol_FPRP, newsigla, newdescripcion,  newcreado_por ,currentDate, newcreado_por, currentDate ,newestado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_suelos_indirectos_reporte` (IN `p_id_ficha` BIGINT(20), IN `p_id_categoria_ficha` BIGINT(20), IN `p_id_sector` BIGINT(20), IN `p_id_suelos_indirectos` BIGINT(20), IN `p_id_criterios_medicion` BIGINT(20), IN `p_descripcion` VARCHAR(255), IN `p_codigo_categoria` VARCHAR(20), IN `p_categoria_medicion` VARCHAR(20), IN `p_hoja` VARCHAR(255), IN `p_referencia` VARCHAR(255), IN `p_anio` INT(11), IN `p_cantidad_anual_n` FLOAT, IN `p_fraccion_n` FLOAT, IN `p_cantidad_animal` FLOAT, IN `p_cantidad_orina` FLOAT, IN `p_fraccion_materiales` FLOAT, IN `p_factor_emision` FLOAT, IN `p_cantidad_residuos` FLOAT, IN `p_cantidad_mineralizado` FLOAT, IN `p_fraccion_mineralizado` FLOAT, IN `p_fraccion_lixiviacion` FLOAT, IN `p_creado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    DECLARE v_cantidad_deposicion FLOAT;
    DECLARE v_n2o_volatilizacion FLOAT;
    DECLARE v_cantidad_lixiviacion FLOAT;
    DECLARE v_n2o_lixxiviacion FLOAT;
    DECLARE v_total FLOAT;

    SET currentDate = NOW(); 

    -- Cálculo de cantidad_deposicion
    SET v_cantidad_deposicion = ((p_cantidad_anual_n * p_fraccion_n) + (p_cantidad_animal + p_cantidad_orina) * p_fraccion_materiales) * p_factor_emision;

    -- Cálculo de n2o_volatilizacion
    SET v_n2o_volatilizacion = v_cantidad_deposicion * (44/28) * POWER(10, -6);

    -- Cálculo de cantidad_lixiviacion
    SET v_cantidad_lixiviacion = (p_cantidad_anual_n + p_cantidad_animal + p_cantidad_orina + p_cantidad_residuos) * p_fraccion_mineralizado * p_fraccion_lixiviacion;

    -- Cálculo de n2o_lixxiviacion
    SET v_n2o_lixxiviacion = v_cantidad_lixiviacion * (44/28) * POWER(10, -6);

    -- Cálculo de total
    SET v_total = v_n2o_volatilizacion + v_n2o_lixxiviacion;

    -- Insertar los datos en la tabla
    INSERT INTO tbl_suelos_indirectos_b (
        id_ficha,
        id_categoria_ficha,
        id_sector,
        id_suelos_indirectos,
        id_criterios_medicion,
        descripcion,
        codigo_categoria,
        categoria_medicion,
        hoja,
        referencia,
        anio,
        cantidad_anual_n,
        fraccion_n,
        cantidad_animal,
        cantidad_orina,
        fraccion_materiales,
        factor_emision,
        cantidad_residuos,
        cantidad_mineralizado,
        fraccion_mineralizado,
        fraccion_lixiviacion,
        cantidad_lixiviacion,
        n2o_lixxiviacion,
        cantidad_deposicion,
        n2o_volatilizacion,
        total,
        creado_por,
        fecha_creacion,
        actualizado_por,
        fecha_actualizacion,
        estado
    ) VALUES (
        p_id_ficha,
        p_id_categoria_ficha,
        p_id_sector,
        p_id_suelos_indirectos,
        p_id_criterios_medicion,
        p_descripcion,
        p_codigo_categoria,
        p_categoria_medicion,
        p_hoja,
        p_referencia,
        p_anio,
        p_cantidad_anual_n,
        p_fraccion_n,
        p_cantidad_animal,
        p_cantidad_orina,
        p_fraccion_materiales,
        p_factor_emision,
        p_cantidad_residuos,
        p_cantidad_mineralizado,
        p_fraccion_mineralizado,
        p_fraccion_lixiviacion,
        v_cantidad_lixiviacion,
        v_n2o_lixxiviacion,
        v_cantidad_deposicion,
        v_n2o_volatilizacion,
        v_total,
        p_creado_por,
        currentDate,
        p_creado_por,
        currentDate,
        p_estado
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerRegistrosPorAnio` (IN `anioSeleccionado` INT)   BEGIN
    SELECT *
    FROM tbl_fermentacion_estiercol
    WHERE anio = anioSeleccionado;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCategoria_Especie` (IN `newid_categoria_especie` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newcategoria_especie` VARCHAR(255), IN `newdescripcion` VARCHAR(255), IN `newactualizado_por` VARCHAR(50), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 
    UPDATE tbl_categorias_especies
    SET id_sector = newid_sector,
        categoria_especie = newcategoria_especie,
        descripcion = newdescripcion,
        actualizado_por = newactualizado_por,
        estado = newestado,
        fecha_actualizacion = CURRENT_TIMESTAMP
        WHERE id_categoria_especie = newid_categoria_especie;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCategoria_Ficha` (IN `newid_categoria_ficha` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newcategoria_ficha` VARCHAR(20), IN `newcodigo_categoriaficha` BIGINT(10), IN `newdescripcion` VARCHAR(255), IN `newhoja` VARCHAR(20), IN `newreferencia` VARCHAR(20), IN `newformula` VARCHAR(20), IN `newactualizado_por` VARCHAR(50), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 
    UPDATE tbl_categorias_fichas
    SET id_sector = newid_sector,
        categoria_ficha = newcategoria_ficha,
        codigo_categoriaficha = newcodigo_categoriaficha,
        descripcion = newdescripcion,
        hoja = newhoja,
        referencia = newreferencia,
        formula = newformula, 
        actualizado_por = newactualizado_por,
        fecha_actualizacion = CURRENT_TIMESTAMP
        WHERE id_categoria_ficha = newid_categoria_ficha;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateEncalado_Medicion` (IN `newid_encalado_medicion` BIGINT(20), IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newnivel_medicion` INT(11), IN `newid_tipo_cal` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` INT(11), IN `newid_criterios_medicion` BIGINT(20), IN `newsigla` VARCHAR(20), IN `newdescripcion` VARCHAR(255), IN `newcodigo_categoria` VARCHAR(10), IN `newhoja` VARCHAR(50), IN `newreferencia` VARCHAR(100), IN `newcantidad_anual_pc` DECIMAL(10,1), IN `newfactor_pc` DECIMAL(10,3), IN `newcantidad_anual_dolomita` DECIMAL(10,1), IN `newfactor_dolomita` DECIMAL(10,3), IN `newactualizado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 

    DECLARE currentDate TIMESTAMP; 
    DECLARE emision_co_pc DECIMAL(10,3);
    DECLARE emision_co_dolomita DECIMAL(10,3);
    

    SET currentDate = NOW(); 

     -- Realizar las operaciones
    IF newcantidad_anual_pc >= 0 AND newfactor_pc >= 0 THEN
    SET emision_co_pc = newcantidad_anual_pc * newfactor_pc * (44/12) / 1000;
    END IF;
    IF newcantidad_anual_dolomita >=0 AND newfactor_dolomita >=0 THEN
    SET emision_co_dolomita = newcantidad_anual_dolomita * newfactor_dolomita * (44/12) / 1000;
    END IF;




    UPDATE tbl_encalado_medicion_n
    SET id_ficha = newid_ficha,
        id_categoria_ficha = newid_categoria_ficha,
        nivel_medicion = newnivel_medicion,
        id_tipo_cal = newid_tipo_cal,
        id_sector = newid_sector,
        anio = newanio,
        numero_ficha = newnumero_ficha,
        id_criterios_medicion = newid_criterios_medicion,
        sigla = newsigla,
        descripcion = newdescripcion,
        codigo_categoria = newcodigo_categoria,
        hoja = newhoja,
        referencia = newreferencia,
        cantidad_anual_pc = newcantidad_anual_pc,
        factor_pc = newfactor_pc,
        cantidad_anual_dolomita = newcantidad_anual_dolomita,
        factor_dolomita = newfactor_dolomita,
        emision_co_pc = emision_co_pc,
        emision_co_dolomita = emision_co_dolomita,
        emision_co_dolomita = emision_co_dolomita,
        actualizado_por = newactualizado_por,
        fecha_actualizacion = CURRENT_TIMESTAMP,
        estado = newestado
        WHERE id_encalado_medicion = newid_encalado_medicion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateEspecie` (IN `newid_especie` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newid_categoria_especie` BIGINT(20), IN `newespecie` VARCHAR(255), IN `newdescripcion` VARCHAR(255), IN `newactualizado_por` VARCHAR(50), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 
    UPDATE tbl_especie
    SET id_sector = newid_sector,
        id_categoria_especie = newid_categoria_especie,
        especie = newespecie,
        descripcion = newdescripcion,
        actualizado_por = newactualizado_por,
        estado = newestado,
        fecha_actualizacion = CURRENT_TIMESTAMP
        WHERE id_especie = newid_especie;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateFermentacion_Estiercol` (IN `newid_fermentacion` BIGINT(20), IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newnivel_medicion` VARCHAR(11), IN `newid_sector` BIGINT(20), IN `newanio` INT(20), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newcategoria_medicion` VARCHAR(45), IN `newid_criterios_medicion` BIGINT(20), IN `newcantidad_especie` INT(11), IN `newdescripcion` VARCHAR(255), IN `newsigla` VARCHAR(45), IN `newactualizado_por` VARCHAR(50), IN `newfactor_fermentacion` DECIMAL(50,0), IN `newfactor_estiercol` DECIMAL(50,0), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 

    DECLARE total_fermentacion DECIMAL(50,0);
    DECLARE total_estiercol DECIMAL(50,0);

 -- Realizar las operaciones
    SET total_fermentacion = (newcantidad_especie * newfactor_fermentacion) / POWER(10, 6);
    SET total_estiercol = (newcantidad_especie * newfactor_estiercol) / POWER(10, 6);

    UPDATE tbl_fermentacion_estiercol
    SET id_ficha = newid_ficha,
        id_categoria_ficha = newid_categoria_ficha,
        nivel_medicion = newnivel_medicion,
        id_sector = newid_sector,
        anio = newanio,
        id_categoria_especie = newid_categoria_especie,
        id_especie = newid_especie,
        categoria_medicion = newcategoria_medicion,
        id_criterios_medicion = newid_criterios_medicion,
        cantidad_especie = newcantidad_especie,
        descripcion = newdescripcion,
        sigla = newsigla,
        actualizado_por = newactualizado_por,
        factor_fermentacion = newfactor_fermentacion,
        factor_estiercol = newfactor_estiercol,
        total_fermentacion = total_fermentacion,
        total_estiercol = total_estiercol,
        estado = newestado
        WHERE id_fermentacion = newid_fermentacion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateFicha` (IN `newid_ficha` BIGINT(20), IN `newdescripcion` VARCHAR(255), IN `newactualizado_por` VARCHAR(50), IN `newnombre_encuentador` VARCHAR(255), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 
    UPDATE tbl_fichas
    SET descripcion = newdescripcion,
        actualizado_por = newactualizado_por,
        nombre_encuentador = newnombre_encuentador,
        estado = newestado,
        fecha_actualizacion = CURRENT_TIMESTAMP
        WHERE id_ficha = newid_ficha;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateFPRP_Medicion` (IN `newid_fprp_estiercol_medicion` BIGINT(20), IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newnivel_medicion` VARCHAR(10), IN `newid_gestion_estiercol_FPRP` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` INT(10), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newcategoria_medicion` VARCHAR(50), IN `newid_criterios_medicion` BIGINT(20), IN `newcantidad_especie` FLOAT, IN `newpromedio_anual_excrecion` DECIMAL(10,5), IN `newfraccion_excrecion_anual` DECIMAL(10,5), IN `newhoja` VARCHAR(100), IN `newreferencia` VARCHAR(255), IN `newdescripcion` VARCHAR(255), IN `newsigla` VARCHAR(20), IN `newactualizado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 

    DECLARE currentDate TIMESTAMP; 
    DECLARE emisiones_directas_FPRP FLOAT;

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET emisiones_directas_FPRP = (newcantidad_especie*newpromedio_anual_excrecion*newfraccion_excrecion_anual);

    UPDATE tbl_estiercol_fprp_medicion_n
    SET id_ficha = newid_ficha,
        id_categoria_ficha = newid_categoria_ficha,
        nivel_medicion = newnivel_medicion,
        id_gestion_estiercol_FPRP = newid_gestion_estiercol_FPRP,
        id_sector = newid_sector,
        anio = newanio,
        numero_ficha = newnumero_ficha,
        id_categoria_especie = newid_categoria_especie,
        id_especie = newid_especie,
        categoria_medicion = newcategoria_medicion,
        id_criterios_medicion = newid_criterios_medicion,
        cantidad_especie = newcantidad_especie,
        promedio_anual_excrecion = newpromedio_anual_excrecion,
        fraccion_excrecion_anual = newfraccion_excrecion_anual,
        emisiones_directas_FPRP = emisiones_directas_FPRP,
        hoja = newhoja,
        referencia = newreferencia,
        descripcion = newdescripcion,
        sigla = newsigla,
        actualizado_por = newactualizado_por,
        fecha_actualizacion = CURRENT_TIMESTAMP,
        estado = newestado
        WHERE id_fprp_estiercol_medicion = newid_fprp_estiercol_medicion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateGestionEstiercolFon` (IN `p_id_gestion_estiercol_fon` BIGINT(20), IN `p_id_sector` BIGINT(20), IN `p_id_categoria_especie` BIGINT(20), IN `p_id_especie` BIGINT(20), IN `p_gestion_estiercol_mms` VARCHAR(100), IN `p_sigla` VARCHAR(45), IN `p_descripcion` VARCHAR(255), IN `p_actualizado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN 
	UPDATE tbl_gestion_mms_estiercol_fon
	SET
	 id_sector = p_id_sector,
	 id_categoria_especie = p_id_categoria_especie,
	 id_especie = p_id_especie,
	 gestion_estiercol_mms = p_gestion_estiercol_mms,
	 sigla = p_sigla,
	 descripcion = p_descripcion,
	 actualizado_por = p_actualizado_por,	
         fecha_actualizacion = CURRENT_TIMESTAMP,
	 estado = p_estado
	WHERE id_gestion_estiercol_fon = p_id_gestion_estiercol_fon;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateGestionMMS` (IN `p_id_gestion_estiercol_mms` BIGINT(20), IN `p_id_sector` BIGINT(20), IN `p_id_categoria_especie` BIGINT(20), IN `p_id_especie` BIGINT(20), IN `p_gestion_estiercol` VARCHAR(255), IN `p_sigla` VARCHAR(45), IN `p_descripcion` VARCHAR(255), IN `p_actualizado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN
  UPDATE tbl_gestion_mms_estiercol
  SET
    id_sector = p_id_sector,
    id_categoria_especie = p_id_categoria_especie,
    id_especie = p_id_especie,
    gestion_estiercol = p_gestion_estiercol,
    sigla = p_sigla,
    descripcion = p_descripcion,
    actualizado_por = p_actualizado_por,
    fecha_actualizacion = NOW(),
    estado = p_estado
  WHERE id_gestion_estiercol_mms = p_id_gestion_estiercol_mms;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSector` (IN `newid_sector` BIGINT(20), IN `newsector` VARCHAR(50), IN `newdescripcion` VARCHAR(255), IN `newactualizado_por` VARCHAR(50), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 
    UPDATE tbl_sector
    SET sector = newsector,
        descripcion = newdescripcion,
        actualizado_por = newactualizado_por,
        estado = newestado,
        fecha_actualizacion = CURRENT_TIMESTAMP
        WHERE id_sector = newid_sector;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSub_urea` (IN `newid_subcategoria_urea` BIGINT(20), IN `newcategoria_urea` VARCHAR(255), IN `newdescripcion` VARCHAR(255), IN `newactualizado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP;
    SET currentDate = NOW();

    UPDATE tbl_sub_categorias_urea
    SET categoria_urea = newcategoria_urea,
        descripcion = newdescripcion,
        actualizado_por = newactualizado_por,
        fecha_actualizacion = currentDate,
        estado = newestado
    WHERE id_subcategoria_urea = newid_subcategoria_urea;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSuelosDirectos_Medicion` (IN `newid_suelosDirectos_medicion` BIGINT(20), IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newid_suelo_directo` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` INT(10), IN `newid_criterios_medicion` BIGINT(20), IN `newcodigo_categoria` VARCHAR(20), IN `newdescripcion_suelo` VARCHAR(100), IN `newsigla` VARCHAR(20), IN `newdescripcion_medicion` VARCHAR(255), IN `newcantidad_anual_n_formula` VARCHAR(50), IN `newcantidad_anual_n_dato` INT(50), IN `newfactor_emision_formula` VARCHAR(50), IN `newfactor_emision_dato` DECIMAL(10,5), IN `newactualizado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 

    DECLARE currentDate TIMESTAMP; 
    DECLARE emisiones_directas_aportes FLOAT;

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET emisiones_directas_aportes = (newcantidad_anual_n_dato*newfactor_emision_dato*(44/28))*POWER(10,6);

    UPDATE tbl_suelosdirectos_medicion
    SET id_ficha = newid_ficha,
        id_categoria_ficha = newid_categoria_ficha,
        id_sector = newid_sector,
        id_suelo_directo = newid_suelo_directo,
        anio = newanio,
        numero_ficha = newnumero_ficha,
        id_criterios_medicion = newid_criterios_medicion,
        codigo_categoria = newcodigo_categoria,
        descripcion_suelo = newdescripcion_suelo,
        sigla = newsigla,
        descripcion_medicion = newdescripcion_medicion,
        cantidad_anual_n_formula = newcantidad_anual_n_formula,
        cantidad_anual_n_dato = newcantidad_anual_n_dato,
        factor_emision_formula = newfactor_emision_formula,
        factor_emision_dato = newfactor_emision_dato,
        emisiones_directas_aportes = emisiones_directas_aportes,
        actualizado_por = newactualizado_por,
        fecha_actualizacion = CURRENT_TIMESTAMP,
        estado = newestado
        WHERE id_suelosDirectos_medicion = newid_suelosDirectos_medicion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSuelosIndirectos` (IN `p_id_suelos_indirectos` BIGINT(20), IN `p_nombre_suelo` VARCHAR(45), IN `p_descripcion` VARCHAR(255), IN `p_actualizado_por` VARCHAR(20), IN `p_fecha_actualizacion` TIMESTAMP, IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    UPDATE tbl_suelos_indirectos
    SET
        nombre_suelo = p_nombre_suelo,
        descripcion = p_descripcion,
        actualizado_por = p_actualizado_por,
        fecha_actualizacion = p_fecha_actualizacion,
        estado = p_estado
    WHERE id_suelos_indirectos = p_id_suelos_indirectos;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTipoSuelo` (IN `p_id_suelo_directo` BIGINT(20), IN `p_nombre_suelo` VARCHAR(45), IN `p_id_sector` BIGINT(20), IN `p_descripcion` VARCHAR(255), IN `p_actualizado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN 
    UPDATE tbl_tipos_suelos_directos
    SET 
	nombre_suelo = p_nombre_suelo,
	id_sector = p_id_sector,
	descripcion = p_descripcion,
	actualizado_por = p_actualizado_por,
	fecha_actualizacion = CURRENT_TIMESTAMP,	
	estado = p_estado
    WHERE id_suelo_directo = p_id_suelo_directo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUrea_Medicion` (IN `newid_urea_medicion` BIGINT(20), IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newcodigo_categoria` VARCHAR(20), IN `newhoja` VARCHAR(255), IN `newreferencia` VARCHAR(255), IN `newid_subcategoria_urea` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` INT(20), IN `newid_criterios_medicion` BIGINT(20), IN `newsigla` VARCHAR(45), IN `newdescripcion` VARCHAR(255), IN `newfertilizacion_urea` INT(20), IN `newfactor_urea` DECIMAL(50,2), IN `newactualizado_por` VARCHAR(50), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 

    DECLARE currentDate TIMESTAMP; 
    DECLARE emisiones_urea DECIMAL(10,3);

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET emisiones_urea = (newfertilizacion_urea * newfactor_urea* (44/12)/1000 ) ;

    UPDATE tbl_urea_medicion
    SET id_ficha = newid_ficha,
        id_categoria_ficha = newid_categoria_ficha,
        id_sector = newid_sector,
        codigo_categoria = newcodigo_categoria,
        hoja = newhoja,
        referencia = newreferencia,
        id_subcategoria_urea = newid_subcategoria_urea,
        anio = newanio,
        numero_ficha = newnumero_ficha,
        id_criterios_medicion = newid_criterios_medicion,
        sigla = newsigla,
        descripcion = newdescripcion,
        fertilizacion_urea = newfertilizacion_urea,
        factor_urea = newfactor_urea,
        emisiones_urea = emisiones_urea,
        actualizado_por = newactualizado_por,
        estado = newestado
        WHERE id_urea_medicion = newid_urea_medicion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Estiercoln2o` (IN `newid_estiercol` BIGINT(20), IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newnivel_medicion` VARCHAR(20), IN `newid_sector` BIGINT(20), IN `newanio` INT(20), IN `newnumero_ficha` INT(20), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newcategoria_medicion` VARCHAR(255), IN `newid_criterios_medicion` BIGINT(20), IN `newcantidad_especie` INT(20), IN `newsigla` VARCHAR(45), IN `newactualizado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'), IN `newtasa_excrecion` DECIMAL(10,5), IN `newmasa_animal` DECIMAL(10,5), IN `newfraccion_excrecion` DECIMAL(5,2), IN `newfactor_emisiones_directas` DECIMAL(10,5), IN `newid_gestion_estiercol_mms` BIGINT(20))   BEGIN 

  DECLARE currentDate TIMESTAMP; 
    DECLARE promedio_anual_excrecion FLOAT;
    DECLARE n_total_excretado FLOAT;
    DECLARE emisiones_directas FLOAT;

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET promedio_anual_excrecion =  (newtasa_excrecion*newmasa_animal*365)/1000;
    SET n_total_excretado = newcantidad_especie*promedio_anual_excrecion*newfraccion_excrecion;
SET emisiones_directas = (n_total_excretado*newfactor_emisiones_directas)*(44/28);

    UPDATE tbl_estiercol_n2o
    SET id_ficha = newid_ficha,
        id_categoria_ficha = newid_categoria_ficha,
        nivel_medicion = newnivel_medicion,
        id_sector = newid_sector,
        anio = newanio,
        numero_ficha = newnumero_ficha,
        id_categoria_especie = newid_categoria_especie,
        id_especie = newid_especie, 
        categoria_medicion = newcategoria_medicion,
        id_criterios_medicion = newid_criterios_medicion,
        cantidad_especie = newcantidad_especie,
        sigla = newsigla, 
        actualizado_por = newactualizado_por,
        fecha_actualizacion = CURRENT_TIMESTAMP,
        estado = newestado,
        tasa_excrecion = newtasa_excrecion,
        masa_animal = newmasa_animal,
        promedio_anual_excrecion = promedio_anual_excrecion,
        fraccion_excrecion = newfraccion_excrecion,
        n_total_excretado = n_total_excretado,
        factor_emisiones_directas = newfactor_emisiones_directas,
        emision_directas = emisiones_directas,
        id_gestion_estiercol_mms = newid_gestion_estiercol_mms
        WHERE id_estiercol = newid_estiercol;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_FONMedicion` (IN `newid_fon` BIGINT(20), IN `newid_ficha` BIGINT(20), IN `newid_categoria_ficha` BIGINT(20), IN `newnivel_medicion` VARCHAR(20), IN `newid_sector` BIGINT(20), IN `newanio` INT(20), IN `newid_gestion_estiercol_mms` BIGINT(20), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newid_criterios_medicion` BIGINT(20), IN `newnumero_ficha` INT(20), IN `newcategoria_medicion` VARCHAR(50), IN `newcantidad_especie` FLOAT, IN `newpromedio_b` DECIMAL(10,5), IN `newfraccion_c` DECIMAL(10,5), IN `newcantidad_nitrogeno_d` DECIMAL(5,2), IN `newcantidad_nitrogeno_e` DECIMAL(5,2), IN `newcantidad_nitrogeno_f` DECIMAL(10,5), IN `newactualizado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 

    DECLARE currentDate TIMESTAMP; 
    DECLARE cantidad_g FLOAT;

    SET currentDate = NOW(); 

    -- Realizar las operaciones
    SET cantidad_g = (newcantidad_especie*newpromedio_b*newfraccion_c*newcantidad_nitrogeno_e)+(newcantidad_especie*newfraccion_c*newcantidad_nitrogeno_f) ;

    UPDATE tbl_fon
    SET id_ficha = newid_ficha,
        id_categoria_ficha = newid_categoria_ficha,
        nivel_medicion = newnivel_medicion,
        id_sector = newid_sector,
        anio = newanio,
        id_gestion_estiercol_mms = newid_gestion_estiercol_mms,
        id_categoria_especie = newid_categoria_especie,
        id_especie = newid_especie,
        id_criterios_medicion = newid_criterios_medicion,
        numero_ficha = newnumero_ficha,
        categoria_medicion = newcategoria_medicion,
        cantidad_especie = newcantidad_especie,
        promedio_b = newpromedio_b,
        fraccion_c = newfraccion_c,
        cantidad_nitrogeno_d = newcantidad_nitrogeno_d,
        cantidad_nitrogeno_e = newcantidad_nitrogeno_e,
        cantidad_nitrogeno_f = newcantidad_nitrogeno_f,
        cantidad_g = cantidad_g,
        actualizado_por = newactualizado_por,
        fecha_actualizacion = CURRENT_TIMESTAMP,
        estado = newestado
        WHERE id_fon = newid_fon;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_FPRP` (IN `newid_gestion_estiercol_FPRP` BIGINT(20), IN `newid_sector` BIGINT(20), IN `newid_categoria_especie` BIGINT(20), IN `newid_especie` BIGINT(20), IN `newgestion_estiercol_FPRP` VARCHAR(255), IN `newsigla` VARCHAR(20), IN `newdescripcion` VARCHAR(255), IN `newactualizado_por` VARCHAR(20), IN `newestado` ENUM('ACTIVO','INACTIVO'))   BEGIN 
    UPDATE tbl_estiercol_fprp_n
    SET id_sector = newid_sector,
        id_categoria_especie = newid_categoria_especie,
        id_especie = newid_especie,
        gestion_estiercol_FPRP = newgestion_estiercol_FPRP,
        sigla = newsigla,
        descripcion = newdescripcion,
        actualizado_por = newactualizado_por,
        fecha_actualizacion = CURRENT_TIMESTAMP,
        estado = newestado
        WHERE id_gestion_estiercol_FPRP = newid_gestion_estiercol_FPRP;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_suelos_indirectos_reporte` (IN `p_id_suelos_indirectos_b` BIGINT(20), IN `p_id_ficha` BIGINT(20), IN `p_id_categoria_ficha` BIGINT(20), IN `p_id_sector` BIGINT(20), IN `p_id_suelos_indirectos` BIGINT(20), IN `p_id_criterios_medicion` BIGINT(20), IN `p_descripcion` VARCHAR(255), IN `p_codigo_categoria` VARCHAR(20), IN `p_categoria_medicion` VARCHAR(20), IN `p_hoja` VARCHAR(255), IN `p_referencia` VARCHAR(255), IN `p_anio` INT(11), IN `p_cantidad_anual_n` FLOAT, IN `p_fraccion_n` FLOAT, IN `p_factor_emision` FLOAT, IN `p_cantidad_animal` FLOAT, IN `p_cantidad_orina` FLOAT, IN `p_fraccion_materiales` FLOAT, IN `p_cantidad_residuos` FLOAT, IN `p_cantidad_mineralizado` FLOAT, IN `p_fraccion_mineralizado` FLOAT, IN `p_fraccion_lixiviacion` FLOAT, IN `p_actualizado_por` VARCHAR(20), IN `p_estado` ENUM('ACTIVO','INACTIVO'))   BEGIN
    DECLARE currentDate TIMESTAMP; 
    DECLARE v_cantidad_deposicion FLOAT;
    DECLARE v_n2o_volatilizacion FLOAT;
    DECLARE v_cantidad_lixiviacion FLOAT;
    DECLARE v_n2o_lixxiviacion FLOAT;
    DECLARE v_total FLOAT;

       -- Cálculo de cantidad_deposicion
    SET v_cantidad_deposicion = ((p_cantidad_anual_n * p_fraccion_n) + (p_cantidad_animal + p_cantidad_orina) * p_fraccion_materiales) * p_factor_emision;

    -- Cálculo de n2o_volatilizacion
    SET v_n2o_volatilizacion = v_cantidad_deposicion * (44/28) * POWER(10, -6);

    -- Cálculo de cantidad_lixiviacion
    SET v_cantidad_lixiviacion = (p_cantidad_anual_n + p_cantidad_animal + p_cantidad_orina + p_cantidad_residuos) * p_fraccion_mineralizado * p_fraccion_lixiviacion;

    -- Cálculo de n2o_lixxiviacion
    SET v_n2o_lixxiviacion = v_cantidad_lixiviacion * (44/28) * POWER(10, -6);

    -- Cálculo de total
    SET v_total = v_n2o_volatilizacion + v_n2o_lixxiviacion;


      SET currentDate = NOW();

    -- Actualizar los campos en la tabla tbl_suelos_indirectos
    UPDATE tbl_suelos_indirectos
    SET
        id_ficha = p_id_ficha,
        id_categoria_ficha = p_id_categoria_ficha,
        id_sector = p_id_sector,
        id_suelos_indirectos = p_id_suelos_indirectos,
        id_criterios_medicion = p_id_criterios_medicion,
        descripcion = p_descripcion,
        codigo_categoria = p_codigo_categoria,
        categoria_medicion = p_categoria_medicion,
        hoja = p_hoja,
        referencia = p_referencia,
        anio = p_anio,
        cantidad_anual_n = p_cantidad_anual_n,
        fraccion_n = p_fraccion_n,
        factor_emision = p_factor_emision,
        cantidad_animal = p_cantidad_animal,
        cantidad_orina = p_cantidad_orina,
        fraccion_materiales = p_fraccion_materiales,
        cantidad_deposicion = v_cantidad_deposicion,
        cantidad_residuos = p_cantidad_residuos,
        cantidad_mineralizado = p_cantidad_mineralizado,
        fraccion_mineralizado = p_fraccion_mineralizado,
        fraccion_lixiviacion = p_fraccion_lixiviacion,
        cantidad_lixiviacion = p_cantidad_lixiviacion,
        cantidad_deposicion = v_cantidad_deposicion,
        n2o_volatilizacion = v_n2o_volatilizacion,
        cantidad_lixiviacion = v_cantidad_lixiviacion,
        n2o_lixxiviacion = v_n2o_lixxiviacion,
        total = v_total,
        actualizado_por = p_actualizado_por,
        fecha_actualizacion = CURRENT_TIMESTAMP,
        estado = p_estado
    WHERE
        id_suelos_indirectos_b = p_id_suelos_indirectos_b;
        
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
(9, '1', 'Mantenimiento', '', 1, '2023-10-29 10:40:33', 1, '2023-10-29 10:40:33', 'Activo'),
(11, '2', 'Mantenimiento Funcional', '', 1, '2023-10-29 21:23:40', 1, '2023-10-29 21:23:40', 'Activo'),
(13, '4', 'Mantenimiento Especie', '', 1, '2023-10-31 02:49:52', 1, '2023-10-31 02:49:52', 'Activo');

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
(57, 1, 1, 'SI', 'SI', 'SI', 'NO', 1, '2023-10-29 06:37:37', 1, '2023-10-31 02:55:38', 'ACTIVO');

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
-- Estructura de tabla para la tabla `tbl_categorias_cultivo`
--

CREATE TABLE `tbl_categorias_cultivo` (
  `id_cultivo` bigint(20) NOT NULL,
  `cultivo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `modificado_por` varchar(20) NOT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT current_timestamp(),
  `id_ficha` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_categorias_cultivo`
--

INSERT INTO `tbl_categorias_cultivo` (`id_cultivo`, `cultivo`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `id_ficha`, `id_sector`, `estado`) VALUES
(1, 'TRIGO', 'Medir la cantidad de emisiones', '1', '2023-11-04 17:47:32', 'profesor', '2023-12-03 16:49:08', 1, 0, 'ACTIVO'),
(3, 'MAIZ', 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 16:52:33', 'profesor', '2023-12-03 16:52:33', 1, 0, 'ACTIVO'),
(4, 'ARROZ', 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 16:53:25', 'profesor', '2023-12-03 16:53:25', 1, 0, 'ACTIVO'),
(5, 'CAÑA', 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 16:53:40', 'profesor', '2023-12-03 16:53:40', 1, 0, 'ACTIVO'),
(6, 'OTRO', 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 16:58:35', 'profesor', '2023-12-03 16:58:35', 1, 0, 'ACTIVO'),
(7, 'PRUEBA FINAL', 'x', 'ENRIQUEB', '2023-12-10 13:51:12', 'ENRIQUEB', '2023-12-10 13:51:37', 1, 0, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias_especies`
--

CREATE TABLE `tbl_categorias_especies` (
  `id_sector` bigint(20) NOT NULL,
  `id_categoria_especie` bigint(20) NOT NULL,
  `categoria_especie` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `actualizado_por` varchar(50) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_categorias_especies`
--

INSERT INTO `tbl_categorias_especies` (`id_sector`, `id_categoria_especie`, `categoria_especie`, `descripcion`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(0, 1, 'GANADO LECHERO', 'Medir la cantidad de emisiones', '1', '2023-10-11 00:38:11', 'profesor', '2023-12-03 12:27:36', 'ACTIVO'),
(0, 2, 'OTROS VACUNOS', 'Medir la cantidad de emisiones', '1', '2023-10-30 20:41:39', 'profesor', '2023-12-03 12:28:28', 'ACTIVO'),
(0, 6, 'BUFALO', 'Medir la cantidad de emisiones', '1', '2023-11-01 15:53:31', 'profesor', '2023-12-03 12:29:12', 'ACTIVO'),
(0, 7, 'OVINOS', 'Medir la cantidad de emisiones', '1', '2023-11-06 22:57:07', 'profesor', '2023-12-03 12:29:44', 'ACTIVO'),
(0, 9, 'Caprinos', 'Medir la cantidad de emisiones', '1', '2023-11-07 21:33:37', 'profesor', '2023-12-03 12:30:22', 'ACTIVO'),
(0, 12, 'EQUINOS', 'Medir la cantidad de emisiones', '1', '2023-11-08 04:03:39', 'profesor', '2023-12-03 12:30:50', 'ACTIVO'),
(0, 13, 'MULAS Y ASNOS', 'Medir la cantidad de emisiones', 'profesor', '2023-11-18 02:32:03', 'profesor', '2023-12-03 12:31:17', 'ACTIVO'),
(0, 14, 'PORCINOS', 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 12:32:30', 'profesor', '2023-12-03 12:32:30', 'ACTIVO'),
(0, 15, 'AVES DE CORRAL', 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 12:32:53', 'profesor', '2023-12-03 12:32:53', 'ACTIVO'),
(0, 16, 'OTROS', 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 12:33:08', 'profesor', '2023-12-03 12:33:08', 'ACTIVO'),
(0, 17, 'Vacuno Inicial', 'Final', 'profesor', '2023-12-04 01:05:07', 'ENRIQUEB', '2023-12-10 12:24:40', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias_fichas`
--

CREATE TABLE `tbl_categorias_fichas` (
  `id_sector` bigint(20) NOT NULL,
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `categoria_ficha` varchar(20) NOT NULL,
  `codigo_categoriaficha` varchar(10) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `hoja` varchar(20) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `formula` varchar(50) NOT NULL,
  `creado_por` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(50) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_categorias_fichas`
--

INSERT INTO `tbl_categorias_fichas` (`id_sector`, `id_ficha`, `id_categoria_ficha`, `categoria_ficha`, `codigo_categoriaficha`, `descripcion`, `hoja`, `referencia`, `formula`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(0, 1, 3, 'Fermentacion enteric', '0', 'Produce Cambio Climatico', '1', 'jsdkjshds', 'a/2', '1', '2023-11-01 19:09:34', 'profesor', '2023-12-03 18:26:08', 'ACTIVO'),
(0, 1, 7, 'Fermentacion enteric', '3A1 Y 3A2', 'Produce Cambio Climatico', '1', 'Capitulo 11 del Volu', 'C=A*B', 'profesor', '2023-12-03 18:27:38', 'profesor', '2023-12-03 18:27:38', 'ACTIVO'),
(0, 1, 8, 'Gestion del Estierco', '3A2', 'Medir la cantidad de emisiones', '2', 'Capitulo 11 del Volu', 'F=A*D*F  H=G*F', 'profesor', '2023-12-03 18:29:49', 'profesor', '2023-12-03 18:29:49', 'ACTIVO'),
(0, 1, 9, 'Quemado de Biomasa e', '3C1B', 'Medir la cantidad de emisiones', 'GEI de la quema de r', 'Capitulo 11 del Volu', 'E=A*B*C*D', 'profesor', '2023-12-03 18:31:27', 'profesor', '2023-12-03 18:31:27', 'ACTIVO'),
(0, 1, 10, 'Encalado', '3', 'Medir la cantidad de emisiones', 'CO2 del uso de cal e', 'Capitulo 11 del Volu', 'E=(A*B+C*D)*(44/12)/', 'profesor', '2023-12-03 18:33:51', 'profesor', '2023-12-04 00:59:29', 'ACTIVO'),
(0, 1, 11, 'UREA', '3C3', 'x', 'CO2 del uso de urea ', 'Capitulo 11 del Volu', 'A*B(*44/12)', 'ENRIQUEB', '2023-12-10 12:46:07', 'ENRIQUEB', '2023-12-10 12:46:07', 'ACTIVO'),
(0, 1, 12, 'SUELOS DIRECTOS', '3C4', 'x', 'N2o Directas por la ', 'Capitulo 11 del Volu', 'A+B', 'ENRIQUEB', '2023-12-10 12:48:11', 'ENRIQUEB', '2023-12-10 12:48:11', 'ACTIVO'),
(0, 1, 13, 'FON', '3C4', 'x', 'N2o Directas por la ', 'Capitulo 11 del Volu', 'A*B*C*D', 'ENRIQUEB', '2023-12-10 12:53:25', 'ENRIQUEB', '2023-12-10 12:53:25', 'ACTIVO'),
(0, 1, 14, 'FPRP', '3C4', 'Medir la cantidad de emisiones', 'N2o Directas por la ', 'Capitulo 11 del Volu', 'A*B*C', 'ENRIQUEB', '2023-12-10 12:55:13', 'ENRIQUEB', '2023-12-10 12:55:13', 'ACTIVO'),
(0, 1, 15, 'SUELOS INDIRECTOS', '3C5', 'X', 'N2o indirectas por v', 'Capitulo 11 del Volu', 'A*B*C', 'ENRIQUEB', '2023-12-10 12:56:56', 'ENRIQUEB', '2023-12-10 12:56:56', 'ACTIVO');

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
  `creado_por` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `modificado_por` varchar(50) NOT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_criterio_medicion`
--

INSERT INTO `tbl_criterio_medicion` (`nivel_medicion`, `id_criterios_medicion`, `id_categoria_ficha`, `criterio_medicion`, `unidad_medicion`, `encabezado_segun_categoria`, `sigla`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `estado`) VALUES
(0, 3, 3, 'kg de CH4/Cabeza', 'kg', 'sdasd', 'MU', 'Produce Cambio Climatico', '1', '2023-11-01 19:20:57', '0', '2023-11-01 19:20:57', 'ACTIVO'),
(1923, 5, 3, 'Ver cuantas emisiones se producen por dia', 'kg', '2esdsda', 'VACA', 'Fermentacion', '1', '2023-11-06 23:18:39', '0', '2023-11-06 23:19:11', 'ACTIVO'),
(0, 6, 3, 'Calcular los Gases de efecto invernadero', 'kg', 'C1', 'Tx, a*b', 'Medir la cantidad de emisiones', '1', '2023-11-12 23:35:39', '0', '2023-11-12 23:35:39', 'ACTIVO'),
(0, 7, 3, 'Final', 'ml', '3C1', 'A,B,C,D', 'Medir las Emisiones', 'profesor', '2023-12-04 01:09:32', 'profesor', '2023-12-04 01:09:32', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cultivos_encalado_medicion`
--

CREATE TABLE `tbl_cultivos_encalado_medicion` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` int(20) NOT NULL,
  `id_tipo_cal` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` date DEFAULT current_timestamp(),
  `numero_ficha` int(20) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `total` int(20) NOT NULL,
  `sigla` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` bigint(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cultivos_medicion`
--

CREATE TABLE `tbl_cultivos_medicion` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` int(20) NOT NULL,
  `id_cultivos_medicion` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` int(20) DEFAULT NULL,
  `numero_ficha` int(20) NOT NULL,
  `id_cultivo` bigint(20) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `total` int(20) NOT NULL,
  `sigla` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `tipo_superficie` decimal(10,3) NOT NULL,
  `masa_combustible` decimal(10,3) NOT NULL,
  `factor_combustion` decimal(10,3) NOT NULL,
  `factor_emision_ch` decimal(10,3) NOT NULL,
  `factor_emision_co` decimal(10,3) NOT NULL,
  `factor_emision_n2o` decimal(10,3) NOT NULL,
  `factor_emision_nox` decimal(10,3) NOT NULL,
  `emision_ch` decimal(10,3) NOT NULL,
  `emision_co` decimal(10,3) NOT NULL,
  `emision_n2o` decimal(10,3) NOT NULL,
  `emision_nox` decimal(10,3) NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL,
  `variacion` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_cultivos_medicion`
--

INSERT INTO `tbl_cultivos_medicion` (`id_ficha`, `id_categoria_ficha`, `nivel_medicion`, `id_cultivos_medicion`, `id_sector`, `anio`, `numero_ficha`, `id_cultivo`, `id_criterios_medicion`, `total`, `sigla`, `descripcion`, `tipo_superficie`, `masa_combustible`, `factor_combustion`, `factor_emision_ch`, `factor_emision_co`, `factor_emision_n2o`, `factor_emision_nox`, `emision_ch`, `emision_co`, `emision_n2o`, `emision_nox`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`, `variacion`) VALUES
(1, 3, 0, 2, 1, 0, 3, 1, 3, 1500, 'A,B,C,D', 'Medir la cantidad de emisiones', 2.000, 4.000, 0.900, 2.700, 92.000, 0.070, 2.500, 0.019, 0.662, 0.001, 0.018, 'profesor', '2023-11-26 15:10:02', 'profesor', '2023-11-26 15:10:02', 'ACTIVO', NULL),
(1, 5, 0, 3, 0, 20231202, 27, 1, 3, 0, 'A,B,C,D', 'Medir la cantidad de emisiones', 0.000, 10.000, 0.800, 2.700, 92.000, 0.070, 2.500, 0.000, 0.000, 0.000, 0.000, 'profesor', '2023-12-02 21:15:16', 'profesor', '2023-12-02 21:40:07', 'ACTIVO', NULL),
(1, 9, 2, 4, 0, 1999, 32, 3, 3, 0, 'A,B,C,D', 'Medir la cantidad de emisiones', 0.000, 5.500, 0.800, 2.700, 92.000, 0.070, 2.500, 0.000, 0.000, 0.000, 0.000, 'profesor', '2023-12-03 07:24:32', 'profesor', '2023-12-10 05:03:52', 'ACTIVO', NULL),
(1, 9, 0, 5, 0, 2003, 100, 1, 3, 0, 'a', 'x', 0.000, 4.000, 0.900, 2.700, 92.000, 0.007, 2.500, 0.000, 0.000, 0.000, 0.000, 'profesor', '2023-12-04 01:55:06', 'profesor', '2023-12-08 03:32:32', 'ACTIVO', NULL),
(1, 3, 0, 6, 0, 2000, 1, 1, 3, 0, 'A,B,C,D', 'Materia de seca quemada', 0.000, 4.000, 0.900, 2.700, 92.000, 0.070, 2.500, 0.000, 0.000, 0.000, 0.000, 'profesor', '2023-12-08 22:47:06', 'profesor', '2023-12-08 22:47:06', 'ACTIVO', NULL),
(1, 3, 0, 7, 0, 2000, 1, 1, 3, 0, 'A,B,C,D', 'Materia de seca quemada', 0.000, 4.000, 0.900, 2.700, 92.000, 0.070, 2.500, 0.000, 0.000, 0.000, 0.000, 'profesor', '2023-12-08 22:55:10', 'profesor', '2023-12-08 22:55:10', 'ACTIVO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cultivos_medicion_resumen`
--
-- Error leyendo la estructura de la tabla bd_cc.tbl_cultivos_medicion_resumen: #1932 - Table 'bd_cc.tbl_cultivos_medicion_resumen' doesn't exist in engine
-- Error leyendo datos de la tabla bd_cc.tbl_cultivos_medicion_resumen: #1064 - Algo está equivocado en su sintax cerca 'FROM `bd_cc`.`tbl_cultivos_medicion_resumen`' en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cultivos_medicion_resumen3c1bresiduos`
--

CREATE TABLE `tbl_cultivos_medicion_resumen3c1bresiduos` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(255) NOT NULL,
  `id_cultivos_medicion` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` date DEFAULT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `medida1` decimal(10,0) DEFAULT NULL,
  `medida2` decimal(10,0) DEFAULT NULL,
  `equivalente` int(11) DEFAULT NULL,
  `variacion` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cultivos_medicion_resumen3c2encalado`
--

CREATE TABLE `tbl_cultivos_medicion_resumen3c2encalado` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(255) NOT NULL,
  `id_cultivos_medicion` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` date DEFAULT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `medida1` decimal(10,0) DEFAULT NULL,
  `medida2` decimal(10,0) DEFAULT NULL,
  `equivalente` int(11) DEFAULT NULL,
  `variacion` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_encalado_medicion_n`
--

CREATE TABLE `tbl_encalado_medicion_n` (
  `id_encalado_medicion` bigint(20) NOT NULL,
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(20) NOT NULL,
  `id_tipo_cal` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` int(20) DEFAULT NULL,
  `numero_ficha` int(11) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `codigo_categoria` varchar(20) NOT NULL,
  `hoja` varchar(100) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `cantidad_anual_pc` decimal(10,3) DEFAULT NULL,
  `factor_pc` decimal(10,3) DEFAULT NULL,
  `cantidad_anual_dolomita` decimal(10,1) DEFAULT NULL,
  `factor_dolomita` decimal(10,3) DEFAULT NULL,
  `emision_co_pc` decimal(10,3) DEFAULT NULL,
  `emision_co_dolomita` decimal(10,3) DEFAULT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL,
  `variacion` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_encalado_medicion_n`
--

INSERT INTO `tbl_encalado_medicion_n` (`id_encalado_medicion`, `id_ficha`, `id_categoria_ficha`, `nivel_medicion`, `id_tipo_cal`, `id_sector`, `anio`, `numero_ficha`, `id_criterios_medicion`, `sigla`, `descripcion`, `codigo_categoria`, `hoja`, `referencia`, `cantidad_anual_pc`, `factor_pc`, `cantidad_anual_dolomita`, `factor_dolomita`, `emision_co_pc`, `emision_co_dolomita`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`, `variacion`) VALUES
(5, 1, 8, '2', 1, 0, 2007, 23, 3, 'MU', 'Medir la cantidad de emisiones', '3C2', 'CO2 del uso de cal en suelos agricolas tier-1', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 369.000, 0.120, 0.0, 0.000, 0.162, 0.000, 'profesor', '2023-12-03 08:59:46', 'profesor', '2023-12-10 05:07:38', 'ACTIVO', NULL),
(6, 1, 10, '1', 2, 8, 2007, 23, 3, 'MU', 'Medir la cantidad de emisiones', '3C2', 'CO2 del uso de cal en suelos agricolas tier-1', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 0.000, 0.000, 3504.0, 0.130, 0.000, 1.670, 'profesor', '2023-12-03 09:00:19', 'ENRIQUEB', '2023-12-10 15:17:44', 'ACTIVO', NULL),
(7, 1, 10, '1', 2, 0, 2007, 100, 3, 'A', 'x', '3C2', 'uso de cal', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 0.000, 0.000, 3504.0, 0.130, 0.000, 1.670, 'profesor', '2023-12-04 01:58:24', 'ENRIQUEB', '2023-12-10 15:19:48', 'ACTIVO', NULL),
(8, 1, 10, '1', 2, 0, 2006, 1, 3, 'ABCD', 'x', '3C2', 'CO2 del uso de cal en suelos agricolas tier-1', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 0.000, 0.000, 1969.0, 0.130, 0.000, 0.939, 'profesor', '2023-12-08 22:59:54', 'ENRIQUEB', '2023-12-10 15:16:24', 'ACTIVO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_encalado_medicion_resumen`
--
-- Error leyendo la estructura de la tabla bd_cc.tbl_encalado_medicion_resumen: #1932 - Table 'bd_cc.tbl_encalado_medicion_resumen' doesn't exist in engine
-- Error leyendo datos de la tabla bd_cc.tbl_encalado_medicion_resumen: #1064 - Algo está equivocado en su sintax cerca 'FROM `bd_cc`.`tbl_encalado_medicion_resumen`' en la linea 1

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
  `creado_por` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `actualizado_por` varchar(50) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_especie`
--

INSERT INTO `tbl_especie` (`id_sector`, `id_categoria_especie`, `id_especie`, `especie`, `descripcion`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 1, 1, 'Vacas lecheras', 'Produccion', '1', '2023-10-13 01:01:01', '1', '2023-10-31 17:13:54', 'ACTIVO'),
(0, 1, 4, 'TERNEROS', 'Produccion', '1', '2023-11-01 18:08:07', 'profesor', '2023-12-03 12:39:39', 'ACTIVO'),
(6, 6, 5, 'Cabras y Burros', 'Medir la cantidad de emisiones', '1', '2023-11-06 23:08:47', '1', '2023-11-06 23:09:31', 'ACTIVO'),
(9, 1, 6, 'Vacas lecheras', 'Produccion', '1', '2023-11-08 05:52:29', '1', '2023-11-13 23:08:01', 'ACTIVO'),
(1, 7, 8, 'Terneros', 'Produccion', 'profesor', '2023-11-18 02:52:20', 'profesor', '2023-11-18 02:53:08', 'ACTIVO');

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
-- Estructura de tabla para la tabla `tbl_estiercol_fprp_medicion_n`
--

CREATE TABLE `tbl_estiercol_fprp_medicion_n` (
  `id_fprp_estiercol_medicion` bigint(20) NOT NULL,
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(20) NOT NULL,
  `id_gestion_estiercol_FPRP` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` int(20) DEFAULT NULL,
  `numero_ficha` int(11) NOT NULL,
  `id_categoria_especie` bigint(20) NOT NULL,
  `id_especie` bigint(20) NOT NULL,
  `categoria_medicion` varchar(20) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `cantidad_especie` float NOT NULL,
  `promedio_anual_excrecion` decimal(10,5) NOT NULL,
  `fraccion_excrecion_anual` decimal(10,5) NOT NULL,
  `emisiones_directas_FPRP` float NOT NULL,
  `total_emisiones` float NOT NULL,
  `total_v_a_p` float NOT NULL,
  `total_o_otros` float NOT NULL,
  `hoja` varchar(100) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_estiercol_fprp_medicion_n`
--

INSERT INTO `tbl_estiercol_fprp_medicion_n` (`id_fprp_estiercol_medicion`, `id_ficha`, `id_categoria_ficha`, `nivel_medicion`, `id_gestion_estiercol_FPRP`, `id_sector`, `anio`, `numero_ficha`, `id_categoria_especie`, `id_especie`, `categoria_medicion`, `id_criterios_medicion`, `cantidad_especie`, `promedio_anual_excrecion`, `fraccion_excrecion_anual`, `emisiones_directas_FPRP`, `total_emisiones`, `total_v_a_p`, `total_o_otros`, `hoja`, `referencia`, `descripcion`, `sigla`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 1, 8, 'M2', 1, 0, 1997, 27, 1, 1, '3a fermentacion ente', 3, 384752, 70.08000, 100.00000, 100000, 0, 0, 0, 'N2o Directas por la aplicacion de fertilizantes estiercol y Residuos', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 'x', 'A,B,C,D', 'profesor', '2023-12-02 23:50:10', 'profesor', '2023-12-09 21:13:03', 'ACTIVO'),
(2, 1, 3, 'm2', 1, 0, 2006, 29, 1, 1, '3a fermentacion ente', 3, 425551, 70.08000, 100.00000, 100000, 0, 0, 0, 'N2o Directas por la aplicacion de fertilizantes estiercol y Residuos', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 'x', 'A,B,C,D', 'profesor', '2023-12-10 05:52:38', 'profesor', '2023-12-10 05:52:38', 'ACTIVO'),
(3, 1, 3, 'M2', 1, 0, 2005, 29, 1, 1, '3a fermentacion ente', 3, 384754, 70.08000, 100.00000, 2696360000, 0, 0, 0, 'N2o Directas por la aplicacion de fertilizantes estiercol y Residuos', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 'x', 'A,B,C,D', 'ENRIQUEB', '2023-12-10 12:14:28', 'ENRIQUEB', '2023-12-10 12:14:28', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estiercol_fprp_n`
--

CREATE TABLE `tbl_estiercol_fprp_n` (
  `id_gestion_estiercol_FPRP` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `id_categoria_especie` bigint(20) NOT NULL,
  `id_especie` bigint(20) NOT NULL,
  `gestion_estiercol_FPRP` varchar(50) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_estiercol_fprp_n`
--

INSERT INTO `tbl_estiercol_fprp_n` (`id_gestion_estiercol_FPRP`, `id_sector`, `id_categoria_especie`, `id_especie`, `gestion_estiercol_FPRP`, `sigla`, `descripcion`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 0, 1, 1, 'Pastura Prado Pradera', 'A,B,C,D', 'Medir la cantidad de emisiones', 'profesor', '2023-12-02 23:46:52', 'profesor', '2023-12-02 23:46:52', 'ACTIVO'),
(2, 0, 1, 1, 'Prueba Inicial', 'A,B,C,D', 'x', 'ENRIQUEB', '2023-12-10 13:49:29', 'ENRIQUEB', '2023-12-10 13:50:09', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estiercol_n2o`
--

CREATE TABLE `tbl_estiercol_n2o` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(20) NOT NULL,
  `id_estiercol` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` int(20) DEFAULT NULL,
  `numero_ficha` int(20) NOT NULL,
  `id_categoria_especie` bigint(20) NOT NULL,
  `id_especie` bigint(20) NOT NULL,
  `categoria_medicion` varchar(255) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `cantidad_especie` int(20) NOT NULL,
  `sigla` varchar(45) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` bigint(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL,
  `tasa_excrecion` decimal(10,5) NOT NULL,
  `masa_animal` decimal(10,5) NOT NULL,
  `promedio_anual_excrecion` float NOT NULL,
  `fraccion_excrecion` decimal(5,2) NOT NULL,
  `n_total_excretado` float NOT NULL,
  `factor_emisiones_directas` decimal(10,5) NOT NULL,
  `emision_directas` float NOT NULL,
  `id_gestion_estiercol_mms` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_estiercol_n2o`
--

INSERT INTO `tbl_estiercol_n2o` (`id_ficha`, `id_categoria_ficha`, `nivel_medicion`, `id_estiercol`, `id_sector`, `anio`, `numero_ficha`, `id_categoria_especie`, `id_especie`, `categoria_medicion`, `id_criterios_medicion`, `cantidad_especie`, `sigla`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`, `tasa_excrecion`, `masa_animal`, `promedio_anual_excrecion`, `fraccion_excrecion`, `n_total_excretado`, `factor_emisiones_directas`, `emision_directas`, `id_gestion_estiercol_mms`) VALUES
(1, 5, '2000', 2, 1, 20231112, 29, 1, 1, '3a fermentacion enterica', 3, 5154, 'TY', 1, '2023-11-13 01:49:58', 1, '2023-11-13 01:50:33', 'ACTIVO', 0.00000, 0.00000, 0, 0.00, 0, 0.00000, 0, 0),
(0, 0, '0', 3, 0, NULL, 0, 0, 1, '', 0, 0, '', 0, '2023-12-02 15:18:53', 0, '2023-12-02 15:18:53', 'ACTIVO', 0.48000, 400.00000, 70.08, 0.90, 0, 0.00000, 0, 0),
(0, 0, '0', 4, 0, NULL, 0, 0, 8, '', 0, 0, '', 0, '2023-12-02 23:32:17', 0, '2023-12-02 23:32:17', 'ACTIVO', 0.48000, 400.00000, 70.08, 999.99, 0, 0.00000, 0, 0),
(0, 0, '0', 5, 0, NULL, 0, 0, 1, '', 0, 0, '', 0, '2023-12-02 23:33:39', 0, '2023-12-02 23:33:39', 'ACTIVO', 20.00000, 20.00000, 146, 20.00, 0, 0.00000, 0, 0),
(0, 0, '0', 6, 0, NULL, 0, 0, 1, '', 0, 0, '', 0, '2023-12-04 00:22:57', 0, '2023-12-04 00:22:57', 'ACTIVO', 0.32000, 380.00000, 44.384, 0.00, 0, 0.00000, 0, 0),
(0, 0, '0', 7, 0, NULL, 0, 0, 1, '', 0, 0, '', 0, '2023-12-04 01:48:21', 0, '2023-12-04 01:48:21', 'ACTIVO', 0.48000, 400.00000, 70.08, 100.00, 0, 0.00000, 0, 0),
(1, 7, 'm2', 8, 0, 2010, 20, 1, 1, '3a1 fermentacion enterica', 3, 458169, 'S,T,N', 0, '2023-12-09 03:52:46', 0, '2023-12-09 05:57:37', 'ACTIVO', 0.48000, 400.00000, 70.08, 70.08, 100000, 100.00000, 100000, 1),
(1, 3, 'M2', 9, 0, 2009, 2, 1, 1, '3a fermentacion enterica', 3, 334078, 'A,B,C,D', 0, '2023-12-10 06:03:09', 0, '2023-12-10 06:03:09', 'ACTIVO', 0.48000, 400.00000, 70.08, 0.00, 0, 0.00000, 0, 1),
(1, 3, 'M2', 10, 0, 2010, 2, 1, 1, '3a fermentacion enterica', 3, 367020, 'A,B,C,D', 0, '2023-12-10 11:47:08', 0, '2023-12-10 11:47:08', 'ACTIVO', 0.48000, 400.00000, 70.08, 100.00, 2572080000, 0.00000, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estiercol_n2o_resumen`
--

CREATE TABLE `tbl_estiercol_n2o_resumen` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(45) NOT NULL,
  `id_estiercol` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` date DEFAULT current_timestamp(),
  `id_criterios_medicion` bigint(20) NOT NULL,
  `medida_oxidonitroso` decimal(50,2) NOT NULL,
  `medida_dioxidocarbono` decimal(50,2) NOT NULL,
  `equivalente` int(11) NOT NULL,
  `variacion` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fermentacion_estiercol`
--

CREATE TABLE `tbl_fermentacion_estiercol` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(11) NOT NULL,
  `id_fermentacion` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` int(20) DEFAULT NULL,
  `numero_ficha` int(11) NOT NULL,
  `id_categoria_especie` bigint(20) NOT NULL,
  `id_especie` bigint(20) NOT NULL,
  `categoria_medicion` varchar(45) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `cantidad_especie` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `sigla` varchar(45) NOT NULL,
  `creado_por` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `actualizado_por` varchar(50) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `factor_fermentacion` decimal(50,0) NOT NULL,
  `factor_estiercol` decimal(50,0) NOT NULL,
  `total_fermentacion` decimal(50,0) NOT NULL,
  `total_estiercol` decimal(50,0) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  `variacion` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_fermentacion_estiercol`
--

INSERT INTO `tbl_fermentacion_estiercol` (`id_ficha`, `id_categoria_ficha`, `nivel_medicion`, `id_fermentacion`, `id_sector`, `anio`, `numero_ficha`, `id_categoria_especie`, `id_especie`, `categoria_medicion`, `id_criterios_medicion`, `cantidad_especie`, `descripcion`, `sigla`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `factor_fermentacion`, `factor_estiercol`, `total_fermentacion`, `total_estiercol`, `estado`, `variacion`) VALUES
(1, 3, 'M2', 23, 0, 2000, 23, 1, 1, '3a fermentacion enterica', 3, 227942, 'Medir la cantidad de emisiones', 'A,B,C,D', 'profesor', '2023-12-03 17:43:42', 'profesor', '2023-12-03 17:43:42', 63, 2, 14, 0, 'ACTIVO', NULL),
(1, 3, 'M2', 24, 0, 2000, 23, 2, 1, '3a fermentacion enterica', 3, 1559619, 'Medir la cantidad de emisiones', 'A,B,C,D', 'profesor', '2023-12-03 17:45:02', 'profesor', '2023-12-03 17:45:02', 56, 1, 87, 2, 'ACTIVO', NULL),
(1, 3, 'M2', 25, 0, 2000, 23, 6, 1, '3a fermentacion enterica', 3, 0, 'Medir la cantidad de emisiones', 'A,B,C,D', 'profesor', '2023-12-03 17:45:51', 'profesor', '2023-12-03 17:45:51', 55, 2, 0, 0, 'ACTIVO', NULL),
(1, 3, 'M2', 26, 0, 2000, 23, 7, 1, '3a fermentacion enterica', 3, 0, 'Medir la cantidad de emisiones', 'A,B,C,D', 'profesor', '2023-12-03 17:51:23', 'profesor', '2023-12-03 17:51:23', 5, 0, 0, 0, 'ACTIVO', NULL),
(1, 3, 'M2', 27, 0, 2000, 23, 9, 1, '3a fermentacion enterica', 3, 0, 'Medir la cantidad de emisiones', 'A,B,C,D', 'profesor', '2023-12-03 17:55:17', 'profesor', '2023-12-03 17:55:17', 5, 0, 0, 0, 'ACTIVO', NULL),
(1, 3, 'M2', 28, 0, 2000, 23, 12, 1, '3a fermentacion enterica', 3, 0, 'Medir la cantidad de emisiones', 'A,B,C,D', 'profesor', '2023-12-03 17:59:04', 'profesor', '2023-12-03 17:59:04', 18, 2, 0, 0, 'ACTIVO', NULL),
(1, 3, 'M2', 29, 0, 2000, 23, 13, 1, '3a fermentacion enterica', 3, 0, 'Medir la cantidad de emisiones', 'A,B,C,D', 'profesor', '2023-12-03 18:00:24', 'profesor', '2023-12-03 18:00:24', 10, 1, 0, 0, 'ACTIVO', NULL),
(1, 3, 'M2', 30, 0, 2000, 23, 14, 1, '3a fermentacion enterica', 3, 505309, 'Medir la cantidad de emisiones', 'A,B,C,D', 'profesor', '2023-12-03 18:01:31', 'profesor', '2023-12-03 18:01:31', 1, 2, 1, 1, 'ACTIVO', NULL),
(1, 3, 'M2', 31, 0, 2000, 23, 15, 1, '3a fermentacion enterica', 3, 17559127, 'Medir la cantidad de emisiones', 'A,B,C,D', 'profesor', '2023-12-03 18:02:58', 'profesor', '2023-12-03 18:02:58', 0, 0, 0, 0, 'ACTIVO', NULL),
(1, 3, 'M2', 32, 0, 2000, 23, 16, 1, '3a fermentacion enterica', 3, 0, 'Medir la cantidad de emisiones', 'A,B,C,D', 'profesor', '2023-12-03 18:03:37', 'profesor', '2023-12-03 18:03:37', 0, 0, 0, 0, 'ACTIVO', NULL),
(1, 3, 'kg Ch4', 34, 0, 2000, 100, 1, 1, '3a fermentacion enterica', 3, 538003, 'x', 'kg de ch cabeza', 'profesor', '2023-12-04 01:32:09', 'profesor', '2023-12-04 01:32:09', 1, 2, 1, 1, 'ACTIVO', NULL),
(1, 3, 'M2', 35, 0, 2003, 1, 1, 1, '3a fermentacion enterica', 3, 277069, 'x', 'x', 'profesor', '2023-12-08 03:01:02', 'profesor', '2023-12-08 03:01:02', 63, 2, 17, 1, 'ACTIVO', NULL),
(1, 3, 'M2', 36, 0, 2004, 1, 1, 1, '3a fermentacion enterica', 3, 320289, 'x', 'x', 'profesor', '2023-12-08 22:31:00', 'profesor', '2023-12-08 22:31:00', 63, 2, 20, 1, 'ACTIVO', NULL),
(1, 3, 'M2', 37, 0, 2000, 27, 1, 1, '3a fermentacion enterica', 3, 999, 'x', 'A,B,C,D', 'ENRIQUEB', '2023-12-10 16:35:03', 'ENRIQUEB', '2023-12-10 16:35:03', 5, 1, 0, 0, 'ACTIVO', NULL),
(1, 3, 'M2', 38, 0, 2007, 2, 1, 1, '3a fermentacion enterica', 3, 1999, 'x', 'A,B,C,D', 'ENRIQUEB', '2023-12-10 16:36:59', 'ENRIQUEB', '2023-12-10 16:36:59', 6, 2, 0, 0, 'ACTIVO', NULL);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fermentacion_estiercol_resumen`
--

CREATE TABLE `tbl_fermentacion_estiercol_resumen` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(45) NOT NULL,
  `id_fermentacion` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` date DEFAULT current_timestamp(),
  `categoria_medicion` varchar(50) NOT NULL,
  `equivalente` int(20) NOT NULL,
  `descripcion_equivalente` varchar(255) NOT NULL,
  `variacion` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fichas`
--

CREATE TABLE `tbl_fichas` (
  `id_ficha` bigint(20) NOT NULL,
  `fecha_solicitud` timestamp NULL DEFAULT NULL,
  `anio_solicitud` timestamp NULL DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `actualizado_por` varchar(50) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `fecha_entrevista` timestamp NULL DEFAULT NULL,
  `nombre_encuentador` varchar(255) NOT NULL,
  `firma_productor` varchar(45) NOT NULL,
  `nombre_encuestador` varchar(255) NOT NULL,
  `firma_encuestador` varchar(45) NOT NULL,
  `nombre_supervisor` varchar(255) NOT NULL,
  `firma_supervisor` varchar(45) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_fichas`
--

INSERT INTO `tbl_fichas` (`id_ficha`, `fecha_solicitud`, `anio_solicitud`, `descripcion`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `fecha_entrevista`, `nombre_encuentador`, `firma_productor`, `nombre_encuestador`, `firma_encuestador`, `nombre_supervisor`, `firma_supervisor`, `estado`) VALUES
(1, '2023-10-11 17:26:30', '2016-10-28 17:26:30', 'Medir la cantidad de emisiones', '1', '2023-10-03 17:26:30', '1', '2023-11-09 20:10:21', '2023-10-04 17:26:30', 'Administrador', 'jsgdjhgsdjgds', 'Roberto Peña', 'shvdjadshvjsd', 'Marco Isidro', 'cxvfdvc', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fon`
--

CREATE TABLE `tbl_fon` (
  `id_fon` bigint(20) NOT NULL,
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` int(20) NOT NULL,
  `id_gestion_estiercol_mms` bigint(20) NOT NULL,
  `id_categoria_especie` bigint(20) NOT NULL,
  `id_especie` bigint(20) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `numero_ficha` int(20) NOT NULL,
  `categoria_medicion` varchar(50) NOT NULL,
  `cantidad_especie` float NOT NULL,
  `promedio_b` decimal(10,5) NOT NULL,
  `fraccion_c` decimal(10,5) NOT NULL,
  `cantidad_nitrogeno_d` decimal(5,2) NOT NULL,
  `cantidad_nitrogeno_e` decimal(5,2) NOT NULL,
  `cantidad_nitrogeno_f` decimal(10,5) NOT NULL,
  `cantidad_g` float NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL,
  `id_sistema` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_fon`
--

INSERT INTO `tbl_fon` (`id_fon`, `id_ficha`, `id_categoria_ficha`, `nivel_medicion`, `id_sector`, `anio`, `id_gestion_estiercol_mms`, `id_categoria_especie`, `id_especie`, `id_criterios_medicion`, `numero_ficha`, `categoria_medicion`, `cantidad_especie`, `promedio_b`, `fraccion_c`, `cantidad_nitrogeno_d`, `cantidad_nitrogeno_e`, `cantidad_nitrogeno_f`, `cantidad_g`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`, `id_sistema`) VALUES
(20, 0, 0, '', 0, 0, 0, 0, 1, 0, 0, '', 367020, 70.08000, 0.00000, 0.00, 1.00, 0.00000, 0, '', '2023-12-07 00:32:51', '', '2023-12-07 00:34:49', 'ACTIVO', 1),
(21, 0, 0, '', 0, 0, 0, 0, 1, 0, 0, '', 1772670, 40.08000, 0.00000, 0.00, 1.00, 0.00000, 0, '', '2023-12-07 00:32:51', '', '2023-12-07 00:34:49', 'ACTIVO', 1),
(22, 1, 8, 'm2', 0, 2020, 3, 1, 1, 3, 29, '3a fermentacion enterica', 367020, 70.08000, 0.00000, 0.00, 100.00, 0.00000, 0, 'profesor', '2023-12-09 15:39:24', 'profesor', '2023-12-09 20:39:27', 'ACTIVO', NULL),
(23, 1, 3, 'M2', 0, 2009, 1, 1, 1, 3, 27, '3a fermentacion enterica', 334078, 70.08000, 0.00000, 0.00, 100.00, 0.00000, 0, 'profesor', '2023-12-10 05:36:42', 'profesor', '2023-12-10 05:36:42', 'ACTIVO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gestion_fon_estiercol_resumen`
--

CREATE TABLE `tbl_gestion_fon_estiercol_resumen` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(45) NOT NULL,
  `id_estiercol` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` date DEFAULT current_timestamp(),
  `total` decimal(50,2) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gestion_mms_estiercol`
--

CREATE TABLE `tbl_gestion_mms_estiercol` (
  `id_gestion_estiercol_mms` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `id_categoria_especie` bigint(20) NOT NULL,
  `id_especie` bigint(20) NOT NULL,
  `gestion_estiercol` varchar(255) NOT NULL,
  `sigla` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_gestion_mms_estiercol`
--

INSERT INTO `tbl_gestion_mms_estiercol` (`id_gestion_estiercol_mms`, `id_sector`, `id_categoria_especie`, `id_especie`, `gestion_estiercol`, `sigla`, `descripcion`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 0, 1, 1, 'Pastura / Prado / Pradera', 'A,B,C,D', 'Medir la cantidad de emisiones', '1', '2023-11-04 17:03:29', 'profesor', '2023-12-03 16:09:26', 'ACTIVO'),
(3, 0, 1, 1, 'Liquido Fango ', 'UREA', 'Medir la cantidad de emisiones', '1', '2023-11-06 18:14:04', 'profesor', '2023-12-03 16:10:13', 'ACTIVO'),
(4, 0, 1, 1, 'Almacenaje de solidos de corral de engorde', 'A,B,C,D', 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 16:11:21', 'ENRIQUEB', '2023-12-10 13:52:42', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gestion_mms_estiercol_fon`
--

CREATE TABLE `tbl_gestion_mms_estiercol_fon` (
  `id_gestion_estiercol_fon` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `id_categoria_especie` bigint(20) NOT NULL,
  `id_especie` bigint(20) NOT NULL,
  `gestion_estiercol_mms` varchar(100) NOT NULL,
  `sigla` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` bigint(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` bigint(20) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_gestion_mms_estiercol_fon`
--

INSERT INTO `tbl_gestion_mms_estiercol_fon` (`id_gestion_estiercol_fon`, `id_sector`, `id_categoria_especie`, `id_especie`, `gestion_estiercol_mms`, `sigla`, `descripcion`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 1, 1, 1, 'Gestion FON', 'TX', 'Medir la cantidad de emisiones', 1, '2023-11-13 17:06:22', 1, '2023-11-13 17:24:16', 'ACTIVO'),
(2, 0, 2, 1, 'Almacenaje de solidos corral de engorde', 'A,B,C,D, E,F', 'Medir la cantidad de emisiones', 0, '2023-12-03 22:43:48', 0, '2023-12-03 22:43:48', 'ACTIVO'),
(3, 0, 1, 1, 'Prueba Inicial', 'A,B,C,D', 'Medir la cantidad de emisiones', 0, '2023-12-10 13:37:19', 0, '2023-12-10 13:44:21', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gestion_mms_estiercol_resumen_n`
--

CREATE TABLE `tbl_gestion_mms_estiercol_resumen_n` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(255) NOT NULL,
  `id_estiercol` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` date DEFAULT NULL,
  `categoria_medicion` varchar(255) NOT NULL,
  `equivalente` int(11) DEFAULT NULL,
  `descripcion_equivalente` varchar(255) NOT NULL,
  `variacion` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `tbl_medicion_urea_resumen`
--

CREATE TABLE `tbl_medicion_urea_resumen` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(45) NOT NULL,
  `id_subcategoria_urea` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` date DEFAULT current_timestamp(),
  `id_criterios_medicion` bigint(20) NOT NULL,
  `medida_dioxidocarbono` decimal(50,2) NOT NULL,
  `equivalente` int(11) NOT NULL,
  `variacion` decimal(20,2) DEFAULT NULL
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

--
-- Volcado de datos para la tabla `tbl_parametros`
--

INSERT INTO `tbl_parametros` (`id_parametros`, `id_usuario`, `parametro`, `valor`, `Fecha_Creacion`, `Fecha_Modificacion`) VALUES
(1, 1, 'admin_dias_vigencia', '360', '2023-12-09 23:48:41', '2023-12-08 23:48:41');

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
  `sector` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(50) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_sector`
--

INSERT INTO `tbl_sector` (`id_sector`, `sector`, `descripcion`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(0, 'Agricultura', 'Medir la cantidad de emisiones', 'profesor', '2023-12-02 19:17:10', 'profesor', '2023-12-02 19:17:10', 'ACTIVO'),
(1, 'urea', 'Es un gas de cambio climatico', '1', '2023-10-30 16:13:47', '1', '2023-11-01 23:13:39', 'ACTIVO'),
(2, 'Medir la cantidad de emisiones', '1', '1', '2023-10-30 17:30:14', '0', '2023-10-31 21:10:38', 'ACTIVO'),
(6, 'Estiercol y encalado', 'a', '0', '2023-11-01 23:14:43', '1', '2023-11-01 23:15:53', 'ACTIVO'),
(8, 'Encalado', 'Produce Cambio Climatico', '1', '2023-11-01 23:27:54', '0', '2023-11-01 23:27:54', 'ACTIVO'),
(9, ' estiercol', 'Medir la cantidad de emisiones', '1', '2023-11-04 02:15:15', '1', '2023-11-08 03:23:12', 'ACTIVO'),
(17, 'Bosque', 'urea', 'profesor', '2023-11-14 04:37:53', 'profesor', '2023-11-14 04:37:53', 'ACTIVO'),
(19, 'Suelos Indirectos', 'Medir las Emisiones', 'profesor', '2023-11-17 17:57:06', 'ENRIQUEB', '2023-12-10 14:02:26', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sistema_mms`
--

CREATE TABLE `tbl_sistema_mms` (
  `id_sistema` bigint(20) NOT NULL,
  `sistema` varchar(255) NOT NULL,
  `formula` varchar(255) NOT NULL,
  `sigla` varchar(45) NOT NULL,
  `definicion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_sistema_mms`
--

INSERT INTO `tbl_sistema_mms` (`id_sistema`, `sistema`, `formula`, `sigla`, `definicion`) VALUES
(1, 'SISTEMA DE AGRICULTURA FAMILIAR', 'a*b+2', 'AF', 'Es para los gases de cambio climatico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sub_categorias_urea`
--

CREATE TABLE `tbl_sub_categorias_urea` (
  `id_subcategoria_urea` bigint(20) NOT NULL,
  `categoria_urea` varchar(255) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_sub_categorias_urea`
--

INSERT INTO `tbl_sub_categorias_urea` (`id_subcategoria_urea`, `categoria_urea`, `id_sector`, `descripcion`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 'Tierras Forestales', 6, 'Medir la cantidad de emisiones', '1', '2023-11-04 18:59:15', 'profesor', '2023-12-03 21:52:13', 'ACTIVO'),
(6, 'Tierras de Cultivo', 1, 'Medir la cantidad de emisiones', '1', '2023-11-13 15:42:18', 'profesor', '2023-12-03 21:52:44', 'ACTIVO'),
(7, 'Pastizales', 0, 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 21:45:59', 'profesor', '2023-12-03 21:45:59', 'ACTIVO'),
(8, 'Asentamientos', 0, 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 21:53:04', 'profesor', '2023-12-03 21:53:04', 'ACTIVO'),
(9, 'Otras ureas', 0, 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 21:53:27', 'ENRIQUEB', '2023-12-10 13:50:34', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_suelosdirectos_medicion`
--

CREATE TABLE `tbl_suelosdirectos_medicion` (
  `id_suelosDirectos_medicion` bigint(20) NOT NULL,
  `id_ficha` bigint(20) DEFAULT NULL,
  `id_categoria_ficha` bigint(20) DEFAULT NULL,
  `id_sector` bigint(20) NOT NULL,
  `id_suelo_directo` bigint(20) NOT NULL,
  `anio` int(20) DEFAULT NULL,
  `numero_ficha` int(10) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `codigo_categoria` varchar(20) NOT NULL,
  `descripcion_suelo` varchar(100) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `descripcion_medicion` varchar(255) NOT NULL,
  `cantidad_anual_n_formula` varchar(50) NOT NULL,
  `cantidad_anual_n_dato` bigint(50) NOT NULL,
  `factor_emision_formula` varchar(50) NOT NULL,
  `factor_emision_dato` decimal(10,5) NOT NULL,
  `emisiones_directas_aportes` float DEFAULT NULL,
  `subtotal` decimal(10,5) DEFAULT NULL,
  `total` decimal(10,5) DEFAULT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_suelosdirectos_medicion`
--

INSERT INTO `tbl_suelosdirectos_medicion` (`id_suelosDirectos_medicion`, `id_ficha`, `id_categoria_ficha`, `id_sector`, `id_suelo_directo`, `anio`, `numero_ficha`, `id_criterios_medicion`, `codigo_categoria`, `descripcion_suelo`, `sigla`, `descripcion_medicion`, `cantidad_anual_n_formula`, `cantidad_anual_n_dato`, `factor_emision_formula`, `factor_emision_dato`, `emisiones_directas_aportes`, `subtotal`, `total`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 1, 3, 0, 1, 20231202, 23, 3, '3C5', 'Fertilizante Sintetico', 'A,B,C,D', 'Medir la Cantidad de Emisiones', 'Fsn', 500, 'EF1', 0.01000, 100000, NULL, NULL, 'profesor', '2023-12-02 19:27:30', 'profesor', '2023-12-02 20:14:44', 'ACTIVO'),
(2, 1, 3, 0, 1, 2010, 10, 3, '3C4', 'Es un tipo de Fertilizante Quimico', 'A,B,C', 'KG N año', 'Fsn', 37451590, 'EF1', 0.01000, 100000, NULL, NULL, 'profesor', '2023-12-08 23:11:56', 'profesor', '2023-12-08 23:11:56', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_suelosdirectos_resumen`
--

CREATE TABLE `tbl_suelosdirectos_resumen` (
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `nivel_medicion` varchar(45) NOT NULL,
  `id_suelo_directo` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `anio` date DEFAULT current_timestamp(),
  `id_criterios_medicion` bigint(20) NOT NULL,
  `medida_oxidonitroso` decimal(50,2) NOT NULL,
  `medida_dioxidocarbono` decimal(50,2) NOT NULL,
  `equivalente` int(11) NOT NULL,
  `variacion` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_suelos_indirectos`
--

CREATE TABLE `tbl_suelos_indirectos` (
  `id_suelos_indirectos` int(11) NOT NULL,
  `nombre_suelo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_suelos_indirectos`
--

INSERT INTO `tbl_suelos_indirectos` (`id_suelos_indirectos`, `nombre_suelo`, `descripcion`, `id_sector`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 'Suelos rocosos', 'Produce Cambio Climatico', 6, '1', '2023-11-13 16:38:22', '0', '2023-11-13 16:38:22', 'ACTIVO'),
(2, 'Cantidad de Anual de Fertilizante', 'Medir la cantidad de emisionesed', 0, '0', '2023-12-03 20:09:33', '0', '2023-12-03 20:09:33', 'ACTIVO'),
(3, 'Factor de Emision Correspondientes', 'Medir la cantidad de emisiones', 0, '0', '2023-12-03 22:12:24', 'ENRIQUEB', '2023-12-10 13:33:32', 'ACTIVO'),
(4, 'Factor de Emision para Emisiones', 'Medir la cantidad de emisiones', 0, 'profesor', '2023-12-10 09:02:01', 'profesor', '2023-12-10 09:02:01', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_suelos_indirectos_b`
--

CREATE TABLE `tbl_suelos_indirectos_b` (
  `id_suelos_indirectos_b` bigint(11) NOT NULL,
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `id_suelos_indirectos` bigint(20) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `codigo_categoria` varchar(20) NOT NULL,
  `hoja` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `anio` int(11) NOT NULL,
  `cantidad_anual_n` float NOT NULL,
  `fraccion_n` float NOT NULL,
  `cantidad_animal` float NOT NULL,
  `cantidad_orina` float NOT NULL,
  `fraccion_materiales` float NOT NULL,
  `factor_emision` float NOT NULL,
  `cantidad_deposicion` float NOT NULL,
  `n2o_volatilizacion` float NOT NULL,
  `cantidad_residuos` float NOT NULL,
  `cantidad_mineralizado` float NOT NULL,
  `fraccion_mineralizado` float NOT NULL,
  `fraccion_lixiviacion` float NOT NULL,
  `cantidad_lixiviacion` float NOT NULL,
  `n2o_lixxiviacion` float NOT NULL,
  `total` float NOT NULL,
  `categoria_medicion` varchar(20) NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_suelos_indirectos_b`
--

INSERT INTO `tbl_suelos_indirectos_b` (`id_suelos_indirectos_b`, `id_ficha`, `id_categoria_ficha`, `id_sector`, `id_suelos_indirectos`, `id_criterios_medicion`, `descripcion`, `codigo_categoria`, `hoja`, `referencia`, `anio`, `cantidad_anual_n`, `fraccion_n`, `cantidad_animal`, `cantidad_orina`, `fraccion_materiales`, `factor_emision`, `cantidad_deposicion`, `n2o_volatilizacion`, `cantidad_residuos`, `cantidad_mineralizado`, `fraccion_mineralizado`, `fraccion_lixiviacion`, `cantidad_lixiviacion`, `n2o_lixxiviacion`, `total`, `categoria_medicion`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 0, 0, 0, 0, 0, '', '0', 'Aplicacion de fertilizantes', 'Capitulo 11 del volumen de las directrices IPCC 6', 2000, 86010900, 0.1, 11133200, 104911, 0.2, 0.01, 108487, 0.17048, 318100, 0.3, 0.075, 454625, 3326740000000, 5227730, 5227730, '3', '0', '2023-12-03 23:55:35', '0', '2023-12-03 23:55:35', 'ACTIVO'),
(2, 1, 3, 0, 1, 3, 'x', '3C5', 'N2o Directas por la aplicacion de fertilizantes estiercol y Residuos', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 2009, 86010, 0.1, 11133200, 104912000, 0.2, 0.01, 232176, 0.364848, 318101, 0, 0.3, 0.0075, 262010, 0.411731, 0.776578, '3a fermentacion ente', 'profesor', '2023-12-10 02:47:34', 'profesor', '2023-12-10 02:47:34', 'ACTIVO'),
(3, 1, 3, 0, 3, 3, 'x', '3C5', 'N2o Indirectas por la aplicacion de fertilizantes estiercol y Residuos', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 2010, 37451600, 0.1, 11855600, 97884700, 0.2, 0.01, 256932, 0.403751, 256932, 0, 0.3, 0, 0, 0, 0.403751, '3a fermentacion ente', 'profesor', '2023-12-10 04:52:42', 'profesor', '2023-12-10 04:52:42', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipos_cal_n`
--

CREATE TABLE `tbl_tipos_cal_n` (
  `id_tipo_cal` bigint(20) NOT NULL,
  `tipo_cal` varchar(50) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `modificado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipos_cal_n`
--

INSERT INTO `tbl_tipos_cal_n` (`id_tipo_cal`, `tipo_cal`, `id_sector`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 'Piedra Caliza', 0, 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 00:04:57', 'profesor', '2023-12-03 00:04:57', 'ACTIVO'),
(2, 'Dolomita', 0, 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 00:05:15', 'profesor', '2023-12-03 00:05:54', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipos_suelos_directos`
--

CREATE TABLE `tbl_tipos_suelos_directos` (
  `id_suelo_directo` bigint(20) NOT NULL,
  `nombre_suelo` varchar(255) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `creado_por` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(20) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipos_suelos_directos`
--

INSERT INTO `tbl_tipos_suelos_directos` (`id_suelo_directo`, `nombre_suelo`, `id_sector`, `descripcion`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`) VALUES
(1, 'Suelos Organicos Gestionados', 0, 'Medir la cantidad de emisiones', '1', '2023-11-04 19:37:21', 'profesor', '2023-12-10 08:53:10', 'ACTIVO'),
(7, 'Estiercol , Animal, Compost', 0, 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 22:09:17', 'profesor', '2023-12-03 22:09:17', 'ACTIVO'),
(8, 'Residuos Agricolas', 0, 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 22:09:32', 'profesor', '2023-12-03 22:09:32', 'ACTIVO'),
(9, 'Cambio en el uso o de la gestion de tierra', 0, 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 22:09:53', 'profesor', '2023-12-03 22:09:53', 'ACTIVO'),
(10, 'Fertilizante Sintetico', 0, 'Medir la cantidad de emisiones', 'profesor', '2023-12-03 22:10:10', 'profesor', '2023-12-03 22:10:10', 'ACTIVO'),
(11, 'Orina y Estiercol a Tierras de Pastoreo', 0, 'Medir la cantidad de emisiones', 'profesor', '2023-12-10 08:54:09', 'profesor', '2023-12-10 08:54:09', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_urea_medicion`
--

CREATE TABLE `tbl_urea_medicion` (
  `id_urea_medicion` bigint(20) NOT NULL,
  `id_ficha` bigint(20) NOT NULL,
  `id_categoria_ficha` bigint(20) NOT NULL,
  `id_sector` bigint(20) NOT NULL,
  `codigo_categoria` varchar(20) NOT NULL,
  `hoja` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `id_subcategoria_urea` bigint(20) NOT NULL,
  `anio` int(20) DEFAULT NULL,
  `numero_ficha` int(20) NOT NULL,
  `id_criterios_medicion` bigint(20) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fertilizacion_urea` int(20) NOT NULL,
  `factor_urea` decimal(10,2) NOT NULL,
  `emisiones_urea` decimal(10,3) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `creado_por` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `actualizado_por` varchar(50) DEFAULT '',
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('ACTIVO','INACTIVO','','') NOT NULL,
  `variacion` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_urea_medicion`
--

INSERT INTO `tbl_urea_medicion` (`id_urea_medicion`, `id_ficha`, `id_categoria_ficha`, `id_sector`, `codigo_categoria`, `hoja`, `referencia`, `id_subcategoria_urea`, `anio`, `numero_ficha`, `id_criterios_medicion`, `sigla`, `descripcion`, `fertilizacion_urea`, `factor_urea`, `emisiones_urea`, `total`, `creado_por`, `fecha_creacion`, `actualizado_por`, `fecha_actualizacion`, `estado`, `variacion`) VALUES
(1, 1, 10, 0, '3C3', 'CO2 del uso de urea en suelos agricolas tier-1', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 1, 2015, 2, 3, 'Gg', 'Medir las Emisiones', 0, 0.20, 0.000, 0.00, 'profesor', '2023-12-02 00:02:53', 'profesor', '2023-12-02 00:02:53', 'ACTIVO', NULL),
(2, 1, 5, 1, '3C3', 'CO2 del uso de urea en suelos agricolas tier-1', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 1, 20231125, 1, 3, 'A,B', 'Medir las Emisiones', 55052, 0.20, 40.371, 0.00, 'profesor', '2023-11-25 18:48:17', 'profesor', '2023-11-25 18:48:17', 'ACTIVO', NULL),
(3, 1, 10, 0, '3C3', 'CO2 del uso de urea en suelos agricolas tier-1', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 6, 2014, 2, 3, 'Gg', 'Medir las Emisiones', 55052, 0.20, 40.371, 0.00, 'profesor', '2023-12-02 00:04:47', 'profesor', '2023-12-02 00:04:47', 'ACTIVO', NULL),
(4, 1, 10, 0, '3C3', 'CO2 del uso de urea en suelos agricolas tier-1', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 7, 2014, 20, 3, 'A,B,C,D', 'Medir la cantidad de emisiones', 0, 0.20, 0.000, 0.00, 'profesor', '2023-12-03 07:33:49', 'profesor', '2023-12-03 07:33:49', 'ACTIVO', NULL),
(5, 1, 3, 0, '3C3', 'CO2 del uso de urea en suelos agricolas tier-1', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 1, 2015, 100, 3, 'a', 'a', 0, 0.20, 0.000, 0.00, 'profesor', '2023-12-04 02:04:19', 'profesor', '2023-12-04 02:04:19', 'ACTIVO', NULL),
(6, 1, 9, 0, '3C3', '', 'Capitulo 11 del Volumen 4 de las directrices del IPCC del 2006', 8, 2015, 1, 3, 'A,B,C,D', 'x', 0, 0.20, 0.000, 0.00, 'profesor', '2023-12-08 23:19:58', 'profesor', '2023-12-08 23:19:58', 'ACTIVO', NULL);

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
  `Fecha_Vencimiento_Token` datetime DEFAULT NULL,
  `Fecha_Creacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Actualizacion` timestamp NULL DEFAULT current_timestamp(),
  `Preguntas_Contestadas` int(11) NOT NULL,
  `Estado` enum('ACTIVO','INACTIVO','PENDIENTE','BLOQUEADO') NOT NULL,
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

INSERT INTO `usuario` (`id`, `nombre_completo`, `correo`, `usuario`, `contrasena`, `Token`, `Fecha_Vencimiento_Token`, `Fecha_Creacion`, `Fecha_Actualizacion`, `Preguntas_Contestadas`, `Estado`, `Primera_Vez`, `Fecha_Vencimiento`, `Intentos_Preguntas`, `Preguntas_Correctas`, `Id_rol`, `id_estado`, `Creado_Por`, `Actualizado_Por`, `Intentos_Fallidos`) VALUES
(1, 'josefina', 'josefina@gmail.com', 'josefinaABC', '$2y$10$Y9znOXKHEJX4QZpKZdn40.DjcZR/M7v.UsLQ8YWrx2kp1tGrNqpCS', NULL, NULL, '2023-12-09 22:14:53', '2023-10-14 03:50:34', 0, 'ACTIVO', 'SI', '2023-11-01 03:50:34', 0, 0, 1, 1, 1, 1, 0),
(19, 'Profesordos', 'profesorABC@gmail.com', 'profesor', 'Oscarlira-1', '', NULL, '2023-12-08 06:42:43', '2023-10-29 15:09:06', 1, 'ACTIVO', 'SI', '2023-10-29 15:04:47', 1, 1, 1, 1, 0, 0, 1),
(46, 'Oscar Lira', 'lira@esta.com', 'lira', 'Oscarlira-1', NULL, NULL, '2023-12-09 19:34:30', '2023-12-07 07:21:25', 0, 'ACTIVO', 'SI', '2023-12-07 07:21:25', 0, NULL, 2, 1, 0, 0, 0),
(47, 'Jose', 'jose@gmail.com', 'Jose', 'Oscarlira-1', NULL, NULL, '2023-12-10 04:19:04', '2023-12-08 01:52:20', 0, 'ACTIVO', 'SI', '2023-12-08 01:52:20', 0, NULL, 2, 1, 0, 0, 1),
(57, 'OSCAR LIRA', 'kike1@gmail.com', 'DANIEL.ESCOTO', 'Oscarlira-1', NULL, NULL, '2023-12-09 18:51:15', '2023-12-09 17:39:54', 0, 'ACTIVO', 'SI', '1970-01-01 07:00:00', 0, NULL, 2, 1, 0, 0, 1),
(63, 'ENRIQUE DANIEL BUESO', 'enriquemorales872@gmail.com', 'ENRIQUEB', '$2y$10$xcgA6V5yGzK1b7Zr9zSIWeedfVBRo7igkC7ZAXr1dKffeVHuHzaF2', NULL, NULL, '2023-12-10 17:04:05', '2023-12-10 10:04:05', 0, 'ACTIVO', 'SI', '1970-01-01 07:00:00', 0, NULL, 2, 1, 0, 0, 0),
(64, 'ENRIQUE MORALES', 'enriquemorales872@gmail.com', 'ENRIQUEBM', '$2y$10$ioo2yw2NcxPa4KhbBYLYK.o18YRDaRHCmtjHEl4o20Q8Yh.vN3S2K', NULL, NULL, '2023-12-10 10:28:09', '2023-12-10 10:28:09', 0, 'ACTIVO', 'SI', '2023-12-10 10:28:09', 0, NULL, 2, 3, 0, 0, 0);

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
-- Indices de la tabla `tbl_categorias_cultivo`
--
ALTER TABLE `tbl_categorias_cultivo`
  ADD PRIMARY KEY (`id_cultivo`),
  ADD KEY `id_fichacc` (`id_ficha`),
  ADD KEY `id_sectorccu` (`id_sector`);

--
-- Indices de la tabla `tbl_categorias_especies`
--
ALTER TABLE `tbl_categorias_especies`
  ADD PRIMARY KEY (`id_categoria_especie`),
  ADD KEY `id_sector` (`id_sector`);

--
-- Indices de la tabla `tbl_categorias_fichas`
--
ALTER TABLE `tbl_categorias_fichas`
  ADD PRIMARY KEY (`id_categoria_ficha`),
  ADD KEY `id_ficha` (`id_ficha`),
  ADD KEY `fid_sector` (`id_sector`);

--
-- Indices de la tabla `tbl_criterio_medicion`
--
ALTER TABLE `tbl_criterio_medicion`
  ADD PRIMARY KEY (`id_criterios_medicion`),
  ADD KEY `fid_categoria_ficha` (`id_categoria_ficha`);

--
-- Indices de la tabla `tbl_cultivos_encalado_medicion`
--
ALTER TABLE `tbl_cultivos_encalado_medicion`
  ADD KEY `id_fichacem` (`id_ficha`),
  ADD KEY `id_categoria_fichacem` (`id_categoria_ficha`),
  ADD KEY `id_tipo_calcem` (`id_tipo_cal`),
  ADD KEY `id_sectorcem` (`id_sector`),
  ADD KEY `id_criterios_medicioncem` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_cultivos_medicion`
--
ALTER TABLE `tbl_cultivos_medicion`
  ADD PRIMARY KEY (`id_cultivos_medicion`),
  ADD KEY `id_fichacm` (`id_ficha`),
  ADD KEY `id_categoria_fichacm` (`id_categoria_ficha`),
  ADD KEY `id_sectorcm` (`id_sector`),
  ADD KEY `id_cultivocm` (`id_cultivo`),
  ADD KEY `id_criterios_medicioncm` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_cultivos_medicion_resumen3c1bresiduos`
--
ALTER TABLE `tbl_cultivos_medicion_resumen3c1bresiduos`
  ADD KEY `id_fichacr` (`id_ficha`),
  ADD KEY `id_categoria_fichacr` (`id_categoria_ficha`),
  ADD KEY `id_cultivos_medicioncr` (`id_cultivos_medicion`),
  ADD KEY `id_sectorcr` (`id_sector`),
  ADD KEY `id_criterios_medicioncr` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_cultivos_medicion_resumen3c2encalado`
--
ALTER TABLE `tbl_cultivos_medicion_resumen3c2encalado`
  ADD KEY `id_fichaenc` (`id_ficha`),
  ADD KEY `id_categoria_fichaenc` (`id_categoria_ficha`),
  ADD KEY `id_cultivos_medicionenc` (`id_cultivos_medicion`),
  ADD KEY `id_sectorenc` (`id_sector`),
  ADD KEY `id_criterios_medicionenc` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_encalado_medicion_n`
--
ALTER TABLE `tbl_encalado_medicion_n`
  ADD PRIMARY KEY (`id_encalado_medicion`),
  ADD KEY `id_fichaemn` (`id_ficha`),
  ADD KEY `id_categoria_fichaemn` (`id_categoria_ficha`),
  ADD KEY `id_sectoremn` (`id_sector`),
  ADD KEY `id_tipo_calemn` (`id_tipo_cal`),
  ADD KEY `id_criterios_medicionemn` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_especie`
--
ALTER TABLE `tbl_especie`
  ADD PRIMARY KEY (`id_especie`),
  ADD KEY `id_categoria_especie_idx` (`id_categoria_especie`),
  ADD KEY `fkid_sector` (`id_sector`);

--
-- Indices de la tabla `tbl_estado_usuario`
--
ALTER TABLE `tbl_estado_usuario`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `tbl_estiercol_fprp_medicion_n`
--
ALTER TABLE `tbl_estiercol_fprp_medicion_n`
  ADD PRIMARY KEY (`id_fprp_estiercol_medicion`),
  ADD KEY `id_fichaefmn` (`id_ficha`),
  ADD KEY `id_categoria_fichaefmn` (`id_categoria_ficha`),
  ADD KEY `id_sectorefmn` (`id_sector`),
  ADD KEY `id_categoria_especieefmn` (`id_categoria_especie`),
  ADD KEY `id_especieefmn` (`id_especie`),
  ADD KEY `id_criterios_medicionefmn` (`id_criterios_medicion`),
  ADD KEY `id_gestion_estiercol_FPRPmedn` (`id_gestion_estiercol_FPRP`);

--
-- Indices de la tabla `tbl_estiercol_fprp_n`
--
ALTER TABLE `tbl_estiercol_fprp_n`
  ADD PRIMARY KEY (`id_gestion_estiercol_FPRP`),
  ADD KEY `id_sectorefn` (`id_sector`),
  ADD KEY `id_categoria_especieefn` (`id_categoria_especie`),
  ADD KEY `id_especieefn` (`id_especie`);

--
-- Indices de la tabla `tbl_estiercol_n2o`
--
ALTER TABLE `tbl_estiercol_n2o`
  ADD PRIMARY KEY (`id_estiercol`),
  ADD KEY `id_fichaen` (`id_ficha`),
  ADD KEY `id_categoria_fichaen` (`id_categoria_ficha`),
  ADD KEY `id_sectoren` (`id_sector`),
  ADD KEY `id_categoria_especieen` (`id_categoria_especie`),
  ADD KEY `id_especieen` (`id_especie`),
  ADD KEY `id_criterios_medicionen` (`id_criterios_medicion`),
  ADD KEY `id_gestion_estiercol_mmsesn` (`id_gestion_estiercol_mms`);

--
-- Indices de la tabla `tbl_estiercol_n2o_resumen`
--
ALTER TABLE `tbl_estiercol_n2o_resumen`
  ADD KEY `id_fichan2` (`id_ficha`),
  ADD KEY `id_categoria_fichan2` (`id_categoria_ficha`),
  ADD KEY `id_estiercoln2` (`id_estiercol`),
  ADD KEY `id_sectorn2` (`id_sector`),
  ADD KEY `id_criterios_medicionn2` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_fermentacion_estiercol`
--
ALTER TABLE `tbl_fermentacion_estiercol`
  ADD PRIMARY KEY (`id_fermentacion`),
  ADD KEY `id_fichafe` (`id_ficha`),
  ADD KEY `id_categoria_fichafe` (`id_categoria_ficha`),
  ADD KEY `id_sectorfe` (`id_sector`),
  ADD KEY `id_categoria_especiefe` (`id_categoria_especie`),
  ADD KEY `id_especiefe` (`id_especie`),
  ADD KEY `id_criterios_medicionfe` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_fermentacion_estiercol_documentacion`
--
ALTER TABLE `tbl_fermentacion_estiercol_documentacion`
  ADD KEY `id_fichafed` (`id_ficha`),
  ADD KEY `id_categoria_fichafed` (`id_categoria_ficha`),
  ADD KEY `id_fermentacionfed` (`id_fermentacion`);

--
-- Indices de la tabla `tbl_fermentacion_estiercol_resumen`
--
ALTER TABLE `tbl_fermentacion_estiercol_resumen`
  ADD KEY `id_fichafer` (`id_ficha`),
  ADD KEY `id_categoria_fichafer` (`id_categoria_ficha`),
  ADD KEY `id_fermentacionfer` (`id_fermentacion`),
  ADD KEY `id_sectorfer` (`id_sector`);

--
-- Indices de la tabla `tbl_fichas`
--
ALTER TABLE `tbl_fichas`
  ADD PRIMARY KEY (`id_ficha`);

--
-- Indices de la tabla `tbl_fon`
--
ALTER TABLE `tbl_fon`
  ADD PRIMARY KEY (`id_fon`),
  ADD KEY `id_especieen` (`id_especie`),
  ADD KEY `fk_sistema` (`id_sistema`),
  ADD KEY `id_fichafon` (`id_ficha`),
  ADD KEY `id_categoria_fichafon` (`id_categoria_ficha`),
  ADD KEY `id_sectorfon` (`id_sector`),
  ADD KEY `id_categoria_especiefon` (`id_categoria_especie`),
  ADD KEY `id_especiefon` (`id_especie`),
  ADD KEY `id_gestion_estiercol_mmsfon` (`id_gestion_estiercol_mms`),
  ADD KEY `id_criterios_medicionfon` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_gestion_fon_estiercol_resumen`
--
ALTER TABLE `tbl_gestion_fon_estiercol_resumen`
  ADD KEY `id_fichagfon` (`id_ficha`),
  ADD KEY `id_categoria_fichagfon` (`id_categoria_ficha`),
  ADD KEY `id_estiercolgfon` (`id_estiercol`),
  ADD KEY `id_sectorfoner` (`id_sector`);

--
-- Indices de la tabla `tbl_gestion_mms_estiercol`
--
ALTER TABLE `tbl_gestion_mms_estiercol`
  ADD PRIMARY KEY (`id_gestion_estiercol_mms`),
  ADD KEY `id_sectormms` (`id_sector`),
  ADD KEY `id_categoria_especiemms` (`id_categoria_especie`),
  ADD KEY `id_especiemms` (`id_especie`);

--
-- Indices de la tabla `tbl_gestion_mms_estiercol_fon`
--
ALTER TABLE `tbl_gestion_mms_estiercol_fon`
  ADD PRIMARY KEY (`id_gestion_estiercol_fon`);

--
-- Indices de la tabla `tbl_gestion_mms_estiercol_resumen_n`
--
ALTER TABLE `tbl_gestion_mms_estiercol_resumen_n`
  ADD KEY `id_fichager` (`id_ficha`),
  ADD KEY `id_categoria_fichager` (`id_categoria_ficha`),
  ADD KEY `id_sectorger` (`id_sector`);

--
-- Indices de la tabla `tbl_hist_contrasena`
--
ALTER TABLE `tbl_hist_contrasena`
  ADD PRIMARY KEY (`id_hist`),
  ADD KEY `Hist_Usuario_id` (`id`);

--
-- Indices de la tabla `tbl_medicion_urea_resumen`
--
ALTER TABLE `tbl_medicion_urea_resumen`
  ADD KEY `id_fichaurea` (`id_ficha`),
  ADD KEY `id_categoria_fichaurea` (`id_categoria_ficha`),
  ADD KEY `id_subcategoria_ureares` (`id_subcategoria_urea`),
  ADD KEY `id_sectorurea` (`id_sector`),
  ADD KEY `id_criterios_medicionurea` (`id_criterios_medicion`);

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
  ADD PRIMARY KEY (`id_sector`);

--
-- Indices de la tabla `tbl_sistema_mms`
--
ALTER TABLE `tbl_sistema_mms`
  ADD PRIMARY KEY (`id_sistema`);

--
-- Indices de la tabla `tbl_sub_categorias_urea`
--
ALTER TABLE `tbl_sub_categorias_urea`
  ADD PRIMARY KEY (`id_subcategoria_urea`),
  ADD KEY `id_sectorur` (`id_sector`);

--
-- Indices de la tabla `tbl_suelosdirectos_medicion`
--
ALTER TABLE `tbl_suelosdirectos_medicion`
  ADD PRIMARY KEY (`id_suelosDirectos_medicion`),
  ADD KEY `id_fichasdm` (`id_ficha`),
  ADD KEY `id_categoria_fichasdm` (`id_categoria_ficha`),
  ADD KEY `id_sectorsdm` (`id_sector`),
  ADD KEY `id_suelo_directosdm` (`id_suelo_directo`),
  ADD KEY `id_criterios_medicionsdm` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_suelosdirectos_resumen`
--
ALTER TABLE `tbl_suelosdirectos_resumen`
  ADD KEY `id_fichasd` (`id_ficha`),
  ADD KEY `id_categoria_fichasd` (`id_categoria_ficha`),
  ADD KEY `id_suelo_directosd` (`id_suelo_directo`),
  ADD KEY `id_sectorsd` (`id_sector`),
  ADD KEY `id_criterios_medicionsd` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_suelos_indirectos`
--
ALTER TABLE `tbl_suelos_indirectos`
  ADD PRIMARY KEY (`id_suelos_indirectos`);

--
-- Indices de la tabla `tbl_suelos_indirectos_b`
--
ALTER TABLE `tbl_suelos_indirectos_b`
  ADD PRIMARY KEY (`id_suelos_indirectos_b`),
  ADD KEY `id_fichaindib` (`id_ficha`),
  ADD KEY `id_categoria_fichaindib` (`id_categoria_ficha`),
  ADD KEY `id_sectorindib` (`id_sector`),
  ADD KEY `id_suelos_indirectosindib` (`id_suelos_indirectos`),
  ADD KEY `id_criterios_medicionindib` (`id_criterios_medicion`);

--
-- Indices de la tabla `tbl_tipos_cal_n`
--
ALTER TABLE `tbl_tipos_cal_n`
  ADD PRIMARY KEY (`id_tipo_cal`),
  ADD KEY `id_sectortic` (`id_sector`);

--
-- Indices de la tabla `tbl_tipos_suelos_directos`
--
ALTER TABLE `tbl_tipos_suelos_directos`
  ADD PRIMARY KEY (`id_suelo_directo`),
  ADD KEY `id_sectortsd` (`id_sector`);

--
-- Indices de la tabla `tbl_urea_medicion`
--
ALTER TABLE `tbl_urea_medicion`
  ADD PRIMARY KEY (`id_urea_medicion`),
  ADD KEY `id_fichaurm` (`id_ficha`),
  ADD KEY `id_categoria_fichaurm` (`id_categoria_ficha`),
  ADD KEY `id_sectorurm` (`id_sector`),
  ADD KEY `id_criterios_medicionurm` (`id_criterios_medicion`),
  ADD KEY `id_subcategoria_ureaurm` (`id_subcategoria_urea`);

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
  MODIFY `Id_objetos` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `Id_parametros` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `Id_Permisos` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `Id_pregunta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_rol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_categorias_cultivo`
--
ALTER TABLE `tbl_categorias_cultivo`
  MODIFY `id_cultivo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_categorias_especies`
--
ALTER TABLE `tbl_categorias_especies`
  MODIFY `id_categoria_especie` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tbl_categorias_fichas`
--
ALTER TABLE `tbl_categorias_fichas`
  MODIFY `id_categoria_ficha` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_criterio_medicion`
--
ALTER TABLE `tbl_criterio_medicion`
  MODIFY `id_criterios_medicion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_cultivos_medicion`
--
ALTER TABLE `tbl_cultivos_medicion`
  MODIFY `id_cultivos_medicion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_encalado_medicion_n`
--
ALTER TABLE `tbl_encalado_medicion_n`
  MODIFY `id_encalado_medicion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_especie`
--
ALTER TABLE `tbl_especie`
  MODIFY `id_especie` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_estiercol_fprp_medicion_n`
--
ALTER TABLE `tbl_estiercol_fprp_medicion_n`
  MODIFY `id_fprp_estiercol_medicion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_estiercol_fprp_n`
--
ALTER TABLE `tbl_estiercol_fprp_n`
  MODIFY `id_gestion_estiercol_FPRP` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_estiercol_n2o`
--
ALTER TABLE `tbl_estiercol_n2o`
  MODIFY `id_estiercol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_fermentacion_estiercol`
--
ALTER TABLE `tbl_fermentacion_estiercol`
  MODIFY `id_fermentacion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `tbl_fichas`
--
ALTER TABLE `tbl_fichas`
  MODIFY `id_ficha` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_fon`
--
ALTER TABLE `tbl_fon`
  MODIFY `id_fon` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tbl_gestion_mms_estiercol`
--
ALTER TABLE `tbl_gestion_mms_estiercol`
  MODIFY `id_gestion_estiercol_mms` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_gestion_mms_estiercol_fon`
--
ALTER TABLE `tbl_gestion_mms_estiercol_fon`
  MODIFY `id_gestion_estiercol_fon` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_sistema_mms`
--
ALTER TABLE `tbl_sistema_mms`
  MODIFY `id_sistema` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_sub_categorias_urea`
--
ALTER TABLE `tbl_sub_categorias_urea`
  MODIFY `id_subcategoria_urea` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_suelosdirectos_medicion`
--
ALTER TABLE `tbl_suelosdirectos_medicion`
  MODIFY `id_suelosDirectos_medicion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_suelos_indirectos`
--
ALTER TABLE `tbl_suelos_indirectos`
  MODIFY `id_suelos_indirectos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_suelos_indirectos_b`
--
ALTER TABLE `tbl_suelos_indirectos_b`
  MODIFY `id_suelos_indirectos_b` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tipos_cal_n`
--
ALTER TABLE `tbl_tipos_cal_n`
  MODIFY `id_tipo_cal` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipos_suelos_directos`
--
ALTER TABLE `tbl_tipos_suelos_directos`
  MODIFY `id_suelo_directo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_urea_medicion`
--
ALTER TABLE `tbl_urea_medicion`
  MODIFY `id_urea_medicion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--

ALTER TABLE `tbl_sector`
  MODIFY `id_sector` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--



ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD CONSTRAINT `Parametro_Usuario` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `tbl_cultivos_medicion_resumen3c1bresiduos`
--
ALTER TABLE `tbl_cultivos_medicion_resumen3c1bresiduos`
  ADD CONSTRAINT `id_categoria_fichacr` FOREIGN KEY (`id_categoria_ficha`) REFERENCES `tbl_categorias_fichas` (`id_categoria_ficha`),
  ADD CONSTRAINT `id_criterios_medicioncr` FOREIGN KEY (`id_criterios_medicion`) REFERENCES `tbl_criterio_medicion` (`id_criterios_medicion`),
  ADD CONSTRAINT `id_cultivos_medicioncr` FOREIGN KEY (`id_cultivos_medicion`) REFERENCES `tbl_cultivos_medicion` (`id_cultivos_medicion`),
  ADD CONSTRAINT `id_fichacr` FOREIGN KEY (`id_ficha`) REFERENCES `tbl_fichas` (`id_ficha`),
  ADD CONSTRAINT `id_sectorcr` FOREIGN KEY (`id_sector`) REFERENCES `tbl_sector` (`id_sector`);

--
-- Filtros para la tabla `tbl_cultivos_medicion_resumen3c2encalado`
--
ALTER TABLE `tbl_cultivos_medicion_resumen3c2encalado`
  ADD CONSTRAINT `id_categoria_fichaenc` FOREIGN KEY (`id_categoria_ficha`) REFERENCES `tbl_categorias_fichas` (`id_categoria_ficha`),
  ADD CONSTRAINT `id_criterios_medicionenc` FOREIGN KEY (`id_criterios_medicion`) REFERENCES `tbl_criterio_medicion` (`id_criterios_medicion`),
  ADD CONSTRAINT `id_cultivos_medicionenc` FOREIGN KEY (`id_cultivos_medicion`) REFERENCES `tbl_cultivos_medicion` (`id_cultivos_medicion`),
  ADD CONSTRAINT `id_fichaenc` FOREIGN KEY (`id_ficha`) REFERENCES `tbl_fichas` (`id_ficha`),
  ADD CONSTRAINT `id_sectorenc` FOREIGN KEY (`id_sector`) REFERENCES `tbl_sector` (`id_sector`);

--
-- Filtros para la tabla `tbl_encalado_medicion_n`
--
ALTER TABLE `tbl_encalado_medicion_n`
  ADD CONSTRAINT `id_categoria_fichaemn` FOREIGN KEY (`id_categoria_ficha`) REFERENCES `tbl_categorias_fichas` (`id_categoria_ficha`),
  ADD CONSTRAINT `id_criterios_medicionemn` FOREIGN KEY (`id_criterios_medicion`) REFERENCES `tbl_criterio_medicion` (`id_criterios_medicion`),
  ADD CONSTRAINT `id_fichaemn` FOREIGN KEY (`id_ficha`) REFERENCES `tbl_fichas` (`id_ficha`),
  ADD CONSTRAINT `id_sectoremn` FOREIGN KEY (`id_sector`) REFERENCES `tbl_sector` (`id_sector`),
  ADD CONSTRAINT `id_tipo_calemn` FOREIGN KEY (`id_tipo_cal`) REFERENCES `tbl_tipos_cal_n` (`id_tipo_cal`);

--
-- Filtros para la tabla `tbl_estiercol_fprp_medicion_n`
--
ALTER TABLE `tbl_estiercol_fprp_medicion_n`
  ADD CONSTRAINT `id_categoria_especieefmn` FOREIGN KEY (`id_categoria_especie`) REFERENCES `tbl_categorias_especies` (`id_categoria_especie`),
  ADD CONSTRAINT `id_categoria_fichaefmn` FOREIGN KEY (`id_categoria_ficha`) REFERENCES `tbl_categorias_fichas` (`id_categoria_ficha`),
  ADD CONSTRAINT `id_criterios_medicionefmn` FOREIGN KEY (`id_criterios_medicion`) REFERENCES `tbl_criterio_medicion` (`id_criterios_medicion`),
  ADD CONSTRAINT `id_especieefmn` FOREIGN KEY (`id_especie`) REFERENCES `tbl_especie` (`id_especie`),
  ADD CONSTRAINT `id_fichaefmn` FOREIGN KEY (`id_ficha`) REFERENCES `tbl_fichas` (`id_ficha`),
  ADD CONSTRAINT `id_gestion_estiercol_FPRPefmn` FOREIGN KEY (`id_gestion_estiercol_FPRP`) REFERENCES `tbl_estiercol_fprp_n` (`id_gestion_estiercol_FPRP`),
  ADD CONSTRAINT `id_gestion_estiercol_FPRPmedn` FOREIGN KEY (`id_gestion_estiercol_FPRP`) REFERENCES `tbl_estiercol_fprp_n` (`id_gestion_estiercol_FPRP`),
  ADD CONSTRAINT `id_sectorefmn` FOREIGN KEY (`id_sector`) REFERENCES `tbl_sector` (`id_sector`);

--
-- Filtros para la tabla `tbl_estiercol_fprp_n`
--
ALTER TABLE `tbl_estiercol_fprp_n`
  ADD CONSTRAINT `id_categoria_especieefn` FOREIGN KEY (`id_categoria_especie`) REFERENCES `tbl_categorias_especies` (`id_categoria_especie`),
  ADD CONSTRAINT `id_especieefn` FOREIGN KEY (`id_especie`) REFERENCES `tbl_especie` (`id_especie`),
  ADD CONSTRAINT `id_sectorefn` FOREIGN KEY (`id_sector`) REFERENCES `tbl_sector` (`id_sector`);

--
-- Filtros para la tabla `tbl_gestion_fon_estiercol_resumen`
--
ALTER TABLE `tbl_gestion_fon_estiercol_resumen`
  ADD CONSTRAINT `id_categoria_fichagfon` FOREIGN KEY (`id_categoria_ficha`) REFERENCES `tbl_categorias_fichas` (`id_categoria_ficha`),
  ADD CONSTRAINT `id_estiercolgfon` FOREIGN KEY (`id_estiercol`) REFERENCES `tbl_estiercol_n2o` (`id_estiercol`),
  ADD CONSTRAINT `id_fichagfon` FOREIGN KEY (`id_ficha`) REFERENCES `tbl_fichas` (`id_ficha`),
  ADD CONSTRAINT `id_sectorfoner` FOREIGN KEY (`id_sector`) REFERENCES `tbl_sector` (`id_sector`);

--
-- Filtros para la tabla `tbl_gestion_mms_estiercol_resumen_n`
--
ALTER TABLE `tbl_gestion_mms_estiercol_resumen_n`
  ADD CONSTRAINT `id_categoria_fichager` FOREIGN KEY (`id_categoria_ficha`) REFERENCES `tbl_categorias_fichas` (`id_categoria_ficha`),
  ADD CONSTRAINT `id_fichager` FOREIGN KEY (`id_ficha`) REFERENCES `tbl_fichas` (`id_ficha`),
  ADD CONSTRAINT `id_sectorger` FOREIGN KEY (`id_sector`) REFERENCES `tbl_categorias_fichas` (`id_sector`);

--
-- Filtros para la tabla `tbl_medicion_urea_resumen`
--
ALTER TABLE `tbl_medicion_urea_resumen`
  ADD CONSTRAINT `id_categoria_fichaurea` FOREIGN KEY (`id_categoria_ficha`) REFERENCES `tbl_categorias_fichas` (`id_categoria_ficha`),
  ADD CONSTRAINT `id_criterios_medicionurea` FOREIGN KEY (`id_criterios_medicion`) REFERENCES `tbl_criterio_medicion` (`id_criterios_medicion`),
  ADD CONSTRAINT `id_fichaurea` FOREIGN KEY (`id_ficha`) REFERENCES `tbl_fichas` (`id_ficha`),
  ADD CONSTRAINT `id_sectorurea` FOREIGN KEY (`id_sector`) REFERENCES `tbl_sector` (`id_sector`),
  ADD CONSTRAINT `id_subcategoria_ureares` FOREIGN KEY (`id_subcategoria_urea`) REFERENCES `tbl_sub_categorias_urea` (`id_subcategoria_urea`);

--
-- Filtros para la tabla `tbl_suelosdirectos_medicion`
--
ALTER TABLE `tbl_suelosdirectos_medicion`
  ADD CONSTRAINT `id_categoria_fichasdm` FOREIGN KEY (`id_categoria_ficha`) REFERENCES `tbl_categorias_fichas` (`id_categoria_ficha`),
  ADD CONSTRAINT `id_criterios_medicionsdm` FOREIGN KEY (`id_criterios_medicion`) REFERENCES `tbl_criterio_medicion` (`id_criterios_medicion`),
  ADD CONSTRAINT `id_fichasdm` FOREIGN KEY (`id_ficha`) REFERENCES `tbl_fichas` (`id_ficha`),
  ADD CONSTRAINT `id_sectorsdm` FOREIGN KEY (`id_sector`) REFERENCES `tbl_sector` (`id_sector`),
  ADD CONSTRAINT `id_suelo_directosdm` FOREIGN KEY (`id_suelo_directo`) REFERENCES `tbl_tipos_suelos_directos` (`id_suelo_directo`);

--
-- Filtros para la tabla `tbl_suelosdirectos_resumen`
--
ALTER TABLE `tbl_suelosdirectos_resumen`
  ADD CONSTRAINT `id_categoria_fichasd` FOREIGN KEY (`id_categoria_ficha`) REFERENCES `tbl_categorias_fichas` (`id_categoria_ficha`),
  ADD CONSTRAINT `id_criterios_medicionsd` FOREIGN KEY (`id_criterios_medicion`) REFERENCES `tbl_criterio_medicion` (`id_criterios_medicion`),
  ADD CONSTRAINT `id_fichasd` FOREIGN KEY (`id_ficha`) REFERENCES `tbl_fichas` (`id_ficha`),
  ADD CONSTRAINT `id_sectorsd` FOREIGN KEY (`id_sector`) REFERENCES `tbl_sector` (`id_sector`),
  ADD CONSTRAINT `id_suelo_directosd` FOREIGN KEY (`id_suelo_directo`) REFERENCES `tbl_tipos_suelos_directos` (`id_suelo_directo`);

--
-- Filtros para la tabla `tbl_tipos_cal_n`
--
ALTER TABLE `tbl_tipos_cal_n`
  ADD CONSTRAINT `id_sectortic` FOREIGN KEY (`id_sector`) REFERENCES `tbl_sector` (`id_sector`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

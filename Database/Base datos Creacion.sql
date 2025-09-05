-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-09-2025 a las 22:18:09
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
-- Base de datos: `venta`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `Categoria_Modificar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Categoria_Modificar` (IN `vIdCategoria` INT, IN `vNombre` VARCHAR(250))   BEGIN

	UPDATE categoria
    	SET Nombre = vNombre
    WHERE IdCategoria = vIdCategoria;

END$$

DROP PROCEDURE IF EXISTS `Categoria_Nuevo`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Categoria_Nuevo` (IN `vNombre` VARCHAR(250))   BEGIN

	INSERT INTO categoria(Nombre)
    	VALUES(vNombre);

END$$

DROP PROCEDURE IF EXISTS `Categoria_Vigentes`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Categoria_Vigentes` ()   BEGIN

	SELECT *
    	FROM categoria
    WHERE Vigencia = 1
    	ORDER BY Nombre;

END$$

DROP PROCEDURE IF EXISTS `Cliente_Buscar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Cliente_Buscar` (IN `vBuscar` VARCHAR(250))   BEGIN

	SELECT C.IdCliente, P.DNI, P.Persona, P.Celular, P.Correo
    	FROM cliente C
        	JOIN persona P ON C.IdCliente = P.IdPersona
        WHERE P.DNI LIKE CONCAT('%', vBuscar ,'%') OR P.Persona LIKE CONCAT('%', vBuscar ,'%')
        	ORDER BY P.ApPaterno, P.ApMaterno, P.Nombres 
         LIMIT 10;

END$$

DROP PROCEDURE IF EXISTS `Cliente_IdBuscar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Cliente_IdBuscar` (IN `vIdCliente` BIGINT)   BEGIN

	SELECT P.IdPersona, P.DNI, P.Nombres, P.ApPaterno, P.ApMaterno, P.Direccion, P.Celular, P.Correo
    	FROM persona P
        	JOIN cliente C ON P.IdPersona = C.IdCliente
        WHERE C.IdCliente = vIdCliente;

END$$

DROP PROCEDURE IF EXISTS `Cliente_Modificar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Cliente_Modificar` (IN `vIdCliente` BIGINT, IN `vDNI` CHAR(8), IN `vNombres` VARCHAR(150), IN `vApPaterno` VARCHAR(150), IN `vApMaterno` VARCHAR(150), IN `vDireccion` VARCHAR(250), IN `vCelular` VARCHAR(9), IN `vCorreo` VARCHAR(50))   BEGIN
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        RESIGNAL;
    END;
    
    START TRANSACTION;
    
    	UPDATE persona
            SET Nombres = vNombres, ApPaterno = vApPaterno, ApMaterno = vApMaterno, Direccion = vDireccion, Celular = vCelular, Correo = vCorreo, DNI = vDNI
        WHERE IdPersona = vIdCliente;
        
        UPDATE cliente
        	SET FechaActualizado = FechaHora()
        WHERE IdCliente = vIdCliente;
     
    COMMIT;

END$$

DROP PROCEDURE IF EXISTS `Cliente_Nuevo`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Cliente_Nuevo` (IN `vDNI` CHAR(8), IN `vNombres` VARCHAR(150), IN `vApPaterno` VARCHAR(150), IN `vApMaterno` VARCHAR(150), IN `vDireccion` VARCHAR(250), IN `vCelular` VARCHAR(9), IN `vCorreo` VARCHAR(50))   BEGIN

	DECLARE NewIdPersona BIGINT;
    DECLARE NewClave VARCHAR(20);
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        RESIGNAL;
    END;
    
    START TRANSACTION;
    
    	IF EXISTS(SELECT * FROM persona WHERE DNI = vDNI) THEN
        
        	UPDATE persona
            	SET Nombres = vNombres, ApPaterno = vApPaterno, ApMaterno = vApMaterno, Direccion = vDireccion, Celular = vCelular, Correo = vCorreo
            WHERE DNI = vDNI;
            
            SELECT IdPersona
            	INTO NewIdPersona
            FROM persona
            	WHERE DNI = vDNI;
                
        ELSE
        	
            SET NewClave = SUBSTRING(REPLACE(UUID(), '-', ''), 1, 10);
            
            INSERT INTO persona(DNI, Nombres, ApPaterno, ApMaterno, Direccion, Celular, Correo, Clave)
            	VALUES(vDNI, vNombres, vApPaterno, vApMaterno, vDireccion, vCelular, vCorreo, NewClave);
                
           	SET NewIdPersona = LAST_INSERT_ID();
            
        END IF;
        
        INSERT INTO cliente(IdCliente, FechaCreado, FechaActualizado)
        	VALUES(NewIdPersona, FechaHora(), FechaHora());
    
    COMMIT;

END$$

DROP PROCEDURE IF EXISTS `Marca_Modificar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Marca_Modificar` (IN `vIdMarca` INT, IN `vNombre` VARCHAR(250))   BEGIN

	UPDATE marca
    	SET Nombre = vNombre
    WHERE IdMarca = vIdMarca;

END$$

DROP PROCEDURE IF EXISTS `Marca_Nuevo`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Marca_Nuevo` (IN `vNombre` VARCHAR(250))   BEGIN

	INSERT INTO marca(Nombre)
    	VALUES(vNombre);

END$$

DROP PROCEDURE IF EXISTS `Marca_Vigentes`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Marca_Vigentes` ()   BEGIN

	SELECT *
    	FROM marca
    WHERE Vigencia = 1
    	ORDER BY Nombre;

END$$

DROP PROCEDURE IF EXISTS `Producto_Buscar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Producto_Buscar` (IN `vBuscar` VARCHAR(250), IN `vIdCategoria` INT, IN `vIdMarca` INT)   BEGIN

	DECLARE vQuery TEXT;
    
    SET vQuery = CONCAT("
    	SELECT P.IdProducto, P.Nombre, P.Precio, P.Stock, M.Nombre AS Marca, C.Nombre AS Categoria, P.Vigencia
    		FROM producto P
                JOIN categoria C ON P.IdCategoria = C.IdCategoria
                JOIN marca M ON P.IdMarca = M.IdMarca
        	WHERE P.Nombre LIKE CONCAT('%', '", vBuscar, "', '%')");
    
    IF (vIdCategoria <> 0) THEN
    	SET vQuery = CONCAT(vQuery,' AND C.IdCategoria = ', vIdCategoria);
    END IF;
    
    IF (vIdMarca <> 0) THEN
    	SET vQuery = CONCAT(vQuery,' AND M.IdMarca = ', vIdMarca);
    END IF;

	SET vQuery = CONCAT(vQuery,' ORDER BY P.Nombre;');
    
    PREPARE stmt FROM vQuery;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END$$

DROP PROCEDURE IF EXISTS `Producto_IdBuscar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Producto_IdBuscar` (IN `vIdProducto` BIGINT)   BEGIN
	
    SELECT *
    	FROM producto
        	WHERE IdProducto = vIdProducto;

END$$

DROP PROCEDURE IF EXISTS `Producto_IdCategoria`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Producto_IdCategoria` (IN `vIdCategoria` INT)   BEGIN

	IF(vIdCategoria = 0) THEN
    
    	SELECT P.IdProducto, P.Nombre, P.Precio, P.Stock, C.Nombre AS Categoria, M.Nombre AS Marca
        	FROM producto P
            	JOIN categoria C ON P.IdCategoria = C.IdCategoria
                JOIN marca M ON P.IdMarca = M.IdMarca
            WHERE P.Vigencia = 1
            	ORDER BY P.Nombre;         
    
    ELSE
    
    	SELECT P.IdProducto, P.Nombre, P.Precio, P.Stock, C.Nombre AS Categoria, M.Nombre AS Marca
        	FROM producto P
            	JOIN categoria C ON P.IdCategoria = C.IdCategoria
                JOIN marca M ON P.IdMarca = M.IdMarca
            WHERE P.IdCategoria = vIdCategoria AND P.Vigencia = 1
            	ORDER BY P.Nombre;
    
    END IF;

END$$

DROP PROCEDURE IF EXISTS `Producto_Modificar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Producto_Modificar` (IN `vIdProducto` BIGINT, IN `vNombre` VARCHAR(500), IN `vIdCategoria` INT, IN `vIdMarca` INT, IN `vPrecio` DECIMAL(18,2), IN `vStock` INT)   BEGIN

	UPDATE producto
    	SET Nombre = vNombre, IdCategoria = vIdCategoria, IdMarca = vIdMarca, Precio = vPrecio, Stock = vStock
    WHERE IdProducto = vIdProducto;

END$$

DROP PROCEDURE IF EXISTS `Producto_Nuevo`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Producto_Nuevo` (IN `vNombre` VARCHAR(500), IN `vIdCategoria` INT, IN `vIdMarca` INT, IN `vPrecio` DECIMAL(18,2), IN `vStock` INT, IN `vImg` VARCHAR(25))   BEGIN

	INSERT INTO producto(Nombre, IdCategoria, IdMarca, Precio, Stock, Img)
    	VALUES(vNombre, vIdCategoria, vIdMarca, vPrecio, vStock, vImg);

END$$

DROP PROCEDURE IF EXISTS `Producto_Vigentes`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Producto_Vigentes` ()   BEGIN

	SELECT P.IdProducto, P.Nombre AS Producto, P.Precio, P.Stock, C.Nombre AS Categoria, M.Nombre AS Marca
    FROM producto P
        JOIN categoria C ON P.IdCategoria = C.IdCategoria
        JOIN marca M ON P.IdMarca = M.IdMarca
    WHERE P.Vigencia = 1;

END$$

DROP PROCEDURE IF EXISTS `Rol_Vigentes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Rol_Vigentes` ()   BEGIN

	SELECT *
    	FROM rol
    WHERE Vigencia = 1
    	ORDER BY Nombre;

END$$

DROP PROCEDURE IF EXISTS `Trabajador_Baja`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Trabajador_Baja` (IN `vIdTrabajador` BIGINT)   BEGIN

	UPDATE trabajador
    	SET Vigencia = NOT Vigencia, FechaActualizado = FechaHora()
    WHERE IdPersona = vIdTrabajador;

END$$

DROP PROCEDURE IF EXISTS `Trabajador_Buscar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Trabajador_Buscar` (IN `vBuscar` VARCHAR(250))   BEGIN

	SELECT T.IdPersona, P.DNI, P.Nombres, P.Persona, P.Celular, P.Correo, R.Nombre AS Rol_Nombre, T.Vigencia
    	FROM trabajador T
        	JOIN persona P ON T.IdPersona = P.IdPersona
            JOIN rol R ON T.IdRol = R.IdRol
        WHERE P.DNI LIKE CONCAT('%', vBuscar ,'%') OR P.Persona LIKE CONCAT('%', vBuscar ,'%')
        	ORDER BY P.ApPaterno, P.ApMaterno, P.Nombres;

END$$

DROP PROCEDURE IF EXISTS `Trabajador_IdBuscar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Trabajador_IdBuscar` (IN `vIdTrabajador` BIGINT)   BEGIN

	SELECT P.IdPersona, P.DNI, P.Nombres, P.ApPaterno, P.ApMaterno, P.Direccion, P.Celular, P.Correo, T.IdRol, T.FechaIngreso
    	FROM persona P
        	JOIN trabajador T ON P.IdPersona = T.IdPersona
        WHERE T.IdPersona = vIdTrabajador;

END$$

DROP PROCEDURE IF EXISTS `Trabajador_IniciarSesion`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Trabajador_IniciarSesion` (IN `vDNI` CHAR(8), IN `vClave` VARCHAR(20))   BEGIN

	SELECT P.IdPersona, P.DNI, P.Persona, R.Nombre AS Rol_Nombre
        FROM persona P
            JOIN trabajador T ON P.IdPersona = T.IdPersona
            JOIN rol R ON T.IdRol = R.IdRol
        WHERE P.DNI = vDNI AND P.Clave = vClave AND T.Vigencia = 1;

END$$

DROP PROCEDURE IF EXISTS `Trabajador_Modificar`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Trabajador_Modificar` (IN `vIdTrabajador` BIGINT, IN `vDNI` CHAR(8), IN `vNombres` VARCHAR(150), IN `vApPaterno` VARCHAR(150), IN `vApMaterno` VARCHAR(150), IN `vDireccion` VARCHAR(250), IN `vCelular` VARCHAR(9), IN `vCorreo` VARCHAR(50), IN `vIdRol` TINYINT, IN `vFechaIngreso` DATE)   BEGIN
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        RESIGNAL;
    END;
    
    START TRANSACTION;
    
    	UPDATE persona
            SET Nombres = vNombres, ApPaterno = vApPaterno, ApMaterno = vApMaterno, Direccion = vDireccion, Celular = vCelular, Correo = vCorreo, DNI = vDNI
        WHERE IdPersona = vIdTrabajador;
        
        UPDATE trabajador
        	SET IdRol = vIdRol, FechaIngreso = vFechaIngreso, FechaActualizado = FechaHora()
        WHERE IdPersona = vIdTrabajador;
     
    COMMIT;

END$$

DROP PROCEDURE IF EXISTS `Trabajador_Nuevo`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Trabajador_Nuevo` (IN `vDNI` CHAR(8), IN `vNombres` VARCHAR(150), IN `vApPaterno` VARCHAR(150), IN `vApMaterno` VARCHAR(150), IN `vDireccion` VARCHAR(250), IN `vCelular` VARCHAR(9), IN `vCorreo` VARCHAR(50), IN `vIdRol` TINYINT, IN `vFechaIngreso` DATE)   BEGIN

	DECLARE NewIdPersona BIGINT;
    DECLARE NewClave VARCHAR(20);
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    	ROLLBACK;
        RESIGNAL;
    END;
    
    START TRANSACTION;
    
    	IF EXISTS(SELECT * FROM persona WHERE DNI = vDNI) THEN
        
        	UPDATE persona
            	SET Nombres = vNombres, ApPaterno = vApPaterno, ApMaterno = vApMaterno, Direccion = vDireccion, Celular = vCelular, Correo = vCorreo
            WHERE DNI = vDNI;
            
            SELECT IdPersona
            	INTO NewIdPersona
            FROM persona
            	WHERE DNI = vDNI;
                
        ELSE
        	
            SET NewClave = SUBSTRING(REPLACE(UUID(), '-', ''), 1, 10);
            
            INSERT INTO persona(DNI, Nombres, ApPaterno, ApMaterno, Direccion, Celular, Correo, Clave)
            	VALUES(vDNI, vNombres, vApPaterno, vApMaterno, vDireccion, vCelular, vCorreo, NewClave);
                
           	SET NewIdPersona = LAST_INSERT_ID();
            
        END IF;
        
        INSERT INTO trabajador(IdPersona, IdRol, FechaIngreso, FechaCreado, FechaActualizado)
        	VALUES(NewIdPersona, vIdRol, vFechaIngreso, FechaHora(), FechaHora());
    
    COMMIT;

END$$

DROP PROCEDURE IF EXISTS `Venta_DetalleNuevo`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Venta_DetalleNuevo` (IN `vIdVenta` BIGINT, IN `vIdProducto` BIGINT, IN `vCantidad` INT)   BEGIN
	DECLARE vPrecio DECIMAL(18,2);
    
    SELECT Precio
    	INTO vPrecio
    FROM producto
    	WHERE IdProducto = vIdProducto;

	INSERT ventadetalle(IdVenta, IdProducto, Cantidad, Precio)
    	VALUES(vIdVenta, vIdProducto, vCantidad, vPrecio);
        
    UPDATE producto
    	SET Stock = Stock - vCantidad
    WHERE IdProducto = vIdProducto;
    
    UPDATE venta
    	SET Total = Total + (vPrecio * vCantidad)
    WHERE IdVenta = vIdVenta;

END$$

DROP PROCEDURE IF EXISTS `Venta_Nuevo`$$
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `Venta_Nuevo` (IN `vIdTrabajador` BIGINT, IN `vIdCliente` BIGINT, IN `vDocumento` VARCHAR(11), IN `vTipoDoc` CHAR(1), IN `vModalidadPago` VARCHAR(2))   BEGIN

	DECLARE Id BIGINT;
    DECLARE Corr BIGINT;
    
    IF vTipoDoc = 'F' THEN
    	SELECT Factura
        	INTO Corr
        FROM contador;
    ELSE
    	SELECT Boleta
        	INTO Corr
        FROM contador;
    END IF;
    
    INSERT INTO venta(IdTrabajador, IdCliente, Documento, TipoDoc, Serie, Correlativo, Total, ModalidadPago)
    	VALUES(vIdTrabajador, vIdCliente, vDocumento, vTipoDoc, '001', SUBSTRING(100000000 + Corr + 1, 2, 8), 0, vModalidadPago);
        
    SET Id = LAST_INSERT_ID();
    
    IF vTipoDoc = 'F' THEN
    	UPDATE contador
        	SET Factura = Factura + 1;
    ELSE
    	UPDATE contador
        	SET Boleta = Boleta + 1;
    END IF;
    
    SELECT Id AS IdVenta;
        
END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `FechaHora`$$
CREATE DEFINER=`root`@`127.0.0.1` FUNCTION `FechaHora` () RETURNS DATETIME  BEGIN

	RETURN DATE_ADD(NOW(), INTERVAL -5 HOUR);

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `Nombre` varchar(250) NOT NULL DEFAULT '',
  `Vigencia` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `Nombre`, `Vigencia`) VALUES
(1, 'JUGUETES', 1),
(2, 'LINEA MARRON', 1),
(3, 'ELECTRO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `IdCliente` bigint(20) NOT NULL DEFAULT 0,
  `FechaCreado` datetime NOT NULL DEFAULT current_timestamp(),
  `FechaActualizado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`IdCliente`, `FechaCreado`, `FechaActualizado`) VALUES
(2, '2025-04-14 22:32:39', '2025-05-23 14:59:52'),
(3, '2025-04-16 15:09:32', '2025-05-23 15:00:10'),
(5, '2025-05-19 15:55:15', '2025-05-19 15:55:15'),
(6, '2025-05-19 16:42:34', '2025-05-19 16:42:34'),
(7, '2025-05-19 17:05:04', '2025-05-19 17:05:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_ruc`
--

DROP TABLE IF EXISTS `cliente_ruc`;
CREATE TABLE `cliente_ruc` (
  `IdCliente` bigint(20) NOT NULL DEFAULT 0,
  `RUC` char(11) NOT NULL DEFAULT '',
  `RazonSocial` varchar(250) NOT NULL DEFAULT '',
  `DireccionFiscal` varchar(250) NOT NULL DEFAULT '',
  `Departamento` varchar(50) NOT NULL DEFAULT '',
  `Provincia` varchar(50) NOT NULL DEFAULT '',
  `Distrito` varchar(50) NOT NULL DEFAULT '',
  `Vigencia` tinyint(1) NOT NULL DEFAULT 1,
  `FechaCreado` datetime NOT NULL DEFAULT current_timestamp(),
  `FechaActualizado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contador`
--

DROP TABLE IF EXISTS `contador`;
CREATE TABLE `contador` (
  `Boleta` bigint(20) NOT NULL DEFAULT 0,
  `Factura` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contador`
--

INSERT INTO `contador` (`Boleta`, `Factura`) VALUES
(2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `IdMarca` int(11) NOT NULL,
  `Nombre` varchar(250) NOT NULL DEFAULT '',
  `Vigencia` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`IdMarca`, `Nombre`, `Vigencia`) VALUES
(1, 'APPLE', 1),
(2, 'SAMSUNG', 1),
(3, 'LENOVO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

DROP TABLE IF EXISTS `pago`;
CREATE TABLE `pago` (
  `IdPago` bigint(20) NOT NULL,
  `IdVenta` bigint(20) NOT NULL DEFAULT 0,
  `IdTipoPago` tinyint(4) NOT NULL DEFAULT 0,
  `Importe` decimal(18,2) NOT NULL DEFAULT 0.00,
  `IdTrabajador` bigint(20) NOT NULL DEFAULT 0,
  `Vigencia` tinyint(1) NOT NULL DEFAULT 1,
  `FechaCreado` datetime NOT NULL DEFAULT current_timestamp(),
  `FechaActualizado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `IdPersona` bigint(20) NOT NULL,
  `DNI` char(8) NOT NULL DEFAULT '',
  `Nombres` varchar(150) NOT NULL,
  `ApPaterno` varchar(150) NOT NULL DEFAULT '',
  `ApMaterno` varchar(150) NOT NULL DEFAULT '',
  `Persona` text GENERATED ALWAYS AS (concat(`ApPaterno`,' ',`ApMaterno`,' ',`Nombres`)) VIRTUAL,
  `Direccion` varchar(250) NOT NULL DEFAULT '',
  `Celular` varchar(9) NOT NULL DEFAULT '',
  `Correo` varchar(50) NOT NULL DEFAULT '',
  `Clave` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`IdPersona`, `DNI`, `Nombres`, `ApPaterno`, `ApMaterno`, `Direccion`, `Celular`, `Correo`, `Clave`) VALUES
(1, '00000000', 'Administrador', '', '', '', '', '', '123456'),
(2, '71499529', 'Francisco', 'Alván', 'Bazan', '', '979002678', 'fran_oa@hotmail.com', '123456'),
(3, '76356178', 'Carlos', 'Huaman', 'Fernandez', 'Calle Piura 623', '936921669', '76356178@isatec.net', 'b60c65551a'),
(4, '75312703', 'Nathaly', 'Huayama', 'Hoyos', 'Calle Lambayeque 512', '987654321', '75312703@isatec.net', '52e4966920'),
(5, '75712713', 'Nathaly', 'Huayama', 'Hoyos', 'Av. Los proceres 258', '987654321', '75712713@isatec.net', '9083c67634'),
(6, '76637639', 'Gianfranco', 'Salazar', 'Frías', 'Av. Bolognesi 632', '987654321', '76637639@isatec.net', '2cd5b8bb34'),
(7, '74491494', 'Jhon', 'Santisteban', 'Mori', 'Av. sin direccion 569', '987654321', '74491494@isatec.net', '5120399c34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `IdProducto` bigint(20) NOT NULL,
  `Nombre` varchar(500) NOT NULL DEFAULT '',
  `IdCategoria` int(11) NOT NULL DEFAULT 0,
  `IdMarca` int(11) NOT NULL DEFAULT 0,
  `Precio` decimal(18,2) NOT NULL DEFAULT 0.00,
  `Stock` int(11) NOT NULL DEFAULT 0,
  `Img` varchar(25) NOT NULL,
  `Vigencia` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `Nombre`, `IdCategoria`, `IdMarca`, `Precio`, `Stock`, `Img`, `Vigencia`) VALUES
(1, 'Laptop 14 Ploma', 2, 2, 1800.00, 5, '', 1),
(2, 'Refrigeradora 280 Lt.', 3, 1, 2800.00, 12, '', 1),
(3, 'Galaxy S25 Ultra', 3, 2, 6500.00, 10, '', 1),
(4, 'Galxy S24 Ultra', 3, 2, 4500.00, 10, '', 1),
(7, 'Iphone 16 Pro Max', 3, 1, 5890.00, 10, '', 1),
(8, 'Play Doo Odontólogo', 1, 1, 25.00, 10, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `IdRol` tinyint(4) NOT NULL,
  `Nombre` varchar(250) NOT NULL DEFAULT '',
  `Vigencia` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`IdRol`, `Nombre`, `Vigencia`) VALUES
(1, 'Administrador', 1),
(2, 'Supervisor', 1),
(3, 'Cajero(a)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

DROP TABLE IF EXISTS `tipopago`;
CREATE TABLE `tipopago` (
  `IdTipoPago` tinyint(4) NOT NULL,
  `Nombre` varchar(250) NOT NULL DEFAULT '',
  `Vigencia` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

DROP TABLE IF EXISTS `trabajador`;
CREATE TABLE `trabajador` (
  `IdPersona` bigint(20) NOT NULL DEFAULT 0,
  `IdRol` tinyint(4) NOT NULL DEFAULT 0,
  `FechaIngreso` date NOT NULL DEFAULT '1900-01-01',
  `Vigencia` tinyint(1) NOT NULL DEFAULT 1,
  `FechaCreado` datetime NOT NULL DEFAULT current_timestamp(),
  `FechaActualizado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`IdPersona`, `IdRol`, `FechaIngreso`, `Vigencia`, `FechaCreado`, `FechaActualizado`) VALUES
(1, 1, '2025-04-14', 1, '2025-04-14 19:07:50', '2025-04-14 19:07:50'),
(2, 2, '2025-08-01', 1, '2025-08-15 09:04:57', '2025-08-21 12:38:47'),
(3, 3, '2025-04-21', 1, '2025-04-21 15:21:09', '2025-04-23 16:33:54'),
(4, 3, '2025-04-23', 1, '2025-04-23 16:31:31', '2025-04-23 16:31:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta` (
  `IdVenta` bigint(20) NOT NULL,
  `FechaHora` datetime NOT NULL DEFAULT current_timestamp(),
  `IdTrabajador` bigint(20) NOT NULL DEFAULT 0,
  `IdCliente` bigint(20) NOT NULL DEFAULT 0,
  `Documento` varchar(11) NOT NULL DEFAULT '',
  `TipoDoc` char(1) NOT NULL DEFAULT '',
  `Serie` varchar(5) NOT NULL DEFAULT '',
  `Correlativo` varchar(10) NOT NULL DEFAULT '',
  `Comprobante` varchar(50) GENERATED ALWAYS AS (concat(`TipoDoc`,`Serie`,'-',`Correlativo`)) VIRTUAL,
  `Total` decimal(18,2) NOT NULL DEFAULT 0.00,
  `IGV` decimal(18,2) GENERATED ALWAYS AS (`Total` - `Total` / 1.18) VIRTUAL,
  `ModalidadPago` varchar(2) NOT NULL DEFAULT '' COMMENT 'CR: Credito\r\nCO: Contado',
  `Vigencia` tinyint(1) NOT NULL DEFAULT 1,
  `FechaActualizado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`IdVenta`, `FechaHora`, `IdTrabajador`, `IdCliente`, `Documento`, `TipoDoc`, `Serie`, `Correlativo`, `Total`, `ModalidadPago`, `Vigencia`, `FechaActualizado`) VALUES
(1, '2025-05-12 20:38:59', 1, 2, '20184861217', 'F', '001', '1', 3600.00, 'CO', 1, '2025-05-12 20:38:59'),
(2, '2025-05-12 20:39:47', 1, 2, '12345678', 'B', '001', '1', 236.00, 'CR', 1, '2025-05-12 20:39:47'),
(3, '2025-05-12 20:54:23', 1, 2, '20184861217', 'F', '001', '00000002', 236.00, 'CO', 1, '2025-05-12 20:54:23'),
(4, '2025-05-12 20:54:38', 1, 2, '12345678', 'B', '001', '00000002', 418.62, 'CR', 1, '2025-05-12 20:54:38'),
(5, '2025-05-12 22:35:13', 1, 2, '20184861217', 'F', '001', '00000003', 7400.00, 'CR', 1, '2025-05-12 22:35:13'),
(6, '2025-05-14 21:25:42', 1, 2, '20184861217', 'F', '001', '00000004', 0.00, 'CO', 1, '2025-05-14 21:25:42'),
(7, '2025-05-14 21:28:01', 1, 2, '20184861217', 'F', '001', '00000005', 6400.00, 'CO', 1, '2025-05-14 21:28:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventadetalle`
--

DROP TABLE IF EXISTS `ventadetalle`;
CREATE TABLE `ventadetalle` (
  `IdVenta` bigint(20) NOT NULL DEFAULT 0,
  `IdProducto` bigint(20) NOT NULL DEFAULT 0,
  `Cantidad` int(11) NOT NULL DEFAULT 0,
  `Precio` decimal(18,2) NOT NULL DEFAULT 0.00,
  `Total` decimal(18,2) GENERATED ALWAYS AS (`Cantidad` * `Precio`) STORED,
  `IGV` decimal(18,2) GENERATED ALWAYS AS (`Total` - `Total` / 1.18) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventadetalle`
--

INSERT INTO `ventadetalle` (`IdVenta`, `IdProducto`, `Cantidad`, `Precio`) VALUES
(1, 1, 2, 1800.00),
(5, 1, 1, 1800.00),
(5, 2, 2, 2800.00),
(7, 1, 2, 1800.00),
(7, 2, 1, 2800.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`IdCliente`);

--
-- Indices de la tabla `cliente_ruc`
--
ALTER TABLE `cliente_ruc`
  ADD PRIMARY KEY (`IdCliente`,`RUC`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`IdMarca`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`IdPago`),
  ADD KEY `IdTrabajador` (`IdTrabajador`,`Vigencia`,`FechaCreado`),
  ADD KEY `IdVenta` (`IdVenta`,`Vigencia`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`IdPersona`),
  ADD UNIQUE KEY `DNI` (`DNI`),
  ADD KEY `DNI_2` (`DNI`,`Clave`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `Nombre` (`Nombre`(250));

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IdRol`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`IdTipoPago`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`IdPersona`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`IdVenta`),
  ADD KEY `FechaHora` (`FechaHora`,`Vigencia`),
  ADD KEY `FechaHora_2` (`FechaHora`,`IdTrabajador`,`Vigencia`);

--
-- Indices de la tabla `ventadetalle`
--
ALTER TABLE `ventadetalle`
  ADD PRIMARY KEY (`IdVenta`,`IdProducto`),
  ADD KEY `IdVenta` (`IdVenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `IdMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `IdPago` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `IdPersona` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `IdRol` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `IdTipoPago` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `IdVenta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

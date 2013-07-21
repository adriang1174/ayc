-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-07-2013 a las 16:29:45
-- Versión del servidor: 5.1.61-0+squeeze1
-- Versión de PHP: 5.3.3-7+squeeze8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mydb2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE IF NOT EXISTS `alertas` (
  `idalerta` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAlerta` varchar(45) DEFAULT NULL,
  `campoAlerta` varchar(45) DEFAULT NULL,
  `tipoAlerta` int(11) DEFAULT NULL COMMENT '1 = Vigencia (fecha actual es mayor a fecha del campo, se dispara el alerta)\n2 = Falta documentación (si el valor del campo es NO, se dispara el alerta)',
  `idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`idalerta`,`idEmpresa`),
  KEY `fk_alertas_empresas1` (`idEmpresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camposCustom`
--

CREATE TABLE IF NOT EXISTS `camposCustom` (
  `idcampo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCampo` varchar(45) DEFAULT NULL,
  `labelCampo` varchar(45) DEFAULT NULL,
  `idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`idcampo`,`idEmpresa`),
  KEY `fk_camposCustom_empresas1` (`idEmpresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `csv`
--

CREATE TABLE IF NOT EXISTS `csv` (
  `EMail` varchar(200) DEFAULT NULL,
  `Fname` varchar(200) DEFAULT NULL,
  `Lname` varchar(200) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `City` varchar(200) DEFAULT NULL,
  `State` varchar(200) DEFAULT NULL,
  `Zip` varchar(200) DEFAULT NULL,
  `Source` varchar(200) DEFAULT NULL,
  `IP` varchar(200) DEFAULT NULL,
  `DateandTime` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadosAR`
--

CREATE TABLE IF NOT EXISTS `empleadosAR` (
  `IdProveedor` int(11) NOT NULL DEFAULT '999999',
  `Nombre` varchar(50) NOT NULL,
  `Identificacion` bigint(20) NOT NULL,
  `CUIL` bigint(20) DEFAULT NULL,
  `Condicion` varchar(20) DEFAULT NULL,
  `F931` varchar(2) DEFAULT NULL,
  `Poliza` varchar(2) DEFAULT NULL,
  `VigenciaDesde` date DEFAULT NULL,
  `VigenciaHasta` date DEFAULT NULL,
  `SeguroDeVida` varchar(2) DEFAULT NULL,
  `ReciboSueldo` varchar(2) DEFAULT NULL,
  `Repeticion` varchar(2) DEFAULT NULL,
  `Indemnidad` varchar(2) DEFAULT NULL,
  `AptoIngreso` varchar(2) NOT NULL,
  `Responsable` varchar(20) DEFAULT NULL,
  `CentroCosto` varchar(80) DEFAULT NULL,
  `UserUpdate` varchar(50) NOT NULL DEFAULT 'BATCH',
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Identificacion`),
  KEY `IdProveedor` (`IdProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadosUY`
--

CREATE TABLE IF NOT EXISTS `empleadosUY` (
  `IdProveedor` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Identificacion` bigint(20) NOT NULL,
  `Condicion` varchar(2) DEFAULT NULL,
  `BPS` varchar(2) DEFAULT NULL,
  `BPS_Ultimo_Pago` varchar(2) DEFAULT NULL,
  `BSE_certificado` varchar(2) DEFAULT NULL,
  `BSE_pago_periodo` varchar(2) DEFAULT NULL,
  `DGI` varchar(2) DEFAULT NULL,
  `DGI_Ultimo_Pago` varchar(2) DEFAULT NULL,
  `MTSS` varchar(2) DEFAULT NULL,
  `VigenciaDesde` date DEFAULT NULL,
  `VigenciaHasta` date DEFAULT NULL,
  `ReciboSueldo` varchar(2) DEFAULT NULL,
  `Indemnidad` varchar(2) DEFAULT NULL,
  `Responsable` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Identificacion`),
  KEY `IdProveedor` (`IdProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `IdEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `Empresa` varchar(50) NOT NULL,
  `Pais` varchar(2) NOT NULL,
  `Identificacion` bigint(20) NOT NULL,
  `Usuario` varchar(12) NOT NULL,
  `Clave` varchar(12) NOT NULL,
  `Logo` varchar(30) DEFAULT NULL,
  `usuarios_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`IdEmpresa`),
  UNIQUE KEY `Empresa` (`Empresa`),
  KEY `fk_empresas_usuarios1` (`usuarios_idusuario`),
  KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` int(11) NOT NULL,
  `opcion` varchar(100) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `idmenu_parent` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmenu`),
  KEY `fk_menu_menu1` (`idmenu_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `idperfil` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idperfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfilMenu`
--

CREATE TABLE IF NOT EXISTS `perfilMenu` (
  `idperfil` int(11) NOT NULL,
  `idmenu` int(11) NOT NULL,
  PRIMARY KEY (`idperfil`,`idmenu`),
  KEY `fk_perfil_has_menu_menu1` (`idmenu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `IdEmpresa` int(11) NOT NULL DEFAULT '1',
  `IdProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `Proveedor` varchar(50) NOT NULL,
  `Identificacion` bigint(20) NOT NULL,
  `DenunciaCC` varchar(2) DEFAULT 'NO',
  `RiesgoFin` varchar(3) DEFAULT NULL,
  `usuarios_idusuario` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`IdProveedor`),
  UNIQUE KEY `Proveedor` (`Proveedor`,`IdEmpresa`),
  KEY `IdEmpresa` (`IdEmpresa`),
  KEY `fk_proveedores_usuarios1` (`usuarios_idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=255 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receptoresAlertas`
--

CREATE TABLE IF NOT EXISTS `receptoresAlertas` (
  `idreceptoresAlertas` int(11) NOT NULL AUTO_INCREMENT,
  `mailReceptor` varchar(255) NOT NULL,
  `idalerta` int(11) NOT NULL,
  `proveedores_IdProveedor` int(11) NOT NULL,
  PRIMARY KEY (`idreceptoresAlertas`,`idalerta`),
  KEY `fk_receptoresAlertas_alertas1` (`idalerta`),
  KEY `fk_receptoresAlertas_proveedores1` (`proveedores_IdProveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosPerfiles`
--

CREATE TABLE IF NOT EXISTS `usuariosPerfiles` (
  `idusuario` int(11) NOT NULL,
  `idperfil` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`,`idperfil`),
  KEY `fk_usuarios_has_perfil_perfil1` (`idperfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoresCampos`
--

CREATE TABLE IF NOT EXISTS `valoresCampos` (
  `idcampo` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `valorCampo` varchar(10) DEFAULT NULL,
  `empleados_Identificacion` bigint(20) NOT NULL,
  PRIMARY KEY (`idcampo`,`idEmpresa`,`empleados_Identificacion`),
  KEY `fk_valoresCampos_camposCustom1` (`idcampo`,`idEmpresa`),
  KEY `fk_valoresCampos_empleadosAR1` (`empleados_Identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD CONSTRAINT `fk_alertas_empresas1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresas` (`IdEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `camposCustom`
--
ALTER TABLE `camposCustom`
  ADD CONSTRAINT `fk_camposCustom_empresas1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresas` (`IdEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleadosUY`
--
ALTER TABLE `empleadosUY`
  ADD CONSTRAINT `empleadosUY_ibfk_1` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedores` (`IdProveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_empresas_usuarios1` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_menu1` FOREIGN KEY (`idmenu_parent`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `perfilMenu`
--
ALTER TABLE `perfilMenu`
  ADD CONSTRAINT `fk_perfil_has_menu_menu1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_perfil_has_menu_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`IdEmpresa`) REFERENCES `empresas` (`IdEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `receptoresAlertas`
--
ALTER TABLE `receptoresAlertas`
  ADD CONSTRAINT `fk_receptoresAlertas_alertas1` FOREIGN KEY (`idalerta`) REFERENCES `alertas` (`idalerta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receptoresAlertas_proveedores1` FOREIGN KEY (`proveedores_IdProveedor`) REFERENCES `proveedores` (`IdProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuariosPerfiles`
--
ALTER TABLE `usuariosPerfiles`
  ADD CONSTRAINT `fk_usuarios_has_perfil_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_has_perfil_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `valoresCampos`
--
ALTER TABLE `valoresCampos`
  ADD CONSTRAINT `fk_valoresCampos_camposCustom1` FOREIGN KEY (`idcampo`, `idEmpresa`) REFERENCES `camposCustom` (`idcampo`, `idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_valoresCampos_empleadosAR1` FOREIGN KEY (`empleados_Identificacion`) REFERENCES `empleadosAR` (`Identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

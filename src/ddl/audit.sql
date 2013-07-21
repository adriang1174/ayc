SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `audit` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `audit` ;

-- -----------------------------------------------------
-- Table `audit`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`usuarios` (
  `idusuario` INT NOT NULL AUTO_INCREMENT ,
  `usuario` VARCHAR(45) NULL ,
  `clave` VARCHAR(45) NULL ,
  PRIMARY KEY (`idusuario`) )
ENGINE = InnoDB
COMMENT = 'Los usuarios master son los únicos que pueden ver el ABM de Empresas. Al loguearse un usuario master, le debe pedir con que empresa quiere trabajar y en el menu debe tener una opción para cambiar la empresa (y setear la variable de sesión)';


-- -----------------------------------------------------
-- Table `audit`.`empresas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`empresas` (
  `IdEmpresa` INT(11) NOT NULL AUTO_INCREMENT ,
  `Empresa` VARCHAR(50) NOT NULL ,
  `Pais` VARCHAR(2) NOT NULL ,
  `Identificacion` BIGINT(20) NOT NULL ,
  `Usuario` VARCHAR(12) NOT NULL ,
  `Clave` VARCHAR(12) NOT NULL ,
  `Logo` VARCHAR(30) NULL DEFAULT NULL ,
  `usuarios_idusuario` INT NOT NULL ,
  PRIMARY KEY (`IdEmpresa`) ,
  UNIQUE INDEX `Empresa` (`Empresa` ASC) ,
  UNIQUE INDEX `Usuario` (`Usuario` ASC) ,
  INDEX `fk_empresas_usuarios1` (`usuarios_idusuario` ASC) ,
  CONSTRAINT `fk_empresas_usuarios1`
    FOREIGN KEY (`usuarios_idusuario` )
    REFERENCES `audit`.`usuarios` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `audit`.`proveedores`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`proveedores` (
  `IdEmpresa` INT(11) NOT NULL ,
  `IdProveedor` INT(11) NOT NULL AUTO_INCREMENT ,
  `Proveedor` VARCHAR(50) NOT NULL ,
  `Identificacion` BIGINT(20) NOT NULL ,
  `DenunciaCC` VARCHAR(2) NULL DEFAULT 'NO' ,
  `RiesgoFin` VARCHAR(3) NULL DEFAULT NULL ,
  `usuarios_idusuario` INT NOT NULL ,
  PRIMARY KEY (`IdProveedor`) ,
  UNIQUE INDEX `Proveedor` (`Proveedor` ASC, `IdEmpresa` ASC) ,
  INDEX `IdEmpresa` (`IdEmpresa` ASC) ,
  INDEX `fk_proveedores_usuarios1` (`usuarios_idusuario` ASC) ,
  CONSTRAINT `proveedores_ibfk_1`
    FOREIGN KEY (`IdEmpresa` )
    REFERENCES `audit`.`empresas` (`IdEmpresa` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_proveedores_usuarios1`
    FOREIGN KEY (`usuarios_idusuario` )
    REFERENCES `audit`.`usuarios` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 371
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `audit`.`empleadosAR`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`empleadosAR` (
  `IdProveedor` INT(11) NOT NULL ,
  `Nombre` VARCHAR(50) NOT NULL ,
  `Identificacion` BIGINT(20) NOT NULL ,
  `CUIL` BIGINT(20) NULL DEFAULT NULL ,
  `Condicion` VARCHAR(2) NULL DEFAULT NULL ,
  `F931` VARCHAR(2) NULL DEFAULT NULL ,
  `Poliza` VARCHAR(2) NULL DEFAULT NULL ,
  `VigenciaDesde` DATE NULL DEFAULT NULL ,
  `VigenciaHasta` DATE NULL DEFAULT NULL ,
  `SeguroDeVida` VARCHAR(2) NULL DEFAULT NULL ,
  `ReciboSueldo` VARCHAR(2) NULL DEFAULT NULL ,
  `Repeticion` VARCHAR(2) NULL DEFAULT NULL ,
  `Indemnidad` VARCHAR(2) NULL DEFAULT NULL ,
  `AptoIngreso` VARCHAR(2) NOT NULL ,
  `Responsable` VARCHAR(20) NULL DEFAULT NULL ,
  `CentroCosto` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`Identificacion`) ,
  INDEX `IdProveedor` (`IdProveedor` ASC) ,
  CONSTRAINT `empleadosAR_ibfk_1`
    FOREIGN KEY (`IdProveedor` )
    REFERENCES `audit`.`proveedores` (`IdProveedor` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `audit`.`empleadosUY`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`empleadosUY` (
  `IdProveedor` INT(11) NOT NULL ,
  `Nombre` VARCHAR(50) NOT NULL ,
  `Identificacion` BIGINT(20) NOT NULL ,
  `Condicion` VARCHAR(2) NULL DEFAULT NULL ,
  `BPS` VARCHAR(2) NULL DEFAULT NULL ,
  `BPS_Ultimo_Pago` VARCHAR(2) NULL DEFAULT NULL ,
  `BSE_certificado` VARCHAR(2) NULL DEFAULT NULL ,
  `BSE_pago_periodo` VARCHAR(2) NULL DEFAULT NULL ,
  `DGI` VARCHAR(2) NULL DEFAULT NULL ,
  `DGI_Ultimo_Pago` VARCHAR(2) NULL DEFAULT NULL ,
  `MTSS` VARCHAR(2) NULL DEFAULT NULL ,
  `VigenciaDesde` DATE NULL DEFAULT NULL ,
  `VigenciaHasta` DATE NULL DEFAULT NULL ,
  `ReciboSueldo` VARCHAR(2) NULL DEFAULT NULL ,
  `Indemnidad` VARCHAR(2) NULL DEFAULT NULL ,
  `Responsable` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`Identificacion`) ,
  INDEX `IdProveedor` (`IdProveedor` ASC) ,
  CONSTRAINT `empleadosUY_ibfk_1`
    FOREIGN KEY (`IdProveedor` )
    REFERENCES `audit`.`proveedores` (`IdProveedor` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `audit`.`camposCustom`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`camposCustom` (
  `idcampo` INT NOT NULL AUTO_INCREMENT ,
  `nombreCampo` VARCHAR(45) NULL ,
  `labelCampo` VARCHAR(45) NULL ,
  `idEmpresa` INT(11) NOT NULL ,
  PRIMARY KEY (`idcampo`, `idEmpresa`) ,
  INDEX `fk_camposCustom_empresas1` (`idEmpresa` ASC) ,
  CONSTRAINT `fk_camposCustom_empresas1`
    FOREIGN KEY (`idEmpresa` )
    REFERENCES `audit`.`empresas` (`IdEmpresa` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `audit`.`valoresCampos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`valoresCampos` (
  `idcampo` INT NOT NULL ,
  `idEmpresa` INT(11) NOT NULL ,
  `valorCampo` VARCHAR(10) NULL ,
  `empleados_Identificacion` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`idcampo`, `idEmpresa`, `empleados_Identificacion`) ,
  INDEX `fk_valoresCampos_camposCustom1` (`idcampo` ASC, `idEmpresa` ASC) ,
  INDEX `fk_valoresCampos_empleadosAR1` (`empleados_Identificacion` ASC) ,
  CONSTRAINT `fk_valoresCampos_camposCustom1`
    FOREIGN KEY (`idcampo` , `idEmpresa` )
    REFERENCES `audit`.`camposCustom` (`idcampo` , `idEmpresa` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_valoresCampos_empleadosAR1`
    FOREIGN KEY (`empleados_Identificacion` )
    REFERENCES `audit`.`empleadosAR` (`Identificacion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `audit`.`alertas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`alertas` (
  `idalerta` INT NOT NULL AUTO_INCREMENT ,
  `nombreAlerta` VARCHAR(45) NULL ,
  `campoAlerta` VARCHAR(45) NULL ,
  `tipoAlerta` INT NULL COMMENT '1 = Vigencia (fecha actual es mayor a fecha del campo, se dispara el alerta)\n2 = Falta documentación (si el valor del campo es NO, se dispara el alerta)' ,
  `idEmpresa` INT NOT NULL ,
  PRIMARY KEY (`idalerta`, `idEmpresa`) ,
  INDEX `fk_alertas_empresas1` (`idEmpresa` ASC) ,
  CONSTRAINT `fk_alertas_empresas1`
    FOREIGN KEY (`idEmpresa` )
    REFERENCES `audit`.`empresas` (`IdEmpresa` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `audit`.`receptoresAlertas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`receptoresAlertas` (
  `idreceptoresAlertas` INT NOT NULL ,
  `mailReceptor` VARCHAR(255) NOT NULL ,
  `idalerta` INT NOT NULL ,
  PRIMARY KEY (`idreceptoresAlertas`, `idalerta`) ,
  INDEX `fk_receptoresAlertas_alertas1` (`idalerta` ASC) ,
  CONSTRAINT `fk_receptoresAlertas_alertas1`
    FOREIGN KEY (`idalerta` )
    REFERENCES `audit`.`alertas` (`idalerta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `audit`.`menu`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`menu` (
  `idmenu` INT NOT NULL ,
  `opcion` VARCHAR(100) NULL ,
  `link` VARCHAR(255) NULL ,
  `idmenu_parent` INT NULL ,
  `orden` INT NULL ,
  PRIMARY KEY (`idmenu`) ,
  INDEX `fk_menu_menu1` (`idmenu_parent` ASC) ,
  CONSTRAINT `fk_menu_menu1`
    FOREIGN KEY (`idmenu_parent` )
    REFERENCES `audit`.`menu` (`idmenu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `audit`.`perfil`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`perfil` (
  `idperfil` INT NOT NULL ,
  `nombre` VARCHAR(45) NULL ,
  PRIMARY KEY (`idperfil`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `audit`.`usuariosPerfiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`usuariosPerfiles` (
  `idusuario` INT NOT NULL ,
  `idperfil` INT NOT NULL ,
  PRIMARY KEY (`idusuario`, `idperfil`) ,
  INDEX `fk_usuarios_has_perfil_perfil1` (`idperfil` ASC) ,
  CONSTRAINT `fk_usuarios_has_perfil_usuarios1`
    FOREIGN KEY (`idusuario` )
    REFERENCES `audit`.`usuarios` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_perfil_perfil1`
    FOREIGN KEY (`idperfil` )
    REFERENCES `audit`.`perfil` (`idperfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `audit`.`perfilMenu`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `audit`.`perfilMenu` (
  `idperfil` INT NOT NULL ,
  `idmenu` INT NOT NULL ,
  PRIMARY KEY (`idperfil`, `idmenu`) ,
  INDEX `fk_perfil_has_menu_menu1` (`idmenu` ASC) ,
  CONSTRAINT `fk_perfil_has_menu_perfil1`
    FOREIGN KEY (`idperfil` )
    REFERENCES `audit`.`perfil` (`idperfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_has_menu_menu1`
    FOREIGN KEY (`idmenu` )
    REFERENCES `audit`.`menu` (`idmenu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

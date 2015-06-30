delimiter $$
CREATE TRIGGER proveedores_Trigger
AFTER insert ON proveedores
FOR EACH ROW
BEGIN
	declare v_idusuario INT;
	insert into usuarios (usuario,clave) values(new.Identificacion,CONCAT(new.Identificacion, '123'));
	SELECT LAST_INSERT_ID() INTO v_idusuario; 
	insert into usuariosPerfiles (idusuario,idperfil) values(v_idusuario,2);
END$$
delimiter ;

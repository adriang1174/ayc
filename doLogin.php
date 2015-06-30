<?php
include("model/dbconfig.php");

session_start();
// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");
	
//	$is_ajax = $_REQUEST['is_ajax'];
//	if(isset($is_ajax) && $is_ajax)
//	{
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		
		
		//now validating the username and password
		$sql="SELECT a.idusuario,a.usuario, a.clave, nombre as perfil, d.IdProveedor as proveedor, e.IdEmpresa as empresa 
		      FROM usuarios a join 
		           usuariosPerfiles b on(a.idusuario = b.idusuario) join 
		           perfil c on(b.idperfil = c.idperfil) left join
		           proveedores d on(a.idusuario = d.usuarios_idusuario) left join
		           empresas e on(a.idusuario = e.usuarios_idusuario)
		      WHERE a.usuario='".$username."'";
		if(!empty($_REQUEST['empresa']))
					$sql .= " AND (e.IdEmpresa = ".$_REQUEST['empresa'] . " OR c.nombre = 'MASTER')";
		      
		$result=mysql_query($sql);
		//var_dump($sql);
		$row=mysql_fetch_array($result);
		
		//if username exists
		if(mysql_num_rows($result)>0)
		{
			//compare the password
			if(strcmp($row['clave'],$password)==0)
			{
				//var_dump($_REQUEST['empresa']); 
				if(!empty($_REQUEST['empresa'])||$row['perfil']!= 'MASTER')
						echo "success";
				else
						echo "select";
						
				//now set the session from here if needed
				$_SESSION['u_id']=$row['idusuario']; 
				$_SESSION['u_name']=$username; 
				$_SESSION['perfil']=$row['perfil']; 
				if(!empty($_REQUEST['empresa']))
					$_SESSION['empresa']=$_REQUEST['empresa'];
				else
					$_SESSION['empresa']=$row['empresa'];
				$_SESSION['proveedor']=$row['proveedor'];
			}
			else
				echo "no"; 
		}
		else
			echo "no"; //Invalid Login
		
//	}
	
?>
<?php
//
// Acá hay que leer el menu de la BD de acuerdo al Perfil
//

include("model/dbconfig.php");

session_start();
// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");

$sql="select a.*
			from menu a join perfilMenu b on(a.idmenu = b.idmenu)
			join perfil c on(c.idperfil = b.idperfil)
			where c.nombre = '".$_SESSION['perfil']."'";
$result=mysql_query($sql);
//var_dump($sql);
print '<body>
<ul id="menu1">' ;


while($row=mysql_fetch_array($result))
{
		if(empty($row['idmenu_parent']))	
		{
				if(!empty($old_parent))
				{
						print '</ul>';
						print '</li>';
				}
				if(empty($row['link']))	
						print '<li><a href="#">'.$row['opcion'].'</a>';
				else
						print '<li><a href="'.$row['link'].'">'.$row['opcion'].'</a>';
		}
		else
		{
						if ($old_parent != $row['idmenu_parent'])
						{
										print '<ul>';
										$old_parent = $row['idmenu_parent'];
						}
						if(empty($row['link']))	
										print '<li><a href="#">'.$row['opcion'].'</a></li>';
						else
										print '<li><a href="'.$row['link'].'">'.$row['opcion'].'</a></li>';
		}
}
if(!empty($old_parent))
{
		print '</ul>';
		print '</li>';
}
else
		print '</li>';
print '</ul>';
		
/*		
print '<body style="background-color:#FFFFCC;">
<ul id="menu1">
<li><a href="#">Empleados</a>
    <ul>
        <li><a href="empleados.php">Empleados</a></li>
        <li><a href="empleados_prov.php">EmpleadosxProv (3)</a></li>
        <li><a href="empresas.php">Empresas</a></li>
	  </ul>
</li>
</ul>'; */
?>

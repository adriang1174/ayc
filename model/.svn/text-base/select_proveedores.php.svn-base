<?php
include("dbconfig.php");

// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");
echo "<select name='proveedores' id='proveedores'>";
echo '  <option value="0"  selected="selected">-- Seleccione --</option>';
$result = mysql_query("SELECT * FROM proveedores" );
	//var_dump($result);
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
{
			//var_dump($row);
				echo '  <option value="'.$row[IdProveedor].'">'.$row[Proveedor].'</option>';
}
echo "</select>";
?>

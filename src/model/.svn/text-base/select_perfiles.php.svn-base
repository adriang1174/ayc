<?php
include("dbconfig.php");

// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");
echo "<select>";
echo '  <option value="0"  selected="selected">-- Seleccione --</option>';
$result = mysql_query("SELECT * FROM perfil	" );
	//var_dump($result);
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
{
			//var_dump($row);
				echo '  <option value="'.$row[idperfil].'">'.$row[nombre].'</option>';
}
echo "</select>";
?>

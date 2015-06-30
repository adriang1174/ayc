<?php
include("dbconfig.php");

// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");
$idEmpresa = $_REQUEST['idEmpresa'];
echo "<select>";
echo '  <option value="0"  selected="selected">-- Seleccione --</option>';
echo '  <option value="F931">F931</option>';
echo '  <option value="Poliza">Poliza</option>';
echo '  <option value="SeguroDeVida">SeguroDeVida</option>';
echo '  <option value="ReciboSueldo">ReciboSueldo</option>';
echo '  <option value="Repeticion">Repeticion</option>';
echo '  <option value="Indemnidad">Indemnidad</option>';
echo '  <option value="AptoIngreso">AptoIngreso</option>';
$result = mysql_query("SELECT * FROM camposCustom where idEmpresa = ".$idEmpresa );
	//var_dump($result);
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
{
			//var_dump($row);
				echo '  <option value="'.$row[nombreCampo].'">'.$row[nombreCampo].'</option>';
}
echo "</select>";
?>

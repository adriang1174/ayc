<?php
session_start();

include("dbconfig.php");

$campos = "['Identificacion', 'Nombre','CUIL','Condicion','F931','Poliza','Vigencia Desde','Vigencia Hasta','Seguro de Vida','Recibo de Sueldo','Repeticion','Indemnidad','Apto Ingreso','Responsable','Centro de Costo'";

//var_dump($_SESSION['empresa']);

//var_dump("SELECT c.* FROM camposCustom c join empresas e on(c.idEmpresa = e.IdEmpresa) where e.IdEmpresa = ".$_SESSION['empresa']." order by idcampo");

if(!empty($_SESSION['empresa']))
{
						
						$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error());
						mysql_select_db($database) or die("Error conecting to db.");
						$result = mysql_query("SELECT c.* FROM camposCustom c join empresas e on(c.idEmpresa = e.IdEmpresa) where e.IdEmpresa = ".$_SESSION['empresa']." order by idcampo" );
						//var_dump($result);
						
						while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
						{
									//var_dump($row);
										$campos .= " ,'".$row['labelCampo']."'"	 ;
						}

}

$campos .= "]";

echo $campos;

?>
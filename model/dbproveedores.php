<?php
session_start();

include("dbconfig.php");
include("wherequery.php");

$examp = $_GET["q"]; //query number

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
$id = $_GET['id'];
$oper = $_REQUEST['oper'];
//Este deber�a tomarlo de sesion con el login
$idEmpresa = $_SESSION['empresa'];
$idUsuario = $_SESSION['u_id'];

if(!$sidx) $sidx =1;
if(!$limit) $limit =1;

// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");

	if($oper === "add")
		{
                      $NombreProv = $_REQUEST['Proveedor'];
                      $query= "INSERT INTO proveedores (idEmpresa,Proveedor,Identificacion,DenunciaCC,RiesgoFin,usuarios_idusuario) VALUES(".$idEmpresa.",'" .$NombreProv ."','".$_REQUEST['Identificacion']."','".$_REQUEST['DenunciaCC']."','".$_REQUEST['RiesgoFin']."',".$idUsuario.")";
                      $result=mysql_query($query);
					  if($debug == 1)	var_dump($query);
                      //$row = mysql_fetch_array($result,MYSQL_ASSOC); SOLO PARA SELECT
		}
	else if($oper === "edit") 
		{
                      $NombreProv = $_REQUEST['Proveedor'];;
                      $idProv = $_REQUEST['id'];
                      $query= "UPDATE proveedores SET Proveedor ='" .$NombreProv ."', 
                      																Identificacion =".$_REQUEST['Identificacion'].",
                      																DenunciaCC = '".$_REQUEST['DenunciaCC']."',
                      																RiesgoFin = '".$_REQUEST['RiesgoFin']."'  
                      				WHERE Idproveedor = ".$idProv;
                      $result=mysql_query($query);
                      if($debug == 1) var_dump($query);
		}
	else if($oper === "del") 
		{
                      $idCountry = $_REQUEST['id'];
                      $query= "DELETE FROM proveedores WHERE IdProveedor = ".$idCountry;
                      $result=mysql_query($query);
                      if($debug == 1) var_dump($query);
		}

	else
		{ 
			$result = mysql_query("SELECT COUNT(*) AS count FROM proveedores WHERE TRUE " .$wh );
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			$count = $row['count'];

			if( $count >0 ) {
				$total_pages = ceil($count/$limit);
			} else {
				$total_pages = 0;
			}

			if ($page > $total_pages) $page=$total_pages;
			$start = $limit*$page - $limit; // do not put $limit*($page - 1)

			if ($start<0) $start = 0;

			$SQL = $SQL = "SELECT * FROM proveedores WHERE IdEmpresa = ".$idEmpresa .$wh. " ORDER BY $sidx $sord LIMIT $start , $limit"; 
			//var_dump($SQL);
			$result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	        	$responce->page = $page;
		        $responce->total = $total_pages;
		        $responce->records = $count;
		        $i=0;
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
			{
				$responce->rows[$i]['id']=$row[IdProveedor];
				$responce->rows[$i]['cell']=array($row[IdProveedor], $row[Proveedor],$row[Identificacion],$row[DenunciaCC],$row[RiesgoFin]);
				$i++;
			}
       			echo json_encode($responce);
		}
?>
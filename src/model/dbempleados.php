<?php
include("dbconfig.php");
include("wherequery.php");

$examp = $_GET["q"]; //query number

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
$idProv = $_GET['id'];
$oper = $_REQUEST['oper'];
$id = $_POST['id'];

if(!$sidx) $sidx =1;
if(!$limit) $limit =1;

// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");

	if($oper === "add")
		{
                      $NombreProv = $_REQUEST['Proveedor'];
                      $query= "                      INSERT INTO empleadosAR (IdProveedor,
																																							Nombre,
																																							CUIL,
																																							Condicion,
																																							F931,
																																							Poliza,
																																							VigenciaDesde,
																																							VigenciaHasta,
																																							SeguroDeVida,
																																							ReciboSueldo,
																																							Repeticion,
																																							Indemnidad,
																																							AptoIngreso,
																																							Responsable,
																																							CentroCosto) VALUES(".$idProv.",'".$_REQUEST['Nombre']."','".$_REQUEST['CUIL']."','".
																																							$_REQUEST['Condicion']."','".$_REQUEST['F931']."','".$_REQUEST['Poliza']."','".$_REQUEST['VigenciaDesde']."','".
																																							$_REQUEST['VigenciaHasta']."','".$_REQUEST['SeguroDeVida']."','".$_REQUEST['ReciboSueldo']."','".$_REQUEST['Repeticion']."','".
																																							$_REQUEST['Indemnidad']."','".$_REQUEST['AptoIngreso']."','".$_REQUEST['Responsable']."','".$_REQUEST['CentroCosto']."')";

                      $result=mysql_query($query);
										  var_dump($query);
                      //$row = mysql_fetch_array($result,MYSQL_ASSOC); SOLO PARA SELECT
		}
	else if($oper === "edit") 
		{
                      $NombreProv = $_REQUEST['Proveedor'];;
                      $idProv = $_REQUEST['id'];
                      $query= "UPDATE empleadosAR  SET Nombre      = '".$_REQUEST['Nombre']."',
																											 CUIL        = '".$_REQUEST['CUIL']  ."',  
																										   Condicion   = '".$_REQUEST['Condicion']  ."',
																											 F931				 = '".$_REQUEST['F931']  ."',
																											 Poliza      = '".$_REQUEST['Poliza']  ."',
																											 VigenciaDesde = '".$_REQUEST['VigenciaDesde']  ."',
																											 VigenciaHasta = '".$_REQUEST['VigenciaHasta']  ."',
																											 SeguroDeVida  = '".$_REQUEST['SeguroDeVida']  ."',
																											 ReciboSueldo  = '".$_REQUEST['ReciboSueldo']  ."',
																											 Repeticion    = '".$_REQUEST['Repeticion']  ."',
																											 Indemnidad    = '".$_REQUEST['Indemnidad']  ."',
																											 AptoIngreso   = '".$_REQUEST['AptoIngreso']  ."',
																											 Responsable   = '".$_REQUEST['Responsable']  ."',
																											 CentroCosto   = '".$_REQUEST['CentroCosto']  ."' 
                      				WHERE Identificacion = ".$id;
                      $result=mysql_query($query);
                      var_dump($query);
		}
	else if($oper === "del") 
		{
                      $idCountry = $_REQUEST['id'];
                      $query= "DELETE FROM empleadosAR WHERE Identificacion = ".$id;
                      $result=mysql_query($query);
                      var_dump($query);
		}

	else
		{ 
			$result = mysql_query("SELECT COUNT(*) AS count FROM empleadosAR WHERE IdProveedor = ".$idProv." " .$wh );
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

			$SQL = $SQL = "SELECT * FROM empleadosAR WHERE IdProveedor = ".$idProv." " .$wh. " ORDER BY $sidx $sord LIMIT $start , $limit"; 
			$result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	        	$responce->page = $page;
		        $responce->total = $total_pages;
		        $responce->records = $count;
		        $i=0;
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
			{
				$responce->rows[$i]['id']=$row[Identificacion];
				$responce->rows[$i]['cell']=array($row[Identificacion],$row[Nombre], $row[CUIL],$row[Condicion],$row[F931],$row[Poliza],$row[VigenciaDesde],$row[VigenciaHasta],$row[SeguroDeVida],$row[ReciboSueldo],
																		$row[Repeticion],$row[Indemnidad],$row[AptoIngreso],$row[Responsable],$row[CentroCosto]);
				$i++;
			}
       			echo json_encode($responce);
		}
?>
<?php
session_start();

include("dbconfig.php");
include("wherequery.php");

$examp = $_GET["q"]; //query number

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
$oper = $_REQUEST['oper'];


$idAlerta = $_REQUEST['idAlerta'];
if(!$sidx) $sidx =1;
if(!$limit) $limit =1;

// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");

	if($oper === "add")
		{
                      $query= "                      INSERT INTO receptoresAlertas (		mailReceptor,
																																							idalerta,
																																							proveedores_IdProveedor)
																																						 VALUES('".$_REQUEST['mailReceptor']."',".$idAlerta.",".$_REQUEST['proveedores_IdProveedor'].")";

                      $result=mysql_query($query);
						if($debug == 1) var_dump($query);
                      //$row = mysql_fetch_array($result,MYSQL_ASSOC); SOLO PARA SELECT
		}
	else if($oper === "edit") 
		{
                      $idreceptorAlerta = $_REQUEST['id'];
                      $query= "UPDATE receptoresAlertas      SET mailReceptor       = '".$_REQUEST['mailReceptor']."',
                      																			 proveedores_IdProveedor = ".$_REQUEST['proveedores_IdProveedor']."			
                      				WHERE idreceptoresAlertas = ".$idreceptorAlerta;
                      $result=mysql_query($query);
                      if($debug == 1) var_dump($query);
		}
	else if($oper === "del") 
		{
                      $idreceptorAlerta = $_REQUEST['id'];
                      $query= "DELETE FROM receptoresAlertas WHERE idreceptoresAlertas = ".$idreceptorAlerta;
                      $result=mysql_query($query);
                      if($debug == 1) var_dump($query);
		}

	else
		{ 
			$result = mysql_query("SELECT COUNT(*) AS count FROM receptoresAlertas WHERE TRUE  AND idalerta = ".$idAlerta." ".$wh );
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

			$SQL = "SELECT * FROM receptoresAlertas WHERE TRUE " .$wh. " AND idalerta = ".$idAlerta." ORDER BY $sidx $sord LIMIT $start , $limit"; 
			//var_dump($SQL);
			$result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	        	$responce->page = $page;
		        $responce->total = $total_pages;
		        $responce->records = $count;
		        $i=0;
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
			{
				$responce->rows[$i]['id']=$row[idreceptoresAlertas];
				$SQL = "SELECT Proveedor FROM proveedores WHERE IdProveedor = " . $row[proveedores_IdProveedor] ; 
				//var_dump($SQL);
				$result2 = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
				$row2 = mysql_fetch_array($result2,MYSQL_ASSOC);
				$responce->rows[$i]['cell']=array($row[idreceptoresAlertas],$row[mailReceptor], $row2[Proveedor]);
				mysql_free_result($result2);
				$i++;
			}
       			echo json_encode($responce);
		}
?>
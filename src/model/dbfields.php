<?php
session_start();

include("dbconfig.php");
include("wherequery.php");

$examp = $_GET["q"]; //query number

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
$idEmpresa = $_REQUEST['id'];
$oper = $_REQUEST['oper'];


if(!$sidx) $sidx =1;
if(!$limit) $limit =1;

// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");

	if($oper === "add")
		{
											$idEmpresa = $_REQUEST['idEmpresa'];
                      $query= "                      INSERT INTO camposCustom (		nombreCampo,
																																							labelCampo,
																																							idEmpresa )
																																						 VALUES('".$_REQUEST['nombreCampo']."','".$_REQUEST['labelCampo']."',".
																																							$idEmpresa.")";

                      $result=mysql_query($query);
						if($debug == 1)		  var_dump($query);
                      //$row = mysql_fetch_array($result,MYSQL_ASSOC); SOLO PARA SELECT
		}
	else if($oper === "edit") 
		{
											$idEmpresa = $_REQUEST['idEmpresa'];
                      $idCampo   = $_REQUEST['id'];
                      $query= "UPDATE camposCustom  SET nombreCampo      = '".$_REQUEST['nombreCampo']."',
																											  labelCampo       = '".$_REQUEST['labelCampo']  ."'
                      				WHERE idcampo = ".$idCampo;
                      $result=mysql_query($query);
                      if($debug == 1) var_dump($query);
		}
	else if($oper === "del") 
		{
                      $idCampo   = $_REQUEST['id'];
                      $query= "DELETE FROM camposCustom WHERE idcampo = ".$idCampo;
                      $result=mysql_query($query);
                      if($debug == 1) var_dump($query);
		}

	else
		{ 
			$idEmpresa = $_REQUEST['idEmpresa'];
			$result = mysql_query("SELECT COUNT(*) AS count FROM camposCustom WHERE TRUE ".$wh ." AND idEmpresa = ".$idEmpresa );
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

			$SQL = $SQL = "SELECT * FROM camposCustom WHERE TRUE " .$wh. " AND idEmpresa = ".$idEmpresa . " ORDER BY $sidx $sord LIMIT $start , $limit"; 
			$result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	        	$responce->page = $page;
		        $responce->total = $total_pages;
		        $responce->records = $count;
		        $i=0;
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
			{
				$responce->rows[$i]['id']=$row[idcampo];
				$responce->rows[$i]['cell']=array($row[idcampo],$row[nombreCampo], $row[labelCampo]);
				$i++;
			}
       			echo json_encode($responce);
		}
?>
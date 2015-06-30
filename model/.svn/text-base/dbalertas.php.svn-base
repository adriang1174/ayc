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


if(!$sidx) $sidx =1;
if(!$limit) $limit =1;

// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");

	if($oper === "add")
		{
                      $query= "                      INSERT INTO alertas (		nombreAlerta,
																																							campoAlerta,
																																							tipoAlerta,
																																							idEmpresa)
																																						 VALUES('".$_REQUEST['nombreAlerta']."',null,".
																																							$_REQUEST['tipoAlerta'].",".$_REQUEST['idEmpresa'].")";

                      $result=mysql_query($query);
										  var_dump($query);
                      //$row = mysql_fetch_array($result,MYSQL_ASSOC); SOLO PARA SELECT
		}
	else if($oper === "edit") 
		{
                      $idAlerta = $_REQUEST['id'];
                      $query= "UPDATE alertas      SET nombreAlerta       = '".$_REQUEST['nombreAlerta']."',
																										   tipoAlerta         = ".$_REQUEST['tipoAlerta']  .",
																											 idEmpresa				 = ".$_REQUEST['idEmpresa']  ."
                      				WHERE idalerta = ".$idAlerta;
                      $result=mysql_query($query);
                      var_dump($query);
		}
	else if($oper === "del") 
		{
                      $idAlerta = $_REQUEST['id'];
                      $query= "DELETE FROM alertas WHERE idalerta = ".$idAlerta;
                      $result=mysql_query($query);
                      var_dump($query);
		}

	else
		{ 
			$result = mysql_query("SELECT COUNT(*) AS count FROM alertas WHERE TRUE ".$wh );
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

			$SQL = "SELECT * FROM alertas WHERE TRUE " .$wh. " ORDER BY $sidx $sord LIMIT $start , $limit"; 
			$result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	        	$responce->page = $page;
		        $responce->total = $total_pages;
		        $responce->records = $count;
		        $i=0;
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
			{
				$responce->rows[$i]['id']=$row[idalerta];
				$SQL = "SELECT Empresa FROM empresas WHERE idEmpresa = " . $row[idEmpresa] ; 
				$result2 = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
				$row2 = mysql_fetch_array($result2,MYSQL_ASSOC);
				$responce->rows[$i]['cell']=array($row[idalerta],$row[nombreAlerta], $row[tipoAlerta],$row2[Empresa]);
				
				mysql_free_result($result2);
				$i++;
			}
       			echo json_encode($responce);
		}
?>
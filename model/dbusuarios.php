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
                      $query= "                      INSERT INTO usuarios (		usuario,
																																							clave
																																					)
																																						 VALUES('".$_REQUEST['usuario']."','".$_REQUEST['clave']."')";
                      $result=mysql_query($query);
					  if($debug == 1) var_dump($query);
										  $idusuario = mysql_insert_id();
                      $query= "                      INSERT INTO usuariosPerfiles (		
																																											idusuario,
																																											idperfil
																																					)
																																						 VALUES(".$idusuario. ",".$_REQUEST['idperfil'].")";
                      $result=mysql_query($query);
						if($debug == 1)	  var_dump($query);

		}
	else if($oper === "edit") 
		{
                      $idusuario  = $_REQUEST['id'];
                      $query= "UPDATE usuario      SET usuario      = '".$_REQUEST['usuario']."',
																											 clave        = '".$_REQUEST['clave']  ."'  
                      				WHERE idusuario = ".$idusuario;
                      $result=mysql_query($query);
                      if($debug == 1) var_dump($query);
                      $query= "UPDATE usuariosPerfiles    SET idperfil      = ".$_REQUEST['idperfil']."
                   							WHERE idusuario = ".$idusuario;
					  if($debug == 1) var_dump($query);
		}
	else if($oper === "del") 
		{
                      $idusuario = $_REQUEST['id'];
                      $query= "DELETE FROM usuarios WHERE idusuario = ".$idusuario;
                      $result=mysql_query($query);
                      $query= "DELETE FROM usuariosPerfiles WHERE idusuario = ".$idusuario;
                      $result=mysql_query($query);
                      if($debug == 1) var_dump($query);
		}

	else
		{ 
			$result = mysql_query("SELECT COUNT(*) AS count FROM usurios WHERE TRUE ".$wh );
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

			$SQL = $SQL = "SELECT a.idusuario,a.usuario,a.clave,c.nombre 
										 FROM usuarios a join usuariosPerfiles b on(a.idusuario = b.idusuario) 
										 join perfil c on(b.idperfil = c.idperfil) WHERE TRUE " .$wh. " ORDER BY $sidx $sord LIMIT $start , $limit"; 
			$result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	        	$responce->page = $page;
		        $responce->total = $total_pages;
		        $responce->records = $count;
		        $i=0;
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
			{
				$responce->rows[$i]['id']=$row[idusuario];
				$responce->rows[$i]['cell']=array($row[idusuario],$row[usuario], $row[clave],$row[nombre]);
				$i++;
			}
       			echo json_encode($responce);
		}
?>
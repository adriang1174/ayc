<?php
session_start();

include("dbconfig.php");
include("wherequery.php");

$fvigd = $_REQUEST['fechad'];
$fvigh = $_REQUEST['fechah'];
//$ids = explode(':',$_REQUEST['ids']);
$ids = $_REQUEST['ids'];

// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");

 $query= "UPDATE empleadosAR  SET  VigenciaDesde = '".$fvigd ."' ,
                                   VigenciaHasta = '".$fvigh ."'
                      				WHERE Identificacion IN( ".$ids .")";
 $result=mysql_query($query);
 
 //echo $query;
 echo "OK";



?>
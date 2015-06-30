<?php
session_start();
//var_dump($_SESSION);
if(empty($_SESSION['u_name']))
{
		header("Location: index.php");
		exit;
}
?>
<?php
session_start();
include "preload.inc"; //this includes all necessary classes and configs
$db_aux = $db;
include ACTIONS_DIR . "dspHeader.php";
$db = $db_aux;


switch( $attributes['step'] )
{
  case 2:
    include ACTIONS_DIR . "actStep2.php";
    include ACTIONS_DIR . "dspStep2.php";
    break;
  case 3:
    include ACTIONS_DIR . "actStep3.php";
    include ACTIONS_DIR . "dspStep3.php";
    break;
  default:
    include ACTIONS_DIR . "actStep1.php";
    include ACTIONS_DIR . "dspStep1.php";
    break;
}
include ACTIONS_DIR . "dspFooter.php";

?>
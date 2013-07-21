<?php
session_start();
//var_dump($_SESSION);
if(empty($_SESSION['u_name']))
{
		header("Location: index.php");
		exit;
}
include("Cabecera.php")
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#menu1').ptMenu();
});
</script>
</head>
<?php
	include('menu.php');
?>
</body>
</html>
